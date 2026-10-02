<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <link rel="icon" type="image/png" href="{{ asset('images/favicon-icon.png') }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $seo = \App\Models\SeoSetting::forPage('home'); ?>
        <title>{{ $seo->meta_title ?: 'Niaz Law P.C. | Expert Legal Counsel in Illinois' }}</title><link rel="canonical" href="{{ url()->current() }}">
        <meta name="description" content="{{ $seo->meta_description ?: 'Niaz Law P.C. provides expert legal counsel and dedicated representation for business and personal legal matters in Illinois.' }}">
        <meta name="keywords" content="{{ $seo->meta_keywords ?: 'law firm Illinois, legal counsel, attorney Illinois, business law, Niaz Law' }}">
        <meta name="robots" content="{{ $seo->meta_robots ?: 'index, follow' }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style>
            /* Insights Section Styles */
            .insight-card {
                overflow: hidden;
            }
            /* Ken-burns zoom on background */
            .insight-card::before {
                content: '';
                position: absolute;
                inset: 0;
                background: inherit;
                background-size: cover;
                background-position: center;
                transition: transform 6s ease;
                transform: scale(1);
                z-index: 0;
            }
            .insight-card:hover::before {
                transform: scale(1.07);
            }
            /* Gradient overlay */
            .insight-card::after {
                content: '';
                position: absolute;
                inset: 0;
                background: linear-gradient(to top, rgba(0,0,0,0.88) 0%, rgba(0,0,0,0.45) 50%, rgba(0,0,0,0.10) 100%);
                z-index: 1;
                transition: background 0.7s ease;
            }
            .insight-card:hover::after {
                background: linear-gradient(to top, rgba(0,0,0,0.92) 0%, rgba(0,0,0,0.60) 60%, rgba(0,0,0,0.20) 100%);
            }
            /* Slide-up text on hover */
            .insight-card .insight-content {
                transition: transform 0.7s ease;
                transform: translateY(0px);
                position: relative;
                z-index: 2;
            }
            .insight-card:hover .insight-content {
                transform: translateY(-6px);
            }
            /* Description - hidden by default, show on hover */
            .insight-card .insight-desc {
                max-height: 0;
                overflow: hidden;
                opacity: 0;
                font-size: 13.5px;
                color: rgba(255,255,255,0.85);
                line-height: 1.55;
                margin-top: 0;
                transition: max-height 0.7s ease, opacity 0.7s ease, margin-top 0.7s ease;
                font-family: var(--font-body);
            }
            .insight-card:hover .insight-desc {
                max-height: 150px;
                opacity: 1;
                margin-top: 10px;
            }
            /* Static underline accent */
            .insight-card .insight-content h3::after {
                content: '';
                display: block;
                position: static;
                width: 48px;
                height: 2px;
                background: #fff;
                margin-top: 12px;
            }
                     /* Keep the important subject of the hero image visible on phones. */
            @media (max-width: 768px) {
                .hero-slide {
                    background-position: 72% center;
                    background-size: cover;
                }
                .hero-container {
                    padding: 0 16px;
                }
                .hero-content {
                    max-width: 92%;
                }
            }

            /* Mobile View Adjustment: Remove hover slide-up effect, reduce left padding, keep only heading */
            @media (max-width: 768px) {
                .insight-card {
                    padding: 20px 16px !important;
                }
                .insight-card .insight-content {
                    margin: 0 !important;
                    padding: 0 !important;
                }
                .insight-card:hover::before {
                    transform: scale(1) !important;
                }
                .insight-card:hover::after {
                    background: linear-gradient(to top, rgba(0,0,0,0.88) 0%, rgba(0,0,0,0.45) 50%, rgba(0,0,0,0.10) 100%) !important;
                }
                .insight-card .insight-content,
                .insight-card:hover .insight-content {
                    transform: none !important;
                }
                .insight-card .insight-desc,
                .insight-card:hover .insight-desc {
                    display: none !important;
                }
            }
        </style>
    </head>
    <body class="antialiased">
        @include('components.header')
        @php
            $fallbackSlide = (object) [
                'image' => $homeSettings->hero_image ?? 'home-hero.png',
                'heading' => $homeSettings->hero_heading ?? "We Stand With You.\nWe Fight for Justice.",
                'button_text' => $homeSettings->hero_button_text ?? 'Contact Us',
                'button_link' => $homeSettings->hero_button_link ?? '/contact-us',
            ];
            $slides = $heroSlides->isNotEmpty() ? $heroSlides : collect([$fallbackSlide]);
        @endphp
        <section class="hero hero-slider" data-hero-slider>
            @foreach($slides as $index => $slide)
                <div class="hero-slide {{ $index === 0 ? 'active' : '' }}" style="--hero-image: url('{{ asset('images/' . $slide->image) }}'); --hero-mobile-image: url('{{ asset('images/' . (!empty($slide->mobile_image) ? $slide->mobile_image : $slide->image)) }}'); --hero-mobile-pos: {{ !empty($slide->mobile_image) ? 'center center' : '66% 10%' }};">
                    <div class="container hero-container">
                        <div class="hero-content">
                            <h1>{!! nl2br(e($slide->heading)) !!}</h1>
                            <a href="{{ $slide->button_link }}" class="btn btn-secondary">{{ $slide->button_text }} <span class="arrow-icon"><img src="{{ asset('images/arrow.svg') }}" alt="" class="hero-btn-arrow"></span></a>
                        </div>
                    </div>
                </div>
            @endforeach
            @if($slides->count() > 1)
                <div class="hero-indicators">
                    @foreach($slides as $index => $slide)
                        <button type="button" class="indicator {{ $index === 0 ? 'active' : '' }}" aria-label="Show hero slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
            @endif
        </section>

        <section class="section insights-section">
            <div class="container">
                <h2 class="section-title insights-title">Latest Insights From Niaz Law</h2>
                <div class="insights-grid">
                    @forelse($homeInsights as $insight)
                    <a class="insight-card" href="{{ route('blog.show', $insight) }}" style="background-image: url('{{ $insight->home_image_url ?: $insight->featured_image_url ?: asset('images/insight-june.png') }}');" aria-label="Read {{ $insight->title }}">
                        <div class="insight-content">
                            <h3>{{ $insight->title }}</h3>
                            <p class="insight-desc">{{ Str::limit(html_entity_decode(strip_tags($insight->content)), 200) }}</p>
                        </div>
                    </a>
                    @empty
                    <a class="insight-card" href="{{ url('/blog') }}" style="background-image: url('{{ asset('images/insight-june.png') }}');">
                        <div class="insight-content">
                            <h3>Niaz's Insights &ndash; June 2026</h3>
                            <p class="insight-desc">A roundup of legal developments, firm updates, and key insights from our attorneys across practice areas.</p>
                        </div>
                    </a>
                    <a class="insight-card" href="{{ url('/blog') }}" style="background-image: url('{{ asset('images/inside-court.jpg') }}');">
                        <div class="insight-content">
                            <h3>Inside the Courts &ndash; Niaz's Securities<br>Litigation Update</h3>
                            <p class="insight-desc">Our latest analysis of securities litigation trends, enforcement actions, and court decisions affecting capital markets.</p>
                        </div>
                    </a>
                    <a class="insight-card" href="{{ url('/blog') }}" style="background-image: url('{{ asset('images/niaz-podcast.jpg') }}');">
                        <div class="insight-content">
                            <h3>Niaz's Podcasts</h3>
                            <p class="insight-desc">Listen to our attorneys discuss pressing legal issues, industry trends, and practical guidance for business leaders.</p>
                        </div>
                    </a>
                    <a class="insight-card" href="{{ url('/blog') }}" style="background-image: url('{{ asset('images/informed-board.jpg') }}');">
                        <div class="insight-content">
                            <h3>The Informed Board &ndash; September 2026</h3>
                            <p class="insight-desc">Essential governance insights for board members navigating regulatory changes, fiduciary duties, and strategic decisions.</p>
                        </div>
                    </a>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="services-section bg-primary">
            <div class="container services-container">
                <div class="services-img-col">
                    <img src="{{ asset('images/professsional-services.jpg') }}" alt="Gavel">
                    <h2 class="services-heading">Professional Services<br>Prepared To Be Your<br>Lawyer Firm</h2>
                    <a href="{{ route('capabilities') }}" class="all-practice-areas desktop-only" style="color: #fff; text-decoration: none;">All Practice Areas ↗</a>
                </div>
                <div class="services-list-col">
                    <div class="services-links">
                        @foreach($homeCapabilities as $cap)
                        <a href="{{ $cap->slug ? route('capabilities.show', $cap->slug) : route('capabilities') }}" class="service-link" style="color:#fff; text-decoration:none;">{{ $cap->title }} <img src="{{ asset('images/errow-side.svg') }}" alt="Arrow Right" style="width: 27px; height: auto;"></a>
                        @endforeach
                    </div>
                </div>
                <div class="mobile-only" style="text-align: center; width: 100%;">
                    <a href="{{ route('capabilities') }}" class="all-practice-areas" style="color: #fff; text-decoration: none; margin: 0 auto;">All Practice Areas ↗</a>
                </div>
            </div>
        </section>

        <section class="about-section">
            <div class="container about-container">
                <div class="about-left-col">
                    <h2 class="section-title about-section-title">Learn About<br class="desktop-only"> <span class="our-firm-text">Our Firm</span></h2>
                    <div class="about-features">
                        <div class="feature">
                            <div class="feature-icon">
                                <img src="{{ asset('images/legacy.png') }}" alt="Legacy">
                            </div>
                            <div>
                                <h4>LEGACY</h4>
                                <p>Built on years of advising businesses across complex commercial, infrastructure, and strategic legal matters.</p>
                            </div>
                        </div>
                        <div class="feature">
                            <div class="feature-icon">
                                <img src="{{ asset('images/integraty.svg') }}" alt="Integrity">
                            </div>
                            <div>
                                <h4>INTEGRITY</h4>
                                <p>We provide clear, dependable legal guidance with professionalism, discretion, and a strong sense of responsibility.</p>
                            </div>
                        </div>
                        <div class="feature">
                            <div class="feature-icon">
                                <img src="{{ asset('images/community.svg') }}" alt="Community">
                            </div>
                            <div>
                                <h4>COMMUNITY</h4>
                                <p>We focus on understanding client priorities and delivering practical legal solutions that support informed business decisions.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="about-images">
                    <img src="{{ asset('images/Community-new.webp') }}" alt="Community" class="about-img-below">
                    <img src="{{ asset('images/Legacy-new.webp') }}" alt="Legacy" class="about-img-up">
                </div>
            </div>
        </section>

        <section class="results-section">
            <div class="container results-container">
                <div class="results-img">
                    <h2>WE LEAVE EVERY OUNCE OF EFFORT, SKILL, AND HEART IN THE COURTROOM.</h2>
                    <span class="we-deliver">We Deliver Results.</span>
                </div>
                <div class="results-list">
                    <div class="result-item">
                        <h4>COMMERCIAL LITIGATION</h4>
                        <h3>Resolving a High-Stakes Contract Dispute Between Business Partners</h3>
                    </div>
                    <div class="result-item">
                        <h4>PROCUREMENT & CONTRACTING</h4>
                        <h3>Securing a Favorable Resolution in a Complex Vendor Dispute</h3>
                    </div>
                    <div class="result-item">
                        <h4>INFRASTRUCTURE & PROJECTS</h4>
                        <h3>Guiding a Major Project Through Contractual and Stakeholder Conflict</h3>
                    </div>
                </div>
            </div>
        </section>

        <section class="section news-section">
            <div class="container">
                <div class="news-header">
                    <h2>The Latest News And Blog From Niaz Law</h2>
                    <a href="{{ url('/blog') }}" class="read-recent">Read Recent Posts <span class="arrow-icon"><img src="{{ asset('images/arrow.svg') }}" alt="Arrow" class="hero-btn-arrow"></span></a>
                </div>
                <div class="news-grid">
                    @forelse($homePosts as $post)
                    <div class="news-card">
                        <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}">
                        <div class="news-content">
                            <h3>{{ $post->title }}</h3>
                            <p>{{ Str::limit(html_entity_decode(strip_tags($post->content)), 130) }}</p>
                            <a href="{{ route('blog.show',$post) }}" class="btn-black">Read now</a>
                        </div>
                    </div>
                    @empty
                    <p>No featured posts yet.</p>
                    @endforelse
                </div>
            </div>
        </section>
        <section class="contact-section">
            <div class="contact-bg"></div>
            <div class="container contact-container">
                <iframe class="home-map" title="Niaz Law Franklin Park office location" src="https://www.google.com/maps?q=9933+Franklin+Ave,+Franklin+Park,+IL+60131&amp;z=17&amp;output=embed" loading="lazy"></iframe>
                <div class="contact-form-card">
                    <h2>Have Questions?<br>Get in Touch!</h2>
                    <form id="home-contact-form" action="{{ route('contact.quick') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Name" pattern="[A-Za-z][A-Za-z\s'-]*" minlength="2" maxlength="100" inputmode="text" data-name-input required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="subject" class="form-control" placeholder="Subject">
                        </div>
                        <div class="form-group">
                            <textarea name="message" class="form-control" placeholder="Message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </section>
        @include('components.footer')
        <script>
            (() => {
                const slider = document.querySelector('[data-hero-slider]');
                if (!slider) return;
                const slides = [...slider.querySelectorAll('.hero-slide')];
                const indicators = [...slider.querySelectorAll('.indicator')];
                if (slides.length < 2) return;
                let activeIndex = 0;
                const show = (index) => {
                    activeIndex = (index + slides.length) % slides.length;
                    slides.forEach((slide, i) => slide.classList.toggle('active', i === activeIndex));
                    indicators.forEach((indicator, i) => indicator.classList.toggle('active', i === activeIndex));
                };
                indicators.forEach((indicator, index) => indicator.addEventListener('click', () => show(index)));
                setInterval(() => show(activeIndex + 1), 6500);
            })();
            
            // Home Contact Form AJAX Submission
            const homeContactForm = document.getElementById('home-contact-form');
            if(homeContactForm) {
                const nameInput = homeContactForm.querySelector('[data-name-input]');
                nameInput.addEventListener('input', () => {
                    nameInput.value = nameInput.value.replace(/[^A-Za-z\s'-]/g, '');
                    nameInput.setCustomValidity('');
                });
                nameInput.addEventListener('invalid', () => {
                    nameInput.setCustomValidity('Please enter a name using letters only.');
                });
                homeContactForm.addEventListener('submit', function(e) {
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
                        successDiv.id = 'home-form-success-msg';
                        successDiv.style.cssText = 'background-color: #d4edda; color: #155724; padding: 20px; border-radius: 8px; border: 1px solid #c3e6cb; text-align: center; margin-bottom: 20px;';
                        successDiv.innerHTML = `
                            <h3 style="margin-top:0; font-size: 20px;">Thank You!</h3>
                            <p style="margin-bottom:0; font-size: 15px;">${data && data.message ? data.message : 'Your inquiry has been sent successfully.'}</p>
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
