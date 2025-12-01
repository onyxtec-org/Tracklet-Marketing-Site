    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a href="{{ route('landing') }}" class="logo">
                <img src="{{ asset('logo.png') }}" alt="Tracklet" class="logo-img" width="150" height="55">
            </a>
            <ul class="nav-links">
                <li><a href="{{ route('landing') }}#features">Features</a></li>
                <li><a href="{{ route('landing') }}#how-it-works">How It Works</a></li>
                <li><a href="{{ route('landing') }}#pricing">Pricing</a></li>
                <li><a href="{{ route('blog') }}">Blog</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
            <div class="nav-actions">
                <a href="{{ env('WEB_URL') }}" target="_blank" class="btn btn-ghost">Sign In</a>
                <a href="{{ env('WEB_URL') }}" target="_blank" class="btn btn-primary">Get Started</a>
            </div>
            <button class="mobile-menu-btn"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <path d="M3 12h18M3 6h18M3 18h18" />
                </svg></button>
        </div>
    </nav>