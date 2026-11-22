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
        };

        return view('profile', compact('user', 'profile'));
    }
}
