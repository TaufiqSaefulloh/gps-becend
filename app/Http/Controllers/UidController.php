<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Uid;
use App\Models\Cluster;

class UidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Uid::with('cluster');

        if ($search) {
            $query->where('nama_uid', 'like', "%{$search}%")
                ->orWhereHas('cluster', function ($q) use ($search) {
                    $q->where('nama_cluster', 'like', "%{$search}%");
                });
        }

        $data = $query->get();

        return view('admin.uid.index', compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clusters = Cluster::all();
        return view('admin.uid.create', compact('clusters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_uid' => 'required|string|max:255|unique:uid,nama_uid',
            'id_cluster' => 'required|exists:cluster,id',
        ]);

        Uid::create([
            'nama_uid' => $request->nama_uid,
            'id_cluster' => $request->id_cluster,
        ]);

        return redirect()->route('admin.uid.index')->with('success', 'UID berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Uid $uid)
    {
        return view('admin.uid.show', compact('uid'));
    }

    public function edit(Uid $uid)
    {
        $clusters = Cluster::all();
        return view('admin.uid.edit', compact('uid', 'clusters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_uid' => 'required|string|max:255|unique:uid,nama_uid,' . $id,
            'id_cluster' => 'required|exists:cluster,id',
        ]);

        $uid = Uid::findOrFail($id);
        $uid->update([
            'nama_uid' => $request->nama_uid,
            'id_cluster' => $request->id_cluster,
        ]);

        return redirect()->route('admin.uid.index')->with('success', 'UID berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $uid = Uid::findOrFail($id);
        $uid->delete();

        return redirect()->route('admin.uid.index')->with('success', 'UID berhasil dihapus.');
    }
}
