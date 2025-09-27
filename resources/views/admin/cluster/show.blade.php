@extends('layouts.vertical', ['title' => 'Detail Cluster'])

@section('content')
<div class="container-fluid">
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Detail Cluster</h4>
            <p class="text-muted fs-14 mb-0">Informasi lengkap cluster</p>
        </div>
        <div class="flex-shrink-0">
            <a href="{{ route('cluster.index') }}" class="btn btn-secondary">
                <i class="mdi mdi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-view-grid text-primary me-2"></i>
                        Informasi Cluster
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="150" class="fw-bold">
                                        <i class="mdi mdi-view-grid text-primary me-1"></i>
                                        Nama Cluster:
                                    </td>
                                    <td>{{ $cluster->nama_cluster }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">
                                        <i class="mdi mdi-calendar-plus text-secondary me-1"></i>
                                        Dibuat:
                                    </td>
                                    <td>{{ $cluster->created_at ? $cluster->created_at->format('d M Y H:i') : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">
                                        <i class="mdi mdi-calendar-edit text-warning me-1"></i>
                                        Diperbarui:
                                    </td>
                                    <td>{{ $cluster->updated_at ? $cluster->updated_at->format('d M Y H:i') : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">
                                        <i class="mdi mdi-domain text-info me-1"></i>
                                        Jumlah UID:
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $cluster->uids->count() }}</span>
                                        UID terdaftar
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex gap-2">
                                <a href="{{ route('cluster.edit', $cluster->id) }}" class="btn btn-warning">
                                    <i class="mdi mdi-pencil me-1"></i>
                                    Edit Cluster
                                </a>
                                <form action="{{ route('cluster.destroy', $cluster->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus cluster ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="mdi mdi-delete me-1"></i>
                                        Hapus Cluster
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($cluster->uids->count() > 0)
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-domain text-info me-2"></i>
                        Daftar UID dalam Cluster {{ $cluster->nama_cluster }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Nama UID</th>
                                    <th>Dibuat</th>
                                    <th>Diperbarui</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cluster->uids as $uid)
                                <tr>
                                    <td>
                                        <span class="badge bg-primary">{{ $uid->id }}</span>
                                    </td>
                                    <td>
                                        <i class="mdi mdi-account text-warning me-1"></i>
                                        {{ $uid->nama_uid }}
                                    </td>
                                    <td>
                                        <i class="mdi mdi-calendar-plus text-secondary me-1"></i>
                                        {{ $uid->created_at ? $uid->created_at->format('d M Y H:i') : 'N/A' }}
                                    </td>
                                    <td>
                                        <i class="mdi mdi-calendar-edit text-info me-1"></i>
                                        {{ $uid->updated_at ? $uid->updated_at->format('d M Y H:i') : 'N/A' }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center">
                    <i class="mdi mdi-domain-off text-muted" style="font-size:3rem;"></i>
                    <h5 class="text-muted mt-3">Belum ada UID yang menggunakan cluster ini</h5>
                    <p class="text-muted">UID yang menggunakan cluster {{ $cluster->nama_cluster }} akan muncul di sini</p>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@section('script-bottom')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Konfirmasi hapus
    const deleteForm = document.querySelector('form[action*="destroy"]');
    if (deleteForm) {
        deleteForm.addEventListener('submit', function(e) {
            if (!confirm('Apakah Anda yakin ingin menghapus cluster ini? Tindakan ini tidak dapat dibatalkan.')) {
                e.preventDefault();
                return false;
            }
        });
    }
});
</script>
@endsection 