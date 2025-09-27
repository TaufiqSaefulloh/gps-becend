<?php

namespace App\Http\Controllers\Api; // PENTING

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function store(Request $request)
    {
        // \Log::info("Lokasi diterima: ", $request->all());
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $location = Location::create([
            'user_id' => $request->user()->id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'timestamp' => now(),
        ]);

        return response()->json(['message' => 'Lokasi tersimpan', 'data' => $location]);
    }

    public function last(Request $request)
    {
        $location = Location::where('user_id', $request->user()->id)
            ->latest('timestamp')
            ->first();

        return response()->json($location);
    }

    public function history(Request $request)
    {
        $date = $request->query('date', now()->toDateString());

        $locations = Location::where('user_id', $request->user()->id)
            ->whereDate('timestamp', $date)
            ->orderBy('timestamp')
            ->get();

        return response()->json($locations);
    }
}
