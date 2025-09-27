<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cluster;

class ClusterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Cluster::with('uids');

        if ($search) {
            $query->where('nama_cluster', 'like', "%{$search}%");
        }

        $data = $query->get();

        return view('admin.cluster.index', compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cluster.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_cluster' => 'required|string|max:255|unique:cluster,nama_cluster',
        ]);

        Cluster::create([
            'nama_cluster' => $request->nama_cluster,
        ]);

        return redirect()->route('admin.cluster.index')->with('success', 'Cluster berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cluster $cluster)
    {
        $cluster->load('uids'); // ambil data UID terkait
        return view('admin.cluster.show', compact('cluster'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cluster $cluster)
    {
        return view('admin.cluster.edit', compact('cluster'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_cluster' => 'required|string|max:255',
        ]);

        $cluster = Cluster::findOrFail($id);
        $cluster->nama_cluster = $request->nama_cluster;
        $cluster->save();

        return redirect()->route('admin.cluster.index')->with('success', 'Cluster berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $cluster = Cluster::findOrFail($id);
        $cluster->delete();

        return redirect()->route('admin.cluster.index')->with('success', 'Cluster berhasil dihapus.');
    }
}
