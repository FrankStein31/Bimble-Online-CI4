<?php

namespace App\Controllers;

use App\Models\JadwalModel;
use CodeIgniter\RESTful\ResourceController;

class JadwalController extends ResourceController
{
    protected $jadwalModel;
    public function __construct()
    {
        $this->jadwalModel = new JadwalModel();
    }
    public function index()
    {
        $data['jadwal'] = $this->jadwalModel->orderBy('jadwal_id', 'DESC')->findAll();
        return view('admin/jadwal', $data);
    }

    public function add()
    {
        $hari = $this->request->getPost('hari');
        $jamMulai = $this->request->getPost('jam_mulai');
        $jamSelesai = $this->request->getPost('jam_selesai');

        // Validasi constraint jam untuk Senin-Jumat (13:00-18:00)
        $hariSenin = in_array($hari, ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']);
        if ($hariSenin) {
            if ($jamMulai < '13:00' || $jamMulai > '18:00' || $jamSelesai < '13:00' || $jamSelesai > '18:00') {
                return redirect()->to('/dashboard/jadwal')
                    ->with('error', 'Untuk Senin-Jumat, jadwal hanya tersedia pukul 13:00-18:00.');
            }
        }

        $data = [
            'hari' => $hari,
            'jam_mulai' => $jamMulai,
            'jam_selesai' => $jamSelesai,
        ];

        if ($this->jadwalModel->insert($data)) {
            return redirect()->to('/dashboard/jadwal')
                ->with('success', 'Jadwal berhasil ditambahkan.');
        } else {
            return redirect()->to('/dashboard/jadwal')
                ->with('error', 'Terjadi kesalahan saat menambahkan jadwal.');
        }
    }

    public function edit($id = null)
    {
        $hari = $this->request->getPost('hari');
        $jamMulai = $this->request->getPost('jam_mulai');
        $jamSelesai = $this->request->getPost('jam_selesai');

        // Validasi constraint jam untuk Senin-Jumat (13:00-18:00)
        $hariSenin = in_array($hari, ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']);
        if ($hariSenin) {
            if ($jamMulai < '13:00' || $jamMulai > '18:00' || $jamSelesai < '13:00' || $jamSelesai > '18:00') {
                return redirect()->to('/dashboard/jadwal')
                    ->with('error', 'Untuk Senin-Jumat, jadwal hanya tersedia pukul 13:00-18:00.');
            }
        }

        $data = [
            'hari' => $hari,
            'jam_mulai' => $jamMulai,
            'jam_selesai' => $jamSelesai,
        ];
        if ($this->jadwalModel->update($id, $data)) {
            return redirect()->to('/dashboard/jadwal')
                ->with('success', 'Jadwal berhasil diperbarui.');
        } else {
            return redirect()->to('/dashboard/jadwal')
                ->with('error', 'Terjadi kesalahan saat memperbarui jadwal.');
        }
    }

    public function delete($id = null)
    {
        $this->jadwalModel->delete($id);
        return redirect()->to('/dashboard/jadwal')
            ->with('success', 'Jadwal berhasil dihapus.');
    }

    public function penugasan()
    {
        $db = \Config\Database::connect();
        $kelas = $db->table('kelas_bimbel')
            ->select('kelas_bimbel.*, program_bimbel.nama_program, program_bimbel.tingkat, program_bimbel.kelas as nama_kelas, jadwal.hari, jadwal.jam_mulai, jadwal.jam_selesai, user.nama as nama_pengajar')
            ->join('program_bimbel', 'program_bimbel.program_id = kelas_bimbel.program_id')
            ->join('jadwal', 'jadwal.jadwal_id = kelas_bimbel.jadwal_id')
            ->join('user', 'user.user_id = kelas_bimbel.pengajar_id', 'left')
            ->orderBy('kelas_bimbel.kelas_id', 'DESC')
            ->get()->getResultArray();

        // Attach student list per kelas (from transaksi where status=lunas)
        foreach ($kelas as &$k) {
            $k['siswa_list'] = $db->table('transaksi t')
                ->select('t.transaksi_id, t.user_id, u.nama, u.nomor_hp')
                ->join('user u', 'u.user_id = t.user_id')
                ->where('t.kelas_id', $k['kelas_id'])
                ->where('t.status', 'lunas')
                ->get()->getResultArray();
        }

        $userModel = new \App\Models\UserModel();
        $pengajar = $userModel->where('role', 'pengajar')->findAll();

        // Attach teacher capacity info (total_terisi / total_kuota across all their kelas)
        foreach ($pengajar as &$p) {
            $kapasitas = $db->table('kelas_bimbel')
                ->select('COALESCE(SUM(terisi),0) as total_terisi, COALESCE(SUM(kuota),0) as total_kuota')
                ->where('pengajar_id', $p['user_id'])
                ->get()->getRowArray();
            $p['total_terisi'] = (int)($kapasitas['total_terisi'] ?? 0);
            $p['total_kuota']  = (int)($kapasitas['total_kuota'] ?? 0);
            $p['is_full'] = ($p['total_kuota'] > 0 && $p['total_terisi'] >= $p['total_kuota']);
        }

        return view('admin/penugasan', ['kelas' => $kelas, 'pengajar' => $pengajar]);
    }

    public function reassign()
    {
        $kelasId = $this->request->getPost('kelas_id');
        $pengajarId = $this->request->getPost('pengajar_id');

        $db = \Config\Database::connect();

        // Check if target teacher is full (all their kelas terisi >= kuota)
        $kapasitas = $db->table('kelas_bimbel')
            ->select('COALESCE(SUM(terisi),0) as total_terisi, COALESCE(SUM(kuota),0) as total_kuota')
            ->where('pengajar_id', $pengajarId)
            ->get()->getRowArray();
        $totalTerisi = (int)($kapasitas['total_terisi'] ?? 0);
        $totalKuota  = (int)($kapasitas['total_kuota'] ?? 0);
        if ($totalKuota > 0 && $totalTerisi >= $totalKuota) {
            return redirect()->to(base_url('dashboard/penugasan'))
                ->with('error', 'Pengajar tersebut sudah full, tidak bisa dipindahkan ke sana.');
        }

        $kelasModel = new \App\Models\KelasBimbelModel();
        $kelasModel->update($kelasId, ['pengajar_id' => $pengajarId]);

        // Update all transaksi that uses this kelas_id
        $db->table('transaksi')
           ->where('kelas_id', $kelasId)
           ->update(['pengajar_id' => $pengajarId]);

        return redirect()->to(base_url('dashboard/penugasan'))->with('success', 'Pengajar berhasil dipindahkan.');
    }

    public function transferSiswa()
    {
        $transaksiId = $this->request->getPost('transaksi_id');
        $fromKelasId = $this->request->getPost('from_kelas_id');
        $toKelasId   = $this->request->getPost('to_kelas_id');

        if (!$transaksiId || !$fromKelasId || !$toKelasId || $fromKelasId == $toKelasId) {
            return redirect()->to(base_url('dashboard/penugasan'))
                ->with('error', 'Pilih kelas tujuan yang berbeda.');
        }

        $db = \Config\Database::connect();

        // Check target class capacity
        $target = $db->table('kelas_bimbel')->where('kelas_id', $toKelasId)->get()->getRowArray();
        if (!$target) {
            return redirect()->to(base_url('dashboard/penugasan'))
                ->with('error', 'Kelas tujuan tidak ditemukan.');
        }
        if ($target['terisi'] >= $target['kuota']) {
            return redirect()->to(base_url('dashboard/penugasan'))
                ->with('error', 'Kelas tujuan sudah penuh (' . $target['terisi'] . '/' . $target['kuota'] . ').');
        }

        // Get the transaksi record to fetch pengajar_id of target kelas
        $toPengajarId = $target['pengajar_id'];

        // Move the student: update transaksi
        $db->table('transaksi')->where('transaksi_id', $transaksiId)->update([
            'kelas_id'    => $toKelasId,
            'pengajar_id' => $toPengajarId,
            'jadwal_id'   => $target['jadwal_id'],
        ]);

        // Decrement source class, increment target class
        $db->table('kelas_bimbel')->where('kelas_id', $fromKelasId)->set('terisi', 'terisi - 1', false)->update();
        $db->table('kelas_bimbel')->where('kelas_id', $toKelasId)->set('terisi', 'terisi + 1', false)->update();

        return redirect()->to(base_url('dashboard/penugasan'))
            ->with('success', 'Siswa berhasil dipindahkan ke kelas tujuan.');
    }
}
