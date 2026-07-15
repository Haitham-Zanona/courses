<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body style="font-family: Arial, sans-serif; background:#f4f4f4; padding:24px; margin:0;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width:480px; margin:0 auto; background:#ffffff; border-radius:8px; overflow:hidden;">
        <tr>
            <td style="background:#1a1a1a; color:#d4af37; padding:20px; text-align:center; font-size:20px; font-weight:bold;">
                💰 New Sale
            </td>
        </tr>
        <tr>
            <td style="padding:24px; color:#222;">
                <p style="margin:0 0 16px;">A new student just bought the Obada-Ar course.</p>
                <table cellpadding="6" cellspacing="0" style="width:100%; border-collapse:collapse;">
                    <tr>
                        <td style="color:#666; width:120px;">Name</td>
                        <td style="font-weight:bold;">{{ $studentName }}</td>
                    </tr>
                    <tr>
                        <td style="color:#666;">Email</td>
                        <td style="font-weight:bold;">{{ $studentEmail }}</td>
                    </tr>
                    <tr>
                        <td style="color:#666;">Amount</td>
                        <td style="font-weight:bold;">$49.00 USD</td>
                    </tr>
                    <tr>
                        <td style="color:#666;">PayPal Order ID</td>
                        <td style="font-weight:bold;">{{ $orderId }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
