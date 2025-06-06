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
    <label>NISN</label>
    <input type="number" name="nisn" class="form-control" value="{{ old('nisn', $g->nisn ?? '') }}" required>
</div>
<div class="form-group">
    <label>Nama Peserta Didik</label>
    <input type="text" name="nama_peserta_didik" class="form-control" value="{{ old('nama_peserta_didik', $g->nama_peserta_didik ?? '') }}" required>
</div>
<div class="form-group">
    <label>NIS</label>
    <input type="number" name="nis" class="form-control" value="{{ old('nis', $g->nis ?? '') }}" required>
</div>
<div class="form-group">
    <label>Kelas</label>
    <select name="id_kelas" class="form-control select2" required>
        <option value="" disabled selected>-- Pilih Kelas --</option>
        @foreach($kelas as $k)
        <option value="{{ $k->id }}" {{ $k->id == $g?->id_kelas ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
        @endforeach
    </select>
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
    <label>Agama</label>
    <input type="text" name="agama" class="form-control" value="{{ old('agama', $g->agama ?? '') }}" required>
</div>
<div class="form-group">
    <label>Pendidikan Sebelumnya</label>
    <input type="text" name="pendidikan_sebelumnya" class="form-control" value="{{ old('pendidikan_sebelumnya', $g->pendidikan_sebelumnya ?? '') }}" required>
</div>
<div class="form-group">
    <label>Alamat Peserta Didik</label>
    <textarea name="alamat_peserta_didik" class="form-control" required>{{ old('alamat_peserta_didik', $g->alamat_peserta_didik ?? '') }}</textarea>
</div>
<div class="form-group">
    <label>Nama Ayah</label>
    <input type="text" name="nama_ayah" class="form-control" value="{{ old('nama_ayah', $g->nama_ayah ?? '') }}" required>
</div>
<div class="form-group">
    <label>Alamat Ayah</label>
    <textarea name="alamat_ayah" class="form-control" required>{{ old('alamat_ayah', $g->alamat_ayah ?? '') }}</textarea>
</div>
<div class="form-group">
    <label>Nama Ibu</label>
    <input type="text" name="nama_ibu" class="form-control" value="{{ old('nama_ibu', $g->nama_ibu ?? '') }}" required>
</div>
<div class="form-group">
    <label>Alamat Ibu</label>
    <textarea name="alamat_ibu" class="form-control" required>{{ old('alamat_ibu', $g->alamat_ibu ?? '') }}</textarea>
</div>
<div class="form-group">
    <label>Wali Peserta Didik</label>
    <input type="text" name="wali_peserta_didik" class="form-control" value="{{ old('wali_peserta_didik', $g->wali_peserta_didik ?? '') }}">
</div>
<div class="form-group">
    <label>Alamat Wali Peserta Didik</label>
    <textarea name="alamat_wali_peserta_didik" class="form-control">{{ old('alamat_wali_peserta_didik', $g->alamat_wali_peserta_didik ?? '') }}</textarea>
</div>
