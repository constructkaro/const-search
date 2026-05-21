@extends('layouts.app')

@section('title', $service['title'] ?? 'Renovation Planning Services')

@section('content')
<style>
    .rp-page,
    .rp-page * {
        box-sizing: border-box;
    }

    .rp-page {
        background: #eeeeee;
        color: #20242c;
        font-family: "Poppins", "Segoe UI", sans-serif;
        overflow: hidden;
    }

    .rp-hero {
        position: relative;
        min-height: 360px;
        display: flex;
        align-items: center;
        background: #111;
        overflow: hidden;
    }

    .rp-hero img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .rp-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, rgba(0,0,0,.88), rgba(0,0,0,.58) 44%, rgba(0,0,0,.06));
    }

    .rp-hero-content {
        position: relative;
        z-index: 2;
        width: min(1180px, calc(100% - 36px));
        margin: 0 auto;
    }

    .rp-hero h1 {
        max-width: 700px;
        margin: 0;
        color: #fff;
        font-size: clamp(28px, 4vw, 50px);
        line-height: 1.18;
        font-weight: 900;
        text-shadow: 0 5px 18px rgba(0,0,0,.45);
    }

    .rp-section {
        padding: 48px 0;
        background: #eeeeee;
    }

    .rp-section.white {
        background: #fff;
    }

    .rp-container {
        width: min(1180px, calc(100% - 36px));
        margin: 0 auto;
    }

    .rp-title {
        margin: 0;
        color: #171923;
        font-size: clamp(23px, 3vw, 33px);
        line-height: 1.25;
        font-weight: 900;
        text-align: center;
    }

    .rp-line {
        width: min(560px, 72%);
        height: 4px;
        margin: 13px auto 30px;
        border-radius: 999px;
        background: linear-gradient(90deg, #f27524 0%, #f27524 40%, #1f73b8 100%);
    }

    .rp-copy {
        max-width: 1080px;
        margin: 0 auto;
        color: #4d5562;
        font-size: 17px;
        line-height: 1.75;
        font-weight: 600;
    }

    .rp-copy p {
        margin: 0 0 14px;
    }

    .rp-copy strong {
        color: #20242c;
        font-weight: 900;
    }

    .rp-value-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 22px;
        max-width: 1040px;
        margin: 30px auto 0;
    }

    .rp-value {
        min-height: 68px;
        padding: 14px 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #1f73b8;
        border-radius: 6px;
        background: #fff;
        color: #20242c;
        font-size: 14px;
        line-height: 1.25;
        font-weight: 900;
        text-align: center;
        box-shadow: 0 6px 12px rgba(28,44,62,.08);
    }

    .rp-value.orange {
        border-color: #f27524;
    }

    .rp-service-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 24px;
        max-width: 1080px;
        margin: 42px auto 0;
    }

    .rp-service-card {
        position: relative;
        min-height: 195px;
        padding: 36px 22px 24px;
        border: 2px solid #f27524;
        border-radius: 8px;
        background: #fff0e4;
        box-shadow: 0 8px 16px rgba(28,44,62,.13);
        text-align: center;
    }

    .rp-service-card.blue {
        border-color: #1f73b8;
        background: #eaf4ff;
    }

    .rp-num {
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

    .rp-service-card.blue .rp-num {
        background: #1f73b8;
    }

    .rp-service-card h3 {
        min-height: 42px;
        margin: 0 0 12px;
        color: #f27524;
        font-size: 16px;
        line-height: 1.25;
        font-weight: 900;
    }

    .rp-service-card.blue h3 {
        color: #1f73b8;
    }

    .rp-service-card p {
        margin: 0;
        color: #343b46;
        font-size: 14px;
        line-height: 1.55;
        font-weight: 600;
    }

    .rp-project-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 26px;
        max-width: 1120px;
        margin: 34px auto 0;
        align-items: start;
    }

    .rp-project-card {
        overflow: hidden;
        border: 2px solid #f27524;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 8px 16px rgba(28,44,62,.14);
    }

    .rp-project-card.blue {
        border-color: #1f73b8;
    }

    .rp-project-card img {
        width: 100%;
        aspect-ratio: 572 / 471;
        display: block;
        object-fit: cover;
    }

    .rp-project-image {
        width: 100%;
        aspect-ratio: 572 / 471;
        display: block;
        object-fit: contain;
        filter: drop-shadow(0 8px 14px rgba(28,44,62,.14));
    }

    .rp-project-label {
        min-height: 54px;
        padding: 13px 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #20242c;
        font-size: 15px;
        line-height: 1.2;
        font-weight: 900;
        text-align: center;
    }

    .rp-check-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px 38px;
        max-width: 980px;
        margin: 24px auto 0;
    }

    .rp-check {
        color: #252b35;
        font-size: 15px;
        line-height: 1.45;
        font-weight: 800;
    }

    .rp-check::before {
        content: "\2713";
        margin-right: 8px;
        color: #111;
        font-weight: 900;
    }

    .rp-footer-info {
        max-width: 980px;
        margin: 30px auto 0;
        color: #4d5562;
        font-size: 15px;
        line-height: 1.6;
        font-weight: 600;
    }

    .rp-footer-info h3 {
        margin: 0 0 8px;
        color: #171923;
        font-size: 18px;
        font-weight: 900;
    }

    .rp-faq {
        max-width: 1040px;
        margin: 30px auto 0;
        display: grid;
        gap: 12px;
    }

    .rp-faq details {
        border: 1px solid #d8dce2;
        border-radius: 7px;
        background: #fff;
        box-shadow: 0 5px 12px rgba(28,44,62,.08);
    }

    .rp-faq summary {
        cursor: pointer;
        padding: 17px 20px;
        color: #20242c;
        font-size: 15.5px;
        font-weight: 900;
    }

    .rp-faq p {
        margin: 0;
        padding: 0 20px 16px;
        color: #4d5562;
        font-size: 15px;
        line-height: 1.6;
        font-weight: 600;
    }

    @media (max-width: 991px) {
        .rp-value-grid,
        .rp-project-grid,
        .rp-check-grid,
        .rp-service-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 640px) {
        .rp-hero {
            min-height: 290px;
        }

        .rp-section {
            padding: 42px 0;
        }

        .rp-value-grid,
        .rp-service-grid,
        .rp-project-grid,
        .rp-check-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="rp-page">
    <section class="rp-hero">
        <img src="{{ asset('images/logo/bv1.png') }}" alt="Renovation planning services">
        <div class="rp-hero-content">
            <h1>
                Renovation Planning Services in<br>
                Navi Mumbai, Mumbai, Thane,<br>
                Pune &amp; Raigad
            </h1>
        </div>
    </section>

    <section class="rp-section white">
        <div class="rp-container">
            <h2 class="rp-title">Renovation Planning Services in Navi Mumbai, Mumbai, Pune, Raigad &amp; Thane</h2>
            <div class="rp-line"></div>

            <div class="rp-copy">
                <p>
                    Planning to upgrade your home, office, or commercial space? At <strong>ConstructKaro</strong>, we provide expert <strong>Renovation Planning Services</strong> that help you redesign, optimize, and modernize your existing property without unnecessary costs or confusion.
                </p>
                <p>
                    From layout changes to complete transformation planning, we ensure your renovation is practical, cost-effective, and well structured before execution begins.
                </p>
            </div>
        </div>
    </section>

    <section class="rp-section">
        <div class="rp-container">
            <h2 class="rp-title">What is Renovation Planning?</h2>
            <div class="rp-line"></div>

            <div class="rp-copy">
                <p>
                    Renovation planning is the process of analyzing your current space and creating a structured plan to improve its functionality, design, and usability.
                </p>
                <p>
                    It includes:
                </p>
            </div>

            <div class="rp-value-grid">
                <div class="rp-value blue">Existing layout evaluation</div>
                <div class="rp-value orange">Redesign &amp; space optimization</div>
                <div class="rp-value blue">Material &amp; cost planning</div>
                <div class="rp-value orange">Execution strategy</div>
            </div>
        </div>
    </section>

    <section class="rp-section white">
        <div class="rp-container">
            <h2 class="rp-title">Our Renovation Planning Services Include</h2>
            <div class="rp-line"></div>

            @php
                $services = [
                    ['num' => '1', 'color' => 'orange', 'title' => 'Existing Space Analysis', 'text' => 'Site inspection, measurement, structural feasibility check, and identifying problem areas.'],
                    ['num' => '2', 'color' => 'blue', 'title' => 'Layout Redesign & Space Optimization', 'text' => 'Replanning room layouts, improving circulation, and maximizing usable space.'],
                    ['num' => '3', 'color' => 'orange', 'title' => 'Interior & Exterior Renovation Planning', 'text' => 'Kitchen and bathroom remodeling, living space redesign, and elevation and facade refresh.'],
                    ['num' => '4', 'color' => 'blue', 'title' => 'Material & Design Selection', 'text' => 'Flooring, tiles, wall finishes, lighting, false ceiling, color concepts, and budget-friendly materials.'],
                    ['num' => '5', 'color' => 'orange', 'title' => 'Cost Estimation & BOQ', 'text' => 'Renovation budget planning, detailed BOQ preparation, and cost-saving recommendations.'],
                    ['num' => '6', 'color' => 'blue', 'title' => 'Execution Strategy & Support', 'text' => 'Step-by-step renovation plan, contractor selection support, and timeline and work sequencing.'],
                ];
            @endphp

            <div class="rp-service-grid">
                @foreach($services as $item)
                    <div class="rp-service-card {{ $item['color'] === 'blue' ? 'blue' : '' }}">
                        <div class="rp-num">{{ $item['num'] }}</div>
                        <h3>{{ $item['title'] }}</h3>
                        <p>{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="rp-section">
        <div class="rp-container">
            <h2 class="rp-title">Types of Renovation Planning Projects</h2>
            <div class="rp-line"></div>

            @php
                $projects = [
                    ['color' => 'orange', 'image' => asset('images/logo/rp1.png'), 'title' => 'Home Renovation Planning', 'alt' => 'Home renovation planning'],
                    ['color' => 'blue', 'image' => asset('images/logo/rp2.png'), 'title' => 'Apartment Renovation Planning', 'alt' => 'Apartment renovation planning'],
                    ['color' => 'orange', 'image' => asset('images/logo/rp3.png'), 'title' => 'Commercial Renovation Planning', 'alt' => 'Commercial renovation planning'],
                    ['color' => 'blue', 'image' => asset('images/logo/rp4.png'), 'title' => 'Building Facelift & Exterior Renovation', 'alt' => 'Building facelift and exterior renovation'],
                ];
            @endphp

            <div class="rp-project-grid">
                @foreach($projects as $project)
                    <img class="rp-project-image" src="{{ $project['image'] }}" alt="{{ $project['alt'] }}">
                @endforeach
            </div>
        </div>
    </section>

    <section class="rp-section white">
        <div class="rp-container">
            <h2 class="rp-title">Why Renovation Planning is Important?</h2>
            <div class="rp-line"></div>

            <div class="rp-check-grid">
                <div class="rp-check">Helps control budget and timeline</div>
                <div class="rp-check">Reduces execution errors</div>
                <div class="rp-check">Improves functionality and aesthetics</div>
                <div class="rp-check">Avoids unnecessary demolition costs</div>
                <div class="rp-check">Ensures better use of existing space</div>
            </div>

            <div class="rp-footer-info">
                <h3>Target Locations We Serve</h3>
                <p>Renovation Planning Services in Navi Mumbai | Renovation Planning Services in Mumbai | Renovation Planning Services in Pune | Renovation Planning Services in Raigad | Renovation Planning Services in Thane</p>
            </div>
        </div>
    </section>

    <section class="rp-section">
        <div class="rp-container">
            <h2 class="rp-title">Frequently Asked Questions (FAQs)</h2>
            <div class="rp-line"></div>

            <div class="rp-faq">
                <details>
                    <summary>1. What is the cost of renovation planning?</summary>
                    <p>The cost depends on property size, planning scope, drawing requirements, BOQ needs, and the level of redesign involved.</p>
                </details>
                <details>
                    <summary>2. Can you renovate my existing home without major demolition?</summary>
                    <p>Yes, renovation planning can focus on improving the current layout while minimizing demolition wherever possible.</p>
                </details>
                <details>
                    <summary>3. Do you provide BOQ for renovation?</summary>
                    <p>Yes, BOQ and cost estimation support can be included based on your renovation scope.</p>
                </details>
                <details>
                    <summary>4. How long does renovation planning take?</summary>
                    <p>Timeline depends on property size, site measurement, design revisions, and BOQ detail requirements.</p>
                </details>
                <details>
                    <summary>5. Do you provide contractor support?</summary>
                    <p>We can coordinate with suitable contractors and execution partners depending on your project location and scope.</p>
                </details>
            </div>
        </div>
    </section>
</div>
@endsection
