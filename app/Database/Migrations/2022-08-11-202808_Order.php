<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Order extends Migration
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
            'id_kamar' => [
                'type' => 'INT',
                'constraint' => 100,
                'unsigned' => true
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 100,
                'unsigned' => true
            ],
            'tanggal_masuk' => [
                'type' => 'DATE',
            ],
            'tanggal_keluar' => [
                'type' => 'DATE',
            ],
            'durasi_sewa' => [
                'type' => 'INT',
                'constraint' => 25
            ],
            'perpanjangan' => [
                'type' => 'INT',
                'constraint' => 25,
                'null' => true
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_kamar', 'kamar', 'id', 'cascade', 'cascade');
        $this->forge->addForeignKey('id_user', 'member', 'id', 'cascade', 'cascade');
        $this->forge->createTable('order');
    }

    public function down()
    {
        $this->forge->dropTable('order');
    }
}
