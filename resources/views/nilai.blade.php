@extends('layouts.beranda')

@section('title','Nilai')

@section('nilai')
<main class="flex-1">
    <div class="flex-1 p-3 md:p-6 min-h-screen">
        @if ($peran === 'guru')
            @include('partials.nilai-guru')
        @else
            @include('partials.nilai-smester')
            @include('partials.nilai-permapel')
        @endif
    </div>
    @include('components.footer')
</main>
@endsection
