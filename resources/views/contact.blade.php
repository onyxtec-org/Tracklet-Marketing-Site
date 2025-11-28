<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contact Tracklet - Get in touch with our team">
    <title>Contact Us - Tracklet</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #9333ea;
            --primary-light: #a855f7;
            --primary-dark: #7c22ce;
            --primary-bg: rgba(147, 51, 234, 0.08);
            --background: #ffffff;
            --foreground: #1a1a2e;
            --muted: #717182;
            --muted-bg: #f8f9fa;
            --border: rgba(0, 0, 0, 0.08);
            --success: #22c55e;
            --error: #ef4444;
            --radius: 12px;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; background: var(--background); color: var(--foreground); line-height: 1.6; }
        a { text-decoration: none; color: inherit; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
        
        /* Navbar */
        .navbar { position: fixed; top: 0; left: 0; right: 0; z-index: 1000; padding: 16px 0; background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); border-bottom: 1px solid var(--border); }
        .navbar .container { display: flex; align-items: center; justify-content: space-between; }
        .logo { display: flex; align-items: center; gap: 10px; font-weight: 700; font-size: 1.35rem; }
        .logo-icon { width: 40px; height: 40px; background: var(--primary); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; }
        .nav-links { display: flex; gap: 32px; list-style: none; }
        .nav-links a { color: var(--primary); font-weight: 500; font-size: 0.95rem; }
        .nav-links a:hover { opacity: 0.8; }
        .nav-links a.active { color: var(--primary); font-weight: 600; }
        .nav-actions { display: flex; align-items: center; gap: 16px; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 12px 24px; border-radius: var(--radius); font-weight: 600; font-size: 0.95rem; cursor: pointer; border: none; transition: all 0.2s; }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-secondary { background: white; color: var(--foreground); border: 1px solid var(--border); }
        .btn-secondary:hover { border-color: var(--primary); color: var(--primary); }
        .btn-white { background: white; color: var(--primary); }
        .btn-ghost { background: transparent; color: var(--muted); }
        .mobile-menu-btn { display: none; background: none; border: none; cursor: pointer; padding: 8px; }

        /* Hero Section */
        .contact-hero { padding: 140px 0 80px; background: linear-gradient(180deg, var(--primary-bg) 0%, var(--background) 100%); text-align: center; }
        .contact-hero .section-tag { display: inline-block; padding: 8px 20px; background: white; border: 1px solid var(--border); border-radius: 100px; font-size: 0.9rem; color: var(--primary); font-weight: 600; margin-bottom: 24px; }
        .contact-hero h1 { font-size: 3rem; font-weight: 700; margin-bottom: 20px; letter-spacing: -0.02em; }
        .contact-hero h1 .highlight { color: var(--primary); }
        .contact-hero p { font-size: 1.1rem; color: var(--muted); max-width: 700px; margin: 0 auto; line-height: 1.7; }

        /* Contact Cards */
        .contact-cards { padding: 60px 0; }
        .contact-cards-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; }
        .contact-card { background: white; border: 1px solid var(--border); border-radius: var(--radius); padding: 28px; transition: all 0.2s; }
        .contact-card:hover { box-shadow: 0 10px 40px rgba(0,0,0,0.08); transform: translateY(-2px); }
        .contact-card-icon { width: 52px; height: 52px; background: var(--primary-bg); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--primary); margin-bottom: 20px; }
        .contact-card h3 { font-size: 1.1rem; font-weight: 600; margin-bottom: 8px; }
        .contact-card p { font-size: 0.9rem; color: var(--muted); line-height: 1.6; }

        /* Form & Info Section */
        .contact-section { padding: 60px 0 100px; }
        .contact-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; }
        
        /* Form */
        .contact-form-card { background: white; border: 1px solid var(--border); border-radius: 20px; padding: 40px; }
        .contact-form-card h2 { font-size: 1.75rem; font-weight: 700; margin-bottom: 8px; }
        .contact-form-card > p { color: var(--muted); margin-bottom: 32px; font-size: 0.95rem; }
        .form-group { margin-bottom: 24px; }
        .form-label { display: block; font-size: 0.9rem; font-weight: 500; margin-bottom: 8px; color: var(--foreground); }
        .form-label .required { color: var(--primary); }
        .form-label .optional { color: var(--muted); font-weight: 400; }
        .form-input, .form-textarea, .form-select { width: 100%; padding: 14px 16px; border: 1px solid var(--border); border-radius: var(--radius); font-size: 0.95rem; font-family: inherit; transition: all 0.2s; background: white; }
        .form-input:focus, .form-textarea:focus, .form-select:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px var(--primary-bg); }
        .form-input::placeholder, .form-textarea::placeholder { color: #a0a0a0; }
        .form-textarea { min-height: 140px; resize: vertical; }
        .form-select { cursor: pointer; appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23717182' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; background-size: 20px; }
        .form-submit { width: 100%; padding: 16px; font-size: 1rem; margin-top: 8px; }
        .form-note { text-align: center; color: var(--muted); font-size: 0.85rem; margin-top: 16px; }

        /* Contact Info */
        .contact-info h2 { font-size: 1.5rem; font-weight: 700; margin-bottom: 24px; }
        .info-card { background: white; border: 1px solid var(--border); border-radius: var(--radius); padding: 24px; display: flex; gap: 16px; align-items: flex-start; margin-bottom: 16px; transition: all 0.2s; }
        .info-card:hover { border-color: var(--primary); }
        .info-card-icon { width: 48px; height: 48px; background: var(--primary-bg); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--primary); flex-shrink: 0; }
        .info-card h4 { font-size: 0.85rem; color: var(--muted); font-weight: 500; margin-bottom: 4px; }
        .info-card a { color: var(--primary); font-weight: 600; font-size: 1rem; }
        .info-card p { color: var(--muted); font-size: 0.85rem; margin-top: 4px; }

        /* Business Hours */
        .hours-card { background: var(--muted-bg); border: 1px solid var(--border); border-radius: var(--radius); padding: 24px; margin-bottom: 16px; }
        .hours-card-header { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }
        .hours-card-icon { width: 40px; height: 40px; background: var(--primary-bg); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--primary); }
        .hours-card h3 { font-size: 1.1rem; font-weight: 600; }
        .hours-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid var(--border); font-size: 0.9rem; }
        .hours-row:last-child { border-bottom: none; }
        .hours-row span:first-child { color: var(--muted); }
        .hours-row span:last-child { font-weight: 500; }

        /* Live Chat Card */
        .chat-card { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); border-radius: var(--radius); padding: 28px; color: white; margin-bottom: 16px; }
        .chat-card-header { display: flex; align-items: center; gap: 12px; margin-bottom: 12px; }
        .chat-card-icon { width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .chat-card h3 { font-size: 1.1rem; font-weight: 600; }
        .chat-card p { font-size: 0.9rem; opacity: 0.9; margin-bottom: 20px; }
        .chat-card .btn { background: white; color: var(--primary); width: 100%; }

        /* Social Links */
        .social-section { margin-top: 32px; }
        .social-section h3 { font-size: 1.1rem; font-weight: 600; margin-bottom: 16px; }
        .social-links { display: flex; gap: 12px; }
        .social-link { width: 48px; height: 48px; background: var(--muted-bg); border: 1px solid var(--border); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--muted); transition: all 0.2s; font-weight: 600; font-size: 0.85rem; }
        .social-link:hover { background: var(--primary); color: white; border-color: var(--primary); }

        /* Support Image */
        .support-image { margin-top: 24px; border-radius: var(--radius); overflow: hidden; }
        .support-image img { width: 100%; height: 250px; object-fit: cover; }

        /* FAQ Section */
        .faq-section { padding: 100px 0; background: var(--muted-bg); }
        .faq-section .section-tag { display: inline-block; padding: 8px 20px; background: white; border: 1px solid var(--border); border-radius: 100px; font-size: 0.9rem; color: var(--primary); font-weight: 600; margin-bottom: 20px; }
        .faq-header { text-align: center; margin-bottom: 60px; }
        .faq-header h2 { font-size: 2.25rem; font-weight: 700; margin-bottom: 16px; }
        .faq-header p { color: var(--muted); font-size: 1.05rem; }
        .faq-grid { display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 48px; }

        /* FAQ Accordion */
        .faq-list { display: flex; flex-direction: column; gap: 16px; }
        .faq-item { background: white; border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; }
        .faq-question { width: 100%; padding: 20px 24px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; cursor: pointer; font-size: 1rem; font-weight: 500; text-align: left; font-family: inherit; color: var(--foreground); transition: all 0.2s; }
        .faq-question:hover { color: var(--primary); }
        .faq-question svg { flex-shrink: 0; transition: transform 0.3s; color: var(--primary); }
        .faq-item.active .faq-question svg { transform: rotate(180deg); }
        .faq-answer { padding: 0 24px 20px; color: var(--muted); font-size: 0.95rem; line-height: 1.7; display: none; }
        .faq-item.active .faq-answer { display: block; }

        /* Resources */
        .resources-sidebar h3 { font-size: 1.25rem; font-weight: 700; margin-bottom: 20px; }
        .resource-card { background: white; border: 1px solid var(--border); border-radius: var(--radius); padding: 20px; display: flex; gap: 16px; align-items: center; margin-bottom: 16px; transition: all 0.2s; cursor: pointer; }
        .resource-card:hover { border-color: var(--primary); transform: translateX(4px); }
        .resource-card-icon { width: 48px; height: 48px; background: var(--primary-bg); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--primary); flex-shrink: 0; }
        .resource-card h4 { font-size: 1rem; font-weight: 600; margin-bottom: 4px; }
        .resource-card p { font-size: 0.85rem; color: var(--muted); }

        /* Still Questions Card */
        .still-questions { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); border-radius: var(--radius); padding: 28px; color: white; margin-top: 24px; }
        .still-questions h4 { font-size: 1.1rem; font-weight: 600; margin-bottom: 8px; }
        .still-questions p { font-size: 0.9rem; opacity: 0.9; margin-bottom: 20px; }
        .still-questions .btn { background: white; color: var(--primary); width: 100%; }

        /* Footer */
        .footer { background: white; border-top: 1px solid var(--border); padding: 60px 0 32px; }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr 1fr; gap: 40px; margin-bottom: 48px; }
        .footer-brand p { color: var(--muted); font-size: 0.9rem; margin: 16px 0 20px; max-width: 280px; line-height: 1.6; }
        .footer-social { display: flex; gap: 12px; }
        .footer-social a { width: 40px; height: 40px; background: var(--muted-bg); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--muted); transition: all 0.2s; }
        .footer-social a:hover { background: var(--primary); color: white; }
        .footer-column h4 { font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--muted); margin-bottom: 20px; }
        .footer-column ul { list-style: none; }
        .footer-column ul li { margin-bottom: 12px; }
        .footer-column ul a { color: var(--muted); font-size: 0.9rem; }
        .footer-column ul a:hover { color: var(--primary); }
        .footer-bottom { padding-top: 32px; border-top: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; }
        .footer-bottom p { color: var(--muted); font-size: 0.85rem; }
        .footer-bottom-links { display: flex; gap: 24px; }
        .footer-bottom-links a { color: var(--muted); font-size: 0.85rem; }

        /* Form Success/Error Messages */
        .form-success {
            text-align: center;
            padding: 48px 24px;
        }
        .form-success .success-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--success) 0%, #16a34a 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            color: white;
        }
        .form-success h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--foreground);
        }
        .form-success p {
            color: var(--muted);
            margin-bottom: 24px;
            font-size: 1rem;
        }
        .form-error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: var(--radius);
            padding: 16px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .form-error .error-icon {
            color: var(--error);
            flex-shrink: 0;
        }
        .form-error p {
            color: var(--error);
            font-size: 0.9rem;
            margin: 0;
        }

        /* Loading Spinner */
        .spinner {
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .btn-loading { display: flex; align-items: center; gap: 8px; }
        #submitBtn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }
        #submitBtn:disabled .btn-icon { display: none; }

        /* Animations */
        .animate-on-scroll { opacity: 0; transform: translateY(30px); transition: opacity 0.6s ease, transform 0.6s ease; }
        .animate-on-scroll.animated { opacity: 1; transform: translateY(0); }
        .delay-1 { transition-delay: 0.1s; }
        .delay-2 { transition-delay: 0.2s; }
        .delay-3 { transition-delay: 0.3s; }
        .delay-4 { transition-delay: 0.4s; }

        /* Responsive */
        @media (max-width: 1024px) {
            .contact-cards-grid { grid-template-columns: repeat(2, 1fr); }
            .contact-grid { grid-template-columns: 1fr; }
            .faq-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            .nav-links, .nav-actions { display: none; }
            .mobile-menu-btn { display: block; }
            .contact-hero h1 { font-size: 2rem; }
            .contact-cards-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr; }
            .footer-bottom { flex-direction: column; gap: 16px; text-align: center; }
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <!-- Hero Section -->
    <section class="contact-hero">
        <div class="container">
            <span class="section-tag animate-on-scroll">Contact Us</span>
            <h1 class="animate-on-scroll delay-1">We'd Love to<br><span class="highlight">Hear from You</span></h1>
            <p class="animate-on-scroll delay-2">Whether you have questions about features, pricing, demos, or partnerships, our team is ready to help. Reach out and we'll respond as soon as possible.</p>
        </div>
    </section>

    <!-- Contact Cards -->
    <section class="contact-cards">
        <div class="container">
            <div class="contact-cards-grid">
                <div class="contact-card animate-on-scroll delay-1">
                    <div class="contact-card-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    </div>
                    <h3>Sales Inquiries</h3>
                    <p>Learn how Tracklet can help your organization</p>
                </div>
                <div class="contact-card animate-on-scroll delay-2">
                    <div class="contact-card-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/></svg>
                    </div>
                    <h3>Customer Support</h3>
                    <p>Get help from our dedicated support team</p>
                </div>
                <div class="contact-card animate-on-scroll delay-3">
                    <div class="contact-card-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <h3>Partnerships</h3>
                    <p>Explore collaboration opportunities</p>
                </div>
                <div class="contact-card animate-on-scroll delay-4">
                    <div class="contact-card-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    </div>
                    <h3>General Questions</h3>
                    <p>Any other questions or feedback</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Form & Contact Info -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-grid">
                <!-- Contact Form -->
                <div class="contact-form-card animate-on-scroll">
                    <h2>Send Us a Message</h2>
                    <p>Fill out the form below and we'll get back to you as soon as possible.</p>
                    
                    <!-- Success Message -->
                    <div id="successMessage" class="form-success" style="display: none;">
                        <div class="success-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        </div>
                        <h3>Message Sent Successfully!</h3>
                        <p>Thank you for reaching out. We've sent a confirmation email to your inbox.</p>
                        <button type="button" class="btn btn-secondary" onclick="resetForm()">Send Another Message</button>
                    </div>

                    <!-- Error Message -->
                    <div id="errorMessage" class="form-error" style="display: none;">
                        <div class="error-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                        </div>
                        <p id="errorText">Something went wrong. Please try again.</p>
                    </div>

                    <form id="contactForm" action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Full Name <span class="required">*</span></label>
                            <input type="text" name="name" class="form-input" placeholder="John Doe" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email Address <span class="required">*</span></label>
                            <input type="email" name="email" class="form-input" placeholder="john@company.com" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Company Name <span class="required">*</span></label>
                            <input type="text" name="company" class="form-input" placeholder="Acme Corporation" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone Number <span class="optional">(Optional)</span></label>
                            <input type="tel" name="phone" class="form-input" placeholder="+1 (555) 000-0000">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Reason for Contact <span class="required">*</span></label>
                            <select name="reason" class="form-select" required>
                                <option value="">Select a reason...</option>
                                <option value="sales">Sales Inquiry</option>
                                <option value="support">Customer Support</option>
                                <option value="partnership">Partnership</option>
                                <option value="demo">Request Demo</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Message <span class="required">*</span></label>
                            <textarea name="message" class="form-textarea" placeholder="Tell us how we can help you..." required></textarea>
                        </div>
                        <button type="submit" id="submitBtn" class="btn btn-primary form-submit">
                            <span class="btn-text">Send Message</span>
                            <span class="btn-loading" style="display: none;">
                                <svg class="spinner" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10" stroke-dasharray="60" stroke-dashoffset="20"/></svg>
                                Sending...
                            </span>
                            <svg class="btn-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        </button>
                        <p class="form-note">We typically respond within 24 hours during business days.</p>
                    </form>
                </div>

                <!-- Contact Info -->
                <div class="contact-info animate-on-scroll delay-2">
                    <h2>Other Ways to Reach Us</h2>
                    
                    <div class="info-card">
                        <div class="info-card-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </div>
                        <div>
                            <h4>Email Us</h4>
                            <a href="mailto:hello@tracklet.com">hello@tracklet.com</a>
                            <p>We'll respond within 24 hours</p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-card-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </div>
                        <div>
                            <h4>Call Us</h4>
                            <a href="tel:+15551234567">+1 (555) 123-4567</a>
                            <p>Mon-Fri, 9AM-6PM EST</p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-card-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div>
                            <h4>Visit Us</h4>
                            <a href="#">123 Business Ave, Suite 456</a>
                            <p>San Francisco, CA 94102</p>
                        </div>
                    </div>

                    <!-- Business Hours -->
                    <div class="hours-card">
                        <div class="hours-card-header">
                            <div class="hours-card-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </div>
                            <h3>Business Hours</h3>
                        </div>
                        <div class="hours-row">
                            <span>Monday - Friday:</span>
                            <span>9:00 AM - 6:00 PM EST</span>
                        </div>
                        <div class="hours-row">
                            <span>Saturday:</span>
                            <span>10:00 AM - 4:00 PM EST</span>
                        </div>
                        <div class="hours-row">
                            <span>Sunday:</span>
                            <span>Closed</span>
                        </div>
                    </div>

                    <!-- Live Chat -->
                    <div class="chat-card">
                        <div class="chat-card-header">
                            <div class="chat-card-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                            </div>
                            <h3>Need Immediate Help?</h3>
                        </div>
                        <p>Chat with our support team for instant assistance during business hours.</p>
                        <button class="btn">Start Live Chat</button>
                    </div>

                    <!-- Social Links -->
                    <div class="social-section">
                        <h3>Follow Us</h3>
                        <div class="social-links">
                            <a href="#" class="social-link">𝕏</a>
                            <a href="#" class="social-link">in</a>
                            <a href="#" class="social-link">f</a>
                            <a href="#" class="social-link">IG</a>
                        </div>
                    </div>

                    <!-- Support Image -->
                    <div class="support-image">
                        <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&h=300&fit=crop" alt="Support">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <div class="faq-header">
                <span class="section-tag animate-on-scroll">Quick Help</span>
                <h2 class="animate-on-scroll delay-1">Frequently Asked Questions</h2>
                <p class="animate-on-scroll delay-2">Find quick answers to common questions before reaching out.</p>
            </div>

            <div class="faq-grid">
                <div class="faq-list">
                    <div class="faq-item animate-on-scroll delay-1">
                        <button class="faq-question">
                            How quickly will I receive a response?
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </button>
                        <div class="faq-answer">
                            We typically respond to all inquiries within 24 hours during business days. For urgent matters, we recommend using our live chat feature for faster assistance.
                        </div>
                    </div>
                    <div class="faq-item animate-on-scroll delay-2">
                        <button class="faq-question">
                            Can I schedule a product demo?
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </button>
                        <div class="faq-answer">
                            Absolutely! You can request a personalized demo by filling out the contact form above and selecting "Request Demo" as your reason for contact. Our team will reach out to schedule a convenient time.
                        </div>
                    </div>
                    <div class="faq-item animate-on-scroll delay-3">
                        <button class="faq-question">
                            Do you offer support in different time zones?
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </button>
                        <div class="faq-answer">
                            Yes! While our primary support hours are 9AM-6PM EST, we have team members across different time zones to assist our global customers. Enterprise customers also get access to 24/7 dedicated support.
                        </div>
                    </div>
                    <div class="faq-item animate-on-scroll delay-4">
                        <button class="faq-question">
                            What information should I include in my message?
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </button>
                        <div class="faq-answer">
                            To help us assist you faster, please include your company name, the number of assets you manage, your current challenges, and any specific features you're interested in.
                        </div>
                    </div>
                    <div class="faq-item animate-on-scroll delay-4">
                        <button class="faq-question">
                            Is there a support portal or knowledge base?
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </button>
                        <div class="faq-answer">
                            Yes! We have a comprehensive Help Center with documentation, tutorials, and guides. You can access it anytime at help.tracklet.com for self-service support.
                        </div>
                    </div>
                </div>

                <div class="resources-sidebar">
                    <h3>Additional Resources</h3>
                    <div class="resource-card animate-on-scroll delay-1">
                        <div class="resource-card-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                        </div>
                        <div>
                            <h4>Help Center</h4>
                            <p>Browse our comprehensive documentation</p>
                        </div>
                    </div>
                    <div class="resource-card animate-on-scroll delay-2">
                        <div class="resource-card-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                        </div>
                        <div>
                            <h4>FAQs</h4>
                            <p>Find answers to common questions</p>
                        </div>
                    </div>
                    <div class="resource-card animate-on-scroll delay-3">
                        <div class="resource-card-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                        </div>
                        <div>
                            <h4>API Docs</h4>
                            <p>Technical documentation for developers</p>
                        </div>
                    </div>

                    <div class="still-questions animate-on-scroll delay-4">
                        <h4>Still have questions?</h4>
                        <p>Our support team is here to help you with any questions or concerns.</p>
                        <button class="btn">Contact Support</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Scroll Animation Observer
        const scrollObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
        
        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            scrollObserver.observe(el);
        });

        // FAQ Accordion
        document.querySelectorAll('.faq-question').forEach(button => {
            button.addEventListener('click', () => {
                const item = button.parentElement;
                const isActive = item.classList.contains('active');
                
                // Close all items
                document.querySelectorAll('.faq-item').forEach(faq => {
                    faq.classList.remove('active');
                });
                
                // Open clicked item if it wasn't active
                if (!isActive) {
                    item.classList.add('active');
                }
            });
        });

        // Contact Form Submission
        const contactForm = document.getElementById('contactForm');
        const submitBtn = document.getElementById('submitBtn');
        const successMessage = document.getElementById('successMessage');
        const errorMessage = document.getElementById('errorMessage');
        const errorText = document.getElementById('errorText');
        const btnText = submitBtn.querySelector('.btn-text');
        const btnLoading = submitBtn.querySelector('.btn-loading');
        const btnIcon = submitBtn.querySelector('.btn-icon');

        contactForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            // Hide any previous messages
            errorMessage.style.display = 'none';
            
            // Show loading state
            submitBtn.disabled = true;
            btnText.style.display = 'none';
            btnIcon.style.display = 'none';
            btnLoading.style.display = 'flex';

            const formData = new FormData(contactForm);

            try {
                const response = await fetch(contactForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    // Hide form and show success message
                    contactForm.style.display = 'none';
                    successMessage.style.display = 'block';
                } else {
                    // Show error message
                    if (data.errors) {
                        const firstError = Object.values(data.errors)[0];
                        errorText.textContent = Array.isArray(firstError) ? firstError[0] : firstError;
                    } else if (data.message) {
                        errorText.textContent = data.message;
                    }
                    errorMessage.style.display = 'flex';
                }
            } catch (error) {
                console.error('Error:', error);
                errorText.textContent = 'Network error. Please check your connection and try again.';
                errorMessage.style.display = 'flex';
            } finally {
                // Reset button state
                submitBtn.disabled = false;
                btnText.style.display = 'inline';
                btnIcon.style.display = 'inline';
                btnLoading.style.display = 'none';
            }
        });

        // Reset form function
        function resetForm() {
            contactForm.reset();
            contactForm.style.display = 'block';
            successMessage.style.display = 'none';
            errorMessage.style.display = 'none';
        }
    </script>

@include('layouts.footer')
