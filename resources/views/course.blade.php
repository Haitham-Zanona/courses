@extends('layouts.app')

@section('title', 'My Course — Obada-Ar')

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
    }

    html,
    body {
        font-family: 'Lato', sans-serif;
        background: #080808 !important;
        color: #F0EAD6 !important;
        direction: ltr;
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
    }

    /* Geo bg */
    .geo-bg {
        position: fixed;
        inset: 0;
        pointer-events: none;
        z-index: 0;
        opacity: 0.035;

        background-image:
            /* خطوط أفقية */
            repeating-linear-gradient(0deg,
                var(--gold) 0px,
                transparent 1px,
                transparent 60px),

            /* خطوط عمودية */
            repeating-linear-gradient(90deg,
                var(--gold) 0px,
                transparent 1px,
                transparent 60px),

            /* خطوط مائلة 45° */
            repeating-linear-gradient(45deg,
                var(--gold) 0px,
                transparent 1px,
                transparent 85px),

            /* خطوط مائلة -45° */
            repeating-linear-gradient(-45deg,
                var(--gold) 0px,
                transparent 1px,
                transparent 85px);
    }

    /* Navbar */
    .navbar {
        background: rgba(8, 8, 8, 0.97);
        border-bottom: 1px solid rgba(212, 175, 55, 0.25);
        padding: 14px 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 100;
        backdrop-filter: blur(10px);
    }

    .logo-en {
        font-family: 'Cinzel', serif;
        font-size: 1.2rem;
        font-weight: 900;
        color: var(--gold);
        letter-spacing: 2px;
    }

    .nav-right {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .nav-student {
        font-size: 0.8rem;
        color: var(--text-muted);
        letter-spacing: 1px;
    }

    .nav-student span {
        color: var(--gold);
    }

    .btn-logout {
        font-family: 'Cinzel', serif;
        font-size: 0.7rem;
        letter-spacing: 2px;
        color: var(--text-muted);
        border: 1px solid var(--border);
        padding: 6px 14px;
        background: none;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-logout:hover {
        color: var(--gold);
        border-color: var(--gold);
    }

    /* Page content */
    .page-wrap {
        max-width: 960px;
        margin: 0 auto;
        padding: 50px 24px 80px;
        position: relative;
        z-index: 1;
    }

    /* Welcome bar */
    .welcome-bar {
        border: 1px solid rgba(212, 175, 55, 0.2);
        background: rgba(212, 175, 55, 0.03);
        padding: 20px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 40px;
    }

    .welcome-text {
        font-family: 'Cinzel', serif;
        font-size: 0.85rem;
        letter-spacing: 1px;
    }

    .welcome-text span {
        color: var(--gold);
    }

    .welcome-ar {
        font-family: 'Amiri', serif;
        color: rgba(212, 175, 55, 0.4);
        font-size: 0.9rem;
        direction: rtl;
    }

    /* Section title */
    .section-label {
        font-family: 'Amiri', serif;
        color: var(--gold);
        font-size: 1rem;
        display: block;
        margin-bottom: 4px;
    }

    .section-title {
        font-family: 'Cinzel', serif;
        font-size: 1.6rem;
        font-weight: 900;
        letter-spacing: 1px;
        margin-bottom: 4px;
    }

    .section-title-ar {
        font-family: 'Amiri', serif;
        color: rgba(212, 175, 55, 0.4);
        font-size: 1rem;
        direction: rtl;
        margin-bottom: 28px;
        display: block;
    }

    /* Video box */
    .video-wrap {
        background: #000;
        border: 1px solid rgba(212, 175, 55, 0.3);
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
    }

    .video-wrap::before {
        content: '';
        display: block;
        padding-top: 56.25%;
        /* 16:9 */
    }

    .video-wrap iframe,
    .video-wrap video {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        border: none;
    }

    /* Ornament */
    .ornament {
        display: flex;
        align-items: center;
        gap: 16px;
        margin: 32px 0;
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
        font-size: 1.1rem;
    }

    /* PDF download */
    .pdf-box {
        background: var(--bg3);
        border: 1px solid var(--border);
        border-right: 3px solid var(--gold);
        padding: 24px 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 40px;
    }

    .pdf-info {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .pdf-icon {
        font-size: 2.2rem;
        flex-shrink: 0;
    }

    .pdf-title {
        font-family: 'Cinzel', serif;
        font-size: 0.95rem;
        font-weight: 700;
        margin-bottom: 2px;
    }

    .pdf-sub {
        font-size: 0.8rem;
        color: var(--text-muted);
    }

    .btn-download {
        font-family: 'Cinzel', serif;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 2px;
        color: #000;
        background: linear-gradient(135deg, var(--gold-light), var(--gold));
        padding: 10px 24px;
        text-decoration: none;
        transition: all 0.3s;
        white-space: nowrap;
    }

    .btn-download:hover {
        background: linear-gradient(135deg, #fff, var(--gold-light));
        transform: translateY(-1px);
    }

    /* Topics grid */
    .topics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 12px;
    }

    .topic-item {
        background: var(--bg3);
        border: 1px solid var(--border);
        padding: 14px 18px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 0.88rem;
        color: #c8bfaa;
        transition: border-color 0.3s;
    }

    .topic-item:hover {
        border-color: rgba(212, 175, 55, 0.3);
    }

    .topic-num {
        font-family: 'Amiri', serif;
        color: var(--gold);
        font-size: 1.3rem;
        font-weight: 700;
        flex-shrink: 0;
        min-width: 24px;
    }

    /* Gaza note */
    .gaza-note {
        margin-top: 40px;
        padding: 20px 24px;
        border: 1px solid rgba(212, 175, 55, 0.15);
        background: rgba(212, 175, 55, 0.02);
        text-align: center;
    }

    .gaza-note p {
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .gaza-note strong {
        color: var(--gold);
    }

    .gaza-note .ar {
        font-family: 'Amiri', serif;
        color: rgba(212, 175, 55, 0.3);
        font-size: 0.9rem;
        display: block;
        margin-top: 4px;
        direction: rtl;
    }
</style>
@endsection

@section('content')
<div class="geo-bg"></div>

{{-- Navbar --}}
<nav class="navbar">
    <span class="logo-en"><a href="{{ route('home') }}">Obada-Ar</a></span>
    <div class="nav-right">
        <span class="nav-student">Welcome, <span>{{ $student->name ?? '' }}</span></span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">LOGOUT</button>
        </form>
    </div>
</nav>

<div class="page-wrap">

    {{-- Welcome bar --}}
    <div class="welcome-bar">
        <div>
            <div class="welcome-text">YOUR COURSE IS READY, <span>{{ strtoupper($student->name ?? '') }}</span></div>
            <div class="welcome-ar">كورسك جاهز — ابدأ رحلتك مع العربية</div>
        </div>
        <span style="font-family:'Amiri',serif; color:var(--gold); font-size:1.5rem;">مرحباً</span>
    </div>

    {{-- Video --}}
    <span class="section-label">الدرس الرئيسي</span>
    <h2 class="section-title">COURSE VIDEO</h2>
    <span class="section-title-ar">فيديو الكورس الشامل</span>

    <div class="video-wrap">
        {{--
        ⚠️ استبدل الرابط برابط الفيديو الخاص فيك
        لو Vimeo: src="https://player.vimeo.com/video/YOUR_VIDEO_ID"
        لو YouTube: src="https://www.youtube.com/embed/YOUR_VIDEO_ID"
        لو ملف محلي: <video controls>
            <source src="{{ asset('videos/course.mp4') }}">
        </video>
        --}}
        <iframe src="https://www.youtube.com/embed/YOUR_VIDEO_ID"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope" allowfullscreen>
        </iframe>
    </div>

    {{-- PDF Download --}}
    <div class="ornament"><span>❖</span></div>

    <div class="pdf-box">
        <div class="pdf-info">
            <span class="pdf-icon">📄</span>
            <div>
                <div class="pdf-title">Obada-Ar — COURSE BOOK</div>
                <div class="pdf-sub">Downloadable PDF · Print anytime</div>
            </div>
        </div>
        <a href="{{ asset('files/arabic-pro-course.pdf') }}" download class="btn-download">
            DOWNLOAD PDF →
        </a>
    </div>

    {{-- Topics --}}
    <span class="section-label">محتوى الكورس</span>
    <h2 class="section-title">COURSE TOPICS</h2>
    <span class="section-title-ar">المواضيع اللي هتتعلمها</span>

    <div class="topics-grid">
        @foreach([
        ['١', 'The Arabic Alphabet', 'حروف الأبجدية'],
        ['٢', 'Daily Expressions', 'العبارات اليومية'],
        ['٣', 'Days of the Week', 'أيام الأسبوع'],
        ['٤', 'Numbers & Counting', 'الأرقام والعدّ'],
        ['٥', 'Telling the Time', 'السؤال عن الوقت'],
        ['٦', 'At the Market', 'في السوق'],
        ['٧', 'Time & Place', 'الوقت والمكان'],
        ['٨', 'Family Vocabulary', 'مفردات العائلة'],
        ['٩', 'Colors & Descriptions', 'الألوان والأوصاف'],
        ['١٠','Around the House', 'مفردات المنزل'],
        ['١١','Food & Meals', 'الطعام والوجبات'],
        ] as [$num, $en, $ar])
        <div class="topic-item">
            <span class="topic-num">{{ $num }}</span>
            <div>
                <div style="font-weight:700; font-size:0.85rem;">{{ $en }}</div>
                <div style="font-family:'Amiri',serif; color:rgba(212,175,55,0.4); font-size:0.8rem; direction:rtl;">{{
                    $ar }}</div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Gaza note --}}
    <div class="gaza-note">
        <p>
            <strong>10%</strong> of your payment has been donated to supporting the children of Gaza. Thank you for
            making a difference.
        </p>
        <span class="ar">١٠٪ من دفعتك تذهب لدعم أطفال غزة — شكراً لك</span>
    </div>

</div>
@endsection
