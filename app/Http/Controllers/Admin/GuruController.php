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
            'user_name' => 'required|max:30|unique:guru,user_name',
            'password' => 'required',
            'tempat_lahir' => 'required|max:30',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|max:15',
            'hp' => 'required|max:15',
            'email' => 'required|email|unique:guru,email',
            'alamat' => 'required',
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
            'user_name' => 'required|max:30|unique:guru,user_name,' . $guru->id,
            'tempat_lahir' => 'required|max:30',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|max:15',
            'hp' => 'required|max:15',
            'email' => 'required|email|unique:guru,email,' . $guru->id,
            'alamat' => 'required',
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
