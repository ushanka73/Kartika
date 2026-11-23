@extends('layouts.beranda')

@section('title', 'Profil')

@section('profile')
@php
    $nama = $profile->nama_lengkap ?: $user->username;

    $inisial = \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($nama, 0, 1));

    $peran = ['admin' => 'Administrator', 'guru' => 'Guru', 'siswa' => 'Siswa'][$user->role] ?? ucfirst($user->role);

    $status = $user->status === 'active' ? 'Aktif' : 'Nonaktif';

    $tanggalLahir = filled($profile->tanggal_lahir ?? null) ? \Illuminate\Support\Carbon::parse($profile->tanggal_lahir)->format('d-m-Y'): null;

    $detailProfil = match ($user->role) {
        'admin' => [
            ['label' => 'Jenis kelamin', 'value' => $profile->jenis_kelamin],
            ['label' => 'Email', 'value' => $profile->email],
            ['label' => 'Nomor telepon', 'value' => $profile->no_telepon],
        ],

        'guru' => [
            ['label' => 'NIP', 'value' => $profile->nip],
            ['label' => 'Jenis kelamin', 'value' => $profile->jenis_kelamin],
            ['label' => 'Tempat lahir', 'value' => $profile->tempat_lahir],
            ['label' => 'Tanggal lahir', 'value' => $tanggalLahir],
            ['label' => 'Pendidikan terakhir', 'value' => $profile->pendidikan_terakhir],
            ['label' => 'Email', 'value' => $profile->email],
            ['label' => 'Nomor telepon', 'value' => $profile->no_telepon],
            ['label' => 'Alamat', 'value' => $profile->alamat],
        ],

        'siswa' => [
            ['label' => 'NISN', 'value' => $profile->nisn],
            ['label' => 'Jenis kelamin', 'value' => $profile->jenis_kelamin],
            ['label' => 'Tempat lahir', 'value' => $profile->tempat_lahir],
            ['label' => 'Tanggal lahir', 'value' => $tanggalLahir],
            [
                'label' => 'Kelas',
                'value' => $profile->kelas
                    ? $profile->kelas->tingkat . ' ' . $profile->kelas->jurusan
                    : null,
            ],
            ['label' => 'Tahun ajaran', 'value' => $profile->tahun_ajaran],
            ['label' => 'Email', 'value' => $profile->email],
            ['label' => 'Nomor telepon', 'value' => $profile->no_telepon],
            ['label' => 'Alamat', 'value' => $profile->alamat],
        ],

        default => [],
    };
@endphp

<main class="flex-1">
    <div class="flex-1 p-3 md:p-6 min-h-screen">
        <section class="rounded-2xl bg-rose-600 p-10 text-white shadow-md md:p-8">
            <p class="mb-5 text-sm font-semibold uppercase tracking-wider text-rose-100">
                Akun saya
            </p>

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                <div class="flex h-20 w-20 shrink-0 items-center justify-center rounded-full bg-white text-2xl font-bold text-rose-600">
                    {{ $inisial }}
                </div>

                <div class="min-w-0 flex-1">
                    <h1 class="text-2xl font-bold md:text-3xl">{{ $nama }}</h1>
                    <p class="mt-1 text-rose-100">
                        {{ $peran }} &middot; {{ '@' . $user->username }}
                    </p>
                </div>

                <span>
                    <form action="{{ route('logout') }}" method="POST" class="mt-2">
                    @csrf
                        <button type="submit"
                            class="block w-full rounded-full border bg-white px-4 py-4 text-rose-600 text-center font-bold hover:bg-rose-50">
                            Logout
                        </button>
                    </form>
                </span>
            </div>
        </section>

        <section class="mt-6 rounded-2xl bg-white shadow-sm">
            <h2 class="font-bold text-[1.6rem] m-4">Informasi akun</h2>

            <dl class="grid grid-cols-2 gap-4 lg:grid-cols-3">
                <div class="rounded-2xl bg-rose-50 p-6 shadow-md outline outline-1 outline-red-500 hover:outline-0">
                    <dt class="text-xl font-bold text-gray-800">Username</dt>
                    <dd class="mt-1 break-words font-semibold text-gray-600">
                        {{ $user->username }}
                    </dd>
                </div>

                <div class="rounded-2xl bg-rose-50 p-6 shadow-md outline outline-1 outline-red-500 hover:outline-0">
                    <dt class="text-xl font-bold text-gray-800">Role</dt>
                    <dd class="mt-1 font-semibold text-gray-600">{{ $peran }}</dd>
                </div>

                <div class="rounded-2xl bg-rose-50 p-6 shadow-md outline outline-1 outline-red-500 hover:outline-0">
                    <dt class="text-xl font-bold text-gray-800">Status akun</dt>
                    <dd class="mt-1 font-semibold text-gray-600">{{ $status }}</dd>
                </div>
            </dl>
        </section>

        <section class="mt-6 rounded-2xl bg-white shadow-sm">
            <h2 class="font-bold text-[1.6rem] m-4">Informasi profil</h2>

            <dl class="mt-4 grid gap-4 sm:grid-cols-2">
                @foreach ($detailProfil as $item)
                    <div class="rounded-2xl bg-rose-50 p-6 shadow-md outline outline-1 outline-red-500 hover:outline-0">
                        <dt class="text-xl font-bold text-gray-800">{{ $item['label'] }}</dt>
                        <dd class="mt-1 font-semibold text-gray-600">
                            {{ filled($item['value']) ? $item['value'] : 'Belum diisi' }}
                        </dd>
                    </div>
                @endforeach
            </dl>
        </section>
    </div>

    @include('components.footer')
</main>
@endsection
