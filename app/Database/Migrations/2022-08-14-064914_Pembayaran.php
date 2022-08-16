<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pembayaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 100,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'id_order' => [
                'type' => 'INT',
                'constraint' => 100,
                'unsigned' => true,
            ],
            'pembayaran' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'nama_pengirim' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'nomor_rekening' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'nama_bank' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'bukti_pembayaran' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'created_at date default current_timestamp',
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_order', 'order', 'id');
        $this->forge->createTable('pembayaran');
    }

    public function down()
    {
        $this->forge->dropTable('pembayaran');
    }
}
