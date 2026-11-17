<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Beranda</title>
</head>
<body>
    <div class="flex min-h-screen">
        @include('components.sidebar')
        <div class="flex flex-col flex-1">
            <main class="flex flex-col">
                @yield('dashboard')
                @yield('profile')
                {{-- @yield('pengelolaan') --}}


            </main>
        </div>
    </div>
    <script>
        const toggle = document.getElementById('menu-toggle');
        const menu = document.getElementById('menu');
        toggle.addEventListener('click', () => {
            const open = menu.classList.toggle('hidden') === false;
            toggle.setAttribute('aria-expanded', open);
        });
    </script>
</body>
</html>
