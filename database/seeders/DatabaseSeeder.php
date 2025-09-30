<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            ClusterSeeder::class,
            UidSeeder::class,
            ProvinsiSeeder::class,
            UlpSeeder::class,
            // UserSeeder::class,
            // LocationSeeder::class,
        ]);
    }
}
