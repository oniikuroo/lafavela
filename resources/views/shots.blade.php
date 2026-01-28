<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __('site.shots_title') }}</title>

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
        </style>
    </head>
    <body>
        @php($currentLang = app()->getLocale())
        <div class="page">
            <header class="topbar">
                <a class="brand" href="{{ url('/') }}">La Favela</a>
                <div class="topbar-right">
                    <a class="nav-link" href="{{ url('/') }}">{{ __('site.back_home') }}</a>
                    <a class="nav-link" href="{{ route('menu') }}">{{ __('site.nav_menu') }}</a>
                    <a class="nav-link" href="{{ route('cocktails') }}">{{ __('site.nav_cocktails') }}</a>
                    <a class="nav-link" href="{{ route('shots') }}">{{ __('site.nav_shots') }}</a>
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
                    <h1 class="menu-title">{{ __('site.shots_heading') }}</h1>
                    <div class="divider" aria-hidden="true"></div>
                    <p class="menu-subtitle">{{ __('site.shots_subtitle') }}</p>
                </div>
                <div class="menu-hours">
                    {{ __('site.menu_hours') }}
                </div>
            </section>

            <section class="menu-grid">
                <div class="menu-card">
                    <h3>{{ __('site.section_shots') }}</h3>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_apple_pie') }}</span>
                            <small>{{ __('site.shot_apple_pie_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_sevillano') }}</span>
                            <small>{{ __('site.shot_sevillano_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_mont_blanc') }}</span>
                            <small>{{ __('site.shot_mont_blanc_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_sao_tome') }}</span>
                            <small>{{ __('site.shot_sao_tome_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_brazil_rosa') }}</span>
                            <small>{{ __('site.shot_brazil_rosa_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_darkhole') }}</span>
                            <small>{{ __('site.shot_darkhole_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_fuck_off') }}</span>
                            <small>{{ __('site.shot_fuck_off_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_cocoloco') }}</span>
                            <small>{{ __('site.shot_cocoloco_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_alloloco') }}</span>
                            <small>{{ __('site.shot_alloloco_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_brain_tumor') }}</span>
                            <small>{{ __('site.shot_brain_tumor_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_brain_hemorage') }}</span>
                            <small>{{ __('site.shot_brain_hemorage_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_blowjob') }}</span>
                            <small>{{ __('site.shot_blowjob_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_lemon_drop') }}</span>
                            <small>{{ __('site.shot_lemon_drop_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_chupirita') }}</span>
                            <small>{{ __('site.shot_chupirita_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_caipipeach') }}</span>
                            <small>{{ __('site.shot_caipipeach_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_piruleta') }}</span>
                            <small>{{ __('site.shot_piruleta_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_horny_bull') }}</span>
                            <small>{{ __('site.shot_horny_bull_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_abc') }}</span>
                            <small>{{ __('site.shot_abc_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                </div>

                <div class="menu-card">
                    <h3>{{ __('site.section_shots') }}</h3>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_wet_pussy') }}</span>
                            <small>{{ __('site.shot_wet_pussy_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_guijon') }}</span>
                            <small>{{ __('site.shot_guijon_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_orgasm') }}</span>
                            <small>{{ __('site.shot_orgasm_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_bob_marley') }}</span>
                            <small>{{ __('site.shot_bob_marley_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_black_russian') }}</span>
                            <small>{{ __('site.shot_black_russian_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_kamikaze') }}</span>
                            <small>{{ __('site.shot_kamikaze_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_liquid_cocaine') }}</span>
                            <small>{{ __('site.shot_liquid_cocaine_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_pinita') }}</span>
                            <small>{{ __('site.shot_pinita_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_wet_pussy_alt') }}</span>
                            <small>{{ __('site.shot_wet_pussy_alt_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_guiron') }}</span>
                            <small>{{ __('site.shot_guiron_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_tim') }}</span>
                            <small>{{ __('site.shot_tim_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_tybrasa') }}</span>
                            <small>{{ __('site.shot_tybrasa_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_fire_on') }}</span>
                            <small>{{ __('site.shot_fire_on_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_boyarski') }}</span>
                            <small>{{ __('site.shot_boyarski_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_escala_diablo') }}</span>
                            <small>{{ __('site.shot_escala_diablo_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_escala_richter') }}</span>
                            <small>{{ __('site.shot_escala_richter_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <span>{{ __('site.shot_casa_diablo') }}</span>
                            <small>{{ __('site.shot_casa_diablo_desc') }}</small>
                        </div>
                        <div class="price">-</div>
                    </div>
                </div>
            </section>

            <footer class="footer-note">{{ __('site.footer') }}</footer>
        </div>
        <script>
            function setLanguage(lang) {
                const url = new URL(window.location.href);
                const path = url.pathname;
                const match = path.match(/^\/(es|en|pt)(\/|$)/i);

                if (match) {
                    url.pathname = path.replace(/^\/(es|en|pt)(\/|$)/i, `/${lang}$2`);
                    url.searchParams.delete('lang');
                } else {
                    url.searchParams.set('lang', lang);
                }

                window.location.href = url.toString();
            }
        </script>
    </body>
</html>

