<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Niaz Law P.C.</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
    <style>
        .admin-login { min-height: 100vh; display: grid; grid-template-columns: 1.08fr .92fr; background: #f7f4ed; }
        .admin-login__visual { position: relative; overflow: hidden; padding: 58px 72px; color: #fff; background: linear-gradient(90deg, rgba(0,0,0,.72), rgba(0,0,0,.25)), url('{{ asset('images/home-hero.png') }}') center / cover; }
        .admin-login__visual img { width: 168px; height: auto; }
        .admin-login__visual h1 { position: absolute; bottom: 86px; max-width: 570px; margin: 0; color: #fff; font-size: clamp(40px, 4.2vw, 66px); line-height: 1.13; }
        .admin-login__panel { display: flex; align-items: center; justify-content: center; padding: 52px; }
        .admin-login__form-wrap { width: min(100%, 430px); }
        .admin-login__eyebrow { margin: 0 0 14px; color: #706c64; font-size: 12px; font-weight: 700; letter-spacing: .14em; text-transform: uppercase; }
        .admin-login h2 { margin: 0 0 12px; font-size: 42px; }
        .admin-login__intro { margin: 0 0 38px; color: #69655f; line-height: 1.6; }
        .admin-login__field { display: flex; flex-direction: column; gap: 9px; margin-bottom: 21px; }
        .admin-login__field label { font-weight: 700; }
        .admin-login__field input { height: 54px; padding: 0 16px; border: 1px solid #c9c4bb; border-radius: 4px; background: #fff; font: 16px var(--font-body); }
        .admin-login__password-wrap { position: relative; }.admin-login__password-wrap input { width: 100%; padding-right: 55px; }.admin-login__toggle-password { position: absolute; top: 50%; right: 12px; display: grid; width: 32px; height: 32px; padding: 0; place-items: center; transform: translateY(-50%); border: 0; background: transparent; color: #4b4843; cursor: pointer; }.admin-login__toggle-password svg { width: 21px; height: 21px; fill: none; stroke: currentColor; stroke-width: 2; }.admin-login__toggle-password:hover { color: #000; }
        .admin-login__field input:focus { outline: 2px solid #111; outline-offset: 1px; }
        .admin-login__error { margin: -12px 0 20px; color: #a51d1d; font-size: 14px; }
        .admin-login__submit { width: 100%; height: 56px; margin-top: 10px; border: 0; background: #000; color: #fff; font: 700 16px var(--font-body); cursor: pointer; transition: background .2s ease; }
        .admin-login__submit:hover { background: #292929; }
        .admin-login__back { display: inline-block; margin-top: 26px; color: #3e3b37; font-size: 14px; text-decoration: underline; }
        @media (max-width: 800px) { .admin-login { grid-template-columns: 1fr; } .admin-login__visual { min-height: 260px; padding: 30px; } .admin-login__visual img { width: 120px; } .admin-login__visual h1 { right: 30px; bottom: 32px; left: 30px; font-size: 34px; } .admin-login__panel { padding: 48px 25px; } }
    </style>
</head>
<body>
    <main class="admin-login">
        <section class="admin-login__visual"><a href="/"><img src="{{ asset('images/header-logo.png') }}" alt="Niaz Law P.C."></a><h1>Manage your firm's digital presence with confidence.</h1></section>
        <section class="admin-login__panel"><div class="admin-login__form-wrap"><p class="admin-login__eyebrow">Niaz Law P.C.</p><h2>Admin Portal</h2><p class="admin-login__intro">Sign in to manage your website content and firm information.</p><form method="post" action="{{ route('admin.login.attempt') }}">@csrf<div class="admin-login__field"><label for="email">Email address</label><input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus></div><div class="admin-login__field"><label for="password">Password</label><div class="admin-login__password-wrap"><input id="password" name="password" type="password" required><button class="admin-login__toggle-password" type="button" aria-label="Show password" aria-pressed="false"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z"/><circle cx="12" cy="12" r="2.7"/></svg></button></div></div>@error('email')<p class="admin-login__error">{{ $message }}</p>@enderror<button class="admin-login__submit" type="submit">Sign in to dashboard</button></form><a class="admin-login__back" href="/">Return to website</a></div></section>
    </main>
    <script>
        const passwordInput = document.querySelector('#password');
        const passwordToggle = document.querySelector('.admin-login__toggle-password');
        passwordToggle.addEventListener('click', () => {
            const isHidden = passwordInput.type === 'password';
            passwordInput.type = isHidden ? 'text' : 'password';
            passwordToggle.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
            passwordToggle.setAttribute('aria-pressed', String(isHidden));
        });
    </script>
</body>
</html>
