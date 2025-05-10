<?php

namespace App\Http\Controllers\Guru;

use App\Models\Admin;
use App\Models\Nilai;
use App\Models\Eraport;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\PesertaDidik;

class EraportCetakController extends Controller
{
    // Menampilkan halaman index dengan data E-Raport
    public function index()
    {
        // Ambil semua data E-Raport
        $eraports = Eraport::with(['kelas'])->get();

        // Menampilkan halaman index dengan data E-Raport
        return view('guru.cetak-eraport.index', compact('eraports'));
    }

    public function detail($id)
    {
        // Ambil data E-Raport berdasarkan ID
        $eraport = Eraport::with(['kelas', 'prestasi', 'ekstrakurikuler'])->findOrFail($id);

        $nilai = Nilai::with('details')->where('nisn',$eraport->nisn)
            ->where('id_kelas',$eraport->id_kelas)
            ->where('tahun',$eraport->tahun)->where('semester',$eraport->semester)->get();

        // Menampilkan halaman untuk melihat data E-Raport
        return view('guru.cetak-eraport.detail', compact('eraport','nilai'));
    }

    public function cetakPdf($id)
    {
        $eraport = Eraport::with(['siswa', 'kelas', 'prestasi', 'ekstrakurikuler'])->findOrFail($id);
        $nilai = Nilai::with('muatan', 'details')->where('nisn',$eraport->nisn)
        ->where('id_kelas',$eraport->id_kelas)
        ->where('tahun',$eraport->tahun)->where('semester',$eraport->semester)
        ->whereHas('muatan', function ($query) {
            $query->where('is_mulok', false);
        })->get();

        $mulok = Nilai::with('muatan', 'details')->where('nisn',$eraport->nisn)
        ->where('id_kelas',$eraport->id_kelas)
        ->where('tahun',$eraport->tahun)->where('semester',$eraport->semester)
        ->whereHas('muatan', function ($query) {
            $query->where('is_mulok', true);
        })->get();
        $kepsek = Admin::select('nama_kepala_sekolah','nip_kepala_sekolah')->first();
        $pdf = Pdf::loadView('guru.cetak-eraport.eraport-pdf', compact('eraport', 'nilai','mulok','kepsek'))->setPaper('A4', 'portrait');
        return $pdf->download('eraport_'.$eraport->siswa->nama_peserta_didik.'.pdf');
    }

    public function printPdf($id)
    {
        $eraport = Eraport::with(['siswa', 'kelas', 'prestasi', 'ekstrakurikuler'])->findOrFail($id);
        $nilai = Nilai::with('muatan', 'details')->where('nisn',$eraport->nisn)
            ->where('id_kelas',$eraport->id_kelas)
            ->where('tahun',$eraport->tahun)->where('semester',$eraport->semester)
            ->whereHas('muatan', function ($query) {
                $query->where('is_mulok', false);
            })->get();

        $mulok = Nilai::with('muatan', 'details')->where('nisn',$eraport->nisn)
            ->where('id_kelas',$eraport->id_kelas)
            ->where('tahun',$eraport->tahun)->where('semester',$eraport->semester)
            ->whereHas('muatan', function ($query) {
                $query->where('is_mulok', true);
            })->get();

        $kepsek = Admin::select('nama_kepala_sekolah','nip_kepala_sekolah','nama_sekolah')->first();

        return view('guru.cetak-eraport.eraport-print-pdf', compact('eraport', 'nilai','mulok','kepsek'));
    }

    public function cetakDataDiri($id)
    {
        $eraport = Eraport::where('id',$id)->first();
        $siswa = PesertaDidik::where('nisn',$eraport->nisn)->first();
        $kepsek = Admin::select('nama_kepala_sekolah','nip_kepala_sekolah','nama_sekolah')->first();
        return view('guru.cetak-eraport.data-diri', compact('kepsek','siswa','eraport'));

    }
}
