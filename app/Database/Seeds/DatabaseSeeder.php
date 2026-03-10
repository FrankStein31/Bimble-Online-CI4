<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        //
        $this->call(UserSeeder::class);
        $this->call(JadwalSeeder::class);
        $this->call(NoRekeningSeeder::class);
        $this->call(ProgramBimbelSeeder::class);
        $this->call(SiswaDiterimaSeeder::class);
        $this->call(TransaksiSeeder::class);
    }
}
