<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tracklet - Asset management platform for organizations">
    <title>Tracklet - Say Goodbye to Administrative Chaos</title>
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

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--background);
            color: var(--foreground);
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 16px 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
        }

        .navbar .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 1.35rem;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: var(--primary);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .nav-links {
            display: flex;
            gap: 32px;
            list-style: none;
        }

        .nav-links a {
            color: var(--primary);
            font-weight: 500;
            font-size: 0.95rem;
        }

        .nav-links a:hover {
            opacity: 0.8;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: var(--radius);
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-secondary {
            background: white;
            color: var(--foreground);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .btn-white {
            background: white;
            color: var(--primary);
        }

        .btn-outline-white {
            background: transparent;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .btn-outline-white:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .btn-ghost {
            background: transparent;
            color: var(--muted);
        }

        /* Hero */
        .hero {
            padding: 140px 0 80px;
            background: var(--background);
        }

        .hero .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: var(--primary-bg);
            border-radius: 100px;
            font-size: 0.9rem;
            color: var(--primary);
            font-weight: 500;
            margin-bottom: 24px;
        }

        .hero-badge-dot {
            width: 8px;
            height: 8px;
            background: var(--success);
            border-radius: 50%;
            box-shadow: 0 0 8px rgba(34, 197, 94, 0.8), 0 0 16px rgba(34, 197, 94, 0.4);
            animation: pulse-glow 2s ease-in-out infinite;
        }

        @keyframes pulse-glow {
            0%, 100% {
                box-shadow: 0 0 8px rgba(34, 197, 94, 0.8), 0 0 16px rgba(34, 197, 94, 0.4);
            }
            50% {
                box-shadow: 0 0 12px rgba(34, 197, 94, 1), 0 0 24px rgba(34, 197, 94, 0.6);
            }
        }

        .hero-title {
            font-size: 3.25rem;
            font-weight: 700;
            line-height: 1.15;
            margin-bottom: 24px;
            letter-spacing: -0.02em;
        }

        .hero-title .highlight {
            color: var(--primary);
        }

        .hero-description {
            font-size: 1.1rem;
            color: var(--muted);
            margin-bottom: 32px;
            line-height: 1.7;
        }

        .hero-actions {
            display: flex;
            gap: 16px;
            margin-bottom: 32px;
        }

        .hero-trust {
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
        }

        .hero-trust-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            color: var(--muted);
        }

        .hero-trust-item svg {
            color: var(--success);
        }

        /* Hero Visual */
        .hero-visual {
            position: relative;
        }

        .hero-browser {
            background: white;
            border-radius: 16px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            border: 1px solid var(--border);
        }

        .browser-header {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 16px;
            background: #f8f9fa;
            border-bottom: 1px solid var(--border);
        }

        .browser-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .browser-dot.red {
            background: #ef4444;
        }

        .browser-dot.yellow {
            background: #f59e0b;
        }

        .browser-dot.green {
            background: #22c55e;
        }

        .browser-url {
            flex: 1;
            margin-left: 12px;
            padding: 6px 12px;
            background: white;
            border-radius: 6px;
            font-size: 0.8rem;
            color: var(--muted);
            border: 1px solid var(--border);
        }

        .browser-content {
            height: 320px;
            background: linear-gradient(135deg, #1a1a2e 0%, #2d2d44 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .browser-content img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .floating-card {
            position: absolute;
            background: white;
            border-radius: 12px;
            padding: 16px 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
            border: 1px solid var(--border);
            opacity: 0;
            transform: translateY(20px);
        }

        .floating-card-1 {
            top: 80px;
            left: -40px;
            animation: floatCard1 0.8s ease 0.8s forwards, floatBounce 4s ease-in-out 1.6s infinite;
        }

        .floating-card-2 {
            bottom: 100px;
            right: -30px;
            animation: floatCard2 0.8s ease 1.2s forwards, floatBounce 4s ease-in-out 2s infinite;
        }

        .floating-label {
            font-size: 0.75rem;
            color: var(--muted);
            margin-bottom: 4px;
        }

        .floating-value {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .floating-change {
            font-size: 0.8rem;
            color: var(--success);
            margin-top: 4px;
        }

        @keyframes floatCard1 {
            from {
                opacity: 0;
                transform: translateX(-30px) translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0) translateY(0);
            }
        }

        @keyframes floatCard2 {
            from {
                opacity: 0;
                transform: translateX(30px) translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0) translateY(0);
            }
        }

        @keyframes floatBounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        /* Stats */
        .stats {
            padding: 60px 0;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
            text-align: center;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 0.95rem;
            color: var(--muted);
        }

        /* Section Styles */
        .section {
            padding: 100px 0;
        }

        .section-light {
            background: var(--muted-bg);
        }

        .section-how-it-works {
            background: var(--primary-bg)
        }

        .section-header {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 60px;
        }

        .section-tag {
            display: inline-block;
            padding: 8px 20px;
            background: var(--primary-bg);
            border-radius: 100px;
            font-size: 0.9rem;
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 16px;
            letter-spacing: -0.02em;
        }

        .section-description {
            font-size: 1.1rem;
            color: var(--muted);
            line-height: 1.7;
        }

        /* Features */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        .feature-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 28px;
            transition: all 0.2s;
        }

        .feature-card:hover {
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            transform: translateY(-4px);
        }

        .feature-icon {
            width: 52px;
            height: 52px;
            background: var(--primary-bg);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .feature-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .feature-description {
            font-size: 0.9rem;
            color: var(--muted);
            line-height: 1.6;
        }

        /* Mid CTA */
        .mid-cta {
            padding: 60px 0;
            text-align: center;
        }

        .mid-cta-text {
            font-size: 1.1rem;
            color: var(--muted);
            margin-bottom: 20px;
        }

        /* How It Works */
        .steps-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            position: relative;
            padding-top: 20px;
        }

        .steps-connector {
            position: absolute;
            top: 50%;
            left: 60px;
            right: 60px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--primary-light), var(--primary));
            border-radius: 2px;
            z-index: 0;
        }

        .step-card {
            background: white;
            border: 1px solid rgba(147, 51, 234, 0.15);
            border-radius: var(--radius);
            padding: 28px;
            position: relative;
            z-index: 1;
        }

        .step-number {
            position: absolute;
            top: -20px;
            right: -20px;
            width: 44px;
            height: 44px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
            z-index: 2;
            box-shadow: 0 4px 12px rgba(147, 51, 234, 0.3);
        }

        .step-icon {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, #faf5ff 0%, #fdf4ff 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            margin-bottom: 20px;
            border: 1px solid rgba(147, 51, 234, 0.1);
        }

        .step-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .step-description {
            font-size: 0.9rem;
            color: var(--muted);
            line-height: 1.6;
        }

        /* CTA Banner */
        .cta-banner {
            background: linear-gradient(135deg, var(--primary) 0%, #a855f7 100%);
            padding: 80px 0;
            text-align: center;
            border-radius: 24px;
            margin: 0 24px;
        }

        .cta-banner-title {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            margin-bottom: 16px;
        }

        .cta-banner-text {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 32px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Benefits */
        .benefits-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .benefits-image {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        .benefits-image img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            background: #ddd;
        }

        .benefit-item {
            display: flex;
            gap: 16px;
            margin-bottom: 28px;
        }

        .benefit-icon {
            width: 48px;
            height: 48px;
            background: var(--primary-bg);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            flex-shrink: 0;
        }

        .benefit-title {
            font-size: 1.05rem;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .benefit-description {
            font-size: 0.9rem;
            color: var(--muted);
            line-height: 1.6;
        }

        /* Comparison */
        .comparison-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
            max-width: 900px;
            margin: 0 auto;
        }

        .comparison-card {
            background: white;
            border-radius: var(--radius);
            padding: 32px;
        }

        .comparison-card.excel {
            border: 2px solid rgba(239, 68, 68, 0.2);
        }

        .comparison-card.tracklet {
            border: 2px solid rgba(147, 51, 234, 0.2);
        }

        .comparison-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .comparison-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .comparison-icon.red {
            background: rgba(239, 68, 68, 0.1);
            color: var(--error);
        }

        .comparison-icon.green {
            background: var(--primary-bg);
            color: var(--primary);
        }

        .comparison-title {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .comparison-list {
            list-style: none;
        }

        .comparison-list li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 0;
            font-size: 0.95rem;
            color: var(--muted);
        }

        .comparison-list li::before {
            content: '•';
            font-weight: bold;
        }

        .comparison-card.excel .comparison-list li::before {
            color: var(--error);
        }

        .comparison-card.tracklet .comparison-list li::before {
            color: var(--primary);
        }

        /* Testimonials */
        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }

        .testimonial-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 32px;
        }

        .testimonial-quote {
            color: var(--primary);
            font-size: 2.5rem;
            margin-bottom: 16px;
            opacity: 0.3;
        }

        .testimonial-stars {
            display: flex;
            gap: 4px;
            margin-bottom: 16px;
        }

        .testimonial-stars svg {
            width: 20px;
            height: 20px;
            fill: #fbbf24;
        }

        .testimonial-content {
            font-size: 1rem;
            color: var(--muted);
            line-height: 1.7;
            margin-bottom: 24px;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .testimonial-avatar {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: #ddd;
            overflow: hidden;
        }

        .testimonial-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .testimonial-name {
            font-weight: 600;
            font-size: 1rem;
        }

        .testimonial-role {
            font-size: 0.85rem;
            color: var(--muted);
        }

        /* Pricing */
        .pricing-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px;
            max-width: 500px;
            margin: 0 auto;
        }

        .pricing-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 40px 32px;
            position: relative;
        }

        .pricing-card.featured {
            background: linear-gradient(135deg, var(--primary) 0%, #a855f7 100%);
            color: white;
            transform: scale(1.05);
        }

        .pricing-badge {
            position: absolute;
            top: -14px;
            left: 50%;
            transform: translateX(-50%);
            background: #fbbf24;
            color: #1a1a2e;
            padding: 6px 16px;
            border-radius: 100px;
            font-size: 0.8rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .pricing-name {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .pricing-description {
            font-size: 0.9rem;
            opacity: 0.8;
            margin-bottom: 24px;
        }

        .pricing-price {
            margin-bottom: 24px;
        }

        .pricing-amount {
            font-size: 3rem;
            font-weight: 800;
        }

        .pricing-period {
            font-size: 1rem;
            opacity: 0.7;
        }

        .pricing-card.featured .btn-primary {
            background: white;
            color: var(--primary);
        }

        .pricing-card:not(.featured) .pricing-description {
            color: var(--muted);
        }

        .pricing-features {
            list-style: none;
            margin-top: 24px;
        }

        .pricing-features li {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 0;
            font-size: 0.95rem;
        }

        .pricing-features li svg {
            color: var(--success);
            flex-shrink: 0;
        }

        .pricing-card.featured .pricing-features li svg {
            color: rgba(255, 255, 255, 0.9);
        }

        .pricing-card:not(.featured) .pricing-features li {
            color: var(--muted);
        }

        /* New Pricing Design */
        .pricing-wrapper {
            max-width: 600px;
            margin: 0 auto;
        }

        .pricing-banner {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border-radius: 20px 20px 0 0;
            padding: 48px 40px 40px;
            position: relative;
            overflow: hidden;
        }

        .pricing-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .pricing-trial-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: var(--success);
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            z-index: 1;
        }

        .pricing-banner-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }

        .pricing-banner-subtitle {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.9);
            position: relative;
            z-index: 1;
        }

        .pricing-card-new {
            background: white;
            border: 1px solid var(--border);
            border-radius: 0 0 20px 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }

        .pricing-display {
            text-align: center;
            margin-bottom: 24px;
            padding-bottom: 24px;
            border-bottom: 1px solid var(--border);
        }

        .pricing-main {
            display: flex;
            align-items: baseline;
            justify-content: center;
            gap: 8px;
            margin-bottom: 12px;
        }

        .pricing-amount-new {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--primary);
        }

        .pricing-period-new {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary);
        }

        .pricing-annual {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .pricing-annual-amount {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--success);
        }

        .pricing-annual-text {
            font-size: 0.85rem;
            color: var(--muted);
        }

        .pricing-trial-info {
            text-align: center;
            margin-bottom: 32px;
        }

        .pricing-free-badge {
            display: inline-block;
            background: var(--success);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .pricing-then-text {
            display: block;
            font-size: 0.85rem;
            color: var(--muted);
            margin-top: 8px;
        }

        .pricing-features-section {
            margin-bottom: 32px;
        }

        .pricing-features-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--foreground);
            margin-bottom: 20px;
        }

        .pricing-features-title svg {
            color: var(--success);
        }

        .pricing-features-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .pricing-features-column {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .pricing-feature-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
            color: var(--foreground);
        }

        .pricing-feature-item svg {
            color: var(--success);
            flex-shrink: 0;
        }

        .pricing-trial-details {
            background: var(--primary-bg);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 32px;
        }

        .trial-detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid rgba(147, 51, 234, 0.1);
        }

        .trial-detail-row:last-child {
            border-bottom: none;
        }

        .trial-detail-label {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            color: var(--foreground);
        }

        .trial-detail-label svg {
            color: var(--primary);
        }

        .trial-detail-value {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--primary);
        }

        .trial-detail-value.trial-cost {
            color: var(--success);
        }

        .trial-detail-value.trial-renewal {
            color: #3b82f6;
        }

        .pricing-cta-btn {
            width: 100%;
            padding: 16px;
            font-size: 1.05rem;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .pricing-banner {
                padding: 40px 24px 32px;
            }

            .pricing-banner-title {
                font-size: 2rem;
            }

            .pricing-card-new {
                padding: 32px 24px;
            }

            .pricing-features-grid {
                grid-template-columns: 1fr;
            }

            .pricing-amount-new {
                font-size: 2.5rem;
            }
        }

        /* Final CTA */
        .final-cta {
            background: linear-gradient(135deg, var(--primary) 0%, #a855f7 100%);
        }

        .final-cta .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .final-cta-content {
            color: white;
            padding: 80px 0;
        }

        .final-cta-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 24px;
            line-height: 1.2;
        }

        .final-cta-text {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 32px;
            line-height: 1.7;
        }

        .final-cta-list {
            list-style: none;
            margin-bottom: 32px;
        }

        .final-cta-list li {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 0;
            font-size: 1rem;
        }

        .final-cta-list li svg {
            color: rgba(255, 255, 255, 0.9);
        }

        .final-cta-actions {
            display: flex;
            gap: 16px;
        }

        .final-cta-image {
            height: 100%;
            min-height: 500px;
        }

        .final-cta-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Footer */
        .footer { background: #1a1a2e; padding: 80px 0 32px; color: white; }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr 1fr; gap: 48px; margin-bottom: 48px; }
        .footer-brand .logo { margin-bottom: 16px; }
        .footer-brand .logo-icon { background: var(--primary); }
        .footer-brand p { color: rgba(255,255,255,0.6); font-size: 0.9rem; max-width: 280px; line-height: 1.7; margin-bottom: 20px; }
        .social-links {
            display: flex;
            gap: 12px;
        }
        .social-link {
            width: 48px;
            height: 48px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,0.7);
            transition: all 0.2s;
        }
        .social-link:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }
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

        /* Scroll Animations */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .animate-on-scroll.animated {
            opacity: 1;
            transform: translateY(0);
        }

        .animate-on-scroll.delay-1 {
            transition-delay: 0.1s;
        }

        .animate-on-scroll.delay-2 {
            transition-delay: 0.2s;
        }

        .animate-on-scroll.delay-3 {
            transition-delay: 0.3s;
        }

        .animate-on-scroll.delay-4 {
            transition-delay: 0.4s;
        }

        .animate-on-scroll.delay-5 {
            transition-delay: 0.5s;
        }

        .animate-on-scroll.delay-6 {
            transition-delay: 0.6s;
        }

        .animate-on-scroll.delay-7 {
            transition-delay: 0.7s;
        }

        .animate-on-scroll.delay-8 {
            transition-delay: 0.8s;
        }

        .animate-fade-up {
            transform: translateY(40px);
        }

        .animate-fade-left {
            transform: translateX(-40px);
        }

        .animate-fade-right {
            transform: translateX(40px);
        }

        .animate-scale {
            transform: scale(0.9);
        }

        .animate-on-scroll.animated.animate-fade-left,
        .animate-on-scroll.animated.animate-fade-right,
        .animate-on-scroll.animated.animate-scale {
            transform: translateX(0) translateY(0) scale(1);
        }

        /* Hero animations */
        .hero-badge {
            animation: fadeInUp 0.6s ease forwards;
        }

        .hero-title {
            animation: fadeInUp 0.6s ease 0.1s forwards;
            opacity: 0;
        }

        .hero-description {
            animation: fadeInUp 0.6s ease 0.2s forwards;
            opacity: 0;
        }

        .hero-actions {
            animation: fadeInUp 0.6s ease 0.3s forwards;
            opacity: 0;
        }

        .hero-trust {
            animation: fadeInUp 0.6s ease 0.4s forwards;
            opacity: 0;
        }

        .hero-browser {
            animation: fadeInUp 0.8s ease 0.3s forwards;
            opacity: 0;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Counter animation */
        .stat-value {
            display: inline-block;
        }

        /* Mobile */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
        }

        @media (max-width: 1024px) {

            .hero .container,
            .benefits-grid,
            .final-cta .container {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .hero-actions,
            .hero-trust {
                justify-content: center;
            }

            .features-grid,
            .steps-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .steps-connector {
                display: none;
            }

            .steps-grid {
                padding-top: 30px;
            }

            .pricing-grid {
                grid-template-columns: 1fr;
                max-width: 400px;
            }

            .pricing-card.featured {
                transform: none;
            }

            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {

            .nav-links,
            .nav-actions {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .hero-title {
                font-size: 2.25rem;
            }

            .features-grid,
            .steps-grid,
            .comparison-grid,
            .testimonials-grid {
                grid-template-columns: 1fr;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }

            .footer-bottom {
                flex-direction: column;
                gap: 16px;
                text-align: center;
            }

            .final-cta-actions {
                flex-direction: column;
            }

            .final-cta-image {
                display: none;
            }

            .cta-banner {
                margin: 0;
                border-radius: 0;
            }
        }

        /* Contact Cards */
        .contact-cards {
            padding: 60px 0;
        }

        .contact-cards-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        .contact-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 28px;
            transition: all 0.2s;
        }

        .contact-card:hover {
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .contact-card-icon {
            width: 52px;
            height: 52px;
            background: var(--primary-bg);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .contact-card h3 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .contact-card p {
            font-size: 0.9rem;
            color: var(--muted);
            line-height: 1.6;
        }

        /* Form & Info Section */
        .contact-section {
            padding: 60px 0 100px;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
        }

        /* Form */
        .contact-form-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 40px;
        }

        .contact-form-card h2 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .contact-form-card>p {
            color: var(--muted);
            margin-bottom: 32px;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--foreground);
        }

        .form-label .required {
            color: var(--primary);
        }

        .form-label .optional {
            color: var(--muted);
            font-weight: 400;
        }

        .form-input,
        .form-textarea,
        .form-select {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            font-size: 0.95rem;
            font-family: inherit;
            transition: all 0.2s;
            background: white;
        }

        .form-input:focus,
        .form-textarea:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-bg);
        }

        .form-input::placeholder,
        .form-textarea::placeholder {
            color: #a0a0a0;
        }

        .form-textarea {
            min-height: 140px;
            resize: vertical;
        }

        .form-select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23717182' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 20px;
        }

        .form-submit {
            width: 100%;
            padding: 16px;
            font-size: 1rem;
            margin-top: 8px;
        }

        .form-note {
            text-align: center;
            color: var(--muted);
            font-size: 0.85rem;
            margin-top: 16px;
        }

        /* Contact Info */
        .contact-info h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 24px;
        }

        .info-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 24px;
            display: flex;
            gap: 16px;
            align-items: flex-start;
            margin-bottom: 16px;
            transition: all 0.2s;
        }

        .info-card:hover {
            border-color: var(--primary);
        }

        .info-card-icon {
            width: 48px;
            height: 48px;
            background: var(--primary-bg);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            flex-shrink: 0;
        }

        .info-card h4 {
            font-size: 0.85rem;
            color: var(--muted);
            font-weight: 500;
            margin-bottom: 4px;
        }

        .info-card a {
            color: var(--primary);
            font-weight: 600;
            font-size: 1rem;
        }

        .info-card p {
            color: var(--muted);
            font-size: 0.85rem;
            margin-top: 4px;
        }

        /* Business Hours */
        .hours-card {
            background: var(--muted-bg);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 24px;
            margin-bottom: 16px;
        }

        .hours-card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .hours-card-icon {
            width: 40px;
            height: 40px;
            background: var(--primary-bg);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
        }

        .hours-card h3 {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .hours-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid var(--border);
            font-size: 0.9rem;
        }

        .hours-row:last-child {
            border-bottom: none;
        }

        .hours-row span:first-child {
            color: var(--muted);
        }

        .hours-row span:last-child {
            font-weight: 500;
        }

        /* Live Chat Card */
        .chat-card {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border-radius: var(--radius);
            padding: 28px;
            color: white;
            margin-bottom: 16px;
        }

        .chat-card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .chat-card-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chat-card h3 {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .chat-card p {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-bottom: 20px;
        }

        .chat-card .btn {
            background: white;
            color: var(--primary);
            width: 100%;
        }

        /* Social Links */
        .social-section {
            margin-top: 32px;
        }

        .social-section h3 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .social-links {
            display: flex;
            gap: 12px;
        }

        .social-link {
            width: 48px;
            height: 48px;
            background: rgba(255,255,255,0.1);
            border: 1px solid var(--border);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--muted);
            transition: all 0.2s;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .social-link:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Support Image */
        .support-image {
            margin-top: 24px;
            border-radius: var(--radius);
            overflow: hidden;
        }

        .support-image img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        /* FAQ Section */
        .faq-section {
            padding: 100px 0;
            background: var(--muted-bg);
        }

        .faq-section .section-tag {
            display: inline-block;
            padding: 8px 20px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 100px;
            font-size: 0.9rem;
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 20px;
        }

        .faq-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .faq-header h2 {
            font-size: 2.25rem;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .faq-header p {
            color: var(--muted);
            font-size: 1.05rem;
        }

        .faq-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 48px;
        }

        /* FAQ Accordion */
        .faq-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .faq-item {
            background: white;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
        }

        .faq-question {
            width: 100%;
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            text-align: left;
            font-family: inherit;
            color: var(--foreground);
            transition: all 0.2s;
        }

        .faq-question:hover {
            color: var(--primary);
        }

        .faq-question svg {
            flex-shrink: 0;
            transition: transform 0.3s;
            color: var(--primary);
        }

        .faq-item.active .faq-question svg {
            transform: rotate(180deg);
        }

        .faq-answer {
            padding: 0 24px 20px;
            color: var(--muted);
            font-size: 0.95rem;
            line-height: 1.7;
            display: none;
        }

        .faq-item.active .faq-answer {
            display: block;
        }

        /* Resources */
        .resources-sidebar h3 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .resource-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px;
            display: flex;
            gap: 16px;
            align-items: center;
            margin-bottom: 16px;
            transition: all 0.2s;
            cursor: pointer;
        }

        .resource-card:hover {
            border-color: var(--primary);
            transform: translateX(4px);
        }

        .resource-card-icon {
            width: 48px;
            height: 48px;
            background: var(--primary-bg);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            flex-shrink: 0;
        }

        .resource-card h4 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .resource-card p {
            font-size: 0.85rem;
            color: var(--muted);
        }

        /* Still Questions Card */
        .still-questions {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border-radius: var(--radius);
            padding: 28px;
            color: white;
            margin-top: 24px;
        }

        .still-questions h4 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .still-questions p {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-bottom: 20px;
        }

        .still-questions .btn {
            background: white;
            color: var(--primary);
            width: 100%;
        }
    </style>
</head>

<body>
@include('layouts.navbar')
