<?php

namespace App\Http\Controllers\Guru;

use App\Models\Nilai;
use App\Models\DetailNilai;
use App\Models\PesertaDidik;
use Illuminate\Http\Request;
use App\Models\MuatanPelajaran;
use App\Http\Controllers\Controller;
use App\Models\Kelas;

class NilaiController extends Controller
{
    public function index()
    {
        $nilai = Nilai::with(['siswa', 'muatan', 'details','kelas'])->paginate(10);
        return view('guru.nilai.index', compact('nilai'));
    }

    public function create()
    {
        $siswa = PesertaDidik::all();
        $muatan = MuatanPelajaran::all();
        $kelas = Kelas::all();
        return view('guru.nilai.create', compact('siswa', 'muatan','kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required',
            'id_muatan_pelajaran' => 'required',
            'id_kelas' => 'required',
            'tahun' => 'required',
            'semester' => 'required',
            'materi.*' => 'required',
            'nilai.*' => 'required|numeric',
        ]);

        $nilai = Nilai::create([
            'nisn' => $request->nisn,
            'id_muatan_pelajaran' => $request->id_muatan_pelajaran,
            'id_kelas' => $request->id_kelas,
            'tahun' => $request->tahun,
            'semester' => $request->semester,
        ]);

        foreach ($request->materi as $index => $materi) {
            DetailNilai::create([
                'nilai_id' => $nilai->id,
                'materi' => $materi,
                'nilai' => $request->nilai[$index],
            ]);
        }

        return redirect()->route('guru.nilai.index')->with('success', 'Data berhasil disimpan.');
    }

        public function edit($id)
    {
        $nilai = Nilai::with('details')->findOrFail($id);
        $siswa = PesertaDidik::all();
        $muatan = MuatanPelajaran::all();
        $kelas = Kelas::all();

        return view('guru.nilai.edit', compact('nilai', 'siswa', 'muatan','kelas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nisn' => 'required',
            'id_muatan_pelajaran' => 'required',
            'tahun' => 'required',
            'id_kelas' => 'required',
            'semester' => 'required',
            'materi.*' => 'required',
            'nilai.*' => 'required|numeric',
        ]);

        $nilai = Nilai::findOrFail($id);

        $nilai->update([
            'nisn' => $request->nisn,
            'id_muatan_pelajaran' => $request->id_muatan_pelajaran,
            'id_kelas' => $request->id_kelas,
            'tahun' => $request->tahun,
            'semester' => $request->semester,
        ]);

        // Hapus semua detail nilai lama
        $nilai->details()->delete();

        // Masukkan detail nilai baru
        foreach ($request->materi as $index => $materi) {
            DetailNilai::create([
                'nilai_id' => $nilai->id,
                'materi' => $materi,
                'nilai' => $request->nilai[$index],
            ]);
        }

        return redirect()->route('guru.nilai.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete(); // otomatis akan hapus detail_nilai juga karena foreign key onDelete('cascade')

        return redirect()->route('guru.nilai.index')->with('success', 'Data berhasil dihapus.');
    }
}
