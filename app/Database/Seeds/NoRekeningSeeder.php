<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NoRekeningSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'bank' => 'Bank BCA',
                'no_rek' => '1234567890',
                'nama' => 'Bimbel Cerdas Mandiri'
            ],
            [
                'bank' => 'Bank Mandiri',
                'no_rek' => '9876543210',
                'nama' => 'Bimbel Cerdas Mandiri'
            ],
            [
                'bank' => 'Bank BRI',
                'no_rek' => '5555666677',
                'nama' => 'Bimbel Cerdas Mandiri'
            ],
            [
                'bank' => 'Bank BNI',
                'no_rek' => '1111222233',
                'nama' => 'Bimbel Cerdas Mandiri'
            ],
            [
                'bank' => 'Bank BSI',
                'no_rek' => '7777888899',
                'nama' => 'Bimbel Cerdas Mandiri'
            ]
        ];

        $this->db->table('no_rekening')->insertBatch($data);
    }
}
