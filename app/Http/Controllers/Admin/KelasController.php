<?php

namespace App\Http\Controllers\Admin;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('guru')->paginate(10);
        $guru = Guru::all();
        return view('admin.kelas.index', compact('guru','kelas'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:30',
            'id_guru' => 'required|exists:guru,id',
            'fase' => 'required|string',
            'semester' => 'required|integer',
            'tahun_pelajaran' => 'required|integer',
        ]);

        Kelas::create($request->all());

        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function update(Request $request, Kelas $kela)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:30',
            'id_guru' => 'required|exists:guru,id',
            'fase' => 'required|string',
            'semester' => 'required|integer',
            'tahun_pelajaran' => 'required|integer',
        ]);

        $kela->update($request->all());

        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil diupdate.');
    }

    public function destroy(Kelas $kela)
    {
        $kela->delete();

        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil dihapus.');
    }
}
