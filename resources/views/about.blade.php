<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon-icon.png') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $seo = \App\Models\SeoSetting::forPage('about'); ?>
    <title>{{ $seo->meta_title ?: 'About Us - Niaz Law P.C.' }}</title><link rel="canonical" href="{{ url()->current() }}">
    <meta name="description" content="{{ $seo->meta_description ?: 'Learn about Niaz Law P.C., a trusted Illinois law firm providing expert legal services.' }}">
    <meta name="keywords" content="{{ $seo->meta_keywords ?: 'about Niaz Law, Illinois law firm, legal team, attorneys Illinois' }}">
        <meta name="robots" content="{{ $seo->meta_robots ?: 'index, follow' }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
    <style>
        /* About Us Hero Section */
        .about-hero {
            position: relative;
            width: 100%;
            height: 490px;
            display: flex;
            align-items: center;
            color: #ffffff;
            padding-top: 80px; /* Offset for absolute/fixed header */
        }

        .about-hero-bg {
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0.7) 100%), url('{{ asset("images/About-Us-new.webp") }}') center/cover no-repeat;
        }

        .about-hero-container {
            width: 100%;
            display: flex;
            align-items: center;
        }

        .about-hero-grid {
            display: grid;
            grid-template-columns: auto auto 1fr;
            gap: 48px;
            width: 100%;
            align-items: center;
        }

        .about-hero-title {
            font-family: var(--font-heading);
            font-size: 56px;
            font-weight: 700;
            color: #ffffff;
            margin: 0;
            white-space: nowrap;
            line-height: 1.1;
        }

        .about-hero-divider {
            width: 1px;
            height: 120px;
            background-color: rgba(255, 255, 255, 0.6);
            align-self: center;
        }

        .about-hero-desc {
            font-family: var(--font-body);
            font-size: 18px;
            line-height: 1.6;
            color: #ffffff;
            max-width: 620px;
            margin: 0;
            font-weight: 400;
        }

        /* Overview Section */
        .about-overview-section {
            padding: 24px 0;
            background-color: #ffffff;
        }

        .about-overview-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--space-64);
            align-items: center;
        }

        .about-overview-content h2 {
            font-size: var(--h2-size);
            margin-bottom: var(--space-24);
            font-family: var(--font-heading);
            color: #000000;
        }

        .about-overview-content p {
            font-size: var(--body-reg);
            line-height: 1.8;
            color: #000;
            text-align:justify;
            
        }

        .about-overview-single-img img {
            width: 100%;
            height: auto;
            max-height: 525px;
            object-fit: cover;
            border-radius: 4px;
        }

        .about-overview-images {
            position: relative;
            width: 100%;
            display: flex;
            align-items: flex-end;
        }

        .about-overview-img-below {
            position: relative;
            width: 75%;
            z-index: 1;
            border-radius: 6px;
            margin-top: 15%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .about-overview-img-up {
            position: absolute;
            top: 0;
            right: 0;
            width: 55%;
            z-index: 2;
            border-radius: 6px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        /* Pillars / 3rd Section */
        .pillars-section {
            width: 100%;
            height: auto;
            padding: 80px 0;
            background-image: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)), url('{{ asset("images/about-3rd-sec-img.png") }}');
            background-position: center, center;
            background-size: auto, cover;
            background-repeat: no-repeat, no-repeat;
            display: flex;
            align-items: center;
            color: #ffffff;
        }

        .pillars-border-box {
            border: 1px solid rgba(255, 255, 255, 0.35);
            padding: 48px 40px;
            border-radius: 4px;
            background: rgba(0, 0, 0, 0.15);
            width: 100%;
        }

        .pillars-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            text-align: center;
        }

        .pillar-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
        }

        .pillar-img-icon {
            width: 38px;
            height: 38px;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        .pillar-item h3 {
            font-family: var(--font-heading);
            font-size: 24px;
            font-weight: 700;
            color: #ffffff;
            margin: 0;
            text-align: center;
        }

        .pillar-item p {
            font-family: var(--font-body);
            font-size: 18px;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.85);
            margin: 0;
            font-weight: 400;
            text-align: center;
        }

        /* Vision & Mission Section */
        .vision-mission-section {
            padding: var(--space-64) 0;
            background-color: #ffffff;
        }

        .vision-mission-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 48px;
            align-items: stretch;
        }

        .vm-content {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 16px 0;
        }

        .vm-content h2 {
            font-size: var(--h2-size);
            margin: 0;
            font-family: var(--font-heading);
            color: #000000;
            position: relative;
            padding-bottom: 16px;
        }

        .vm-content h2::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 15px;
            width: 75px;
            height: 1px;
            background-color: #a0a0a0;
        }

        .vm-content p {
            font-size: 14px;
            line-height: 1.8;
            color: #000;
            margin: 0;
            text-align: justify;
        }

        .vm-image {
            height: 100%;
        }

        .vm-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* Practice Areas / Capabilities Grid Section */
        .about-capabilities-section {
            padding: 30px 0;
            background-color: #F8F5EF;
        }

        .about-capabilities-heading {
            font-family: var(--font-heading);
            font-size: 38px;
            font-weight: 700;
            color: #000000;
            text-align: center;
            line-height: 1.25;
            margin-bottom: 48px;
        }

        .about-capabilities-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        .about-cap-card {
            padding: 15px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            position: relative;
            /* transition: transform 0.3s, box-shadow 0.3s; */
            text-decoration: none;
            color: inherit;
            height: auto;
            min-height: 364px;
            width: 100%;
        }
