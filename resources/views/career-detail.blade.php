<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon-icon.png') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $career['title'] }} | Niaz Law P.C.</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
    <style>
        .career-detail {
            padding: 105px 0 85px;
            background: #f7f4ee;
            color: #182119;
        }
        .career-detail__wrap {
            width: min(1170px, calc(100% - 48px));
            margin: auto;
        }
        .career-hero-card {
            border-radius: 14px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 12px 32px rgba(0, 0, 0, .08);
            border: 1px solid #e2ddd3;
            margin-bottom: 28px;
        }
        .career-detail__hero {
            display: grid;
            grid-template-columns: 1fr 1fr;
            height: 360px;
            background: linear-gradient(135deg, #1b2e21 0%, #152219 50%, #0e1611 100%);
            overflow: hidden;
            margin: 0;
            padding: 0;
            border: 0;
        }
        .career-detail__title {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            padding: 42px 48px;
            color: #f8f5ef;
        }
        .career-detail__title h1 {
            margin: 0;
            font: 400 clamp(38px, 4.2vw, 60px)/1.02 Georgia, serif;
            color: #ffffff;
        }
        .career-detail__title p {
            max-width: 390px;
            margin: 18px 0 0;
            color: #e1e6e2;
            font: 16px/1.55 Arial, sans-serif;
        }
        .career-detail__image {
            height: 360px;
            margin: 0;
            padding: 0;
        }
        .career-detail__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .career-tabs {
            display: flex;
            height: 62px;
            min-height: 62px;
            background: #fff;
            margin: 0;
            padding: 0;
            border: 0;
            align-items: stretch;
        }
        .career-tab {
            min-width: 220px;
            margin: 0 !important;
            border: 0 !important;
            border-right: 1px solid #ede8de !important;
            border-radius: 0 !important;
            padding: 0 30px !important;
            background: #fff;
            color: #273027;
            font: 600 15px Arial, sans-serif;
            text-align: left;
            cursor: pointer;
            display: flex;
            align-items: center;
            height: 100%;
            box-shadow: none !important;
            outline: none !important;
            transition: background .2s ease, color .2s ease;
        }
        .career-tab:first-child.active {
            border-bottom-left-radius: 13px !important;
        }
        .career-tab:hover {
            background: #faf8f4;
            color: #111;
        }
        .career-tab.active {
            background: #152219 !important;
            color: #fff !important;
            box-shadow: none !important;
        }
        .career-panel {
            display: none;
            max-width: 800px;
            padding: 45px 50px 20px;
            font: 17px/1.7 Arial, sans-serif;
            color: #3e443e;
            background: #fff;
            border-radius: 12px;
            border: 1px solid #e6e1d7;
            box-shadow: 0 4px 16px rgba(0, 0, 0, .04);
            margin-top: 10px;
        }
        .career-panel.active {
            display: block;
        }
        .career-panel h2 {
            margin: 0 0 18px;
            color: #111111;
            font: 400 34px Georgia, serif;
        }
        .career-panel p {
            margin: 0;
        }
        .career-opening {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
            padding: 20px 0;
            border-top: 1px solid #cfc8ba;
            color: #111111;
            font: 400 20px Georgia, serif;
        }
        .career-actions {
            display: flex;
            gap: 14px;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 24px;
        }
        .career-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 13px 26px;
            font-family: 'Inter', Arial, sans-serif;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: .02em;
            text-decoration: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all .25s ease;
            border: none;
            outline: none;
            line-height: 1;
            white-space: nowrap;
            box-sizing: border-box;
        }
        .career-btn svg {
            transition: transform .2s ease;
            flex-shrink: 0;
        }
        .career-btn:hover svg {
            transform: translateX(4px);
        }
        .career-btn--primary {
            background: #18281d;
            color: #fff !important;
            border: 1.5px solid #18281d;
            box-shadow: 0 4px 14px rgba(24, 40, 29, .2);
        }
        .career-btn--primary:hover {
            background: #253c2d;
            border-color: #253c2d;
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(24, 40, 29, .28);
        }
        .career-btn--outline {
            background: #fff;
            color: #18281d !important;
            border: 1.5px solid #18281d;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .04);
        }
        .career-btn--outline:hover {
            background: #18281d;
            color: #fff !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(24, 40, 29, .2);
        }

        /* Highly Refined Compact Modal Styles */
                .app-modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 1000;
            background: rgba(14, 18, 15, 0.72);
            padding: 16px;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }
        .app-modal-card {
            width: min(540px, 94vw);
            max-height: 92vh;
            overflow-y: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
            padding: 22px 26px 20px;
            background: #ffffff;
            color: #182119;
            border-radius: 14px;
            box-shadow: 0 24px 60px rgba(0, 0, 0, .40);
            border: 1px solid rgba(0, 0, 0, 0.08);
            box-sizing: border-box;
            position: relative;
            animation: modalFadeIn 0.25s ease-out;
        }
        .app-modal-card::-webkit-scrollbar {
            display: none;
            width: 0;
            height: 0;
        }
        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(8px) scale(0.98); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        .app-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
            padding-bottom: 10px;
            padding-right: 36px;
            border-bottom: 1px solid #ece7dd;
        }
        .app-modal-title {
            margin: 0 0 4px;
            font: 400 20px/1.2 Georgia, serif;
            color: #121813;
        }
        .app-role-pill {
            display: inline-block;
            background: #f4efe6;
            color: #795d24;
            font: 600 11.5px/1 'Inter', Arial, sans-serif;
            padding: 3px 9px;
            border-radius: 14px;
            border: 1px solid #e2d7c5;
            text-transform: none !important;
            letter-spacing: normal;
        }
        .app-modal-close {
            position: absolute;
            top: 18px;
            right: 18px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 0;
            background: #f5f2ec;
            color: #555;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            z-index: 5;
        }
        .app-modal-close:hover {
            background: #18281d;
            color: #fff;
        }
        .app-modal-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 9px 12px;
        }
        .app-field {
            display: flex;
            flex-direction: column;
        }
        .app-field.full {
            grid-column: 1 / -1;
        }
        .app-field label.app-label {
            font: 600 12px/1.2 'Inter', Arial, sans-serif;
            text-transform: none !important;
            letter-spacing: normal;
            color: #2a332b;
            margin-bottom: 4px;
        }
        .app-field input,
        .app-field textarea {
            width: 100%;
            box-sizing: border-box;
            padding: 0 11px;
            height: 37px;
            font: 13.5px 'Inter', Arial, sans-serif;
            border: 1px solid #d4cdc3;
            border-radius: 6px;
            background: #faf8f5;
            color: #1a1a1a;
            outline: none;
            transition: border-color .2s ease, background .2s ease, box-shadow .2s ease;
        }
        .app-field input:focus,
        .app-field textarea:focus {
            border-color: #18281d;
            background: #ffffff;
            box-shadow: 0 0 0 2px rgba(24, 40, 29, 0.08);
        }
        .app-field textarea {
            height: 46px;
            min-height: 46px;
            padding: 7px 11px;
            resize: vertical;
        }
        .app-file-card {
            display: flex !important;
            align-items: center;
            justify-content: space-between;
            padding: 7px 11px;
            background: #faf8f5;
            border: 1.5px dashed #cfc7ba;
            border-radius: 6px;
            cursor: pointer;
            transition: all .2s ease;
            box-sizing: border-box;
            text-transform: none !important;
            margin-bottom: 0 !important;
        }
        .app-file-card:hover {
            border-color: #18281d;
            background: #f4f0e8;
        }
        .app-file-card.has-file {
            border-color: #1e5c32;
            background: #f0f7f2;
        }
        .app-file-left {
            display: flex;
            align-items: center;
            gap: 9px;
            overflow: hidden;
            text-transform: none !important;
        }
        .app-file-icon {
            width: 28px;
            height: 28px;
            border-radius: 5px;
            background: #ebe5da;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #18281d;
            flex-shrink: 0;
        }
        .app-file-card.has-file .app-file-icon {
            background: #d4ebd9;
            color: #1e5c32;
        }
        .app-file-info {
            display: flex;
            flex-direction: column;
            overflow: hidden;
            text-transform: none !important;
        }
        .app-file-name {
            font: 600 12.5px 'Inter', Arial, sans-serif;
            color: #18281d;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 230px;
            text-transform: none !important;
            letter-spacing: normal;
        }
        .app-file-hint {
            font: 400 11px 'Inter', Arial, sans-serif;
            color: #666;
            text-transform: none !important;
            letter-spacing: normal;
        }
        .app-file-browse {
            font: 600 11.5px 'Inter', Arial, sans-serif;
            text-transform: none !important;
            letter-spacing: normal;
            padding: 5px 11px;
            background: #18281d;
            color: #ffffff;
            border-radius: 5px;
            flex-shrink: 0;
            transition: opacity 0.2s;
        }
        .app-file-browse:hover {
            opacity: 0.9;
        }
        .app-modal-error {
            padding: 8px 12px;
            background: #fde8e8;
            border: 1px solid #f8b4b4;
            color: #9b1c1c;
            border-radius: 6px;
            font: 600 12.5px Arial, sans-serif;
            margin-bottom: 10px;
        }

        /* Success View Styles */
        .app-modal-success {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 16px 8px 8px;
        }
        .app-success-badge {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: #eaf5ed;
            border: 2px solid #b7dfbe;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #18281d;
            margin-bottom: 14px;
            animation: bounceIn 0.35s ease-out;
        }
        @keyframes bounceIn {
            0% { transform: scale(0.6); opacity: 0; }
            70% { transform: scale(1.1); }
            100% { transform: scale(1); opacity: 1; }
        }
        .app-success-title {
            margin: 0 0 8px;
            font: 400 24px/1.2 Georgia, serif;
            color: #121813;
        }
        .app-success-msg {
            margin: 0 0 20px;
            font: 400 14px/1.5 Arial, sans-serif;
            color: #4a544b;
            max-width: 360px;
        }

        @media(max-width:768px){
            .career-detail { padding-top: 0 !important; }
            .career-detail__wrap { width: 100%; }
            .career-hero-card { border-radius: 0; border: 0; margin-top: 0; }
            .career-detail__hero { grid-template-columns: 1fr; height: auto; }
            .career-detail__title { min-height: 220px; padding: 95px 24px 30px; }
            .career-detail__image { height: 210px; }
            .career-tabs { height: 54px; min-height: 54px; overflow-x: auto; }
            .career-tab { min-width: auto; padding: 0 20px !important; font-size: 14px; white-space: nowrap; }
            .career-tab:first-child.active { border-bottom-left-radius: 0 !important; }
            .career-panel { padding: 30px 20px 0; border-radius: 0; border: 0; box-shadow: none; }
            .career-opening { align-items: flex-start; flex-direction: column; }
            .app-modal-grid { grid-template-columns: 1fr; }
            .app-modal-card { padding: 22px 20px; }
        }
        .career-rich-text p { margin: 0 0 8px; line-height: 1.6; }
        .career-rich-text ul, .career-rich-text ol { margin: 0 0 8px; padding-left: 24px; }
        .career-rich-text li { margin-bottom: 4px; }
        .career-rich-text div { margin: 0 0 8px; }
        .career-rich-text .career-actions { display: none !important; }
        .career-rich-text p:empty, .career-rich-text div:empty { display: none; }
        .career-read-more-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin: 6px 0 16px;
            padding: 4px 0;
            background: none;
            border: none;
            color: #1b2e21;
            font: 600 13.5px/1 'Inter', Arial, sans-serif;
            cursor: pointer;
            text-decoration: underline;
            text-underline-offset: 3px;
            transition: color .2s ease;
        }
        .career-read-more-btn:hover {
            color: #795d24;
        }
        .career-read-more-btn svg {
            transition: transform 0.25s ease;
        }
        .career-read-more-btn.is-active svg {
            transform: rotate(180deg);
        }
        .career-desc-more {
            animation: fadeInDesc 0.25s ease-out;
        }
        @keyframes fadeInDesc {
            from { opacity: 0; transform: translateY(-4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="antialiased" style="display:flex;flex-direction:column;min-height:100vh">
@include('components.header')
<main class="career-detail" style="flex-grow:1">
    <div class="career-detail__wrap">
        <div class="career-hero-card">
            <section class="career-detail__hero">
                <div class="career-detail__title">
                    <h1>{{ $career['title'] }}</h1>
                    <p>{{ $track === 'attorneys' ? 'Build a rewarding legal practice with a team that values judgment, initiative and client relationships.' : 'Bring your skills to a collaborative team where every contribution supports exceptional client service.' }}</p>
                </div>
                <div class="career-detail__image">
                    <img src="{{ asset('images/'.$career['image']) }}" alt="{{ $career['image_alt'] }}">
                </div>
            </section>
            <div class="career-tabs" role="tablist" aria-label="{{ $career['title'] }} information">
                <button class="career-tab active" type="button" role="tab" aria-selected="true" data-panel="overview">Overview</button>
                @if($track === 'attorneys')
                    <button class="career-tab" type="button" role="tab" aria-selected="false" data-panel="advancement">Career Advancement</button>
                @endif
                <button class="career-tab" type="button" role="tab" aria-selected="false" data-panel="openings">Current Openings</button>
            </div>
        </div>

        <section class="career-panel active" id="overview">
            <h2>Build your future with us</h2>
            <div class="career-rich-text">{!! $career['overview'] !!}</div>
        </section>

        @if($track === 'attorneys')
            <section class="career-panel" id="advancement">
                <h2>Career advancement</h2>
                <div class="career-rich-text">{!! $career['advancement'] !!}</div>
            </section>
        @endif

        <section class="career-panel" id="openings">
            <h2>Current openings</h2>
            @forelse($career['openings'] as $opening)
                <article style="padding:28px 0;border-top:1px solid #cfc8ba">
                    <h3 style="margin:0 0 6px;font:400 25px Georgia">{{ $opening->title }}</h3>
                    <p style="color:#666;margin-bottom:16px">{{ $opening->location }}</p>
                    @if($opening->description)
                        @php
                            $desc = $opening->description;
                            if (strpos($desc, '<p') === false && strpos($desc, '<div') === false) {
                                $desc = '<p>' . implode('</p><p>', array_map('nl2br', preg_split('/\r?\n\s*\r?\n/', trim($desc)))) . '</p>';
                            }
                        @endphp
                        <div class="career-opening-desc career-rich-text" style="margin:10px 0 16px;">{!! $desc !!}</div>
                    @endif
                    <div class="career-actions">
                        <button class="career-btn career-btn--primary" type="button" data-opening="{{ $opening->title }}">
                            <span>Apply here</span>
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </button>
                        <a class="career-btn career-btn--outline" href="mailto:{{ config('services.contact_inquiries.recipient') }}?subject={{ rawurlencode('Application: '.$opening->title) }}">
                            <span>Email your CV</span>
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </a>
                    </div>
                </article>
            @empty
                <p>No current openings are listed. Please check back soon.</p>
            @endforelse
        </section>
    </div>
</main>
@include('components.footer')

<!-- Highly Refined Compact Application Modal (No Scrollbar, Clean Typography) -->
<div id="application-modal" class="app-modal-overlay">
    <div class="app-modal-card">
        <!-- Close Button -->
        <button type="button" id="close-application" class="app-modal-close" aria-label="Close">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>

        <!-- Application Form -->
        <form id="application-form" method="post" action="{{ route('careers.apply') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="opening" id="application-opening">

            <div class="app-modal-header">
                <div>
                    <h2 class="app-modal-title">Apply for Opening</h2>
                    <span class="app-role-pill" id="application-role">Role</span>
                </div>
            </div>

            <div id="app-modal-error" class="app-modal-error" style="display:none;"></div>

            <div class="app-modal-grid">
                <div class="app-field full">
                    <label class="app-label">Full Name *</label>
                    <input required name="name" placeholder="John Doe">
                </div>

                <div class="app-field">
                    <label class="app-label">Email Address *</label>
                    <input required type="email" name="email" placeholder="john@example.com">
                </div>

                <div class="app-field">
                    <label class="app-label">Phone Number *</label>
                    <input required name="phone" placeholder="(555) 000-0000">
                </div>

                <div class="app-field full">
                    <label class="app-label">Attach Resume / CV (PDF)</label>
                    <input type="file" name="resume" id="app-resume-file" accept=".pdf,application/pdf" style="display:none;">
                    <label for="app-resume-file" class="app-file-card" id="app-file-card">
                        <div class="app-file-left">
                            <div class="app-file-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg>
                            </div>
                            <div class="app-file-info">
                                <span class="app-file-name" id="app-resume-name">Select PDF Resume</span>
                                <span class="app-file-hint" id="app-resume-hint">Max file size: 10MB</span>
                            </div>
                        </div>
                        <span class="app-file-browse">Browse</span>
                    </label>
                </div>

                <div class="app-field full">
                    <label class="app-label">Cover Note (Optional)</label>
                    <textarea name="message" rows="2" placeholder="Brief note or message to the hiring team..."></textarea>
                </div>
            </div>

            <button id="app-submit-btn" class="career-btn career-btn--primary" type="submit" style="width:100%;margin-top:10px;padding:11px 18px;border-radius:6px;font-size:14px;">
                <span>Submit Application</span>
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </button>
        </form>

        <!-- Success Confirmation View -->
        <div id="app-modal-success" class="app-modal-success" style="display:none;">
            <div class="app-success-badge">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#18281d" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            </div>
            <h3 class="app-success-title">Application Received!</h3>
            <p class="app-success-msg">Thank you! Your request is being reviewed by our team, and we will get back to you soon.</p>
            <button type="button" id="app-success-close-btn" class="career-btn career-btn--primary" style="padding:10px 30px;border-radius:6px;">
                <span>Close</span>
            </button>
        </div>
    </div>
</div>

<script>
    // Read More toggle for Opening Descriptions (after 2 paragraphs)
    document.querySelectorAll('.career-opening-desc').forEach(descEl => {
        const children = Array.from(descEl.children);
        if (children.length > 2) {
            const moreContainer = document.createElement('div');
            moreContainer.className = 'career-desc-more';
            moreContainer.style.display = 'none';
            for (let i = 2; i < children.length; i++) {
                moreContainer.appendChild(children[i]);
            }
            const toggleBtn = document.createElement('button');
            toggleBtn.type = 'button';
            toggleBtn.className = 'career-read-more-btn';
            toggleBtn.setAttribute('aria-expanded', 'false');
            toggleBtn.innerHTML = '<span>Read more</span> <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>';
            toggleBtn.addEventListener('click', () => {
                const isHidden = moreContainer.style.display === 'none';
                if (isHidden) {
                    moreContainer.style.display = 'block';
                    toggleBtn.querySelector('span').textContent = 'Read less';
                    toggleBtn.classList.add('is-active');
                    toggleBtn.setAttribute('aria-expanded', 'true');
                } else {
                    moreContainer.style.display = 'none';
                    toggleBtn.querySelector('span').textContent = 'Read more';
                    toggleBtn.classList.remove('is-active');
                    toggleBtn.setAttribute('aria-expanded', 'false');
                }
            });
            descEl.appendChild(moreContainer);
            descEl.appendChild(toggleBtn);
        }
    });

    // Tab switching
    document.querySelectorAll('.career-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            document.querySelectorAll('.career-tab').forEach(item => {
                item.classList.toggle('active', item === tab);
                item.setAttribute('aria-selected', String(item === tab));
            });
            document.querySelectorAll('.career-panel').forEach(panel => {
                panel.classList.toggle('active', panel.id === tab.dataset.panel);
            });
        });
    });

    // Modal elements
    const modal = document.getElementById('application-modal');
    const form = document.getElementById('application-form');
    const submitBtn = document.getElementById('app-submit-btn');
    const modalSuccess = document.getElementById('app-modal-success');
    const modalError = document.getElementById('app-modal-error');
    const fileInput = document.getElementById('app-resume-file');
    const fileCard = document.getElementById('app-file-card');
    const fileName = document.getElementById('app-resume-name');
    const closeBtn = document.getElementById('close-application');
    const successCloseBtn = document.getElementById('app-success-close-btn');

    // Open modal buttons
    document.querySelectorAll('[data-opening]').forEach(b => {
        b.onclick = () => {
            modal.style.display = 'flex';
            document.getElementById('application-opening').value = b.dataset.opening;
            document.getElementById('application-role').textContent = b.dataset.opening;
            form.style.display = 'block';
            modalSuccess.style.display = 'none';
            modalError.style.display = 'none';
        };
    });

    // Close modal function
    const closeModal = () => {
        modal.style.display = 'none';
    };

    closeBtn.onclick = closeModal;
    successCloseBtn.onclick = closeModal;

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModal();
        }
    });

    // File input change feedback
    fileInput.addEventListener('change', () => {
        const hint = document.getElementById('app-resume-hint');
        if (fileInput.files && fileInput.files[0]) {
            fileName.textContent = fileInput.files[0].name;
            if (hint) hint.textContent = 'File attached (click to change)';
            fileCard.classList.add('has-file');
        } else {
            fileName.textContent = 'Select PDF Resume';
            if (hint) hint.textContent = 'Max file size: 10MB';
            fileCard.classList.remove('has-file');
        }
    });

    // AJAX Form submission with real-time success screen
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        submitBtn.disabled = true;
        const originalBtnHTML = submitBtn.innerHTML;
        submitBtn.innerHTML = '<span>Submitting application...</span>';
        modalError.style.display = 'none';

        const formData = new FormData(form);

        try {
            const res = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });

            const data = await res.json();

            if (res.ok && data.success) {
                form.style.display = 'none';
                modalSuccess.style.display = 'flex';
                form.reset();
                fileName.textContent = 'Select PDF Resume';
                const hint = document.getElementById('app-resume-hint');
                if (hint) hint.textContent = 'Max file size: 10MB';
                fileCard.classList.remove('has-file');
            } else {
                modalError.textContent = data.message || (data.errors ? Object.values(data.errors).flat().join(' ') : 'An error occurred. Please check your inputs and try again.');
                modalError.style.display = 'block';
            }
        } catch (err) {
            modalError.textContent = 'Network error or application failed. Please try again or email your CV directly.';
            modalError.style.display = 'block';
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnHTML;
        }
    });

    // Check if session has success from standard redirect
    @if(session('success'))
        modal.style.display = 'flex';
        form.style.display = 'none';
        modalSuccess.style.display = 'flex';
    @endif
</script>
</body>
</html>
