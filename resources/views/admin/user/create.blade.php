@extends('layout.master')

@section('content')
<h2>Tambah User Baru</h2>

@if($errors->any())
    <ul style="color:red">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <label>Nama:</label><br>
    <input type="text" name="name" value="{{ old('name') }}"><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="{{ old('email') }}"><br>

    <label>Password:</label><br>
    <input type="password" name="password"><br>

    <label>Konfirmasi Password:</label><br>
    <input type="password" name="password_confirmation"><br><br>

    <button type="submit">Simpan</button>
</form>
@endsection
