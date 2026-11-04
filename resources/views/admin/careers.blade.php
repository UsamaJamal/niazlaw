<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Career Management {{ $currentTrack ? '— ' . ($currentTrack === 'attorneys' ? 'Attorneys' : 'Professional Staff') : '' }} - Niaz Law P.C.</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; background: #f6f4ef; font: 15px Arial, sans-serif; color: #1a1a1a; }
        .side {
            position: fixed; inset: 0 auto 0 0; width: 250px; padding: 25px 14px;
            background: linear-gradient(160deg, #15191a, #050606); color: #fff; z-index: 10;
            overflow-y: auto;
        }
        .side img { width: 114px; margin: 0 11px 28px; }
        .side p { margin: 0 12px 10px; color: #c9bd9f; font: 700 9px Arial; letter-spacing: .2em; text-transform: uppercase; }
        .side a {
            display: block; padding: 12px; color: #f6f4ef; text-decoration: none; font: 14px Georgia, serif;
            border-left: 2px solid transparent; border-radius: 4px; transition: all .2s;
        }
        .side a:hover, .side a.active {
            border-left-color: #c29c53;
            background: linear-gradient(90deg, rgba(175, 137, 67, .32), rgba(175, 137, 67, .08));
            color: #fff;
        }

        /* Career Dropdown inside Sidebar */
        .career-nav-group { margin: 2px 0; }
        .career-nav-title {
            display: flex; align-items: center; justify-content: space-between;
            padding: 12px; color: #f6f4ef; font: 14px Georgia, serif; cursor: pointer;
            list-style: none; border-left: 2px solid #c29c53; border-radius: 4px;
            background: linear-gradient(90deg, rgba(175, 137, 67, .32), rgba(175, 137, 67, .08));
            user-select: none;
        }
        .career-nav-title::-webkit-details-marker { display: none; }
        .career-nav-title svg { transition: transform 0.25s ease; color: #c29c53; }
        .career-nav-group[open] .career-nav-title svg { transform: rotate(180deg); }
        .career-nav-sub {
            margin: 4px 0 6px 14px; padding-left: 10px;
            border-left: 1px solid rgba(194, 156, 83, 0.4);
            display: flex; flex-direction: column; gap: 3px;
        }
        .career-nav-sub a {
            display: block !important; padding: 8px 12px !important; font-size: 13px !important;
            color: #dfdad1 !important; text-decoration: none !important; border: none !important;
            border-radius: 4px !important; background: transparent !important;
        }
        .career-nav-sub a:hover, .career-nav-sub a.active-sub {
            color: #fff !important; background: rgba(175, 137, 67, 0.25) !important; font-weight: bold;
        }

        /* Main Container - Full Width */
        .main { margin-left: 250px; padding: 36px 48px; width: calc(100% - 250px); max-width: 100%; }
        .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 16px; }
        .top-bar h1 { margin: 0; font: 400 32px Georgia, serif; color: #15191a; }
        .track-badge {
            display: inline-block; padding: 7px 16px; background: #c29c53; color: #fff;
            border-radius: 20px; font: 700 12px Arial; text-transform: uppercase; letter-spacing: 0.1em;
        }
        .track-tabs { display: flex; gap: 8px; margin-bottom: 25px; border-bottom: 2px solid #ddd; width: 100%; }
        .track-tab {
            padding: 12px 24px; text-decoration: none; font: 700 14px Arial; color: #555;
            border-bottom: 3px solid transparent; margin-bottom: -2px; transition: all .2s;
        }
        .track-tab:hover { color: #000; }
        .track-tab.active { color: #c29c53; border-bottom-color: #c29c53; background: #fff; }

        /* Full Width Card */
        .card {
            margin: 24px 0; padding: 32px; background: #fff; border: 1px solid #ddd;
            border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,.03); width: 100%;
        }
        .card h2 { margin: 0 0 20px; font: 400 24px Georgia, serif; color: #222; border-bottom: 1px solid #eee; padding-bottom: 12px; }
        .field { width: 100%; margin-bottom: 24px; }
        .field label { display: block; font: 700 14px Arial; color: #222; margin-bottom: 8px; }
        .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        input, select {
            box-sizing: border-box; width: 100%; padding: 12px 14px;
            border: 1px solid #cfc9be; border-radius: 4px; font: 15px Arial;
        }
        button, .btn-action {
            padding: 13px 24px; background: #1e3022; color: #fff; border: 0; border-radius: 4px;
            font: 700 14px Arial; cursor: pointer; text-decoration: none; display: inline-block;
            transition: opacity .2s;
        }
        button:hover, .btn-action:hover { opacity: .9; }
        .edit-btn { background: #b28a48; }
        .opening {
            display: flex; justify-content: space-between; align-items: center;
            padding: 18px 0; border-top: 1px solid #eee; gap: 16px;
        }
        .actions { display: flex; gap: 8px; }
        .actions form { margin: 0; }
        .msg-success { padding: 14px 18px; background: #e7f3eb; color: #1e5c32; border-radius: 4px; margin-bottom: 20px; font-weight: bold; }

        @media (max-width: 900px) {
            .side { position: relative; width: 100%; }
            .main { margin-left: 0; width: 100%; padding: 20px; }
            .field-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <aside class="side">
        <a href="{{ route('admin.dashboard') }}"><img src="{{ asset('images/header-logo.png') }}" alt="Niaz Law"></a>
        <p>WEBSITE MANAGEMENT</p>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.home-settings.edit') }}">Home Page Setting</a>
        <a href="{{ route('admin.attorneys.create') }}">Add Attorney</a>
        <a href="{{ route('admin.attorneys.details') }}">Attorney Detail Page</a>
        <a href="{{ route('admin.capabilities.index') }}">Capabilities</a>
        <a href="{{ route('admin.capabilities.pages') }}">Capability Pages</a>
        
        <!-- Career Management with Dropdown Arrow -->
        <details class="career-nav-group" open>
            <summary class="career-nav-title">
                <span>Career Management</span>
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m6 9 6 6 6-6"/></svg>
            </summary>
            <div class="career-nav-sub">
                <a class="{{ $currentTrack === 'attorneys' ? 'active-sub' : '' }}" href="{{ route('admin.careers.edit', ['track' => 'attorneys']) }}">
                    <span>Attorneys</span>
                </a>
                <a class="{{ $currentTrack === 'professional-staff' ? 'active-sub' : '' }}" href="{{ route('admin.careers.edit', ['track' => 'professional-staff']) }}">
                    <span>Professional Staff</span>
                </a>
                <a class="{{ !$currentTrack ? 'active-sub' : '' }}" href="{{ route('admin.careers.edit') }}" style="opacity: 0.75; font-size: 12px;">
                    <span>All Tracks</span>
                </a>
            </div>
        </details>

        <a href="{{ route('admin.contact-settings.edit') }}">Contact Us</a>
        <a href="{{ route('admin.footer-settings.edit') }}">Footer Settings</a>
        <a href="{{ route('admin.seo-settings.edit') }}">SEO Settings</a>
    </aside>

    <main class="main">
        <div class="top-bar">
            <div>
                <h1>Career Management</h1>
                <p style="color:#666;margin:6px 0 0;">Manage public career page rich content and job openings with full TinyMCE editor.</p>
            </div>
            @if($currentTrack)
                <span class="track-badge">{{ $currentTrack === 'attorneys' ? 'Attorneys Track' : 'Professional Staff Track' }}</span>
            @endif
        </div>

        @if(session('success'))
            <div class="msg-success">{{ session('success') }}</div>
        @endif

        <div class="track-tabs">
            <a class="track-tab {{ !$currentTrack ? 'active' : '' }}" href="{{ route('admin.careers.edit') }}">All Tracks</a>
            <a class="track-tab {{ $currentTrack === 'attorneys' ? 'active' : '' }}" href="{{ route('admin.careers.edit', ['track' => 'attorneys']) }}">Attorneys</a>
            <a class="track-tab {{ $currentTrack === 'professional-staff' ? 'active' : '' }}" href="{{ route('admin.careers.edit', ['track' => 'professional-staff']) }}">Professional Staff</a>
        </div>

        <!-- Career Content Form - Full Width with TinyMCE -->
        <form class="card" method="post" action="{{ route('admin.careers.update') }}">
            @csrf
            @method('PUT')
            <h2>Page Content & Rich Descriptions (Full Width)</h2>

            @if(!$currentTrack || $currentTrack === 'attorneys')
                <div style="margin-bottom:32px;">
                    <h3 style="margin:0 0 16px;font:400 20px Georgia;color:#80612c;border-bottom:1px solid #eee;padding-bottom:8px;">Attorneys Track</h3>
                    
                    <div class="field">
                        <label>Attorney Overview Paragraph</label>
                        <textarea class="tinymce-editor" name="attorney_overview">{{ old('attorney_overview', $settings->attorney_overview) }}</textarea>
                    </div>

                    <div class="field">
                        <label>Attorney Career Advancement</label>
                        <textarea class="tinymce-editor" name="attorney_advancement">{{ old('attorney_advancement', $settings->attorney_advancement) }}</textarea>
                    </div>
                </div>
            @endif

            @if(!$currentTrack || $currentTrack === 'professional-staff')
                <div style="margin-bottom:32px;">
                    <h3 style="margin:0 0 16px;font:400 20px Georgia;color:#80612c;border-bottom:1px solid #eee;padding-bottom:8px;">Professional Staff Track</h3>
                    
                    <div class="field">
                        <label>Professional Staff Overview Paragraph</label>
                        <textarea class="tinymce-editor" name="staff_overview">{{ old('staff_overview', $settings->staff_overview) }}</textarea>
                    </div>

                    <div class="field">
                        <label>Professional Staff Career Advancement</label>
                        <textarea class="tinymce-editor" name="staff_advancement">{{ old('staff_advancement', $settings->staff_advancement) }}</textarea>
                    </div>
                </div>
            @endif

            <div class="field">
                <label>Application Notification Recipient Email</label>
                <input type="email" name="application_email" value="{{ old('application_email', $settings->application_email) }}" placeholder="e.g. faisal@niazlawpc.com">
            </div>

            <button type="submit">Save Content</button>
        </form>

        <!-- Add Opening Form - Full Width with TinyMCE -->
        <form class="card" method="post" action="{{ route('admin.careers.openings.store') }}">
            @csrf
            <h2>Add Current Opening</h2>

            <div class="field-row">
                <div class="field">
                    <label>Track Category</label>
                    <select name="track">
                        <option value="attorneys" {{ ($currentTrack === 'attorneys' || old('track') === 'attorneys') ? 'selected' : '' }}>Attorneys</option>
                        <option value="professional-staff" {{ ($currentTrack === 'professional-staff' || old('track') === 'professional-staff') ? 'selected' : '' }}>Professional Staff</option>
                    </select>
                </div>
                <div class="field">
                    <label>Role Title</label>
                    <input name="title" required value="{{ old('title') }}" placeholder="e.g. Associate Attorney">
                </div>
            </div>

            <div class="field">
                <label>Location / Employment Type</label>
                <input name="location" required value="{{ old('location') }}" placeholder="e.g. Franklin Park, IL · Full-time">
            </div>

            <div class="field">
                <label>Full Job Description / Requirements (Rich Editor)</label>
                <textarea class="tinymce-editor" name="description" placeholder="Enter job responsibilities, qualifications, and requirements...">{{ old('description') }}</textarea>
            </div>

            <button type="submit">Add Opening</button>
        </form>

        <!-- Current Openings List -->
        <section class="card">
            <h2>Current Openings ({{ $openings->count() }})</h2>

            @forelse($openings as $opening)
                <div class="opening">
                    <div>
                        <b style="font-size:16px;">{{ $opening->title }}</b>
                        <span style="display:inline-block;margin-left:8px;padding:3px 10px;border-radius:3px;font-size:11px;font-weight:bold;background:{{ $opening->track === 'attorneys' ? '#e9ecef' : '#f0f3e9' }};color:#333;">
                            {{ $opening->track === 'attorneys' ? 'Attorneys' : 'Professional Staff' }}
                        </span>
                        <div style="color:#666;font-size:13px;margin-top:4px;">{{ $opening->location }}</div>
                    </div>
                    <div class="actions">
                        <a class="btn-action edit-btn" href="{{ route('admin.careers.openings.edit', $opening) }}">Edit</a>
                        <form method="post" action="{{ route('admin.careers.openings.destroy', $opening) }}" onsubmit="return confirm('Delete opening?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:#a1281e;">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <p style="color:#777;margin:10px 0;">No openings found {{ $currentTrack ? 'for this track' : '' }}.</p>
            @endforelse
        </section>
    </main>

    <!-- TinyMCE Rich Text Editor CDN & Initialization with Image Upload -->
    <script src="https://cdn.jsdelivr.net/npm/tinymce@7.9.1/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '.tinymce-editor',
            height: 300,
            menubar: 'insert edit view format tools table',
            branding: false,
            promotion: false,
            statusbar: true,
            resize: true,
            toolbar_mode: 'sliding',
            font_size_formats: '8px 10px 12px 14px 16px 18px 20px 22px 24px 26px 28px 30px 32px 34px 36px 38px 40px 42px 44px 46px 48px 50px 52px 54px 56px 60px 64px 72px',
            plugins: 'advlist autolink lists link image charmap searchreplace visualblocks code fullscreen table wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image table | removeformat | code fullscreen',
            content_style: 'body{font-family:Arial,sans-serif;font-size:15px;line-height:1.65;padding:12px;color:#1a1a1a}p{margin:0 0 1em}ul,ol{margin:0 0 1em;padding-left:1.5em}img{max-width:100%;height:auto;border-radius:4px;}',
            image_title: true,
            automatic_uploads: true,
            images_upload_url: '{{ route("admin.careers.upload-image") }}',
            images_upload_handler: function (blobInfo, progress) {
                return new Promise(function (resolve, reject) {
                    var xhr = new XMLHttpRequest();
                    xhr.withCredentials = false;
                    xhr.open('POST', '{{ route("admin.careers.upload-image") }}');
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                    xhr.upload.onprogress = function (e) {
                        progress(e.loaded / e.total * 100);
                    };
                    xhr.onload = function () {
                        if (xhr.status < 200 || xhr.status >= 300) {
                            reject('HTTP Error: ' + xhr.status);
                            return;
                        }
                        var json = JSON.parse(xhr.responseText);
                        if (!json || typeof json.location != 'string') {
                            reject('Invalid JSON: ' + xhr.responseText);
                            return;
                        }
                        resolve(json.location);
                    };
                    xhr.onerror = function () {
                        reject('Image upload failed.');
                    };
                    var formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());
                    formData.append('_token', '{{ csrf_token() }}');
                    xhr.send(formData);
                });
            },
            file_picker_types: 'image',
            file_picker_callback: function (cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function () {
                    var file = this.files[0];
                    var formData = new FormData();
                    formData.append('file', file);
                    formData.append('_token', '{{ csrf_token() }}');

                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', '{{ route("admin.careers.upload-image") }}');
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                    xhr.onload = function () {
                        if (xhr.status >= 200 && xhr.status < 300) {
                            var json = JSON.parse(xhr.responseText);
                            cb(json.location, { title: file.name });
                        } else {
                            alert('Upload failed: ' + xhr.statusText);
                        }
                    };
                    xhr.send(formData);
                };
                input.click();
            }
        });

        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', () => tinymce.triggerSave());
        });
    </script>
</body>
</html>
