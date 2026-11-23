<section>
    <div id="nilai-ganjil">
        <div class="grid grid-cols-2 gap-3 lg:grid-cols-4">
            <div class="rounded-2xl bg-white p-4 shadow-md">
                <p class="text-sm text-gray-500">Rata-rata</p>
                <p class="mt-1 text-2xl font-bold text-rose-600">81,3</p>
            </div>
            <div class="rounded-2xl bg-white p-4 shadow-md">
                <p class="text-sm text-gray-500">Mata pelajaran</p>
                <p class="mt-1 text-2xl font-bold">3</p>
            </div>
            <div class="rounded-2xl bg-white p-4 shadow-md">
                <p class="text-sm text-gray-500">Tuntas</p>
                <p class="mt-1 text-2xl font-bold text-green-600">2</p>
            </div>
            <div class="rounded-2xl bg-white p-4 shadow-md">
                <p class="text-sm text-gray-500">Belum tuntas</p>
                <p class="mt-1 text-2xl font-bold text-red-600">1</p>
            </div>
        </div>
                <div class="mt-6 mb-3 flex items-baseline justify-between px-1">
            <h3 class="text-lg font-bold">Nilai per mata pelajaran</h3>
            <span class="text-xs text-gray-500">▏ garis KKM</span>
        </div>
        <div class="flex flex-col gap-3">
            @include('partials.Itunilai', ['kode' => 'MTK', 'mapel' => 'Matematika',       'guru' => 'Budi Santoso, S.Pd.', 'kkm' => 75, 'nilai' => 67])
            @include('partials.Itunilai', ['kode' => 'BIN', 'mapel' => 'Bahasa Indonesia', 'guru' => 'Siti Aminah, S.Pd.',  'kkm' =>    75, 'nilai' => 80])
            @include('partials.Itunilai', ['kode' => 'FIS', 'mapel' => 'Fisika',           'guru' => 'Agus Wijaya, M.Pd.',  'kkm' => 75, 'nilai' => 97])
        </div>
    </div>
</section>
