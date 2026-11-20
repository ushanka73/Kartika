@extends('layouts.beranda')

@section('title','Materi')

@section('materi')

<main class="flex-1">
    <div class="flex-1 p-3 md:p-6 min-h-screen">
        <header class="relative overflow-hidden p-10 shadow-md rounded-2xl bg-rose-600 min-h-60 flex flex-col justify-end text-white">
            <div class="pointer-events-none absolute -right-20 -top-2 hidden h-[22rem] w-[22rem] md:block xl:right-32" aria-hidden="true">
                <div class="absolute left-[55%] top-[35%] h-[26rem] w-[26rem] -translate-x-1/2 -translate-y-1/2 rounded-full bg-white/10"></div>
                <div class="absolute left-[55%] top-[35%] h-[17rem] w-[17rem] -translate-x-1/2 -translate-y-1/2 rounded-full bg-white/10"></div>
                @include('partials.bendera-merah-putih', ['class' => 'relative h-full w-full'])
            </div>

            <div class="relative z-10 lg:max-w-[60%]">
                <h1 class="text-[2rem] font-bold">Selamat datang, <span>{Guru}!</span></h1>
                <p class="text-[1rem]">Mata Pelajaran {} </p>
            </div>
        </header>
        <div class="flex-1 p-3 md:p-6">
            @include('components.Materi-Pembelajaran')
        </div>
        <div class="flex-1 p-3 md:p-6">
            @include('components.Semua-Materi')




        </div>
    </div>
    @include('components.footer')
</main>
@endsection

