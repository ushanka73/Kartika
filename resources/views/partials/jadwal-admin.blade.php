@if (session('sukses'))
    <div class="m-4 rounded-2xl bg-green-100 px-4 py-3 text-sm font-bold text-green-700">
        {{ session('sukses') }}
    </div>
@endif

<div class="m-4">
    <button type="button" onclick="bukaTambahJadwal()"
            class="rounded-full bg-rose-600 px-5 py-2 text-sm font-bold text-white shadow-md hover:bg-rose-700">
        + Tambah jadwal
    </button>
</div>

<div id="modal-jadwal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">
    <div class="max-h-full w-full max-w-lg overflow-y-auto rounded-3xl bg-white p-6 shadow-xl">
        <h3 id="judul-modal-jadwal" class="mb-4 text-xl font-bold">Tambah Jadwal</h3>

        <form id="form-jadwal" method="POST" action="{{ route('jadwal.store') }}">
            @csrf
            <input type="hidden" name="_method" id="jadwal-method" value="POST">
            <input type="hidden" name="mode" id="jadwal-mode" value="{{ old('mode', 'tambah') }}">
            <input type="hidden" name="url_edit" id="jadwal-url-edit" value="{{ old('url_edit') }}">

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="mb-1 block text-sm font-bold">Kelas</label>
                    <select name="id_kelas" id="jadwal-id_kelas" class="w-full rounded-xl border border-gray-300 px-4 py-2 text-sm">
                        <option value="">-- Pilih kelas --</option>
                        @foreach ($kelasList as $k)
                            <option value="{{ $k->id_kelas }}" @selected(old('id_kelas') == $k->id_kelas)>{{ $k->tingkat }} {{ $k->jurusan }}</option>
                        @endforeach
                    </select>
                    @error('id_kelas') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-bold">Hari</label>
                    <select name="hari" id="jadwal-hari" class="w-full rounded-xl border border-gray-300 px-4 py-2 text-sm">
                        <option value="">-- Pilih hari --</option>
                        @foreach ($hariList as $h)
                            <option value="{{ $h }}" @selected(old('hari') === $h)>{{ $h }}</option>
                        @endforeach
                    </select>
                    @error('hari') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <label class="mt-4 mb-1 block text-sm font-bold">Mata pelajaran</label>
            <select name="id_mapel" id="jadwal-id_mapel" class="w-full rounded-xl border border-gray-300 px-4 py-2 text-sm">
                <option value="">-- Pilih mata pelajaran --</option>
                @foreach ($mapelList as $m)
                    <option value="{{ $m->id_mapel }}" @selected(old('id_mapel') == $m->id_mapel)>{{ $m->nama_mapel }}</option>
                @endforeach
            </select>
            @error('id_mapel') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror

            <label class="mt-4 mb-1 block text-sm font-bold">Guru</label>
            <select name="id_guru" id="jadwal-id_guru" class="w-full rounded-xl border border-gray-300 px-4 py-2 text-sm">
                <option value="">-- Pilih guru --</option>
                @foreach ($guruList as $g)
                    <option value="{{ $g->id_guru }}" @selected(old('id_guru') == $g->id_guru)>{{ $g->nama_lengkap }}</option>
                @endforeach
            </select>
            @error('id_guru') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror

            <div class="mt-4 grid grid-cols-2 gap-3">
                <div>
                    <label class="mb-1 block text-sm font-bold">Jam mulai</label>
                    <input type="time" name="jam_mulai" id="jadwal-jam_mulai" value="{{ old('jam_mulai') }}" class="w-full rounded-xl border border-gray-300 px-4 py-2 text-sm">
                    @error('jam_mulai') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-bold">Jam selesai</label>
                    <input type="time" name="jam_selesai" id="jadwal-jam_selesai" value="{{ old('jam_selesai') }}" class="w-full rounded-xl border border-gray-300 px-4 py-2 text-sm">
                    @error('jam_selesai') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <label class="mt-4 mb-1 block text-sm font-bold">Ruang</label>
            <input type="text" name="ruang" id="jadwal-ruang" value="{{ old('ruang') }}" placeholder="mis. R-101" class="w-full rounded-xl border border-gray-300 px-4 py-2 text-sm">
            @error('ruang') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror

            <div class="mt-4 grid grid-cols-2 gap-3">
                <div>
                    <label class="mb-1 block text-sm font-bold">Semester</label>
                    <select name="semester" id="jadwal-semester" class="w-full rounded-xl border border-gray-300 px-4 py-2 text-sm">
                        <option value="Ganjil" @selected(old('semester', 'Ganjil') === 'Ganjil')>Ganjil</option>
                        <option value="Genap" @selected(old('semester') === 'Genap')>Genap</option>
                    </select>
                </div>
                <div>
                    <label class="mb-1 block text-sm font-bold">Tahun ajaran</label>
                    <input type="text" name="tahun_ajaran" id="jadwal-tahun_ajaran" value="{{ old('tahun_ajaran', '2026/2027') }}" class="w-full rounded-xl border border-gray-300 px-4 py-2 text-sm">
                    @error('tahun_ajaran') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-6 flex gap-2">
                <button type="button" onclick="tutupModalJadwal()" class="flex-1 rounded-full border border-gray-300 py-2.5 text-sm font-bold hover:bg-gray-50">Batal</button>
                <button type="submit" class="flex-1 rounded-full bg-rose-600 py-2.5 text-sm font-bold text-white hover:bg-rose-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="modal-hapus-jadwal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">
    <div class="w-full max-w-sm rounded-3xl bg-white p-6 text-center shadow-xl">
        <h3 class="text-lg font-bold">Hapus jadwal?</h3>
        <p class="mt-1 text-sm text-gray-500">Jadwal <b id="nama-hapus-jadwal"></b> akan dihapus permanen.</p>
        <form id="form-hapus-jadwal" method="POST" action="" class="mt-6 flex gap-2">
            @csrf
            @method('DELETE')
            <button type="button" onclick="tutupModalJadwal()" class="flex-1 rounded-full border border-gray-300 py-2.5 text-sm font-bold hover:bg-gray-50">Batal</button>
            <button type="submit" class="flex-1 rounded-full bg-red-600 py-2.5 text-sm font-bold text-white hover:bg-red-700">Hapus</button>
        </form>
    </div>
