@extends('layouts.app')

@section('meta_title', 'Labour Contractor Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane | ConstructKaro')
@section('meta_description', 'Labour Contractor Services for skilled and unskilled manpower, RCC labour, finishing labour, industrial labour, infrastructure labour and site workforce coordination.')
@section('title', 'Labour Contractor Services | ConstructKaro')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@600;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --lb-blue: #0a82d9;
        --lb-orange: #f27a21;
        --lb-bg: #ededed;
        --lb-text: #111;
        --lb-muted: #4b5563;
        --lb-line: #cfd6de;
        --lb-white: #fff;
    }

    body {
        background: var(--lb-bg);
        font-family: "Inter", "Segoe UI", sans-serif;
        color: var(--lb-text);
    }

    .lb-page {
        background: var(--lb-bg);
        padding-bottom: 44px;
    }

    .lb-wrap {
        width: min(1180px, calc(100% - 44px));
        margin: 0 auto;
    }

    .lb-hero {
        min-height: 300px;
        display: flex;
        align-items: center;
        background:
            /* linear-gradient(90deg, rgba(0,0,0,.86) 0%, rgba(0,0,0,.52) 38%, rgba(0,0,0,.10) 100%), */
            url("{{ asset('images/logo/lcc1.png') }}") center / cover no-repeat;
    }

    .lb-hero h1 {
        max-width: 660px;
        margin: 0;
        color: #fff;
        font-family: "Manrope", sans-serif;
        font-size: clamp(34px, 4vw, 58px);
        font-weight: 900;
        line-height: 1.05;
    }

    .lb-section {
        padding: 44px 0 0;
    }

    .lb-title {
        margin: 0 0 10px;
        color: #111;
        font-family: "Manrope", sans-serif;
        font-size: clamp(24px, 2.4vw, 34px);
        font-weight: 900;
        line-height: 1.2;
        text-align: center;
    }

    .lb-title.left {
        text-align: left;
    }

    .lb-line {
        width: 76px;
        height: 3px;
        margin: 0 auto 22px;
        border-radius: 999px;
        background: linear-gradient(90deg, var(--lb-orange), var(--lb-blue));
    }

    .lb-copy {
        color: #3f4650;
        font-size: 15px;
        font-weight: 600;
        line-height: 1.7;
    }

    .lb-copy.narrow {
        max-width: 1050px;
        margin: 0 auto;
    }

    .lb-copy p {
        margin: 0 0 12px;
    }

    .lb-chip-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 18px;
        margin-top: 24px;
    }

    .lb-chip {
        min-height: 72px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 14px 16px;
        border: 2px solid var(--lb-blue);
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

    .lb-chip:nth-child(even) {
        border-color: var(--lb-orange);
        background: #fff0e5;
    }

    .lb-number-grid {
        max-width: 980px;
        margin: 28px auto 0;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 28px;
    }

    .lb-number-card {
        min-height: 150px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 32px 18px 20px;
        border: 2px solid var(--lb-orange);
        border-radius: 8px;
        background: #fff0e5;
        color: #111;
        font-size: 13px;
        font-weight: 700;
        line-height: 1.35;
        text-align: center;
    }

    .lb-number-card:nth-child(even) {
        border-color: var(--lb-blue);
        background: #eaf6ff;
    }

    .lb-num {
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
        background: var(--lb-orange);
        color: #fff;
        font-family: "Manrope", sans-serif;
        font-weight: 900;
    }

    .lb-number-card:nth-child(even) .lb-num {
        background: var(--lb-blue);
    }

    .lb-number-card strong {
        display: block;
        margin-bottom: 8px;
        font-family: "Manrope", sans-serif;
        font-size: 14px;
        font-weight: 900;
    }

    .lb-project-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-top: 22px;
    }

    .lb-project {
        overflow: hidden;
        border: 2px solid var(--lb-blue);
        border-radius: 8px;
        background: #eaf6ff;
        box-shadow: 0 6px 16px rgba(17,24,39,.10);
    }

    .lb-project:nth-child(odd) {
        border-color: var(--lb-orange);
        background: #fff0e5;
    }

    .lb-project img {
        width: 100%;
        aspect-ratio: 1.25 / 1;
        display: block;
        object-fit: cover;
    }

    .lb-project h3 {
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

    .lb-checks {
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

    .lb-process {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 12px;
        margin-top: 20px;
    }

    .lb-step {
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

    .lb-faq-list {
        max-width: 900px;
        margin: 24px auto 0;
        display: grid;
        gap: 12px;
    }

    .lb-faq {
        overflow: hidden;
        border: 1px solid var(--lb-line);
        border-radius: 6px;
        background: var(--lb-white);
        box-shadow: 0 4px 12px rgba(17,24,39,.10);
    }

    .lb-faq button {
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

    .lb-faq-answer {
        display: none;
        padding: 0 20px 16px;
        color: var(--lb-muted);
        font-size: 14px;
        font-weight: 500;
        line-height: 1.6;
    }

    .lb-faq.open .lb-faq-answer {
        display: block;
    }

    @media (max-width: 980px) {
        .lb-chip-grid,
        .lb-project-grid,
        .lb-number-grid,
        .lb-checks,
        .lb-process {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 560px) {
        .lb-wrap {
            width: calc(100% - 24px);
        }

        .lb-hero {
            min-height: 240px;
        }

        .lb-hero h1 {
            font-size: 34px;
        }

        .lb-chip-grid,
        .lb-project-grid,
        .lb-number-grid,
        .lb-checks,
        .lb-process {
            grid-template-columns: 1fr;
        }
    }
</style>

@php
    $scope = [
        'Skilled construction labour',
        'Unskilled manpower',
        'Site workforce coordination',
        'Labour deployment & supervision',
        'Trade-specific manpower teams',
    ];

    $services = [
        ['title' => 'RCC & Structural Labour Supply', 'items' => ['Bar bending labour', 'Shuttering carpenters', 'RCC masons', 'Concrete labour teams']],
        ['title' => 'Finishing Work Labour', 'items' => ['Tile fitting labour', 'Painting manpower', 'Waterproofing labour', 'Plaster and finishing teams']],
        ['title' => 'Industrial & Infrastructure Labour', 'items' => ['Industrial project manpower', 'Road and highway labour teams', 'Drainage and utility work labour', 'Heavy construction workforce']],
        ['title' => 'Skilled & Unskilled Labour Supply', 'items' => ['Skilled construction workers', 'Helpers and general labour', 'Multi-trade manpower supply', 'Site support staff']],
        ['title' => 'Labour Management & Coordination', 'items' => ['Workforce deployment planning', 'Attendance and coordination support', 'Team mobilisation assistance', 'Project labour vendor allocation']],
    ];

    $projects = [
        ['title' => 'Residential Construction Labour', 'img' => 'images/logo/lcc2.png'],
        ['title' => 'Commercial Construction Labour', 'img' => 'images/logo/lcc3.png'],
        ['title' => 'Industrial Labour Supply', 'img' => 'images/logo/lcc4.png'],
        ['title' => 'Road & Infrastructure Labour', 'img' => 'images/logo/lcc5.png'],
    ];

    $faqs = [
        ['q' => '1. What types of labour do you provide?', 'a' => 'We help coordinate skilled labour, unskilled manpower, RCC labour, finishing labour, industrial labour, infrastructure labour and trade-specific workforce teams.'],
        ['q' => '2. Do you provide skilled and unskilled labour?', 'a' => 'Yes. Both skilled trade workers and unskilled support labour can be arranged based on the project requirement.'],
        ['q' => '3. Can you provide labour for industrial and infrastructure projects?', 'a' => 'Yes. Labour teams can be coordinated for factories, warehouses, roads, drainage, utilities and infrastructure projects.'],
        ['q' => '4. How quickly can labour teams be mobilized?', 'a' => 'Mobilisation depends on project size, trade requirement, site location and workforce availability. Smaller teams can usually be arranged faster.'],
        ['q' => '5. Do you provide labour-only contracts?', 'a' => 'Yes. Labour-only support can be coordinated where the client provides material and site supervision, depending on scope and terms.'],
    ];
@endphp

<main class="lb-page">
    <section class="lb-hero">
        <div class="lb-wrap">
            <!-- <h1>Labour Contractor</h1> -->
        </div>
    </section>

    <section class="lb-section">
        <div class="lb-wrap lb-copy narrow">
            <h2 class="lb-title">Labour Contractor Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane</h2>
            <p>Construction projects require skilled manpower, proper coordination, and timely workforce availability to ensure smooth execution. At ConstructKaro, we connect you with verified and experienced Labour Contractors for residential, commercial, industrial, and infrastructure projects.</p>
            <p>From RCC labour teams to finishing work manpower, we help provide skilled and unskilled labour as per your project requirements.</p>
        </div>
    </section>

    <section class="lb-section">
        <div class="lb-wrap">
            <h2 class="lb-title">What Does a Labour Contractor Do?</h2>
            <div class="lb-line"></div>
            <p class="lb-copy">A labour contractor manages and supplies:</p>

            <div class="lb-chip-grid">
                @foreach($scope as $item)
                    <div class="lb-chip">{{ $item }}</div>
                @endforeach
            </div>

            <p class="lb-copy" style="margin-top: 14px;">These services help ensure construction work progresses efficiently and on schedule.</p>
        </div>
    </section>

    <section class="lb-section">
        <div class="lb-wrap">
            <h2 class="lb-title">Our Labour Contractor Services Include</h2>
            <div class="lb-line"></div>

            <div class="lb-number-grid">
                @foreach($services as $index => $service)
                    <article class="lb-number-card">
                        <span class="lb-num">{{ $index + 1 }}</span>
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

    <section class="lb-section">
        <div class="lb-wrap">
            <h2 class="lb-title">Types of Labour Projects</h2>
            <div class="lb-line"></div>

            <div class="lb-project-grid">
                @foreach($projects as $project)
                    <!-- <article class="lb-project"> -->
                        <img src="{{ asset($project['img']) }}" alt="{{ $project['title'] }}">
                        <!-- <h3>{{ $project['title'] }}</h3> -->
                    <!-- </article> -->
                @endforeach
            </div>
        </div>
    </section>

    <section class="lb-section">
        <div class="lb-wrap">
            <h2 class="lb-title">Why Choose ConstructKaro?</h2>
            <div class="lb-line"></div>
            <div class="lb-checks">
                <div>&#10003; Verified labour contractors</div>
                <div>&#10003; Skilled and unskilled manpower support</div>
                <div>&#10003; Quick workforce mobilisation</div>
                <div>&#10003; Project-based labour allocation</div>
                <div>&#10003; Suitable for residential and infrastructure projects</div>
            </div>
            <p class="lb-copy" style="margin-top: 18px;">We help ensure your project has the right workforce at the right time for smooth execution.</p>
        </div>
    </section>

    <section class="lb-section">
        <div class="lb-wrap">
            <h2 class="lb-title">Our Execution Process</h2>
            <div class="lb-line"></div>
            <div class="lb-process">
                <div class="lb-step">1. Requirement Discussion</div>
                <div class="lb-step">2. Labour Requirement Analysis</div>
                <div class="lb-step">3. Contractor & Team Allocation</div>
                <div class="lb-step">4. Workforce Mobilization</div>
                <div class="lb-step">5. Site Coordination Support</div>
                <div class="lb-step">6. Ongoing Labour Management</div>
            </div>
        </div>
    </section>

    <section class="lb-section">
        <div class="lb-wrap lb-copy narrow">
            <h2 class="lb-title left">Target Locations We Serve</h2>
            <p>Labour Contractor in Navi Mumbai | Construction Labour Supply in Mumbai | Skilled Labour Contractor in Pune | RCC Labour Contractor in Raigad | Construction Manpower Services in Thane</p>
            <p>Also serving Panvel, Kharghar, Taloja, Mahape, Karjat, Khopoli and nearby areas.</p>
        </div>
    </section>

    <section class="lb-section">
        <div class="lb-wrap">
            <h2 class="lb-title">Frequently Asked Questions (FAQs)</h2>
            <div class="lb-line"></div>

            <div class="lb-faq-list">
                @foreach($faqs as $index => $faq)
                    <article class="lb-faq" id="lb-faq-{{ $index }}">
                        <button type="button" onclick="toggleLabourFaq({{ $index }})">{{ $faq['q'] }}</button>
                        <div class="lb-faq-answer">{{ $faq['a'] }}</div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</main>

<script>
    function toggleLabourFaq(index) {
        const item = document.getElementById('lb-faq-' + index);
        const wasOpen = item.classList.contains('open');

        document.querySelectorAll('.lb-faq').forEach(function (faqItem) {
            faqItem.classList.remove('open');
        });

        if (!wasOpen) {
            item.classList.add('open');
        }
    }
</script>

@endsection
