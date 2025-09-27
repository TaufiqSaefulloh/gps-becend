<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClusterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // Daftar nama cluster unik yang diekstrak dari input Anda
        $clusters = [
            'KALIMANTAN',
            'SULAWESI',
            'NUSA TENGGARA',
            'MALUKU',
            'PAPUA',
        ];

        // Masukkan data cluster ke dalam tabel 'cluster'
        foreach ($clusters as $clusterName) {
            DB::table('cluster')->insert([
                'nama_cluster' => $clusterName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
