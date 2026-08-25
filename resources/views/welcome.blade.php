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
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
/* ============================================================
   CSS VARIABLES & RESET
   ============================================================ */
:root {
    --blue:        #1f67ab;
    --blue-light:  #2f89d0;
    --orange:      #df6d1c;
    --orange-light:#ef8a39;
    --bg:          #eeeeee;
    --text:        #222;
    --container-w: 92%;
    --container-max:1320px;
    --radius:      18px;
    --shadow:      0 6px 18px rgba(0,0,0,.18);
}

*, *::before, *::after {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background: var(--bg);
    color: var(--text);
    overflow-x: hidden;
}

html {
    scroll-behavior: smooth;
}

.home-page {
    overflow: hidden;
    width: 100%;
}

.home-page img {
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
    margin-bottom: 48px;
}

.section-heading h2 {
    font-size: clamp(28px, 3.2vw, 38px);
    font-weight: 900;
    color: #1f1f1f;
    line-height: 1.15;
}

.heading-bar {
    width: 220px;
    height: 4px;
    margin: 12px auto 0;
    border-radius: 50px;
    background: linear-gradient(90deg, #ef7d2d, #2f78bf);
}

/* ============================================================
   HERO
   ============================================================ */
.hero-banner {
    width: 100vw;
    min-height: clamp(360px, 42vw, 520px);
    margin-left: calc(50% - 50vw);
    background-image:
        linear-gradient(90deg, rgba(0,0,0,.90), rgba(0,0,0,.62), rgba(0,0,0,.12)),
        image-set(
            url("{{ asset('images/banner.webp') }}") type("image/webp"),
            url("{{ asset('images/banner.jpg') }}") type("image/jpeg")
        );
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    padding: 52px 0;
    position: relative;
    overflow: hidden;
}

.hero-inner {
    width: var(--container-w);
    max-width: var(--container-max);
    margin: 0 auto;
    position: relative;
    z-index: 1;
}

.hero-content {
    max-width: 600px;
}

.hero-tech-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 11px;
    min-height: 30px;
    margin-bottom: 22px;
    padding: 8px 20px;
    border: 1.5px solid #ff8a3d;
    border-radius: 999px;
    background: rgba(255, 250, 245, .94);
    color: #a34321;
    font-size: 17px;
    font-weight: 700;
    line-height: 1;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    white-space: nowrap;
    box-shadow: 0 8px 22px rgba(0,0,0,.18);
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
    font-size: clamp(34px, 4vw, 56px);
    font-weight: 900;
    line-height: 1.1;
    margin-bottom: 10px;
}

.hero-subtitle {
    color: #fff;
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 12px;
}

.hero-description {
    color: rgba(255,255,255,.88);
    font-size: 15px;
    line-height: 1.6;
    margin-bottom: 28px;
}

.hero-plan-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    min-height: 54px;
    padding: 0 28px;
    border: none;
    border-radius: 14px;
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
    margin-top: 28px;
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 12px;
}

.hero-proof-item {
    min-height: 78px;
    padding: 12px 10px;
    border: 1px solid rgba(255,255,255,.22);
    border-radius: 14px;
    background: rgba(255,255,255,.11);
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
    padding: 64px 0;
    background: #fff;
}

.ck-trust-container {
    width: var(--container-w);
    max-width: var(--container-max);
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
}

.ck-trust-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    gap: 12px;
}

.ck-trust-icon-img {
    width: 87px;
    height: 81px;
    object-fit: contain;
}

.ck-trust-title {
    font-size: clamp(16px, 2vw, 24px);
    font-weight: 700;
    color: #111;
    line-height: 1.4;
}

/* ============================================================
   MAIN SERVICE CARDS
   ============================================================ */
.ck-services-section {
    padding: 88px 0 60px;
    background: var(--bg);
}

.ck-services-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: clamp(28px, 4vw, 56px);
    align-items: stretch;
}

.ck-service-card {
    background: #fff;
    border: 1.5px solid #111;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    text-align: center;
    padding: 0 20px 28px;
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100%;
    min-height: 315px;
    transition: transform .28s ease, box-shadow .28s ease, border-color .28s ease;
}

.ck-service-card:hover {
    transform: translateY(-8px);
    border-color: var(--blue);
    box-shadow: 0 18px 38px rgba(31,103,171,.18);
}

.ck-service-image {
    width: min(78%, 270px);
    aspect-ratio: 4 / 3;
    height: auto;
    margin: -52px auto 20px;
    border-radius: 14px;
    overflow: hidden;
    border: 1.5px solid #111;
    box-shadow: 0 4px 12px rgba(0,0,0,.2);
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
    font-size: 20px;
    font-weight: 800;
    margin-bottom: 6px;
}

.ck-service-line {
    width: 130px;
    height: 1px;
    background: #bbb;
    margin: 0 auto 12px;
}

.ck-service-text {
    color: #777;
    font-size: 12px;
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
    border-radius: 10px;
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
.explore-services-section {
    padding: 60px 0 70px;
    background: var(--bg);
}

.explore-services-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 32px;
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
    transform: translateY(-7px);
    box-shadow: 0 18px 36px rgba(0,0,0,.16);
}

