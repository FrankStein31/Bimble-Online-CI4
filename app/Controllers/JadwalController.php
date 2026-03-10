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
}
