@extends('layout.master')

@section('page-content')
<div class="container-fluid">
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Tambah Cluster</h4>
            <p class="text-muted fs-14 mb-0">Tambah cluster baru untuk SPKLU</p>
        </div>
        <div class="flex-shrink-0">
            <a href="{{ route('admin.cluster.index') }}" class="btn btn-secondary">
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
                        Form Tambah Cluster
                    </h5>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-alert-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.cluster.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama_cluster" class="form-label">
                                        <i class="mdi mdi-view-grid text-primary me-1"></i>
                                        Nama Cluster <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('nama_cluster') is-invalid @enderror" 
                                           id="nama_cluster" 
                                           name="nama_cluster" 
                                           value="{{ old('nama_cluster') }}"
                                           placeholder="Contoh: Cluster Jakarta, Cluster Bandung, dll"
                                           required>
                                    @error('nama_cluster')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Masukkan nama cluster yang akan digunakan untuk mengelompokkan SPKLU
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="mdi mdi-content-save me-1"></i>
                                        Simpan Cluster
                                    </button>
                                    <a href="{{ route('admin.cluster.index') }}" class="btn btn-secondary">
                                        <i class="mdi mdi-close me-1"></i>
                                        Batal
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-bottom')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto focus pada input pertama
    document.getElementById('nama_cluster').focus();
    
    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const clusterInput = document.getElementById('nama_cluster');
        if (!clusterInput.value.trim()) {
            e.preventDefault();
            clusterInput.classList.add('is-invalid');
            clusterInput.focus();
            return false;
        }
    });
});
</script>
@endsection 