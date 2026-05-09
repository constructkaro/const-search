@extends('layouts.app')

@section('meta_title', 'Residential Architecture Services in Navi Mumbai, Mumbai, Thane, Pune & Raigad | ConstructKaro')
@section('meta_description', 'ConstructKaro provides residential architecture services for houses, villas, bungalows, apartments, farmhouses and redevelopment projects across Navi Mumbai, Mumbai, Thane, Pune and Raigad.')
@section('title', 'Residential Architecture Services')

@section('content')

<style>
    .ra-page,
    .ra-page * {
        box-sizing: border-box;
    }

    .ra-page {
        background: #f0f0f0;
        color: #111;
        font-family: 'Segoe UI', Arial, sans-serif;
        overflow-x: hidden;
    }

    .ra-page img {
        max-width: 100%;
    }

    /* HERO IMAGE ONLY */
    .ra-hero-wrap {
        width: 100%;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background: transparent;
    }

    .ra-hero-img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
    }

    .ra-section {
        background: #f0f0f0;
        padding: 52px 80px;
    }

    .ra-inner {
        max-width: 1320px;
        margin: 0 auto;
    }

    .ra-title {
        font-size: 30px;
        font-weight: 900;
        color: #111;
        margin: 0 0 10px;
        line-height: 1.2;
        font-family: 'Segoe UI', Arial, sans-serif;
    }

    .ra-title.center {
        text-align: center;
    }

    .ra-intro-title {
        font-size: 26px;
        font-weight: 900;
        color: #111;
        text-align: center;
        margin: 0 0 10px;
        font-family: 'Segoe UI', Arial, sans-serif;
    }

    .ra-underline {
        display: flex;
        margin-bottom: 28px;
    }

    .ra-underline.center {
        justify-content: center;
    }

    .ra-underline span {
        height: 3px;
        display: block;
        border-radius: 2px;
    }

    .ul-orange {
        background: #e87c2f;
        width: 80px;
    }

    .ul-blue {
        background: #1a3a6b;
        width: 80px;
    }

    .ra-intro-text,
    .ra-what-text {
        font-size: 15px;
        color: #333;
        line-height: 1.78;
        margin: 0 0 14px;
    }

    /* OFFER CARDS */
    .ra-offer-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 70px 35px;
        margin-top: 55px;
        align-items: stretch;
    }

    .ra-offer-card {
        border-radius: 18px;
        padding: 48px 26px 28px;
        position: relative;
        border: 2px solid transparent;
        min-height: 255px;
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.22);
    }

    .ra-offer-card:nth-child(1),
    .ra-offer-card:nth-child(2),
    .ra-offer-card:nth-child(3) {
        grid-column: span 2;
    }

    .ra-offer-card:nth-child(4) {
        grid-column: 2 / span 2;
    }

    .ra-offer-card:nth-child(5) {
        grid-column: 4 / span 2;
    }

    .ra-offer-card.orange {
        background: #fff0e4;
        border-color: #e87c2f;
    }

    .ra-offer-card.blue {
        background: #eaf2ff;
        border-color: #1f70b8;
    }

    .ra-offer-num {
        position: absolute;
        top: -34px;
        left: 50%;
        transform: translateX(-50%);
        width: 58px;
        height: 58px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        font-weight: 900;
        color: #fff;
    }

    .ra-offer-card.orange .ra-offer-num {
        background: #e87c2f;
    }

    .ra-offer-card.blue .ra-offer-num {
        background: #1f70b8;
    }

    .ra-offer-title {
        font-size: 27px;
        font-weight: 900;
        color: #111;
        margin-bottom: 18px;
        text-align: center;
        line-height: 1.3;
    }

    .ra-offer-desc {
        font-size: 17px;
        color: #444;
        text-align: center;
        line-height: 1.55;
        margin: 0 0 14px;
        font-weight: 600;
    }

    .ra-offer-sub {
        font-size: 18px;
        font-weight: 800;
        color: #444;
        text-align: center;
        margin: 16px 0 8px;
    }

    .ra-offer-list-wrap {
        text-align: center;
    }

    .ra-offer-list {
        display: inline-block;
        text-align: left;
        padding-left: 22px;
        margin: 0 auto;
    }

    .ra-offer-list li {
        font-size: 17px;
        color: #444;
        padding: 2px 0;
        line-height: 1.45;
        font-weight: 600;
    }

    /* PROJECT CARDS */
    .ra-proj-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 22px;
    }

    .ra-proj-card {
        border-radius: 16px;
        overflow: hidden;
        border: 2px solid transparent;
        background: #fff;
        box-shadow: 0 2px 14px rgba(0, 0, 0, 0.07);
        transition: transform 0.22s ease, box-shadow 0.22s ease;
    }

    .ra-proj-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.13);
    }

    .ra-proj-card.blue {
        border-color: #4a90c4;
    }

    .ra-proj-card.orange {
        border-color: #e87c2f;
    }

    .ra-proj-card img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        display: block;
        background: #f8f8f8;
    }

    .ra-proj-label {
        padding: 16px 14px;
        font-size: 17px;
        font-weight: 800;
        color: #111;
        text-align: center;
        line-height: 1.3;
        background: #fff;
    }

    .ra-proj-card.orange .ra-proj-label {
        background: #fff5ee;
    }

    /* WHY SECTION */
    .ra-why-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 20px;
        text-align: center;
        margin-top: 8px;
    }

    .ra-why-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 14px;
    }

    .ra-why-icon {
        width: 72px;
        height: 72px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 34px;
        color: #1a3a6b;
    }

    .ra-why-label {
        font-size: 15px;
        font-weight: 800;
        color: #111;
        line-height: 1.35;
    }

    /* FAQ */
    .ra-faq-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
        margin-top: 8px;
    }

    .ra-faq-item {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
        overflow: hidden;
        border: 1px solid #e8eaf0;
    }

    .ra-faq-q {
        width: 100%;
        background: none;
        border: none;
        padding: 20px 24px;
        font-size: 16px;
        font-weight: 700;
        color: #111;
        text-align: left;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        transition: background 0.18s;
    }

    .ra-faq-q:hover {
        background: #f8f9fc;
    }

    .ra-faq-icon {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 14px;
        color: #555;
        transition: transform 0.25s ease, background 0.2s;
    }

    .ra-faq-item.open .ra-faq-icon {
        transform: rotate(45deg);
        background: #e87c2f;
        color: #fff;
    }

    .ra-faq-a {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.32s ease, padding 0.22s ease;
        padding: 0 24px;
        font-size: 15px;
        color: #444;
        line-height: 1.72;
    }

    .ra-faq-item.open .ra-faq-a {
        max-height: 300px;
        padding: 0 24px 20px;
    }

    @media (max-width: 1100px) {
        .ra-offer-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 60px 25px;
        }

        .ra-offer-card:nth-child(1),
        .ra-offer-card:nth-child(2),
        .ra-offer-card:nth-child(3),
        .ra-offer-card:nth-child(4),
        .ra-offer-card:nth-child(5) {
            grid-column: auto;
        }

        .ra-why-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 860px) {
        .ra-section {
            padding: 32px 20px;
        }

        .ra-offer-grid {
            grid-template-columns: 1fr;
            gap: 55px;
        }

        .ra-proj-grid {
            grid-template-columns: 1fr 1fr;
        }

        .ra-why-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 560px) {
        .ra-section {
            padding: 24px 14px;
        }

        .ra-proj-grid {
            grid-template-columns: 1fr;
        }

        .ra-why-grid {
            grid-template-columns: 1fr 1fr;
        }

        .ra-title {
            font-size: 22px;
        }

        .ra-intro-title {
            font-size: 21px;
        }

        .ra-offer-title {
            font-size: 22px;
        }

        .ra-offer-desc,
        .ra-offer-list li {
            font-size: 15px;
        }
    }

    .ra-page .ra-hero-banner {
    position: relative;
    width: 100%;
    height: 430px;
    overflow: hidden;
    background: #000;
}

