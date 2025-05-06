@extends('guru.layout.app')

@php
    $judul = 'Detail E-Raport';
@endphp

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
        <h1 class="text-center">E-Raport Siswa</h1>
        <div class="row mt-4">
            <div class="col-md-6">
                <p><strong>Nama Peserta Didik:</strong> {{ $eraport->siswa->nama_peserta_didik }}</p>
                <p><strong>NISN:</strong> {{ $eraport->nisn }}</p>
                <p><strong>Sekolah:</strong> {{ 'genjea' }}</p>
                <p><strong>Kelas:</strong> {{ $eraport->kelas->nama_kelas }}</p>
            </div>

            <div class="col-md-6">
                <p><strong>Fase:</strong> {{ $eraport->kelas->nama_kelas }}</p>
                <p><strong>Tahun Pelajaran:</strong> {{ $eraport->tahun }}</p>
                <p><strong>Semester:</strong> {{ $eraport->semester }}</p>
                <p><strong>Naik ke Kelas:</strong> {{ $eraport->naik_kelas }}</p>
                <p><strong>Tinggal di Kelas:</strong> {{ $eraport->tinggal_kelas }}</p>
            </div>
        </div>

        <h3 class="mt-4">Nilai</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Muatan Pelajaran</th>
                    <th>Materi & Nilai</th>
                </tr>
            </thead>
            <tbody>
                @forelse($nilai as $key => $n)
                    <tr>
                        <td>{{$key+1 }}</td>
                        <td>{{ $n->muatan->nama_muatan_pelajaran }}</td>
                        <td>
                            <ul>
                                @foreach($n->details as $d)
                                    <li>{{ $d->materi }}: {{ $d->nilai }}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data nilai</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <h3 class="mt-4">Kehadiran</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kehadiran</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>Sakit</td>
                        <td>{{ $eraport->sakit }}</td>
                    </tr>
                    <tr>
                        <td>Izin</td>
                        <td>{{ $eraport->izin }}</td>
                    </tr>
                    <tr>
                        <td>Tanpa Keterangan</td>
                        <td>{{ $eraport->tanpa_keterangan }}</td>
                    </tr>
            </tbody>
        </table>

        <h3 class="mt-4">Prestasi</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Prestasi</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($eraport->prestasi as $prestasi)
                    <tr>
                        <td>{{ $prestasi->nama_prestasi }}</td>
                        <td>{{ $prestasi->nilai }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3 class="mt-4">Ekstrakurikuler</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ekstrakurikuler</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($eraport->ekstrakurikuler as $ekstra)
                    <tr>
                        <td>{{ $ekstra->nama_ekstrakurikuler }}</td>
                        <td>{{ $ekstra->nilai }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="form-group">
            <label>Catatan</label>
            <textarea name="catatan" class="form-control" rows="3" readonly>{{ $eraport->catatan }}</textarea>
        </div>

        <a href="{{ route('guru.eraport.print', $eraport->id) }}" class="btn btn-success mt-4">Cetak E-Raport ke PDF</a>
    </div>
    </div>
@endsection
