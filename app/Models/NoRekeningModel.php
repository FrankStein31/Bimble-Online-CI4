<?php

namespace App\Models;

use CodeIgniter\Model;

class NoRekeningModel extends Model
{
    protected $table            = 'no_rekening';
    protected $primaryKey       = 'rekening_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'bank',
        'no_rek',
        'nama'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'bank'   => 'required|max_length[100]',
        'no_rek' => 'required|max_length[50]',
        'nama'   => 'required|max_length[255]',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
}
