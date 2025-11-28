    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a href="{{ route('landing') }}" class="logo">
                <div class="logo-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2" />
                        <rect x="9" y="3" width="6" height="4" rx="1" />
                    </svg>
                </div>
                Tracklet
            </a>
            <ul class="nav-links">
                <li><a href="{{ route('landing') }}#features">Features</a></li>
                <li><a href="{{ route('landing') }}#how-it-works">How It Works</a></li>
                <li><a href="{{ route('landing') }}#pricing">Pricing</a></li>
                <li><a href="{{ route('blog') }}">Blog</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
            <div class="nav-actions">
                <a href="{{ env('WEB_URL') }}" class="btn btn-ghost">Sign In</a>
                <a href="{{ env('WEB_URL') }}" class="btn btn-primary">Get Started</a>
            </div>
            <button class="mobile-menu-btn"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <path d="M3 12h18M3 6h18M3 18h18" />
                </svg></button>
        </div>
    </nav>