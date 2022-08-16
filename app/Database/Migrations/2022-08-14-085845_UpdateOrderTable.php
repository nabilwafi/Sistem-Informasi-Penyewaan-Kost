<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateOrderTable extends Migration
{
    public function up()
    {
        $data = 'created_at date default current_timestamp';
        
        $this->forge->addColumn('order', $data);
    }

    public function down()
    {
        //
    }
}
