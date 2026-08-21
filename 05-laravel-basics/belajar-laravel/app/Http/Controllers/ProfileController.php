<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:2048'
        ]);

        if ($request->hasFile('foto_profil')) {
            if ($user->foto_profil) {
                Storage::disk('public')->delete($user->foto_profil);
            }

            $path = $request->file('foto_profil')->store('profil', 'public');
            $user->foto_profil = $path;
        }

        $user->name = $request->name;
        $user->save();
        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|string|min:8|confirmed',
        ], [
            'password_baru.confirmed' => 'Konfirmasi password baru tidak cocok!',
            'password_baru.min' => 'Password baru minimal 8 karakter!',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->password_lama, $user->password)) {
            return back ()->withErrors(['password_lama' => 'Password lama yang Anda masukkan salah!']);
        }

        $user->password = Hash::make($request->password_baru);
        $user->save();

        return back()->with('success_password', 'Password berhasil diubah! Jangan sampai lupa.');
    }
}
