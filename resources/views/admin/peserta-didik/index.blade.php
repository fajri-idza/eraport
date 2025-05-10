@extends('admin.layout.app')
@php
    $judul = 'Data Siswa';
@endphp
@section('content')
<div class="container-fluid">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">Tambah Siswa</button>
    <a href="{{ route('admin.peserta-didik.import.view') }}" class="btn btn-success mb-3">Import Excel</a>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if ($data->count())
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NISN</th>
                            <th>Nama Peserta Didik</th>
                            <th>NIS</th>
                            <th>Kelas</th>
                            <th>Tempat Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Pendidikan Sebelumnya</th>
                            <th>Alamat Peserta Didik</th>
                            <th>Nama Orang Tua</th>
                            <th>Alamat Orang Tua</th>
                            <th>Wali Peserta Didik</th>
                            <th>Alamat Wali Peserta Didik</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $g)
                        <tr>
                            <td>{{ $g->nisn }}</td>
                            <td>{{ $g->nama_peserta_didik }}</td>
                            <td>{{ $g->nis }}</td>
                            <td>{{ $g->kelas->nama_kelas }}</td>
                            <td>{{ $g->tempat_lahir }},{{ \Carbon\Carbon::parse($g->tanggal_lahir)->translatedFormat('j F Y') }}</td>
                            <td>{{ $g->jenis_kelamin }}</td>
                            <td>{{ $g->agama }}</td>
                            <td>{{ $g->pendidikan_sebelumnya }}</td>
                            <td>{{ $g->alamat_peserta_didik }}</td>
                            <td>{{ $g->nama_orang_tua }}</td>
                            <td>{{ $g->alamat_orang_tua }}</td>
                            <td>{{ $g->wali_peserta_didik }}</td>
                            <td>{{ $g->alamat_wali_peserta_didik }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal{{ $g->nisn }}">Edit</button>
                                <form action="{{ route('admin.peserta-didik.destroy', $g->nisn) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{ $g->nisn }}" tabindex="-1" aria-labelledby="editModalLabel{{ $g->nisn }}" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Edit Siswa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <form action="{{ route('admin.peserta-didik.update', $g->nisn) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    @include('admin.peserta-didik._form', ['g' => $g])
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                  <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                        @endforeach
                    </tbody>
                </table>
                @if ($data->count() > 0)
                    <!-- Menampilkan pagination hanya jika ada data -->
                    {{ $data->links() }}
                @endif
            </div>
            @else
            <div class="text-center">
                <p>Data tidak tersedia.</p>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.peserta-didik.store') }}" method="POST">
        @csrf
        <div class="modal-body">
            @include('admin.peserta-didik._form', ['g' => null])
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
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
@if ($errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById('addModal'));
            myModal.show();
        });
    </script>
@endif
@endpush
