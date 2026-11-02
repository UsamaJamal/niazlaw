<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon-icon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $attorney->meta_title ?: ($attorney->name . ' - Attorney | Niaz Law P.C.') }}</title><link rel="canonical" href="{{ url()->current() }}">
    <meta name="description" content="{{ $attorney->meta_description ?: ('Learn about ' . $attorney->name . ', ' . ($attorney->title ?? 'Attorney') . ' at Niaz Law P.C.') }}">
    <meta name="keywords" content="{{ $attorney->meta_keywords ?: ($attorney->name . ', attorney Illinois, lawyer Illinois, Niaz Law attorney, ' . ($attorney->title ?? 'legal counsel') . ', Illinois law firm') }}">
    <meta name="robots" content="{{ $attorney->robots ?: 'index, follow' }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Attorney detail page: matches the supplied Figma/PDF composition. */
        .attorney-hero {
            position: relative;
            display: block;
            height: 411px;
            padding: 126px 0 0;
            box-sizing: border-box;
            color: #fff;
            background: linear-gradient(rgba(23, 29, 32, .52), rgba(23, 29, 32, .52)), url('{{ asset('images/Attorney-Page-new.webp') }}') center / cover;
        }
        .attorney-hero::before {
            display: none;
            position: absolute;
            z-index: 0;
            inset: -8px;
            content: '';
            filter: blur(3px);
        }
        .attorney-hero__container {
            position: relative;
            z-index: 1;
            height: 100%;
        }
        .attorney-title {
            display: flex;
            align-items: center;
            gap: 22px;
        }
        .attorney-title h1 {
            flex: 0 0 auto;
            margin: 0;
            color: #fff;
            font: 700 clamp(42px, 4vw, 58px) / 1.1 Georgia, serif;
        }
        .attorney-title .attorney-title-line {
            flex: 1;
            height: 1px;
            background: rgba(255, 255, 255, .66);
        }
        .attorney-title .share-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-decoration: none;
        }
        .attorney-profile {
            position: absolute;
            z-index: 2;
            top: 104px;
            left: var(--space-100, 100px);
            display: flex;
            align-items: flex-start;
            gap: 25px;
        }
        .attorney-profile img {
            display: block;
            width: 242px;
            height: 242px;
            object-fit: cover;
            object-position: center top;
        }
        .attorney-profile__meta {
            min-width: 230px;
            padding-top: 8px;
            color: #fff;
        }
        .attorney-profile__meta h3 {
            margin: 0 0 12px;
            color: #fff;
            font: 700 25px / 1.1 Georgia, serif;
        }
        .attorney-profile__meta p {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0 0 12px;
            color: #fff;
            font-size: 14px;
            line-height: 1.15;
            overflow-wrap: anywhere;
        }
        .attorney-profile__meta p svg {
            flex-shrink: 0;
            color: #fff;
        }
        .attorney-profile__meta a {
            color: inherit;
            text-decoration: none;
        }
        .attorney-profile__meta a:hover,
        .attorney-profile__meta a:focus-visible {
            text-decoration: underline;
            text-underline-offset: 3px;
        }
        .attorney-meta-row {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
        .attorney-profile__meta > .email { display: none; }
        .attorney-meta-row .phone,
        .attorney-meta-row .email--mobile,
        .attorney-meta-row .location { display: inline-flex; align-items: center; gap: 8px; margin: 0; }
        .email--mobile { display: inline-flex !important; }
        .attorney-contact-actions {
            display: flex;
            width: max-content;
            margin-top: 7px;
            border: 1px solid rgba(255, 255, 255, .34);
        }
        .attorney-contact-actions a,
        .attorney-contact-actions button {
            display: inline-flex;
            width: 37px;
            height: 37px;
            align-items: center;
            justify-content: center;
            border: 0;
            border-right: 1px solid rgba(255, 255, 255, .34);
            background: rgba(0, 0, 0, .12);
            color: #fff;
            cursor: pointer;
            text-decoration: none;
        }
        .attorney-contact-actions > :last-child { border-right: 0; }
        .attorney-contact-actions a:hover,
        .attorney-contact-actions button:hover { background: rgba(255, 255, 255, .16); text-decoration: none; }
        .attorney-overview {
            min-height: 201px;
            box-sizing: border-box;
            padding: 38px 0 28px;
            background: #f8f5ef;
        }
        .attorney-overview__inner {
            padding-left: 267px;
        }
        .attorney-experience-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 270px;
            gap: 54px;
            align-items: start;
        }
        .attorney-practice-sidebar {
            padding: 3px 0 3px 25px;
            border-left: 1px solid #cfcfcf;
        }
        .attorney-practice-sidebar h3 {
            margin: 0 0 13px;
            color: #080808;
            font: 700 20px / 1.2 Georgia, serif;
        }
        .attorney-practice-sidebar h4 {
            margin: 0 0 9px;
            color: #252525;
            font: 700 16px / 1.35 Georgia, serif;
        }
        .industry-practice-group + .industry-practice-group { margin-top: 23px; }
        .attorney-practice-sidebar ul {
            margin: 0;
            padding-left: 18px;
        }
        .attorney-practice-sidebar li {
            margin: 0 0 9px;
            padding-left: 2px;
            color: #252525;
            font-size: 14px;
            line-height: 1.4;
        }
        .attorney-practice-sidebar a {
            color: inherit;
            text-decoration: none;
        }
        .attorney-overview h2,
        .attorney-section h2 {
            margin: 0;
            color: #080808;
            font: 700 31px / 1.1 Georgia, serif;
        }
        .attorney-overview h2::after,
        .attorney-credentials > h2::after {
            content: '';
            display: block;
            width: 41px;
            height: 2px;
            margin-top: 11px;
            background: #000;
        }
        .attorney-overview p {
            max-width: 1060px;
            margin: 18px 0 0;
            font-size: 15px;
            line-height: 1.7;
            letter-spacing: .01em;
        }
        .attorney-content {
            padding-top: 50px;
            padding-bottom: 0;
        }
        .attorney-section { margin: 0 0 30px; }
        .attorney-section h2 { margin-bottom: 21px; }
        .attorney-section p,
        .attorney-section li {
            font-size: 14px;
            line-height: 1.7;
            letter-spacing: .01em;
        }
        .attorney-section p { margin: 0; }
        .attorney-section ul {
            margin: 18px 0 0 17px;
            padding-left: 0px;
            list-style: disc;
        }
        .attorney-section li {
            display: list-item;
            margin: 11px 0;
            padding-left: 2px;
        }

        .attorney-columns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 68px;
        }
        .attorney-columns > div + div {
            border-left: 1px solid #cfcfcf;
            padding-left: 68px;
        }
        .attorney-columns h3 {
            margin: 0;
            font: 700 25px / 1.15 Georgia, serif;
        }
        .attorney-insights { margin-top: 36px; margin-bottom: 40px; }
        .attorney-insights > h2 { margin-bottom: 27px; }
        .attorney-insights__grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 60px;
        }
        .attorney-insight-card {
            display: grid;
            grid-template-columns: 43% 1fr;
            gap: 24px;
        }
        .attorney-insight-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }
        .attorney-insight-card h3 {
            margin: 10px 0 14px;
            padding-bottom: 13px;
            border-bottom: 1px solid #aaa;
            font: 700 20px / 1.06 Georgia, serif;
        }
        .attorney-insight-card p { font-size: 13px; line-height: 1.5; }
        .attorney-insight-card a {
            display: inline-flex;
            min-width: 150px;
            min-height: 39px;
            align-items: center;
            justify-content: center;
            margin-top: 4px;
            padding: 8px 20px;
            background: #050505;
            color: #fff;
            font-size: 13px;
        }
        @media (max-width: 1024px) {
            .attorney-hero { height: 365px; padding-top: 120px; }
            .attorney-profile { top: 95px; left: var(--space-32, 32px); }
            .attorney-profile img { width: 190px; height: 205px; }
            .attorney-overview__inner { padding-left: 215px; }
            .attorney-experience-layout { grid-template-columns: minmax(0, 1fr) 230px; gap: 32px; }
            .attorney-insights__grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 768px) {
            .attorney-profile { left: 25px; }
        }
        @media (max-width: 650px) {
            .attorney-hero { height: auto; min-height: 0; padding: 112px 24px 32px; overflow: hidden; }
            .attorney-hero::before { display: block; background: linear-gradient(rgba(6, 12, 22, .42), rgba(6, 12, 22, .48)), url('{{ asset('images/attorney-hero-mobile-v3.png') }}') center / cover; }
            .attorney-hero__container { height: auto; }
            .attorney-title { display: none; }
            .attorney-title h1 { font-size: 28px; line-height: 33px; text-align: center; }
            .attorney-title .attorney-title-line, .attorney-title .share-icon { display: none; }
            .attorney-profile { position: relative; top: auto; left: auto; margin: 0; gap: 18px; flex-direction: column; align-items: center; }
            .attorney-profile img { width: 240px; height: 200px; border: 2px solid rgba(255, 255, 255, .55); border-radius: 12px; }
            .attorney-profile__meta { padding-top: 0; min-width: 0; color: #fff; text-align: center; width: 100%; display: flex; flex-direction: column; align-items: center; }
            .attorney-profile__meta::before { content: attr(data-attorney-name); margin-bottom: 12px; color: #fff; font: 700 28px / 1.1 Georgia, serif; }
            .attorney-profile__meta h3 { color: #fff; font-size: 19px; line-height: 21px; margin-bottom: 10px; font-weight:500; font-family: Georgia, serif; text-align: center; }
            .attorney-profile__meta p { color: #fff; font-size: 14px; line-height: 20px; margin-bottom: 0; justify-content: center; }
            .attorney-profile__meta .email { display: inline-flex; align-items: center; justify-content: center; gap: 8px; margin-bottom: 8px; }
            .attorney-meta-row { display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px; width: 100%; max-width: 100%; box-sizing: border-box; }
            .attorney-profile__meta .phone, .attorney-profile__meta .email--mobile, .attorney-profile__meta .location { display: inline-flex; align-items: center; justify-content: center; gap: 6px; margin: 0; white-space: nowrap; font-size: 13px; }
            .attorney-profile__meta > .email { display: none; }
            .attorney-profile__meta .email--mobile { display: inline-flex !important; }
            .attorney-profile__meta .phone svg, .attorney-profile__meta .location svg { width: 14px; height: 14px; flex-shrink: 0; }
            .attorney-overview { min-height: auto; padding: 32px 0; }
            .attorney-overview .container { padding: 0 16px; }
            .attorney-overview__inner { padding-left: 0; text-align: justify; }
            .attorney-experience-layout { grid-template-columns: 1fr; gap: 30px; }
            .attorney-practice-sidebar { padding: 24px 0 0; border-top: 1px solid #cfcfcf; border-left: 0; }
            .attorney-content { padding-top: 27px; padding-bottom: 0px; text-align: justify;}
            .attorney-credentials > h2 { display: block; }
            .attorney-credentials > h2::after { display: block; width: 65px; margin-top: 12px; margin-left: 0; }
            .attorney-columns { grid-template-columns: 1fr; gap: 36px; }
            .attorney-columns > div + div { border: 0; padding: 0; }
            .attorney-insight-card { grid-template-columns: 1fr; gap: 0; }
            .attorney-insight-card:nth-child(n+2) { display: none; }
        }
    </style>
</head>
<body>
    @include('components.header')

    @php
        $experiencePoints = preg_split('/\r\n|\r|\n/', $attorney->experience_points ?: '');
        $educationItems = preg_split('/\r\n|\r|\n/', $attorney->education ?: '');
        $admissionItems = preg_split('/\r\n|\r|\n/', $attorney->admissions ?: '');
        $capabilityItems = $attorney->capabilities->sortBy(fn ($capability) => strtolower($capability->title));
    @endphp

    <main>
        <section class="attorney-hero">
            <div class="container attorney-hero__container">
                <div class="attorney-title">
                <h1>{{ $attorney->name }}</h1>
                <div class="attorney-title-line"></div>
                <a href="#" class="share-icon" title="Share">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                        <path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92s2.92-1.31 2.92-2.92c0-1.61-1.31-2.92-2.92-2.92z"/>
                    </svg>
                </a>
            </div>
            <div class="attorney-profile">
                <img src="{{ asset('images/' . ($attorney->photo ?: 'lawyer_profile.jpg')) }}" alt="{{ $attorney->name }}">
                <div class="attorney-profile__meta" data-attorney-name="{{ $attorney->name }}">
                    <h3>{{ $attorney->title }}</h3>
                    @if($attorney->email)
                        <p class="email">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            <a href="mailto:{{ $attorney->email }}">{{ $attorney->email }}</a>
                        </p>
                    @endif
                    <div class="attorney-meta-row">
                        @if($attorney->phone)
                            <p class="phone">
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $attorney->phone) }}">{{ $attorney->phone }}</a>
                            </p>
                        @endif
                        @if($attorney->email)
                            <p class="email email--mobile">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                <a href="mailto:{{ $attorney->email }}">{{ $attorney->email }}</a>
                            </p>
                        @endif
                        @if($attorney->location)
                            <p class="location">
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                <a href="https://www.google.com/maps/search/?api=1&amp;query={{ urlencode($attorney->location) }}" target="_blank" rel="noopener noreferrer">{{ $attorney->location }}</a>
                            </p>
                        @endif
                    </div>
                    <div class="attorney-contact-actions" aria-label="Attorney profile actions">
                        @if($attorney->linkedin_url)
                        <a href="{{ $attorney->linkedin_url }}" target="_blank" rel="noopener noreferrer" title="Open {{ $attorney->name }}'s LinkedIn profile" aria-label="Open {{ $attorney->name }}'s LinkedIn profile">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true"><path d="M5.1 3.5A2.1 2.1 0 1 1 1 3.5a2.1 2.1 0 0 1 4.1 0zM1.4 8h3.5v11H1.4V8zm5.7 0h3.4v1.5h.1c.5-.9 1.7-1.9 3.6-1.9 3.8 0 4.5 2.5 4.5 5.8V19h-3.5v-4.9c0-1.2 0-2.7-1.7-2.7s-1.9 1.3-1.9 2.6V19H8.1V8z"/></svg>
                        </a>
                        @endif
                        <a href="{{ route('attorneys.vcard', $attorney) }}" title="Download contact card (.vcf)" aria-label="Download {{ $attorney->name }} contact card">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="5" y="3" width="14" height="18" rx="2"/><path d="M9 8h6M9 12h6M9 16h3"/></svg>
                        </a>
                        @if($attorney->profile_pdf)
                        <a href="{{ asset($attorney->profile_pdf) }}" target="_blank" rel="noopener noreferrer" title="Open uploaded profile PDF" aria-label="Open {{ $attorney->name }} profile PDF">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 2h9l3 3v17H6z"/><path d="M15 2v4h4M8 16h8M8 12h8"/></svg>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

        <section class="attorney-overview">
            <div class="container">
                <div class="attorney-overview__inner">
                    <h2>Overview</h2>
                    <p>{{ $attorney->overview ?: 'Attorney overview will be available soon.' }}</p>
                </div>
            </div>
        </section>

        <div class="container attorney-content">
            <section class="attorney-section">
                <div class="attorney-experience-layout">
                    <div>
                        <h2>Experience</h2>
                        <p>{{ $attorney->experience ?: 'Professional experience will be available soon.' }}</p>
                        @if($attorney->experience_points)
                            <ul>
                                @foreach($experiencePoints as $point)
                                    @if(trim($point))<li>{{ $point }}</li>@endif
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    @if($capabilityItems->isNotEmpty())
                    <aside class="attorney-practice-sidebar" aria-label="Capabilities">
                        <h3>Capabilities</h3>
                        <ul>@foreach($capabilityItems as $capability)<li><a href="{{ route('capabilities.show', ['capability' => $capability->slug ?: $capability->id]) }}">{{ $capability->title }}</a></li>@endforeach</ul>
                    </aside>
                    @endif
                </div>
            </section>

            <section class="attorney-section attorney-credentials">
                <h2>Credentials</h2>
                <div class="attorney-columns">
                    <div>
                        <h3>Education</h3>
                        <ul>
                            @foreach($educationItems as $item)
                                @if(trim($item))<li>{{ $item }}</li>@endif
                            @endforeach
                        </ul>
                    </div>
                    <div>
                        <h3>Admissions</h3>
                        <ul>
                            @foreach($admissionItems as $item)
                                @if(trim($item))<li>{{ $item }}</li>@endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </section>

            <section class="attorney-section attorney-insights">
                <h2>Insights And News</h2>
                <div class="attorney-insights__grid">
                    @forelse($attorneyPosts as $post)
                    <article class="attorney-insight-card">
                        @if($post->featured_image_url)<img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}">@endif
                        <div><h3>{{ $post->title }}</h3><p>{{ Str::limit(html_entity_decode(strip_tags($post->content)), 160) }}</p><a href="{{ route('blog.show',$post) }}">Read now</a></div>
                    </article>
                    @empty
                    <p>No insights have been added for this attorney yet.</p>
                    @endforelse
                </div>
            </section>
        </div>
    </main>
    @include('components.footer')
</body>
</html>
