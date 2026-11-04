<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $blog->meta_title ?: $blog->title . ' | Niaz Law P.C.' }}</title><link rel="canonical" href="{{ url()->current() }}">
    <meta name="description" content="{{ $blog->meta_description ?: Str::limit(html_entity_decode(strip_tags($blog->content)), 160) }}">
    <meta name="keywords" content="{{ $blog->meta_keywords ?: ($blog->category ? $blog->category.', ' : '') . 'legal insights, Niaz Law, Illinois law firm' }}">
    <meta name="robots" content="{{ $blog->robots ?? 'index, follow' }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon-icon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
    <style>
        .post-hero { min-height: 470px; padding: 40px 0 0; display: flex; align-items: flex-end; color: #111; background: linear-gradient(180deg, rgba(0,0,0,.16), rgba(0,0,0,.05)), url('{{ $blog->featured_image_url }}') center/cover; }
        .post-hero__card { max-width: 760px; margin: 0 0 -85px 0; padding: 30px 38px; background: #f8f5ed; box-shadow: 0 2px 8px rgba(0,0,0,.18); }
        .post-hero h1 { max-width: 720px; margin: 0 0 14px; color: #111; font: 700 34px/1.12 Georgia; }
        .post-meta { margin: 0; color: #444; font-size: 12px; }
        html, body { max-width: 100%; overflow-x: hidden; }
        .post-layout { box-sizing: border-box; width: calc(100% - 32px); max-width: 1220px; margin: 0 auto; padding: 110px 16px 16px; overflow: hidden; }
        .post-content { box-sizing: border-box; width: 100%; max-width: 1080px; margin: 0 auto; min-width: 0; overflow-wrap: anywhere; word-break: normal; font-size: 17px; line-height: 1.8; color: #222; }
        .post-image { display: block; width: 100%; max-height: 560px; object-fit: cover; margin: 0 0 45px; }
        .post-content h1, .post-content h2, .post-content h3, .post-content h4 { max-width: 100%; margin: 1.5em 0 .55em; line-height: 1.25; color: #111; overflow-wrap: anywhere; }
        .post-content h1 { font-size: 40px; }
        .post-content h2 { font-size: 32px; }
        .post-content h3 { font-size: 25px; }
        .post-content p { max-width: 100%; margin: 0 0 1.2em; overflow-wrap: anywhere; }
        .post-content ul, .post-content ol { display: block; margin: 0 0 1.3em; padding-left: 1.7em; }
        .post-content ul { list-style: disc; }
        .post-content ol { list-style: decimal; }
        .post-content table { display: block; width: 100%; max-width: 100%; overflow-x: auto; margin: 1.5em 0; border-collapse: collapse; border: 1px solid #bbb; }
        .post-content th, .post-content td { padding: 12px 14px; border: 1px solid #bbb; text-align: left; vertical-align: top; }
        .post-content th { background: #f1ede5; font-weight: 700; }
        .post-content code { padding: 2px 5px; background: #f1f1f1; font-family: monospace; }
        .post-content pre code { padding: 0; background: transparent; }
        .post-content li { margin: .4em 0; }
        .post-content blockquote { margin: 1.5em 0; padding: 15px 22px; border-left: 4px solid #b18a4b; background: #f6f3ed; }
        .post-content pre { padding: 18px; overflow: auto; background: #171717; color: #fff; max-width: 100%; box-sizing: border-box; }
        .post-content img { display: block; max-width: 100%; height: auto; }
        .related { box-sizing: border-box; width: 100%; max-width: 1220px; margin: 20px auto 0; padding: 0 25px 85px; }
        .related h2 { margin: 0 0 28px; font: 700 34px Georgia; }
        .related-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 55px; }
        .related-card { display: grid; grid-template-columns: 42% 1fr; gap: 22px; height: 100%; }
        .related-card img { width: 100%; height: 100%; min-height: 205px; object-fit: cover; }
        .related-card > div { display: flex; flex-direction: column; height: 100%; }
        .related-card h3 { margin: 0 0 12px; padding-bottom: 12px; border-bottom: 1px solid #999; font: 700 22px/1.15 Georgia; }
        .related-card p { margin: 0 0 16px; font-size: 13px; line-height: 1.5; }
        .related-card a { display: inline-block; padding: 10px 22px; background: #111; color: #fff; text-decoration: none; font-size: 12px; margin-top: auto; align-self: flex-start; }
        .back { display: inline-block; margin-bottom: 28px; color: #886a38; text-decoration: none; font-weight: bold; }
        @media(max-width: 650px) {
            .post-hero { min-height: 360px; }
            .post-hero__card { margin-left: 18px; margin-right: 18px; padding: 22px; }
            .post-layout { padding: 110px 18px 70px; }
            .post-content { font-size: 16px; }
        }
    </style>
</head>
<body>
    @include('components.header')
    <section class="post-hero">
        <div class="container">
            <div class="post-hero__card">
                <h1>{{ $blog->title }}</h1>
                <p class="post-meta">{{ $blog->category ?: 'Legal Insight' }} @if($blog->published_at) &middot; {{ $blog->published_at->format('M d, Y') }} @endif</p>
            </div>
        </div>
    </section>
    <main class="post-layout">
        <div class="post-content">
            {!! $blog->content !!}
        </div>
    </main>
    <section class="related">
        <h2>Related Insights And News</h2>
        <div class="related-grid">
            @foreach(\App\Models\BlogPost::where('id', '!=', $blog->id)->where('status', 'published')->latest()->take(2)->get() as $related)
            <article class="related-card">
                <img src="{{ $related->featured_image_url }}" alt="{{ $related->title }}">
                <div>
                    <h3>{{ $related->title }}</h3>
                    <p>{{ Str::limit(html_entity_decode(strip_tags($related->content)), 150) }}</p>
                    <a href="{{ route('blog.show', $related) }}">Read now</a>
                </div>
            </article>
            @endforeach
        </div>
    </section>
    @include('components.footer')
</body>
</html>
