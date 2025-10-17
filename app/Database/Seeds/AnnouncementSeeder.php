<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run()
    {
         // Two sample announcements to preload in the database
        $data = [
            [
                'title' => 'Welcome Students!',
                'content' => 'The new school year starts next week. Please be prepared.',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'System Maintenance',
                'content' => 'The portal will be offline this Saturday for maintenance.',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        // Insert all sample records at once
        $this->db->table('announcements')->insertBatch($data);
    }
}
