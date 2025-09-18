@extends('layout.master')

@section('head')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    window.userHistory = JSON.parse('{!! json_encode($locations) !!}');
</script>
<script src="{{ asset('js/history_map_leaflet.js') }}"></script>
@endsection

@section('content')
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
                            <th style="width: 30%;">⏰ Waktu</th>
                            <th style="width: 35%;">🌍 Latitude</th>
                            <th style="width: 35%;">🌍 Longitude</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($locations as $loc)
                        <tr>
                            <td class="fw-semibold text-center">{{ $loc->timestamp }}</td>
                            <td class="text-success fw-bold">{{ $loc->latitude }}</td>
                            <td class="text-primary fw-bold">{{ $loc->longitude }}</td>
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