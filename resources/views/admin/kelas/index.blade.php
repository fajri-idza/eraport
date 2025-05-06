@extends('admin.layout.app')
@php
    $judul = 'Data Kelas';
@endphp
@section('content')
@section('content')
<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalTambah">Tambah Kelas</button>

    <div class="card shadow">
        <div class="card-body">
            @if($kelas->count())
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id Kelas</th>
                            <th>Nama Kelas</th>
                            <th>Guru</th>
                            <th>Fase</th>
                            <th>Semester</th>
                            <th>Tahun Pelajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kelas as $k)
                        <tr>
                            <td>{{ $k->id }}</td>
                            <td>{{ $k->nama_kelas }}</td>
                            <td>{{ $k->guru->nama ?? '-' }}</td>
                            <td>{{ $k->fase }}</td>
                            <td>{{ $k->semester }}</td>
                            <td>{{ $k->tahun_pelajaran }}</td>
                            <td>
                                <button
                                    class="btn btn-sm btn-warning"
                                    data-toggle="modal"
                                    data-target="#modalEdit{{ $k->id }}"
                                >Edit</button>

                                <form action="{{ route('admin.kelas.destroy', $k->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="modalEdit{{ $k->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <form action="{{ route('admin.kelas.update', $k->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Kelas</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Nama Kelas</label>
                                                <input type="text" name="nama_kelas" class="form-control" value="{{ $k->nama_kelas }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Guru</label>
                                                <select name="id_guru" class="form-control select2" required>
                                                    <option value="" disabled selected>-- Pilih Guru --</option>
                                                    @foreach($guru as $g)
                                                        <option value="{{ $g->id }}" {{ $g->id == $k->id_guru ? 'selected' : '' }}>{{ $g->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Fase</label>
                                                <input type="text" name="fase" class="form-control" value="{{ $k->fase }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Semester</label>
                                                <input type="number" name="semester" class="form-control" value="{{ $k->semester }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Tahun Pelajaran</label>
                                                <input type="number" name="tahun_pelajaran" class="form-control" value="{{ $k->tahun_pelajaran }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
                {{ $kelas->links() }}
            </div>
            @else
                <div class="text-center">
                    <p>Data tidak tersedia.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.kelas.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Kelas</label>
                        <input type="text" name="nama_kelas" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Guru</label>
                        <select name="id_guru" class="form-control select2" required>
                            <option value="" disabled selected>-- Pilih Guru --</option>
                            @foreach($guru as $g)
                                <option value="{{ $g->id }}">{{ $g->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Fase</label>
                        <input type="text" name="fase" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Semester</label>
                        <input type="number" name="semester" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Tahun Pelajaran</label>
                        <input type="number" name="tahun_pelajaran" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('.select2').select2({
        dropdownParent: $(document.body),
        width: '100%'
    });

    // Select2 dalam Modal
    $('#modalTambah').on('shown.bs.modal', function () {
        $(this).find('.select2').select2({
            dropdownParent: $('#modalTambah'),
            width: '100%'
        });
    });

    @foreach($kelas as $k)
    $('#modalEdit{{ $k->id }}').on('shown.bs.modal', function () {
        $(this).find('.select2').select2({
            dropdownParent: $('#modalEdit{{ $k->id }}'),
            width: '100%'
        });
    });
    @endforeach
});
</script>
@endpush
