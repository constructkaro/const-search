@extends('layouts.app')

@section('title', $service['title'] ?? 'Elevation and Facade Design Services')

@section('content')
<style>
    .ef-page,
    .ef-page * {
        box-sizing: border-box;
    }

    .ef-page {
        background: #eeeeee;
        color: #20242c;
        font-family: "Poppins", "Segoe UI", sans-serif;
        overflow: hidden;
    }

    .ef-hero {
        position: relative;
        min-height: 360px;
        display: flex;
        align-items: center;
        background: #111;
        overflow: hidden;
    }

    .ef-hero img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .ef-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, rgba(0,0,0,.88), rgba(0,0,0,.58) 44%, rgba(0,0,0,.06));
    }

    .ef-hero-content {
        position: relative;
        z-index: 2;
        width: min(1180px, calc(100% - 36px));
        margin: 0 auto;
    }

    .ef-hero h1 {
        max-width: 680px;
        margin: 0;
        color: #fff;
        font-size: clamp(28px, 4vw, 50px);
        line-height: 1.18;
        font-weight: 900;
        text-shadow: 0 5px 18px rgba(0,0,0,.45);
    }

    .ef-section {
        padding: 48px 0;
        background: #eeeeee;
    }

    .ef-section.white {
        background: #fff;
    }

    .ef-container {
        width: min(1180px, calc(100% - 36px));
        margin: 0 auto;
    }

    .ef-title {
        margin: 0;
        color: #171923;
        font-size: clamp(23px, 3vw, 33px);
        line-height: 1.25;
        font-weight: 900;
        text-align: center;
    }

    .ef-line {
        width: min(560px, 72%);
        height: 4px;
        margin: 13px auto 30px;
        border-radius: 999px;
        background: linear-gradient(90deg, #f27524 0%, #f27524 40%, #1f73b8 100%);
    }

    .ef-copy {
        max-width: 1080px;
        margin: 0 auto;
        color: #4d5562;
        font-size: 15px;
        line-height: 1.75;
        font-weight: 500;
    }

    .ef-copy p {
        margin: 0 0 14px;
    }

    .ef-copy strong {
        color: #20242c;
        font-weight: 900;
    }

    .ef-value-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 22px;
        max-width: 1040px;
        margin: 30px auto 0;
    }

    .ef-value {
        min-height: 58px;
        padding: 12px 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #1f73b8;
        border-radius: 6px;
        background: #fff;
        color: #20242c;
        font-size: 13px;
        line-height: 1.25;
        font-weight: 900;
        text-align: center;
        box-shadow: 0 6px 12px rgba(28,44,62,.08);
    }

    .ef-value.orange {
        border-color: #f27524;
    }

    .ef-service-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 24px;
        max-width: 1123px;
        margin: 36px auto 0;
    }

    .ef-service-card {
        position: relative;
        min-height: 170px;
        padding: 28px 16px 18px;
        border: 2px solid #f27524;
        border-radius: 8px;
        background: #fff0e4;
        box-shadow: 0 8px 16px rgba(28,44,62,.13);
        text-align: center;
    }

    .ef-service-card.blue {
        border-color: #1f73b8;
        background: #eaf4ff;
    }

    .ef-num {
        position: absolute;
        top: -16px;
        left: 50%;
        width: 32px;
        height: 32px;
        transform: translateX(-50%);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        background: #f27524;
        color: #fff;
        font-size: 16px;
        font-weight: 900;
    }

    .ef-service-card.blue .ef-num {
        background: #1f73b8;
    }

    .ef-service-card h3 {
        min-height: 36px;
        margin: 0 0 10px;
        color: #f27524;
        font-size: 14px;
        line-height: 1.25;
        font-weight: 900;
    }

    .ef-service-card.blue h3 {
        color: #1f73b8;
    }

    .ef-service-card p {
        margin: 0;
        color: #343b46;
        font-size: 12.5px;
        line-height: 1.45;
        font-weight: 600;
    }

    .ef-service-card.offset {
        grid-column: 1 / span 1;
        margin-left: 50%;
    }

    .ef-style-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 22px;
        max-width: 1200px;
        margin: 34px auto 0;
    }

    .ef-style-card {
        overflow: hidden;
        border: 2px solid #f27524;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 8px 16px rgba(28,44,62,.14);
    }

    .ef-style-card.blue {
        border-color: #1f73b8;
    }

    .ef-style-card img {
        width: 100%;
        aspect-ratio: 555 / 433;
        display: block;
        object-fit: cover;
    }

    .ef-style-image {
        width: 100%;
        aspect-ratio: 555 / 433;
        display: block;
        object-fit: contain;
        filter: drop-shadow(0 8px 14px rgba(28,44,62,.14));
    }

    .ef-label {
        min-height: 42px;
        padding: 10px 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #20242c;
        font-size: 12.5px;
        line-height: 1.2;
        font-weight: 900;
        text-align: center;
    }

    .ef-check-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px 38px;
        max-width: 980px;
        margin: 24px auto 0;
    }

    .ef-check {
        color: #252b35;
        font-size: 14px;
        line-height: 1.45;
        font-weight: 800;
    }

    .ef-check::before {
        content: "\2713";
        margin-right: 8px;
        color: #111;
        font-weight: 900;
    }

    .ef-note {
        max-width: 920px;
        margin: 22px auto 0;
        color: #4d5562;
        font-size: 13.5px;
        line-height: 1.6;
        font-weight: 600;
        text-align: center;
    }

    .ef-footer-info {
        max-width: 980px;
        margin: 30px auto 0;
        color: #4d5562;
        font-size: 13.5px;
        line-height: 1.6;
        font-weight: 600;
    }

    .ef-footer-info h3 {
        margin: 0 0 8px;
        color: #171923;
        font-size: 16px;
        font-weight: 900;
    }

    .ef-faq {
        max-width: 1040px;
        margin: 30px auto 0;
        display: grid;
        gap: 12px;
    }

    .ef-faq details {
        border: 1px solid #d8dce2;
        border-radius: 7px;
        background: #fff;
        box-shadow: 0 5px 12px rgba(28,44,62,.08);
    }

    .ef-faq summary {
        cursor: pointer;
        padding: 15px 18px;
        color: #20242c;
        font-size: 14px;
        font-weight: 900;
    }

    .ef-faq p {
        margin: 0;
        padding: 0 18px 16px;
        color: #4d5562;
        font-size: 13.5px;
        line-height: 1.6;
        font-weight: 600;
    }

    @media (max-width: 991px) {
        .ef-value-grid,
        .ef-style-grid,
        .ef-check-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .ef-service-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            max-width: 720px;
        }

        .ef-service-card.offset {
            grid-column: auto;
            margin-left: 0;
        }
    }

    @media (max-width: 640px) {
        .ef-hero {
            min-height: 290px;
        }

        .ef-section {
            padding: 42px 0;
        }

        .ef-value-grid,
        .ef-service-grid,
        .ef-style-grid,
        .ef-check-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="ef-page">
    <section class="ef-hero">
        <img src="{{ asset('images/logo/bv1.png') }}" alt="Elevation and facade design services">
        <div class="ef-hero-content">
            <h1>
                Elevation and Facade Design<br>
                Services in<br>
                Navi Mumbai, Mumbai, Thane,<br>
                Pune &amp; Raigad
            </h1>
        </div>
    </section>

    <section class="ef-section white">
        <div class="ef-container">
            <h2 class="ef-title">Elevation and Facade Design Services in Navi Mumbai, Mumbai,<br> Pune, Raigad &amp; Thane</h2>
            <div class="ef-line"></div>

            <div class="ef-copy">
                <p>
                    Your building's exterior is the first thing people notice. At <strong>ConstructKaro</strong>, we provide expert <strong>Elevation and Facade Design Services</strong> that enhance the visual appeal, functionality, and value of your property.
                </p>
                <p>
                    Whether it is a bungalow, apartment, commercial building, or villa, we connect you with verified architects who design stunning, practical, and modern exteriors tailored to your project.
                </p>
            </div>
        </div>
    </section>

    <section class="ef-section">
        <div class="ef-container">
            <h2 class="ef-title">What is Elevation and Facade Design?</h2>
            <div class="ef-line"></div>

            <div class="ef-copy">
                <p>
                    Elevation design refers to the exterior view of a building, including front, side, rear, and overall facade design. It focuses on the overall outer appearance, materials, textures, and architectural elements.
                </p>
                <p>
                    A well-designed facade ensures:
                </p>
            </div>

            <div class="ef-value-grid">
                <div class="ef-value blue">Strong visual identity</div>
                <div class="ef-value orange">Better natural light &amp; ventilation</div>
                <div class="ef-value blue">Long-term durability</div>
                <div class="ef-value orange">Higher property value</div>
            </div>
        </div>
    </section>

    <section class="ef-section white">
        <div class="ef-container">
            <h2 class="ef-title">Our Elevation &amp; Facade Design Services Include</h2>
            <div class="ef-line"></div>

            @php
                $services = [
                    ['num' => '1', 'color' => 'orange', 'title' => '2D Elevation Design', 'text' => 'Front elevation concepts, side and rear elevation planning, and design as per site size and structure.'],
                    ['num' => '2', 'color' => 'blue', 'title' => '3D Elevation & Visualization', 'text' => 'Realistic 3D exterior views, multiple design options, and high-quality elevation presentation.'],
                    ['num' => '3', 'color' => 'orange', 'title' => 'Facade Material Planning', 'text' => 'Stone, tiles, wood, cladding, glass, texture, color combination, and material suggestions.'],
                    ['num' => '4', 'color' => 'blue', 'title' => 'Lighting & Exterior Detailing', 'text' => 'Facade lighting design, balcony and railing detailing, and gate and compound wall design.'],
                    ['num' => '5', 'color' => 'orange', 'title' => 'Renovation & Facelift Design', 'text' => 'Old building exterior redesign, modern facade upgrade, and cost-effective transformation plans.'],
                ];
            @endphp

            <div class="ef-service-grid">
                @foreach($services as $index => $item)
                    <div class="ef-service-card {{ $item['color'] === 'blue' ? 'blue' : '' }} {{ $index === 3 ? 'blue' : '' }}">
                        <div class="ef-num">{{ $item['num'] }}</div>
                        <h3>{{ $item['title'] }}</h3>
                        <p>{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="ef-section">
        <div class="ef-container">
            <h2 class="ef-title">Types of Elevation &amp; Facade Design Styles</h2>
            <div class="ef-line"></div>

            @php
                $styles = [
                    ['color' => 'blue', 'image' => asset('images/logo/ev1.png'), 'title' => 'Contemporary Facade Design', 'alt' => 'Contemporary facade design'],
                    ['color' => 'orange', 'image' => asset('images/logo/ev2.png'), 'title' => 'Classic Elevation Design', 'alt' => 'Classic elevation design'],
                    ['color' => 'blue', 'image' => asset('images/logo/ev3.png'), 'title' => 'Commercial Facade Design', 'alt' => 'Commercial facade design'],
                    ['color' => 'orange', 'image' => asset('images/logo/ev4.png'), 'title' => 'Luxury Villa Elevation Design', 'alt' => 'Luxury villa elevation design'],
                ];
            @endphp

            <div class="ef-style-grid">
                @foreach($styles as $style)
                    <img class="ef-style-image" src="{{ $style['image'] }}" alt="{{ $style['alt'] }}">
                @endforeach
            </div>
        </div>
    </section>

    <section class="ef-section white">
        <div class="ef-container">
            <h2 class="ef-title">Why Choose ConstructKaro?</h2>
            <div class="ef-line"></div>

            <div class="ef-check-grid">
                <div class="ef-check">Verified architects &amp; designers</div>
                <div class="ef-check">Multiple elevation design options</div>
                <div class="ef-check">Material &amp; cost guidance</div>
                <div class="ef-check">Design + execution coordination</div>
                <div class="ef-check">Suitable for residential &amp; commercial projects</div>
            </div>

            <p class="ef-note">We ensure your building stands out with a professional and impactful exterior design.</p>

            <div class="ef-footer-info">
                <h3>Areas We Serve</h3>
                <p>Elevation Design in Navi Mumbai | Facade Design in Mumbai | Elevation Design in Pune | Facade Design in Raigad | Elevation Design in Thane</p>
            </div>
        </div>
    </section>

    <section class="ef-section">
        <div class="ef-container">
            <h2 class="ef-title">Frequently Asked Questions (FAQs)</h2>
            <div class="ef-line"></div>

            <div class="ef-faq">
                <details>
                    <summary>1. What is the cost of elevation design?</summary>
                    <p>The cost depends on building size, design complexity, number of views, 3D visualization, and material planning scope.</p>
                </details>
                <details>
                    <summary>2. Do you provide 3D elevation designs?</summary>
                    <p>Yes, 3D elevation views can be created to help you visualize the final exterior before execution.</p>
                </details>
                <details>
                    <summary>3. Can you redesign my old building facade?</summary>
                    <p>Yes, renovation and facade facelift design can be planned for existing homes, apartments, shops, and commercial buildings.</p>
                </details>
                <details>
                    <summary>4. Do you help with material selection?</summary>
                    <p>Yes, we can guide you on facade materials, textures, colors, cladding, glass, lighting, and practical finish options.</p>
                </details>
                <details>
                    <summary>5. How long does elevation design take?</summary>
                    <p>Timeline depends on project size, revisions, drawing requirements, and 3D visualization scope.</p>
                </details>
            </div>
        </div>
    </section>
</div>
@endsection
