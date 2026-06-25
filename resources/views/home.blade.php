@extends('layouts.app')

@section('title', 'Obada-Ar — Learn Arabic From Zero')

@section('head')
<link rel="preload" as="image" href="/images/children-tentss.webp" fetchpriority="high">
@endsection

@section('styles')
<style>
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
        --red: #C0392B;
        --bg: #080808;
        --bg2: #0f0f0f;
        --bg3: #161616;
        --bg4: #1e1e1e;
        --text: #F0EAD6;
        --text-muted: #7a7060;
        --border: #2a2418;
        --pattern: rgba(212, 175, 55, 0.04);
    }

    body {
        font-family: 'Lato', sans-serif;
        background: var(--bg);
        color: var(--text);
        line-height: 1.8;
        overflow-x: hidden;
        padding-top: 116px;
    }

    /* ── ISLAMIC GEOMETRY BACKGROUND ── */
    .geo-bg {
        position: fixed;
        inset: 0;
        pointer-events: none;
        z-index: 0;
        opacity: 0.03;
        background-image:
            repeating-linear-gradient(0deg, var(--gold) 0px, transparent 1px, transparent 60px),
            repeating-linear-gradient(90deg, var(--gold) 0px, transparent 1px, transparent 60px),
            repeating-linear-gradient(45deg, var(--gold) 0px, transparent 1px, transparent 85px),
            repeating-linear-gradient(-45deg, var(--gold) 0px, transparent 1px, transparent 85px);
    }

    /* ── ARABIC LETTER DECORATIONS (design elements only) ── */
    .arabic-deco {
        font-family: 'Amiri', serif;
        position: absolute;
        color: var(--gold);
        opacity: 0.06;
        font-size: 12rem;
        font-weight: 700;
        pointer-events: none;
        line-height: 1;
        user-select: none;
    }

    /* ── DIVIDER ORNAMENT ── */
    .ornament {
        display: flex;
        align-items: center;
        gap: 16px;
        justify-content: center;
        margin: 24px 0;
    }

    .ornament::before,
    .ornament::after {
        content: '';
        flex: 1;
        max-width: 120px;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--gold), transparent);
    }

    .ornament-symbol {
        font-family: 'Amiri', serif;
        color: var(--gold);
        font-size: 1.4rem;
    }

    /* ── ANNOUNCEMENT BAR ── */
    .navbar-announcement {
        background: var(--gold);
        color: #000;
        text-align: center;
        padding: 12px 24px;
        font-family: 'Cinzel', serif;
        font-size: 0.95rem;
        font-weight: 900;
        letter-spacing: 3px;
        text-transform: uppercase;
        line-height: 1.4;
    }

    /* ── NAVBAR ── */
    .navbar {
        background: rgba(8, 8, 8, 0.96);
        border-bottom: 1px solid rgba(212, 175, 55, 0.3);
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 100;
        backdrop-filter: blur(10px);
    }

    .navbar-main {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 32px;
    }

    .logo {
        display: flex;
        align-items: baseline;
        gap: 10px;
    }

    .logo-en {
        font-family: 'Cinzel', serif;
        font-size: 1.8rem;
        font-weight: 900;
        color: var(--gold);
        letter-spacing: 2px;
    }

    .logo-mobile {
        height: 52px;
        width: auto;
        display: none;
        object-fit: contain;
    }

    .nav-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .nav-login {
        font-family: 'Cinzel', serif;
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--gold);
        border: 1px solid rgba(212, 175, 55, 0.45);
        padding: 8px 18px;
        border-radius: 2px;
        letter-spacing: 1px;
        transition: all 0.3s;
    }

    .nav-login:hover {
        background: rgba(212, 175, 55, 0.08);
        border-color: var(--gold);
    }

    .nav-cta {
        font-family: 'Cinzel', serif;
        font-size: 0.8rem;
        font-weight: 700;
        color: #000;
        background: var(--gold);
        padding: 8px 20px;
        border-radius: 2px;
        letter-spacing: 1px;
        transition: all 0.3s;
    }

    .nav-cta:hover {
        background: var(--gold-light);
    }

    /* ── HERO ── */
    .hero {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 80px 24px;
        overflow: hidden;
        background: var(--bg);
    }

    /* Children background image — covers entire hero */
    .hero-bg-image {
        position: absolute;
        inset: 0;
        background: url('/images/children-tentss.webp') center / cover no-repeat;
        opacity: 0.45;
        z-index: 0;
    }

    /* Very light overlay to preserve image clarity */
    .hero-bg-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.3);
        z-index: 1;
    }

    .hero-inner {
        position: relative;
        z-index: 2;
        max-width: 800px;
    }

    .hero-tag {
        display: inline-block;
        border: 1px solid rgba(212, 175, 55, 0.4);
        color: var(--gold);
        font-family: 'Cinzel', serif;
        font-size: 0.7rem;
        letter-spacing: 4px;
        padding: 6px 20px;
        margin-bottom: 30px;
        position: relative;
    }

    .hero-tag::before,
    .hero-tag::after {
        content: '◆';
        font-size: 0.5rem;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
    }

    .hero-tag::before {
        left: -8px;
    }

    .hero-tag::after {
        right: -8px;
    }

    .hero h1 {
        font-family: 'Cinzel', serif;
        font-size: clamp(2.2rem, 6vw, 4rem);
        font-weight: 900;
        line-height: 1.2;
        margin-bottom: 24px;
        color: var(--text);
        letter-spacing: -1px;
    }

    .hero h1 .gold-text {
        color: var(--gold);
        font-style: italic;
    }

    /* Hero price block at top */
    .hero-price-top {
        margin: 0 auto 36px;
        padding: 28px 32px;
        border: 1px solid rgba(212, 175, 55, 0.3);
        background: rgba(212, 175, 55, 0.04);
        max-width: 480px;
    }

    .hero-price-top-amount {
        font-family: 'Cinzel', serif;
        font-size: 3.8rem;
        font-weight: 900;
        color: var(--gold);
        line-height: 1;
        margin-bottom: 8px;
    }

    .hero-price-top-sub {
        font-size: 0.75rem;
        color: var(--text-muted);
        letter-spacing: 3px;
        text-transform: uppercase;
        margin-bottom: 20px;
    }

    .hero-sub {
        font-size: 1.1rem;
        color: #9a9080;
        max-width: 560px;
        margin: 0 auto 40px;
        font-weight: 300;
        letter-spacing: 0.5px;
    }

    /* Gaza children block — transparent so hero bg image shows through */
    .hero-gaza-block {
        position: relative;
        width: 100%;
        max-width: 600px;
        margin: 0 auto 40px;
        padding: 56px 32px;
        text-align: center;
        border: 1px solid rgba(212, 175, 55, 0.5);
        background: rgba(0, 0, 0, 0.15);
        backdrop-filter: blur(1px);
    }

    .hero-gaza-content {
        position: relative;
        z-index: 1;
    }

    .hero-gaza-title {
        font-family: 'Cinzel', serif;
        font-size: clamp(1.5rem, 4vw, 2rem);
        font-weight: 900;
        color: #fff;
        margin-bottom: 4px;
        letter-spacing: 1px;
    }

    .hero-gaza-subtitle {
        font-family: 'Cinzel', serif;
        font-size: clamp(1.5rem, 4vw, 2rem);
        font-weight: 900;
        color: var(--gold);
        margin-bottom: 20px;
        letter-spacing: 1px;
    }

    .hero-gaza-divider {
        display: flex;
        align-items: center;
        gap: 12px;
        justify-content: center;
        margin-bottom: 16px;
    }

    .hero-gaza-divider::before,
    .hero-gaza-divider::after {
        content: '';
        width: 60px;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--gold), transparent);
    }

    .hero-gaza-divider-sym {
        color: var(--gold);
        font-size: 0.8rem;
    }

    .hero-gaza-text {
        font-size: 0.92rem;
        color: rgba(255, 255, 255, 0.75);
        margin-bottom: 28px;
        letter-spacing: 0.5px;
    }

    .hero-gaza-btn {
        display: inline-block;
        border: 1px solid var(--gold);
        color: var(--gold);
        font-family: 'Cinzel', serif;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 3px;
        padding: 13px 30px;
        text-transform: uppercase;
        transition: all 0.3s;
    }

    .hero-gaza-btn:hover {
        background: var(--gold);
        color: #000;
    }

    @keyframes spin-slow {
        to {
            transform: rotate(360deg);
        }
    }

    /* Hero stats */
    .hero-stats {
        display: flex;
        justify-content: center;
        gap: 0;
        margin-bottom: 40px;
        flex-wrap: wrap;
    }

    .hero-stat {
        padding: 16px 28px;
        border-right: 1px solid rgba(212, 175, 55, 0.2);
        text-align: center;
    }

    .hero-stat:last-child {
        border-right: none;
    }

    .hero-stat-num {
        font-family: 'Cinzel', serif;
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--gold);
        display: block;
    }

    .hero-stat-label {
        font-size: 0.75rem;
        color: var(--text-muted);
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    /* ── CTA BUTTON ── */
    .btn-main {
        display: inline-block;
        position: relative;
        font-family: 'Cinzel', serif;
        font-size: 1rem;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: #000;
        background: linear-gradient(135deg, var(--gold-light), var(--gold), var(--gold-dark));
        padding: 18px 56px;
        clip-path: polygon(12px 0%, 100% 0%, calc(100% - 12px) 100%, 0% 100%);
        transition: all 0.3s;
        cursor: pointer;
        border: none;
    }

    .btn-main:hover {
        background: linear-gradient(135deg, #fff, var(--gold-light), var(--gold));
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(212, 175, 55, 0.4);
    }

    .btn-sub {
        margin-top: 14px;
        font-size: 0.78rem;
        color: var(--text-muted);
        letter-spacing: 1px;
    }

    /* ── SECTION BASE ── */
    section {
        padding: 80px 24px;
        position: relative;
    }

    .section-title {
        font-family: 'Cinzel', serif;
        font-size: clamp(1.6rem, 4vw, 2.4rem);
        font-weight: 900;
        text-align: center;
        margin-bottom: 40px;
        letter-spacing: 1px;
    }

    .container {
        max-width: 960px;
        margin: 0 auto;
    }

    /* ── WHAT YOU LEARN ── */
    .learn-section {
        background: var(--bg2);
    }

    .learn-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
    }

    @media (max-width: 640px) {
        .learn-grid {
            grid-template-columns: 1fr;
        }
    }

    .learn-card {
        background: var(--bg3);
        border: 1px solid var(--border);
        padding: 36px 32px;
        position: relative;
        overflow: hidden;
        transition: all 0.35s;
    }

    .learn-card:hover {
        border-color: rgba(212, 175, 55, 0.4);
        background: var(--bg4);
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
    }

    .learn-card::before {
        content: attr(data-ar);
        font-family: 'Amiri', serif;
        position: absolute;
        bottom: -30px;
        right: -10px;
        font-size: 9rem;
        color: var(--gold);
        opacity: 0.05;
        font-weight: 700;
        pointer-events: none;
        line-height: 1;
    }

    .learn-card-icon {
        font-size: 2.2rem;
        margin-bottom: 16px;
        display: block;
        filter: grayscale(0.2);
    }

    .learn-card-title {
        font-family: 'Cinzel', serif;
        font-size: 1rem;
        font-weight: 700;
        letter-spacing: 1px;
        color: var(--gold);
        margin-bottom: 12px;
    }

    .learn-card-text {
        font-size: 0.9rem;
        color: #9a9080;
        font-weight: 300;
        line-height: 1.9;
    }

    .learn-card-divider {
        width: 40px;
        height: 1px;
        background: linear-gradient(to right, var(--gold), transparent);
        margin-bottom: 14px;
    }

    /* ── CURRICULUM ── */
    .curriculum-section {
        background: var(--bg);
    }

    .module-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .module-item {
        background: var(--bg3);
        border: 1px solid var(--border);
        padding: 18px 24px;
        display: flex;
        align-items: center;
        gap: 20px;
        transition: all 0.3s;
        cursor: default;
    }

    .module-item:hover {
        border-color: rgba(212, 175, 55, 0.4);
        background: var(--bg4);
    }

    .module-num {
        font-family: 'Cinzel', serif;
        color: var(--gold);
        font-size: 1.6rem;
        font-weight: 700;
        line-height: 1;
        min-width: 44px;
        text-align: center;
        flex-shrink: 0;
    }

    .module-divider {
        width: 1px;
        height: 36px;
        background: linear-gradient(to bottom, transparent, var(--gold), transparent);
        flex-shrink: 0;
    }

    .module-info {
        flex: 1;
    }

    .module-title {
        font-family: 'Cinzel', serif;
        font-size: 0.9rem;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .module-count {
        font-size: 0.75rem;
        color: var(--text-muted);
        letter-spacing: 1px;
        flex-shrink: 0;
    }

    /* ── INSTRUCTOR ── */
    .instructor-section {
        background: var(--bg2);
        overflow: hidden;
    }

    .instructor-card {
        display: flex;
        align-items: center;
        gap: 40px;
        flex-wrap: wrap;
        justify-content: center;
        position: relative;
        z-index: 1;
    }

    .instructor-img-wrap {
        position: relative;
        flex-shrink: 0;
    }

    .instructor-img-wrap img {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--gold);
        display: block;
        position: relative;
        z-index: 1;
    }

    .instructor-img-wrap::before {
        content: 'م';
        font-family: 'Amiri', serif;
        position: absolute;
        font-size: 8rem;
        color: var(--gold);
        opacity: 0.12;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 0;
    }

    .instructor-info {
        max-width: 480px;
    }

    .instructor-name {
        font-family: 'Cinzel', serif;
        font-size: 1.5rem;
        font-weight: 900;
        margin-bottom: 12px;
        letter-spacing: 1px;
    }

    .instructor-bio {
        color: #8a8070;
        font-size: 0.95rem;
        font-weight: 300;
        line-height: 1.8;
    }

    /* ── TESTIMONIALS ── */
    .testimonials-section {
        background: var(--bg);
    }

    .testimonials-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 20px;
    }

    .testimonial-card {
        background: var(--bg3);
        border: 1px solid var(--border);
        padding: 28px 24px;
        position: relative;
        overflow: hidden;
        transition: border-color 0.3s;
    }

    .testimonial-card:hover {
        border-color: rgba(212, 175, 55, 0.35);
    }

    .testimonial-card::before {
        content: attr(data-ar-letter);
        font-family: 'Amiri', serif;
        position: absolute;
        bottom: -20px;
        left: 10px;
        font-size: 7rem;
        color: var(--gold);
        opacity: 0.05;
        pointer-events: none;
        font-weight: 700;
    }

    .stars {
        color: var(--gold);
        font-size: 0.85rem;
        letter-spacing: 2px;
        margin-bottom: 12px;
    }

    .t-text {
        font-size: 0.9rem;
        color: #9a9080;
        margin-bottom: 16px;
        font-weight: 300;
        line-height: 1.8;
        font-style: italic;
    }

    .t-avatar {
        width: 54px;
        height: 54px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid rgba(212, 175, 55, 0.45);
        margin-bottom: 16px;
        display: block;
        background: var(--bg4);
    }

    .t-author {
        font-family: 'Cinzel', serif;
        font-size: 0.85rem;
        font-weight: 700;
    }

    .t-role {
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-top: 2px;
    }

    /* ── INSTAGRAM ── */
    .instagram-section {
        background: var(--bg2);
        text-align: center;
    }

    .instagram-handle {
        font-family: 'Cinzel', serif;
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--gold);
        letter-spacing: 2px;
        margin-bottom: 8px;
        display: block;
    }

    .instagram-sub {
        font-size: 0.85rem;
        color: var(--text-muted);
        letter-spacing: 2px;
        margin-bottom: 32px;
    }

    .instagram-stats {
        display: flex;
        justify-content: center;
        gap: 48px;
        margin-bottom: 40px;
        flex-wrap: wrap;
    }

    .instagram-stat {
        text-align: center;
    }

    .instagram-stat-num {
        font-family: 'Cinzel', serif;
        font-size: 2rem;
        font-weight: 900;
        color: var(--gold);
        display: block;
    }

    .instagram-stat-label {
        font-size: 0.72rem;
        color: var(--text-muted);
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .instagram-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-family: 'Cinzel', serif;
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 2px;
        color: #000;
        background: linear-gradient(135deg, var(--gold-light), var(--gold), var(--gold-dark));
        padding: 16px 40px;
        border-radius: 2px;
        transition: all 0.3s;
        text-transform: uppercase;
    }

    .instagram-btn:hover {
        background: linear-gradient(135deg, #fff, var(--gold-light), var(--gold));
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(212, 175, 55, 0.4);
    }

    /* ── PRICING ── */
    .pricing-section {
        background: var(--bg2);
        overflow: hidden;
    }

    .price-box {
        max-width: 520px;
        margin: 0 auto;
        background: var(--bg3);
        border: 1px solid rgba(212, 175, 55, 0.4);
        padding: 48px 40px;
        text-align: center;
        position: relative;
        clip-path: polygon(20px 0%, 100% 0%, calc(100% - 20px) 100%, 0% 100%);
        box-shadow: 0 0 60px rgba(212, 175, 55, 0.07);
    }

    .price-box::before {
        content: 'ث';
        font-family: 'Amiri', serif;
        position: absolute;
        font-size: 18rem;
        color: var(--gold);
        opacity: 0.03;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        pointer-events: none;
    }

    .price-old {
        color: var(--text-muted);
        font-size: 1rem;
        letter-spacing: 1px;
        margin-bottom: 4px;
    }

    .price-amount {
        font-family: 'Cinzel', serif;
        font-size: 5.5rem;
        font-weight: 900;
        color: var(--gold);
        line-height: 1;
        margin-bottom: 4px;
    }

    .price-period {
        font-size: 0.8rem;
        color: var(--text-muted);
        letter-spacing: 3px;
        text-transform: uppercase;
        margin-bottom: 32px;
    }

    .price-features {
        list-style: none;
        margin-bottom: 32px;
        text-align: left;
    }

    .price-features li {
        padding: 10px 0;
        border-bottom: 1px solid var(--border);
        font-size: 0.9rem;
        color: #b0a890;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .price-features li:last-child {
        border: none;
    }

    .price-features li::before {
        content: '◆';
        color: var(--gold);
        font-size: 0.5rem;
        flex-shrink: 0;
    }

    /* ── FAQ ── */
    .faq-section {
        background: var(--bg);
    }

    .faq-list {
        max-width: 680px;
        margin: 0 auto;
    }

    .faq-item {
        border-bottom: 1px solid var(--border);
        overflow: hidden;
    }

    .faq-q {
        padding: 20px 0;
        font-family: 'Cinzel', serif;
        font-size: 0.9rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        transition: color 0.3s;
    }

    .faq-q:hover {
        color: var(--gold);
    }

    .faq-arrow {
        color: var(--gold);
        font-size: 1rem;
        transition: transform 0.3s;
        flex-shrink: 0;
        font-style: normal;
    }

    .faq-a {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease, padding 0.3s;
        font-size: 0.9rem;
        color: #8a8070;
        font-weight: 300;
        line-height: 1.9;
    }

    .faq-item.open .faq-a {
        max-height: 200px;
        padding-bottom: 20px;
    }

    .faq-item.open .faq-arrow {
        transform: rotate(180deg);
    }

    /* ── FINAL CTA ── */
    .final-cta {
        text-align: center;
        padding: 100px 24px;
        overflow: hidden;
        position: relative;
        background: var(--bg2);
    }

    .final-cta::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('/images/children-tent.webp') center / cover no-repeat;
        opacity: 0.45;
        z-index: 0;
    }

    .final-cta::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.55);
        z-index: 1;
    }

    .final-cta h2 {
        font-family: 'Cinzel', serif;
        font-size: clamp(1.8rem, 5vw, 3rem);
        font-weight: 900;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    /* ── FOOTER ── */
    footer {
        background: #000;
        border-top: 1px solid rgba(212, 175, 55, 0.2);
        padding: 40px 24px;
        text-align: center;
    }

    .footer-logo-img {
        height: 70px;
        width: auto;
        display: block;
        margin: 0 auto 12px;
        object-fit: contain;
    }

    .footer-logo {
        font-family: 'Cinzel', serif;
        font-size: 1.6rem;
        font-weight: 900;
        color: var(--gold);
        letter-spacing: 4px;
        display: block;
        margin-bottom: 12px;
    }

    .footer-copy {
        font-size: 0.75rem;
        color: var(--text-muted);
        letter-spacing: 1px;
    }

    /* ── FADE IN ── */
    .fade-up {
        opacity: 0;
        transform: translateY(40px);
        transition: opacity 0.7s ease, transform 0.7s ease;
    }

    .fade-up.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* ── MOBILE ── */
    @media (max-width: 768px) {
        body {
            padding-top: 90px;
        }

        /* Navbar */
        .navbar-announcement {
            font-size: 0.65rem;
            padding: 8px 10px;
            letter-spacing: 1px;
        }

        .nav-cta {
            display: none;
        }

        .logo-en {
            display: none;
        }

        .logo-mobile {
            display: block;
        }

        .nav-login {
            font-size: 0.72rem;
            padding: 6px 12px;
        }

        .navbar-main {
            padding: 10px 12px;
        }

        /* Hero */
        .hero {
            padding: 40px 16px;
            min-height: auto;
        }

        .hero-price-top {
            padding: 20px 16px;
            margin-bottom: 24px;
        }

        .hero-price-top-amount {
            font-size: 2.8rem;
        }

        .hero-price-top-sub {
            font-size: 0.65rem;
            letter-spacing: 1.5px;
        }

        .hero-sub {
            font-size: 0.95rem;
            margin-bottom: 28px;
        }

        /* Gaza block */
        .hero-gaza-block {
            padding: 36px 20px;
            margin-bottom: 28px;
        }

        .hero-gaza-title,
        .hero-gaza-subtitle {
            font-size: 1.4rem;
        }

        /* Buttons */
        .btn-main {
            padding: 15px 32px;
            font-size: 0.85rem;
            letter-spacing: 2px;
            clip-path: polygon(8px 0%, 100% 0%, calc(100% - 8px) 100%, 0% 100%);
        }

        /* Sections */
        section {
            padding: 56px 16px;
        }

        .section-title {
            font-size: 1.4rem;
            margin-bottom: 28px;
        }

        /* Learn cards */
        .learn-card {
            padding: 28px 20px;
        }

        /* Module list */
        .module-item {
            padding: 14px 16px;
            gap: 12px;
        }

        .module-num {
            font-size: 1.2rem;
            min-width: 32px;
        }

        .module-title {
            font-size: 0.82rem;
        }

        /* Instructor */
        .instructor-card {
            gap: 24px;
        }

        .instructor-info {
            max-width: 100%;
            text-align: center;
        }

        /* Instagram */
        .instagram-stats {
            gap: 24px;
        }

        .instagram-stat-num {
            font-size: 1.5rem;
        }

        .instagram-btn {
            padding: 13px 24px;
            font-size: 0.75rem;
            letter-spacing: 1px;
        }

        /* Pricing */
        .price-box {
            padding: 36px 24px;
            clip-path: polygon(12px 0%, 100% 0%, calc(100% - 12px) 100%, 0% 100%);
        }

        .price-amount {
            font-size: 4rem;
        }

        /* Final CTA */
        .final-cta {
            padding: 70px 16px;
        }

        .final-cta::before {
            display: none;
        }

        /* Footer */
        .footer-logo-img {
            height: 55px;
        }

        .footer-logo {
            font-size: 1.2rem;
        }
    }

    /* Extra small screens */
    @media (max-width: 380px) {
        .navbar-announcement {
            font-size: 0.58rem;
            letter-spacing: 0.5px;
        }

        .hero-price-top-amount {
            font-size: 2.4rem;
        }

        .btn-main {
            padding: 13px 24px;
            font-size: 0.78rem;
        }

        .instagram-stats {
            gap: 16px;
        }
    }
</style>
@endsection

@section('content')

<div class="geo-bg"></div>

{{-- NAVBAR --}}
<nav class="navbar">
    <div class="navbar-announcement">
        10% OF PROCEEDS SUPPORT GAZA'S CHILDREN
    </div>
    <div class="navbar-main">
        <div class="logo">
            <span class="logo-en">Obada-Ar</span>
            <img class="logo-mobile" src="{{ asset('images/logo-p.webp') }}" alt="Obada-Ar" width="39" height="52">
        </div>
        <div class="nav-actions">
            <a href="{{ route('login') }}" class="nav-login">LOGIN</a>
            <a href="{{ route('checkout') }}" class="nav-cta">ENROLL NOW</a>
        </div>
    </div>
</nav>

{{-- HERO --}}
<section class="hero">
    <div class="hero-bg-image"></div>
    <div class="hero-bg-overlay"></div>
    <div class="hero-inner">
        <div class="hero-tag">COMPLETE BEGINNER'S COURSE</div>

        <h1>Master <span class="gold-text">Arabic</span><br>From Zero</h1>

        {{-- Price + CTA at top of page --}}
        <div class="hero-price-top">
            <div class="hero-price-top-amount">$49</div>
            <div class="hero-price-top-sub">ONE-TIME PAYMENT · LIFETIME ACCESS</div>
            <a href="{{ route('checkout') }}" class="btn-main">BUY NOW — $49</a>
        </div>

        <p class="hero-sub">Letters · Numbers · Daily Conversations · Pronunciation<br>Everything you need to speak with
            confidence</p>

        {{-- Gaza Children Block --}}
        <div class="hero-gaza-block">
            <div class="hero-gaza-content">
                <p class="hero-gaza-title">Learn Arabic.</p>
                <p class="hero-gaza-subtitle">Support Gaza's Children.</p>
                <div class="hero-gaza-divider">
                    <span class="hero-gaza-divider-sym">——◆——</span>
                </div>
                <p class="hero-gaza-text">10% of every purchase helps children in Gaza.</p>
                <a href="#impact" class="hero-gaza-btn">SEE THE IMPACT ❤</a>
            </div>
        </div>

    </div>
</section>

{{-- WHAT YOU LEARN --}}
<section class="learn-section fade-up">
    <div class="container">
        <h2 class="section-title">WHAT YOU WILL LEARN</h2>

        <div class="learn-grid">

            <div class="learn-card" data-ar="ح">
                <span class="learn-card-icon">🔤</span>
                <div class="learn-card-title">COMPLETE ARABIC LETTER FOUNDATIONS</div>
                <div class="learn-card-divider"></div>
                <p class="learn-card-text">
                    The course begins with all Arabic letters from Alef to Ya, covering the 10 articulation points that
                    form the basis of correct pronunciation. You will learn each letter in its different forms and how
                    to write it by hand using an easy-to-follow PDF book.
                </p>
            </div>

            <div class="learn-card" data-ar="ت">
                <span class="learn-card-icon">💬</span>
                <div class="learn-card-title">PRACTICAL DAILY COMMUNICATION</div>
                <div class="learn-card-divider"></div>
                <p class="learn-card-text">
                    After mastering the letters, you move into real-life sentences and phrases that allow you to
                    interact with people naturally. You will cover expressions used in travel, markets, restaurants, and
                    everyday social situations.
                </p>
            </div>

            <div class="learn-card" data-ar="م">
                <span class="learn-card-icon">📚</span>
                <div class="learn-card-title">FLEXIBLE & VARIED CONTENT</div>
                <div class="learn-card-divider"></div>
                <p class="learn-card-text">
                    The course includes a comprehensive PDF book and a one-hour video where Obada walks you through
                    every part step by step. You can follow the lessons whenever it suits your schedule — no fixed
                    timing required.
                </p>
            </div>

            <div class="learn-card" data-ar="د">
                <span class="learn-card-icon">🤝</span>
                <div class="learn-card-title">A PURCHASE THAT GIVES BACK</div>
                <div class="learn-card-divider"></div>
                <p class="learn-card-text">
                    Obada dedicates a portion of the course proceeds to supporting families in need in Gaza. When you
                    enroll, you are also contributing to a meaningful humanitarian cause that helps those who need it
                    most.
                </p>
            </div>

        </div>
    </div>
</section>


{{-- CURRICULUM --}}
<section class="curriculum-section fade-up">
    <div class="container">
        <h2 class="section-title">COURSE CURRICULUM</h2>

        <div class="module-list">
            @foreach([
            ['1', 'The Arabic Alphabet', '3 PDFs'],
            ['2', 'Daily Expressions', '2 PDFs'],
            ['3', 'Days of the Week', '2 PDFs'],
            ['4', 'Numbers & Counting', '3 PDFs'],
            ['5', 'Telling the Time', '2 PDFs'],
            ['6', 'At the Market', '3 PDFs'],
            ['7', 'Time & Place', '3 PDFs'],
            ['8', 'Family Vocabulary', '2 PDFs'],
            ['9', 'Colors & Descriptions', '3 PDFs'],
            ['10', 'Around the House', '2 PDFs'],
            ['11', 'Food & Meals', '4 PDFs'],
            ] as [$num, $title, $count])
            <div class="module-item">
                <div class="module-num">{{ $num }}</div>
                <div class="module-divider"></div>
                <div class="module-info">
                    <div class="module-title">{{ $title }}</div>
                </div>
                <div class="module-count">{{ $count }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA MIDDLE --}}
