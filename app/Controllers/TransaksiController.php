<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\UserModel;
use App\Models\ProgramBimbelModel;
use App\Models\JadwalModel;
use App\Models\KelasBimbelModel;
use CodeIgniter\RESTful\ResourceController;

class TransaksiController extends ResourceController
{
    protected $transaksiModel;
    protected $userModel;
    protected $programBimbelModel;
    protected $jadwalModel;
    protected $kelasModel;

    public function __construct()
    {
        $this->transaksiModel     = new TransaksiModel();
        $this->userModel          = new UserModel();
        $this->programBimbelModel = new ProgramBimbelModel();
        $this->jadwalModel        = new JadwalModel();
        $this->kelasModel         = new KelasBimbelModel();
    }

    public function transaksi()
    {
        $db = \Config\Database::connect();

        $data['transaksi'] = $this->transaksiModel->getTransaksiWithDetails();
        $data['siswa']     = $this->userModel->where('role', 'siswa')->findAll();
        $data['program']   = $this->programBimbelModel->findAll();
        $data['jadwal']    = $this->jadwalModel->findAll();

        // Jadwal per program (untuk info di edit modal)
        $programJadwal = [];
        $pjRows = $db->table('program_jadwal pj')
            ->select('pj.program_id, pj.jadwal_id, pj.urutan, j.hari, j.jam_mulai, j.jam_selesai')
            ->join('jadwal j', 'j.jadwal_id = pj.jadwal_id')
            ->orderBy('pj.program_id')->orderBy('pj.urutan')
            ->get()->getResultArray();
        foreach ($pjRows as $row) {
            $pid = $row['program_id'];
            if (!isset($programJadwal[$pid])) $programJadwal[$pid] = [];
            $programJadwal[$pid][] = $row['hari'] . ' ' . substr($row['jam_mulai'], 0, 5) . '–' . substr($row['jam_selesai'], 0, 5);
        }
        $data['programJadwal'] = $programJadwal;

        return view('admin/transaksi', $data);
    }

    public function add()
    {
        $bukti     = $this->request->getFile('photo_bukti');
        $buktiName = null;

        if ($bukti && $bukti->isValid() && !$bukti->hasMoved()) {
            $buktiName = $bukti->getRandomName();
            $bukti->move(ROOTPATH . 'public/uploads/bukti_pembayaran', $buktiName);
        }

        $data = [
            'user_id'    => $this->request->getPost('user_id'),
            'program_id' => $this->request->getPost('program_id'),
            'jadwal_id'  => $this->request->getPost('jadwal_id') ?: null,
            'tagihan'    => $this->request->getPost('tagihan'),
            'status'     => $this->request->getPost('status'),
            'photo_bukti'=> $buktiName,
        ];

        $this->transaksiModel->insert($data);

        // Jika status langsung lunas, assign guru
        if ($data['status'] === 'lunas') {
            $transaksiId = $this->transaksiModel->insertID();
            $this->assignGuru($transaksiId);
        }

        return redirect()->to(base_url('dashboard/transaksi'))->with('success', 'Data transaksi berhasil ditambahkan.');
    }

