<header class="navbar">
    <div class="container navbar-container">
        <div class="nav-logo">
            <a href="/">
                <img src="{{ asset('images/header-logo.png') }}" alt="Niaz Law P.C." style="max-height: 50px; width: auto;">
            </a>
        </div>
        <div style="display: flex; align-items: center; gap: clamp(14px, 2vw, 32px);">
            <nav class="nav-links">
                <a href="/attorneys">Attorneys</a>
                <a href="/capabilities">Capabilities</a>
                <div class="nav-dropdown-wrapper">
                    <a href="#">Insights &amp; Resources</a>
                    <div class="nav-dropdown">
                        <a href="/insights">INSIGHTS</a>
                        <a href="/case-study">CASE STUDIES</a>
                        <a href="/blog">BLOGS</a>
                    </div>
                </div>
                <a href="/about">About</a>
                <a href="/contact-us">Contact</a>
                <div class="career-menu"><a href="javascript:void(0)" class="career-menu__trigger" onclick="event.preventDefault();" role="button" aria-haspopup="true">Career</a><div class="career-menu__cards"><a class="career-menu__card" href="{{ route('careers.track', 'attorneys') }}"><img src="{{ asset('images/discus-business-needs.jpg') }}" alt="Attorney meeting with clients"><span>Attorneys <b>→</b></span></a><a class="career-menu__card" href="{{ route('careers.track', 'professional-staff') }}"><img src="{{ asset('images/professsional-services.jpg') }}" alt="Professional staff collaborating"><span>Professional Staff <b>→</b></span></a></div></div>
            </nav>
            <div class="nav-actions" style="display: flex; align-items: center; gap: 16px;">
                <div class="header-search-wrapper" id="header-search-wrapper">
                    <svg id="search-trigger" class="search-trigger" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="cursor: pointer;"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <div class="header-search-dropdown">
                        <div class="search-input-container">
                            <form action="{{ route('search') }}" method="get" style="display: flex; width: 100%; align-items: center; margin: 0; padding: 0;">
                                <input type="text" id="header-search-input" name="q" placeholder="Search" style="flex-grow: 1;">
                                <span class="search-counter" id="search-counter" style="display: none; color: #ffffff; font-family: 'Inter', sans-serif; font-size: 14px; margin-right: 10px;">0/0</span>
                            </form>
                        </div>
                    </div>
                </div>
                <button class="mobile-menu-toggle" type="button" aria-label="Open menu" aria-controls="mobile-menu" aria-expanded="false"><svg class="hamburger-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></button>
            </div>
        </div>
    </div>
</header>

<div class="mobile-menu" id="mobile-menu" aria-hidden="true">
    <div class="mobile-menu__panel">
        <div class="mobile-menu__top">
            <a href="/"><img src="{{ asset('images/header-logo.png') }}" alt="Niaz Law P.C."></a>
            <button class="mobile-menu__close" type="button" aria-label="Close menu">×</button>
        </div>
        <nav class="mobile-menu__links" aria-label="Mobile navigation">
            <a href="/attorneys">Attorneys</a>
            @php($headerCapabilities = \App\Models\Capability::orderBy('title')->get())
            <button type="button" class="mobile-menu__dropdown-toggle" aria-expanded="false">
                Capabilities
                <svg class="mobile-menu__chevron" viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
            </button>
            <div class="mobile-menu__sub-links" aria-hidden="true">
                @foreach($headerCapabilities as $cap)
                    <a href="{{ route('capabilities.show', ['capability' => $cap->slug ?: $cap->id]) }}">{{ $cap->title }}</a>
                @endforeach
            </div>
                        <button type="button" class="mobile-menu__dropdown-toggle" aria-expanded="false">
                Career
                <svg class="mobile-menu__chevron" viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
            </button>
            <div class="mobile-menu__sub-links" aria-hidden="true">
                <a href="{{ route('careers.track', 'attorneys') }}">Attorneys</a>
                <a href="{{ route('careers.track', 'professional-staff') }}">Professional Staff</a>
            </div>
            <button type="button" class="mobile-menu__dropdown-toggle" aria-expanded="false">
                Insights &amp; Resources
                <svg class="mobile-menu__chevron" viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
            </button>
            <div class="mobile-menu__sub-links" aria-hidden="true">
                <a href="/insights">Insights</a>
                <a href="/case-study">Case Studies</a>
                <a href="/blog">Blogs</a>
            </div>
            <a href="/about">About</a>
            <a href="/contact-us">Contact</a>
        </nav>
        <div class="mobile-menu__socials"><a href="#">f</a><a href="#">in</a><a href="#">♥</a><a href="#">◎</a></div>
    </div>
