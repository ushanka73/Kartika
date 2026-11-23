@extends('layouts.beranda')

@section('title','Jadwal')

@section('jadwal')

<main class="flex-1">
    <div class="flex-1 p-3 md:p-6 min-h-screen">
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
