@extends('layouts.app')

@section('title', $service['title'] ?? 'Basic Design Consultation Services')

@section('content')
<style>
    .bdc-page,
    .bdc-page * {
        box-sizing: border-box;
    }

    .bdc-page {
        background: #eeeeee;
        color: #20242c;
        font-family: "Poppins", "Segoe UI", sans-serif;
        overflow: hidden;
    }

    .bdc-hero {
        position: relative;
        min-height: 360px;
        display: flex;
        align-items: center;
        background: #111;
        overflow: hidden;
    }

    .bdc-hero img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .bdc-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, rgba(0,0,0,.88), rgba(0,0,0,.58) 44%, rgba(0,0,0,.06));
    }

    .bdc-hero-content {
        position: relative;
        z-index: 2;
        width: min(1180px, calc(100% - 36px));
        margin: 0 auto;
    }

    .bdc-hero h1 {
        max-width: 740px;
        margin: 0;
        color: #fff;
        font-size: clamp(28px, 4vw, 50px);
        line-height: 1.18;
        font-weight: 900;
        text-shadow: 0 5px 18px rgba(0,0,0,.45);
    }

    .bdc-section {
        padding: 48px 0;
        background: #eeeeee;
    }

    .bdc-section.white {
        background: #fff;
    }

    .bdc-container {
        width: min(1180px, calc(100% - 36px));
        margin: 0 auto;
    }

    .bdc-title {
        margin: 0;
        color: #171923;
        font-size: clamp(23px, 3vw, 33px);
        line-height: 1.25;
        font-weight: 900;
        text-align: center;
    }

    .bdc-line {
        width: min(560px, 72%);
        height: 4px;
        margin: 13px auto 30px;
        border-radius: 999px;
        background: linear-gradient(90deg, #f27524 0%, #f27524 40%, #1f73b8 100%);
    }

    .bdc-copy {
        max-width: 1080px;
        margin: 0 auto;
        color: #4d5562;
        font-size: 17px;
        line-height: 1.75;
        font-weight: 600;
    }

    .bdc-copy p {
        margin: 0 0 14px;
    }

    .bdc-copy strong {
        color: #20242c;
        font-weight: 900;
    }

    .bdc-value-grid {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 16px;
        max-width: 1120px;
        margin: 30px auto 0;
    }

    .bdc-value {
        min-height: 64px;
        padding: 12px 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #1f73b8;
        border-radius: 6px;
        background: #fff;
        color: #20242c;
        font-size: 13.5px;
        line-height: 1.25;
        font-weight: 900;
        text-align: center;
        box-shadow: 0 6px 12px rgba(28,44,62,.08);
    }

    .bdc-value.orange {
        border-color: #f27524;
    }

    .bdc-service-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 22px;
        max-width: 1080px;
        margin: 34px auto 0;
    }

    .bdc-service-card {
        min-height: 74px;
        padding: 16px 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #f27524;
        border-radius: 8px;
        background: #fff0e4;
        color: #f27524;
        font-size: 15px;
        line-height: 1.25;
        font-weight: 900;
        text-align: center;
        box-shadow: 0 8px 16px rgba(28,44,62,.13);
    }

    .bdc-service-card.blue {
        border-color: #1f73b8;
        background: #eaf4ff;
        color: #1f73b8;
    }

    .bdc-project-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 26px;
        max-width: 1120px;
        margin: 34px auto 0;
        align-items: start;
    }

    .bdc-project-card {
        overflow: hidden;
        border: 2px solid #f27524;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 8px 16px rgba(28,44,62,.14);
    }

    .bdc-project-card.blue {
        border-color: #1f73b8;
    }

    .bdc-project-card img {
        width: 100%;
        aspect-ratio: 428 / 411;
        display: block;
        object-fit: cover;
    }

    .bdc-project-image {
        width: 100%;
        aspect-ratio: 428 / 411;
        display: block;
        object-fit: contain;
        filter: drop-shadow(0 8px 14px rgba(28,44,62,.14));
    }

    .bdc-project-label {
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

    .bdc-check-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px 38px;
        max-width: 980px;
        margin: 24px auto 0;
    }

    .bdc-check {
        color: #252b35;
        font-size: 15px;
        line-height: 1.45;
        font-weight: 800;
    }

    .bdc-check::before {
        content: "\2713";
        margin-right: 8px;
        color: #111;
        font-weight: 900;
    }

    .bdc-footer-info {
        max-width: 980px;
        margin: 30px auto 0;
        color: #4d5562;
        font-size: 15px;
        line-height: 1.6;
        font-weight: 600;
    }

    .bdc-footer-info h3 {
        margin: 0 0 8px;
        color: #171923;
        font-size: 18px;
        font-weight: 900;
    }

    .bdc-faq {
        max-width: 1040px;
        margin: 30px auto 0;
        display: grid;
        gap: 12px;
    }

    .bdc-faq details {
        border: 1px solid #d8dce2;
        border-radius: 7px;
        background: #fff;
        box-shadow: 0 5px 12px rgba(28,44,62,.08);
    }

    .bdc-faq summary {
        cursor: pointer;
        padding: 17px 20px;
        color: #20242c;
        font-size: 15.5px;
        font-weight: 900;
    }

    .bdc-faq p {
        margin: 0;
        padding: 0 20px 16px;
        color: #4d5562;
        font-size: 15px;
        line-height: 1.6;
        font-weight: 600;
    }

    @media (max-width: 991px) {
        .bdc-value-grid,
        .bdc-service-grid,
        .bdc-project-grid,
        .bdc-check-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 640px) {
        .bdc-hero {
            min-height: 290px;
        }

        .bdc-section {
            padding: 42px 0;
        }

        .bdc-value-grid,
        .bdc-service-grid,
        .bdc-project-grid,
        .bdc-check-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="bdc-page">
    <section class="bdc-hero">
        <img src="{{ asset('images/logo/bv1.png') }}" alt="Basic design consultation services">
        <div class="bdc-hero-content">
            <h1>
                Basic Design Consultation Services in<br>
                Navi Mumbai, Mumbai, Thane,<br>
                Pune &amp; Raigad
            </h1>
        </div>
    </section>

    <section class="bdc-section white">
        <div class="bdc-container">
            <h2 class="bdc-title">Basic Design Consultation Services in Navi Mumbai, Mumbai,<br> Pune, Raigad &amp; Thane</h2>
            <div class="bdc-line"></div>

            <div class="bdc-copy">
                <p>
                    Planning to build, renovate, or redesign your property but unsure where to start? At <strong>ConstructKaro</strong>, we provide expert <strong>Basic Design Consultation Services</strong> to help you understand the right planning approach, layout possibilities, design direction, and project feasibility before execution begins.
                </p>
                <p>
                    Whether it is a home, bungalow, farmhouse, office, or commercial project, our consultation helps you make smarter design and construction decisions from day one.
                </p>
            </div>
        </div>
    </section>

    <section class="bdc-section">
        <div class="bdc-container">
            <h2 class="bdc-title">What is Basic Design Consultation?</h2>
            <div class="bdc-line"></div>

            <div class="bdc-copy">
                <p>
                    Basic design consultation is an initial professional discussion where architects and planning experts guide you regarding:
                </p>
            </div>

            <div class="bdc-value-grid">
                <div class="bdc-value blue">Space planning</div>
                <div class="bdc-value orange">Layout possibilities</div>
                <div class="bdc-value blue">Design concepts</div>
                <div class="bdc-value orange">Plot utilization</div>
                <div class="bdc-value blue">Budget feasibility</div>
                <div class="bdc-value orange">Construction planning approach</div>
            </div>

            <div class="bdc-copy" style="margin-top:24px;">
                <p>It helps you gain clarity before investing time and money into detailed drawings or construction work.</p>
            </div>
        </div>
    </section>

    <section class="bdc-section white">
        <div class="bdc-container">
            <h2 class="bdc-title">Our Basic Design Consultation Services Include</h2>
            <div class="bdc-line"></div>

            @php
                $services = [
                    ['color' => 'blue', 'title' => 'Requirement Understanding'],
                    ['color' => 'orange', 'title' => 'Plot & Space Evaluation'],
                    ['color' => 'blue', 'title' => 'Layout & Space Planning Guidance'],
                    ['color' => 'orange', 'title' => 'Design Style Consultation'],
                    ['color' => 'blue', 'title' => 'Budget & Feasibility Guidance'],
                    ['color' => 'orange', 'title' => 'Execution Planning Direction'],
                ];
            @endphp

            <div class="bdc-service-grid">
                @foreach($services as $item)
                    <div class="bdc-service-card {{ $item['color'] === 'blue' ? 'blue' : '' }}">{{ $item['title'] }}</div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bdc-section">
        <div class="bdc-container">
            <h2 class="bdc-title">Types of Design Consultation Projects</h2>
            <div class="bdc-line"></div>

            @php
                $projects = [
                    ['color' => 'orange', 'image' => asset('images/logo/bdc1.png'), 'title' => 'Residential Design Consultation', 'alt' => 'Residential design consultation'],
                    ['color' => 'blue', 'image' => asset('images/logo/bdc2.png'), 'title' => 'Farmhouse & Plot Consultation', 'alt' => 'Farmhouse and plot consultation'],
                    ['color' => 'orange', 'image' => asset('images/logo/bdc3.png'), 'title' => 'Commercial Design Consultation', 'alt' => 'Commercial design consultation'],
                    ['color' => 'blue', 'image' => asset('images/logo/bdc4.png'), 'title' => 'Renovation & Interior Consultation', 'alt' => 'Renovation and interior consultation'],
                ];
            @endphp

            <div class="bdc-project-grid">
                @foreach($projects as $project)
                    <img class="bdc-project-image" src="{{ $project['image'] }}" alt="{{ $project['alt'] }}">
                @endforeach
            </div>
        </div>
    </section>

    <section class="bdc-section white">
        <div class="bdc-container">
            <h2 class="bdc-title">Why Basic Design Consultation is Important?</h2>
            <div class="bdc-line"></div>

            <div class="bdc-check-grid">
                <div class="bdc-check">Gives clarity before starting construction</div>
                <div class="bdc-check">Helps avoid planning mistakes</div>
                <div class="bdc-check">Saves time and unnecessary expenses</div>
                <div class="bdc-check">Aligns design with budget</div>
                <div class="bdc-check">Improves project decision-making</div>
            </div>

            <div class="bdc-footer-info">
                <h3>Target Locations We Serve</h3>
                <p>Design Consultation in Navi Mumbai | Design Consultation in Mumbai | Design Consultation in Pune | Design Consultation in Raigad | Design Consultation in Thane</p>
            </div>
        </div>
    </section>

    <section class="bdc-section">
        <div class="bdc-container">
            <h2 class="bdc-title">Frequently Asked Questions (FAQs)</h2>
            <div class="bdc-line"></div>

            <div class="bdc-faq">
                <details>
                    <summary>1. What is included in basic design consultation?</summary>
                    <p>It includes requirement discussion, layout guidance, design direction, space planning suggestions, and feasibility review.</p>
                </details>
                <details>
                    <summary>2. Is consultation useful before buying land?</summary>
                    <p>Yes, it helps you understand plot potential, layout possibilities, and basic planning constraints before making decisions.</p>
                </details>
                <details>
                    <summary>3. Do you provide online consultation?</summary>
                    <p>Online consultation can be arranged depending on your project details and location.</p>
                </details>
                <details>
                    <summary>4. Can I get design ideas during consultation?</summary>
                    <p>Yes, you can get initial design direction, layout suggestions, and practical planning inputs.</p>
                </details>
                <details>
                    <summary>5. Do you provide complete design services after consultation?</summary>
                    <p>Yes, complete design and execution coordination can be taken forward after consultation if required.</p>
                </details>
            </div>
        </div>
    </section>
</div>
@endsection
