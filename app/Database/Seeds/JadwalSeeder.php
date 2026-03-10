<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JadwalSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'hari' => 'Senin',
                'jam_mulai' => '08:00',
                'jam_selesai' => '10:00'
            ],
            [
                'hari' => 'Senin',
                'jam_mulai' => '10:30',
                'jam_selesai' => '12:30'
            ],
            [
                'hari' => 'Senin',
                'jam_mulai' => '14:00',
                'jam_selesai' => '16:00'
            ],
            [
                'hari' => 'Selasa',
                'jam_mulai' => '08:00',
                'jam_selesai' => '10:00'
            ],
            [
                'hari' => 'Selasa',
                'jam_mulai' => '10:30',
                'jam_selesai' => '12:30'
            ],
            [
                'hari' => 'Selasa',
                'jam_mulai' => '14:00',
                'jam_selesai' => '16:00'
            ],
            [
                'hari' => 'Rabu',
                'jam_mulai' => '08:00',
                'jam_selesai' => '10:00'
            ],
            [
                'hari' => 'Rabu',
                'jam_mulai' => '10:30',
                'jam_selesai' => '12:30'
            ],
            [
                'hari' => 'Kamis',
                'jam_mulai' => '08:00',
                'jam_selesai' => '10:00'
            ],
            [
                'hari' => 'Kamis',
                'jam_mulai' => '14:00',
                'jam_selesai' => '16:00'
            ],
            [
                'hari' => 'Jumat',
                'jam_mulai' => '08:00',
                'jam_selesai' => '10:00'
            ],
            [
                'hari' => 'Jumat',
                'jam_mulai' => '14:00',
                'jam_selesai' => '16:00'
            ],
            [
                'hari' => 'Sabtu',
                'jam_mulai' => '08:00',
                'jam_selesai' => '10:00'
            ],
            [
                'hari' => 'Sabtu',
                'jam_mulai' => '10:30',
                'jam_selesai' => '12:30'
            ],
            [
                'hari' => 'Sabtu',
                'jam_mulai' => '14:00',
                'jam_selesai' => '16:00'
            ]
        ];

        $this->db->table('jadwal')->insertBatch($data);
    }
}