/* 
        .about-cap-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        } */

        .about-cap-card h3 {
            font-family: 'Libre Baskerville', serif;
            font-size: 17px;
            font-weight: 700;
            line-height: 23px;
            color: #000000;
            margin-bottom: var(--space-16);
            min-height: 55px;
        }

        .about-cap-img {
            width: 100%;
            height: 163px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: var(--space-16);
        }

        .about-cap-desc {
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
            max-height: 72px;
        }

        .about-cap-arrow {
            position: absolute;
            right: 15px;
            bottom: 39px;
            width: 40.67px;
            height: 40.67px;
            flex-shrink: 0;
            border-radius: 50%;
            border: 1.5px solid #000000;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            text-decoration: none;
            transition: all 0.3s;
            font-weight:bold;
            font-size:20px;

        }

        .about-cap-arrow:hover {
            background: #000;
            color: #fff;
            border-color: #000;
        }

        /* Results Highlight Section */
        .about-results-section {
            padding: var(--space-48) 0;
            background-color: #F8F5EF;
        }

        .about-results-card {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset("images/we-deliver-results.jpg") }}') center/cover;
            padding: var(--space-64);
            border-radius: 12px;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            min-height: 320px;
        }

        .about-results-card h2 {
            font-size: 32px;
            font-style: italic;
            line-height: 1.4;
            max-width: 850px;
            margin-bottom: var(--space-24);
        }

        .about-results-card .tagline {
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            border-bottom: 2px solid #ffffff;
            padding-bottom: 4px;
        }

        /* Team & Leadership Highlight */
        .about-team-section {
            padding: var(--space-64) 0;
            background-color: #ffffff;
        }

        .about-team-card {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: var(--space-48);
            align-items: center;
            background: #F8F5EF;
            border-radius: 12px;
            overflow: hidden;
            padding: var(--space-32);
        }

        .about-team-img img {
            width: 100%;
            height: 340px;
            object-fit: cover;
            border-radius: 8px;
        }

        .about-team-info h3 {
            font-size: 28px;
            margin-bottom: var(--space-8);
        }

        .about-team-info .role {
            font-size: 16px;
            font-weight: 600;
            color: #666666;
            margin-bottom: var(--space-16);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .about-team-info p {
            font-size: 16px;
            line-height: 1.7;
            color: #333333;
            margin-bottom: var(--space-24);
        }

        .show-on-mobile-inline {
            display: none;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 1024px) {
            .about-hero-grid {
                gap: 24px;
            }
            .about-hero-title {
                font-size: 42px;
            }
            .about-overview-grid {
                grid-template-columns: 1fr;
            }
            .pillars-grid {
                grid-template-columns: 1fr;
            }
            .vision-mission-grid {
                grid-template-columns: 1fr;
                gap: 32px;
            }
            .about-capabilities-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .about-team-card {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .about-hero {
                height: 500px;
                min-height: 500px;
                padding-top: 80px;
                padding-bottom: 40px;
                align-items: flex-end;
            }
            .about-hero-bg {
                background-image: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.6) 100%), url('{{ asset("images/About-Us-new.webp") }}');
                background-position: center, 63% center;
                background-size: auto, cover;
                background-repeat: no-repeat, no-repeat;
            }
            .hide-on-mobile {
                display: none;
            }
            .show-on-mobile-inline {
                display: inline;
            }
            .about-overview-section {
                padding: 20px 0;
            }
            .about-capabilities-section {
                padding: 40px 0;
            }
            .about-capabilities-heading {
                font-size: 25px;
                padding: 0 10px;
            }
            .about-capabilities-grid {
                grid-template-columns: 1fr;
            }
            .about-cap-card {
                max-width: 100%;
            }
            .about-hero-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
            .about-hero-divider {
                display: none;
            }
            .pillars-section {
                padding: 40px 0;
            }
            .vision-mission-section {
                margin-top: 15px;
                padding: 0;
                background-color: transparent;
            }
            .pillars-border-box {
                padding: 32px 16px;
            }
            .pillars-grid {
                gap: 32px;
            }
            .about-hero-title {
                font-size: 34px;
            }
            .about-hero-desc {
                font-size: 17px;
                letter-spacing: 1px;
                text-align: justify;
            }
            .about-overview-grid {
                display: flex;
                flex-direction: column-reverse;
                gap: 32px;
            }
            .about-capabilities-grid {
                grid-template-columns: 1fr;
            }
            .about-people-grid {
                grid-template-columns: 1fr;
            }
        }

        /* People Behind Practice Section */
        .about-people-section {
            padding: var(--space-64) 0;
            background-color: #ffffff;
        }
        
        .about-people-section h2 {
            font-size: 32px;
            font-family: var(--font-heading);
            margin-bottom: var(--space-48);
            color: #111111;
        }

        .about-people-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            justify-items: center;
        }

        .about-people-card {
            display: flex;
            flex-direction: column;
            background-color: #F8F5EF;
            text-decoration: none;
            color: inherit;
            width: 100%;
            max-width: 364px;
            height: 100%;
            overflow: hidden;
            margin: 0 auto;
            border-radius:5px;
        }

        .about-people-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            object-position: center;
            display: block;
        }

        .about-people-info {
            padding: 20px 24px;
            flex: 1;
            display: flex;
            flex-direction: column;
            background-color: #F8F5EF;
        }

        .about-people-info h3 {
            font-family: var(--font-heading);
            font-size: 20px;
            font-weight: 700;
            margin: 0 0 2px 0;
            color: #111111;
            line-height: 1.25;
        }

        .about-people-info .role {
            font-family: var(--font-body);
            font-size: 13px;
            font-weight: 700;
            color: #111111;
            margin: 0 0 10px 0;
        }
        .about-people-info .designation {
            font-family: var(--font-body);
            font-size: 13px;
            font-weight: 700;
            color: #111111;
            margin: 0 0 4px;
            line-height: 1.3;
        }

        .about-people-details {
            font-family: var(--font-body);
            font-size: 13px;
            color: #333333;
            line-height: 1.5;
        }

        .about-people-details .location {
            color: #666666;
            margin: 0 0 2px 0;
        }

        .about-people-details .email {
            font-weight: 700;
            color: #111111;
            margin: 0 0 2px 0;
        }

        .about-people-details .phone {
            color: #333333;
            margin: 0;
        }

        @media (max-width: 1024px) {
            .about-people-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .about-people-section {
                padding: 40px 0;
            }
            .about-people-section h2 {
                font-size: 28px;
                margin-bottom: 24px;
            }
            .about-people-grid {
                grid-template-columns: 1fr;
                gap: 24px;
            }
        }
    </style>
