@extends('layouts.app')

@section('title', 'ArabicPro — Learn Arabic From Zero')

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

    /* ── ARABIC LETTER DECORATIONS ── */
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

    /* ── NAVBAR ── */
    .navbar {
        background: rgba(8, 8, 8, 0.96);
        border-bottom: 1px solid rgba(212, 175, 55, 0.3);
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
        font-size: 1.4rem;
        font-weight: 900;
        color: var(--gold);
        letter-spacing: 2px;
    }

    .logo-gaz {
        font-family: 'Cinzel', serif;
        font-size: 0.8rem;
        font-weight: 900;
        color: var(--gold);
        letter-spacing: 2px;
        direction: ltr;
        unicode-bidi: embed;
    }

    .logo-ar {
        font-family: 'Amiri', serif;
        font-size: 1.1rem;
        color: rgba(212, 175, 55, 0.5);
        letter-spacing: 0;
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
        background:
            radial-gradient(ellipse 80% 60% at 50% 0%, rgba(212, 175, 55, 0.07) 0%, transparent 70%),
            var(--bg);
    }

    .hero-ar-left {
        font-family: 'Amiri', serif;
        position: absolute;
        left: -40px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20rem;
        color: var(--gold);
        opacity: 0.04;
        font-weight: 700;
        pointer-events: none;
        writing-mode: vertical-rl;
        letter-spacing: -10px;
    }

    .hero-ar-right {
        font-family: 'Amiri', serif;
        position: absolute;
        right: -40px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20rem;
        color: var(--gold);
        opacity: 0.04;
        font-weight: 700;
        pointer-events: none;
        writing-mode: vertical-rl;
        letter-spacing: -10px;
    }

    .hero-inner {
        position: relative;
        z-index: 1;
        max-width: 800px;
    }

    .hero-eyebrow {
        font-family: 'Amiri', serif;
        color: var(--gold);
        font-size: 1.3rem;
        letter-spacing: 2px;
        margin-bottom: 8px;
        display: block;
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
        margin-bottom: 10px;
        color: var(--text);
        letter-spacing: -1px;
    }

    .hero h1 .gold-text {
        color: var(--gold);
        font-style: italic;
    }

    .hero-arabic-title {
        font-family: 'Amiri', serif;
        font-size: clamp(1.4rem, 4vw, 2.2rem);
        color: rgba(212, 175, 55, 0.6);
        margin-bottom: 24px;
        font-weight: 400;
    }

    .hero-sub {
        font-size: 1.1rem;
        color: #9a9080;
        max-width: 560px;
        margin: 0 auto 40px;
        font-weight: 300;
        letter-spacing: 0.5px;
    }

    /* Instructor image with Arabic frame */
    .instructor-frame {
        position: relative;
        width: 300px;
        height: 300px;
        margin: 0 auto 40px;
    }

    .instructor-frame::before {
        content: 'ع';
        font-family: 'Amiri', serif;
        position: absolute;
        inset: -20px;
        font-size: 14rem;
        color: var(--gold);
        opacity: 0.07;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: none;
    }

    .instructor-frame img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid var(--gold);
        position: relative;
        z-index: 1;
        box-shadow: 0 0 40px rgba(212, 175, 55, 0.15), 0 0 80px rgba(212, 175, 55, 0.05);
    }

    /* Rotating border */
    .instructor-frame::after {
        content: '';
        position: absolute;
        inset: -8px;
        border-radius: 50%;
        border: 1px dashed rgba(212, 175, 55, 0.3);
        animation: spin-slow 20s linear infinite;
        z-index: 0;
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

    .btn-main-ar {
        font-family: 'Amiri', serif;
        font-size: 0.8rem;
        display: block;
        color: rgba(0, 0, 0, 0.6);
        letter-spacing: 0;
        margin-top: 2px;
        font-weight: 400;
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

    .section-label {
        font-family: 'Amiri', serif;
        color: var(--gold);
        font-size: 1rem;
        text-align: center;
        letter-spacing: 3px;
        display: block;
        margin-bottom: 6px;
    }

    .section-title {
        font-family: 'Cinzel', serif;
        font-size: clamp(1.6rem, 4vw, 2.4rem);
        font-weight: 900;
        text-align: center;
        margin-bottom: 4px;
        letter-spacing: 1px;
    }

    .section-title-ar {
        font-family: 'Amiri', serif;
        font-size: 1.3rem;
        color: rgba(212, 175, 55, 0.5);
        text-align: center;
        margin-bottom: 40px;
        direction: rtl;
    }

    .container {
        max-width: 960px;
        margin: 0 auto;
    }

    /* ── WHAT YOU LEARN ── */
    /* .learn-section {
        background: var(--bg2);
    }

    .learn-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 16px;
    }

    .learn-item {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 18px 20px;
        background: var(--bg3);
        border: 1px solid var(--border);
        border-right: 3px solid var(--gold);
        transition: all 0.3s;
    }

    .learn-item:hover {
        background: var(--bg4);
        border-color: rgba(212, 175, 55, 0.5);
        transform: translateX(-4px);
    }

    .learn-num {
        font-family: 'Amiri', serif;
        color: var(--gold);
        font-size: 1.8rem;
        font-weight: 700;
        line-height: 1;
        flex-shrink: 0;
        min-width: 32px;
    }

    .learn-text {
        font-size: 0.95rem;
        color: #c8bfaa;
        padding-top: 4px;
        font-weight: 300;
        letter-spacing: 0.3px;
    } */

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
        direction: ltr;
        unicode-bidi: embed;
    }

    .learn-card-title {
        font-family: 'Cinzel', serif;
        font-size: 1rem;
        font-weight: 700;
        letter-spacing: 1px;
        color: var(--gold);
        margin-bottom: 12px;
        direction: ltr;
        unicode-bidi: embed;
    }

    .learn-card-title-ar {
        font-family: 'Amiri', serif;
        font-size: 0.85rem;
        color: rgba(212, 175, 55, 0.4);
        display: block;
        margin-bottom: 14px;
        direction: rtl;
    }

    .learn-card-text {
        font-size: 0.9rem;
        color: #9a9080;
        font-weight: 300;
        line-height: 1.9;
        direction: ltr;
        unicode-bidi: embed;
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

    .module-ar-num {
        font-family: 'Amiri', serif;
        color: var(--gold);
        font-size: 2rem;
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
        margin-bottom: 2px;
    }

    .module-sub {
        font-family: 'Amiri', serif;
        font-size: 0.9rem;
        color: rgba(212, 175, 55, 0.5);
        direction: rtl;
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

    .instructor-bg-ar {
        position: absolute;
        font-family: 'Amiri', serif;
        font-size: 30rem;
        color: var(--gold);
        opacity: 0.02;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        pointer-events: none;
        white-space: nowrap;
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
        margin-bottom: 4px;
        letter-spacing: 1px;
    }

    .instructor-title-ar {
        font-family: 'Amiri', serif;
        color: var(--gold);
        font-size: 1.1rem;
        margin-bottom: 12px;
        direction: rtl;
    }

    .instructor-bio {
        color: #8a8070;
        font-size: 0.95rem;
        font-weight: 300;
        line-height: 1.8;
        direction: ltr;
        unicode-bidi: embed;
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
        direction: ltr;
        unicode-bidi: embed;
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

    .price-label-ar {
        font-family: 'Amiri', serif;
        color: var(--text-muted);
        font-size: 1rem;
        direction: rtl;
        margin-bottom: 8px;
    }

    .price-old {
        color: var(--text-muted);
        text-decoration: line-through;
        font-size: 1rem;
        letter-spacing: 1px;
        margin-bottom: 4px;
    }

    .price-amount {
        font-family: 'Cinzel', serif;
        font-size: 4rem;
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
        text-align: right;
        direction: rtl;
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

    .guarantee-text {
        margin-top: 20px;
        font-family: 'Amiri', serif;
        color: var(--text-muted);
        font-size: 0.9rem;
        direction: rtl;
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
        direction: ltr;
        unicode-bidi: embed;
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
        direction: ltr;
        unicode-bidi: embed;
    }

    .faq-a-ar {
        font-family: 'Amiri', serif;
        font-size: 0.9rem;
        color: rgba(212, 175, 55, 0.4);
        direction: rtl;
        display: block;
        margin-top: 4px;
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
        background:
            radial-gradient(ellipse 80% 50% at 50% 100%, rgba(212, 175, 55, 0.07) 0%, transparent 70%),
            var(--bg2);
        text-align: center;
        padding: 100px 24px;
        overflow: hidden;
        position: relative;
    }

    .final-cta-ar {
        font-family: 'Amiri', serif;
        position: absolute;
        bottom: -60px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 22rem;
        color: var(--gold);
        opacity: 0.025;
        white-space: nowrap;
        pointer-events: none;
    }

    .final-cta h2 {
        font-family: 'Cinzel', serif;
        font-size: clamp(1.8rem, 5vw, 3rem);
        font-weight: 900;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    .final-cta-subtitle {
        font-family: 'Amiri', serif;
        font-size: 1.4rem;
        color: rgba(212, 175, 55, 0.5);
        margin-bottom: 40px;
        direction: rtl;
    }

    /* ── FOOTER ── */
    footer {
        background: #000;
        border-top: 1px solid rgba(212, 175, 55, 0.2);
        padding: 40px 24px;
        text-align: center;
    }

    .footer-logo {
        font-family: 'Cinzel', serif;
        font-size: 1.6rem;
        font-weight: 900;
        color: var(--gold);
        letter-spacing: 4px;
        display: block;
        margin-bottom: 4px;
    }

    .footer-logo-ar {
        font-family: 'Amiri', serif;
        font-size: 1rem;
        color: rgba(212, 175, 55, 0.3);
        display: block;
        margin-bottom: 16px;
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
</style>
@endsection

@section('content')

<div class="geo-bg"></div>

{{-- NAVBAR --}}
<nav class="navbar">
    <a href="#" class="nav-cta">ENROLL NOW</a>
    <div class="logo">
        {{-- <span class="logo-gaz">10% of the price of this course will be dedicated to supporting families in need in
            Gaza</span> --}}
        <span class="logo-gaz">10% of proceeds support Gaza’s children</span>
        {{-- <span class="logo-ar">إنجليش برو</span> --}}
    </div>

    <div class="logo">
        <span class="logo-en">Arabic PRO</span>
        {{-- <span class="logo-ar">إنجليش برو</span> --}}
    </div>
</nav>

{{-- HERO --}}
<section class="hero">
    <div class="hero-ar-left">أب ج</div>
    <div class="hero-ar-right">١٢٣</div>

    <div class="hero-inner">
        <span class="hero-eyebrow">بسم الله الرحمن الرحيم</span>

        <div class="hero-tag">COMPLETE BEGINNER'S COURSE</div>

        <h1>Master <span class="gold-text">Arabic</span><br>From Zero</h1>
        <div class="hero-arabic-title">تعلّم العربية من الصفر</div>

        <p class="hero-sub">Letters · Numbers · Daily Conversations · Pronunciation<br>Everything you need to speak with
            confidence</p>

        <div class="instructor-frame">
            <img src="{{ asset('images/instructor.png') }}" alt="Instructor">
        </div>

        <div class="hero-stats">
            <div class="hero-stat">
                <span class="hero-stat-num">500+</span>
                <span class="hero-stat-label">Students</span>
            </div>
            <div class="hero-stat">
                <span class="hero-stat-num">4.9 ★</span>
                <span class="hero-stat-label">Rating</span>
            </div>
            <div class="hero-stat">
                <span class="hero-stat-num">11</span>
                <span class="hero-stat-label">Modules</span>
            </div>
            <div class="hero-stat">
                <span class="hero-stat-num">PDF</span>
                <span class="hero-stat-label">Instant Access</span>
            </div>
        </div>

        <div class="ornament">
            <span class="ornament-symbol">❖</span>
        </div>

        <a href="#" class="btn-main">
            ENROLL NOW
            <span class="btn-main-ar">سجّل الآن</span>
        </a>
        <p class="btn-sub">✦ INSTANT ACCESS AFTER PAYMENT ✦</p>
    </div>
</section>

{{-- WHAT YOU LEARN --}}
{{-- <section class="learn-section fade-up">
    <div class="container">
        <span class="section-label">ماذا ستتعلم</span>
        <h2 class="section-title">WHAT YOU WILL LEARN</h2>
        <div class="section-title-ar">محتوى الكورس الشامل</div>

        <div class="learn-grid">
            @foreach([
            ['١', 'The Alphabet A–Z with correct pronunciation'],
            ['٢', 'Numbers from 1 to 1,000 in Arabic'],
            ['٣', 'Greetings & everyday expressions'],
            ['٤', 'Introducing yourself confidently'],
            ['٥', 'Colors, shapes & common objects'],
            ['٦', 'Essential daily action verbs'],
            ['٧', 'Conversations at restaurants & shops'],
            ['٨', 'Travel & airport phrases'],
            ['٩', 'Common questions & how to answer'],
            ['١٠', 'Basic grammar for beginners'],
            ['١١', 'Interactive practice exercises'],
            ['١٢', 'Full review & final assessment'],
            ] as [$num, $item])
            <div class="learn-item">
                <span class="learn-num">{{ $num }}</span>
                <span class="learn-text">{{ $item }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section> --}}

{{-- WHAT YOU LEARN --}}
<section class="learn-section fade-up">
    <div class="container">
        <span class="section-label">ماذا ستتعلم</span>
        <h2 class="section-title">WHAT YOU WILL LEARN</h2>
        <div class="section-title-ar">محتوى الكورس الشامل</div>

        <div class="learn-grid">

            <div class="learn-card" data-ar="ح">
                <span class="learn-card-icon">🔤</span>
                <div class="learn-card-title">COMPLETE ARABIC LETTER FOUNDATIONS</div>
                <span class="learn-card-title-ar">تعليم شامل للحروف العربية</span>
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
                <span class="learn-card-title-ar">التواصل العملي اليومي</span>
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
                <span class="learn-card-title-ar">محتوى متنوع ومرن</span>
                <div class="learn-card-divider"></div>
                <p class="learn-card-text">
                    The course includes a comprehensive PDF book and a one-hour video where Abada walks you through
                    every part step by step. You can follow the lessons whenever it suits your schedule — no fixed
                    timing required.
                </p>
            </div>

            <div class="learn-card" data-ar="د">
                <span class="learn-card-icon">🤝</span>
                <div class="learn-card-title">A PURCHASE THAT GIVES BACK</div>
                <span class="learn-card-title-ar">دعم إنساني من كل اشتراك</span>
                <div class="learn-card-divider"></div>
                <p class="learn-card-text">
                    Abada dedicates a portion of the course proceeds to supporting families in need in Gaza. When you
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
        <span class="section-label">المنهج الدراسي</span>
        <h2 class="section-title">COURSE CURRICULUM</h2>
        <div class="section-title-ar">١٢ وحدة مرتبة من السهل للمتقدم</div>

        <div class="module-list">
            @foreach([
            ['١', 'Unit One', 'The Arabic Alphabet', 'حروف الأبجدية', '3 PDFs'],
            ['٢', 'Unit Two', 'Daily Expressions', 'العبارات اليومية', '2 PDFs'],
            ['٣', 'Unit Three', 'Days of the Week', 'أيام الأسبوع', '2 PDFs'],
            ['٤', 'Unit Four', 'Numbers & Counting', 'الأرقام والعدّ', '3 PDFs'],
            ['٥', 'Unit Five', 'Telling the Time', 'السؤال عن الوقت', '2 PDFs'],
            ['٦', 'Unit Six', 'At the Market', 'في السوق', '3 PDFs'],
            ['٧', 'Unit Seven', 'Time & Place', 'الوقت والمكان', '3 PDFs'],
            ['٨', 'Unit Eight', 'Family Vocabulary', 'مفردات العائلة', '2 PDFs'],
            ['٩', 'Unit Nine', 'Colors & Descriptions', 'الألوان والأوصاف', '3 PDFs'],
            ['١٠','Unit Ten', 'Around the House', 'مفردات المنزل', '2 PDFs'],
            ['١١','Unit Eleven','Food & Meals', 'الطعام والوجبات', '4 PDFs'],
            ] as [$num, $en_unit, $title, $title_ar, $count])
            <div class="module-item">
                <div class="module-ar-num">{{ $num }}</div>
                <div class="module-divider"></div>
                <div class="module-info">
                    <div class="module-title">{{ $title }}</div>
                    <div class="module-sub">{{ $title_ar }}</div>
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
    <p style="font-family:'Amiri',serif; color:var(--text-muted); font-size:1.1rem; margin-bottom:24px; direction:rtl;">
        لا تؤجّل تعلّمك — ابدأ اليوم
    </p>
    <a href="#" class="btn-main">
        SECURE YOUR SPOT
        <span class="btn-main-ar">احجز مقعدك الآن</span>
    </a>
</section>

{{-- INSTRUCTOR --}}
<section class="instructor-section fade-up">
    <div class="instructor-bg-ar">المعلّم</div>
    <div class="container">
        <span class="section-label">المدرب</span>
        <h2 class="section-title">YOUR INSTRUCTOR</h2>
        <div class="section-title-ar">تعرّف على مدرّبك</div>

        <div class="instructor-card">
            <div class="instructor-img-wrap">
                <img src="{{ asset('images/instructor.png') }}" alt="Instructor">
            </div>
            <div class="instructor-info">
                <div class="instructor-name">OBADA</div>
                <div class="instructor-title-ar">متخصص في تعليم اللغة العربية للناطقين بالإنجليزية</div>
                <div class="instructor-bio">
                    Obada is an Arabic language teacher from Gaza, specializing in teaching Arabic to non-native
                    speakers in a simple and
                    practical way. With over 200 students taught worldwide and 170,000+ followers on social media, he
                    has helped thousands
                    learn to read, write, and speak Arabic naturally. His teaching style focuses on real-life examples
                    and everyday phrases,
                    making Arabic accessible, enjoyable, and useful from day one. A portion of this course's proceeds
                    goes directly to
                    supporting families in need in Gaza.
                </div>
            </div>
        </div>
    </div>
</section>

{{-- TESTIMONIALS --}}
<section class="testimonials-section fade-up">
    <div class="container">
        <span class="section-label">آراء الطلاب</span>
        <h2 class="section-title">STUDENT REVIEWS</h2>
        <div class="section-title-ar">ما قاله طلابنا</div>

        <div class="testimonials-grid">
            @foreach([
            ['Michael, New York', 'Investor', 'Focusing on letter pronunciation from day one made everything click.
            Within weeks I was greeting my Arab colleagues with
            confidence.', 'ب'],
            ['Sarah, London', 'Marketing Professional', 'Abada\'s style made learning Arabic actually enjoyable. Now I
            hold real
            conversations with my clients in Dubai and Riyadh.', 'س'],
            ['David, Los Angeles', 'Entrepreneur', 'I learned everyday phrases faster than I expected. And knowing part
            of the proceeds supports Gaza made enrolling even
            more meaningful.', 'ع'],
            ['Joanna, Boston', 'Student', 'I never expected to read and write Arabic letters this quickly. The course
            and book together make learning feel
            effortless.', 'ن'],
            ['Henry, Manchester', 'Teacher', 'The focus on real daily sentences is what sets this apart. I finally feel
            confident speaking with my Arab friends.', 'خ'],
            ['Emma, San Francisco', 'Software Engineer', 'Abada\'s approach to letter pronunciation is brilliantly
            simple. The one-hour video alone gives you a rock-solid
            foundation.', 'ر'],
            ] as [$name, $role, $text, $letter])
            <div class="testimonial-card" data-ar-letter="{{ $letter }}">
                <div class="stars">★★★★★</div>
                <p class="t-text">"{{ $text }}"</p>
                <div class="t-author">{{ $name }}</div>
                <div class="t-role">{{ $role }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- PRICING --}}
<section class="pricing-section fade-up">
    <div class="container">
        <span class="section-label">السعر</span>
        <h2 class="section-title">COURSE PRICING</h2>
        <div class="section-title-ar">استثمر في نفسك اليوم</div>

        <div class="price-box">
            <div class="price-label-ar">عرض محدود — لا تفوّته</div>
            <div class="price-old">Original Price: $99</div>
            <div class="price-amount">$49</div>
            <div class="price-period">ONE-TIME PAYMENT · LIFETIME ACCESS</div>

            <ul class="price-features">
                <li>12 complete learning modules</li>
                <li>All PDF files — downloadable & printable</li>
                <li>Instant access after payment</li>
                <li>Free content updates</li>
                <li>Email support included</li>
            </ul>

            <a href="#" class="btn-main"
                style="width: 100%; display: block; text-align: center; clip-path: none; border-radius: 2px;">
                BUY NOW — $49
                <span class="btn-main-ar">اشتري الآن بـ ٤٩ دولار</span>
            </a>

            <p class="guarantee-text">🛡 ضمان استعادة المبلغ كاملاً خلال ٧ أيام إذا لم تكن راضياً</p>
        </div>
    </div>
</section>

{{-- FAQ --}}
<section class="faq-section fade-up">
    <div class="container">
        <span class="section-label">أسئلة شائعة</span>
        <h2 class="section-title">FREQUENTLY ASKED QUESTIONS</h2>
        <div class="section-title-ar">إجابات على أسئلتك</div>

        <div class="faq-list">
            @foreach([
            [
            'Is this course suitable for someone with no background in Arabic?',
            'Yes, the course is designed for complete beginners. It starts from the very basics — teaching you the
            letters and how to
            pronounce them correctly.',
            'نعم، الكورس مصمم للمبتدئين تمامًا، ويبدأ معك من تعليم الحروف وكيفية نطقها بشكل صحيح'
            ],
            [
            'How long does it take to complete the course?',
            'You can complete the course in a short time. The main video is one hour long, and the accompanying book
            helps you
            practice further. You can learn at your own pace, as all materials are always available.',
            'يمكنك إكمال الكورس في وقت قصير؛ الفيديو الأساسي مدته ساعة، والكتاب المرافق يساعدك على الممارسة. يمكنك
            التعلم وفق جدولك
            الشخصي، فالمواد متاحة دائمًا.'
            ],
            [
            'Does the course focus on practical speaking or just grammar?',
            'Alongside teaching the letters and basic grammar, the course focuses on sentences and phrases used in
            everyday life. The
            goal is to help you speak confidently in real-life situations.',
            'إلى جانب تعليم الحروف والنحو الأساسي، يركز الكورس على الجمل والعبارات المستخدمة يوميًا . الهدف أن تتمكن من
            التحدث بثقة
            في مواقف الحياة المختلفة.'
            ],
            [
            'How does my enrollment help others?',
            'A portion of the course proceeds goes directly to supporting families in need in Gaza — meaning your
            enrollment is not
            only an investment in yourself, but also a contribution to a humanitarian cause.',
            'جزء من أرباح الكورس يذهب لدعم العائلات المحتاجة في غزة، مما يعني أن اشتراكك ليس استثمارًا في نفسك فقط، بل
            مساهمة في عمل
            إنساني أيضًا.'
            ],
            ] as [$q, $a, $a_ar])
            <div class="faq-item">
                <div class="faq-q">
                    {{ $q }}
                    <i class="faq-arrow">▾</i>
                </div>
                <div class="faq-a">
                    {{ $a }}
                    <span class="faq-a-ar">{{ $a_ar }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- FINAL CTA --}}
<section class="final-cta">
    <div class="final-cta-ar">ابدأ رحلتك</div>
    <div class="container" style="position: relative; z-index:1;">
        <div class="ornament"><span class="ornament-symbol">❖</span></div>
        <h2 class="section-title">READY TO START YOUR<br><span style="color:var(--gold)">Arabic JOURNEY?</span></h2>
        <p class="final-cta-subtitle">جاهز تبدأ رحلتك مع العربية؟</p>
        <p style="color:var(--text-muted); font-size:0.9rem; margin-bottom:36px; letter-spacing:1px;">JOIN 500+ STUDENTS
            WHO ALREADY STARTED</p>
        <a href="#" class="btn-main">
            START NOW — $49
            <span class="btn-main-ar">ابدأ الآن</span>
        </a>
    </div>
</section>

{{-- FOOTER --}}
<footer>
    <span class="footer-logo">Arabic PRO</span>
    <span class="footer-logo-ar">تعلّم بثقة</span>
    <p class="footer-copy">© {{ date('Y') }} ALL RIGHTS RESERVED ✦ جميع الحقوق محفوظة</p>
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
