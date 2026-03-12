<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTransaksiAddMidtrans extends Migration
{
    public function up()
    {
        $this->forge->addColumn('transaksi', [
            'midtrans_order_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'after'      => 'photo_bukti',
            ],
            'metode_bayar' => [
                'type'       => 'ENUM',
                'constraint' => ['manual', 'midtrans'],
                'default'    => 'manual',
                'after'      => 'midtrans_order_id',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('transaksi', ['midtrans_order_id', 'metode_bayar']);
    }
}
