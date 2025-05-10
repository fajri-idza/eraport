@extends('admin.layout.app')
@php
    $judul = 'Data Mapel';
@endphp
@section('content')
<div class="container-fluid">

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#createModal">
        Tambah Muatan Pelajaran
    </button>

    <!-- DataTables -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                @if($muatan->count())
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Guru</th>
                            <th>Kelas</th>
                            <th>KKM</th>
                            <th>Mulok/Pilihan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($muatan as $m)
                        <tr>
                            <td>{{ $m->nama_muatan_pelajaran }}</td>
                            <td>{{ $m->guru?->nama ?? '-' }}</td>
                            <td>{{ $m->kelas->nama_kelas }}</td>
                            <td>{{ $m->kkm }}</td>
                            <td>{{ $m->is_mulok ? 'Ya' : 'Tidak' }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal{{ $m->id }}">Edit</button>
                                <form action="{{ route('admin.muatan-pelajaran.destroy', $m->id) }}" method="POST" style="display:inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $m->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $m->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form action="{{ route('admin.muatan-pelajaran.update', $m->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Muatan Pelajaran</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Nama Muatan Pelajaran</label>
                                                <input type="text" name="nama_muatan_pelajaran" class="form-control" value="{{ $m->nama_muatan_pelajaran }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Guru</label>
                                                <select name="id_guru" class="form-control select2" required>
                                                    <option value="" disabled>-- Pilih Guru --</option>
                                                    @foreach($guru as $g)
                                                    <option value="{{ $g->id }}" {{ $g->id == $m->id_guru ? 'selected' : '' }}>{{ $g->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Kelas</label>
                                                <select name="id_kelas" class="form-control select2" required>
                                                    <option value="" disabled>-- Pilih Kelas --</option>
                                                    @foreach($kelas as $k)
                                                    <option value="{{ $k->id }}" {{ $k->id == $m->id_kelas ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>KKM</label>
                                                <input type="number" name="kkm" class="form-control" step="any" value="{{ $m->kkm }}" required>
                                            </div>
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" id="is_mulok" name="is_mulok" value="{{ $m->is_mulok }}">
                                                <label class="form-check-label" for="is_mulok">Muatan Pelajaran Mulok/Pilihan</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>

                {{ $muatan->links() }}
                @else
                    <div class="text-center">
                        <span class="text-muted">Belum ada data.</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.muatan-pelajaran.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Muatan Pelajaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Muatan Pelajaran</label>
                        <input type="text" name="nama_muatan_pelajaran" class="form-control" required>
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
                        <label>Kelas</label>
                        <select name="id_kelas" class="form-control select2" required>
                            <option value="" disabled selected>-- Pilih Kelas --</option>
                            @foreach($kelas as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>KKM</label>
                        <input type="number" name="kkm" step="any" class="form-control" required>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="is_mulok" name="is_mulok" value="1">
                        <label class="form-check-label" for="is_mulok">Muatan Pelajaran Mulok/Pilihan</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
            placeholder: "-- Pilih --",
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endpush
