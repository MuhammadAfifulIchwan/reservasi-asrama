<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFacilitiesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'facility_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],

            'facility_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],

            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],

            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '12,2',
            ],

            'capacity' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],

            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],

            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['available', 'unavailable', 'maintenance'],
                'default'    => 'available',
            ],

            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable('facilities');
    }

    public function down()
    {
        $this->forge->dropTable('facilities');
    }
}