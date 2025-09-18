@extends('layout.master')

@section('head')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // Pakai ini sesuai permintaan Pak, jangan diubah
    window.userHistory = JSON.parse('{!! json_encode($users) !!}');
</script>

<script src="{{ asset('js/dashboard_map_leaflet.js') }}"></script>
@endsection

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">🚗 GPS TRACKER</a>

        <div class="dropdown">
            <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" id="profileDropdown"
                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff&size=32"
                    alt="profile" class="rounded-circle me-2">
                <span class="d-none d-lg-inline fw-semibold">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="profileDropdown">
                <li>
                    <form action="{{ route('admin.logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                    </form>
                </li>
            </ul>
        </div>

    </div>
</nav>

<!-- Map -->
<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
        <strong>Peta Posisi Terbaru</strong>
        <!-- Filter Tanggal -->
        <div class="card shadow-sm mb-4">
            <div class="card-body d-flex align-items-center">
                <form action="{{ route('admin.dashboard') }}" method="GET" class="d-flex align-items-center">
                    <label for="date" class="me-2 fw-semibold">Pilih Tanggal:</label>
                    <input type="date" name="date" id="date" class="form-control me-2"
                        value="{{ request('date', date('Y-m-d')) }}">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
                @if(request('date'))
                <span class="ms-3 text-muted">Menampilkan data tanggal: <strong>{{ request('date') }}</strong></span>
                @endif
            </div>
        </div>

    </div>
    <div class="card-body p-0">
        <div id="map" style="height: 500px; width: 100%; border-radius: 5px;"></div>
    </div>
</div>

<!-- Users Table -->
<div class="card shadow-sm">
    <div class="card-header bg-secondary text-white">
        <strong>Daftar User</strong>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">User</th>
                        <th scope="col">Email</th>
                        <th scope="col">Posisi Terakhir</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>
                            @if($user['latestLocation'])
                            <span class="badge bg-success">
                                {{ $user['latestLocation']['latitude'] }}, {{ $user['latestLocation']['longitude'] }}
                            </span>
                            @else
                            <span class="badge bg-secondary">-</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.user.history', ['user_id' => $user['id'], 'date' => date('Y-m-d')]) }}"
                                class="btn btn-sm btn-primary">
                                Lihat History
                            </a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection