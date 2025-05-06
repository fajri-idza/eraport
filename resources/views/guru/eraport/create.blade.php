@extends('guru.layout.app')
@php
    $judul = 'Tambah E-Raport';
@endphp
@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
    <form action="{{ route('guru.eraport.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Siswa</label>
            <select name="nisn" class="form-control select2" required>
                <option value="" disabled selected>Pilih Siswa</option>
                @foreach($siswa as $s)
                    <option value="{{ $s->nisn }}">{{ $s->nisn .' - '. $s->nama_peserta_didik }}</option>
                @endforeach
            </select>
            @error('nisn')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Kelas</label>
            <select name="id_kelas" class="form-control select2" required>
                <option value="" disabled selected>Pilih Kelas</option>
                @foreach($kelas as $s)
                    <option value="{{ $s->id }}">{{ $s->nama_kelas }}</option>
                @endforeach
            </select>
            @error('id_kelas')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Sakit</label>
            <input type="number" name="sakit" class="form-control" required>
            @error('sakit')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Izin</label>
            <input type="number" name="izin" class="form-control" required>
            @error('izin')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Tanpa Keterangan</label>
            <input type="number" name="tanpa_keterangan" class="form-control" required>
            @error('tanpa_keterangan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Catatan</label>
            <textarea name="catatan" class="form-control" rows="3" required></textarea>
            @error('catatan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Naik Kelas</label>
            <input type="text" name="naik_kelas" class="form-control" required>
            @error('naik_kelas')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Tinggal Kelas</label>
            <input type="text" name="tinggal_kelas" class="form-control" required>
            @error('tinggal_kelas')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Tahun</label>
            <input type="number" name="tahun" class="form-control" value="{{ date('Y') }}" required>
            @error('tahun')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Semester</label>
            <select name="semester" class="form-control" required>
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
            @error('semester')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <h5 class="mt-4">Prestasi</h5>
        <div id="prestasi-area"></div>
        <button type="button" onclick="addPrestasi()" class="btn btn-sm btn-success mb-3">Tambah Prestasi</button>

        <h5 class="mt-4">Ekstrakurikuler</h5>
        <div id="ekstra-area"></div>
        <button type="button" onclick="addEkstra()" class="btn btn-sm btn-success mb-3">Tambah Ekstrakurikuler</button>

        <div class="mt-4 text-center">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('guru.eraport.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
</div>

<script>
function addPrestasi() {
    let html = `
        <div class="row mb-2 align-items-center">
            <div class="col-md-5">
                <input type="text" name="nama_prestasi[]" class="form-control" placeholder="Nama Prestasi" required>
            </div>
            <div class="col-md-5">
                <input type="text" name="nilai_prestasi[]" class="form-control" placeholder="Nilai Prestasi" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove()">Hapus</button>
            </div>
        </div>
    `;
    document.getElementById('prestasi-area').insertAdjacentHTML('beforeend', html);
}

function addEkstra() {
    let html = `
        <div class="row mb-2 align-items-center">
            <div class="col-md-5">
                <input type="text" name="nama_ekstrakurikuler[]" class="form-control" placeholder="Nama Ekstrakurikuler" required>
            </div>
            <div class="col-md-5">
                <input type="text" name="nilai_ekstrakurikuler[]" class="form-control" placeholder="Nilai Ekstrakurikuler" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove()">Hapus</button>
            </div>
        </div>
    `;
    document.getElementById('ekstra-area').insertAdjacentHTML('beforeend', html);
}
</script>
@endsection
