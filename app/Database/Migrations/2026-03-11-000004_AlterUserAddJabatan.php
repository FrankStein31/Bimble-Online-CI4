<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUserAddJabatan extends Migration
{
    public function up()
    {
        $this->forge->addColumn('user', [
            'jabatan' => [
                'type'       => 'ENUM',
                'constraint' => ['SD', 'SMP', 'SMA'],
                'null'       => true,
                'after'      => 'tingkat',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('user', 'jabatan');
    }
}
