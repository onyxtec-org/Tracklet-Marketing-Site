@include('layouts.header')

    <!-- Hero -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">
                    <span class="hero-badge-dot"></span>
                    Trusted by 10,000+ organizations worldwide
                </div>
                <h1 class="hero-title">Say Goodbye to<br><span class="highlight">Administrative Chaos</span></h1>
                <p class="hero-description">Tracklet gives your team one live dashboard for expenses, inventory, and assets. See what’s in stock, who has which device, and where the money is going, without chasing spreadsheets or email threads.</p>
                <div class="hero-actions">
                    <a href="{{route('contact')}}" class="btn btn-primary">Request a Demo <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                    <a href="#" class="btn btn-secondary"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8" fill="currentColor"/></svg> Watch Video</a>
                </div>
                <div class="hero-trust">
                    <span class="hero-trust-item"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Free 14-day trial</span>
                    <span class="hero-trust-item"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> No credit card required</span>
                    <span class="hero-trust-item"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Cancel anytime</span>
                </div>
            </div>
            <div class="hero-visual">
                <div class="hero-browser">
                    <div class="browser-header">
                        <span class="browser-dot red"></span>
                        <span class="browser-dot yellow"></span>
                        <span class="browser-dot green"></span>
                        <span class="browser-url">tracklet.com/dashboard</span>
                    </div>
                    <div class="browser-content">
                        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?w=800&h=400&fit=crop" alt="Dashboard">
                    </div>
                </div>
                <div class="floating-card floating-card-1">
                    <div class="floating-label">Assets Tracked</div>
                    <div class="floating-value">2,847</div>
                    <div class="floating-change">↑ 12% this month</div>
                </div>
                <div class="floating-card floating-card-2">
                    <div class="floating-label">Time Saved</div>
                    <div class="floating-value">40 hrs</div>
                    <div class="floating-change" style="color: var(--primary);">per week</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="stats" id="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat animate-on-scroll delay-1"><div class="stat-value" data-count="10" data-suffix="K+">0</div><div class="stat-label">Organizations</div></div>
                <div class="stat animate-on-scroll delay-2"><div class="stat-value" data-count="5" data-suffix="M+">0</div><div class="stat-label">Assets Managed</div></div>
                <div class="stat animate-on-scroll delay-3"><div class="stat-value" data-count="99.9" data-suffix="%" data-decimal="true">0</div><div class="stat-label">Uptime</div></div>
                <div class="stat animate-on-scroll delay-4"><div class="stat-value" data-count="40" data-suffix="hrs">0</div><div class="stat-label">Avg. Time Saved/Week</div></div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="section" id="features">
        <div class="container">
            <div class="section-header animate-on-scroll">
                <span class="section-tag">Platform Features</span>
                <h2 class="section-title">Everything You Need to Manage Your Assets</h2>
                <p class="section-description">From tracking inventory to scheduling maintenance, Tracklet gives you complete control over your organization's physical resources.</p>
            </div>
            <div class="features-grid">
                <div class="feature-card animate-on-scroll delay-1">
                    <div class="feature-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></div>
                    <h3 class="feature-title">Asset Management</h3>
                    <p class="feature-description">Track laptops, equipment, appliances, and fixed assets with unique codes, assignments, locations, and full movement history — all in real-time.</p>
                </div>
                <div class="feature-card animate-on-scroll delay-2">
                    <div class="feature-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg></div>
                    <h3 class="feature-title">Inventory Tracking</h3>
                    <p class="feature-description">Never run out of supplies. Set minimum thresholds, log stock-in/out, and get automatic low-stock alerts with full purchase and aging history.</p>
                </div>
                <div class="feature-card animate-on-scroll delay-3">
                    <div class="feature-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="9"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg></div>
                    <h3 class="feature-title">Expense Tracking</h3>
                    <p class="feature-description">Monitor all organizational expenses in one place. View monthly, quarterly, and YTD spend with visual charts, summaries, and easy exports.</p>
                </div>
                <div class="feature-card animate-on-scroll delay-4">
                    <div class="feature-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="4" y1="21" x2="4" y2="14"/><line x1="4" y1="10" x2="4" y2="3"/><line x1="12" y1="21" x2="12" y2="12"/><line x1="12" y1="8" x2="12" y2="3"/><line x1="20" y1="21" x2="20" y2="16"/><line x1="20" y1="12" x2="20" y2="3"/></svg></div>
                    <h3 class="feature-title">Maintenance Scheduling</h3>
                    <p class="feature-description">Plan and track all repairs, inspections, and scheduled maintenance. See upcoming tasks for the next 7 days and reduce downtime effortlessly.</p>
                </div>
                <div class="feature-card animate-on-scroll delay-5">
                    <div class="feature-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg></div>
                    <h3 class="feature-title">Multi-Organization Support</h3>
                    <p class="feature-description">Manage multiple locations, branches, or client organizations with strict data isolation. Each org gets its own secure dashboard and users.</p>
                </div>
                <div class="feature-card animate-on-scroll delay-6">
                    <div class="feature-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
                    <h3 class="feature-title">Role-Based Access Control</h3>
                    <p class="feature-description">Give Admins, Finance, Support, and Staff the right level of access. Everyone sees only what they need—nothing more, nothing less.</p>
                </div>
                <div class="feature-card animate-on-scroll delay-7">
                    <div class="feature-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="20" x2="12" y2="10"/><line x1="18" y1="20" x2="18" y2="4"/><line x1="6" y1="20" x2="6" y2="16"/></svg></div>
                    <h3 class="feature-title">Real-Time Dashboard</h3>
                    <p class="feature-description">View expenses, low-stock items, asset status, and upcoming maintenance from one unified dashboard — your single source of truth.</p>
                </div>
                <div class="feature-card animate-on-scroll delay-8">
                    <div class="feature-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
                    <h3 class="feature-title">Secure & Compliant</h3>
                    <p class="feature-description">Enterprise-grade security with RBAC, encrypted data, verified Stripe webhooks, and isolated organization environments.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Mid CTA -->
    <div class="mid-cta">
        <div class="container">
            <p class="mid-cta-text">Want to see Tracklet in action?</p>
            <a href="{{ route('contact') }}" class="btn btn-primary">Schedule a Demo</a>
        </div>
    </div>

    <!-- How It Works -->
    <section class="section section-how-it-works" id="how-it-works">
        <div class="container">
            <div class="section-header animate-on-scroll">
                <span class="section-tag">How It Works</span>
                <h2 class="section-title">Simple, Efficient Workflow</h2>
                <p class="section-description">Get started in minutes and streamline your asset management process with our intuitive four-step workflow.</p>
            </div>
            <div class="steps-grid">
                <div class="steps-connector"></div>
                <div class="step-card animate-on-scroll delay-1">
                    <span class="step-number">01</span>
                    <div class="step-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><line x1="9" y1="15" x2="15" y2="15"/></svg></div>
                    <h3 class="step-title">Asset Registration</h3>
                    <p class="step-description">Quickly register all your assets, furniture, equipment, and inventory with unique codes and tags.</p>
                </div>
                <div class="step-card animate-on-scroll delay-2">
                    <span class="step-number">02</span>
                    <div class="step-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/></svg></div>
                    <h3 class="step-title">Real-Time Tracking</h3>
                    <p class="step-description">Monitor asset locations, assignments, status, and utilization across all your offices and locations.</p>
                </div>
                <div class="step-card animate-on-scroll delay-3">
                    <span class="step-number">03</span>
                    <div class="step-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg></div>
                    <h3 class="step-title">Maintenance Management</h3>
                    <p class="step-description">Schedule preventive maintenance, log repairs, and ensure zero equipment downtime.</p>
                </div>
                <div class="step-card animate-on-scroll delay-4">
                    <span class="step-number">04</span>
                    <div class="step-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
                    <h3 class="step-title">Audit & Reporting</h3>
                    <p class="step-description">Generate comprehensive reports for audits, compliance, depreciation, and financial tracking.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Banner -->
    <section class="section">
        <div class="cta-banner animate-on-scroll animate-scale">
            <h2 class="cta-banner-title">Ready to simplify your asset management?</h2>
            <p class="cta-banner-text">Join thousands of organizations that have eliminated spreadsheet chaos and saved countless hours with Tracklet.</p>
            <a href="{{ env('WEB_URL') }}" class="btn btn-white">Get Started Free</a>
        </div>
    </section>

    <!-- Benefits -->
    <section class="section" id="benefits">
        <div class="container">
            <div class="section-header animate-on-scroll">
                <span class="section-tag">Value Proposition</span>
                <h2 class="section-title">Why Organizations Choose Tracklet</h2>
                <p class="section-description">Stop wasting time on Excel spreadsheets and eliminate the administrative burden of manual asset tracking.</p>
            </div>
            <div class="benefits-grid">
                <div class="benefits-image animate-on-scroll animate-fade-left">
                    <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?w=600&h=500&fit=crop" alt="Office">
                </div>
                <div class="benefits-list">
                    <div class="benefit-item animate-on-scroll animate-fade-right delay-1">
                        <div class="benefit-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
                        <div><h4 class="benefit-title">Save 40+ Hours Per Week</h4><p class="benefit-description">Eliminate manual tracking and reduce administrative workload by automating asset management.</p></div>
                    </div>
                    <div class="benefit-item animate-on-scroll animate-fade-right delay-2">
                        <div class="benefit-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg></div>
                        <div><h4 class="benefit-title">Reduce Costs by 30%</h4><p class="benefit-description">Prevent over-ordering, reduce asset loss, and optimize maintenance schedules to cut expenses.</p></div>
                    </div>
                    <div class="benefit-item animate-on-scroll animate-fade-right delay-3">
                        <div class="benefit-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
                        <div><h4 class="benefit-title">100% Accountability</h4><p class="benefit-description">Track who has what, where, and when with complete audit trails and assignment history.</p></div>
                    </div>
                    <div class="benefit-item animate-on-scroll animate-fade-right delay-4">
                        <div class="benefit-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
                        <div><h4 class="benefit-title">Multi-Location Management</h4><p class="benefit-description">Manage assets across multiple offices, floors, and coworking spaces from one dashboard.</p></div>
                    </div>
                    <div class="benefit-item animate-on-scroll animate-fade-right delay-5">
                        <div class="benefit-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
                        <div><h4 class="benefit-title">Easy Audits & Compliance</h4><p class="benefit-description">Generate reports in seconds for audits, compliance, and financial tracking requirements.</p></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Comparison -->
    <section class="section section-light">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Excel Spreadsheets vs. Tracklet</h2>
            </div>
            <div class="comparison-grid">
                <div class="comparison-card excel">
                    <div class="comparison-header">
                        <div class="comparison-icon red"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></div>
                        <h3 class="comparison-title">Excel Spreadsheets</h3>
                    </div>
                    <ul class="comparison-list">
                        <li>Manual data entry and updates</li>
                        <li>Version control nightmares</li>
                        <li>No real-time visibility</li>
                        <li>Difficult to scale and audit</li>
                        <li>Prone to errors and loss</li>
                    </ul>
                </div>
                <div class="comparison-card tracklet">
                    <div class="comparison-header">
                        <div class="comparison-icon green"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <h3 class="comparison-title">Tracklet Platform</h3>
                    </div>
                    <ul class="comparison-list">
                        <li>Automated tracking and alerts</li>
                        <li>Single source of truth</li>
                        <li>Real-time insights and reports</li>
                        <li>Built for enterprise scale</li>
                        <li>Complete audit trails</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="section" id="testimonials">
        <div class="container">
            <div class="section-header animate-on-scroll">
                <span class="section-tag">Customer Success Stories</span>
                <h2 class="section-title">Trusted by Leading Organizations</h2>
                <p class="section-description">See how companies around the world are transforming their asset management with Tracklet.</p>
            </div>
            <div class="testimonials-grid">
                <div class="testimonial-card animate-on-scroll delay-1">
                    <div class="testimonial-quote">"</div>
                    <div class="testimonial-stars"><svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg></div>
                    <p class="testimonial-content">"Tracklet has been a game-changer for our organization. We've reduced our asset tracking time by 75% and eliminated all the headaches of managing Excel spreadsheets."</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar"><img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Sarah"></div>
                        <div><div class="testimonial-name">Sarah Johnson</div><div class="testimonial-role">IT Manager, TechCorp Global</div></div>
                    </div>
                </div>
                <div class="testimonial-card animate-on-scroll delay-2">
                    <div class="testimonial-quote">"</div>
                    <div class="testimonial-stars"><svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg></div>
                    <p class="testimonial-content">"Managing furniture and equipment across 15 coworking locations used to be a nightmare. Tracklet gave us complete visibility and saved us thousands in lost assets."</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar"><img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Michael"></div>
                        <div><div class="testimonial-name">Michael Chen</div><div class="testimonial-role">Operations Director, CoWork Spaces Inc.</div></div>
                    </div>
                </div>
                <div class="testimonial-card animate-on-scroll delay-3">
                    <div class="testimonial-quote">"</div>
                    <div class="testimonial-stars"><svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg></div>
                    <p class="testimonial-content">"The depreciation tracking and financial reporting features have made our audit process so much easier. I can't imagine going back to manual tracking."</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar"><img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Emily"></div>
                        <div><div class="testimonial-name">Emily Rodriguez</div><div class="testimonial-role">Finance Manager, Global Solutions Ltd</div></div>
                    </div>
                </div>
                <div class="testimonial-card animate-on-scroll delay-4">
                    <div class="testimonial-quote">"</div>
                    <div class="testimonial-stars"><svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg><svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg></div>
                    <p class="testimonial-content">"The maintenance scheduling feature alone has saved us from countless equipment failures. Our downtime has dropped to nearly zero."</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar"><img src="https://randomuser.me/api/portraits/men/75.jpg" alt="David"></div>
                        <div><div class="testimonial-name">David Patel</div><div class="testimonial-role">Facilities Manager, Enterprise Holdings</div></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Logos -->
    <section class="logos">
        <p class="logos-title">Trusted by organizations worldwide</p>
        <div class="logos-grid">
            <span>Company Logo</span>
            <span>Company Logo</span>
            <span>Company Logo</span>
            <span>Company Logo</span>
            <span>Company Logo</span>
        </div>
    </section>

    <!-- Pricing -->
    <section class="section" id="pricing">
        <div class="container">
            <div class="section-header animate-on-scroll">
                <span class="section-tag">Pricing Plans</span>
                <h2 class="section-title">Simple, Transparent Pricing</h2>
                <p class="section-description">Choose the plan that fits your organization. All plans include a 14-day free trial with no credit card required.</p>
            </div>
            <div class="pricing-grid">
                <div class="pricing-card featured animate-on-scroll delay-1">
                    <h3 class="pricing-name">Tracklet</h3>
                    <p class="pricing-description">Complete asset management solution</p>
                    <div class="pricing-price"><span class="pricing-amount">$999</span><span class="pricing-period"> per year</span></div>
                    <a href="{{ env('WEB_URL') }}" class="btn btn-primary" style="width:100%;">Get Started</a>
                    <ul class="pricing-features">
                        <li><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg> Unlimited assets</li>
                        <li><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg> Unlimited locations</li>
                        <li><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg> Advanced reporting</li>
                        <li><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg> Priority support</li>
                        <li><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg> Mobile app access</li>
                        <li><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg> Asset tracking</li>
                        <li><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg> Maintenance scheduling</li>
                        <li><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg> Custom workflows</li>
                        <li><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg> API access</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="final-cta" id="contact">
        <div class="container">
            <div class="final-cta-content">
                <h2 class="final-cta-title">Ready to Eliminate Spreadsheet Chaos?</h2>
                <p class="final-cta-text">Join 10,000+ organizations using Tracklet to save time, reduce costs, and gain complete visibility over their assets.</p>
                <ul class="final-cta-list">
                    <li><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Free 14-day trial, no credit card required</li>
                    <li><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Setup in minutes, not days</li>
                    <li><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Cancel anytime, no questions asked</li>
                    <li><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Dedicated onboarding support</li>
                </ul>
                <div class="final-cta-actions">
                    <a href="{{ env('WEB_URL') }}" class="btn btn-white">Start Your Free Trial <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-white">Schedule a Demo</a>
                </div>
            </div>
            <div class="final-cta-image">
                <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?w=600&h=600&fit=crop" alt="Office">
            </div>
        </div>
    </section>

   @include('layouts.footer')