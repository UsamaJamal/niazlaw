<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon-icon.png') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $seo = \App\Models\SeoSetting::forPage('capabilities'); ?>
    <title>{{ $seo->meta_title ?: 'Legal Capabilities - Niaz Law P.C.' }}</title><link rel="canonical" href="{{ url()->current() }}">
    <meta name="description" content="{{ $seo->meta_description ?: 'Explore the legal capabilities of Niaz Law P.C., covering commercial transactions and business law.' }}">
    <meta name="keywords" content="{{ $seo->meta_keywords ?: 'legal capabilities, law firm services Illinois, commercial transactions, Niaz Law' }}">
        <meta name="robots" content="{{ $seo->meta_robots ?: 'index, follow' }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
    <style>
        /* Capabilities Hero */
        .capabilities-hero {
            position: relative;
            height: 490px;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset("images/Capabilities-banner-new.webp") }}') center/cover;
            display: flex;
            align-items: center;
            color: #fff;
            padding-top: 80px; /* Offset for absolute header */
        }
        .capabilities-hero-content {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 72px;
            width: 100%;
            box-sizing: border-box;
            align-items: center;
            justify-content: start;
        }
        .capabilities-hero h1 {
            font-size: var(--h1-size);
            margin-bottom: 0;
        }
        .hero-desc-wrapper {
            position: relative;
            padding-left: 60px;
            max-width: 600px;
        }
        .hero-desc-wrapper::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 150px;
            border-left: 1.5px solid #ffffff;
        }

        .capabilities-hero p {
            font-size: var(--body-reg);
            line-height: 1.6;
            color: #eaeaea;
        }

        /* Search Section */
        .search-section {
            width: 100%;
            margin-top: -20px;
            position: relative;
            z-index: 5;
        }
        .search-card {
            width: 92%;
            max-width: 900px;
            height: 100px;
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #e0e0e0;
            box-shadow: 0px 4px 24px rgba(0,0,0,0.06);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 40px;
            margin: 0 auto;
        }
        .search-box {
            display: flex;
            width: 100%;
            max-width: 844px;
            height: 60px;
            border: 1px solid #000000;
            border-radius: 6px;
            overflow: hidden;
            background: #ffffff;
            align-items: center;
        }
        .search-icon {
            width: 18px;
            height: 18px;
            color: #888;
            margin-left: 20px;
            flex-shrink: 0;
        }
        .search-box input {
            flex-grow: 1;
            min-width: 0;
            padding: 0 16px;
            border: none;
            outline: none;
            font-size: var(--body-reg);
            font-family: var(--font-heading);
            height: 100%;
            color: #333;
        }
        .search-box input::placeholder {
            color: #000000;
            opacity: 0.5;
            font-family: 'Libre Baskerville', serif;
            font-weight: 400;
            font-size: 16px;
            line-height: 34px;
        }
        .search-box button {
            background: #000;
            color: #fff;
            border: none;
            flex-shrink: 0;
            padding: 0 40px;
            font-weight: 400;
            font-family: var(--font-heading);
            font-size: var(--body-reg);
            cursor: pointer;
            height: 100%;
            transition: background 0.3s;
        }
        .search-box button:hover {
            background: #333;
        }

        /* Capabilities Grid */
        .capabilities-grid-container {
            padding: 30px 0 10px 0;
            background: #fff;
        }
        .capabilities-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            column-gap: 16px;
            row-gap: 16px;
        }

        /* Capability Card */
        .capability-card {
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            position: relative;
            transition: transform 0.3s, box-shadow 0.3s;
            text-decoration: none;
            color: inherit;
            height: 100%;
            min-height: 420px;
            box-sizing: border-box;
        }
        .capability-card h3 {
            font-family: 'Libre Baskerville', serif;
            font-size: 22px;
            font-weight: 700;
            line-height: 30px;
            color: #000000;
            margin-bottom: 12px;
            height: 60px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        .capability-img {
            width: 100%;
            height: 240px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: var(--space-16);
        }
        .capability-desc {
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
            color: #000000;
            margin-bottom: var(--space-16);
            margin-left: 4px;
            padding: 0 54px 0 0;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 72px;
        }
        .capability-link {
            position: absolute;
            right: 15px;
            bottom: 28px;
            width: 46.67px;
            height: 46.67px;
            flex-shrink: 0;
            border-radius: 50%;
            border: 1.5px solid #000000;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            text-decoration: none;
            transition: all 0.3s;
        }
        .capability-link:hover {
            background: #000;
            color: #fff;
            border-color: #000;
        }

        @media (max-width: 1400px) {
            /* Container handles width gracefully */
        }

        @media (max-width: 1200px) {
            .capabilities-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 992px) {
            .capabilities-hero {
                /* Let .container handle horizontal padding */
            }
            /* search-section padding handled by .container */
            .capabilities-grid-container {
                padding: var(--space-64) 0;
            }
            .capabilities-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .capabilities-hero-content {
                grid-template-columns: 1fr;
                gap: var(--space-16);
            }
            .capabilities-hero h1 {
                font-size: 40px;
            }
            .hero-desc-wrapper {
                padding-left: 0;
            }
            .hero-desc-wrapper::before {
                display: none;
            }
        }
        
        @media (max-width: 768px) {
            .container.capabilities-hero-content,
            .container.search-section,
            .container.capabilities-grid {
                padding: 0 16px;
            }
        }

        @media (max-width: 576px) {
            .capabilities-hero {
                height: 500px;
                align-items: flex-end;
                padding-bottom: 60px;
                background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset("images/capability-mobile-view.png") }}') center/cover;
            }
            .capabilities-hero-content {
                display: flex;
                flex-direction: column;
                gap: 16px;
                align-items: flex-start;
                text-align: left;
            }
            .capabilities-hero h1 {
                font-family: 'Libre Baskerville', serif;
                font-weight: 700;
                font-size: 28px;
                line-height: 38px;
                letter-spacing: 0.28px;
                color: #FFFFFF;
                width: 178px;
                height: 38px;
                margin: 0;
            }
            .capabilities-hero p {
                font-family: 'Inter', sans-serif;
                font-weight: 400;
                font-size: 18px;
                line-height: 30px;
                letter-spacing: 0;
                text-align: justify;
                color: #FFFFFF;
                width: 100%;
                max-width: 324px;
                height: auto;
                min-height: 150px;
                margin: 0;
            }
            /* vertical line hidden at 992px */
            .search-section {
                margin-top: -30px;
            }
            .search-card {
                height: 90px;
                width: 100%;
                box-sizing: border-box;
                padding: 0 15px;
                border-radius: 10px;
                box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.15);
                border: none;
            }
            .search-box {
                height: 50px;
                border-radius: 10px;
            }
            .search-icon {
                margin-left: 8px;
                width: 16px;
                height: 16px;
            }
            .search-box input {
                font-family: 'Libre Baskerville', serif;
                font-size: 14px;
                color: #333;
                min-width: 0;
                padding: 0 5px 0 6px;
            }
            .search-box input::placeholder {
                font-family: 'Libre Baskerville', serif;
                font-weight: 400;
                font-size: 13px;
                line-height: 34px;
                color: #000000;
                opacity: 0.5;
            }
            .search-box button {
                padding: 0 12px;
                font-family: 'Libre Baskerville', serif;
                font-size: 14px;
                flex-shrink: 0;
            }
            .capabilities-grid-container {
                padding: 40px 0 30px 0;
                box-sizing: border-box;
                width: 100%;
                overflow-x: hidden;
            }
            .capabilities-grid {
                grid-template-columns: 1fr;
                box-sizing: border-box;
                width: 100%;
            }
            .capability-card {
                height: auto;
                min-height: auto;
                padding: 0 0 24px 0;
                box-sizing: border-box;
                width: 100%;
            }
            .capability-card h3 {
                min-height: 0;
                margin-bottom: 8px;
                word-wrap: break-word;
            }
            br.desktop-br {
                display: none;
            }
            .capability-desc {
                padding-right: 60px;
                margin-bottom: 0;
                width: 100%;
                box-sizing: border-box;
                text-align: left;
            }
            .capability-link {
                bottom: 20px;
                right: 15px;
            }
        }

        /* extraneous block removed */
    </style>
