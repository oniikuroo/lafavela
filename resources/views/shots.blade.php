@extends('layouts.site')

@section('head')
        <meta name="referrer" content="strict-origin-when-cross-origin">
        <meta http-equiv="X-Content-Type-Options" content="nosniff">
        <meta http-equiv="X-Frame-Options" content="DENY">
        <meta http-equiv="Permissions-Policy" content="geolocation=(), microphone=(), camera=()">

        @php
            $seoTitle = __('site.shots_title');
            $seoDescription = __('site.shots_description');
            $seoUrl = url()->current();
            $seoImage = asset('images/favela-logo-v2.png');
            $seoBase = rtrim(config('app.url') ?: request()->getSchemeAndHttpHost(), '/');
            $seoLang = app()->getLocale();
            $seoLocaleMap = ['es' => 'es_ES', 'en' => 'en_US', 'pt' => 'pt_PT'];
            $seoLocale = $seoLocaleMap[$seoLang] ?? 'es_ES';
            $path = request()->path();
            $path = $path === '/' ? '' : $path;
            $path = preg_replace('/^(es|en|pt)(\/|$)/i', '', $path);
            $path = trim($path, '/');
            $altPath = $path ? '/' . $path : '';
            $defaultLang = in_array(config('app.locale'), ['es', 'en', 'pt'], true) ? config('app.locale') : 'en';
            $hreflangs = [
                'es' => $seoBase . '/es' . $altPath,
                'en' => $seoBase . '/en' . $altPath,
                'pt' => $seoBase . '/pt' . $altPath,
                'x-default' => $seoBase . '/' . $defaultLang . $altPath,
            ];
            $structuredData = [
                '@context' => 'https://schema.org',
                '@type' => 'BarOrPub',
                'name' => 'La Favela Lounge Bar',
                'telephone' => '+34 696 989 246',
                'image' => $seoImage,
                'url' => $seoBase,
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => 'C. Amor de Dios, 56',
                    'addressLocality' => 'Sevilla',
                    'postalCode' => '41002',
                    'addressRegion' => 'Andalucía',
                    'addressCountry' => 'ES',
                ],
                'sameAs' => [
                    'https://www.instagram.com/lafavela.sevilla/',
                ],
            ];
        @endphp

        <title>{{ __('site.shots_title') }}</title>
        <meta name="description" content="{{ $seoDescription }}">
        <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
        <link rel="canonical" href="{{ $seoUrl }}">
        <link rel="alternate" hreflang="es" href="{{ $hreflangs['es'] }}">
        <link rel="alternate" hreflang="en" href="{{ $hreflangs['en'] }}">
        <link rel="alternate" hreflang="pt" href="{{ $hreflangs['pt'] }}">
        <link rel="alternate" hreflang="x-default" href="{{ $hreflangs['x-default'] }}">

        <meta property="og:title" content="{{ $seoTitle }}">
        <meta property="og:description" content="{{ $seoDescription }}">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ $seoUrl }}">
        <meta property="og:image" content="{{ $seoImage }}">
        <meta property="og:site_name" content="La Favela">
        <meta property="og:locale" content="{{ $seoLocale }}">
        <meta property="og:locale:alternate" content="es_ES">
        <meta property="og:locale:alternate" content="en_US">
        <meta property="og:locale:alternate" content="pt_PT">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $seoTitle }}">
        <meta name="twitter:description" content="{{ $seoDescription }}">
        <meta name="twitter:image" content="{{ $seoImage }}">

        <meta name="theme-color" content="#1a7f3b">

        <script type="application/ld+json">{!! json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>

            @endsection

@section('styles')
            :root {
                --brazil-green: #1a7f3b;
                --brazil-yellow: #f7c800;
                --brazil-blue: #0b3a8a;
                --sunset: #ff8a2a;
                --sand: #fff3cd;
                --deep: #0b241b;
                --teal: #0f5d4c;
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                min-height: 100vh;
                font-family: "Sora", "Segoe UI", sans-serif;
                color: var(--deep);
                background:
                    radial-gradient(600px 420px at 10% 15%, #f7c80055 0%, transparent 70%),
                    radial-gradient(520px 380px at 90% 10%, #0b3a8a55 0%, transparent 65%),
                    radial-gradient(500px 340px at 70% 90%, #1a7f3b55 0%, transparent 70%),
                    linear-gradient(145deg, #fff7de 0%, #ffe9b2 42%, #fff3cd 100%);
            }

            .page {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                padding: 32px 24px 56px;
                position: relative;
                overflow: hidden;
            }

            .topbar {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
                flex-wrap: wrap;
            }

            .brand {
                font-family: "Bebas Neue", "Sora", sans-serif;
                font-size: 32px;
                letter-spacing: 0.08em;
                text-transform: uppercase;
            }

            .nav-link {
                font-size: 12px;
                letter-spacing: 0.16em;
                text-transform: uppercase;
                font-weight: 700;
                color: var(--brazil-blue);
                text-decoration: none;
                padding: 10px 14px;
                border-radius: 999px;
                border: 2px solid rgba(11, 58, 138, 0.3);
                background: rgba(255, 255, 255, 0.55);
                transition: transform 200ms ease, box-shadow 200ms ease;
            }

            .nav-link:hover {
                transform: translateY(-2px);
                box-shadow: 0 12px 24px rgba(11, 58, 138, 0.25);
            }

            .topbar-right {
                display: flex;
                align-items: center;
                gap: 16px;
            }

            .admin-link {
                font-size: 10px;
                letter-spacing: 0.16em;
                text-transform: uppercase;
                font-weight: 700;
                color: rgba(11, 58, 138, 0.75);
                text-decoration: none;
                padding: 8px 12px;
                border-radius: 999px;
                border: 1px solid rgba(11, 58, 138, 0.18);
                background: rgba(255, 255, 255, 0.38);
                transition: background 200ms ease, transform 200ms ease;
            }

            .admin-link:hover {
                background: rgba(255, 255, 255, 0.65);
                transform: translateY(-1px);
            }

            .lang-select {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                font-size: 11px;
                letter-spacing: 0.2em;
                text-transform: uppercase;
                font-weight: 700;
                color: var(--brazil-blue);
            }

            .lang-select select {
                appearance: none;
                border-radius: 999px;
                border: 2px solid rgba(11, 58, 138, 0.3);
                background: rgba(255, 255, 255, 0.7);
                padding: 8px 32px 8px 14px;
                font-size: 11px;
                font-weight: 700;
                letter-spacing: 0.18em;
                text-transform: uppercase;
                color: var(--brazil-blue);
                cursor: pointer;
            }

            .menu-hero {
                margin-top: 32px;
                display: grid;
                grid-template-columns: 1.1fr 0.9fr;
                gap: 24px;
                align-items: end;
            }

            .menu-title {
                font-family: "Bebas Neue", "Sora", sans-serif;
                font-size: clamp(44px, 8vw, 88px);
                text-transform: uppercase;
                letter-spacing: 0.12em;
                color: var(--brazil-green);
                margin: 0;
            }

            .menu-subtitle {
                margin: 10px 0 0;
                font-size: 16px;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                color: var(--brazil-blue);
                font-weight: 600;
            }

            .menu-hours {
                background: rgba(255, 255, 255, 0.7);
                border-radius: 18px;
                padding: 18px 20px;
                border: 1px solid rgba(26, 127, 59, 0.25);
                text-transform: uppercase;
                letter-spacing: 0.12em;
                font-size: 12px;
                font-weight: 700;
                text-align: right;
            }

            .menu-ad {
                margin-top: 16px;
                display: inline-flex;
                align-items: center;
                gap: 10px;
                padding: 10px 16px;
                border-radius: 999px;
                font-size: 12px;
                letter-spacing: 0.18em;
                text-transform: uppercase;
                font-weight: 700;
                color: #0b3a8a;
                background: linear-gradient(90deg, rgba(247, 200, 0, 0.25), rgba(255, 138, 42, 0.25));
                border: 1px solid rgba(11, 58, 138, 0.25);
                box-shadow: 0 10px 20px rgba(11, 36, 27, 0.12);
            }

            .menu-grid {
                margin-top: 28px;
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 22px;
            }

            .menu-card {
                background: rgba(255, 255, 255, 0.75);
                border-radius: 22px;
                padding: 22px 22px 18px;
                border: 1px solid rgba(15, 93, 76, 0.2);
                box-shadow: 0 18px 36px rgba(11, 36, 27, 0.12);
                animation: fade 800ms ease forwards;
            }

            .menu-card h3 {
                margin: 0 0 16px;
                font-size: 18px;
                letter-spacing: 0.16em;
                text-transform: uppercase;
                color: var(--teal);
            }

            .menu-item {
                display: flex;
                justify-content: space-between;
                gap: 12px;
                margin-bottom: 14px;
                font-size: 14px;
            }

            .menu-item span {
                font-weight: 600;
            }

            .menu-item small {
                display: block;
                font-size: 12px;
                color: rgba(11, 36, 27, 0.7);
                margin-top: 4px;
            }

            .price {
                font-weight: 700;
                color: var(--brazil-blue);
            }

            .divider {
                height: 3px;
                border-radius: 999px;
                background: linear-gradient(90deg, var(--brazil-green), var(--brazil-yellow), var(--brazil-blue));
                margin-top: 6px;
            }

            .footer-note {
                margin-top: 32px;
                text-transform: uppercase;
                letter-spacing: 0.18em;
                font-size: 11px;
                color: rgba(11, 36, 27, 0.7);
                text-align: center;
            }

            @keyframes fade {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }

            @media (max-width: 900px) {
                .menu-hero {
                    grid-template-columns: 1fr;
                    align-items: start;
                }

                .menu-hours {
                    text-align: left;
                }

                .menu-grid {
                    grid-template-columns: 1fr;
                }

                .topbar-right {
                    width: 100%;
                    justify-content: flex-start;
                    flex-wrap: wrap;
                }

                .lang-select {
                    width: 100%;
                    justify-content: flex-start;
                }

                .lang-select select {
                    width: 100%;
                }
            }

            @media (max-width: 600px) {
                .nav-link {
                    font-size: 11px;
                    padding: 8px 10px;
                }
            }
        
            .social-bar {
                display: flex;
                justify-content: flex-end;
                gap: 8px;
                color: #0b3a8a;
                margin-bottom: 12px;
                flex-wrap: wrap;
            }
            .social-bar a {
                color: inherit;
                text-decoration: none;
                padding: 6px;
                border-radius: 999px;
                border: 2px solid rgba(11, 58, 138, 0.25);
                background: rgba(255, 255, 255, 0.6);
                display: inline-flex;
                align-items: center;
                gap: 6px;
            }
            .social-icon {
                width: 12px;
                height: 12px;
                display: block;
            }

            /* Home-style cards for menu pages */
            .menu-grid {
                display: grid;
                gap: 28px;
            }

            .menu-section {
                background: linear-gradient(150deg, #fff7de 0%, #ffe6a2 100%);
                border: 2px solid var(--brazil-green);
                border-radius: 24px;
                padding: 20px 22px;
                box-shadow: 0 18px 32px rgba(10, 40, 24, 0.18);
                position: relative;
                overflow: hidden;
            }

            .menu-section::before {
                content: "";
                position: absolute;
                inset: 10px;
                border-radius: 18px;
                border: 2px dashed rgba(11, 58, 138, 0.35);
                pointer-events: none;
            }

            .menu-section h2 {
                position: relative;
                z-index: 1;
                font-family: "Bebas Neue", "Sora", sans-serif;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                margin: 0 0 14px;
                color: var(--brazil-blue);
            }

            .menu-items {
                position: relative;
                z-index: 1;
                display: grid;
                gap: 12px;
            }

            .menu-item {
                background: rgba(255, 255, 255, 0.9);
                border: 2px solid rgba(11, 58, 138, 0.18);
                border-radius: 16px;
                padding: 12px 14px;
                box-shadow: 0 10px 18px rgba(11, 58, 138, 0.12);
            }

            .menu-item-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 12px;
            }

            .menu-item-name {
                font-weight: 700;
                color: var(--deep);
            }

            .menu-item-price {
                font-weight: 800;
                color: var(--brazil-green);
            }

@endsection

@section('content')
        @php($currentLang = app()->getLocale())
        <div class="page">
            <div class="social-bar">
    <a href="tel:+34696989246" aria-label="Telefono">
        <svg class="social-icon" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M7 3c-.9 0-1.7.7-1.7 1.7 0 8.1 6.6 14.6 14.6 14.6.9 0 1.7-.7 1.7-1.7v-3.1c0-.7-.5-1.3-1.2-1.6l-3.3-1.1c-.7-.2-1.4 0-1.8.5l-1.3 1.6c-2.3-1.1-4.1-2.9-5.2-5.2l1.6-1.3c.5-.4.7-1.1.5-1.8L9.4 4.2C9.2 3.6 8.5 3 7.8 3H7z" fill="currentColor"/>
        </svg>
    </a>
    <a href="https://www.instagram.com/lafavela.sevilla/" target="_blank" rel="noopener">
        <svg class="social-icon" viewBox="0 0 24 24" aria-hidden="true">
            <rect x="5" y="5" width="14" height="14" rx="4" ry="4" fill="none" stroke="currentColor" stroke-width="1.5"/>
            <circle cx="12" cy="12" r="3.25" fill="none" stroke="currentColor" stroke-width="1.5"/>
            <circle cx="16.5" cy="7.5" r="1" fill="currentColor"/>
        </svg>
    </a>
</div>
            <header class="topbar">
                <a class="brand" href="{{ route('home', ['lang' => $currentLang]) }}">La Favela</a>
                <div class="topbar-right">
                    <a class="nav-link" href="{{ route('home', ['lang' => $currentLang]) }}">{{ __('site.back_home') }}</a>
                    <a class="nav-link" href="{{ route('menu', ['lang' => $currentLang]) }}">{{ __('site.nav_menu') }}</a>
                    <a class="nav-link" href="{{ route('cocktails', ['lang' => $currentLang]) }}">{{ __('site.nav_cocktails') }}</a>
                    <a class="nav-link" href="{{ route('shots', ['lang' => $currentLang]) }}">{{ __('site.nav_shots') }}</a>
                    @auth
                        @if (auth()->user()?->is_admin)
                            <a class="admin-link" href="{{ route('admin.localized.menu', ['lang' => $currentLang, 'page' => 'shots']) }}">Panel</a>
                        @endif
                    @else
                        <a class="admin-link" href="{{ route('login') }}">Acceso</a>
                    @endauth
                    <div class="lang-select">
                        <span>{{ __('site.language') }}</span>
                        <select aria-label="{{ __('site.language') }}" onchange="setLanguage(this.value)">
                            <option value="es" {{ $currentLang === 'es' ? 'selected' : '' }}>ES</option>
                            <option value="en" {{ $currentLang === 'en' ? 'selected' : '' }}>EN</option>
                            <option value="pt" {{ $currentLang === 'pt' ? 'selected' : '' }}>PT</option>
                        </select>
                    </div>
                </div>
            </header>

            <section class="menu-hero">
                <div>
                    <h1 class="menu-title">{{ $menuContent['heading'] ?? __('site.shots_heading') }}</h1>
                    <div class="divider" aria-hidden="true"></div>
                    <p class="menu-subtitle">{{ $menuContent['subtitle'] ?? __('site.shots_subtitle') }}</p>
                </div>
                <div class="menu-hours">
                    {{ $menuContent['hours'] ?? __('site.menu_hours') }}
                </div>
            </section>

            <section class="menu-grid">
            @if (!empty($menuSections))
                @foreach ($menuSections as $section)
                    <section class="menu-section">
                        <h2>{{ $section->title }}</h2>
                        <div class="menu-items">
                            @foreach ($section->items as $item)
                                <div class="menu-item">
                                    <div class="menu-item-header">
                                        <span class="menu-item-name">{{ $item->name }}</span>
                                        @if (!empty($item->price))
                                            <span class="menu-item-price">{{ $item->price }}</span>
                                        @endif
                                    </div>
                                    @if (!empty($item->description))
                                        <p class="menu-item-desc">{{ $item->description }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endforeach
            @else
                <p>{{ __('site.menu_empty') }}</p>
            @endif
            </section>
        </div>
@endsection

@section('scripts')
        <script>
            function setLanguage(lang) {
                const routes = {
                    es: @json(route('shots', ['lang' => 'es'])),
                    en: @json(route('shots', ['lang' => 'en'])),
                    pt: @json(route('shots', ['lang' => 'pt'])),
                };

                window.location.href = routes[lang] || routes.es;
            }
        </script>
@endsection
