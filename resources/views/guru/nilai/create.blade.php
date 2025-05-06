@extends('guru.layout.app')
@php
    $judul = 'Input Nilai';
@endphp

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">

    <form action="{{ route('guru.nilai.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Siswa</label>
            <select name="nisn" class="form-control select2" required>
                <option value="" disabled selected>Pilih Siswa</option>
                @foreach($siswa as $s)
                    <option value="{{ $s->nisn }}">{{ $s->nisn .' - '. $s->nama_peserta_didik }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Kelas</label>
            <select name="id_kelas" class="form-control select2" required>
                <option value="" disabled selected>Pilih Kelas</option>
                @foreach($kelas as $s)
                    <option value="{{ $s->id }}">{{$s->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Muatan Pelajaran</label>
            <select name="id_muatan_pelajaran" class="form-control select2" required>
                <option value="">Pilih Muatan Pelajaran</option>
                @foreach($muatan as $m)
                    <option value="{{ $m->id }}">{{ $m->nama_muatan_pelajaran }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Tahun</label>
            <input type="text" name="tahun" class="form-control" value="{{ date('Y') }}" required>
        </div>

        <div class="form-group">
            <label>Semester</label>
            <select name="semester" class="form-control" required>
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
        </div>

        <h4>Materi dan Nilai</h4>
        <div id="nilai-container"></div>
        <button type="button" class="btn btn-sm btn-success mb-3" onclick="addNilai()">Tambah Materi + Nilai</button>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary mx-2">Simpan</button>
            <a href="{{ route('guru.nilai.index') }}" class="btn btn-secondary mx-2">Batal</a>
        </div>


    </form>
</div>
</div>

<script>
function addNilai() {
    var container = document.getElementById('nilai-container');
    var html = `
        <div class="row mb-2">
            <div class="col-md-6">
                <input type="text" name="materi[]" class="form-control" placeholder="Nama Materi" required>
            </div>
            <div class="col-md-4">
                <input type="number" name="nilai[]" class="form-control" placeholder="Nilai" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove()">X</button>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
}
</script>

@endsection
