<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('meta_title', 'ProBiz Awards 2026 Dubai | UAE Business Awards')</title>
    <meta name="description" content="@yield('meta_description', 'Explore ProBiz Awards 2026 Dubai. Discover business and restaurant award categories, nomination details and the gala on 11 December 2026.')">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" href="{{ asset('assets/keditor/probiz/assets/probiz-awards-dubai-2026-light.png') }}" type="image/png">

    <script>
        tailwind = {
            config: {
                prefix: 'tw-',
                corePlugins: { preflight: false },
                theme: {
                    extend: {
                        colors: {
                            probizGold: '#d4a331',
                            probizAmber: '#f4d778',
                            probizInk: '#05060a',
                            probizNavy: '#081826'
                        },
                        boxShadow: {
                            probiz: '0 28px 80px rgba(0, 0, 0, 0.35)'
                        }
                    }
                }
            }
        };
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/keditor/probiz/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/keditor/probiz/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/keditor/probiz/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/keditor/probiz/css/mCustomScrollbar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/keditor/probiz/css/odometer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/keditor/probiz/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/keditor/probiz/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/keditor/probiz/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/keditor/probiz/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/keditor/css/tested.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/keditor/probiz/css/style.css') }}?v=20260916-mobile-icons-only-v1">
    <style>
        @media (min-width: 992px) {
            .main-header .navbar-collapse,
            .navbar-expand-lg .navbar-collapse {
                display: flex !important;
                visibility: visible !important;
                opacity: 1 !important;
                height: auto !important;
                flex-basis: auto !important;
                align-items: center !important;
            }

            .main-header .navbar-nav {
                display: flex !important;
                flex-direction: row !important;
                align-items: center !important;
                justify-content: center !important;
                gap: 14px !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }

            .main-header .nav-item,
            .main-header .nav-link,
            .main-header .cta-buttons {
                display: flex !important;
                visibility: visible !important;
                opacity: 1 !important;
            }

            .main-header .nav-link {
                color: #ffffff !important;
                font-size: 12px !important;
                font-weight: 900 !important;
                line-height: 1.2 !important;
                padding: 8px 4px !important;
                white-space: nowrap !important;
            }

            .main-header .cta-buttons {
                align-items: center !important;
                gap: 8px !important;
                flex-shrink: 0 !important;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
<div id="loader" style="display:none" aria-hidden="true">
    <div class="loader"></div>
    <div class="progress-container mt-3">
        <div class="progress-bar" id="progressBar"></div>
    </div>
    <div class="loading-text" id="loadingText">Loading...</div>
</div>

@include('frontEnd.layouts.headerprobiz')
@include('frontEnd.layouts.sidebarprobiz')

<main id="main" class="{{ (Helper::GeneralSiteSettings("style_header")) ? "fixed-top-margin" : "" }}">
    @yield('content')
</main>

@include('frontEnd.layouts.Footerprobiz')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script src="{{ asset('assets/keditor/probiz/js/vendor/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/keditor/probiz/js/jquery.odometer.min.js') }}"></script>
<script src="{{ asset('assets/keditor/probiz/js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('assets/keditor/probiz/js/jquery.knob.min.js') }}"></script>
<script src="{{ asset('assets/keditor/probiz/js/jquery-countdowngampang.min.js') }}"></script>
<script src="{{ asset('assets/keditor/probiz/js/jquery.ba-throttle-debounce.min.js') }}"></script>
<script src="{{ asset('assets/keditor/probiz/js/jquery.mCustomScrollbar.min.js') }}"></script>
<script src="{{ asset('assets/keditor/probiz/js/jarallax.min.js') }}"></script>
<script src="{{ asset('assets/keditor/probiz/js/jquery.appear.js') }}"></script>
<script src="{{ asset('assets/keditor/probiz/js/jquery.easing.js') }}"></script>
<script src="{{ asset('assets/keditor/probiz/js/slick.min.js') }}"></script>
<script src="{{ asset('assets/keditor/probiz/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/keditor/probiz/js/main.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const loader = document.getElementById('loader');
        const progressBar = document.getElementById('progressBar');
        const loadingText = document.getElementById('loadingText');

        if (loader && progressBar && loadingText) {
            let progress = 0;
            const interval = setInterval(function () {
                progress += 20;
                progressBar.style.width = progress + '%';
                loadingText.textContent = 'Loading... ' + progress + '%';

                if (progress >= 100) {
                    clearInterval(interval);
                    setTimeout(function () {
                        loader.style.opacity = '0';
                        loader.style.transition = 'opacity 0.5s ease';
                        setTimeout(function () {
                            loader.style.display = 'none';
                        }, 500);
                    }, 80);
                }
            }, 20);
        }

        document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
            anchor.addEventListener('click', function (event) {
                const selector = this.getAttribute('href');
                if (!selector || selector === '#') {
                    return;
                }

                const target = document.querySelector(selector);
                if (target) {
                    event.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        const navbarCollapse = document.getElementById('navbarNav') || document.querySelector('.navbar-collapse');
        if (navbarCollapse) {
            const menuToggles = document.querySelectorAll('.probiz-mobile-word-trigger, .probiz-mobile-trigger, .probiz-menu-toggle, .navbar-toggler');
            const setMenuState = function (isOpen) {
                navbarCollapse.classList.toggle('probiz-menu-open', isOpen);
                navbarCollapse.classList.toggle('show', isOpen);
                menuToggles.forEach(function (toggle) {
                    toggle.classList.toggle('active', isOpen);
                    toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                    if (toggle.classList.contains('probiz-mobile-word-trigger')) {
                        const label = toggle.querySelector('.probiz-mobile-label');
                        const icon = toggle.querySelector('i');
                        if (label) {
                            label.textContent = isOpen ? 'CLOSE' : 'MENU';
                        }
                        if (icon) {
                            icon.classList.toggle('bi-list', !isOpen);
                            icon.classList.toggle('bi-x-lg', isOpen);
                        }
                    }
                });
            };

            menuToggles.forEach(function (menuToggle) {
                menuToggle.addEventListener('click', function (event) {
                    event.preventDefault();
                    setMenuState(!navbarCollapse.classList.contains('probiz-menu-open'));
                });
            });

            navbarCollapse.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', function () {
                    if (window.innerWidth < 992 && !link.classList.contains('dropdown-toggle')) {
                        setMenuState(false);
                    }
                });
            });

            window.addEventListener('scroll', function () {
                const header = document.querySelector('.main-header');
                if (window.innerWidth < 992 && header && header.getBoundingClientRect().bottom <= 0) {
                    setMenuState(false);
                }
            });

        }

        const header = document.querySelector('.main-header');
        if (header) {
            window.addEventListener('scroll', function () {
                header.classList.toggle('scrolled', window.scrollY > 50);
            });
        }

        const scrollTopBtn = document.querySelector('.scroll-top5');
        if (scrollTopBtn) {
            window.addEventListener('scroll', function () {
                scrollTopBtn.style.opacity = window.pageYOffset > 300 ? '1' : '0.7';
            });
        }

        const counters = document.querySelectorAll('.probiz-count[data-count]');
        if (counters.length) {
            const runCounter = function (counter) {
                if (counter.dataset.counted === 'true') {
                    return;
                }

                counter.dataset.counted = 'true';
                const target = parseInt(counter.dataset.count || '0', 10);
                const duration = 1100;
                const startTime = performance.now();

                function tick(now) {
                    const progress = Math.min((now - startTime) / duration, 1);
                    const eased = 1 - Math.pow(1 - progress, 3);
                    counter.textContent = Math.round(target * eased);

                    if (progress < 1) {
                        requestAnimationFrame(tick);
                    } else {
                        counter.textContent = target;
                    }
                }

                requestAnimationFrame(tick);
            };

            if ('IntersectionObserver' in window) {
                const counterObserver = new IntersectionObserver(function (entries, observer) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            runCounter(entry.target);
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.35 });

                counters.forEach(function (counter) {
                    counterObserver.observe(counter);
                });
            } else {
                counters.forEach(runCounter);
            }
        }

        const video = document.querySelector('.video-background');
        if (video) {
            video.play().catch(function () {});
        }

        const track = document.querySelector('.impact-track');
        const prevBtn = document.querySelector('.carousel-btn.prev');
        const nextBtn = document.querySelector('.carousel-btn.next');
        const dots = document.querySelectorAll('.dot');
        if (track && prevBtn && nextBtn && dots.length) {
            let index = 0;
            const totalSlides = Math.max(dots.length, 1);

            function updateCarousel() {
                track.style.transform = 'translateX(-' + (index * 100) + '%)';
                dots.forEach(function (dot, i) {
                    dot.classList.toggle('active', i === index);
                });
            }

            nextBtn.addEventListener('click', function () {
                index = (index + 1) % totalSlides;
                updateCarousel();
            });

            prevBtn.addEventListener('click', function () {
                index = (index - 1 + totalSlides) % totalSlides;
                updateCarousel();
            });

            dots.forEach(function (dot, i) {
                dot.addEventListener('click', function () {
                    index = i;
                    updateCarousel();
                });
            });
        }

        if (window.AOS) {
            AOS.init({
                duration: 1000,
                once: true
            });
        }
    });
</script>
</body>
</html>
