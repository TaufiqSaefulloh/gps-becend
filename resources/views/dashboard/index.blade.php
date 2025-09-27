@extends('layout.master')

@section('head')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    window.userHistory = JSON.parse('{!! json_encode($users) !!}');
</script>
<script src="{{ asset('js/dashboard_map_leaflet.js') }}"></script>
<style>
    #map { height: 70vh; width: 100%; border-radius: 8px; margin-bottom: 20px; }
    .user-table-container { max-height: 300px; overflow-y: auto; }
    .search-bar { max-width: 300px; }
</style>
@endsection

@section('page-content')
<!-- Map -->
<div id="map"></div>

<!-- Users Table -->
<div class="card shadow-sm user-table-container">
    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
        <strong>Daftar User</strong>
        <input type="text" id="userSearch" class="form-control form-control-sm search-bar" placeholder="Cari user, email ...">
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0" id="userTable">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>User</th>
                        <th>Posisi Terakhir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user['nip'] }}</td> <!-- ganti -->
                        <td>{{ $user['name'] }}</td>
                        <td>
                            @if($user['latestLocation'])
                            <span class="badge bg-success">{{ $user['latestLocation']['latitude'] }}, {{ $user['latestLocation']['longitude'] }}</span>
                            @else
                            <span class="badge bg-secondary">-</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.user.history', ['user_id' => $user['id'], 'date' => date('Y-m-d')]) }}" class="btn btn-sm btn-primary">Lihat History</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('userSearch');
    const table = document.getElementById('userTable').getElementsByTagName('tbody')[0];

    searchInput.addEventListener('keyup', function() {
        const filter = searchInput.value.toLowerCase();
        Array.from(table.rows).forEach(row => {
            const name = row.cells[1].textContent.toLowerCase();
            const email = row.cells[2].textContent.toLowerCase();
            row.style.display = (name.includes(filter) || email.includes(filter)) ? '' : 'none';
        });
    });
});
</script>
@endsection
