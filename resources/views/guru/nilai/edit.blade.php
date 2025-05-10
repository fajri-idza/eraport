@extends('guru.layout.app')
@php
    $judul = 'Edit Nilai';
@endphp

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">

    <form action="{{ route('guru.nilai.update', $nilai->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Siswa</label>
            <select name="nisn" class="form-control select2" required>
                @foreach($siswa as $s)
                    <option value="{{ $s->nisn }}" {{ $nilai->nisn == $s->nisn ? 'selected' : '' }}>
                        {{ $s->nama_peserta_didik }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Kelas</label>
            <select name="id_kelas" class="form-control select2" required>
                @foreach($kelas as $s)
                    <option value="{{ $s->id }}" {{ $nilai->id_kelas == $s->id ? 'selected' : '' }}>
                        {{ $s->nama_kelas }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Muatan Pelajaran</label>
            <select name="id_muatan_pelajaran" class="form-control select2" required>
                @foreach($muatan as $m)
                    <option value="{{ $m->id }}" {{ $nilai->id_muatan_pelajaran == $m->id ? 'selected' : '' }}>
                        {{ $m->nama_muatan_pelajaran }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Tahun</label>
            <input type="text" name="tahun" class="form-control" value="{{ $nilai->tahun }}" required>
        </div>

        <div class="form-group">
            <label>Semester</label>
            <select name="semester" class="form-control" required>
                <option value="1" {{ $nilai->semester == 1 ? 'selected' : '' }}>1</option>
                <option value="2" {{ $nilai->semester == 2 ? 'selected' : '' }}>2</option>
            </select>
        </div>

        <h4>Materi dan Nilai</h4>
        <div id="nilai-container">
            @foreach($nilai->details as $detail)
                <div class="row mb-2">
                    <div class="col-md-4">
                        <input type="text" name="materi[]" class="form-control" value="{{ $detail->materi }}" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="nilai[]" class="form-control" value="{{ $detail->nilai }}" required>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="capaian_kompetensi[]" class="form-control" value="{{ $detail->capaian_kompetensi }}">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove()">X</button>
                    </div>
                </div>
            @endforeach
        </div>

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
            <div class="col-md-4">
                <input type="text" name="materi[]" class="form-control" placeholder="Nama Materi" required>
            </div>
            <div class="col-md-2">
                <input type="number" name="nilai[]" class="form-control" placeholder="Nilai" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="capaian_kompetensi[]" class="form-control" placeholder="Capaian Kompetensi">
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
