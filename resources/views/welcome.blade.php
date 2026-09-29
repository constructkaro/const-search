@extends('layouts.app')

@section('title', 'ConstructKaro - Architects, Contractors & Construction Services')
@section('meta_description', 'Plan, hire, and execute construction projects with ConstructKaro. Find verified architects, contractors, interior designers, surveyors, BOQ experts, and construction support across Mumbai, Navi Mumbai, Pune, Thane, and Raigad.')
@section('canonical', 'https://constructkaro.com/')
@section('og_title', 'ConstructKaro - Verified Construction Services')
@section('og_description', 'Find verified architects, contractors, interior designers, surveyors, BOQ experts, and construction support for residential, commercial, industrial, and infrastructure projects.')
@section('og_image', 'https://constructkaro.com/images/banner.jpg')
@section('twitter_title', 'ConstructKaro - Verified Construction Services')
@section('twitter_description', 'Plan, hire, and execute construction projects with verified ConstructKaro experts across Maharashtra.')
@section('twitter_image', 'https://constructkaro.com/images/banner.jpg')

@php
    $isCustomerLoggedIn = session('customer_logged_in');
    $ckImage = function ($path, $alt = '', $class = '', array $attrs = []) {
        $webpPath = preg_replace('/\.(png|jpe?g)$/i', '.webp', $path);
        $useWebp = $webpPath && file_exists(public_path($webpPath));
        $attrString = '';

        foreach ($attrs as $name => $value) {
            if ($value === null || $value === false) {
                continue;
            }

            $attrString .= ' ' . e($name) . '="' . e($value === true ? $name : $value) . '"';
        }

        $classAttr = $class !== '' ? ' class="' . e($class) . '"' : '';
        $img = '<img src="' . asset($path) . '"' . $classAttr . ' alt="' . e($alt) . '"' . $attrString . '>';

        if (! $useWebp) {
            return $img;
        }

        return '<picture><source srcset="' . asset($webpPath) . '" type="image/webp">' . $img . '</picture>';
    };
@endphp

@push('head')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "ConstructKaro",
    "url": "https://constructkaro.com/",
    "logo": "https://constructkaro.com/images/logo.png",
    "email": "connect@constructkaro.com",
    "telephone": "+91 73858 82657",
    "areaServed": [
        "Mumbai",
        "Navi Mumbai",
        "Pune",
        "Thane",
        "Raigad"
    ],
    "sameAs": []
}
</script>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "ConstructKaro",
    "url": "https://constructkaro.com/"
}
</script>
@endpush

@push('styles')
<link rel="preload" as="image" href="{{ asset('images/banner-mobile.webp') }}" type="image/webp" media="(max-width: 767px)" fetchpriority="high">
<link rel="preload" as="image" href="{{ asset('images/banner.webp') }}" type="image/webp" media="(min-width: 768px)" fetchpriority="high">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
/* ============================================================
   CSS VARIABLES & RESET
   ============================================================ */
:root {
    --blue:        #155f9f;
    --blue-light:  #2b84c6;
    --orange:      #d96a1f;
    --orange-light:#f08a36;
    --ink:         #142235;
    --muted:       #607080;
    --line:        #dbe5ee;
    --bg:          #f3f6f8;
    --surface:     #ffffff;
    --text:        #1b2430;
    --container-w: 92%;
    --container-max:1320px;
    --radius:      8px;
    --shadow:      0 18px 45px rgba(16, 36, 58, .10);
    --ck-shadow:   0 18px 45px rgba(16, 36, 58, .10);
    --ck-shadow-soft: 0 10px 28px rgba(16, 36, 58, .08);
}

*, *::before, *::after {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

:is(h1, h2, h3, h4, h5, h6),
:is(h1, h2, h3, h4, h5, h6) * {
    font-family: 'Montserrat', sans-serif;
}

body {
    background: var(--bg);
    color: var(--text);
    overflow-x: hidden;
    -webkit-font-smoothing: antialiased;
    text-rendering: optimizeLegibility;
}

html {
    scroll-behavior: smooth;
}

.home-page {
    overflow: hidden;
    width: 100%;
}

.home-page img:not(.ck-compare-heading-image):not(.ck-compare-managed-image):not(.ck-compare-unmanaged-image):not(.ck-package-cta-image):not(.ck-package-visual-image) {
    max-width: 100%;
    display: block;
}

.home-page picture {
    display: contents;
}

.home-page a,
.home-page button,
.home-page input {
    min-width: 0;
}

.home-page section {
    scroll-margin-top: 90px;
}

/* ============================================================
   SHARED UTILITIES
   ============================================================ */
.section-container {
    width: var(--container-w);
    max-width: var(--container-max);
    margin: 0 auto;
}

.section-heading {
    text-align: center;
    margin-bottom: 42px;
}

.section-heading h2 {
    font-size: clamp(28px, 3.2vw, 38px);
    font-weight: 900;
    color: var(--ink);
    line-height: 1.15;
}

.heading-bar {
    width: 92px;
    height: 5px;
    margin: 12px auto 0;
    border-radius: 50px;
    background: linear-gradient(90deg, var(--orange), var(--blue-light));
}

/* ============================================================
   HERO
   ============================================================ */
.hero-banner {
    width: 100vw;
    min-height: clamp(420px, 44vw, 688px);
    margin-left: calc(50% - 50vw);
    background-image:
        /* linear-gradient(90deg, rgba(8,18,32,.94) 0%, rgba(8,18,32,.74) 47%, rgba(8,18,32,.16) 100%), */
        image-set(
           
            url("{{ asset('images/banner.png') }}") type("image/png")
        );
    background-size: cover;
    background-position: center clamp(-112px, -5.8vw, -78px);
    display: flex;
    align-items: center;
    padding: 50px 0;
    position: relative;
    overflow: hidden;
}

.hero-banner::after {
    content: "";
    position: absolute;
    inset: auto 0 0;
    height: 120px;
    background: linear-gradient(180deg, transparent, rgba(8,18,32,.40));
    pointer-events: none;
}

.hero-inner {
    width: var(--container-w);
    max-width: var(--container-max);
    margin: 0 auto;
    position: relative;
    z-index: 1;
}

.hero-content {
    max-width: 650px;
}

.hero-tech-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 11px;
    min-height: 30px;
    margin-bottom: 22px;
    padding: 9px 18px;
    border: 1px solid rgba(255, 138, 61, .55);
    border-radius: 999px;
    background: rgba(255, 250, 245, .96);
    color: #8f3d13;
    font-size: 13px;
    font-weight: 800;
    line-height: 1;
    letter-spacing: .9px;
    text-transform: uppercase;
    white-space: nowrap;
    box-shadow: 0 12px 26px rgba(0,0,0,.18);
}

.hero-tech-badge::before {
    content: "";
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #12c84f;
    flex: 0 0 10px;
}

.hero-title {
    color: #fff;
    font-size: clamp(38px, 4.2vw, 62px);
    font-weight: 900;
    line-height: 1.04;
    margin-bottom: 14px;
    max-width: 620px;
}

.hero-subtitle {
    color: #fff;
    font-size: clamp(19px, 2vw, 25px);
    font-weight: 700;
    margin-bottom: 12px;
}

.hero-description {
    color: rgba(255,255,255,.82);
    font-size: 16px;
    line-height: 1.7;
    margin-bottom: 30px;
    max-width: 560px;
}

.hero-plan-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-left: 20px;
    gap: 10px;
    min-height: 54px;
    padding: 0 28px;
    border: none;
    border-radius: 8px;
    background: linear-gradient(180deg, #ff8b2c 0%, #f25c05 100%);
    color: #fff;
    font-size: 17px;
    font-weight: 800;
    line-height: 1;
    cursor: pointer;
    box-shadow: 0 14px 32px rgba(242,92,5,.34);
    transition: transform .25s ease, box-shadow .25s ease, opacity .25s ease;
}

.hero-plan-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 18px 38px rgba(242,92,5,.42);
}

.hero-plan-btn svg {
    width: 20px;
    height: 20px;
    flex: 0 0 20px;
}

.hero-proof-grid {
    width: min(100%, 620px);
    margin-top: 32px;
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 12px;
}

.hero-proof-item {
    min-height: 78px;
    padding: 14px 12px;
    border: 1px solid rgba(255,255,255,.22);
    border-radius: 8px;
    background: rgba(255,255,255,.13);
    backdrop-filter: blur(8px);
}

.hero-proof-value {
    display: block;
    color: #fff;
    font-size: 22px;
    font-weight: 900;
    line-height: 1;
}

.hero-proof-label {
    display: block;
    margin-top: 7px;
    color: rgba(255,255,255,.78);
    font-size: 11px;
    font-weight: 600;
    line-height: 1.25;
}

/* ============================================================
   TRUST STRIP
   ============================================================ */
.ck-trust-section {
    padding: 40px 0 46px;
    background: var(--bg);
}

.ck-trust-heading {
    width: fit-content;
    max-width: 90%;
    margin: 0 auto 44px;
    text-align: center;
}

.ck-trust-heading h2 {
    color: #000408;
    font-size: clamp(28px, 3vw, 42px);
    font-weight: 650;
    line-height: 1.15;
    text-transform: uppercase;
}

.ck-trust-heading-line {
    width: 100%;
    height: 4px;
    margin-top: 10px;
    border-radius: 2px;
    background: linear-gradient(90deg, #ef6c1c 0%, #1d72b8 100%);
}

.ck-trust-container {
    width: var(--container-w);
    max-width: 1765px;
    margin: 0 auto;
    /* display: grid; */
    grid-template-columns: 454fr 483fr 352fr 359fr;
    gap: 18px;
    align-items: center;
    border-radius: 18px;
    overflow: hidden;
}

.ck-trust-item {
    position: relative;
    min-width: 0;
}

.ck-trust-item:hover {
    z-index: 2;
}

.ck-trust-item picture {
    display: block;
}

.ck-trust-card-img {
    display: block;
    width: 100%;
    height: auto;
    transition: transform .25s ease, filter .25s ease;
}

.ck-trust-item:hover .ck-trust-card-img {
    transform: translateY(-8px) scale(1.03);
    filter: brightness(1.08) drop-shadow(3px 6px 4px rgba(0, 0, 0, .25));
}

.ck-process-image-swap {
    position: relative;
    display: block;
    width: 100%;
}

.ck-process-image-swap picture {
    display: contents;
}

.ck-process-image-swap .ck-process-image-after {
    position: absolute;
    inset: 0;
    opacity: 0;
}

.ck-process-image-swap img {
    width: 100%;
    height: auto;
    transition: opacity .35s ease, transform .35s ease, filter .35s ease;
}

.ck-process-image-swap:hover .ck-process-image-before,
.ck-process-image-swap:focus-within .ck-process-image-before {
    opacity: 0;
}

.ck-process-image-swap:hover .ck-process-image-after,
.ck-process-image-swap:focus-within .ck-process-image-after {
    opacity: 1;
}

.ck-process-image-swap:hover img {
    transform: translateY(-4px);
    filter: drop-shadow(0 12px 18px rgba(16, 36, 58, .18));
}

/* ============================================================
   MAIN SERVICE CARDS
   ============================================================ */
.ck-services-section {
    padding: 82px 0 60px;
    background: var(--bg);
}

.ck-services-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: clamp(22px, 3vw, 34px);
    align-items: stretch;
}

.ck-service-card {
    background: #fff;
    border: 1px solid var(--line);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    text-align: center;
    padding: 0 20px 28px;
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100%;
    min-height: 300px;
    transition: transform .28s ease, box-shadow .28s ease, border-color .28s ease;
}

.ck-service-card:hover {
    transform: translateY(-6px);
    border-color: rgba(43,132,198,.55);
    box-shadow: 0 22px 44px rgba(16,36,58,.13);
}

.ck-service-image {
    width: min(78%, 270px);
    aspect-ratio: 4 / 3;
    height: auto;
    margin: -52px auto 20px;
    border-radius: 8px;
    overflow: hidden;
    border: 4px solid #fff;
    box-shadow: 0 10px 22px rgba(16,36,58,.16);
    flex-shrink: 0;
    background: #e7eef5;
}

.ck-service-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: transform .35s ease;
}

.ck-service-card:hover .ck-service-image img {
    transform: scale(1.05);
}

.ck-service-title {
    color: var(--orange);
    font-size: 19px;
    font-weight: 800;
    margin-bottom: 6px;
}

.ck-service-line {
    width: 64px;
    height: 3px;
    border-radius: 999px;
    background: #d9e5ef;
    margin: 0 auto 12px;
}

.ck-service-text {
    color: var(--muted);
    font-size: 13px;
    font-style: italic;
    margin-bottom: 20px;
    line-height: 1.5;
    flex: 1;
}

.ck-service-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    max-width: 240px;
    height: 42px;
    border-radius: 8px;
    background: linear-gradient(180deg, #2f89d0, #1d6eb3);
    color: #fff;
    text-decoration: none;
    font-size: 14px;
    font-weight: 700;
    transition: transform .2s ease, box-shadow .2s ease, opacity .2s;
}

.ck-service-btn:hover {
    opacity: .88;
    color: #fff;
    text-decoration: none;
    transform: translateY(-1px);
    box-shadow: 0 8px 18px rgba(31,103,171,.22);
}

/* ============================================================
   EXPLORE MORE SERVICES
   ============================================================ */
.our-services-section {
    padding: 56px 0 64px;
    background: #ececec;
}

.our-services-shell {
    width: 96%;
    max-width: 1840px;
    margin: 0 auto;
}

.our-services-heading {
    margin-bottom: 28px;
    text-align: center;
}

.our-services-heading h2 {
    margin: 0;
    color: #292929;
    font-size: 46px;
    font-weight: 800;
    line-height: 1.1;
    text-transform: uppercase;
}

.our-services-heading-line {
    width: min(90%, 400px);
    height: 4px;
    margin: 10px auto 26px;
    border-radius: 2px;
    background: linear-gradient(90deg, #ef6c1c 0%, #2478bb 100%);
}

.our-services-heading h3 {
    margin: 0 0 10px;
    color: #333;
    font-size: 34px;
    font-weight: 600;
    line-height: 1.2;
}

.our-services-heading h3 span {
    color: #ef7121;
}

.our-services-heading p {
    margin: 0;
    color: #333;
    font-size: 22px;
    line-height: 1.4;
}

.our-services-grid {
    display: grid;
    grid-template-columns: repeat(5, minmax(0, 1fr));
    column-gap: 32px;
    row-gap: 38px;
    align-items: start;
}

.our-service-card {
    position: relative;
    z-index: 0;
    display: block;
    width: 100%;
    min-width: 0;
    aspect-ratio: 366 / 443;
    padding: 0;
    border: 0;
    border-radius: 14px;
    overflow: hidden;
    background: transparent;
    color: inherit;
    font: inherit;
    text-align: inherit;
    text-decoration: none;
    cursor: pointer;
    appearance: none;
    -webkit-appearance: none;
    transform-origin: center center;
    transform: translateY(0) scale(1);
    filter: drop-shadow(0 4px 5px rgba(16, 36, 58, .12));
    transition: transform .28s ease, filter .28s ease;
}

.our-service-card:hover,
.our-service-card:focus-visible {
    color: inherit;
    text-decoration: none;
    outline: none;
    z-index: 5;
    transform: translateY(-10px) scale(1.04);
    filter: drop-shadow(0 18px 16px rgba(16, 36, 58, .24));
}

.our-service-card img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 14px;
    pointer-events: none;
    transform: scale(1);
    transform-origin: center center;
    transition: opacity .4s ease, transform .28s ease;
}

.our-service-card .hover-state {
    position: absolute;
    inset: 0;
    opacity: 0;
}

.our-service-card:hover .default-state,
.our-service-card:focus-visible .default-state {
    opacity: 0;
}

.our-service-card:hover .hover-state,
.our-service-card:focus-visible .hover-state {
    opacity: 1;
}

.our-service-card.open-plan-modal-btn {
    overflow: visible;
}

.our-service-card.open-plan-modal-btn:hover,
.our-service-card.open-plan-modal-btn:focus-visible {
    transform: translateY(-10px);
}

.our-service-card.open-plan-modal-btn:hover img,
.our-service-card.open-plan-modal-btn:focus-visible img {
    transform: scale(1.04);
}

@media (prefers-reduced-motion: reduce) {
    .our-service-card,
    .our-service-card img {
        transition: none;
    }
}

@media (max-width: 1400px) {
    .our-services-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
}

@media (max-width: 768px) {
    .our-services-section { padding: 44px 0; }
    .our-services-heading h2 { font-size: 34px; }
    .our-services-heading h3 { font-size: 25px; }
    .our-services-heading p { font-size: 17px; }
    .our-services-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 24px; }
}

@media (max-width: 480px) {
    .our-services-grid { grid-template-columns: 1fr; }
    .our-service-card { width: min(100%, 366px); margin: 0 auto; }
}

.explore-services-section {
    padding: 68px 0 78px;
    background: var(--bg);
}

.explore-services-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 26px;
    align-items: stretch;
}

.explore-card {
    background: #fff;
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow);
    text-align: center;
    display: flex;
    flex-direction: column;
    height: 100%;
    transition: transform .28s ease, box-shadow .28s ease;
}

