@extends('layouts.app')

@section('title', $service['title'] ?? 'Approval Drawing Support Services')

@section('content')
<style>
    .ads-page,
    .ads-page * {
        box-sizing: border-box;
    }

    .ads-page {
        background: #eeeeee;
        color: #20242c;
        font-family: "Poppins", "Segoe UI", sans-serif;
        overflow: hidden;
    }

    .ads-hero {
        position: relative;
        min-height: 360px;
        display: flex;
        align-items: center;
        background: #111;
        overflow: hidden;
    }

    .ads-hero img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .ads-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, rgba(0,0,0,.88), rgba(0,0,0,.58) 44%, rgba(0,0,0,.06));
    }

    .ads-hero-content {
        position: relative;
        z-index: 2;
        width: min(1180px, calc(100% - 36px));
        margin: 0 auto;
    }

    .ads-hero h1 {
        max-width: 720px;
        margin: 0;
        color: #fff;
        font-size: clamp(28px, 4vw, 50px);
        line-height: 1.18;
        font-weight: 900;
        text-shadow: 0 5px 18px rgba(0,0,0,.45);
    }

    .ads-section {
        padding: 48px 0;
        background: #eeeeee;
    }

    .ads-section.white {
        background: #fff;
    }

    .ads-container {
        width: min(1180px, calc(100% - 36px));
        margin: 0 auto;
    }

    .ads-title {
        margin: 0;
        color: #171923;
        font-size: clamp(23px, 3vw, 33px);
        line-height: 1.25;
        font-weight: 900;
        text-align: center;
    }

    .ads-line {
        width: min(560px, 72%);
        height: 4px;
        margin: 13px auto 30px;
        border-radius: 999px;
        background: linear-gradient(90deg, #f27524 0%, #f27524 40%, #1f73b8 100%);
    }

    .ads-copy {
        max-width: 1080px;
        margin: 0 auto;
        color: #4d5562;
        font-size: 17px;
        line-height: 1.75;
        font-weight: 600;
    }

    .ads-copy p {
        margin: 0 0 14px;
    }

    .ads-copy strong {
        color: #20242c;
        font-weight: 900;
    }

    .ads-value-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 22px;
        max-width: 1040px;
        margin: 30px auto 0;
    }

    .ads-value {
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

    .ads-value.orange {
        border-color: #f27524;
    }

    .ads-service-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 24px;
        max-width: 1080px;
        margin: 42px auto 0;
    }

    .ads-service-card {
        position: relative;
        min-height: 195px;
        padding: 36px 22px 24px;
        border: 2px solid #f27524;
        border-radius: 8px;
        background: #fff0e4;
        box-shadow: 0 8px 16px rgba(28,44,62,.13);
        text-align: center;
    }

    .ads-service-card.blue {
        border-color: #1f73b8;
        background: #eaf4ff;
    }

    .ads-num {
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

    .ads-service-card.blue .ads-num {
        background: #1f73b8;
    }

    .ads-service-card h3 {
        min-height: 42px;
        margin: 0 0 12px;
        color: #f27524;
        font-size: 16px;
        line-height: 1.25;
        font-weight: 900;
    }

    .ads-service-card.blue h3 {
        color: #1f73b8;
    }

    .ads-service-card p {
        margin: 0;
        color: #343b46;
        font-size: 14px;
        line-height: 1.55;
        font-weight: 600;
    }

    .ads-project-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 26px;
        max-width: 1120px;
        margin: 34px auto 0;
        align-items: start;
    }

    .ads-project-card {
        overflow: hidden;
        border: 2px solid #f27524;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 8px 16px rgba(28,44,62,.14);
    }

    .ads-project-card.blue {
        border-color: #1f73b8;
    }

    .ads-project-card img {
        width: 100%;
        aspect-ratio: 428 / 411;
        display: block;
        object-fit: cover;
    }

    .ads-project-image {
        width: 100%;
        aspect-ratio: 428 / 411;
        display: block;
        object-fit: contain;
        filter: drop-shadow(0 8px 14px rgba(28,44,62,.14));
    }

    .ads-project-label {
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

    .ads-check-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px 38px;
        max-width: 980px;
        margin: 24px auto 0;
    }

    .ads-check {
        color: #252b35;
        font-size: 15px;
        line-height: 1.45;
        font-weight: 800;
    }

    .ads-check::before {
        content: "\2713";
        margin-right: 8px;
        color: #111;
        font-weight: 900;
    }

    .ads-footer-info {
        max-width: 980px;
        margin: 30px auto 0;
        color: #4d5562;
        font-size: 15px;
        line-height: 1.6;
        font-weight: 600;
    }

    .ads-footer-info h3 {
        margin: 0 0 8px;
        color: #171923;
        font-size: 18px;
        font-weight: 900;
    }

    .ads-faq {
        max-width: 1040px;
        margin: 30px auto 0;
        display: grid;
        gap: 12px;
    }

    .ads-faq details {
        border: 1px solid #d8dce2;
        border-radius: 7px;
        background: #fff;
        box-shadow: 0 5px 12px rgba(28,44,62,.08);
    }

    .ads-faq summary {
        cursor: pointer;
        padding: 17px 20px;
        color: #20242c;
        font-size: 15.5px;
        font-weight: 900;
    }

    .ads-faq p {
        margin: 0;
        padding: 0 20px 16px;
        color: #4d5562;
        font-size: 15px;
        line-height: 1.6;
        font-weight: 600;
    }

    @media (max-width: 991px) {
        .ads-value-grid,
        .ads-project-grid,
        .ads-check-grid,
        .ads-service-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 640px) {
        .ads-hero {
            min-height: 290px;
        }

        .ads-section {
            padding: 42px 0;
        }

        .ads-value-grid,
        .ads-service-grid,
        .ads-project-grid,
        .ads-check-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="ads-page">
    <section class="ads-hero">
        <img src="{{ asset('images/logo/bv1.png') }}" alt="Approval drawing support services">
        <div class="ads-hero-content">
            <h1>
                Approval drawing support Services in<br>
                Navi Mumbai, Mumbai, Thane,<br>
                Pune &amp; Raigad
            </h1>
        </div>
    </section>

    <section class="ads-section white">
        <div class="ads-container">
            <h2 class="ads-title">Approval Drawing Support Services in Navi Mumbai, Mumbai, Pune, Raigad &amp; Thane</h2>
            <div class="ads-line"></div>

            <div class="ads-copy">
                <p>
                    Planning to start construction but stuck with approvals? At <strong>ConstructKaro</strong>, we provide professional <strong>Approval Drawing Support Services</strong> to help you prepare accurate drawings and navigate the approval process smoothly.
                </p>
                <p>
                    From municipal submissions to layout compliance, we ensure your project meets all required norms so you can start construction without delays or legal issues.
                </p>
            </div>
        </div>
    </section>

    <section class="ads-section">
        <div class="ads-container">
            <h2 class="ads-title">What is Approval Drawing Support?</h2>
            <div class="ads-line"></div>

            <div class="ads-copy">
                <p>
                    <strong>Approval drawing support</strong> involves preparing and coordinating technical drawings required for government approvals before construction begins.
                </p>
                <p>It includes:</p>
            </div>

            <div class="ads-value-grid">
                <div class="ads-value blue">Submission drawings preparation</div>
                <div class="ads-value orange">Compliance with local building rules</div>
                <div class="ads-value blue">Coordination with architects &amp; consultants</div>
                <div class="ads-value orange">Approval process guidance</div>
            </div>
        </div>
    </section>

    <section class="ads-section white">
        <div class="ads-container">
            <h2 class="ads-title">Our Approval Drawing Support Services Include</h2>
            <div class="ads-line"></div>

            @php
                $services = [
                    ['num' => '1', 'color' => 'orange', 'title' => 'Submission Drawings Preparation', 'text' => 'Building plan drawings, floor plans, elevations, sections, site layout, parking layout, and basic documentation.'],
                    ['num' => '2', 'color' => 'blue', 'title' => 'Municipal & Authority Compliance', 'text' => 'Local authority norms, FSI rules, height regulation, open space compliance, and area calculations.'],
                    ['num' => '3', 'color' => 'orange', 'title' => 'Layout & Plot Approval Support', 'text' => 'Plotting layout approval drawings, road and infrastructure layout plans, and township planning submissions.'],
                    ['num' => '4', 'color' => 'blue', 'title' => 'Coordination with Professionals', 'text' => 'Architectural and structural consultant support and documentation alignment for approval.'],
                    ['num' => '5', 'color' => 'orange', 'title' => 'Documentation & Process Guidance', 'text' => 'Required document checklist, approval process step-by-step guidance, and liaison support if required.'],
                    ['num' => '6', 'color' => 'blue', 'title' => 'Execution Strategy & Support', 'text' => 'Step-by-step construction plan, contractor selection support, and timeline and work sequencing.'],
                ];
            @endphp

            <div class="ads-service-grid">
                @foreach($services as $item)
                    <div class="ads-service-card {{ $item['color'] === 'blue' ? 'blue' : '' }}">
                        <div class="ads-num">{{ $item['num'] }}</div>
                        <h3>{{ $item['title'] }}</h3>
                        <p>{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="ads-section">
        <div class="ads-container">
            <h2 class="ads-title">Types of Approval Drawing Projects</h2>
            <div class="ads-line"></div>

            @php
                $projects = [
                    ['color' => 'orange', 'image' => asset('images/logo/rp1.png'), 'title' => 'Residential Building Approvals', 'alt' => 'Residential building approvals'],
                    ['color' => 'blue', 'image' => asset('images/logo/rp2.png'), 'title' => 'Commercial Project Approvals', 'alt' => 'Commercial project approvals'],
                    ['color' => 'orange', 'image' => asset('images/logo/pd6.png'), 'title' => 'Plotting & Layout Approvals', 'alt' => 'Plotting and layout approvals'],
                    ['color' => 'blue', 'image' => asset('images/logo/rp3.png'), 'title' => 'Renovation & Modification Approvals', 'alt' => 'Renovation and modification approvals'],
                ];
            @endphp

            <div class="ads-project-grid">
                @foreach($projects as $project)
                    <img class="ads-project-image" src="{{ $project['image'] }}" alt="{{ $project['alt'] }}">
                @endforeach
            </div>
        </div>
    </section>

    <section class="ads-section white">
        <div class="ads-container">
            <h2 class="ads-title">Why Approval Drawing Support is Important?</h2>
            <div class="ads-line"></div>

            <div class="ads-check-grid">
                <div class="ads-check">Ensures legal compliance before construction</div>
                <div class="ads-check">Avoids project delays &amp; penalties</div>
                <div class="ads-check">Helps smooth approval process</div>
                <div class="ads-check">Prevents design changes during execution</div>
                <div class="ads-check">Builds confidence for investment</div>
            </div>

            <div class="ads-footer-info">
                <h3>Target Locations We Serve</h3>
                <p>Approval Drawing Support in Navi Mumbai | Approval Drawing Support in Mumbai | Approval Drawing Support in Pune | Approval Drawing Support in Raigad | Approval Drawing Support in Thane</p>
            </div>
        </div>
    </section>

    <section class="ads-section">
        <div class="ads-container">
            <h2 class="ads-title">Frequently Asked Questions (FAQs)</h2>
            <div class="ads-line"></div>

            <div class="ads-faq">
                <details>
                    <summary>1. What drawings are required for approval?</summary>
                    <p>Requirements can include site plan, floor plans, elevation, sections, parking layout, area statements, and supporting documents based on local rules.</p>
                </details>
                <details>
                    <summary>2. Can you help with municipal approvals?</summary>
                    <p>Yes, we can help prepare drawings and coordinate with suitable professionals for the municipal approval process.</p>
                </details>
                <details>
                    <summary>3. Do you handle plotting layout approvals?</summary>
                    <p>Yes, plotting and layout approval support can be provided depending on land details and local authority requirements.</p>
                </details>
                <details>
                    <summary>4. How long does approval drawing preparation take?</summary>
                    <p>Timeline depends on project size, available site details, drawing scope, and number of revisions.</p>
                </details>
                <details>
                    <summary>5. Do you provide liaison support?</summary>
                    <p>Liaison and consultant coordination support can be arranged depending on project location and requirement.</p>
                </details>
            </div>
        </div>
    </section>
</div>
@endsection
