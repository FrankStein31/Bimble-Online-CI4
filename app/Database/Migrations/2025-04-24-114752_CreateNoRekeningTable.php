<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNoRekeningTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'rekening_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'bank' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'no_rek' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
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

        $this->forge->addPrimaryKey('rekening_id');
        $this->forge->createTable('no_rekening');
    }

    public function down()
    {
        $this->forge->dropTable('no_rekening');
    }
}
