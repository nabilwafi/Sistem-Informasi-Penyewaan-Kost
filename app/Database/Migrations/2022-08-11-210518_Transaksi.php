<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'id_order' => [
                'type' => 'INT',
                'constraint' => 100,
                'unsigned' => true
            ],
            'nominal_pembayaran' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'bukti_pembayaran' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'total_pembayaran' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ],
            'status_pembayaran' => [
                'type' => 'ENUM',
                'constraint' => ['belum bayar', 'lunas', 'menyicil'],
                'default' => 'belum bayar'
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_order', 'order', 'id', 'cascade', 'cascade');

        $this->forge->createTable('transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi');
    }
}
