@extends('layout.master')

@section('page-content')
<div class="container mt-4">
    <h2 class="mb-4">➕ Tambah User</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="id_ulp" class="form-label">ULP</label>
                    <select name="id_ulp" id="id_ulp" class="form-select" required>
                        <option value="">-- Pilih ULP --</option>
                        @foreach ($ulp as $u)
                        <option value="{{ $u->id }}" {{ old('id_ulp') == $u->id ? 'selected' : '' }}>
                            {{ $u->nama_ulp }}
                        </option>
                        @endforeach
                    </select>
                </div>


                <div class="mb-3">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="text" name="nip" id="nip" class="form-control"
                        value="{{ old('nip') }}">
                </div>



                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.getElementById('role');
        const nipInput = document.getElementById('nip');

        function toggleNip() {
            if (roleSelect.value === 'user') {
                nipInput.removeAttribute('disabled');
                nipInput.setAttribute('required', 'required');
            } else {
                nipInput.setAttribute('disabled', 'disabled');
                nipInput.removeAttribute('required');
                nipInput.value = ''; // kosongkan biar aman
            }
        }

        roleSelect.addEventListener('change', toggleNip);
        toggleNip(); // jalan saat page load
    });
</script>