.explore-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 22px 44px rgba(16,36,58,.13);
}

.orange-card { border: 1px solid rgba(217,106,31,.42); }
.blue-card   { border: 1px solid rgba(43,132,198,.42); }

.explore-card-image {
    aspect-ratio: 16 / 10;
    height: auto;
    overflow: hidden;
    flex-shrink: 0;
    background: #e7eef5;
}

.explore-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
    transition: transform .35s ease;
}

.explore-card:hover .explore-card-image img {
    transform: scale(1.04);
}

.explore-card-body {
    padding: 20px 20px 24px;
    display: flex;
    flex-direction: column;
    align-items: center;
    flex: 1;
}

.explore-card-body h3 {
    font-size: 19px;
    font-weight: 900;
    margin-bottom: 10px;
    line-height: 1.2;
}

.orange-card h3 { color: var(--orange); }
.blue-card   h3 { color: var(--blue); }

.explore-card-body p {
    font-size: 13px;
    color: var(--muted);
    margin-bottom: 20px;
    flex: 1;
    line-height: 1.5;
}

.explore-btn {
    width: 100%;
    max-width: 240px;
    height: 44px;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 15px;
    font-weight: 800;
    text-decoration: none;
    transition: transform .2s ease, box-shadow .2s ease, opacity .2s;
}

.explore-btn:hover {
    opacity: .88;
    color: #fff;
    text-decoration: none;
    transform: translateY(-1px);
    box-shadow: 0 8px 18px rgba(0,0,0,.16);
}

