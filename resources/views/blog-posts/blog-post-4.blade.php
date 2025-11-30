@php
    $pageTitle = "When Finance and Admins Share the Same Dashboard | Tracklet Blog";
    $pageDescription = "See how shared visibility between finance and admin teams reduces back-and-forth, improves spend control, and streamlines reporting.";
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $pageDescription }}">
    <title>{{ $pageTitle }}</title>
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
        
        /* Navbar Styles */
        .navbar { position: fixed; top: 0; left: 0; right: 0; z-index: 1000; padding: 16px 0; background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); border-bottom: 1px solid var(--border); }
        .navbar .container { display: flex; align-items: center; justify-content: space-between; }
        .logo { display: flex; align-items: center; gap: 10px; font-weight: 700; font-size: 1.35rem; }
        .logo-img { height: auto; }
        .nav-links { display: flex; gap: 32px; list-style: none; }
        .nav-links a { color: var(--primary); font-weight: 500; font-size: 0.95rem; }
        .nav-links a:hover { opacity: 0.8; }
        .nav-actions { display: flex; align-items: center; gap: 16px; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 12px 24px; border-radius: var(--radius); font-weight: 600; font-size: 0.95rem; cursor: pointer; border: none; transition: all 0.2s; }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-ghost { background: transparent; color: var(--muted); }
        .mobile-menu-btn { display: none; background: none; border: none; cursor: pointer; padding: 8px; }

        /* Blog Post Page Specific Styles */
        .blog-post-hero {
            padding: 140px 0 80px;
            background: linear-gradient(180deg, var(--primary-bg) 0%, var(--background) 100%);
        }

        .blog-post-hero .container {
            max-width: 900px;
        }

        .blog-post-meta {
            display: flex;
            align-items: center;
            gap: 24px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .blog-post-meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--muted);
            font-size: 0.9rem;
        }

        .blog-post-meta-item svg {
            width: 18px;
            height: 18px;
        }

        .blog-post-title {
            font-size: 3rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 24px;
            color: var(--foreground);
        }

        .blog-post-excerpt {
            font-size: 1.25rem;
            color: var(--muted);
            line-height: 1.7;
            margin-bottom: 32px;
        }

        .blog-post-content {
            padding: 60px 0 100px;
        }

        .blog-post-wrapper {
            max-width: 800px;
            margin: 0 auto;
        }

        .blog-post-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: var(--radius);
            margin-bottom: 48px;
        }

        .blog-post-body {
            font-size: 1.1rem;
            line-height: 1.9;
            color: var(--foreground);
        }

        .blog-post-body h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-top: 48px;
            margin-bottom: 24px;
            color: var(--foreground);
        }

        .blog-post-body h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-top: 36px;
            margin-bottom: 16px;
            color: var(--foreground);
        }

        .blog-post-body h4 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-top: 28px;
            margin-bottom: 12px;
            color: var(--foreground);
        }

        .blog-post-body p {
            margin-bottom: 24px;
            color: var(--muted);
        }

        .blog-post-body ul, .blog-post-body ol {
            margin-left: 24px;
            margin-bottom: 24px;
            color: var(--muted);
        }

        .blog-post-body li {
            margin-bottom: 12px;
        }

        .blog-post-body strong {
            color: var(--foreground);
            font-weight: 600;
        }

        .blog-post-body table {
            width: 100%;
            border-collapse: collapse;
            margin: 32px 0;
            background: white;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .blog-post-body table th {
            background: var(--muted-bg);
            padding: 16px;
            text-align: left;
            font-weight: 600;
            color: var(--foreground);
            border-bottom: 2px solid var(--border);
        }

        .blog-post-body table td {
            padding: 16px;
            border-bottom: 1px solid var(--border);
            color: var(--muted);
        }

        .blog-post-body table tr:last-child td {
            border-bottom: none;
        }

        .blog-post-body table tr:hover {
            background: var(--muted-bg);
        }

        .blog-post-cta {
            background: var(--primary-bg);
            border-radius: var(--radius);
            padding: 40px;
            margin: 48px 0;
            text-align: center;
        }

        .blog-post-cta h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 16px;
            color: var(--foreground);
        }

        .blog-post-cta p {
            color: var(--muted);
            margin-bottom: 24px;
            font-size: 1rem;
        }

        .faq-section {
            margin-top: 60px;
            padding-top: 48px;
            border-top: 2px solid var(--border);
        }

        .faq-section h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 32px;
            color: var(--foreground);
        }

        .faq-item {
            margin-bottom: 32px;
        }

        .faq-question {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--foreground);
            margin-bottom: 12px;
        }

        .faq-answer {
            color: var(--muted);
            line-height: 1.8;
        }

        .story-box {
            background: var(--muted-bg);
            border-left: 4px solid var(--primary);
            padding: 24px;
            margin: 32px 0;
            border-radius: var(--radius);
        }

        .story-box p {
            margin-bottom: 12px;
        }

        .story-box p:last-child {
            margin-bottom: 0;
        }

        .story-box ul {
            margin-top: 12px;
        }

        @media (max-width: 768px) {
            .blog-post-title {
                font-size: 2rem;
            }

            .blog-post-excerpt {
                font-size: 1.1rem;
            }

            .blog-post-body {
                font-size: 1rem;
            }

            .blog-post-body h2 {
                font-size: 1.75rem;
            }

            .blog-post-body h3 {
                font-size: 1.25rem;
            }

            .blog-post-body table {
                font-size: 0.9rem;
            }

            .blog-post-body table th,
            .blog-post-body table td {
                padding: 12px;
            }
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
    </style>
</head>
<body>
    @include('layouts.navbar')

    <!-- Blog Post Hero -->
    <section class="blog-post-hero">
        <div class="container">
            <div class="blog-post-meta">
                <div class="blog-post-meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                    <span>Tracklet Team</span>
                </div>
                <div class="blog-post-meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                    <span>{{ date('F d, Y') }}</span>
                </div>
                <div class="blog-post-meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                    <span>8 min read</span>
                </div>
            </div>
            <h1 class="blog-post-title">When Finance and Admins Share the Same Dashboard</h1>
            <p class="blog-post-excerpt">See how shared visibility between finance and admin teams reduces back-and-forth, improves spend control, and streamlines reporting.</p>
        </div>
    </section>

    <!-- Blog Post Content -->
    <section class="blog-post-content">
        <div class="container">
            <div class="blog-post-wrapper">
                <img src="{{ asset('4.png') }}" alt="Finance and admin collaboration" class="blog-post-image">

                <div class="blog-post-body">
                    <h2>Introduction</h2>

                    <p>Finance and admin teams work side by side, but most of the time they operate with different tools, different reports, and different versions of the same truth. This creates delays, confusion, and constant back-and-forth. Small gaps become bigger problems as a company grows.</p>

                    <p>When both teams share one dashboard, everything changes. Spend becomes clearer. Approvals move faster. Stock levels make more sense. Asset ownership stays clean. And reporting becomes simple instead of stressful.</p>

                    <p>This blog explains why shared visibility matters, what problems it solves, and how it helps finance and admin teams save time, reduce waste, and work with confidence.</p>

                    <h2>Why Shared Dashboards Matter for Finance and Admin Teams</h2>

                    <p>A shared dashboard brings both teams to the same page. It removes guesswork and gives everyone a real-time view of operations, spending, inventory, and assets.</p>

                    <p><strong>Why shared visibility is powerful:</strong></p>

                    <ul>
                        <li>Both teams see the same data</li>
                        <li>No conflicting numbers</li>
                        <li>No chasing updates</li>
                        <li>Faster approvals</li>
                        <li>Better cost control</li>
                        <li>Clear monthly reporting</li>
                    </ul>

                    <p>When finance and admins work from one system instead of five tools and ten spreadsheets, daily work becomes smoother and smarter.</p>

                    <h2>The Real Problem: Back-and-Forth That Never Ends</h2>

                    <p>Most companies struggle because finance and admin teams have different sources of information.</p>

                    <p>The admin team knows what was bought, where it is used, and who has it. The finance team knows what was paid, which vendor it came from, and how it fits into the budget.</p>

                    <p>But when these views live in separate places, small tasks turn into long threads.</p>

                    <p><strong>Common back-and-forth conversations:</strong></p>

                    <ul>
                        <li>"Can you send me the updated list?"</li>
                        <li>"Do you know who approved this?"</li>
                        <li>"Where is the invoice for this item?"</li>
                        <li>"Why does your stock number not match mine?"</li>
                        <li>"Who has this laptop right now?"</li>
                        <li>"Is this expense for Project A or Project B?"</li>
                    </ul>

                    <p>This slows down work, creates confusion, and delays vital decisions. A shared dashboard ends this chaos.</p>

                    <h2>How Shared Visibility Reduces Back-and-Forth</h2>

                    <p>When both teams see the same real-time updates, they no longer depend on manual messaging or old spreadsheets.</p>

                    <p><strong>Shared visibility helps by:</strong></p>

                    <ul>
                        <li>Showing every purchase instantly</li>
                        <li>Linking assets to the people who use them</li>
                        <li>Updating stock levels automatically</li>
                        <li>Categorizing expenses clearly</li>
                        <li>Recording maintenance activities</li>
                        <li>Tagging each item with department and purpose</li>
                    </ul>

                    <h2>How It Improves Spend Control</h2>

                    <p>Spend control becomes weak when numbers live in different systems.</p>

                    <p>Admin sees items. Finance sees payments. Neither sees the full picture.</p>

                    <p>A shared dashboard connects purchases to usage, assignment, and stock data. This stops overspending and shortens the approval cycle.</p>

                    <p><strong>Spend control improvements:</strong></p>

                    <ul>
                        <li>No duplicate purchasing</li>
                        <li>No rush buying due to unknown stockouts</li>
                        <li>Accurate view of monthly spend</li>
                        <li>Budget aligned with real asset use</li>
                        <li>Early warnings for rising costs</li>
                        <li>Reduced waste</li>
                    </ul>

                    <p>Finance finally understands why something was purchased. Admins finally understand how it impacts the budget.</p>

                    <h2>A Clear View of Daily Operations</h2>

                    <p>With a shared dashboard, daily work becomes predictable.</p>

                    <p><strong>What finance sees:</strong></p>

                    <ul>
                        <li>Real-time expense categories</li>
                        <li>Vendor history</li>
                        <li>Purchase trends</li>
                        <li>Department-level spending</li>
                        <li>Depreciation of assets</li>
                    </ul>

                    <p><strong>What admin sees:</strong></p>

                    <ul>
                        <li>Stock levels</li>
                        <li>Asset assignments</li>
                        <li>Maintenance due dates</li>
                        <li>Usage patterns</li>
                        <li>Approvals needed</li>
                    </ul>

                    <p>Together, both teams get the full story.</p>

                    <h2>How Shared Dashboards Improve Reporting</h2>

                    <p>Reporting is one of the biggest pain points for both teams. Finance spends hours gathering data. Admins spend hours explaining it. A shared dashboard changes this completely.</p>

                    <p><strong>Reporting becomes easier because:</strong></p>

                    <ul>
                        <li>All numbers are always up to date</li>
                        <li>Data is auto-categorized</li>
                        <li>No manual merging</li>
                        <li>No conflicting sheets</li>
                        <li>No missing context</li>
                        <li>No last-minute panic</li>
                    </ul>

                    <table>
                        <thead>
                            <tr>
                                <th>Report Type</th>
                                <th>Without Shared Dashboard</th>
                                <th>With Shared Dashboard</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Monthly Spend</strong></td>
                                <td>Missing data</td>
                                <td>Clear and real-time</td>
                            </tr>
                            <tr>
                                <td><strong>Asset List</strong></td>
                                <td>Outdated</td>
                                <td>Accurate and assigned</td>
                            </tr>
                            <tr>
                                <td><strong>Stock Levels</strong></td>
                                <td>Guesswork</td>
                                <td>Live quantities</td>
                            </tr>
                            <tr>
                                <td><strong>Vendor Costs</strong></td>
                                <td>Spread across emails</td>
                                <td>One organized place</td>
                            </tr>
                            <tr>
                                <td><strong>Depreciation</strong></td>
                                <td>Manual calculations</td>
                                <td>Auto-updated</td>
                            </tr>
                        </tbody>
                    </table>

                    <p>Tracklet's dashboard does this automatically, removing hours of manual work every month.</p>

                    <h2>Better Decision Making for Leaders</h2>

                    <p>When leaders see clear numbers, they make better decisions.</p>

                    <p><strong>Shared dashboards help leaders:</strong></p>

                    <ul>
                        <li>Plan budgets</li>
                        <li>Forecast costs</li>
                        <li>Approve purchases faster</li>
                        <li>Track inventory gaps</li>
                        <li>Avoid unnecessary buying</li>
                        <li>Allocate assets wisely</li>
                        <li>Reduce downtime</li>
                    </ul>

                    <p>Finance leaders get financial clarity. Admin leaders get operational clarity. Together, they make stronger decisions.</p>

                    <h2>A Story: When Teams Finally Share One View</h2>

                    <div class="story-box">
                        <p><strong>Let's imagine a growing company with 80 employees.</strong></p>
                        <p><strong>Before shared dashboard:</strong></p>
                        <ul>
                            <li>Admin tracks laptops in sheet</li>
                            <li>Finance tracks expenses in separate files</li>
                            <li>Stock updates happen only when someone remembers</li>
                            <li>No one knows depreciation</li>
                            <li>New budgets take weeks to finalize</li>
                        </ul>
                        <p><strong>After shared dashboard:</strong></p>
                        <ul>
                            <li>Finance opens the dashboard → sees real-time spend and purchases</li>
                            <li>Admin logs new assets → finance sees them instantly</li>
                            <li>Stock alerts appear automatically</li>
                            <li>Depreciation updates on its own</li>
                            <li>Budgets become predictable</li>
                        </ul>
                        <p>Both teams save hours each week and make decisions with confidence.</p>
                    </div>

                    <h2>How Tracklet Makes Finance-Admin Collaboration Easy</h2>

                    <p>Tracklet brings both teams into one system. No more silos. No more mixed data. No more manual updates.</p>

                    <p><strong>Tracklet features built for shared visibility:</strong></p>

                    <h3>1. Expense Tracking</h3>

                    <ul>
                        <li>Clear categories</li>
                        <li>Vendor history</li>
                        <li>Real-time spend</li>
                    </ul>

                    <h3>2. Asset Management</h3>

                    <ul>
                        <li>Assignments</li>
                        <li>Movement history</li>
                        <li>Depreciation</li>
                    </ul>

                    <h3>3. Inventory</h3>

                    <ul>
                        <li>Live stock level</li>
                        <li>Low-stock alerts</li>
                        <li>Department-level usage</li>
                    </ul>

                    <h3>4. Maintenance Logs</h3>

                    <ul>
                        <li>Service dates</li>
                        <li>Issue records</li>
                        <li>Scheduled repairs</li>
                    </ul>

                    <h3>5. Shared Dashboard</h3>

                    <ul>
                        <li>Finance + Admin view combined</li>
                        <li>True single source of truth</li>
                        <li>Instant clarity</li>
                    </ul>

                    <p>Tracklet removes the friction that slows both teams.</p>

                    <p>When finance and admins share the same dashboard, the entire company runs smoother.</p>

                    <h2>Final Thoughts</h2>

                    <p>Finance and admin teams work better when they share the same truth. Not different sheets. Not separate systems. Not scattered updates.</p>

                    <p>A shared dashboard removes confusion, saves time, and gives both teams full visibility into spend, assets, stock, and maintenance. It builds trust and brings clarity to the entire organization.</p>

                    <p>Tracklet gives teams this unified view from day one.</p>

                    <div class="blog-post-cta">
                        <h3>Ready to Unify Finance and Admin Teams?</h3>
                        <p>See how Tracklet helps finance and admin teams work smarter together. Get complete shared visibility from day one.</p>
                        <a href="{{ env('WEB_URL') }}" target="_blank" class="btn btn-primary">Tracklet's Finance Module Turns Spend Into Strategy</a>
                    </div>

                    <div class="faq-section">
                        <h2>FAQs</h2>

                        <div class="faq-item">
                            <div class="faq-question">1. Why should finance and admin teams share the same dashboard?</div>
                            <div class="faq-answer">Because it removes back-and-forth, prevents errors, and gives both teams real-time visibility into spending, stock, and assets.</div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question">2. How does shared visibility improve spend control?</div>
                            <div class="faq-answer">It connects purchases to usage, helps spot duplicate buying, and gives finance instant updates on costs and categories.</div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question">3. What problems happen when teams use separate tools?</div>
                            <div class="faq-answer">Conflicting data, slow approvals, budget confusion, duplicate purchases, missing invoices, and delays in reporting.</div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question">4. Does a shared dashboard reduce manual work?</div>
                            <div class="faq-answer">Yes. It automates updates, organizes expenses, tracks assets, and replaces multiple spreadsheets.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@include('layouts.footer')


