<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Obada-Ar')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700;900&family=Lato:wght@300;400;700&family=Amiri:wght@400;700&display=swap"
        rel="stylesheet">

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
        }

        html,
        body {
            background: #080808 !important;
            color: #F0EAD6;
            line-height: 1.8;
            overflow-x: hidden;
            min-height: 100vh;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        img {
            max-width: 100%;
        }
    </style>

    @yield('styles')
</head>

<body>
    @yield('content')
    @yield('scripts')
</body>

</html>
