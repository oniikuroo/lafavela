@extends('layouts.site')

@section('head')
        <meta name="referrer" content="strict-origin-when-cross-origin">
        <meta http-equiv="X-Content-Type-Options" content="nosniff">
        <meta http-equiv="X-Frame-Options" content="DENY">
        <meta http-equiv="Permissions-Policy" content="geolocation=(), microphone=(), camera=()">

        @php
            $seoTitle = __('site.site_title');
            $seoDescription = __('site.site_description');
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

        <title>{{ __('site.site_title') }}</title>
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
                    radial-gradient(600px 420px at 12% 12%, #f7c80055 0%, transparent 70%),
                    radial-gradient(520px 380px at 86% 18%, #0b3a8a55 0%, transparent 65%),
                    radial-gradient(500px 340px at 60% 92%, #1a7f3b55 0%, transparent 70%),
                    linear-gradient(145deg, #fff7de 0%, #ffe9b2 42%, #fff3cd 100%);
                overflow-x: hidden;
            }

            .page {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                padding: 32px 24px 40px;
                position: relative;
                overflow: hidden;
            }

            .topbar {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
                position: relative;
                z-index: 2;
                flex-wrap: wrap;
            }

            .brand {
                font-family: "Bebas Neue", "Sora", sans-serif;
                font-size: 32px;
                letter-spacing: 0.08em;
                text-transform: uppercase;
            }

            .location {
                font-size: 14px;
                font-weight: 600;
                color: var(--teal);
                text-transform: uppercase;
                letter-spacing: 0.12em;
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

            .lang-select {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                font-size: 8px;
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
                font-size: 8px;
                font-weight: 700;
                letter-spacing: 0.18em;
                text-transform: uppercase;
                color: var(--brazil-blue);
                cursor: pointer;
            }

            .hero {
                flex: 1;
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 32px;
                align-items: center;
                margin-top: 36px;
                position: relative;
                z-index: 2;
            }

            .label-card {
                background: linear-gradient(150deg, #fff7de 0%, #ffe6a2 100%);
                border: 3px solid var(--brazil-green);
                border-radius: 28px;
                padding: 36px 32px;
                box-shadow: 0 26px 50px rgba(10, 40, 24, 0.2);
                position: relative;
                animation: rise 800ms ease forwards;
            }

            .label-card::before {
                content: "";
                position: absolute;
                inset: 10px;
                border-radius: 22px;
                border: 2px dashed var(--brazil-blue);
                pointer-events: none;
            }

            .label-ribbon {
                display: inline-block;
                background: var(--brazil-yellow);
                color: #2d1a00;
                font-weight: 700;
                font-size: 12px;
                padding: 6px 12px;
                border-radius: 999px;
                letter-spacing: 0.2em;
                text-transform: uppercase;
                box-shadow: inset 0 -2px 0 rgba(0, 0, 0, 0.1);
            }

            .label-title {
                font-family: "Bebas Neue", "Sora", sans-serif;
                font-size: clamp(52px, 9vw, 104px);
                display: inline-flex;
                align-items: center;
                gap: 14px;
                margin: 16px 0 8px;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                color: var(--brazil-green);
            }

            .label-flag {
                width: 58px;
                height: 38px;
                border-radius: 6px;
                box-shadow: 0 6px 16px rgba(11, 36, 27, 0.2);
                border: 1px solid rgba(11, 36, 27, 0.2);
                flex-shrink: 0;
            }

            .label-subtitle {
                font-size: 18px;
                font-weight: 600;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                color: var(--brazil-blue);
            }

            .label-line {
                height: 3px;
                background: linear-gradient(90deg, var(--brazil-green), var(--brazil-yellow), var(--brazil-blue));
                border-radius: 999px;
                margin: 18px 0;
            }

            .label-tags {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
            }

            .shots-ad {
                margin: 0;
                display: inline-flex;
                align-items: center;
                gap: 10px;
                padding: 14px 28px;
                border-radius: 999px;
                font-size: 16px;
                letter-spacing: 0.22em;
                text-transform: uppercase;
                font-weight: 700;
                color: #0b3a8a;
                background: linear-gradient(120deg, rgba(247, 200, 0, 0.35), rgba(255, 138, 42, 0.45));
                border: 2px solid rgba(11, 58, 138, 0.35);
                box-shadow: 0 16px 32px rgba(11, 36, 27, 0.2);
                position: relative;
                overflow: hidden;
                animation: glow 2.4s ease-in-out infinite;
            }

            .shots-ad::after {
                content: "";
                position: absolute;
                inset: -40% 60% auto -40%;
                height: 140%;
                width: 60%;
                background: linear-gradient(120deg, transparent, rgba(255, 255, 255, 0.55), transparent);
                transform: skewX(-18deg);
                animation: sweep 3.6s ease-in-out infinite;
            }

            .shots-ad span {
                position: relative;
                z-index: 1;
            }

            .tag {
                background: rgba(255, 255, 255, 0.7);
                border: 1px solid rgba(15, 93, 76, 0.3);
                color: var(--teal);
                padding: 8px 14px;
                border-radius: 999px;
                font-size: 12px;
                letter-spacing: 0.1em;
                text-transform: uppercase;
                animation: pop 600ms ease forwards;
                opacity: 0;
            }

            .tag:nth-child(1) { animation-delay: 120ms; }
            .tag:nth-child(2) { animation-delay: 200ms; }
            .tag:nth-child(3) { animation-delay: 280ms; }
            .tag:nth-child(4) { animation-delay: 360ms; }

            .label-footer {
                margin-top: 22px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                font-size: 13px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.12em;
                color: #2d1a00;
            }

            .seal {
                width: 74px;
                height: 74px;
                border-radius: 50%;
                border: 2px solid rgba(11, 58, 138, 0.3);
                background: #ffffffcc;
                padding: 0;
                object-fit: cover;
                box-shadow: 0 10px 20px rgba(11, 36, 27, 0.18);
            }

            .info-panel {
                background: rgba(255, 255, 255, 0.65);
                border-radius: 22px;
                padding: 28px;
                border: 1px solid rgba(11, 58, 138, 0.2);
                backdrop-filter: blur(6px);
                box-shadow: 0 20px 40px rgba(11, 36, 27, 0.15);
                animation: fade 900ms ease forwards;
            }

            .info-stack {
                display: flex;
                flex-direction: column;
                gap: 16px;
            }

            .info-panel h2 {
                margin: 0 0 12px;
                font-size: 20px;
                text-transform: uppercase;
                letter-spacing: 0.12em;
                color: var(--brazil-blue);
            }

            .info-panel p {
                margin: 0 0 12px;
                line-height: 1.6;
                font-size: 15px;
                color: #1a2d26;
            }

            .address-link {
                color: var(--brazil-blue);
                font-weight: 600;
                text-decoration: none;
                border-bottom: 2px solid rgba(11, 58, 138, 0.25);
                padding-bottom: 2px;
            }

            .address-link:hover {
                color: var(--brazil-green);
                border-bottom-color: rgba(26, 127, 59, 0.35);
            }

            .cta-row {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                margin-top: 18px;
            }

            .cta {
                border-radius: 999px;
                padding: 12px 18px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.1em;
                font-size: 12px;
                text-decoration: none;
                transition: transform 200ms ease, box-shadow 200ms ease;
            }

            .cta.primary {
                background: var(--brazil-green);
                color: #fdf8ea;
                box-shadow: 0 12px 24px rgba(26, 127, 59, 0.35);
            }

            .cta.secondary {
                border: 2px solid var(--brazil-blue);
                color: var(--brazil-blue);
                background: rgba(255, 255, 255, 0.6);
            }

            .cta:hover {
                transform: translateY(-2px);
                box-shadow: 0 16px 32px rgba(15, 93, 76, 0.3);
            }

            .leaf {
                position: absolute;
                width: 260px;
                height: 160px;
                background: radial-gradient(circle at 20% 40%, #2f9c63, #0b5b3b);
                border-radius: 100% 0 100% 0;
                opacity: 0.25;
                filter: blur(0.5px);
                animation: float 6s ease-in-out infinite;
            }

            .leaf.left {
                top: 120px;
                left: -60px;
                transform: rotate(-12deg);
            }

            .leaf.right {
                bottom: 120px;
                right: -80px;
                transform: rotate(16deg);
                animation-delay: 1.5s;
            }

            .orb {
                position: absolute;
                width: 240px;
                height: 240px;
                border-radius: 50%;
                background: radial-gradient(circle, #ffce4c, rgba(255, 206, 76, 0));
                opacity: 0.6;
                top: -40px;
                right: 10%;
                filter: blur(6px);
            }

            .footer {
                margin-top: 32px;
                text-transform: uppercase;
                letter-spacing: 0.2em;
                font-size: 12px;
                color: rgba(11, 36, 27, 0.7);
                text-align: center;
            }

            @keyframes rise {
                from { transform: translateY(20px); opacity: 0; }
                to { transform: translateY(0); opacity: 1; }
            }

            @keyframes pop {
                from { transform: translateY(6px); opacity: 0; }
                to { transform: translateY(0); opacity: 1; }
            }

            @keyframes fade {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }

            @keyframes float {
                0%, 100% { transform: translateY(0) rotate(-12deg); }
                50% { transform: translateY(-10px) rotate(-8deg); }
            }

            @keyframes glow {
                0%, 100% { transform: translateY(0); box-shadow: 0 16px 32px rgba(11, 36, 27, 0.2); }
                50% { transform: translateY(-3px); box-shadow: 0 22px 44px rgba(11, 36, 27, 0.26); }
            }

            @keyframes sweep {
                0% { transform: translateX(-120%) skewX(-18deg); opacity: 0; }
                20% { opacity: 0.9; }
                50% { transform: translateX(160%) skewX(-18deg); opacity: 0; }
                100% { opacity: 0; }
            }

            @media (max-width: 900px) {
                .shots-ad {
                    font-size: 14px;
                    letter-spacing: 0.18em;
                    padding: 12px 22px;
                }

                .hero {
                    grid-template-columns: 1fr;
                }

                .label-card {
                    padding: 30px 24px;
                }

                .label-footer {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 12px;
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

                .location {
                    width: 100%;
                }
            }

            @media (max-width: 600px) {
                .location {
                    font-size: 12px;
                    letter-spacing: 0.1em;
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

            .notice-banner {
                margin: 8px 0 14px;
                padding: 10px 14px;
                border-radius: 12px;
                background: rgba(11, 58, 138, 0.08);
                border: 1px solid rgba(11, 58, 138, 0.18);
                color: #0b3a8a;
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
                align-items: center;
                font-size: 13px;
                font-weight: 600;
            }
            .notice-banner strong {
                text-transform: uppercase;
                letter-spacing: 0.12em;
                font-size: 8px;
            }
@endsection

@section('content')
        @php($currentLang = app()->getLocale())
        <div class="page">
            <div class="orb" aria-hidden="true"></div>
            <div class="leaf left" aria-hidden="true"></div>
            <div class="leaf right" aria-hidden="true"></div>

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
            @if (!empty($notice))
                <div class="notice-banner" role="status">
                    <strong>{{ $notice->title }}</strong>
                    @if (!empty($notice->body))
                        <span>{{ $notice->body }}</span>
                    @endif
                </div>
            @endif
            <header class="topbar">
                <a class="brand" href="{{ route('home', ['lang' => $currentLang]) }}">La Favela</a>
                <div class="topbar-right">
                    <div class="location">{{ __('site.location') }}</div>
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

            <main class="hero">
                <section class="label-card" aria-labelledby="label-title">
                    <span class="label-ribbon">{{ __('site.ribbon') }}</span>
                    <h1 class="label-title" id="label-title">
                        <span>La Favela</span>
                        <svg class="label-flag" viewBox="0 0 42 28" aria-hidden="true">
                            <rect width="42" height="28" fill="#1a7f3b"/>
                            <polygon points="21,2 40,14 21,26 2,14" fill="#f7c800"/>
                            <circle cx="21" cy="14" r="6" fill="#0b3a8a"/>
                            <rect x="15" y="13" width="12" height="2" fill="#ffffff" opacity="0.9"/>
                        </svg>
                    </h1>
                    <div class="label-subtitle">{{ $settings['subtitle'] ?? __('site.subtitle') }}</div>
                    <div class="label-line" aria-hidden="true"></div>
                    <div class="label-tags">
                        <span class="tag">{{ __('site.tag_cachaca') }}</span>
                        <span class="tag">{{ __('site.tag_samba') }}</span>
                        <span class="tag">{{ __('site.tag_sunset') }}</span>
                        <span class="tag">{{ __('site.tag_bites') }}</span>
                    </div>
                    <div class="label-footer">
                    <span>{{ $settings['hours'] ?? __('site.hours') }}</span>
                        <img class="seal" src="{{ asset('images/favela-logo.png') }}" alt="La Favela logo">
                    </div>
                </section>

                <div class="info-stack">
                <div class="shots-ad"><span>{{ __('site.home_shots_ad') }}</span></div>
                    <section class="info-panel">
                        <h2>{{ __('site.visit_title') }}</h2>
                        <p>{{ $settings['visit_intro'] ?? __('site.visit_intro') }}</p>
                        <p>
                            <a class="address-link" href="https://maps.app.goo.gl/h2iAN9fyDTt7f8Mt6" target="_blank" rel="noopener noreferrer">
                                {{ __('site.visit_address') }}
                            </a>
                        </p>
                        <div class="cta-row">
                            <a class="cta primary" href="{{ route('cocktails', ['lang' => $currentLang]) }}">{{ __('site.cta_cocktails') }}</a>
                            <a class="cta secondary" href="{{ route('menu', ['lang' => $currentLang]) }}">{{ __('site.cta_menu') }}</a>
                            <a class="cta secondary" href="{{ route('shots', ['lang' => $currentLang]) }}">{{ __('site.cta_shots') }}</a>
                        </div>
                    </section>
                </div>
            </main>

            <footer class="footer">{{ __('site.footer') }}<br><span class="footer-powered">Powered by Oni Web Studio</span></footer>
        </div>
@endsection

@section('scripts')
        <script>
            function setLanguage(lang) {
                const url = new URL(window.location.href);
                const basePath = @json(parse_url(config('app.url') ?: url('/'), PHP_URL_PATH));
                const normalizedBase = (basePath && basePath !== '/') ? basePath.replace(/\/$/, '') : '';
                let path = url.pathname;

                if (normalizedBase && path.startsWith(normalizedBase)) {
                    path = path.slice(normalizedBase.length);
                }

                path = path.replace(/^\/(es|en|pt)(?=\/|$)/i, '');
                path = path.replace(/^\/+/, '');

                url.pathname = `${normalizedBase}/${lang}${path ? '/' + path : ''}`;
                url.searchParams.delete('lang');

                window.location.href = url.toString();
            }
        </script>
@endsection
