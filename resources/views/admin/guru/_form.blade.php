@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Terjadi kesalahan!</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="form-group">
    <label>Nama</label>
    <input type="text" name="nama" class="form-control" value="{{ old('nama', $g->nama ?? '') }}" required>
</div>
<div class="form-group">
    <label>Jabatan</label>
    <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $g->jabatan ?? '') }}" required>
</div>
<div class="form-group">
    <label>Status Guru</label>
    <select name="status_guru" class="form-control" required>
        <option value="">-- Pilih --</option>
        <option value="HONORER" {{ (old('type', $g->status_guru ?? '') == 'HONORER') ? 'selected' : '' }}>Honorer</option>
        <option value="PNS" {{ (old('type', $g->status_guru ?? '') == 'PNS') ? 'selected' : '' }}>PNS</option>
    </select>
</div>
<div class="form-group">
    <label>NIP/NIK</label>
    <input type="number" name="nip" class="form-control" value="{{ old('nip', $g->nip ?? '') }}" required>
</div>
<div class="form-group">
    <label>Jenis Guru</label>
    <select name="type" class="form-control" required>
        <option value="">-- Pilih --</option>
        <option value="MAPEL" {{ (old('type', $g->type ?? '') == 'MAPEL') ? 'selected' : '' }}>Guru Mata Pelajaran</option>
        <option value="KELAS" {{ (old('type', $g->type ?? '') == 'KELAS') ? 'selected' : '' }}>Guru Kelas</option>
    </select>
</div>
<div class="form-group">
    <label>Username</label>
    <input type="text" name="user_name" class="form-control" value="{{ old('user_name', $g->user_name ?? '') }}" required>
</div>
<div class="form-group">
    <label>Password</label>
    <input type="password" name="password" class="form-control" @if(!$g) required @endif>
    @if($g)
    <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
    @endif
</div>
<div class="form-group">
    <label>Tempat Lahir</label>
    <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $g->tempat_lahir ?? '') }}" required>
</div>
<div class="form-group">
    <label>Tanggal Lahir</label>
    <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $g ? $g->tanggal_lahir->toDateString() : '') }}" required>
</div>
<div class="form-group">
    <label>Jenis Kelamin</label>
    <select name="jenis_kelamin" class="form-control" required>
        <option value="">-- Pilih --</option>
        <option value="Laki-laki" {{ (old('jenis_kelamin', $g->jenis_kelamin ?? '') == 'Laki-laki') ? 'selected' : '' }}>Laki-laki</option>
        <option value="Perempuan" {{ (old('jenis_kelamin', $g->jenis_kelamin ?? '') == 'Perempuan') ? 'selected' : '' }}>Perempuan</option>
    </select>
</div>
<div class="form-group">
    <label>HP</label>
    <input type="text" name="hp" class="form-control" value="{{ old('hp', $g->hp ?? '') }}" required>
</div>
<div class="form-group">
    <label>Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $g->email ?? '') }}" required>
</div>
<div class="form-group">
    <label>Alamat</label>
    <textarea name="alamat" class="form-control" required>{{ old('alamat', $g->alamat ?? '') }}</textarea>
</div>
