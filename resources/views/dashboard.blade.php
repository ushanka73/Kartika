<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Dashboard</title>
</head>
<body class="bg-rose-300 text-gray-800">
    <div class="min-h-screen md:flex">

        {{-- Sidebar: di mobile jadi bar atas, menu muncul lewat tombol --}}
        <aside class="bg-rose-600 text-white md:fixed md:inset-y-0 md:left-0 md:w-64 md:rounded-r-3xl md:shadow-2xl">
            <div class="flex items-center justify-between px-6 py-5 md:py-8">
                @include('partials.logo-kartika', ['class' => 'h-9 w-auto md:h-11'])

                <button id="menu-toggle" class="rounded-xl p-2 hover:bg-rose-700 md:hidden" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="menu">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>

            <nav id="menu" class="hidden px-4 pb-6 md:block">
                <ul class="space-y-1 font-bold">
                    <li><a href="{{ route('dashboard') }}" class="block rounded-xl bg-white px-4 py-3 text-rose-600" aria-current="page">Dashboard</a></li>
                    <li><a href="#" class="block rounded-xl px-4 py-3 transition-colors duration-150 hover:bg-rose-700">Jadwal</a></li>
                    <li><a href="#" class="block rounded-xl px-4 py-3 transition-colors duration-150 hover:bg-rose-700">Materi</a></li>
                    <li><a href="#" class="block rounded-xl px-4 py-3 transition-colors duration-150 hover:bg-rose-700">Nilai</a></li>
                    <li><a href="#" class="block rounded-xl px-4 py-3 transition-colors duration-150 hover:bg-rose-700">Pengumuman</a></li>
                    <li><a href="#" class="block rounded-xl px-4 py-3 transition-colors duration-150 hover:bg-rose-700">Keluhan</a></li>
                </ul>
                <a href="{{ route('login') }}" class="mt-6 block rounded-xl border border-white/40 px-4 py-3 text-center font-bold transition-colors duration-150 hover:bg-rose-700">Keluar</a>
            </nav>
        </aside>

        <main class="flex-1 p-6 md:ml-64 md:p-10">
            <header class="mb-8">
                <h1 class="text-[1.6rem] font-bold">Selamat datang, <span class="text-rose-600">Admin!</span></h1>
                <p class="text-[.95rem] text-gray-500">Ringkasan kegiatan sekolah semester Ganjil 2026/2027</p>
            </header>

            {{-- Kartu ringkasan (masih data contoh) --}}
            <section class="mb-8 grid grid-cols-2 gap-4 lg:grid-cols-4">
                <div class="rounded-3xl bg-white p-6 shadow-sm">
                    <p class="text-sm font-bold text-gray-500">Siswa</p>
                    <p class="mt-2 text-3xl font-bold text-rose-600">6</p>
                </div>
                <div class="rounded-3xl bg-white p-6 shadow-sm">
                    <p class="text-sm font-bold text-gray-500">Guru</p>
                    <p class="mt-2 text-3xl font-bold text-rose-600">3</p>
                </div>
                <div class="rounded-3xl bg-white p-6 shadow-sm">
                    <p class="text-sm font-bold text-gray-500">Kelas</p>
                    <p class="mt-2 text-3xl font-bold text-rose-600">3</p>
                </div>
                <div class="rounded-3xl bg-white p-6 shadow-sm">
                    <p class="text-sm font-bold text-gray-500">Keluhan menunggu</p>
                    <p class="mt-2 text-3xl font-bold text-rose-600">1</p>
                </div>
            </section>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                <section class="min-w-0 rounded-3xl bg-white p-6 shadow-sm lg:col-span-2">
                    <h2 class="mb-4 text-lg font-bold">Jadwal hari ini</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead>
                                <tr class="border-b text-gray-500">
                                    <th class="py-3 pr-4 font-bold">Jam</th>
                                    <th class="py-3 pr-4 font-bold">Mata pelajaran</th>
                                    <th class="py-3 pr-4 font-bold">Kelas</th>
                                    <th class="py-3 font-bold">Ruang</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b">
                                    <td class="py-3 pr-4 whitespace-nowrap">07:00 – 08:30</td>
                                    <td class="py-3 pr-4">Matematika</td>
                                    <td class="py-3 pr-4">X IPA</td>
                                    <td class="py-3">R-101</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-3 pr-4 whitespace-nowrap">08:30 – 10:00</td>
                                    <td class="py-3 pr-4">Matematika</td>
                                    <td class="py-3 pr-4">XI IPS</td>
                                    <td class="py-3">R-201</td>
                                </tr>
                                <tr>
                                    <td class="py-3 pr-4 whitespace-nowrap">10:15 – 11:45</td>
                                    <td class="py-3 pr-4">Fisika</td>
                                    <td class="py-3 pr-4">X IPA</td>
                                    <td class="py-3">Lab Fisika</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="rounded-3xl bg-white p-6 shadow-sm">
                    <h2 class="mb-4 text-lg font-bold">Pengumuman</h2>
                    <ul class="space-y-4">
                        <li class="border-l-4 border-rose-600 pl-3">
                            <p class="font-bold">Jadwal Penilaian Tengah Semester</p>
                            <p class="text-sm text-gray-500">PTS Ganjil dilaksanakan minggu ketiga Oktober.</p>
                        </li>
                        <li class="border-l-4 border-rose-600 pl-3">
                            <p class="font-bold">Pengumpulan Tugas Matematika</p>
                            <p class="text-sm text-gray-500">Tugas bab 1 dikumpulkan paling lambat Jumat.</p>
                        </li>
                        <li class="border-l-4 border-rose-200 pl-3">
                            <p class="font-bold">Libur Nasional</p>
                            <p class="text-sm text-gray-500">KBM diliburkan sesuai kalender akademik.</p>
                        </li>
                    </ul>
                </section>
            </div>
        </main>
    </div>

    <script>
        // Menu mobile
        const toggle = document.getElementById('menu-toggle');
        const menu = document.getElementById('menu');
        toggle.addEventListener('click', () => {
            const open = menu.classList.toggle('hidden') === false;
            toggle.setAttribute('aria-expanded', open);
        });
    </script>
</body>
</html>
