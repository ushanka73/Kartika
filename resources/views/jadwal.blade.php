@extends('layouts.beranda')

@section('title','Jadwal')

@section('jadwal')

<main class="flex-1">
    <div class="flex-1 p-3 md:p-6 min-h-screen">
        @include('components.jadwal')
        @include('components.kalender')
        <h2 class="font-bold text-[1.6rem] m-4">Jadwal Mata Pelajaran</h2>
         @if (auth()->user()->role === 'admin')
            @include('partials.jadwal-admin')
        @endif
        @foreach ($hariList as $hari)
            <section class="col-span-2 lg:col-span-4">
                <h3 class="font-bold text-[1.6rem] m-4">{{ $hari }}</h3>
                <div class="overflow-x-auto rounded-3xl bg-white p-6 shadow-md">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b text-gray-500">
                                <th class="py-3 pr-4 font-bold">Jam</th>
                                <th class="py-3 pr-4 font-bold">Mata pelajaran</th>
                                @if (auth()->user()->role === 'siswa')
                                    <th class="py-3 pr-4 font-bold">Guru</th>
                                @else
                                    <th class="py-3 pr-4 font-bold">Kelas</th>
                                @endif
                                <th class="py-3 font-bold">Ruang</th>
                                    @if (auth()->user()->role === 'admin')
                                        <th class="py-3 text-center font-bold">Aksi</th>
                                    @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jadwalPerHari->get($hari, collect()) as $j)
                            <tr @class(['border-b' => ! $loop->last])>
                                <td class="py-3 pr-4 whitespace-nowrap">
                                {{ substr($j->jam_mulai, 0, 5) }} – {{ substr($j->jam_selesai, 0, 5) }}
                                </td>
                                <td class="py-3 pr-4">{{ $j->mataPelajaran->nama_mapel }}</td>
                                @if (auth()->user()->role === 'siswa')
                                <td class="py-3 pr-4">{{ $j->guru->nama_lengkap }}</td>
                                @else
                                <td class="py-3 pr-4">{{ $j->kelas->tingkat }} {{ $j->kelas->jurusan }}</td>
                                @endif
                                <td class="py-3">{{ $j->ruang }}</td>
                                @if (auth()->user()->role === 'admin')
                                <td class="py-3">
                                    <div class="flex justify-center gap-2">
                                                <button type="button"
                                                        onclick="bukaEditJadwal({{ Js::from(route('jadwal.update', $j)) }}, {{ Js::from([
                                                            'id_kelas'     => $j->id_kelas,
                                                            'id_mapel'     => $j->id_mapel,
                                                            'id_guru'      => $j->id_guru,
                                                            'hari'         => $j->hari,
                                                            'jam_mulai'    => substr($j->jam_mulai, 0, 5),
                                                            'jam_selesai'  => substr($j->jam_selesai, 0, 5),
                                                            'ruang'        => $j->ruang,
                                                            'semester'     => $j->semester,
                                                            'tahun_ajaran' => $j->tahun_ajaran,
                                                        ]) }})"
                                                        class="rounded-full bg-rose-500 px-3 py-1 text-xs font-bold text-white hover:bg-rose-600">
                                                    Edit
                                                </button>
                                                <button type="button"
                                                        onclick="bukaHapusJadwal({{ Js::from(route('jadwal.destroy', $j)) }}, {{ Js::from($j->mataPelajaran->nama_mapel . ' (' . $j->hari . ')') }})"
                                                        class="rounded-full border border-red-300 px-3 py-1 text-xs font-bold text-red-600 hover:bg-red-50">
                                                    Hapus
                                                </button>
                                            </div>
                                        </td>
                                    @endif

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
