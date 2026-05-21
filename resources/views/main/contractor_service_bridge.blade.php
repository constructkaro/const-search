@extends('layouts.app')

@section('meta_title', 'Bridge Contractor Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane | ConstructKaro')
@section('meta_description', 'Bridge Contractor Services for road bridges, culverts, industrial access bridges, repair works, strengthening, RCC foundations and bridge infrastructure projects.')
@section('title', 'Bridge Contractor Services | ConstructKaro')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@600;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --bc-blue: #0a82d9;
        --bc-orange: #f27a21;
        --bc-bg: #ededed;
        --bc-text: #111;
        --bc-muted: #4b5563;
        --bc-line: #cfd6de;
        --bc-white: #fff;
    }

    body {
        background: var(--bc-bg);
        font-family: "Inter", "Segoe UI", sans-serif;
        color: var(--bc-text);
    }

    .bc-page {
        background: var(--bc-bg);
        padding-bottom: 44px;
    }

    .bc-wrap {
        width: min(1180px, calc(100% - 44px));
        margin: 0 auto;
    }

    .bc-hero {
        min-height: 300px;
        display: flex;
        align-items: center;
        background:
            /* linear-gradient(90deg, rgba(0,0,0,.88) 0%, rgba(0,0,0,.60) 38%, rgba(0,0,0,.08) 100%), */
            url("{{ asset('images/logo/bc1.png') }}") center / cover no-repeat;
    }

    .bc-hero h1 {
        max-width: 650px;
        margin: 0;
        color: #fff;
        font-family: "Manrope", sans-serif;
        font-size: clamp(34px, 4vw, 56px);
        font-weight: 900;
        line-height: 1.08;
    }

    .bc-section {
        padding: 48px 0 0;
    }

    .bc-title {
        margin: 0 0 10px;
        color: #111;
        font-family: "Manrope", sans-serif;
        font-size: clamp(24px, 2.4vw, 34px);
        font-weight: 900;
        line-height: 1.2;
        text-align: center;
    }

    .bc-title.left {
        text-align: left;
    }

    .bc-line {
        width: 76px;
        height: 3px;
        margin: 0 auto 22px;
        border-radius: 999px;
        background: linear-gradient(90deg, var(--bc-orange), var(--bc-blue));
    }

    .bc-copy {
        color: #3f4650;
        font-size: 15px;
        font-weight: 600;
        line-height: 1.7;
    }

    .bc-copy.narrow {
        max-width: 1050px;
        margin: 0 auto;
    }

    .bc-copy p {
        margin: 0 0 12px;
    }

    .bc-chip-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 18px;
        margin-top: 24px;
    }

    .bc-chip {
        min-height: 72px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 14px 16px;
        border: 2px solid var(--bc-blue);
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

    .bc-chip:nth-child(even) {
        border-color: var(--bc-orange);
        background: #fff0e5;
    }

    .bc-number-grid {
        max-width: 980px;
        margin: 28px auto 0;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 28px;
    }

    .bc-number-card {
        min-height: 150px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 32px 18px 20px;
        border: 2px solid var(--bc-orange);
        border-radius: 8px;
        background: #fff0e5;
        color: #111;
        font-size: 13px;
        font-weight: 700;
        line-height: 1.35;
        text-align: center;
    }

    .bc-number-card:nth-child(even) {
        border-color: var(--bc-blue);
        background: #eaf6ff;
    }

    .bc-num {
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
        background: var(--bc-orange);
        color: #fff;
        font-family: "Manrope", sans-serif;
        font-weight: 900;
    }

    .bc-number-card:nth-child(even) .bc-num {
        background: var(--bc-blue);
    }

    .bc-number-card strong {
        display: block;
        margin-bottom: 8px;
        font-family: "Manrope", sans-serif;
        font-size: 14px;
        font-weight: 900;
    }

    .bc-project-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-top: 22px;
    }

    .bc-project img {
        width: 100%;
        aspect-ratio: 1.2 / 1;
        display: block;
        object-fit: contain;
        filter: drop-shadow(0 10px 16px rgba(17,24,39,.12));
    }

    .bc-checks {
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

    .bc-process {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 12px;
        margin-top: 20px;
    }

    .bc-step {
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

    .bc-faq-list {
        max-width: 900px;
        margin: 24px auto 0;
        display: grid;
        gap: 12px;
    }

    .bc-faq {
        overflow: hidden;
        border: 1px solid var(--bc-line);
        border-radius: 6px;
        background: var(--bc-white);
        box-shadow: 0 4px 12px rgba(17,24,39,.10);
    }

    .bc-faq button {
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

    .bc-faq-answer {
        display: none;
        padding: 0 20px 16px;
        color: var(--bc-muted);
        font-size: 14px;
        font-weight: 500;
        line-height: 1.6;
    }

    .bc-faq.open .bc-faq-answer {
        display: block;
    }

    @media (max-width: 980px) {
        .bc-chip-grid,
        .bc-project-grid,
        .bc-number-grid,
        .bc-checks,
        .bc-process {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 560px) {
        .bc-wrap {
            width: calc(100% - 24px);
        }

        .bc-hero {
            min-height: 240px;
        }

        .bc-hero h1 {
            font-size: 34px;
        }

        .bc-chip-grid,
        .bc-project-grid,
        .bc-number-grid,
        .bc-checks,
        .bc-process {
            grid-template-columns: 1fr;
        }
    }
</style>

@php
    $scope = [
        'Site preparation and foundation work',
        'RCC and steel structure execution',
        'Abutments, piers, approach deck slab work',
        'Culvert and drainage crossing construction',
        'Repair and strengthening of existing bridges',
    ];

    $services = [
        ['title' => 'RCC Bridge Construction', 'items' => ['Road and vehicular bridge construction', 'RCC deck slab construction', 'Pile and open foundation execution', 'Steel support and shuttering work']],
        ['title' => 'Culverts & Drainage Crossings', 'items' => ['Box culvert construction', 'Pipe culvert installation', 'Stormwater road cross-drainage structures', 'Rural and township drainage crossings']],
        ['title' => 'Industrial & Access Bridges', 'items' => ['Factory and warehouse access bridges', 'Heavy vehicle movement structures', 'Internal infrastructure bridges', 'Site access-only solutions']],
        ['title' => 'Bridge Repair & Strengthening', 'items' => ['Crack repair and concrete restoration', 'Bearing setting and expansion work', 'Railing, kerb, and safety works', 'Structural strengthening support']],
        ['title' => 'BOQ, Estimation & Execution Support', 'items' => ['Quantity estimation', 'Material and labour planning', 'Contractor assignment support', 'Site execution coordination']],
    ];

    $projects = [
        ['img' => 'images/logo/bc2.png', 'alt' => 'Road bridge construction'],
        ['img' => 'images/logo/bc3.png', 'alt' => 'Culvert construction'],
        ['img' => 'images/logo/bc4.png', 'alt' => 'Industrial bridge construction'],
        ['img' => 'images/logo/bc5.png', 'alt' => 'Bridge repair projects'],
    ];

    $faqs = [
        ['q' => '1. What types of bridge work do you handle?', 'a' => 'We help coordinate road bridges, culverts, industrial access bridges, drainage crossings, repair works, and strengthening projects.'],
        ['q' => '2. Do you provide culvert construction services?', 'a' => 'Yes. Box culverts, pipe culverts, stormwater drainage crossings, and road-side culvert works can be coordinated.'],
        ['q' => '3. Can you help with bridge repair?', 'a' => 'Yes. Repair support can include concrete restoration, crack repair, railing work, and strengthening coordination.'],
        ['q' => '4. Do you provide BOQ and estimation?', 'a' => 'Yes. BOQ, quantity estimation, material planning, and execution support can be provided.'],
        ['q' => '5. Do you work on industrial access bridges?', 'a' => 'Yes. We support bridge and culvert work for industrial access, warehouse movement, and site infrastructure needs.'],
    ];
@endphp

<main class="bc-page">
    <section class="bc-hero">
        <div class="bc-wrap">
            <h1>Bridge Contractor</h1>
        </div>
    </section>

    <section class="bc-section">
        <div class="bc-wrap bc-copy narrow">
            <h2 class="bc-title">Bridge Contractor Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane</h2>
            <p>Bridges are critical infrastructure projects that require expert planning, structural accuracy, and quality execution. At ConstructKaro, we connect you with verified Bridge Contractors for small bridges, culverts, road crossings, industrial access bridges, and infrastructure development projects.</p>
            <p>From foundation work to deck slab and finishing, we help ensure your bridge project is executed with safety, durability, and technical precision.</p>
        </div>
    </section>

    <section class="bc-section">
        <div class="bc-wrap">
            <h2 class="bc-title">What Does a Bridge Contractor Do?</h2>
            <div class="bc-line"></div>
            <p class="bc-copy">A bridge contractor manages and executes bridge construction works, including:</p>

            <div class="bc-chip-grid">
                @foreach($scope as $item)
                    <div class="bc-chip">{{ $item }}</div>
                @endforeach
            </div>

            <p class="bc-copy" style="margin-top: 14px;">These specialists prepare the land for safe and stable construction.</p>
        </div>
    </section>

    <section class="bc-section">
        <div class="bc-wrap">
            <h2 class="bc-title">Our Bridge Contractor Services Include</h2>
            <div class="bc-line"></div>

            <div class="bc-number-grid">
                @foreach($services as $index => $service)
                    <article class="bc-number-card">
                        <span class="bc-num">{{ $index + 1 }}</span>
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

    <section class="bc-section">
        <div class="bc-wrap">
            <h2 class="bc-title">Types of Bridge Projects</h2>
            <div class="bc-line"></div>

            <div class="bc-project-grid">
                @foreach($projects as $project)
                    <article class="bc-project">
                        <img src="{{ asset($project['img']) }}" alt="{{ $project['alt'] }}">
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bc-section">
        <div class="bc-wrap">
            <h2 class="bc-title">Why Choose ConstructKaro?</h2>
            <div class="bc-line"></div>
            <div class="bc-checks">
                <div>&#10003; Verified bridge & infrastructure contractors</div>
                <div>&#10003; Technical planning & execution support</div>
                <div>&#10003; BOQ and cost estimation guidance</div>
                <div>&#10003; Quality-focused construction process</div>
                <div>&#10003; Suitable for road, industrial and township projects</div>
            </div>
            <p class="bc-copy" style="margin-top: 18px;">We help you execute bridge projects with proper planning, safety, and long-term durability.</p>
        </div>
    </section>

    <section class="bc-section">
        <div class="bc-wrap">
            <h2 class="bc-title">Our Execution Process</h2>
            <div class="bc-line"></div>
            <div class="bc-process">
                <div class="bc-step">1. Requirement Discussion</div>
                <div class="bc-step">2. Site Inspection & Feasibility Check</div>
                <div class="bc-step">3. Drawing / BOQ Review</div>
                <div class="bc-step">4. Contractor Assignment</div>
                <div class="bc-step">5. Bridge Construction Execution</div>
                <div class="bc-step">6. Quality Monitoring & Completion</div>
            </div>
        </div>
    </section>

    <section class="bc-section">
        <div class="bc-wrap bc-copy narrow">
            <h2 class="bc-title left">Target Locations We Serve</h2>
            <p>Bridge Contractor in Navi Mumbai | Bridge Contractor in Mumbai | Bridge Construction Services in Pune | Bridge Contractor in Raigad | Bridge Contractor in Thane</p>
            <p>Also serving Panvel, Kharghar, Karjat, Khopoli, Alibaug and nearby areas.</p>
        </div>
    </section>

    <section class="bc-section">
        <div class="bc-wrap">
            <h2 class="bc-title">Frequently Asked Questions (FAQs)</h2>
            <div class="bc-line"></div>

            <div class="bc-faq-list">
                @foreach($faqs as $index => $faq)
                    <article class="bc-faq" id="bc-faq-{{ $index }}">
                        <button type="button" onclick="toggleBridgeFaq({{ $index }})">{{ $faq['q'] }}</button>
                        <div class="bc-faq-answer">{{ $faq['a'] }}</div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</main>

<script>
    function toggleBridgeFaq(index) {
        const item = document.getElementById('bc-faq-' + index);
        const wasOpen = item.classList.contains('open');

        document.querySelectorAll('.bc-faq').forEach(function (faqItem) {
            faqItem.classList.remove('open');
        });

        if (!wasOpen) {
            item.classList.add('open');
        }
    }
</script>

@endsection
