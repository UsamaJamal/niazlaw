<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon-icon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $seo = \App\Models\SeoSetting::forPage('contact'); ?>
    <title>{{ $seo->meta_title ?: 'Contact Us - Niaz Law P.C.' }}</title><link rel="canonical" href="{{ url()->current() }}">
    <meta name="description" content="{{ $seo->meta_description ?: 'Contact Niaz Law P.C. to schedule a legal consultation in Illinois.' }}">
    <meta name="keywords" content="{{ $seo->meta_keywords ?: 'contact law firm, legal consultation Illinois, Niaz Law contact' }}">
        <meta name="robots" content="{{ $seo->meta_robots ?: 'index, follow' }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .contact-page { background: #fff; }
        .contact-hero { min-height: 490px; padding: 142px 0 70px; display: flex; align-items: center; color: #fff; background: linear-gradient(90deg, rgba(0,0,0,.64), rgba(0,0,0,.34)), url('{{ asset('images/Contact-Us-new.webp') }}') center / cover; }
        .contact-hero__content { display: grid; grid-template-columns: auto auto 1fr; gap: 48px; align-items: center; width: 100%; }
        .contact-hero h1 { margin: 0; color: #fff; font-size: 56px; font-family: var(--font-heading); font-weight: 700; white-space: nowrap; line-height: 1.1; }
        .contact-hero-divider { width: 1px; height: 150px; background-color: rgba(255, 255, 255, 1); align-self: center; }
        .contact-hero p { max-width: 620px; margin: 0; font-family: var(--font-body); font-size: 18px; line-height: 1.6; font-weight: 400; color: #ffffff; }
        .contact-main { padding: 26px 0 66px; }
        .contact-main h2 { margin: 0 0 35px; font-size: clamp(34px, 3vw, 46px); }
        .contact-layout { display: grid; grid-template-columns: 1.25fr .75fr; gap: 60px; align-items: stretch; }
        .contact-form-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 24px 12px; }
        .contact-field { display: flex; flex-direction: column; gap: 9px; }
        .contact-field label { font-family: var(--font-heading); font-size: 16px; font-weight: 700; }
        .contact-field input, .contact-field select, .contact-field textarea { width: 100%; border: 1px solid #777; border-radius: 4px; color: #111; background: #fff; font: 16px var(--font-body); }
        .contact-field input, .contact-field select { height: 46px; padding: 0 17px; }
        .contact-field select { padding-right: 44px; appearance: none; -webkit-appearance: none; background: #fff url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="%23111" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>') no-repeat right 17px center; cursor: pointer; }
        .contact-field input::placeholder, .contact-field textarea::placeholder { color: #9a9a9a; }
        .contact-field textarea { padding: 15px 17px; min-height: 116px; resize: none; }
        .contact-field--full { grid-column: 1 / -1; }
        .contact-submit { display: block; min-width: 285px; min-height: 46px; margin: 35px auto 0; border: 0; background: #000; color: #fff; font: 600 16px var(--font-heading); cursor: pointer; }
        .contact-map { height: 100%; overflow: hidden; border-radius: 9px; background: #e7e5df; }
        .contact-map iframe { width: 100%; height: 100%; border: 0; display: block; filter: saturate(.72) contrast(.94); }
        .contact-cards { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 24px; margin-top: 76px; align-items: stretch; }
        .contact-card { min-height: 211px; height: auto; padding: 30px 20px 22px; display: flex; flex-direction: column; align-items: center; justify-content: flex-start; text-align: center; background: #faf7f1; border: 1px solid #e1ded8; border-radius: 8px; box-shadow: 0 6px 0 #000; box-sizing: border-box; }
        .contact-card svg { width: 34px; height: 34px; margin-bottom: 20px; stroke: #000; stroke-width: 2.25; fill: none; }
        .contact-card h3 { margin: 0 0 13px; font-size: 19px; line-height: 1.2; white-space: normal; word-break: break-word; }
        .contact-card p { margin: 0; font-size: 17px; line-height: 1.4; overflow-wrap: anywhere; }
        .contact-card--office p { width: 100%; font-size: 15px; line-height: 1.35; text-align: left; white-space: normal; overflow-wrap: normal; }
        .contact-card--naperville p { font-size: 14px; }
        @media (max-width: 1320px) { .contact-cards { grid-template-columns: repeat(4, minmax(0, 1fr)); justify-content: stretch; gap: 16px; } .contact-card { width: 100%; } }
        @media (max-width: 950px) { .contact-hero__content { grid-template-columns: 1fr; gap: 24px; } .contact-hero-divider { display: none; } .contact-layout { grid-template-columns: 1fr; gap: 55px; } .contact-map { display: none; } .desktop-break { display: none; } }
        @media (max-width: 600px) { .contact-hero { min-height: 490px; padding: 145px 0 30px; } .contact-hero h1 { font-size: 28px; } .contact-hero p { font-size: 18px; } .contact-main { padding: 25px 0 68px; } .contact-main h2 { margin-bottom: 24px; text-align: center; font-size: 24px; } .contact-form-grid { grid-template-columns: 1fr; gap: 20px; } .contact-field--full { grid-column: auto; } .contact-submit { width: fit-content; min-width: 260px; padding: 0 32px; } .contact-cards { grid-template-columns: 1fr; justify-content: stretch; gap: 24px; margin-top: 52px; } .contact-card { width: 100%; height: auto; min-height: 190px; padding: 25px 18px 20px; } .contact-card svg { margin-bottom: 13px; } .contact-card h3 { margin-bottom: 8px; font-size: 20px; } .contact-card p { font-size: 15px; } .contact-card--office p { text-align: center; } }
    </style>
</head>
<body class="contact-page">
    @include('components.header')
    <main>
        <section class="contact-hero">
            <div class="container contact-hero__content">
                <h1>Contact Us</h1>
                <div class="contact-hero-divider"></div>
                <p>Connect with our team to discuss your business, transaction,<br class="desktop-break"> project, or other legal needs.</p>
            </div>
        </section>
        <section class="contact-main">
            <div class="container">
                <div class="contact-layout">
                    <div class="contact-form-panel">
                        <h2>Get In Touch</h2>
                        @if(session('success'))
                            <div style="background-color: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px; border-radius: 4px; border: 1px solid #c3e6cb;">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if($errors->any())
                            <div style="background-color: #f8d7da; color: #721c24; padding: 15px; margin-bottom: 20px; border-radius: 4px; border: 1px solid #f5c6cb;">
                                <ul style="margin: 0; padding-left: 20px;">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('contact.submit') }}" method="post" id="contact-form">
                            @csrf
                            <div class="contact-form-grid">
                                <div class="contact-field"><label for="first-name">First Name *</label><input id="first-name" name="first_name" type="text" placeholder="Name" pattern="[A-Za-z][A-Za-z\s'-]*" minlength="2" maxlength="50" data-name-input required value="{{ old('first_name') }}"></div>
                                <div class="contact-field"><label for="last-name">Last Name *</label><input id="last-name" name="last_name" type="text" placeholder="Name" pattern="[A-Za-z][A-Za-z\s'-]*" minlength="2" maxlength="50" data-name-input required value="{{ old('last_name') }}"></div>
                                <div class="contact-field"><label for="email">Email *</label><input id="email" name="email" type="email" placeholder="Email" required value="{{ old('email') }}"></div>
                                <div class="contact-field"><label for="phone">Phone Number *</label><input id="phone" name="phone" type="tel" placeholder="Number" inputmode="numeric" pattern="[0-9]{7,15}" minlength="7" maxlength="15" data-phone-input required value="{{ old('phone') }}"></div>
                                <div class="contact-field"><label for="company">Company / Organization</label><input id="company" name="company" type="text" placeholder="Name" value="{{ old('company') }}"></div>
                                <div class="contact-field"><label for="practice">How Can We Help ? *</label><select id="practice" name="practice" required><option value="">Select Practice Area</option>@forelse($capabilities as $capability)<option value="{{ $capability->title }}" {{ old('practice') == $capability->title ? 'selected' : '' }}>{{ $capability->title }}</option>@empty<option>Commercial Transactions</option><option>Procurement &amp; Contracting</option><option>Infrastructure &amp; Projects</option><option>Operational Risk</option>@endforelse</select></div>
                                <div class="contact-field contact-field--full"><label for="message">Message *</label><textarea id="message" name="message" placeholder="Tell us briefly how we can help" required>{{ old('message') }}</textarea></div>
                            </div>
                            <button class="contact-submit" type="submit">Submit Inquiry</button>
                        </form>
                    </div>
                    <div class="contact-map"><iframe title="Niaz Law Franklin Park office location" src="https://www.google.com/maps?q=9933+Franklin+Ave,+Franklin+Park,+IL+60131&amp;z=17&amp;output=embed" loading="lazy"></iframe></div>
                </div>
                <section class="contact-cards" aria-label="Contact details">
                    <article class="contact-card"><svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="4"/><path d="m3 8 9 6 9-6"/></svg><h3>Email</h3><p>{{ $contactSettings->email ?? 'info@niazlawpc.com' }}</p></article>
                    <article class="contact-card"><svg viewBox="0 0 24 24"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.4 19.4 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.4 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2Z"/></svg><h3>Phone</h3><p>{{ $contactSettings->phone ?? '(630) 201-5927' }}</p></article>
                    <article class="contact-card contact-card--office"><svg viewBox="0 0 24 24"><path d="M20 10c0 6-8 11-8 11S4 16 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg><h3>Franklin Park Office:</h3><p>{!! nl2br(e($contactSettings->franklin_address ?? "9933 Franklin Ave.\nFranklin Park, IL 60131")) !!}</p></article>
                    @php
                        $napervilleAddress = $contactSettings->naperville_address ?? "3333 Warrenville Road, Suite 200\nLisle, IL 60532, USA";
                        if (!str_contains(strtolower($napervilleAddress), 'usa')) {
                            $napervilleAddress .= ', USA';
                        }
                    @endphp
                    <article class="contact-card contact-card--office contact-card--naperville"><svg viewBox="0 0 24 24"><path d="M20 10c0 6-8 11-8 11S4 16 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg><h3>Naperville / Lisle Office:</h3><p>{{ $napervilleAddress }}</p></article>
                </section>
            </div>
        </section>
    </main>
    @include('components.footer')
    <script>
        document.querySelectorAll('[data-name-input]').forEach((input) => {
            input.addEventListener('input', () => {
                input.value = input.value.replace(/[^A-Za-z\s'-]/g, '');
                input.setCustomValidity('');
            });
            input.addEventListener('invalid', () => {
                input.setCustomValidity('Please enter a name using letters only.');
            });
        });

        const phoneInput = document.querySelector('[data-phone-input]');
        phoneInput.addEventListener('input', () => {
            phoneInput.value = phoneInput.value.replace(/\D/g, '');
            phoneInput.setCustomValidity('');
        });
        phoneInput.addEventListener('invalid', () => {
            phoneInput.setCustomValidity('Please enter a valid phone number using 7 to 15 digits.');
        });

        // AJAX Form Submission to prevent page reload
        const contactForm = document.getElementById('contact-form');
        if(contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const form = this;
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalBtnText = submitBtn.innerText;
                submitBtn.innerText = 'Sending...';
                submitBtn.disabled = true;

                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(async response => {
                    const data = await response.json().catch(() => null);
                    if (!response.ok) {
                        const errorMsg = data && data.message ? data.message : 'Something went wrong. Please check your inputs or try again later.';
                        throw new Error(errorMsg);
                    }
                    return data;
                })
                .then(data => {
                    const successDiv = document.createElement('div');
                    successDiv.id = 'form-success-msg';
                    successDiv.style.cssText = 'background-color: #d4edda; color: #155724; padding: 30px; border-radius: 8px; border: 1px solid #c3e6cb; text-align: center; margin-top: 20px;';
                    successDiv.innerHTML = `
                        <h3 style="margin-top:0; font-size: 24px;">Thank You!</h3>
                        <p style="margin-bottom:0; font-size: 16px;">${data && data.message ? data.message : 'Your inquiry has been sent successfully. We will get back to you soon.'}</p>
                    `;
                    
                    form.style.display = 'none';
                    form.parentNode.insertBefore(successDiv, form);

                    setTimeout(() => {
                        successDiv.remove();
                        form.reset();
                        form.style.display = 'block';
                        submitBtn.innerText = originalBtnText;
                        submitBtn.disabled = false;
                    }, 5000);
                })
                .catch(error => {
                    console.error('Error:', error);
                    submitBtn.innerText = originalBtnText;
                    submitBtn.disabled = false;
                    alert(error.message);
                });
            });
        }
    </script>
</body>
</html>
