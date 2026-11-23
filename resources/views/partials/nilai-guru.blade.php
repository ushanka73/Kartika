<section class="mt-6">
    @if (session('sukses'))
        <div class="mb-4 rounded-2xl bg-green-100 px-4 py-3 text-sm font-bold text-green-700">
            {{ session('sukses') }}
        </div>
    @endif

    <div class="mb-4 flex flex-wrap items-center justify-between gap-3 px-1">
        <div>
            <h2 class="text-[1.6rem] font-bold">Kelola Nilai</h2>
        </div>

        <button type="button" onclick="bukaTambah()"
                class="rounded-full bg-rose-600 px-5 py-2 text-sm font-bold text-white shadow-md hover:bg-rose-700">
            + Tambah nilai
        </button>
    </div>
    @include('partials.nilai-smester')

    <div class="overflow-x-auto rounded-3xl bg-white p-6 shadow-md">
        <table class="w-full text-left text-sm">
            <thead>
                <tr class="border-b text-gray-500">
                    <th class="py-3 pr-4 font-bold">No</th>
                    <th class="py-3 pr-4 font-bold">Nama</th>
                    <th class="py-3 pr-4 font-bold">Kelas</th>
                    <th class="py-3 pr-4 font-bold">Mapel</th>
                    <th class="py-3 pr-4 text-center font-bold">Nilai</th>
                    <th class="py-3 text-center font-bold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($nilaiList as $n)
                    <tr @class(['border-b' => ! $loop->last])>
                        <td class="py-3 pr-4 text-gray-400">{{ $loop->iteration }}</td>
                        <td class="py-3 pr-4 font-bold">{{ $n->siswa->nama_lengkap }}</td>
                        <td class="py-3 pr-4">{{ $n->kelas->tingkat }} {{ $n->kelas->jurusan }}</td>
                        <td class="py-3 pr-4">{{ $n->mataPelajaran->nama_mapel }}</td>
                        <td @class(['py-3 pr-4 text-center font-bold', 'text-red-600' => $n->nilai_akhir < $n->mataPelajaran->kkm])>
                            {{ $n->nilai_akhir }}
                        </td>
                        <td class="py-3">
                            <div class="flex justify-center gap-2">
                                <button type="button"
                                        onclick="bukaEdit('{{ route('guru.nilai.update', $n) }}', '{{ $n->id_siswa }}', '{{ $n->id_mapel }}', '{{ $n->semester }}', '{{ $n->tahun_ajaran }}', '{{ $n->nilai_akhir }}')"
                                        class="rounded-full bg-rose-500 border border-rose-300 px-3 py-1 text-xs font-bold text-white hover:bg-amber-50 hover:text-rose-500    ">
                                    Edit
                                </button>
                                <button type="button"
                                        onclick="bukaHapus('{{ route('guru.nilai.destroy', $n) }}', '{{ $n->siswa->nama_lengkap }}')"
                                        class="rounded-full border border-red-300 px-3 py-1 text-xs font-bold text-red-600 hover:bg-red-50">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-gray-400">Belum ada nilai</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

