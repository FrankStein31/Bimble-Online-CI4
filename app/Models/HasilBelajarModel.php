<?php

namespace App\Models;

use CodeIgniter\Model;

class HasilBelajarModel extends Model
{
    protected $table            = 'hasil_belajar';
    protected $primaryKey       = 'hasil_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'siswa_id',
        'pengajar_id',
        'program_id',
        'mata_pelajaran',
        'nilai',
        'catatan',
        'tanggal',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'siswa_id'      => 'required|integer',
        'pengajar_id'   => 'required|integer',
        'program_id'    => 'required|integer',
        'mata_pelajaran'=> 'required|max_length[100]',
        'nilai'         => 'permit_empty|decimal',
        'tanggal'       => 'required|valid_date',
    ];

    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getByPengajar($pengajarId)
    {
        return $this->select('hasil_belajar.*, siswa.nama as nama_siswa, siswa.nomor_hp, program_bimbel.nama_program, program_bimbel.tingkat, program_bimbel.kelas')
            ->join('user as siswa', 'siswa.user_id = hasil_belajar.siswa_id')
            ->join('program_bimbel', 'program_bimbel.program_id = hasil_belajar.program_id')
            ->where('hasil_belajar.pengajar_id', $pengajarId)
            ->orderBy('hasil_belajar.tanggal', 'DESC')
            ->findAll();
    }

    public function getBySiswa($siswaId)
    {
        return $this->select('hasil_belajar.*, pengajar.nama as nama_pengajar, program_bimbel.nama_program, program_bimbel.tingkat, program_bimbel.kelas')
            ->join('user as pengajar', 'pengajar.user_id = hasil_belajar.pengajar_id')
            ->join('program_bimbel', 'program_bimbel.program_id = hasil_belajar.program_id')
            ->where('hasil_belajar.siswa_id', $siswaId)
            ->orderBy('hasil_belajar.tanggal', 'DESC')
            ->findAll();
    }

    public function getAll()
    {
        return $this->select('hasil_belajar.*, siswa.nama as nama_siswa, pengajar.nama as nama_pengajar, program_bimbel.nama_program, program_bimbel.tingkat, program_bimbel.kelas')
            ->join('user as siswa', 'siswa.user_id = hasil_belajar.siswa_id')
            ->join('user as pengajar', 'pengajar.user_id = hasil_belajar.pengajar_id')
            ->join('program_bimbel', 'program_bimbel.program_id = hasil_belajar.program_id')
            ->orderBy('hasil_belajar.tanggal', 'DESC')
            ->findAll();
    }

    public function getByPengajarAndSiswa($pengajarId, $siswaId)
    {
        return $this->select('hasil_belajar.*, program_bimbel.nama_program, program_bimbel.tingkat, program_bimbel.kelas')
            ->join('program_bimbel', 'program_bimbel.program_id = hasil_belajar.program_id')
            ->where('hasil_belajar.pengajar_id', $pengajarId)
            ->where('hasil_belajar.siswa_id', $siswaId)
            ->orderBy('hasil_belajar.tanggal', 'DESC')
            ->findAll();
    }
}
