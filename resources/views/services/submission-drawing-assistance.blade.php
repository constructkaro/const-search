@extends('layouts.app')

@section('title', $service['title'] ?? 'Submission Drawing Assistance Services')

@section('content')
<style>
    .sda-page,
    .sda-page * {
        box-sizing: border-box;
    }

    .sda-page {
        background: #eeeeee;
        color: #20242c;
        font-family: "Poppins", "Segoe UI", sans-serif;
        overflow: hidden;
    }

    .sda-hero {
        position: relative;
        min-height: 360px;
        display: flex;
        align-items: center;
        background: #111;
        overflow: hidden;
    }

    .sda-hero img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .sda-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, rgba(0,0,0,.88), rgba(0,0,0,.58) 44%, rgba(0,0,0,.06));
    }

    .sda-hero-content {
        position: relative;
        z-index: 2;
        width: min(1180px, calc(100% - 36px));
        margin: 0 auto;
    }

    .sda-hero h1 {
        max-width: 740px;
        margin: 0;
        color: #fff;
        font-size: clamp(28px, 4vw, 50px);
        line-height: 1.18;
        font-weight: 900;
        text-shadow: 0 5px 18px rgba(0,0,0,.45);
    }

    .sda-section {
        padding: 48px 0;
        background: #eeeeee;
    }

    .sda-section.white {
        background: #fff;
    }

    .sda-container {
        width: min(1180px, calc(100% - 36px));
        margin: 0 auto;
    }

    .sda-title {
        margin: 0;
        color: #171923;
        font-size: clamp(23px, 3vw, 33px);
        line-height: 1.25;
        font-weight: 900;
        text-align: center;
    }

    .sda-line {
        width: min(560px, 72%);
        height: 4px;
        margin: 13px auto 30px;
        border-radius: 999px;
        background: linear-gradient(90deg, #f27524 0%, #f27524 40%, #1f73b8 100%);
    }

    .sda-copy {
        max-width: 1080px;
        margin: 0 auto;
        color: #4d5562;
        font-size: 17px;
        line-height: 1.75;
        font-weight: 600;
    }

    .sda-copy p {
        margin: 0 0 14px;
    }

    .sda-copy strong {
        color: #20242c;
        font-weight: 900;
    }

    .sda-value-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 22px;
        max-width: 860px;
        margin: 30px auto 0;
    }

    .sda-value {
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

    .sda-value.orange {
        border-color: #f27524;
    }

    .sda-service-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 24px;
        max-width: 1080px;
        margin: 42px auto 0;
    }

    .sda-service-card {
        position: relative;
        min-height: 195px;
        padding: 36px 22px 24px;
        border: 2px solid #f27524;
        border-radius: 8px;
        background: #fff0e4;
        box-shadow: 0 8px 16px rgba(28,44,62,.13);
        text-align: center;
    }

    .sda-service-card.blue {
        border-color: #1f73b8;
        background: #eaf4ff;
    }

    .sda-num {
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

    .sda-service-card.blue .sda-num {
        background: #1f73b8;
    }

    .sda-service-card h3 {
        min-height: 42px;
        margin: 0 0 12px;
        color: #f27524;
        font-size: 16px;
        line-height: 1.25;
        font-weight: 900;
    }

    .sda-service-card.blue h3 {
        color: #1f73b8;
    }

    .sda-service-card p {
        margin: 0;
        color: #343b46;
        font-size: 14px;
        line-height: 1.55;
        font-weight: 600;
    }

    .sda-project-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 26px;
        max-width: 1120px;
        margin: 34px auto 0;
        align-items: start;
    }

    .sda-project-card {
        overflow: hidden;
        border: 2px solid #f27524;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 8px 16px rgba(28,44,62,.14);
    }

    .sda-project-card.blue {
        border-color: #1f73b8;
    }

    .sda-project-card img {
        width: 100%;
        aspect-ratio: 428 / 411;
        display: block;
        object-fit: cover;
    }

    .sda-project-image {
        width: 100%;
        aspect-ratio: 428 / 411;
        display: block;
        object-fit: contain;
        filter: drop-shadow(0 8px 14px rgba(28,44,62,.14));
    }

    .sda-project-label {
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

    .sda-check-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px 38px;
        max-width: 980px;
        margin: 24px auto 0;
    }

    .sda-check {
        color: #252b35;
        font-size: 15px;
        line-height: 1.45;
        font-weight: 800;
    }

    .sda-check::before {
        content: "\2713";
        margin-right: 8px;
        color: #111;
        font-weight: 900;
    }

    .sda-footer-info {
        max-width: 980px;
        margin: 30px auto 0;
        color: #4d5562;
        font-size: 15px;
        line-height: 1.6;
        font-weight: 600;
    }

    .sda-footer-info h3 {
        margin: 0 0 8px;
        color: #171923;
        font-size: 18px;
        font-weight: 900;
    }

    .sda-faq {
        max-width: 1040px;
        margin: 30px auto 0;
        display: grid;
        gap: 12px;
    }

    .sda-faq details {
        border: 1px solid #d8dce2;
        border-radius: 7px;
        background: #fff;
        box-shadow: 0 5px 12px rgba(28,44,62,.08);
    }

    .sda-faq summary {
        cursor: pointer;
        padding: 17px 20px;
        color: #20242c;
        font-size: 15.5px;
        font-weight: 900;
    }

    .sda-faq p {
        margin: 0;
        padding: 0 20px 16px;
        color: #4d5562;
        font-size: 15px;
        line-height: 1.6;
        font-weight: 600;
    }

    @media (max-width: 991px) {
        .sda-value-grid,
        .sda-project-grid,
        .sda-check-grid,
        .sda-service-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 640px) {
        .sda-hero {
            min-height: 290px;
        }

        .sda-section {
            padding: 42px 0;
        }

        .sda-value-grid,
        .sda-service-grid,
        .sda-project-grid,
        .sda-check-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="sda-page">
    <section class="sda-hero">
        <img src="{{ asset('images/logo/bv1.png') }}" alt="Submission drawing assistance services">
        <div class="sda-hero-content">
            <h1>
                Submission Drawing<br>
                Assistance Services in<br>
                Navi Mumbai, Mumbai, Thane,<br>
                Pune &amp; Raigad
            </h1>
        </div>
    </section>

    <section class="sda-section white">
        <div class="sda-container">
            <h2 class="sda-title">Submission Drawing Assistance Services in Navi Mumbai, Mumbai, Pune, Raigad &amp; Thane</h2>
            <div class="sda-line"></div>

            <div class="sda-copy">
                <p>
                    Getting your project approved starts with the right drawings. At <strong>ConstructKaro</strong>, we provide professional <strong>Submission Drawing Assistance</strong> to prepare precise, compliant, and authority-ready drawings for residential, commercial, and plotting projects.
                </p>
                <p>
                    We ensure your drawings meet all local regulations so your approval process becomes faster, smoother, and hassle-free.
                </p>
            </div>
        </div>
    </section>

    <section class="sda-section">
        <div class="sda-container">
            <h2 class="sda-title">What is Submission Drawing Assistance?</h2>
            <div class="sda-line"></div>

            <div class="sda-copy">
                <p>
                    Submission drawing assistance involves preparing technical drawings required for municipal or authority approvals before starting construction.
                </p>
                <p>These drawings are essential to:</p>
            </div>

            <div class="sda-value-grid">
                <div class="sda-value blue">Get building plan approvals</div>
                <div class="sda-value orange">Ensure compliance with local norms</div>
                <div class="sda-value blue">Avoid legal issues &amp; redesign delays</div>
            </div>
        </div>
    </section>

    <section class="sda-section white">
        <div class="sda-container">
            <h2 class="sda-title">Our Submission Drawing Assistance Services Include</h2>
            <div class="sda-line"></div>

            @php
                $services = [
                    ['num' => '1', 'color' => 'orange', 'title' => 'Building Plan Drawings', 'text' => 'Floor plans, site layout, elevation plans, and sectional drawings.'],
                    ['num' => '2', 'color' => 'blue', 'title' => 'Site Layout & Plot Drawings', 'text' => 'Plot boundaries and dimensions, building placement on site, setbacks and access planning.'],
                    ['num' => '3', 'color' => 'orange', 'title' => 'Area Statement & FSI Calculations', 'text' => 'Built-up area calculations, FSI/FAR figures, carpet and usable area details.'],
                    ['num' => '4', 'color' => 'blue', 'title' => 'Compliance-Based Drawings', 'text' => 'Local authority rules, fire safety and ventilation, parking layout, and open space compliance.'],
                    ['num' => '5', 'color' => 'orange', 'title' => 'Plotting & Layout Submission Drawings', 'text' => 'Residential plotting layouts, internal road planning, and open space and amenity layouts.'],
                    ['num' => '6', 'color' => 'blue', 'title' => 'Documentation & Coordination Support', 'text' => 'Required document checklist, drawing revision as per authority comments, and coordination with consultants.'],
                ];
            @endphp

            <div class="sda-service-grid">
                @foreach($services as $item)
                    <div class="sda-service-card {{ $item['color'] === 'blue' ? 'blue' : '' }}">
                        <div class="sda-num">{{ $item['num'] }}</div>
                        <h3>{{ $item['title'] }}</h3>
                        <p>{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="sda-section">
        <div class="sda-container">
            <h2 class="sda-title">Types of Submission Drawing Projects</h2>
            <div class="sda-line"></div>

            @php
                $projects = [
                    ['color' => 'orange', 'image' => asset('images/logo/sd1.png'), 'title' => 'Residential Submission Drawings', 'alt' => 'Residential submission drawings'],
                    ['color' => 'blue', 'image' => asset('images/logo/sd2.png'), 'title' => 'Commercial Submission Drawings', 'alt' => 'Commercial submission drawings'],
                    ['color' => 'orange', 'image' => asset('images/logo/sd3.png'), 'title' => 'Plotting & Layout Submission', 'alt' => 'Plotting and layout submission'],
                    ['color' => 'blue', 'image' => asset('images/logo/sd4.png'), 'title' => 'Renovation & Modification Submission', 'alt' => 'Renovation and modification submission'],
                ];
            @endphp

            <div class="sda-project-grid">
                @foreach($projects as $project)
                    <img class="sda-project-image" src="{{ $project['image'] }}" alt="{{ $project['alt'] }}">
                @endforeach
            </div>
        </div>
    </section>

    <section class="sda-section white">
        <div class="sda-container">
            <h2 class="sda-title">Why Submission Drawing Assistance is Important?</h2>
            <div class="sda-line"></div>

            <div class="sda-check-grid">
                <div class="sda-check">Ensures compliance with local building rules</div>
                <div class="sda-check">Speeds up approval process</div>
                <div class="sda-check">Reduces chances of rejection</div>
                <div class="sda-check">Avoids costly redesigns</div>
                <div class="sda-check">Helps smooth project execution</div>
            </div>

            <div class="sda-footer-info">
                <h3>Target Locations We Serve</h3>
                <p>Submission Drawing Assistance in Navi Mumbai | Submission Drawing Assistance in Mumbai | Submission Drawing Assistance in Pune | Submission Drawing Assistance in Raigad | Submission Drawing Assistance in Thane</p>
            </div>
        </div>
    </section>

    <section class="sda-section">
        <div class="sda-container">
            <h2 class="sda-title">Frequently Asked Questions (FAQs)</h2>
            <div class="sda-line"></div>

            <div class="sda-faq">
                <details>
                    <summary>1. What drawings are included in submission drawings?</summary>
                    <p>Submission drawings can include site plan, floor plans, sections, elevations, area statements, parking layout, and compliance drawings.</p>
                </details>
                <details>
                    <summary>2. Do you provide FSI calculations?</summary>
                    <p>Yes, area statement and FSI/FAR calculation support can be included based on project requirements.</p>
                </details>
                <details>
                    <summary>3. Can you revise drawings based on authority feedback?</summary>
                    <p>Yes, drawing revision support can be coordinated after authority comments or required corrections.</p>
                </details>
                <details>
                    <summary>4. How long does it take to prepare submission drawings?</summary>
                    <p>Timeline depends on project size, site information, drawing scope, and revision requirements.</p>
                </details>
                <details>
                    <summary>5. Do you help with approvals also?</summary>
                    <p>We can coordinate approval support and connect you with suitable professionals based on location and project scope.</p>
                </details>
            </div>
        </div>
    </section>
</div>
@endsection
