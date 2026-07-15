<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body style="font-family: Arial, sans-serif; background:#f4f4f4; padding:24px; margin:0;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width:480px; margin:0 auto; background:#ffffff; border-radius:8px; overflow:hidden;">
        <tr>
            <td style="background:#1a1a1a; color:#d4af37; padding:20px; text-align:center; font-size:20px; font-weight:bold;">
                ✅ Payment Received
            </td>
        </tr>
        <tr>
            <td style="padding:24px; color:#222;">
                <p style="margin:0 0 16px;">Hi {{ $studentName }},</p>
                <p style="margin:0 0 16px;">
                    Thanks for your payment! We noticed you already have an Obada-Ar account
                    (username: <strong>{{ $username }}</strong>), so we kept your existing login as-is —
                    no need to create a new one.
                </p>
                <p style="margin:0 0 16px;">
                    Just log in with your existing username and password at
                    <a href="{{ url('/login') }}">{{ url('/login') }}</a>.
                </p>
                <p style="margin:0;">
                    Forgot your password? Simply reply to this email and we'll help you out.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
