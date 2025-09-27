<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Location;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->query('date', date('Y-m-d')); // ambil dari query atau default hari ini

        // Ambil semua user kecuali admin (id=1) beserta lokasi terbaru sesuai tanggal
        $users = User::with(['locations' => function ($q) use ($date) {
            $q->whereDate('timestamp', $date)->latest(); // lokasi sesuai tanggal, urut terbaru
        }])
            ->where('id', '!=', 1) // filter user admin
            ->get();

        // Map ke JSON untuk frontend
        $usersJson = $users->map(function ($user) {
            $latest = $user->locations->first(); // lokasi terbaru sesuai filter
            return [
                'id' => $user->id,
                'name' => $user->name,
                'nip' => $user->nip, // ganti email dengan nip
                'latestLocation' => $latest ? [
                    'latitude' => $latest->latitude,
                    'longitude' => $latest->longitude,
                    'timestamp' => $latest->timestamp,
                ] : null
            ];
        });

        return view('dashboard.index', [
            'users' => $usersJson,
            'date' => $date
        ]);
    }



    public function history(Request $request)
    {
        $userId = $request->query('user_id', User::first()->id ?? null);
        $date   = $request->query('date', date('Y-m-d'));

        $user = User::findOrFail($userId);

        $locations = $user->locations()
            ->whereDate('timestamp', $date)
            ->orderBy('timestamp', 'desc')
            ->get()
            ->map(function ($loc) {
                return (object) [
                    'id'        => $loc->id,
                    'latitude'  => $loc->latitude,
                    'longitude' => $loc->longitude,
                    'timestamp' => Carbon::parse($loc->timestamp)
                        ->timezone('Asia/Makassar')
                        ->format('d M Y H:i:s') . ' WITA',
                ];
            });

        $users = User::orderBy('name')->get();

        return view('dashboard.history', compact('user', 'locations', 'date', 'users'));
    }
}
