<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProgramBimbelTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'program_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_program' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'durasi' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'tingkat' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'kelas' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'harga' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'keterangan' => [
                'type'       => 'TEXT',
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

        $this->forge->addPrimaryKey('program_id');
        $this->forge->createTable('program_bimbel');
    }

    public function down()
    {
        $this->forge->dropTable('program_bimbel');
    }
}
