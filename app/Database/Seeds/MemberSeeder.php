<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run()
    {
        for($i = 0; $i < 50; $i++) {
            $data = [
                'nama' => 'member'.($i+1),
                'email' => 'member'.($i+1).'@member',
                'password' => '12345678',
                'handphone' => rand(),
                'alamat' => 'Jl. in aja dlu',
                'role' => 'member'
            ];

            $this->db->table('member')->insert($data);
        }
    }
}
