@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

@php
    $isCustomerLoggedIn = session('customer_logged_in');
@endphp

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
        url("{{ asset('images/banner.jpg') }}");
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

.hero-field-search {
    width: 100%;
    max-width: 480px;
    height: 52px;
    background: #f2f2f2;
    border-radius: 14px;
    display: flex;
    align-items: center;
    padding: 0 16px;
    gap: 10px;
    box-shadow: 0 12px 30px rgba(0,0,0,.18);
    transition: transform .25s ease, box-shadow .25s ease, background .25s ease;
}

.hero-field-search:focus-within {
    background: #fff;
    transform: translateY(-2px);
    box-shadow: 0 16px 36px rgba(0,0,0,.22);
}

.hero-icon-left {
    width: 24px;
    height: 24px;
    color: var(--blue-light);
    flex-shrink: 0;
}

.hero-field-search input {
    flex: 1;
    height: 100%;
    border: none;
    outline: none;
    background: transparent;
    font-size: 14px;
    color: #333;
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
    background: url("{{ asset('images/logo/Confused.png') }}") center/cover no-repeat;
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

.upcoming-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    z-index: 2;
    padding: 6px 12px;
    border-radius: 999px;
    background: rgba(17,24,39,.85);
    color: #fff;
    font-size: 11px;
    font-weight: 700;
}

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
    background: url("{{ asset('images/logo/area.png') }}") center/cover no-repeat;
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
    .explore-services-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 72px 28px;
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
    .explore-services-grid {
        grid-template-columns: 1fr;
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
    .faq-container {
        width: calc(100% - 32px);
    }

    .hero-banner {
        min-height: auto;
        padding: 64px 0;
        background-image:
            linear-gradient(90deg, rgba(0,0,0,.88), rgba(0,0,0,.66)),
            url("{{ asset('images/banner.jpg') }}");
        background-position: 70% center;
    }

    .hero-inner {
        width: calc(100% - 32px);
    }

    .hero-content      { max-width: 100%; }
    .hero-title        { font-size: clamp(28px, 8vw, 34px); }
    .hero-subtitle     { font-size: 17px; }
    .hero-description  { font-size: 13px; }
    .hero-field-search {
        max-width: none;
        height: auto;
        min-height: 50px;
        border-radius: 12px;
    }

    .hero-field-search input {
        font-size: 13px;
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

<div class="home-page">

    {{-- ── HERO ── --}}
    <section class="hero-banner">
        <div class="hero-inner">
            <div class="hero-content">
                <h1 class="hero-title">Plan. Hire. Execute</h1>
                <p class="hero-subtitle">We manage your construction end-to-end</p>
                <p class="hero-description">From planning and design to execution and quality checks — everything handled through us</p>

                <div class="hero-field-search">
                    <svg class="hero-icon-left" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M10 2a8 8 0 105.293 14.293l4.707 4.707 1.414-1.414-4.707-4.707A8 8 0 0010 2zm0 2a6 6 0 110 12 6 6 0 010-12z"/>
                    </svg>
                    <input type="text" placeholder="Search for Residential Architect">
                </div>
            </div>
        </div>
    </section>

    {{-- ── TRUST STRIP ── --}}
    <section class="ck-trust-section">
        <div class="ck-trust-container">
            <div class="ck-trust-item">
                <img src="{{ asset('images/logo/safety-helmet.png') }}" class="ck-trust-icon-img" alt="">
                <p class="ck-trust-title">Built by 20+ years<br>construction experience</p>
            </div>
            <div class="ck-trust-item">
                <img src="{{ asset('images/logo/verify.png') }}" class="ck-trust-icon-img" alt="">
                <p class="ck-trust-title">Verified<br>vendors only</p>
            </div>
            <div class="ck-trust-item">
                <img src="{{ asset('images/logo/onground.png') }}" class="ck-trust-icon-img" alt="">
                <p class="ck-trust-title">On-ground<br>execution support</p>
            </div>
            <div class="ck-trust-item">
                <img src="{{ asset('images/logo/transpernt.png') }}" class="ck-trust-icon-img" alt="">
                <p class="ck-trust-title">Transparent<br>pricing approach</p>
            </div>
        </div>
    </section>

    {{-- ── MAIN SERVICE CARDS ── --}}
  
   

    <div id="comingSoonLocationBox" style="display:none;">
        <h2>We are coming soon for this location</h2>
        <p>Currently, our services are not available in your selected area. We are expanding soon.</p>
    </div>
 <section class="ck-services-section" id="mainServicesSection">
    <div class="section-container">
        <div class="ck-services-grid">

            <div class="ck-service-card">
                <div class="ck-service-image">
                    <img src="{{ asset('images/b1.png') }}" alt="Architect">
                </div>
                <h3 class="ck-service-title">Architect</h3>
                <div class="ck-service-line"></div>
                <p class="ck-service-text">Post your requirements and get your quote within 24 hours.</p>
                @if($isCustomerLoggedIn)
                    <a href="{{ route('post', ['work_type_id' => 2]) }}" class="ck-service-btn">Post Your Requirement</a>
                @else
                    <a href="javascript:void(0)" data-redirect="{{ route('post', ['work_type_id' => 2]) }}" class="ck-service-btn open-customer-login-modal">Post Your Requirement</a>
                @endif
            </div>

            <div class="ck-service-card">
                <div class="ck-service-image">
                    <img src="{{ asset('images/b2.png') }}" alt="Contractor">
                </div>
                <h3 class="ck-service-title">Contractor</h3>
                <div class="ck-service-line"></div>
                <p class="ck-service-text">Post your requirements and get your quote within 24 hours.</p>
                @if($isCustomerLoggedIn)
                    <a href="{{ route('post', ['work_type_id' => 1]) }}" class="ck-service-btn">Post Your Requirement</a>
                @else
                    <a href="javascript:void(0)" data-redirect="{{ route('post', ['work_type_id' => 1]) }}" class="ck-service-btn open-customer-login-modal">Post Your Requirement</a>
                @endif
            </div>

            <div class="ck-service-card">
                <div class="ck-service-image">
                    <img src="{{ asset('images/b3.png') }}" alt="Interior Designer">
                </div>
                <h3 class="ck-service-title">Interior Designer</h3>
                <div class="ck-service-line"></div>
                <p class="ck-service-text">Post your requirements and get your quote within 24 hours.</p>
                @if($isCustomerLoggedIn)
                    <a href="{{ route('post_for_interior', ['work_type_id' => 4]) }}" class="ck-service-btn">Post Your Requirement</a>
                @else
                    <a href="javascript:void(0)" data-redirect="{{ route('post_for_interior', ['work_type_id' => 4]) }}" class="ck-service-btn open-customer-login-modal">Post Your Requirement</a>
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
                        <img src="{{ asset('images/explore/survey-services.png') }}" alt="Survey Services">
                    </div>
                    <div class="explore-card-body">
                        <h3>Survey Services</h3>
                        <p>Explore All Categories of Survey Services</p>
                        @if($isCustomerLoggedIn)
                            <a href="{{ route('customer.survey') }}" class="explore-btn orange-btn">Get Started</a>
                        @else
                            <a href="javascript:void(0)" data-redirect="{{ route('customer.survey') }}" class="explore-btn orange-btn open-customer-login-modal">Get Started</a>
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
                        <img src="{{ asset('images/explore/structural-audit.png') }}" alt="Structural Audit">
                    </div>
                    <div class="explore-card-body">
                        <h3>Structural Audit</h3>
                        <p>Explore All Categories of structural Services</p>
                        @if($isCustomerLoggedIn)
                            <a href="{{ route('customer.structuralaudit') }}" class="explore-btn blue-btn">Get Started</a>
                        @else
                            <a href="javascript:void(0)" data-redirect="{{ route('customer.structuralaudit') }}" class="explore-btn blue-btn open-customer-login-modal">Get Started</a>
                        @endif
                    </div>
                </div>

                <div class="explore-card orange-card">
                    <div class="explore-card-image">
                        <img src="{{ asset('images/explore/boq-estimation.png') }}" alt="BOQ/Estimation">
                    </div>
                    <div class="explore-card-body">
                        <h3>BOQ / Estimation</h3>
                        <p>Explore All Categories of BOQ / Estimation Services</p>
                        @if($isCustomerLoggedIn)
                            <a href="{{ route('customer.boq') }}" class="explore-btn orange-btn">Get Started</a>
                        @else
                            <a href="javascript:void(0)" data-redirect="{{ route('customer.boq') }}" class="explore-btn orange-btn open-customer-login-modal">Get Started</a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ── GUIDE ── --}}
    <section class="ck-guide-section">
        <div class="ck-guide-container">
            <div class="ck-guide-image-box">
                <img src="{{ asset('images/logo/confused-customer.jpg') }}" alt="Confused Customer">
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
   
    <section class="upcoming-services-section">
        <div class="upcoming-services-heading">
            <h2>Our Upcoming Services</h2>
            <div class="upcoming-heading-line"></div>
        </div>

        <div class="upcoming-auto-scroll-wrap">
            <div class="upcoming-auto-scroll-track">

                @php
                    $services = [
                        ['legal-due-diligence.png','NA Support & Legal Due Diligence','orange-border'],
                        ['welding-fabrication.png','Welding & Fabrication','blue-border'],
                        ['testing-services.jpeg','Testing Services','blue-border'],
                        ['machinaryonhire.png','Machinery On Hire','orange-border'],
                        ['facade-services.png','Facade Services','blue-border'],
                        ['StructuralAudit.jpeg','Structural Audit','blue-border']

                    ];
                @endphp

                {{-- ORIGINAL --}}
                @foreach ($services as $upcoming)
                    <div class="upcoming-card {{ $upcoming[2] }}">
                        <span class="upcoming-badge">Coming Soon</span>
                        <div class="upcoming-card-image">
                            <img src="{{ asset('images/explore/' . $upcoming[0]) }}" alt="{{ $upcoming[1] }}">
                        </div>
                        <div class="upcoming-card-body">
                            <h3>{{ $upcoming[1] }}</h3>
                            <p>Launching soon on ConstructKaro</p>
                        </div>
                    </div>
                @endforeach

                {{-- DUPLICATE (IMPORTANT for seamless loop) --}}
                @foreach ($services as $upcoming)
                    <div class="upcoming-card {{ $upcoming[2] }}">
                        <span class="upcoming-badge">Coming Soon</span>
                        <div class="upcoming-card-image">
                            <img src="{{ asset('images/explore/' . $upcoming[0]) }}" alt="{{ $upcoming[1] }}">
                        </div>
                        <div class="upcoming-card-body">
                            <h3>{{ $upcoming[1] }}</h3>
                            <p>Launching soon on ConstructKaro</p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    {{-- ── VENDOR ── --}}
    <section class="ck-vendor-section">
        <div class="ck-vendor-container">
            <div class="ck-vendor-content-box">
                <h2 class="ck-vendor-title">Get real construction projects in your area</h2>
                <p class="ck-vendor-text">Join ConstructKaro and start receiving verified leads. No commission, no listing fees.</p>
                <a href="https://vendor.constructkaro.com/" class="ck-vendor-btn">Join as Vendor</a>
            </div>
            <div class="ck-vendor-image-box">
                <img src="{{ asset('images/logo/a1.jpg') }}" alt="Construction Projects">
            </div>
        </div>
    </section>

    {{-- ── CITIES ── --}}
    <section class="ck-city-section">
        <h2 class="ck-city-title">Cities We Serve</h2>
        <div class="ck-city-grid">
            <div class="ck-city-card"><img src="{{ asset('images/logo/navi-mumbai.png') }}" alt="Navi Mumbai"></div>
            <div class="ck-city-card"><img src="{{ asset('images/logo/mumbai.png') }}"      alt="Mumbai"></div>
            <div class="ck-city-card"><img src="{{ asset('images/logo/thane.png') }}"       alt="Thane"></div>
            <div class="ck-city-card"><img src="{{ asset('images/logo/pune.png') }}"        alt="Pune"></div>
            <div class="ck-city-card"><img src="{{ asset('images/logo/raigad.png') }}"      alt="Raigad"></div>
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
                    <img src="{{ asset('images/services/contractor.png') }}" alt="Contractor">
                    <!-- <span class="ck-slide-label">Contractor</span> -->
                </a>
            </div>
            <!-- <div class="ck-slide"><img src="{{ asset('images/services/architect.png') }}"  alt="contractor"></div> -->
            <div class="ck-slide">
                <a href="{{ route('architect.services') }}">
                    <img src="{{ asset('images/services/architect.png') }}" alt="Architect">
                    <!-- <span class="ck-slide-label">Architect</span> -->
                </a>
            </div>
              <div class="ck-slide">
                <a href="{{ route('interior.services') }}">
                    <img src="{{ asset('images/services/interior.png') }}" alt="Interior Designing">
                    <!-- <span class="ck-slide-label">Interior</span> -->
                </a>
            </div>
            <div class="ck-slide">
                <a href="{{ route('survey.services') }}">
                    <img src="{{ asset('images/services/survey.png') }}" alt="Survey">
                    <!-- <span class="ck-slide-label">Survey</span> -->
                </a>
            </div>
              <div class="ck-slide">
                <a href="{{ route('survey.structural') }}">
                    <img src="{{ asset('images/services/structural.png') }}" alt="Structural">
                    <!-- <span class="ck-slide-label">Structural</span> -->
                </a>
            </div>
              <div class="ck-slide">
                <a href="{{ route('boq.testing') }}">
                    <img src="{{ asset('images/services/boq.png') }}" alt="BOQ">
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
                    <img src="{{ asset('images/testimonials/client1.png') }}" alt="Client">
                </div>
                <h3 class="ck-testimonial-name">Patil Infra & Realtors Pvt. Ltd.</h3>
                <p class="ck-testimonial-role">Real Estate Developer | Khopoli</p>
                <div class="ck-stars">★★★★☆</div>
                <p class="ck-testimonial-text">For our ongoing building projects, finding dependable contractors on time is always a challenge. Through ConstructKaro, we were able to identify suitable labour contractors quickly, improving our execution efficiency.</p>
            </div>

            <div class="ck-testimonial-card">
                <div class="ck-testimonial-img">
                    <img src="{{ asset('images/testimonials/client2.png') }}" alt="Client">
                </div>
                <h3 class="ck-testimonial-name">Dinesh Shirke</h3>
                <p class="ck-testimonial-role">Home Owner | Nagothane, Maharashtra</p>
                <div class="ck-stars">★★★★☆</div>
                <p class="ck-testimonial-text">I was planning to construct a bungalow and didn't know how to start. I posted my requirement on ConstructKaro and received genuine responses. One lead converted into actual work and my bungalow construction has started.</p>
            </div>

            <div class="ck-testimonial-card">
                <div class="ck-testimonial-img">
                    <img src="{{ asset('images/testimonials/client3.png') }}" alt="Client">
                </div>
                <h3 class="ck-testimonial-name">Omkar Vidhate</h3>
                <p class="ck-testimonial-role">Architect | Pune</p>
                <div class="ck-stars">★★★☆☆</div>
                <p class="ck-testimonial-text">After leaving my job, getting independent projects was challenging. Through ConstructKaro, I received architectural planning and interior design work that matched my skills perfectly.</p>
            </div>

            <div class="ck-testimonial-card">
                <div class="ck-testimonial-img">
                    <img src="{{ asset('images/testimonials/client4.png') }}" alt="Client">
                </div>
                <h3 class="ck-testimonial-name">Sanket Asgaonkar</h3>
                <p class="ck-testimonial-role">Land Surveyor & Drone Survey Specialist | Raigad</p>
                <div class="ck-stars">★★★★☆</div>
                <p class="ck-testimonial-text">I had the skills and equipment, but finding the right drone survey clients was difficult. Through ConstructKaro, I received a drone survey requirement in Poladpur that perfectly matched my profile.</p>
            </div>

        </div>
    </section>

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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });

$(document).ready(function () {

    $(document).on('click', '.open-customer-login-modal', function () {
        let redirectUrl = $(this).data('redirect') || '';
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
        '.hero-banner, .ck-trust-section, .ck-services-section, .explore-services-section, .ck-guide-section, .upcoming-services-section, .ck-vendor-section, .ck-city-section, .ck-all-services-section, .ck-testimonial-section'
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
@endsection
