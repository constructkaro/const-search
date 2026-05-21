@extends('layouts.app')

@section('title', 'Showroom Planning Services')

@section('content')
<style>
    .sp-page,
    .sp-page * {
        box-sizing: border-box;
    }

    .sp-page {
        background: #f1f1f1;
        color: #222;
        font-family: "Poppins", "Segoe UI", sans-serif;
        overflow: hidden;
    }

    .sp-hero {
        position: relative;
        min-height: 378px;
        display: flex;
        align-items: center;
        background: #101010;
        overflow: hidden;
    }

    .sp-hero img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .sp-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, rgba(0,0,0,.86) 0%, rgba(0,0,0,.55) 42%, rgba(0,0,0,.08) 100%);
    }

    .sp-hero-content {
        position: relative;
        z-index: 2;
        width: min(1180px, calc(100% - 36px));
        margin: 0 auto;
    }

    .sp-hero h1 {
        max-width: 620px;
        margin: 0;
        color: #fff;
        font-size: clamp(30px, 4.4vw, 54px);
        line-height: 1.18;
        font-weight: 900;
        text-shadow: 0 5px 18px rgba(0,0,0,.45);
    }

    .sp-section {
        padding: 54px 0;
        background: #f1f1f1;
    }

    .sp-section.white {
        background: #fff;
    }

    .sp-container {
        width: min(1180px, calc(100% - 36px));
        margin: 0 auto;
    }

    .sp-title {
        margin: 0;
        color: #171923;
        font-size: clamp(24px, 3vw, 34px);
        line-height: 1.25;
        font-weight: 900;
        text-align: center;
    }

    .sp-line {
        width: 190px;
        height: 3px;
        margin: 13px auto 28px;
        border-radius: 999px;
        background: linear-gradient(90deg, #f27524 0%, #f27524 48%, #1f73b8 48%, #1f73b8 100%);
    }

    .sp-intro {
        max-width: 1060px;
        margin: 0 auto;
        color: #4d5562;
        font-size: 15.5px;
        line-height: 1.75;
    }

    .sp-intro p {
        margin: 0 0 14px;
    }

    .sp-intro strong {
        color: #222;
        font-weight: 800;
    }

    .sp-service-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 28px 26px;
        margin-top: 36px;
    }

    .sp-service-card {
        position: relative;
        min-height: 245px;
        overflow: hidden;
        padding: 0 20px 20px;
        border: 2px solid #f27524;
        border-radius: 8px;
        background: #fff0e4;
        box-shadow: 0 8px 16px rgba(28,44,62,.15);
        text-align: center;
    }

    .sp-service-card.blue {
        border-color: #1f73b8;
        background: #eaf4ff;
    }

    .sp-num {
        position: absolute;
        top: -20px;
        left: 50%;
        width: 42px;
        height: 42px;
        transform: translateX(-50%);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f27524;
        color: #fff;
        font-size: 22px;
        font-weight: 900;
    }

    .sp-service-card.blue .sp-num {
        background: #1f73b8;
    }

    .sp-service-image {
        width: calc(100% + 40px);
        height: 150px;
        margin: 0 -20px 18px;
        display: block;
        object-fit: cover;
        /* background: #fff; */
    }

    .sp-icon {
        height: 58px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #20242c;
        font-size: 42px;
        font-weight: 900;
    }

    .sp-card-title {
        min-height: 42px;
        margin: 0 0 10px;
        color: #f27524;
        font-size: 17px;
        line-height: 1.22;
        font-weight: 900;
    }

    .sp-service-card.blue .sp-card-title {
        color: #1f73b8;
    }

    .sp-card-text {
        margin: 0;
        color: #343b46;
        font-size: 13.5px;
        line-height: 1.5;
        font-weight: 600;
    }

    .sp-plan-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 35px;
            max-width: 1096px;
            margin: 34px auto 0;
        }

    .sp-plan-card {
        overflow: hidden;
        border: 2px solid #1f73b8;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 8px 16px rgba(28,44,62,.16);
    }

    .sp-plan-card.orange {
        border-color: #f27524;
    }

    .sp-plan-card img {
        width: 100%;
        aspect-ratio: 1.35 / 1;
        object-fit: cover;
        display: block;
    }

    .sp-plan-label {
        min-height: 48px;
        padding: 12px 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #20242c;
        font-size: 14px;
        font-weight: 900;
        text-align: center;
        line-height: 1.25;
    }

    .sp-check-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px 42px;
        max-width: 1000px;
        margin: 26px auto 0;
    }

    .sp-check {
        color: #252b35;
        font-size: 15px;
        line-height: 1.45;
        font-weight: 700;
    }

    .sp-check::before {
        content: "\2713";
        margin-right: 8px;
        color: #111;
        font-weight: 900;
    }

    .sp-footer-info {
        max-width: 1120px;
        margin: 42px auto 0;
        text-align: left;
    }

    .sp-footer-info h3 {
        margin: 24px 0 8px;
        color: #171923;
        font-size: 18px;
        line-height: 1.3;
        font-weight: 900;
    }

    .sp-footer-info p {
        margin: 0;
        color: #4d5562;
        font-size: 13.5px;
        line-height: 1.55;
        font-weight: 600;
    }

    @media (max-width: 991px) {
        .sp-service-grid,
        .sp-plan-grid,
        .sp-check-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .sp-plan-grid {
            max-width: 680px;
            gap: 28px;
        }
    }

    @media (max-width: 640px) {
        .sp-hero {
            min-height: 280px;
        }

        .sp-section {
            padding: 42px 0;
        }

        .sp-service-grid,
        .sp-plan-grid,
        .sp-check-grid {
            grid-template-columns: 1fr;
        }

        .sp-service-grid {
            gap: 34px;
        }

        .sp-plan-grid {
            max-width: 340px;
        }
    }
