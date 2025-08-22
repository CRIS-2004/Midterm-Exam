<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $students = [
            [
                'user_id' => '00012345678',
                'name' => 'Cris Parcon',
                'age' => 21,
                'email' => 'crislawrence.parcon@gmail.com',
                'userType' => 'Student'
            ],
             [
                 'user_id' => '00023456789',
                'name' => 'Justin Mics',
                'age' => 15,
                'email' => 'justinmics@gmail.com',
                'userType' => 'Student'
            ]
        ];
        $instructors = [
            [
                 'user_id' => '00034567890',
               'name' => 'Micheal Victor',
                'age' => 30,
                'email' => 'michael@gmail.com',
                'userType' => 'Insructor'
            ],
              [
                 'user_id' => '00045678901',
               'name' => 'Steve Harry',
                'age' => 35,
                'email' => 'steve@gmail.com',
                'userType' => 'Insructor'
            ]
        ];
        $admin = [
            [
                 'user_id' => '00056789012',
                'name' => 'Lorenzo Parcs',
                'age' => 40,
                'email' => 'Lparcs@gmail.com',
                'userType' => 'Admin'
            ]
        ];
        $this->db->table('users')->insertBatch($students);
        $this->db->table('users')->insertBatch($instructors);
        $this->db->table('users')->insertBatch($admin);
    }

}
