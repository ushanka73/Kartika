<svg class="logo-kartika {{ $class ?? 'h-11 w-auto' }}" viewBox="2 16 376 89" role="img" aria-label="Kartika">
    <g fill="#f00" fill-opacity="0" stroke="#f00" stroke-width="2.5" stroke-linejoin="round" stroke-linecap="round">
        <path class="logo-line" d="M67.8 100L46.9 100L23.3 69L23.3 100L6.2 100L6.2 29.8L23.3 29.8L23.3 60.6L46.7 29.8L66.8 29.8L39.6 64.2L67.8 100Z"/>
        <path class="logo-line" d="M72.5 72Q72.5 63.4 75.8 56.9Q79 50.4 84.6 46.9Q90.2 43.4 97.1 43.4L97.1 43.4Q103 43.4 107.5 45.8Q111.9 48.2 114.3 52.1L114.3 52.1L114.3 44.2L131.4 44.2L131.4 100L114.3 100L114.3 92.1Q111.8 96 107.3 98.4Q102.9 100.8 97 100.8L97 100.8Q90.2 100.8 84.6 97.3Q79 93.7 75.8 87.2Q72.5 80.6 72.5 72L72.5 72ZM114.3 72.1Q114.3 65.7 110.8 62Q107.2 58.3 102.1 58.3L102.1 58.3Q97 58.3 93.5 61.9Q89.9 65.6 89.9 72L89.9 72Q89.9 78.4 93.5 82.2Q97 85.9 102.1 85.9L102.1 85.9Q107.2 85.9 110.8 82.2Q114.3 78.5 114.3 72.1L114.3 72.1Z"/>
        <path class="logo-line" d="M160.9 53.5Q163.9 48.9 168.4 46.3Q172.9 43.6 178.4 43.6L178.4 43.6L178.4 61.7L173.7 61.7Q167.3 61.7 164.1 64.4Q160.9 67.2 160.9 74.1L160.9 74.1L160.9 100L143.8 100L143.8 44.2L160.9 44.2L160.9 53.5Z"/>
        <path class="logo-line" d="M211.6 85.5L217.7 85.5L217.7 100L209.0 100Q199.7 100 194.5 95.5Q189.3 90.9 189.3 80.6L189.3 80.6L189.3 58.4L182.5 58.4L182.5 44.2L189.3 44.2L189.3 30.6L206.4 30.6L206.4 44.2L217.6 44.2L217.6 58.4L206.4 58.4L206.4 80.8Q206.4 83.3 207.6 84.4Q208.8 85.5 211.6 85.5L211.6 85.5Z"/>
        <path class="logo-line" d="M235.8 38.4Q231.3 38.4 228.5 35.8Q225.6 33.1 225.6 29.2L225.6 29.2Q225.6 25.2 228.5 22.5Q231.3 19.9 235.8 19.9L235.8 19.9Q240.2 19.9 243.1 22.5Q245.9 25.2 245.9 29.2L245.9 29.2Q245.9 33.1 243.1 35.8Q240.2 38.4 235.8 38.4L235.8 38.4ZM227.2 44.2L244.3 44.2L244.3 100L227.2 100L227.2 44.2Z"/>
        <path class="logo-line" d="M312 100L290.8 100L273.8 76.6L273.8 100L256.7 100L256.7 26L273.8 26L273.8 66.9L290.7 44.2L311.8 44.2L288.6 72.2L312 100Z"/>
        <path class="logo-line" d="M315.1 72Q315.1 63.4 318.4 56.9Q321.6 50.4 327.2 46.9Q332.8 43.4 339.7 43.4L339.7 43.4Q345.6 43.4 350.1 45.8Q354.5 48.2 356.9 52.1L356.9 52.1L356.9 44.2L374 44.2L374 100L356.9 100L356.9 92.1Q354.4 96 349.9 98.4Q345.5 100.8 339.6 100.8L339.6 100.8Q332.8 100.8 327.2 97.3Q321.6 93.7 318.4 87.2Q315.1 80.6 315.1 72L315.1 72ZM356.9 72.1Q356.9 65.7 353.4 62Q349.8 58.3 344.7 58.3L344.7 58.3Q339.6 58.3 336.1 61.9Q332.5 65.6 332.5 72L332.5 72Q332.5 78.4 336.1 82.2Q339.6 85.9 344.7 85.9L344.7 85.9Q349.8 85.9 353.4 82.2Q356.9 78.5 356.9 72.1L356.9 72.1Z"/>
    </g>
</svg>

@include('partials.anime-script')

@once
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const logoLines = document.querySelectorAll('.logo-kartika .logo-line');
            const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            if (window.anime && !reduceMotion) {
                const { animate, svg, stagger } = anime;

                animate(svg.createDrawable(logoLines), {
                    draw: ['0 0', '0 1'],
                    ease: 'inOutQuad',
                    duration: 1200,
                    delay: stagger(150),
                });

                animate(logoLines, {
                    fillOpacity: [0, 1],
                    ease: 'outQuad',
                    duration: 1200,
                    delay: stagger(150, { start: 1100 }),
                });
            } else {
                logoLines.forEach((line) => line.setAttribute('fill-opacity', 1));
            }
        });
    </script>
@endonce
