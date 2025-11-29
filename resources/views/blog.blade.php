<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tracklet Blog - Insights, tips, and best practices for asset and inventory management">
    <title>Blog - Tracklet</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
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
        .nav-links a { color: var(--muted); font-weight: 500; font-size: 0.95rem; transition: color 0.2s; }
        .nav-links a:hover, .nav-links a.active { color: var(--primary); }
        .nav-actions { display: flex; align-items: center; gap: 16px; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 12px 24px; border-radius: var(--radius); font-weight: 600; font-size: 0.95rem; cursor: pointer; border: none; transition: all 0.2s; }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); transform: translateY(-2px); }
        .btn-ghost { background: transparent; color: var(--muted); }
        .btn-ghost:hover { color: var(--primary); }
        .btn-white { background: white; color: var(--primary); }
        .btn-white:hover { background: #f8f9fa; }

        /* Blog Hero */
        .blog-hero {
            padding: 140px 0 80px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 50%, #c084fc 100%);
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .blog-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 80%, rgba(255,255,255,0.1) 0%, transparent 50%),
                        radial-gradient(circle at 80% 20%, rgba(255,255,255,0.1) 0%, transparent 50%);
        }
        .blog-hero .container { position: relative; z-index: 1; }
        .blog-hero-icon {
            width: 64px;
            height: 64px;
            background: rgba(255,255,255,0.2);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
        }
        .blog-hero-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 16px;
            letter-spacing: -0.02em;
        }
        .blog-hero-description {
            font-size: 1.15rem;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto 40px;
            line-height: 1.7;
        }
        .search-box {
            max-width: 600px;
            margin: 0 auto;
            position: relative;
        }
        .search-box input {
            width: 100%;
            padding: 18px 24px 18px 56px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50px;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            font-size: 1rem;
            color: white;
            outline: none;
            transition: all 0.3s;
        }
        .search-box input::placeholder { color: rgba(255,255,255,0.7); }
        .search-box input:focus { background: rgba(255,255,255,0.2); border-color: rgba(255,255,255,0.5); }
        .search-box svg {
            position: absolute;
            left: 22px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.7);
        }

        /* Category Filters */
        .category-filters {
            padding: 32px 0;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 73px;
            background: white;
            z-index: 100;
        }
        .category-filters .container {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            justify-content: center;
        }
        .category-btn {
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 500;
            font-size: 0.95rem;
            cursor: pointer;
            border: 1px solid var(--border);
            background: white;
            color: var(--muted);
            transition: all 0.2s;
        }
        .category-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }
        .category-btn.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Featured Articles */
        .featured-section {
            padding: 80px 0 60px;
        }
        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 40px;
        }
        .section-header svg { color: var(--primary); }
        .section-title {
            font-size: 1.75rem;
            font-weight: 700;
            letter-spacing: -0.02em;
        }
        .featured-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 32px;
        }
        .featured-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--border);
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
        }
        .featured-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .card-image {
            position: relative;
            height: 240px;
            overflow: hidden;
        }
        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }
        .featured-card:hover .card-image img { transform: scale(1.05); }
        .card-badges {
            position: absolute;
            top: 16px;
            left: 16px;
            right: 16px;
            display: flex;
            justify-content: space-between;
        }
        .badge {
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .badge-featured {
            background: var(--primary);
            color: white;
        }
        .badge-category {
            background: white;
            color: var(--primary);
        }
        .card-content {
            padding: 28px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }
        .card-title {
            font-size: 1.35rem;
            font-weight: 700;
            margin-bottom: 12px;
            line-height: 1.3;
            letter-spacing: -0.01em;
            color: var(--foreground);
            transition: color 0.2s;
        }
        .featured-card:hover .card-title { color: var(--primary); }
        .card-excerpt {
            color: var(--muted);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 20px;
            flex: 1;
        }
        .card-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 16px;
            border-top: 1px solid var(--border);
        }
        .card-author {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--muted);
            font-size: 0.9rem;
        }
        .card-date {
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--muted);
            font-size: 0.9rem;
        }
        .card-arrow {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--primary-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            transition: all 0.2s;
        }
        .featured-card:hover .card-arrow {
            background: var(--primary);
            color: white;
        }

        /* Articles Grid */
        .articles-section {
            padding: 60px 0 80px;
            background: var(--muted-bg);
        }
        .articles-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 32px;
        }
        .article-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--border);
            transition: all 0.3s;
        }
        .article-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 32px rgba(0,0,0,0.08);
        }
        .article-card .card-image { height: 200px; }
        .article-card .card-badges { justify-content: flex-end; }
        .article-card .card-content { padding: 24px; }
        .article-card .card-title {
            font-size: 1.15rem;
            margin-bottom: 10px;
        }
        .article-card:hover .card-title { color: var(--primary); }
        .article-card .card-excerpt {
            font-size: 0.9rem;
            margin-bottom: 16px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Load More */
        .load-more-wrapper {
            text-align: center;
            margin-top: 48px;
        }
        .btn-load-more {
            padding: 14px 32px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            border: 2px solid var(--primary);
            background: white;
            color: var(--primary);
            transition: all 0.2s;
        }
        .btn-load-more:hover {
            background: var(--primary);
            color: white;
        }

        /* Newsletter */
        .newsletter-section {
            padding: 100px 0;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 50%, #c084fc 100%);
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .newsletter-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 70%, rgba(255,255,255,0.1) 0%, transparent 50%);
        }
        .newsletter-section .container { position: relative; z-index: 1; }
        .newsletter-icon {
            width: 72px;
            height: 72px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
        }
        .newsletter-title {
            font-size: 2.25rem;
            font-weight: 700;
            margin-bottom: 16px;
            letter-spacing: -0.02em;
        }
        .newsletter-description {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto 40px;
        }
        .newsletter-form {
            display: flex;
            gap: 12px;
            max-width: 500px;
            margin: 0 auto;
            justify-content: center;
        }
        .newsletter-form input {
            flex: 1;
            padding: 16px 24px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50px;
            background: rgba(255,255,255,0.1);
            font-size: 1rem;
            color: white;
            outline: none;
            min-width: 280px;
        }
        .newsletter-form input::placeholder { color: rgba(255,255,255,0.7); }
        .newsletter-form input:focus { border-color: rgba(255,255,255,0.5); background: rgba(255,255,255,0.15); }
        .btn-subscribe {
            padding: 16px 32px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            border: none;
            background: white;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }
        .btn-subscribe:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        /* Footer */
      .footer { background: #1a1a2e; padding: 80px 0 32px; color: white; }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr 1fr; gap: 48px; margin-bottom: 48px; }
        .footer-brand .logo { margin-bottom: 16px; }
        .footer-brand .logo-icon { background: var(--primary); }
        .footer-brand p { color: rgba(255,255,255,0.6); font-size: 0.9rem; max-width: 280px; line-height: 1.7; margin-bottom: 20px; }
        .footer-social { display: flex; gap: 12px; }
        .footer-social a {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,0.7);
            transition: all 0.2s;
        }
        .footer-social a:hover { background: var(--primary); color: white; }
        .footer-column h4 { font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: rgba(255,255,255,0.5); margin-bottom: 20px; }
        .footer-column ul { list-style: none; }
        .footer-column ul li { margin-bottom: 12px; }
        .footer-column ul a { color: rgba(255,255,255,0.7); font-size: 0.9rem; transition: color 0.2s; }
        .footer-column ul a:hover { color: white; }
        .footer-bottom { padding-top: 32px; border-top: 1px solid rgba(255,255,255,0.1); display: flex; justify-content: space-between; align-items: center; }
        .footer-bottom p { color: rgba(255,255,255,0.5); font-size: 0.85rem; }
        .footer-bottom-links { display: flex; gap: 24px; }
        .footer-bottom-links a { color: rgba(255,255,255,0.5); font-size: 0.85rem; }
        .footer-bottom-links a:hover { color: white; }

        /* No Results */
        .no-results {
            text-align: center;
            padding: 80px 24px;
            color: var(--muted);
        }
        .no-results svg { margin-bottom: 16px; opacity: 0.5; }
        .no-results h3 { font-size: 1.25rem; margin-bottom: 8px; color: var(--foreground); }

        /* Mobile Menu */
        .mobile-menu-btn { display: none; background: none; border: none; cursor: pointer; padding: 8px; }

        /* Responsive */
        @media (max-width: 1024px) {
            .featured-grid { grid-template-columns: 1fr; }
            .articles-grid { grid-template-columns: repeat(2, 1fr); }
            .footer-grid { grid-template-columns: repeat(2, 1fr); gap: 32px; }
        }
        @media (max-width: 768px) {
            .nav-links, .nav-actions { display: none; }
            .mobile-menu-btn { display: block; }
            .blog-hero { padding: 120px 0 60px; }
            .blog-hero-title { font-size: 2rem; }
            .category-filters .container { justify-content: flex-start; overflow-x: auto; flex-wrap: nowrap; padding-bottom: 12px; }
            .category-btn { white-space: nowrap; }
            .articles-grid { grid-template-columns: 1fr; }
            .newsletter-form { flex-direction: column; }
            .newsletter-form input { min-width: auto; }
            .footer-grid { grid-template-columns: 1fr; }
            .footer-bottom { flex-direction: column; gap: 16px; text-align: center; }
        }

        /* Hide articles that don't match filter */
        .article-card.hidden, .featured-card.hidden { display: none; }
    </style>