</div>
<style>
.mobile-menu__dropdown-toggle {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    background: none;
    border: none;
    border-bottom: 1px solid rgba(0,0,0,0.10);
    padding: 18px 0;
    font-family: var(--font-heading, 'Libre Baskerville', serif);
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: #1a1a1a;
    cursor: pointer;
    text-align: left;
}
.mobile-menu__chevron {
    width: 20px;
    height: 20px;
    transition: transform 0.3s ease;
    flex-shrink: 0;
}
.mobile-menu__dropdown-toggle[aria-expanded="true"] .mobile-menu__chevron {
    transform: rotate(180deg);
}
.mobile-menu__sub-links {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.35s ease;
    background: rgba(0,0,0,0.03);
}
.mobile-menu__sub-links[aria-hidden="false"] {
    max-height: 1000px;
}
.mobile-menu__sub-links a {
    display: block !important;
    padding: 12px 22px !important;
    font-size: 13px !important;
    letter-spacing: 0.1em !important;
    border-bottom: 1px solid rgba(0,0,0,0.06) !important;
    color: #555 !important;
}
.mobile-menu__sub-links a:hover { color: #000 !important; background: rgba(0,0,0,0.04); }
</style>

<script>
    (() => {
        const navbar = document.querySelector('.navbar');
        const menu = document.querySelector('.mobile-menu');
        const menuToggle = document.querySelector('.mobile-menu-toggle');
        const menuClose = document.querySelector('.mobile-menu__close');
        let previousScrollY = window.scrollY;

        const closeMenu = () => {
            document.body.classList.remove('mobile-menu-open');
            menu.setAttribute('aria-hidden', 'true');
            menuToggle.setAttribute('aria-expanded', 'false');
        };

        menuToggle.addEventListener('click', () => {
            const isOpen = document.body.classList.toggle('mobile-menu-open');
            menu.setAttribute('aria-hidden', String(!isOpen));
            menuToggle.setAttribute('aria-expanded', String(isOpen));
        });
        menuClose.addEventListener('click', closeMenu);
        // Dropdown toggles for Capabilities & Insights & Resources
        const dropdownToggles = document.querySelectorAll('.mobile-menu__dropdown-toggle');
        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', (e) => {
                e.stopPropagation();
                const subLinks = toggle.nextElementSibling;
                if (subLinks && subLinks.classList.contains('mobile-menu__sub-links')) {
                    const isExpanded = toggle.getAttribute('aria-expanded') === 'true';
                    
                    // Close all other dropdowns
                    dropdownToggles.forEach(otherToggle => {
                        if (otherToggle !== toggle) {
                            otherToggle.setAttribute('aria-expanded', 'false');
                            const otherSub = otherToggle.nextElementSibling;
                            if (otherSub && otherSub.classList.contains('mobile-menu__sub-links')) {
                                otherSub.setAttribute('aria-hidden', 'true');
                            }
                        }
                    });

                    toggle.setAttribute('aria-expanded', String(!isExpanded));
                    subLinks.setAttribute('aria-hidden', String(isExpanded));
                }
            });
        });

        // Close menu when clicking nav links or sub-links
        menu.addEventListener('click', (event) => {
            const clickedNavLink = event.target.closest('.mobile-menu__links > a, .mobile-menu__sub-links a');
            if (event.target === menu || clickedNavLink) closeMenu();
        });

        const searchTrigger = document.getElementById('search-trigger');
        const searchWrapper = document.getElementById('header-search-wrapper');
        const navbarContainer = document.querySelector('.navbar-container');
        const searchInput = document.getElementById('header-search-input');
        const searchCounter = document.getElementById('search-counter');
        let currentMatchIndex = -1;
        let matchElements = [];

        function clearHighlights() {
            document.querySelectorAll('.search-highlight').forEach(el => {
                const parent = el.parentNode;
                parent.replaceChild(document.createTextNode(el.textContent), el);
                parent.normalize();
            });
            matchElements = [];
            currentMatchIndex = -1;
            searchCounter.style.display = 'none';
            searchCounter.textContent = '0/0';
        }

        function highlightText(node, regex) {
            if (node.nodeType === 3) {
                const match = regex.exec(node.data);
                if (match && node.data.trim().length > 0) {
                    const highlightNode = document.createElement('mark');
                    highlightNode.className = 'search-highlight';
                    const matchedText = match[0];
                    const matchStart = match.index;
                    
                    const after = node.splitText(matchStart);
                    after.splitText(matchedText.length);
                    
                    highlightNode.appendChild(after.cloneNode(true));
                    after.parentNode.replaceChild(highlightNode, after);
                    matchElements.push(highlightNode);
                    
                    return highlightNode;
                }
            } else if (node.nodeType === 1 && node.childNodes && 
                       !['SCRIPT', 'STYLE', 'MARK', 'NOSCRIPT', 'IFRAME', 'SVG'].includes(node.tagName.toUpperCase()) && 
                       !node.classList.contains('header-search-dropdown')) {
                let child = node.firstChild;
                while (child) {
                    const next = child.nextSibling;
                    const highlighted = highlightText(child, regex);
                    if (highlighted) {
                        child = highlighted.nextSibling; 
                    } else {
                        child = next;
                    }
                }
            }
            return null;
        }

        function updateCounterUI() {
            if (matchElements.length > 0) {
                searchCounter.textContent = `${currentMatchIndex + 1}/${matchElements.length}`;
                matchElements.forEach((el, index) => {
                    if (index === currentMatchIndex) {
                        el.classList.add('search-highlight-active');
                    } else {
                        el.classList.remove('search-highlight-active');
                    }
                });
            }
        }

        function scrollToMatch(index) {
            if (matchElements[index]) {
                const navHeight = navbar.offsetHeight || 100;
                const rect = matchElements[index].getBoundingClientRect();
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                window.scrollTo({
                    top: rect.top + scrollTop - navHeight - 20,
                    behavior: 'smooth'
                });
            }
        }

        function nextMatch() {
            if (matchElements.length === 0) return;
            currentMatchIndex = (currentMatchIndex + 1) % matchElements.length;
            updateCounterUI();
            scrollToMatch(currentMatchIndex);
        }

        searchInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                searchInput.form.submit();
            }
        });

        searchTrigger.addEventListener('click', (e) => {
            if (searchWrapper.classList.contains('is-active')) {
                if (searchInput.value.trim() !== '') {
                    searchInput.form.submit();
                } else {
                    searchWrapper.classList.remove('is-active');
                    navbarContainer.classList.remove('search-is-active');
                    searchInput.value = '';
                }
            } else {
                searchWrapper.classList.add('is-active');
                navbarContainer.classList.add('search-is-active');
                setTimeout(() => searchInput.focus(), 100);
            }
            e.stopPropagation();
        });

        document.addEventListener('click', (e) => {
            if (!searchWrapper.contains(e.target)) {
                searchWrapper.classList.remove('is-active');
                navbarContainer.classList.remove('search-is-active');
                searchInput.value = '';
            }
        });

        const careerMenu = document.querySelector('.career-menu');
        if (careerMenu) {
            let careerTimeout;
            careerMenu.addEventListener('mouseenter', () => {
                clearTimeout(careerTimeout);
                careerMenu.classList.add('is-open');
            });
            careerMenu.addEventListener('mouseleave', () => {
                careerTimeout = setTimeout(() => {
                    careerMenu.classList.remove('is-open');
                }, 300);
            });
        }

        window.addEventListener('scroll', () => {
            const currentScrollY = window.scrollY;

            if (currentScrollY <= 0) {
                navbar.classList.remove('navbar-hidden', 'scrolled');
            } else if (currentScrollY > previousScrollY && currentScrollY > 80) {
                navbar.classList.add('navbar-hidden');
            } else if (currentScrollY < previousScrollY) {
                navbar.classList.remove('navbar-hidden');
                navbar.classList.add('scrolled');
            }

            previousScrollY = currentScrollY;
        }, { passive: true });
    })();
</script>