.orange-btn { background: linear-gradient(180deg, #ef8a39, #df6d1c); }
.blue-btn   { background: linear-gradient(180deg, #2f89d0, #1d6eb3); }

/* ============================================================
   PROCESS + ASSURANCE
   ============================================================ */
.ck-process-section {
    padding: 76px 0;
    background: #fff;
}

.ck-process-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

.ck-process-card {
    position: relative;
    min-height: 210px;
    padding: 26px 22px;
    border: 1px solid var(--line);
    border-radius: 8px;
    background: linear-gradient(180deg, #fff, #f7fbff);
    box-shadow: var(--ck-shadow-soft);
}

.ck-process-number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    margin-bottom: 18px;
    border-radius: 8px;
    background: #1f67ab;
    color: #fff;
    font-weight: 900;
}

.ck-process-card:nth-child(even) .ck-process-number {
    background: #df6d1c;
}

.ck-process-card h3 {
    color: var(--ink);
    font-size: 18px;
    font-weight: 900;
    line-height: 1.2;
    margin-bottom: 10px;
}

.ck-process-card p {
    color: var(--muted);
    font-size: 14px;
    line-height: 1.55;
}

.ck-solution-section {
    padding: 36px 0 56px;
    background: #fff;
}

.ck-solution-shell {
    width: var(--container-w);
    max-width: 1765px;
    margin: 0 auto;
}

.ck-solution-intro {
    padding: 0;
}

.ck-solution-badge {
    display: inline-flex;
    margin-bottom: 14px;
    padding: 7px 12px;
    border-radius: 999px;
    background: #2275b9;
    color: #fff;
    font-size: 15px;
    font-weight: 800;
    text-transform: uppercase;
}

.ck-solution-headline {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 70px;
    margin: 0 0 10px;
}

.ck-solution-headline span {
    color: #292929;
    font-size: 29px;
    font-weight: 800;
    line-height: 1.15;
}

.ck-solution-intro p {
    max-width: 1660px;
    color: #292929;
    font-size: 16px;
    line-height: 1.4;
}

.ck-solution-options {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 70px;
    width: 94%;
    margin: 42px auto 0;
}

.ck-solution-card {
    position: relative;
    min-width: 0;
    aspect-ratio: 2792 / 1684;
    padding: 0;
    border: 0;
    border-radius: 0;
    background: #fff;
    box-shadow: none;
    overflow: hidden;
    transition: none;
}

.ck-solution-card:hover {
    box-shadow: none;
    transform: none;
}

.ck-solution-card picture {
    display: block;
    width: 100%;
    height: 100%;
}

.ck-solution-card-img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: none;
}

.ck-solution-card-img.hover-state {
    position: absolute;
    inset: 0;
    opacity: 0;
}

.ck-solution-card:hover .ck-solution-card-img.default-state {
    opacity: 0;
}

.ck-solution-card:hover .ck-solution-card-img.hover-state {
    opacity: 1;
}

.ck-solution-card h3 {
    color: #292929;
    font-size: 28px;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 8px;
    transition: color .25s ease;
}

.ck-solution-card:hover h3 {
    color: #2478bb;
}

.ck-solution-card p {
    color: #292929;
    font-size: 16px;
    line-height: 1.4;
    margin-bottom: 12px;
}

.ck-solution-list {
    display: grid;
    gap: 9px;
    margin: 0;
    padding: 0;
    list-style: none;
}

.ck-solution-list li {
    position: relative;
    padding-left: 28px;
    color: #292929;
    font-size: 20px;
    font-weight: 600;
    line-height: 1.25;
}

.ck-solution-list li::before {
    content: "";
    position: absolute;
    left: 0;
    top: .4em;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #292929;
    transition: background-color .25s ease;
}

.ck-solution-card:hover .ck-solution-list li::before {
    background: #2478bb;
}

.ck-assurance-section {
    padding: 48px 0 58px;
    background: #fff;
}

.ck-assurance-shell {
    width: 94%;
    max-width: 1780px;
    margin: 0 auto;
}

.ck-assurance-panel {
    padding: 0;
    background: transparent;
    color: #292929;
}

.ck-assurance-eyebrow {
    display: inline-flex;
    margin-bottom: 24px;
    padding: 7px 16px;
    border-radius: 999px;
    background: #2478bb;
    color: #fff;
    font-size: 15px;
    font-weight: 800;
    letter-spacing: .8px;
    text-transform: uppercase;
}

.ck-assurance-panel h2 {
    margin: 0 0 10px;
    font-size: 38px;
    font-weight: 800;
    line-height: 1.15;
}

.ck-assurance-panel p {
    color: #292929;
    font-size: 20px;
    line-height: 1.45;
}

.ck-assurance-list {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 44px;
    margin-top: 28px;
}

.ck-assurance-item {
    position: relative;
    aspect-ratio: 462 / 346;
    padding: 0;
    border: 0;
    border-radius: 20px;
    overflow: hidden;
    background: transparent;
}

.ck-assurance-item img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: opacity .35s ease;
}

.ck-assurance-item .hover-state {
    position: absolute;
    inset: 0;
    opacity: 0;
}

.ck-assurance-item:hover .default-state {
    opacity: 0;
}

.ck-assurance-item:hover .hover-state {
    opacity: 1;
}

.ck-compare-section {
    padding: 12px 0 54px;
    background: #efefef;
    overflow: hidden;
}

.ck-compare-shell {
    width: min(92vw, 1660px);
    margin: 0 auto;
}

.ck-compare-image {
    display: block;
    width: 100%;
    height: auto;
    border-radius: 0;
}

.ck-compare-heading-image {
    display: block;
    width: 80%;
    max-width: 1450px;
    height: auto;
    margin: 0 auto 42px;
    border-radius: 0;
    cursor: zoom-in;
    transform-origin: center;
    transition: transform 260ms ease, filter 260ms ease;
}

.ck-compare-panels {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 120px minmax(0, 1fr);
    width: min(100%, 1450px);
    margin: 0 auto;
    justify-content: center;
    align-items: start;
    gap: 42px;
}

.ck-compare-managed-image {
    position: relative;
    z-index: 1;
    display: block;
    width: 100%;
    max-width: 600px;
    height: auto;
    justify-self: end;
    border-radius: 14px;
    box-shadow: 10px 10px 14px rgba(0, 0, 0, 0.16);
    cursor: zoom-in;
    transform-origin: center;
    transition: transform 260ms ease, box-shadow 260ms ease;
}

.ck-compare-unmanaged-image {
    position: relative;
    z-index: 1;
    display: block;
    width: 100%;
    max-width: 600px;
    height: auto;
    justify-self: start;
    border-radius: 14px;
    box-shadow: 10px 10px 14px rgba(0, 0, 0, 0.16);
    cursor: zoom-in;
    transform-origin: center;
    transition: transform 260ms ease, box-shadow 260ms ease;
}

.ck-compare-update-banner {
    width: min(100%, 1523px);
    margin: 42px auto 0;
    transition: transform 260ms ease, box-shadow 260ms ease;
}

.ck-compare-update-image {
    display: block;
    width: 100%;
    height: auto;
    border-radius: 16px;
}

.ck-package-compare-row {
    display: grid;
    grid-template-columns: minmax(0, 1134fr) minmax(0, 646fr);
    align-items: start;
    gap: 24px;
    width: min(100%, 1523px);
    margin: 42px auto 0;
}

.ck-package-cta-image {
    position: relative;
    z-index: 1;
    display: block;
    width: 100%;
    height: auto;
    border-radius: 14px;
    cursor: pointer;
    transition: transform 260ms ease, box-shadow 260ms ease;
}

.ck-package-cta-link {
    position: relative;
    z-index: 1;
    display: block;
    min-width: 0;
    border-radius: 14px;
    text-decoration: none;
    transition: transform 260ms ease, filter 260ms ease;
}

.ck-package-cta-button {
    position: absolute;
    z-index: 2;
    left: 50%;
    bottom: 18%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: min(34%, 330px);
    min-height: clamp(38px, 3.5vw, 54px);
    padding: 6px 20px;
    border: 1px solid rgba(66, 66, 66, .72);
    border-radius: 12px;
    background: #fff;
    color: #2b2b2b;
    font-family: 'Montserrat', sans-serif;
    font-size: clamp(16px, 1.8vw, 28px);
    font-weight: 800;
    line-height: 1;
    white-space: nowrap;
    box-shadow: 0 5px 8px rgba(0, 0, 0, .3);
    transform: translateX(-50%);
    transition: background-color 220ms ease, color 220ms ease, box-shadow 220ms ease;
}

.ck-package-cta-link:focus-visible {
    outline: 4px solid #1c78bf;
    outline-offset: 5px;
}

.ck-package-visual-image {
    position: relative;
    z-index: 1;
    display: block;
    width: 100%;
    height: auto;
    border-radius: 14px;
    transition: transform 260ms ease, box-shadow 260ms ease;
}

@media (hover: hover) and (pointer: fine) {
    .ck-compare-heading-image:hover {
        transform: scale(1.025);
        filter: drop-shadow(0 12px 12px rgba(0, 0, 0, 0.16));
    }

    .ck-compare-managed-image:hover {
        z-index: 5;
        transform: translateY(-10px) scale(1.045);
        box-shadow: 18px 24px 34px rgba(0, 0, 0, 0.26);
    }

    .ck-compare-unmanaged-image:hover {
        z-index: 5;
        transform: translateY(-10px) scale(1.045);
        box-shadow: 18px 24px 34px rgba(0, 0, 0, 0.26);
    }

    .ck-compare-update-banner:hover {
        transform: translateY(-6px) scale(1.012);
        box-shadow: 0 18px 30px rgba(29, 94, 145, 0.18);
    }

    .ck-package-cta-link:hover {
        z-index: 5;
        transform: translateY(-8px) scale(1.025);
        filter: drop-shadow(0 20px 16px rgba(125, 67, 22, .22));
    }

    .ck-package-cta-link:hover .ck-package-cta-button {
        background: #fff;
        color: #ec6c20;
        box-shadow: 0 7px 12px rgba(97, 45, 10, .34);
    }

    .ck-package-visual-image:hover {
        z-index: 5;
        transform: translateY(-8px) scale(1.035);
        box-shadow: 0 20px 32px rgba(29, 94, 145, 0.2);
    }
}

.ck-compare-divider {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    align-self: stretch;
    min-height: 0;
}

.ck-compare-divider::before {
    display: none;
    content: "";
    position: absolute;
    top: 15%;
    bottom: 15%;
    left: 50%;
    width: 7px;
    border-radius: 8px;
    background: linear-gradient(180deg, #0876d1 0%, #ef7625 100%);
    transform: translateX(-50%);
}

.ck-compare-divider-image {
    display: block;
    width: min(104px, 100%);
    max-width: 100%;
    height: auto;
    max-height: 100%;
    object-fit: contain;
}

.ck-compare-vs {
    position: relative;
    z-index: 1;
    display: none;
    align-items: center;
    justify-content: center;
    width: 96px;
    height: 96px;
    border: 2px solid #1680ce;
    border-radius: 50%;
    background: #fff;
    color: #65788c;
    font-size: 38px;
    font-weight: 900;
    line-height: 1;
    box-shadow: 2px 3px 5px rgba(0, 0, 0, 0.2);
}

.ck-compare-heading {
    display: flex;
    align-items: center;
    gap: 18px;
    width: 100%;
    margin-bottom: 30px;
}

.ck-compare-heading::before,
.ck-compare-heading::after {
    content: "";
    display: block;
    height: 6px;
    border-radius: 8px;
    flex: 1 1 0;
}

.ck-compare-heading::before {
    background: linear-gradient(90deg, #ef6c1c 0%, rgba(239,108,28,0.25));
}

.ck-compare-heading::after {
    background: linear-gradient(90deg, rgba(37,118,187,0.25), #2478bb 100%);
}

.ck-compare-heading h2 {
    margin: 0;
    color: #292929;
    font-size: clamp(34px, 4vw, 84px);
    font-weight: 900;
    line-height: 0.96;
    letter-spacing: -0.06em;
    text-transform: uppercase;
    white-space: nowrap;
}

.ck-compare-layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(300px, 0.92fr) minmax(0, 1fr);
    gap: 28px 26px;
    align-items: start;
}

.ck-compare-column {
    display: grid;
    gap: 18px;
}

.ck-compare-top-pill {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 92px;
    padding: 18px 20px;
    border-radius: 30px;
    color: #fff;
    font-size: clamp(22px, 2vw, 36px);
    font-weight: 800;
    line-height: 1.05;
    text-align: center;
    letter-spacing: -0.04em;
    box-shadow: 0 8px 18px rgba(16, 39, 61, 0.08);
}

.ck-compare-top-pill.managed {
    background: linear-gradient(180deg, #1d77c7 0%, #2f84c8 100%);
    border: 3px solid rgba(37, 120, 187, 0.85);
}

.ck-compare-top-pill.unmanaged {
    background: linear-gradient(180deg, #f28a3d 0%, #ef6f1a 100%);
    border: 3px solid rgba(239, 113, 31, 0.82);
}

.ck-compare-flow {
    position: relative;
    display: grid;
    gap: 18px;
    padding-top: 8px;
}

.ck-compare-step {
    position: relative;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 22px;
    align-items: center;
}

.ck-compare-step-card {
    position: relative;
    display: flex;
    align-items: center;
    gap: 16px;
    min-height: 92px;
    padding: 18px 18px 18px 16px;
    border-radius: 18px;
    background: rgba(255, 255, 255, 0.68);
    border: 2px solid rgba(37, 120, 187, 0.7);
    box-shadow: 0 4px 12px rgba(17, 37, 59, 0.04);
    color: #2b2b2b;
    font-size: clamp(18px, 1.7vw, 26px);
    font-weight: 600;
    line-height: 1.25;
}

.ck-compare-step-card.unmanaged {
    border-color: rgba(239, 113, 31, 0.8);
}

.ck-compare-step-card .icon-box {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 52px;
    height: 52px;
    border-radius: 12px;
    flex-shrink: 0;
    font-size: 30px;
    font-weight: 800;
    color: #fff;
}

.ck-compare-step-card.managed .icon-box {
    background: #2d7eca;
}

.ck-compare-step-card.unmanaged .icon-box {
    background: #ef731f;
}

.ck-compare-connector {
    position: relative;
    min-height: 110px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.ck-compare-connector::before,
.ck-compare-connector::after {
    content: "";
    position: absolute;
    top: 50%;
    width: 46%;
    height: 3px;
    transform: translateY(-50%);
}

.ck-compare-connector::before {
    left: 0;
    background: linear-gradient(90deg, rgba(39,126,196,0.85), rgba(39,126,196,0.2));
}

.ck-compare-connector::after {
    right: 0;
    background: linear-gradient(90deg, rgba(239,115,31,0.2), rgba(239,115,31,0.85));
}

.ck-compare-center-card {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 14px;
    width: 100%;
    min-height: 120px;
    padding: 16px 18px;
    border: 3px solid rgba(71, 71, 71, 0.9);
    border-radius: 22px;
    background: rgba(255, 255, 255, 0.22);
    box-shadow: 0 8px 18px rgba(25, 35, 46, 0.04);
    text-align: center;
}

.ck-compare-center-card .step-number {
    position: absolute;
    top: -22px;
    left: 50%;
    transform: translateX(-50%);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 54px;
    height: 54px;
    border: 2px solid rgba(62, 62, 62, 0.9);
    border-radius: 50%;
    background: #dfe7ec;
    color: #1d2430;
    font-size: 24px;
    font-weight: 800;
    line-height: 1;
}

.ck-compare-stage-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 52px;
    height: 52px;
    border-radius: 12px;
    background: #eef3f7;
    color: #1d2430;
    font-size: 28px;
    font-weight: 700;
}

.ck-compare-stage-copy {
    color: #1d2430;
    font-size: clamp(18px, 1.7vw, 30px);
    font-weight: 800;
    line-height: 1.08;
    text-transform: uppercase;
    letter-spacing: -0.04em;
}

@media (max-width: 1200px) {
    .ck-compare-panels {
        grid-template-columns: minmax(0, 1fr) 90px minmax(0, 1fr);
        gap: 24px;
    }

    .ck-compare-vs {
        width: 76px;
        height: 76px;
        font-size: 30px;
    }

    .ck-compare-layout { grid-template-columns: 1fr; }
    .ck-compare-heading { flex-wrap: wrap; }
    .ck-compare-heading h2 { white-space: normal; text-align: center; }
    .ck-compare-step { grid-template-columns: 1fr; }
    .ck-compare-connector { min-height: 18px; }
    .ck-compare-connector::before,
    .ck-compare-connector::after { display: none; }
}

@media (max-width: 1100px) {
    .ck-compare-shell { width: min(92vw, 700px); }
    .ck-compare-heading-image {
        width: 94%;
        margin-bottom: 30px;
    }
    .ck-compare-panels { grid-template-columns: 1fr; gap: 24px; }
    .ck-compare-managed-image {
        width: min(100%, 600px);
        justify-self: center;
    }
    .ck-compare-unmanaged-image {
        width: min(100%, 600px);
        justify-self: center;
    }
    .ck-compare-divider { min-height: 76px; }
    .ck-compare-divider-image { display: none; }
    .ck-compare-divider::before {
        display: block;
        top: 50%;
        bottom: auto;
        left: 8%;
        right: 8%;
        width: auto;
        height: 5px;
        transform: translateY(-50%);
        background: linear-gradient(90deg, #0876d1 0%, #ef7625 100%);
    }
    .ck-compare-vs { display: inline-flex; }
    .ck-package-compare-row {
        grid-template-columns: minmax(0, 1134fr) minmax(0, 646fr);
        gap: 16px;
    }
}

@media (max-width: 576px) {
    .ck-compare-section { padding: 28px 0 34px; }
    .ck-compare-shell { width: min(92vw, 700px); }
    .ck-compare-heading-image { margin-bottom: 24px; }
    .ck-compare-panels { grid-template-columns: 1fr; gap: 22px; }
    .ck-compare-divider { min-height: 70px; }
    .ck-compare-divider::before {
        display: block;
        top: 50%;
        bottom: auto;
        left: 8%;
        right: 8%;
        width: auto;
        height: 5px;
        transform: translateY(-50%);
        background: linear-gradient(90deg, #0876d1 0%, #ef7625 100%);
    }
    .ck-compare-vs { width: 66px; height: 66px; font-size: 26px; }
    .ck-compare-update-banner {
        margin-top: 28px;
    }
    .ck-package-compare-row {
        grid-template-columns: 1fr;
        gap: 18px;
        margin-top: 28px;
    }
    .ck-package-cta-button {
        width: min(56%, 240px);
        min-height: 38px;
        bottom: 14%;
        padding-inline: 12px;
        font-size: 15px;
    }
    .ck-compare-heading { gap: 10px; }
    .ck-compare-heading::before,
    .ck-compare-heading::after { height: 4px; }
    .ck-compare-top-pill { min-height: 74px; border-radius: 22px; }
    .ck-compare-step-card { min-height: 74px; font-size: 17px; }
    .ck-compare-center-card { min-height: 96px; }
    .ck-compare-stage-copy { font-size: 18px; }
}

/* ============================================================
   GUIDE SECTION
   ============================================================ */
.ck-guide-section {
    padding: 66px 0;
    background: var(--bg);
}

.ck-guide-container {
    width: var(--container-w);
    max-width: var(--container-max);
    margin: 0 auto;
    display: grid;
    grid-template-columns: minmax(320px, 0.78fr) minmax(0, 1.22fr);
    gap: 24px;
    align-items: stretch;
}

.ck-guide-image-box {
    border: 1px solid rgba(217,106,31,.38);
    border-left: 5px solid var(--blue-light);
    border-radius: 8px;
    overflow: hidden;
    box-shadow: var(--shadow);
    min-height: 320px;
    background: #e7eef5;
}

.ck-guide-image-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
    transition: transform .45s ease;
}

.ck-guide-image-box:hover img {
    transform: scale(1.04);
}

.ck-guide-content-box {
    border-radius: 8px;
    overflow: hidden;
    background: image-set(
        url("{{ asset('images/logo/Confused.webp') }}") type("image/webp"),
        url("{{ asset('images/logo/Confused.png') }}") type("image/png")
    ) center/cover no-repeat;
    box-shadow: var(--shadow);
    padding: 40px 42px;
    color: #fff;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 20px;
    min-height: 320px;
    position: relative;
    isolation: isolate;
}

.ck-guide-content-box::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, rgba(10,29,52,.32), rgba(10,29,52,.12));
    z-index: 0;
}

.ck-guide-content-box > * {
    position: relative;
    z-index: 1;
}

.ck-guide-title {
    font-size: 26px;
    font-weight: 900;
    line-height: 1.3;
}

.ck-guide-text {
    font-size: 17px;
    line-height: 1.5;
    opacity: .94;
}

.ck-guide-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0 36px;
    height: 52px;
    border-radius: 8px;
    background: #fff;
    color: #222;
    text-decoration: none;
    font-size: 18px;
    font-weight: 900;
    box-shadow: 0 5px 12px rgba(0,0,0,.3);
    white-space: nowrap;
    transition: color .2s ease, background-color .2s ease, border-radius .2s ease, transform .2s ease, box-shadow .2s ease, text-shadow .2s ease;
}

.ck-guide-btn:hover,
.ck-guide-btn:focus-visible {
    color: #1976b9;
    background: #fff;
    border-radius: 12px;
    text-decoration: none;
    outline: none;
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 8px 14px rgba(0,0,0,.38), inset 0 1px 3px rgba(0,0,0,.14);
    text-shadow: 0 2px 2px rgba(0,0,0,.24);
}

/* ============================================================
   UPCOMING SERVICES (auto-scroll)
   ============================================================ */
.upcoming-services-section {
    padding: 68px 0 60px;
    background: linear-gradient(180deg, #f7f7f7, #ececec);
    overflow: hidden;
}

.upcoming-services-heading {
    text-align: center;
    margin-bottom: 36px;
}

.upcoming-services-heading h2 {
    font-size: clamp(28px, 3.2vw, 38px);
    font-weight: 800;
    color: var(--ink);
}

.upcoming-heading-line {
    width: 92px;
    height: 5px;
    margin: 12px auto 0;
    border-radius: 999px;
    background: linear-gradient(90deg, #ef7d2d, #2f78bf);
}

.upcoming-auto-scroll-wrap { overflow: hidden; padding: 6px 0; }

.upcoming-auto-scroll-track {
    display: flex;
    gap: 24px;
    width: max-content;
    animation: upcomingAutoScroll 24s linear infinite;
    will-change: transform;
}
.upcoming-auto-scroll-track:hover {
    animation-play-state: paused;
}

@keyframes upcomingAutoScroll {
    0%   { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

.upcoming-card {
    width: 360px;
    min-width: 360px;
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: var(--shadow);
    position: relative;
    transition: transform .28s ease, box-shadow .28s ease;
}

.upcoming-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 22px 44px rgba(16,36,58,.13);
}

.upcoming-card.orange-border { border: 1px solid rgba(217,106,31,.42); }
.upcoming-card.blue-border   { border: 1px solid rgba(43,132,198,.42); }

.upcoming-card-image {
    height: 230px;
    overflow: hidden;
    background: #e7eef5;
}

.upcoming-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform .35s ease;
}

.upcoming-card:hover .upcoming-card-image img {
    transform: scale(1.04);
}

.upcoming-card-body {
    padding: 20px 18px 24px;
    text-align: center;
}

.upcoming-card-body h3 {
    font-size: clamp(16px, 1.6vw, 20px);
    font-weight: 800;
    color: #1f1f1f;
    line-height: 1.25;
}

.upcoming-card-body p {
    font-size: 13px;
    color: #777;
    margin-top: 6px;
}

/* ============================================================
   VENDOR SECTION
   ============================================================ */
.ck-vendor-section {
    padding: 66px 0;
    background: var(--bg);
}

.ck-vendor-container {
    width: var(--container-w);
    max-width: var(--container-max);
    margin: 0 auto;
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(320px, 1fr);
    gap: 28px;
    align-items: stretch;
}

.ck-vendor-content-box {
    position: relative;
    min-height: 300px;
    border-radius: 8px;
    background: image-set(
        url("{{ asset('images/logo/area.webp') }}") type("image/webp"),
        url("{{ asset('images/logo/area.png') }}") type("image/png")
    ) center/cover no-repeat;
    box-shadow: var(--shadow);
    padding: 44px 40px;
    text-align: center;
    color: #fff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 18px;
    isolation: isolate;
}

.ck-vendor-content-box::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, rgba(8,26,48,.30), rgba(8,26,48,.12));
    z-index: 0;
}

.ck-vendor-content-box > * {
    position: relative;
    z-index: 1;
}

.ck-vendor-title {
    font-size: 28px;
    font-weight: 900;
    line-height: 1.3;
}

.ck-vendor-text {
    font-size: 18px;
    line-height: 1.45;
    max-width: 520px;
    opacity: .95;
}

.ck-vendor-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0 32px;
    height: 50px;
    border-radius: 8px;
    background: #fff;
    color: #2b2b2b;
    text-decoration: none;
    font-size: 18px;
    font-weight: 900;
    box-shadow: 0 5px 10px rgba(0,0,0,.3);
    transition: transform .2s ease, box-shadow .2s ease, opacity .2s;
}

.ck-vendor-btn:hover {
    color: #2b2b2b;
    opacity: .9;
    text-decoration: none;
    transform: translateY(-1px);
    box-shadow: 0 10px 20px rgba(0,0,0,.22);
}

.ck-vendor-image-box {
    min-height: 300px;
    border: 1px solid rgba(217,106,31,.38);
    border-left: 5px solid var(--blue-light);
    border-right: 5px solid var(--blue-light);
    border-radius: 8px;
    overflow: hidden;
    box-shadow: var(--shadow);
    background: #e7eef5;
}

.ck-vendor-image-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    object-position: center;
    transition: transform .45s ease;
}

.ck-vendor-image-box:hover img {
    transform: scale(1.04);
}

/* ============================================================
   CITIES WE SERVE
   ============================================================ */
.ck-city-section {
    padding: 58px 0;
    background: #fff;
    text-align: center;
}

.ck-city-title {
    font-size: clamp(28px, 3.2vw, 38px);
    font-weight: 900;
    color: #1f1f1f;
    margin-bottom: 36px;
}

.ck-city-grid {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 22px;
    flex-wrap: wrap;
    width: var(--container-w);
    max-width: var(--container-max);
    margin: 0 auto;
}

.ck-city-card {
    width: clamp(128px, 14vw, 180px);
    padding: 14px;
    border-radius: 8px;
    background: #f7fafc;
    border: 1px solid #e6eef5;
    box-shadow: 0 8px 20px rgba(16,36,58,.06);
}

.ck-city-card img {
    width: 100%;
    height: auto;
    object-fit: contain;
    display: block;
}

/* ============================================================
   ALL SERVICES SLIDER
   ============================================================ */
.ck-all-services-section {
    padding: 66px 0 76px;
    background: var(--bg);
    text-align: center;
}

.ck-all-services-title {
    font-size: clamp(28px, 3.2vw, 38px);
    font-weight: 900;
    color: var(--ink);
}

.ck-all-services-line {
    width: 92px;
    height: 5px;
    margin: 12px auto 44px;
    border-radius: 50px;
    background: linear-gradient(90deg, #ef7d2d, #2f78bf);
}
.ck-service-slider {
    width: var(--container-w);
    max-width: 998px;
    height: 444px;
    margin: 0 auto;
    display: flex;
    gap: 7px;
    overflow: hidden;
    align-items: stretch;
    touch-action: pan-x;
}

/* .ck-service-slider {
    width: var(--container-w);
    max-width: 960px;
    height: 420px;
    margin: 0 auto;
    display: flex;
    gap: 10px;
    overflow: hidden;
    align-items: stretch;
    touch-action: pan-x;
} */

.ck-slide {
    flex: 1;
    min-width: 58px;
    border-radius: 8px;
    overflow: hidden;
    position: relative;
    box-shadow: 0 14px 28px rgba(16,36,58,.16);
    transition: flex .42s ease, transform .28s ease, box-shadow .28s ease;
    cursor: pointer;
}

.ck-slide.active { flex: 6.2; }

.ck-slide:not(.active) img {
    transform: scaleY(1.16);
    transform-origin: top;
}

.ck-slide:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 28px rgba(0,0,0,.20);
}

.ck-slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    filter: grayscale(100%);
    transition: filter .42s ease;
}

.ck-slide.active img { filter: grayscale(0%); }

.ck-slide-label {
    position: absolute;
    left: 12px;
    bottom: 16px;
    writing-mode: vertical-rl;
    transform: rotate(180deg);
    background: var(--blue-light);
    color: #fff;
    padding: 10px 7px;
    border-radius: 6px;
    font-size: 16px;
    font-weight: 800;
}

.ck-slide.active .ck-slide-label {
    writing-mode: initial;
    transform: none;
    left: 50%;
    translate: -50% 0;
    bottom: 64px;
    padding: 7px 30px;
    font-size: 14px;
    white-space: nowrap;
}

.ck-slide a {
    display: block;
    height: 100%;
    color: inherit;
    text-decoration: none;
    user-select: none;
    -webkit-user-drag: none;
}

/* ============================================================
   TESTIMONIALS
   ============================================================ */
.ck-testimonial-section {
    padding: 58px 0 68px;
    background: var(--bg);
}

.ck-testimonial-shell {
    width: min(96%, 1840px);
    margin: 0 auto;
}

.ck-testimonial-heading {
    margin-bottom: 32px;
    text-align: center;
}

.ck-testimonial-heading h2 {
    margin: 0;
    color: #252525;
    font-size: clamp(34px, 3.4vw, 58px);
    font-weight: 900;
    line-height: 1.05;
    text-transform: uppercase;
}

.ck-testimonial-line {
    width: min(42%, 770px);
    height: 5px;
    margin: 18px auto 0;
    border-radius: 5px;
    background: linear-gradient(90deg, #ee6b1d, #2478bb);
}

.ck-testimonial-grid {
    display: grid;
    grid-template-columns: repeat(5, minmax(0, 1fr));
    gap: 10px;
    align-items: start;
}

.ck-testimonial-card {
    position: relative;
    z-index: 0;
    display: block;
    aspect-ratio: 1509 / 1380;
    min-width: 0;
    outline: none;
    transform: translateY(0) scale(1);
    transition: transform 260ms ease;
}

.ck-testimonial-card img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: opacity 260ms ease;
}

.ck-testimonial-card .hover-state {
    position: absolute;
    inset: 0;
    opacity: 0;
}

.ck-testimonial-card:hover,
.ck-testimonial-card:focus-visible {
    z-index: 3;
    transform: translateY(-8px) scale(1.04);
}

.ck-testimonial-card:hover .default-state,
.ck-testimonial-card:focus-visible .default-state {
    opacity: 0;
}

.ck-testimonial-card:hover .hover-state,
.ck-testimonial-card:focus-visible .hover-state {
    opacity: 1;
}

@media (max-width: 768px) {
    .ck-testimonial-section {
        padding: 42px 0 50px;
    }

    .ck-testimonial-shell {
        width: min(92%, 680px);
    }

    .ck-testimonial-heading {
        margin-bottom: 24px;
    }

    .ck-testimonial-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .ck-testimonial-line {
        width: 120px;
        height: 4px;
    }
}

/* ============================================================
   FAQ
   ============================================================ */
.faq-section {
    padding: 70px 0 60px;
    background: #fff;
}

.faq-container {
    width: var(--container-w);
    max-width: 900px;
    margin: 0 auto;
}

.faq-heading {
    text-align: center;
    margin-bottom: 36px;
}

.faq-heading h2 {
    font-size: 32px;
    font-weight: 800;
    color: var(--ink);
}

.faq-heading-line {
    display: flex;
    justify-content: center;
    margin-top: 10px;
}

.faq-line-orange,
.faq-line-blue {
    width: 110px;
    height: 3px;
}

.faq-line-orange {
    background: #e97827;
    border-radius: 20px 0 0 20px;
}

.faq-line-blue {
    background: #2f78bf;
    border-radius: 0 20px 20px 0;
}

.faq-accordion {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.faq-item {
    background: #fff;
    border: 1px solid var(--line);
    border-radius: 8px;
    box-shadow: 0 10px 24px rgba(16,36,58,.06);
    overflow: hidden;
}

.faq-question {
    width: 100%;
    border: none;
    background: #fff;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 14px;
    text-align: left;
    padding: 20px 22px;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
}

.faq-icon {
    color: var(--blue);
    font-size: 22px;
    font-weight: 700;
    flex-shrink: 0;
}

.faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height .3s ease;
}

.faq-item.active .faq-answer { max-height: 300px; }

.faq-answer p {
    padding: 0 22px 20px;
    color: #555;
    font-size: 14px;
    line-height: 1.7;
}

/* ============================================================
   LOGIN MODAL
   ============================================================ */
.custom-modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.55);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 99999;
    padding: 20px;
}

