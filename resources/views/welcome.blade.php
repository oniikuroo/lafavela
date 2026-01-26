<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __('site.site_title') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Sora:wght@300;400;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
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

            @media (max-width: 900px) {
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
                    justify-content: space-between;
                }
            }
        </style>
    </head>
    <body>
        @php($currentLang = app()->getLocale())
        <div class="page">
            <div class="orb" aria-hidden="true"></div>
            <div class="leaf left" aria-hidden="true"></div>
            <div class="leaf right" aria-hidden="true"></div>

            <header class="topbar">
                <a class="brand" href="{{ url('/') }}">La Favela</a>
                <div class="topbar-right">
                    <div class="location">{{ __('site.location') }}</div>
                    <div class="lang-select">
                        <span>{{ __('site.language') }}</span>
                        <select aria-label="{{ __('site.language') }}" onchange="window.location='{{ url()->current() }}?lang=' + this.value;">
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
                    <div class="label-subtitle">{{ __('site.subtitle') }}</div>
                    <div class="label-line" aria-hidden="true"></div>
                    <div class="label-tags">
                        <span class="tag">{{ __('site.tag_cachaca') }}</span>
                        <span class="tag">{{ __('site.tag_samba') }}</span>
                        <span class="tag">{{ __('site.tag_sunset') }}</span>
                        <span class="tag">{{ __('site.tag_bites') }}</span>
                    </div>
                    <div class="label-footer">
                    <span>{{ __('site.hours') }}</span>
                        <img class="seal" src="{{ asset('images/favela-logo.png') }}" alt="La Favela logo">
                    </div>
                </section>

                <section class="info-panel">
                    <h2>{{ __('site.visit_title') }}</h2>
                    <p>{{ __('site.visit_intro') }}</p>
                    <p>
                        <a class="address-link" href="https://maps.app.goo.gl/h2iAN9fyDTt7f8Mt6" target="_blank" rel="noopener noreferrer">
                            {{ __('site.visit_address') }}
                        </a>
                    </p>
                    <div class="cta-row">
                        <a class="cta primary" href="{{ route('cocktails') }}">{{ __('site.cta_cocktails') }}</a>
                        <a class="cta secondary" href="{{ route('menu') }}">{{ __('site.cta_menu') }}</a>
                    </div>
                </section>
            </main>

            <footer class="footer">{{ __('site.footer') }}</footer>
        </div>
    </body>
</html>
