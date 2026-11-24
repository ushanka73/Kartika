<section class="col-span-2 lg:col-span-4">
    <h2 class="font-bold text-[1.6rem] m-4">Jadwal hari ini</h2>
    <div class="overflow-x-auto rounded-3xl bg-white p-6 shadow-md ">
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
                </tr>
            </thead>
            <tbody>
                @forelse ($jadwalPerHari->get($hariIni, collect()) as $j)
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
                    </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-6 text-center text-gray-400">Tidak ada jadwal hari ini</td>
                        </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