</head>
<body class="antialiased">

    {{-- Header Component inside 1440px container without CSS conflicts --}}
    @include('components.header')

    {{-- Full Width Hero Section with 1440px Constrained Content --}}
    <section class="about-hero about-hero-bg">
        <div class="container about-hero-container">
            <div class="about-hero-grid">
                <h1 class="about-hero-title">Lawyer</h1>
                <div class="about-hero-divider"></div>
                <p class="about-hero-desc">
                   Experienced legal counsel focused on complex business matters, strategic transactions, and practical solutions tailored to each client’s needs.                </p>
            </div>
        </div>
    </section>

    {{-- 1440px Constrained Section 1: Overview & History --}}
    <section class="about-overview-section">
        <div class="container">
            <div class="about-overview-grid">
                <div class="about-overview-content">
                    <h2>Legal Insight <br class="hide-on-mobile">Shaped By<br>Business Realities.</h2>
                    <p>
                        We advise businesses on complex commercial and strategic matters where legal considerations intersect with operations, transactions, projects, and long-term business objectives. Our work spans commercial agreements, infrastructure-related matters, procurement, aviation, and other business-critical arrangements.
                    </p>
                    <p>
                        Our approach is grounded in understanding how legal decisions affect the broader commercial environment. We work closely with clients to identify key issues, structure agreements, manage contractual obligations, and address risk in a practical manner that supports informed decision-making and sustainable business relationships.
                    </p>
                </div>
                <div class="about-overview-single-img">
                    <img src="{{ asset('images/aboutus-2nd-sec-img.png') }}" alt="Legal Insight - Lady Justice">
                </div>
            </div>
        </div>
    </section>

    {{-- Full Width Background 3rd Section with 1440px Container Inner Box --}}
    <section class="pillars-section">
        <div class="container">
            <div class="pillars-border-box">
                <div class="pillars-grid">
                    <div class="pillar-item">
                        <img src="{{ asset('images/pillar-icon1.png') }}" alt="Our Philosophy" class="pillar-img-icon">
                        <h3>Our Philosophy</h3>
                        <p>We provide practical legal guidance by understanding each client's business, priorities, and challenges while helping them make clear and confident decisions.</p>
                    </div>
                    <div class="pillar-item">
                        <img src="{{ asset('images/pillar-icon2.png') }}" alt="Our Principle" class="pillar-img-icon">
                        <h3>Our Principle</h3>
                        <p>We approach every matter with integrity, professionalism, and careful attention while providing clear communication and dependable guidance throughout the legal process.</p>
                    </div>
                    <div class="pillar-item">
                        <img src="{{ asset('images/pillar-icon3.png') }}" alt="Key Of Success" class="pillar-img-icon">
                        <h3>Key Of Success</h3>
                        <p>We believe preparation, collaboration, and sound judgment are essential to managing risk, solving complex issues, and supporting long-term business objectives.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 1440px Constrained 4th Section: Vision & Mission --}}
    <section class="vision-mission-section">
        <div class="container">
            <div class="vision-mission-grid">
                <div class="vm-content">
                    <h2>Our Vision</h2>
                    <p>Our vision is to be a trusted legal partner for businesses navigating complex commercial, infrastructure, and strategic matters. We aim to provide practical, forward-looking legal guidance that helps clients make informed decisions, manage risk, and pursue long-term opportunities with confidence.</p>
                    <p>By combining legal insight with a clear understanding of business priorities, we strive to build lasting client relationships and support sustainable growth across domestic and international markets.</p>
                </div>
                <div class="vm-image">
                    <img src="{{ asset('images/aboutus-4th-sec-img.png') }}" alt="Vision and Mission">
                </div>
                <div class="vm-content">
                    <h2>Our Mission</h2>
                    <p>Our mission is to deliver clear, responsive, and business-focused legal counsel tailored to the unique needs and objectives of each client. We work closely with businesses to identify challenges, structure effective solutions, and guide important transactions and projects.</p>
                    <p>Through integrity, careful analysis, and strong communication, we help clients protect their interests, manage commercial risk, and move complex legal and business matters forward effectively.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- 1440px Constrained Section: What Define Our Practices --}}
    <section class="about-section">
        <div class="container about-container">
            <div class="about-left-col">
                <h2 class="section-title about-section-title">What Defines<br class="desktop-only"> <span class="our-firm-text">Our Practice</span></h2>
                <div class="about-features">
                    <div class="feature">
                        <div class="feature-icon">
                            <img src="{{ asset('images/legacy.png') }}" alt="Legacy">
                        </div>
                        <div>
                            <h4>LEGACY</h4>
                            <p>Built on years of advising businesses across complex commercial, infrastructure, and strategic legal matters.</p>
                        </div>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">
                            <img src="{{ asset('images/integraty.svg') }}" alt="Integrity">
                        </div>
                        <div>
                            <h4>INTEGRITY</h4>
                            <p>We provide clear, dependable legal guidance with professionalism, discretion, and a strong sense of responsibility.</p>
                        </div>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">
                            <img src="{{ asset('images/community.svg') }}" alt="Community">
                        </div>
                        <div>
                            <h4>COMMUNITY</h4>
                            <p>We focus on understanding client priorities and delivering practical legal solutions that support informed business decisions.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="about-images">
                <img src="{{ asset('images/Community-new.webp') }}" alt="Community" class="about-img-below">
                <img src="{{ asset('images/Legacy-new.webp') }}" alt="Legacy" class="about-img-up">
            </div>
        </div>
    </section>

    {{-- 1440px Constrained Section: Focused Where Business And Law Intersect --}}
    <section class="about-capabilities-section">
        <div class="container">
            <h2 class="about-capabilities-heading">Focused Where Business<br>And Law Intersect</h2>
            <div class="about-capabilities-grid">
                @foreach($aboutCapabilities as $capability)
                <a href="{{ route('capabilities.show', ['capability' => $capability->slug ?: $capability->id]) }}" class="about-cap-card">
                    <div>
                        <h3>{{ $capability->title }}</h3>
                        <img class="about-cap-img" src="{{ $capability->image ? asset(strpos($capability->image,'/') !== false ? $capability->image : 'images/'.$capability->image) : asset('images/commercial-imge.png') }}" alt="{{ $capability->title }}">
                    </div>
                    <div class="about-cap-bottom">
                        <p class="about-cap-desc">{{ $capability->description }}</p>
                        <div class="about-cap-arrow">↗</div>
                    </div>
                </a>
                @endforeach
                @if($aboutCapabilities->isEmpty())<p>No capabilities available yet.</p>@endif
                @if(false)
                <a href="/capabilities" class="about-cap-card">
                    <div>
                        <h3>Procurement <br class="hide-on-mobile">& Contracting</h3>
                        <img src="{{ asset('images/contracting-imge.png') }}" alt="Procurement & Contracting">
                    </div>
                    <div class="about-cap-bottom">
                        <p>Legal support for procurement processes, vendor relationships and commercial risk.</p>
                        <div class="about-cap-arrow">↗</div>
                    </div>
                </a>
                <a href="/capabilities" class="about-cap-card">
                    <div>
                        <h3>Infrastructure <br class="hide-on-mobile">& Projects</h3>
                        <img src="{{ asset('images/project-imge.png') }}" alt="Infrastructure & Projects">
                    </div>
                    <div class="about-cap-bottom">
                        <p>Counsel for project structures, contractual obligations and stakeholder relationships.</p>
                        <div class="about-cap-arrow">↗</div>
                    </div>
                </a>
                <a href="/capabilities" class="about-cap-card">
                    <div>
                        <h3>Operational <br class="hide-on-mobile">Risk</h3>
                        <img src="{{ asset('images/Operational-imge.png') }}" alt="Operational Risk">
                    </div>
                    <div class="about-cap-bottom">
                        <p>Practical guidance to identify and manage operational legal risk.</p>
                        <div class="about-cap-arrow">↗</div>
                    </div>
                </a>
                @endif
            </div>
        </div>
    </section>

    {{-- 1440px Constrained Section: The People Behind the Practice --}}
    <section class="about-people-section">
        <div class="container">
            <h2>The People Behind the Practice</h2>
            <div class="about-people-grid">
                @foreach($aboutAttorneys as $attorney)
                <a class="about-people-card" href="{{ route('attorneys.detail', $attorney) }}">
                    <img src="{{ $attorney->photo ? asset(strpos($attorney->photo, '/') !== false ? $attorney->photo : 'images/'.$attorney->photo) : asset('images/aboutus-last-img.jpg') }}" alt="{{ $attorney->name }}">
                    <div class="about-people-info">
                        <h3>{{ $attorney->name }}</h3>
                        @if($attorney->designation)<p class="designation">{{ $attorney->designation }}</p>@endif
                        <p class="role">{{ $attorney->title ?: ($attorney->practice ?: 'Attorney') }}</p>
                        <div class="about-people-details">
                            <p class="location">{{ $attorney->location ?: 'Illinois' }}</p>
                            @if($attorney->email)<p class="email">{{ $attorney->email }}</p>@endif
                            @if($attorney->phone)<p class="phone">{{ $attorney->phone }}</p>@endif
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Footer Component --}}
    @include('components.footer')

    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>
