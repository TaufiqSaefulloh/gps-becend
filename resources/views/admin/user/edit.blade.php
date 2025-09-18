@extends('layout.master')

@section('content')
<h2>Edit User</h2>

@if($errors->any())
    <ul style="color:red">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama:</label><br>
    <input type="text" name="name" value="{{ old('name', $user->name) }}"><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="{{ old('email', $user->email) }}"><br>

    <label>Password (isi jika ingin diubah):</label><br>
    <input type="password" name="password"><br>

    <label>Konfirmasi Password:</label><br>
    <input type="password" name="password_confirmation"><br><br>

    <button type="submit">Update</button>
</form>
@endsection
