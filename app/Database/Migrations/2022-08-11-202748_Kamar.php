<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kamar extends Migration
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
            'no_kamar' => [
                'type' => 'INT',
                'constraint' => 100
            ],
            'gambar' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'deskripsi' => [
                'type' => 'TEXT'
            ],
            'harga_kamar' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'status_kamar' => [
                'type' => 'ENUM',
                'constraint' => ['tidak terisi', 'terisi']
            ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('kamar');
    }

    public function down()
    {
        $this->forge->dropTable('kamar');
    }
}
