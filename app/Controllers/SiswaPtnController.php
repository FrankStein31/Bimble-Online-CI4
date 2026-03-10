<?php

namespace App\Controllers;

use App\Models\SiswaDiterimaPtnModel;
use CodeIgniter\Controller;

class SiswaPtnController extends Controller
{
    protected $siswaPtnModel;
    protected $validation;

    public function __construct()
    {
        $this->siswaPtnModel = new SiswaDiterimaPtnModel();
        $this->validation = \Config\Services::validation();
    }

    // Menampilkan daftar siswa diterima PTN
    public function index()
    {
        $data['siswa'] = $this->siswaPtnModel->orderBy('tahun_diterima', 'DESC')->findAll();
        return view('admin/siswaDiterima', $data);
    }

    // Menambahkan data siswa baru
    public function add()
    {

        // Siapkan data untuk disimpan
        $data = [
            'nama_siswa' => $this->request->getPost('nama_siswa'),
            'prodi' => $this->request->getPost('prodi'),
            'nama_kampus' => $this->request->getPost('kampus'),
            'tahun_diterima' => $this->request->getPost('tahun')
        ];


        // Penanganan upload foto
        $file = $this->request->getFile('foto');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Buat direktori jika belum ada
            if (!is_dir('uploads/siswa-ptn')) {
                mkdir('uploads/siswa-ptn', 0777, true);
            }

            // Generate nama file baru
            $newName = 'siswa_' . time() . '.' . $file->getExtension();

            // Pindahkan file
            $file->move('uploads/siswa-ptn', $newName);

            // Simpan nama file ke database
            $data['photo'] = $newName;
        }

        // Simpan data ke database
        if ($this->siswaPtnModel->insert($data)) {
            return redirect()->to('/dashboard/siswa-ptn')
                ->with('success', 'Data siswa berhasil ditambahkan');
        } else {
            return redirect()->to('/dashboard/jadwal')
                ->with('error', 'Gagal menambahkan data siswa')
                ->withInput();
        }
        // Jika bukan POST, arahkan kembali ke halaman daftar
        return redirect()->to('/dashboard/siswa-ptn');
    }

    // Mengupdate data siswa
    public function update($id = null)
    {

        // Validasi ID
        if (!$id || !$this->siswaPtnModel->find($id)) {
            return redirect()->to('/dashboard/siswa-ptn')
                ->with('error', 'Data siswa tidak ditemukan');
        }


        // Siapkan data untuk disimpan
        $data = [
            'nama_siswa' => $this->request->getPost('nama'),
            'prodi' => $this->request->getPost('prodi'),
            'nama_kampus' => $this->request->getPost('kampus'),
            'tahun_diterima' => $this->request->getPost('tahun')
        ];

        // Penanganan upload foto jika ada
        $file = $this->request->getFile('foto');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Buat direktori jika belum ada
            if (!is_dir('uploads/siswa-ptn')) {
                mkdir('uploads/siswa-ptn', 0777, true);
            }

            // Hapus foto lama jika ada
            $oldData = $this->siswaPtnModel->find($id);
            if ($oldData['photo'] && file_exists('uploads/siswa-ptn/' . $oldData['photo'])) {
                unlink('uploads/siswa-ptn/' . $oldData['photo']);
            }

            // Generate nama file baru
            $newName = 'siswa_' . time() . '.' . $file->getExtension();

            // Pindahkan file
            $file->move('uploads/siswa-ptn', $newName);

            // Simpan nama file ke database
            $data['photo'] = $newName;
        }

        // Update data
        if ($this->siswaPtnModel->update($id, $data)) {
            return redirect()->to('/dashboard/siswa-ptn')
                ->with('success', 'Data siswa berhasil diperbarui');
        } else {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui data siswa')
                ->withInput();
        }


        // Jika bukan POST, arahkan kembali ke halaman daftar
        return redirect()->to('/dashboard/siswa-ptn');
    }

    // Menghapus data siswa
    public function delete($id = null)
    {
        // Validasi ID
        if (!$id || !($siswa = $this->siswaPtnModel->find($id))) {
            return redirect()->to('/dashboard/siswa-ptn')
                ->with('error', 'Data siswa tidak ditemukan');
        }

        // Hapus foto jika ada
        if ($siswa['photo'] && file_exists('uploads/siswa-ptn/' . $siswa['photo'])) {
            unlink('uploads/siswa-ptn/' . $siswa['photo']);
        }

        // Hapus data dari database
        if ($this->siswaPtnModel->delete($id)) {
            return redirect()->to('/dashboard/siswa-ptn')
                ->with('success', 'Data siswa berhasil dihapus');
        } else {
            return redirect()->to('/dashboard/siswa-ptn')
                ->with('error', 'Gagal menghapus data siswa');
        }
    }

    // Menampilkan foto siswa
    public function viewPhoto($id = null)
    {
        // Validasi ID
        if (!$id || !($siswa = $this->siswaPtnModel->find($id))) {
            return redirect()->to('/dashboard/siswa-ptn')
                ->with('error', 'Data siswa tidak ditemukan');
        }

        // Cek apakah foto ada
        if (!$siswa['photo'] || !file_exists('uploads/siswa-ptn/' . $siswa['photo'])) {
            return redirect()->to('/dashboard/siswa-ptn')
                ->with('error', 'Foto siswa tidak ditemukan');
        }

        // Tampilkan foto
        $file = 'uploads/siswa-ptn/' . $siswa['photo'];
        $mime = mime_content_type($file);
        header('Content-Type: ' . $mime);
        readfile($file);
        exit;
    }
}
