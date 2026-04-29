<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramBimbelModel extends Model
{
    protected $table            = 'program_bimbel';
    protected $primaryKey       = 'program_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_program',
        'durasi',
        'tingkat',
        'kelas',
        'harga',
        'keterangan'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'nama_program' => 'required|min_length[3]|max_length[255]',
        'durasi'       => 'required|max_length[50]',
        'tingkat'      => 'required|in_list[SD,SMP,SMA]',
        'kelas'        => 'required|max_length[20]',
        'harga'        => 'required|numeric',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;

    // Relationship methods
    public function transaksi()
    {
        return $this->hasMany(TransaksiModel::class, 'program_id', 'program_id');
    }

    /**
     * Get all programs with their linked jadwal slots
     */
    public function getWithJadwal(): array
    {
        $db       = \Config\Database::connect();
        $programs = $this->findAll();

        foreach ($programs as &$p) {
            $p['jadwal'] = $db->table('program_jadwal pj')
                ->select('pj.jadwal_id, pj.urutan, j.hari, j.jam_mulai, j.jam_selesai')
                ->join('jadwal j', 'j.jadwal_id = pj.jadwal_id')
                ->where('pj.program_id', $p['program_id'])
                ->orderBy('pj.urutan', 'ASC')
                ->get()
                ->getResultArray();
        }

        return $programs;
    }

    /**
     * Get linked jadwal IDs for a specific program
     */
    public function getJadwalIds(int $programId): array
    {
        $db  = \Config\Database::connect();
        $rows = $db->table('program_jadwal')
            ->select('jadwal_id, urutan')
            ->where('program_id', $programId)
            ->orderBy('urutan', 'ASC')
            ->get()
            ->getResultArray();

        $result = [];
        foreach ($rows as $r) {
            $result[$r['urutan']] = (int) $r['jadwal_id'];
        }
        return $result;
    }

    /**
     * Save (replace) jadwal links for a program
     * @param int   $programId
     * @param int[] $jadwalIds  up to 3 jadwal IDs (index 0 = urutan 1, etc.)
     */
    public function saveJadwal(int $programId, array $jadwalIds): void
    {
        $db = \Config\Database::connect();
        // Delete old links
        $db->table('program_jadwal')->where('program_id', $programId)->delete();
        // Insert new links
        foreach ($jadwalIds as $index => $jadwalId) {
            if (!empty($jadwalId)) {
                $db->table('program_jadwal')->insert([
                    'program_id' => $programId,
                    'jadwal_id'  => (int) $jadwalId,
                    'urutan'     => $index + 1,
                ]);
            }
        }
    }
}
