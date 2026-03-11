<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTransaksiAddKelasJadwal extends Migration
{
    public function up()
    {
        $this->forge->addColumn('transaksi', [
            'jadwal_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'program_id',
            ],
            'kelas_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'jadwal_id',
            ],
            'pengajar_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'kelas_id',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('transaksi', ['jadwal_id', 'kelas_id', 'pengajar_id']);
    }
}
