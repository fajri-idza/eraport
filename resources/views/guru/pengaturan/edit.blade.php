@extends('guru.layout.app')
@php
    $judul = 'Edit Profile';
@endphp
@section('content')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
    @if(session('success'))
    <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('guru.profile.update') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Nama User</label>
            <input type="text" name="nama" class="form-control" value="{{ $guru->nama }}" required>
        </div>

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="user_name" class="form-control" value="{{ $guru->user_name }}" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary mx-2">Simpan</button>
            <a href="{{ route('guru.dashboard') }}" class="btn btn-secondary mx-2">Batal</a>
        </div>


    </form>
</div>
</div>

@endsection
