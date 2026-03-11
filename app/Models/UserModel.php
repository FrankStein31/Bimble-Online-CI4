<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama',
        'nomor_hp',
        'email',
        'role',
        'password',
        'photo',
        'tingkat',
        'jabatan',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    // protected $validationRules = [
    //     'nama'     => 'required|min_length[3]|max_length[255]',
    //     'nomor_hp' => 'required|min_length[10]|max_length[20]',
    //     'email'    => 'required|valid_email|is_unique[user.email,user_id,{user_id}]',
    //     'password' => 'required|min_length[8]',
    //     'role'     => 'required|in_list[admin,siswa,pengajar]',
    // ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Email sudah digunakan. Silakan gunakan email yang lain.',
        ],
    ];

    protected $skipValidation = false;

    // Callbacks
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
        }

        return $data;
    }

    // Relationship methods
    public function transaksi()
    {
        return $this->hasMany(TransaksiModel::class, 'user_id', 'user_id');
    }
}
