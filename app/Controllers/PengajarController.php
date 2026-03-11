<?php

namespace App\Controllers;

use App\Models\HasilBelajarModel;
use App\Models\TransaksiModel;
use App\Models\JadwalModel;
use App\Models\ProgramBimbelModel;
use App\Models\UserModel;
use App\Models\KelasBimbelModel;

class PengajarController extends BaseController
{
    protected $hasilBelajarModel;
    protected $transaksiModel;
    protected $jadwalModel;
    protected $programModel;
    protected $userModel;
    protected $kelasModel;

    public function __construct()
    {
        $this->hasilBelajarModel = new HasilBelajarModel();
        $this->transaksiModel    = new TransaksiModel();
        $this->jadwalModel       = new JadwalModel();
        $this->programModel      = new ProgramBimbelModel();
        $this->userModel         = new UserModel();
        $this->kelasModel        = new KelasBimbelModel();
    }

    public function dashboard()
    {
        $pengajarId = session()->get('user_id');

        // Kelas yang dipegang pengajar ini
        $kelasList  = $this->kelasModel->getKelasByPengajar($pengajarId);
        $totalSiswa = 0;
        foreach ($kelasList as $k) {
            $totalSiswa += (int) $k['terisi'];
        }
        $totalHasil = count($this->hasilBelajarModel->where('pengajar_id', $pengajarId)->findAll());

        return view('pengajar/dashboard', [
            'totalSiswa' => $totalSiswa,
            'totalHasil' => $totalHasil,
            'kelasList'  => $kelasList,
        ]);
    }

    public function jadwal()
    {
        $pengajarId = session()->get('user_id');
        $kelasList  = $this->kelasModel->getKelasByPengajar($pengajarId);
        return view('pengajar/jadwal', ['kelasList' => $kelasList]);
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
        $jabatan    = session()->get('jabatan'); // SD / SMP / SMA

        $hasil   = $this->hasilBelajarModel->getByPengajar($pengajarId);
        $siswa   = $this->getSiswaSaya($pengajarId);

        // Filter program sesuai jenjang pengajar yang login
        $programQuery = $this->programModel;
        if (!empty($jabatan)) {
            $program = $programQuery->where('tingkat', $jabatan)->findAll();
        } else {
            $program = $programQuery->findAll();
        }

        // Build siswa→program mapping from active transaksi
        $siswaMap = [];
        foreach ($siswa as $s) {
            $db = \Config\Database::connect();
            $row = $db->table('transaksi')
                ->select('transaksi.program_id')
                ->where('transaksi.user_id', $s['user_id'])
                ->where('transaksi.pengajar_id', $pengajarId)
                ->where('transaksi.status', 'lunas')
                ->orderBy('transaksi.transaksi_id', 'DESC')
                ->limit(1)
                ->get()->getRowArray();
            if ($row) {
                $siswaMap[$s['user_id']] = (int)$row['program_id'];
            }
        }

        return view('pengajar/hasil_belajar', [
            'hasil'    => $hasil,
            'siswa'    => $siswa,
            'program'  => $program,
            'siswaMap' => $siswaMap,
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

    /**
     * Ambil daftar siswa yang di-assign ke pengajar ini (via kelas_bimbel).
     */
    private function getSiswaSaya(int $pengajarId): array
    {
        $db = \Config\Database::connect();
        return $db->table('transaksi')
            ->select('user.user_id, user.nama, user.nomor_hp, user.email, user.photo, user.tingkat,
                      program_bimbel.nama_program, program_bimbel.tingkat as tingkat_program, program_bimbel.kelas,
                      jadwal.hari, jadwal.jam_mulai, jadwal.jam_selesai,
                      transaksi.status, transaksi.transaksi_id')
            ->join('user', 'user.user_id = transaksi.user_id')
            ->join('program_bimbel', 'program_bimbel.program_id = transaksi.program_id')
            ->join('jadwal', 'jadwal.jadwal_id = transaksi.jadwal_id', 'left')
            ->where('transaksi.pengajar_id', $pengajarId)
            ->where('transaksi.status', 'lunas')
            ->groupBy('user.user_id, user.nama, user.nomor_hp, user.email, user.photo, user.tingkat,
                       program_bimbel.nama_program, program_bimbel.tingkat, program_bimbel.kelas,
                       jadwal.hari, jadwal.jam_mulai, jadwal.jam_selesai,
                       transaksi.status, transaksi.transaksi_id')
            ->get()
            ->getResultArray();
    }
}
