<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        // Contoh ULP region untuk 15 user pertama
        $regions = [
            'Balikpapan Selatan' => ['lat_min' => -1.250, 'lat_max' => -1.220, 'lng_min' => 116.850, 'lng_max' => 116.920],
            'Samarinda Kota'     => ['lat_min' => -0.500, 'lat_max' => -0.480, 'lng_min' => 117.120, 'lng_max' => 117.150],
            'Tenggarong'         => ['lat_min' => -0.500, 'lat_max' => -0.480, 'lng_min' => 116.900, 'lng_max' => 116.930],
        ];

        // Assign tiap user ke region
        $userRegions = [
            1 => 'Balikpapan Selatan',
            2 => 'Balikpapan Selatan',
            3 => 'Balikpapan Selatan',
            4 => 'Samarinda Kota',
            5 => 'Samarinda Kota',
            6 => 'Samarinda Kota',
            7 => 'Tenggarong',
            8 => 'Tenggarong',
            9 => 'Tenggarong',
            10 => 'Balikpapan Selatan',
            11 => 'Samarinda Kota',
            12 => 'Tenggarong',
            13 => 'Balikpapan Selatan',
            14 => 'Samarinda Kota',
            15 => 'Tenggarong',
        ];

        foreach ($userRegions as $user_id => $regionName) {
            $latMin = $regions[$regionName]['lat_min'];
            $latMax = $regions[$regionName]['lat_max'];
            $lngMin = $regions[$regionName]['lng_min'];
            $lngMax = $regions[$regionName]['lng_max'];

            for ($i = 0; $i < 3; $i++) {
                $latitude  = $latMin + mt_rand(0, 10000)/10000 * ($latMax - $latMin);
                $longitude = $lngMin + mt_rand(0, 10000)/10000 * ($lngMax - $lngMin);

                DB::table('locations')->insert([
                    'user_id' => $user_id,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'timestamp' => Carbon::now()->subMinutes(rand(1,60)),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
