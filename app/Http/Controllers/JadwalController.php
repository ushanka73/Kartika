<?php

namespace App\Http\Controllers;
use App\Models\Jadwal;

use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $hariList = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        $jadwalPerHari = Jadwal::with('mataPelajaran','kelas')
        ->orderBy('jam_mulai')
        ->get()
        ->groupBy('hari');

        return view('jadwal', compact('hariList','jadwalPerHari'));
    }
}
