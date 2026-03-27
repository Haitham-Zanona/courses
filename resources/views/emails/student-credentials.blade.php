<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Georgia', serif;
            background: #f5f0e8;
            margin: 0;
            padding: 40px 20px;
        }

        .card {
            max-width: 560px;
            margin: 0 auto;
            background: #0f0f0f;
            border: 1px solid #D4AF37;
            padding: 40px;
        }

        .logo {
            font-size: 1.6rem;
            font-weight: 900;
            color: #D4AF37;
            letter-spacing: 3px;
            margin-bottom: 4px;
        }

        .logo-ar {
            color: rgba(212, 175, 55, 0.4);
            font-size: 0.9rem;
            margin-bottom: 30px;
        }

        .divider {
            border: none;
            border-top: 1px solid #2a2418;
            margin: 24px 0;
        }

        h2 {
            color: #F0EAD6;
            font-size: 1.2rem;
            margin-bottom: 8px;
        }

        p {
            color: #9a9080;
            font-size: 0.95rem;
            line-height: 1.8;
        }

        .credentials-box {
            background: #161616;
            border: 1px solid #2a2418;
            border-right: 3px solid #D4AF37;
            padding: 20px 24px;
            margin: 24px 0;
        }

        .cred-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #2a2418;
        }

        .cred-row:last-child {
            border: none;
        }

        .cred-label {
            color: #7a7060;
            font-size: 0.8rem;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .cred-value {
            color: #D4AF37;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .btn {
            display: block;
            background: linear-gradient(135deg, #F5E27A, #D4AF37);
            color: #000;
            text-align: center;
            padding: 14px 24px;
            font-weight: 900;
            font-size: 0.95rem;
            letter-spacing: 2px;
            text-decoration: none;
            margin: 24px 0;
        }

        .footer-note {
            font-size: 0.78rem;
            color: #4a4030;
            text-align: center;
            margin-top: 24px;
        }

        .gaza-note {
            background: rgba(212, 175, 55, 0.05);
            border: 1px solid rgba(212, 175, 55, 0.15);
            padding: 14px 16px;
            text-align: center;
            margin-top: 20px;
        }

        .gaza-note p {
            font-size: 0.82rem;
            color: #7a7060;
            margin: 0;
        }

        .gaza-note strong {
            color: #D4AF37;
        }
    </style>
</head>

<body>
    <div class="card">

        <div class="logo">ARABIC PRO</div>
        <div class="logo-ar">تعلّم العربية مع عبادة</div>

        <hr class="divider">

        <h2>Welcome, {{ $studentName }}! 🎉</h2>
        <p>
            Thank you for enrolling in <strong style="color:#D4AF37">Arabic Pro</strong>.
            Your account is ready — here are your login details to access the course:
        </p>

        <div class="credentials-box">
            <div class="cred-row">
                <span class="cred-label">Username</span>
                <span class="cred-value">{{ $username }}</span>
            </div>
            <div class="cred-row">
                <span class="cred-label">Password</span>
                <span class="cred-value">{{ $password }}</span>
            </div>
        </div>

        <p>Click the button below to log in and start your Arabic journey:</p>

        <a href="{{ url('/login') }}" class="btn">
            ACCESS MY COURSE →
        </a>

        <hr class="divider">

        <p style="font-size:0.85rem;">
            📎 Your course PDF is attached to this email — you can download and print it anytime.
        </p>

        <div class="gaza-note">
            <p>
                <strong>10%</strong> of your payment goes directly to supporting
                families in need in Gaza. Thank you for making a difference.
            </p>
        </div>

        <p class="footer-note">
            © {{ date('Y') }} Arabic Pro — All Rights Reserved<br>
            If you have any questions, reply to this email.
        </p>

    </div>
</body>

</html>
