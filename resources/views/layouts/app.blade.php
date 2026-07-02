<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>GERD METER - @yield('title', 'Cek Risiko Lambung Anda')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo gerd.png') }}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Geist:wght@400;500;600&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .hero-gradient {
            background: radial-gradient(circle at 70% 30%, rgba(76, 175, 80, 0.08) 0%, transparent 50%);
        }
        html {
            scroll-behavior: smooth;
        }
        .organic-wave {
            fill: #0F2916;
        }

        /* Modern Navbar Links */
        .nav-link {
            position: relative;
            padding-bottom: 4px;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #006E1C; /* Primary Color */
            transform: scaleX(0);
            transition: transform 0.3s ease;
            transform-origin: left;
            border-radius: 2px;
        }
        .nav-link.active-link::after {
            transform: scaleX(1);
        }
        .nav-link:hover,
        .nav-link.active-link {
            color: #006E1C;
        }
    </style>
</head>
<body class="bg-background text-on-surface font-body-md font-normal selection:bg-primary-container selection:text-white min-h-screen flex flex-col">

<!-- Top Navigation Bar -->
<nav class="sticky top-0 w-full z-50 bg-surface/95 backdrop-blur-md shadow-sm border-b border-surface-container-high">
    <div class="flex justify-between items-center w-full px-6 md:px-10 lg:px-12 py-4 max-w-[1400px] mx-auto">
        <a href="{{ route('home') }}" class="text-headline-md font-headline-md font-bold text-forest-green flex items-center gap-2 hover:opacity-80 transition-opacity">
            <img src="{{ asset('images/logo gerd.png') }}" alt="GERD METER Logo" class="h-8 w-auto">
            GERD METER
        </a>
        <!-- Desktop Links -->
        <div class="hidden md:flex gap-8 items-center">
            <a class="nav-link {{ request()->routeIs('home') ? 'active-link' : '' }} text-on-surface-variant font-medium transition-colors font-body-md text-body-md" href="{{ route('home') }}#home">Home</a>
            <a class="nav-link text-on-surface-variant font-medium transition-colors font-body-md text-body-md" href="{{ route('home') }}#tentang-gerd">Tentang GERD</a>
            <a class="nav-link text-on-surface-variant font-medium transition-colors font-body-md text-body-md" href="{{ route('home') }}#cara-kerja">Cara Kerja</a>
            <a class="nav-link text-on-surface-variant font-medium transition-colors font-body-md text-body-md" href="{{ route('home') }}#tips">Tips</a>
        </div>
        <div class="flex items-center gap-4">
            <form action="{{ route('start') }}" method="POST" class="hidden md:block">
                @csrf
                <button type="submit" class="bg-primary-container text-white px-6 py-2.5 rounded-full font-label-sm font-medium text-label-sm hover:opacity-90 transition-all active:scale-95">
                    Mulai Screening
                </button>
            </form>
            <button id="mobile-menu-button" class="md:hidden text-on-surface p-1 rounded-md hover:bg-surface-container-high transition-colors">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </div>

    <!-- Mobile Menu (Hidden by default) -->
    <div id="mobile-menu" class="hidden md:hidden absolute top-full left-0 w-full bg-surface shadow-md border-b border-surface-container-high">
        <div class="flex flex-col px-6 py-4 space-y-4">
            <a class="mobile-nav-link text-on-surface-variant font-medium" href="{{ route('home') }}#home">Home</a>
            <a class="mobile-nav-link text-on-surface-variant font-medium" href="{{ route('home') }}#tentang-gerd">Tentang GERD</a>
            <a class="mobile-nav-link text-on-surface-variant font-medium" href="{{ route('home') }}#cara-kerja">Cara Kerja</a>
            <a class="mobile-nav-link text-on-surface-variant font-medium" href="{{ route('home') }}#tips">Tips</a>
            <form action="{{ route('start') }}" method="POST" class="w-full pt-4 border-t border-surface-container-high mt-2">
                @csrf
                <button type="submit" class="w-full bg-primary-container text-white px-6 py-3 rounded-full font-bold">
                    Mulai Screening
                </button>
            </form>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="grow flex flex-col">
    @yield('content')
</div>

