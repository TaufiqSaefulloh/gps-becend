<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provinsi;
use App\Models\Uid;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Provinsi::with('uid.cluster');

        if ($search) {
            // Cari provinsi berdasarkan nama provinsi
            $query->where('nama_provinsi', 'like', "%{$search}%");
            // Jika ingin mencari UID atau cluster juga, bisa ditambahkan like ini:
            // ->orWhereHas('uid', function($q) use ($search) {
            //     $q->where('nama_uid', 'like', "%{$search}%")
            //       ->orWhereHas('cluster', function($q2) use ($search) {
            //           $q2->where('nama_cluster', 'like', "%{$search}%");
            //       });
            // });
        }

        $data = $query->get();

        return view('admin.provinsi.index', compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $uids = Uid::all();
        return view('admin.provinsi.create', compact('uids'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_provinsi' => 'required|string|max:255|unique:provinsi,nama_provinsi',
            'id_uid' => 'required|exists:uid,id',
        ]);

        Provinsi::create([
            'nama_provinsi' => $request->nama_provinsi,
            'id_uid' => $request->id_uid,
        ]);

        return redirect()->route('admin.provinsi.index')->with('success', 'Provinsi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $provinsi = Provinsi::findOrFail($id);
        return view('admin.provinsi.show', compact('provinsi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $provinsi = Provinsi::findOrFail($id);
        $uids = Uid::all(); // ambil semua UID
        return view('admin.provinsi.edit', compact('provinsi', 'uids'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_provinsi' => 'required|string|max:255|unique:provinsi,nama_provinsi,' . $id,
            'id_uid' => 'required|exists:uid,id',
        ]);
        $provinsi = Provinsi::findOrFail($id);
        $provinsi->update([
            'nama_provinsi' => $request->nama_provinsi,
            'id_uid' => $request->id_uid,
        ]);

        return redirect()->route('admin.provinsi.index')->with('success', 'Provinsi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $provinsi = Provinsi::findOrFail($id);
        $provinsi->delete();

        return redirect()->route('admin.provinsi.index')->with('success', 'Provinsi berhasil dihapus.');
    }
}
