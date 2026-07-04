<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePaymentsTable extends Migration
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

            'reservation_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],

            'invoice_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],

            'payment_method' => [
                'type'       => 'ENUM',
                'constraint' => [
                    'Transfer Bank',
                    'QRIS'
                ],
            ],

            'payment_proof' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],

            'payment_status' => [
                'type'       => 'ENUM',
                'constraint' => [
                    'Belum Bayar',
                    'Menunggu Verifikasi',
                    'Lunas',
                    'Ditolak'
                ],
                'default' => 'Belum Bayar',
            ],

            'payment_date' => [
                'type' => 'DATETIME',
                'null' => true,
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

        // foreign key ke reservations
        $this->forge->addForeignKey(
            'reservation_id',
            'reservations',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('payments');
    }

    public function down()
    {
        $this->forge->dropTable('payments');
    }
}