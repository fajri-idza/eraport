<?php

namespace App\Imports;

use App\Models\Guru;
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
use Throwable;

class GuruImport implements ToModel, WithHeadingRow, SkipsOnFailure, SkipsOnError, WithValidation
{
    use Importable;

    public $failures = [];

    public function model(array $row)
    {
        $tanggal = $row['tanggal_lahir'];

        if (is_numeric($tanggal)) {
            $tanggal_lahir = Date::excelToDateTimeObject($tanggal);
        } else {
            $tanggal_lahir = Carbon::parse($tanggal);
        }
        return new Guru([
            'nama'           => $row['nama'],
            'jabatan'        => $row['jabatan'],
            'user_name'      => $row['user_name'],
            'nip'            => $row['nip'],
            'status_guru'    => $row['status_guru'],
            'type'           => $row['type'],
            'password'       => Hash::make($row['password']),
            'tempat_lahir'   => $row['tempat_lahir'],
            'tanggal_lahir'  => $tanggal_lahir,
            'jenis_kelamin'  => $row['jenis_kelamin'],
            'hp'             => $row['hp'],
            'email'          => $row['email'],
            'alamat'         => $row['alamat'],
        ]);
    }

    public function rules(): array
    {
        return [
            '*.nama'           => 'required|string|max:30',
            '*.jabatan'        => 'required|string|max:30',
            '*.nip'            => 'required|numeric|digits_between:1,18',
            '*.type'           => 'required',
            '*.status_guru'    => 'required',
            '*.user_name'      => 'required|string|max:30|unique:guru,user_name',
            '*.password'       => 'required|string|min:6',
            '*.tempat_lahir'   => 'required|string|max:30',
            '*.tanggal_lahir'  => 'required|date',
            '*.jenis_kelamin'  => 'required|string',
            '*.hp'             => 'required|string|max:15',
            '*.email'          => 'required|email|unique:guru,email',
            '*.alamat'         => 'required|string',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        $this->failures = array_merge($this->failures, $failures);
    }

    public function onError(Throwable $e)
    {
        // Lewati baris jika error
    }
}