.ra-page .ra-hero-banner-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
}

.ra-page .ra-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        90deg,
        rgba(0, 0, 0, 0.78) 0%,
        rgba(0, 0, 0, 0.58) 38%,
        rgba(0, 0, 0, 0.20) 70%,
        rgba(0, 0, 0, 0.05) 100%
    );
    z-index: 1;
}

.ra-page .ra-hero-content {
    position: absolute;
    top: 50%;
    left: 7%;
    transform: translateY(-50%);
    z-index: 2;
    max-width: 780px;
}

.ra-page .ra-hero-content h1 {
    color: #ffffff;
    font-size: 56px;
    line-height: 1.18;
    font-weight: 900;
    letter-spacing: 1px;
    margin: 0;
    text-shadow: 0 5px 20px rgba(0, 0, 0, 0.45);
}

@media (max-width: 992px) {
    .ra-page .ra-hero-banner {
        height: 360px;
    }

    .ra-page .ra-hero-content h1 {
        font-size: 42px;
    }
}

@media (max-width: 576px) {
    .ra-page .ra-hero-banner {
        height: 300px;
    }

    .ra-page .ra-hero-content {
        left: 6%;
        right: 6%;
    }

    .ra-page .ra-hero-content h1 {
        font-size: 30px;
        line-height: 1.25;
    }
}

