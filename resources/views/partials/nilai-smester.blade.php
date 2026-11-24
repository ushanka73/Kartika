<section class="mt-6">
    <div class="mb-4 flex flex-wrap items-center justify-between gap-3 px-1">
        <div>
            <h2 class="text-[1.6rem] font-bold">Nilai Semester {{ $semester }}</h2>
            @isset($siswa)
                <p class="text-sm text-gray-500">{{ $siswa->nama_lengkap }} · {{ $siswa->kelas->tingkat }} {{ $siswa->kelas->jurusan }}</p>
            @endisset
        </div>
        <div class="flex gap-2">
            @foreach (['Ganjil', 'Genap'] as $s)
                <a href="{{ request()->fullUrlWithQuery(['semester' => $s]) }}"
                   @class([
                       'rounded-full border px-4 py-1.5 text-sm',
                       'border-rose-600 bg-rose-600 font-bold text-white' => $semester === $s,
                       'border-rose-300 text-rose-700 hover:bg-rose-50'  => $semester !== $s,
                   ])>
                    {{ $s }}
                </a>
            @endforeach
        </div>
    </div>
</section>
