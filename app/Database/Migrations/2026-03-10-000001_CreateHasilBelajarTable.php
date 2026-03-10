<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHasilBelajarTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'hasil_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'siswa_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'pengajar_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'program_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'mata_pelajaran' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'nilai' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'null'       => true,
            ],
            'catatan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'tanggal' => [
                'type' => 'DATE',
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

        $this->forge->addPrimaryKey('hasil_id');
        $this->forge->addForeignKey('siswa_id', 'user', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('pengajar_id', 'user', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('program_id', 'program_bimbel', 'program_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('hasil_belajar');
    }

    public function down()
    {
        $this->forge->dropTable('hasil_belajar');
    }
}
