<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ulp;
use Illuminate\Http\Request;
use App\Models\Provinsi;

class UlpController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Ulp::with('provinsi');

        if ($search) {
            $query->where('nama_ulp', 'like', "%{$search}%")
                ->orWhereHas('provinsi', function ($q) use ($search) {
                    $q->where('nama_provinsi', 'like', "%{$search}%");
                });
        }

        $data = $query->get();

        return view('admin.ulp.index', compact('data'));
    }

    public function create()
    {
        $provinsi = Provinsi::all(); // ambil semua provinsi dari tabel provinsi
        return view('admin.ulp.create', compact('provinsi'));
    }
    public function edit($id)
    {
        $ulp = Ulp::findOrFail($id);
        $provinsi = Provinsi::all(); // ambil semua provinsi dari tabel provinsi
        return view('admin.ulp.edit', compact('ulp', 'provinsi'));
    }
}
