@extends('layouts.app')

@section('title', $service['title'] ?? 'Plot Development Planning Services')

@section('content')
<style>
    .pd-page,
    .pd-page * {
        box-sizing: border-box;
    }

    .pd-page {
        background: #eeeeee;
        color: #20242c;
        font-family: "Poppins", "Segoe UI", sans-serif;
        overflow: hidden;
    }

    .pd-hero {
        position: relative;
        min-height: 360px;
        display: flex;
        align-items: center;
        background: #111;
        overflow: hidden;
    }

    .pd-hero img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .pd-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, rgba(0,0,0,.88), rgba(0,0,0,.58) 44%, rgba(0,0,0,.06));
    }

    .pd-hero-content {
        position: relative;
        z-index: 2;
        width: min(1180px, calc(100% - 36px));
        margin: 0 auto;
    }

    .pd-hero h1 {
        max-width: 680px;
        margin: 0;
        color: #fff;
        font-size: clamp(28px, 4vw, 50px);
        line-height: 1.18;
        font-weight: 900;
        text-shadow: 0 5px 18px rgba(0,0,0,.45);
    }

    .pd-section {
        padding: 48px 0;
        background: #eeeeee;
    }

    .pd-section.white {
        background: #fff;
    }

    .pd-container {
        width: min(1180px, calc(100% - 36px));
        margin: 0 auto;
    }

    .pd-title {
        margin: 0;
        color: #171923;
        font-size: clamp(23px, 3vw, 33px);
        line-height: 1.25;
        font-weight: 900;
        text-align: center;
    }

    .pd-line {
        width: min(560px, 72%);
        height: 4px;
        margin: 13px auto 30px;
        border-radius: 999px;
        background: linear-gradient(90deg, #f27524 0%, #f27524 40%, #1f73b8 100%);
    }

    .pd-copy {
        max-width: 1080px;
        margin: 0 auto;
        color: #4d5562;
        font-size: 15px;
        line-height: 1.75;
        font-weight: 500;
    }

    .pd-copy p {
        margin: 0 0 14px;
    }

    .pd-copy strong {
        color: #20242c;
        font-weight: 900;
    }

    .pd-image-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 28px;
        max-width: 920px;
        margin: 34px auto 0;
        align-items: start;
    }

    .pd-image-grid.five {
        grid-template-columns: repeat(6, minmax(0, 1fr));
        max-width: 980px;
    }

    .pd-plain-image-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 28px 34px;
        max-width: 1000px;
        margin: 34px auto 0;
    }

    .pd-plain-image {
        width: min(100%, 300px);
        aspect-ratio: 474 / 397;
        display: block;
        object-fit: contain;
        filter: drop-shadow(0 8px 14px rgba(28,44,62,.14));
    }

    .pd-image-card {
        grid-column: span 2;
        overflow: hidden;
        border: 2px solid #1f73b8;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 8px 16px rgba(28,44,62,.14);
    }

    .pd-image-card.orange {
        border-color: #f27524;
    }

    .pd-image-card.offset {
        grid-column: 2 / span 2;
    }

    .pd-image-card img {
        width: 100%;
        aspect-ratio: 1.25 / 1;
        display: block;
        object-fit: cover;
    }

    .pd-image-label {
        min-height: 42px;
        padding: 10px 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #20242c;
        font-size: 13px;
        line-height: 1.2;
        font-weight: 900;
        text-align: center;
    }

    .pd-service-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 22px;
        max-width: 980px;
        margin: 36px auto 0;
    }

    .pd-service-card {
        position: relative;
        min-height: 170px;
        padding: 28px 16px 18px;
        border: 2px solid #f27524;
        border-radius: 8px;
        background: #fff0e4;
        box-shadow: 0 8px 16px rgba(28,44,62,.13);
        text-align: center;
    }

    .pd-service-card.blue {
        border-color: #1f73b8;
        background: #eaf4ff;
    }

    .pd-num {
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

    .pd-service-card.blue .pd-num {
        background: #1f73b8;
    }

    .pd-service-card h3 {
        min-height: 36px;
        margin: 0 0 10px;
        color: #f27524;
        font-size: 14px;
        line-height: 1.25;
        font-weight: 900;
    }

    .pd-service-card.blue h3 {
        color: #1f73b8;
    }

    .pd-service-card p {
        margin: 0;
        color: #343b46;
        font-size: 12.5px;
        line-height: 1.45;
        font-weight: 600;
    }

    .pd-type-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 20px;
        max-width: 1060px;
        margin: 34px auto 0;
    }

    .pd-type-card {
        overflow: hidden;
        border: 2px solid #f27524;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 8px 16px rgba(28,44,62,.14);
    }

    .pd-type-card.blue {
        border-color: #1f73b8;
    }

    .pd-type-card img {
        width: 100%;
        aspect-ratio: 1.45 / 1;
        display: block;
        object-fit: cover;
    }

    .pd-type-image-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 28px;
        max-width: 1120px;
        margin: 34px auto 0;
        align-items: start;
    }

    .pd-type-image {
        width: 100%;
        aspect-ratio: 442 / 397;
        display: block;
        object-fit: contain;
        filter: drop-shadow(0 8px 14px rgba(28,44,62,.14));
    }

    .pd-check-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px 38px;
        max-width: 980px;
        margin: 24px auto 0;
    }

    .pd-check {
        color: #252b35;
        font-size: 14px;
        line-height: 1.45;
        font-weight: 800;
    }

    .pd-check::before {
        content: "\2713";
        margin-right: 8px;
        color: #111;
        font-weight: 900;
    }

    .pd-footer-info {
        max-width: 980px;
        margin: 30px auto 0;
        color: #4d5562;
        font-size: 13.5px;
        line-height: 1.6;
        font-weight: 600;
    }

    .pd-footer-info h3 {
        margin: 0 0 8px;
        color: #171923;
        font-size: 16px;
        font-weight: 900;
    }

    .pd-faq {
        max-width: 1040px;
        margin: 30px auto 0;
        display: grid;
        gap: 12px;
    }

    .pd-faq details {
        border: 1px solid #d8dce2;
        border-radius: 7px;
        background: #fff;
        box-shadow: 0 5px 12px rgba(28,44,62,.08);
    }

    .pd-faq summary {
        cursor: pointer;
        padding: 15px 18px;
        color: #20242c;
        font-size: 14px;
        font-weight: 900;
    }

    .pd-faq p {
        margin: 0;
        padding: 0 18px 16px;
        color: #4d5562;
        font-size: 13.5px;
        line-height: 1.6;
        font-weight: 600;
    }

    @media (max-width: 991px) {
        .pd-service-grid,
        .pd-type-grid,
        .pd-type-image-grid,
        .pd-check-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .pd-image-grid,
        .pd-image-grid.five {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            max-width: 700px;
        }

        .pd-plain-image {
            width: min(100%, 300px);
        }

        .pd-image-card,
        .pd-image-card.offset {
            grid-column: auto;
        }
    }

    @media (max-width: 640px) {
        .pd-hero {
            min-height: 290px;
        }

        .pd-section {
            padding: 42px 0;
        }

        .pd-service-grid,
        .pd-type-grid,
        .pd-type-image-grid,
        .pd-check-grid,
        .pd-image-grid,
        .pd-image-grid.five,
        .pd-type-image-grid {
            grid-template-columns: 1fr;
        }

        .pd-plain-image-grid {
            gap: 22px;
        }

        .pd-plain-image,
        .pd-type-image {
            width: min(100%, 330px);
            margin: 0 auto;
        }
    }
