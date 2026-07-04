<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [

            'name' => 'Administrator',

            'email' => 'admin@asrama.com',

            'password' => password_hash('admin123', PASSWORD_DEFAULT),

            'phone' => '081234567890',

            'role' => 'admin',

            'created_at' => date('Y-m-d H:i:s'),

            'updated_at' => date('Y-m-d H:i:s')

        ];

        $this->db->table('users')->insert($data);
    }
}