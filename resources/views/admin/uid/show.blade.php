@extends('layouts.vertical', ['title' => 'Detail UID'])

@section('content')
<div class="container-fluid">
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Detail UID</h4>
            <p class="text-muted fs-14 mb-0">Informasi lengkap UID</p>
        </div>
        <div class="flex-shrink-0">
            <a href="{{ route('uid.index') }}" class="btn btn-secondary">
                <i class="mdi mdi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-account text-primary me-2"></i>
                        Informasi UID
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="150" class="fw-bold">
                                        <i class="mdi mdi-account text-primary me-1"></i>
                                        Nama UID:
                                    </td>
                                    <td>{{ $uid->nama_uid }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">
                                        <i class="mdi mdi-view-grid text-info me-1"></i>
                                        Cluster:
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ $uid->cluster->nama_cluster }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">
                                        <i class="mdi mdi-calendar-plus text-secondary me-1"></i>
                                        Dibuat:
                                    </td>
                                    <td>{{ $uid->created_at ? $uid->created_at->format('d M Y H:i') : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">
                                        <i class="mdi mdi-calendar-edit text-warning me-1"></i>
                                        Diperbarui:
                                    </td>
                                    <td>{{ $uid->updated_at ? $uid->updated_at->format('d M Y H:i') : 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex gap-2">
                                <a href="{{ route('uid.edit', $uid->id) }}" class="btn btn-warning">
                                    <i class="mdi mdi-pencil me-1"></i>
                                    Edit UID
                                </a>
                                <form action="{{ route('uid.destroy', $uid->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus UID ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="mdi mdi-delete me-1"></i>
                                        Hapus UID
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-information text-info me-2"></i>
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
                                    <td>{{ $uid->cluster->nama_cluster }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">
                                        <i class="mdi mdi-calendar-plus text-secondary me-1"></i>
                                        Cluster Dibuat:
                                    </td>
                                    <td>{{ $uid->cluster->created_at ? $uid->cluster->created_at->format('d M Y H:i') : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">
                                        <i class="mdi mdi-calendar-edit text-warning me-1"></i>
                                        Cluster Diperbarui:
                                    </td>
                                    <td>{{ $uid->cluster->updated_at ? $uid->cluster->updated_at->format('d M Y H:i') : 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">
                                <i class="mdi mdi-view-grid text-primary" style="font-size:3rem;"></i>
                                <h5 class="mt-3">{{ $uid->cluster->nama_cluster }}</h5>
                                <p class="text-muted">Cluster yang digunakan oleh UID ini</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-bottom')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Konfirmasi hapus
    const deleteForm = document.querySelector('form[action*="destroy"]');
    if (deleteForm) {
        deleteForm.addEventListener('submit', function(e) {
            if (!confirm('Apakah Anda yakin ingin menghapus UID ini? Tindakan ini tidak dapat dibatalkan.')) {
                e.preventDefault();
                return false;
            }
        });
    }
});
</script>
@endsection 