<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $data = [
            'nama' => 'Fauzan Fashihul Lisan',
            'username' => 'fauzanfl',
            'password' => password_hash('ffl031202', PASSWORD_DEFAULT),
        ];

        $this->db->table('users')->insert($data);
    }
}
