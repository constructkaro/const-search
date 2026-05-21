@extends('layouts.app')

@section('meta_title', 'Road & Highway Contractor Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane | ConstructKaro')
@section('meta_description', 'Road and Highway Contractor Services for residential roads, internal roads, industrial roads, highways, asphalt work, concrete roads, drainage, and roadside infrastructure.')
@section('title', 'Road & Highway Contractor Services | ConstructKaro')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@600;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --rh-blue: #0a82d9;
        --rh-orange: #f27a21;
        --rh-bg: #ededed;
        --rh-text: #111;
        --rh-muted: #4b5563;
        --rh-line: #cfd6de;
        --rh-white: #fff;
    }

    body {
        background: var(--rh-bg);
        font-family: "Inter", "Segoe UI", sans-serif;
        color: var(--rh-text);
    }

    .rh-page {
        background: var(--rh-bg);
        padding-bottom: 44px;
    }

    .rh-wrap {
        width: min(1180px, calc(100% - 44px));
        margin: 0 auto;
    }

    .rh-hero {
        min-height: 300px;
        display: flex;
        align-items: center;
        background:
            /* linear-gradient(90deg, rgba(0,0,0,.88) 0%, rgba(0,0,0,.58) 38%, rgba(0,0,0,.08) 100%), */
            url("{{ asset('images/logo/rh1.png') }}") center / cover no-repeat;
    }

    .rh-hero h1 {
        max-width: 650px;
        margin: 0;
        color: #fff;
        font-family: "Manrope", sans-serif;
        font-size: clamp(34px, 4vw, 56px);
        font-weight: 900;
        line-height: 1.08;
    }

    .rh-section {
        padding: 48px 0 0;
    }

    .rh-title {
        margin: 0 0 10px;
        color: #111;
        font-family: "Manrope", sans-serif;
        font-size: clamp(24px, 2.4vw, 34px);
        font-weight: 900;
        line-height: 1.2;
        text-align: center;
    }

    .rh-title.left {
        text-align: left;
    }

    .rh-line {
        width: 76px;
        height: 3px;
        margin: 0 auto 22px;
        border-radius: 999px;
        background: linear-gradient(90deg, var(--rh-orange), var(--rh-blue));
    }

    .rh-copy {
        color: #3f4650;
        font-size: 15px;
        font-weight: 600;
        line-height: 1.7;
    }

    .rh-copy.narrow {
        max-width: 1050px;
        margin: 0 auto;
    }

    .rh-copy p {
        margin: 0 0 12px;
    }

    .rh-chip-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 18px;
        margin-top: 24px;
    }

    .rh-chip {
        min-height: 72px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 14px 16px;
        border: 2px solid var(--rh-blue);
        border-radius: 8px;
        background: #eaf6ff;
        color: #111;
        font-family: "Manrope", sans-serif;
        font-size: 15px;
        font-weight: 900;
        line-height: 1.2;
        text-align: center;
        box-shadow: 0 6px 16px rgba(17,24,39,.08);
    }

    .rh-chip:nth-child(even) {
        border-color: var(--rh-orange);
        background: #fff0e5;
    }

    .rh-number-grid {
        max-width: 980px;
        margin: 28px auto 0;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 28px;
    }

    .rh-number-card {
        min-height: 150px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 32px 18px 20px;
        border: 2px solid var(--rh-orange);
        border-radius: 8px;
        background: #fff0e5;
        color: #111;
        font-size: 13px;
        font-weight: 700;
        line-height: 1.35;
        text-align: center;
    }

    .rh-number-card:nth-child(even) {
        border-color: var(--rh-blue);
        background: #eaf6ff;
    }

    .rh-num {
        min-width: 28px;
        height: 28px;
        position: absolute;
        top: -14px;
        left: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transform: translateX(-50%);
        border-radius: 8px;
        background: var(--rh-orange);
        color: #fff;
        font-family: "Manrope", sans-serif;
        font-weight: 900;
    }

    .rh-number-card:nth-child(even) .rh-num {
        background: var(--rh-blue);
    }

    .rh-number-card strong {
        display: block;
        margin-bottom: 8px;
        font-family: "Manrope", sans-serif;
        font-size: 14px;
        font-weight: 900;
    }

    .rh-project-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-top: 22px;
    }

    .rh-project {
        overflow: hidden;
    }

    .rh-project img {
        width: 100%;
        aspect-ratio: 1.2 / 1;
        display: block;
        object-fit: contain;
        filter: drop-shadow(0 10px 16px rgba(17,24,39,.12));
    }

    .rh-checks {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 18px;
        margin-top: 18px;
        color: #111;
        font-size: 13px;
        font-weight: 800;
        line-height: 1.35;
        text-align: center;
    }

    .rh-process {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 12px;
        margin-top: 20px;
    }

    .rh-step {
        min-height: 62px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
        color: #111;
        font-family: "Manrope", sans-serif;
        font-size: 12px;
        font-weight: 900;
        line-height: 1.15;
        text-align: center;
    }

    .rh-faq-list {
        max-width: 900px;
        margin: 24px auto 0;
        display: grid;
        gap: 12px;
    }

    .rh-faq {
        overflow: hidden;
        border: 1px solid var(--rh-line);
        border-radius: 6px;
        background: var(--rh-white);
        box-shadow: 0 4px 12px rgba(17,24,39,.10);
    }

    .rh-faq button {
        width: 100%;
        min-height: 52px;
        padding: 14px 20px;
        border: 0;
        background: transparent;
        cursor: pointer;
        color: #111;
        font-family: "Manrope", sans-serif;
        font-size: 14px;
        font-weight: 900;
        text-align: left;
    }

    .rh-faq-answer {
        display: none;
        padding: 0 20px 16px;
        color: var(--rh-muted);
        font-size: 14px;
        font-weight: 500;
        line-height: 1.6;
    }

    .rh-faq.open .rh-faq-answer {
        display: block;
    }

    @media (max-width: 980px) {
        .rh-chip-grid,
        .rh-project-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .rh-number-grid,
        .rh-checks,
        .rh-process {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 560px) {
        .rh-wrap {
            width: calc(100% - 24px);
        }

        .rh-hero {
            min-height: 240px;
        }

        .rh-hero h1 {
            font-size: 34px;
        }

        .rh-chip-grid,
        .rh-project-grid,
        .rh-number-grid,
        .rh-checks,
        .rh-process {
            grid-template-columns: 1fr;
        }
    }
</style>

@php
    $scope = [
        'Site preparation & earthwork',
        'Subgrade & base layer preparation',
        'Asphalt & concrete road construction',
        'Drainage & roadside infrastructure',
        'Highway & infrastructure execution',
    ];

    $services = [
        ['title' => 'Road Construction', 'items' => ['Internal roads & society roads', 'Residential & township roads', 'Industrial & warehouse access roads', 'Rural & local infrastructure']],
        ['title' => 'Highway Construction', 'items' => ['Highway widening projects', 'Asphalt & concrete highway work', 'Road strengthening & rehabilitation', 'Surface drainage construction']],
        ['title' => 'Earthwork & Site Preparation', 'items' => ['Excavation & grading', 'Soil compaction & levelling', 'Embankment preparation', 'Site & subgrade preparation']],
        ['title' => 'Base Layer & Pavement Work', 'items' => ['GSB granular sub-base work', 'WMM wet mix macadam laying', 'Bituminous road layers', 'Concrete pavement preparation']],
        ['title' => 'Drainage & Roadside Infrastructure', 'items' => ['Stormwater drainage', 'Culverts & side drains', 'Road marking & signage', 'Kerb stones & shoulder work']],
    ];

    $projects = [
        ['img' => 'images/logo/rh2.png', 'alt' => 'Residential and township roads'],
        ['img' => 'images/logo/rh3.png', 'alt' => 'Industrial and warehouse roads'],
        ['img' => 'images/logo/rh4.png', 'alt' => 'Highway and infrastructure projects'],
        ['img' => 'images/logo/rh5.png', 'alt' => 'Concrete and asphalt road work'],
    ];

    $faqs = [
        ['q' => '1. What types of roads do you construct?', 'a' => 'We help coordinate construction for residential roads, internal roads, industrial access roads, concrete roads, asphalt roads, and highway infrastructure work.'],
        ['q' => '2. Do you provide asphalt and concrete road work?', 'a' => 'Yes. Asphalt, concrete, base layer preparation, subgrade work, and related road construction services can be coordinated.'],
        ['q' => '3. Can you handle earthwork and grading?', 'a' => 'Yes. Road work can include site preparation, excavation, levelling, compaction, and grading support.'],
        ['q' => '4. Do you provide BOQ and estimation support?', 'a' => 'Yes. ConstructKaro can help with BOQ and cost planning support for road and highway contractor requirements.'],
        ['q' => '5. How do you ensure road quality?', 'a' => 'We focus on verified contractors, proper layer execution, material coordination, and structured monitoring during construction.'],
    ];
@endphp

<main class="rh-page">
    <section class="rh-hero">
        <!-- <div class="rh-wrap">
            <h1>Road & Highway<br>Contractor</h1>
        </div> -->
    </section>

    <section class="rh-section">
        <div class="rh-wrap rh-copy narrow">
            <h2 class="rh-title">Road & Highway Contractor Services in Navi Mumbai, Mumbai,<br>Pune, Raigad & Thane</h2>
            <p>Road infrastructure plays a major role in connectivity, transportation, and development. At ConstructKaro, we connect you with experienced and verified Road & Highway Contractors for residential roads, internal roads, industrial roads, highways, and infrastructure development projects.</p>
            <p>From earthwork to asphalt paving, we ensure every road project is executed with proper planning, quality standards, and durable construction methods.</p>
        </div>
    </section>

    <section class="rh-section">
        <div class="rh-wrap">
            <h2 class="rh-title">What Does a Road & Highway Contractor Do?</h2>
            <div class="rh-line"></div>
            <p class="rh-copy">A road and highway contractor handles:</p>

            <div class="rh-chip-grid">
                @foreach($scope as $item)
                    <div class="rh-chip">{{ $item }}</div>
                @endforeach
            </div>

            <p class="rh-copy" style="margin-top: 14px;">These contractors ensure smooth, safe, and long-lasting road development.</p>
        </div>
    </section>

    <section class="rh-section">
        <div class="rh-wrap">
            <h2 class="rh-title">Our Road & Highway Contractor Services Include</h2>
            <div class="rh-line"></div>

            <div class="rh-number-grid">
                @foreach($services as $index => $service)
                    <article class="rh-number-card">
                        <span class="rh-num">{{ $index + 1 }}</span>
                        <div>
                            <strong>{{ $service['title'] }}</strong>
                            @foreach($service['items'] as $item)
                                <div>- {{ $item }}</div>
                            @endforeach
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="rh-section">
        <div class="rh-wrap">
            <h2 class="rh-title">Types of Road & Highway Projects</h2>
            <div class="rh-line"></div>

            <div class="rh-project-grid">
                @foreach($projects as $project)
                    <article class="rh-project">
                        <img src="{{ asset($project['img']) }}" alt="{{ $project['alt'] }}">
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="rh-section">
        <div class="rh-wrap">
            <h2 class="rh-title">Why Choose ConstructKaro?</h2>
            <div class="rh-line"></div>
            <div class="rh-checks">
                <div>✓ Verified road & highway contractors</div>
                <div>✓ Structured project execution</div>
                <div>✓ Earthwork to finishing support</div>
                <div>✓ Quality-focused infrastructure work</div>
                <div>✓ BOQ & cost planning assistance</div>
            </div>
            <p class="rh-copy" style="margin-top: 18px;">We help you execute durable and professionally managed road infrastructure projects.</p>
        </div>
    </section>

    <section class="rh-section">
        <div class="rh-wrap">
            <h2 class="rh-title">Our Execution Process</h2>
            <div class="rh-line"></div>
            <div class="rh-process">
                <div class="rh-step">1. Requirement Discussion</div>
                <div class="rh-step">2. Site Inspection & Survey</div>
                <div class="rh-step">3. BOQ & Planning</div>
                <div class="rh-step">4. Contractor Assignment</div>
                <div class="rh-step">5. Road Construction Execution</div>
                <div class="rh-step">6. Quality Monitoring & Completion</div>
            </div>
        </div>
    </section>

    <section class="rh-section">
        <div class="rh-wrap rh-copy narrow">
            <h2 class="rh-title left">Target Locations We Serve</h2>
            <p>Road Contractor in Navi Mumbai | Highway Contractor in Mumbai | Road Construction Services in Pune | Highway Contractor in Raigad | Road Infrastructure Contractor in Thane</p>
        </div>
    </section>

    <section class="rh-section">
        <div class="rh-wrap">
            <h2 class="rh-title">Frequently Asked Questions (FAQs)</h2>
            <div class="rh-line"></div>

            <div class="rh-faq-list">
                @foreach($faqs as $index => $faq)
                    <article class="rh-faq" id="rh-faq-{{ $index }}">
                        <button type="button" onclick="toggleRoadFaq({{ $index }})">{{ $faq['q'] }}</button>
                        <div class="rh-faq-answer">{{ $faq['a'] }}</div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</main>

<script>
    function toggleRoadFaq(index) {
        const item = document.getElementById('rh-faq-' + index);
        const wasOpen = item.classList.contains('open');

        document.querySelectorAll('.rh-faq').forEach(function (faqItem) {
            faqItem.classList.remove('open');
        });

        if (!wasOpen) {
            item.classList.add('open');
        }
    }
</script>

@endsection
