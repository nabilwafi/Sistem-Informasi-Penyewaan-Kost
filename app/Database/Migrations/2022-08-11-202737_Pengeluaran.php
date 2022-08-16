<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pengeluaran extends Migration
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
            'tanggal' => [
                'type' => 'DATETIME',
            ],
            'jumlah' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'jenis_pengeluaran' => [
                'type' => 'ENUM',
                'constraint' => ['listrik', 'air', 'internet', 'kebersihan', 'lain-lain']
            ],
            'keterangan' => [
                'type' => 'TEXT',
            ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('pengeluaran');
    }

    public function down()
    {
        $this->forge->dropTable('pengeluaran');
    }
}