    public function edit($id = null)
    {
        if ($id === null) {
            return redirect()->to(base_url('dashboard/transaksi'))->with('error', 'ID transaksi tidak ditemukan.');
        }

        $transaksi = $this->transaksiModel->find($id);
        if (!$transaksi) {
            return redirect()->to(base_url('dashboard/transaksi'))->with('error', 'Data transaksi tidak ditemukan.');
        }

        $statusLama = $transaksi['status'];
        $statusBaru = $this->request->getPost('status');

        $newProgramId = (int) $this->request->getPost('program_id');

        // Jika program berubah, reset jadwal_id ke jadwal pertama dari program baru
        $jadwalId = $transaksi['jadwal_id'];
        if ($newProgramId !== (int) $transaksi['program_id']) {
            $db = \Config\Database::connect();
            $pj = $db->table('program_jadwal')
                ->where('program_id', $newProgramId)
                ->orderBy('urutan', 'ASC')
                ->get()->getRowArray();
            $jadwalId = $pj ? (int) $pj['jadwal_id'] : null;
        }

        $data = [
            'user_id'    => $this->request->getPost('user_id'),
            'program_id' => $newProgramId,
            'jadwal_id'  => $jadwalId,
            'tagihan'    => $this->request->getPost('tagihan'),
            'status'     => $statusBaru,
        ];

        $bukti = $this->request->getFile('photo_bukti');
        if ($bukti && $bukti->isValid() && !$bukti->hasMoved()) {
            if ($transaksi['photo_bukti'] && file_exists(ROOTPATH . 'public/uploads/bukti_pembayaran/' . $transaksi['photo_bukti'])) {
                unlink(ROOTPATH . 'public/uploads/bukti_pembayaran/' . $transaksi['photo_bukti']);
            }
            $buktiName          = $bukti->getRandomName();
            $bukti->move(ROOTPATH . 'public/uploads/bukti_pembayaran', $buktiName);
            $data['photo_bukti'] = $buktiName;
        }

        $this->transaksiModel->update($id, $data);

        // Auto-assign guru jika status baru = lunas dan belum ada kelas
        if ($statusBaru === 'lunas' && $statusLama !== 'lunas') {
            $this->assignGuru($id);
        }

        // Jika status berubah dari lunas ke ditolak, kurangi slot kelas
        if ($statusLama === 'lunas' && $statusBaru === 'ditolak') {
            $this->lepasKelas($id, $transaksi);
        }

        return redirect()->to(base_url('dashboard/transaksi'))->with('success', 'Data transaksi berhasil diperbarui.');
    }

    /**
     * Quick status update — called via POST from inline buttons in the table.
     * Handles auto-assign on lunas and class release on ditolak.
     */
    public function updateStatus($id = null)
    {
        if (!$id) {
            return redirect()->to(base_url('dashboard/transaksi'))->with('error', 'ID tidak valid.');
        }

        $transaksi = $this->transaksiModel->find($id);
        if (!$transaksi) {
            return redirect()->to(base_url('dashboard/transaksi'))->with('error', 'Transaksi tidak ditemukan.');
        }

        $statusLama = $transaksi['status'];
        $statusBaru = $this->request->getPost('status');

        if (!in_array($statusBaru, ['pending', 'lunas', 'ditolak'])) {
            return redirect()->to(base_url('dashboard/transaksi'))->with('error', 'Status tidak valid.');
        }

        $this->transaksiModel->update($id, ['status' => $statusBaru]);

        if ($statusBaru === 'lunas' && $statusLama !== 'lunas') {
            $this->assignGuru((int) $id);
        }

        if ($statusLama === 'lunas' && $statusBaru !== 'lunas') {
            $this->lepasKelas((int) $id, $transaksi);
        }

        $labels = ['lunas' => 'Lunas', 'pending' => 'Pending', 'ditolak' => 'Ditolak'];
        return redirect()->to(base_url('dashboard/transaksi'))
            ->with('success', 'Status transaksi ' . $transaksi['user_id'] . ' diubah ke ' . $labels[$statusBaru] . '.');
    }

    public function delete($id = null)
    {
        if ($id === null) {
            return redirect()->to(base_url('dashboard/transaksi'))->with('error', 'ID transaksi tidak ditemukan.');
        }

        $transaksi = $this->transaksiModel->find($id);
        if (!$transaksi) {
            return redirect()->to(base_url('dashboard/transaksi'))->with('error', 'Data transaksi tidak ditemukan.');
        }

        // Kurangi slot kelas jika transaksi lunas dihapus
        if ($transaksi['status'] === 'lunas' && $transaksi['kelas_id']) {
            $this->kelasModel->kurangiTerisi((int) $transaksi['kelas_id']);
        }

        if ($transaksi['photo_bukti'] && file_exists(ROOTPATH . 'public/uploads/bukti_pembayaran/' . $transaksi['photo_bukti'])) {
            unlink(ROOTPATH . 'public/uploads/bukti_pembayaran/' . $transaksi['photo_bukti']);
        }

        $this->transaksiModel->delete($id);

        return redirect()->to(base_url('dashboard/transaksi'))->with('success', 'Data transaksi berhasil dihapus.');
    }

