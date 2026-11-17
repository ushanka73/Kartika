@php
    $menu = [
        ['label' => 'Dashboard',  'href' => route('dashboard'), 'active' => request()->routeIs('dashboard')],
        ['label' => 'Jadwal',     'href' => '#', 'active' => false],
        ['label' => 'Materi',     'href' => '#', 'active' => false],
        ['label' => 'Nilai',      'href' => '#', 'active' => false],
        ['label' => 'Pengumuman', 'href' => '#', 'active' => false],
        ['label' => 'Keluhan',    'href' => '#', 'active' => false],
    ];
@endphp


<header class="sticky top-0 z-30 flex items-center justify-between bg-rose-600 px-5 py-3 text-white shadow-md lg:hidden">
    @include('partials.logo-kartika', ['class' => 'h-8 w-auto'])

    <button id="drawer-open" type="button" class="rounded-xl p-2 hover:bg-rose-700" aria-label="Buka menu" aria-expanded="false" aria-controls="mobile-drawer">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
    </button>
</header>

<aside class="sticky top-0 hidden h-screen shrink-0 flex-col bg-rose-600 p-4 text-white lg:flex">
    <div class="px-6 py-8">
        @include('partials.logo-kartika', ['class' => 'h-11 w-auto'])
    </div>

    @include('components.sidebar-menu')
</aside>

<div id="mobile-drawer" class="invisible fixed inset-0 z-40 md:hidden" aria-hidden="true">
    <div data-drawer-close data-drawer-overlay class="absolute inset-0 bg-black/50 opacity-0 transition-opacity duration-300"></div>

    <aside data-drawer-panel class="absolute inset-y-0 left-0 flex w-72 max-w-[80%] -translate-x-full flex-col bg-rose-600 p-4 text-white shadow-xl transition-transform duration-300 ease-out" role="dialog" aria-modal="true" aria-label="Menu navigasi">
        <div class="flex items-center justify-between px-4 py-5">
            @include('partials.logo-kartika', ['class' => 'h-8 w-auto'])

            <button data-drawer-close type="button" class="rounded-xl p-2 hover:bg-rose-700" aria-label="Tutup menu">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M6 6l12 12M18 6L6 18"/></svg>
            </button>
        </div>

        @include('components.sidebar-menu')
    </aside>
</div>

<script>
    (() => {
        const drawer = document.getElementById('mobile-drawer');
        const openBtn = document.getElementById('drawer-open');
        const overlay = drawer.querySelector('[data-drawer-overlay]');
        const panel = drawer.querySelector('[data-drawer-panel]');
        let hideTimer;

        const setOpen = (open) => {
            clearTimeout(hideTimer);
            if (open) drawer.classList.remove('invisible');
            requestAnimationFrame(() => {
                overlay.classList.toggle('opacity-0', !open);
                panel.classList.toggle('-translate-x-full', !open);
            });
            if (!open) hideTimer = setTimeout(() => drawer.classList.add('invisible'), 300);

            drawer.setAttribute('aria-hidden', String(!open));
            openBtn.setAttribute('aria-expanded', String(open));
            document.body.classList.toggle('overflow-hidden', open);
            (open ? panel.querySelector('[data-drawer-close]') : openBtn).focus();
        };

        openBtn.addEventListener('click', () => setOpen(true));
        drawer.querySelectorAll('[data-drawer-close]').forEach((el) => el.addEventListener('click', () => setOpen(false)));
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && openBtn.getAttribute('aria-expanded') === 'true') setOpen(false);
        });
        window.matchMedia('(min-width: 768px)').addEventListener('change', (e) => {
            if (e.matches && openBtn.getAttribute('aria-expanded') === 'true') setOpen(false);
        });
    })();
</script>
