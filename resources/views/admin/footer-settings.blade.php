<!doctype html><html><head><meta charset="utf-8"><title>Footer Settings</title><link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}"><style>
body{margin:0;background:#f6f4ef;font-family:Arial}
.fs-shell{min-height:100vh;display:grid;grid-template-columns:250px 1fr}
.fs-side{width:250px;box-sizing:border-box;padding:25px 14px;background:linear-gradient(160deg,#15191a,#050606);color:#fff}
.fs-side a{display:block;padding:12px;color:#f6f4ef;text-decoration:none;font:14px Georgia}
.fs-side a:hover,.fs-side .active{background:rgba(175,137,67,.3)}
.fs-main{padding:40px;max-width:none;margin:0}
.box{max-width:900px;background:#fff;padding:30px}
.option{display:block;padding:10px;border:1px solid #ddd;margin:6px 0}
.save{padding:13px 22px;background:#171717;color:#fff;border:0}
.success{background:#efe5cd;padding:12px}
.box h1{margin:18px 0 28px;font:700 36px Georgia;color:#171717}
.box h2{margin:28px 0 10px;font:700 24px Georgia;color:#171717}
.box p{font:15px Arial;line-height:1.6;color:#555}
.box .option{font:15px Arial;background:#fafafa;border-radius:4px}
.box .save{font:700 14px Arial;cursor:pointer}
.box .add-page{display:inline-block;background:#b28a48;color:#fff;text-decoration:none;padding:12px 18px;margin-top:10px}
.box .footer-save{display:block;background:#171717;color:#fff;padding:13px 22px;margin-top:28px}
.static-row{display:flex!important;align-items:center;justify-content:space-between;gap:16px}
.static-meta{color:#666;font-size:13px}
.static-actions{display:flex;gap:8px}
.static-edit,.static-delete{padding:8px 12px;border:0;font:700 12px Arial;cursor:pointer;text-decoration:none}
.static-edit{background:#b28a48;color:#fff}
.static-delete{background:#a1281e;color:#fff}
.box>form{max-width:900px}
.box>form>br{display:none}

/* New field styles */
.field-group{margin:10px 0}
.field-group label{display:block;font:700 13px Arial;color:#333;margin-bottom:5px}
.field-group input[type="text"],.field-group input[type="url"],.field-group textarea{
  width:100%;box-sizing:border-box;padding:10px 12px;border:1px solid #ddd;
  font:15px Arial;border-radius:4px;background:#fafafa;color:#171717;
}
.field-group textarea{height:80px;resize:vertical}
.social-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:8px}
.social-item{display:flex;align-items:center;gap:10px;padding:10px 12px;border:1px solid #ddd;border-radius:4px;background:#fafafa}
.social-item svg{flex-shrink:0;color:#b28a48}
.social-item input{flex:1;border:none;background:transparent;font:14px Arial;color:#171717;outline:none}
.section-divider{border:none;border-top:1px solid #e5e5e5;margin:28px 0}

@media(max-width:850px){
  .fs-shell{display:block}
  .fs-side{width:100%;display:flex;overflow:auto}
  .fs-side a{white-space:nowrap}
  .fs-main{padding:20px}
  .social-grid{grid-template-columns:1fr}
}
</style></head><body>
<div class="fs-shell">
  <aside class="fs-side">
    <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
    <a href="{{ route('admin.home-settings.edit') }}">Home Page Setting</a>
    <a href="{{ route('admin.attorneys.create') }}">Add Attorney</a>
    <a href="{{ route('admin.attorneys.details') }}">Attorney Detail Page</a>
    <a href="{{ route('admin.capabilities.index') }}">Capabilities</a>
    <a href="{{ route('admin.capabilities.pages') }}">Capability Pages</a>
    <a href="{{ route('admin.contact-settings.edit') }}">Contact Us</a>
    <a class="active" href="{{ route('admin.footer-settings.edit') }}">Footer Settings</a>
    <a href="{{ route('admin.seo-settings.edit') }}">SEO Settings</a>
    <a href="{{ route('admin.blog.index') }}">Blog</a>
    <a href="{{ url('/admin/blog?type=case_study') }}">Case Study</a>
    <a href="{{ url('/admin/blog?type=insight') }}">Insight</a>
  </aside>

  <main class="fs-main">
    <div class="box">
      <a href="{{ route('admin.dashboard') }}">← Back</a>
      <h1>Footer Settings</h1>

      @if(session('success'))
        <p class="success">{{ session('success') }}</p>
      @endif

      <form method="post" action="{{ route('admin.footer-settings.update') }}">
        @csrf @method('PUT')

        {{-- ========== ABOUT US SECTION ========== --}}
        <h2>About Us</h2>
        <p>Footer ke "About Us" column main dikhne wala text.</p>
        <div class="field-group">
          <label for="about_text">About Us Text</label>
          <textarea name="about_text" id="about_text" placeholder="Expert legal counsel and dedicated representation...">{{ old('about_text', $settings->about_text) }}</textarea>
        </div>

        <hr class="section-divider">

        {{-- ========== SOCIAL MEDIA LINKS ========== --}}
        <h2>Social Media Links</h2>
        <p>Footer main dikhne wale social media links. Khali chhod dain to icon nahi dikhega.</p>
        <div class="social-grid">

          <div class="social-item">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 2C6.477 2 2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12c0-5.523-4.477-10-10-10z"/>
            </svg>
            <input type="url" name="facebook_url" placeholder="https://facebook.com/..." value="{{ old('facebook_url', $settings->facebook_url) }}">
          </div>

          <div class="social-item">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
              <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-1.47 0-2.12.8-2.49 1.37v-1.17h-2.76v8.36h2.76v-4.64c0-1.24.23-2.44 1.77-2.44 1.52 0 1.54 1.41 1.54 2.52v4.56h2.44M7.83 18.5v-8.36H5.06v8.36h2.77M6.45 6.09c-.9 0-1.62.72-1.62 1.62s.72 1.63 1.62 1.63 1.62-.73 1.62-1.63-.72-1.62-1.62-1.62z"/>
            </svg>
            <input type="url" name="linkedin_url" placeholder="https://linkedin.com/..." value="{{ old('linkedin_url', $settings->linkedin_url) }}">
          </div>

          <div class="social-item">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
              <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
            </svg>
            <input type="url" name="twitter_url" placeholder="https://twitter.com/..." value="{{ old('twitter_url', $settings->twitter_url) }}">
          </div>

          <div class="social-item">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" fill-rule="evenodd">
              <path d="M12 0C8.74 0 8.33.01 7.05.07c-1.27.06-2.14.26-2.9.56a5.88 5.88 0 0 0-2.12 1.38 5.88 5.88 0 0 0-1.38 2.12c-.3.76-.5 1.63-.56 2.9C.01 8.33 0 8.74 0 12s.01 3.67.07 4.95c.06 1.27.26 2.14.56 2.9a5.88 5.88 0 0 0 1.38 2.12 5.88 5.88 0 0 0 2.12 1.38c.76.3 1.63.5 2.9.56 1.28.06 1.69.07 4.95.07s3.67-.01 4.95-.07c1.27-.06 2.14-.26 2.9-.56a5.88 5.88 0 0 0 2.12-1.38 5.88 5.88 0 0 0 1.38-2.12c.3-.76.5-1.63.56-2.9.06-1.28.07-1.69.07-4.95s-.01-3.67-.07-4.95c-.06-1.27-.26-2.14-.56-2.9a5.88 5.88 0 0 0-1.38-2.12 5.88 5.88 0 0 0-2.12-1.38c-.76-.3-1.63-.5-2.9-.56C15.67.01 15.26 0 12 0zm0 5.84a6.16 6.16 0 1 1 0 12.32 6.16 6.16 0 0 1 0-12.32zm6.4 2.88a1.44 1.44 0 1 1-2.88 0 1.44 1.44 0 0 1 2.88 0zM12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8z"/>
            </svg>
            <input type="url" name="instagram_url" placeholder="https://instagram.com/..." value="{{ old('instagram_url', $settings->instagram_url) }}">
          </div>

        </div>

        <hr class="section-divider">

        {{-- ========== SERVICES / CAPABILITIES ========== --}}
        <h2>Services</h2>
        <p>Footer main dikhne wali capabilities (services) select karein.</p>
        @foreach($capabilities as $capability)
          <label class="option">
            <input type="checkbox" name="capability_ids[]" value="{{ $capability->id }}"
              {{ in_array($capability->id, $settings->capability_ids ?: []) ? 'checked' : '' }}>
            {{ $capability->title }}
          </label>
        @endforeach

        <hr class="section-divider">

        {{-- ========== STATIC PAGES ========== --}}
        <h2>Static Pages</h2>
        <p>Privacy Policy ya Terms of Use jaise pages banayein. Published pages footer ke "Links" section main apne aap dikhain ge.</p>
        <a class="save add-page" href="{{ route('admin.static-pages.create') }}">+ Add Static Page</a>
        <br><br>
        @forelse(\App\Models\StaticPage::orderBy('title')->get() as $page)
          <div class="option static-row">
            <div>
              <strong>{{ $page->title }}</strong>
              <span class="static-meta">{{ ucfirst($page->status) }}</span>
            </div>
            <div class="static-actions">
              <a class="static-edit" href="{{ route('admin.static-pages.edit', $page) }}">Edit</a>
              <button class="static-delete" type="submit" name="delete_static_page" value="{{ $page->id }}"
                onclick="return confirm('Delete this static page?')">Delete</button>
            </div>
          </div>
        @empty
          <p>Abhi tak koi static page nahi bana.</p>
        @endforelse

        <hr class="section-divider">

        {{-- ========== COPYRIGHT ========== --}}
        <h2>Copyright Text</h2>
        <p>Footer ke neeche dikhne wala copyright text.</p>
        <div class="field-group">
          <label for="copyright_text">Copyright Text</label>
          <input type="text" name="copyright_text" id="copyright_text"
            placeholder="Copyright © 2026 Niaz Law P.C. - All Rights Reserved."
            value="{{ old('copyright_text', $settings->copyright_text) }}">
        </div>

        <button class="save footer-save">Save Footer Settings</button>
      </form>
    </div>
  </main>
</div>
</body></html>
