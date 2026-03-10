<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSiswaDiterimaPtnTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'siswa_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_siswa' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'prodi' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'nama_kampus' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'tahun_diterima' => [
                'type'       => 'VARCHAR',
                'constraint' => 4,
            ],
            'photo' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('siswa_id');
        $this->forge->createTable('siswa_diterima_ptn');
    }

    public function down()
    {
        $this->forge->dropTable('siswa_diterima_ptn');
    }
}