<section style="background: var(--bg2); text-align: center; padding: 60px 24px;">
    <div class="ornament"><span class="ornament-symbol">❖</span></div>
    <p
        style="font-size: 1rem; color: var(--text-muted); letter-spacing: 2px; margin-bottom: 24px; text-transform: uppercase;">
        Don't delay — start today
    </p>
    <a href="{{ route('checkout') }}" class="btn-main">SECURE YOUR SPOT</a>
</section>

{{-- INSTRUCTOR --}}
<section class="instructor-section fade-up">
    <div class="container">
        <h2 class="section-title">YOUR INSTRUCTOR</h2>

        <div class="instructor-card">
            <div class="instructor-img-wrap">
                <img src="{{ asset('images/Instructor.webp') }}" alt="Instructor" loading="lazy" decoding="async"
                    width="140" height="140">
            </div>
            <div class="instructor-info">
                <div class="instructor-name">OBADA</div>
                <div class="instructor-bio">
                    Obada is an Arabic language teacher from Gaza, specializing in teaching Arabic to non-native
                    speakers in a simple and practical way. With over 500 students taught worldwide and 180,000+
                    followers on social media, he has helped thousands learn to read, write, and speak Arabic
                    naturally. His teaching style focuses on real-life examples and everyday phrases, making Arabic
                    accessible, enjoyable, and useful from day one. A portion of this course's proceeds goes
                    directly to supporting families in need in Gaza.
                </div>
            </div>
        </div>
    </div>
