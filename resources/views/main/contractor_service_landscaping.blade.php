@extends('layouts.app')

@section('meta_title', 'Landscaping Contractor Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane | ConstructKaro')
@section('meta_description', 'Landscaping Contractor Services for garden development, hardscape work, farmhouse landscaping, outdoor lighting, irrigation and maintenance.')
@section('title', 'Landscaping Contractor Services | ConstructKaro')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@600;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --lc-blue: #0a82d9;
        --lc-orange: #f27a21;
        --lc-bg: #ededed;
        --lc-text: #111;
        --lc-muted: #4b5563;
        --lc-line: #cfd6de;
        --lc-white: #fff;
    }

    body {
        background: var(--lc-bg);
        font-family: "Inter", "Segoe UI", sans-serif;
        color: var(--lc-text);
    }

    .lc-page {
        background: var(--lc-bg);
        padding-bottom: 44px;
    }

    .lc-wrap {
        width: min(1180px, calc(100% - 44px));
        margin: 0 auto;
    }

    .lc-hero {
        min-height: 300px;
        display: flex;
        align-items: center;
        background:
            /* linear-gradient(90deg, rgba(0,0,0,.84) 0%, rgba(0,0,0,.50) 38%, rgba(0,0,0,.08) 100%), */
            url("{{ asset('images/logo/lc1.png') }}") center / cover no-repeat;
    }

    .lc-hero h1 {
        max-width: 660px;
        margin: 0;
        color: #fff;
        font-family: "Manrope", sans-serif;
        font-size: clamp(34px, 4vw, 58px);
        font-weight: 900;
        line-height: 1.05;
    }

    .lc-section {
        padding: 44px 0 0;
    }

    .lc-title {
        margin: 0 0 10px;
        color: #111;
        font-family: "Manrope", sans-serif;
        font-size: clamp(24px, 2.4vw, 34px);
        font-weight: 900;
        line-height: 1.2;
        text-align: center;
    }

    .lc-title.left {
        text-align: left;
    }

    .lc-line {
        width: 76px;
        height: 3px;
        margin: 0 auto 22px;
        border-radius: 999px;
        background: linear-gradient(90deg, var(--lc-orange), var(--lc-blue));
    }

    .lc-copy {
        color: #3f4650;
        font-size: 15px;
        font-weight: 600;
        line-height: 1.7;
    }

    .lc-copy.narrow {
        max-width: 1050px;
        margin: 0 auto;
    }

    .lc-copy p {
        margin: 0 0 12px;
    }

    .lc-chip-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 18px;
        margin-top: 24px;
    }

    .lc-chip {
        min-height: 72px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 14px 16px;
        border: 2px solid var(--lc-blue);
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

    .lc-chip:nth-child(even) {
        border-color: var(--lc-orange);
        background: #fff0e5;
    }

    .lc-number-grid {
        max-width: 980px;
        margin: 28px auto 0;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 28px;
    }

    .lc-number-card {
        min-height: 150px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 32px 18px 20px;
        border: 2px solid var(--lc-orange);
        border-radius: 8px;
        background: #fff0e5;
        color: #111;
        font-size: 13px;
        font-weight: 700;
        line-height: 1.35;
        text-align: center;
    }

    .lc-number-card:nth-child(even) {
        border-color: var(--lc-blue);
        background: #eaf6ff;
    }

    .lc-num {
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
        background: var(--lc-orange);
        color: #fff;
        font-family: "Manrope", sans-serif;
        font-weight: 900;
    }

    .lc-number-card:nth-child(even) .lc-num {
        background: var(--lc-blue);
    }

    .lc-number-card strong {
        display: block;
        margin-bottom: 8px;
        font-family: "Manrope", sans-serif;
        font-size: 14px;
        font-weight: 900;
    }

    .lc-project-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-top: 22px;
    }

    .lc-project {
        overflow: hidden;
        border: 2px solid var(--lc-blue);
        border-radius: 8px;
        background: #eaf6ff;
        box-shadow: 0 6px 16px rgba(17,24,39,.10);
    }

    .lc-project:nth-child(odd) {
        border-color: var(--lc-orange);
        background: #fff0e5;
    }

    .lc-project img {
        width: 100%;
        aspect-ratio: 1.25 / 1;
        display: block;
        object-fit: cover;
    }

    .lc-project h3 {
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

    .lc-checks {
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

    .lc-process {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 12px;
        margin-top: 20px;
    }

    .lc-step {
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

    .lc-faq-list {
        max-width: 900px;
        margin: 24px auto 0;
        display: grid;
        gap: 12px;
    }

    .lc-faq {
        overflow: hidden;
        border: 1px solid var(--lc-line);
        border-radius: 6px;
        background: var(--lc-white);
        box-shadow: 0 4px 12px rgba(17,24,39,.10);
    }

    .lc-faq button {
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

    .lc-faq-answer {
        display: none;
        padding: 0 20px 16px;
        color: var(--lc-muted);
        font-size: 14px;
        font-weight: 500;
        line-height: 1.6;
    }

    .lc-faq.open .lc-faq-answer {
        display: block;
    }

    @media (max-width: 980px) {
        .lc-chip-grid,
        .lc-project-grid,
        .lc-number-grid,
        .lc-checks,
        .lc-process {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 560px) {
        .lc-wrap {
            width: calc(100% - 24px);
        }

        .lc-hero {
            min-height: 240px;
        }

        .lc-hero h1 {
            font-size: 34px;
        }

        .lc-chip-grid,
        .lc-project-grid,
        .lc-number-grid,
        .lc-checks,
        .lc-process {
            grid-template-columns: 1fr;
        }
    }
</style>

@php
    $scope = [
        'Garden & lawn development',
        'Hardscape and paving work',
        'Plantation & irrigation systems',
        'Outdoor lighting & water features',
        'Site beautification and maintenance',
    ];

    $services = [
        ['title' => 'Garden & Lawn Development', 'items' => ['Natural grass and turf installation', 'Garden planning and plantation', 'Residential and commercial lawn setup', 'Landscape maintenance solutions']],
        ['title' => 'Hardscape & Outdoor Flooring', 'items' => ['Paver block and pathway work', 'Stone cladding and outdoor flooring', 'Compound and driveway work', 'Outdoor seating and curb creation']],
        ['title' => 'Farmhouse & Villa Landscaping', 'items' => ['Luxury farmhouse landscaping', 'Outdoor seating and garden zones', 'Walkways and lighting features', 'Modern integrated landscape design']],
        ['title' => 'Commercial & Township Landscaping', 'items' => ['Office and commercial landscapes', 'Township garden development', 'Public landscape planning', 'Entrance and avenue plantation']],
        ['title' => 'Irrigation & Water Features', 'items' => ['Automatic irrigation systems', 'Drip irrigation solutions', 'Water fountains and features', 'Rainwater-friendly landscape planning']],
    ];

    $projects = [
        ['title' => 'Residential Landscaping', 'img' => 'images/logo/lc2.png'],
        ['title' => 'Farmhouse Landscaping', 'img' => 'images/logo/lc3.png'],
        ['title' => 'Commercial & Corporate Landscaping', 'img' => 'images/logo/lc4.png'],
        ['title' => 'Hardscape & Outdoor Design', 'img' => 'images/logo/lc5.png'],
    ];

    $faqs = [
        ['q' => '1. What types of landscaping projects do you handle?', 'a' => 'We support residential gardens, farmhouse landscapes, commercial outdoor spaces, township landscaping, hardscape works, irrigation and maintenance projects.'],
        ['q' => '2. Do you provide hardscape work also?', 'a' => 'Yes. Hardscape support includes paver blocks, outdoor flooring, pathways, stone work, seating zones, driveways and compound area development.'],
        ['q' => '3. Can you develop farmhouse landscapes?', 'a' => 'Yes. We can coordinate farmhouse and villa landscape planning, garden development, walkways, outdoor seating, lighting and irrigation.'],
        ['q' => '4. Do you provide irrigation systems?', 'a' => 'Yes. Automatic irrigation, drip irrigation and garden water management systems can be planned and executed.'],
        ['q' => '5. Do you provide maintenance services?', 'a' => 'Yes. Landscape maintenance, lawn care, plantation upkeep and outdoor space improvement support can be coordinated.'],
    ];
@endphp

<main class="lc-page">
    <section class="lc-hero">
        <div class="lc-wrap">
        <h1 class="ck-visually-hidden">Landscaping Contractor</h1>
        </div>
    </section>

    <section class="lc-section">
        <div class="lc-wrap lc-copy narrow">
            <h2 class="lc-title">Landscaping Contractor Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane</h2>
            <p>A well-designed landscape enhances the beauty, functionality, and value of your property. At ConstructKaro, we connect you with experienced and verified Landscaping Contractors for residential, commercial, industrial, farmhouse, and township projects.</p>
            <p>From garden development to hardscape execution and outdoor design, we help create outdoor spaces that are visually appealing, functional, and sustainable.</p>
        </div>
    </section>

    <section class="lc-section">
        <div class="lc-wrap">
            <h2 class="lc-title">What Does a Landscaping Contractor Do?</h2>
            <div class="lc-line"></div>
            <p class="lc-copy">A landscaping contractor handles:</p>

            <div class="lc-chip-grid">
                @foreach($scope as $item)
                    <div class="lc-chip">{{ $item }}</div>
                @endforeach
            </div>

            <p class="lc-copy" style="margin-top: 14px;">These services help improve the aesthetics and usability of outdoor spaces.</p>
        </div>
    </section>

    <section class="lc-section">
        <div class="lc-wrap">
            <h2 class="lc-title">Our Landscaping Contractor Services Include</h2>
            <div class="lc-line"></div>

            <div class="lc-number-grid">
                @foreach($services as $index => $service)
                    <article class="lc-number-card">
                        <span class="lc-num">{{ $index + 1 }}</span>
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

    <section class="lc-section">
        <div class="lc-wrap">
            <h2 class="lc-title">Types of Landscaping Projects</h2>
            <div class="lc-line"></div>

            <div class="lc-project-grid">
                @foreach($projects as $project)
                    <!-- <article class="lc-project"> -->
                        <img src="{{ asset($project['img']) }}" alt="{{ $project['title'] }}">
                        <!-- <h3>{{ $project['title'] }}</h3> -->
                    <!-- </article> -->
                @endforeach
            </div>
        </div>
    </section>

    <section class="lc-section">
        <div class="lc-wrap">
            <h2 class="lc-title">Why Choose ConstructKaro?</h2>
            <div class="lc-line"></div>
            <div class="lc-checks">
                <div>&#10003; Verified landscaping contractors</div>
                <div>&#10003; Garden and hardscape execution support</div>
                <div>&#10003; Farmhouse and villa landscaping expertise</div>
                <div>&#10003; Outdoor planning and beautification solutions</div>
                <div>&#10003; Suitable for residential and commercial projects</div>
            </div>
            <p class="lc-copy" style="margin-top: 18px;">We help you create outdoor spaces that are beautiful, functional, and professionally executed.</p>
        </div>
    </section>

    <section class="lc-section">
        <div class="lc-wrap">
            <h2 class="lc-title">Our Execution Process</h2>
            <div class="lc-line"></div>
            <div class="lc-process">
                <div class="lc-step">1. Requirement Discussion</div>
                <div class="lc-step">2. Site Inspection & Landscape Planning</div>
                <div class="lc-step">3. Design & Material Selection</div>
                <div class="lc-step">4. Contractor Assignment</div>
                <div class="lc-step">5. Landscaping Execution</div>
                <div class="lc-step">6. Final Finishing & Handover</div>
            </div>
        </div>
    </section>

    <section class="lc-section">
        <div class="lc-wrap lc-copy narrow">
            <h2 class="lc-title left">Target Locations We Serve</h2>
            <p>Landscaping Contractor in Navi Mumbai | Landscape Design Services in Mumbai | Landscaping Contractor in Pune | Garden Development Services in Raigad | Outdoor Landscaping Contractor in Thane</p>
        </div>
    </section>

    <section class="lc-section">
        <div class="lc-wrap">
            <h2 class="lc-title">Frequently Asked Questions (FAQs)</h2>
            <div class="lc-line"></div>

            <div class="lc-faq-list">
                @foreach($faqs as $index => $faq)
                    <article class="lc-faq" id="lc-faq-{{ $index }}">
                        <button type="button" onclick="toggleLandscapingFaq({{ $index }})">{{ $faq['q'] }}</button>
                        <div class="lc-faq-answer">{{ $faq['a'] }}</div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</main>

<script>
    function toggleLandscapingFaq(index) {
        const item = document.getElementById('lc-faq-' + index);
        const wasOpen = item.classList.contains('open');

        document.querySelectorAll('.lc-faq').forEach(function (faqItem) {
            faqItem.classList.remove('open');
        });

        if (!wasOpen) {
            item.classList.add('open');
        }
    }
</script>

@endsection
