<!doctype html>
<html lang="en"><head>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon-icon.png') }}"><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>{{ $page->meta_title ?: ($page->title . ' | Niaz Law P.C.') }}</title><link rel="canonical" href="{{ url()->current() }}">
    <meta name="description" content="{{ $page->meta_description ?: ('Read our ' . $page->title . '.') }}">
    <meta name="keywords" content="{{ $page->meta_keywords ?: '' }}">
    <meta name="robots" content="{{ $page->robots ?: 'index, follow' }}"><link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}"><style>
.static-hero{min-height:390px;padding:145px 0 65px;color:#fff;background:linear-gradient(90deg,rgba(0,0,0,.68),rgba(0,0,0,.34)),url('{{ asset('images/about-hero-bg.jpg') }}') center/cover;display:flex;align-items:end}.static-hero h1{margin:0;font:700 clamp(42px,5vw,66px)/1.1 Georgia;color:#fff}.static-content{max-width:1000px;padding:70px 20px 90px;font-size:17px;line-height:1.8}.static-content h1,.static-content h2,.static-content h3{font-family:Georgia;color:#111}.static-content img{max-width:100%;height:auto}.static-content table{max-width:100%;display:block;overflow:auto}
</style></head><body>@include('components.header')<section class="static-hero"><div class="container"><h1>{{ $page->title }}</h1></div></section><main class="container static-content">{!! $page->content !!}</main>@include('components.footer')</body></html>
