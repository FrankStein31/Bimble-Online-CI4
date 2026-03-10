<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\ProgramBimbelModel;
use App\Models\UserModel;
use App\Models\NoRekeningModel;
use CodeIgniter\RESTful\ResourceController;

class RegistrasiController extends ResourceController
{
    protected $transaksiModel;
    protected $programModel;
    protected $userModel;
    protected $rekeningModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->programModel = new ProgramBimbelModel();
        $this->userModel = new UserModel();
        $this->rekeningModel = new NoRekeningModel();
    }

    public function registrasiPembayaran()
    {
        // Ambil data program bimbel untuk dropdown
        $data['program'] = $this->programModel->findAll();

        return view('pembayaran/registrasipembayaran', $data);
    }

    public function submit()
    {
        // Validasi input
        $rules = [
            'program_id' => 'required|numeric|is_not_unique[program_bimbel.program_id]',
            'tagihan' => 'required|numeric',
        ];

        // Validasi file bukti pembayaran
        if (!$this->validate($rules)) {
            return redirect()->back()->with('error', 'Mohon lengkapi semua field dengan benar.');
        }

        // Proses upload bukti pembayaran
        $bukti = $this->request->getFile('photo_bukti');

        if (!$bukti->isValid()) {
            return redirect()->back()->with('error', 'File bukti pembayaran tidak valid. Silakan pilih file gambar.');
        }

        // Buat nama file unik dan pindahkan ke folder uploads
        $buktiName = $bukti->getRandomName();
        $bukti->move(ROOTPATH . 'public/uploads/bukti_pembayaran', $buktiName);

        // Siapkan data transaksi
        $data = [
            'user_id' => session()->get('user_id'),
            'program_id' => $this->request->getPost('program_id'),
            'tagihan' => $this->request->getPost('tagihan'),
            'photo_bukti' => $buktiName,
            'status' => 'pending' // Status awal pending, menunggu konfirmasi admin
        ];

        // Simpan transaksi
        $this->transaksiModel->insert($data);

        // Redirect ke halaman paket aktif dengan pesan sukses
        return redirect()->to(base_url('/registrasi-pembayaran/paket-aktif'))
            ->with('success', 'Registrasi pembayaran berhasil dilakukan. Kami akan segera memverifikasi pembayaran Anda.');
    }

    public function paketAktif()
    {
        // Ambil user_id dari session
        $userId = session()->get('user_id');

        // Ambil data transaksi aktif (status = lunas)
        $transaksi = $this->transaksiModel->getTransaksiByUser($userId);

        // Siapkan data untuk view
        $data = [
            'transaksi' => $transaksi
        ];

        return view('pembayaran/paketaktif', $data);
    }

    public function transferBank()
    {
        // Ambil data rekening bank dari database
        $data['bankAccounts'] = $this->rekeningModel->findAll();

        return view('pembayaran/transferbank', $data);
    }


    public function history()
    {
        // Ambil user_id dari session
        $userId = session()->get('user_id');

        // Ambil semua data transaksi siswa
        $transaksi = $this->transaksiModel->getTransaksiByUser($userId);

        // Siapkan data untuk view
        $data = [
            'transaksi' => $transaksi
        ];

        return view('pembayaran/history', $data);
    }
}
