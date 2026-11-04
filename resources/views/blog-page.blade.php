<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon-icon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $seo = \App\Models\SeoSetting::forPage('blog'); ?>
    <title>{{ $seo->meta_title ?: 'Articles & Perspectives - Niaz Law P.C.' }}</title><link rel="canonical" href="{{ url()->current() }}">
    <meta name="description" content="{{ $seo->meta_description ?: 'Read the latest legal articles and perspectives from Niaz Law P.C.' }}">
    <meta name="keywords" content="{{ $seo->meta_keywords ?: 'legal blog, law articles Illinois, legal insights, Niaz Law articles' }}">
        <meta name="robots" content="{{ $seo->meta_robots ?: 'index, follow' }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
    <style>
        .blog-page { background: #fff; }
        .blog-hero { min-height: 490px; padding: 142px 0 70px; display: flex; align-items: center; color: #fff; background: linear-gradient(90deg, rgba(0,0,0,.63), rgba(0,0,0,.34)), url('{{ asset('images/Blog-Page-new.webp') }}') center / cover; }
        .blog-hero__content { display: grid; grid-template-columns: auto 1fr; align-items: center; gap: 72px; width: 100%; }
        .blog-hero h1 { margin: 0; color: #fff; font-size: clamp(42px, 4.5vw, 67px); line-height: 1.12; font-family: var(--font-heading); font-weight: 700; }
        .blog-hero p { max-width: 550px; margin: 0; padding: 20px 0 20px 40px; border-left: 2px solid #fff; color: #f7f7f7; font-size: 17px; line-height: 1.7; }
        .blog-content { padding: 52px 0 102px; }
        .blog-feature { display: grid; grid-template-columns: 1.15fr 1fr; align-items: center; gap: 10px; max-width: 1250px; margin: 0 auto 66px; }
        .blog-feature__image { height: 465px; overflow: hidden; clip-path: polygon(0 0, 100% 0, 73% 100%, 0 100%); }
        .blog-feature__image img { width: 100%; height: 100%; object-fit: cover; object-position: center; }
        .blog-feature__content { margin-left: -68px; padding-left: 68px; }
        .blog-feature h2 { max-width: 530px; margin: 0 0 12px; font-size: clamp(28px, 2.6vw, 42px); line-height: 1.22; }
        .blog-category { margin: 0 0 20px; font-family: var(--font-heading); font-size: 17px; font-weight: 700; }
        .blog-feature__content > p:last-of-type { max-width: 535px; margin: 0 0 26px; font-size: 15px; line-height: 1.65; }
        .article-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 48px 72px; max-width: 1250px; margin: 0 auto; }
        .article-card { display: grid; grid-template-columns: 262.5px 1fr; gap: 26px; min-width: 0; align-items: start; }
        .article-card__image { width: 100%; height: 342px; object-fit: cover; }
        .article-card__content { padding-top: 35px; }
        .article-card h3 { margin: 0 0 14px; padding-bottom: 14px; border-bottom: 1px solid #8e8e8e; font-size: clamp(19px, 1.6vw, 26px); line-height: 1.18; }
        .article-card p { margin: 0 0 17px; color: #000; font-size: 13px; line-height: 1.52; text-align:justify; }
        .article-button { display: inline-flex; min-width: 188px; min-height: 42px; align-items: center; justify-content: center; padding: 10px 22px; background: #000; color: #fff; font-size: 14px; font-weight: 600; transition: background .2s ease; }
        .article-button:hover { background: #333; }
        .blog-load { text-align: center; margin-top: 78px; }
        @media (max-width: 900px) { .blog-hero__content { grid-template-columns: 1fr; gap: 24px; } .blog-hero p { padding: 0; border-left: 0; text-align: justify; } .blog-feature { grid-template-columns: 1fr; gap: 30px; } .blog-feature__image { clip-path: none; height: 400px; } .blog-feature__content { margin-left: 0; padding-left: 0; } .blog-feature p { text-align: justify; } .article-grid { gap: 42px 32px; } .article-card { grid-template-columns: 1fr; gap: 18px; } .article-card__image { width: 100%; height: 280px; } .article-card__content { padding-top: 0; } }
        @media (max-width: 650px) { .blog-hero { min-height: 500px; padding: 145px 0 52px; } .blog-hero h1 { font-size: 40px; } .blog-hero p { font-size: 16px; } .blog-content { padding: 54px 0 66px; } .blog-feature { margin-bottom: 48px; } .blog-feature__image { height: 300px; } .blog-feature h2 { font-size: 28px; } .article-grid { grid-template-columns: 1fr; gap: 42px; } .article-card { grid-template-columns: 1fr; gap: 18px; } .article-card__image { width: 100%; height: 260px; } .article-card__content { padding-top: 0; } .article-card h3 { font-size: 20px; margin-bottom: 12px; padding-bottom: 12px; } .article-card p { font-size: 13px; margin-bottom: 16px; text-align: justify; } .article-button { min-width: 140px; min-height: 40px; font-size: 13px; } .blog-load { margin-top: 52px; } }
    </style>
</head>
<body class="blog-page">
    @include('components.header')
    <main>
        <section class="blog-hero">
            <div class="container blog-hero__content">
                <h1>Articles &amp;<br>Perspectives</h1>
                <p>Read practical legal perspectives and commentary on commercial transactions, infrastructure, aviation, procurement, and evolving business challenges.</p>
            </div>
        </section>
        <section class="blog-content">
            <div class="container">
                @if($posts->isNotEmpty())
                @php($featured = $posts->first())
                <article class="blog-feature">
                    <div class="blog-feature__image">@if($featured->featured_image_url)<img src="{{ $featured->featured_image_url }}" alt="{{ $featured->title }}">@endif</div>
                    <div class="blog-feature__content">
                        <h2>{{ $featured->title }}</h2>
                        <p class="blog-category">{{ $featured->category }}</p>
                        <p>{{ Str::limit(html_entity_decode(strip_tags($featured->content)), 250) }}</p>
                        <a class="article-button" href="{{ route('blog.show',$featured) }}">Read Blog</a>
                    </div>
                </article>
                <div class="article-grid">
                    @foreach ($posts->skip(1) as $post)
                        <article class="article-card">
                            @if($post->featured_image_url)<img class="article-card__image" src="{{ $post->featured_image_url }}" alt="{{ $post->title }}">@endif
                            <div class="article-card__content">
                                <h3>{{ $post->title }}</h3>
                                <p>{{ Str::limit(html_entity_decode(strip_tags($post->content)), 150) }}</p>
                                <a class="article-button" href="{{ route('blog.show',$post) }}">Read now</a>
                            </div>
                        </article>
                    @endforeach
                </div>
                @else
                    <p>No published blog posts yet.</p>
                @endif
            </div>
        </section>
    </main>
    @include('components.footer')
</body>
</html>