</style>
  <style>
    .ra-proj-grid {
        max-width: 1400px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 70px;
        padding: 30px 20px;
    }

    .ra-proj-card {
        background: #ffffff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 8px 18px rgba(0,0,0,0.18);
        border: 5px solid #1e73be;
    }

    .ra-proj-card.orange {
        border-color: #f25c05;
    }

    .ra-proj-card.blue {
        border-color: #1e73be;
    }

    .ra-proj-card img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        display: block;
    }

    .ra-proj-label {
        min-height: 95px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 18px 15px;
        font-size: 30px;
        line-height: 1.25;
        font-weight: 900;
        color: #55585c;
        background: #eef6ff;
    }

    .ra-proj-card.orange .ra-proj-label {
        background: #fff1e8;
    }

    @media (max-width: 991px) {
        .ra-proj-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        .ra-proj-card img {
            height: 220px;
        }

        .ra-proj-label {
            font-size: 24px;
        }
    }

    @media (max-width: 575px) {
        .ra-proj-grid {
            grid-template-columns: 1fr;
            gap: 24px;
            padding: 20px 15px;
        }

        .ra-proj-card img {
            height: 230px;
        }

        .ra-proj-label {
            font-size: 22px;
            min-height: 80px;
        }
    }
</style>

    {{-- WHY RESIDENTIAL ARCHITECTURE IS IMPORTANT --}}
   <style>
    .ra-why-section {
        padding: 70px 20px;
        background: #f3f4f6;
    }

    .ra-why-inner {
        max-width: 1400px;
        margin: 0 auto;
    }

    .ra-why-top-line {
        width: 420px;
        height: 4px;
        margin: 0 auto 55px;
        border-radius: 50px;
        background: linear-gradient(
            90deg,
            #f25c05 0%,
            #f25c05 35%,
            #1e73be 35%,
            #1e73be 100%
        );
    }

    .ra-why-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 35px;
        align-items: start;
        text-align: center;
    }

    .ra-why-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
    }

 .ra-why-icon-box {
    width: 148px;
    height: 150px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 22px;
}

    .ra-why-icon-box img {
        width: 142px;
        height: 125px;
        object-fit: contain;
        display: block;
    }

    .ra-why-label {
        font-size: 28px;
        line-height: 1.25;
        font-weight: 900;
        color: #202124;
        letter-spacing: 1px;
    }

    @media (max-width: 1100px) {
        .ra-why-grid {
            grid-template-columns: repeat(3, 1fr);
            row-gap: 45px;
        }

        .ra-why-label {
            font-size: 23px;
        }
    }

    @media (max-width: 768px) {
        .ra-why-top-line {
            width: 260px;
            margin-bottom: 40px;
        }

        .ra-why-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 35px 25px;
        }

        .ra-why-icon-box {
            width: 75px;
            height: 75px;
            margin-bottom: 16px;
        }

        .ra-why-icon-box img {
            width: 70px;
            height: 70px;
        }

        .ra-why-label {
            font-size: 19px;
            letter-spacing: 0.5px;
        }
    }

    @media (max-width: 480px) {
        .ra-why-section {
            padding: 50px 15px;
        }

        .ra-why-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="ra-page">

    {{-- HERO IMAGE ONLY --}}
   {{-- HERO BANNER --}}
<section class="ra-hero-banner">
    <img
        src="{{ asset('images/architecture/hero-architect.jpg') }}"
        onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1600&q=90'"
        alt="Architect Services"
        class="ra-hero-banner-img"
    >

    <div class="ra-hero-overlay"></div>

    <div class="ra-hero-content">
        <h1>
            Architect Services in<br>
            Navi Mumbai, Mumbai,<br>
            Thane, Pune &amp; Raigad
        </h1>
    </div>
</section>
    {{-- BUILD YOUR PROJECT --}}
    <div class="ra-section" style="padding-bottom: 0;">
        <div class="ra-inner">
            <h2 class="ra-intro-title">Build Your Project with the Right Architectural Guidance</h2>

            <div class="ra-underline center">
                <span class="ul-orange"></span>
                <span class="ul-blue"></span>
            </div>

            <p class="ra-intro-text">
                Designing a home is more than just creating walls and rooms—it is about building a lifestyle.
                At <strong>ConstructKaro,</strong> we provide <strong>Residential Architecture Services</strong>
                that help you plan, design, and execute your dream home with clarity and confidence.
            </p>

            <p class="ra-intro-text">
                Whether you are building a bungalow, villa, apartment, or redevelopment project, we connect you
                with the <strong>right residential architects</strong> near you and ensure smooth project execution
                from concept to completion.
            </p>
        </div>
    </div>

    {{-- WHAT IS RESIDENTIAL ARCHITECTURE --}}
    <div class="ra-section">
        <div class="ra-inner">
            <h2 class="ra-title center">What is Residential Architecture?</h2>

            <div class="ra-underline center">
                <span class="ul-orange"></span>
                <span class="ul-blue"></span>
            </div>

            <p class="ra-what-text">
                <strong>Residential architecture</strong> focuses on designing homes that are functional, aesthetic,
                and aligned with your lifestyle. From space planning to elevation design, it ensures your home is
                practical, beautiful, and future-ready.
            </p>
        </div>
    </div>

    {{-- WHAT WE OFFER --}}
    <div class="ra-section" style="padding-top: 0;">
        <div class="ra-inner">
            <h2 class="ra-title center">What We Offer</h2>

            <div class="ra-underline center">
                <span class="ul-orange"></span>
                <span class="ul-blue"></span>
            </div>

            @php
                $offerCards = [
                    [
                        'number' => 1,
                        'color' => 'orange',
                        'title' => 'Custom Home Design',
                        'description' => 'We help you create fully customized home designs based on your plot size, budget, and preferences.',
                        'subtitle' => 'Perfect for:',
                        'points' => ['Villas & Bungalows', 'Row Houses', 'Farmhouses'],
                    ],
                    [
                        'number' => 2,
                        'color' => 'blue',
                        'title' => 'Architectural Planning & Layouts',
                        'description' => 'Our architects design efficient layouts with proper space utilization, ventilation, and natural lighting.',
                        'subtitle' => 'Includes:',
                        'points' => ['Floor Plans', '3D Elevations', 'Section & Structural Coordination'],
                    ],
                    [
                        'number' => 3,
                        'color' => 'orange',
                        'title' => 'Modern & Luxury Home Design',
                        'description' => 'Looking for premium design? We provide modern and luxury architectural solutions with high-end aesthetics and smart planning.',
                        'subtitle' => '',
                        'points' => [],
                    ],
                    [
                        'number' => 4,
                        'color' => 'blue',
                        'title' => 'Redevelopment & Renovation Design',
                        'description' => 'We assist in redesigning old homes or redevelopment projects with improved layouts and modern design concepts.',
                        'subtitle' => '',
                        'points' => [],
                    ],
                    [
                        'number' => 5,
                        'color' => 'orange',
                        'title' => 'Approval Drawings & Documentation',
                        'description' => 'We support you with required drawings for approvals and permissions as per local authorities.',
                        'subtitle' => '',
                        'points' => [],
                    ],
                ];
            @endphp

            <div class="ra-offer-grid">
                @foreach($offerCards as $card)
                    <div class="ra-offer-card {{ $card['color'] }}">
                        <div class="ra-offer-num">{{ $card['number'] }}</div>

                        <div class="ra-offer-title">
                            {{ $card['title'] }}
                        </div>

                        <p class="ra-offer-desc">
                            {{ $card['description'] }}
                        </p>

                        @if(!empty($card['subtitle']))
                            <p class="ra-offer-sub">{{ $card['subtitle'] }}</p>
                        @endif

                        @if(!empty($card['points']))
                            <div class="ra-offer-list-wrap">
                                <ul class="ra-offer-list">
                                    @foreach($card['points'] as $point)
                                        <li>{{ $point }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
 <h2 class="ra-title center">Types of Residential Projects We Handle</h2>



@php
    $projectCards = [
        [
            'color' => 'blue',
            'image' => 'images/logo/ra1.png',
            'fallback' => 'https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=600&q=80',
            'title' => 'Independent Houses',
            'alt' => 'Independent Houses',
        ],
        [
            'color' => 'orange',
            'image' => 'images/logo/ra2.png',
            'fallback' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=600&q=80',
            'title' => 'Villas & Luxury Homes',
            'alt' => 'Villas and Luxury Homes',
        ],
        [
            'color' => 'blue',
            'image' => 'images/logo/ra3.png',
            'fallback' => 'https://images.unsplash.com/photo-1605276374104-dee2a0ed3cd6?w=600&q=80',
            'title' => 'Row Houses',
            'alt' => 'Row Houses',
        ],
        [
            'color' => 'orange',
            'image' => 'images/logo/ra4.png',
            'fallback' => 'https://images.unsplash.com/photo-1475089488792-0a0ac0a5d51d?w=600&q=80',
            'title' => 'Farmhouses',
            'alt' => 'Farmhouses',
        ],
        [
            'color' => 'blue',
            'image' => 'images/logo/ra5.png',
            'fallback' => 'https://images.unsplash.com/photo-1580587771525-78b9dba3b914?w=600&q=80',
            'title' => 'Bungalows',
            'alt' => 'Bungalows',
        ],
        [
            'color' => 'orange',
            'image' => 'images/logo/ra6.png',
            'fallback' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=600&q=80',
            'title' => 'Apartment Layouts',
            'alt' => 'Apartment Layouts',
        ],
    ];
@endphp

<div class="ra-proj-grid">
    @foreach($projectCards as $project)
            <img
                src="{{ asset($project['image']) }}"
                onerror="this.onerror=null;this.src='{{ $project['fallback'] }}'"
                alt="{{ $project['alt'] }}"
            >

          
       
    @endforeach
</div>


<div class="ra-why-section">
    <div class="ra-why-inner">
  <h2 class="ra-intro-title">
 WHY RESIDENTIAL ARCHITECTURE IS IMPORTANT </h2>

        <div class="ra-why-top-line"></div>

        @php
            $whyItems = [
                [
                    'icon' => 'images/logo/ra7.png',
                    'label' => 'Ensures proper<br>space planning',
                    'alt' => 'Space Planning',
                ],
                [
                    'icon' => 'images/logo/ra8.png',
                    'label' => 'Improves natural<br>light & ventilation',
                    'alt' => 'Light and Ventilation',
                ],
                [
                    'icon' => 'images/logo/ra9.png',
                    'label' => 'Enhances<br>property value',
                    'alt' => 'Property Value',
                ],
                [
                    'icon' => 'images/logo/ra10.png',
                    'label' => 'Helps in cost<br>optimization',
                    'alt' => 'Cost Optimization',
                ],
                [
                    'icon' => 'images/logo/ra11.png',
                    'label' => 'Avoids future<br>design issues',
                    'alt' => 'Design Issues',
                ],
            ];
        @endphp

        <div class="ra-why-grid">
            @foreach($whyItems as $item)
                <div class="ra-why-item">
                    <div class="ra-why-icon-box">
                        <img src="{{ asset($item['icon']) }}" alt="{{ $item['alt'] }}">
                    </div>

                    
                </div>
            @endforeach
        </div>

    </div>
</div>

    {{-- FAQ ACCORDION --}}
    <div class="ra-section" style="padding-top: 0;">
        <div class="ra-inner">
            <h2 class="ra-title center">Frequently Asked Questions (FAQs)</h2>

            <div class="ra-underline center">
                <span class="ul-orange"></span>
                <span class="ul-blue"></span>
            </div>

            @php
                $faqs = [
                    [
                        'question' => 'How do I find the best residential architects near me?',
                        'answer' => 'ConstructKaro connects you with verified and experienced residential architects in Navi Mumbai, Mumbai, Thane, Pune, and Raigad. Simply reach out to us and we will match you with the right architect based on your project type, location, and budget.',
                    ],
                    [
                        'question' => 'What is the cost of residential architecture services?',
                        'answer' => 'The cost of residential architecture services depends on the project size, design complexity, and location. Architects may charge a fixed fee or percentage-based fee depending on the scope.',
                    ],
                    [
                        'question' => 'Do you provide 3D designs?',
                        'answer' => 'Yes, our architects provide 3D elevations and visualizations so you can understand how your home may look before construction begins.',
                    ],
                    [
                        'question' => 'How long does the architectural design process take?',
                        'answer' => 'The design process depends on project size, number of revisions, drawing requirements, and approval scope. Basic planning may take a few days, while complete design work may take longer.',
                    ],
                    [
                        'question' => 'Can you help with government approvals and permissions?',
                        'answer' => 'Yes, we can assist with approval drawings and required documentation support as per local authority requirements.',
                    ],
                ];
            @endphp

            <div class="ra-faq-list">
                @foreach($faqs as $index => $faq)
                    <div class="ra-faq-item">
                        <button type="button" class="ra-faq-q" onclick="raToggleFaq(this)">
                            <span>{{ $index + 1 }}. {{ $faq['question'] }}</span>
                            <div class="ra-faq-icon">+</div>
                        </button>

                        <div class="ra-faq-a">
                            {{ $faq['answer'] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

<script>
    function raToggleFaq(btn) {
        const item = btn.closest('.ra-faq-item');
        const isOpen = item.classList.contains('open');

        document.querySelectorAll('.ra-faq-item.open').forEach(function (el) {
            el.classList.remove('open');
        });

        if (!isOpen) {
            item.classList.add('open');
        }
    }
</script>

@endsection