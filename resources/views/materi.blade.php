@extends('layouts.beranda')

@section('title','Materi')

@section('materi')

<main class="flex-1">
    <div class="flex-1 p-3 md:p-6 min-h-screen">
        <div class="flex-1 p-3 md:p-6">
            @if (auth()->user()->role==='guru')
                @include('partials.materi-guru')
            @endif
                @include('partials.Materi-Pembelajaran')
        </div>
        <div class="flex-1 p-3 md:p-6">
            @include('partials.Semua-Materi')
       </div>
    </div>
    @include('components.footer')
</main>
@endsection

