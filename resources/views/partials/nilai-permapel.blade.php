<section>
    <div class="grid grid-cols-2 gap-3 lg:grid-cols-4">
        <div class="rounded-2xl bg-white p-4 shadow-md">
            <p class="text-sm text-gray-500">Rata-rata</p>
            <p class="mt-1 text-2xl font-bold text-rose-600">{{ number_format($ringkasan['rata_rata'], 1, ',', '.') }}</p>
        </div>
        <div class="rounded-2xl bg-white p-4 shadow-md">
            <p class="text-sm text-gray-500">Mata pelajaran</p>
            <p class="mt-1 text-2xl font-bold">{{ $ringkasan['jumlah_mapel'] }}</p>
        </div>
        <div class="rounded-2xl bg-white p-4 shadow-md">
            <p class="text-sm text-gray-500">Tuntas</p>
            <p class="mt-1 text-2xl font-bold text-green-600">{{ $ringkasan['tuntas'] }}</p>
        </div>
        <div class="rounded-2xl bg-white p-4 shadow-md">
            <p class="text-sm text-gray-500">Belum tuntas</p>
            <p class="mt-1 text-2xl font-bold text-red-600">{{ $ringkasan['belum_tuntas'] }}</p>
        </div>
    </div>

    <div class="mt-6 mb-3 flex items-baseline justify-between px-1">
        <h3 class="text-lg font-bold">Nilai per mata pelajaran</h3>
        <span class="text-xs text-gray-500">▏ garis KKM</span>
    </div>

    <div class="flex flex-col gap-3">
        @forelse ($nilaiList as $n)
            @include('partials.Itunilai', [
                'kode'  => $n->mataPelajaran->kode_mapel,
                'mapel' => $n->mataPelajaran->nama_mapel,
                'guru'  => $n->guru->nama_lengkap ?? '-',
                'kkm'   => $n->mataPelajaran->kkm,
                'nilai' => $n->nilai_akhir,
            ])
        @empty
            <div class="rounded-2xl bg-white p-6 text-center text-sm text-gray-500 shadow-md">
                Belum ada nilai untuk semester {{ $semester }}.
            </div>
        @endforelse
    </div>
</section>
