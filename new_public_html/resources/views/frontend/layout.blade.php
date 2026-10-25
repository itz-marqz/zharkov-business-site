@php
    $siteName    = 'Сергій Жарков';
    $pageTitle   = trim($__env->yieldContent('title')) ?: ($title ?? null) ?: $siteName.' — бізнес-тренер, коуч, консультант';
    $pageDesc    = trim($__env->yieldContent('meta_description')) ?: ($meta_description ?? null) ?: 'Корпоративні та відкриті бізнес-тренінги, коучинг і управлінське консультування від Сергія Жаркова.';
    $pageKeywords = trim($__env->yieldContent('meta_keywords')) ?: ($meta_keywords ?? null);
    $s = $settings ?? null;

    $services = [
        ['Корпоративні бізнес-тренінги', 'corporate-trainings'],
        ['Відкриті тренінги',            'open-trainings'],
        ['Коучинг',                      'coaching'],
        ['Управлінське консультування',  'counseling'],
    ];
    $sections = [
        ['Заходи',   'events'],
        ['Кейси',    'cases'],
        ['Відгуки',  'reviews'],
        ['Відео',    'video'],
        ['Про мене', 'about-me'],
    ];
    $isActive = static fn (string $slug): bool => request()->is($slug, $slug.'/*');
    $servicesActive = collect($services)->contains(fn ($item) => $isActive($item[1]));
    $cssFile = 'frontend/css/site.css';
    $cssUrl  = asset($cssFile).'?v='.(@filemtime(public_path($cssFile)) ?: 1);
@endphp
<!DOCTYPE html>
<html lang="uk" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDesc }}">
    @if ($pageKeywords) <meta name="keywords" content="{{ $pageKeywords }}"> @endif
    <meta name="theme-color" content="#fbfbfd">
    <script>
        // Скрипт мгновенно проверяет тему, чтобы не было "моргания" белым экраном
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-bs-theme', savedTheme);
        document.documentElement.classList.replace('no-js', 'js');
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400..800&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ $cssUrl }}">
    @stack('head')
</head>
<body>
    <a class="skip-link" href="#main">Перейти до змісту</a>

    <svg xmlns="http://www.w3.org/2000/svg" width="0" height="0" style="position:absolute" aria-hidden="true" focusable="false">
        <symbol id="i-arrow" viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></symbol>
        <symbol id="i-chevron-left" viewBox="0 0 24 24"><path d="M15 6l-6 6 6 6"/></symbol>
        <symbol id="i-chevron-right" viewBox="0 0 24 24"><path d="M9 6l6 6-6 6"/></symbol>
        <symbol id="i-quote" viewBox="0 0 24 24"><path d="M7.2 6C4.9 7.1 3.5 9.2 3.5 12v6h6v-6H6.3c0-1.7.8-3 2.4-3.8L7.2 6zm9.5 0c-2.3 1.1-3.7 3.2-3.7 6v6h6v-6h-3.2c0-1.7.8-3 2.4-3.8L16.7 6z"/></symbol>
        <symbol id="i-moon" viewBox="0 0 24 24"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></symbol>
    </svg>

    <header>
        <nav class="navbar navbar-expand-lg site-nav" id="siteNav" aria-label="Головне меню">
            <div class="container">
                <a class="brand" href="{{ url('/') }}" aria-label="{{ $siteName }} — на головну">
                    <img class="brand__mark" src="{{ asset('frontend/img/sz-mark.png') }}" alt="" width="21" height="40">
                    <span class="brand__text">
                        <span class="brand__name">{{ $siteName }}</span>
                        <span class="brand__role">бізнес-тренер · коуч</span>
                    </span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Відкрити меню">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navMenu">
                    <ul class="navbar-nav ms-lg-auto align-items-lg-center gap-lg-1">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle @if ($servicesActive) active @endif" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Послуги</a>
                            <ul class="dropdown-menu">
                                @foreach ($services as [$label, $slug])
                                    <li><a class="dropdown-item @if ($isActive($slug)) active @endif" href="{{ url($slug) }}">{{ $label }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        @foreach ($sections as [$label, $slug])
                            <li class="nav-item">
                                <a class="nav-link @if ($isActive($slug)) active @endif" href="{{ url($slug) }}" @if ($isActive($slug)) aria-current="page" @endif>{{ $label }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="d-flex align-items-center mt-3 mt-lg-0 ms-lg-3">
                        <a class="btn btn-ink w-100" href="{{ url('contacts') }}">Зв’язатися</a>
                        <button id="themeToggle" class="btn btn-soft ms-2 p-0 flex-shrink-0" style="width: 42px; height: 42px; display: grid; place-items: center; border-radius: 50%;" aria-label="Змінити тему">
                            <svg class="icon"><use href="#i-moon"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main id="main">
        @yield('main')
    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <img class="footer-logo" src="{{ asset('frontend/img/logo-light.png') }}" alt="{{ $siteName }}" width="190" height="107" loading="lazy">
                    <p class="footer-about">Корпоративні та відкриті тренінги, коучинг і управлінське консультування для команд і керівників.</p>
                </div>
                <div class="col-6 col-lg-3 offset-lg-1">
                    <h2 class="footer-title">Послуги</h2>
                    <ul class="footer-links">
                        @foreach ($services as [$label, $slug]) <li><a href="{{ url($slug) }}">{{ $label }}</a></li> @endforeach
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h2 class="footer-title">Розділи</h2>
                    <ul class="footer-links">
                        @foreach ($sections as [$label, $slug]) <li><a href="{{ url($slug) }}">{{ $label }}</a></li> @endforeach
                        <li><a href="{{ url('contacts') }}">Контакти</a></li>
                    </ul>
                </div>
                <div class="col-lg-2">
                    <h2 class="footer-title">Контакти</h2>
                    <ul class="footer-links">
                        @if (filled($s->phone ?? null)) <li><a href="tel:{{ preg_replace('/[^\d+]/', '', $s->phone) }}">{{ $s->phone }}</a></li> @endif
                        @if (filled($s->email ?? null)) <li><a href="mailto:{{ $s->email }}">{{ $s->email }}</a></li> @endif
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <span>© {{ date('Y') }} {{ $siteName }}</span>
                <span>Бізнес-тренінги, коучинг, консультування</span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (() => {
            const nav = document.getElementById('siteNav');
            const onScroll = () => nav.classList.toggle('is-scrolled', window.scrollY > 8);
            onScroll();
            addEventListener('scroll', onScroll, { passive: true });

            document.getElementById('themeToggle').addEventListener('click', () => {
                const html = document.documentElement;
                const newTheme = html.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark';
                html.setAttribute('data-bs-theme', newTheme);
                localStorage.setItem('theme', newTheme);
            });

            const items = document.querySelectorAll('.reveal');
            if (matchMedia('(prefers-reduced-motion: reduce)').matches || !('IntersectionObserver' in window)) {
                items.forEach((el) => el.classList.add('is-in'));
            } else {
                const io = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-in');
                            io.unobserve(entry.target);
                        }
                    });
                }, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });
                items.forEach((el) => io.observe(el));
            }
        })();
    </script>
</body>
</html>
