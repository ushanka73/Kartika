@php
    $kalenderId = 'kalender-' . uniqid();
    $kalenderName = $name ?? null;
    $kalenderSelected = $selected ?? null;
@endphp

<section id="{{ $kalenderId }}" class="col-span-2 flex flex-col">
    <div class="flex items-center justify-between">
        <h2 class="font-bold text-[1.6rem] m-4">Kalender</h2>
        <h2 data-kalender-label class="text-right text-sm text-neutral-500"></h2>
    </div>
    <div class="flex-1 rounded-3xl bg-white p-6 shadow-md">
        <div data-kalender data-selected="{{ $kalenderSelected }}"
            class="w-full select-none text-neutral-950">

            <div class="relative mb-4 flex h-9 items-center justify-center">
                <button type="button" data-kalender-prev aria-label="Bulan sebelumnya"
                    class="absolute left-0 inline-flex h-8 w-8 items-center justify-center rounded-md border border-neutral-200 bg-white text-neutral-700 shadow-sm transition-colors hover:bg-neutral-100 hover:text-neutral-900 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-neutral-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m15 18-6-6 6-6" />
                    </svg>
                </button>
                <div data-kalender-caption class="text-sm font-medium" aria-live="polite"></div>
                <button type="button" data-kalender-next aria-label="Bulan berikutnya"
                    class="absolute right-0 inline-flex h-8 w-8 items-center justify-center rounded-md border border-neutral-200 bg-white text-neutral-700 shadow-sm transition-colors hover:bg-neutral-100 hover:text-neutral-900 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-neutral-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m9 18 6-6-6-6" />
                    </svg>
                </button>
            </div>

            <div role="grid" class="w-full">
                <div role="row" class="mb-1 grid grid-cols-7">
                    @foreach (['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'] as $hari)
                        <div role="columnheader" class="py-1 text-center text-[0.8rem] font-normal text-neutral-500">
                            {{ $hari }}</div>
                    @endforeach
                </div>
                <div data-kalender-days class="grid grid-cols-7 gap-y-1"></div>
            </div>

            @if ($kalenderName)
                <input type="hidden" name="{{ $kalenderName }}" data-kalender-input value="{{ $kalenderSelected }}">
            @endif
        </div>
    </div>
</section>