</style>

<div class="pd-page">
    <section class="pd-hero">
        <img src="{{ asset('images/logo/bv1.png') }}" alt="Plot development planning services">
        <div class="pd-hero-content">
            <h1>
                Plot Development Planning<br>
                Services in<br>
                Navi Mumbai, Mumbai, Thane,<br>
                Pune &amp; Raigad
            </h1>
        </div>
    </section>

    <section class="pd-section white">
        <div class="pd-container">
            <h2 class="pd-title">Plot Development Planning Services In Navi Mumbai,<br> Mumbai, Raigad, Thane &amp; Pune</h2>
            <div class="pd-line"></div>

            <div class="pd-copy">
                <p>
                    Planning to develop land into residential plots, a township, or an investment layout? At <strong>ConstructKaro</strong>, we provide professional <strong>Plot Development Planning Services</strong> for landowners, builders, and developers in Navi Mumbai, Raigad, Mumbai, Thane, and Pune.
                </p>
                <p>
                    From layout design to infrastructure planning, we guide you through every stage and help your development move in a structured, profitable, and future-ready way.
                </p>
            </div>
        </div>
    </section>

    <section class="pd-section">
        <div class="pd-container">
            <h2 class="pd-title">What is Plot Development Planning?</h2>
            <div class="pd-line"></div>

            <div class="pd-copy">
                <p>
                    Plot development planning is the process of converting raw land into organized plots with proper infrastructure, including roads, drainage, utilities, land space planning, and future construction readiness.
                </p>
            </div>

            @php
                $planningItems = [
                    ['image' => asset('images/logo/pd1.png'), 'title' => 'Land analysis & feasibility', 'alt' => 'Land analysis and feasibility'],
                    ['image' => asset('images/logo/pd2.png'), 'title' => 'Layout planning', 'alt' => 'Layout planning'],
                    ['image' => asset('images/logo/pd3.png'), 'title' => 'Infrastructure design', 'alt' => 'Infrastructure design'],
                    ['image' => asset('images/logo/pd4.png'), 'title' => 'Approval support', 'alt' => 'Approval support'],
                    ['image' => asset('images/logo/pd5.png'), 'title' => 'Execution guidance', 'alt' => 'Execution guidance'],
                ];
            @endphp

            <div class="pd-plain-image-grid">
                @foreach($planningItems as $item)
                    <img class="pd-plain-image" src="{{ $item['image'] }}" alt="{{ $item['alt'] }}">
                @endforeach
            </div>
        </div>
    </section>

    <section class="pd-section white">
        <div class="pd-container">
            <h2 class="pd-title">Our Plot Development Planning Services Include</h2>
            <div class="pd-line"></div>

            @php
                $services = [
                    ['num' => '1', 'color' => 'orange', 'title' => 'Land Feasibility & Site Analysis', 'text' => 'Topography study, land access, road connectivity, and basic development potential review.'],
                    ['num' => '2', 'color' => 'blue', 'title' => 'Layout Planning & Plot Design', 'text' => 'Residential and commercial plot layouts with road width, plot sizes, open spaces, and circulation.'],
                    ['num' => '3', 'color' => 'orange', 'title' => 'Infrastructure Planning', 'text' => 'Road network, drainage, water supply, street lighting, and utility planning.'],
                    ['num' => '4', 'color' => 'blue', 'title' => 'Survey & Technical Support', 'text' => 'Site measurements, contour understanding, and support for layout preparation.'],
                    ['num' => '5', 'color' => 'orange', 'title' => 'Approval & Documentation', 'text' => 'Guidance for drawings, documents, and coordination needed for approvals.'],
                    ['num' => '6', 'color' => 'blue', 'title' => 'Execution Planning & Vendor Coordination', 'text' => 'Construction phase guidance, vendor coordination, and staged development planning.'],
                ];
            @endphp

            <div class="pd-service-grid">
                @foreach($services as $item)
                    <div class="pd-service-card {{ $item['color'] === 'blue' ? 'blue' : '' }}">
                        <div class="pd-num">{{ $item['num'] }}</div>
                        <h3>{{ $item['title'] }}</h3>
                        <p>{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="pd-section">
        <div class="pd-container">
            <h2 class="pd-title">Types of Plot Development Projects</h2>
            <div class="pd-line"></div>

            @php
                $projectTypes = [
                    ['color' => 'blue', 'image' => asset('images/logo/pd6.png'), 'title' => 'Residential Plotting Projects', 'alt' => 'Residential plotting projects'],
                    ['color' => 'orange', 'image' => asset('images/logo/pd7.png'), 'title' => 'Farmhouse Plot Development', 'alt' => 'Farmhouse plot development'],
                    ['color' => 'blue', 'image' => asset('images/logo/pd8.png'), 'title' => 'Commercial Plot Development', 'alt' => 'Commercial plot development'],
                    ['color' => 'orange', 'image' => asset('images/logo/pd9.png'), 'title' => 'Township & Large Layout Planning', 'alt' => 'Township and large layout planning'],
                ];
            @endphp

            <div class="pd-type-image-grid">
                @foreach($projectTypes as $type)
                    <img class="pd-type-image" src="{{ $type['image'] }}" alt="{{ $type['alt'] }}">
                @endforeach
            </div>
        </div>
    </section>

    <section class="pd-section white">
        <div class="pd-container">
            <h2 class="pd-title">Why Choose ConstructKaro?</h2>
            <div class="pd-line"></div>

            <div class="pd-check-grid">
                <div class="pd-check">Structured planning approach</div>
                <div class="pd-check">Verified surveyors, planners & contractors</div>
                <div class="pd-check">End-to-end support from planning to execution</div>
                <div class="pd-check">Cost optimization & better plot utilization</div>
                <div class="pd-check">Single point of coordination</div>
            </div>

            <div class="pd-footer-info">
                <h3>Areas We Serve</h3>
                <p>Plot Development Planning in Navi Mumbai | Plot Development Planning in Mumbai | Plot Development Planning in Pune | Plot Development Planning in Raigad | Plot Development Planning in Thane</p>
            </div>
        </div>
    </section>

    <section class="pd-section">
        <div class="pd-container">
            <h2 class="pd-title">Frequently Asked Questions (FAQs)</h2>
            <div class="pd-line"></div>

            <div class="pd-faq">
                <details>
                    <summary>1. What is the cost of plot development planning?</summary>
                    <p>The cost depends on land size, survey requirements, layout complexity, infrastructure scope, and approval support needed.</p>
                </details>
                <details>
                    <summary>2. Can you help with NA conversion?</summary>
                    <p>We can guide you with the planning and documentation process and connect you with suitable professionals for location-specific requirements.</p>
                </details>
                <details>
                    <summary>3. Do you provide execution support?</summary>
                    <p>Yes, we can coordinate with execution partners for roads, drainage, utilities, and other site development work.</p>
                </details>
                <details>
                    <summary>4. How long does layout planning take?</summary>
                    <p>Timeline depends on plot size, survey details, revisions, and approval scope.</p>
                </details>
                <details>
                    <summary>5. Do you provide survey services?</summary>
                    <p>Yes, survey and technical support can be coordinated as part of the plot development planning process.</p>
                </details>
            </div>
        </div>
    </section>
</div>
@endsection
