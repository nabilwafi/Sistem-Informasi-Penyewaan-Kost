<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'email' => 'admin@admin',
            'password' => '1234678'
        ];

        $this->db->table('admin')->insert($data);
    }
}
