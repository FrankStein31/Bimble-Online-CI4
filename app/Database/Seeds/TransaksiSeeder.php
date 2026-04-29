<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run()
    {
        // Truncate dulu
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');
        $this->db->table('transaksi')->truncate();
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');

        // Ambil user_id berdasarkan email
        $userMap = [];
        $users = $this->db->table('user')->select('user_id, email')->get()->getResultArray();
        foreach ($users as $u) {
            $userMap[$u['email']] = $u['user_id'];
        }

        // Ambil jadwal_id pertama yang tersedia
        $jadwalList = $this->db->table('jadwal')->select('jadwal_id')->orderBy('jadwal_id')->limit(6)->get()->getResultArray();
        $jadwalIds  = array_column($jadwalList, 'jadwal_id');

        if (empty($userMap) || empty($jadwalIds)) {
            return; // Skip jika belum ada data
        }

        $siswaSD  = $userMap['siswa@gmail.com'] ?? null;
        $siswaSMP = $userMap['budi@gmail.com']  ?? null;
        $siswaSMA = $userMap['siti@gmail.com']  ?? null;

        $data = [];

        if ($siswaSD) {
            $data[] = [
                'user_id'    => $siswaSD,
                'program_id' => 1,  // Program SD
                'jadwal_id'  => $jadwalIds[0] ?? null,
                'tagihan'    => 200000,
                'photo_bukti'=> null,
                'status'     => 'lunas',
            ];
        }

        if ($siswaSMP) {
            $data[] = [
                'user_id'    => $siswaSMP,
                'program_id' => 4,  // Program SMP
                'jadwal_id'  => $jadwalIds[1] ?? null,
                'tagihan'    => 200000,
                'photo_bukti'=> null,
                'status'     => 'lunas',
            ];
            $data[] = [
                'user_id'    => $siswaSMP,
                'program_id' => 5,  // Program SMP lain
                'jadwal_id'  => $jadwalIds[2] ?? null,
                'tagihan'    => 190000,
                'photo_bukti'=> null,
                'status'     => 'pending',
            ];
        }

        if ($siswaSMA) {
            $data[] = [
                'user_id'    => $siswaSMA,
                'program_id' => 7,  // Program SMA
                'jadwal_id'  => $jadwalIds[3] ?? null,
                'tagihan'    => 250000,
                'photo_bukti'=> null,
                'status'     => 'pending',
            ];
            $data[] = [
                'user_id'    => $siswaSMA,
                'program_id' => 8,  // Program SMA lain
                'jadwal_id'  => $jadwalIds[4] ?? null,
                'tagihan'    => 230000,
                'photo_bukti'=> null,
                'status'     => 'ditolak',
            ];
        }

        if (!empty($data)) {
            $this->db->table('transaksi')->insertBatch($data);
        }
    }
}