<script>
    (function() {
        const root = document.getElementById(@json($kalenderId));
        if (!root) return;

        const BULAN = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
            'Oktober', 'November', 'Desember'
        ];
        const HARI = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        const caption = root.querySelector('[data-kalender-caption]');
        const daysEl = root.querySelector('[data-kalender-days]');
        const label = root.querySelector('[data-kalender-label]');
        const input = root.querySelector('[data-kalender-input]');

        const pad = (n) => String(n).padStart(2, '0');
        const toValue = (d) => `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())}`;
        const sameDay = (a, b) => a && b && a.getFullYear() === b.getFullYear() && a.getMonth() === b.getMonth() && a.getDate() === b.getDate();
        const parseValue = (v) => {
            const m = /^(\d{4})-(\d{2})-(\d{2})$/.exec(v || '');
            return m ? new Date(+m[1], +m[2] - 1, +m[3]) : null;
        };

        const today = new Date();
        today.setHours(0, 0, 0, 0);

        let selected = parseValue(root.dataset.selected) || today;
        let view = new Date(selected.getFullYear(), selected.getMonth(), 1);
        let focusDate = selected;

        const base = 'inline-flex h-9 w-full items-center justify-center rounded-xl text-sm font-normal transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-neutral-400';

        function classesFor(date, outside) {
            if (sameDay(date, selected)) {
                return base + ' bg-rose-600 text-neutral-50 hover:bg-red-900 hover:text-neutral-50' +
                    (outside ? ' opacity-60' : '');
            }
            if (sameDay(date, today)) {
                return base + ' bg-red-100 font-medium text-neutral-900 hover:bg-neutral-200';
            }
            if (outside) {
                return base + ' text-red-400 hover:bg-red-100';
            }
            return base + ' text-red-900 hover:bg-red-100';
        }

        function render(focus = false) {
            const year = view.getFullYear();
            const month = view.getMonth();
            caption.textContent = `${BULAN[month]} ${year}`;

            const first = new Date(year, month, 1);
            const last = new Date(year, month + 1, 0);
            const start = new Date(year, month, 1 - first.getDay());
            const end = new Date(year, month, last.getDate() + (6 - last.getDay()));

            daysEl.innerHTML = '';
            for (let d = new Date(start); d <= end; d.setDate(d.getDate() + 1)) {
                const date = new Date(d);
                const outside = date.getMonth() !== month;
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.setAttribute('role', 'gridcell');
                btn.textContent = date.getDate();
                btn.dataset.value = toValue(date);
                btn.className = classesFor(date, outside);
                btn.tabIndex = sameDay(date, focusDate) ? 0 : -1;
                btn.setAttribute('aria-label',
                    `${HARI[date.getDay()]}, ${date.getDate()} ${BULAN[date.getMonth()]} ${date.getFullYear()}`);
                if (sameDay(date, selected)) btn.setAttribute('aria-selected', 'true');
                if (sameDay(date, today)) btn.setAttribute('aria-current', 'date');
                btn.addEventListener('click', () => select(date));
                daysEl.appendChild(btn);
            }

            if (!daysEl.querySelector('[tabindex="0"]')) {
                daysEl.querySelector(`[data-value="${toValue(first)}"]`).tabIndex = 0;
            }

            label.textContent = selected ?
                `${HARI[selected.getDay()]}, ${selected.getDate()} ${BULAN[selected.getMonth()]} ${selected.getFullYear()}` :
                '';

            if (focus) {
                const target = daysEl.querySelector(`[data-value="${toValue(focusDate)}"]`);
                if (target) target.focus();
            }
        }

        function select(date) {
            selected = date;
            focusDate = date;
            if (date.getMonth() !== view.getMonth() || date.getFullYear() !== view.getFullYear()) {
                view = new Date(date.getFullYear(), date.getMonth(), 1);
            }
            if (input) input.value = toValue(date);
            render(true);
            root.dispatchEvent(new CustomEvent('kalender:change', {
                bubbles: true,
                detail: {
                    date: new Date(date),
                    value: toValue(date)
                },
            }));
        }

        function moveMonth(delta) {
            view = new Date(view.getFullYear(), view.getMonth() + delta, 1);
            const lastDay = new Date(view.getFullYear(), view.getMonth() + 1, 0).getDate();
            focusDate = new Date(view.getFullYear(), view.getMonth(), Math.min(focusDate.getDate(), lastDay));
            render();
        }

        root.querySelector('[data-kalender-prev]').addEventListener('click', () => moveMonth(-1));
        root.querySelector('[data-kalender-next]').addEventListener('click', () => moveMonth(1));

        daysEl.addEventListener('keydown', (e) => {
            const steps = {
                ArrowLeft: -1,
                ArrowRight: 1,
                ArrowUp: -7,
                ArrowDown: 7
            };
            let next = null;
            if (e.key in steps) {
                next = new Date(focusDate);
                next.setDate(next.getDate() + steps[e.key]);
            } else if (e.key === 'PageUp' || e.key === 'PageDown') {
                next = new Date(focusDate);
                next.setMonth(next.getMonth() + (e.key === 'PageUp' ? -1 : 1));
            } else if (e.key === 'Home' || e.key === 'End') {
                next = new Date(focusDate);
                next.setDate(next.getDate() + (e.key === 'Home' ? -next.getDay() : 6 - next.getDay()));
            } else {
                return;
            }
            e.preventDefault();
            focusDate = next;
            view = new Date(next.getFullYear(), next.getMonth(), 1);
            render(true);
        });

        render();
    })();
</script>
