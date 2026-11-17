<aside class="bg-rose-600 p-4 text-white flex flex-col sticky top-0 h-screen">
    <div class="flex items-center justify-between px-6 py-5 md:py-8">
        @include('partials.logo-kartika', ['class' => 'h-9 w-auto md:h-11'])

        <button id="menu-toggle" class="rounded-xl p-2 hover:bg-rose-700 md:hidden" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="menu">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
    </div>

    <nav id="menu" class="px-4 pb-6 flex-1 flex flex-col justify-between">
        <ul class="space-y-1 font-bold">
            <li><a href="{{ route('dashboard') }}" class="block rounded-full bg-white px-4 py-4 text-rose-600" aria-current="page">Dashboard</a></li>
            <li><a href="#" class="block rounded-full px-4 py-4 transition-colors duration-150 hover:bg-rose-700">Jadwal</a></li>
            <li><a href="#" class="block rounded-full px-4 py-4 transition-colors duration-150 hover:bg-rose-700">Materi</a></li>
            <li><a href="#" class="block rounded-full px-4 py-4 transition-colors duration-150 hover:bg-rose-700">Nilai</a></li>
            <li><a href="#" class="block rounded-full px-4 py-4 transition-colors duration-150 hover:bg-rose-700">Pengumuman</a></li>
            <li><a href="#" class="block rounded-full px-4 py-4 transition-colors duration-150 hover:bg-rose-700">Keluhan</a></li>
        </ul>
        <a href="{{ route('profile') }}" class="mt-6 block rounded-full border border-white/40 px-4 py-4 text-center font-bold transition-colors duration-150 hover:bg-rose-700">Profile</a>
    </nav>
</aside>
