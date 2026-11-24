<?php

namespace App\Http\Controllers;
use App\Models\Jadwal;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $hariIni       = Jadwal::hariIni();
        $jadwalPerHari = Jadwal::milikUser(auth()->user());
        return view('dashboard', compact('hariIni', 'jadwalPerHari'));
    }
}
