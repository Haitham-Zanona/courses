@extends('layouts.app')
@section('title', 'Thank You — Obada-Ar')
@section('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@700;900&family=Lato:wght@300;400;700&family=Amiri:wght@400;700&display=swap');

    *,
    *::before,
    *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    :root {
        --gold: #D4AF37;
        --gold-light: #F5E27A;
        --bg: #080808;
        --bg3: #161616;
        --text: #F0EAD6;
        --text-muted: #7a7060;
        --border: #2a2418;
    }

    body {
        font-family: 'Lato', sans-serif;
        background: var(--bg);
        color: var(--text);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        direction: ltr;
    }

    .geo-bg {
        position: fixed;
        inset: 0;
        pointer-events: none;
        opacity: 0.025;
        background-image: repeating-linear-gradient(0deg, var(--gold) 0px, transparent 1px, transparent 60px), repeating-linear-gradient(90deg, var(--gold) 0px, transparent 1px, transparent 60px);
    }

    .card {
        max-width: 520px;
        width: 100%;
        background: var(--bg3);
        border: 1px solid rgba(212, 175, 55, 0.3);
        padding: 48px 40px;
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .check {
        font-size: 3rem;
        margin-bottom: 16px;
        display: block;
    }

    .logo {
        font-family: 'Cinzel', serif;
        font-size: 1.4rem;
        font-weight: 900;
        color: var(--gold);
        letter-spacing: 3px;
        display: block;
        margin-bottom: 4px;
    }

    .logo-ar {
        font-family: 'Amiri', serif;
        color: rgba(212, 175, 55, 0.4);
        font-size: 0.9rem;
        display: block;
        margin-bottom: 24px;
    }

    .ornament {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 20px 0;
    }

    .ornament::before,
    .ornament::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--gold), transparent);
    }

    .ornament span {
        font-family: 'Amiri', serif;
        color: var(--gold);
    }

    h2 {
        font-family: 'Cinzel', serif;
        font-size: 1.4rem;
        font-weight: 900;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    p {
        color: var(--text-muted);
        font-size: 0.9rem;
        line-height: 1.8;
        margin-bottom: 12px;
    }

    p strong {
        color: var(--gold);
    }

    .email-note {
        background: rgba(212, 175, 55, 0.04);
        border: 1px solid rgba(212, 175, 55, 0.15);
        padding: 16px;
        margin: 20px 0;
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .btn {
        display: inline-block;
        font-family: 'Cinzel', serif;
        font-size: 0.85rem;
        font-weight: 900;
        letter-spacing: 2px;
        color: #000;
        background: linear-gradient(135deg, var(--gold-light), var(--gold));
        padding: 12px 32px;
        text-decoration: none;
        margin-top: 8px;
        transition: all 0.3s;
    }

    .btn:hover {
        transform: translateY(-1px);
    }
</style>
@endsection

@section('content')
<div class="geo-bg"></div>
<div class="card">
    <span class="check">✅</span>
    <span class="logo">Obada-Ar</span>
    <span class="logo-ar">تعلّم العربية مع عبادة</span>
    <div class="ornament"><span>❖</span></div>
    <h2>PAYMENT SUCCESSFUL!</h2>
    <p>
        Welcome aboard, <strong>{{ session('payer_name', 'Student') }}</strong>!<br>
        Your enrollment is confirmed.
    </p>
    <div class="email-note">
        📧 Check your email — we've sent your <strong>login credentials</strong>
        and the <strong>course PDF</strong> to your inbox.
    </div>
    <p style="font-size:0.8rem;">Don't see the email? Check your spam folder.</p>
    <a href="{{ route('login') }}" class="btn">LOGIN TO MY COURSE →</a>
</div>
@endsection