.custom-modal-overlay.active { display: flex; }

.custom-modal-box {
    width: 100%;
    max-width: 420px;
    background: #fff;
    border-radius: 18px;
    padding: 28px 24px;
    position: relative;
}

.custom-modal-close {
    position: absolute;
    top: 10px;
    right: 14px;
    border: none;
    background: transparent;
    font-size: 28px;
    cursor: pointer;
    line-height: 1;
}

.custom-modal-header h3 {
    font-size: 24px;
    font-weight: 800;
    color: #1c2c3e;
}

.custom-modal-header p {
    font-size: 14px;
    color: #777;
    margin: 6px 0 22px;
}

.customer-login-methods {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 4px;
    margin: 0 0 20px;
    padding: 4px;
    border: 1px solid #d8e1ea;
    border-radius: 10px;
    background: #f4f7fa;
}

.customer-login-method {
    min-height: 40px;
    border: 0;
    border-radius: 7px;
    background: transparent;
    color: #536273;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
}

.customer-login-method.active {
    background: #fff;
    color: #0b4c82;
    box-shadow: 0 1px 4px rgba(28, 44, 62, 0.14);
}

.form-group { margin-bottom: 16px; }

.form-group label {
    display: block;
    margin-bottom: 7px;
    font-size: 13px;
    font-weight: 600;
}

.custom-input {
    width: 100%;
    height: 46px;
    border: 1px solid #d8d8d8;
    border-radius: 10px;
    padding: 0 14px;
    font-size: 14px;
    outline: none;
}

.error-text {
    display: block;
    margin-top: 5px;
    font-size: 12px;
    color: #dc2626;
}

.otp-success-msg {
    font-size: 13px;
    color: #15803d;
    margin-top: 8px;
}

.custom-modal-actions { margin-top: 16px; }

.modal-btn {
    width: 100%;
    border: none;
    border-radius: 10px;
    padding: 13px 18px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
}

.primary-btn { background: linear-gradient(180deg, #f58a3c, #f25c05); color: #fff; }
.verify-btn  { background: linear-gradient(180deg, #2f80c8, #1f67ab); color: #fff; }

/* ============================================================
   FREE PLAN MODAL
   ============================================================ */
.plan-modal-overlay {
    position: fixed;
    inset: 0;
    z-index: 100000;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 24px;
    background:
        radial-gradient(circle at 22% 18%, rgba(242, 92, 5, .22), transparent 28%),
        rgba(10, 18, 29, .72);
    backdrop-filter: blur(6px);
}

.plan-modal-overlay.active { display: flex; }

.plan-modal-box {
    width: min(100%, 860px);
    max-height: calc(100vh - 48px);
    overflow: hidden;
    position: relative;
    padding: 0;
    border: 1px solid rgba(255,255,255,.58);
    border-radius: 24px;
    background: linear-gradient(135deg, #fffaf6 0%, #ffffff 42%, #f4f8fb 100%);
    box-shadow: 0 34px 90px rgba(0,0,0,.36);
    scrollbar-gutter: stable;
}

.plan-modal-inner {
    display: grid;
    grid-template-columns: minmax(250px, .9fr) minmax(0, 1.1fr);
    min-height: 0;
}

.plan-modal-intro {
    position: relative;
    overflow: hidden;
    padding: 28px 26px;
    background:
        linear-gradient(160deg, rgba(22, 36, 51, .96), rgba(29, 54, 75, .94)),
        url('{{ asset('images/banner.webp') }}') center/cover;
    color: #fff;
}

.plan-modal-intro::after {
    content: "";
    position: absolute;
    inset: auto 24px 24px 24px;
    height: 1px;
    background: rgba(255,255,255,.18);
}

.plan-modal-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 12px;
    border-radius: 999px;
    background: rgba(255,255,255,.12);
    border: 1px solid rgba(255,255,255,.16);
    color: #ffe0cb;
    font-size: 13px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: .4px;
}

.plan-modal-badge::before {
    content: "";
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #25c26e;
    box-shadow: 0 0 0 5px rgba(37,194,110,.16);
}

.plan-modal-intro h3 {
    margin: 24px 0 10px;
    color: #fff;
    font-size: 28px;
    line-height: 1.12;
    font-weight: 900;
}

.plan-modal-intro p {
    margin: 0;
    color: rgba(255,255,255,.76);
    font-size: 15px;
    line-height: 1.55;
}

.plan-modal-points {
    display: grid;
    gap: 10px;
    margin-top: 24px;
}

.plan-modal-point {
    display: flex;
    align-items: center;
    gap: 10px;
    color: rgba(255,255,255,.9);
    font-size: 14px;
    font-weight: 700;
}

.plan-modal-point i {
    display: inline-grid;
    width: 28px;
    height: 28px;
    place-items: center;
    border-radius: 50%;
    background: rgba(255,115,23,.16);
    color: #ffb172;
}

.plan-modal-form {
    padding: 30px 34px 28px;
}

.plan-modal-close {
    position: absolute;
    top: 18px;
    right: 18px;
    z-index: 2;
    width: 38px;
    height: 38px;
    border: none;
    border-radius: 50%;
    background: rgba(15, 23, 42, .07);
    color: #334155;
    font-size: 28px;
    line-height: 1;
    cursor: pointer;
}

.plan-modal-close:hover {
    background: rgba(242, 92, 5, .12);
    color: #d63800;
}

.plan-modal-title {
    max-width: 420px;
    color: #111827;
    font-size: 28px;
    font-weight: 900;
    line-height: 1.12;
    margin-bottom: 8px;
}

.plan-modal-copy {
    max-width: 430px;
    color: #5f6773;
    font-size: 15px;
    line-height: 1.5;
    margin-bottom: 14px;
}

.plan-step-label {
    display: inline-flex;
    align-items: center;
    padding: 8px 12px;
    border-radius: 999px;
    background: #fff0e7;
    color: #c2410c;
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 14px;
}

.plan-step { display: none; }
.plan-step.active { display: block; }

.plan-form-group { margin-bottom: 12px; }

.plan-form-group label {
    display: block;
    margin-bottom: 7px;
    color: #263241;
    font-size: 14px;
    font-weight: 800;
}

.plan-input,
.plan-select {
    width: 100%;
    height: 46px;
    border: 1px solid #d9e1ea;
    border-radius: 12px;
    background: #fff;
    padding: 0 15px;
    color: #252b33;
    font-size: 15px;
    outline: none;
    box-shadow: 0 1px 0 rgba(15,23,42,.04);
}

.plan-input:focus,
.plan-select:focus {
    border-color: #ff7417;
    box-shadow: 0 0 0 3px rgba(255,116,23,.16);
}

.plan-otp-panel {
    padding: 14px;
    border: 1px solid #ffd7bd;
    border-radius: 14px;
    background: #fff8f2;
    box-shadow: 0 12px 24px rgba(242,92,5,.08);
}

.plan-otp-panel p {
    color: #4f4f4f;
    font-size: 14px;
    line-height: 1.25;
    margin-bottom: 10px;
}

.plan-outline-btn {
    min-height: 42px;
    padding: 0 15px;
    border: 1px solid #ff7417;
    border-radius: 11px;
    background: #fff;
    color: #9c2b0e;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
}

.plan-otp-row {
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 8px;
    align-items: center;
}

.plan-note,
.plan-status {
    color: #9b4b33;
    font-size: 14px;
    line-height: 1.4;
    text-align: left;
    margin: 10px 0;
}

.plan-status.success { color: #15803d; }
.plan-status.error { color: #dc2626; }

.plan-actions {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-top: 14px;
}

.plan-actions.single {
    grid-template-columns: 1fr;
}

.plan-primary-btn,
.plan-secondary-btn {
    min-height: 48px;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 800;
    cursor: pointer;
}

.plan-primary-btn {
    background: linear-gradient(180deg, #ff841d, #ff670f);
    color: #fff;
    box-shadow: 0 8px 18px rgba(255,103,15,.28);
}

.plan-secondary-btn {
    background: #fff;
    color: #444;
    box-shadow: 0 2px 8px rgba(0,0,0,.15);
}

.plan-privacy {
    display: none;
    align-items: center;
    justify-content: flex-start;
    gap: 10px;
    margin: 16px 34px 34px;
    padding: 10px 14px;
    border: 1px solid #e4ebf2;
    border-radius: 12px;
    background: rgba(255,255,255,.72);
    color: #555;
    font-size: 13px;
    font-style: italic;
}

.plan-privacy svg {
    width: 18px;
    height: 18px;
    color: #ff7417;
}

.smooth-reveal {
    opacity: 0;
    transform: translateY(26px);
    transition: opacity .65s ease, transform .65s ease;
}

.smooth-reveal.is-visible {
    opacity: 1;
    transform: translateY(0);
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

    .smooth-reveal {
        opacity: 1;
        transform: none;
    }
}

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media (max-width: 1200px) {
    .ck-testimonial-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
    }
}

@media (max-width: 991px) {
    .section-heading {
        margin-bottom: 36px;
    }

    .hero-banner {
        min-height: 420px;
        background-position: 62% center;
    }

    .hero-content {
        max-width: 560px;
    }

    .ck-trust-container {
        grid-template-columns: repeat(2, 1fr);
        gap: 28px;
    }

    .ck-services-grid,
    .explore-services-grid,
    .ck-process-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 72px 28px;
    }

    .ck-assurance-shell {
        grid-template-columns: 1fr;
    }

    .ck-assurance-list {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 24px;
    }

    .ck-solution-shell {
        grid-template-columns: 1fr;
    }

    .ck-solution-headline {
        grid-template-columns: 1fr;
        gap: 10px;
    }

    .ck-solution-headline span {
        font-size: 30px;
    }

    .ck-solution-options {
        width: 100%;
        gap: 40px;
        margin-top: 32px;
    }

    .ck-solution-card h3 { font-size: 26px; }
    .ck-solution-list li { font-size: 19px; }

    .ck-service-card,
    .explore-card {
        max-width: 460px;
        margin: 0 auto;
        width: 100%;
    }

    .ck-guide-container {
        grid-template-columns: 1fr;
        gap: 24px;
    }

    .ck-guide-image-box {
        min-height: 240px;
        aspect-ratio: 16 / 8;
    }

    .ck-vendor-container {
        grid-template-columns: 1fr;
    }

    .ck-vendor-image-box {
        min-height: 260px;
        aspect-ratio: 16 / 8;
    }

    .ck-city-grid {
        gap: 26px;
    }
}

@media (max-width: 768px) {
    .ck-services-grid,
    .explore-services-grid,
    .ck-process-grid,
    .ck-solution-options,
    .ck-assurance-list {
        grid-template-columns: 1fr;
    }

    .ck-compare-table {
        overflow-x: auto;
    }

    .ck-compare-row {
        min-width: 720px;
    }

    .ck-service-slider {
        height: clamp(250px, 58vw, 360px);
        max-width: calc(100% - 32px);
        flex-direction: row;
        gap: 6px;
        overflow-x: auto;
        overflow-y: hidden;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
        overscroll-behavior-x: contain;
        padding: 0 0 12px;
    }

    .ck-slide,
    .ck-slide.active {
        height: 100%;
        min-width: 0;
        width: auto;
        scroll-snap-align: center;
    }

    .ck-slide { flex: 0 0 58px; }
    .ck-slide.active { flex: 0 0 min(70vw, 330px); }

    .ck-slide img { filter: grayscale(0%); }

    .ck-slide-label {
        writing-mode: vertical-rl;
        transform: rotate(180deg);
        left: 8px;
        bottom: 12px;
        translate: 0;
        padding: 8px 5px;
        font-size: 13px;
        white-space: nowrap;
    }

    .ck-slide.active .ck-slide-label {
        writing-mode: vertical-rl;
        transform: rotate(180deg);
        left: 8px;
        bottom: 12px;
        translate: 0;
        padding: 8px 5px;
        font-size: 13px;
    }

}

@media (max-width: 576px) {
    :root {
        --container-w: calc(100% - 32px);
    }

    .section-container,
    .ck-trust-container,
    .ck-guide-container,
    .ck-vendor-container,
    .ck-solution-shell,
    .ck-assurance-shell,
    .faq-container {
        width: calc(100% - 32px);
    }

    .hero-banner {
        min-height: auto;
        padding: 64px 0;
        background-image:
            linear-gradient(90deg, rgba(8,18,32,.92), rgba(8,18,32,.68)),
            image-set(
                url("{{ asset('images/banner-mobile.webp') }}") type("image/webp"),
                url("{{ asset('images/banner.jpg') }}") type("image/jpeg")
            );
        background-position: 70% center;
    }

    .hero-inner {
        width: calc(100% - 32px);
    }

    .hero-content      { max-width: 100%; }
    .hero-tech-badge {
        min-height: 36px;
        margin-bottom: 18px;
        padding: 7px 14px;
        gap: 8px;
        font-size: 11px;
        letter-spacing: .8px;
        line-height: 1.25;
        text-align: center;
        white-space: normal;
    }
    .hero-tech-badge::before {
        width: 8px;
        height: 8px;
        flex-basis: 8px;
    }
    .hero-title        { font-size: clamp(28px, 8vw, 34px); }
    .hero-subtitle     { font-size: 17px; }
    .hero-description  { font-size: 13px; }
    .hero-plan-btn {
        width: 100%;
        margin-left: 0;
        min-height: 50px;
        padding: 0 16px;
        font-size: 14px;
        border-radius: 8px;
    }

    .hero-proof-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .hero-proof-item {
        min-height: 70px;
    }

    .ck-process-section,
    .ck-solution-section,
    .ck-assurance-section,
    .ck-compare-section {
        padding: 52px 0;
    }

    .ck-compare-section {
        padding: 28px 0 34px;
    }

    .ck-compare-shell {
        width: min(92vw, 700px);
    }

    .ck-solution-section { padding: 36px 0; }

    .ck-solution-intro {
        padding: 0;
    }

    .ck-solution-badge { font-size: 11px; }
    .ck-solution-headline span { font-size: 25px; }
    .ck-solution-intro p { font-size: 16px; }
    .ck-solution-options { margin-top: 26px; gap: 22px; }
    .ck-solution-card { padding: 0; }
    .ck-solution-card h3 { font-size: 22px; }
    .ck-solution-card p { font-size: 15px; }
    .ck-solution-list { gap: 11px; }
    .ck-solution-list li { padding-left: 22px; font-size: 16px; }
    .ck-solution-list li::before { width: 9px; height: 9px; }

    .ck-assurance-panel {
        padding: 0;
    }

    .ck-assurance-eyebrow { margin-bottom: 18px; font-size: 12px; }
    .ck-assurance-panel h2 { font-size: 27px; }
    .ck-assurance-panel p { font-size: 16px; }

    .plan-modal-box {
        max-height: calc(100vh - 28px);
        overflow-y: auto;
        border-radius: 20px;
    }

    .plan-modal-inner {
        display: block;
        min-height: 0;
    }

    .plan-modal-intro {
        padding: 24px 22px;
    }

    .plan-modal-intro h3 {
        margin-top: 18px;
        font-size: 24px;
    }

    .plan-modal-points {
        grid-template-columns: 1fr;
        gap: 8px;
        margin-top: 18px;
    }

    .plan-modal-form {
        padding: 24px 22px;
    }

    .plan-modal-title {
        padding-right: 34px;
        font-size: 25px;
    }

    .plan-modal-copy,
    .plan-step-label,
    .plan-form-group label,
    .plan-note,
    .plan-status {
        font-size: 15px;
    }

    .plan-actions {
        grid-template-columns: 1fr;
    }

    .plan-otp-row {
        grid-template-columns: 1fr;
    }

    .plan-privacy {
        margin: 0 22px 24px;
    }

    .section-heading h2,
    .ck-all-services-title,
    .ck-testimonial-heading h2,
    .upcoming-services-heading h2,
    .ck-city-title {
        font-size: 28px;
        line-height: 1.2;
    }

    .heading-bar,
    .upcoming-heading-line,
    .ck-all-services-line,
    .ck-testimonial-line {
        width: 92px;
    }

    .ck-trust-section { padding: 34px 0 40px; }
    .ck-trust-heading { margin-bottom: 30px; }
    .ck-trust-container { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px; }
    .ck-services-section { padding: 76px 0 48px; }

    .ck-service-image {
        width: 86%;
        height: auto;
        margin-top: -44px;
    }

    .explore-card-image { aspect-ratio: 16 / 9; }

    .ck-guide-section,
    .ck-vendor-section,
    .ck-city-section,
    .ck-all-services-section,
    .ck-testimonial-section,
    .faq-section {
        padding-top: 46px;
        padding-bottom: 46px;
    }

    .ck-guide-image-box,
    .ck-guide-content-box,
    .ck-vendor-content-box,
    .ck-vendor-image-box {
        border-radius: 8px;
        min-height: 230px;
    }

    .ck-guide-content-box,
    .ck-vendor-content-box {
        padding: 28px 20px;
    }

    .ck-guide-title   { font-size: 21px; }
    .ck-guide-text    { font-size: 15px; }
    .ck-guide-btn     { font-size: 15px; padding: 0 16px; width: 100%; white-space: normal; min-height: 50px; height: auto; }

    .ck-vendor-title  { font-size: 22px; }
    .ck-vendor-text   { font-size: 16px; }
    .ck-vendor-btn    { width: 100%; font-size: 16px; min-height: 50px; height: auto; padding: 12px 18px; }
    .ck-vendor-image-box { min-height: 220px; }

    .ck-city-grid     { gap: 18px 14px; }
    .ck-city-card     { width: calc(50% - 14px); max-width: 138px; }

    .upcoming-services-section { padding: 46px 0; }
    .upcoming-services-heading { margin-bottom: 26px; }
    .upcoming-auto-scroll-track { gap: 16px; animation-duration: 30s; }
    .upcoming-card    { width: 76vw; min-width: 76vw; max-width: 290px; border-radius: 8px; }
    .upcoming-card-image { height: 170px; }

    .ck-testimonial-grid {
        grid-template-columns: 1fr;
        gap: 18px;
    }

    .ck-testimonial-card {
        width: min(100%, 420px);
        margin: 0 auto;
    }

    #comingSoonLocationBox {
        width: calc(100% - 32px);
        margin: 32px auto;
        padding: 28px 18px;
    }

    #comingSoonLocationBox h2 {
        font-size: 23px;
        line-height: 1.25;
    }

    #comingSoonLocationBox p {
        font-size: 14px;
    }
}

@media (max-width: 380px) {
    .ck-trust-container {
        grid-template-columns: 1fr;
    }

    .ck-trust-item {
        max-width: 454px;
        margin: 0 auto;
    }


    .ck-service-card,
    .explore-card {
        border-radius: 14px;
    }

    .ck-slide,
    .ck-slide.active {
        min-width: 0;
    }

    .ck-service-slider {
        height: 230px;
        gap: 5px;
    }

    .ck-slide-label,
    .ck-slide.active .ck-slide-label {
        left: 6px;
        bottom: 10px;
        font-size: 11px;
        padding: 7px 4px;
    }

    .ck-slide { flex-basis: 48px; }
    .ck-slide.active { flex-basis: min(72vw, 260px); }
}


#comingSoonLocationBox {
    max-width: 1100px;
    margin: 45px auto;
    padding: 38px 20px;
    background: #fff4ec;
    border: 1px solid #ffd6bd;
    border-radius: 18px;
    text-align: center;
}

#comingSoonLocationBox h2 {
    color: #1c2c3e;
    font-size: 28px;
    font-weight: 800;
    margin-bottom: 10px;
}

