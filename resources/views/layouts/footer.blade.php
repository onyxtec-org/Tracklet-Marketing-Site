    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="{{ route('landing') }}" class="logo">
                        <img src="{{ asset('footer-logo.png') }}" alt="Tracklet" class="logo-img" width="150" height="55">
                    </a>
                    <p>The all-in-one asset management platform for modern organizations. Track, manage, and optimize your physical resources.</p>
                    <div class="social-links">
                        <a href="https://instagram.com/tracklet.co" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="Instagram">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                            </svg>
                        </a>
                        <a href="https://facebook.com/tracklet.co" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="Facebook">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                            </svg>
                        </a>
                        <a href="mailto:trackletsocials@gmail.com" class="social-link" aria-label="Email">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </a>
                        <a href="https://linkedin.com/company/tracklet.co" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="LinkedIn">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
                                <rect x="2" y="9" width="4" height="12"/>
                                <circle cx="4" cy="4" r="2"/>
                            </svg>
                        </a>
                        <a href="https://tiktok.com/@tracklet.co" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="TikTok">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                            </svg>
                        </a>
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
                <p>© {{ date('Y') }} Tracklet. All rights reserved.</p>
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