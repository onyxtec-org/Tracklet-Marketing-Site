    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="{{ route('landing') }}" class="logo">
                        <img src="{{ asset('LOGO.svg') }}" alt="Tracklet" class="logo-img" width="150" height="55">
                    </a>
                    <p>The all-in-one asset management platform for modern organizations. Track, manage, and optimize your physical resources.</p>
                    <div class="social-links">
                        <a href="#" class="social-link"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>
                        <a href="#" class="social-link"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg></a>
                        <a href="#" class="social-link"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/></svg></a>
                    </div>
                </div>
                <div class="footer-column">
                    <h4>Product</h4>
                    <ul><li><a href="#features">Features</a></li><li><a href="#pricing">Pricing</a></li><li><a href="#">Integrations</a></li><li><a href="#">Updates</a></li></ul>
                </div>
                <div class="footer-column">
                    <h4>Company</h4>
                    <ul><li><a href="#">About</a></li><li><a href="{{ route('blog') }}">Blog</a></li><li><a href="#">Careers</a></li><li><a href="{{ route('contact') }}">Contact</a></li></ul>
                </div>
                <div class="footer-column">
                    <h4>Resources</h4>
                    <ul><li><a href="#">Documentation</a></li><li><a href="#">Help Center</a></li><li><a href="#">API Reference</a></li><li><a href="#">Community</a></li></ul>
                </div>
                <div class="footer-column">
                    <h4>Legal</h4>
                    <ul><li><a target="_blank" href="{{ route('privacy') }}">Privacy Policy</a></li><li><a target="_blank" href="{{ route('terms') }}">Terms of Service</a></li><li><a href="#">Cookie Policy</a></li><li><a href="#">GDPR</a></li></ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2024 Tracklet. All rights reserved.</p>
                <div class="footer-bottom-links">
                    <a target="_blank" href="{{ route('privacy') }}">Privacy</a>
                    <a target="_blank" href="{{ route('terms') }}">Terms</a>
                    <a href="#">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll
        window.addEventListener('scroll', () => {
            document.querySelector('.navbar').classList.toggle('scrolled', window.scrollY > 20);
        });
        
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', e => {
                e.preventDefault();
                const t = document.querySelector(a.getAttribute('href'));
                if (t) t.scrollIntoView({ behavior: 'smooth' });
            });
        });
        
        // Scroll Animation Observer
        const scrollObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });
        
        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            scrollObserver.observe(el);
        });
        
        // Counter Animation
        function animateCounter(element, target, suffix, isDecimal) {
            const duration = 2000;
            const start = 0;
            const startTime = performance.now();
            
            function update(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                
                // Easing function (easeOutExpo)
                const easeProgress = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
                
                let current = start + (target - start) * easeProgress;
                
                if (isDecimal) {
                    element.textContent = current.toFixed(1) + suffix;
                } else {
                    element.textContent = Math.floor(current) + suffix;
                }
                
                if (progress < 1) {
                    requestAnimationFrame(update);
                }
            }
            
            requestAnimationFrame(update);
        }
        
        // Stats Counter Observer
        let statsAnimated = false;
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !statsAnimated) {
                    statsAnimated = true;
                    document.querySelectorAll('.stat-value[data-count]').forEach(stat => {
                        const target = parseFloat(stat.dataset.count);
                        const suffix = stat.dataset.suffix || '';
                        const isDecimal = stat.dataset.decimal === 'true';
                        animateCounter(stat, target, suffix, isDecimal);
                    });
                }
            });
        }, {
            threshold: 0.3
        });
        
        const statsSection = document.getElementById('stats-section');
        if (statsSection) {
            statsObserver.observe(statsSection);
        }
    </script>
    <script>
        // Category Filtering
        const categoryBtns = document.querySelectorAll('.category-btn');
        const featuredCards = document.querySelectorAll('.featured-card');
        const articleCards = document.querySelectorAll('.article-card');
        const noResults = document.getElementById('noResults');
        const loadMoreWrapper = document.getElementById('loadMoreWrapper');
        const featuredSection = document.querySelector('.featured-section');

        let currentCategory = 'all';

        categoryBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Update active state
                categoryBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                
                currentCategory = btn.dataset.category;
                filterArticles();
            });
        });

        function filterArticles() {
            let visibleFeatured = 0;
            let visibleArticles = 0;

            // Filter featured cards
            featuredCards.forEach(card => {
                const category = card.dataset.category;
                if (currentCategory === 'all' || category === currentCategory) {
                    card.classList.remove('hidden');
                    visibleFeatured++;
                } else {
                    card.classList.add('hidden');
                }
            });

            // Filter article cards
            articleCards.forEach(card => {
                const category = card.dataset.category;
                if (currentCategory === 'all' || category === currentCategory) {
                    card.classList.remove('hidden');
                    visibleArticles++;
                } else {
                    card.classList.add('hidden');
                }
            });

            // Show/hide featured section
            featuredSection.style.display = visibleFeatured > 0 ? 'block' : 'none';

            // Show/hide no results message
            if (visibleFeatured === 0 && visibleArticles === 0) {
                noResults.style.display = 'block';
                loadMoreWrapper.style.display = 'none';
            } else {
                noResults.style.display = 'none';
                loadMoreWrapper.style.display = 'block';
            }
        }

        // Search functionality
        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            let visibleCount = 0;

            // Reset category filter when searching
            if (searchTerm) {
                categoryBtns.forEach(b => b.classList.remove('active'));
                document.querySelector('[data-category="all"]').classList.add('active');
            }

            // Search featured cards
            featuredCards.forEach(card => {
                const title = card.querySelector('.card-title').textContent.toLowerCase();
                const excerpt = card.querySelector('.card-excerpt').textContent.toLowerCase();
                const category = card.querySelector('.badge-category').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || excerpt.includes(searchTerm) || category.includes(searchTerm)) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });

            // Search article cards
            articleCards.forEach(card => {
                const title = card.querySelector('.card-title').textContent.toLowerCase();
                const excerpt = card.querySelector('.card-excerpt').textContent.toLowerCase();
                const category = card.querySelector('.badge-category').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || excerpt.includes(searchTerm) || category.includes(searchTerm)) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });

            // Update visibility states
            const visibleFeatured = document.querySelectorAll('.featured-card:not(.hidden)').length;
            featuredSection.style.display = visibleFeatured > 0 ? 'block' : 'none';

            if (visibleCount === 0) {
                noResults.style.display = 'block';
                loadMoreWrapper.style.display = 'none';
            } else {
                noResults.style.display = 'none';
                loadMoreWrapper.style.display = 'block';
            }
        });

        // Mobile menu toggle
        document.querySelector('.mobile-menu-btn').addEventListener('click', () => {
            const navLinks = document.querySelector('.nav-links');
            const navActions = document.querySelector('.nav-actions');
            navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
            navActions.style.display = navActions.style.display === 'flex' ? 'none' : 'flex';
        });
    </script>
        <script>
        // Mobile menu toggle
        document.querySelector('.mobile-menu-btn')?.addEventListener('click', () => {
            const navLinks = document.querySelector('.nav-links');
            const navActions = document.querySelector('.nav-actions');
            if (navLinks) navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
            if (navActions) navActions.style.display = navActions.style.display === 'flex' ? 'none' : 'flex';
        });
    </script>
</body>
</html>