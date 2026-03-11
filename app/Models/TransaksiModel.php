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
        'jadwal_id',
        'kelas_id',
        'pengajar_id',
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
        return $this->select('transaksi.*, user.nama, user.email, user.nomor_hp, user.tingkat, program_bimbel.nama_program, program_bimbel.tingkat as tingkat_program, program_bimbel.kelas, jadwal.hari, jadwal.jam_mulai, jadwal.jam_selesai, pengajar.nama as nama_pengajar')
            ->join('user', 'user.user_id = transaksi.user_id')
            ->join('program_bimbel', 'program_bimbel.program_id = transaksi.program_id')
            ->join('jadwal', 'jadwal.jadwal_id = transaksi.jadwal_id', 'left')
            ->join('user as pengajar', 'pengajar.user_id = transaksi.pengajar_id', 'left')
            ->orderBy('transaksi.created_at', 'DESC')
            ->findAll();
    }

    public function getTransaksiById($id)
    {
        return $this->select('transaksi.*, user.nama, user.email, user.nomor_hp, user.tingkat, program_bimbel.nama_program, program_bimbel.tingkat as tingkat_program, program_bimbel.kelas, jadwal.hari, jadwal.jam_mulai, jadwal.jam_selesai, pengajar.nama as nama_pengajar')
            ->join('user', 'user.user_id = transaksi.user_id')
            ->join('program_bimbel', 'program_bimbel.program_id = transaksi.program_id')
            ->join('jadwal', 'jadwal.jadwal_id = transaksi.jadwal_id', 'left')
            ->join('user as pengajar', 'pengajar.user_id = transaksi.pengajar_id', 'left')
            ->where('transaksi.transaksi_id', $id)
            ->first();
    }

    public function getTransaksiByUser($userId)
    {
        return $this->select('transaksi.*, program_bimbel.nama_program, program_bimbel.harga, program_bimbel.tingkat, program_bimbel.kelas, program_bimbel.keterangan, jadwal.hari, jadwal.jam_mulai, jadwal.jam_selesai, pengajar.nama as nama_pengajar')
            ->join('program_bimbel', 'program_bimbel.program_id = transaksi.program_id')
            ->join('jadwal', 'jadwal.jadwal_id = transaksi.jadwal_id', 'left')
            ->join('user as pengajar', 'pengajar.user_id = transaksi.pengajar_id', 'left')
            ->where('transaksi.user_id', $userId)
            ->orderBy('transaksi.created_at', 'DESC')
            ->findAll();
    }
}