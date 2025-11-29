@include('layouts.header')

<style>
        /* Privacy Page Specific Styles */
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
        .logo-img { height: auto; }
        .nav-links { display: flex; gap: 32px; list-style: none; }
        .nav-links a { color: var(--primary); font-weight: 500; font-size: 0.95rem; }
        .nav-links a:hover { opacity: 0.8; }
        .nav-links a.active { color: var(--primary); font-weight: 600; }
        .nav-actions { display: flex; align-items: center; gap: 16px; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 12px 24px; border-radius: var(--radius); font-weight: 600; font-size: 0.95rem; cursor: pointer; border: none; transition: all 0.2s; }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-ghost { background: transparent; color: var(--muted); }
        .mobile-menu-btn { display: none; background: none; border: none; cursor: pointer; padding: 8px; }

        /* Hero Section */
        .privacy-hero { padding: 140px 0 60px; background: linear-gradient(180deg, var(--primary-bg) 0%, var(--background) 100%); text-align: center; }
        .privacy-hero h1 { font-size: 3rem; font-weight: 700; margin-bottom: 16px; letter-spacing: -0.02em; }
        .privacy-hero .last-updated { color: var(--muted); font-size: 0.95rem; }

        /* Privacy Content */
        .privacy-content { padding: 60px 0 100px; }
        .privacy-wrapper { max-width: 900px; margin: 0 auto; }
        .privacy-intro { background: var(--muted-bg); border-radius: var(--radius); padding: 32px; margin-bottom: 48px; }
        .privacy-intro p { color: var(--muted); line-height: 1.8; }
        
        .privacy-section { margin-bottom: 48px; }
        .privacy-section h2 { font-size: 1.75rem; font-weight: 700; margin-bottom: 20px; color: var(--foreground); }
        .privacy-section h3 { font-size: 1.25rem; font-weight: 600; margin-top: 32px; margin-bottom: 12px; color: var(--foreground); }
        .privacy-section p { color: var(--muted); line-height: 1.8; margin-bottom: 16px; }
        .privacy-section ul, .privacy-section ol { margin-left: 24px; margin-bottom: 16px; color: var(--muted); line-height: 1.8; }
        .privacy-section li { margin-bottom: 8px; }
        .privacy-section strong { color: var(--foreground); font-weight: 600; }

        .privacy-footer { text-align: center; padding: 40px 0; border-top: 1px solid var(--border); margin-top: 60px; }
        .privacy-footer p { color: var(--muted); font-size: 0.9rem; }

        @media (max-width: 768px) {
            .nav-links, .nav-actions { display: none; }
            .mobile-menu-btn { display: block; }
            .privacy-hero h1 { font-size: 2rem; }
            .privacy-wrapper { padding: 0 16px; }
            .privacy-intro { padding: 24px; }
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
    </style>

    <!-- Hero Section -->
    <section class="privacy-hero">
        <div class="container">
            <h1>Privacy Policy</h1>
            <p class="last-updated">Last Updated: November 29, 2025</p>
        </div>
    </section>

    <!-- Privacy Content -->
    <section class="privacy-content">
        <div class="container">
            <div class="privacy-wrapper">
                <div class="privacy-intro">
                    <p>At TrackLet, we are committed to protecting your privacy and ensuring the security of your personal information. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our multi-organization management system ("Service").</p>
                </div>

                <div class="privacy-section">
                    <h2>1. Information We Collect</h2>
                    <h3>1.1 Information You Provide</h3>
                    <p>We collect information that you provide directly to us, including:</p>
                    <ul>
                        <li><strong>Account Information:</strong> Name, email address, password, and role assignments</li>
                        <li><strong>Organization Information:</strong> Organization name, email, phone, address, and contact details</li>
                        <li><strong>Business Data:</strong> Expenses, inventory items, assets, maintenance records, and related information</li>
                        <li><strong>Payment Information:</strong> Payment method details processed through Stripe (we do not store full credit card numbers)</li>
                        <li><strong>Communication Data:</strong> Messages, support requests, and feedback you send to us</li>
                    </ul>
                    
                    <h3>1.2 Automatically Collected Information</h3>
                    <p>When you use our Service, we automatically collect certain information, including:</p>
                    <ul>
                        <li><strong>Usage Data:</strong> Pages visited, features used, time spent, and actions taken</li>
                        <li><strong>Device Information:</strong> IP address, browser type, operating system, and device identifiers</li>
                        <li><strong>Log Data:</strong> Access logs, error logs, and system logs</li>
                        <li><strong>Cookies and Tracking:</strong> Session cookies, authentication tokens, and similar technologies</li>
                    </ul>
                </div>

                <div class="privacy-section">
                    <h2>2. How We Use Your Information</h2>
                    <p>We use the information we collect to:</p>
                    <ul>
                        <li>Provide, maintain, and improve the Service</li>
                        <li>Process your registration and manage your account</li>
                        <li>Process payments and manage subscriptions</li>
                        <li>Send you important notifications about your account and the Service</li>
                        <li>Respond to your inquiries and provide customer support</li>
                        <li>Monitor and analyze usage patterns and trends</li>
                        <li>Detect, prevent, and address technical issues and security threats</li>
                        <li>Comply with legal obligations and enforce our Terms and Conditions</li>
                        <li>Send you marketing communications (with your consent, where required)</li>
                    </ul>
                </div>

                <div class="privacy-section">
                    <h2>3. Data Isolation and Security</h2>
                    <h3>3.1 Multi-Organization Isolation</h3>
                    <p>TrackLet is designed with strict data isolation:</p>
                    <ul>
                        <li>Each organization's data is completely separated from other organizations</li>
                        <li>Organizations cannot access data belonging to other organizations</li>
                        <li>Super Admins have access only for system administration purposes</li>
                        <li>All data access is logged and audited</li>
                    </ul>
                    
                    <h3>3.2 Security Measures</h3>
                    <p>We implement industry-standard security measures to protect your information:</p>
                    <ul>
                        <li>Encryption of data in transit (SSL/TLS)</li>
                        <li>Encryption of sensitive data at rest</li>
                        <li>Regular security audits and vulnerability assessments</li>
                        <li>Access controls and authentication mechanisms</li>
                        <li>Secure password storage (hashed and salted)</li>
                        <li>Regular backups and disaster recovery procedures</li>
                    </ul>
                </div>

                <div class="privacy-section">
                    <h2>4. Data Sharing and Disclosure</h2>
                    <p>We do not sell, trade, or rent your personal information to third parties. We may share your information only in the following circumstances:</p>
                    
                    <h3>4.1 Service Providers</h3>
                    <p>We may share information with trusted third-party service providers who assist us in operating the Service, including:</p>
                    <ul>
                        <li><strong>Payment Processors:</strong> Stripe for payment processing (subject to Stripe's privacy policy)</li>
                        <li><strong>Hosting Providers:</strong> Cloud hosting services for infrastructure</li>
                        <li><strong>Email Services:</strong> Email delivery services for notifications</li>
                        <li><strong>Analytics Services:</strong> Usage analytics and monitoring tools</li>
                    </ul>
                    <p>These service providers are contractually obligated to protect your information and use it only for the purposes we specify.</p>
                    
                    <h3>4.2 Legal Requirements</h3>
                    <p>We may disclose your information if required by law or in response to:</p>
                    <ul>
                        <li>Court orders, subpoenas, or legal processes</li>
                        <li>Government requests or regulatory requirements</li>
                        <li>Enforcement of our Terms and Conditions</li>
                        <li>Protection of our rights, property, or safety</li>
                        <li>Prevention of fraud or security threats</li>
                    </ul>
                    
                    <h3>4.3 Business Transfers</h3>
                    <p>In the event of a merger, acquisition, or sale of assets, your information may be transferred to the acquiring entity, subject to the same privacy protections.</p>
                </div>

                <div class="privacy-section">
                    <h2>5. Your Rights and Choices</h2>
                    <h3>5.1 Access and Correction</h3>
                    <p>You have the right to:</p>
                    <ul>
                        <li>Access your personal information through your account settings</li>
                        <li>Update or correct your information at any time</li>
                        <li>Request a copy of your data</li>
                    </ul>
                    
                    <h3>5.2 Data Deletion</h3>
                    <p>You may request deletion of your account and data by:</p>
                    <ul>
                        <li>Contacting us through the Service or email</li>
                        <li>Cancelling your subscription (data will be retained according to our retention policy)</li>
                    </ul>
                    <p>Note: Some information may be retained for legal, regulatory, or business purposes even after account deletion.</p>
                    
                    <h3>5.3 Communication Preferences</h3>
                    <p>You can:</p>
                    <ul>
                        <li>Opt out of marketing emails by clicking unsubscribe links</li>
                        <li>Manage notification preferences in your account settings</li>
                        <li>Contact us to update your communication preferences</li>
                    </ul>
                    
                    <h3>5.4 Cookies and Tracking</h3>
                    <p>You can control cookies through your browser settings. However, disabling cookies may affect the functionality of the Service.</p>
                </div>

                <div class="privacy-section">
                    <h2>6. Data Retention</h2>
                    <p>We retain your information for as long as:</p>
                    <ul>
                        <li>Your account is active</li>
                        <li>Necessary to provide the Service</li>
                        <li>Required by law or regulatory obligations</li>
                        <li>Necessary for legitimate business purposes</li>
                    </ul>
                    <p>After account termination, we may retain certain information for:</p>
                    <ul>
                        <li>Legal and regulatory compliance</li>
                        <li>Dispute resolution</li>
                        <li>Fraud prevention</li>
                        <li>A reasonable period as specified by applicable law</li>
                    </ul>
                </div>

                <div class="privacy-section">
                    <h2>7. Children's Privacy</h2>
                    <p>TrackLet is not intended for use by individuals under the age of 18. We do not knowingly collect personal information from children. If we become aware that we have collected information from a child, we will take steps to delete such information promptly.</p>
                </div>

                <div class="privacy-section">
                    <h2>8. International Data Transfers</h2>
                    <p>Your information may be transferred to and processed in countries other than your country of residence. These countries may have data protection laws that differ from those in your country. We take appropriate safeguards to ensure your information receives adequate protection in accordance with this Privacy Policy.</p>
                </div>

                <div class="privacy-section">
                    <h2>9. California Privacy Rights</h2>
                    <p>If you are a California resident, you have additional rights under the California Consumer Privacy Act (CCPA), including:</p>
                    <ul>
                        <li>The right to know what personal information we collect</li>
                        <li>The right to delete your personal information</li>
                        <li>The right to opt-out of the sale of personal information (we do not sell personal information)</li>
                        <li>The right to non-discrimination for exercising your privacy rights</li>
                    </ul>
                </div>

                <div class="privacy-section">
                    <h2>10. GDPR Rights (European Users)</h2>
                    <p>If you are located in the European Economic Area (EEA), you have additional rights under the General Data Protection Regulation (GDPR), including:</p>
                    <ul>
                        <li>The right to access your personal data</li>
                        <li>The right to rectification of inaccurate data</li>
                        <li>The right to erasure ("right to be forgotten")</li>
                        <li>The right to restrict processing</li>
                        <li>The right to data portability</li>
                        <li>The right to object to processing</li>
                        <li>Rights related to automated decision-making</li>
                    </ul>
                    <p>To exercise these rights, please contact us using the information provided below.</p>
                </div>

                <div class="privacy-section">
                    <h2>11. Changes to This Privacy Policy</h2>
                    <p>We may update this Privacy Policy from time to time. We will:</p>
                    <ul>
                        <li>Notify you of material changes via email or through the Service</li>
                        <li>Update the "Last Updated" date at the top of this page</li>
                        <li>Provide at least 30 days' notice for significant changes</li>
                    </ul>
                    <p>Your continued use of the Service after changes become effective constitutes acceptance of the updated Privacy Policy.</p>
                </div>

                <div class="privacy-section">
                    <h2>12. Third-Party Links</h2>
                    <p>Our Service may contain links to third-party websites or services. We are not responsible for the privacy practices of these third parties. We encourage you to review their privacy policies before providing any information.</p>
                </div>

                <div class="privacy-section">
                    <h2>13. Data Breach Notification</h2>
                    <p>In the event of a data breach that may affect your personal information, we will:</p>
                    <ul>
                        <li>Investigate the breach promptly</li>
                        <li>Notify affected users as required by applicable law</li>
                        <li>Take appropriate remedial actions</li>
                        <li>Report to relevant authorities if required</li>
                    </ul>
                </div>

                <div class="privacy-section">
                    <h2>14. Contact Us</h2>
                    <p>If you have any questions, concerns, or requests regarding this Privacy Policy or our data practices, please contact us at:</p>
                    <ul>
                        <li>Email: privacy@tracklet.com</li>
                        <li>Support: support@tracklet.com</li>
                        <li>Through the Service's support features</li>
                    </ul>
                </div>

                <div class="privacy-section">
                    <h2>15. Consent</h2>
                    <p>By using TrackLet, you consent to the collection, use, and disclosure of your information as described in this Privacy Policy.</p>
                </div>

            </div>
        </div>
    </section>

    @include('layouts.footer')