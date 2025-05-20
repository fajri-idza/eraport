@extends('admin.layout.app')
@php
    $judul = 'Data Guru';
@endphp
@section('content')
<div class="container-fluid">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">Tambah Guru</button>
    <a href="{{ route('admin.guru.import.view') }}" class="btn btn-success mb-3">Import Excel</a>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if($guru->count())
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Status Guru</th>
                            <th>NIP/NIK</th>
                            <th>Jabatan</th>
                            <th>Jenis Guru</th>
                            <th>Username</th>
                            <th>Tempat Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>HP</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($guru as $g)
                        <tr>
                            <td>{{ $g->nama }}</td>
                            <td>{{ $g->status_guru }}</td>
                            <td>{{ $g->nip }}</td>
                            <td>{{ $g->jabatan }}</td>
                            <td>{{ $g->type }}</td>
                            <td>{{ $g->user_name }}</td>
                            <td>{{ $g->tempat_lahir }}, {{ $g->tanggal_lahir->format('d F Y') }}</td>
                            <td>{{ $g->jenis_kelamin }}</td>
                            <td>{{ $g->hp }}</td>
                            <td>{{ $g->email }}</td>
                            <td>{{ $g->alamat }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal{{ $g->id }}">Edit</button>
                                <form action="{{ route('admin.guru.destroy', $g->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{ $g->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $g->id }}" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Edit Guru</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <form action="{{ route('admin.guru.update', $g->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    @include('admin.guru._form', ['g' => $g])
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
                @if ($guru->count() > 0)
                    <!-- Menampilkan pagination hanya jika ada data -->
                    {{ $guru->links() }}
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
        <h5 class="modal-title">Tambah Guru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.guru.store') }}" method="POST">
        @csrf
        <div class="modal-body">
            @include('admin.guru._form', ['g' => null])
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

@if ($errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById('addModal'));
            myModal.show();
        });
    </script>
@endif
