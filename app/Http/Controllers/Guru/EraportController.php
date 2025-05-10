<?php

namespace App\Http\Controllers\Guru;

use App\Models\Kelas;
use App\Models\Eraport;
use App\Models\PesertaDidik;
use Illuminate\Http\Request;
use App\Models\EraportPrestasi;
use App\Http\Controllers\Controller;
use App\Models\EraportEkstrakulikuler;
use App\Models\EraportEkstrakurikuler;

class EraportController extends Controller
{
    public function index()
    {
        $eraports = Eraport::with(['prestasi', 'ekstrakurikuler'])->paginate(10);

        return view('guru.eraport.index', compact('eraports'));
    }

    public function create()
    {
        $siswa = PesertaDidik::all();
        $kelas = Kelas::all();
        return view('guru.eraport.create', compact('siswa', 'kelas'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nisn' => 'required',
            'id_kelas' => 'required|exists:kelas,id',
            'sakit' => 'required|numeric',
            'izin' => 'required|numeric',
            'tanpa_keterangan' => 'required|numeric',
            'catatan' => 'required|string',
            'naik_kelas' => 'required|string',
            'tinggal_kelas' => 'required|string',
            'tahun' => 'required|numeric',
            'semester' => 'required|in:1,2',
            'tanggal_cetak' => 'required|date',
            'prestasi' => 'array|nullable',
            'prestasi.*.nama_prestasi' => 'string|nullable',
            'prestasi.*.nilai' => 'string|nullable',
            'ekstrakurikuler' => 'array|nullable',
            'ekstrakurikuler.*.nama_ekstrakurikuler' => 'string|nullable',
            'ekstrakurikuler.*.nilai' => 'string|nullable',
        ]);

        // Simpan data utama ke Eraport
        $eraport = Eraport::create([
            'nisn' => $request->nisn,
            'id_kelas' => $request->id_kelas,
            'sakit' => $request->sakit,
            'izin' => $request->izin,
            'tanpa_keterangan' => $request->tanpa_keterangan,
            'catatan' => $request->catatan,
            'naik_kelas' => $request->naik_kelas,
            'tinggal_kelas' => $request->tinggal_kelas,
            'tahun' => $request->tahun,
            'semester' => $request->semester,
            'tanggal_cetak' => $request->tanggal_cetak
        ]);

        // Simpan prestasi jika ada
        if ($request->has('nama_prestasi')) {
            foreach ($request->nama_prestasi as $index => $prestasi) {

                    EraportPrestasi::create([
                        'e_raport_id' => $eraport->id,
                        'nama_prestasi' => $prestasi,
                        'nilai' => $request->nilai_prestasi[$index] ?? '-',
                    ]);

            }
        }

        // Simpan ekstrakurikuler jika ada
        if ($request->has('nama_ekstrakurikuler')) {

            foreach ($request->nama_ekstrakurikuler as $index => $ekstra) {

                    EraportEkstrakurikuler::create([
                        'e_raport_id' => $eraport->id,
                        'nama_ekstrakurikuler' => $ekstra,
                        'nilai' => $request->nilai_ekstrakurikuler[$index] ?? '-',
                    ]);

            }
        }

        return redirect()->route('guru.eraport.index')->with('success', 'E-Raport berhasil disimpan.');
    }

    public function edit($id)
    {
        $eraport = Eraport::with(['prestasi', 'ekstrakurikuler'])->findOrFail($id);
        $siswa = PesertaDidik::all();
        $kelas = Kelas::all();
        return view('guru.eraport.edit', compact('eraport','siswa','kelas'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'nisn' => 'required',
            'id_kelas' => 'required|exists:kelas,id',
            'sakit' => 'required|numeric',
            'izin' => 'required|numeric',
            'tanpa_keterangan' => 'required|numeric',
            'catatan' => 'required|string',
            'naik_kelas' => 'required|string',
            'tinggal_kelas' => 'required|string',
            'tahun' => 'required|numeric',
            'semester' => 'required|in:1,2',
            'tanggal_cetak' => 'required|date',
            'prestasi' => 'array|nullable',
            'prestasi.*.nama_prestasi' => 'string|nullable',
            'prestasi.*.nilai' => 'string|nullable',
            'ekstrakurikuler' => 'array|nullable',
            'ekstrakurikuler.*.nama_ekstrakurikuler' => 'string|nullable',
            'ekstrakurikuler.*.nilai' => 'string|nullable',
        ]);

        // Cari data E-Raport berdasarkan ID
        $eraport = Eraport::findOrFail($id);

        // Update data utama E-Raport
        $eraport->update([
            'nisn' => $request->nisn,
            'id_kelas' => $request->id_kelas,
            'sakit' => $request->sakit,
            'izin' => $request->izin,
            'tanpa_keterangan' => $request->tanpa_keterangan,
            'catatan' => $request->catatan,
            'naik_kelas' => $request->naik_kelas,
            'tinggal_kelas' => $request->tinggal_kelas,
            'tahun' => $request->tahun,
            'semester' => $request->semester,
            'tanggal_cetak' => $request->tanggal_cetak,
        ]);

        // Update atau simpan prestasi jika ada
        if ($request->has('nama_prestasi')) {
            // Hapus semua prestasi yang ada
            $eraport->prestasi()->delete();

            // Simpan prestasi baru
            foreach ($request->nama_prestasi as $index => $prestasi) {
                EraportPrestasi::create([
                    'e_raport_id' => $eraport->id,
                    'nama_prestasi' => $prestasi,
                    'nilai' => $request->nilai_prestasi[$index] ?? '-',
                ]);
            }
        }

        // Update atau simpan ekstrakurikuler jika ada
        if ($request->has('nama_ekstrakurikuler')) {
            // Hapus semua ekstrakurikuler yang ada
            $eraport->ekstrakurikuler()->delete();

            // Simpan ekstrakurikuler baru
            foreach ($request->nama_ekstrakurikuler as $index => $ekstra) {
                EraportEkstrakurikuler::create([
                    'e_raport_id' => $eraport->id,
                    'nama_ekstrakurikuler' => $ekstra,
                    'nilai' => $request->nilai_ekstrakurikuler[$index] ?? '-',
                ]);
            }
        }

        return redirect()->route('guru.eraport.index')->with('success', 'E-Raport berhasil diperbarui.');
    }

    public function show($id)
    {
        $eraport = Eraport::with(['siswa', 'kelas', 'prestasi', 'ekstrakurikuler'])->findOrFail($id);

        return view('guru.eraport.show', compact('eraport'));
    }

    public function destroy($id)
    {
        $eraport = Eraport::findOrFail($id);
        $eraport->delete();

        return redirect()->route('guru.eraport.index')->with('success', 'Data berhasil dihapus.');
    }
}
