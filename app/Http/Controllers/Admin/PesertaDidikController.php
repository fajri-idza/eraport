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
            'nisn' => 'required|numeric|digits_between:1,12',
            'nama_peserta_didik' => 'required|max:30',
            'nis' => 'required|numeric|digits_between:1,8',
            'id_kelas' => 'required',
            'tempat_lahir' => 'required|max:30',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|max:10',
            'agama' => 'required|max:10',
            'pendidikan_sebelumnya' => 'required|max:10',
            'alamat_peserta_didik' => 'required|max:100',
            'nama_ayah' => 'required|max:30',
            'alamat_ayah' => 'required|max:100',
            'nama_ibu' => 'required|max:30',
            'alamat_ibu' => 'required|max:100',
            'wali_peserta_didik' => '',
            'alamat_wali_peserta_didik' => ''
        ], [
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.digits_between' => 'NISN melewati jumlah batas karakter maksimal 12 angka.',
            'nama_peserta_didik.required' => 'Nama peserta didik wajib diisi.',
            'nama_peserta_didik.max' => 'Nama peserta didik maksimal 30 karakter.',
            'nis.required' => 'NIS wajib diisi.',
            'nis.numeric' => 'NIS harus berupa angka',
            'nis.digits_between' => 'NIS melewati jumlah batas karakter maksimal 8 angka.',
            'id_kelas.required' => 'Kelas wajib dipilih.',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tempat_lahir.max' => 'Tempat lahir maksimal 30 karakter.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'jenis_kelamin.max' => 'Jenis kelamin maksimal 10 karakter.',
            'agama.required' => 'Agama wajib diisi.',
            'agama.max' => 'Agama maksimal 10 karakter.',
            'pendidikan_sebelumnya.required' => 'Pendidikan sebelumnya wajib diisi.',
            'pendidikan_sebelumnya.max' => 'Pendidikan sebelumnya maksimal 10 karakter.',
            'alamat_peserta_didik.required' => 'Alamat peserta didik wajib diisi.',
            'alamat_peserta_didik.max' => 'Alamat peserta didik maksimal 100 karakter.',
            'nama_ayah.required' => 'Nama Ayah wajib diisi.',
            'nama_ibu.required' => 'Nama Ibu wajib diisi.',
            'nama_ayah.max' => 'Nama Ayah maksimal 30 karakter.',
            'nama_ibu.max' => 'Nama Ibu maksimal 30 karakter.',
            'alamat_ayah.required' => 'Alamat Ayah wajib diisi.',
            'alamat_ibu.required' => 'Alamat Ibu wajib diisi.',
            'alamat_ayah.max' => 'Alamat Ayah maksimal 100 karakter.',
            'alamat_ibu.max' => 'Alamat ibu maksimal 100 karakter.',
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
             'nama_ayah' => 'required|max:30',
            'alamat_ayah' => 'required|max:100',
            'nama_ibu' => 'required|max:30',
            'alamat_ibu' => 'required|max:100',
            'wali_peserta_didik' => '',
            'alamat_wali_peserta_didik' => ''
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
