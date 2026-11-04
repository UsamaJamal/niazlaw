<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Capabilities</title>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<style>*{box-sizing:border-box}.cp-shell{min-height:100vh;display:grid;grid-template-columns:250px 1fr;background:#f6f4ef}.cp-side{padding:25px 14px;background:linear-gradient(160deg,#15191a,#050606);color:#fff}.cp-logo{display:block;margin:0 11px 29px;padding-bottom:23px;border-bottom:1px solid #333}.cp-logo img{width:114px}.cp-label{margin:0 12px 11px;color:#c9bd9f;font:700 9px Arial;letter-spacing:.24em}.cp-nav a{display:flex;align-items:center;gap:13px;padding:12px;margin:2px 0;border-left:2px solid transparent;border-radius:6px;color:#f6f4ef;font:14px Georgia;text-decoration:none}.cp-nav a.active,.cp-nav a:hover{border-left-color:#c29c53;background:linear-gradient(90deg,rgba(175,137,67,.32),rgba(175,137,67,.08))}.cp-nav svg{width:18px;height:18px}.cp{padding:42px 5%;background:#f6f4ef}.cp-wrap{max-width:1000px;margin:auto}.cp-top{display:flex;justify-content:space-between;align-items:center;margin-bottom:25px}.cp-top h1{margin:0;font:700 38px Georgia}.cp-back{padding:12px 16px;border:1px solid #222;background:#fff;color:#111;text-decoration:none;font:700 13px Arial}.cp-card{padding:28px;background:#fff;border:1px solid #dfdad1;border-radius:9px}.cp-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px}.cp-field{display:flex;flex-direction:column;gap:8px}.cp-field.full{grid-column:1/-1}.cp-field label{font:700 14px Arial}.cp-field input,.cp-field textarea{width:100%;padding:13px;border:1px solid #cfc9be;border-radius:4px;font:15px Arial}.cp-field textarea{min-height:110px;resize:vertical}.cp-save{margin-top:24px;padding:15px 23px;border:0;background:#171717;color:#fff;font:700 14px Arial;cursor:pointer}.cp-success{padding:14px;background:#f3ede0;border-left:3px solid #9b7a40}.cp-list{margin-top:34px}.cp-list h2{font:700 28px Georgia}.cp-items{display:grid;grid-template-columns:repeat(3,1fr);gap:16px}.cp-item{padding:13px;background:#fff;border:1px solid #dfdad1}.cp-item img{width:100%;height:120px;object-fit:cover}.cp-item h3{margin:12px 0 6px;font:700 19px Georgia}.cp-item p{margin:0;font:14px/1.5 Arial}.cp-edit,.cp-delete{display:inline-block;margin-top:12px;padding:8px 10px;font:700 12px Arial;text-decoration:none;cursor:pointer}.cp-edit{background:#171717;color:#fff}.cp-delete{margin-left:6px;border:1px solid #a8342d;background:#fff;color:#9c2f29}@media(max-width:850px){.cp-shell{grid-template-columns:1fr}.cp-side{padding:16px}.cp-nav{display:flex;overflow:auto}.cp-nav a{white-space:nowrap}.cp{padding:28px 18px}}@media(max-width:650px){.cp-grid,.cp-items{grid-template-columns:1fr}.cp-field.full{grid-column:auto}.cp-top{align-items:flex-start;gap:15px;flex-direction:column}}</style>
</head>
<body>
<div class="cp-shell">
<aside class="cp-side">
<a class="cp-logo" href="{{ route('admin.dashboard') }}">
<img src="{{ asset('images/header-logo.png') }}" alt="Niaz Law P.C.">
</a>
<p class="cp-label">WEBSITE MANAGEMENT</p>
<nav class="cp-nav">
<a href="{{ route('admin.home-settings.edit') }}">
<x-admin-icon name="home"/>Home Page Setting</a>
<a href="{{ route('admin.attorneys.create') }}">
<x-admin-icon name="user"/>Add Attorney</a>
<a href="{{ route('admin.attorneys.details') }}">
<x-admin-icon name="users"/>Attorney Detail Page</a>
<a class="active" href="{{ route('admin.capabilities.index') }}">
<x-admin-icon name="chart"/>Capabilities</a>
<a href="{{ route('admin.capabilities.pages') }}">
<x-admin-icon name="file"/>Capability Pages</a>
<a href="{{ route('admin.contact-settings.edit') }}">
<x-admin-icon name="mail"/>Contact Us</a>
<a href="{{ route('admin.footer-settings.edit') }}">
<x-admin-icon name="external"/>Footer Settings</a>
<a href="{{ route('admin.seo-settings.edit') }}">
<x-admin-icon name="edit"/>SEO Settings</a>
<p style="margin:22px 12px 8px;color:#c9bd9f;font:700 9px Arial;letter-spacing:.24em">INSIGHTS &amp; RESOURCES</p>
<div style="margin-left:8px">
<a href="{{ route('admin.blog.index') }}">
<x-admin-icon name="edit"/>Blog</a>
<a href="{{ url('/admin/blog?type=case_study') }}">
<x-admin-icon name="file"/>Case Study</a>
<a href="{{ url('/admin/blog?type=insight') }}">
<x-admin-icon name="bulb"/>Insight</a>
</div>
<a href="{{ route('admin.careers.edit') }}"><x-admin-icon name="users"/>Career Management</a></nav>
</aside>
<main class="cp">
<div class="cp-wrap">
<header class="cp-top">
<h1>Capabilities</h1>
<a class="cp-back" href="{{ route('admin.dashboard') }}">← Back to dashboard</a>
</header>@if(session('success'))<p class="cp-success">{{ session('success') }}</p>@endif<form class="cp-card" method="post" action="{{ route('admin.capabilities.store') }}" enctype="multipart/form-data">@csrf<div class="cp-grid">
<div class="cp-field full">
<label>Capability Title</label>
<input name="title" value="{{ old('title') }}" placeholder="e.g. Commercial Transactions" required>
</div>
<div class="cp-field full">
<label>Description</label>
<textarea name="description" required>{{ old('description') }}</textarea>
</div>
<div class="cp-field full">
<label>Card Image</label>
<input type="file" name="image" accept=".jpg,.jpeg,.png,.webp,image/*">
</div>
</div>
<button class="cp-save" type="submit">Add capability</button>
</form>@if($capabilities->isNotEmpty())<section class="cp-list">
<h2>Added Capabilities</h2>
<div class="cp-items">@foreach($capabilities as $capability)<article class="cp-item">@if($capability->image)<img src="{{ asset(strpos($capability->image, '/') !== false ? $capability->image : 'images/'.$capability->image) }}" alt="{{ $capability->title }}">@endif<h3>{{ $capability->title }}</h3>
<p>{{ $capability->description }}</p>
<a class="cp-edit" href="{{ route('admin.capabilities.card-edit', ['capability' => $capability->id]) }}">Edit card</a>
<form method="post" action="{{ route('admin.capabilities.destroy', ['capability' => $capability->id]) }}" style="display:inline" onsubmit="return confirm('Delete this capability?')">@csrf @method('DELETE')<button class="cp-delete" type="submit">Delete</button>
</form>
</article>@endforeach</div>
</section>@endif</div>
</main>
</div>
</body>
</html>
