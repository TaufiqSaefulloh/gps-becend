@extends('layout.master')

@section('page-content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-semibold">Master Data User</h5>

        <div class="d-flex align-items-center">
            <!-- Search Bar -->
            <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex me-2">
                <input type="text" name="search" value="{{ request('search') }}"
                    class="form-control form-control-sm me-2"
                    placeholder="Cari nama/email...">
                <button type="submit" class="btn btn-sm btn-outline-primary">🔍</button>
            </form>

            <div class="d-flex justify-content-between align-items-center me-2 gap-2">
                <!-- Tambah User -->
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
                    ➕ Tambah User
                </a>

                <!-- Import Users -->
                <form action="{{ route('admin.users.import') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center gap-2">
                    @csrf
                    <input type="file" name="file" class="form-control form-control-sm" required>
                    <button type="submit" class="btn btn-success btn-sm">
                        📂 Import Users
                    </button>
                </form>
            </div>


        </div>
    </div>

    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th width="200">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $user->nip }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><span class="badge bg-info">{{ $user->role ?? 'User' }}</span></td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin hapus user ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">🗑️ Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-3">Belum ada data user</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection