@extends('layouts.app')

@section('meta_title', 'Residential Contractor Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane | ConstructKaro')
@section('meta_description', 'Residential Contractor Services for villas, bungalows, apartments, row houses, and residential building construction across Navi Mumbai, Mumbai, Pune, Raigad and Thane.')
@section('title', 'Residential Contractor Services | ConstructKaro')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@600;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --rc-blue: #0a82d9;
        --rc-orange: #f27a21;
        --rc-bg: #ededed;
        --rc-text: #111;
        --rc-muted: #4b5563;
        --rc-line: #cfd6de;
        --rc-white: #fff;
    }

    body {
        background: var(--rc-bg);
        font-family: "Inter", "Segoe UI", sans-serif;
        color: var(--rc-text);
    }

    .rc-page {
        background: var(--rc-bg);
        padding-bottom: 44px;
    }

    .rc-wrap {
        width: min(1180px, calc(100% - 44px));
        margin: 0 auto;
    }

    .rc-hero {
        min-height: 300px;
        display: flex;
        align-items: center;
        background:
            linear-gradient(90deg, rgba(0,0,0,.88) 0%, rgba(0,0,0,.62) 38%, rgba(0,0,0,.10) 100%),
            url("{{ asset('images/logo/rc1.png') }}") center / cover no-repeat;
    }

    .rc-hero h1 {
        max-width: 560px;
        margin: 0;
        color: #fff;
        font-family: "Manrope", sans-serif;
        font-size: clamp(34px, 4vw, 56px);
        font-weight: 900;
        line-height: 1.05;
    }

    .rc-section {
        padding: 48px 0 0;
    }

    .rc-title {
        margin: 0 0 10px;
        color: #111;
        font-family: "Manrope", sans-serif;
        font-size: clamp(24px, 2.4vw, 34px);
        font-weight: 900;
        line-height: 1.2;
        text-align: center;
    }

    .rc-title.left {
        text-align: left;
    }

    .rc-line {
        width: 76px;
        height: 3px;
        margin: 0 auto 22px;
        border-radius: 999px;
        background: linear-gradient(90deg, var(--rc-orange), var(--rc-blue));
    }

    .rc-copy {
        color: #3f4650;
        font-size: 15px;
        font-weight: 600;
        line-height: 1.7;
    }

    .rc-copy.narrow {
        max-width: 1050px;
        margin: 0 auto;
    }

    .rc-copy p {
        margin: 0 0 12px;
    }

    .rc-chip-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 18px;
        margin-top: 24px;
    }

    .rc-chip {
        min-height: 72px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 14px 16px;
        border: 2px solid var(--rc-blue);
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

    .rc-chip:nth-child(even) {
        border-color: var(--rc-orange);
        background: #fff0e5;
    }

    .rc-project-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-top: 22px;
    }

    .rc-project {
        overflow: hidden;
        background: transparent;
    }

    .rc-project img {
        width: 100%;
        aspect-ratio: 1.2 / 1;
        display: block;
        object-fit: contain;
        filter: drop-shadow(0 10px 16px rgba(17,24,39,.12));
    }

    .rc-bullets {
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

    .rc-checks {
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

    .rc-process {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 14px;
        margin-top: 20px;
    }

    .rc-step {
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

    .rc-faq-list {
        max-width: 900px;
        margin: 24px auto 0;
        display: grid;
        gap: 12px;
    }

    .rc-faq {
        overflow: hidden;
        border: 1px solid var(--rc-line);
        border-radius: 6px;
        background: var(--rc-white);
        box-shadow: 0 4px 12px rgba(17,24,39,.10);
    }

    .rc-faq button {
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

    .rc-faq-answer {
        display: none;
        padding: 0 20px 16px;
        color: var(--rc-muted);
        font-size: 14px;
        font-weight: 500;
        line-height: 1.6;
    }

    .rc-faq.open .rc-faq-answer {
        display: block;
    }

    @media (max-width: 980px) {
        .rc-chip-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .rc-project-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .rc-bullets,
        .rc-checks,
        .rc-process {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 560px) {
        .rc-wrap {
            width: calc(100% - 24px);
        }

        .rc-hero {
            min-height: 240px;
        }

        .rc-hero h1 {
            font-size: 34px;
        }

        .rc-chip-grid,
        .rc-project-grid,
        .rc-bullets,
        .rc-checks,
        .rc-process {
            grid-template-columns: 1fr;
        }
    }
</style>

@php
    $scope = [
        'RCC & structural work',
        'Brickwork & plastering',
        'Finishing & interiors',
        'Labour & site management',
        'Material coordination',
    ];

    $includes = [
        'New Home Construction',
        'Core & Shell Construction',
        'Turnkey Residential Construction',
        'Renovation & Remodeling',
        'Finishing & Exterior Work',
    ];

    $projects = [
        ['title' => 'Bungalow & Villa Construction', 'img' => 'images/logo/rc2.png'],
        ['title' => 'Apartment & Residential Building Construction', 'img' => 'images/logo/rc3.png'],
        ['title' => 'Row House & Duplex Construction', 'img' => 'images/logo/rc4.png'],
        ['title' => 'Farmhouse & Weekend Home Construction', 'img' => 'images/logo/rc5.png'],
    ];

    $faqs = [
        ['q' => '1. What does a residential contractor do?', 'a' => 'A residential contractor manages home construction work such as civil structure, labour coordination, material planning, finishing, and site execution.'],
        ['q' => '2. Do you provide turnkey construction?', 'a' => 'Yes. ConstructKaro can help coordinate turnkey residential construction from planning and BOQ support to contractor assignment and execution.'],
        ['q' => '3. Can you construct as per my architect’s drawing?', 'a' => 'Yes. The project can be executed as per approved architectural and structural drawings.'],
        ['q' => '4. Do you provide labour + material contracts?', 'a' => 'Yes. Both labour-only and labour-with-material contract coordination can be handled based on your requirement.'],
        ['q' => '5. How do you ensure quality?', 'a' => 'We focus on structured execution, contractor verification, BOQ clarity, and stage-wise coordination for better quality control.'],
    ];
@endphp

<main class="rc-page">
    <section class="rc-hero">
        <div class="rc-wrap">
            <h1>Residential<br>Contractor</h1>
        </div>
    </section>

    <section class="rc-section">
        <div class="rc-wrap rc-copy narrow">
            <h2 class="rc-title left">Residential Contractor Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane</h2>
            <p>Building a home is one of the biggest investments in life, and choosing the right contractor is critical for smooth execution. At ConstructKaro, we connect you with verified and experienced Residential Contractors for villas, bungalows, apartments, row houses, and residential buildings.</p>
            <p>From foundation to finishing, we help ensure your project is executed with proper planning, quality workmanship, and timely coordination.</p>
        </div>
    </section>

    <section class="rc-section">
        <div class="rc-wrap">
            <h2 class="rc-title">What is a Residential Contractor?</h2>
            <div class="rc-line"></div>
            <p class="rc-copy">A residential contractor is responsible for managing and executing home construction projects, including:</p>

            <div class="rc-chip-grid">
                @foreach($scope as $item)
                    <div class="rc-chip">{{ $item }}</div>
                @endforeach
            </div>

            <p class="rc-copy" style="margin-top: 14px;">The contractor ensures your approved design is properly executed on-site.</p>
        </div>
    </section>

    <section class="rc-section">
        <div class="rc-wrap">
            <h2 class="rc-title">Our Residential Contractor Services Include</h2>
            <div class="rc-line"></div>

            <div class="rc-chip-grid">
                @foreach($includes as $item)
                    <div class="rc-chip">{{ $item }}</div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="rc-section">
        <div class="rc-wrap">
            <h2 class="rc-title">Types of Residential Construction Projects</h2>
            <div class="rc-line"></div>

            <div class="rc-project-grid">
                @foreach($projects as $project)
                    <article class="rc-project">
                        <img src="{{ asset($project['img']) }}" alt="{{ $project['title'] }}">
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="rc-section">
        <div class="rc-wrap">
            <h2 class="rc-title">Why Choose ConstructKaro?</h2>
            <div class="rc-line"></div>
            <div class="rc-bullets">
                <div>Verified residential contractors</div>
                <div>Structured execution process</div>
                <div>BOQ & cost planning support</div>
                <div>Quality-focused construction approach</div>
                <div>Single platform coordination</div>
            </div>
        </div>
    </section>

    <section class="rc-section">
        <div class="rc-wrap">
            <h2 class="rc-title">Why Choose ConstructKaro?</h2>
            <div class="rc-line"></div>
            <div class="rc-checks">
                <div>✓ Verified residential contractors</div>
                <div>✓ Structured execution process</div>
                <div>✓ BOQ & cost planning support</div>
                <div>✓ Quality-focused construction approach</div>
                <div>✓ Single platform coordination</div>
            </div>
            <p class="rc-copy" style="margin-top: 18px;">We help you build your dream home with better planning, transparency, and execution support.</p>
        </div>
    </section>

    <section class="rc-section">
        <div class="rc-wrap">
            <h2 class="rc-title">Our Construction Process</h2>
            <div class="rc-line"></div>
            <div class="rc-process">
                <div class="rc-step">1. Requirement Discussion</div>
                <div class="rc-step">2. Design & BOQ Review</div>
                <div class="rc-step">3. Contractor Assignment</div>
                <div class="rc-step">4. Construction Execution</div>
                <div class="rc-step">5. Quality Monitoring</div>
            </div>
        </div>
    </section>

    <section class="rc-section">
        <div class="rc-wrap rc-copy narrow">
            <h2 class="rc-title left">Target Locations We Serve</h2>
            <p>Residential Contractor in Navi Mumbai | Residential Contractor in Mumbai | Residential Contractor in Pune | Residential Contractor in Raigad | Residential Contractor in Thane</p>
        </div>
    </section>

    <section class="rc-section">
        <div class="rc-wrap">
            <h2 class="rc-title">Frequently Asked Questions (FAQs)</h2>
            <div class="rc-line"></div>

            <div class="rc-faq-list">
                @foreach($faqs as $index => $faq)
                    <article class="rc-faq" id="rc-faq-{{ $index }}">
                        <button type="button" onclick="toggleResidentialFaq({{ $index }})">{{ $faq['q'] }}</button>
                        <div class="rc-faq-answer">{{ $faq['a'] }}</div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</main>

<script>
    function toggleResidentialFaq(index) {
        const item = document.getElementById('rc-faq-' + index);
        const wasOpen = item.classList.contains('open');

        document.querySelectorAll('.rc-faq').forEach(function (faqItem) {
            faqItem.classList.remove('open');
        });

        if (!wasOpen) {
            item.classList.add('open');
        }
    }
</script>

@endsection