#comingSoonLocationBox p {
    color: #555;
    font-size: 16px;
}

.hero-banner .hero-inner .hero-content .hero-plan-btn {
    position: relative;
    left: calc(50vw - max(4vw, calc(50vw - 660px)));
    top: -156px;
    width: auto;
    min-height: 44px;
    padding: 0 22px;
    margin-left: 0;
    transform: translateX(-50%);
    border: 1px solid #666;
    background: #454545;
    color: #fff;
    font-size: 14px;
    box-shadow: 0 8px 22px rgba(0, 0, 0, .25);
    transition: background-color .25s ease, border-color .25s ease, box-shadow .25s ease, transform .25s ease;
}

.hero-banner .hero-inner .hero-content .hero-plan-btn:hover {
    transform: translateX(-50%) translateY(-2px);
    border-color: #f58220;
    background: #f58220;
    color: #fff;
    box-shadow: 0 10px 24px rgba(245, 130, 32, .35);
}

@media (max-width: 576px) {
    .hero-banner .hero-inner .hero-content .hero-plan-btn {
        left: calc(50vw - 16px);
        top: -60px;
        min-height: 42px;
        padding: 0 16px;
    }
}

.home-page .hero-banner {
    overflow: visible;
    margin-bottom: 130px;
    z-index: 2;
}

.home-page .ck-trust-section {
    position: relative;
    z-index: 1;
}

.hero-discovery-card {
    position: absolute;
    z-index: 5;
    left: 50%;
    bottom: -110px;
    width: min(90%, 1720px);
    padding: 24px 35px 26px;
    border: 1px solid #2478bb;
    border-radius: 18px;
    background: #fff;
    box-shadow: 0 12px 28px rgba(20, 43, 65, .12);
    transform: translateX(-50%);
}

.hero-discovery-search {
    min-height: 76px;
    display: flex;
    align-items: center;
    padding: 8px 10px 8px 22px;
    border: 1px solid #2478bb;
    border-radius: 48px;
    background: #f5f5f5;
}

.hero-discovery-location {
    min-width: 0;
    height: 48px;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 0 18px 0 0;
    border: 0;
    border-right: 2px solid #2478bb;
    background: transparent;
    color: #303030;
    font-size: 17px;
    font-weight: 700;
    text-align: left;
    cursor: pointer;
}

.hero-discovery-location svg {
    flex: 0 0 auto;
    color: #2478bb;
}

.hero-discovery-location svg:first-child {
    width: 22px;
    height: 26px;
}

.hero-discovery-location svg:last-child {
    width: 14px;
    height: 14px;
}

.hero-discovery-location span {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.hero-discovery-input-wrap {
    position: relative;
    width: 100%;
    min-width: 0;
    display: flex;
    align-items: center;
    gap: 12px;
    padding-left: 0;
}

.hero-discovery-input-wrap > svg {
    flex: 0 0 auto;
    width: 22px;
    height: 22px;
    color: #2478bb;
}

.hero-discovery-input {
    width: 100%;
    min-width: 0;
    height: 50px;
    padding: 0;
    border: 0;
    outline: 0;
    background: transparent;
    color: #303030;
    font-size: 17px;
}

.hero-discovery-input::placeholder {
    color: #929292;
    opacity: 1;
}

.hero-discovery-submit {
    flex: 0 0 auto;
    min-width: 124px;
    height: 50px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 0 22px;
    border: 0;
    border-radius: 999px;
    background: #2478bb;
    color: #fff;
    font-size: 17px;
    font-weight: 700;
    cursor: pointer;
    transition: background-color .2s ease, transform .2s ease;
}

.hero-discovery-submit:hover {
    background: #135f9d;
    transform: translateY(-1px);
}

.hero-discovery-submit svg {
    display: block;
    width: 22px;
    height: 22px;
}

.hero-discovery-status {
    position: absolute;
    top: calc(100% + 6px);
    left: 0;
    z-index: 2;
    padding: 6px 10px;
    border-radius: 5px;
    background: #fff;
    color: #b42318;
    font-size: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, .12);
}

.hero-discovery-status:empty {
    display: none;
}

.hero-discovery-highlights {
    display: grid;
    grid-template-columns: repeat(6, minmax(0, 1fr));
    grid-auto-rows: 72px;
    align-items: center;
    gap: 18px;
    margin-top: 26px;
}

.hero-discovery-highlight {
    min-width: 0;
    display: flex;
    align-items: center;
    gap: 12px;
}

.hero-discovery-highlight.has-image {
    width: 100%;
    height: 72px;
    display: grid;
    place-items: center;
}

.hero-discovery-highlight-image {
    display: block;
    width: auto;
    max-width: none;
    height: 68px;
    margin: 0;
    object-fit: contain;
    object-position: center;
}

.hero-discovery-image-swap {
    position: relative;
    display: grid;
    place-items: center;
    width: 259px;
    max-width: none;
    height: 68px;
}

.hero-discovery-image-swap .hero-discovery-highlight-image {
    transition: opacity .25s ease, transform .25s ease;
}

.hero-discovery-highlight-image.hover-state {
    position: absolute;
    top: 0;
    left: 50%;
    opacity: 0;
    transform: translateX(-50%);
}

.hero-discovery-highlight:hover .default-state,
.hero-discovery-highlight:focus-within .default-state {
    opacity: 0;
}

.hero-discovery-highlight:hover .hover-state,
.hero-discovery-highlight:focus-within .hover-state {
    opacity: 1;
}

.hero-discovery-highlight:hover .hero-discovery-highlight-image,
.hero-discovery-highlight:focus-within .hero-discovery-highlight-image {
    transform: translateY(-2px);
}

.hero-discovery-highlight:hover .hero-discovery-highlight-image.hover-state,
.hero-discovery-highlight:focus-within .hero-discovery-highlight-image.hover-state {
    transform: translateX(-50%) translateY(-2px);
}

.hero-discovery-highlight:not(.has-image) .hero-discovery-icon {
    flex-basis: 72px;
    width: 72px;
    height: 72px;
}

.hero-discovery-highlight:not(.has-image) .hero-discovery-icon svg {
    width: 38px;
    height: 38px;
}

.hero-discovery-highlight:not(.has-image) .hero-discovery-copy {
    font-size: 13px;
}

.hero-discovery-highlight:not(.has-image) .hero-discovery-copy strong {
    font-size: 16px;
    white-space: normal;
}

