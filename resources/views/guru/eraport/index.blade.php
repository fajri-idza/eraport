@extends('guru.layout.app')

@php
    $judul = 'Data E-Raport';
@endphp

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
    <a href="{{ route('guru.eraport.create') }}" class="btn btn-primary mb-3">Tambah E-Raport</a>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Nama Siswa</th>
                    <th rowspan="2">NISN</th>
                    <th rowspan="2">Kelas</th>
                    <th rowspan="2">Ekstrakurikuler</th> <!-- Kolom Ekstrakurikuler -->
                    <th colspan="3" class="text-center">Kehadiran</th>
                    <th rowspan="2">Catatan</th>
                    <th rowspan="2">Prestasi</th>
                    <th rowspan="2">Aksi</th>
                </tr>
                <tr>
                    <th>Sakit</th>
                    <th>Izin</th>
                    <th>Tanpa Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($eraports as $index => $eraport)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $eraport->siswa->nama_peserta_didik ?? '-' }}</td>
                    <td>{{ $eraport->nisn }}</td>
                    <td>{{ $eraport->kelas->nama_kelas ?? '-' }}</td>
                    <td>
                        <!-- Menampilkan ekstrakurikuler terkait, jika ada -->
                        @foreach($eraport->ekstrakurikuler as $ekstra)
                            <div>{{ $ekstra->nama_ekstrakurikuler }} ({{ $ekstra->nilai }})</div>
                        @endforeach
                    </td>
                    <td>{{ $eraport->sakit }}</td>
                    <td>{{ $eraport->izin }}</td>
                    <td>{{ $eraport->tanpa_keterangan }}</td>
                    <td>{{ $eraport->catatan }}</td>
                    <td>
                        <!-- Menampilkan ekstrakurikuler terkait, jika ada -->
                        @foreach($eraport->prestasi as $p)
                            <div>{{ $p->nama_prestasi }} ({{ $p->nilai }})</div>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('guru.eraport.show', $eraport->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('guru.eraport.edit', $eraport->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('guru.eraport.destroy', $eraport->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="13" class="text-center">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        {{ $eraports->links() }}
    </div>
</div>
</div>
@endsection
