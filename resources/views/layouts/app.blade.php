<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="Zry4myJZ4NNDlfhao3PTKu9MDpx5RT9RbqGsK90YSsE">
    <title>@yield('title', 'ConstructKaro - Construction Services Platform')</title>
    <meta name="description" content="@yield('meta_description', 'ConstructKaro helps homeowners, businesses, and landowners plan, design, and execute construction projects with verified architects, contractors, interior designers, surveyors, and BOQ experts across Maharashtra.')">
    <meta name="robots" content="@yield('robots', 'index, follow')">
    <link rel="canonical" href="@yield('canonical', url()->current())">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="ConstructKaro">
    <meta property="og:title" content="@yield('og_title', trim($__env->yieldContent('title', 'ConstructKaro - Construction Services Platform')))">
    <meta property="og:description" content="@yield('og_description', trim($__env->yieldContent('meta_description', 'ConstructKaro helps homeowners, businesses, and landowners plan, design, and execute construction projects with verified construction experts.')))">
    <meta property="og:url" content="@yield('canonical', url()->current())">
    <meta property="og:image" content="@yield('og_image', asset('images/banner.jpg'))">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', trim($__env->yieldContent('title', 'ConstructKaro - Construction Services Platform')))">
    <meta name="twitter:description" content="@yield('twitter_description', trim($__env->yieldContent('meta_description', 'ConstructKaro helps homeowners, businesses, and landowners plan, design, and execute construction projects with verified construction experts.')))">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/banner.jpg'))">
    <link rel="icon" href="{{ asset('favicon.png') }}?v=2" type="image/png">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}?v=2" type="image/png">

    @stack('head')

    <style>
        :root {
            --ck-blue: #1f67ab;
            --ck-blue-2: #2f89d0;
            --ck-orange: #df6d1c;
            --ck-orange-2: #ef8a39;
            --ck-ink: #1c2c3e;
            --ck-muted: #667085;
            --ck-page: #eef2f7;
            --ck-card: #ffffff;
            --ck-border: #d9e2ec;
            --ck-shadow: 0 14px 38px rgba(16, 35, 57, .10);
            --ck-shadow-soft: 0 8px 24px rgba(16, 35, 57, .08);
            --ck-radius: 16px;
            --ck-container: 1280px;
        }

        * {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            overflow-x: hidden;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: var(--ck-page);
            color: var(--ck-ink);
            -webkit-font-smoothing: antialiased;
            text-rendering: optimizeLegibility;
        }

        .main-content {
            width: 100%;
            max-width: 100%;
            margin: 0;
            padding: 0;
        }

        .main-content img,
        .main-content svg,
        .main-content video {
            max-width: 100%;
        }

        .main-content img {
            height: auto;
        }

        .main-content a {
            text-underline-offset: 3px;
        }

        .main-content button,
        .main-content a,
        .main-content input,
        .main-content select,
        .main-content textarea {
            -webkit-tap-highlight-color: transparent;
        }

        .main-content button,
        .main-content [type="button"],
        .main-content [type="submit"],
        .main-content a[class*="btn"],
        .main-content a[class*="button"] {
            transition: transform .22s ease, box-shadow .22s ease, opacity .22s ease, background-color .22s ease, color .22s ease;
        }

        .main-content button:hover,
        .main-content [type="button"]:hover,
        .main-content [type="submit"]:hover,
        .main-content a[class*="btn"]:hover,
        .main-content a[class*="button"]:hover {
            transform: translateY(-1px);
        }

        .main-content input,
        .main-content select,
        .main-content textarea {
            max-width: 100%;
        }

        .main-content table {
            border-collapse: collapse;
            width: 100%;
        }

        .main-content :is(.card, [class*="-card"], [class*="_card"]) {
            backface-visibility: hidden;
        }

        .main-content :is(.card, [class*="-card"]):has(img) img {
            object-position: center;
        }

        @media (max-width: 768px) {
            .main-content :is(h1, .hero-title) {
                overflow-wrap: anywhere;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }

            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                scroll-behavior: auto !important;
                transition-duration: .01ms !important;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- Header --}}
    @include('partials.header')

    {{-- Main Content --}}
    <main class="main-content">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    <!-- JS -->
    @stack('scripts')

</body>
</html>
