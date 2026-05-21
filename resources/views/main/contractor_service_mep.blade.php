@extends('layouts.app')

@section('meta_title', 'MEP Contractor Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane | ConstructKaro')
@section('meta_description', 'MEP Contractor Services for electrical, plumbing, HVAC, firefighting, safety systems, utility coordination, BOQ and installation execution.')
@section('title', 'MEP Contractor Services | ConstructKaro')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@600;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --mep-blue: #0a82d9;
        --mep-orange: #f27a21;
        --mep-bg: #ededed;
        --mep-text: #111;
        --mep-muted: #4b5563;
        --mep-line: #cfd6de;
        --mep-white: #fff;
    }

    body {
        background: var(--mep-bg);
        font-family: "Inter", "Segoe UI", sans-serif;
        color: var(--mep-text);
    }

    .mep-page {
        background: var(--mep-bg);
        padding-bottom: 44px;
    }

    .mep-wrap {
        width: min(1180px, calc(100% - 44px));
        margin: 0 auto;
    }

    .mep-hero {
        min-height: 300px;
        display: flex;
        align-items: center;
        background:
            /* linear-gradient(90deg, rgba(0,0,0,.86) 0%, rgba(0,0,0,.52) 38%, rgba(0,0,0,.10) 100%), */
            url("{{ asset('images/logo/mc1.png') }}") center / cover no-repeat;
    }

    .mep-hero h1 {
        max-width: 660px;
        margin: 0;
        color: #fff;
        font-family: "Manrope", sans-serif;
        font-size: clamp(34px, 4vw, 58px);
        font-weight: 900;
        line-height: 1.05;
    }

    .mep-section {
        padding: 44px 0 0;
    }

    .mep-title {
        margin: 0 0 10px;
        color: #111;
        font-family: "Manrope", sans-serif;
        font-size: clamp(24px, 2.4vw, 34px);
        font-weight: 900;
        line-height: 1.2;
        text-align: center;
    }

    .mep-title.left {
        text-align: left;
    }

    .mep-line {
        width: 76px;
        height: 3px;
        margin: 0 auto 22px;
        border-radius: 999px;
        background: linear-gradient(90deg, var(--mep-orange), var(--mep-blue));
    }

    .mep-copy {
        color: #3f4650;
        font-size: 15px;
        font-weight: 600;
        line-height: 1.7;
    }

    .mep-copy.narrow {
        max-width: 1050px;
        margin: 0 auto;
    }

    .mep-copy p {
        margin: 0 0 12px;
    }

    .mep-chip-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 18px;
        margin-top: 24px;
    }

    .mep-chip {
        min-height: 72px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 14px 16px;
        border: 2px solid var(--mep-blue);
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

    .mep-chip:nth-child(even) {
        border-color: var(--mep-orange);
        background: #fff0e5;
    }

    .mep-number-grid {
        max-width: 980px;
        margin: 28px auto 0;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 28px;
    }

    .mep-number-card {
        min-height: 150px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 32px 18px 20px;
        border: 2px solid var(--mep-orange);
        border-radius: 8px;
        background: #fff0e5;
        color: #111;
        font-size: 13px;
        font-weight: 700;
        line-height: 1.35;
        text-align: center;
    }

    .mep-number-card:nth-child(even) {
        border-color: var(--mep-blue);
        background: #eaf6ff;
    }

    .mep-num {
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
        background: var(--mep-orange);
        color: #fff;
        font-family: "Manrope", sans-serif;
        font-weight: 900;
    }

    .mep-number-card:nth-child(even) .mep-num {
        background: var(--mep-blue);
    }

    .mep-number-card strong {
        display: block;
        margin-bottom: 8px;
        font-family: "Manrope", sans-serif;
        font-size: 14px;
        font-weight: 900;
    }

    .mep-project-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-top: 22px;
    }

    .mep-project {
        overflow: hidden;
        border: 2px solid var(--mep-blue);
        border-radius: 8px;
        background: #eaf6ff;
        box-shadow: 0 6px 16px rgba(17,24,39,.10);
    }

    .mep-project:nth-child(odd) {
        border-color: var(--mep-orange);
        background: #fff0e5;
    }

    .mep-project img {
        width: 100%;
        aspect-ratio: 1.25 / 1;
        display: block;
        object-fit: cover;
    }

    .mep-project h3 {
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

    .mep-checks {
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

    .mep-process {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 12px;
        margin-top: 20px;
    }

    .mep-step {
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

    .mep-faq-list {
        max-width: 900px;
        margin: 24px auto 0;
        display: grid;
        gap: 12px;
    }

    .mep-faq {
        overflow: hidden;
        border: 1px solid var(--mep-line);
        border-radius: 6px;
        background: var(--mep-white);
        box-shadow: 0 4px 12px rgba(17,24,39,.10);
    }

    .mep-faq button {
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

    .mep-faq-answer {
        display: none;
        padding: 0 20px 16px;
        color: var(--mep-muted);
        font-size: 14px;
        font-weight: 500;
        line-height: 1.6;
    }

    .mep-faq.open .mep-faq-answer {
        display: block;
    }

    @media (max-width: 980px) {
        .mep-chip-grid,
        .mep-project-grid,
        .mep-number-grid,
        .mep-checks,
        .mep-process {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 560px) {
        .mep-wrap {
            width: calc(100% - 24px);
        }

        .mep-hero {
            min-height: 240px;
        }

        .mep-hero h1 {
            font-size: 34px;
        }

        .mep-chip-grid,
        .mep-project-grid,
        .mep-number-grid,
        .mep-checks,
        .mep-process {
            grid-template-columns: 1fr;
        }
    }
</style>

@php
    $scope = [
        'Mechanical systems (HVAC & ventilation)',
        'Electrical systems & power distribution',
        'Plumbing & water supply systems',
        'Fire fighting & safety systems',
        'Utility coordination within buildings',
    ];

    $services = [
        ['title' => 'Mechanical (HVAC) Services', 'items' => ['HVAC system installation', 'Ventilation and exhaust systems', 'Ducting and air distribution', 'Chiller and AHU/VRF systems']],
        ['title' => 'Electrical Services', 'items' => ['Electrical distribution and panel work', 'Wiring and cable management', 'Load calculation and power distribution', 'Lighting and backup systems']],
        ['title' => 'Plumbing Services', 'items' => ['Water supply and drainage systems', 'Bathroom and kitchen plumbing', 'Underground and overhead piping', 'Pump and water tank connections']],
        ['title' => 'Fire Fighting Systems', 'items' => ['Fire hydrant systems', 'Sprinkler installation', 'Fire alarm systems', 'Fire safety compliance work']],
        ['title' => 'MEP Coordination & Execution', 'items' => ['MEP shop drawings', 'Utility coordination with civil work', 'BOQ and quantity estimation', 'Testing and commissioning support']],
    ];

    $projects = [
        ['title' => 'Residential MEP Projects', 'img' => 'images/logo/mc2.png'],
        ['title' => 'Commercial MEP Projects', 'img' => 'images/logo/mc3.png'],
        ['title' => 'Industrial MEP Projects', 'img' => 'images/logo/mc4.png'],
        ['title' => 'Fire Fighting & Utility Infrastructure', 'img' => 'images/logo/mc5.png'],
    ];

    $faqs = [
        ['q' => '1. What does MEP include?', 'a' => 'MEP includes mechanical systems, electrical systems, plumbing systems, HVAC, firefighting, safety systems, utility coordination and testing support.'],
        ['q' => '2. Do you provide HVAC installation services?', 'a' => 'Yes. HVAC support can include ducting, ventilation, air conditioning systems, exhaust systems and installation coordination.'],
        ['q' => '3. Can you handle industrial MEP projects?', 'a' => 'Yes. We can coordinate MEP work for industrial sheds, factories, warehouses, commercial buildings and residential projects.'],
        ['q' => '4. Do you provide fire fighting system installation?', 'a' => 'Yes. Fire hydrant systems, sprinkler systems, alarm systems and fire safety utility installation can be coordinated.'],
        ['q' => '5. Do you provide BOQ and estimation support?', 'a' => 'Yes. We support BOQ, quantity estimation, contractor assignment and execution coordination for MEP projects.'],
    ];
@endphp

<main class="mep-page">
    <section class="mep-hero">
        <div class="mep-wrap">
            <!-- <h1>MEP Contractor</h1> -->
        </div>
    </section>

    <section class="mep-section">
        <div class="mep-wrap mep-copy narrow">
            <h2 class="mep-title">MEP Contractor Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane</h2>
            <p>Efficient Mechanical, Electrical, and Plumbing systems are essential for every modern building. At ConstructKaro, we connect you with verified and experienced MEP Contractors for residential, commercial, industrial, and infrastructure projects.</p>
            <p>From electrical systems and HVAC installation to plumbing and fire fighting systems, we help ensure your project is executed with proper coordination, safety, and technical precision.</p>
        </div>
    </section>

    <section class="mep-section">
        <div class="mep-wrap">
            <h2 class="mep-title">What is an MEP Contractor?</h2>
            <div class="mep-line"></div>
            <p class="mep-copy">An MEP Contractor handles:</p>

            <div class="mep-chip-grid">
                @foreach($scope as $item)
                    <div class="mep-chip">{{ $item }}</div>
                @endforeach
            </div>

            <p class="mep-copy" style="margin-top: 14px;">These systems are critical for the functionality, safety, and efficiency of any property.</p>
        </div>
    </section>

    <section class="mep-section">
        <div class="mep-wrap">
            <h2 class="mep-title">Our MEP Contractor Services Include</h2>
            <div class="mep-line"></div>

            <div class="mep-number-grid">
                @foreach($services as $index => $service)
                    <article class="mep-number-card">
                        <span class="mep-num">{{ $index + 1 }}</span>
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

    <section class="mep-section">
        <div class="mep-wrap">
            <h2 class="mep-title">Types of MEP Projects</h2>
            <div class="mep-line"></div>

            <div class="mep-project-grid">
                @foreach($projects as $project)
                    <!-- <article class="mep-project"> -->
                        <img src="{{ asset($project['img']) }}" alt="{{ $project['title'] }}">
                        <!-- <h3>{{ $project['title'] }}</h3> -->
                    <!-- </article> -->
                @endforeach
            </div>
        </div>
    </section>

    <section class="mep-section">
        <div class="mep-wrap">
            <h2 class="mep-title">Why Choose ConstructKaro?</h2>
            <div class="mep-line"></div>
            <div class="mep-checks">
                <div>&#10003; Verified MEP contractors</div>
                <div>&#10003; Coordinated mechanical, electrical and plumbing execution</div>
                <div>&#10003; BOQ and quantity estimation support</div>
                <div>&#10003; Quality-focused installation standards</div>
                <div>&#10003; Suitable for residential, commercial and industrial projects</div>
            </div>
            <p class="mep-copy" style="margin-top: 18px;">We help ensure your building systems are efficient, safe, and professionally executed.</p>
        </div>
    </section>

    <section class="mep-section">
        <div class="mep-wrap">
            <h2 class="mep-title">Our Execution Process</h2>
            <div class="mep-line"></div>
            <div class="mep-process">
                <div class="mep-step">1. Requirement Discussion</div>
                <div class="mep-step">2. Site Inspection & Utility Planning</div>
                <div class="mep-step">3. MEP Design & BOQ Review</div>
                <div class="mep-step">4. Contractor Assignment</div>
                <div class="mep-step">5. MEP Installation & Execution</div>
                <div class="mep-step">6. Testing, Commissioning & Completion</div>
            </div>
        </div>
    </section>

    <section class="mep-section">
        <div class="mep-wrap mep-copy narrow">
            <h2 class="mep-title left">Target Locations We Serve</h2>
            <p>MEP Contractor in Navi Mumbai | MEP Services in Mumbai | Mechanical Electrical Plumbing Contractor in Pune | HVAC & Plumbing Contractor in Raigad | Fire Fighting Contractor in Thane</p>
            <p>Also serving Panvel, Kharghar, Taloja, Khopoli, Karjat, Khopoli and nearby areas.</p>
        </div>
    </section>

    <section class="mep-section">
        <div class="mep-wrap">
            <h2 class="mep-title">Frequently Asked Questions (FAQs)</h2>
            <div class="mep-line"></div>

            <div class="mep-faq-list">
                @foreach($faqs as $index => $faq)
                    <article class="mep-faq" id="mep-faq-{{ $index }}">
                        <button type="button" onclick="toggleMepFaq({{ $index }})">{{ $faq['q'] }}</button>
                        <div class="mep-faq-answer">{{ $faq['a'] }}</div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</main>

<script>
    function toggleMepFaq(index) {
        const item = document.getElementById('mep-faq-' + index);
        const wasOpen = item.classList.contains('open');

        document.querySelectorAll('.mep-faq').forEach(function (faqItem) {
            faqItem.classList.remove('open');
        });

        if (!wasOpen) {
            item.classList.add('open');
        }
    }
</script>

@endsection
