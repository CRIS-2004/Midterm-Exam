<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAnnouncementsTable extends Migration
{
    public function up()
    {
        // Define structure of 'announcements' table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',                //Integer data type
                'constraint' => 11,             //Max lenght to 11 digits only
                'unsigned' => true,             //only positive numbers
                'auto_increment' => true,       // Auto-Increment for new records
            ],
            'title' => [
                'type' => 'VARCHAR',            //Variable Character string
                'constraint' => '255',          //Max lenght to 255 digits only
                'null' => false,                //Cannot be empty
            ],
            'content' => [
                'type' => 'TEXT',               //Text data type for longer inputs
                'null' => false,                 //Cannot be empty
            ],
            'created_at' => [
                'type' => 'DATETIME',           //Date and Time format
                'null' => false,                 //Cannot be empty
            ],
        ]);

        // Set primary key
        $this->forge->addKey('id', true);

        // Create table
        $this->forge->createTable('announcements');
    }

    public function down()
    {
        // Drop table when rolling back migration
        $this->forge->dropTable('announcements');
    }
}
