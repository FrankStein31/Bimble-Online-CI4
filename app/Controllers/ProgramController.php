<?php

namespace App\Controllers;

use App\Models\ProgramBimbelModel;
use CodeIgniter\RESTful\ResourceController;

class ProgramController extends ResourceController
{
    protected $programModel;
    public function __construct()
    {
        $this->programModel = new ProgramBimbelModel();
    }
    public function index()
    {
        $data['program'] = $this->programModel->findAll();
        return view('admin/program', $data);
    }

    public function create()
    {
        $data = [
            'nama_program' => $this->request->getPost('program'),
            'durasi' => $this->request->getPost('durasi'),
            'tingkat' => $this->request->getPost('tingkat'),
            'kelas' => $this->request->getPost('kelas'),
            'harga' => $this->request->getPost('harga'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];

        if ($this->programModel->insert($data)) {
            return redirect()->to('/dashboard/program')
                ->with('success', 'Program berhasil ditambahkan.');
        } else {
            return redirect()->to('/dashboard/program')
                ->with('error', 'Terjadi kesalahan saat menambahkan program.');
        }

        return view('admin/program');
    }

    public function edit($id = null)
    {
        $data = [
            'nama_program' => $this->request->getPost('program'),
            'durasi' => $this->request->getPost('durasi'),
            'tingkat' => $this->request->getPost('tingkat'),
            'kelas' => $this->request->getPost('kelas'),
            'harga' => $this->request->getPost('harga'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];

        if ($this->programModel->update($id, $data)) {
            return redirect()->to('/dashboard/program')
                ->with('success', 'Program berhasil diperbarui.');
        } else {
            return redirect()->to('/dashboard/program')
                ->with('error', 'Terjadi kesalahan saat memperbarui program.');
        }
        return view('admin/program');
    }

    public function delete($id = null)
    {
        $this->programModel->delete($id);
        return redirect()->to('/dashboard/program')
            ->with('success', 'Program berhasil dihapus.');
    }
}
