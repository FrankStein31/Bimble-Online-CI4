<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table            = 'transaksi';
    protected $primaryKey       = 'transaksi_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'program_id',
        'tagihan',
        'photo_bukti',
        'status'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'user_id'     => 'required|integer|is_not_unique[user.user_id]',
        'program_id'  => 'required|integer|is_not_unique[program_bimbel.program_id]',
        'tagihan'     => 'required|numeric',
        'status'      => 'required|in_list[pending,lunas,ditolak]',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;

    // Relationship methods
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }

    public function program()
    {
        return $this->belongsTo(ProgramBimbelModel::class, 'program_id', 'program_id');
    }

    // Helper methods
    public function getTransaksiWithDetails()
    {
        return $this->select('transaksi.*, user.*, program_bimbel.*')
            ->join('user', 'user.user_id = transaksi.user_id')
            ->join('program_bimbel', 'program_bimbel.program_id = transaksi.program_id')
            ->findAll();
    }

    public function getTransaksiById($id)
    {
        return $this->select('transaksi.*, user.*, program_bimbel.*')
            ->join('user', 'user.user_id = transaksi.user_id')
            ->join('program_bimbel', 'program_bimbel.program_id = transaksi.program_id')
            ->where('transaksi.transaksi_id', $id)
            ->first();
    }

    public function getTransaksiByUser($userId)
    {
        return $this->select('transaksi.*, program_bimbel.nama_program, program_bimbel.harga, program_bimbel.tingkat, program_bimbel.kelas, program_bimbel.keterangan')
            ->join('program_bimbel', 'program_bimbel.program_id = transaksi.program_id')
            ->where('transaksi.user_id', $userId)
            ->orderBy('transaksi.created_at', 'DESC')
            ->findAll();
    }
}
