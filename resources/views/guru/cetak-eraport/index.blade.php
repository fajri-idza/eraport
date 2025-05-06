@extends('guru.layout.app')

@php
    $judul = 'Cetak E-Raport';
@endphp

@section('content')

<div class="card shadow mb-4">
    <div class="card-body">
        <!-- Tabel Data E-Raport -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Tahun Ajaran</th>
                    <th>Semester</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($eraports as $index => $eraport)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $eraport->nisn }}</td>
                        <td>{{ $eraport->siswa->nama_peserta_didik }}</td>
                        <td>{{ $eraport->kelas->nama_kelas }}</td>
                        <td>{{ $eraport->tahun }}</td>
                        <td>{{ $eraport->semester}}</td>
                        <td>
                            <a href="{{ route('guru.eraport.detail', $eraport->id) }}" class="btn btn-info">Lihat</a>
                            <a href="{{ route('guru.eraport.print', $eraport->id) }}" class="btn btn-success">Cetak PDF</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