    public function viewBukti($id = null)
    {
        if ($id === null) {
            return redirect()->to(base_url('dashboard/transaksi'))->with('error', 'ID transaksi tidak ditemukan.');
        }

        $transaksi = $this->transaksiModel->getTransaksiById($id);
        if (!$transaksi) {
            return redirect()->to(base_url('dashboard/transaksi'))->with('error', 'Data transaksi tidak ditemukan.');
        }

        $data['transaksi'] = $transaksi;
        return view('admin/bukti_pembayaran', $data);
    }

    /**
     * Auto-assign guru ke transaksi yang baru lunas.
     * Jika jadwal_id belum diset, ambil jadwal pertama dari program_jadwal.
     * Cari/buat kelas_bimbel dengan slot tersedia.
     * Update transaksi.kelas_id dan transaksi.pengajar_id.
     */
    private function assignGuru(int $transaksiId): void
    {
        $transaksi = $this->transaksiModel->find($transaksiId);
        if (!$transaksi) {
            return;
        }

        // Cek sudah ada kelas_id (sudah assigned sebelumnya)
        if ($transaksi['kelas_id']) {
            return;
        }

        // Ambil tingkat program
        $program = $this->programBimbelModel->find($transaksi['program_id']);
        if (!$program) {
            return;
        }

        $tingkat   = $program['tingkat'];
        $programId = (int) $transaksi['program_id'];

        // Jika jadwal_id belum diset, ambil jadwal pertama dari program_jadwal
        $jadwalId = $transaksi['jadwal_id'] ? (int) $transaksi['jadwal_id'] : null;
        if (!$jadwalId) {
            $db = \Config\Database::connect();
            $pj = $db->table('program_jadwal')
                ->where('program_id', $programId)
                ->orderBy('urutan', 'ASC')
                ->get()->getRowArray();
            if ($pj) {
                $jadwalId = (int) $pj['jadwal_id'];
                // Simpan jadwal_id ke transaksi agar konsisten
                $this->transaksiModel->update($transaksiId, ['jadwal_id' => $jadwalId]);
            }
        }

        if (!$jadwalId) {
            log_message('warning', "Program $programId tidak memiliki jadwal terdaftar, assign dibatalkan.");
            return;
        }

        // Cari atau buat kelas bimbel
        $kelasId = $this->kelasModel->getOrCreateKelas($programId, $jadwalId, $tingkat);

        if (!$kelasId) {
            // Tidak ada pengajar tersedia — catat tapi jangan block
            log_message('warning', "Tidak ada pengajar tersedia untuk program $programId jadwal $jadwalId tingkat $tingkat");
            return;
        }

        // Ambil pengajar_id dari kelas
        $kelas = $this->kelasModel->find($kelasId);

        // Update transaksi dengan kelas_id dan pengajar_id
        $this->transaksiModel->update($transaksiId, [
            'kelas_id'    => $kelasId,
            'pengajar_id' => $kelas['pengajar_id'],
        ]);

        // Tambah jumlah siswa di kelas
        $this->kelasModel->tambahTerisi($kelasId);
    }

    /**
     * Lepas siswa dari kelas jika transaksi dibatalkan/ditolak setelah lunas.
     */
    private function lepasKelas(int $transaksiId, array $transaksi): void
    {
        if ($transaksi['kelas_id']) {
            $this->kelasModel->kurangiTerisi((int) $transaksi['kelas_id']);
        }

        $this->transaksiModel->update($transaksiId, [
            'kelas_id'    => null,
            'pengajar_id' => null,
        ]);
    }
}
