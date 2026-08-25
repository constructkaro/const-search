@extends('layouts.app')

@section('meta_title', 'Earthwork & Excavation Contractor Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane | ConstructKaro')
@section('meta_description', 'Earthwork and Excavation Contractor Services for site clearing, excavation, soil work, grading, foundation preparation, road earthwork and land development projects.')
@section('title', 'Earthwork & Excavation Contractor Services | ConstructKaro')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@600;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --ec-blue: #0a82d9;
        --ec-orange: #f27a21;
        --ec-bg: #ededed;
        --ec-text: #111;
        --ec-muted: #4b5563;
        --ec-line: #cfd6de;
        --ec-white: #fff;
    }

    body {
        background: var(--ec-bg);
        font-family: "Inter", "Segoe UI", sans-serif;
        color: var(--ec-text);
    }

    .ec-page {
        background: var(--ec-bg);
        padding-bottom: 44px;
    }

    .ec-wrap {
        width: min(1180px, calc(100% - 44px));
        margin: 0 auto;
    }

    .ec-hero {
        min-height: 300px;
        display: flex;
        align-items: center;
        background:
            /* linear-gradient(90deg, rgba(0,0,0,.88) 0%, rgba(0,0,0,.60) 38%, rgba(0,0,0,.08) 100%), */
            url("{{ asset('images/logo/eec1.png') }}") center / cover no-repeat;
    }

    .ec-hero h1 {
        max-width: 650px;
        margin: 0;
        color: #fff;
        font-family: "Manrope", sans-serif;
        font-size: clamp(34px, 4vw, 56px);
        font-weight: 900;
        line-height: 1.08;
    }

    .ec-section {
        padding: 48px 0 0;
    }

    .ec-title {
        margin: 0 0 10px;
        color: #111;
        font-family: "Manrope", sans-serif;
        font-size: clamp(24px, 2.4vw, 34px);
        font-weight: 900;
        line-height: 1.2;
        text-align: center;
    }

    .ec-title.left {
        text-align: left;
    }

    .ec-line {
        width: 76px;
        height: 3px;
        margin: 0 auto 22px;
        border-radius: 999px;
        background: linear-gradient(90deg, var(--ec-orange), var(--ec-blue));
    }

    .ec-copy {
        color: #3f4650;
        font-size: 15px;
        font-weight: 600;
        line-height: 1.7;
    }

    .ec-copy.narrow {
        max-width: 1050px;
        margin: 0 auto;
    }

    .ec-copy p {
        margin: 0 0 12px;
    }

    .ec-chip-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 18px;
        margin-top: 24px;
    }

    .ec-chip {
        min-height: 72px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 14px 16px;
        border: 2px solid var(--ec-blue);
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

    .ec-chip:nth-child(even) {
        border-color: var(--ec-orange);
        background: #fff0e5;
    }

    .ec-number-grid {
        max-width: 980px;
        margin: 28px auto 0;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 28px;
    }

    .ec-number-card {
        min-height: 150px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 32px 18px 20px;
        border: 2px solid var(--ec-orange);
        border-radius: 8px;
        background: #fff0e5;
        color: #111;
        font-size: 13px;
        font-weight: 700;
        line-height: 1.35;
        text-align: center;
    }

    .ec-number-card:nth-child(even) {
        border-color: var(--ec-blue);
        background: #eaf6ff;
    }

    .ec-num {
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
        background: var(--ec-orange);
        color: #fff;
        font-family: "Manrope", sans-serif;
        font-weight: 900;
    }

    .ec-number-card:nth-child(even) .ec-num {
        background: var(--ec-blue);
    }

    .ec-number-card strong {
        display: block;
        margin-bottom: 8px;
        font-family: "Manrope", sans-serif;
        font-size: 14px;
        font-weight: 900;
    }

    .ec-project-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-top: 22px;
    }

    .ec-project img {
        width: 100%;
        aspect-ratio: 1.2 / 1;
        display: block;
        object-fit: contain;
        filter: drop-shadow(0 10px 16px rgba(17,24,39,.12));
    }

    .ec-checks {
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

    .ec-process {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 12px;
        margin-top: 20px;
    }

    .ec-step {
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

    .ec-faq-list {
        max-width: 900px;
        margin: 24px auto 0;
        display: grid;
        gap: 12px;
    }

    .ec-faq {
        overflow: hidden;
        border: 1px solid var(--ec-line);
        border-radius: 6px;
        background: var(--ec-white);
        box-shadow: 0 4px 12px rgba(17,24,39,.10);
    }

    .ec-faq button {
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

    .ec-faq-answer {
        display: none;
        padding: 0 20px 16px;
        color: var(--ec-muted);
        font-size: 14px;
        font-weight: 500;
        line-height: 1.6;
    }

    .ec-faq.open .ec-faq-answer {
        display: block;
    }

    @media (max-width: 980px) {
        .ec-chip-grid,
        .ec-project-grid,
        .ec-number-grid,
        .ec-checks,
        .ec-process {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 560px) {
        .ec-wrap {
            width: calc(100% - 24px);
        }

        .ec-hero {
            min-height: 240px;
        }

        .ec-hero h1 {
            font-size: 34px;
        }

        .ec-chip-grid,
        .ec-project-grid,
        .ec-number-grid,
        .ec-checks,
        .ec-process {
            grid-template-columns: 1fr;
        }
    }
</style>

@php
    $scope = [
        'Site clearing & leveling',
        'Soil excavation & trenching',
        'Cut & fill operations',
        'Foundation excavation',
        'Land grading & compaction',
    ];

    $services = [
        ['title' => 'Site Clearing & Land Preparation', 'items' => ['Vegetation & debris removal', 'Level marking & grading', 'Surface preparation for construction', 'Plot development preparation']],
        ['title' => 'Excavation Work', 'items' => ['Foundation excavation', 'Basement excavation', 'Trench excavation for utilities', 'Road excavation projects']],
        ['title' => 'Earthmoving & Soil Work', 'items' => ['Cut & fill operations', 'Soil loading & disposal', 'Embankment preparation', 'Site material movement']],
        ['title' => 'Compaction & Grading', 'items' => ['Soil compaction control', 'Road subgrade preparation', 'Slope formation & profiling', 'Surface stabilisation']],
        ['title' => 'Infrastructure & Road Earthwork', 'items' => ['Highway & road earthwork', 'Drainage excavation', 'Access & utility trench work', 'Industrial site grading preparation']],
    ];

    $projects = [
        ['img' => 'images/logo/eec2.png', 'alt' => 'Residential excavation projects'],
        ['img' => 'images/logo/eec3.png', 'alt' => 'Commercial and industrial excavation'],
        ['img' => 'images/logo/eec4.png', 'alt' => 'Road and infrastructure earthwork'],
        ['img' => 'images/logo/eec5.png', 'alt' => 'Plot development and land grading'],
    ];

    $faqs = [
        ['q' => '1. What types of excavation work do you handle?', 'a' => 'We help coordinate foundation excavation, basement excavation, trenching, site clearing, land grading, compaction and road earthwork.'],
        ['q' => '2. Do you provide machinery for excavation work?', 'a' => 'Yes. Machinery and equipment coordination can be arranged based on project size, soil conditions and site access.'],
        ['q' => '3. Can you handle large-scale infrastructure earthwork?', 'a' => 'Yes. Contractors can be matched for larger road, industrial and infrastructure earthwork requirements.'],
        ['q' => '4. Do you provide site leveling and compaction?', 'a' => 'Yes. Site leveling, grading, soil compaction and subgrade preparation can be coordinated.'],
        ['q' => '5. Do you provide BOQ and quantity estimation?', 'a' => 'Yes. BOQ and quantity support can be provided for excavation, filling, grading and earthmoving work.'],
    ];
@endphp

<main class="ec-page">
    <section class="ec-hero">
        <div class="ec-wrap">
            <h1 class="ck-visually-hidden">Earthwork &amp; Excavation Contractor</h1>
        </div>
    </section>

    <section class="ec-section">
        <div class="ec-wrap ec-copy narrow">
            <h2 class="ec-title">Earthwork & Excavation Contractor Services in Navi Mumbai, Mumbai,<br>Pune, Raigad & Thane</h2>
            <p>Professional Earthwork & Excavation Services for Construction Projects.</p>
            <p>Every successful construction project begins with proper site preparation. At ConstructKaro, we connect you with experienced and verified Earthwork & Excavation Contractors for residential, commercial, industrial, infrastructure, and plotting projects.</p>
            <p>From land clearing to deep excavation and grading, we ensure your site is prepared safely, accurately, and efficiently for the next stage of construction.</p>
        </div>
    </section>

    <section class="ec-section">
        <div class="ec-wrap">
            <h2 class="ec-title">What Does an Earthwork & Excavation Contractor Do?</h2>
            <div class="ec-line"></div>
            <p class="ec-copy">Earthwork and excavation contractors handle:</p>

            <div class="ec-chip-grid">
                @foreach($scope as $item)
                    <div class="ec-chip">{{ $item }}</div>
                @endforeach
            </div>

            <p class="ec-copy" style="margin-top: 14px;">These activities prepare the land for safe and stable construction.</p>
        </div>
    </section>

    <section class="ec-section">
        <div class="ec-wrap">
            <h2 class="ec-title">Our Earthwork & Excavation Services Include</h2>
            <div class="ec-line"></div>

            <div class="ec-number-grid">
                @foreach($services as $index => $service)
                    <article class="ec-number-card">
                        <span class="ec-num">{{ $index + 1 }}</span>
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

    <section class="ec-section">
        <div class="ec-wrap">
            <h2 class="ec-title">Types of Earthwork & Excavation Projects</h2>
            <div class="ec-line"></div>

            <div class="ec-project-grid">
                @foreach($projects as $project)
                    <article class="ec-project">
                        <img src="{{ asset($project['img']) }}" alt="{{ $project['alt'] }}">
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="ec-section">
        <div class="ec-wrap">
            <h2 class="ec-title">Why Choose ConstructKaro?</h2>
            <div class="ec-line"></div>
            <div class="ec-checks">
                <div>&#10003; Verified excavation contractors</div>
                <div>&#10003; Proper machinery & skilled operators</div>
                <div>&#10003; Site and structured execution</div>
                <div>&#10003; BOQ & quantity estimation support</div>
                <div>&#10003; Suitable for residential & infrastructure projects</div>
            </div>
            <p class="ec-copy" style="margin-top: 18px;">We help you prepare your site with accurate earthwork execution and proper construction planning.</p>
        </div>
    </section>

    <section class="ec-section">
        <div class="ec-wrap">
            <h2 class="ec-title">Our Execution Process</h2>
            <div class="ec-line"></div>
            <div class="ec-process">
                <div class="ec-step">1. Requirement Discussion</div>
                <div class="ec-step">2. Site Inspection & Survey</div>
                <div class="ec-step">3. Earthwork Planning & BOQ</div>
                <div class="ec-step">4. Machinery & Contractor Assignment</div>
                <div class="ec-step">5. Excavation & Site Preparation</div>
                <div class="ec-step">6. Quality & Safety Monitoring</div>
            </div>
        </div>
    </section>

    <section class="ec-section">
        <div class="ec-wrap ec-copy narrow">
            <h2 class="ec-title left">Target Locations We Serve</h2>
            <p>Earthwork Contractor in Navi Mumbai | Excavation Contractor in Mumbai | Earthwork Services in Pune | Excavation Contractor in Raigad | Land Grading Contractor in Thane</p>
            <p>Also serving Panvel, Kharghar, Karjat, Khopoli, Alibaug and nearby areas.</p>
        </div>
    </section>

    <section class="ec-section">
        <div class="ec-wrap">
            <h2 class="ec-title">Frequently Asked Questions (FAQs)</h2>
            <div class="ec-line"></div>

            <div class="ec-faq-list">
                @foreach($faqs as $index => $faq)
                    <article class="ec-faq" id="ec-faq-{{ $index }}">
                        <button type="button" onclick="toggleEarthworkFaq({{ $index }})">{{ $faq['q'] }}</button>
                        <div class="ec-faq-answer">{{ $faq['a'] }}</div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</main>

<script>
    function toggleEarthworkFaq(index) {
        const item = document.getElementById('ec-faq-' + index);
        const wasOpen = item.classList.contains('open');

        document.querySelectorAll('.ec-faq').forEach(function (faqItem) {
            faqItem.classList.remove('open');
        });

        if (!wasOpen) {
            item.classList.add('open');
        }
    }
</script>

@endsection