.orange-card { border: 2px solid #ef7d2d; }
.blue-card   { border: 2px solid #2f78bf; }

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
    padding: 22px 20px 26px;
    display: flex;
    flex-direction: column;
    align-items: center;
    flex: 1;
}

.explore-card-body h3 {
    font-size: 22px;
    font-weight: 900;
    margin-bottom: 10px;
    line-height: 1.2;
}

.orange-card h3 { color: var(--orange); }
.blue-card   h3 { color: var(--blue); }

.explore-card-body p {
    font-size: 13px;
    color: #555;
    margin-bottom: 20px;
    flex: 1;
    line-height: 1.5;
}

.explore-btn {
    width: 100%;
    max-width: 240px;
    height: 44px;
    border-radius: 10px;
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
    border: 1px solid #dbe5ee;
    border-radius: 16px;
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
    border-radius: 12px;
    background: #1f67ab;
    color: #fff;
    font-weight: 900;
}

.ck-process-card:nth-child(even) .ck-process-number {
    background: #df6d1c;
}

.ck-process-card h3 {
    color: #152536;
    font-size: 19px;
    font-weight: 900;
    line-height: 1.2;
    margin-bottom: 10px;
}

.ck-process-card p {
    color: #5e6a76;
    font-size: 14px;
    line-height: 1.55;
}

.ck-solution-section {
    padding: 78px 0;
    background: linear-gradient(180deg, #f8fafc 0%, #eef2f7 100%);
}

.ck-solution-shell {
    width: var(--container-w);
    max-width: var(--container-max);
    margin: 0 auto;
    display: grid;
    grid-template-columns: minmax(0, .92fr) minmax(0, 1.08fr);
    gap: 30px;
    align-items: stretch;
}

.ck-solution-intro {
    padding: 34px;
    border-radius: 18px;
    background: #fff;
    border: 1px solid #dbe5ee;
    box-shadow: var(--ck-shadow);
}

.ck-solution-badge {
    display: inline-flex;
    margin-bottom: 16px;
    padding: 7px 13px;
    border-radius: 999px;
    background: #fff4ec;
    color: #c54e17;
    font-size: 12px;
    font-weight: 900;
    letter-spacing: .8px;
    text-transform: uppercase;
}

.ck-solution-intro h2 {
    color: #10243a;
    font-size: clamp(30px, 3.3vw, 46px);
    font-weight: 900;
    line-height: 1.08;
    margin-bottom: 16px;
}

.ck-solution-intro p {
    color: #5e6a76;
    font-size: 16px;
    line-height: 1.7;
}

.ck-solution-options {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
}

.ck-solution-card {
    padding: 26px 24px;
    border-radius: 18px;
    background: #fff;
    border: 2px solid #dbe5ee;
    box-shadow: var(--ck-shadow-soft);
}

.ck-solution-card.primary {
    border-color: #ef8a39;
}

.ck-solution-card.secondary {
    border-color: #2f89d0;
}

.ck-solution-card h3 {
    color: #10243a;
    font-size: 22px;
    font-weight: 900;
    line-height: 1.2;
    margin-bottom: 10px;
}

.ck-solution-card p {
    color: #65717d;
    font-size: 14px;
    line-height: 1.55;
    margin-bottom: 16px;
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
    padding-left: 20px;
    color: #354353;
    font-size: 13px;
    font-weight: 700;
    line-height: 1.35;
}

.ck-solution-list li::before {
    content: "";
    position: absolute;
    left: 0;
    top: .45em;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #df6d1c;
}

.ck-solution-card.secondary .ck-solution-list li::before {
    background: #1f67ab;
}

.ck-assurance-section {
    padding: 76px 0;
    background: #eef2f7;
}

.ck-assurance-shell {
    width: var(--container-w);
    max-width: var(--container-max);
    margin: 0 auto;
    display: grid;
    grid-template-columns: minmax(0, .9fr) minmax(0, 1.1fr);
    gap: 32px;
    align-items: stretch;
}

.ck-assurance-panel {
    padding: 34px;
    border-radius: 18px;
    background: #10243a;
    color: #fff;
    box-shadow: var(--ck-shadow);
}

.ck-assurance-eyebrow {
    display: inline-flex;
    margin-bottom: 14px;
    padding: 7px 12px;
    border-radius: 999px;
    background: rgba(239,138,57,.18);
    color: #ffb072;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: .8px;
    text-transform: uppercase;
}

.ck-assurance-panel h2 {
    font-size: clamp(28px, 3vw, 42px);
    font-weight: 900;
    line-height: 1.08;
    margin-bottom: 16px;
}

.ck-assurance-panel p {
    color: rgba(255,255,255,.76);
    font-size: 16px;
    line-height: 1.65;
}

.ck-assurance-list {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}

.ck-assurance-item {
    padding: 22px;
    border: 1px solid #dbe5ee;
    border-radius: 16px;
    background: #fff;
    box-shadow: var(--ck-shadow-soft);
}

.ck-assurance-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    margin-bottom: 14px;
    border-radius: 11px;
    background: #fff4ec;
    color: #df6d1c;
    font-weight: 900;
}

.ck-assurance-item h3 {
    color: #152536;
    font-size: 17px;
    font-weight: 900;
    margin-bottom: 8px;
}

.ck-assurance-item p {
    color: #65717d;
    font-size: 13px;
    line-height: 1.5;
}

.ck-compare-section {
    padding: 76px 0;
    background: #fff;
}

.ck-compare-table {
    width: var(--container-w);
    max-width: 1040px;
    margin: 0 auto;
    overflow: hidden;
    border: 1px solid #dbe5ee;
    border-radius: 18px;
    background: #fff;
    box-shadow: var(--ck-shadow);
}

.ck-compare-row {
    display: grid;
    grid-template-columns: 1.1fr 1fr 1fr;
}

.ck-compare-row > div {
    padding: 18px 20px;
    border-bottom: 1px solid #e7edf3;
    color: #46515d;
    font-size: 14px;
    line-height: 1.4;
}

.ck-compare-row:last-child > div {
    border-bottom: none;
}

.ck-compare-head > div {
    background: #10243a;
    color: #fff;
    font-weight: 900;
}

.ck-compare-factor {
    font-weight: 900;
    color: #152536 !important;
    background: #f6f9fc;
}

.ck-compare-good {
    color: #117a3f !important;
    font-weight: 800;
}

.ck-compare-risk {
    color: #a04423 !important;
}

/* ============================================================
   GUIDE SECTION
   ============================================================ */
.ck-guide-section {
    padding: 48px 0;
    background: var(--bg);
}

.ck-guide-container {
    width: var(--container-w);
    max-width: var(--container-max);
    margin: 0 auto;
    display: grid;
    grid-template-columns: minmax(320px, 0.78fr) minmax(0, 1.22fr);
    gap: 28px;
    align-items: stretch;
}

.ck-guide-image-box {
    border: 3px solid #f26f21;
    border-left: 6px solid #1f78c8;
    border-radius: 16px;
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
    border-radius: 16px;
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
    background: rgba(10, 29, 52, .16);
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
    border-radius: 10px;
    background: #fff;
    color: #222;
    text-decoration: none;
    font-size: 18px;
    font-weight: 900;
    box-shadow: 0 5px 12px rgba(0,0,0,.3);
    white-space: nowrap;
    transition: transform .2s ease, box-shadow .2s ease, opacity .2s;
}

.ck-guide-btn:hover {
    color: #222;
    opacity: .9;
    text-decoration: none;
    transform: translateY(-1px);
    box-shadow: 0 10px 20px rgba(0,0,0,.24);
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
    font-size: 38px;
    font-weight: 800;
    color: #1f1f1f;
}

.upcoming-heading-line {
    width: 200px;
    height: 4px;
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
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 24px rgba(0,0,0,.11);
    position: relative;
    transition: transform .28s ease, box-shadow .28s ease;
}

.upcoming-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 34px rgba(0,0,0,.15);
}

