@extends('layout.master')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height:100vh; background:#f4f6f9;">
    <div class="card shadow-lg" style="width: 400px; border-radius:15px;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4">🔑 Admin Login</h3>

            {{-- Error Message --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="email">📧 Email</label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           class="form-control" 
                           placeholder="Masukkan email" 
                           value="{{ old('email') }}" 
                           required>
                </div>

                <div class="form-group mb-3">
                    <label for="password">🔒 Password</label>
                    <input type="password" 
                           name="password" 
                           id="password" 
                           class="form-control" 
                           placeholder="Masukkan password" 
                           required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</div>
@endsection
