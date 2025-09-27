@extends('layout.master')

@section('head')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    window.userHistory = JSON.parse('{!! json_encode($locations) !!}');
</script>
<script src="{{ asset('js/history_map_leaflet.js') }}"></script>
@endsection

@section('page-content')
<div class=" my-4">

    <!-- Title -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">
            📍 History Lokasi - {{ $user->name }}
            <small class="text-muted">({{ $date }})</small>
        </h3>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">
            ⬅ Kembali ke Dashboard
        </a>
    </div>

    <!-- Map -->
    <div class="card shadow-sm mb-4">
        <div class="card-body p-0">
            <div id="map" style="height:500px; border-radius: 10px;"></div>
        </div>
    </div>


    <!-- Table -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0 fw-semibold">📋 Riwayat Koordinat</h5>
        </div>
        <!-- Filter Tanggal -->

        <div class="d-flex justify-content-between align-items-center m-3">
            <form method="GET" action="{{ route('admin.user.history') }}" class="d-flex align-items-center">
                <!-- Pilih User -->
                <select name="user_id" class="form-select form-select-sm me-2" onchange="this.form.submit()">
                    @foreach($users as $u)
                    <option value="{{ $u->id }}" @if($u->id == $user->id) selected @endif>
                        {{ $u->name }}
                    </option>
                    @endforeach
                </select>

                <!-- Pilih Tanggal -->
                <input type="date" name="date" value="{{ $date }}" class="form-control form-control-sm me-2">
                <button type="submit" class="btn btn-sm btn-primary">Filter</button>
            </form>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle table-hover mb-0">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>⏰ Waktu</th>
                            <th>🌍 Latitude</th>
                            <th>🌍 Longitude</th>
                            <th>📍 Lokasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($locations as $loc)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold text-center">{{ $loc->timestamp }}</td>
                            <td class="text-success fw-bold">{{ $loc->latitude }}</td>
                            <td class="text-primary fw-bold">{{ $loc->longitude }}</td>
                            <td class="alamat" data-lat="{{ $loc->latitude }}" data-lon="{{ $loc->longitude }}">
                                ⏳ Memuat...
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">
                                🚫 Tidak ada data lokasi untuk tanggal ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", async function() {
        const alamatCells = document.querySelectorAll(".alamat");
        alamatCells.forEach(async (cell) => {
            let lat = cell.getAttribute("data-lat");
            let lon = cell.getAttribute("data-lon");

            try {
                let res = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`);
                let data = await res.json();
                cell.innerHTML = data.display_name || "❓ Tidak diketahui";
            } catch (e) {
                cell.innerHTML = "⚠️ Gagal memuat alamat";
            }
        });
    });
</script>