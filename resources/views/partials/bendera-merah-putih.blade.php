@php($uid = 'bendera-' . \Illuminate\Support\Str::random(6))
<svg class="bendera-anim {{ $class ?? 'h-40 w-40' }}" viewBox="0 0 200 200" role="img" aria-label="Bendera Merah Putih berkibar" data-uid="{{ $uid }}">
    <defs>
        <linearGradient id="{{ $uid }}-fold" gradientUnits="userSpaceOnUse" x1="48" y1="0" x2="172" y2="0"></linearGradient>
        <linearGradient id="{{ $uid }}-pole" x1="0" y1="0" x2="1" y2="0">
            <stop offset="0" stop-color="#C9D1DC"/>
            <stop offset="0.35" stop-color="#A3AEBD"/>
            <stop offset="0.36" stop-color="#7F8B9C"/>
            <stop offset="1" stop-color="#6A7586"/>
        </linearGradient>
    </defs>

    <ellipse class="bendera-ground" cx="44" cy="190" rx="26" ry="4.5" fill="#1F2937" fill-opacity="0.12"/>

    <g class="bendera-sparkles" fill="#FFC800">
        <path class="bendera-spark" style="--d:0s"   d="M166 22 l2.2 5.8 5.8 2.2 -5.8 2.2 -2.2 5.8 -2.2 -5.8 -5.8 -2.2 5.8 -2.2z"/>
        <path class="bendera-spark" style="--d:.7s"  d="M186 70 l1.5 4 4 1.5 -4 1.5 -1.5 4 -1.5 -4 -4 -1.5 4 -1.5z"/>
        <path class="bendera-spark" style="--d:1.3s" d="M120 140 l1.8 4.8 4.8 1.8 -4.8 1.8 -1.8 4.8 -1.8 -4.8 -4.8 -1.8 4.8 -1.8z"/>
    </g>

    <g class="bendera-pole-group">

        <rect x="28" y="180" width="32" height="10" rx="5" fill="#7F8B9C"/>
        <rect x="28" y="180" width="32" height="5" rx="2.5" fill="#A3AEBD"/>

        <rect x="40" y="24" width="8" height="160" rx="4" fill="url(#{{ $uid }}-pole)"/>

        <circle cx="44" cy="21" r="7.5" fill="#FFB100"/>
        <path d="M44 13.5 A7.5 7.5 0 0 0 44 28.5 Z" fill="#FFC800"/>
        <ellipse cx="41.5" cy="18" rx="2.2" ry="1.6" fill="#FFF3C4"/>
    </g>

    <g class="bendera-cloth">
        <path class="bendera-shadow" fill="#1F2937" fill-opacity="0.08"/>
        <path class="bendera-red" fill="#FF3B4A"/>
        <path class="bendera-white" fill="#FFFFFF"/>
        <path class="bendera-fold" fill="url(#{{ $uid }}-fold)"/>
        <path class="bendera-edge" fill="none" stroke="#E5E7EB" stroke-width="1.2" stroke-linejoin="round"/>
    </g>
</svg>

