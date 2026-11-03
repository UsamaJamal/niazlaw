<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon-icon.png') }}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $seo = \App\Models\SeoSetting::forPage('attorneys'); ?>
        <title>{{ $seo->meta_title ?: 'Our Attorneys - Niaz Law P.C.' }}</title><link rel="canonical" href="{{ url()->current() }}">
        <meta name="description" content="{{ $seo->meta_description ?: 'Meet the experienced attorneys at Niaz Law P.C.' }}">
        <meta name="keywords" content="{{ $seo->meta_keywords ?: 'attorneys Illinois, lawyers Illinois, legal team, Niaz Law attorneys' }}">
        <meta name="robots" content="{{ $seo->meta_robots ?: 'index, follow' }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body class="antialiased" style="display: flex; flex-direction: column; min-height: 100vh;">
        @include('components.header')

        <!-- Attorney Hero Section -->
        <main style="flex-grow: 1; width: 100%;">
        <section class="attorney-hero">
            <div class="attorney-hero-bg">
                <img src="{{ asset('images/Attorney-Page-new.webp') }}" alt="Attorneys">
                <div class="hero-overlay"></div>
            </div>
            <div class="container attorney-hero-content">
                <div class="hero-text-row">
                    <h1 class="page-title">Lawyer</h1>
                    <div class="title-divider"></div>
                    <p class="page-description">
                        Experienced legal counsel focused on complex business matters, strategic transactions, and practical solutions tailored to each client's needs.
                    </p>
                </div>
            </div>
        </section>

        <style>
            .search-section {
                width: 100%;
                margin-top: -20px;
                position: relative;
                z-index: 5;
                padding: 0;
            }
            .search-card {
                width: 92%;
                max-width: 900px;
                height: 100px;
                background: #ffffff;
                border-radius: 16px;
                border: 1px solid #e0e0e0;
                box-shadow: 0px 4px 24px rgba(0,0,0,0.06);
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 0 40px;
                margin: 0 auto;
            }
            .search-box {
                display: flex;
                width: 100%;
                max-width: 844px;
                height: 60px;
                border: 1px solid #000000;
                border-radius: 6px;
                overflow: hidden;
                background: #ffffff;
                align-items: center;
            }
            .search-icon {
                width: 18px;
                height: 18px;
                color: #888;
                margin-left: 20px;
                flex-shrink: 0;
            }
            .search-box input {
                flex-grow: 1;
                min-width: 0;
                padding: 0 16px;
                border: none;
                outline: none;
                font-size: var(--body-reg);
                font-family: var(--font-heading);
                height: 100%;
                color: #333;
                background: transparent;
            }
            .search-box input::placeholder {
                color: #000000;
                opacity: 0.5;
                font-family: 'Libre Baskerville', serif;
                font-weight: 400;
                font-size: 16px;
                line-height: 34px;
            }
            .search-box button {
                background: #000;
                color: #fff;
                border: none;
                flex-shrink: 0;
                padding: 0 40px;
                font-weight: 400;
                font-family: var(--font-heading);
                font-size: var(--body-reg);
                cursor: pointer;
                height: 100%;
                transition: background 0.3s;
            }
            .search-box button:hover {
                background: #333;
            }
            
            @media (max-width: 768px) {
                .container.search-section {
                    padding: 0 16px;
                }
            }

            @media (max-width: 576px) {
                .search-section {
                    margin-top: -30px;
                }
                .search-card {
                    height: 90px;
                    width: 100%;
                    box-sizing: border-box;
                    padding: 0 15px;
                    border-radius: 10px;
                }
                .search-box {
                    height: 50px;
                    border-radius: 10px;
                }
                .search-icon {
                    margin-left: 8px;
                    width: 16px;
                    height: 16px;
                }
                .search-box input {
                    font-size: 14px;
                    padding: 0 5px 0 6px;
                }
                .search-box input::placeholder {
                    font-size: 13px;
                }
                .search-box button {
                    padding: 0 12px;
                    font-size: 14px;
                }
            }
        </style>
        <!-- Search Bar Section -->
        <section class="container search-section">
            <div class="search-card">
                <div class="search-box">
                    <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" placeholder="Search by name">
                    <button type="button">Search</button>
                </div>
            </div>
        </section>

        <!-- Filters Section -->
        <section class="filters-section">
            <div class="container">
                <div class="filters-row">
                    <div class="custom-dropdown" data-filter="practice">
                        <div class="dropdown-header">
                            <span>Practice</span>
                            <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                        <div class="dropdown-menu">
                            @foreach($practiceFilters as $practiceFilter)
                                <div class="dropdown-item">{{ $practiceFilter }}</div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="custom-dropdown" data-filter="industry">
                        <div class="dropdown-header">
                            <span>Industry</span>
                            <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                        <div class="dropdown-menu">
                            @foreach($industryFilters as $industryFilter)
                                <div class="dropdown-item">{{ $industryFilter }}</div>
                            @endforeach
                        </div>
                    </div>

                    <div class="custom-dropdown" data-filter="location">
                        <div class="dropdown-header">
                            <span>Location</span>
                            <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                        <div class="dropdown-menu">
                            <div class="dropdown-item">Franklin Park</div>
                            <div class="dropdown-item">Naperville / Lisle</div>
                        </div>
                    </div>

                    <div class="custom-dropdown" data-filter="title">
                        <div class="dropdown-header">
                            <span>Title</span>
                            <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                        <div class="dropdown-menu">
                            <div class="dropdown-item">Partner</div>
                            <div class="dropdown-item">Senior of Counsel</div>
                            <div class="dropdown-item">Senior Counsel</div>
                            <div class="dropdown-item">Counsel</div>
                            <div class="dropdown-item">Associate Attorney</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Lawyers Grid Section -->
        <section class="lawyers-section">
            <div class="container">
                <div class="lawyers-grid">
                    @forelse($attorneys as $attorney)
                    <a href="{{ $attorney->slug ? route('attorneys.detail', $attorney->slug) : '#' }}" class="lawyer-card" data-name="{{ strtolower($attorney->name) }}" data-practice="{{ strtolower($attorney->practice) }}" data-industry="{{ strtolower($attorney->industry) }}" data-location="{{ strtolower($attorney->location) }}" data-title="{{ strtolower($attorney->title) }}">
                        <div class="lawyer-img">
                            <img src="{{ asset('images/' . ($attorney->photo ?: 'lawyer_profile.jpg')) }}" alt="{{ $attorney->name }}">
                        </div>
                        <div class="lawyer-info">
                            <h3>{{ $attorney->name }}</h3>
                            @if($attorney->designation)<p class="designation">{{ $attorney->designation }}</p>@endif
                            <p class="title">{{ $attorney->title }}</p>
                            <p class="location">{{ $attorney->location }}</p>
                            <p class="email">{{ $attorney->email }}</p>
                            <p class="phone">{{ $attorney->phone }}</p>
                        </div>
                    </a>
                    @empty
                    <p class="lawyers-empty">No attorneys added yet. New attorneys added from the admin panel will appear here.</p>
                    @endforelse
                </div>
                
                <div class="no-results-msg" style="display: none; text-align: center; padding: 60px 0; font-family: var(--font-body); font-size: 18px; color: #555;">
                    <p>No attorneys found matching your search criteria.</p>
                    <a href="javascript:void(0)" onclick="clearFilters()" style="display: inline-block; margin-top: 20px; color: #000; text-decoration: underline; font-weight: 600;">Clear Search</a>
                </div>
                
                @if($attorneys->count() > 6)
                <div class="load-more-container">
                    <button class="btn btn-black btn-load-more">Load More</button>
                </div>
                @endif
            </div>
        </section>

        </main>

        @include('components.footer')
        
        <script>
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('.navbar');
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // Custom Dropdown Logic
            document.querySelectorAll('.dropdown-header').forEach(header => {
                header.addEventListener('click', function(e) {
                    e.stopPropagation();
                    let parent = this.parentElement;
                    
                    // Close others
                    document.querySelectorAll('.custom-dropdown').forEach(dropdown => {
                        if (dropdown !== parent) {
                            dropdown.classList.remove('open');
                        }
                    });

                    // Toggle current
                    parent.classList.toggle('open');
                });
            });

            const selectedFilters = { practice: '', industry: '', location: '', title: '' };
            const searchInput = document.querySelector('.search-box input');
            const searchBtn = document.querySelector('.search-box button');
            const cards = [...document.querySelectorAll('.lawyer-card')];

            function applyFilters() {
                const query = searchInput.value.trim().toLowerCase();
                let visibleCount = 0;
                cards.forEach(card => {
                    const nameMatches = !query || card.dataset.name.includes(query);
                    const filtersMatch = Object.entries(selectedFilters).every(([key, value]) => !value || card.dataset[key].includes(value));
                    if (nameMatches && filtersMatch) {
                        card.style.display = 'flex';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });
                
                const noResultsMsg = document.querySelector('.no-results-msg');
                if (noResultsMsg) {
                    noResultsMsg.style.display = visibleCount === 0 ? 'block' : 'none';
                }

                const loadMore = document.querySelector('.load-more-container');
                if (loadMore) loadMore.style.display = 'none';
            }

            function clearFilters() {
                searchInput.value = '';
                Object.keys(selectedFilters).forEach(key => {
                    selectedFilters[key] = '';
                });
                document.querySelectorAll('.dropdown-header span').forEach(span => {
                    // reset labels based on filter type
                    const filter = span.closest('.custom-dropdown').dataset.filter;
                    span.textContent = filter.charAt(0).toUpperCase() + filter.slice(1);
                });
                applyFilters();
            }

            document.querySelectorAll('.dropdown-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const parent = this.closest('.custom-dropdown');
                    const filter = parent.dataset.filter;
                    selectedFilters[filter] = this.textContent.trim().toLowerCase();
                    parent.querySelector('.dropdown-header span').textContent = this.textContent;
                    parent.classList.remove('open');
                    applyFilters();
                });
            });

            // Close when clicking outside
            document.addEventListener('click', function() {
                document.querySelectorAll('.custom-dropdown').forEach(dropdown => {
                    dropdown.classList.remove('open');
                });
            });

            searchInput.addEventListener('input', applyFilters);
            searchBtn.addEventListener('click', applyFilters);

            // Links from an attorney profile can preselect its saved practice or industry.
            const profileFilter = new URLSearchParams(window.location.search);
            ['practice', 'industry'].forEach(filter => {
                const value = profileFilter.get(filter);
                if (!value) return;
                selectedFilters[filter] = value.toLowerCase();
                const dropdown = document.querySelector('.custom-dropdown[data-filter="' + filter + '"]');
                if (dropdown) dropdown.querySelector('.dropdown-header span').textContent = value;
            });
            applyFilters();
        </script>
    </body>
</html>