</style>

<div class="sp-page">
    <section class="sp-hero">
        <img
            src=""
            onerror="this.onerror=null;this.src='{{ asset('images/logo/sp.png') }}'"
            alt="Showroom planning services"
        >
        <div class="sp-hero-content">
            <h1>
                Showroom Planning Services in<br>
                Navi Mumbai, Mumbai, Thane,<br>
                Pune &amp; Raigad
            </h1>
        </div>
    </section>

    <section class="sp-section white">
        <div class="sp-container">
            <h2 class="sp-title">Office Interior Designer Services In Navi Mumbai,<br> Mumbai, Raigad, Thane &amp; Pune</h2>
            <div class="sp-line"></div>

            <div class="sp-intro">
                <p>
                    At <strong>ConstructKaro</strong>, we provide expert <strong>showroom planning services</strong> designed to maximize customer engagement, product visibility, and business conversions. Whether you are launching a <strong>bike showroom, car showroom, or retail display space</strong>, our team ensures your showroom is functional, attractive, and aligned with your brand identity.
                </p>
                <p>
                    We specialize in creating high-impact showroom design plans that turn visitors into buyers.
                </p>
            </div>
        </div>
    </section>

    <section class="sp-section">
        <div class="sp-container">
            <h2 class="sp-title">Our Showroom Planning Services</h2>
            <div class="sp-line"></div>

            @php
                $showroomServices = [
                    ['num' => '1', 'color' => 'orange', 'image' => asset('images/logo/sp1.png'), 'title' => 'Showroom Design Plan', 'text' => 'Complete showroom design planning including layout, zoning, and display positioning.'],
                    ['num' => '2', 'color' => 'blue', 'image' => asset('images/logo/sp2.png'), 'title' => 'Product Display Optimization', 'text' => 'Strategic placement of products to maximize visibility and customer interaction.'],
                    ['num' => '3', 'color' => 'orange', 'image' => asset('images/logo/sp3.png'), 'title' => 'Customer Flow & Experience Design', 'text' => 'Layouts designed to guide customers smoothly through the showroom.'],
                    ['num' => '4', 'color' => 'blue', 'image' => asset('images/logo/sp4.png'), 'title' => 'Branding & Visual Merchandising', 'text' => 'Interior elements aligned with your brand identity and product positioning.'],
                    ['num' => '5', 'color' => 'orange', 'image' => asset('images/logo/sp5.png'), 'title' => 'Lighting & Ambience Planning', 'text' => 'Complete showroom design planning including layout, zoning, display positioning, highlight key products with the right lighting and atmosphere.'],
                    ['num' => '6', 'color' => 'blue', 'image' => asset('images/logo/sp6.png'), 'title' => 'Product Display 3D Showroom Design', 'text' => 'Visualize your showroom with realistic 3D design previews before execution.'],
                ];
            @endphp

            <div class="sp-service-grid">
                @foreach($showroomServices as $item)
                    <!-- <div class="sp-service-card {{ $item['color'] === 'blue' ? 'blue' : '' }}"> -->
                        <!-- <div class="sp-num">{{ $item['num'] }}</div> -->
                        <img class="sp-service-image" src="{{ $item['image'] }}" alt="{{ $item['title'] }}">
                        <!-- <h3 class="sp-card-title">{{ $item['title'] }}</h3> -->
                        <!-- <p class="sp-card-text">{{ $item['text'] }}</p> -->
                    <!-- </div> -->
                @endforeach
            </div>
        </div>
    </section>

    <section class="sp-section white">
        <div class="sp-container">
            <h2 class="sp-title">Types of Showroom Design Plans</h2>
            <div class="sp-line"></div>

            @php
                $planCards = [
                    ['color' => 'blue', 'image' => asset('images/logo/sp7.png'), 'title' => 'Bike Showroom Design Plan', 'alt' => 'Bike showroom design plan'],
                    ['color' => 'orange', 'image' => asset('images/logo/sp9.png'), 'title' => 'Car Showroom Design Plan', 'alt' => 'Car showroom design plan'],
                    ['color' => 'blue', 'image' => asset('images/logo/sp8.png'), 'title' => 'Retail Showroom Design Plan', 'alt' => 'Retail showroom design plan'],
                ];
            @endphp

            <div class="sp-plan-grid">
                @foreach($planCards as $plan)
                    <!-- <div class="sp-plan-card {{ $plan['color'] === 'orange' ? 'orange' : '' }}"> -->
                        <img
                            src="{{ $plan['image'] }}"
                            alt="{{ $plan['alt'] }}"
                        >
                        <!-- <div class="sp-plan-label">{{ $plan['title'] }}</div> -->
                    <!-- </div> -->
                @endforeach
            </div>
        </div>
    </section>

    <section class="sp-section">
        <div class="sp-container">
            <h2 class="sp-title">Key Elements of a Successful Showroom Plan</h2>
            <div class="sp-line"></div>
            <div class="sp-check-grid">
                <div class="sp-check">Entrance &amp; Attraction Zone</div>
                <div class="sp-check">Product Display Areas</div>
                <div class="sp-check">Customer Interaction Space</div>
                <div class="sp-check">Billing &amp; Reception Counter</div>
                <div class="sp-check">Storage &amp; Utility Area</div>
                <div class="sp-check">Lighting &amp; Branding Elements</div>
            </div>
        </div>
    </section>

    <section class="sp-section white">
        <div class="sp-container">
            <h2 class="sp-title">Why Choose ConstructKaro?</h2>
            <div class="sp-line"></div>
            <div class="sp-check-grid">
                <div class="sp-check">Verified Designers &amp; Experts</div>
                <div class="sp-check">Business-Focused Planning Approach</div>
                <div class="sp-check">Customized Showroom Solutions</div>
                <div class="sp-check">Fast Turnaround Time</div>
                <div class="sp-check">End-to-End Support</div>
                <div class="sp-check">Execution with Trusted Vendors</div>
            </div>

            <div class="sp-footer-info">
                <h3>Service Locations:</h3>
                <p>Showroom Planning Services in Navi Mumbai | Showroom Planning Services in Raigad | Showroom Planning Services in Thane | Showroom Planning Services in Mumbai | Showroom Planning Services in Pune</p>
            </div>
        </div>
    </section>
</div>
@endsection
