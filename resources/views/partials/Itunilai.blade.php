<div class="flex items-center gap-4 rounded-2xl bg-white p-4 shadow-md">
    <div @class([
        'flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl text-2xl font-bold',
        'bg-rose-100 text-rose-800' => $nilai >= $kkm,
        'bg-red-100 text-red-600'   => $nilai <  $kkm,
    ])>{{ $nilai }}</div>

    <div class="min-w-0 flex-1">
        <div class="flex flex-wrap items-center gap-2">
            <span class="rounded-md bg-rose-100 px-2 py-0.5 text-xs font-bold text-rose-800">{{ $kode }}</span>
            <span class="font-bold">{{ $mapel }}</span>
            @if ($nilai >= $kkm)
                <span class="ml-auto rounded-full px-3 py-0.5 text-xs font-bold text-green-700">Tuntas</span>
            @else
                <span class="ml-auto rounded-full py-0.5 text-xs font-bold text-red-600">Belum tuntas</span>
            @endif
        </div>

        <div class="relative mt-3 mb-2 h-2 rounded-full bg-gray-100">
            <div @class(['h-full rounded-full', 'bg-rose-600' => $nilai >= $kkm, 'bg-red-400' => $nilai < $kkm])
                 style="width: {{ $nilai }}%"></div>
            <div class="absolute -top-1 h-4 w-0.5 bg-gray-800" style="left: {{ $kkm }}%"></div>
        </div>

        <div class="flex flex-wrap gap-x-4 gap-y-1 text-xs text-gray-400">
            <span> {{ $guru }}</span>
            <span> KKM {{ $kkm }}</span>
            @if ($nilai < $kkm)
                <span class="text-red-500">Kurang {{ $kkm - $nilai }} poin</span>
            @endif
        </div>
    </div>
</div>
