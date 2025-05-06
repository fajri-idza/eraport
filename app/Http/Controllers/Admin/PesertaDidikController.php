<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
use App\Imports\SiswaImport;
use App\Models\PesertaDidik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class PesertaDidikController extends Controller
{
    public function index()
    {
        $data = PesertaDidik::with('kelas')->paginate(10);
        $kelas = Kelas::all();
        return view('admin.peserta-didik.index', compact('data','kelas'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required',
            'nama_peserta_didik' => 'required|max:30',
            'nis' => 'required|integer',
            'id_kelas' => 'required',
            'tempat_lahir' => 'required|max:30',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|max:10',
            'agama' => 'required|max:10',
            'pendidikan_sebelumnya' => 'required|max:10',
            'alamat_peserta_didik' => 'required|max:100',
            'nama_orang_tua' => 'required|max:30',
            'alamat_orang_tua' => 'required|max:100',
            'wali_peserta_didik' => '',
            'alamat_wali_peserta_didik' => ''
        ]);

        PesertaDidik::create($request->all());

        return redirect()->route('admin.peserta-didik.index')->with('success', 'Peserta Didik berhasil ditambahkan');
    }

    public function edit($nisn)
    {
        $pesertaDidik = PesertaDidik::findOrFail($nisn);
        return view('admin.peserta-didik.edit', compact('pesertaDidik'));
    }

    public function update(Request $request, $nisn)
    {
        $request->validate([
            'nama_peserta_didik' => 'required|max:30',
            'nis' => 'required|integer',
            'id_kelas' => 'required',
            'tempat_lahir' => 'required|max:30',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|max:10',
            'agama' => 'required|max:10',
            'pendidikan_sebelumnya' => 'required|max:10',
            'alamat_peserta_didik' => 'required|max:100',
            'nama_orang_tua' => 'required|max:30',
            'alamat_orang_tua' => 'required|max:100',
        ]);

        $pesertaDidik = PesertaDidik::findOrFail($nisn);
        $pesertaDidik->update($request->all());

        return redirect()->route('admin.peserta-didik.index')->with('success', 'Peserta Didik berhasil diperbarui');
    }

    public function destroy($nisn)
    {
        $pesertaDidik = PesertaDidik::findOrFail($nisn);
        $pesertaDidik->delete();

        return redirect()->route('admin.peserta-didik.index')->with('success', 'Peserta Didik berhasil dihapus');
    }

    public function ViewImport()
    {
        return view('admin.peserta-didik.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        $import = new SiswaImport();
        Excel::import($import, $request->file('file'));

        if (count($import->failures) > 0) {

            return back()->with([
                'message' => 'Import selesai dengan beberapa baris gagal.',
                'failures' => $import->failures,
            ]);
        }

        return back()->with('message', 'Import berhasil tanpa error.');
    }
}
