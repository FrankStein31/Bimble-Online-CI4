<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasBimbelModel extends Model
{
    protected $table            = 'kelas_bimbel';
    protected $primaryKey       = 'kelas_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'program_id',
        'jadwal_id',
        'pengajar_id',
        'kuota',
        'terisi',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Cari kelas yang masih ada slot kosong untuk program + jadwal + jabatan pengajar tertentu.
     * Jabatan pengajar harus sama dengan tingkat program (SD/SMP/SMA).
     *
     * @param int    $programId
     * @param int    $jadwalId
     * @param string $tingkat   SD|SMP|SMA
     * @return array|null
     */
    public function cariKelasAvailable(int $programId, int $jadwalId, string $tingkat): ?array
    {
        return $this->select('kelas_bimbel.*, user.nama as nama_pengajar')
            ->join('user', 'user.user_id = kelas_bimbel.pengajar_id')
            ->where('kelas_bimbel.program_id', $programId)
            ->where('kelas_bimbel.jadwal_id', $jadwalId)
            ->where('user.jabatan', $tingkat)
            ->where('kelas_bimbel.terisi <', 'kelas_bimbel.kuota', false)
            ->orderBy('kelas_bimbel.kelas_id', 'ASC')
            ->first();
    }

    /**
     * Cari atau buat kelas bimbel. Jika semua kelas penuh, buat kelas baru
     * dengan pengajar berikutnya yang sesuai jabatan dan belum memiliki kelas
     * di slot yang sama. Return kelas_id.
     *
     * @param int    $programId
     * @param int    $jadwalId
     * @param string $tingkat
     * @return int|null kelas_id yang akan dipakai, null jika tidak ada pengajar tersedia
     */
    public function getOrCreateKelas(int $programId, int $jadwalId, string $tingkat): ?int
    {
        $db = \Config\Database::connect();

        // 1. Cari kelas yang sudah ada dan masih ada slot
        $kelas = $this->select('kelas_bimbel.*')
            ->join('user', 'user.user_id = kelas_bimbel.pengajar_id')
            ->where('kelas_bimbel.program_id', $programId)
            ->where('kelas_bimbel.jadwal_id', $jadwalId)
            ->where('user.jabatan', $tingkat)
            ->where('kelas_bimbel.terisi <', 'kelas_bimbel.kuota', false)
            ->orderBy('kelas_bimbel.kelas_id', 'ASC')
            ->first();

        if ($kelas) {
            return (int) $kelas['kelas_id'];
        }

        // 2. Tidak ada slot kosong → cari pengajar yang belum punya kelas di slot ini
        $pengajarSudahPunya = $db->table('kelas_bimbel')
            ->select('pengajar_id')
            ->where('program_id', $programId)
            ->where('jadwal_id', $jadwalId)
            ->get()->getResultArray();

        $pengajarSudahPunyaIds = array_column($pengajarSudahPunya, 'pengajar_id');

        $userModel = new UserModel();
        $pengajarQuery = $userModel->where('role', 'pengajar')->where('jabatan', $tingkat);

        if (!empty($pengajarSudahPunyaIds)) {
            $pengajarQuery->whereNotIn('user_id', $pengajarSudahPunyaIds);
        }

        $pengajar = $pengajarQuery->first();

        if (!$pengajar) {
            return null; // Tidak ada pengajar tersedia
        }

        // 3. Buat kelas baru dengan pengajar baru
        $this->insert([
            'program_id'  => $programId,
            'jadwal_id'   => $jadwalId,
            'pengajar_id' => $pengajar['user_id'],
            'kuota'       => 5,
            'terisi'      => 0,
        ]);

        return (int) $this->insertID();
    }

    /**
     * Tambah 1 ke jumlah terisi setelah siswa dikonfirmasi (lunas).
     */
    public function tambahTerisi(int $kelasId): void
    {
        $this->set('terisi', 'terisi + 1', false)
             ->where('kelas_id', $kelasId)
             ->update();
    }

    /**
     * Kurangi 1 dari jumlah terisi (misal jika transaksi dihapus/ditolak setelah lunas).
     */
    public function kurangiTerisi(int $kelasId): void
    {
        $this->set('terisi', 'IF(terisi > 0, terisi - 1, 0)', false)
             ->where('kelas_id', $kelasId)
             ->update();
    }

    /**
     * Ambil detail kelas lengkap (join program + jadwal + pengajar).
     */
    public function getKelasWithDetails(int $kelasId): ?array
    {
        return $this->select('kelas_bimbel.*, program_bimbel.nama_program, program_bimbel.tingkat, program_bimbel.kelas, jadwal.hari, jadwal.jam_mulai, jadwal.jam_selesai, user.nama as nama_pengajar')
            ->join('program_bimbel', 'program_bimbel.program_id = kelas_bimbel.program_id')
            ->join('jadwal', 'jadwal.jadwal_id = kelas_bimbel.jadwal_id')
            ->join('user', 'user.user_id = kelas_bimbel.pengajar_id')
            ->where('kelas_bimbel.kelas_id', $kelasId)
            ->first();
    }

    /**
     * Ambil semua kelas milik seorang pengajar.
     * Setiap kelas dilengkapi jadwal_list dari program_jadwal (semua jadwal program).
     */
    public function getKelasByPengajar(int $pengajarId): array
    {
        $db   = \Config\Database::connect();
        $rows = $this->select('kelas_bimbel.*, program_bimbel.nama_program, program_bimbel.tingkat, program_bimbel.kelas as kelas_program')
            ->join('program_bimbel', 'program_bimbel.program_id = kelas_bimbel.program_id')
            ->where('kelas_bimbel.pengajar_id', $pengajarId)
            ->orderBy('kelas_bimbel.kelas_id', 'ASC')
            ->findAll();

        // Attach semua jadwal dari program_jadwal per kelas
        foreach ($rows as &$row) {
            $jadwalList = $db->table('program_jadwal pj')
                ->select('j.jadwal_id, j.hari, j.jam_mulai, j.jam_selesai')
                ->join('jadwal j', 'j.jadwal_id = pj.jadwal_id')
                ->where('pj.program_id', $row['program_id'])
                ->orderBy('pj.urutan', 'ASC')
                ->get()->getResultArray();
            $row['jadwal_list'] = $jadwalList;
            // Backward-compat: isi hari/jam dari jadwal pertama
            $row['hari']        = $jadwalList[0]['hari']        ?? null;
            $row['jam_mulai']   = $jadwalList[0]['jam_mulai']   ?? null;
            $row['jam_selesai'] = $jadwalList[0]['jam_selesai'] ?? null;
        }

        return $rows;
    }
}
