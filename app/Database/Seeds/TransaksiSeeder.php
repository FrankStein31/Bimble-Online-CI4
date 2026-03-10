<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id' => 2, // Budi Santoso
                'program_id' => 4, // Matematika SMP
                'tagihan' => 200000,
                'photo_bukti' => null,
                'status' => 'lunas'
            ],
            [
                'user_id' => 3, // Siti Aminah
                'program_id' => 5, // IPA SMP
                'tagihan' => 190000,
                'photo_bukti' => null,
                'status' => 'pending'
            ],
            [
                'user_id' => 6, // Rini Pratiwi
                'program_id' => 7, // Matematika SMA IPA
                'tagihan' => 250000,
                'photo_bukti' => null,
                'status' => 'lunas'
            ],
            [
                'user_id' => 2, // Budi Santoso
                'program_id' => 6, // Bahasa Inggris SMP
                'tagihan' => 170000,
                'photo_bukti' => null,
                'status' => 'pending'
            ],
            [
                'user_id' => 3, // Siti Aminah
                'program_id' => 10, // Persiapan UTBK
                'tagihan' => 350000,
                'photo_bukti' => null,
                'status' => 'ditolak'
            ],
            [
                'user_id' => 6, // Rini Pratiwi
                'program_id' => 8, // Fisika SMA
                'tagihan' => 230000,
                'photo_bukti' => null,
                'status' => 'lunas'
            ]
        ];

        $this->db->table('transaksi')->insertBatch($data);
    }
}
