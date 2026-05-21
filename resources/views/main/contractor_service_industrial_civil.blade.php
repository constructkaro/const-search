@extends('layouts.app')

@section('meta_title', 'Industrial Civil Contractor Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane | ConstructKaro')
@section('meta_description', 'Industrial Civil Contractor Services for factory buildings, warehouses, industrial sheds, RCC work, foundations, utilities and infrastructure development.')
@section('title', 'Industrial Civil Contractor Services | ConstructKaro')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@600;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --ic-blue: #0a82d9;
        --ic-orange: #f27a21;
        --ic-bg: #ededed;
        --ic-text: #111;
        --ic-muted: #4b5563;
        --ic-line: #cfd6de;
        --ic-white: #fff;
    }

    body {
        background: var(--ic-bg);
        font-family: "Inter", "Segoe UI", sans-serif;
        color: var(--ic-text);
    }

    .ic-page {
        background: var(--ic-bg);
        padding-bottom: 44px;
    }

    .ic-wrap {
        width: min(1180px, calc(100% - 44px));
        margin: 0 auto;
    }

    .ic-hero {
        min-height: 300px;
        display: flex;
        align-items: center;
        background:
            /* linear-gradient(90deg, rgba(0,0,0,.84) 0%, rgba(0,0,0,.50) 38%, rgba(0,0,0,.08) 100%), */
            url("{{ asset('images/logo/ic1.png') }}") center / cover no-repeat;
    }

    .ic-hero h1 {
        max-width: 660px;
        margin: 0;
        color: #fff;
        font-family: "Manrope", sans-serif;
        font-size: clamp(34px, 4vw, 58px);
        font-weight: 900;
        line-height: 1.05;
    }

    .ic-section {
        padding: 44px 0 0;
    }

    .ic-title {
        margin: 0 0 10px;
        color: #111;
        font-family: "Manrope", sans-serif;
        font-size: clamp(24px, 2.4vw, 34px);
        font-weight: 900;
        line-height: 1.2;
        text-align: center;
    }

    .ic-title.left {
        text-align: left;
    }

    .ic-line {
        width: 76px;
        height: 3px;
        margin: 0 auto 22px;
        border-radius: 999px;
        background: linear-gradient(90deg, var(--ic-orange), var(--ic-blue));
    }

    .ic-copy {
        color: #3f4650;
        font-size: 15px;
        font-weight: 600;
        line-height: 1.7;
    }

    .ic-copy.narrow {
        max-width: 1050px;
        margin: 0 auto;
    }

    .ic-copy p {
        margin: 0 0 12px;
    }

    .ic-chip-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 18px;
        margin-top: 24px;
    }

    .ic-chip {
        min-height: 72px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 14px 16px;
        border: 2px solid var(--ic-blue);
        border-radius: 8px;
        background: #eaf6ff;
        color: #111;
        font-family: "Manrope", sans-serif;
        font-size: 14px;
        font-weight: 900;
        line-height: 1.2;
        text-align: center;
        box-shadow: 0 6px 16px rgba(17,24,39,.08);
    }

    .ic-chip:nth-child(even) {
        border-color: var(--ic-orange);
        background: #fff0e5;
    }

    .ic-number-grid {
        max-width: 980px;
        margin: 28px auto 0;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 28px;
    }

    .ic-number-card {
        min-height: 150px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 32px 18px 20px;
        border: 2px solid var(--ic-orange);
        border-radius: 8px;
        background: #fff0e5;
        color: #111;
        font-size: 13px;
        font-weight: 700;
        line-height: 1.35;
        text-align: center;
    }

    .ic-number-card:nth-child(even) {
        border-color: var(--ic-blue);
        background: #eaf6ff;
    }

    .ic-num {
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
        background: var(--ic-orange);
        color: #fff;
        font-family: "Manrope", sans-serif;
        font-weight: 900;
    }

    .ic-number-card:nth-child(even) .ic-num {
        background: var(--ic-blue);
    }

    .ic-number-card strong {
        display: block;
        margin-bottom: 8px;
        font-family: "Manrope", sans-serif;
        font-size: 14px;
        font-weight: 900;
    }

    .ic-project-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-top: 22px;
    }

    .ic-project {
        overflow: hidden;
        border: 2px solid var(--ic-blue);
        border-radius: 8px;
        background: #eaf6ff;
        box-shadow: 0 6px 16px rgba(17,24,39,.10);
    }

    .ic-project:nth-child(odd) {
        border-color: var(--ic-orange);
        background: #fff0e5;
    }

    .ic-project img {
        width: 100%;
        aspect-ratio: 1.25 / 1;
        display: block;
        object-fit: cover;
    }

    .ic-project h3 {
        min-height: 48px;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 8px;
        color: #111;
        font-family: "Manrope", sans-serif;
        font-size: 13px;
        font-weight: 900;
        line-height: 1.15;
        text-align: center;
    }

    .ic-checks {
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

    .ic-process {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 12px;
        margin-top: 20px;
    }

    .ic-step {
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

    .ic-faq-list {
        max-width: 900px;
        margin: 24px auto 0;
        display: grid;
        gap: 12px;
    }

    .ic-faq {
        overflow: hidden;
        border: 1px solid var(--ic-line);
        border-radius: 6px;
        background: var(--ic-white);
        box-shadow: 0 4px 12px rgba(17,24,39,.10);
    }

    .ic-faq button {
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

    .ic-faq-answer {
        display: none;
        padding: 0 20px 16px;
        color: var(--ic-muted);
        font-size: 14px;
        font-weight: 500;
        line-height: 1.6;
    }

    .ic-faq.open .ic-faq-answer {
        display: block;
    }

    @media (max-width: 980px) {
        .ic-chip-grid,
        .ic-project-grid,
        .ic-number-grid,
        .ic-checks,
        .ic-process {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 560px) {
        .ic-wrap {
            width: calc(100% - 24px);
        }

        .ic-hero {
            min-height: 240px;
        }

        .ic-hero h1 {
            font-size: 34px;
        }

        .ic-chip-grid,
        .ic-project-grid,
        .ic-number-grid,
        .ic-checks,
        .ic-process {
            grid-template-columns: 1fr;
        }
    }
</style>

@php
    $scope = [
        'Industrial RCC structures',
        'Factory & warehouse construction',
        'Earthwork & foundation work',
        'Industrial flooring & drainage systems',
        'Infrastructure & utility development',
    ];

    $services = [
        ['title' => 'Factory & Industrial Building Construction', 'items' => ['RCC industrial structures', 'Warehouse and production areas', 'Industrial utility coordination', 'Safety-first execution process']],
        ['title' => 'Warehouse & Logistics Infrastructure', 'items' => ['Warehouse civil works', 'Logistics yard development', 'Loading and unloading areas', 'Heavy-duty industrial flooring']],
        ['title' => 'Industrial Shed Construction', 'items' => ['MS and steel shed execution', 'Industrial roofing systems', 'Foundation and plinth work', 'Utility and service area development']],
        ['title' => 'Earthwork & Foundation Services', 'items' => ['Site grading and leveling', 'Heavy excavation and foundation work', 'Soil compaction and development preparation', 'Machine foundation construction']],
        ['title' => 'Industrial Infrastructure Work', 'items' => ['Internal roads and drainage systems', 'Water and utility line support', 'Compound and access works', 'Safety and service integration work']],
    ];

    $projects = [
        ['title' => 'Factory Construction Projects', 'img' => 'images/logo/ic2.png'],
        ['title' => 'Warehouse & Logistics Projects', 'img' => 'images/logo/ic3.png'],
        ['title' => 'Industrial Shed & PEB Projects', 'img' => 'images/logo/ic4.png'],
        ['title' => 'Industrial Infrastructure Development', 'img' => 'images/logo/ic5.png'],
    ];

    $faqs = [
        ['q' => '1. What types of industrial civil projects do you handle?', 'a' => 'We support factory buildings, warehouses, logistics facilities, industrial sheds, RCC structures, foundations, roads, drainage, flooring and utility development work.'],
        ['q' => '2. Do you provide industrial shed construction?', 'a' => 'Yes. We can coordinate industrial shed construction including steel structure work, foundations, roofing, flooring and utility support.'],
        ['q' => '3. Can you handle warehouse and logistics projects?', 'a' => 'Yes. We help with warehouse civil work, loading areas, heavy-duty flooring, internal roads and logistics infrastructure execution.'],
        ['q' => '4. Do you provide BOQ and estimation support?', 'a' => 'Yes. BOQ, quantity estimation, cost planning and contractor assignment support can be provided for industrial civil projects.'],
        ['q' => '5. How do you ensure safety and quality?', 'a' => 'We work through verified contractors, structured execution planning, quality monitoring, BOQ-based scope control and stage-wise coordination.'],
    ];
@endphp

<main class="ic-page">
    <section class="ic-hero">
        <div class="ic-wrap">
            <!-- <h1>Industrial Civil<br>Contractor</h1> -->
        </div>
    </section>

    <section class="ic-section">
        <div class="ic-wrap ic-copy narrow">
            <h2 class="ic-title">Industrial Civil Contractor Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane</h2>
            <p>Industrial projects require strong infrastructure, precise execution, and experienced contractors to ensure smooth operations and long-term durability. At ConstructKaro, we connect you with verified and experienced Industrial Civil Contractors for factories, warehouses, industrial sheds, logistics parks, and infrastructure projects.</p>
            <p>From site development to RCC structures and industrial flooring, we help ensure every project is executed with quality, safety, and proper planning.</p>
        </div>
    </section>

    <section class="ic-section">
        <div class="ic-wrap">
            <h2 class="ic-title">What Does an Industrial Civil Contractor Do?</h2>
            <div class="ic-line"></div>
            <p class="ic-copy">An industrial civil contractor manages and executes:</p>

            <div class="ic-chip-grid">
                @foreach($scope as $item)
                    <div class="ic-chip">{{ $item }}</div>
                @endforeach
            </div>

            <p class="ic-copy" style="margin-top: 14px;">These contractors ensure industrial facilities are structurally strong, functional, and execution-ready.</p>
        </div>
    </section>

    <section class="ic-section">
        <div class="ic-wrap">
            <h2 class="ic-title">Our Industrial Civil Contractor Services Include</h2>
            <div class="ic-line"></div>

            <div class="ic-number-grid">
                @foreach($services as $index => $service)
                    <article class="ic-number-card">
                        <span class="ic-num">{{ $index + 1 }}</span>
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

    <section class="ic-section">
        <div class="ic-wrap">
            <h2 class="ic-title">Types of Industrial Civil Projects</h2>
            <div class="ic-line"></div>

            <div class="ic-project-grid">
                @foreach($projects as $project)
                    <!-- <article class="ic-project"> -->
                        <img src="{{ asset($project['img']) }}" alt="{{ $project['title'] }}">
                        <!-- <h3>{{ $project['title'] }}</h3> -->
                    <!-- </article> -->
                @endforeach
            </div>
        </div>
    </section>

    <section class="ic-section">
        <div class="ic-wrap">
            <h2 class="ic-title">Why Choose ConstructKaro?</h2>
            <div class="ic-line"></div>
            <div class="ic-checks">
                <div>&#10003; Verified industrial civil contractors</div>
                <div>&#10003; Structured project execution process</div>
                <div>&#10003; BOQ and cost estimation support</div>
                <div>&#10003; Quality-focused industrial construction</div>
                <div>&#10003; Single platform coordination</div>
            </div>
            <p class="ic-copy" style="margin-top: 18px;">We help businesses execute projects with better planning, transparency, and professional support.</p>
        </div>
    </section>

    <section class="ic-section">
        <div class="ic-wrap">
            <h2 class="ic-title">Our Execution Process</h2>
            <div class="ic-line"></div>
            <div class="ic-process">
                <div class="ic-step">1. Requirement Discussion</div>
                <div class="ic-step">2. Drawing & BOQ Review</div>
                <div class="ic-step">3. Contractor Assignment</div>
                <div class="ic-step">4. Industrial Civil Construction Execution</div>
                <div class="ic-step">5. Quality Monitoring</div>
                <div class="ic-step">6. Project Completion & Handover</div>
            </div>
        </div>
    </section>

    <section class="ic-section">
        <div class="ic-wrap ic-copy narrow">
            <h2 class="ic-title left">Target Locations We Serve</h2>
            <p>Industrial Civil Contractor in Navi Mumbai | Industrial Civil Contractor in Mumbai | Industrial Civil Services in Pune | Industrial Contractor in Raigad | Factory & Warehouse Contractor in Thane</p>
        </div>
    </section>

    <section class="ic-section">
        <div class="ic-wrap">
            <h2 class="ic-title">Frequently Asked Questions (FAQs)</h2>
            <div class="ic-line"></div>

            <div class="ic-faq-list">
                @foreach($faqs as $index => $faq)
                    <article class="ic-faq" id="ic-faq-{{ $index }}">
                        <button type="button" onclick="toggleIndustrialCivilFaq({{ $index }})">{{ $faq['q'] }}</button>
                        <div class="ic-faq-answer">{{ $faq['a'] }}</div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</main>

<script>
    function toggleIndustrialCivilFaq(index) {
        const item = document.getElementById('ic-faq-' + index);
        const wasOpen = item.classList.contains('open');

        document.querySelectorAll('.ic-faq').forEach(function (faqItem) {
            faqItem.classList.remove('open');
        });

        if (!wasOpen) {
            item.classList.add('open');
        }
    }
</script>

@endsection