.hero-discovery-icon {
    flex: 0 0 48px;
    width: 48px;
    height: 48px;
    display: grid;
    place-items: center;
    border-radius: 6px;
    background: linear-gradient(145deg, #247fc2, #07508b);
    color: #fff;
    font-size: 26px;
}

.hero-discovery-icon svg {
    display: block;
    width: 29px;
    height: 29px;
}

.hero-discovery-copy {
    min-width: 0;
    margin: 0;
    color: #343434;
    font-size: 12px;
    line-height: 1.2;
}

.hero-discovery-copy strong {
    display: block;
    margin-bottom: 3px;
    font-size: 13px;
    font-weight: 800;
    line-height: 1.15;
    white-space: nowrap;
}

@media (max-width: 1700px) {
    .hero-discovery-card {
        width: min(94%, 1720px);
        padding: 22px 24px 26px;
    }

    .hero-discovery-highlights {
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 10px;
        margin-top: 28px;
    }

    .hero-discovery-image-swap,
    .hero-discovery-highlight.has-image {
        height: 56px;
    }

    .hero-discovery-image-swap {
        width: 214px;
    }

    .hero-discovery-highlight-image {
        height: 56px;
    }
}

@media (max-width: 1000px) {
    .hero-discovery-highlights {
        grid-template-columns: repeat(6, 214px);
        overflow-x: auto;
        overflow-y: hidden;
        padding: 4px 0 10px;
        scrollbar-width: thin;
    }
}

@media (max-width: 768px) {
    .home-page .hero-banner {
        flex-direction: column;
        gap: 24px;
        margin-bottom: 0;
        padding-bottom: 28px;
    }

    .hero-discovery-card {
        position: relative;
        left: auto;
        bottom: auto;
        width: calc(100% - 32px);
        margin: 0 auto;
        padding: 16px;
        transform: none;
    }

    .hero-discovery-search {
        padding: 8px 8px 8px 14px;
        border-radius: 16px;
    }

    .hero-discovery-location {
        width: 100%;
        height: 42px;
        padding: 0 2px 7px;
        border-right: 0;
        border-bottom: 1px solid #2478bb;
        font-size: 15px;
    }

    .hero-discovery-input-wrap {
        gap: 8px;
        padding-left: 0;
    }

    .hero-discovery-input {
        height: 42px;
        font-size: 14px;
    }

    .hero-discovery-submit {
        min-width: 48px;
        width: 48px;
        height: 42px;
        padding: 0;
    }

    .hero-discovery-submit span {
        position: absolute;
        width: 1px;
        height: 1px;
        overflow: hidden;
        clip: rect(0 0 0 0);
        white-space: nowrap;
    }

    .hero-discovery-highlights {
        grid-template-columns: repeat(6, 214px);
        gap: 16px 10px;
        margin-top: 20px;
    }

    .hero-discovery-highlight {
        align-items: flex-start;
        gap: 8px;
    }

    .hero-discovery-icon {
        flex-basis: 40px;
        width: 40px;
        height: 40px;
        font-size: 19px;
    }

    .hero-discovery-icon svg {
        width: 24px;
        height: 24px;
    }

    .hero-discovery-copy {
        font-size: 10px;
    }

    .hero-discovery-copy strong {
        font-size: 10px;
        white-space: normal;
    }
}
</style>
@endpush

@section('content')

<div class="home-page">

    {{-- ── HERO ── --}}

<section class="hero-banner">
    <div class="hero-inner">
        <div class="hero-content">

            <button type="button" class="hero-plan-btn" id="openPlanModalBtn">
                <span>GET END-TO-END CONSTRUCTION PLAN</span>

                <svg viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2.8"
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     aria-hidden="true">
                    <path d="M5 12h14"></path>
                    <path d="m13 6 6 6-6 6"></path>
                </svg>
            </button>

        </div>
    </div>
    <div class="hero-discovery-card">
        <div class="hero-discovery-search">
            <form class="hero-discovery-input-wrap" id="heroDiscoverySearchForm" role="search">
                <input class="hero-discovery-input" id="heroDiscoverySearchInput" type="search" list="heroServiceSuggestions" autocomplete="off" placeholder="Search Architects, Contractors, Feasibility Reports, BOQ Services & More..." aria-label="Search construction services">
                <datalist id="heroServiceSuggestions">
                    <option value="Architect"></option>
                    <option value="Contractor"></option>
                    <option value="Interior Design"></option>
                    <option value="Survey Services"></option>
                    <option value="Structural Services"></option>
                    <option value="Structural Audit"></option>
                    <option value="BOQ / Estimation"></option>
                    <option value="Testing Services"></option>
                    <option value="Facade Services"></option>
                    <option value="Welding & Fabrication"></option>
                    <option value="Feasibility Report"></option>
                    <option value="Residential Architectural Planning"></option>
                    <option value="Bungalow and Villa Design"></option>
                    <option value="Apartment and Flat Layout Planning"></option>
                    <option value="Commercial Building Design"></option>
                    <option value="Office Planning"></option>
                    <option value="Showroom Planning"></option>
                    <option value="Farmhouse Design"></option>
                    <option value="Plot Development Planning"></option>
                    <option value="Elevation and Facade Design"></option>
                    <option value="Floor Plan Design"></option>
                    <option value="Space Planning"></option>
                    <option value="Concept Design"></option>
                    <option value="Renovation Planning"></option>
                    <option value="Approval Drawing Support"></option>
                    <option value="Submission Drawing Assistance"></option>
                    <option value="Basic Design Consultation"></option>
                </datalist>
                <button class="hero-discovery-submit" type="submit" aria-label="Search">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="10.8" cy="10.8" r="7.2"/><path d="m16 16 5 5"/></svg>
                    <span>Search</span>
                </button>
                <span class="hero-discovery-status" id="heroDiscoverySearchStatus" role="status" aria-live="polite"></span>
            </form>
        </div>

        <div class="hero-discovery-highlights" aria-label="Why choose ConstructKaro">
            <div class="hero-discovery-highlight has-image">
                <span class="hero-discovery-image-swap">
                    <img class="hero-discovery-highlight-image default-state" src="{{ asset('images/home/highlights/1.png') }}" alt="20+ Years - Construction Experience" width="275" height="72" loading="eager" decoding="async">
                    <img class="hero-discovery-highlight-image hover-state" src="{{ asset('images/home/highlights/11.png') }}" alt="" width="275" height="72" loading="eager" decoding="async" aria-hidden="true">
                </span>
            </div>
            <div class="hero-discovery-highlight has-image">
                <span class="hero-discovery-image-swap">
                    <img class="hero-discovery-highlight-image default-state" src="{{ asset('images/home/highlights/2.png') }}" alt="8+ Services - Construction Categories" width="275" height="72" loading="eager" decoding="async">
                    <img class="hero-discovery-highlight-image hover-state" src="{{ asset('images/home/highlights/22.png') }}" alt="" width="275" height="72" loading="eager" decoding="async" aria-hidden="true">
                </span>
            </div>
            <div class="hero-discovery-highlight has-image">
                <span class="hero-discovery-image-swap">
                    <img class="hero-discovery-highlight-image default-state" src="{{ asset('images/home/highlights/3.png') }}" alt="5+ Locations - Cities and Regions Served" width="275" height="72" loading="eager" decoding="async">
                    <img class="hero-discovery-highlight-image hover-state" src="{{ asset('images/home/highlights/33.png') }}" alt="" width="275" height="72" loading="eager" decoding="async" aria-hidden="true">
                </span>
            </div>
            <div class="hero-discovery-highlight has-image">
                <span class="hero-discovery-image-swap">
                    <img class="hero-discovery-highlight-image default-state" src="{{ asset('images/home/highlights/4.png') }}" alt="On-site Support - Execution Assistance" width="275" height="72" loading="eager" decoding="async">
                    <img class="hero-discovery-highlight-image hover-state" src="{{ asset('images/home/highlights/44.png') }}" alt="" width="275" height="72" loading="eager" decoding="async" aria-hidden="true">
                </span>
            </div>
            <div class="hero-discovery-highlight has-image">
                <span class="hero-discovery-image-swap">
                    <img class="hero-discovery-highlight-image default-state" src="{{ asset('images/home/highlights/5.png') }}" alt="Clear Pricing - Transparent Approach" width="275" height="72" loading="eager" decoding="async">
                    <img class="hero-discovery-highlight-image hover-state" src="{{ asset('images/home/highlights/55.png') }}" alt="" width="275" height="72" loading="eager" decoding="async" aria-hidden="true">
                </span>
            </div>
            <div class="hero-discovery-highlight has-image">
                <span class="hero-discovery-image-swap">
                    <img class="hero-discovery-highlight-image default-state" src="{{ asset('images/home/highlights/6.png') }}" alt="Within 24 Hours - Requirement Response" width="275" height="72" loading="eager" decoding="async">
                    <img class="hero-discovery-highlight-image hover-state" src="{{ asset('images/home/highlights/66.png') }}" alt="" width="275" height="72" loading="eager" decoding="async" aria-hidden="true">
                </span>
            </div>
        </div>
    </div>
</section>
    {{-- ── TRUST STRIP ── --}}
    <section class="ck-trust-section">
        <div class="ck-trust-heading">
            <h2>How ConstructKaro Works</h2>
            <div class="ck-trust-heading-line"></div>
        </div>

        <div class="ck-trust-container">
            <div class="ck-process-image-swap">
                {!! $ckImage('images/home/process/share-requirement-matched.png', 'How ConstructKaro works in four steps', 'ck-trust-card-img ck-process-image-before', ['width' => 7138, 'height' => 1192, 'loading' => 'eager', 'decoding' => 'async']) !!}
                {!! $ckImage('images/home/process/share-requirement-hour.png', 'How ConstructKaro works with 24 hour response', 'ck-trust-card-img ck-process-image-after', ['width' => 7362, 'height' => 1276, 'loading' => 'eager', 'decoding' => 'async', 'aria-hidden' => 'true']) !!}
            </div>
         
        </div>
    </section>

    {{-- ── MAIN SERVICE CARDS ── --}}
  
   

    <section class="ck-solution-section">
        <div class="ck-solution-shell">
            <div class="ck-solution-intro">
                <span class="ck-solution-badge">One platform, any construction need</span>
                <h2 class="ck-solution-headline">
                    <span>Best for complete end-to-end construction.</span>
                    <span>Flexible for separate services too.</span>
                </h2>
                <p>Whether you want ConstructKaro to guide the full journey from planning to execution, or you only need one service like an architect, contractor, survey, BOQ, testing, or facade, we help you find the right solution without confusion.</p>
            </div>

            <div class="ck-solution-options">
                <div class="ck-solution-card primary">
                    {!! $ckImage('images/home/solutions/end-to-end-solution.png', 'End-to-End Construction Solution', 'ck-solution-card-img default-state', ['width' => 2792, 'height' => 1684, 'loading' => 'eager', 'decoding' => 'async']) !!}
                    {!! $ckImage('images/home/solutions/end-to-end-solution-hover.png', '', 'ck-solution-card-img hover-state', ['width' => 2901, 'height' => 1750, 'loading' => 'eager', 'decoding' => 'async', 'aria-hidden' => true]) !!}
                </div>

                <div class="ck-solution-card secondary">
                    {!! $ckImage('images/home/solutions/separate-service-solutions.png', 'Separate Service Solutions', 'ck-solution-card-img default-state', ['width' => 2792, 'height' => 1684, 'loading' => 'eager', 'decoding' => 'async']) !!}
                    {!! $ckImage('images/home/solutions/separate-service-solutions-hover.png', '', 'ck-solution-card-img hover-state', ['width' => 2901, 'height' => 1750, 'loading' => 'eager', 'decoding' => 'async', 'aria-hidden' => true]) !!}
                </div>
            </div>
        </div>
    </section>

    <div id="comingSoonLocationBox" style="display:none;">
        <h2>We are coming soon for this location</h2>
        <p>Currently, our services are not available in your selected area. We are expanding soon.</p>
    </div>
    @php
        $ourServices = [
            ['name' => 'Architect', 'image' => 'architect.png', 'hover' => 'architect-hover.png', 'url' => route('post', ['work_type_id' => 2]), 'login' => true],
            ['name' => 'Contractor', 'image' => 'contractor.png', 'hover' => 'contractor-hover.png', 'url' => route('post', ['work_type_id' => 1]), 'login' => true],
            ['name' => 'Feasibility Report', 'image' => 'feasibility-report.png', 'hover' => 'feasibility-report-hover.png', 'modal' => true],
            ['name' => 'Survey Services', 'image' => 'survey-services.png', 'hover' => 'survey-services-hover.png', 'url' => route('customer.survey'), 'login' => true],
            ['name' => 'Structural Audit', 'image' => 'structural-audit.png', 'hover' => 'structural-audit-hover.png', 'url' => route('customer.structuralaudit'), 'login' => true],
            ['name' => 'BOQ / Estimation', 'image' => 'boq-estimation.png', 'hover' => 'boq-estimation-hover.png', 'url' => route('customer.boq'), 'login' => true],
            ['name' => 'Welding & Fabrication', 'image' => 'welding-fabrication.png', 'hover' => 'welding-fabrication-hover.png', 'url' => route('customer.welding_fabrication'), 'login' => true],
            ['name' => 'Testing Services', 'image' => 'testing-services.png', 'hover' => 'testing-services-hover.png', 'url' => route('customer.testing'), 'login' => true],
            ['name' => 'Facade Services', 'image' => 'facade-services.png', 'hover' => 'facade-services-hover.png', 'url' => route('customer.facade'), 'login' => true],
        ];
    @endphp

    <section class="our-services-section" id="mainServicesSection">
        <div class="our-services-shell">
            <div class="our-services-heading">
                <h2>Our Services</h2>
                <div class="our-services-heading-line"></div>
                <h3>Everything Your Project Needs, <span>All in One Place.</span></h3>
                <p>From architecture and survey to contracting, BOQ, testing, facade, fabrication and more.</p>
            </div>

            <div class="our-services-grid">
                @foreach($ourServices as $service)
                    @if(!empty($service['modal']))
                        <a href="#freePlanModal"
                           class="our-service-card open-plan-modal-btn"
                           aria-label="{{ $service['name'] }}"
                           aria-haspopup="dialog"
                           aria-controls="freePlanModal">
                            {!! $ckImage('images/home/services/' . $service['image'], $service['name'], 'default-state', ['width' => 345, 'height' => 419, 'loading' => 'lazy', 'decoding' => 'async']) !!}
                            {!! $ckImage('images/home/services/' . $service['hover'], '', 'hover-state', ['width' => 366, 'height' => 443, 'loading' => 'lazy', 'decoding' => 'async', 'aria-hidden' => true]) !!}
                        </a>
                    @else
                        <a href="{{ $service['url'] }}"
                           class="our-service-card{{ !$isCustomerLoggedIn && !empty($service['login']) ? ' open-customer-login-modal' : '' }}"
                           @if(!$isCustomerLoggedIn && !empty($service['login'])) data-redirect="{{ $service['url'] }}" @endif
                           aria-label="{{ $service['name'] }}">
                            {!! $ckImage('images/home/services/' . $service['image'], $service['name'], 'default-state', ['width' => 345, 'height' => 419, 'loading' => 'lazy', 'decoding' => 'async']) !!}
                            {!! $ckImage('images/home/services/' . $service['hover'], '', 'hover-state', ['width' => 366, 'height' => 443, 'loading' => 'lazy', 'decoding' => 'async', 'aria-hidden' => true]) !!}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── GUIDE ── --}}
    <section class="ck-assurance-section">
        <div class="ck-assurance-shell">
            <div class="ck-assurance-panel">
                <span class="ck-assurance-eyebrow">Why Choose Us</span>
                <h2>Construction support built on systems, not guesswork.</h2>
                <p>ConstructKaro brings planning, vendor discovery, service selection, and execution support into one organised experience, so customers do not have to manage everything blindly.</p>
            </div>

            <div class="ck-assurance-list">
                <div class="ck-assurance-item">
                    {!! $ckImage('images/home/assurance/verified-network.png', 'Verified service network', 'default-state', ['width' => 437, 'height' => 326, 'loading' => 'lazy', 'decoding' => 'async']) !!}
                    {!! $ckImage('images/home/assurance/verified-network-hover.png', '', 'hover-state', ['width' => 462, 'height' => 346, 'loading' => 'lazy', 'decoding' => 'async', 'aria-hidden' => true]) !!}
                </div>
                <div class="ck-assurance-item">
                    {!! $ckImage('images/home/assurance/transparent-pricing.png', 'Transparent pricing approach', 'default-state', ['width' => 437, 'height' => 326, 'loading' => 'lazy', 'decoding' => 'async']) !!}
                    {!! $ckImage('images/home/assurance/transparent-pricing-hover.png', '', 'hover-state', ['width' => 460, 'height' => 346, 'loading' => 'lazy', 'decoding' => 'async', 'aria-hidden' => true]) !!}
                </div>
                <div class="ck-assurance-item">
                    {!! $ckImage('images/home/assurance/fast-response.png', 'Fast requirement response', 'default-state', ['width' => 437, 'height' => 326, 'loading' => 'lazy', 'decoding' => 'async']) !!}
                    {!! $ckImage('images/home/assurance/fast-response-hover.png', '', 'hover-state', ['width' => 460, 'height' => 346, 'loading' => 'lazy', 'decoding' => 'async', 'aria-hidden' => true]) !!}
                </div>
                <div class="ck-assurance-item">
                    {!! $ckImage('images/home/assurance/end-to-end-path.png', 'End-to-end path', 'default-state', ['width' => 437, 'height' => 326, 'loading' => 'lazy', 'decoding' => 'async']) !!}
                    {!! $ckImage('images/home/assurance/end-to-end-path-hover.png', '', 'hover-state', ['width' => 460, 'height' => 346, 'loading' => 'lazy', 'decoding' => 'async', 'aria-hidden' => true]) !!}
                </div>
            </div>
        </div>
    </section>

    <section class="ck-guide-section">
        <div class="ck-guide-container">
            <div class="ck-guide-image-box">
                {!! $ckImage('images/logo/confused-customer.jpg', 'Confused Customer', '', ['width' => 520, 'height' => 320, 'loading' => 'lazy', 'decoding' => 'async']) !!}
            </div>

            <div class="ck-guide-content-box">
                <h2 class="ck-guide-title">
                    Confused About Which Construction Service or
                    Package to Choose for Your Project?
                </h2>
                <p class="ck-guide-text">
                    From initial planning to complete project execution, ConstructKaro
                    guides you with the right services at every stage.
                </p>
                <a href="{{ route('confused_guide_me') }}" class="ck-guide-btn">
                    Let ConstructKaro Guide Me
                </a>
            </div>
        </div>
    </section>

    {{-- ── UPCOMING SERVICES ── --}}
   
    {{-- ── VENDOR ── --}}
    <section class="ck-compare-section">
        <div class="ck-compare-shell">
            <img src="{{ asset('images/home/compare/Group 947.png') }}"
                 alt="Platform Managed vs Unmanaged Execution"
                 class="ck-compare-heading-image"
                 loading="lazy"
                 decoding="async">
            <div class="ck-compare-panels">
                <img src="{{ asset('images/home/compare/BLU.png') }}"
                     alt="ConstructKaro managed project experience"
                     class="ck-compare-managed-image"
                     width="2796"
                     height="2828"
                     loading="lazy"
                     decoding="async">
                <div class="ck-compare-divider" aria-hidden="true">
                    <img src="{{ asset('images/home/compare/line.png') }}"
                         alt=""
                         class="ck-compare-divider-image"
                         width="416"
                         height="1965"
                         loading="lazy"
                         decoding="async">
                    <span class="ck-compare-vs">VS</span>
                </div>
                <img src="{{ asset('images/home/compare/ORG.png') }}"
                     alt="Traditional unmanaged project experience"
                     class="ck-compare-unmanaged-image"
                     width="2796"
                     height="2828"
                     loading="lazy"
                     decoding="async">
            </div>
            <div class="ck-compare-update-banner">
                <img src="{{ asset('images/home/compare/STAY.png') }}"
                     alt="Stay updated. Stay in control with ConstructKaro"
                     class="ck-compare-update-image"
                     loading="lazy"
                     decoding="async">
            </div>
            <div class="ck-package-compare-row">
                <a href="{{ route('guide.requirement') }}"
                   class="ck-package-cta-link"
                   aria-label="Open construction requirement form">
                    <img src="{{ asset('images/home/compare/Group 950.png') }}"
                         alt="Find the right construction package"
                         class="ck-package-cta-image"
                         loading="lazy"
                         decoding="async">
                    <span class="ck-package-cta-button">View Packages</span>
                </a>
                <img src="{{ asset('images/home/compare/Group 667.png') }}"
                     alt="Compare Core and Shell with Turnkey construction packages"
                     class="ck-package-visual-image"
                     loading="lazy"
                     decoding="async">
            </div>
        </div>
    </section>



    {{-- ── CITIES ── --}}
    <section class="ck-city-section">
        <!-- <h2 class="ck-city-title">Cities We Serve</h2> -->
        <div class="ck-city-grid">
             <img src="{{ asset('images/home/compare/Group848.png') }}"
                 alt="Platform Managed vs Unmanaged Execution"
                 class="ck-compare-image"
                 loading="lazy"
                 decoding="async">
         
        </div>
    </section>

    {{-- ── ALL SERVICES SLIDER ── --}}
    <section class="ck-all-services-section" id="exploreAllServicesSection">
        <h2 class="ck-all-services-title">Explore All Our Services</h2>
        <div class="ck-all-services-line"></div>

        <div class="ck-service-slider">
            <!-- <div class="ck-slide"><img src="{{ asset('images/services/contractor.png') }}" alt="Contractor"></div> -->
            <div class="ck-slide active">
                <a href="{{ route('contractor.services') }}">
                    {!! $ckImage('images/services/contractor.png', 'Contractor', '', ['width' => 360, 'height' => 420, 'loading' => 'lazy', 'decoding' => 'async']) !!}
                    <!-- <span class="ck-slide-label">Contractor</span> -->
                </a>
            </div>
            <!-- <div class="ck-slide"><img src="{{ asset('images/services/architect.png') }}"  alt="contractor"></div> -->
            <div class="ck-slide">
                <a href="{{ route('architect.services') }}">
                    {!! $ckImage('images/services/architect.png', 'Architect', '', ['width' => 140, 'height' => 420, 'loading' => 'lazy', 'decoding' => 'async']) !!}
                    <!-- <span class="ck-slide-label">Architect</span> -->
                </a>
            </div>
              <div class="ck-slide">
                <a href="{{ route('interior.services') }}">
                    {!! $ckImage('images/services/interior.png', 'Interior Designing', '', ['width' => 140, 'height' => 420, 'loading' => 'lazy', 'decoding' => 'async']) !!}
                    <!-- <span class="ck-slide-label">Interior</span> -->
                </a>
            </div>
            <div class="ck-slide">
                <a href="{{ route('survey.services') }}">
                    {!! $ckImage('images/services/survey.png', 'Survey', '', ['width' => 140, 'height' => 420, 'loading' => 'lazy', 'decoding' => 'async']) !!}
                    <!-- <span class="ck-slide-label">Survey</span> -->
                </a>
            </div>
              <div class="ck-slide">
                <a href="{{ route('survey.structural') }}">
                    {!! $ckImage('images/services/structural.png', 'Structural', '', ['width' => 140, 'height' => 420, 'loading' => 'lazy', 'decoding' => 'async']) !!}
                    <!-- <span class="ck-slide-label">Structural</span> -->
                </a>
            </div>
              <div class="ck-slide">
                <a href="{{ route('boq.testing') }}">
                    {!! $ckImage('images/services/boq.png', 'BOQ', '', ['width' => 140, 'height' => 420, 'loading' => 'lazy', 'decoding' => 'async']) !!}
                    <!-- <span class="ck-slide-label">BOQ</span> -->
                </a>
            </div>
            <div class="ck-slide">
                <a href="{{ route('construction.feasibility') }}">
                    {!! $ckImage('images/services/flexiblity.png', 'Feasibility Report', '', ['width' => 140, 'height' => 420, 'loading' => 'lazy', 'decoding' => 'async']) !!}
                </a>
            </div>
            <div class="ck-slide">
                <a href="{{ route('customer.facade') }}">
                    {!! $ckImage('images/services/facade.png', 'Facade Services', '', ['width' => 140, 'height' => 420, 'loading' => 'lazy', 'decoding' => 'async']) !!}
                </a>
            </div>
            <div class="ck-slide">
                <a href="{{ route('customer.testing') }}">
                    {!! $ckImage('images/services/testing.png', 'Testing Services', '', ['width' => 140, 'height' => 420, 'loading' => 'lazy', 'decoding' => 'async']) !!}
                </a>
            </div>
            <div class="ck-slide">
                <a href="{{ route('construction.welding.fabrication.work') }}">
                    {!! $ckImage('images/services/welding.png', 'Welding and Fabrication', '', ['width' => 140, 'height' => 420, 'loading' => 'lazy', 'decoding' => 'async']) !!}
                </a>
            </div>
        </div>
    </section>

    {{-- ── TESTIMONIALS ── --}}
    <section class="ck-testimonial-section">
        <div class="ck-testimonial-shell">
            <div class="ck-testimonial-heading">
                <h2>What People Say About Us</h2>
                <div class="ck-testimonial-line"></div>
            </div>

            <div class="ck-testimonial-grid">
                @foreach(['A', 'B', 'C', 'D', 'E'] as $testimonialImage)
                    <article class="ck-testimonial-card" tabindex="0">
                        <img src="{{ asset('images/home/compare/' . $testimonialImage . '.png') }}"
                             alt="ConstructKaro customer testimonial"
                             class="default-state"
                             loading="lazy"
                             decoding="async">
                        <img src="{{ asset('images/home/compare/' . $testimonialImage . '1.png') }}"
                             alt=""
                             class="hover-state"
                             aria-hidden="true"
                             loading="lazy"
                             decoding="async">
                    </article>
                @endforeach
            </div>
        </div>
    </section>

