@extends('layout.master')

@section('page-content')
<div class="container-fluid">
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Tambah Provinsi</h4>
            <p class="text-muted fs-14 mb-0">Tambah provinsi baru</p>
        </div>
        <div class="flex-shrink-0">
            <a href="{{ route('provinsi.index') }}" class="btn btn-secondary">
                <i class="mdi mdi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-map-marker text-primary me-2"></i>
                        Form Tambah Provinsi
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

                    <form action="{{ route('provinsi.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama_provinsi" class="form-label">
                                        <i class="mdi mdi-map-marker text-primary me-1"></i>
                                        Nama Provinsi <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('nama_provinsi') is-invalid @enderror" 
                                           id="nama_provinsi" 
                                           name="nama_provinsi" 
                                           value="{{ old('nama_provinsi') }}"
                                           placeholder="Contoh: Kalimantan Barat, Sulawesi Selatan, dll"
                                           required>
                                    @error('nama_provinsi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Masukkan nama provinsi yang akan digunakan
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="id_uid" class="form-label">
                                        <i class="mdi mdi-account text-primary me-1"></i>
                                        UID <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select @error('id_uid') is-invalid @enderror" 
                                            id="id_uid" 
                                            name="id_uid" 
                                            required>
                                        <option value="">Pilih UID</option>
                                        @foreach($uids as $uid)
                                            <option value="{{ $uid->id }}" {{ old('id_uid') == $uid->id ? 'selected' : '' }}>
                                                {{ $uid->nama_uid }} ({{ $uid->cluster->nama_cluster }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_uid')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Pilih UID yang akan digunakan untuk provinsi ini
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="mdi mdi-content-save me-1"></i>
                                        Simpan Provinsi
                                    </button>
                                    <a href="{{ route('provinsi.index') }}" class="btn btn-secondary">
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
    document.getElementById('nama_provinsi').focus();
    
    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const provinsiInput = document.getElementById('nama_provinsi');
        const uidSelect = document.getElementById('id_uid');
        
        if (!provinsiInput.value.trim()) {
            e.preventDefault();
            provinsiInput.classList.add('is-invalid');
            provinsiInput.focus();
            return false;
        }
        
        if (!uidSelect.value) {
            e.preventDefault();
            uidSelect.classList.add('is-invalid');
            uidSelect.focus();
            return false;
        }
    });
});
</script>
@endsection 