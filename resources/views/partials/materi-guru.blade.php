@if (session('sukses'))
    <div class="mb-4 rounded-2xl bg-green-100 px-4 py-3 text-sm font-bold text-green-700">
        {{ session('sukses') }}
    </div>
    @endif

    <div class="mb-2">
        <button type="button" onclick="bukaTambahMateri()"
                class="rounded-full bg-rose-600 px-5 py-2 text-sm font-bold text-white shadow-md hover:bg-rose-700">
            + Tambah materi
        </button>
    </div>

<div id="modal-materi" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">
    <div class="max-h-full w-full max-w-lg overflow-y-auto rounded-3xl bg-white p-6 shadow-xl">
        <h3 id="judul-modal-materi" class="mb-4 text-xl font-bold">Tambah Materi</h3>

        <form id="form-materi" method="POST" action="{{ route('materi.store') }}">
            @csrf
            <input type="hidden" name="_method" id="materi-method" value="POST">
            <input type="hidden" name="mode" id="materi-mode" value="{{ old('mode', 'tambah') }}">
            <input type="hidden" name="url_edit" id="materi-url-edit" value="{{ old('url_edit') }}">

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="mb-1 block text-sm font-bold">Mata pelajaran</label>
                    <select name="id_mapel" id="materi-id_mapel" class="w-full rounded-xl border border-gray-300 px-4 py-2 text-sm">
                        <option value="">-- Pilih mapel --</option>
                        @foreach ($mapelGuru as $mp)
                        <option value="{{ $mp->id_mapel }}" @selected(old('id_mapel') == $mp->id_mapel)>{{ $mp->nama_mapel }}</option>
                        @endforeach
                    </select>
                    @error('id_mapel') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-bold">Kelas</label>
                    <select name="id_kelas" id="materi-id_kelas" class="w-full rounded-xl border border-gray-300 px-4 py-2 text-sm">
                        <option value="">-- Pilih kelas --</option>
                        @foreach ($kelasGuru as $k)
                        <option value="{{ $k->id_kelas }}" @selected(old('id_kelas') == $k->id_kelas)>{{ $k->tingkat }} {{ $k->jurusan }}</option>
                        @endforeach
                    </select>
                    @error('id_kelas') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <label class="mt-4 mb-1 block text-sm font-bold">Judul materi</label>
            <input type="text" name="judul" id="materi-judul" value="{{ old('judul') }}" placeholder="mis. Persamaan Linear"
            class="w-full rounded-xl border border-gray-300 px-4 py-2 text-sm">
            @error('judul') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror

            <label class="mt-4 mb-1 block text-sm font-bold">Deskripsi <span class="font-normal text-gray-400">(opsional)</span></label>
            <textarea name="deskripsi" id="materi-deskripsi" rows="3"
            class="w-full rounded-xl border border-gray-300 px-4 py-2 text-sm">{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror

            <p class="mt-3 text-xs text-gray-500">File materi diunggah ke folder Google Drive sekolah.</p>

            <div class="mt-6 flex gap-2">
                <button type="button" onclick="tutupModalMateri()" class="flex-1 rounded-full border border-gray-300 py-2.5 text-sm font-bold hover:bg-gray-50">Batal</button>
                <button type="submit" class="flex-1 rounded-full bg-rose-600 py-2.5 text-sm font-bold text-white hover:bg-rose-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="modal-hapus-materi" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">
    <div class="w-full max-w-sm rounded-3xl bg-white p-6 text-center shadow-xl">
        <h3 class="text-lg font-bold">Hapus materi?</h3>
        <p class="mt-1 text-sm text-gray-500">Materi <b id="nama-hapus-materi"></b> akan dihapus permanen.</p>
        <form id="form-hapus-materi" method="POST" action="" class="mt-6 flex gap-2">
            @csrf
            @method('DELETE')
            <button type="button" onclick="tutupModalMateri()" class="flex-1 rounded-full border border-gray-300 py-2.5 text-sm font-bold hover:bg-gray-50">Batal</button>
            <button type="submit" class="flex-1 rounded-full bg-red-600 py-2.5 text-sm font-bold text-white hover:bg-red-700">Hapus</button>
        </form>
    </div>
</div>

<script>
    const kolomMateri = ['id_mapel', 'id_kelas', 'judul', 'deskripsi'];

    function tampilkanModalMateri(id) {
        document.getElementById(id).classList.remove('hidden');
        document.getElementById(id).classList.add('flex');
    }

    function tutupModalMateri() {
        ['modal-materi', 'modal-hapus-materi'].forEach(function (id) {
            document.getElementById(id).classList.add('hidden');
            document.getElementById(id).classList.remove('flex');
        });
    }

    function isiFormMateri(judul, url, method, mode, data) {
        document.getElementById('judul-modal-materi').innerText = judul;
        document.getElementById('form-materi').action = url;
        document.getElementById('materi-method').value = method;
        document.getElementById('materi-mode').value = mode;
        document.getElementById('materi-url-edit').value = (mode === 'edit') ? url : '';

        kolomMateri.forEach(function (kolom) {
            document.getElementById('materi-' + kolom).value = data[kolom] ?? '';
        });

        tampilkanModalMateri('modal-materi');
    }

    function bukaTambahMateri() {
        isiFormMateri('Tambah Materi', {{ Js::from(route('materi.store')) }}, 'POST', 'tambah', {});
    }

    function bukaEditMateri(url, data) {
        isiFormMateri('Edit Materi', url, 'PUT', 'edit', data);
    }

    function bukaHapusMateri(url, judul) {
        document.getElementById('form-hapus-materi').action = url;
        document.getElementById('nama-hapus-materi').innerText = judul;
        tampilkanModalMateri('modal-hapus-materi');
    }

    @if ($errors->any())
        if ({{ Js::from(old('mode')) }} === 'edit') {
            document.getElementById('judul-modal-materi').innerText = 'Edit Materi';
            document.getElementById('form-materi').action = {{ Js::from(old('url_edit')) }};
            document.getElementById('materi-method').value = 'PUT';
        }
        tampilkanModalMateri('modal-materi');
    @endif
</script>
