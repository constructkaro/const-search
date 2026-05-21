@extends('layouts.app')

@section('meta_title', 'Commercial Contractor Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane | ConstructKaro')
@section('meta_description', 'Commercial Contractor Services for office buildings, showrooms, commercial complexes, interiors, RCC work, turnkey construction and infrastructure utility work.')
@section('title', 'Commercial Contractor Services | ConstructKaro')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@600;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --cm-blue: #0a82d9;
        --cm-orange: #f27a21;
        --cm-bg: #ededed;
        --cm-text: #111;
        --cm-muted: #4b5563;
        --cm-line: #cfd6de;
        --cm-white: #fff;
    }

    body {
        background: var(--cm-bg);
        font-family: "Inter", "Segoe UI", sans-serif;
        color: var(--cm-text);
    }

    .cm-page {
        background: var(--cm-bg);
        padding-bottom: 44px;
    }

    .cm-wrap {
        width: min(1180px, calc(100% - 44px));
        margin: 0 auto;
    }

    .cm-hero {
        min-height: 300px;
        display: flex;
        align-items: center;
        background:
            /* linear-gradient(90deg, rgba(0,0,0,.84) 0%, rgba(0,0,0,.50) 38%, rgba(0,0,0,.08) 100%), */
            url("{{ asset('images/logo/coc1.png') }}") center / cover no-repeat;
    }

    .cm-hero h1 {
        max-width: 660px;
        margin: 0;
        color: #fff;
        font-family: "Manrope", sans-serif;
        font-size: clamp(34px, 4vw, 58px);
        font-weight: 900;
        line-height: 1.05;
    }

    .cm-section {
        padding: 44px 0 0;
    }

    .cm-title {
        margin: 0 0 10px;
        color: #111;
        font-family: "Manrope", sans-serif;
        font-size: clamp(24px, 2.4vw, 34px);
        font-weight: 900;
        line-height: 1.2;
        text-align: center;
    }

    .cm-title.left {
        text-align: left;
    }

    .cm-line {
        width: 76px;
        height: 3px;
        margin: 0 auto 22px;
        border-radius: 999px;
        background: linear-gradient(90deg, var(--cm-orange), var(--cm-blue));
    }

    .cm-copy {
        color: #3f4650;
        font-size: 15px;
        font-weight: 600;
        line-height: 1.7;
    }

    .cm-copy.narrow {
        max-width: 1050px;
        margin: 0 auto;
    }

    .cm-copy p {
        margin: 0 0 12px;
    }

    .cm-chip-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 18px;
        margin-top: 24px;
    }

    .cm-chip {
        min-height: 72px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 14px 16px;
        border: 2px solid var(--cm-blue);
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

    .cm-chip:nth-child(even) {
        border-color: var(--cm-orange);
        background: #fff0e5;
    }

    .cm-number-grid {
        max-width: 980px;
        margin: 28px auto 0;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 28px;
    }

    .cm-number-card {
        min-height: 150px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 32px 18px 20px;
        border: 2px solid var(--cm-orange);
        border-radius: 8px;
        background: #fff0e5;
        color: #111;
        font-size: 13px;
        font-weight: 700;
        line-height: 1.35;
        text-align: center;
    }

    .cm-number-card:nth-child(even) {
        border-color: var(--cm-blue);
        background: #eaf6ff;
    }

    .cm-num {
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
        background: var(--cm-orange);
        color: #fff;
        font-family: "Manrope", sans-serif;
        font-weight: 900;
    }

    .cm-number-card:nth-child(even) .cm-num {
        background: var(--cm-blue);
    }

    .cm-number-card strong {
        display: block;
        margin-bottom: 8px;
        font-family: "Manrope", sans-serif;
        font-size: 14px;
        font-weight: 900;
    }

    .cm-project-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-top: 22px;
    }

    .cm-project {
        overflow: hidden;
        border: 2px solid var(--cm-blue);
        border-radius: 8px;
        background: #eaf6ff;
        box-shadow: 0 6px 16px rgba(17,24,39,.10);
    }

    .cm-project:nth-child(odd) {
        border-color: var(--cm-orange);
        background: #fff0e5;
    }

    .cm-project img {
        width: 100%;
        aspect-ratio: 1.25 / 1;
        display: block;
        object-fit: cover;
    }

    .cm-project h3 {
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

    .cm-checks {
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

    .cm-process {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 12px;
        margin-top: 20px;
    }

    .cm-step {
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

    .cm-faq-list {
        max-width: 900px;
        margin: 24px auto 0;
        display: grid;
        gap: 12px;
    }

    .cm-faq {
        overflow: hidden;
        border: 1px solid var(--cm-line);
        border-radius: 6px;
        background: var(--cm-white);
        box-shadow: 0 4px 12px rgba(17,24,39,.10);
    }

    .cm-faq button {
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

    .cm-faq-answer {
        display: none;
        padding: 0 20px 16px;
        color: var(--cm-muted);
        font-size: 14px;
        font-weight: 500;
        line-height: 1.6;
    }

    .cm-faq.open .cm-faq-answer {
        display: block;
    }

    @media (max-width: 980px) {
        .cm-chip-grid,
        .cm-project-grid,
        .cm-number-grid,
        .cm-checks,
        .cm-process {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 560px) {
        .cm-wrap {
            width: calc(100% - 24px);
        }

        .cm-hero {
            min-height: 240px;
        }

        .cm-hero h1 {
            font-size: 34px;
        }

        .cm-chip-grid,
        .cm-project-grid,
        .cm-number-grid,
        .cm-checks,
        .cm-process {
            grid-template-columns: 1fr;
        }
    }
</style>

@php
    $scope = [
        'Commercial building construction',
        'RCC & structural work',
        'Interior & exterior finishing',
        'Site management & coordination',
        'Infrastructure & utility development',
    ];

    $services = [
        ['title' => 'Commercial Building Construction', 'items' => ['Office building execution', 'Retail and shop construction', 'Small factory and warehouse construction', 'Mixed-use development projects']],
        ['title' => 'Core & Shell Construction', 'items' => ['Excavation and foundation work', 'RCC frame and slab construction', 'Columns, beams and walls', 'Infrastructure and plinthing']],
        ['title' => 'Turnkey Commercial Construction', 'items' => ['Complete end-to-end execution', 'Civil, structural and finishing work', 'Interior and exterior finishing', 'Handover-ready commercial spaces']],
        ['title' => 'Commercial Interior Fit-Out', 'items' => ['Office interiors', 'Showroom fit-outs', 'Partition and false ceiling work', 'MEP and lighting coordination']],
        ['title' => 'Infrastructure & Utility Work', 'items' => ['Drainage and water supply systems', 'Electrical utility support', 'Parking and access development', 'Safety and service integration work']],
    ];

    $projects = [
        ['title' => 'Office Building Construction', 'img' => 'images/logo/coc2.png'],
        ['title' => 'Retail & Showroom Construction', 'img' => 'images/logo/coc3.png'],
        ['title' => 'Commercial Complex Projects', 'img' => 'images/logo/coc4.png'],
        ['title' => 'Warehouse & Industrial Commercial Projects', 'img' => 'images/logo/coc5.png'],
    ];

    $faqs = [
        ['q' => '1. What types of commercial projects do you handle?', 'a' => 'We help with office buildings, showrooms, retail spaces, commercial complexes, warehouses, industrial commercial spaces and fit-out projects.'],
        ['q' => '2. Do you provide turnkey commercial construction?', 'a' => 'Yes. Turnkey execution can include civil work, RCC, finishing, utilities, interiors and handover-ready commercial spaces.'],
        ['q' => '3. Can you handle commercial interiors and fit-outs?', 'a' => 'Yes. We can coordinate office interiors, showroom fit-outs, partitions, ceilings, finishing and utility integration.'],
        ['q' => '4. Do you provide BOQ and estimation support?', 'a' => 'Yes. We support BOQ preparation, quantity estimation, cost planning and contractor assignment for commercial projects.'],
        ['q' => '5. How do you ensure project quality?', 'a' => 'Project quality is supported through verified contractors, planned execution, regular monitoring, BOQ-based scope control and structured handover.'],
    ];
@endphp

<main class="cm-page">
    <section class="cm-hero">
        <div class="cm-wrap">
            <!-- <h1>Commercial<br>Contractor</h1> -->
        </div>
    </section>

    <section class="cm-section">
        <div class="cm-wrap cm-copy narrow">
            <h2 class="cm-title">Commercial Contractor Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane</h2>
            <p>Commercial projects require strong planning, quality execution, and efficient project management. At ConstructKaro, we connect you with verified and experienced Commercial Contractors for offices, retail spaces, showrooms, commercial complexes, warehouses, and mixed-use developments.</p>
            <p>From structure to finishing, we help ensure your commercial project is executed professionally, efficiently, and according to your business requirements.</p>
        </div>
    </section>

    <section class="cm-section">
        <div class="cm-wrap">
            <h2 class="cm-title">What Does a Commercial Contractor Do?</h2>
            <div class="cm-line"></div>
            <p class="cm-copy">A commercial contractor manages and executes:</p>

            <div class="cm-chip-grid">
                @foreach($scope as $item)
                    <div class="cm-chip">{{ $item }}</div>
                @endforeach
            </div>

            <p class="cm-copy" style="margin-top: 14px;">These contractors ensure your commercial space is functional, durable, and ready for business operations.</p>
        </div>
    </section>

    <section class="cm-section">
        <div class="cm-wrap">
            <h2 class="cm-title">Our Commercial Contractor Services Include</h2>
            <div class="cm-line"></div>

            <div class="cm-number-grid">
                @foreach($services as $index => $service)
                    <article class="cm-number-card">
                        <span class="cm-num">{{ $index + 1 }}</span>
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

    <section class="cm-section">
        <div class="cm-wrap">
            <h2 class="cm-title">Types of Commercial Construction Projects</h2>
            <div class="cm-line"></div>

            <div class="cm-project-grid">
                @foreach($projects as $project)
                    <!-- <article class="cm-project"> -->
                        <img src="{{ asset($project['img']) }}" alt="{{ $project['title'] }}">
                        <!-- <h3>{{ $project['title'] }}</h3> -->
                    <!-- </article> -->
                @endforeach
            </div>
        </div>
    </section>

    <section class="cm-section">
        <div class="cm-wrap">
            <h2 class="cm-title">Why Choose ConstructKaro?</h2>
            <div class="cm-line"></div>
            <div class="cm-checks">
                <div>&#10003; Verified commercial contractors</div>
                <div>&#10003; Structured project execution process</div>
                <div>&#10003; BOQ and cost estimation support</div>
                <div>&#10003; Quality-focused commercial construction</div>
                <div>&#10003; Single platform coordination</div>
            </div>
            <p class="cm-copy" style="margin-top: 18px;">We help businesses execute projects with better planning, transparency, and professional support.</p>
        </div>
    </section>

    <section class="cm-section">
        <div class="cm-wrap">
            <h2 class="cm-title">Our Execution Process</h2>
            <div class="cm-line"></div>
            <div class="cm-process">
                <div class="cm-step">1. Requirement Discussion</div>
                <div class="cm-step">2. Drawing & BOQ Review</div>
                <div class="cm-step">3. Contractor Assignment</div>
                <div class="cm-step">4. Commercial Construction Execution</div>
                <div class="cm-step">5. Quality Monitoring</div>
                <div class="cm-step">6. Project Completion & Handover</div>
            </div>
        </div>
    </section>

    <section class="cm-section">
        <div class="cm-wrap cm-copy narrow">
            <h2 class="cm-title left">Target Locations We Serve</h2>
            <p>Commercial Contractor in Navi Mumbai | Commercial Construction Contractor in Mumbai | Commercial Building Services in Pune | Commercial Contractor in Raigad | Office & Showroom Contractor in Thane</p>
        </div>
    </section>

    <section class="cm-section">
        <div class="cm-wrap">
            <h2 class="cm-title">Frequently Asked Questions (FAQs)</h2>
            <div class="cm-line"></div>

            <div class="cm-faq-list">
                @foreach($faqs as $index => $faq)
                    <article class="cm-faq" id="cm-faq-{{ $index }}">
                        <button type="button" onclick="toggleCommercialFaq({{ $index }})">{{ $faq['q'] }}</button>
                        <div class="cm-faq-answer">{{ $faq['a'] }}</div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</main>

<script>
    function toggleCommercialFaq(index) {
        const item = document.getElementById('cm-faq-' + index);
        const wasOpen = item.classList.contains('open');

        document.querySelectorAll('.cm-faq').forEach(function (faqItem) {
            faqItem.classList.remove('open');
        });

        if (!wasOpen) {
            item.classList.add('open');
        }
    }
</script>

@endsection
