<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $profile = match ($user->role) {
            'admin' => $user->admin,
            'guru'  => $user->guru,
            'siswa' => $user->siswa,
            default => abort(403, 'Role tidak dikenali.'),
        };
        if (!$profile) {
            abort(404, 'Data profil pengguna tidak ditemukan.');
        }
        if ($user->role === 'siswa') {
            $profile->load('kelas');
        }

        return view('profile', compact('user', 'profile'));
    }
}