</section>

{{-- TESTIMONIALS --}}
<section class="testimonials-section fade-up">
    <div class="container">
        <h2 class="section-title">STUDENT REVIEWS</h2>

        <div class="testimonials-grid">
            @foreach([
            ['Michael, New York', 'Investor', 'Focusing on letter pronunciation from day one made everything click.
            Within weeks I was greeting my Arab colleagues with confidence.', 'ب', 'review-michael.webp'],
            ['Sarah, London', 'Marketing Professional', 'Obada\'s style made learning Arabic actually enjoyable. Now I
            hold real conversations with my clients in Dubai and Riyadh.', 'س', 'review-sarah.webp'],
            ['David, Los Angeles', 'Entrepreneur', 'I learned everyday phrases faster than I expected. And knowing part
            of the proceeds supports Gaza made enrolling even more meaningful.', 'ع', 'review-david.webp'],
            ['Joanna, Boston', 'Student', 'I never expected to read and write Arabic letters this quickly. The course
            and book together make learning feel effortless.', 'ن', 'review-joanna.webp'],
            ['Henry, Manchester', 'Teacher', 'The focus on real daily sentences is what sets this apart. I finally feel
            confident speaking with my Arab friends.', 'خ', 'review-henry.webp'],
            ] as [$name, $role, $text, $letter, $photo])
            <div class="testimonial-card" data-ar-letter="{{ $letter }}">
                {{-- Place photo in: public/images/reviews/{{ $photo }} --}}
                <img class="t-avatar" src="{{ asset('images/reviews/' . $photo) }}" onerror="this.style.display='none'"
                    alt="{{ $name }}" loading="lazy" decoding="async" width="54" height="54">
                <div class="stars">★★★★★</div>
                <p class="t-text">"{{ $text }}"</p>
                <div class="t-author">{{ $name }}</div>
                <div class="t-role">{{ $role }}</div>
            </div>
            @endforeach

            {{-- Last testimonial — place photo in: public/images/reviews/review-emma.jpg --}}
            <div class="testimonial-card" data-ar-letter="ر">
                <img class="t-avatar" src="{{ asset('images/reviews/review-emma.webp') }}"
                    onerror="this.style.display='none'" alt="Emma, San Francisco" loading="lazy" decoding="async"
                    width="54" height="54">
                <div class="stars">★★★★★</div>
                <p class="t-text">"Learning Arabic was a beautiful experience, and what touched me the most was knowing
                    that I was also supporting the children of Gaza. It made every lesson feel more meaningful."</p>
                <div class="t-author">Emma, San Francisco</div>
                <div class="t-role">Software Engineer</div>
            </div>
        </div>
    </div>
</section>

{{-- INSTAGRAM --}}
<section class="instagram-section fade-up">
    <div class="container">
        <h2 class="section-title">FOLLOW ON INSTAGRAM</h2>

        <div class="instagram-stats">
            <div class="instagram-stat">
                <span class="instagram-stat-num">180K+</span>
                <span class="instagram-stat-label">Followers</span>
            </div>
            <div class="instagram-stat">
                <span class="instagram-stat-num">500+</span>
                <span class="instagram-stat-label">Posts</span>
            </div>
            <div class="instagram-stat">
                <span class="instagram-stat-num">Daily</span>
                <span class="instagram-stat-label">New Content</span>
            </div>
        </div>

        <span class="instagram-handle">@arabic_with_obada</span>
        <p class="instagram-sub">FREE Arabic lessons & tips every day</p>

        {{-- TODO: Replace the URL below with your Instagram profile URL --}}
        <a href="https://www.instagram.com/arabic_with_obada" target="_blank" rel="noopener noreferrer"
            class="instagram-btn">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
            </svg>
            FOLLOW @arabic_with_obada
        </a>
    </div>
</section>

{{-- PRICING --}}
<section class="pricing-section fade-up">
    <div class="container">
        <h2 class="section-title">COURSE PRICING</h2>

        <div class="price-box">
            <div class="price-old">Original Price: $49</div>
            <div class="price-amount">$49</div>
            <div class="price-period">ONE-TIME PAYMENT · LIFETIME ACCESS</div>

            <ul class="price-features">
                <li>11 complete learning modules</li>
                <li>All PDF files — downloadable & printable</li>
                <li>Instant access after payment</li>
                <li>Free content updates</li>
                <li>Email support included</li>
            </ul>

            <a href="{{ route('checkout') }}" class="btn-main"
                style="width: 100%; display: block; text-align: center; clip-path: none; border-radius: 2px;">
                BUY NOW — $49
            </a>
        </div>
    </div>
</section>

{{-- FAQ --}}
<section class="faq-section fade-up">
    <div class="container">
        <h2 class="section-title">FREQUENTLY ASKED QUESTIONS</h2>

        <div class="faq-list">
            @foreach([
            [
            'Is this course suitable for someone with no background in Arabic?',
            'Yes, the course is designed for complete beginners. It starts from the very basics — teaching you the
            letters and how to pronounce them correctly.'
            ],
            [
            'How long does it take to complete the course?',
            'You can complete the course in a short time. The main video is one hour long, and the accompanying book
            helps you practice further. You can learn at your own pace, as all materials are always available.'
            ],
            [
            'Does the course focus on practical speaking or just grammar?',
            'Alongside teaching the letters and basic grammar, the course focuses on sentences and phrases used in
            everyday life. The goal is to help you speak confidently in real-life situations.'
            ],
            [
            'How does my enrollment help others?',
            'A portion of the course proceeds goes directly to supporting families in need in Gaza — meaning your
            enrollment is not only an investment in yourself, but also a contribution to a humanitarian cause.'
            ],
            ] as [$q, $a])
            <div class="faq-item">
                <div class="faq-q">
                    {{ $q }}
                    <i class="faq-arrow">▾</i>
                </div>
                <div class="faq-a">
                    {{ $a }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- FINAL CTA --}}
<section class="final-cta" id="impact">
    <div class="container" style="position: relative; z-index: 2;">
        <div class="ornament"><span class="ornament-symbol">❖</span></div>
        <h2 class="section-title">READY TO START YOUR<br><span style="color:var(--gold)">Arabic JOURNEY?</span></h2>
        <p style="color:var(--text-muted); font-size:0.9rem; margin-bottom:36px; letter-spacing:1px;">JOIN 500+ STUDENTS
            WHO ALREADY STARTED</p>
        <a href="{{ route('checkout') }}" class="btn-main">START NOW — $49</a>
    </div>
</section>

{{-- FOOTER --}}
<footer>
    <img src="{{ asset('images/logo-p.webp') }}" alt="Obada-Ar" class="footer-logo-img" loading="lazy" width="53"
        height="70">
    <span class="footer-logo">Obada-Ar</span>
    <p class="footer-copy">© {{ date('Y') }} ALL RIGHTS RESERVED</p>
</footer>

@endsection

@section('scripts')
<script>
    // FAQ
    document.querySelectorAll('.faq-q').forEach(q => {
        q.addEventListener('click', () => {
            const item = q.parentElement;
            document.querySelectorAll('.faq-item').forEach(i => {
                if (i !== item) i.classList.remove('open');
            });
            item.classList.toggle('open');
        });
    });

    // Scroll reveal
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((e, i) => {
            if (e.isIntersecting) {
                setTimeout(() => e.target.classList.add('visible'), i * 80);
                observer.unobserve(e.target);
            }
        });
    }, { threshold: 0.08 });
    document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
</script>
@endsection