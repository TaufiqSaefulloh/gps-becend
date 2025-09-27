<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('provinsi')->insertOrIgnore([
            // Cluster KALIMANTAN - KALBAR
            [
                'id' => 1,
                'nama_provinsi' => 'KALIMANTAN BARAT',
                'id_uid' => 1, // KALBAR
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Cluster KALIMANTAN - KALSELTENG
            [
                'id' => 2,
                'nama_provinsi' => 'KALIMANTAN SELATAN',
                'id_uid' => 2, // KALSELTENG
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nama_provinsi' => 'KALIMANTAN TENGAH',
                'id_uid' => 2, // KALSELTENG
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Cluster KALIMANTAN - KALTIMRA
            [
                'id' => 4,
                'nama_provinsi' => 'KALIMANTAN TIMUR',
                'id_uid' => 3, // KALTIMRA
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'nama_provinsi' => 'KALIMANTAN UTARA',
                'id_uid' => 3, // KALTIMRA
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Cluster SULAWESI - SULSELRABAR
            [
                'id' => 6,
                'nama_provinsi' => 'SULAWESI SELATAN',
                'id_uid' => 4, // SULSELRABAR
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'nama_provinsi' => 'SULAWESI TENGGARA',
                'id_uid' => 4, // SULSELRABAR
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'nama_provinsi' => 'SULAWESI BARAT',
                'id_uid' => 4, // SULSELRABAR
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Cluster SULAWESI - SULUTTENGGO
            [
                'id' => 9,
                'nama_provinsi' => 'SULAWESI UTARA',
                'id_uid' => 5, // SULUTTENGGO
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'nama_provinsi' => 'SULAWESI TENGAH',
                'id_uid' => 5, // SULUTTENGGO
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 11,
                'nama_provinsi' => 'GORONTALO',
                'id_uid' => 5, // SULUTTENGGO
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Cluster NUSA TENGGARA - NTB
            [
                'id' => 12,
                'nama_provinsi' => 'NUSA TENGGARA BARAT',
                'id_uid' => 6, // NTB
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Cluster NUSA TENGGARA - NTT
            [
                'id' => 13,
                'nama_provinsi' => 'NUSA TENGGARA TIMUR',
                'id_uid' => 7, // NTT
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Cluster MALUKU - MMU
            [
                'id' => 14,
                'nama_provinsi' => 'MALUKU',
                'id_uid' => 8, // MMU
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 15,
                'nama_provinsi' => 'MALUKU UTARA',
                'id_uid' => 8, // MMU
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Cluster PAPUA - P2B
            [
                'id' => 16,
                'nama_provinsi' => 'PAPUA',
                'id_uid' => 9, // P2B
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 17,
                'nama_provinsi' => 'PAPUA BARAT',
                'id_uid' => 9, // P2B
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
