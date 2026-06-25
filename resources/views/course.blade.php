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
        padding-top: 65px;
    }

    .geo-bg {
        position: fixed;
        inset: 0;
        pointer-events: none;
        z-index: 0;
        opacity: 0.035;
        background-image:
            repeating-linear-gradient(0deg, var(--gold) 0px, transparent 1px, transparent 60px),
            repeating-linear-gradient(90deg, var(--gold) 0px, transparent 1px, transparent 60px),
            repeating-linear-gradient(45deg, var(--gold) 0px, transparent 1px, transparent 85px),
            repeating-linear-gradient(-45deg, var(--gold) 0px, transparent 1px, transparent 85px);
    }

    /* Navbar */
    .navbar {
        background: rgba(8, 8, 8, 0.97);
        border-bottom: 1px solid rgba(212, 175, 55, 0.25);
        padding: 14px 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 100;
        backdrop-filter: blur(10px);
    }

    .logo-en {
        font-family: 'Cinzel', serif;
        font-size: 1.4rem;
        font-weight: 900;
        color: var(--gold);
        letter-spacing: 2px;
    }

    .logo-en a {
        color: inherit;
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

    /* Page */
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
        font-size: 0.9rem;
        letter-spacing: 1px;
    }

    .welcome-text span {
        color: var(--gold);
    }

    .welcome-sub {
        font-size: 0.8rem;
        color: var(--text-muted);
        margin-top: 4px;
        letter-spacing: 0.5px;
    }

    /* Section title */
    .section-title {
        font-family: 'Cinzel', serif;
        font-size: 1.6rem;
        font-weight: 900;
        letter-spacing: 1px;
        margin-bottom: 24px;
    }

    /* Video */
    .video-wrap {
        background: #000;
        border: 1px solid rgba(212, 175, 55, 0.3);
        margin-bottom: 40px;
        position: relative;
        width: 100%;
        aspect-ratio: 16 / 9;
        overflow: hidden;
    }

    .video-wrap iframe {
        position: absolute;
        top: 0;
        left: 0;
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

    /* PDF */
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

    /* Topics */
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
        font-family: 'Cinzel', serif;
        color: var(--gold);
        font-size: 1.1rem;
        font-weight: 700;
        flex-shrink: 0;
        min-width: 24px;
    }

    .topic-name {
        font-weight: 700;
        font-size: 0.85rem;
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

    @media (max-width: 768px) {

        html,
        body {
            padding-top: 50px;
        }

        .navbar {
            padding: 10px 14px;
        }

        .logo-en {
            font-size: 1.1rem;
        }

        .nav-student {
            display: none;
        }

        .page-wrap {
            padding: 32px 16px 60px;
        }

        .welcome-bar {
            padding: 16px;
        }

        .welcome-text {
            font-size: 0.78rem;
        }

        .section-title {
            font-size: 1.2rem;
            margin-bottom: 16px;
        }

        .pdf-box {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .btn-download {
            width: 100%;
            text-align: center;
        }

        .topics-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 420px) {
        .topics-grid {
            grid-template-columns: 1fr;
        }

        .logo-en {
            font-size: 0.95rem;
            letter-spacing: 1px;
        }
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
            <div class="welcome-sub">Begin your Arabic journey — all materials are below.</div>
        </div>
        <span style="font-family:'Cinzel',serif; color:var(--gold); font-size:1rem; letter-spacing:2px;">WELCOME</span>
    </div>

    {{-- Video Section --}}
    <h2 class="section-title">COURSE VIDEO</h2>

    <div class="video-wrap">
        {{--
        Google Drive embed — replace GOOGLE_DRIVE_FILE_ID with the actual file ID.
        Get the ID from your Drive share link:
        https://drive.google.com/file/d/GOOGLE_DRIVE_FILE_ID/view
        --}}
        <iframe src="https://drive.google.com/file/d/1ndyxn9cVXwtHlyrKlU6KCXOVdNIIb8s0/preview"
            allow="autoplay" allowfullscreen>
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
    <h2 class="section-title">COURSE TOPICS</h2>

    <div class="topics-grid">
        @foreach([
        ['1', 'The Arabic Alphabet'],
        ['2', 'Daily Expressions'],
        ['3', 'Days of the Week'],
        ['4', 'Numbers & Counting'],
        ['5', 'Telling the Time'],
        ['6', 'At the Market'],
        ['7', 'Time & Place'],
        ['8', 'Family Vocabulary'],
        ['9', 'Colors & Descriptions'],
        ['10', 'Around the House'],
        ['11', 'Food & Meals'],
        ] as [$num, $title])
        <div class="topic-item">
            <span class="topic-num">{{ $num }}</span>
            <div class="topic-name">{{ $title }}</div>
        </div>
        @endforeach
    </div>

    {{-- Gaza note --}}
    <div class="gaza-note">
        <p>
            <strong>10%</strong> of your payment has been donated to supporting the children of Gaza.
            Thank you for making a difference.
        </p>
    </div>

</div>
@endsection
