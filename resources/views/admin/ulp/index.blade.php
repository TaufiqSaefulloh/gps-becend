@extends("layout.master")

@section("page-content")
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-semibold">Master Data ULP</h5>

                    <div class="d-flex align-items-center">
                        <!-- Search Bar -->
                        <form action="{{ route('admin.ulp.index') }}" method="GET" class="d-flex me-2">
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="form-control form-control-sm me-2"
                                placeholder="Cari nama ULP / Provinsi...">
                            <button type="submit" class="btn btn-sm btn-outline-primary">🔍</button>
                        </form>


                        <!-- Tambah User -->
                        <a href="{{ route('admin.ulp.create') }}" class="btn btn-primary btn-sm">➕ Tambah ULP</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama ULP</th>
                                <th>ID Provinsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_ulp }}</td>
                                <td>
                                    @if($item->provinsi)
                                    <span class="badge bg-info">{{ $item->provinsi->nama_provinsi }}</span>
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td>
                                    <!-- Tombol Lihat Users -->
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#usersModal{{ $item->id }}">
                                        👤 Users
                                    </button>
                                    <a href="{{ route('admin.ulp.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                        <i class="mdi mdi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.ulp.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="mdi mdi-delete"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @foreach($data as $item)
                    <div class="modal fade" id="usersModal{{ $item->id }}" tabindex="-1" aria-labelledby="usersModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="usersModalLabel{{ $item->id }}">Users di {{ $item->nama_ulp }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @php
                                    $users = $item->users; // pastikan relasi di model ULP sudah ada
                                    @endphp

                                    @if($users->count())
                                    <table class="table table-bordered text-center mb-0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIP</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $index => $user)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $user->nip }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                    <p class="text-center text-muted">Belum ada user untuk ULP ini.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection