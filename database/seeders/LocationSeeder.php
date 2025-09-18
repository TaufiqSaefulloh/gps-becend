<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        // Contoh lokasi di Jakarta & sekitarnya
        $locations = [
            ['user_id' => 1, 'latitude' => -6.200, 'longitude' => 106.816, 'timestamp' => Carbon::now()->subMinutes(10)],
            ['user_id' => 1, 'latitude' => -6.201, 'longitude' => 106.817, 'timestamp' => Carbon::now()->subMinutes(5)],
            ['user_id' => 2, 'latitude' => -6.210, 'longitude' => 106.820, 'timestamp' => Carbon::now()->subMinutes(15)],
            ['user_id' => 2, 'latitude' => -6.212, 'longitude' => 106.822, 'timestamp' => Carbon::now()->subMinutes(5)],
            ['user_id' => 3, 'latitude' => -6.220, 'longitude' => 106.830, 'timestamp' => Carbon::now()->subMinutes(20)],
        ];

        foreach($locations as $loc){
            DB::table('locations')->insert([
                'user_id' => $loc['user_id'],
                'latitude' => $loc['latitude'],
                'longitude' => $loc['longitude'],
                'timestamp' => $loc['timestamp'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
