<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UidSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('uid')->insertOrIgnore([
            // Cluster KALIMANTAN
            [
                'id' => 1,
                'nama_uid' => 'KALBAR',
                'id_cluster' => 1, // KALIMANTAN
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama_uid' => 'KALSELTENG',
                'id_cluster' => 1, // KALIMANTAN
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nama_uid' => 'KALTIMRA',
                'id_cluster' => 1, // KALIMANTAN
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Cluster SULAWESI
            [
                'id' => 4,
                'nama_uid' => 'SULSELRABAR',
                'id_cluster' => 2, // SULAWESI
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'nama_uid' => 'SULUTTENGGO',
                'id_cluster' => 2, // SULAWESI
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Cluster NUSA TENGGARA
            [
                'id' => 6,
                'nama_uid' => 'NTB',
                'id_cluster' => 3, // NUSA TENGGARA
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'nama_uid' => 'NTT',
                'id_cluster' => 3, // NUSA TENGGARA
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Cluster MALUKU
            [
                'id' => 8,
                'nama_uid' => 'MMU',
                'id_cluster' => 4, // MALUKU
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Cluster PAPUA
            [
                'id' => 9,
                'nama_uid' => 'P2B',
                'id_cluster' => 5, // PAPUA
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}