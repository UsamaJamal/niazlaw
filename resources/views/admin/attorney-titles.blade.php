<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Attorney Titles</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
    <style>
        *{box-sizing:border-box}body{margin:0;background:#f6f4ef;font-family:Arial}.shell{min-height:100vh;display:grid;grid-template-columns:250px 1fr}.side{padding:25px 14px;background:linear-gradient(160deg,#15191a,#050606);color:#fff}.logo{display:block;margin:0 11px 29px;padding-bottom:23px;border-bottom:1px solid #333}.logo img{width:114px}.label{margin:0 12px 11px;color:#c9bd9f;font:700 9px Arial;letter-spacing:.24em}.side nav a{display:flex;align-items:center;gap:13px;padding:12px;margin:2px 0;border-left:2px solid transparent;border-radius:6px;color:#f6f4ef;font:14px Georgia;text-decoration:none}.side nav a:hover,.side nav a.active{border-left-color:#c29c53;background:linear-gradient(90deg,rgba(175,137,67,.32),rgba(175,137,67,.08))}.side nav svg{width:18px;height:18px}.main{padding:42px clamp(24px,5vw,76px)}.content{max-width:820px;margin:auto}.back{color:#222;text-decoration:none}.card{background:#fff;padding:28px;margin-top:20px}.row{display:flex;justify-content:space-between;align-items:center;padding:12px 0;border-bottom:1px solid #ddd}.row:last-child{border:0}.add{display:flex;gap:10px}.add input{flex:1;padding:12px;border:1px solid #bbb}.btn{padding:12px 18px;border:0;background:#171717;color:#fff;font-weight:700;cursor:pointer}.delete{background:#a1281e}.success{padding:12px;background:#efe5cd}@media(max-width:850px){.shell{display:block}.side{padding:16px}.side nav{display:flex;overflow:auto}.side nav a{white-space:nowrap}.main{padding:28px 18px}}
    </style>
</head>
<body>
<div class="shell">
    <aside class="side">
        <a class="logo" href="{{ route('admin.dashboard') }}"><img src="{{ asset('images/header-logo.png') }}" alt="Niaz Law P.C."></a>
        <p class="label">WEBSITE MANAGEMENT</p>
        <nav>
            <a href="{{ route('admin.home-settings.edit') }}"><x-admin-icon name="home"/>Home Page Setting</a>
            <a href="{{ route('admin.attorneys.create') }}"><x-admin-icon name="user"/>Add Attorney</a>
            <a class="active" href="{{ route('admin.attorney-titles.index') }}"><x-admin-icon name="edit"/>Titles</a>
            <a href="{{ route('admin.attorneys.details') }}"><x-admin-icon name="users"/>Attorney Detail Page</a>
            <a href="{{ route('admin.capabilities.index') }}"><x-admin-icon name="chart"/>Capabilities</a>
            <a href="{{ route('admin.capabilities.pages') }}"><x-admin-icon name="file"/>Capability Pages</a>
            <a href="{{ route('admin.contact-settings.edit') }}"><x-admin-icon name="mail"/>Contact Us</a>
            <a href="{{ route('admin.footer-settings.edit') }}"><x-admin-icon name="external"/>Footer Settings</a>
            <a href="{{ route('admin.seo-settings.edit') }}"><x-admin-icon name="edit"/>SEO Settings</a>
        </nav>
    </aside>
    <main class="main"><div class="content">
        <a class="back" href="{{ route('admin.attorneys.create') }}">← Back to Add Attorney</a>
        <h1>Attorney Titles</h1>
        <p>Yahan add kiye gaye titles, Add Attorney ke Title dropdown mein automatic show honge.</p>
        @if(session('success'))<p class="success">{{ session('success') }}</p>@endif
        <div class="card"><form class="add" method="post" action="{{ route('admin.attorney-titles.store') }}">@csrf<input name="name" required maxlength="120" placeholder="e.g. Partner"><button class="btn">Add Title</button></form></div>
        <div class="card">@forelse($titles as $title)<div class="row"><strong>{{ $title->name }}</strong><form method="post" action="{{ route('admin.attorney-titles.destroy',$title) }}">@csrf @method('DELETE')<button class="btn delete" onclick="return confirm('Remove this title?')">Remove</button></form></div>@empty<p>No titles added yet.</p>@endforelse</div>
    </div></main>
</div>
</body>
</html>
