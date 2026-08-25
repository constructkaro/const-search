@extends('layouts.app')

@section('meta_title', 'Culverts Contractor Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane | ConstructKaro')
@section('meta_description', 'Culverts Contractor Services for box culverts, pipe culverts, road crossings, drainage crossings, foundations, repair and maintenance works.')
@section('title', 'Culverts Contractor Services | ConstructKaro')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@600;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --cc-blue: #0a82d9;
        --cc-orange: #f27a21;
        --cc-bg: #ededed;
        --cc-text: #111;
        --cc-muted: #4b5563;
        --cc-line: #cfd6de;
        --cc-white: #fff;
    }

    body {
        background: var(--cc-bg);
        font-family: "Inter", "Segoe UI", sans-serif;
        color: var(--cc-text);
    }

    .cc-page {
        background: var(--cc-bg);
        padding-bottom: 44px;
    }

    .cc-wrap {
        width: min(1180px, calc(100% - 44px));
        margin: 0 auto;
    }

    .cc-hero {
        min-height: 300px;
        display: flex;
        align-items: center;
        background:
            /* linear-gradient(90deg, rgba(0,0,0,.84) 0%, rgba(0,0,0,.50) 34%, rgba(0,0,0,.08) 100%), */
            url("{{ asset('images/logo/cc5.png') }}") center / cover no-repeat;
    }

    .cc-hero h1 {
        max-width: 640px;
        margin: 0;
        color: #fff;
        font-family: "Manrope", sans-serif;
        font-size: clamp(34px, 4vw, 58px);
        font-weight: 900;
        line-height: 1.05;
    }

    .cc-section {
        padding: 44px 0 0;
    }

    .cc-title {
        margin: 0 0 10px;
        color: #111;
        font-family: "Manrope", sans-serif;
        font-size: clamp(24px, 2.4vw, 34px);
        font-weight: 900;
        line-height: 1.2;
        text-align: center;
    }

    .cc-title.left {
        text-align: left;
    }

    .cc-line {
        width: 76px;
        height: 3px;
        margin: 0 auto 22px;
        border-radius: 999px;
        background: linear-gradient(90deg, var(--cc-orange), var(--cc-blue));
    }

    .cc-copy {
        color: #3f4650;
        font-size: 15px;
        font-weight: 600;
        line-height: 1.7;
    }

    .cc-copy.narrow {
        max-width: 1050px;
        margin: 0 auto;
    }

    .cc-copy p {
        margin: 0 0 12px;
    }

    .cc-chip-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 18px;
        margin-top: 24px;
    }

    .cc-chip {
        min-height: 72px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 14px 16px;
        border: 2px solid var(--cc-blue);
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

    .cc-chip:nth-child(even) {
        border-color: var(--cc-orange);
        background: #fff0e5;
    }

    .cc-number-grid {
        max-width: 980px;
        margin: 28px auto 0;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 28px;
    }

    .cc-number-card {
        min-height: 150px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 32px 18px 20px;
        border: 2px solid var(--cc-orange);
        border-radius: 8px;
        background: #fff0e5;
        color: #111;
        font-size: 13px;
        font-weight: 700;
        line-height: 1.35;
        text-align: center;
    }

    .cc-number-card:nth-child(even) {
        border-color: var(--cc-blue);
        background: #eaf6ff;
    }

    .cc-num {
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
        background: var(--cc-orange);
        color: #fff;
        font-family: "Manrope", sans-serif;
        font-weight: 900;
    }

    .cc-number-card:nth-child(even) .cc-num {
        background: var(--cc-blue);
    }

    .cc-number-card strong {
        display: block;
        margin-bottom: 8px;
        font-family: "Manrope", sans-serif;
        font-size: 14px;
        font-weight: 900;
    }

    .cc-project-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-top: 22px;
    }

    .cc-project {
        overflow: hidden;
        border: 2px solid var(--cc-blue);
        border-radius: 8px;
        background: #eaf6ff;
        box-shadow: 0 6px 16px rgba(17,24,39,.10);
    }

    .cc-project:nth-child(odd) {
        border-color: var(--cc-orange);
        background: #fff0e5;
    }

    .cc-project img {
        width: 100%;
        aspect-ratio: 1.25 / 1;
        display: block;
        object-fit: cover;
    }

    .cc-checks {
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

    .cc-process {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 12px;
        margin-top: 20px;
    }

    .cc-step {
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

    .cc-faq-list {
        max-width: 900px;
        margin: 24px auto 0;
        display: grid;
        gap: 12px;
    }

    .cc-faq {
        overflow: hidden;
        border: 1px solid var(--cc-line);
        border-radius: 6px;
        background: var(--cc-white);
        box-shadow: 0 4px 12px rgba(17,24,39,.10);
    }

    .cc-faq button {
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

    .cc-faq-answer {
        display: none;
        padding: 0 20px 16px;
        color: var(--cc-muted);
        font-size: 14px;
        font-weight: 500;
        line-height: 1.6;
    }

    .cc-faq.open .cc-faq-answer {
        display: block;
    }

    @media (max-width: 980px) {
        .cc-chip-grid,
        .cc-project-grid,
        .cc-number-grid,
        .cc-checks,
        .cc-process {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 560px) {
        .cc-wrap {
            width: calc(100% - 24px);
        }

        .cc-hero {
            min-height: 240px;
        }

        .cc-hero h1 {
            font-size: 34px;
        }

        .cc-chip-grid,
        .cc-project-grid,
        .cc-number-grid,
        .cc-checks,
        .cc-process {
            grid-template-columns: 1fr;
        }
    }
</style>

@php
    $scope = [
        'Drainage crossing construction',
        'RCC box culvert execution',
        'Pipe culvert installation',
        'Earthwork & foundation preparation',
        'Road connectivity & water flow management',
    ];

    $services = [
        ['title' => 'Box Culvert Construction', 'items' => ['RCC box section work', 'Single and multi-cell culverts', 'Road crossing structures', 'Drainage and highway infrastructure projects']],
        ['title' => 'Pipe Culvert Installation', 'items' => ['Precast pipe culverts', 'Water flow systems', 'Stormwater roadway solutions', 'Rural and township projects']],
        ['title' => 'Earthwork & Foundation Preparation', 'items' => ['Excavation and trenching', 'Base preparation and bedding', 'RCC and steel foundation work', 'Backfilling and compaction execution']],
        ['title' => 'Road & Drainage Integration', 'items' => ['Culvert connection with drains', 'Side drains and approach matching', 'Water flow management guidance', 'Surface reinstatement support']],
        ['title' => 'Repair & Maintenance Work', 'items' => ['Culvert repair and strengthening', 'Crack repair and waterproofing', 'Structural maintenance services', 'Drainage blockage solutions']],
    ];

    $projects = [
        ['title' => 'Road Culvert Construction', 'img' => 'images/logo/cc1.png'],
        ['title' => 'Pipe Culvert Projects', 'img' => 'images/logo/cc2.png'],
        ['title' => 'Industrial & Township Culverts', 'img' => 'images/logo/cc3.png'],
        ['title' => 'Repair & Maintenance Projects', 'img' => 'images/logo/cc4.png'],
    ];

    $faqs = [
        ['q' => '1. What types of culverts do you construct?', 'a' => 'We help with RCC box culverts, pipe culverts, drainage crossings, road culverts, township culverts and industrial access culvert work.'],
        ['q' => '2. Do you provide culvert repair services?', 'a' => 'Yes. Culvert repair, crack treatment, waterproofing, strengthening and drainage blockage solutions can be coordinated.'],
        ['q' => '3. Can you handle township and industrial culvert projects?', 'a' => 'Yes. Contractors can be matched for township roads, industrial access roads, factory sites and internal infrastructure requirements.'],
        ['q' => '4. Do you provide BOQ and estimation support?', 'a' => 'Yes. We can support BOQ, quantity estimation, material planning and contractor assignment for culvert projects.'],
        ['q' => '5. How do you ensure durability?', 'a' => 'Durability is supported through proper foundation preparation, RCC execution, drainage flow planning, compaction and quality monitoring.'],
    ];
@endphp

<main class="cc-page">
    <section class="cc-hero">
        <div class="cc-wrap">
        <h1 class="ck-visually-hidden">Culverts Contractor</h1>
        </div>
    </section>

    <section class="cc-section">
        <div class="cc-wrap cc-copy narrow">
            <h2 class="cc-title">Culverts Contractor Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane</h2>
            <p>Culverts are essential for smooth water flow, road connectivity, and long-lasting infrastructure development. At ConstructKaro, we connect you with experienced and verified Culverts Contractors for road crossings, drainage systems, township infrastructure, industrial projects, and highway works.</p>
            <p>From excavation to RCC construction and finishing, we help ensure every culvert project is executed with proper engineering standards, durability, and safety.</p>
        </div>
    </section>

    <section class="cc-section">
        <div class="cc-wrap">
            <h2 class="cc-title">What Does a Culverts Contractor Do?</h2>
            <div class="cc-line"></div>
            <p class="cc-copy">A culverts contractor handles:</p>

            <div class="cc-chip-grid">
                @foreach($scope as $item)
                    <div class="cc-chip">{{ $item }}</div>
                @endforeach
            </div>

            <p class="cc-copy" style="margin-top: 14px;">These structures help safely pass water beneath roads, highways, and access routes.</p>
        </div>
    </section>

    <section class="cc-section">
        <div class="cc-wrap">
            <h2 class="cc-title">Our Culverts Contractor Services Include</h2>
            <div class="cc-line"></div>

            <div class="cc-number-grid">
                @foreach($services as $index => $service)
                    <article class="cc-number-card">
                        <span class="cc-num">{{ $index + 1 }}</span>
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

    <section class="cc-section">
        <div class="cc-wrap">
            <h2 class="cc-title">Types of Culvert Projects</h2>
            <div class="cc-line"></div>

            <div class="cc-project-grid">
                @foreach($projects as $project)
                    <!-- <article class="cc-project"> -->
                        <img src="{{ asset($project['img']) }}" alt="{{ $project['title'] }}">
                    <!-- </article> -->
                @endforeach
            </div>
        </div>
    </section>

    <section class="cc-section">
        <div class="cc-wrap">
            <h2 class="cc-title">Why Choose ConstructKaro?</h2>
            <div class="cc-line"></div>
            <div class="cc-checks">
                <div>&#10003; Verified culvert contractors</div>
                <div>&#10003; Structured infrastructure execution</div>
                <div>&#10003; RCC and drainage expertise</div>
                <div>&#10003; BOQ and cost estimation support</div>
                <div>&#10003; Suitable for road and industrial projects</div>
            </div>
            <p class="cc-copy" style="margin-top: 18px;">We help ensure your culvert projects are technically strong, durable, and properly executed.</p>
        </div>
    </section>

    <section class="cc-section">
        <div class="cc-wrap">
            <h2 class="cc-title">Our Execution Process</h2>
            <div class="cc-line"></div>
            <div class="cc-process">
                <div class="cc-step">1. Requirement Discussion</div>
                <div class="cc-step">2. Site Inspection & Survey</div>
                <div class="cc-step">3. BOQ & Planning</div>
                <div class="cc-step">4. Contractor Assignment</div>
                <div class="cc-step">5. Culvert Construction Execution</div>
                <div class="cc-step">6. Quality Monitoring & Completion</div>
            </div>
        </div>
    </section>

    <section class="cc-section">
        <div class="cc-wrap cc-copy narrow">
            <h2 class="cc-title left">Target Locations We Serve</h2>
            <p>Culverts Contractor in Navi Mumbai | Culverts Contractor in Mumbai | Culvert Construction Services in Pune | Culverts Contractor in Raigad | Culvert Contractor in Thane</p>
            <p>Also serving Panvel, Kharghar, Karjat, Khopoli, Alibaug and nearby areas.</p>
        </div>
    </section>

    <section class="cc-section">
        <div class="cc-wrap">
            <h2 class="cc-title">Frequently Asked Questions (FAQs)</h2>
            <div class="cc-line"></div>

            <div class="cc-faq-list">
                @foreach($faqs as $index => $faq)
                    <article class="cc-faq" id="cc-faq-{{ $index }}">
                        <button type="button" onclick="toggleCulvertFaq({{ $index }})">{{ $faq['q'] }}</button>
                        <div class="cc-faq-answer">{{ $faq['a'] }}</div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</main>

<script>
    function toggleCulvertFaq(index) {
        const item = document.getElementById('cc-faq-' + index);
        const wasOpen = item.classList.contains('open');

        document.querySelectorAll('.cc-faq').forEach(function (faqItem) {
            faqItem.classList.remove('open');
        });

        if (!wasOpen) {
            item.classList.add('open');
        }
    }
</script>

@endsection
