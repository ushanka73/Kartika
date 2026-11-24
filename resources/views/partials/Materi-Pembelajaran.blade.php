<section class="mt-6">
    <div class="mb-4 flex flex-wrap items-center justify-between gap-3 px-1">
        <div>
            <h2 class="text-[1.6rem] font-bold">Materi Pembelajaran</h2>
            <p class="text-sm text-gray-500">
                @if (auth()->user()->role === 'siswa')
                    Kelas {{ auth()->user()->siswa->kelas->tingkat }} {{ auth()->user()->siswa->kelas->jurusan }}
                @elseif (auth()->user()->role === 'guru')
                    Materi yang Anda unggah
                @else
                    Semua kelas
                @endif
            </p>
        </div>

        <form method="GET" action="{{ route('materi') }}" class="w-full sm:w-64">
            @if (request('mapel'))
                <input type="hidden" name="mapel" value="{{ request('mapel') }}">
            @endif
            <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari judul materi"
                   class="w-full rounded-full border border-gray-300 px-4 py-2 text-sm focus:border-rose-500 focus:outline-none focus:ring-2 focus:ring-rose-200">
        </form>
    </div>

    <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
        <a href="{{ route('materi', ['cari' => request('cari')]) }}"
           @class([
               'flex flex-col gap-2 rounded-2xl p-4',
               'border-2 border-rose-600 bg-rose-50' => ! request('mapel'),
               'border border-gray-200 bg-white hover:border-rose-300' => request('mapel'),
           ])>
            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-rose-600 text-xs font-bold text-white">ALL</span>
            <span class="font-bold">Semua mapel</span>
            <span class="text-xs text-gray-500">{{ $semuaMateri->count() }} materi</span>
        </a>

        @foreach ($materiPerMapel as $idMapel => $daftar)
            @php $mapel = $daftar->first()->mataPelajaran; @endphp
            <a href="{{ route('materi', ['mapel' => $idMapel, 'cari' => request('cari')]) }}"
               @class([
                   'flex flex-col gap-2 rounded-2xl p-4',
                   'border-2 border-rose-600 bg-rose-50' => request('mapel') == $idMapel,
                   'border border-gray-200 bg-white hover:border-rose-300' => request('mapel') != $idMapel,
               ])>
                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-rose-600 text-xs font-bold text-white">{{ $mapel->kode_mapel }}</span>
                <span class="font-bold">{{ $mapel->nama_mapel }}</span>
                <span class="text-xs text-gray-500">{{ $daftar->count() }} materi</span>
            </a>
        @endforeach
    </div>
</section>
