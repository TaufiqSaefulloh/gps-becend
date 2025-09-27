<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['nip' => '10001', 'name' => 'Ahmad',  'email' => 'ahmad@example.com',  'password' => 'password', 'id_ulp' => 2],
            ['nip' => '10002', 'name' => 'Budi',   'email' => 'budi@example.com',   'password' => 'password', 'id_ulp' => 3],
            ['nip' => '10003', 'name' => 'Citra',  'email' => 'citra@example.com',  'password' => 'password', 'id_ulp' => 2],
            ['nip' => '10004', 'name' => 'Dewi',   'email' => 'dewi@example.com',   'password' => 'password', 'id_ulp' => 2],
            ['nip' => '10005', 'name' => 'Eka',    'email' => 'eka@example.com',    'password' => 'password', 'id_ulp' => 3],
            ['nip' => '10006', 'name' => 'Fajar',  'email' => 'fajar@example.com',  'password' => 'password', 'id_ulp' => 3],
            ['nip' => '10007', 'name' => 'Gilang', 'email' => 'gilang@example.com', 'password' => 'password', 'id_ulp' => 3],
            ['nip' => '10008', 'name' => 'Hana',   'email' => 'hana@example.com',   'password' => 'password', 'id_ulp' => 2],
            ['nip' => '10009', 'name' => 'Indra',  'email' => 'indra@example.com',  'password' => 'password', 'id_ulp' => 3],
            ['nip' => '10010', 'name' => 'Joko',   'email' => 'joko@example.com',   'password' => 'password', 'id_ulp' => 2],
            ['nip' => '10011', 'name' => 'Kiki',   'email' => 'kiki@example.com',   'password' => 'password', 'id_ulp' => 2],
            ['nip' => '10012', 'name' => 'Lina',   'email' => 'lina@example.com',   'password' => 'password', 'id_ulp' => 3],
            ['nip' => '10013', 'name' => 'Mira',   'email' => 'mira@example.com',   'password' => 'password', 'id_ulp' => 3],
            ['nip' => '10014', 'name' => 'Nanda',  'email' => 'nanda@example.com',  'password' => 'password', 'id_ulp' => 2],
            ['nip' => '10015', 'name' => 'Oscar',  'email' => 'oscar@example.com',  'password' => 'password', 'id_ulp' => 3],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'nip' => $user['nip'],
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'id_ulp' => $user['id_ulp'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
