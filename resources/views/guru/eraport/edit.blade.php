@extends('guru.layout.app')
@php
    $judul = 'Edit E-Raport';
@endphp
@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
    <form action="{{ route('guru.eraport.update', $eraport->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Siswa</label>
            <select name="nisn" class="form-control select2" required>
                <option value="" disabled>Pilih Siswa</option>
                @foreach($siswa as $s)
                    <option value="{{ $s->nisn }}" {{ $eraport->nisn == $s->nisn ? 'selected' : '' }}>
                        {{ $s->nisn .' - '. $s->nama_peserta_didik }}
                    </option>
                @endforeach
            </select>
            @error('nisn')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Kelas</label>
            <select name="id_kelas" class="form-control select2" required>
                <option value="" disabled>Pilih Kelas</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}" {{ $eraport->id_kelas == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kelas }}
                    </option>
                @endforeach
            </select>
            @error('id_kelas')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Sakit</label>
            <input type="number" name="sakit" class="form-control" value="{{ old('sakit', $eraport->sakit) }}" required>
            @error('sakit')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Izin</label>
            <input type="number" name="izin" class="form-control" value="{{ old('izin', $eraport->izin) }}" required>
            @error('izin')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Tanpa Keterangan</label>
            <input type="number" name="tanpa_keterangan" class="form-control" value="{{ old('tanpa_keterangan', $eraport->tanpa_keterangan) }}" required>
            @error('tanpa_keterangan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Catatan</label>
            <textarea name="catatan" class="form-control" rows="3" required>{{ old('catatan', $eraport->catatan) }}</textarea>
            @error('catatan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Naik Kelas</label>
            <input type="text" name="naik_kelas" class="form-control" value="{{ old('naik_kelas', $eraport->naik_kelas) }}" required>
            @error('naik_kelas')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Tinggal Kelas</label>
            <input type="text" name="tinggal_kelas" class="form-control" value="{{ old('tinggal_kelas', $eraport->tinggal_kelas) }}" required>
            @error('tinggal_kelas')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Tahun</label>
            <input type="number" name="tahun" class="form-control" value="{{ old('tahun', $eraport->tahun) }}" required>
            @error('tahun')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Semester</label>
            <select name="semester" class="form-control" required>
                <option value="1" {{ $eraport->semester == 1 ? 'selected' : '' }}>1</option>
                <option value="2" {{ $eraport->semester == 2 ? 'selected' : '' }}>2</option>
            </select>
            @error('semester')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <h5 class="mt-4">Prestasi</h5>
        <div id="prestasi-area">
            @foreach($eraport->prestasi as $prestasi)
                <div class="row mb-2 align-items-center">
                    <div class="col-md-5">
                        <input type="text" name="nama_prestasi[]" class="form-control" value="{{ $prestasi->nama_prestasi }}" placeholder="Nama Prestasi" required>
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="nilai_prestasi[]" class="form-control" value="{{ $prestasi->nilai}}" placeholder="Nilai Prestasi" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove()">Hapus</button>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="button" onclick="addPrestasi()" class="btn btn-sm btn-success mb-3">Tambah Prestasi</button>

        <h5 class="mt-4">Ekstrakurikuler</h5>
        <div id="ekstra-area">
            @foreach($eraport->ekstrakurikuler as $ekstra)
                <div class="row mb-2 align-items-center">
                    <div class="col-md-5">
                        <input type="text" name="nama_ekstrakurikuler[]" class="form-control" value="{{ $ekstra->nama_ekstrakurikuler }}" placeholder="Nama Ekstrakurikuler" required>
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="nilai_ekstrakurikuler[]" class="form-control" value="{{ $ekstra->nilai }}" placeholder="Nilai Ekstrakurikuler" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove()">Hapus</button>
                    </div>
                </div>
            @endforeach
        </div>
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
