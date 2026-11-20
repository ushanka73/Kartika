@extends('layouts.beranda')

@section('title','Jadwal')

@section('jadwal')

<main class="flex-1">
    <div class="flex-1 p-3 md:p-6 min-h-screen">
        <header class="relative overflow-hidden p-10 rounded-2xl bg-rose-600 min-h-60  text-white shadow-md flex flex-col justify-end">
            <div class="pointer-events-none absolute -right-20 -top-2 hidden h-[22rem] w-[22rem] md:block xl:right-32" aria-hidden="true">
                <div class="absolute left-[55%] top-[35%] h-[26rem] w-[26rem] -translate-x-1/2 -translate-y-1/2 rounded-full bg-white/10"></div>
                <div class="absolute left-[55%] top-[35%] h-[17rem] w-[17rem] -translate-x-1/2 -translate-y-1/2 rounded-full bg-white/10"></div>
                @include('partials.bendera-merah-putih', ['class' => 'relative h-full w-full'])
            </div>
            <img src="#" alt="Foto profil"
            class="relative mb-3 h-20 w-20 md:h-28 md:w-28 rounded-full object-cover ring-4 ring-white">
            <h1 class="relative text-2xl md:text-[2rem] font-bold">NamaSiswa</h1>
            <p class="relative text-sm md:text-base opacity-90">Kelas X IPA 1 · Semester Ganjil 2025/2026</p>
        </header>
        @include('components.jadwal')
        @include('components.kalender')
        <h2 class="font-bold text-[1.6rem] m-4">Jadwal Mata Pelajaran</h2>
        @foreach ($hariList as $hari)
            <section class="col-span-2 lg:col-span-4">
                <h3 class="font-bold text-[1.6rem] m-4">{{ $hari }}</h3>
                <div class="overflow-x-auto rounded-3xl bg-white p-6 shadow-md">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b text-gray-500">
                                <th class="py-3 pr-4 font-bold">Jam</th>
                                <th class="py-3 pr-4 font-bold">Mata pelajaran</th>
                                <th class="py-3 pr-4 font-bold">Kelas</th>
                                <th class="py-3 font-bold">Ruang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jadwalPerHari->get($hari, collect()) as $j)
                                <tr @class(['border-b' => ! $loop->last])>
                                    <td class="py-3 pr-4 whitespace-nowrap">
                                        {{ substr($j->jam_mulai, 0, 5) }} – {{ substr($j->jam_selesai, 0, 5) }}
                                    </td>
                                    <td class="py-3 pr-4">{{ $j->mataPelajaran->nama_mapel }}</td>
                                    <td class="py-3 pr-4">{{ $j->kelas->tingkat }} {{ $j->kelas->jurusan }}</td>
                                    <td class="py-3">{{ $j->ruang }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-gray-400">Tidak ada jadwal</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        @endforeach


    </div>
    @include('components.footer')
</main>
@endsection
