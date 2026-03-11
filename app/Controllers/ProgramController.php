<?php

namespace App\Controllers;

use App\Models\ProgramBimbelModel;
use App\Models\JadwalModel;
use CodeIgniter\RESTful\ResourceController;

class ProgramController extends ResourceController
{
    protected $programModel;
    protected $jadwalModel;

    public function __construct()
    {
        $this->programModel = new ProgramBimbelModel();
        $this->jadwalModel  = new JadwalModel();
    }

    public function index()
    {
        $data['program'] = $this->programModel->getWithJadwal();
        $data['jadwal']  = $this->jadwalModel->orderBy('hari', 'ASC')->orderBy('jam_mulai', 'ASC')->findAll();
        return view('admin/program', $data);
    }

    public function create()
    {
        $data = [
            'nama_program' => $this->request->getPost('program'),
            'durasi'       => $this->request->getPost('durasi'),
            'tingkat'      => $this->request->getPost('tingkat'),
            'kelas'        => $this->request->getPost('kelas'),
            'harga'        => $this->request->getPost('harga'),
            'keterangan'   => $this->request->getPost('keterangan'),
        ];

        $programId = $this->programModel->insert($data, true);

        if ($programId) {
            // Save jadwal links
            $jadwalIds = $this->request->getPost('jadwal_id') ?? [];
            $this->programModel->saveJadwal((int) $programId, array_values((array) $jadwalIds));

            return redirect()->to('/dashboard/program')
                ->with('success', 'Program berhasil ditambahkan.');
        }

        return redirect()->to('/dashboard/program')
            ->with('error', 'Terjadi kesalahan saat menambahkan program.');
    }

    public function edit($id = null)
    {
        $data = [
            'nama_program' => $this->request->getPost('program'),
            'durasi'       => $this->request->getPost('durasi'),
            'tingkat'      => $this->request->getPost('tingkat'),
            'kelas'        => $this->request->getPost('kelas'),
            'harga'        => $this->request->getPost('harga'),
            'keterangan'   => $this->request->getPost('keterangan'),
        ];

        if ($this->programModel->update($id, $data)) {
            // Replace jadwal links
            $jadwalIds = $this->request->getPost('jadwal_id') ?? [];
            $this->programModel->saveJadwal((int) $id, array_values((array) $jadwalIds));

            return redirect()->to('/dashboard/program')
                ->with('success', 'Program berhasil diperbarui.');
        }

        return redirect()->to('/dashboard/program')
            ->with('error', 'Terjadi kesalahan saat memperbarui program.');
    }

    public function delete($id = null)
    {
        // program_jadwal rows are cascade-deleted via FK
        $this->programModel->delete($id);
        return redirect()->to('/dashboard/program')
            ->with('success', 'Program berhasil dihapus.');
    }
}

