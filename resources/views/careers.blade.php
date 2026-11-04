<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon-icon.png') }}">
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Careers | Niaz Law P.C.</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .careers-page{min-height:calc(100vh - 100px);padding:72px 24px;background:#f6f4ef}.careers-panel{max-width:1100px;margin:auto;padding:48px 56px 54px;background:#262d27;color:#fff}.careers-panel h1{margin:0 0 36px;font:400 clamp(42px,5vw,68px)/1 Georgia,serif}.careers-options{display:grid;grid-template-columns:repeat(2,1fr);gap:34px}.career-option{display:block;color:#fff;text-decoration:none}.career-option__image{display:block;height:250px;overflow:hidden;background:#18221a}.career-option img{width:100%;height:100%;object-fit:cover;transition:transform .35s ease,opacity .35s ease}.career-option h2{margin:20px 0 0;font:400 27px Georgia,serif;transition:color .2s ease}.career-option:hover img,.career-option:focus-visible img{transform:scale(1.05);opacity:.84}.career-option:hover h2,.career-option:focus-visible h2{color:#d6b779}@media(max-width:700px){.careers-page{padding:42px 16px}.careers-panel{padding:35px 25px}.careers-options{grid-template-columns:1fr;gap:28px}.career-option__image{height:210px}}
    </style>
</head>
<body class="antialiased" style="display:flex;flex-direction:column;min-height:100vh">
    @include('components.header')
    <main class="careers-page" style="flex-grow:1">
        <section class="careers-panel" aria-labelledby="careers-heading">
            <h1 id="careers-heading">Careers</h1>
            <div class="careers-options">
                <a class="career-option" href="{{ route('careers.track', 'attorneys') }}">
                    <span class="career-option__image"><img src="{{ asset('images/discus-business-needs.jpg') }}" alt="Attorney speaking with clients"></span>
                    <h2>Attorneys</h2>
                </a>
                <a class="career-option" href="{{ route('careers.track', 'professional-staff') }}">
                    <span class="career-option__image"><img src="{{ asset('images/professsional-services.jpg') }}" alt="Professional staff collaborating"></span>
                    <h2>Professional Staff</h2>
                </a>
            </div>
        </section>
    </main>
    @include('components.footer')
</body>
</html>
