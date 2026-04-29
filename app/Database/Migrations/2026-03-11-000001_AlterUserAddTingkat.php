<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUserAddTingkat extends Migration
{
    public function up()
    {
        $this->forge->addColumn('user', [
            'tingkat' => [
                'type'       => 'ENUM',
                'constraint' => ['SD', 'SMP', 'SMA'],
                'null'       => true,
                'after'      => 'role',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('user', 'tingkat');
    }
}
