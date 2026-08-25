@extends('layouts.app')

@section('meta_title', 'Waterproofing Contractor Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane | ConstructKaro')
@section('meta_description', 'Waterproofing Contractor Services for terrace, roof, bathroom, basement, retaining wall, external wall and industrial waterproofing systems.')
@section('title', 'Waterproofing Contractor Services | ConstructKaro')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@600;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --wc-blue: #0a82d9;
        --wc-orange: #f27a21;
        --wc-bg: #ededed;
        --wc-text: #111;
        --wc-muted: #4b5563;
        --wc-line: #cfd6de;
        --wc-white: #fff;
    }

    body {
        background: var(--wc-bg);
        font-family: "Inter", "Segoe UI", sans-serif;
        color: var(--wc-text);
    }

    .wc-page {
        background: var(--wc-bg);
        padding-bottom: 44px;
    }

    .wc-wrap {
        width: min(1180px, calc(100% - 44px));
        margin: 0 auto;
    }

    .wc-hero {
        min-height: 300px;
        display: flex;
        align-items: center;
        background:
            /* linear-gradient(90deg, rgba(0,0,0,.86) 0%, rgba(0,0,0,.52) 38%, rgba(0,0,0,.10) 100%), */
            url("{{ asset('images/logo/wc1.png') }}") center / cover no-repeat;
    }

    .wc-hero h1 {
        max-width: 660px;
        margin: 0;
        color: #fff;
        font-family: "Manrope", sans-serif;
        font-size: clamp(34px, 4vw, 58px);
        font-weight: 900;
        line-height: 1.05;
    }

    .wc-section {
        padding: 44px 0 0;
    }

    .wc-title {
        margin: 0 0 10px;
        color: #111;
        font-family: "Manrope", sans-serif;
        font-size: clamp(24px, 2.4vw, 34px);
        font-weight: 900;
        line-height: 1.2;
        text-align: center;
    }

    .wc-title.left {
        text-align: left;
    }

    .wc-line {
        width: 76px;
        height: 3px;
        margin: 0 auto 22px;
        border-radius: 999px;
        background: linear-gradient(90deg, var(--wc-orange), var(--wc-blue));
    }

    .wc-copy {
        color: #3f4650;
        font-size: 15px;
        font-weight: 600;
        line-height: 1.7;
    }

    .wc-copy.narrow {
        max-width: 1050px;
        margin: 0 auto;
    }

    .wc-copy p {
        margin: 0 0 12px;
    }

    .wc-chip-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 18px;
        margin-top: 24px;
    }

    .wc-chip {
        min-height: 72px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 14px 16px;
        border: 2px solid var(--wc-blue);
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

    .wc-chip:nth-child(even) {
        border-color: var(--wc-orange);
        background: #fff0e5;
    }

    .wc-number-grid {
        max-width: 980px;
        margin: 28px auto 0;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 28px;
    }

    .wc-number-card {
        min-height: 150px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 32px 18px 20px;
        border: 2px solid var(--wc-orange);
        border-radius: 8px;
        background: #fff0e5;
        color: #111;
        font-size: 13px;
        font-weight: 700;
        line-height: 1.35;
        text-align: center;
    }

    .wc-number-card:nth-child(even) {
        border-color: var(--wc-blue);
        background: #eaf6ff;
    }

    .wc-num {
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
        background: var(--wc-orange);
        color: #fff;
        font-family: "Manrope", sans-serif;
        font-weight: 900;
    }

    .wc-number-card:nth-child(even) .wc-num {
        background: var(--wc-blue);
    }

    .wc-number-card strong {
        display: block;
        margin-bottom: 8px;
        font-family: "Manrope", sans-serif;
        font-size: 14px;
        font-weight: 900;
    }

    .wc-project-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-top: 22px;
    }

    .wc-project {
        overflow: hidden;
        border: 2px solid var(--wc-blue);
        border-radius: 8px;
        background: #eaf6ff;
        box-shadow: 0 6px 16px rgba(17,24,39,.10);
    }

    .wc-project:nth-child(odd) {
        border-color: var(--wc-orange);
        background: #fff0e5;
    }

    .wc-project img {
        width: 100%;
        aspect-ratio: 1.25 / 1;
        display: block;
        object-fit: cover;
    }

    .wc-project h3 {
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

    .wc-checks {
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

    .wc-process {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 12px;
        margin-top: 20px;
    }

    .wc-step {
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

    .wc-faq-list {
        max-width: 900px;
        margin: 24px auto 0;
        display: grid;
        gap: 12px;
    }

    .wc-faq {
        overflow: hidden;
        border: 1px solid var(--wc-line);
        border-radius: 6px;
        background: var(--wc-white);
        box-shadow: 0 4px 12px rgba(17,24,39,.10);
    }

    .wc-faq button {
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

    .wc-faq-answer {
        display: none;
        padding: 0 20px 16px;
        color: var(--wc-muted);
        font-size: 14px;
        font-weight: 500;
        line-height: 1.6;
    }

    .wc-faq.open .wc-faq-answer {
        display: block;
    }

    @media (max-width: 980px) {
        .wc-chip-grid,
        .wc-project-grid,
        .wc-number-grid,
        .wc-checks,
        .wc-process {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 560px) {
        .wc-wrap {
            width: calc(100% - 24px);
        }

        .wc-hero {
            min-height: 240px;
        }

        .wc-hero h1 {
            font-size: 34px;
        }

        .wc-chip-grid,
        .wc-project-grid,
        .wc-number-grid,
        .wc-checks,
        .wc-process {
            grid-template-columns: 1fr;
        }
    }
</style>

@php
    $scope = [
        'Terrace & roof waterproofing',
        'Bathroom & kitchen leakage treatment',
        'Basement & retaining wall waterproofing',
        'External wall damp-proofing',
        'Industrial & infrastructure waterproof systems',
    ];

    $services = [
        ['title' => 'Terrace & Roof Waterproofing', 'items' => ['Terrace leakage treatment', 'Acrylic membrane waterproofing', 'Chemical waterproof coating', 'Heat-reflective waterproof systems']],
        ['title' => 'Bathroom & Wet Area Waterproofing', 'items' => ['Bathroom leakage repair', 'Kitchen and wet-area waterproofing', 'Tile joint and grouting repair', 'Water blockage solutions']],
        ['title' => 'Basement & Foundation Waterproofing', 'items' => ['Retaining wall waterproofing', 'Basement seepage treatment', 'Foundation protection systems', 'Underground waterproof coatings']],
        ['title' => 'External Wall Waterproofing', 'items' => ['Damp-proof exterior coatings', 'Crack filling and leak treatment', 'Protective exterior waterproofing', 'Exterior facade waterproofing']],
        ['title' => 'Industrial & Infrastructure Waterproofing', 'items' => ['Factory and warehouse waterproofing', 'Industrial roof treatments', 'Protective waterproof compound systems', 'Infrastructure protection coatings']],
    ];

    $projects = [
        ['title' => 'Residential Waterproofing', 'img' => 'images/logo/wc2.png'],
        ['title' => 'Commercial Waterproofing', 'img' => 'images/logo/wc3.png'],
        ['title' => 'Industrial Waterproofing', 'img' => 'images/logo/wc4.png'],
        ['title' => 'Crack & Leakage Repair Solutions', 'img' => 'images/logo/wc5.png'],
    ];

    $faqs = [
        ['q' => '1. What types of waterproofing services do you provide?', 'a' => 'We support terrace waterproofing, roof waterproofing, bathroom leakage treatment, basement waterproofing, external wall damp-proofing and industrial waterproofing systems.'],
        ['q' => '2. Do you provide leakage repair solutions?', 'a' => 'Yes. Leakage repair for terraces, bathrooms, external walls, cracks, joints and damp areas can be coordinated.'],
        ['q' => '3. Which waterproofing methods do you use?', 'a' => 'Methods can include acrylic coatings, chemical waterproofing, membrane systems, crack filling, grouting, protective coatings and surface preparation based on site conditions.'],
        ['q' => '4. Can you handle industrial waterproofing projects?', 'a' => 'Yes. We can coordinate waterproofing for factories, warehouses, industrial roofs, retaining walls and infrastructure projects.'],
        ['q' => '5. How long does waterproofing last?', 'a' => 'Durability depends on surface condition, product system, workmanship and maintenance. Proper surface preparation and quality materials help improve long-term performance.'],
    ];
@endphp

<main class="wc-page">
    <section class="wc-hero">
        <div class="wc-wrap">
        <h1 class="ck-visually-hidden">Waterproofing Contractor</h1>
        </div>
    </section>

    <section class="wc-section">
        <div class="wc-wrap wc-copy narrow">
            <h2 class="wc-title">Waterproofing Contractor Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane</h2>
            <p>Water leakage and dampness can damage the strength, appearance, and lifespan of any structure. At ConstructKaro, we connect you with verified and experienced Waterproofing Contractors for residential, commercial, industrial, and infrastructure projects.</p>
            <p>From terrace waterproofing to basement leakage treatment and bathroom sealing, we help ensure your property remains protected against water seepage, cracks, and moisture damage.</p>
        </div>
    </section>

    <section class="wc-section">
        <div class="wc-wrap">
            <h2 class="wc-title">What Does a Waterproofing Contractor Do?</h2>
            <div class="wc-line"></div>
            <p class="wc-copy">A waterproofing contractor handles:</p>

            <div class="wc-chip-grid">
                @foreach($scope as $item)
                    <div class="wc-chip">{{ $item }}</div>
                @endforeach
            </div>

            <p class="wc-copy" style="margin-top: 14px;">These services help prevent structural damage, seepage, fungus, and long-term maintenance issues.</p>
        </div>
    </section>

    <section class="wc-section">
        <div class="wc-wrap">
            <h2 class="wc-title">Our Waterproofing Contractor Services Include</h2>
            <div class="wc-line"></div>

            <div class="wc-number-grid">
                @foreach($services as $index => $service)
                    <article class="wc-number-card">
                        <span class="wc-num">{{ $index + 1 }}</span>
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

    <section class="wc-section">
        <div class="wc-wrap">
            <h2 class="wc-title">Types of Waterproofing Projects</h2>
            <div class="wc-line"></div>

            <div class="wc-project-grid">
                @foreach($projects as $project)
                    <!-- <article class="wc-project"> -->
                        <img src="{{ asset($project['img']) }}" alt="{{ $project['title'] }}">
                        <!-- <h3>{{ $project['title'] }}</h3> -->
                    <!-- </article> -->
                @endforeach
            </div>
        </div>
    </section>

    <section class="wc-section">
        <div class="wc-wrap">
            <h2 class="wc-title">Why Choose ConstructKaro?</h2>
            <div class="wc-line"></div>
            <div class="wc-checks">
                <div>&#10003; Verified waterproofing contractors</div>
                <div>&#10003; Advanced waterproofing systems</div>
                <div>&#10003; Residential and industrial leakage solutions</div>
                <div>&#10003; Quality-focused execution</div>
                <div>&#10003; Suitable for all property types</div>
            </div>
            <p class="wc-copy" style="margin-top: 18px;">We help protect your property with durable, reliable, and professionally executed waterproofing solutions.</p>
        </div>
    </section>

    <section class="wc-section">
        <div class="wc-wrap">
            <h2 class="wc-title">Our Execution Process</h2>
            <div class="wc-line"></div>
            <div class="wc-process">
                <div class="wc-step">1. Requirement Discussion</div>
                <div class="wc-step">2. Site Inspection & Leakage Analysis</div>
                <div class="wc-step">3. Waterproofing System Selection</div>
                <div class="wc-step">4. Contractor Assignment</div>
                <div class="wc-step">5. Waterproofing Execution</div>
                <div class="wc-step">6. Final Testing & Quality Check</div>
            </div>
        </div>
    </section>

    <section class="wc-section">
        <div class="wc-wrap wc-copy narrow">
            <h2 class="wc-title left">Target Locations We Serve</h2>
            <p>Waterproofing Contractor in Navi Mumbai | Waterproofing Services in Mumbai | Terrace Waterproofing Contractor in Pune | Leakage Repair Services in Raigad | Damp Proofing Contractor in Thane</p>
            <p>Also serving Panvel, Kharghar, Taloja, Mahape, Karjat, Khopoli and nearby areas.</p>
        </div>
    </section>

    <section class="wc-section">
        <div class="wc-wrap">
            <h2 class="wc-title">Frequently Asked Questions (FAQs)</h2>
            <div class="wc-line"></div>

            <div class="wc-faq-list">
                @foreach($faqs as $index => $faq)
                    <article class="wc-faq" id="wc-faq-{{ $index }}">
                        <button type="button" onclick="toggleWaterproofingFaq({{ $index }})">{{ $faq['q'] }}</button>
                        <div class="wc-faq-answer">{{ $faq['a'] }}</div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</main>

<script>
    function toggleWaterproofingFaq(index) {
        const item = document.getElementById('wc-faq-' + index);
        const wasOpen = item.classList.contains('open');

        document.querySelectorAll('.wc-faq').forEach(function (faqItem) {
            faqItem.classList.remove('open');
        });

        if (!wasOpen) {
            item.classList.add('open');
        }
    }
</script>

@endsection