</div>

<script>
    const kolomJadwal = ['id_kelas', 'id_mapel', 'id_guru', 'hari', 'jam_mulai', 'jam_selesai', 'ruang', 'semester', 'tahun_ajaran'];

    function tampilkanModalJadwal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.getElementById(id).classList.add('flex');
    }

    function tutupModalJadwal() {
        ['modal-jadwal', 'modal-hapus-jadwal'].forEach(function (id) {
            document.getElementById(id).classList.add('hidden');
            document.getElementById(id).classList.remove('flex');
        });
    }

    function isiFormJadwal(judul, url, method, mode, data) {
        document.getElementById('judul-modal-jadwal').innerText = judul;
        document.getElementById('form-jadwal').action = url;
        document.getElementById('jadwal-method').value = method;
        document.getElementById('jadwal-mode').value = mode;
        document.getElementById('jadwal-url-edit').value = (mode === 'edit') ? url : '';

        kolomJadwal.forEach(function (kolom) {
            document.getElementById('jadwal-' + kolom).value = data[kolom] ?? '';
        });

        tampilkanModalJadwal('modal-jadwal');
    }

    function bukaTambahJadwal() {
        isiFormJadwal('Tambah Jadwal', {{ Js::from(route('jadwal.store')) }}, 'POST', 'tambah', {
            semester: 'Ganjil',
            tahun_ajaran: '2026/2027',
        });
    }

    function bukaEditJadwal(url, data) {
        isiFormJadwal('Edit Jadwal', url, 'PUT', 'edit', data);
    }

    function bukaHapusJadwal(url, nama) {
        document.getElementById('form-hapus-jadwal').action = url;
        document.getElementById('nama-hapus-jadwal').innerText = nama;
        tampilkanModalJadwal('modal-hapus-jadwal');
    }

    @if ($errors->any())
        if ({{ Js::from(old('mode')) }} === 'edit') {
            document.getElementById('judul-modal-jadwal').innerText = 'Edit Jadwal';
            document.getElementById('form-jadwal').action = {{ Js::from(old('url_edit')) }};
            document.getElementById('jadwal-method').value = 'PUT';
        }
        tampilkanModalJadwal('modal-jadwal');
    @endif
</script>
