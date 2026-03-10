<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SiswaDiterimaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_siswa' => 'Andi Prasetyo',
                'prodi' => 'Teknik Informatika',
                'nama_kampus' => 'Institut Teknologi Bandung',
                'tahun_diterima' => '2023',
                'photo' => null
            ],
            [
                'nama_siswa' => 'Maya Sari',
                'prodi' => 'Kedokteran',
                'nama_kampus' => 'Universitas Gadjah Mada',
                'tahun_diterima' => '2023',
                'photo' => null
            ],
            [
                'nama_siswa' => 'Rizky Firmansyah',
                'prodi' => 'Teknik Elektro',
                'nama_kampus' => 'Institut Teknologi Sepuluh Nopember',
                'tahun_diterima' => '2023',
                'photo' => null
            ],
            [
                'nama_siswa' => 'Putri Indah',
                'prodi' => 'Farmasi',
                'nama_kampus' => 'Universitas Indonesia',
                'tahun_diterima' => '2022',
                'photo' => null
            ],
            [
                'nama_siswa' => 'Dani Ramadhan',
                'prodi' => 'Teknik Mesin',
                'nama_kampus' => 'Institut Teknologi Bandung',
                'tahun_diterima' => '2022',
                'photo' => null
            ],
            [
                'nama_siswa' => 'Sari Melati',
                'prodi' => 'Psikologi',
                'nama_kampus' => 'Universitas Padjadjaran',
                'tahun_diterima' => '2022',
                'photo' => null
            ],
            [
                'nama_siswa' => 'Bima Sakti',
                'prodi' => 'Hukum',
                'nama_kampus' => 'Universitas Indonesia',
                'tahun_diterima' => '2024',
                'photo' => null
            ],
            [
                'nama_siswa' => 'Lestari Wulandari',
                'prodi' => 'Akuntansi',
                'nama_kampus' => 'Universitas Gadjah Mada',
                'tahun_diterima' => '2024',
                'photo' => null
            ],
            [
                'nama_siswa' => 'Fajar Nugroho',
                'prodi' => 'Teknik Sipil',
                'nama_kampus' => 'Institut Teknologi Sepuluh Nopember',
                'tahun_diterima' => '2024',
                'photo' => null
            ],
            [
                'nama_siswa' => 'Indira Sari',
                'prodi' => 'Ilmu Komunikasi',
                'nama_kampus' => 'Universitas Padjadjaran',
                'tahun_diterima' => '2021',
                'photo' => null
            ]
        ];

        $this->db->table('siswa_diterima_ptn')->insertBatch($data);
    }
}
