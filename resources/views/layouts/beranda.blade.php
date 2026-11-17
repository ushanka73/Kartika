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

    <div class="min-h-screen lg:flex">
        @include('components.sidebar')
        <div class="flex flex-col flex-1 min-w-0">
            <main class="flex flex-col">
                @yield('dashboard')
                @yield('profile')
            </main>
        </div>
    </div>
</body>
</html>
