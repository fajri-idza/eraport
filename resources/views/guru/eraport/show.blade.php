@extends('guru.layout.app')

@php
    $judul = 'Detail Eraport';
@endphp

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">

    <!-- Informasi Siswa -->
    <div class="form-group">
        <label>Siswa</label>
        <input type="text" class="form-control" value="{{ $eraport->siswa->nisn }} - {{ $eraport->siswa->nama_peserta_didik }}" disabled>
    </div>

    <!-- Informasi Kelas -->
    <div class="form-group">
        <label>Kelas</label>
        <input type="text" class="form-control" value="{{ $eraport->kelas->nama_kelas }}" disabled>
    </div>

    <!-- Tahun Ajaran -->
    <div class="form-group">
        <label>Tahun</label>
        <input type="text" class="form-control" value="{{ $eraport->tahun }}" disabled>
    </div>

    <!-- Semester -->
    <div class="form-group">
        <label>Semester</label>
        <input type="text" class="form-control" value="{{ $eraport->semester }}" disabled>
    </div>

    <!-- Data Kehadiran -->
    <div class="form-group">
        <label>Sakit</label>
        <input type="text" class="form-control" value="{{ $eraport->sakit }}" disabled>
    </div>

    <div class="form-group">
        <label>Izin</label>
        <input type="text" class="form-control" value="{{ $eraport->izin }}" disabled>
    </div>

    <div class="form-group">
        <label>Tanpa Keterangan</label>
        <input type="text" class="form-control" value="{{ $eraport->tanpa_keterangan }}" disabled>
    </div>

    <!-- Catatan -->
    <div class="form-group">
        <label>Catatan</label>
        <textarea class="form-control" disabled>{{ $eraport->catatan }}</textarea>
    </div>

    <!-- Status Naik Kelas -->
    <div class="form-group">
        <label>Naik Kelas</label>
        <input type="text" class="form-control" value="{{ $eraport->naik_kelas }}" disabled>
    </div>

    <!-- Status Tinggal Kelas -->
    <div class="form-group">
        <label>Tinggal Kelas</label>
        <input type="text" class="form-control" value="{{ $eraport->tinggal_kelas }}" disabled>
    </div>

    <!-- Prestasi -->
    <h4>Prestasi</h4>
    @foreach($eraport->prestasi as $prestasi)
        <div class="row mb-2">
            <div class="col-md-6">
                <input type="text" class="form-control" value="{{ $prestasi->nama_prestasi }}" disabled>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" value="{{ $prestasi->nilai }}" disabled>
            </div>
        </div>
    @endforeach

    <!-- Ekstrakurikuler -->
    <h4>Ekstrakurikuler</h4>
    @foreach($eraport->ekstrakurikuler as $ekstra)
        <div class="row mb-2">
            <div class="col-md-6">
                <input type="text" class="form-control" value="{{ $ekstra->nama_ekstrakurikuler }}" disabled>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" value="{{ $ekstra->nilai }}" disabled>
            </div>
        </div>
    @endforeach

    <!-- Tombol Kembali -->
    <div class="d-flex justify-content-center">
        <a href="{{ route('guru.eraport.index') }}" class="btn btn-secondary mx-2">Kembali</a>
    </div>
</div>
</div>
@endsection
