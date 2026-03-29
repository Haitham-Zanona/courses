@extends('layouts.app')

@section('title', 'Enroll Now — Obada-Ar')

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
        --gold-dark: #a8860a;
        --bg: #080808;
        --bg2: #0f0f0f;
        --bg3: #161616;
        --bg4: #1e1e1e;
        --text: #F0EAD6;
        --text-muted: #7a7060;
        --border: #2a2418;
        --green: #4caf50;
    }

    body {
        font-family: 'Lato', sans-serif;
        background: var(--bg);
        color: var(--text);
        line-height: 1.8;
        overflow-x: hidden;
        direction: ltr;
    }

    /* ── GEO BG ── */
    .geo-bg {
        position: fixed;
        inset: 0;
        pointer-events: none;
        z-index: 0;
        opacity: 0.025;
        background-image:
            repeating-linear-gradient(0deg, var(--gold) 0px, transparent 1px, transparent 60px),
            repeating-linear-gradient(90deg, var(--gold) 0px, transparent 1px, transparent 60px),
            repeating-linear-gradient(45deg, var(--gold) 0px, transparent 1px, transparent 85px),
            repeating-linear-gradient(-45deg, var(--gold) 0px, transparent 1px, transparent 85px);
    }

    /* ── NAVBAR ── */
    .navbar {
        background: rgba(8, 8, 8, 0.97);
        border-bottom: 1px solid rgba(212, 175, 55, 0.25);
        padding: 16px 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 100;
        backdrop-filter: blur(10px);
    }

    .logo {
        display: flex;
        align-items: baseline;
        gap: 10px;
    }

    .logo-en {
        font-family: 'Cinzel', serif;
        font-size: 1.3rem;
        font-weight: 900;
        color: var(--gold);
        letter-spacing: 2px;
    }

    .logo-ar {
        font-family: 'Amiri', serif;
        font-size: 1rem;
        color: rgba(212, 175, 55, 0.45);
    }

    .back-link {
        font-family: 'Cinzel', serif;
        font-size: 0.75rem;
        color: var(--text-muted);
        letter-spacing: 2px;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: color 0.3s;
    }

    .back-link:hover {
        color: var(--gold);
    }

    /* ── PAGE LAYOUT ── */
    .page-wrap {
        max-width: 1000px;
        margin: 0 auto;
        padding: 60px 24px 100px;
        position: relative;
        z-index: 1;
    }

    .page-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .page-eyebrow {
        font-family: 'Amiri', serif;
        color: var(--gold);
        font-size: 1.1rem;
        display: block;
        margin-bottom: 8px;
    }

    .page-title {
        font-family: 'Cinzel', serif;
        font-size: clamp(1.8rem, 4vw, 2.8rem);
        font-weight: 900;
        letter-spacing: 1px;
        margin-bottom: 6px;
    }

    .page-sub {
        font-family: 'Amiri', serif;
        color: rgba(212, 175, 55, 0.5);
        font-size: 1.1rem;
    }

    /* ── ORNAMENT ── */
    .ornament {
        display: flex;
        align-items: center;
        gap: 16px;
        justify-content: center;
        margin: 20px 0;
    }

    .ornament::before,
    .ornament::after {
        content: '';
        flex: 1;
        max-width: 100px;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--gold), transparent);
    }

    .ornament span {
        font-family: 'Amiri', serif;
        color: var(--gold);
        font-size: 1.2rem;
    }

    /* ── TWO COLUMN ── */
    .checkout-grid {
        display: grid;
        grid-template-columns: 1fr 420px;
        gap: 32px;
        align-items: start;
    }

    @media (max-width: 780px) {
        .checkout-grid {
            grid-template-columns: 1fr;
        }
    }

    /* ── ORDER SUMMARY (LEFT) ── */
    .summary-box {
        background: var(--bg3);
        border: 1px solid var(--border);
        padding: 36px 32px;
        position: relative;
        overflow: hidden;
    }

    .summary-box::before {
        content: 'ع';
        font-family: 'Amiri', serif;
        position: absolute;
        bottom: -40px;
        right: -10px;
        font-size: 14rem;
        color: var(--gold);
        opacity: 0.03;
        pointer-events: none;
        font-weight: 700;
    }

    .summary-label {
        font-family: 'Cinzel', serif;
        font-size: 0.7rem;
        letter-spacing: 4px;
        color: var(--gold);
        text-transform: uppercase;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .summary-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--border);
    }

    /* Course card inside summary */
    .course-card {
        display: flex;
        gap: 16px;
        align-items: flex-start;
        padding-bottom: 24px;
        border-bottom: 1px solid var(--border);
        margin-bottom: 24px;
    }

    .course-thumb {
        width: 70px;
        height: 70px;
        background: var(--bg4);
        border: 1px solid rgba(212, 175, 55, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Amiri', serif;
        font-size: 2rem;
        color: var(--gold);
        flex-shrink: 0;
    }

    .course-info-title {
        font-family: 'Cinzel', serif;
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 4px;
        letter-spacing: 0.5px;
    }

    .course-info-sub {
        font-family: 'Amiri', serif;
        font-size: 0.9rem;
        color: rgba(212, 175, 55, 0.5);
        display: block;
        margin-bottom: 8px;
        direction: rtl;
        text-align: right;
    }

    .course-info-tags {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .tag {
        font-size: 0.7rem;
        color: var(--text-muted);
        border: 1px solid var(--border);
        padding: 2px 8px;
        letter-spacing: 1px;
    }

    /* Includes list */
    .includes-list {
        list-style: none;
        margin-bottom: 24px;
    }

    .includes-list li {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 0;
        font-size: 0.88rem;
        color: #9a9080;
        border-bottom: 1px solid rgba(42, 36, 24, 0.5);
    }

    .includes-list li:last-child {
        border: none;
    }

    .includes-list li::before {
        content: '◆';
        color: var(--gold);
        font-size: 0.45rem;
        flex-shrink: 0;
    }

    /* Price breakdown */
    .price-breakdown {
        background: var(--bg4);
        border: 1px solid var(--border);
        padding: 20px;
        margin-bottom: 20px;
    }

    .price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 6px 0;
        font-size: 0.88rem;
        color: var(--text-muted);
    }

    .price-row.total {
        border-top: 1px solid var(--border);
        margin-top: 10px;
        padding-top: 14px;
        font-size: 1.1rem;
        color: var(--text);
    }

    .price-row.total .amount {
        font-family: 'Cinzel', serif;
        color: var(--gold);
        font-size: 1.4rem;
        font-weight: 700;
    }

    .price-row .strike {
        text-decoration: line-through;
        color: var(--text-muted);
        font-size: 0.8rem;
    }

    .price-row .discount {
        color: var(--green);
        font-size: 0.8rem;
        font-weight: 700;
    }

    /* Guarantee */
    .guarantee-bar {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 16px;
        border: 1px solid rgba(76, 175, 80, 0.2);
        background: rgba(76, 175, 80, 0.04);
        font-size: 0.82rem;
        color: #7a9a7a;
    }

    .guarantee-bar .icon {
        font-size: 1.4rem;
        flex-shrink: 0;
    }

    /* ── PAYMENT BOX (RIGHT) ── */
    .payment-box {
        background: var(--bg3);
        border: 1px solid rgba(212, 175, 55, 0.3);
        padding: 36px 32px;
        position: sticky;
        top: 90px;
        box-shadow: 0 0 60px rgba(212, 175, 55, 0.05);
    }

    .payment-label {
        font-family: 'Cinzel', serif;
        font-size: 0.7rem;
        letter-spacing: 4px;
        color: var(--gold);
        text-transform: uppercase;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .payment-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--border);
    }

    /* Gumroad button */
    .btn-gumroad {
        display: block;
        width: 100%;
        font-family: 'Cinzel', serif;
        font-size: 1rem;
        font-weight: 900;
        letter-spacing: 2px;
        color: #000;
        background: linear-gradient(135deg, var(--gold-light), var(--gold), var(--gold-dark));
        padding: 18px 24px;
        text-align: center;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        margin-bottom: 6px;
        text-decoration: none;
        animation: glow-btn 3s infinite;
    }

    .btn-gumroad:hover {
        background: linear-gradient(135deg, #fff, var(--gold-light), var(--gold));
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(212, 175, 55, 0.35);
    }

    @keyframes glow-btn {

        0%,
        100% {
            box-shadow: 0 4px 20px rgba(212, 175, 55, 0.2);
        }

        50% {
            box-shadow: 0 4px 35px rgba(212, 175, 55, 0.45);
        }
    }

    .btn-gumroad-ar {
        font-family: 'Amiri', serif;
        font-size: 0.85rem;
        color: rgba(0, 0, 0, 0.55);
        display: block;
        margin-top: 3px;
        font-weight: 400;
        letter-spacing: 0;
    }

    .btn-sub {
        text-align: center;
        font-size: 0.75rem;
        color: var(--text-muted);
        letter-spacing: 1px;
        margin-bottom: 24px;
    }

    /* Payment methods icons */
    .payment-methods {
        margin-bottom: 24px;
    }

    .payment-methods-label {
        font-size: 0.72rem;
        color: var(--text-muted);
        letter-spacing: 2px;
        text-transform: uppercase;
        text-align: center;
        margin-bottom: 12px;
    }

    .payment-icons {
        display: flex;
        justify-content: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .pay-icon {
        background: var(--bg4);
        border: 1px solid var(--border);
        padding: 6px 12px;
        font-size: 0.72rem;
        color: var(--text-muted);
        letter-spacing: 1px;
    }

    /* Trust badges */
    .trust-list {
        list-style: none;
        border-top: 1px solid var(--border);
        padding-top: 20px;
    }

    .trust-list li {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 7px 0;
        font-size: 0.82rem;
        color: #7a7060;
    }

    .trust-list li .t-icon {
        color: var(--gold);
        font-size: 0.9rem;
        flex-shrink: 0;
        width: 16px;
        text-align: center;
    }

    /* Gaza note */
    .gaza-note {
        margin-top: 20px;
        padding: 14px 16px;
        border: 1px solid rgba(212, 175, 55, 0.15);
        background: rgba(212, 175, 55, 0.03);
        text-align: center;
    }

    .gaza-note p {
        font-size: 0.8rem;
        color: var(--text-muted);
        line-height: 1.7;
    }

    .gaza-note p strong {
        color: var(--gold);
        font-weight: 700;
    }

    .gaza-note .arabic {
        font-family: 'Amiri', serif;
        font-size: 0.85rem;
        color: rgba(212, 175, 55, 0.4);
        display: block;
        margin-top: 4px;
        direction: rtl;
    }

    /* ── FOOTER ── */
    .checkout-footer {
        border-top: 1px solid var(--border);
        padding: 30px 24px;
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .checkout-footer p {
        font-size: 0.75rem;
        color: var(--text-muted);
        letter-spacing: 1px;
    }

    .checkout-footer a {
        color: var(--gold);
        text-decoration: none;
    }

    /* Fade in */
    .fade-up {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .fade-up.visible {
        opacity: 1;
        transform: translateY(0);
    }
</style>
@endsection

@section('content')

<div class="geo-bg"></div>

{{-- NAVBAR --}}
<nav class="navbar">
    <div class="logo">
        <span class="logo-en">Obada-Ar</span>
        <span class="logo-ar">عربك برو</span>
    </div>
    <a href="{{ route('home') }}" class="back-link">
        ← BACK TO COURSE
    </a>
</nav>

{{-- PAGE CONTENT --}}
<div class="page-wrap">

    {{-- HEADER --}}
    <div class="page-header fade-up">
        <span class="page-eyebrow">أنت على وشك البدء</span>
        <h1 class="page-title">COMPLETE YOUR ENROLLMENT</h1>
        <p class="page-sub">خطوة واحدة تفصلك عن تعلم العربية</p>
        <div class="ornament"><span>❖</span></div>
    </div>

    {{-- GRID --}}
    <div class="checkout-grid">

        {{-- LEFT: ORDER SUMMARY --}}
        <div class="summary-box fade-up">

            <div class="summary-label">Order Summary</div>

            {{-- Course card --}}
            <div class="course-card">
                <div class="course-thumb">ع</div>
                <div>
                    <div class="course-info-title">Obada-Ar — BEGINNER'S COURSE</div>
                    <span class="course-info-sub">كورس العربية الشامل للمبتدئين</span>
                    <div class="course-info-tags">
                        <span class="tag">BEGINNER</span>
                        <span class="tag">PDF + VIDEO</span>
                        <span class="tag">LIFETIME ACCESS</span>
                    </div>
                </div>
            </div>

            {{-- Includes --}}
            <div class="summary-label">What's Included</div>
            <ul class="includes-list">
                <li>Complete Arabic letters from Alef to Ya with pronunciation</li>
                <li>1-hour video walkthrough by Abada</li>
                <li>Comprehensive PDF book — downloadable & printable</li>
                <li>Everyday sentences & real-life conversations</li>
                <li>Travel, restaurant & social phrases</li>
                <li>Instant access immediately after payment</li>
                <li>Free future content updates</li>
                <li>Email support included</li>
            </ul>

            {{-- Price breakdown --}}
            <div class="price-breakdown">
                <div class="price-row">
                    <span>Original Price</span>
                    <span class="strike">$99.00</span>
                </div>
                <div class="price-row">
                    <span>Discount</span>
                    <span class="discount">— $50.00</span>
                </div>
                <div class="price-row total">
                    <span>Total</span>
                    <span class="amount">$49</span>
                </div>
            </div>

            {{-- Guarantee --}}
            <div class="guarantee-bar">
                <span class="icon">🛡</span>
                <span>7-day money-back guarantee. If you are not satisfied, we will refund you in full — no questions
                    asked.</span>
            </div>

        </div>

        {{-- RIGHT: PAYMENT --}}
        <div class="payment-box fade-up">

            <div class="payment-label">Secure Payment</div>

            {{-- Gumroad button --}}
            {{--
            ⚠️ استبدل الرابط التالي برابط منتجك على Gumroad
            مثال: https://abadapro.gumroad.com/l/arabic-course
            أو لو تبي Overlay أضف class="gumroad-button" وحط السكريبت في الأسفل
            --}}
            <a href="https://gumroad.com/l/YOUR_PRODUCT_ID" class="btn-gumroad gumroad-button"
                data-gumroad-single-product="true">
                ENROLL NOW — $49
                <span class="btn-gumroad-ar">سجّل الآن — ٤٩ دولار</span>
            </a>
            <p class="btn-sub">✦ INSTANT ACCESS AFTER PAYMENT ✦</p>

            {{-- Payment methods --}}
            <div class="payment-methods">
                <p class="payment-methods-label">Accepted Payments</p>
                <div class="payment-icons">
                    <span class="pay-icon">VISA</span>
                    <span class="pay-icon">MASTERCARD</span>
                    <span class="pay-icon">PAYPAL</span>
                    <span class="pay-icon">AMEX</span>
                </div>
            </div>

            {{-- Trust badges --}}
            <ul class="trust-list">
                <li><span class="t-icon">🔒</span> Secure 256-bit SSL encryption</li>
                <li><span class="t-icon">⚡</span> Instant access after payment</li>
                <li><span class="t-icon">📧</span> Download link sent to your email</li>
                <li><span class="t-icon">🛡</span> 7-day money-back guarantee</li>
                <li><span class="t-icon">♾</span> Lifetime access — yours forever</li>
            </ul>

            {{-- Gaza note --}}
            <div class="gaza-note">
                <p>
                    <strong>10%</strong> of the price of this course will be dedicated to
                    supporting families in need in Gaza.
                </p>
                <span class="arabic">10% of proceeds support Gaza’s children</span>
            </div>

        </div>
    </div>
</div>

{{-- FOOTER --}}
<footer class="checkout-footer">
    <p>© {{ date('Y') }} Obada-Ar — ALL RIGHTS RESERVED &nbsp;·&nbsp;
        <a href="{{ route('home') }}">Back to Course</a>
    </p>
</footer>

@endsection

@section('scripts')
{{-- Gumroad Overlay Script --}}
<script src="https://gumroad.com/js/gumroad.js"></script>

<script>
    // Fade up on scroll
const observer = new IntersectionObserver((entries) => {
    entries.forEach((e, i) => {
        if (e.isIntersecting) {
            setTimeout(() => e.target.classList.add('visible'), i * 100);
            observer.unobserve(e.target);
        }
    });
}, { threshold: 0.1 });
document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
</script>
@endsection
