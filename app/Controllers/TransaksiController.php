<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\UserModel;
use App\Models\ProgramBimbelModel;
use CodeIgniter\RESTful\ResourceController;

class TransaksiController extends ResourceController
{
    protected $transaksiModel;
    protected $userModel;
    protected $programBimbelModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->userModel = new UserModel();
        $this->programBimbelModel = new ProgramBimbelModel();
    }

    public function transaksi()
    {

        $data['transaksi'] = $this->transaksiModel->getTransaksiWithDetails();
        // Siapkan data siswa dan program untuk form tambah/edit
        $data['siswa'] = $this->userModel->where('role', 'siswa')->findAll();
        $data['program'] = $this->programBimbelModel->findAll();
        return view('admin/transaksi', $data);
    }

    public function add()
    {
        // Proses upload bukti pembayaran jika ada
        $bukti = $this->request->getFile('photo_bukti');
        $buktiName = null;

        if ($bukti && $bukti->isValid() && !$bukti->hasMoved()) {
            // Buat nama file unik
            $buktiName = $bukti->getRandomName();
            // Pindahkan file ke folder uploads
            $bukti->move(ROOTPATH . 'public/uploads/bukti_pembayaran', $buktiName);
        }

        // Data yang akan disimpan
        $data = [
            'user_id' => $this->request->getPost('user_id'),
            'program_id' => $this->request->getPost('program_id'),
            'tagihan' => $this->request->getPost('tagihan'),
            'status' => $this->request->getPost('status'),
            'photo_bukti' => $buktiName,
        ];

        // Simpan data transaksi
        $this->transaksiModel->insert($data);

        return redirect()->to(base_url('dashboard/transaksi'))->with('success', 'Data transaksi berhasil ditambahkan.');


        // Jika bukan POST, tampilkan form
        $data['siswa'] = $this->userModel->where('role', 'siswa')->findAll();
        $data['program'] = $this->programBimbelModel->findAll();

        return view('dashboard/transaksi', $data);
    }

    public function edit($id = null)
    {
        if ($id === null) {
            return redirect()->to(base_url('dashboard/transaksi'))->with('error', 'ID transaksi tidak ditemukan.');
        }

        // Cek apakah data transaksi ada
        $transaksi = $this->transaksiModel->find($id);
        if (!$transaksi) {
            return redirect()->to(base_url('dashboard/transaksi'))->with('error', 'Data transaksi tidak ditemukan.');
        }


        // Data yang akan diupdate
        $data = [
            'user_id' => $this->request->getPost('user_id'),
            'program_id' => $this->request->getPost('program_id'),
            'tagihan' => $this->request->getPost('tagihan'),
            'status' => $this->request->getPost('status'),
        ];

        // Proses upload bukti pembayaran jika ada
        $bukti = $this->request->getFile('photo_bukti');
        if ($bukti && $bukti->isValid() && !$bukti->hasMoved()) {
            // Hapus file lama jika ada
            if ($transaksi['photo_bukti'] && file_exists(ROOTPATH . 'public/uploads/bukti_pembayaran/' . $transaksi['photo_bukti'])) {
                unlink(ROOTPATH . 'public/uploads/bukti_pembayaran/' . $transaksi['photo_bukti']);
            }

            // Buat nama file unik
            $buktiName = $bukti->getRandomName();
            // Pindahkan file ke folder uploads
            $bukti->move(ROOTPATH . 'public/uploads/bukti_pembayaran', $buktiName);

            // Update data bukti pembayaran
            $data['photo_bukti'] = $buktiName;
        }

        // Update data transaksi
        $this->transaksiModel->update($id, $data);

        return redirect()->to(base_url('dashboard/transaksi'))->with('success', 'Data transaksi berhasil diperbarui.');


        // Jika bukan POST, tampilkan form edit
        $data['transaksi'] = $this->transaksiModel->getTransaksiById($id);
        $data['siswa'] = $this->userModel->where('role', 'siswa')->findAll();
        $data['program'] = $this->programBimbelModel->findAll();

        return view('dashboard/transaksi', $data);
    }

    public function delete($id = null)
    {
        if ($id === null) {
            return redirect()->to(base_url('dashboard/transaksi'))->with('error', 'ID transaksi tidak ditemukan.');
        }

        // Cek apakah data transaksi ada
        $transaksi = $this->transaksiModel->find($id);
        if (!$transaksi) {
            return redirect()->to(base_url('dashboard/transaksi'))->with('error', 'Data transaksi tidak ditemukan.');
        }

        // Hapus file bukti pembayaran jika ada
        if ($transaksi['photo_bukti'] && file_exists(ROOTPATH . 'public/uploads/bukti_pembayaran/' . $transaksi['photo_bukti'])) {
            unlink(ROOTPATH . 'public/uploads/bukti_pembayaran/' . $transaksi['photo_bukti']);
        }

        // Hapus data transaksi
        $this->transaksiModel->delete($id);

        return redirect()->to(base_url('dashboard/transaksi'))->with('success', 'Data transaksi berhasil dihapus.');
    }

    public function viewBukti($id = null)
    {
        if ($id === null) {
            return redirect()->to(base_url('dashboard/transaksi'))->with('error', 'ID transaksi tidak ditemukan.');
        }

        // Cek apakah data transaksi ada
        $transaksi = $this->transaksiModel->getTransaksiById($id);
        if (!$transaksi) {
            return redirect()->to(base_url('dashboard/transaksi'))->with('error', 'Data transaksi tidak ditemukan.');
        }

        $data['transaksi'] = $transaksi;
        return view('dashboard/transaksi', $data);
    }
}
