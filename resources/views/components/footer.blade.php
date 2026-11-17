<footer class="bg-rose-100/30 p-10 border-2">
    <div class="max-w-6xl mx-auto px-4 text-center">
        <div class="flex justify-center items-center gap-2 mb-4">
            @include('partials.logo-kartika-red', ['class' => 'h-4 w-auto md:h-7'])
        </div>
        <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">
            Sistem Kelola Akademik & Rekap Terpadu Informasi Kesiswaan.
        </p>
        <p class="text-gray-500 dark:text-gray-500 text-xs">
            &copy; {{ date('Y') }} Kartika. All rights reserved.
        </p>
    </div>
</footer>
