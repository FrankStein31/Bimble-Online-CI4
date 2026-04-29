<?php

namespace App\Controllers;

use App\Models\HasilBelajarModel;
use App\Models\UserModel;
use App\Models\ProgramBimbelModel;

class HasilBelajarController extends BaseController
{
    protected $hasilBelajarModel;
    protected $userModel;
    protected $programModel;

    public function __construct()
    {
        $this->hasilBelajarModel = new HasilBelajarModel();
        $this->userModel         = new UserModel();
        $this->programModel      = new ProgramBimbelModel();
    }

    public function index()
    {
        $hasil    = $this->hasilBelajarModel->getAll();
        $siswa    = $this->userModel->where('role', 'siswa')->findAll();
        $pengajar = $this->userModel->where('role', 'pengajar')->findAll();
        $program  = $this->programModel->findAll();

        return view('admin/hasil_belajar', [
            'hasil'    => $hasil,
            'siswa'    => $siswa,
            'pengajar' => $pengajar,
            'program'  => $program,
        ]);
    }

    public function add()
    {
        $data = [
            'siswa_id'       => $this->request->getPost('siswa_id'),
            'pengajar_id'    => $this->request->getPost('pengajar_id'),
            'program_id'     => $this->request->getPost('program_id'),
            'mata_pelajaran' => $this->request->getPost('mata_pelajaran'),
            'nilai'          => $this->request->getPost('nilai'),
            'catatan'        => $this->request->getPost('catatan'),
            'tanggal'        => $this->request->getPost('tanggal'),
        ];

        if ($this->hasilBelajarModel->insert($data)) {
            return redirect()->to('/dashboard/hasil-belajar')->with('success', 'Hasil belajar berhasil ditambahkan.');
        }

        return redirect()->to('/dashboard/hasil-belajar')->with('error', 'Gagal menambahkan hasil belajar.');
    }

    public function edit($id = null)
    {
        $data = [
            'siswa_id'       => $this->request->getPost('siswa_id'),
            'pengajar_id'    => $this->request->getPost('pengajar_id'),
            'program_id'     => $this->request->getPost('program_id'),
            'mata_pelajaran' => $this->request->getPost('mata_pelajaran'),
            'nilai'          => $this->request->getPost('nilai'),
            'catatan'        => $this->request->getPost('catatan'),
            'tanggal'        => $this->request->getPost('tanggal'),
        ];

        if ($this->hasilBelajarModel->update($id, $data)) {
            return redirect()->to('/dashboard/hasil-belajar')->with('success', 'Hasil belajar berhasil diperbarui.');
        }

        return redirect()->to('/dashboard/hasil-belajar')->with('error', 'Gagal memperbarui hasil belajar.');
    }

    public function delete($id = null)
    {
        $this->hasilBelajarModel->delete($id);
        return redirect()->to('/dashboard/hasil-belajar')->with('success', 'Hasil belajar berhasil dihapus.');
    }
}
