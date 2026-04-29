<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProgramJadwalTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'program_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'jadwal_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'urutan' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
                'comment'    => '1, 2, or 3 (pertemuan ke-)',
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('program_id', 'program_bimbel', 'program_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('jadwal_id', 'jadwal', 'jadwal_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('program_jadwal');
    }

    public function down()
    {
        $this->forge->dropTable('program_jadwal', true);
    }
}
