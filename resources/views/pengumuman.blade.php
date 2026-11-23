@extends('layouts.beranda')

@section('title', 'Pengumuman')

@section('pengumuman')

<main>
    <div class="flex flex-col md:grid-cols-2 p-3 gap-6 md:p-6 min-h-screen">
        <div>
            <form action="{{ route('pengumuman.store') }}" method="POST" class="mx-auto p-6 bg-white rounded-xl shadow-sm border border-gray-200 space-y-3">
                @csrf
                <h2 class="text-xl font-semibold text-gray-800 border-gray-100">Buat Pengumuman Baru</h2>
                <hr>
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">
                        Judul
                    </label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}" placeholder="Masukkan judul pengumuman" required
                        class="w-full px-3.5 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    @error('judul')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="isi" class="block text-sm font-medium text-gray-700 mb-1">
                        Isi Pengumuman
                    </label>
                    <textarea id="isi" name="isi" rows="5" placeholder="Tuliskan isi pengumuman..." required
                        class="w-full px-3.5 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">{{ old('isi') }}</textarea>
                    @error('isi')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tanggal_posting" class="block text-sm font-medium text-gray-700 mb-1">
                        Tanggal Posting
                    </label>
                    <input type="datetime-local" id="tanggal_posting" name="tanggal_posting" value="{{ old('tanggal_posting', now()->format('Y-m-d\TH:i')) }}"
                        class="w-full px-3.5 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    @error('tanggal_posting')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tanggal_kadaluarsa" class="block text-sm font-medium text-gray-700 mb-1">
                        Tanggal Kadaluarsa
                    </label>
                    <input type="datetime-local" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" value="{{ old('tanggal_kadaluarsa') }}"
                        class="w-full px-3.5 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    @error('tanggal_kadaluarsa')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2 flex items-center justify-end gap-3">
                    <a href="{{ url()->previous() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        Kembali
                    </a>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
        <div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs font-semibold text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-3.5 w-12">No</th>
                                <th scope="col" class="px-6 py-3.5">Judul</th>
                                <th scope="col" class="px-6 py-3.5">Isi</th>
                                <th scope="col" class="px-6 py-3.5">Pembuat</th>
                                <th scope="col" class="px-6 py-3.5">Tanggal Posting</th>
                                <th scope="col" class="px-6 py-3.5">Kadaluarsa</th>
                                <th scope="col" class="px-6 py-3.5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($pengumumen as $item)
                                <tr class="hover:bg-gray-50/80 transition">
                                    <td class="px-6 py-4 text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 max-w-xs">
                                        <div class="text-gray-900 truncate">{{ $item->judul }}</div>
                                    </td>
                                    <td class="px-6 py-4 max-w-xs">
                                        <p class="text-gray-500 truncate mt-0.5">{{ Str::limit($item->isi, 60) }}</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $item->user->name ?? 'User #' . $item->id_user }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                        {{ \Carbon\Carbon::parse($item->tanggal_posting)->format('H:i, d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($item->tanggal_kadaluarsa)
                                            @if (\Carbon\Carbon::parse($item->tanggal_kadaluarsa)->isPast())
                                                <span class="inline-flex items-center">
                                                    Kadaluarsa ({{ \Carbon\Carbon::parse($item->tanggal_kadaluarsa)->format('d M Y') }})
                                                </span>
                                            @else
                                                <span class="inline-flex items-center">
                                                    {{ \Carbon\Carbon::parse($item->tanggal_kadaluarsa)->format('H:i, d M Y') }}
                                                </span>
                                            @endif
                                        @else
                                            <span class="text-xs text-gray-400">Selamanya</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="inline-flex items-center gap-2">
                                            <button type="button"
                                                onclick="openEditModal(this)"
                                                data-url="{{ route('pengumuman.update', $item->id_pengumuman) }}"
                                                data-judul="{{ $item->judul }}"
                                                data-isi="{{ $item->isi }}"
                                                data-posting="{{ \Carbon\Carbon::parse($item->tanggal_posting)->format('Y-m-d') }}"
                                                data-kadaluarsa="{{ \Carbon\Carbon::parse($item->tanggal_kadaluarsa)->format('Y-m-d') }}"
                                                class="px-2.5 py-1.5 text-xs font-medium text-white bg-amber-500 rounded-md hover:bg-amber-600 transition cursor-pointer">
                                                Edit
                                            </button>
                                            <button type="button"
                                                onclick="openDeleteModal(this)"
                                                data-url="{{ route('pengumuman.destroy', $item->id_pengumuman) }}"
                                                data-judul="{{ $item->judul }}"
                                                class="px-2.5 py-1.5 text-xs font-medium text-white bg-rose-600 rounded-md hover:bg-rose-700 transition cursor-pointer">
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-gray-400">
                                        Belum ada data pengumuman.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="editModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">
            <div class="w-full max-w-lg rounded-xl bg-white p-6 shadow-2xl">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-xl font-bold">Edit Pengumuman</h2>
                    <button type="button" onclick="closeEditModal()" class="text-2xl leading-none text-gray-400 hover:text-gray-600">×</button>
                </div>

                <form id="editForm" action="" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="mb-1 block text-sm font-bold">Judul</label>
                        <input type="text" id="edit_judul" name="judul" required
                            class="w-full rounded-xl border border-gray-300 px-3.5 py-2.5 focus:border-teal-600 focus:outline-none">
                    </div>

                    <div class="mb-4">
                        <label class="mb-1 block text-sm font-bold">Isi</label>
                        <textarea id="edit_isi" name="isi" rows="4" required
                            class="w-full rounded-xl border border-gray-300 px-3.5 py-2.5 focus:border-teal-600 focus:outline-none"></textarea>
                    </div>

                    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="mb-1 block text-sm font-bold">Tanggal Posting</label>
                            <input type="date" id="edit_tanggal_posting" name="tanggal_posting" required
                                class="w-full rounded-xl border border-gray-300 px-3.5 py-2.5 focus:border-teal-600 focus:outline-none">
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-bold">Tanggal Kadaluarsa</label>
                            <input type="date" id="edit_tanggal_kadaluarsa" name="tanggal_kadaluarsa" required
                                class="w-full rounded-xl border border-gray-300 px-3.5 py-2.5 focus:border-teal-600 focus:outline-none">
                        </div>
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeEditModal()"
                            class="rounded-md border border-gray-300 px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-100">
                            Batal
                        </button>
                        <button type="submit"
                            class="rounded-md bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">
            <div class="w-full max-w-md rounded-xl bg-white p-6 shadow-2xl">
                <h2 class="text-lg font-bold text-gray-900 mb-2">Hapus Pengumuman?</h2>
                <h2 id="delete_judul" class="font-semibold text-gray-900"></h2>
                <p class="text-sm text-gray-600 mt-2">
                    Pengumuman akan dihapus permanen.
                </p>

                <form id="deleteForm" action="" method="POST" class="mt-6 flex justify-end gap-2">
                    @csrf
                    @method('DELETE')

                    <button type="button" onclick="closeDeleteModal()"
                        class="rounded-md border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-100 cursor-pointer">
                        Batal
                    </button>
                    <button type="submit"
                        class="rounded-md bg-rose-600 px-4 py-2 text-sm font-semibold text-white hover:bg-rose-700 cursor-pointer">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
    @include('components.footer')
</main>
<script>
    const editModal = document.getElementById('editModal');
    const editForm = document.getElementById('editForm');

    function openEditModal(button) {
        editForm.action = button.dataset.url;

        document.getElementById('edit_judul').value = button.dataset.judul;
        document.getElementById('edit_isi').value = button.dataset.isi;
        document.getElementById('edit_tanggal_posting').value = button.dataset.posting;
        document.getElementById('edit_tanggal_kadaluarsa').value = button.dataset.kadaluarsa;

        editModal.classList.remove('hidden');
        editModal.classList.add('flex');
    }

    function closeEditModal() {
        editModal.classList.add('hidden');
        editModal.classList.remove('flex');
    }

    const deleteModal = document.getElementById('deleteModal');
    const deleteForm = document.getElementById('deleteForm');

    function openDeleteModal(button) {
        deleteForm.action = button.dataset.url;
        document.getElementById('delete_judul').textContent = `"${button.dataset.judul}"`;

        deleteModal.classList.remove('hidden');
        deleteModal.classList.add('flex');
    }

    function closeDeleteModal() {
        deleteModal.classList.add('hidden');
        deleteModal.classList.remove('flex');
    }
</script>
@endsection
