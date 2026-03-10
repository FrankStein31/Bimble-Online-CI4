<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaDiterimaPtnModel extends Model
{
    protected $table            = 'siswa_diterima_ptn';
    protected $primaryKey       = 'siswa_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_siswa',
        'prodi',
        'nama_kampus',
        'tahun_diterima',
        'photo'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'nama_siswa'     => 'required|max_length[255]',
        'prodi'          => 'required|max_length[255]',
        'nama_kampus'    => 'required|max_length[255]',
        'tahun_diterima' => 'required',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
}