</head>
<body>
    <!-- Navbar -->
    @include('layouts.navbar')
    <!-- Blog Hero -->
    <section class="blog-hero">
        <div class="container">
            <div class="blog-hero-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
            </div>
            <h1 class="blog-hero-title">Tracklet Blog</h1>
            <p class="blog-hero-description">Insights, tips, and best practices for asset and inventory management in modern workplaces. Stay ahead with industry trends, product updates, and expert advice.</p>
            <div class="search-box">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                <input type="text" id="searchInput" placeholder="Search articles...">
            </div>
        </div>
    </section>

    <!-- Category Filters -->
    <section class="category-filters">
        <div class="container">
            <button class="category-btn active" data-category="all">All Posts</button>
            <button class="category-btn" data-category="asset-management">Asset Management</button>
            <button class="category-btn" data-category="inventory-tips">Inventory Tips</button>
            <button class="category-btn" data-category="office-productivity">Office Productivity</button>
            <button class="category-btn" data-category="software-updates">Software Updates</button>
            <button class="category-btn" data-category="case-studies">Case Studies</button>
            <button class="category-btn" data-category="company-news">Company News</button>
        </div>
    </section>

    <!-- Featured Articles -->
    <section class="featured-section">
        <div class="container">
            <div class="section-header">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>
                <h2 class="section-title">Featured Articles</h2>
            </div>
            <div class="featured-grid" id="featuredGrid">
                <!-- Featured Card 1 -->
                <article class="featured-card" data-category="asset-management" data-featured="true">
                    <div class="card-image">
                        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?w=800&h=500&fit=crop" alt="Modern office space">
                        <div class="card-badges">
                            <span class="badge badge-featured">Featured</span>
                            <span class="badge badge-category">Asset Management</span>
                        </div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">The Complete Guide to Modern Asset Management in 2025</h3>
                        <p class="card-excerpt">Learn how leading organizations are transforming their asset tracking with technology. Discover best practices, common pitfalls to avoid, and proven strategies for success.</p>
                        <div class="card-meta">
                            <div style="display: flex; align-items: center; gap: 16px;">
                                <span class="card-author">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    Sarah Chen
                                </span>
                                <span class="card-date">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    Nov 25, 2025
                                </span>
                            </div>
                            <div class="card-arrow">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Featured Card 2 -->
                <article class="featured-card" data-category="case-studies" data-featured="true">
                    <div class="card-image">
                        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&h=500&fit=crop" alt="Coworking space">
                        <div class="card-badges">
                            <span class="badge badge-featured">Featured</span>
                            <span class="badge badge-category">Case Studies</span>
                        </div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">How Coworking Spaces Are Revolutionizing Asset Tracking</h3>
                        <p class="card-excerpt">Case study: How flexible workspaces are using Tracklet to manage shared resources and maintain accountability across hundreds of members.</p>
                        <div class="card-meta">
                            <div style="display: flex; align-items: center; gap: 16px;">
                                <span class="card-author">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    David Kim
                                </span>
                                <span class="card-date">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    Nov 18, 2025
                                </span>
                            </div>
                            <div class="card-arrow">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- All Articles -->
    <section class="articles-section">
        <div class="container">
            <div class="articles-grid" id="articlesGrid">
                <!-- Article 1 -->
                <article class="article-card" data-category="inventory-tips">
                    <div class="card-image">
                        <img src="https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=600&h=400&fit=crop" alt="Inventory management">
                        <div class="card-badges">
                            <span class="badge badge-category">Inventory Tips</span>
                        </div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">5 Inventory Management Mistakes That Cost Companies Millions</h3>
                        <p class="card-excerpt">Avoid these common inventory management pitfalls that lead to unnecessary expenses and operational inefficiencies in your organization.</p>
                        <div class="card-meta">
                            <div style="display: flex; align-items: center; gap: 16px;">
                                <span class="card-author">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    Michael Rodriguez
                                </span>
                                <span class="card-date">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    Nov 22, 2025
                                </span>
                            </div>
                            <div class="card-arrow">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Article 2 -->
                <article class="article-card" data-category="office-productivity">
                    <div class="card-image">
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=600&h=400&fit=crop" alt="Office productivity">
                        <div class="card-badges">
                            <span class="badge badge-category">Office Productivity</span>
                        </div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Boosting Office Productivity Through Better Resource Management</h3>
                        <p class="card-excerpt">Discover how optimizing your asset allocation can improve team efficiency and create a more productive work environment for everyone.</p>
                        <div class="card-meta">
                            <div style="display: flex; align-items: center; gap: 16px;">
                                <span class="card-author">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    Emma Thompson
                                </span>
                                <span class="card-date">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    Nov 20, 2025
                                </span>
                            </div>
                            <div class="card-arrow">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Article 3 -->
                <article class="article-card" data-category="software-updates">
                    <div class="card-image">
                        <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=600&h=400&fit=crop" alt="Software update">
                        <div class="card-badges">
                            <span class="badge badge-category">Software Updates</span>
                        </div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">What's New in Tracklet: November 2025 Product Updates</h3>
                        <p class="card-excerpt">Explore the latest features and improvements we've added to make your asset management experience even better, including AI-powered insights.</p>
                        <div class="card-meta">
                            <div style="display: flex; align-items: center; gap: 16px;">
                                <span class="card-author">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    Product Team
                                </span>
                                <span class="card-date">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    Nov 15, 2025
                                </span>
                            </div>
                            <div class="card-arrow">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Article 4 -->
                <article class="article-card" data-category="company-news">
                    <div class="card-image">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=600&h=400&fit=crop" alt="Team meeting">
                        <div class="card-badges">
                            <span class="badge badge-category">Company News</span>
                        </div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Tracklet Raises $15M Series A to Expand Global Operations</h3>
                        <p class="card-excerpt">We're excited to announce our Series A funding round led by top-tier investors. Here's what this means for our customers and the future of Tracklet.</p>
                        <div class="card-meta">
                            <div style="display: flex; align-items: center; gap: 16px;">
                                <span class="card-author">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    Jessica Park
                                </span>
                                <span class="card-date">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    Nov 12, 2025
                                </span>
                            </div>
                            <div class="card-arrow">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Article 5 -->
                <article class="article-card" data-category="asset-management">
                    <div class="card-image">
                        <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?w=600&h=400&fit=crop" alt="Asset tracking">
                        <div class="card-badges">
                            <span class="badge badge-category">Asset Management</span>
                        </div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">RFID vs QR Codes: Which Asset Tracking Method is Right for You?</h3>
                        <p class="card-excerpt">A comprehensive comparison of the two most popular asset tracking technologies to help you make the best decision for your organization.</p>
                        <div class="card-meta">
                            <div style="display: flex; align-items: center; gap: 16px;">
                                <span class="card-author">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    Alex Turner
                                </span>
                                <span class="card-date">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    Nov 10, 2025
                                </span>
                            </div>
                            <div class="card-arrow">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Article 6 -->
                <article class="article-card" data-category="case-studies">
                    <div class="card-image">
                        <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=600&h=400&fit=crop" alt="Corporate building">
                        <div class="card-badges">
                            <span class="badge badge-category">Case Studies</span>
                        </div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">How TechCorp Reduced Asset Loss by 85% with Tracklet</h3>
                        <p class="card-excerpt">Learn how a Fortune 500 company transformed their asset management process and saved millions in equipment loss and theft prevention.</p>
                        <div class="card-meta">
                            <div style="display: flex; align-items: center; gap: 16px;">
                                <span class="card-author">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    Lisa Wang
                                </span>
                                <span class="card-date">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    Nov 8, 2025
                                </span>
                            </div>
                            <div class="card-arrow">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Article 7 -->
                <article class="article-card" data-category="inventory-tips">
                    <div class="card-image">
                        <img src="https://images.unsplash.com/photo-1553413077-190dd305871c?w=600&h=400&fit=crop" alt="Warehouse">
                        <div class="card-badges">
                            <span class="badge badge-category">Inventory Tips</span>
                        </div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Setting Up Automated Reorder Points: A Step-by-Step Guide</h3>
                        <p class="card-excerpt">Never run out of critical supplies again. Learn how to configure smart reorder points that keep your inventory levels optimized automatically.</p>
                        <div class="card-meta">
                            <div style="display: flex; align-items: center; gap: 16px;">
                                <span class="card-author">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    James Wilson
                                </span>
                                <span class="card-date">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    Nov 5, 2025
                                </span>
                            </div>
                            <div class="card-arrow">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Article 8 -->
                <article class="article-card" data-category="office-productivity">
                    <div class="card-image">
                        <img src="https://images.unsplash.com/photo-1524758631624-e2822e304c36?w=600&h=400&fit=crop" alt="Modern office">
                        <div class="card-badges">
                            <span class="badge badge-category">Office Productivity</span>
                        </div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">The Future of Hybrid Workplaces: Managing Assets Across Locations</h3>
                        <p class="card-excerpt">As hybrid work becomes the norm, organizations face new challenges in tracking assets across multiple locations. Here's how to adapt.</p>
                        <div class="card-meta">
                            <div style="display: flex; align-items: center; gap: 16px;">
                                <span class="card-author">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    Rachel Green
                                </span>
                                <span class="card-date">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    Nov 3, 2025
                                </span>
                            </div>
                            <div class="card-arrow">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Article 9 -->
                <article class="article-card" data-category="software-updates">
                    <div class="card-image">
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&h=400&fit=crop" alt="Dashboard analytics">
                        <div class="card-badges">
                            <span class="badge badge-category">Software Updates</span>
                        </div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Introducing Advanced Analytics: Data-Driven Asset Decisions</h3>
                        <p class="card-excerpt">Our new analytics dashboard helps you understand asset utilization patterns, predict maintenance needs, and optimize your resource allocation.</p>
                        <div class="card-meta">
                            <div style="display: flex; align-items: center; gap: 16px;">
                                <span class="card-author">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    Product Team
                                </span>
                                <span class="card-date">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    Nov 1, 2025
                                </span>
                            </div>
                            <div class="card-arrow">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <!-- No Results Message -->
            <div class="no-results" id="noResults" style="display: none;">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                <h3>No articles found</h3>
                <p>Try selecting a different category or adjusting your search.</p>
            </div>

            <!-- Load More -->
            <div class="load-more-wrapper" id="loadMoreWrapper">
                <button class="btn-load-more">Load More Articles</button>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            </div>
            <h2 class="newsletter-title">Stay Updated with Tracklet</h2>
            <p class="newsletter-description">Get the latest insights on asset management, productivity tips, and product updates delivered to your inbox.</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Enter your email" required>
                <button type="submit" class="btn-subscribe">
                    Subscribe
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                </button>
            </form>
        </div>
    </section>

@include('layouts.footer')

