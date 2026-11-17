
<nav class="px-4 pb-6 flex-1 flex flex-col justify-between" aria-label="Menu utama">
    <ul class="space-y-1 font-bold">
        @foreach ($menu as $item)
            <li>
                <a href="{{ $item['href'] }}"
                   @class([
                       'block rounded-full px-4 py-4 transition-colors duration-150',
                       'bg-white text-rose-600' => $item['active'],
                       'hover:bg-rose-700' => ! $item['active'],
                   ])
                   @if ($item['active']) aria-current="page" @endif>
                    {{ $item['label'] }}
                </a>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('profile') }}"
       @class([
           'mt-6 block rounded-full px-4 py-4 text-center font-bold transition-colors duration-150',
           'bg-white text-rose-600' => request()->routeIs('profile'),
           'border border-white/40 hover:bg-rose-700' => ! request()->routeIs('profile'),
       ])
       @if (request()->routeIs('profile')) aria-current="page" @endif>
        Profile
    </a>
</nav>
