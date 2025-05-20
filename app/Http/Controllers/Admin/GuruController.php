<?php

namespace App\Http\Controllers\Admin;

use App\Models\Guru;
use App\Imports\GuruImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class GuruController extends Controller
{
    //controller guru di admin

    public function index()
    {
        $guru = Guru::paginate(10);
        return view('admin.guru.index', compact('guru'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:30',
            'jabatan' => 'required|max:30',
            'nip' => 'required|numeric|digits_between:1,18',
            'user_name' => 'required|max:30|unique:guru,user_name',
            'password' => 'required',
            'type' => 'required',
            'tempat_lahir' => 'required|max:30',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|max:15',
            'hp' => 'required|max:15',
            'email' => 'required|email|unique:guru,email',
            'alamat' => 'required',
            'status_guru' => 'required',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 30 karakter.',
            'nip.digits_between' => 'NIP melewati jumlah batas karakter maksimal 18 angka.',

            'jabatan.required' => 'Jabatan wajib diisi.',
            'jabatan.max' => 'Jabatan maksimal 30 karakter.',

            'user_name.required' => 'Username wajib diisi.',
            'user_name.max' => 'Username maksimal 30 karakter.',
            'user_name.unique' => 'Username sudah digunakan.',

            'password.required' => 'Password wajib diisi.',
            'type.required' => 'Jenis Guru wajib diisi.',

            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tempat_lahir.max' => 'Tempat lahir maksimal 30 karakter.',

            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',

            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'jenis_kelamin.max' => 'Jenis kelamin maksimal 15 karakter.',

            'hp.required' => 'Nomor HP wajib diisi.',
            'hp.max' => 'Nomor HP maksimal 15 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',

            'alamat.required' => 'Alamat wajib diisi.',
        ]);


        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        Guru::create($data);

        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $request->validate([
            'nama' => 'required|max:30',
            'jabatan' => 'required|max:30',
            'nip' => 'required|numeric|digits_between:1,18',
            'user_name' => 'required|max:30|unique:guru,user_name,' . $guru->id,
            'tempat_lahir' => 'required|max:30',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|max:15',
            'hp' => 'required|max:15',
            'email' => 'required|email|unique:guru,email,' . $guru->id,
            'alamat' => 'required',
            'type' => 'required',
            'status_guru' => 'required',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 30 karakter.',
            'nip.digits_between' => 'NIP melewati jumlah batas karakter maksimal 18 angka.',

            'jabatan.required' => 'Jabatan wajib diisi.',
            'jabatan.max' => 'Jabatan maksimal 30 karakter.',

            'user_name.required' => 'Username wajib diisi.',
            'user_name.max' => 'Username maksimal 30 karakter.',
            'user_name.unique' => 'Username sudah digunakan.',

            'type.required' => 'Jenis Guru wajib diisi.',

            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tempat_lahir.max' => 'Tempat lahir maksimal 30 karakter.',

            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',

            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'jenis_kelamin.max' => 'Jenis kelamin maksimal 15 karakter.',

            'hp.required' => 'Nomor HP wajib diisi.',
            'hp.max' => 'Nomor HP maksimal 15 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',

            'alamat.required' => 'Alamat wajib diisi.',
        ]);

        $data = $request->except('password');

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $guru->update($data);

        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil diupdate.');
    }

    public function destroy($id)
    {
        Guru::findOrFail($id)->delete();
        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil dihapus.');
    }

    public function ViewImport()
    {
        return view('admin.guru.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        $import = new GuruImport();
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
