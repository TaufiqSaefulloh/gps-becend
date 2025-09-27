@extends('layout.master')

@section('page-content')
<div class="container-fluid">
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Edit UID</h4>
            <p class="text-muted fs-14 mb-0">Edit data UID</p>
        </div>
        <div class="flex-shrink-0">
            <a href="{{ route('admin.uid.index') }}" class="btn btn-secondary">
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
                        Form Edit UID
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

                    <form action="{{ route('admin.uid.update', $uid->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama_uid" class="form-label">
                                        <i class="mdi mdi-account text-primary me-1"></i>
                                        Nama UID <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('nama_uid') is-invalid @enderror" 
                                           id="nama_uid" 
                                           name="nama_uid" 
                                           value="{{ old('nama_uid', $uid->nama_uid) }}"
                                           placeholder="Contoh: KALBAR, SULSELRABAR, NTB, dll"
                                           required>
                                    @error('nama_uid')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Edit nama UID yang akan digunakan
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="id_cluster" class="form-label">
                                        <i class="mdi mdi-view-grid text-primary me-1"></i>
                                        Cluster <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select @error('id_cluster') is-invalid @enderror" 
                                            id="id_cluster" 
                                            name="id_cluster" 
                                            required>
                                        <option value="">Pilih Cluster</option>
                                        @foreach($clusters as $cluster)
                                            <option value="{{ $cluster->id }}" {{ old('id_cluster', $uid->id_cluster) == $cluster->id ? 'selected' : '' }}>
                                                {{ $cluster->nama_cluster }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_cluster')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Pilih cluster yang akan digunakan untuk UID ini
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="mdi mdi-content-save me-1"></i>
                                        Update UID
                                    </button>
                                    <a href="{{ route('admin.uid.index') }}" class="btn btn-secondary">
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
    document.getElementById('nama_uid').focus();
    
    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const uidInput = document.getElementById('nama_uid');
        const clusterSelect = document.getElementById('id_cluster');
        
        if (!uidInput.value.trim()) {
            e.preventDefault();
            uidInput.classList.add('is-invalid');
            uidInput.focus();
            return false;
        }
        
        if (!clusterSelect.value) {
            e.preventDefault();
            clusterSelect.classList.add('is-invalid');
            clusterSelect.focus();
            return false;
        }
    });
});
</script>
@endsection 