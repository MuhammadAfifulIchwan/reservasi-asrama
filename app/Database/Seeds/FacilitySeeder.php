<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FacilitySeeder extends Seeder
{
    public function run()
    {
        $data = [

            // KAMAR PUTRA
            [
                'facility_code' => 'PUTRA01',
                'facility_name' => 'Putra-01',
                'category' => 'Kamar Putra',
                'price' => 150000,
                'capacity' => 1,
                'description' => 'Kamar mahasiswa putra',
                'image' => null,
                'status' => 'Tersedia',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],

            [
                'facility_code' => 'PUTRA02',
                'facility_name' => 'Putra-02',
                'category' => 'Kamar Putra',
                'price' => 150000,
                'capacity' => 1,
                'description' => 'Kamar mahasiswa putra',
                'image' => null,
                'status' => 'Tersedia',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],

            [
                'facility_code' => 'PUTRA03',
                'facility_name' => 'Putra-03',
                'category' => 'Kamar Putra',
                'price' => 150000,
                'capacity' => 1,
                'description' => 'Kamar mahasiswa putra',
                'image' => null,
                'status' => 'Tersedia',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],

            [
                'facility_code' => 'PUTRA04',
                'facility_name' => 'Putra-04',
                'category' => 'Kamar Putra',
                'price' => 150000,
                'capacity' => 1,
                'description' => 'Kamar mahasiswa putra',
                'image' => null,
                'status' => 'Tersedia',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],

            [
                'facility_code' => 'PUTRA05',
                'facility_name' => 'Putra-05',
                'category' => 'Kamar Putra',
                'price' => 150000,
                'capacity' => 1,
                'description' => 'Kamar mahasiswa putra',
                'image' => null,
                'status' => 'Tersedia',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],

            // KAMAR PUTRI
            [
                'facility_code' => 'PUTRI01',
                'facility_name' => 'Putri-01',
                'category' => 'Kamar Putri',
                'price' => 150000,
                'capacity' => 1,
                'description' => 'Kamar mahasiswa putri',
                'image' => null,
                'status' => 'Tersedia',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],

            [
                'facility_code' => 'PUTRI02',
                'facility_name' => 'Putri-02',
                'category' => 'Kamar Putri',
                'price' => 150000,
                'capacity' => 1,
                'description' => 'Kamar mahasiswa putri',
                'image' => null,
                'status' => 'Tersedia',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],

            [
                'facility_code' => 'PUTRI03',
                'facility_name' => 'Putri-03',
                'category' => 'Kamar Putri',
                'price' => 150000,
                'capacity' => 1,
                'description' => 'Kamar mahasiswa putri',
                'image' => null,
                'status' => 'Tersedia',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],

            [
                'facility_code' => 'PUTRI04',
                'facility_name' => 'Putri-04',
                'category' => 'Kamar Putri',
                'price' => 150000,
                'capacity' => 1,
                'description' => 'Kamar mahasiswa putri',
                'image' => null,
                'status' => 'Tersedia',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],

            [
                'facility_code' => 'PUTRI05',
                'facility_name' => 'Putri-05',
                'category' => 'Kamar Putri',
                'price' => 150000,
                'capacity' => 1,
                'description' => 'Kamar mahasiswa putri',
                'image' => null,
                'status' => 'Tersedia',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],

            // KAMAR TAMU
            [
                'facility_code' => 'TAMU01',
                'facility_name' => 'Tamu-01',
                'category' => 'Kamar Tamu',
                'price' => 100000,
                'capacity' => 2,
                'description' => 'Kamar tamu asrama',
                'image' => null,
                'status' => 'Tersedia',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],

            [
                'facility_code' => 'TAMU02',
                'facility_name' => 'Tamu-02',
                'category' => 'Kamar Tamu',
                'price' => 100000,
                'capacity' => 2,
                'description' => 'Kamar tamu asrama',
                'image' => null,
                'status' => 'Tersedia',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],

            [
                'facility_code' => 'TAMU03',
                'facility_name' => 'Tamu-03',
                'category' => 'Kamar Tamu',
                'price' => 100000,
                'capacity' => 2,
                'description' => 'Kamar tamu asrama',
                'image' => null,
                'status' => 'Tersedia',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],

            [
                'facility_code' => 'TAMU04',
                'facility_name' => 'Tamu-04',
                'category' => 'Kamar Tamu',
                'price' => 100000,
                'capacity' => 2,
                'description' => 'Kamar tamu asrama',
                'image' => null,
                'status' => 'Tersedia',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],

            [
                'facility_code' => 'TAMU05',
                'facility_name' => 'Tamu-05',
                'category' => 'Kamar Tamu',
                'price' => 100000,
                'capacity' => 2,
                'description' => 'Kamar tamu asrama',
                'image' => null,
                'status' => 'Tersedia',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],

            // PARKIR
            [
                'facility_code' => 'PARKIRMOBIL',
                'facility_name' => 'Parkir Mobil',
                'category' => 'Parkir',
                'price' => 20000,
                'capacity' => 25,
                'description' => 'Area parkir mobil',
                'image' => null,
                'status' => 'Tersedia',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],

            [
                'facility_code' => 'PARKIRBUS',
                'facility_name' => 'Parkir Bus',
                'category' => 'Parkir',
                'price' => 50000,
                'capacity' => 10,
                'description' => 'Area parkir bus',
                'image' => null,
                'status' => 'Tersedia',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]

        ];

        $this->db->table('facilities')->insertBatch($data);
    }
}