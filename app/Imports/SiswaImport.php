<?php

namespace App\Imports;

use App\Models\PesertaDidik;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Validators\Failure;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Validation\Rule;
use Throwable;


class SiswaImport implements ToModel, WithHeadingRow, SkipsOnFailure, SkipsOnError, WithValidation
{
    use Importable;

    public $failures = [];
    // Menyimpan setiap baris data siswa
    public function model(array $row)
    {
        $tanggal = $row['tanggal_lahir'];

        if (is_numeric($tanggal)) {
            $tanggal_lahir = Date::excelToDateTimeObject($tanggal);
        } else {
            $tanggal_lahir = Carbon::parse($tanggal);
        }
        return new PesertaDidik([
            'nisn' => $row['nisn'],
            'nama_peserta_didik' => $row['nama_peserta_didik'],
            'nis' => $row['nis'],
            'id_kelas' => $row['id_kelas'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => $tanggal_lahir,
            'jenis_kelamin' => $row['jenis_kelamin'],
            'agama' => $row['agama'],
            'pendidikan_sebelumnya' => $row['pendidikan_sebelumnya'],
            'alamat_peserta_didik' => $row['alamat_peserta_didik'],
            'nama_orang_tua' => $row['nama_orang_tua'],
            'alamat_orang_tua' => $row['alamat_orang_tua'],
            'wali_peserta_didik' => $row['wali_peserta_didik'] ?? null,
            'alamat_wali_peserta_didik' => $row['alamat_wali_peserta_didik'] ?? null,
        ]);
    }

    // Validasi setiap baris data
    public function rules(): array
    {
        return [
            'nisn' => 'required|numeric|unique:peserta_didik,nisn',
            'nis' => 'required|numeric|unique:peserta_didik,nis',
            'nama_peserta_didik' => 'required|string|max:30',
            'id_kelas' => 'required',
            'tempat_lahir' => 'required|string|max:30',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'agama' => ['required'],
            'pendidikan_sebelumnya' => ['required'],
            'alamat_peserta_didik' => 'required|string|max:100',
            'nama_orang_tua' => 'required|string|max:30',
            'alamat_orang_tua' => 'required|string|max:100',
            'wali_peserta_didik' => 'nullable|string|max:30',
            'alamat_wali_peserta_didik' => 'nullable|string|max:100',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        $this->failures = array_merge($this->failures, $failures);
    }

    public function onError(\Throwable $e)
    {
        // Jika ada error, lanjutkan ke baris berikutnya
    }
}
