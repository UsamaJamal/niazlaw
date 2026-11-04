<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Capability Pages</title>
<link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
<style>*{box-sizing:border-box}.shell{min-height:100vh;display:grid;grid-template-columns:250px 1fr;background:#f6f4ef}.side{padding:25px 14px;background:linear-gradient(160deg,#15191a,#050606);color:#fff}.logo{display:block;margin:0 11px 29px;padding-bottom:23px;border-bottom:1px solid #333}.logo img{width:114px}.label{margin:0 12px 11px;color:#c9bd9f;font:700 9px Arial;letter-spacing:.24em}.nav a{display:flex;align-items:center;gap:13px;padding:12px;margin:2px 0;border-left:2px solid transparent;border-radius:6px;color:#f6f4ef;font:14px Georgia;text-decoration:none}.nav a:hover,.nav a.active{border-left-color:#c29c53;background:linear-gradient(90deg,rgba(175,137,67,.32),rgba(175,137,67,.08))}.nav svg{width:18px;height:18px}.main{padding:42px 5%}.wrap{max-width:1000px;margin:auto}.top{display:flex;justify-content:space-between;align-items:center;margin-bottom:25px}.top h1{margin:0;font:700 38px Georgia}.back{padding:12px 16px;border:1px solid #222;background:#fff;color:#111;text-decoration:none;font:700 13px Arial}.intro{font:16px Arial;color:#555}.grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:25px}.card{padding:20px;background:#fff;border:1px solid #dfdad1}.card h2{margin:0 0 10px;font:700 21px Georgia}.card p{margin:7px 0;font:14px Arial}.btn{display:inline-block;margin-top:12px;padding:9px 12px;background:#171717;color:#fff;text-decoration:none;font:700 12px Arial}.public{color:#886d3b;text-decoration:none;font:13px Arial}@media(max-width:850px){.shell{grid-template-columns:1fr}.side{padding:16px}.nav{display:flex;overflow:auto}.nav a{white-space:nowrap}}@media(max-width:650px){.grid{grid-template-columns:1fr}.top{align-items:flex-start;gap:15px;flex-direction:column}}</style>
</head>
<body>
<div class="shell">
<aside class="side">
<a class="logo" href="{{ route('admin.dashboard') }}">
<img src="{{ asset('images/header-logo.png') }}" alt="Niaz Law P.C.">
</a>
<p class="label">WEBSITE MANAGEMENT</p>
<nav class="nav">
<a href="{{ route('admin.home-settings.edit') }}">
<x-admin-icon name="home"/>Home Page Setting</a>
<a href="{{ route('admin.attorneys.create') }}">
<x-admin-icon name="user"/>Add Attorney</a>
<a href="{{ route('admin.attorneys.details') }}">
<x-admin-icon name="users"/>Attorney Detail Page</a>
<a href="{{ route('admin.capabilities.index') }}">
<x-admin-icon name="chart"/>Capabilities</a>
<a class="active" href="{{ route('admin.capabilities.pages') }}">
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
<main class="main">
<div class="wrap">
<header class="top">
<h1>Capability Pages</h1>
<a class="back" href="{{ route('admin.capabilities.index') }}">← Add capability</a>
</header>
<p class="intro">Manage the public pages created for each capability.</p>
<div class="grid">@forelse($capabilities as $capability)<article class="card">
<h2>{{ $capability->title }}</h2>
<p>{{ $capability->description }}</p>
<p>
<strong>Slug:</strong> {{ $capability->slug ?: 'Not assigned' }}</p>@if($capability->slug)<a class="public" href="{{ route('capabilities.show',$capability->slug) }}" target="_blank">View public page ↗</a>@endif<br>
<a class="btn" href="{{ route('admin.capabilities.card-edit',$capability->id) }}">Edit card</a> <a class="btn" href="{{ route('admin.capabilities.edit',$capability->id) }}">Edit page</a>
</article>@empty<p>No capability pages have been created yet.</p>@endforelse</div>
</div>
</main>
</div>
</body>
</html>
