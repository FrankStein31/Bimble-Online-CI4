<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\ProgramBimbelModel;
use App\Models\UserModel;
use App\Models\NoRekeningModel;
use App\Models\JadwalModel;
use App\Models\KelasBimbelModel;
use CodeIgniter\RESTful\ResourceController;

class RegistrasiController extends ResourceController
{
    protected $transaksiModel;
    protected $programModel;
    protected $userModel;
    protected $rekeningModel;
    protected $jadwalModel;
    protected $kelasModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->programModel   = new ProgramBimbelModel();
        $this->userModel      = new UserModel();
        $this->rekeningModel  = new NoRekeningModel();
        $this->jadwalModel    = new JadwalModel();
        $this->kelasModel     = new KelasBimbelModel();
    }

    /**
     * Halaman pilih program — filter sesuai tingkat siswa yang sedang login.
     */
    public function registrasiPembayaran()
    {
        $tingkatSiswa = session()->get('tingkat');

        if ($tingkatSiswa) {
            $program = $this->programModel->where('tingkat', $tingkatSiswa)->findAll();
        } else {
            $program = $this->programModel->findAll();
        }

        $data['program']  = $program;
        $data['rekening'] = $this->rekeningModel->findAll();

        return view('pembayaran/registrasipembayaran', $data);
    }

    /**
     * Proses submit order baru.
     * Siswa memilih program + upload bukti bayar.
     * Jadwal & Pengajar akan di-assign saat admin konfirmasi lunas.
     */
    public function submit()
    {
        $rules = [
            'program_id' => 'required|numeric|is_not_unique[program_bimbel.program_id]',
            'tagihan'    => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Mohon lengkapi semua field dengan benar.');
        }

        $programId    = (int) $this->request->getPost('program_id');
        $tingkatSiswa = session()->get('tingkat');

        // Verifikasi program sesuai tingkat siswa
        $program = $this->programModel->find($programId);
        if (!$program) {
            return redirect()->back()->with('error', 'Program tidak ditemukan.');
        }

        if ($tingkatSiswa && $program['tingkat'] !== $tingkatSiswa) {
            return redirect()->back()->with('error', 'Program tidak sesuai dengan jenjang pendidikan Anda (' . $tingkatSiswa . ').');
        }

        // Cek sudah terdaftar di program yang sama
        $existing = $this->transaksiModel
            ->where('user_id', session()->get('user_id'))
            ->where('program_id', $programId)
            ->whereIn('status', ['pending', 'lunas'])
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar di program ini.');
        }

        // Upload bukti pembayaran
        $bukti = $this->request->getFile('photo_bukti');
        if (!$bukti || !$bukti->isValid()) {
            return redirect()->back()->with('error', 'File bukti pembayaran tidak valid.');
        }

        $buktiName = $bukti->getRandomName();
        $bukti->move(ROOTPATH . 'public/uploads/bukti_pembayaran', $buktiName);

        $this->transaksiModel->insert([
            'user_id'     => session()->get('user_id'),
            'program_id'  => $programId,
            'jadwal_id'   => null,
            'tagihan'     => $this->request->getPost('tagihan'),
            'photo_bukti' => $buktiName,
            'status'      => 'pending',
        ]);

        return redirect()->to(base_url('/registrasi-pembayaran/paket-aktif'))
            ->with('success', 'Registrasi pembayaran berhasil! Menunggu konfirmasi admin.');
    }

    public function paketAktif()
    {
        $userId    = session()->get('user_id');
        $transaksi = $this->transaksiModel->getTransaksiByUser($userId);

        // Handle Midtrans redirect params
        $midtransStatus = $this->request->getGet('midtrans');
        if ($midtransStatus === 'success') {
            session()->setFlashdata('success', '🎉 Pembayaran berhasil! Program kamu sudah aktif.');
        } elseif ($midtransStatus === 'pending') {
            session()->setFlashdata('success', '⏳ Pembayaran sedang diproses. Status akan diperbarui otomatis.');
        }

        return view('pembayaran/paketaktif', ['transaksi' => $transaksi]);
    }

    public function transferBank()
    {
        $data['bankAccounts'] = $this->rekeningModel->findAll();
        return view('pembayaran/transferbank', $data);
    }

    public function history()
    {
        $userId    = session()->get('user_id');
        $transaksi = $this->transaksiModel->getTransaksiByUser($userId);

        return view('pembayaran/history', ['transaksi' => $transaksi]);
    }
}
