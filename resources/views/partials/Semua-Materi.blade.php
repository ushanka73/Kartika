@php
        $linkDrive = \App\Models\Materi::LINK_DRIVE;
@endphp
<section>
    <h2 class="mb-4 px-1 text-[1.6rem] font-bold">Semua Materi</h2>

    <div class="flex flex-col gap-3">
        @forelse ($materiList as $m)
            <div class="flex items-start gap-4 rounded-2xl bg-white p-4 shadow-md">
                <div class="min-w-0 flex-1">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="rounded-md bg-rose-100 px-2 py-0.5 text-xs font-bold text-rose-800">{{ $m->mataPelajaran->kode_mapel }}</span>
                        <span class="font-bold">{{ $m->judul }}</span>
                    </div>
                    @if ($m->deskripsi)
                        <p class="mt-1 text-sm text-gray-500">{{ $m->deskripsi }}</p>
                    @endif
                    <div class="mt-2 flex flex-wrap gap-x-4 gap-y-1 text-xs text-gray-400">
                        <span>{{ $m->guru->nama_lengkap }}</span>
                        @if (auth()->user()->role !== 'siswa')
                            <span>{{ $m->kelas->tingkat }} {{ $m->kelas->jurusan }}</span>
                        @endif
                        <span>{{ $m->tanggal_upload->format('d M Y') }}</span>
                    </div>
                    <div class="mt-3 flex flex-wrap gap-2">
                        <a href="{{ $linkDrive }}" target="_blank" rel="noopener"
                           class="rounded-full border border-rose-300 px-4 py-1.5 text-xs font-bold text-rose-700 hover:bg-rose-50">
                            Buka folder materi
                        </a>

                        @if (auth()->user()->role === 'guru' && $m->id_guru == auth()->user()->guru->id_guru)
                            <button type="button"
                                    onclick="bukaEditMateri({{ Js::from(route('materi.update', $m)) }}, {{ Js::from([
                                        'id_mapel'  => $m->id_mapel,
                                        'id_kelas'  => $m->id_kelas,
                                        'judul'     => $m->judul,
                                        'deskripsi' => $m->deskripsi,
                                    ]) }})"
                                    class="rounded-full bg-rose-500 px-4 py-1.5 text-xs font-bold text-white hover:bg-rose-600">
                                Edit
                            </button>
                            <button type="button"
                                    onclick="bukaHapusMateri({{ Js::from(route('materi.destroy', $m)) }}, {{ Js::from($m->judul) }})"
                                    class="rounded-full border border-red-300 px-4 py-1.5 text-xs font-bold text-red-600 hover:bg-red-50">
                                Hapus
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="rounded-2xl bg-white p-8 text-center text-sm text-gray-400 shadow-md">
                Belum ada materi{{ request('cari') ? ' yang cocok dengan "' . request('cari') . '"' : '' }}.
            </div>
        @endforelse
    </div>
</section>
