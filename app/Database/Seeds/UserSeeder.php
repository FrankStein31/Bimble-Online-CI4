<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Administrator',
                'email' => 'admin@gmail.com',
                'nomor_hp' => '081234567890',
                'role' => 'admin',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'photo' => null
            ],
            [
                'nama' => 'siswa',
                'email' => 'siswa@gmail.com',
                'nomor_hp' => '081234567891',
                'role' => 'siswa',
                'password' => password_hash('siswa123', PASSWORD_DEFAULT),
                'photo' => null
            ],
            [
                'nama' => 'Budi Santoso',
                'email' => 'budi@gmail.com',
                'nomor_hp' => '081234567891',
                'role' => 'siswa',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'photo' => null
            ],
            [
                'nama' => 'Siti Aminah',
                'email' => 'siti@gmail.com',
                'nomor_hp' => '081234567892',
                'role' => 'siswa',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'photo' => null
            ],
            [
                'nama' => 'Ahmad Rahman',
                'email' => 'ahmad@gmail.com',
                'nomor_hp' => '081234567893',
                'role' => 'pengajar',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'photo' => null
            ],
            [
                'nama' => 'Dewi Sartika',
                'email' => 'dewi@gmail.com',
                'nomor_hp' => '081234567894',
                'role' => 'pengajar',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'photo' => null
            ],
            [
                'nama' => 'Rini Pratiwi',
                'email' => 'rini@gmail.com',
                'nomor_hp' => '081234567895',
                'role' => 'siswa',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'photo' => null
            ]
        ];

        $this->db->table('user')->insertBatch($data);
    }
}
