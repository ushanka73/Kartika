        <header class="relative overflow-hidden p-10 rounded-2xl bg-rose-600 min-h-60  text-white shadow-md flex flex-col justify-end">
            <div class="pointer-events-none absolute -right-20 -top-2 hidden h-[22rem] w-[22rem] md:block xl:right-32" aria-hidden="true">
                <div class="absolute left-[55%] top-[35%] h-[26rem] w-[26rem] -translate-x-1/2 -translate-y-1/2 rounded-full bg-white/10"></div>
                <div class="absolute left-[55%] top-[35%] h-[17rem] w-[17rem] -translate-x-1/2 -translate-y-1/2 rounded-full bg-white/10"></div>
                @include('partials.bendera-merah-putih', ['class' => 'relative h-full w-full'])
            </div>
            <img src="#" alt="Foto profil"
            class="relative mb-3 h-20 w-20 md:h-28 md:w-28 rounded-full object-cover ring-4 ring-white">
            <h1 class="relative text-2xl md:text-[2rem] font-bold">{User}</h1>
            <p class="relative text-sm md:text-base opacity-90">{Kelas} · {Semester} </p>
        </header>