</head>
<body class="antialiased" style="background-color: #ffffff; display: flex; flex-direction: column; min-height: 100vh;">

    @include('components.header')

    <main style="flex-grow: 1; width: 100%;">
    <section class="capabilities-hero">
        <div class="container capabilities-hero-content">
            <div>
                <h1>Capabilities</h1>
            </div>
            <div class="hero-desc-wrapper">
                <p>We advise businesses on complex commercial, infrastructure, and operational matters with practical legal guidance aligned to their strategic objectives.</p>
            </div>
        </div>
    </section>

    <div class="container search-section">
        <div class="search-card">
            <form class="search-box" action="{{ route('capabilities') }}" method="GET">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name">
                <button type="submit">Search</button>
            </form>
        </div>
    </div>

    <section class="capabilities-grid-container">
        <div class="container">
            @if($adminCapabilities->isEmpty())
                <div style="text-align: center; padding: 60px 0; font-family: var(--font-body); font-size: 18px; color: #555;">
                    <p>No capabilities found matching "{{ request('search') }}".</p>
                    <a href="{{ route('capabilities') }}" style="display: inline-block; margin-top: 20px; color: #000; text-decoration: underline; font-weight: 600;">Clear Search</a>
                </div>
            @else
                <div class="capabilities-grid">
                    @foreach($adminCapabilities as $capability)
                        <a href="{{ $capability->slug ? route('capabilities.show', $capability->slug) : '#' }}" class="capability-card">
                            <h3>{{ $capability->title }}</h3>
                            <img src="{{ $capability->image ? asset(strpos($capability->image, '/') !== false ? $capability->image : 'images/' . $capability->image) : asset('images/commercial-imge.png') }}" alt="{{ $capability->title }}" class="capability-img">
                            <p class="capability-desc">{{ $capability->description }}</p>
                            <div class="capability-link">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5.5" y1="18.5" x2="18.5" y2="5.5"></line>
                                    <polyline points="8.5 5.5 18.5 5.5 18.5 15.5"></polyline>
                                </svg>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
    </main>

    @include('components.footer')
</body>
</html>
