<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReservationsTable extends Migration
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

            'reservation_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],

            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],

            'facility_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],

            'purpose' => [
                'type' => 'TEXT',
            ],

            'start_date' => [
                'type' => 'DATE',
            ],

            'end_date' => [
                'type' => 'DATE',
            ],

            'total_price' => [
                'type'       => 'DECIMAL',
                'constraint' => '12,2',
            ],

            'status' => [
                'type'       => 'ENUM',
                'constraint' => [
                    'Pending',
                    'Approved',
                    'Rejected',
                    'Selesai'
                ],
                'default' => 'Pending',
            ],

            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ]

        ]);

        $this->forge->addKey('id', true);

        // foreign key user
        $this->forge->addForeignKey(
            'user_id',
            'users',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // foreign key facility
        $this->forge->addForeignKey(
            'facility_id',
            'facilities',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('reservations');
    }

    public function down()
    {
        $this->forge->dropTable('reservations');
    }
}