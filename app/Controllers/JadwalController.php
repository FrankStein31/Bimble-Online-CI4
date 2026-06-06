<?php

namespace App\Controllers;

use App\Models\JadwalModel;
use CodeIgniter\RESTful\ResourceController;

class JadwalController extends ResourceController
{
    protected $jadwalModel;
    public function __construct()
    {
        $this->jadwalModel = new JadwalModel();
    }
    public function index()
    {
        $data['jadwal'] = $this->jadwalModel->orderBy('jadwal_id', 'DESC')->findAll();
        return view('admin/jadwal', $data);
    }

    public function add()
    {
        $data = [
            'hari' => $this->request->getPost('hari'),
            'jam_mulai' => $this->request->getPost('jam_mulai'),
            'jam_selesai' => $this->request->getPost('jam_selesai'),
        ];


        if ($this->jadwalModel->insert($data)) {
            return redirect()->to('/dashboard/jadwal')
                ->with('success', 'Jadwal berhasil ditambahkan.');
        } else {
            return redirect()->to('/dashboard/jadwal')
                ->with('error', 'Terjadi kesalahan saat menambahkan jadwal.');
        }
        return view('/dashboard/jadwal');
    }

    public function edit($id = null)
    {
        $data = [
            'hari' => $this->request->getPost('hari'),
            'jam_mulai' => $this->request->getPost('jam_mulai'),
            'jam_selesai' => $this->request->getPost('jam_selesai'),
        ];
        if ($this->jadwalModel->update($id, $data)) {
            return redirect()->to('/dashboard/jadwal')
                ->with('success', 'Jadwal berhasil diperbarui.');
        } else {
            return redirect()->to('/dashboard/jadwal')
                ->with('error', 'Terjadi kesalahan saat memperbarui jadwal.');
        }
    }

    public function delete($id = null)
    {
        $this->jadwalModel->delete($id);
        return redirect()->to('/dashboard/jadwal')
            ->with('success', 'Jadwal berhasil dihapus.');
    }

    public function penugasan()
    {
        $db = \Config\Database::connect();
        $kelas = $db->table('kelas_bimbel')
            ->select('kelas_bimbel.*, program_bimbel.nama_program, program_bimbel.tingkat, program_bimbel.kelas as nama_kelas, jadwal.hari, jadwal.jam_mulai, jadwal.jam_selesai, user.nama as nama_pengajar')
            ->join('program_bimbel', 'program_bimbel.program_id = kelas_bimbel.program_id')
            ->join('jadwal', 'jadwal.jadwal_id = kelas_bimbel.jadwal_id')
            ->join('user', 'user.user_id = kelas_bimbel.pengajar_id', 'left')
            ->orderBy('kelas_bimbel.kelas_id', 'DESC')
            ->get()->getResultArray();

        $userModel = new \App\Models\UserModel();
        $pengajar = $userModel->where('role', 'pengajar')->findAll();

        return view('admin/penugasan', ['kelas' => $kelas, 'pengajar' => $pengajar]);
    }

    public function reassign()
    {
        $kelasId = $this->request->getPost('kelas_id');
        $pengajarId = $this->request->getPost('pengajar_id');

        $kelasModel = new \App\Models\KelasBimbelModel();
        $kelasModel->update($kelasId, ['pengajar_id' => $pengajarId]);

        // Update all transaksi that uses this kelas_id
        $db = \Config\Database::connect();
        $db->table('transaksi')
           ->where('kelas_id', $kelasId)
           ->update(['pengajar_id' => $pengajarId]);

        return redirect()->to(base_url('dashboard/penugasan'))->with('success', 'Pengajar berhasil dipindahkan.');
    }
}