</div>

{{-- FREE CONSTRUCTION PLAN MODAL --}}
<div id="freePlanModal" class="plan-modal-overlay">
    <div class="plan-modal-box">
        <button type="button" class="plan-modal-close" id="closePlanModalBtn" aria-label="Close">&times;</button>

        <div class="plan-modal-inner">
            <div class="plan-modal-intro">
                <span class="plan-modal-badge">Free consultation</span>
                <h3>Plan your construction with the right team.</h3>
                <p>Tell us a few details and we will map your next step with design, vendor, and execution guidance.</p>

                <div class="plan-modal-points">
                    <div class="plan-modal-point"><i class="bi bi-clock"></i><span>24 hour callback</span></div>
                    <div class="plan-modal-point"><i class="bi bi-shield-check"></i><span>Verified professionals</span></div>
                    <div class="plan-modal-point"><i class="bi bi-geo-alt"></i><span>Mumbai, Pune, Thane, Raigad</span></div>
                </div>
            </div>

            <div class="plan-modal-form">
                <h2 class="plan-modal-title">Get Your Free Construction Feasibility Report</h2>
                <p class="plan-modal-copy">Share your details and our team will reach out within 24 hours with a personalised feasibility report.</p>

                <div class="plan-step active" data-plan-step="1">
            <div class="plan-step-label">Step 1 of 3 &mdash; Your details</div>

            <div class="plan-form-group">
                <label for="planFullName">Full Name</label>
                <input type="text" id="planFullName" class="plan-input" placeholder="Enter your full name" autocomplete="name">
                <small class="error-text" id="planFullNameError"></small>
            </div>

            <div class="plan-form-group">
                <label for="planEmail">Email</label>
                <input type="email" id="planEmail" class="plan-input" placeholder="you@example.com" autocomplete="email">
                <small class="error-text" id="planEmailError"></small>
            </div>

            <div class="plan-form-group">
                <label for="planTimeframe">When are you planning to start?</label>
                <select id="planTimeframe" class="plan-select">
                    <option value="">Select timeframe</option>
                    <option value="Immediately">Immediately</option>
                    <option value="Within 1 month">Within 1 month</option>
                    <option value="1-3 months">1-3 months</option>
                    <option value="3-6 months">3-6 months</option>
                    <option value="Just exploring">Just exploring</option>
                </select>
                <small class="error-text" id="planTimeframeError"></small>
            </div>

            <p class="plan-note">Verify your mobile with OTP, then tap Get My Free Plan.</p>

            <div class="plan-actions single">
                <button type="button" class="plan-primary-btn" id="planStepOneNext">Continue</button>
            </div>
        </div>

        <div class="plan-step" data-plan-step="2">
            <div class="plan-step-label">Step 2 of 3 &mdash; Verify your mobile</div>

            <div class="plan-form-group">
                <label for="planMobile">Phone Number</label>
                <input type="text" id="planMobile" class="plan-input" placeholder="Mobile number" maxlength="10" autocomplete="tel">
                <small class="error-text" id="planMobileError"></small>
            </div>

            <div class="plan-otp-panel">
                <p>Add a valid mobile number. India format is auto-detected.</p>
                <button type="button" class="plan-outline-btn" id="planSendOtpBtn">Send OTP</button>

                <div class="plan-form-group" style="margin: 12px 0 0;">
                    <label for="planOtp">SMS code</label>
                    <div class="plan-otp-row">
                        <input type="text" id="planOtp" class="plan-input" placeholder="6-digit OTP" maxlength="6" inputmode="numeric">
                        <button type="button" class="plan-primary-btn" id="planVerifyOtpBtn">Verify</button>
                    </div>
                    <small class="error-text" id="planOtpError"></small>
                </div>
            </div>

            <p class="plan-status" id="planOtpStatus">Verify your number to continue.</p>
            <p class="plan-note">Verify your mobile with OTP, then tap Get My Free Plan.</p>

            <div class="plan-actions">
                <button type="button" class="plan-secondary-btn" data-plan-back="1">Back</button>
                <button type="button" class="plan-primary-btn" id="planStepTwoNext">Continue</button>
            </div>
        </div>

        <div class="plan-step" data-plan-step="3">
            <div class="plan-step-label">Step 3 of 3 &mdash; Your city</div>

            <div class="plan-form-group">
                <label for="planCity">City</label>
                <select id="planCity" class="plan-select">
                    <option value="">Select city</option>
                    <option value="Mumbai">Mumbai</option>
                    <option value="Navi Mumbai">Navi Mumbai</option>
                    <option value="Pune">Pune</option>
                    <option value="Thane">Thane</option>
                    <option value="Raigad">Raigad</option>
                </select>
                <small class="error-text" id="planCityError"></small>
            </div>

            <p class="plan-status" id="planSubmitStatus"></p>

            <div class="plan-actions">
                <button type="button" class="plan-secondary-btn" data-plan-back="2">Back</button>
                <button type="button" class="plan-primary-btn" id="planSubmitBtn">Get My Feasibility Report &rarr;</button>
            </div>
        </div>
            </div>
        </div>

        <div class="plan-privacy">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                <path d="m9 12 2 2 4-5"></path>
            </svg>
            <span>We respect your privacy. No spam, ever.</span>
        </div>
    </div>
</div>

{{-- ── LOGIN MODAL ── --}}
<div id="customerLoginOtpModal" class="custom-modal-overlay">
    <div class="custom-modal-box">
        <button type="button" class="custom-modal-close" id="closeCustomerLoginModal">&times;</button>

        <div class="custom-modal-header">
            <h3>Login to Continue</h3>
            <p id="customerLoginHelp">Enter your mobile number to get OTP</p>
        </div>

        <input type="hidden" id="customer_redirect_url">

        <div class="customer-login-methods" role="tablist" aria-label="Choose login method">
            <button type="button" class="customer-login-method active" id="customerOtpTab" data-customer-login-method="otp" role="tab" aria-selected="true">Login with OTP</button>
            <button type="button" class="customer-login-method" id="customerPasswordTab" data-customer-login-method="password" role="tab" aria-selected="false">Login with Password</button>
        </div>

        <div class="form-group">
            <label>Mobile Number</label>
            <input type="text" id="customer_mobile_number" class="custom-input" placeholder="Enter mobile number" maxlength="10">
            <small class="error-text" id="customer_mobile_error"></small>
        </div>

        <div class="form-group" id="customerOtpSection" style="display:none;">
            <label>Enter OTP</label>
            <input type="text" id="customer_otp_code" class="custom-input" placeholder="Enter OTP" maxlength="6">
            <small class="error-text" id="customer_otp_error"></small>
        </div>

        <div class="form-group" id="customerPasswordSection" style="display:none;">
            <label>Password</label>
            <input type="password" id="customer_password" class="custom-input" placeholder="Enter password" autocomplete="current-password">
            <small class="error-text" id="customer_password_error"></small>
        </div>

        <div class="otp-success-msg" id="customer_otp_success_msg"></div>

        <div class="custom-modal-actions">
            <button type="button" class="modal-btn primary-btn" id="customerSendOtpBtn">Get OTP</button>
            <button type="button" class="modal-btn verify-btn" id="customerVerifyOtpBtn" style="display:none;">Verify OTP</button>
            <button type="button" class="modal-btn primary-btn" id="customerPasswordLoginBtn" style="display:none;">Login</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
window.$ = window.jQuery = (function () {
    let ajaxHeaders = {};

    function wrap(input) {
        let elements = [];

        if (input === document || input === window || input instanceof Element) {
            elements = [input];
        } else if (typeof input === 'string') {
            elements = Array.from(document.querySelectorAll(input));
        } else if (input && input.elements) {
            elements = input.elements;
        }

        return {
            elements,
            ready(fn) {
                if (document.readyState !== 'loading') fn();
                else document.addEventListener('DOMContentLoaded', fn);
                return this;
            },
            on(eventName, selectorOrHandler, handler) {
                const delegated = typeof selectorOrHandler === 'string';
                const callback = delegated ? handler : selectorOrHandler;

                elements.forEach(function (element) {
                    element.addEventListener(eventName, function (event) {
                        if (!delegated) {
                            callback.call(element, event);
                            return;
                        }

                        const target = event.target.closest(selectorOrHandler);
                        if (target && element.contains(target)) {
                            callback.call(target, event);
                        }
                    });
                });

                return this;
            },
            val(value) {
                if (value === undefined) return elements[0] ? elements[0].value : '';
                elements.forEach(element => { element.value = value; });
                return this;
            },
            text(value) {
                if (value === undefined) return elements[0] ? elements[0].textContent : '';
                elements.forEach(element => { element.textContent = value; });
                return this;
            },
            hide() {
                elements.forEach(element => { element.style.display = 'none'; });
                return this;
            },
            show() {
                elements.forEach(element => { element.style.display = ''; });
                return this;
            },
            addClass(className) {
                elements.forEach(element => element.classList.add(className));
                return this;
            },
            removeClass(className) {
                elements.forEach(element => element.classList.remove(className));
                return this;
            },
            hasClass(className) {
                return elements[0] ? elements[0].classList.contains(className) : false;
            },
            closest(selector) {
                return wrap(elements[0] ? elements[0].closest(selector) : null);
            },
            find(selector) {
                return wrap(elements[0] ? elements[0].querySelector(selector) : null);
            },
            prop(name, value) {
                if (value === undefined) return elements[0] ? elements[0][name] : undefined;
                elements.forEach(element => { element[name] = value; });
                return this;
            },
            data(name) {
                return elements[0] ? elements[0].dataset[name] : undefined;
            },
            attr(name) {
                return elements[0] ? elements[0].getAttribute(name) : undefined;
            }
        };
    }

    wrap.ajaxSetup = function (options) {
        ajaxHeaders = options.headers || {};
    };

    wrap.ajax = function (options) {
        fetch(options.url, {
            method: options.type || 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                ...ajaxHeaders
            },
            body: new URLSearchParams(options.data || {})
        })
        .then(response => response.json().then(data => ({ ok: response.ok, data })))
        .then(function (result) {
            if (result.ok && options.success) options.success(result.data);
            if (!result.ok && options.error) options.error(result.data);
        })
        .catch(function (error) {
            if (options.error) options.error(error);
        })
        .finally(function () {
            if (options.complete) options.complete();
        });
    };

    return wrap;
})();

$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });

$(document).ready(function () {

    function setCustomerLoginMethod(method) {
        const passwordMode = method === 'password';

        $('#customerOtpTab').removeClass('active').prop('ariaSelected', !passwordMode);
        $('#customerPasswordTab').removeClass('active').prop('ariaSelected', passwordMode);
        $(passwordMode ? '#customerPasswordTab' : '#customerOtpTab').addClass('active');
        $('#customerLoginHelp').text(passwordMode
            ? 'Enter your mobile number and password'
            : 'Enter your mobile number to get OTP');
        $('#customerPasswordSection')[passwordMode ? 'show' : 'hide']();
        $('#customerPasswordLoginBtn')[passwordMode ? 'show' : 'hide']();
        $('#customerSendOtpBtn')[passwordMode ? 'hide' : 'show']();
        $('#customerOtpSection').hide();
        $('#customerVerifyOtpBtn').hide();
        $('#customer_otp_code').val('');
        $('#customer_password').val('');
        $('#customer_otp_error').text('');
        $('#customer_password_error').text('');
        $('#customer_otp_success_msg').text('');
    }

    $(document).on('click', '[data-customer-login-method]', function () {
        setCustomerLoginMethod($(this).data('customerLoginMethod'));
    });

    $(document).on('click', '.open-customer-login-modal', function (event) {
        event.preventDefault();
        let redirectUrl = $(this).data('redirect') || $(this).attr('href') || '';
        $('#customer_redirect_url').val(redirectUrl);
        $('#customer_mobile_number').val('');
        $('#customer_otp_code').val('');
        $('#customer_password').val('');
        $('#customer_mobile_error').text('');
        $('#customer_otp_error').text('');
        $('#customer_password_error').text('');
        $('#customer_otp_success_msg').text('');
        setCustomerLoginMethod('otp');
        $('#customerLoginOtpModal').addClass('active');
    });

    $('#closeCustomerLoginModal').on('click', function () {
        $('#customerLoginOtpModal').removeClass('active');
    });

    $('#customerLoginOtpModal').on('click', function (e) {
        if (e.target.id === 'customerLoginOtpModal') {
            $('#customerLoginOtpModal').removeClass('active');
        }
    });

    let planOtpVerified = false;
    let planVerifiedMobile = '';

    function planSetStep(step) {
        document.querySelectorAll('[data-plan-step]').forEach(function (stepPanel) {
            stepPanel.classList.toggle('active', stepPanel.dataset.planStep === String(step));
        });
    }

    function planClearErrors() {
        [
            'planFullNameError',
            'planEmailError',
            'planTimeframeError',
            'planMobileError',
            'planOtpError',
            'planCityError'
        ].forEach(function (id) {
            const element = document.getElementById(id);
            if (element) element.textContent = '';
        });
    }

    function planSetStatus(id, message, type) {
        const element = document.getElementById(id);
        if (!element) return;
        element.textContent = message || '';
        element.className = 'plan-status' + (type ? ' ' + type : '');
    }

    function planReset() {
        planOtpVerified = false;
        planVerifiedMobile = '';
        planClearErrors();
        planSetStatus('planOtpStatus', 'Verify your number to continue.', '');
        planSetStatus('planSubmitStatus', '', '');
        $('#planFullName').val('');
        $('#planEmail').val('');
        $('#planTimeframe').val('');
        $('#planMobile').val('');
        $('#planOtp').val('');
        $('#planCity').val('');
        planSetStep(1);
    }

    $('#openPlanModalBtn, .open-plan-modal-btn').on('click', function (event) {
        event.preventDefault();
        planReset();
        $('#freePlanModal').addClass('active');
        setTimeout(function () {
            const nameInput = document.getElementById('planFullName');
            if (nameInput) nameInput.focus();
        }, 80);
    });

    $('#closePlanModalBtn').on('click', function () {
        $('#freePlanModal').removeClass('active');
    });

    $('#freePlanModal').on('click', function (e) {
        if (e.target.id === 'freePlanModal') {
            $('#freePlanModal').removeClass('active');
        }
    });

    $(document).on('click', '[data-plan-back]', function () {
        planSetStep(this.dataset.planBack);
    });

    $('#planStepOneNext').on('click', function () {
        planClearErrors();

        const fullName = $('#planFullName').val().trim();
        const email = $('#planEmail').val().trim();
        const timeframe = $('#planTimeframe').val();
        let valid = true;

        if (!fullName) {
            $('#planFullNameError').text('Please enter your full name');
            valid = false;
        }

        if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            $('#planEmailError').text('Please enter a valid email');
            valid = false;
        }

        if (!timeframe) {
            $('#planTimeframeError').text('Please select timeframe');
            valid = false;
        }

        if (valid) planSetStep(2);
    });

    $('#planMobile').on('input', function () {
        if (this.value !== planVerifiedMobile) {
            planOtpVerified = false;
            planSetStatus('planOtpStatus', 'Verify your number to continue.', '');
        }
    });

    $('#planSendOtpBtn').on('click', function (e) {
        e.preventDefault();
        const mobile = $('#planMobile').val().trim();
        $('#planMobileError').text('');
        $('#planOtpError').text('');
        planSetStatus('planOtpStatus', '', '');

        if (!/^[0-9]{10}$/.test(mobile)) {
            $('#planMobileError').text('Please enter valid 10 digit mobile number');
            return;
        }

        const btn = $(this);
        btn.prop('disabled', true).text('Sending...');

        $.ajax({
            url: "{{ route('customer.send.otp') }}",
            type: "POST",
            data: { mobile },
            success: function (response) {
                if (response.status === true) {
                    planSetStatus('planOtpStatus', response.message || 'OTP sent successfully.', 'success');
                } else {
                    planSetStatus('planOtpStatus', response.message || 'Failed to send OTP.', 'error');
                }
            },
            error: function () {
                planSetStatus('planOtpStatus', 'Something went wrong while sending OTP.', 'error');
            },
            complete: function () {
                btn.prop('disabled', false).text('Send OTP');
            }
        });
    });

    $('#planVerifyOtpBtn').on('click', function (e) {
        e.preventDefault();
        const mobile = $('#planMobile').val().trim();
        const otp = $('#planOtp').val().trim();
        $('#planOtpError').text('');
        planSetStatus('planOtpStatus', '', '');

        if (!/^[0-9]{10}$/.test(mobile)) {
            $('#planMobileError').text('Please enter valid 10 digit mobile number');
            return;
        }

        if (!otp) {
            $('#planOtpError').text('Please enter OTP');
            return;
        }

        const btn = $(this);
        btn.prop('disabled', true).text('Verifying...');

        $.ajax({
            url: "{{ route('customer.verify.otp') }}",
            type: "POST",
            data: { mobile, otp },
            success: function (response) {
                if (response.status === true) {
                    planOtpVerified = true;
                    planVerifiedMobile = mobile;
                    planSetStatus('planOtpStatus', response.message || 'Mobile verified successfully.', 'success');
                } else {
                    planOtpVerified = false;
                    planSetStatus('planOtpStatus', response.message || 'Invalid OTP.', 'error');
                }
            },
            error: function () {
                planOtpVerified = false;
                planSetStatus('planOtpStatus', 'Something went wrong while verifying OTP.', 'error');
            },
            complete: function () {
                btn.prop('disabled', false).text('Verify');
            }
        });
    });

    $('#planStepTwoNext').on('click', function () {
        $('#planMobileError').text('');
        $('#planOtpError').text('');

        if (!planOtpVerified || $('#planMobile').val().trim() !== planVerifiedMobile) {
            planSetStatus('planOtpStatus', 'Verify your number to continue.', 'error');
            return;
        }

        planSetStep(3);
    });

    $('#planSubmitBtn').on('click', function (e) {
        e.preventDefault();
        $('#planCityError').text('');
        planSetStatus('planSubmitStatus', '', '');

        const city = $('#planCity').val();
        if (!city) {
            $('#planCityError').text('Please select city');
            return;
        }

        const btn = $(this);
        btn.prop('disabled', true).text('Submitting...');

        $.ajax({
            url: "{{ route('construction.requirement.store') }}",
            type: "POST",
            data: {
                full_name: $('#planFullName').val().trim(),
                email: $('#planEmail').val().trim(),
                mobile: planVerifiedMobile,
                city: city,
                planning_timeframe: $('#planTimeframe').val(),
                'services[]': 'Construction Feasibility Report with Interior Designer',
                project_description: 'Free construction feasibility report request including architect, contractor, and interior designer support. Timeframe: ' + $('#planTimeframe').val()
            },
            success: function (response) {
                planSetStatus('planSubmitStatus', response.message || 'Your request is submitted. Our team will contact you soon.', 'success');
                setTimeout(function () {
                    $('#freePlanModal').removeClass('active');
                    planReset();
                }, 1200);
            },
            error: function () {
                planSetStatus('planSubmitStatus', 'Something went wrong while submitting. Please try again.', 'error');
            },
            complete: function () {
                btn.prop('disabled', false).text('Get My Feasibility Report ->');
            }
        });
    });

    $('.faq-question').on('click', function () {
        const item = $(this).closest('.faq-item');
        const active = item.hasClass('active');
        $('.faq-item').removeClass('active');
        $('.faq-icon').text('+');
        if (!active) {
            item.addClass('active');
            item.find('.faq-icon').text('−');
        }
    });
});

