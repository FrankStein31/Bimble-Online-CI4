<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Disable FK check dan update data user yang ada, atau insert yang belum ada
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');
        $this->db->table('user')->truncate();
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');

        $data = [
            [
                'nama'     => 'Administrator',
                'email'    => 'admin@gmail.com',
                'nomor_hp' => '081234567890',
                'role'     => 'admin',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'photo'    => null,
                'tingkat'  => null,
                'jabatan'  => null,
            ],
            // Siswa SD
            [
                'nama'     => 'Andi Setiawan',
                'email'    => 'siswa@gmail.com',
                'nomor_hp' => '081234567891',
                'role'     => 'siswa',
                'password' => password_hash('siswa123', PASSWORD_DEFAULT),
                'photo'    => null,
                'tingkat'  => 'SD',
                'jabatan'  => null,
            ],
            [
                'nama'     => 'Budi Santoso',
                'email'    => 'budi@gmail.com',
                'nomor_hp' => '081234567892',
                'role'     => 'siswa',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'photo'    => null,
                'tingkat'  => 'SMP',
                'jabatan'  => null,
            ],
            [
                'nama'     => 'Siti Aminah',
                'email'    => 'siti@gmail.com',
                'nomor_hp' => '081234567893',
                'role'     => 'siswa',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'photo'    => null,
                'tingkat'  => 'SMA',
                'jabatan'  => null,
            ],
            // Pengajar SD
            [
                'nama'     => 'Ahmad Rahman',
                'email'    => 'ahmad@gmail.com',
                'nomor_hp' => '081234567894',
                'role'     => 'pengajar',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'photo'    => null,
                'tingkat'  => null,
                'jabatan'  => 'SD',
            ],
            // Pengajar SMP
            [
                'nama'     => 'Dewi Sartika',
                'email'    => 'dewi@gmail.com',
                'nomor_hp' => '081234567895',
                'role'     => 'pengajar',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'photo'    => null,
                'tingkat'  => null,
                'jabatan'  => 'SMP',
            ],
            // Pengajar SMA
            [
                'nama'     => 'Rini Pratiwi',
                'email'    => 'rini@gmail.com',
                'nomor_hp' => '081234567896',
                'role'     => 'pengajar',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'photo'    => null,
                'tingkat'  => null,
                'jabatan'  => 'SMA',
            ],
        ];

        $this->db->table('user')->insertBatch($data);
    }
}
