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
}
