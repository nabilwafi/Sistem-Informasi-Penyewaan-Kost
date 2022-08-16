<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cicilan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_order' => [
                'type' => 'INT',
                'constraint' => 100
            ],
            'pembayaran' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'tanggal_pembayaran' => [
                'type' => 'DATE',
            ],
            'bulan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
        ]);

        $this->forge->createTable('cicilan');
    }

    public function down()
    {
        $this->forge->dropTable('cicilan');
    }
}
