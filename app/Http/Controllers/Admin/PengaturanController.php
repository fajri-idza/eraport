<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PengaturanController extends Controller
{
    public function editProfile()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.pengaturan.edit', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'nama' => 'required|string|max:30',
            'nama_sekolah' => 'required|string|max:30',
            'nama_kepala_sekolah' => 'required|string|max:30',
            'nip_kepala_sekolah' => 'required',
            'username' => [
                'required',
                'string',
                'max:30',
                Rule::unique('admin', 'username')->ignore($admin->npsn,'npsn'),
            ],
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama maksimal 30 karakter.',

            'nama_sekolah.required' => 'Nama sekolah wajib diisi.',
            'nama_sekolah.string' => 'Nama sekolah harus berupa teks.',
            'nama_sekolah.max' => 'Nama sekolah maksimal 30 karakter.',

            'nama_kepala_sekolah.required' => 'Nama kepala sekolah wajib diisi.',
            'nama_kepala_sekolah.string' => 'Nama kepala sekolah harus berupa teks.',
            'nama_kepala_sekolah.max' => 'Nama kepala sekolah maksimal 30 karakter.',

            'nip_kepala_sekolah.required' => 'NIP kepala sekolah wajib diisi.',

            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username maksimal 30 karakter.',
            'username.unique' => 'Username sudah digunakan.',

            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $admin->nama = $request->nama;
        $admin->username = $request->username;
        $admin->nama_sekolah = $request->nama_sekolah;
        $admin->nama_kepala_sekolah = $request->nama_kepala_sekolah;
        $admin->nip_kepala_sekolah = $request->nip_kepala_sekolah;

        if ($request->password) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