@once
    <style>
        .bendera-anim { overflow: visible; }
        .bendera-anim .bendera-pole-group {
            transform-box: fill-box;
            transform-origin: 50% 100%;
            animation: bendera-pop .7s cubic-bezier(.34, 1.56, .64, 1) both;
        }
        .bendera-anim .bendera-ground {
            transform-box: fill-box;
            transform-origin: center;
            animation: bendera-ground .7s cubic-bezier(.34, 1.56, .64, 1) both;
        }
        .bendera-anim .bendera-spark {
            transform-box: fill-box;
            transform-origin: center;
            animation: bendera-twinkle 2s ease-in-out var(--d) infinite both;
        }
        @keyframes bendera-pop {
            0%   { transform: scale(.2, 0); }
            60%  { transform: scale(1.12, .92); }
            80%  { transform: scale(.96, 1.04); }
            100% { transform: scale(1, 1); }
        }
        @keyframes bendera-ground {
            from { transform: scale(0); } to { transform: scale(1); }
        }
        @keyframes bendera-twinkle {
            0%, 100% { transform: scale(0) rotate(0deg); opacity: 0; }
            40%, 60% { transform: scale(1) rotate(45deg); opacity: 1; }
        }
        @media (prefers-reduced-motion: reduce) {
            .bendera-anim .bendera-pole-group,
            .bendera-anim .bendera-ground { animation: none; }
            .bendera-anim .bendera-spark { animation: none; opacity: 1; }
        }
    </style>
    <script>
        (() => {
            const X0 = 48, TOP = 34, H = 72, W_MAX = 124, STEPS = 32, STOPS = 24;
            const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            const NS = 'http://www.w3.org/2000/svg';

            const wave = (u, v, t) => {
                const amp = 7 * Math.pow(u, 0.85);
                return amp * Math.sin(u * 2.4 * Math.PI - t * 4.2 + v * 0.7)
                     + 2.5 * u * Math.sin(u * 5 * Math.PI - t * 6.3);
            };
            const slope = (u, t) => (wave(u + 0.01, 0.5, t) - wave(u - 0.01, 0.5, t)) / 0.02;
            const easeOutBack = (p) => 1 + 2.2 * Math.pow(p - 1, 3) + 1.2 * Math.pow(p - 1, 2);

            const init = (svg) => {
                const q = (s) => svg.querySelector(s);
                const red = q('.bendera-red'), white = q('.bendera-white'), fold = q('.bendera-fold');
                const edge = q('.bendera-edge'), shadow = q('.bendera-shadow');
                const grad = svg.querySelector('linearGradient[id$="-fold"]');
                const stops = Array.from({ length: STOPS + 1 }, (_, i) => {
                    const s = document.createElementNS(NS, 'stop');
                    s.setAttribute('offset', i / STOPS);
                    grad.appendChild(s);
                    return s;
                });

                const row = (v, w, t, dy = 0, dx = 0) => Array.from({ length: STEPS + 1 }, (_, i) => {
                    const u = i / STEPS;
                    const sag = v * v * 4 * u;
                    return [X0 + u * w + dx, TOP + v * H + wave(u, v, t) + sag + dy];
                });
                const line = (pts) => pts.map((p) => p[0].toFixed(2) + ' ' + p[1].toFixed(2)).join(' L');
                const shape = (a, b) => 'M' + line(a) + ' L' + line(b.slice().reverse()) + 'Z';

                const start = performance.now();
                const frame = (now) => {
                    const t = reduceMotion ? 0.6 : (now - start) / 1000;
                    const p = reduceMotion ? 1 : Math.min(1, Math.max(0, (t - 0.35) / 0.8));
                    const w = W_MAX * (p === 0 ? 0.001 : easeOutBack(p));

                    const top = row(0, w, t), mid = row(0.5, w, t), bot = row(1, w, t);
                    red.setAttribute('d', shape(top, mid));
                    white.setAttribute('d', shape(mid, bot));
                    fold.setAttribute('d', shape(top, bot));
                    edge.setAttribute('d', shape(top, bot));
                    shadow.setAttribute('d', shape(row(0, w, t, 6, 3), row(1, w, t, 6, 3)));

                    grad.setAttribute('x2', X0 + w);
                    stops.forEach((s, i) => {
                        const k = slope(i / STOPS, t);
                        s.setAttribute('stop-color', k > 0 ? '#000' : '#fff');
                        s.setAttribute('stop-opacity', Math.min(0.28, Math.abs(k) * 0.012).toFixed(3));
                    });

                    if (!reduceMotion) requestAnimationFrame(frame);
                };
                requestAnimationFrame(frame);
            };

            const boot = () => document.querySelectorAll('.bendera-anim:not([data-ready])').forEach((svg) => {
                svg.setAttribute('data-ready', '');
                init(svg);
            });
            document.readyState === 'loading' ? document.addEventListener('DOMContentLoaded', boot) : boot();
        })();
    </script>
@endonce
