<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau message de contact</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f5;">
    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background-color:#f4f4f5; padding:24px 0;">
        <tr>
            <td align="center">
                <table role="presentation" cellpadding="0" cellspacing="0" width="600" style="background-color:#ffffff; border-radius:8px; box-shadow:0 4px 12px rgba(15,23,42,0.12); font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; color:#0f172a;">
                    <tr>
                        <td style="padding:20px 24px; border-bottom:1px solid #e5e7eb; background-color:#2563eb; border-radius:8px 8px 0 0;">
                            <h1 style="margin:0; font-size:20px; line-height:1.4; color:#ffffff;">
                                Nouveau message de contact
                            </h1>
                            <p style="margin:4px 0 0; font-size:13px; color:#dbeafe;">
                                My Helper Community • Notification automatique
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:20px 24px 8px;">
                            <p style="margin:0 0 12px; font-size:14px;">
                                Bonjour,
                            </p>
                            <p style="margin:0 0 12px; font-size:14px; line-height:1.6;">
                                Vous avez reçu un nouveau message depuis le formulaire de contact de votre site.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 24px 16px;">
                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse; background-color:#f9fafb; border-radius:6px; border:1px solid #e5e7eb;">
                                <tr>
                                    <td style="padding:12px 16px; border-bottom:1px solid #e5e7eb;">
                                        <strong style="font-size:13px; color:#6b7280;">Nom</strong><br>
                                        <span style="font-size:14px; color:#111827;">{{ $name }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 16px; border-bottom:1px solid #e5e7eb;">
                                        <strong style="font-size:13px; color:#6b7280;">Email</strong><br>
                                        <a href="mailto:{{ $email }}" style="font-size:14px; color:#2563eb; text-decoration:none;">
                                            {{ $email }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 16px;">
                                        <strong style="font-size:13px; color:#6b7280;">Message</strong><br>
                                        <p style="margin:6px 0 0; font-size:14px; line-height:1.7; white-space:pre-line; color:#111827;">
                                            {{ $content }}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:8px 24px 20px;">
                            <p style="margin:0; font-size:12px; line-height:1.6; color:#6b7280;">
                                Si vous n’êtes pas à l’origine de cette demande, vous pouvez ignorer cet email.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:12px 24px 20px; border-top:1px solid #e5e7eb; border-radius:0 0 8px 8px;">
                            <p style="margin:0; font-size:12px; color:#9ca3af;">
                                &copy; {{ date('Y') }} My Helper Community. Tous droits réservés.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