$(document).on('click', '#customerSendOtpBtn', function (e) {
    e.preventDefault();
    let mobile = $('#customer_mobile_number').val().trim();
    $('#customer_mobile_error').text('');
    $('#customer_otp_error').text('');
    $('#customer_otp_success_msg').text('');

    if (!mobile) { $('#customer_mobile_error').text('Please enter mobile number'); return; }
    if (!/^[0-9]{10}$/.test(mobile)) { $('#customer_mobile_error').text('Please enter valid 10 digit mobile number'); return; }

    let btn = $(this);
    btn.prop('disabled', true).text('Sending...');

    $.ajax({
        url: "{{ route('customer.send.otp') }}",
        type: "POST",
        data: { mobile },
        success: function (response) {
            if (response.status === true) {
                $('#customerOtpSection').show();
                $('#customerVerifyOtpBtn').show();
                $('#customerSendOtpBtn').hide();
                $('#customer_otp_success_msg').text(response.message || 'OTP sent successfully');
            } else {
                $('#customer_mobile_error').text(response.message || 'Failed to send OTP');
            }
        },
        error: function () { $('#customer_mobile_error').text('Something went wrong while sending OTP'); },
        complete: function () { btn.prop('disabled', false).text('Get OTP'); }
    });
});

$(document).on('click', '#customerVerifyOtpBtn', function (e) {
    e.preventDefault();
    let mobile = $('#customer_mobile_number').val().trim();
    let otp = $('#customer_otp_code').val().trim();
    let redirectUrl = $('#customer_redirect_url').val();
    $('#customer_otp_error').text('');
    $('#customer_otp_success_msg').text('');

    if (!otp) { $('#customer_otp_error').text('Please enter OTP'); return; }

    let btn = $(this);
    btn.prop('disabled', true).text('Verifying...');

    $.ajax({
        url: "{{ route('customer.verify.otp') }}",
        type: "POST",
        data: { mobile, otp },
        success: function (response) {
            if (response.status === true) {
                $('#customer_otp_success_msg').text(response.message || 'OTP verified successfully');
                setTimeout(function () {
                    redirectUrl ? window.location.href = redirectUrl : window.location.reload();
                }, 700);
            } else {
                $('#customer_otp_error').text(response.message || 'Invalid OTP');
            }
        },
        error: function () { $('#customer_otp_error').text('Something went wrong while verifying OTP'); },
        complete: function () { btn.prop('disabled', false).text('Verify OTP'); }
    });
});

$(document).on('click', '#customerPasswordLoginBtn', function (e) {
    e.preventDefault();
    const mobile = $('#customer_mobile_number').val().trim();
    const password = $('#customer_password').val();
    const redirectUrl = $('#customer_redirect_url').val();
    $('#customer_mobile_error').text('');
    $('#customer_password_error').text('');
    $('#customer_otp_success_msg').text('');

    if (!/^[0-9]{10}$/.test(mobile)) {
        $('#customer_mobile_error').text('Please enter valid 10 digit mobile number');
        return;
    }
    if (!password) {
        $('#customer_password_error').text('Please enter your password');
        return;
    }

    const btn = $(this);
    btn.prop('disabled', true).text('Logging in...');

    $.ajax({
        url: "{{ route('customer.login.password') }}",
        type: 'POST',
        data: { mobile, password, redirect_url: redirectUrl },
        success: function (response) {
            $('#customer_otp_success_msg').text(response.message || 'Login successful');
            setTimeout(function () {
                redirectUrl ? window.location.href = redirectUrl : window.location.reload();
            }, 500);
        },
        error: function (response) {
            $('#customer_password_error').text(response.message || 'Unable to login. Please try again.');
        },
        complete: function () {
            btn.prop('disabled', false).text('Login');
        }
    });
});
</script>

<script>
const serviceSlider = document.querySelector('.ck-service-slider');
let serviceSwipeStartX = 0;
let serviceSwipeStartY = 0;
let serviceSwipeMoved = false;

if (serviceSlider) {
    serviceSlider.addEventListener('pointerdown', function (event) {
        serviceSwipeStartX = event.clientX;
        serviceSwipeStartY = event.clientY;
        serviceSwipeMoved = false;
    });

    serviceSlider.addEventListener('pointermove', function (event) {
        const moveX = Math.abs(event.clientX - serviceSwipeStartX);
        const moveY = Math.abs(event.clientY - serviceSwipeStartY);

        if (moveX > 10 && moveX > moveY) {
            serviceSwipeMoved = true;
        }
    });
}

document.querySelectorAll('.ck-slide').forEach(function (slide) {
    function activateSlide() {
        document.querySelectorAll('.ck-slide').forEach(s => s.classList.remove('active'));
        slide.classList.add('active');
    }

    slide.addEventListener('click', function (event) {
        if (serviceSwipeMoved) {
            event.preventDefault();
            serviceSwipeMoved = false;
            return;
        }

        activateSlide();
    });

    slide.addEventListener('mouseenter', function () {
        activateSlide();
    });
});
</script>
@php
    $serviceSearchCatalog = [
        ['name' => 'Residential Architectural Planning', 'aliases' => ['residential architectural planning', 'residential planning', 'house planning'], 'url' => route('architectural.service.details', 'residential-architectural-planning')],
        ['name' => 'Bungalow and Villa Design', 'aliases' => ['bungalow design', 'villa design', 'bungalow and villa'], 'url' => route('architectural.service.details', 'bungalow-and-villa-design')],
        ['name' => 'Apartment and Flat Layout Planning', 'aliases' => ['apartment layout', 'flat layout', 'apartment planning', 'flat planning'], 'url' => route('architectural.service.details', 'apartment-flat-layout-planning')],
        ['name' => 'Commercial Building Design', 'aliases' => ['commercial building design', 'commercial design'], 'url' => route('architectural.service.details', 'commercial-building-design')],
        ['name' => 'Office Planning', 'aliases' => ['office planning', 'office design', 'office layout'], 'url' => route('architectural.service.details', 'office-and-showroom-planning')],
        ['name' => 'Showroom Planning', 'aliases' => ['showroom planning', 'showroom design', 'showroom layout'], 'url' => route('architectural.service.details', 'showroom-planning')],
        ['name' => 'Farmhouse Design', 'aliases' => ['farmhouse design', 'farmhouse planning'], 'url' => route('architectural.service.details', 'farmhouse-design')],
        ['name' => 'Plot Development Planning', 'aliases' => ['plot development', 'plot planning', 'land development planning'], 'url' => route('architectural.service.details', 'plot-development-planning')],
        ['name' => 'Elevation and Facade Design', 'aliases' => ['elevation design', 'facade design', 'elevation and facade'], 'url' => route('architectural.service.details', 'elevation-and-facade-design')],
        ['name' => 'Floor Plan Design', 'aliases' => ['floor plan', 'floor plan design', 'floor planning'], 'url' => route('architectural.service.details', 'floor-plan-design')],
        ['name' => 'Space Planning', 'aliases' => ['space planning', 'space plan'], 'url' => route('architectural.service.details', 'space-planning')],
        ['name' => 'Concept Design', 'aliases' => ['concept design', 'design concept'], 'url' => route('architectural.service.details', 'concept-design')],
        ['name' => 'Renovation Planning', 'aliases' => ['renovation planning', 'renovation design', 'redesign planning'], 'url' => route('architectural.service.details', 'renovation-planning')],
        ['name' => 'Approval Drawing Support', 'aliases' => ['approval drawing', 'municipal drawing', 'approval support'], 'url' => route('architectural.service.details', 'approval-drawing-support')],
        ['name' => 'Submission Drawing Assistance', 'aliases' => ['submission drawing', 'drawing submission'], 'url' => route('architectural.service.details', 'submission-drawing-assistance')],
        ['name' => 'Basic Design Consultation', 'aliases' => ['design consultation', 'basic design consultation', 'architect consultation'], 'url' => route('architectural.service.details', 'basic-design-consultation')],
        ['name' => 'Structural Audit', 'aliases' => ['structural audit', 'building audit', 'safety audit'], 'url' => route('customer.structuralaudit')],
        ['name' => 'Architect', 'aliases' => ['architect', 'architects', 'architecture', 'architectural'], 'url' => route('architect.services')],
        ['name' => 'Contractor', 'aliases' => ['contractor', 'contractors', 'construction contractor'], 'url' => route('contractor.services')],
        ['name' => 'Interior Design', 'aliases' => ['interior', 'interior design', 'interior designer'], 'url' => route('interior.services')],
        ['name' => 'Survey Services', 'aliases' => ['survey', 'surveyor', 'land survey', 'survey services'], 'url' => route('survey.services')],
        ['name' => 'Structural Services', 'aliases' => ['structural', 'structural services', 'structural design'], 'url' => route('survey.structural')],
        ['name' => 'BOQ / Estimation', 'aliases' => ['boq', 'estimation', 'estimate', 'bill of quantities'], 'url' => route('boq.testing')],
        ['name' => 'Testing Services', 'aliases' => ['testing', 'test', 'material testing', 'testing services'], 'url' => route('customer.testing')],
        ['name' => 'Facade Services', 'aliases' => ['facade', 'facade services', 'elevation'], 'url' => route('customer.facade')],
        ['name' => 'Welding & Fabrication', 'aliases' => ['welding', 'fabrication', 'welding fabrication'], 'url' => route('customer.welding_fabrication')],
    ];
@endphp
<script>
document.addEventListener("DOMContentLoaded", function () {

    const mainServicesSection = document.getElementById("mainServicesSection");
    const exploreServicesSection = document.getElementById("exploreServicesSection");
    const comingSoonLocationBox = document.getElementById("comingSoonLocationBox");
    const heroDiscoveryLocation = document.getElementById("heroDiscoveryLocation");
    const heroDiscoveryLocationText = document.getElementById("heroDiscoveryLocationText");
    const headerLocationButton = document.getElementById("openLocationModal");
    const headerLocationText = document.getElementById("selectedLocationText");
    const heroDiscoverySearchForm = document.getElementById("heroDiscoverySearchForm");
    const heroDiscoverySearchInput = document.getElementById("heroDiscoverySearchInput");
    const heroDiscoverySearchStatus = document.getElementById("heroDiscoverySearchStatus");
    const exploreAllServicesSection = document.getElementById("exploreAllServicesSection");
    const serviceSearchCatalog = @json($serviceSearchCatalog);
    const revealItems = document.querySelectorAll(
        '.hero-banner, .ck-trust-section, .ck-process-section, .ck-solution-section, .ck-services-section, .explore-services-section, .ck-assurance-section, .ck-guide-section, .ck-compare-section, .ck-vendor-section, .ck-city-section, .ck-all-services-section, .ck-testimonial-section'
    );

    if (heroDiscoveryLocation && heroDiscoveryLocationText && headerLocationButton && headerLocationText) {
        const syncHeroLocation = function () {
            heroDiscoveryLocationText.textContent = headerLocationText.textContent.trim();
        };

        syncHeroLocation();
        new MutationObserver(syncHeroLocation).observe(headerLocationText, {
            childList: true,
            characterData: true,
            subtree: true
        });

        heroDiscoveryLocation.addEventListener("click", function () {
            headerLocationButton.click();
        });
    }

    if (heroDiscoverySearchForm && heroDiscoverySearchInput && heroDiscoverySearchStatus) {
        heroDiscoverySearchForm.addEventListener("submit", function (event) {
            event.preventDefault();
            heroDiscoverySearchStatus.textContent = "";

            const query = heroDiscoverySearchInput.value.toLowerCase()
                .replace(/[^a-z0-9\s]/g, " ")
                .replace(/\s+/g, " ")
                .trim();

            if (!query) {
                heroDiscoverySearchInput.focus();
                return;
            }

            const matchingService = serviceSearchCatalog.find(function (service) {
                return service.aliases.some(function (alias) {
                    return query.includes(alias) || alias.includes(query);
                });
            });

            if (matchingService) {
                window.location.assign(matchingService.url);
                return;
            }

            if (query.includes("feasibility")) {
                const feasibilityCard = document.querySelector('.our-service-card[aria-label="Feasibility Report"]');
                if (feasibilityCard) {
                    feasibilityCard.click();
                    return;
                }
            }

            heroDiscoverySearchStatus.textContent = "Service not found. Explore all available services below.";
            if (exploreAllServicesSection) {
                exploreAllServicesSection.scrollIntoView({ behavior: "smooth", block: "start" });
            }
        });

        heroDiscoverySearchInput.addEventListener("input", function () {
            heroDiscoverySearchStatus.textContent = "";
        });
    }

    function showServices() {
        if (mainServicesSection) mainServicesSection.style.display = "block";
        if (exploreServicesSection) exploreServicesSection.style.display = "block";
        if (comingSoonLocationBox) comingSoonLocationBox.style.display = "none";
    }

    function showComingSoon() {
        if (mainServicesSection) mainServicesSection.style.display = "none";
        if (exploreServicesSection) exploreServicesSection.style.display = "none";
        if (comingSoonLocationBox) comingSoonLocationBox.style.display = "block";
    }

    // Default page load: show services
    const locationAllowed = localStorage.getItem("location_allowed");

    if (locationAllowed === "no") {
        showComingSoon();
    } else {
        showServices();
    }

    // Make functions globally available for header location script
    window.showServices = showServices;
    window.showComingSoon = showComingSoon;

    revealItems.forEach(function (item) {
        item.classList.add('smooth-reveal');
    });

    if ('IntersectionObserver' in window) {
        const revealObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        revealItems.forEach(function (item) {
            revealObserver.observe(item);
        });
    } else {
        revealItems.forEach(function (item) {
            item.classList.add('is-visible');
        });
    }
});
</script>
@endpush
@endsection
