@extends('admin.layout.app')
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

    <form action="{{ route('admin.profile.update') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Nama Sekolah</label>
            <input type="text" name="nama_sekolah" class="form-control" value="{{ $admin->nama_sekolah }}" required>
        </div>
        <div class="form-group">
            <label>Nama Kepala Sekolah</label>
            <input type="text" name="nama_kepala_sekolah" class="form-control" value="{{ $admin->nama_kepala_sekolah }}" required>
        </div>
        <div class="form-group">
            <label>NIP kepala Sekolah</label>
            <input type="number" name="nip_kepala_sekolah" class="form-control" value="{{ $admin->nip_kepala_sekolah }}" required>
        </div>
        <div class="form-group">
            <label>Nama User</label>
            <input type="text" name="nama" class="form-control" value="{{ $admin->nama }}" required>
        </div>

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="{{ $admin->username }}" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary mx-2">Simpan</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mx-2">Batal</a>
        </div>


    </form>
</div>
</div>
@endsection
