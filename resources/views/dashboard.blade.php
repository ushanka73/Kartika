@extends('layouts.beranda')

@section('title', 'Dashboard')

@section('dashboard')

<main class="flex-1">
    <div class="flex-1 p-3 md:p-6 min-h-screen">
        @include('components.header')
        <h2 class="font-bold text-[1.6rem] m-4">Ringkasan Data</h2>
        <section class="grid grid-cols-2 gap-4 lg:grid-cols-4">
            <div class="rounded-2xl bg-white p-6 shadow-md outline outline-1 outline-red-500 hover:outline-0">
                <p class="text-xl font-bold text-gray-500">Siswa</p>
                <p class="mt-2 text-3xl font-bold text-rose-600 text-right">6</p>
            </div>
            <div class="rounded-2xl bg-white p-6 shadow-md outline outline-1 outline-red-500 hover:outline-0">
                <p class="text-xl font-bold text-gray-500">Guru</p>
                <p class="mt-2 text-3xl font-bold text-rose-600 text-right">3</p>
            </div>
            <div class="rounded-2xl bg-white p-6 shadow-md outline outline-1 outline-red-500 hover:outline-0">
                <p class="text-xl font-bold text-gray-500">Kelas</p>
                <p class="mt-2 text-3xl font-bold text-rose-600 text-right">3</p>
            </div>
            <div class="rounded-2xl bg-white p-6 shadow-md outline outline-1 outline-red-500 hover:outline-0">
                <p class="text-xl font-bold text-gray-500">Keluhan</p>
                <p class="mt-2 text-3xl font-bold text-rose-600 text-right">1</p>
            </div>
        @include('components.pengumuman')
        @include('components.kalender')
        @include('components.jadwal')
        </section>

    </div>
    @include('components.footer')
</main>
@endsection
