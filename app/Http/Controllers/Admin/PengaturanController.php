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
            'nama' => 'required|string|max:255',
            'nama_sekolah' => 'required|string|max:255',
            'nama_kepala_sekolah' => 'required|string|max:255',
            'nip_kepala_sekolah' => 'required',
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('admin', 'username')->ignore($admin->npsn,'npsn'),
            ],
            'password' => 'nullable|string|min:6|confirmed',
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
