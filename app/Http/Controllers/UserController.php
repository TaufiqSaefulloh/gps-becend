<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Provinsi;
use App\Models\Ulp;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Kalau ada input pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Bisa pakai pagination biar rapi
        $users = $query->orderBy('name')->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $provinsi = Provinsi::all(); // ambil semua provinsi dari tabel provinsi
        $ulp = Ulp::all(); // ambil semua data ULP
        return view('admin.users.create', compact('provinsi', 'ulp'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip'      => $request->role === 'user'
                ? 'required|string|max:255|unique:users,nip'
                : 'nullable|string|max:255|unique:users,nip',
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|string|in:admin,user',
            'id_ulp' => 'required|exists:ulp,id',
        ]);

        User::create([
            'nip'      => $request->nip,
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
            'id_ulp' => $request->id_ulp,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dibuat.');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nip'      => $request->role === 'user'
                ? ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)]
                : ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'name'     => 'required|string|max:255',
            'email'    => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:6|confirmed',
            'role'     => 'required|string|in:admin,user',
            'id_ulp' => 'required|exists:ulp,id',
        ]);

        $user->nip   = $request->nip;
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->role  = $request->role;
        $user->id_ulp = $request->id_ulp;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diupdate.');
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        $ulp = Ulp::all(); // ambil semua data ULP
        return view('admin.users.edit', compact('user', 'ulp'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        // Tingkatkan maksimal eksekusi PHP (detik)
        set_time_limit(300); // 5 menit

        Excel::import(new UsersImport, $request->file('file'));

        return redirect()->route('admin.users.index')->with('success', 'Users berhasil diimport!');
    }
}