<!-- Footer & Contact Section -->
<footer id="kontak" class="bg-[#0A1A10] {{ request()->routeIs('home') ? 'pt-20 pb-10' : 'py-6' }} border-t-4 border-primary mt-auto">
    <div class="max-w-[1400px] mx-auto px-6 md:px-10 lg:px-12 w-full">
        @if(request()->routeIs('home'))
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 lg:gap-8 mb-16">
            <!-- Brand & Intro (Span 4) -->
            <div class="lg:col-span-4">
                <div class="text-2xl font-bold text-white flex items-center gap-2 mb-6">
                    <img src="{{ asset('images/logo gerd.png') }}" alt="GERD METER Logo" class="h-8 w-auto">
                    GERD<span class="text-primary font-medium">Meter</span>
                </div>
                <p class="text-white/60 text-sm leading-relaxed mb-6 pr-4">
                    Sistem pakar diagnosis dini Gastroesophageal Reflux Disease berbasis web dengan metode Backward Chaining untuk akurasi tinggi layaknya pakar medis.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-white/70 hover:bg-primary hover:text-white transition-colors">
                        <span class="material-symbols-outlined text-[20px]">language</span>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-white/70 hover:bg-primary hover:text-white transition-colors">
                        <span class="material-symbols-outlined text-[20px]">mail</span>
                    </a>
                </div>
            </div>

            <!-- Quick Links (Span 3) -->
            <div class="lg:col-span-3 lg:ml-12">
                <h4 class="text-white font-bold mb-6 text-lg">Jelajahi</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('home') }}#home" class="text-white/60 hover:text-primary transition-colors text-sm flex items-center gap-2"><span class="material-symbols-outlined text-[16px]">chevron_right</span> Beranda</a></li>
                    <li><a href="{{ route('home') }}#tentang-gerd" class="text-white/60 hover:text-primary transition-colors text-sm flex items-center gap-2"><span class="material-symbols-outlined text-[16px]">chevron_right</span> Tentang GERD</a></li>
                    <li><a href="{{ route('home') }}#cara-kerja" class="text-white/60 hover:text-primary transition-colors text-sm flex items-center gap-2"><span class="material-symbols-outlined text-[16px]">chevron_right</span> Cara Kerja</a></li>
                    <li><a href="{{ route('home') }}#tips" class="text-white/60 hover:text-primary transition-colors text-sm flex items-center gap-2"><span class="material-symbols-outlined text-[16px]">chevron_right</span> Tips Kesehatan</a></li>
                </ul>
            </div>

            <!-- Contact Information (Span 5) -->
            <div class="lg:col-span-5">
                <h4 class="text-white font-bold mb-6 text-lg">Hubungi Kami</h4>
                <div class="bg-white/5 rounded-2xl p-6 border border-white/10">
                    <ul class="space-y-6">
                        <li class="flex items-start gap-4">
                            <div class="w-10 h-10 shrink-0 rounded-full bg-primary/20 flex items-center justify-center text-primary mt-1">
                                <span class="material-symbols-outlined text-[20px]">location_on</span>
                            </div>
                            <div>
                                <h5 class="text-white font-medium text-sm mb-1">Alamat Kantor</h5>
                                <p class="text-white/60 text-sm leading-relaxed">Jl. Kesehatan No. 123, Komplek Medika<br>Jakarta Selatan, Indonesia 12345</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="w-10 h-10 shrink-0 rounded-full bg-primary/20 flex items-center justify-center text-primary mt-1">
                                <span class="material-symbols-outlined text-[20px]">support_agent</span>
                            </div>
                            <div>
                                <h5 class="text-white font-medium text-sm mb-1">Pusat Bantuan</h5>
                                <p class="text-white/60 text-sm">bantuan@gerdmeter.com<br>+62 812 3456 7890</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <!-- Copyright Bar -->
        <div class="{{ request()->routeIs('home') ? 'border-t border-white/10 pt-8' : '' }} flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-white/50 text-xs text-center md:text-left">
                &copy; {{ date('Y') }} GERDMeter System. All rights reserved.
            </p>
            <div class="flex gap-6 text-xs text-white/50 justify-center">
                <a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a>
                <a href="#" class="hover:text-white transition-colors">Syarat & Ketentuan</a>
            </div>
        </div>
    </div>
</footer>

<script>
    // Active state for navbar
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            if(window.location.pathname === '/' || window.location.pathname === '') {
                navLinks.forEach(l => {
                    l.classList.remove('active-link');
                });
                link.classList.add('active-link');
            }
        });
    });

    // Mobile Menu Toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');

    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Close menu when a link is clicked
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });
    }
</script>

@stack('scripts')

</body>
</html>
