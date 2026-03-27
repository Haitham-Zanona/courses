@extends('layouts.app')

@section('title', 'Login — Arabic Pro')

@section('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@700;900&family=Lato:wght@300;400;700&family=Amiri:wght@400;700&display=swap');

    /* 1. تصغير كل المسافات الافتراضية وإجبار الطول الكامل */
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #050505;
        /* السواد الأساسي لمنع أي بياض */
        overflow-x: hidden;
    }

    /* 2. حاوية الصفحة الرئيسية */
    .main-wrapper {
        min-height: 100vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        background: radial-gradient(circle at center, #1a1a1a 0%, #050505 100%);
        padding: 20px;
        box-sizing: border-box;
    }

    /* 3. الزخرفة الخلفية - مثبتة لتغطي كل شيء */
    .geo-bg {
        position: fixed;
        inset: 0;
        pointer-events: none;
        opacity: 0.03;
        background-image:
            linear-gradient(var(--gold, #D4AF37) 1px, transparent 1px),
            linear-gradient(90deg, var(--gold, #D4AF37) 1px, transparent 1px);
        background-size: 60px 60px;
        z-index: 1;
    }

    .bg-letter {
        position: fixed;
        font-family: 'Amiri', serif;
        font-size: 40rem;
        color: #D4AF37;
        opacity: 0.02;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        pointer-events: none;
        z-index: 1;
    }

    /* 4. تصميم الكارد الفخم */
    .login-card {
        background: #0f0f0f;
        border: 1px solid rgba(212, 175, 55, 0.25);
        padding: 50px 40px;
        width: 100%;
        max-width: 420px;
        position: relative;
        z-index: 10;
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.8);
        border-radius: 4px;
        box-sizing: border-box;
    }

    /* إضافة لمسة فخامة ذهبية في أعلى الكارد */
    .login-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, #D4AF37, transparent);
    }

    .logo {
        text-align: center;
        margin-bottom: 30px;
    }

    .logo-en {
        font-family: 'Cinzel', serif;
        font-size: 1.8rem;
        font-weight: 900;
        color: #D4AF37;
        letter-spacing: 4px;
        display: block;
    }

    .logo-ar {
        font-family: 'Amiri', serif;
        font-size: 1.1rem;
        color: #7a7060;
        display: block;
        margin-top: 5px;
    }

    .ornament {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 35px;
    }

    .ornament::before,
    .ornament::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.4), transparent);
    }

    /* الحقول */
    .form-group {
        margin-bottom: 25px;
        text-align: left;
    }

    .form-label {
        font-family: 'Cinzel', serif;
        font-size: 0.7rem;
        letter-spacing: 2px;
        color: #D4AF37;
        display: block;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .form-input {
        width: 100%;
        background: #161616;
        border: 1px solid #2a2418;
        color: #F0EAD6;
        padding: 15px;
        font-size: 1rem;
        box-sizing: border-box;
        transition: 0.3s;
    }

    .form-input:focus {
        outline: none;
        border-color: #D4AF37;
        background: #1a1a1a;
    }

    .btn-login {
        width: 100%;
        background: linear-gradient(135deg, #F5E27A, #D4AF37, #a8860a);
        color: #000;
        font-family: 'Cinzel', serif;
        font-weight: 900;
        letter-spacing: 2px;
        padding: 16px;
        border: none;
        cursor: pointer;
        transition: 0.3s;
        text-transform: uppercase;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        filter: brightness(1.1);
    }

    .back-link {
        display: block;
        text-align: center;
        margin-top: 25px;
        color: #555;
        text-decoration: none;
        font-size: 0.8rem;
        transition: 0.3s;
    }

    .back-link:hover {
        color: #D4AF37;
    }

    /* التجاوب للموبايل */
    @media (max-width: 480px) {
        .login-card {
            padding: 40px 20px;
        }

        .logo-en {
            font-size: 1.4rem;
        }
    }
</style>
@endsection

@section('content')
<div class="main-wrapper">
    <div class="geo-bg"></div>
    <div class="bg-letter">ع</div>

    <div class="login-card">
        <div class="logo">
            <span class="logo-en">ARABIC PRO</span>
            <span class="logo-ar">تعلّم العربية مع عبادة</span>
        </div>

        <div class="ornament">
            <span style="color: #D4AF37">❖</span>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-input" placeholder="arabic_xxxx" required>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-login">
                Access My Course →
            </button>
        </form>

        <a href="{{ route('home') }}" class="back-link">← Return To Home</a>
    </div>
</div>
@endsection
