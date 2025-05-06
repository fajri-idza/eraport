<?php

namespace App\Http\Controllers\Guru;

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
        $guru = Auth::guard('guru')->user();
        return view('guru.pengaturan.edit', compact('guru'));
    }

    public function updateProfile(Request $request)
    {
        $guru = Auth::guard('guru')->user();
        $request->validate([
            'nama' => 'required|string|max:255',
            'user_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('guru', 'user_name')->ignore($guru->id),
            ],
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $guru->nama = $request->nama;
        $guru->user_name = $request->user_name;

        if ($request->password) {
            $guru->password = Hash::make($request->password);
        }

        $guru->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
