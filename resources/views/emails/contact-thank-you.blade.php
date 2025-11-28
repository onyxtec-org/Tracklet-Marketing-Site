<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Contacting Tracklet</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f8f9fa; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%); padding: 40px 40px 30px; text-align: center;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center">
                                        <div style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 14px; display: inline-block; line-height: 60px; margin-bottom: 20px;">
                                            <span style="font-size: 28px;">✓</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <h1 style="color: #ffffff; font-size: 28px; font-weight: 700; margin: 0 0 10px 0;">Thank You!</h1>
                                        <p style="color: rgba(255,255,255,0.9); font-size: 16px; margin: 0;">We've received your message</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 40px;">
                            <p style="color: #1a1a2e; font-size: 16px; line-height: 1.7; margin: 0 0 24px 0;">
                                Hi <strong>{{ $contactData['name'] }}</strong>,
                            </p>
                            <p style="color: #717182; font-size: 15px; line-height: 1.7; margin: 0 0 24px 0;">
                                Thank you for reaching out to Tracklet! We've successfully received your message and our team is already reviewing it.
                            </p>
                            
                            <!-- Message Summary Box -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f8f9fa; border-radius: 12px; margin: 24px 0;">
                                <tr>
                                    <td style="padding: 24px;">
                                        <p style="color: #9333ea; font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 16px 0;">Your Message Summary</p>
                                        
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="padding: 8px 0; border-bottom: 1px solid rgba(0,0,0,0.06);">
                                                    <span style="color: #717182; font-size: 14px;">Name:</span>
                                                </td>
                                                <td style="padding: 8px 0; border-bottom: 1px solid rgba(0,0,0,0.06); text-align: right;">
                                                    <span style="color: #1a1a2e; font-size: 14px; font-weight: 500;">{{ $contactData['name'] }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px 0; border-bottom: 1px solid rgba(0,0,0,0.06);">
                                                    <span style="color: #717182; font-size: 14px;">Company:</span>
                                                </td>
                                                <td style="padding: 8px 0; border-bottom: 1px solid rgba(0,0,0,0.06); text-align: right;">
                                                    <span style="color: #1a1a2e; font-size: 14px; font-weight: 500;">{{ $contactData['company'] }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px 0; border-bottom: 1px solid rgba(0,0,0,0.06);">
                                                    <span style="color: #717182; font-size: 14px;">Reason:</span>
                                                </td>
                                                <td style="padding: 8px 0; border-bottom: 1px solid rgba(0,0,0,0.06); text-align: right;">
                                                    <span style="color: #1a1a2e; font-size: 14px; font-weight: 500;">{{ ucfirst($contactData['reason']) }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="padding: 12px 0 0 0;">
                                                    <span style="color: #717182; font-size: 14px;">Message:</span>
                                                    <p style="color: #1a1a2e; font-size: 14px; line-height: 1.6; margin: 8px 0 0 0; padding: 12px; background: white; border-radius: 8px;">{{ $contactData['message'] }}</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <p style="color: #717182; font-size: 15px; line-height: 1.7; margin: 0 0 24px 0;">
                                <strong style="color: #1a1a2e;">What happens next?</strong><br>
                                Our team typically responds within <strong style="color: #9333ea;">24 hours</strong> during business days. If your inquiry is urgent, feel free to reach out via live chat on our website.
                            </p>

                            <!-- CTA Button -->
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" style="padding: 16px 0;">
                                        <a href="{{ config('app.url') }}" style="display: inline-block; background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%); color: #ffffff; text-decoration: none; padding: 14px 32px; border-radius: 10px; font-size: 15px; font-weight: 600;">
                                            Visit Tracklet
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8f9fa; padding: 30px 40px; border-top: 1px solid rgba(0,0,0,0.06);">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center">
                                        <p style="color: #9333ea; font-size: 18px; font-weight: 700; margin: 0 0 8px 0;">Tracklet</p>
                                        <p style="color: #717182; font-size: 13px; margin: 0 0 16px 0;">Asset & Inventory Management Platform</p>
                                        <p style="color: #a0a0a0; font-size: 12px; margin: 0;">
                                            © {{ date('Y') }} Tracklet. All rights reserved.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <!-- Unsubscribe Notice -->
                <table width="600" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="center" style="padding: 24px 20px;">
                            <p style="color: #a0a0a0; font-size: 12px; margin: 0;">
                                This is an automated response to your contact form submission.<br>
                                You're receiving this email because you contacted us at tracklet.com
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