.upcoming-card.orange-border { border: 2px solid #ef7d2d; }
.upcoming-card.blue-border   { border: 2px solid #2f78bf; }

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
    padding: 60px 0;
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
    border-radius: 16px;
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
    background: rgba(8, 26, 48, .14);
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
    border-radius: 10px;
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
    border: 3px solid #f26f21;
    border-left: 6px solid #1f78c8;
    border-right: 6px solid #1f78c8;
    border-radius: 16px;
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
    padding: 52px 0;
    background: #f4f4f4;
    text-align: center;
}

.ck-city-title {
    font-size: 38px;
    font-weight: 900;
    color: #1f1f1f;
    margin-bottom: 36px;
}

.ck-city-grid {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 40px;
    flex-wrap: wrap;
    width: var(--container-w);
    max-width: var(--container-max);
    margin: 0 auto;
}

.ck-city-card {
    width: clamp(128px, 14vw, 180px);
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
    padding: 60px 0 70px;
    background: var(--bg);
    text-align: center;
}

.ck-all-services-title {
    font-size: clamp(28px, 3.2vw, 38px);
    font-weight: 900;
    color: #1f1f1f;
}

.ck-all-services-line {
    width: 240px;
    height: 4px;
    margin: 12px auto 44px;
    border-radius: 50px;
    background: linear-gradient(90deg, #ef7d2d, #2f78bf);
}

.ck-service-slider {
    width: var(--container-w);
    max-width: 960px;
    height: 420px;
    margin: 0 auto;
    display: flex;
    gap: 8px;
    overflow: hidden;
    align-items: stretch;
    touch-action: pan-x;
}

.ck-slide {
    flex: 1;
    min-width: 68px;
    border-radius: 14px;
    overflow: hidden;
    position: relative;
    box-shadow: 0 6px 10px rgba(0,0,0,.22);
    transition: flex .42s ease, transform .28s ease, box-shadow .28s ease;
    cursor: pointer;
}

.ck-slide.active { flex: 3.2; }

.ck-slide:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 28px rgba(0,0,0,.20);
}

.ck-slide img {
    width: 110%;
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
    border-radius: 8px;
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
    padding: 80px 0 70px;
    background: var(--bg);
}

.ck-testimonial-heading {
    text-align: center;
    margin-bottom: 90px;
}

.ck-testimonial-heading h2 {
    font-size: clamp(28px, 3.2vw, 38px);
    font-weight: 900;
    color: #1f1f1f;
}

.ck-testimonial-line {
    width: min(420px, 82vw);
    height: 4px;
    margin: 12px auto 0;
    border-radius: 50px;
    background: linear-gradient(90deg, #ef7d2d, #2f78bf);
}

.ck-testimonial-grid {
    width: var(--container-w);
    max-width: var(--container-max);
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 28px;
    align-items: stretch;
}

.ck-testimonial-card {
    position: relative;
    background: #fff;
    border: 1.5px solid var(--blue);
    border-radius: var(--radius);
    padding: 80px 22px 26px;
    text-align: center;
    height: 100%;
    transition: transform .28s ease, box-shadow .28s ease;
}

.ck-testimonial-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 30px rgba(31,103,171,.14);
}

.ck-testimonial-img {
    position: absolute;
    top: -56px;
    left: 50%;
    transform: translateX(-50%);
    width: 108px;
    height: 108px;
    border-radius: 50%;
    overflow: hidden;
    background: #ddd;
    border: 3px solid #fff;
    box-shadow: 0 4px 12px rgba(0,0,0,.18);
}

.ck-testimonial-avatar {
    width: 100%;
    height: 100%;
    border-radius: inherit;
    display: grid;
    place-items: center;
    background: linear-gradient(135deg, #1f67ab, #ef8a39);
    color: #fff;
    font-size: 22px;
    font-weight: 900;
}

.ck-testimonial-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.ck-testimonial-name {
    font-size: 17px;
    font-weight: 800;
    color: #1f1f1f;
    margin: 0 0 4px;
    line-height: 1.3;
}

.ck-testimonial-role {
    font-size: 13px;
    color: #777;
    margin: 0 0 10px;
}

.ck-stars {
    color: #ffb800;
    font-size: 24px;
    line-height: 1;
    margin-bottom: 14px;
    letter-spacing: 2px;
}

.ck-testimonial-text {
    font-size: 13px;
    line-height: 1.6;
    color: #666;
}

/* ============================================================
   FAQ
   ============================================================ */
.faq-section {
    padding: 70px 0 60px;
    background: #e9e9e9;
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
    color: #1f1f1f;
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
    border-radius: 14px;
    box-shadow: 0 4px 10px rgba(0,0,0,.1);
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
    font-size: 16px;
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
        grid-template-columns: repeat(2, 1fr);
        gap: 80px 24px;
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

    .ck-solution-shell {
        grid-template-columns: 1fr;
    }

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
            linear-gradient(90deg, rgba(0,0,0,.88), rgba(0,0,0,.66)),
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
        min-height: 50px;
        padding: 0 16px;
        font-size: 14px;
        border-radius: 12px;
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

    .ck-solution-intro {
        padding: 26px 22px;
    }

    .ck-assurance-panel {
        padding: 26px 22px;
    }

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
        width: min(240px, 72vw);
    }

    .ck-trust-section { padding: 42px 0; }
    .ck-trust-container { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px; }
    .ck-trust-icon-img { width: 62px; height: 58px; }
    .ck-trust-title     { font-size: 13px; }

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
        border-radius: 14px;
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
    .upcoming-card    { width: 76vw; min-width: 76vw; max-width: 290px; border-radius: 16px; }
    .upcoming-card-image { height: 170px; }

    .ck-testimonial-grid {
        grid-template-columns: 1fr;
        gap: 80px;
    }

    .ck-testimonial-card { padding: 76px 16px 22px; }
    .ck-testimonial-name { font-size: 15px; }

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
        max-width: 220px;
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
</style>
@endpush

@section('content')

<div class="home-page">

    {{-- ── HERO ── --}}
    <section class="hero-banner">
        <div class="hero-inner">
            <div class="hero-content">
                <div class="hero-tech-badge" aria-label="India's No.1 tech powered end-to-end construction solution">
                    INDIA'S NO.1 TECH POWERED END-TO-END CONSTRUCTION SOLUTION
                </div>

                <h1 class="hero-title">Plan. Hire. Execute</h1>
                <p class="hero-subtitle">We manage your construction end-to-end</p>
                <p class="hero-description">From planning and design to execution and quality checks — everything handled through us</p>

                <button type="button" class="hero-plan-btn" id="openPlanModalBtn">
                    Get End-to-End Construction Plan
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M5 12h14"></path>
                        <path d="m13 6 6 6-6 6"></path>
                    </svg>
                </button>

                <div class="hero-proof-grid" aria-label="ConstructKaro highlights">
                    <div class="hero-proof-item">
                        <span class="hero-proof-value">20+</span>
                        <span class="hero-proof-label">Years construction experience</span>
                    </div>
                    <div class="hero-proof-item">
                        <span class="hero-proof-value">24h</span>
                        <span class="hero-proof-label">Requirement response window</span>
                    </div>
                    <div class="hero-proof-item">
                        <span class="hero-proof-value">8+</span>
                        <span class="hero-proof-label">Construction service categories</span>
                    </div>
                    <div class="hero-proof-item">
                        <span class="hero-proof-value">5</span>
                        <span class="hero-proof-label">Cities and regions served</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── TRUST STRIP ── --}}
    <section class="ck-trust-section">
        <div class="ck-trust-container">
            <div class="ck-trust-item">
                {!! $ckImage('images/logo/safety-helmet.png', '', 'ck-trust-icon-img', ['width' => 87, 'height' => 81, 'loading' => 'eager', 'decoding' => 'async']) !!}
                <p class="ck-trust-title">Built by 20+ years<br>construction experience</p>
            </div>
            <div class="ck-trust-item">
                {!! $ckImage('images/logo/verify.png', '', 'ck-trust-icon-img', ['width' => 87, 'height' => 81, 'loading' => 'eager', 'decoding' => 'async']) !!}
                <p class="ck-trust-title">Verified<br>vendors only</p>
            </div>
            <div class="ck-trust-item">
                {!! $ckImage('images/logo/onground.png', '', 'ck-trust-icon-img', ['width' => 87, 'height' => 81, 'loading' => 'eager', 'decoding' => 'async']) !!}
                <p class="ck-trust-title">On-ground<br>execution support</p>
            </div>
            <div class="ck-trust-item">
                {!! $ckImage('images/logo/transpernt.png', '', 'ck-trust-icon-img', ['width' => 87, 'height' => 81, 'loading' => 'eager', 'decoding' => 'async']) !!}
                <p class="ck-trust-title">Transparent<br>pricing approach</p>
            </div>
        </div>
    </section>

    {{-- ── MAIN SERVICE CARDS ── --}}
  
   

    <section class="ck-process-section">
        <div class="section-container">
            <div class="section-heading">
                <h2>How ConstructKaro Works</h2>
                <div class="heading-bar"></div>
            </div>

            <div class="ck-process-grid">
                <div class="ck-process-card">
                    <span class="ck-process-number">01</span>
                    <h3>Share your requirement</h3>
                    <p>Tell us your service, city, timeline, and project need in a simple guided flow.</p>
                </div>
                <div class="ck-process-card">
                    <span class="ck-process-number">02</span>
                    <h3>Get matched with experts</h3>
                    <p>We route the enquiry to relevant architects, contractors, surveyors, BOQ experts, and support teams.</p>
                </div>
                <div class="ck-process-card">
                    <span class="ck-process-number">03</span>
                    <h3>Compare with clarity</h3>
                    <p>Review service fit, pricing approach, execution capability, and practical next steps before you decide.</p>
                </div>
                <div class="ck-process-card">
                    <span class="ck-process-number">04</span>
                    <h3>Plan and execute</h3>
                    <p>Move from planning to site execution with on-ground coordination and transparent communication.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="ck-solution-section">
        <div class="ck-solution-shell">
            <div class="ck-solution-intro">
                <span class="ck-solution-badge">One platform, any construction need</span>
                <h2>Best for complete end-to-end construction. Flexible for separate services too.</h2>
                <p>Whether you want ConstructKaro to guide the full journey from planning to execution, or you only need one service like an architect, contractor, survey, BOQ, testing, legal support, facade, or machinery, we help you find the right solution without confusion.</p>
            </div>

            <div class="ck-solution-options">
                <div class="ck-solution-card primary">
                    <h3>End-to-End Construction Solution</h3>
                    <p>For customers who want one organised path from idea to execution.</p>
                    <ul class="ck-solution-list">
                        <li>Planning, design and BOQ clarity</li>
                        <li>Verified experts and contractor support</li>
                        <li>Execution coordination and site guidance</li>
                        <li>Transparent process from start to finish</li>
                    </ul>
                </div>

                <div class="ck-solution-card secondary">
                    <h3>Separate Service Solutions</h3>
                    <p>For customers who need only one expert service at the right time.</p>
                    <ul class="ck-solution-list">
                        <li>Architect, contractor and interior experts</li>
                        <li>Survey, structural audit, BOQ and testing</li>
                        <li>NA/legal, facade, welding and machinery</li>
                        <li>Choose one service now, add more later</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div id="comingSoonLocationBox" style="display:none;">
        <h2>We are coming soon for this location</h2>
        <p>Currently, our services are not available in your selected area. We are expanding soon.</p>
    </div>
 <section class="ck-services-section" id="mainServicesSection">
    <div class="section-container">
        <div class="ck-services-grid">

            <div class="ck-service-card">
                <div class="ck-service-image">
                    {!! $ckImage('images/b1.png', 'Architect', '', ['width' => 270, 'height' => 203, 'loading' => 'lazy', 'decoding' => 'async']) !!}
                </div>
                <h3 class="ck-service-title">Architect</h3>
                <div class="ck-service-line"></div>
                <p class="ck-service-text">Post your requirements and get your quote within 24 hours.</p>
                @if($isCustomerLoggedIn)
                    <a href="{{ route('post', ['work_type_id' => 2]) }}" class="ck-service-btn">Post Your Requirement</a>
                @else
                    <a href="{{ route('post', ['work_type_id' => 2]) }}" data-redirect="{{ route('post', ['work_type_id' => 2]) }}" class="ck-service-btn open-customer-login-modal">Post Your Requirement</a>
                @endif
            </div>

            <div class="ck-service-card">
                <div class="ck-service-image">
                    {!! $ckImage('images/b2.png', 'Contractor', '', ['width' => 270, 'height' => 203, 'loading' => 'lazy', 'decoding' => 'async']) !!}
                </div>
                <h3 class="ck-service-title">Contractor</h3>
                <div class="ck-service-line"></div>
                <p class="ck-service-text">Post your requirements and get your quote within 24 hours.</p>
                @if($isCustomerLoggedIn)
                    <a href="{{ route('post', ['work_type_id' => 1]) }}" class="ck-service-btn">Post Your Requirement</a>
                @else
                    <a href="{{ route('post', ['work_type_id' => 1]) }}" data-redirect="{{ route('post', ['work_type_id' => 1]) }}" class="ck-service-btn open-customer-login-modal">Post Your Requirement</a>
                @endif
            </div>

            <div class="ck-service-card">
                <div class="ck-service-image">
                    {!! $ckImage('images/b3.png', 'Interior Designer', '', ['width' => 270, 'height' => 203, 'loading' => 'lazy', 'decoding' => 'async']) !!}
                </div>
                <h3 class="ck-service-title">Interior Designer</h3>
                <div class="ck-service-line"></div>
                <p class="ck-service-text">Post your requirements and get your quote within 24 hours.</p>
                @if($isCustomerLoggedIn)
                    <a href="{{ route('post_for_interior', ['work_type_id' => 4]) }}" class="ck-service-btn">Post Your Requirement</a>
                @else
                    <a href="{{ route('post_for_interior', ['work_type_id' => 4]) }}" data-redirect="{{ route('post_for_interior', ['work_type_id' => 4]) }}" class="ck-service-btn open-customer-login-modal">Post Your Requirement</a>
                @endif
            </div>

        </div>
    </div>
