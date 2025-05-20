@extends('guru.layout.app')
@php
    $judul = 'Data Nilai';
@endphp
@section('content')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">

    <a href="{{ route('guru.nilai.create') }}" class="btn btn-primary mb-3">Tambah Nilai</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Siswa</th>
                <th>Kelas</th>
                <th>Muatan Pelajaran</th>
                <th>Tahun</th>
                <th>Semester</th>
                <th>Materi & Nilai</th>
                <th>Capaian Kompetensi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($nilai as $key => $n)
                <tr>
                    <td>{{ $nilai->firstItem() + $key }}</td>
                    <td>{{ $n->siswa->nama_peserta_didik }}</td>
                    <td>{{ $n->kelas->nama_kelas }}</td>
                    <td>{{ $n->muatan?->nama_muatan_pelajaran ?? '-' }}</td>
                    <td>{{ $n->tahun }}</td>
                    <td>{{ $n->semester }}</td>
                    <td>
                        <ul>
                            @foreach($n->details as $d)
                                <li>{{ $d->materi }}: {{ $d->nilai }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul>
                            @foreach($n->details as $d)
                                <li>{{ $d->capaian_kompetensi ?? '-' }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        @if(auth()->guard('guru')->user()->id === $n->guru_id)
                        <a href="{{ route('guru.nilai.edit', $n->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('guru.nilai.destroy', $n->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin mau hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada data nilai</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $nilai->links() }}
    </div>
</div>
</div>
@endsection
