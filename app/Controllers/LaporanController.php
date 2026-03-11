<?php

namespace App\Controllers;

use App\Models\HasilBelajarModel;
use App\Models\ProgramBimbelModel;
use App\Models\UserModel;
use App\Models\JadwalModel;
use App\Models\KelasBimbelModel;

class LaporanController extends BaseController
{
    protected $hasilModel;
    protected $programModel;
    protected $userModel;
    protected $jadwalModel;
    protected $kelasModel;

    public function __construct()
    {
        $this->hasilModel   = new HasilBelajarModel();
        $this->programModel = new ProgramBimbelModel();
        $this->userModel    = new UserModel();
        $this->jadwalModel  = new JadwalModel();
        $this->kelasModel   = new KelasBimbelModel();
    }

    // ============================================================
    // CRUD Hasil Belajar (gabungan dari HasilBelajarController)
    // ============================================================

    public function tambahHasil()
    {
        $data = [
            'siswa_id'       => $this->request->getPost('siswa_id'),
            'pengajar_id'    => $this->request->getPost('pengajar_id'),
            'program_id'     => $this->request->getPost('program_id'),
            'mata_pelajaran' => $this->request->getPost('mata_pelajaran'),
            'nilai'          => $this->request->getPost('nilai') ?: null,
            'catatan'        => $this->request->getPost('catatan'),
            'tanggal'        => $this->request->getPost('tanggal'),
        ];

        if ($this->hasilModel->insert($data)) {
            return redirect()->to('/dashboard/laporan')->with('success', 'Data hasil belajar berhasil ditambahkan.');
        }
        return redirect()->to('/dashboard/laporan')->with('error', 'Gagal menambahkan data.');
    }

    public function editHasil($id = null)
    {
        $data = [
            'siswa_id'       => $this->request->getPost('siswa_id'),
            'pengajar_id'    => $this->request->getPost('pengajar_id'),
            'program_id'     => $this->request->getPost('program_id'),
            'mata_pelajaran' => $this->request->getPost('mata_pelajaran'),
            'nilai'          => $this->request->getPost('nilai') ?: null,
            'catatan'        => $this->request->getPost('catatan'),
            'tanggal'        => $this->request->getPost('tanggal'),
        ];

        if ($this->hasilModel->update($id, $data)) {
            return redirect()->to('/dashboard/laporan')->with('success', 'Data berhasil diperbarui.');
        }
        return redirect()->to('/dashboard/laporan')->with('error', 'Gagal memperbarui data.');
    }

    public function hapusHasil($id = null)
    {
        $this->hasilModel->delete($id);
        return redirect()->to('/dashboard/laporan')->with('success', 'Data berhasil dihapus.');
    }

    // ============================================================

    public function index()
    {
        $filter = [
            'tingkat'        => $this->request->getGet('tingkat'),
            'program_id'     => $this->request->getGet('program_id'),
            'pengajar_id'    => $this->request->getGet('pengajar_id'),
            'tanggal_dari'   => $this->request->getGet('tanggal_dari'),
            'tanggal_sampai' => $this->request->getGet('tanggal_sampai'),
        ];

        $hasil = $this->getHasilFiltered($filter);
        // Semua data untuk form CRUD
        $hasilAll = $this->hasilModel->getAll();

        return view('admin/laporan', [
            'hasil'     => $hasil,
            'hasilAll'  => $hasilAll,
            'filter'    => $filter,
            'program'   => $this->programModel->findAll(),
            'pengajar'  => $this->userModel->where('role', 'pengajar')->findAll(),
            'siswa'     => $this->userModel->where('role', 'siswa')->findAll(),
        ]);
    }

    public function cetak()
    {
        $filter = [
            'tingkat'        => $this->request->getGet('tingkat'),
            'program_id'     => $this->request->getGet('program_id'),
            'pengajar_id'    => $this->request->getGet('pengajar_id'),
            'tanggal_dari'   => $this->request->getGet('tanggal_dari'),
            'tanggal_sampai' => $this->request->getGet('tanggal_sampai'),
        ];

        $hasil = $this->getHasilFiltered($filter);

        return view('admin/laporan_cetak', [
            'hasil'  => $hasil,
            'filter' => $filter,
        ]);
    }

    private function getHasilFiltered(array $filter): array
    {
        $db = \Config\Database::connect();
        $builder = $db->table('hasil_belajar')
            ->select('hasil_belajar.*, 
                      siswa.nama as nama_siswa, siswa.tingkat as tingkat_siswa,
                      pengajar.nama as nama_pengajar,
                      program_bimbel.nama_program, program_bimbel.tingkat as tingkat_program, program_bimbel.kelas')
            ->join('user as siswa', 'siswa.user_id = hasil_belajar.siswa_id')
            ->join('user as pengajar', 'pengajar.user_id = hasil_belajar.pengajar_id')
            ->join('program_bimbel', 'program_bimbel.program_id = hasil_belajar.program_id')
            ->orderBy('hasil_belajar.tanggal', 'DESC');

        if (!empty($filter['tingkat'])) {
            $builder->where('program_bimbel.tingkat', $filter['tingkat']);
        }
        if (!empty($filter['program_id'])) {
            $builder->where('hasil_belajar.program_id', $filter['program_id']);
        }
        if (!empty($filter['pengajar_id'])) {
            $builder->where('hasil_belajar.pengajar_id', $filter['pengajar_id']);
        }
        if (!empty($filter['tanggal_dari'])) {
            $builder->where('hasil_belajar.tanggal >=', $filter['tanggal_dari']);
        }
        if (!empty($filter['tanggal_sampai'])) {
            $builder->where('hasil_belajar.tanggal <=', $filter['tanggal_sampai']);
        }

        return $builder->get()->getResultArray();
    }
}