</section>
    {{-- ── EXPLORE MORE SERVICES ── --}}
    <!-- <section class="explore-services-section"> -->
        <section class="explore-services-section" id="exploreServicesSection">
        <div class="section-container">
            <div class="section-heading">
                <h2>Explore More Services</h2>
                <div class="heading-bar"></div>
            </div>

            <div class="explore-services-grid">

                <div class="explore-card orange-card">
                    <div class="explore-card-image">
                        {!! $ckImage('images/explore/survey-services.png', 'Survey Services', '', ['width' => 420, 'height' => 263, 'loading' => 'lazy', 'decoding' => 'async']) !!}
                    </div>
                    <div class="explore-card-body">
                        <h3>Survey Services</h3>
                        <p>Explore All Categories of Survey Services</p>
                        @if($isCustomerLoggedIn)
                            <a href="{{ route('customer.survey') }}" class="explore-btn orange-btn">Get Started</a>
                        @else
                            <a href="{{ route('customer.survey') }}" data-redirect="{{ route('customer.survey') }}" class="explore-btn orange-btn open-customer-login-modal">Get Started</a>
                        @endif
                    </div>
                </div>

                <!-- <div class="explore-card blue-card">
                    <div class="explore-card-image">
                        <img src="{{ asset('images/explore/testing-services.png') }}" alt="Testing Services">
                    </div>
                    <div class="explore-card-body">
                        <h3>Testing Services</h3>
                        <p>Explore All Categories of Testing Services</p>
                        <a href="{{ route('customer.testing') }}" class="explore-btn blue-btn">Get Started</a>
                    </div>
                </div> -->
                 <div class="explore-card blue-card">
                    <div class="explore-card-image">
                        {!! $ckImage('images/explore/structural-audit.png', 'Structural Audit', '', ['width' => 420, 'height' => 263, 'loading' => 'lazy', 'decoding' => 'async']) !!}
                    </div>
                    <div class="explore-card-body">
                        <h3>Structural Audit</h3>
                        <p>Explore All Categories of structural Services</p>
                        @if($isCustomerLoggedIn)
                            <a href="{{ route('customer.structuralaudit') }}" class="explore-btn blue-btn">Get Started</a>
                        @else
                            <a href="{{ route('customer.structuralaudit') }}" data-redirect="{{ route('customer.structuralaudit') }}" class="explore-btn blue-btn open-customer-login-modal">Get Started</a>
                        @endif
                    </div>
                </div>

                <div class="explore-card orange-card">
                    <div class="explore-card-image">
                        {!! $ckImage('images/explore/boq-estimation.png', 'BOQ/Estimation', '', ['width' => 420, 'height' => 263, 'loading' => 'lazy', 'decoding' => 'async']) !!}
                    </div>
                    <div class="explore-card-body">
                        <h3>BOQ / Estimation</h3>
                        <p>Explore All Categories of BOQ / Estimation Services</p>
                        @if($isCustomerLoggedIn)
                            <a href="{{ route('customer.boq') }}" class="explore-btn orange-btn">Get Started</a>
                        @else
                            <a href="{{ route('customer.boq') }}" data-redirect="{{ route('customer.boq') }}" class="explore-btn orange-btn open-customer-login-modal">Get Started</a>
                        @endif
                    </div>
                </div>

                <div class="explore-card orange-card">
                    <div class="explore-card-image">
                        {!! $ckImage('images/explore/legal-due-diligence.png', 'NA Support & Legal Due Diligence', '', ['width' => 420, 'height' => 263, 'loading' => 'lazy', 'decoding' => 'async']) !!}
                    </div>
                    <div class="explore-card-body">
                        <h3>NA Support & Legal Due Diligence</h3>
                        <p>Explore All Categories of NA Support & Legal Services</p>
                        @if($isCustomerLoggedIn)
                            <a href="{{ route('customer.nasupport') }}" class="explore-btn orange-btn">Get Started</a>
                        @else
                            <a href="{{ route('customer.nasupport') }}" data-redirect="{{ route('customer.nasupport') }}" class="explore-btn orange-btn open-customer-login-modal">Get Started</a>
                        @endif
                    </div>
                </div>

                <div class="explore-card blue-card">
                    <div class="explore-card-image">
                        {!! $ckImage('images/explore/welding-fabrication.png', 'Welding & Fabrication', '', ['width' => 420, 'height' => 263, 'loading' => 'lazy', 'decoding' => 'async']) !!}
                    </div>
                    <div class="explore-card-body">
                        <h3>Welding & Fabrication</h3>
                        <p>Explore All Categories of Welding & Fabrication Services</p>
                        @if($isCustomerLoggedIn)
                            <a href="{{ route('customer.welding_fabrication') }}" class="explore-btn blue-btn">Get Started</a>
                        @else
                            <a href="{{ route('customer.welding_fabrication') }}" data-redirect="{{ route('customer.welding_fabrication') }}" class="explore-btn blue-btn open-customer-login-modal">Get Started</a>
                        @endif
                    </div>
                </div>

                <div class="explore-card blue-card">
                    <div class="explore-card-image">
                        {!! $ckImage('images/explore/testing-services.jpeg', 'Testing Services', '', ['width' => 420, 'height' => 263, 'loading' => 'lazy', 'decoding' => 'async']) !!}
                    </div>
                    <div class="explore-card-body">
                        <h3>Testing Services</h3>
                        <p>Explore All Categories of Testing Services</p>
                        @if($isCustomerLoggedIn)
                            <a href="{{ route('customer.testing') }}" class="explore-btn blue-btn">Get Started</a>
                        @else
                            <a href="{{ route('customer.testing') }}" data-redirect="{{ route('customer.testing') }}" class="explore-btn blue-btn open-customer-login-modal">Get Started</a>
                        @endif
                    </div>
                </div>

                <div class="explore-card orange-card">
                    <div class="explore-card-image">
                        {!! $ckImage('images/explore/machinaryonhire.png', 'Machinery On Hire', '', ['width' => 420, 'height' => 263, 'loading' => 'lazy', 'decoding' => 'async']) !!}
                    </div>
                    <div class="explore-card-body">
                        <h3>Machinery On Hire</h3>
                        <p>Explore All Categories of Machinery On Hire Services</p>
                        <a href="{{ route('machinery_provider.create') }}" class="explore-btn orange-btn">Get Started</a>
                    </div>
                </div>

                <div class="explore-card blue-card">
                    <div class="explore-card-image">
                        {!! $ckImage('images/explore/facade-services.png', 'Facade Services', '', ['width' => 420, 'height' => 263, 'loading' => 'lazy', 'decoding' => 'async']) !!}
                    </div>
                    <div class="explore-card-body">
                        <h3>Facade Services</h3>
                        <p>Explore All Categories of Facade Services</p>
                        @if($isCustomerLoggedIn)
                            <a href="{{ route('customer.facade') }}" class="explore-btn blue-btn">Get Started</a>
                        @else
                            <a href="{{ route('customer.facade') }}" data-redirect="{{ route('customer.facade') }}" class="explore-btn blue-btn open-customer-login-modal">Get Started</a>
                        @endif
                    </div>
                </div>

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
                    <span class="ck-assurance-icon">✓</span>
                    <h3>Verified service network</h3>
                    <p>Connect with relevant providers across architectural, contractor, survey, BOQ, audit, legal, and support services.</p>
                </div>
                <div class="ck-assurance-item">
                    <span class="ck-assurance-icon">Rs</span>
                    <h3>Transparent pricing approach</h3>
                    <p>Get quote-led conversations that make scope and next steps clearer before committing.</p>
                </div>
                <div class="ck-assurance-item">
                    <span class="ck-assurance-icon">24</span>
                    <h3>Fast requirement response</h3>
                    <p>Post your requirement and get guided follow-up so your project does not stay stuck at the starting line.</p>
                </div>
                <div class="ck-assurance-item">
                    <span class="ck-assurance-icon">Go</span>
                    <h3>End-to-end path</h3>
                    <p>From design and approvals to BOQ, vendors, materials, testing, and execution support in one place.</p>
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
        <div class="section-heading">
            <h2>Platform Managed vs Unmanaged Execution</h2>
            <div class="heading-bar"></div>
        </div>

        <div class="ck-compare-table">
            <div class="ck-compare-row ck-compare-head">
                <div>Factor</div>
                <div>ConstructKaro Approach</div>
                <div>Typical Unmanaged Approach</div>
            </div>
            <div class="ck-compare-row">
                <div class="ck-compare-factor">Service discovery</div>
                <div class="ck-compare-good">Relevant experts by service and location</div>
                <div class="ck-compare-risk">Random referrals and limited options</div>
            </div>
            <div class="ck-compare-row">
                <div class="ck-compare-factor">Scope clarity</div>
                <div class="ck-compare-good">Requirement-led conversations</div>
                <div class="ck-compare-risk">Verbal scope and repeated confusion</div>
            </div>
            <div class="ck-compare-row">
                <div class="ck-compare-factor">Planning support</div>
                <div class="ck-compare-good">Design, BOQ, survey, legal, and audit routes</div>
                <div class="ck-compare-risk">Separate follow-ups with no single flow</div>
            </div>
            <div class="ck-compare-row">
                <div class="ck-compare-factor">Execution confidence</div>
                <div class="ck-compare-good">On-ground support and transparent communication</div>
                <div class="ck-compare-risk">Phone updates and uncertainty</div>
            </div>
        </div>
    </section>

    <section class="ck-vendor-section">
        <div class="ck-vendor-container">
            <div class="ck-vendor-content-box">
                <h2 class="ck-vendor-title">Get real construction projects in your area</h2>
                <p class="ck-vendor-text">Join ConstructKaro and start receiving verified leads. No commission, no listing fees.</p>
                <a href="https://vendor.constructkaro.com/" class="ck-vendor-btn">Join as Vendor</a>
            </div>
            <div class="ck-vendor-image-box">
                {!! $ckImage('images/logo/a1.jpg', 'Construction Projects', '', ['width' => 520, 'height' => 300, 'loading' => 'lazy', 'decoding' => 'async']) !!}
            </div>
        </div>
    </section>

    {{-- ── CITIES ── --}}
    <section class="ck-city-section">
        <h2 class="ck-city-title">Cities We Serve</h2>
        <div class="ck-city-grid">
            <div class="ck-city-card">{!! $ckImage('images/logo/navi-mumbai.png', 'Navi Mumbai', '', ['width' => 180, 'height' => 180, 'loading' => 'lazy', 'decoding' => 'async']) !!}</div>
            <div class="ck-city-card">{!! $ckImage('images/logo/mumbai.png', 'Mumbai', '', ['width' => 180, 'height' => 180, 'loading' => 'lazy', 'decoding' => 'async']) !!}</div>
            <div class="ck-city-card">{!! $ckImage('images/logo/thane.png', 'Thane', '', ['width' => 180, 'height' => 180, 'loading' => 'lazy', 'decoding' => 'async']) !!}</div>
            <div class="ck-city-card">{!! $ckImage('images/logo/pune.png', 'Pune', '', ['width' => 180, 'height' => 180, 'loading' => 'lazy', 'decoding' => 'async']) !!}</div>
            <div class="ck-city-card">{!! $ckImage('images/logo/raigad.png', 'Raigad', '', ['width' => 180, 'height' => 180, 'loading' => 'lazy', 'decoding' => 'async']) !!}</div>
        </div>
    </section>

    {{-- ── ALL SERVICES SLIDER ── --}}
    <section class="ck-all-services-section">
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
        </div>
    </section>

    {{-- ── TESTIMONIALS ── --}}
    <section class="ck-testimonial-section">
        <div class="ck-testimonial-heading">
            <h2>What People Say About Us</h2>
            <div class="ck-testimonial-line"></div>
        </div>

        <div class="ck-testimonial-grid">

            <div class="ck-testimonial-card">
                <div class="ck-testimonial-img">
                    <div class="ck-testimonial-avatar" aria-hidden="true">PI</div>
                </div>
                <h3 class="ck-testimonial-name">Patil Infra & Realtors Pvt. Ltd.</h3>
                <p class="ck-testimonial-role">Real Estate Developer | Khopoli</p>
                <div class="ck-stars">★★★★☆</div>
                <p class="ck-testimonial-text">For our ongoing building projects, finding dependable contractors on time is always a challenge. Through ConstructKaro, we were able to identify suitable labour contractors quickly, improving our execution efficiency.</p>
            </div>

            <div class="ck-testimonial-card">
                <div class="ck-testimonial-img">
                    <div class="ck-testimonial-avatar" aria-hidden="true">DS</div>
                </div>
                <h3 class="ck-testimonial-name">Dinesh Shirke</h3>
                <p class="ck-testimonial-role">Home Owner | Nagothane, Maharashtra</p>
                <div class="ck-stars">★★★★☆</div>
                <p class="ck-testimonial-text">I was planning to construct a bungalow and didn't know how to start. I posted my requirement on ConstructKaro and received genuine responses. One lead converted into actual work and my bungalow construction has started.</p>
            </div>

            <div class="ck-testimonial-card">
                <div class="ck-testimonial-img">
                    <div class="ck-testimonial-avatar" aria-hidden="true">OV</div>
                </div>
                <h3 class="ck-testimonial-name">Omkar Vidhate</h3>
                <p class="ck-testimonial-role">Architect | Pune</p>
                <div class="ck-stars">★★★☆☆</div>
                <p class="ck-testimonial-text">After leaving my job, getting independent projects was challenging. Through ConstructKaro, I received architectural planning and interior design work that matched my skills perfectly.</p>
            </div>

            <div class="ck-testimonial-card">
                <div class="ck-testimonial-img">
                    <div class="ck-testimonial-avatar" aria-hidden="true">SA</div>
                </div>
                <h3 class="ck-testimonial-name">Sanket Asgaonkar</h3>
                <p class="ck-testimonial-role">Land Surveyor & Drone Survey Specialist | Raigad</p>
                <div class="ck-stars">★★★★☆</div>
                <p class="ck-testimonial-text">I had the skills and equipment, but finding the right drone survey clients was difficult. Through ConstructKaro, I received a drone survey requirement in Poladpur that perfectly matched my profile.</p>
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
                <h2 class="plan-modal-title">Get Your Free Construction Plan</h2>
                <p class="plan-modal-copy">Share your details and our team will reach out within 24 hours with a personalised plan.</p>

                <div class="plan-step active" data-plan-step="1">
            <div class="plan-step-label">Step 1 of 3 &mdash; Your details</div>

            <div class="plan-form-group">
                <label for="planFullName">Full Name</label>
                <input type="text" id="planFullName" class="plan-input" placeholder="E.g. Rohan Sharma" autocomplete="name">
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
                <button type="button" class="plan-primary-btn" id="planSubmitBtn">Get My Free Plan &rarr;</button>
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
            <p>Enter your mobile number to get OTP</p>
        </div>

        <input type="hidden" id="customer_redirect_url">

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

        <div class="otp-success-msg" id="customer_otp_success_msg"></div>

        <div class="custom-modal-actions">
            <button type="button" class="modal-btn primary-btn" id="customerSendOtpBtn">Get OTP</button>
            <button type="button" class="modal-btn verify-btn" id="customerVerifyOtpBtn" style="display:none;">Verify OTP</button>
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

    $(document).on('click', '.open-customer-login-modal', function (event) {
        event.preventDefault();
        let redirectUrl = $(this).data('redirect') || $(this).attr('href') || '';
        $('#customer_redirect_url').val(redirectUrl);
        $('#customer_mobile_number').val('');
        $('#customer_otp_code').val('');
        $('#customer_mobile_error').text('');
        $('#customer_otp_error').text('');
        $('#customer_otp_success_msg').text('');
        $('#customerOtpSection').hide();
        $('#customerVerifyOtpBtn').hide();
        $('#customerSendOtpBtn').show();
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

    $('#openPlanModalBtn').on('click', function () {
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
                'services[]': 'End-to-end construction',
                project_description: 'Free end-to-end construction plan request. Timeframe: ' + $('#planTimeframe').val()
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
                btn.prop('disabled', false).text('Get My Free Plan ->');
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
<script>
document.addEventListener("DOMContentLoaded", function () {

    const mainServicesSection = document.getElementById("mainServicesSection");
    const exploreServicesSection = document.getElementById("exploreServicesSection");
    const comingSoonLocationBox = document.getElementById("comingSoonLocationBox");
    const revealItems = document.querySelectorAll(
        '.hero-banner, .ck-trust-section, .ck-process-section, .ck-solution-section, .ck-services-section, .explore-services-section, .ck-assurance-section, .ck-guide-section, .ck-compare-section, .ck-vendor-section, .ck-city-section, .ck-all-services-section, .ck-testimonial-section'
    );

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
