<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Career Opening - Niaz Law P.C.</title>
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

        /* Full Width Main */
        .main { margin-left: 250px; padding: 36px 48px; width: calc(100% - 250px); max-width: 100%; }
        .wrap { width: 100%; max-width: 100%; background: #fff; padding: 36px; border: 1px solid #ddd; border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,.03); }
        .wrap h1 { margin: 16px 0 24px; font: 400 30px Georgia, serif; }
        .field { width: 100%; margin-bottom: 22px; }
        .field label { display: block; font: 700 14px Arial; color: #222; margin-bottom: 8px; }
        .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        input, select {
            box-sizing: border-box; width: 100%; padding: 12px 14px;
            border: 1px solid #cfc9be; border-radius: 4px; font: 15px Arial;
        }
        button {
            padding: 13px 26px; background: #1e3022; color: #fff; border: 0;
            border-radius: 4px; font: 700 14px Arial; cursor: pointer; transition: opacity .2s;
        }
        button:hover { opacity: .9; }
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
        
        <details class="career-nav-group" open>
            <summary class="career-nav-title">
                <span>Career Management</span>
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m6 9 6 6 6-6"/></svg>
            </summary>
            <div class="career-nav-sub">
                <a class="{{ $opening->track === 'attorneys' ? 'active-sub' : '' }}" href="{{ route('admin.careers.edit', ['track' => 'attorneys']) }}">
                    <span>Attorneys</span>
                </a>
                <a class="{{ $opening->track === 'professional-staff' ? 'active-sub' : '' }}" href="{{ route('admin.careers.edit', ['track' => 'professional-staff']) }}">
                    <span>Professional Staff</span>
                </a>
                <a href="{{ route('admin.careers.edit') }}" style="opacity: 0.75; font-size: 12px;">
                    <span>All Tracks</span>
                </a>
            </div>
        </details>

        <a href="{{ route('admin.contact-settings.edit') }}">Contact Us</a>
        <a href="{{ route('admin.footer-settings.edit') }}">Footer Settings</a>
        <a href="{{ route('admin.seo-settings.edit') }}">SEO Settings</a>
    </aside>

    <main class="main">
        <div class="wrap">
            <a href="{{ route('admin.careers.edit', ['track' => $opening->track]) }}" style="color:#80612c;text-decoration:none;font-weight:bold;font-size:13px;">← Back to Career Management</a>
            <h1>Edit Opening</h1>
            
            <form method="post" action="{{ route('admin.careers.openings.update', $opening) }}">
                @csrf
                @method('PUT')
                
                <div class="field-row">
                    <div class="field">
                        <label>Category</label>
                        <select name="track">
                            <option value="attorneys" {{ $opening->track === 'attorneys' ? 'selected' : '' }}>Attorneys</option>
                            <option value="professional-staff" {{ $opening->track === 'professional-staff' ? 'selected' : '' }}>Professional Staff</option>
                        </select>
                    </div>

                    <div class="field">
                        <label>Role Title</label>
                        <input name="title" value="{{ old('title', $opening->title) }}" required>
                    </div>
                </div>

                <div class="field">
                    <label>Location / Employment Type</label>
                    <input name="location" value="{{ old('location', $opening->location) }}" required>
                </div>

                <div class="field">
                    <label>Full Job Description / Requirements (Rich Editor)</label>
                    <textarea class="tinymce-editor" name="description">{{ old('description', $opening->description) }}</textarea>
                </div>

                <div class="field">
                    <label style="display:flex;align-items:center;gap:10px;cursor:pointer;font-weight:normal;">
                        <input style="width:auto;margin:0;" type="checkbox" name="active" value="1" {{ $opening->active ? 'checked' : '' }}>
                        <span style="font-weight:bold;">Active (Show this opening on website)</span>
                    </label>
                </div>

                <button type="submit">Save Changes</button>
            </form>
        </div>
    </main>

    <!-- TinyMCE Rich Text Editor CDN & Initialization with Image Upload -->
    <script src="https://cdn.jsdelivr.net/npm/tinymce@7.9.1/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '.tinymce-editor',
            height: 360,
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

        document.querySelector('form').addEventListener('submit', () => tinymce.triggerSave());
    </script>
</body>
</html>
