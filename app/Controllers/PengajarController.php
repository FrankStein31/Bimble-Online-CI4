<?php

namespace App\Controllers;

use App\Models\HasilBelajarModel;
use App\Models\TransaksiModel;
use App\Models\JadwalModel;
use App\Models\ProgramBimbelModel;
use App\Models\UserModel;

class PengajarController extends BaseController
{
    protected $hasilBelajarModel;
    protected $transaksiModel;
    protected $jadwalModel;
    protected $programModel;
    protected $userModel;

    public function __construct()
    {
        $this->hasilBelajarModel = new HasilBelajarModel();
        $this->transaksiModel    = new TransaksiModel();
        $this->jadwalModel       = new JadwalModel();
        $this->programModel      = new ProgramBimbelModel();
        $this->userModel         = new UserModel();
    }

    public function dashboard()
    {
        $pengajarId = session()->get('user_id');

        $totalSiswa  = count($this->getSiswaSaya($pengajarId));
        $totalHasil  = count($this->hasilBelajarModel->where('pengajar_id', $pengajarId)->findAll());
        $jadwal      = $this->jadwalModel->findAll();

        return view('pengajar/dashboard', [
            'totalSiswa' => $totalSiswa,
            'totalHasil' => $totalHasil,
            'jadwal'     => $jadwal,
        ]);
    }

    public function jadwal()
    {
        $jadwal = $this->jadwalModel->orderBy('hari', 'ASC')->findAll();
        return view('pengajar/jadwal', ['jadwal' => $jadwal]);
    }

    public function siswa()
    {
        $pengajarId = session()->get('user_id');
        $siswa      = $this->getSiswaSaya($pengajarId);
        return view('pengajar/siswa', ['siswa' => $siswa]);
    }

    public function hasilBelajar()
    {
        $pengajarId = session()->get('user_id');
        $hasil      = $this->hasilBelajarModel->getByPengajar($pengajarId);
        $siswa      = $this->getSiswaSaya($pengajarId);
        $program    = $this->programModel->findAll();

        return view('pengajar/hasil_belajar', [
            'hasil'   => $hasil,
            'siswa'   => $siswa,
            'program' => $program,
        ]);
    }

    public function tambahHasil()
    {
        $pengajarId = session()->get('user_id');

        $data = [
            'siswa_id'       => $this->request->getPost('siswa_id'),
            'pengajar_id'    => $pengajarId,
            'program_id'     => $this->request->getPost('program_id'),
            'mata_pelajaran' => $this->request->getPost('mata_pelajaran'),
            'nilai'          => $this->request->getPost('nilai'),
            'catatan'        => $this->request->getPost('catatan'),
            'tanggal'        => $this->request->getPost('tanggal'),
        ];

        if ($this->hasilBelajarModel->insert($data)) {
            return redirect()->to('/pengajar/hasil-belajar')->with('success', 'Hasil belajar berhasil ditambahkan.');
        }

        return redirect()->to('/pengajar/hasil-belajar')->with('error', 'Gagal menambahkan hasil belajar.');
    }

    public function editHasil($id = null)
    {
        $pengajarId = session()->get('user_id');
        $hasil      = $this->hasilBelajarModel->find($id);

        if (!$hasil || $hasil['pengajar_id'] != $pengajarId) {
            return redirect()->to('/pengajar/hasil-belajar')->with('error', 'Data tidak ditemukan.');
        }

        $data = [
            'siswa_id'       => $this->request->getPost('siswa_id'),
            'program_id'     => $this->request->getPost('program_id'),
            'mata_pelajaran' => $this->request->getPost('mata_pelajaran'),
            'nilai'          => $this->request->getPost('nilai'),
            'catatan'        => $this->request->getPost('catatan'),
            'tanggal'        => $this->request->getPost('tanggal'),
        ];

        if ($this->hasilBelajarModel->update($id, $data)) {
            return redirect()->to('/pengajar/hasil-belajar')->with('success', 'Hasil belajar berhasil diperbarui.');
        }

        return redirect()->to('/pengajar/hasil-belajar')->with('error', 'Gagal memperbarui hasil belajar.');
    }

    public function hapusHasil($id = null)
    {
        $pengajarId = session()->get('user_id');
        $hasil      = $this->hasilBelajarModel->find($id);

        if (!$hasil || $hasil['pengajar_id'] != $pengajarId) {
            return redirect()->to('/pengajar/hasil-belajar')->with('error', 'Data tidak ditemukan.');
        }

        $this->hasilBelajarModel->delete($id);
        return redirect()->to('/pengajar/hasil-belajar')->with('success', 'Hasil belajar berhasil dihapus.');
    }

    private function getSiswaSaya($pengajarId)
    {
        $db = \Config\Database::connect();
        return $db->table('transaksi')
            ->select('user.user_id, user.nama, user.nomor_hp, user.email, user.photo, program_bimbel.nama_program, program_bimbel.tingkat, program_bimbel.kelas, transaksi.status')
            ->join('user', 'user.user_id = transaksi.user_id')
            ->join('program_bimbel', 'program_bimbel.program_id = transaksi.program_id')
            ->where('transaksi.status', 'lunas')
            ->groupBy('user.user_id, user.nama, user.nomor_hp, user.email, user.photo, program_bimbel.nama_program, program_bimbel.tingkat, program_bimbel.kelas, transaksi.status')
            ->get()
            ->getResultArray();
    }
}
