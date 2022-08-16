<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
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
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'handphone' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'alamat' => [
                'type' => 'TEXT',
            ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('member');
    }

    public function down()
    {
        $this->forge->dropTable('member');
    }
}
