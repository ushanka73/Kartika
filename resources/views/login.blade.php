<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>
<body class="overflow-x-hidden bg-red-50">
    <div class="min-h-screen flex items-center justify-center p-6 ">
        <div class="w-full max-w-[400px] md:max-w-[700px] rounded-3xl bg-rose-600 flex justify-between shadow-2xl">
            <div class="p-8 hidden md:flex flex-1 flex-col items-center justify-center gap-6">
                @include('partials.logo-tutwuri', ['class' => 'h-40 w-auto', 'color' => '#fff', 'opacity' => 1, 'dot' => 16])
                @include('partials.logo-kartika', ['class' => 'h-12 w-auto'])
            </div>
            <div class="w-full md:w-[400px] rounded-3xl bg-white px-[34px] pt-9 pb-10">
                <h1 class="mb-1 text-[1.4rem] font-bold">Welcome <span class="text-rose-600">back!</span></h1>
                <p class="mb-6 text-[.9rem]">Login untuk melanjutkan</p>
                <form action="#" method="post">
                    @csrf
                    <label class="mb-1.5 block text-md font-bold">Username</label>
                    <input class="mb-4 block w-full rounded-xl border bg-white px-3.5 py-3 transition-[border-color,box-shadow] duration-150 placeholder:text-gray-400 focus:border-rose-600 focus:shadow-[0_0_0_3px_rgba(225,29,72,.22)] focus:outline-none motion-reduce:transition-none" type="text" id="tb-li-email" name="username" placeholder="Username" autocomplete="username" required>

                    <label class="mb-1.5 block text-md font-bold">Password</label>
                    <input class="mb-4 block w-full rounded-xl border bg-white px-3.5 py-3 transition-[border-color,box-shadow] duration-150 placeholder:text-gray-400 focus:border-rose-600 focus:shadow-[0_0_0_3px_rgba(225,29,72,.22)] focus:outline-none motion-reduce:transition-none" type="password" id="tb-li-password" name="password" autocomplete="current-password" required>

                    <button class="mt-1 w-full rounded-xl bg-rose-600 p-4 text-md font-bold text-white transition-colors duration-150 hover:bg-rose-700" type="submit">Masuk</button>
                </form>
            </div>

        </div>
    </div>
</body>
</html>
