<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
    <title>SEO Settings - Niaz Law P.C.</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
    <style>
        *{box-sizing:border-box}
        .seo-shell{min-height:100vh;display:grid;grid-template-columns:250px 1fr;background:#f6f4ef}
        .seo-side{min-height:100vh;padding:25px 14px;background:linear-gradient(160deg,#15191a,#050606);color:#fff;overflow-y:auto}
        .seo-logo{display:block;margin:0 11px 29px;padding-bottom:23px;border-bottom:1px solid rgba(255,255,255,.14)}
        .seo-logo img{width:114px}
        .seo-label{margin:0 12px 11px;color:#c9bd9f;font:700 9px Arial;letter-spacing:.24em}
        .seo-nav a{display:flex;align-items:center;gap:13px;padding:12px;margin:2px 0;border-left:2px solid transparent;border-radius:6px;color:#f6f4ef;font:14px Georgia;text-decoration:none}
        .seo-nav a:hover,.seo-nav a.active{border-left-color:#c29c53;background:linear-gradient(90deg,rgba(175,137,67,.32),rgba(175,137,67,.08))}
        .seo-nav svg{width:18px;height:18px}
        .seo-main{padding:38px clamp(20px,5vw,60px) 60px}
        .seo-content{max-width:980px;margin:auto}
        .seo-header{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:32px;gap:20px}
        .seo-header h1{margin:0;font:700 38px Georgia;color:#171717}
        .seo-header p{margin:8px 0 0;color:#666;font:15px Arial}
        .seo-back{padding:12px 16px;border:1px solid #222;background:#fff;color:#111;font:700 13px Arial;text-decoration:none;white-space:nowrap}
        .seo-success{padding:14px 18px;background:#f3ede0;border-left:3px solid #9b7a40;color:#51452f;margin-bottom:24px;font:15px Arial}

        /* Page Card */
        .page-card{background:#fff;border:1px solid #dfdad1;border-radius:10px;margin-bottom:20px;overflow:hidden}
        .page-card__head{display:flex;align-items:center;gap:14px;padding:18px 24px;background:#fff;border-bottom:1px solid #ede8df;cursor:pointer;user-select:none}
        .page-card__head:hover{background:#fdfcfb}
        .page-card__icon{display:flex;align-items:center;justify-content:center;color:#ffb900}
        .page-card__icon svg{width:22px;height:22px}
        .page-card__title{font:700 18px "Arial", sans-serif;color:#003366}
        .page-card__badge{margin-left:auto;font:13px Arial;color:#888}
        .page-card__body{padding:24px 24px 40px;display:none;background:#fff}
        .page-card__body.open{display:block}

        /* Fields */
        .seo-field{margin-bottom:24px}
        .seo-field label{display:block;font:700 15px "Arial", sans-serif;color:#003366;margin-bottom:10px}
        .seo-field input,.seo-field textarea,.seo-field select{width:100%;padding:14px 16px;border:1px solid #dcdcdc;border-radius:6px;font:15px Arial;color:#171717;background:#fff;transition:border-color .2s}
        .seo-field input:focus,.seo-field textarea:focus,.seo-field select:focus{outline:none;border-color:#003366;box-shadow: 0 0 0 2px rgba(0,51,102,0.1)}
        .seo-field textarea{min-height:120px;resize:vertical}
        .char-hint{margin-top:8px;font:13px Arial;color:#888}
        .char-hint.bad{color:#c62828}
        .preview-box{margin-top:14px;padding:14px 16px;background:#f5f8ff;border:1px solid #d0daf5;border-radius:6px}
        .preview-box__label{font:700 11px Arial;color:#1a73e8;letter-spacing:.08em;text-transform:uppercase;margin-bottom:8px}
        .preview-title{font:700 18px Arial;color:#1a0dab;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
        .preview-url{font:13px Arial;color:#006621;margin:2px 0 4px}
        .preview-desc{font:14px/1.4 Arial;color:#545454}

        /* Save button */
        .seo-save{display:inline-flex;align-items:center;gap:10px;padding:14px 26px;border:0;border-radius:5px;background:#171717;color:#fff;font:700 14px Arial;cursor:pointer;margin-top:8px}
        .seo-save:hover{background:#b28a48}
        .seo-save svg{width:18px;height:18px}

        @media(max-width:850px){
            .seo-shell{grid-template-columns:1fr}
            .seo-side{min-height:auto}
            .seo-nav{display:flex;overflow:auto;gap:3px}
            .seo-label{display:none}
            .seo-nav a{white-space:nowrap;padding:10px}
            .seo-main{padding:24px 18px}
        }
    </style>
</head>
<body>
<div class="seo-shell">
    <aside class="seo-side">
        <a class="seo-logo" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('images/header-logo.png') }}" alt="Niaz Law P.C.">
        </a>
        <p class="seo-label">WEBSITE MANAGEMENT</p>
        <nav class="seo-nav">
            <a href="{{ route('admin.home-settings.edit') }}"><x-admin-icon name="home"/>Home Page Setting</a>
            <a href="{{ route('admin.attorneys.create') }}"><x-admin-icon name="user"/>Add Attorney</a>
            <a href="{{ route('admin.attorneys.details') }}"><x-admin-icon name="users"/>Attorney Detail Page</a>
            <a href="{{ route('admin.capabilities.index') }}"><x-admin-icon name="chart"/>Capabilities</a>
            <a href="{{ route('admin.capabilities.pages') }}"><x-admin-icon name="file"/>Capability Pages</a>
            <a href="{{ route('admin.contact-settings.edit') }}"><x-admin-icon name="mail"/>Contact Us</a>
            <a href="{{ route('admin.footer-settings.edit') }}"><x-admin-icon name="external"/>Footer Settings</a>
            <a class="active" href="{{ route('admin.seo-settings.edit') }}"><x-admin-icon name="edit"/>SEO Settings</a>
            <p style="margin:22px 12px 8px;color:#c9bd9f;font:700 9px Arial;letter-spacing:.24em">INSIGHTS &amp; RESOURCES</p>
            <div style="margin-left:8px">
                <a href="{{ route('admin.blog.index') }}"><x-admin-icon name="edit"/>Blog</a>
                <a href="{{ url('/admin/blog?type=case_study') }}"><x-admin-icon name="file"/>Case Study</a>
                <a href="{{ url('/admin/blog?type=insight') }}"><x-admin-icon name="bulb"/>Insight</a>
            </div>
        </nav>
    </aside>

    <main class="seo-main">
        <div class="seo-content">
            <div class="seo-header">
                <div>
                    <h1>SEO Settings</h1>
                    <p>Har page ka Meta Title, Description aur Keywords yahan se manage karein.</p>
                </div>
                <a class="seo-back" href="{{ route('admin.dashboard') }}">← Back</a>
            </div>

            @if(session('success'))
                <div class="seo-success">✓ {{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.seo-settings.update') }}">
                @csrf @method('PUT')

                @php
                $pageIcons = [
                    'home'         => 'home',
                    'about'        => 'users',
                    'attorneys'    => 'user',
                    'capabilities' => 'chart',
                    'contact'      => 'mail',
                    'blog'         => 'edit',
                    'case-study'   => 'file',
                    'insights'     => 'bulb',
                ];
                $pageUrls = [
                    'home'         => '/',
                    'about'        => '/about',
                    'attorneys'    => '/attorneys',
                    'capabilities' => '/capabilities',
                    'contact'      => '/contact-us',
                    'blog'         => '/blog',
                    'case-study'   => '/case-study',
                    'insights'     => '/insights',
                ];
                @endphp

                @foreach($pages as $pageKey => $pageInfo)
                @php
                    $seo = $seoMap->get($pageKey);
                    $hasSeo = $seo && ($seo->meta_title || $seo->meta_description || $seo->meta_keywords);
                @endphp
                <div class="page-card" id="card-{{ $pageKey }}">
                    <div class="page-card__head" onclick="toggleCard('{{ $pageKey }}')">
                        <div class="page-card__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                        </div>
                        <div>
                            <div class="page-card__title">{{ $loop->iteration }}. {{ $pageInfo['label'] }} Search Engine Optimization (SEO)</div>
                        </div>
                        <span class="page-card__badge">
                            Manage Meta Title, Meta Des...
                        </span>
                    </div>
                    <div class="page-card__body" id="body-{{ $pageKey }}">

                        {{-- Meta Title --}}
                        <div class="seo-field">
                            <label for="title-{{ $pageKey }}">
                                {{ $pageInfo['label'] }} Meta Title
                            </label>
                            <input type="text"
                                id="title-{{ $pageKey }}"
                                name="seo[{{ $pageKey }}][meta_title]"
                                value="{{ old('seo.'.$pageKey.'.meta_title', $seo->meta_title ?? '') }}"
                                placeholder="{{ $pageInfo['default_title'] }}"
                                maxlength="160"
                                oninput="updatePreview('{{ $pageKey }}')">
                            <div class="char-hint">
                                Recommended length: 50-60 characters for optimal Google display.
                            </div>
                        </div>

                        {{-- Meta Description --}}
                        <div class="seo-field">
                            <label for="desc-{{ $pageKey }}">
                                {{ $pageInfo['label'] }} Meta Description
                            </label>
                            <textarea
                                id="desc-{{ $pageKey }}"
                                name="seo[{{ $pageKey }}][meta_description]"
                                maxlength="320"
                                oninput="updatePreview('{{ $pageKey }}')">{{ old('seo.'.$pageKey.'.meta_description', $seo->meta_description ?? '') }}</textarea>
                            <div class="char-hint">
                                Recommended length: 150-160 characters describing your {{ strtolower($pageInfo['label']) }} content.
                            </div>
                        </div>

                        {{-- Meta Keywords --}}
                        <div class="seo-field">
                            <label for="kw-{{ $pageKey }}">
                                {{ $pageInfo['label'] }} Meta Keywords
                            </label>
                            <input type="text"
                                id="kw-{{ $pageKey }}"
                                name="seo[{{ $pageKey }}][meta_keywords]"
                                value="{{ old('seo.'.$pageKey.'.meta_keywords', $seo->meta_keywords ?? '') }}"
                                maxlength="500">
                            <div class="char-hint">
                                Optional: enter relevant keywords separated by commas.
                            </div>
                        </div>

                        {{-- Robots Tag --}}
                        <div class="seo-field">
                            <label for="robots-{{ $pageKey }}">
                                {{ $pageInfo['label'] }} Robots Tag
                            </label>
                            <select
                                id="robots-{{ $pageKey }}"
                                name="seo[{{ $pageKey }}][meta_robots]"
                                >
                                @php($robots = old('seo.'.$pageKey.'.meta_robots', $seo->meta_robots ?? 'index, follow'))
                                <option value="index, follow" {{ $robots === 'index, follow' ? 'selected' : '' }}>index, follow</option>
                                <option value="index, nofollow" {{ $robots === 'index, nofollow' ? 'selected' : '' }}>index, nofollow</option>
                                <option value="noindex, follow" {{ $robots === 'noindex, follow' ? 'selected' : '' }}>noindex, follow</option>
                                <option value="noindex, nofollow" {{ $robots === 'noindex, nofollow' ? 'selected' : '' }}>noindex, nofollow</option>
                            </select>
                            <div class="char-hint">
                                Choose how search engines should index this page.
                            </div>
                        </div>

                        {{-- Google Preview --}}
                        <div class="preview-box">
                            <div class="preview-box__label">🔍 Google Preview</div>
                            <div class="preview-title" id="preview-title-{{ $pageKey }}">{{ optional($seo)->meta_title ?: $pageInfo['default_title'] }}</div>
                            <div class="preview-url">niazlawpc.com{{ $pageUrls[$pageKey] ?? '/'.$pageKey }}</div>
                            <div class="preview-desc" id="preview-desc-{{ $pageKey }}">{{ optional($seo)->meta_description ?: 'No meta description set.' }}</div>
                        </div>

                    </div>
                </div>
                @endforeach

                <button type="submit" class="seo-save">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Save All SEO Settings
                </button>
            </form>
        </div>
    </main>
</div>

<script>
function toggleCard(key) {
    const body = document.getElementById('body-' + key);
    body.classList.toggle('open');
}

function updatePreview(key) {
    const titleInput = document.getElementById('title-' + key);
    const descInput = document.getElementById('desc-' + key);
    const previewTitle = document.getElementById('preview-title-' + key);
    const previewDesc = document.getElementById('preview-desc-' + key);
    if (titleInput && previewTitle) {
        previewTitle.textContent = titleInput.value || titleInput.getAttribute('placeholder') || '';
    }
    if (descInput && previewDesc) {
        previewDesc.textContent = descInput.value || 'No meta description set.';
    }
}

// Auto-open a card if it has unsaved/old data
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.page-card__body').forEach(body => {
        const key = body.id.replace('body-', '');
        const titleInput = document.getElementById('title-' + key);
        const descInput = document.getElementById('desc-' + key);
        if ((titleInput && titleInput.value) || (descInput && descInput.value)) {
            body.classList.add('open');
        }
    });
});
</script>
</body>
</html>
