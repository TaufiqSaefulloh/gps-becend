@extends('layout.master')

@section('page-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-semibold">Edit ULP</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.ulp.update', $ulp->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama_ulp" class="form-label">Nama ULP</label>
                            <input type="text" class="form-control" id="nama_ulp" name="nama_ulp" value="{{ $ulp->nama_ulp }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="id_provinsi" class="form-label">Provinsi</label>
                            <select class="form-select" id="id_provinsi" name="id_provinsi" required>
                                <option value="{{ $ulp->id_provinsi }}">-- Pilih Provinsi --</option>
                                @foreach($provinsi as $p)
                                <option value="{{ $p->id }}" {{ $p->id == $ulp->id_provinsi ? 'selected' : '' }}>{{ $p->nama_provinsi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('admin.ulp.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection