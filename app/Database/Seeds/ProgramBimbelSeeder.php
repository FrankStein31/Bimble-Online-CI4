<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProgramBimbelSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_program' => 'Matematika Dasar SD',
                'durasi' => '2 jam/pertemuan',
                'tingkat' => 'SD',
                'kelas' => '1-6',
                'harga' => 150000,
                'keterangan' => 'Program bimbingan belajar matematika untuk siswa SD kelas 1-6'
            ],
            [
                'nama_program' => 'Bahasa Indonesia SD',
                'durasi' => '1.5 jam/pertemuan',
                'tingkat' => 'SD',
                'kelas' => '1-6',
                'harga' => 120000,
                'keterangan' => 'Program bimbingan belajar bahasa Indonesia untuk siswa SD'
            ],
            [
                'nama_program' => 'IPA Terpadu SD',
                'durasi' => '2 jam/pertemuan',
                'tingkat' => 'SD',
                'kelas' => '4-6',
                'harga' => 140000,
                'keterangan' => 'Program bimbingan belajar IPA untuk siswa SD kelas 4-6'
            ],
            [
                'nama_program' => 'Matematika SMP',
                'durasi' => '2.5 jam/pertemuan',
                'tingkat' => 'SMP',
                'kelas' => '7-9',
                'harga' => 200000,
                'keterangan' => 'Program bimbingan belajar matematika untuk siswa SMP'
            ],
            [
                'nama_program' => 'IPA SMP',
                'durasi' => '2.5 jam/pertemuan',
                'tingkat' => 'SMP',
                'kelas' => '7-9',
                'harga' => 190000,
                'keterangan' => 'Program bimbingan belajar IPA untuk siswa SMP (Fisika, Kimia, Biologi)'
            ],
            [
                'nama_program' => 'Bahasa Inggris SMP',
                'durasi' => '2 jam/pertemuan',
                'tingkat' => 'SMP',
                'kelas' => '7-9',
                'harga' => 170000,
                'keterangan' => 'Program bimbingan belajar bahasa Inggris untuk siswa SMP'
            ],
            [
                'nama_program' => 'Matematika SMA IPA',
                'durasi' => '3 jam/pertemuan',
                'tingkat' => 'SMA',
                'kelas' => '10-12',
                'harga' => 250000,
                'keterangan' => 'Program bimbingan belajar matematika untuk siswa SMA jurusan IPA'
            ],
            [
                'nama_program' => 'Fisika SMA',
                'durasi' => '2.5 jam/pertemuan',
                'tingkat' => 'SMA',
                'kelas' => '10-12',
                'harga' => 230000,
                'keterangan' => 'Program bimbingan belajar fisika untuk siswa SMA'
            ],
            [
                'nama_program' => 'Kimia SMA',
                'durasi' => '2.5 jam/pertemuan',
                'tingkat' => 'SMA',
                'kelas' => '10-12',
                'harga' => 230000,
                'keterangan' => 'Program bimbingan belajar kimia untuk siswa SMA'
            ],
            [
                'nama_program' => 'Persiapan UTBK',
                'durasi' => '4 jam/pertemuan',
                'tingkat' => 'SMA',
                'kelas' => '12',
                'harga' => 350000,
                'keterangan' => 'Program intensif persiapan UTBK untuk masuk PTN'
            ]
        ];

        $this->db->table('program_bimbel')->insertBatch($data);
    }
}
