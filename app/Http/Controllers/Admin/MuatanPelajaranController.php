<?php

namespace App\Http\Controllers\Admin;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\MuatanPelajaran;
use App\Http\Controllers\Controller;

class MuatanPelajaranController extends Controller
{
    public function index()
    {
        $muatan = MuatanPelajaran::with('guru', 'kelas')->paginate(10);
        $guru = Guru::all();
        $kelas = Kelas::all();
        return view('admin.muatan-pelajaran.index', compact('muatan', 'guru', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_muatan_pelajaran' => 'required|string|max:30',
            'id_guru' => 'required|exists:guru,id',
            'id_kelas' => 'required|exists:kelas,id',
            'kkm' => 'required',
        ]);

        $data = $request->all();
        $data['is_mulok'] = $request->has('is_mulok');
        MuatanPelajaran::create($data);

        return redirect()->route('admin.muatan-pelajaran.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, MuatanPelajaran $muatan_pelajaran)
    {
        $request->validate([
            'nama_muatan_pelajaran' => 'required|string|max:30',
            'id_guru' => 'required|exists:guru,id',
            'id_kelas' => 'required|exists:kelas,id',
            'kkm' => 'required',
        ]);
        $data = $request->all();
        $data['is_mulok'] = $request->has('is_mulok');

        $muatan_pelajaran->update($data);

        return redirect()->route('admin.muatan-pelajaran.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy(MuatanPelajaran $muatan_pelajaran)
    {
        $muatan_pelajaran->delete();

        return redirect()->route('admin.muatan-pelajaran.index')->with('success', 'Data berhasil dihapus.');
    }
}