<div id="modal-nilai" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">
    <div class="w-full max-w-lg rounded-3xl bg-white p-6 shadow-xl">

        <h3 id="judul-modal" class="mb-4 text-xl font-bold">Tambah Nilai</h3>

        <form id="form-nilai" method="POST" action="{{ route('guru.nilai.store') }}">
            @csrf

            <input type="hidden" name="_method" id="input-method" value="POST">
            <input type="hidden" name="mode" id="input-mode" value="{{ old('mode', 'tambah') }}">
            <input type="hidden" name="url_edit" id="input-url-edit" value="{{ old('url_edit') }}">

            <label class="mb-1 block text-sm font-bold">Siswa</label>
            <select name="id_siswa" id="input-siswa"
                    class="w-full rounded-xl border border-gray-300 px-4 py-2 text-sm focus:border-rose-500 focus:outline-none">
                <option value="">-- Pilih siswa --</option>
                @foreach ($siswaList as $s)
                    <option value="{{ $s->id_siswa }}" @selected(old('id_siswa') == $s->id_siswa)>
                        {{ $s->nama_lengkap }} ({{ $s->tingkat }} {{ $s->jurusan }})
                    </option>
                @endforeach
            </select>
            @error('id_siswa') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror

            <label class="mt-4 mb-1 block text-sm font-bold">Mata pelajaran</label>
            <select name="id_mapel" id="input-mapel"
                    class="w-full rounded-xl border border-gray-300 px-4 py-2 text-sm focus:border-rose-500 focus:outline-none">
                <option value="">-- Pilih mata pelajaran --</option>
                @foreach ($mapelList as $m)
                    <option value="{{ $m->id_mapel }}" @selected(old('id_mapel') == $m->id_mapel)>
                        {{ $m->nama_mapel }} (KKM {{ $m->kkm }})
                    </option>
                @endforeach
            </select>
            @error('id_mapel') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror

            <div class="mt-4 grid grid-cols-2 gap-3">
                <div>
                    <label class="mb-1 block text-sm font-bold">Semester</label>
                    <select name="semester" id="input-semester"
                            class="w-full rounded-xl border border-gray-300 px-4 py-2 text-sm focus:border-rose-500 focus:outline-none">
                        <option value="Ganjil" @selected(old('semester', 'Ganjil') === 'Ganjil')>Ganjil</option>
                        <option value="Genap" @selected(old('semester') === 'Genap')>Genap</option>
                    </select>
                </div>
                <div>
                    <label class="mb-1 block text-sm font-bold">Tahun ajaran</label>
                    <input type="text" name="tahun_ajaran" id="input-tahun" value="{{ old('tahun_ajaran', '2026/2027') }}"
                           class="w-full rounded-xl border border-gray-300 px-4 py-2 text-sm focus:border-rose-500 focus:outline-none">
                    @error('tahun_ajaran') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <label class="mt-4 mb-1 block text-sm font-bold">Nilai akhir</label>
            <input type="number" name="nilai_akhir" id="input-nilai" min="0" max="100" value="{{ old('nilai_akhir') }}" placeholder="0–100"
                   class="w-full rounded-xl border border-gray-300 px-4 py-2 text-sm focus:border-rose-500 focus:outline-none">
            @error('nilai_akhir') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror

            <div class="mt-6 flex gap-2">
                <button type="button" onclick="tutupSemua()"
                        class="flex-1 rounded-full border border-gray-300 py-2.5 text-sm font-bold hover:bg-gray-50">Batal</button>
                <button type="submit"
                        class="flex-1 rounded-full bg-rose-600 py-2.5 text-sm font-bold text-white hover:bg-rose-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="modal-hapus" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">
    <div class="w-full max-w-sm rounded-3xl bg-white p-6 text-center shadow-xl">
        <h3 class="text-lg font-bold">Hapus nilai?</h3>
        <p class="mt-1 text-sm text-gray-500">Nilai milik <b id="nama-hapus"></b> akan dihapus permanen.</p>

        <form id="form-hapus" method="POST" action="" class="mt-6 flex gap-2">
            @csrf
            @method('DELETE')
            <button type="button" onclick="tutupSemua()"
                    class="flex-1 rounded-full border border-gray-300 py-2.5 text-sm font-bold hover:bg-gray-50">Batal</button>
            <button type="submit"
                    class="flex-1 rounded-full bg-red-600 py-2.5 text-sm font-bold text-white hover:bg-red-700">Hapus</button>
        </form>
    </div>
</div>


<script>
    function tampilkan(idModal) {
        document.getElementById(idModal).classList.remove('hidden');
        document.getElementById(idModal).classList.add('flex');
    }

    function tutupSemua() {
        document.getElementById('modal-nilai').classList.add('hidden');
        document.getElementById('modal-hapus').classList.add('hidden');
    }

    function bukaTambah() {
        document.getElementById('judul-modal').innerText  = 'Tambah Nilai';
        document.getElementById('form-nilai').action      = '{{ route('guru.nilai.store') }}';
        document.getElementById('input-method').value     = 'POST';
        document.getElementById('input-mode').value       = 'tambah';
        document.getElementById('input-url-edit').value   = '';

        document.getElementById('input-siswa').value      = '';
        document.getElementById('input-mapel').value      = '';
        document.getElementById('input-semester').value   = 'Ganjil';
        document.getElementById('input-tahun').value      = '2026/2027';
        document.getElementById('input-nilai').value      = '';

        tampilkan('modal-nilai');
    }

    function bukaEdit(url, idSiswa, idMapel, semester, tahun, nilai) {
        document.getElementById('judul-modal').innerText  = 'Edit Nilai';
        document.getElementById('form-nilai').action      = url;
        document.getElementById('input-method').value     = 'PUT';
        document.getElementById('input-mode').value       = 'edit';
        document.getElementById('input-url-edit').value   = url;

        document.getElementById('input-siswa').value      = idSiswa;
        document.getElementById('input-mapel').value      = idMapel;
        document.getElementById('input-semester').value   = semester;
        document.getElementById('input-tahun').value      = tahun;
        document.getElementById('input-nilai').value      = nilai;

        tampilkan('modal-nilai');
    }

    function bukaHapus(url, nama) {
        document.getElementById('form-hapus').action      = url;
        document.getElementById('nama-hapus').innerText   = nama;
        tampilkan('modal-hapus');
    }

    @if ($errors->any())
        if ('{{ old('mode') }}' === 'edit') {
            document.getElementById('judul-modal').innerText = 'Edit Nilai';
            document.getElementById('form-nilai').action     = '{{ old('url_edit') }}';
            document.getElementById('input-method').value    = 'PUT';
        }
        tampilkan('modal-nilai');
    @endif
</script>
