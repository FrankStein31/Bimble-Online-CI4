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

        $db = \Config\Database::connect();
        $transaksiRows = $db->table('transaksi')
            ->select('transaksi.user_id, transaksi.program_id, transaksi.pengajar_id')
            ->where('transaksi.status', 'lunas')
            ->orderBy('transaksi.transaksi_id', 'DESC')
            ->get()->getResultArray();

        $siswaMap = [];
        foreach ($transaksiRows as $row) {
            $uid = $row['user_id'];
            if (!isset($siswaMap[$uid])) {
                $siswaMap[$uid] = [
                    'program_id'  => $row['program_id'],
                    'pengajar_id' => $row['pengajar_id'],
                ];
            }
        }

        return view('admin/hasil_belajar', [
            'hasil'    => $hasil,
            'siswa'    => $siswa,
            'pengajar' => $pengajar,
            'program'  => $program,
            'siswaMap' => $siswaMap,
        ]);
    }

    public function add()
    {
        $program_id = $this->request->getPost('program_id');
        $program = $this->programModel->find($program_id);
        
        $data = [
            'siswa_id'       => $this->request->getPost('siswa_id'),
            'pengajar_id'    => $this->request->getPost('pengajar_id'),
            'program_id'     => $program_id,
            'mata_pelajaran' => $program ? $program['nama_program'] : '',
            'nilai'          => $this->request->getPost('nilai'),
            'catatan'        => $this->request->getPost('catatan'),
            'tanggal'        => $this->request->getPost('tanggal'),
        ];

        if ($this->hasilBelajarModel->insert($data)) {
            return redirect()->to('/dashboard/laporan')->with('success', 'Hasil belajar berhasil ditambahkan.');
        }

        return redirect()->to('/dashboard/laporan')->with('error', 'Gagal menambahkan hasil belajar.');
    }

    public function edit($id = null)
    {
        $program_id = $this->request->getPost('program_id');
        $program = $this->programModel->find($program_id);

        $data = [
            'siswa_id'       => $this->request->getPost('siswa_id'),
            'pengajar_id'    => $this->request->getPost('pengajar_id'),
            'program_id'     => $program_id,
            'mata_pelajaran' => $program ? $program['nama_program'] : '',
            'nilai'          => $this->request->getPost('nilai'),
            'catatan'        => $this->request->getPost('catatan'),
            'tanggal'        => $this->request->getPost('tanggal'),
        ];

        if ($this->hasilBelajarModel->update($id, $data)) {
            return redirect()->to('/dashboard/laporan')->with('success', 'Hasil belajar berhasil diperbarui.');
        }

        return redirect()->to('/dashboard/laporan')->with('error', 'Gagal memperbarui hasil belajar.');
    }

    public function delete($id = null)
    {
        $this->hasilBelajarModel->delete($id);
        return redirect()->to('/dashboard/hasil-belajar')->with('success', 'Hasil belajar berhasil dihapus.');
    }
}
