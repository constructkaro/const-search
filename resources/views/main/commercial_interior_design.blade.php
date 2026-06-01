@extends('layouts.app')

@section('title', 'Commercial Interior Design')

@section('content')
<style>
    body {
        background: #e9e9e9;
        color: #262626;
        font-family: "Poppins", Arial, sans-serif;
    }

    .com-hero {
        min-height: 330px;
        background:
            linear-gradient(90deg, rgba(0,0,0,.90) 0%, rgba(0,0,0,.72) 38%, rgba(0,0,0,.18) 100%),
            url("{{ asset('images/logo/i3.png') }}");
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        padding: 48px 36px;
    }

    .com-hero h1 {
        margin: 0;
        color: #fff;
        font-size: 52px;
        line-height: 1.12;
        font-weight: 900;
        letter-spacing: .2px;
        max-width: 720px;
        text-shadow: 0 5px 14px rgba(0,0,0,.45);
    }

    .com-page {
        background: #e9e9e9;
        padding: 42px 18px 70px;
    }

    .com-wrap {
        max-width: 1180px;
        margin: 0 auto;
    }

    .com-section {
        margin-bottom: 56px;
    }

    .com-title {
        margin: 0;
        text-align: center;
        color: #252525;
        font-size: 28px;
        line-height: 1.25;
        font-weight: 900;
    }

    .com-title.small {
        font-size: 24px;
    }

    .com-line {
        width: 560px;
        max-width: 70%;
        height: 3px;
        margin: 12px auto 28px;
        background: linear-gradient(90deg, #f37021 0 50%, #1e73be 50% 100%);
        border-radius: 20px;
    }

    .com-text {
        max-width: 1100px;
        margin: 0 auto 18px;
        color: #4c4c4c;
        font-size: 15px;
        line-height: 1.55;
        font-weight: 500;
    }

    .com-text strong {
        color: #252525;
        font-weight: 900;
    }

    .pill-row {
        display: grid;
        grid-template-columns: repeat(7, minmax(0, 1fr));
        gap: 8px;
        margin: 22px auto;
    }

    .pill {
        min-height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 6px 8px;
        background: #eaf4ff;
        border: 2px solid #1e73be;
        border-radius: 4px;
        color: #111;
        font-size: 11px;
        font-weight: 900;
        line-height: 1.2;
    }

    .pill.orange {
        background: #fff0e6;
        border-color: #f37021;
    }

    .service-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 48px 40px;
        max-width: 940px;
        margin: 0 auto;
    }

    .service-card {
        position: relative;
        min-height: 145px;
        background: #fff0e6;
        border: 2px solid #f37021;
        border-radius: 10px;
        padding: 30px 18px 18px;
        box-shadow: 0 5px 7px rgba(0,0,0,.18);
    }

    .service-card.blue {
        background: #eaf4ff;
        border-color: #1e73be;
    }

    .service-num {
        position: absolute;
        top: -14px;
        left: 50%;
        transform: translateX(-50%);
        width: 26px;
        height: 26px;
        border-radius: 5px;
        background: #f37021;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        font-weight: 900;
    }

    .service-card.blue .service-num {
        background: #1e73be;
    }

    .service-card h3 {
        margin: 0 0 16px;
        text-align: center;
        color: #f37021;
        font-size: 15px;
        line-height: 1.25;
        font-weight: 900;
    }

    .service-card.blue h3 {
        color: #1e73be;
    }

    .service-card ul {
        margin: 0;
        padding-left: 28px;
        color: #111;
        font-size: 10px;
        line-height: 1.55;
        font-weight: 700;
    }

    .project-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        max-width: 900px;
        margin: 0 auto;
    }

    .project-card {
        background: #fff0e6;
        border: 2px solid #f37021;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0,0,0,.16);
    }

    .project-card.blue {
        background: #eaf4ff;
        border-color: #1e73be;
    }

    .project-card img {
        width: 100%;
        height: 118px;
        object-fit: cover;
        display: block;
    }

    .project-card h3 {
        min-height: 45px;
        margin: 0;
        padding: 8px 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #111;
        font-size: 10px;
        line-height: 1.15;
        font-weight: 900;
    }

    .style-row {
        display: flex;
        justify-content: center;
        gap: 18px;
        flex-wrap: wrap;
        max-width: 1040px;
        margin: 0 auto;
        color: #111;
        font-size: 12px;
        font-weight: 900;
        line-height: 1.6;
    }

    .style-row span::before,
    .check-item::before {
        content: "✓ ";
        font-weight: 900;
    }

    .check-grid {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 18px;
        margin: 0 auto 18px;
    }

    .check-item {
        text-align: center;
        color: #111;
        font-size: 11px;
        line-height: 1.25;
        font-weight: 900;
    }

    .center-note {
        max-width: 950px;
        margin: 16px auto 0;
        text-align: center;
        color: #4c4c4c;
        font-size: 11px;
        font-weight: 600;
    }

    .process-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 24px;
        max-width: 960px;
        margin: 0 auto;
    }

    .process-item {
        text-align: center;
        color: #111;
        font-size: 11px;
        line-height: 1.2;
        font-weight: 900;
    }

    .location-block {
        max-width: 1080px;
        margin: 0 auto 36px;
        color: #111;
        font-size: 12px;
        line-height: 1.7;
        font-weight: 700;
    }

    .location-block h3 {
        margin: 0 0 6px;
        color: #111;
        font-size: 14px;
        font-weight: 900;
    }

    .location-block ul {
        margin: 0;
        padding-left: 18px;
    }

    .faq-wrap {
        max-width: 680px;
        margin: 0 auto;
    }

    .faq-item {
        background: #fff;
        border-radius: 4px;
        margin-bottom: 12px;
        box-shadow: 0 2px 5px rgba(0,0,0,.2);
        overflow: hidden;
    }

    .faq-question {
        width: 100%;
        border: none;
        background: #fff;
        color: #111;
        padding: 16px 22px;
        text-align: left;
        font-size: 12px;
        font-weight: 900;
        cursor: pointer;
    }

    .faq-answer {
        display: none;
        padding: 0 22px 16px;
        color: #4c4c4c;
        font-size: 12px;
        line-height: 1.5;
        font-weight: 600;
    }

    .faq-item.active .faq-answer {
        display: block;
    }

    @media (max-width: 900px) {
        .com-hero h1 {
            font-size: 38px;
        }

        .pill-row,
        .service-grid,
        .project-grid,
        .check-grid,
        .process-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 560px) {
        .com-hero {
            min-height: 260px;
            padding: 34px 20px;
        }

        .com-hero h1 {
            font-size: 30px;
        }

        .com-title,
        .com-title.small {
            font-size: 21px;
        }

        .pill-row,
        .service-grid,
        .project-grid,
        .check-grid,
        .process-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="com-hero">
    <h1>Commercial Interior<br>Design</h1>
</section>

<main class="com-page">
    <div class="com-wrap">
        <section class="com-section">
            <h2 class="com-title">Commercial Interior Design Services in Navi Mumbai, Mumbai, Pune, Raigad &amp; Thane</h2>
            <div class="com-line"></div>

            <p class="com-text">
                A well-designed commercial space enhances productivity, improves customer experience, and strengthens your brand identity. At <strong>ConstructKaro</strong>, we provide professional <strong>Commercial Interior Design</strong> Services for offices, retail outlets, showrooms, restaurants, hotels, clinics, educational institutions, and commercial complexes.
            </p>
            <p class="com-text">
                Our commercial interior designers focus on creating spaces that are functional, visually appealing, and optimized for business growth while reflecting your brand's personality and operational requirements.
            </p>
        </section>

        <section class="com-section">
            <h2 class="com-title small">What is Commercial Interior Design?</h2>
            <div class="com-line"></div>

            <p class="com-text">
                <strong>Commercial Interior Design</strong> is the process of planning, designing, and executing interior spaces for businesses and commercial establishments.
            </p>
            <p class="com-text">It includes:</p>

            <div class="pill-row">
                <div class="pill">Space planning</div>
                <div class="pill orange">Workplace layout</div>
                <div class="pill">Retail design</div>
                <div class="pill orange">Furniture planning</div>
                <div class="pill">Lighting design</div>
                <div class="pill orange">Brand integration</div>
                <div class="pill">Material selection</div>
            </div>

            <p class="com-text">The goal is to create a professional environment that improves workflow, customer engagement, and overall business performance.</p>
        </section>

        <section class="com-section">
            <h2 class="com-title">Our Commercial Interior Design Services Include</h2>
            <div class="com-line"></div>

            <div class="service-grid">
                @php
                    $services = [
                        ['Office Interior Design', ['Reception and waiting areas', 'Workstation layouts', 'Conference rooms', 'Cabin and storage design'], false],
                        ['Retail & Showroom Interior Design', ['Product display planning', 'Customer movement flow', 'Brand-focused interiors', 'Counter and billing zone optimization'], true],
                        ['Restaurant & Cafe Interior Design', ['Dining area layouts', 'Theme-based interiors', 'Kitchen and service coordination', 'Lighting and seating concepts'], false],
                        ['Clinic & Healthcare Interior Design', ['Reception and consultation areas', 'Patient-friendly layouts', 'Clean and calming interiors', 'Storage and utility planning'], true],
                        ['Co-working & Cabin Interiors', ['Flexible desk layouts', 'Meeting rooms', 'Private cabins', 'Breakout and pantry spaces'], false],
                        ['Turnkey Commercial Interior Solutions', ['Design to execution', 'Furniture coordination', 'MEP and electrical planning', 'Site supervision'], true],
                    ];
                @endphp

                @foreach($services as $service)
                    <div class="service-card {{ $service[2] ? 'blue' : '' }}">
                        <div class="service-num">{{ $loop->iteration }}</div>
                        <h3>{{ $service[0] }}</h3>
                        <ul>
                            @foreach($service[1] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="com-section">
            <h2 class="com-title small">Types of Commercial Interior Design Projects</h2>
            <div class="com-line"></div>

            <div class="project-grid">
                <!-- <div class="project-card"> -->
                    <img src="{{ asset('images/logo/ci1.png') }}" alt="Office Interior Design">
                    <!-- <h3>Office Interior Design</h3>
                </div> -->
                <!-- <div class="project-card blue"> -->
                    <img src="{{ asset('images/logo/ci2.png') }}" alt="Retail and Showroom Interior Design">
                    <!-- <h3>Retail &amp; Showroom Interior<br>Design</h3>
                </div> -->
                <!-- <div class="project-card"> -->
                    <img src="{{ asset('images/logo/ci3.png') }}" alt="Restaurant and Hospitality Interior Design">
                    <!-- <h3>Restaurant &amp; Hospitality<br>Interior Design</h3>
                </div> -->
                <!-- <div class="project-card blue"> -->
                    <img src="{{ asset('images/logo/ci4.png') }}" alt="Commercial Complex Interior Design">
                    <!-- <h3>Commercial Complex &amp;<br>Institutional Interiors</h3>
                </div> -->
            </div>
        </section>

        <section class="com-section">
            <h2 class="com-title small">Popular Commercial Interior Design Styles</h2>
            <div class="com-line"></div>
            <div class="style-row">
                <span>Modern Commercial Interiors</span>
                <span>Corporate Interior Design</span>
                <span>Industrial Interior Design</span>
                <span>Contemporary Workspace Design</span>
                <span>Luxury Commercial Interiors</span>
                <span>Minimalist Office Design</span>
                <span>Brand-Centric Interior Design</span>
                <span>Functional Retail Design</span>
            </div>
        </section>

        <section class="com-section">
            <h2 class="com-title small">Why Commercial Interior Design is Important?</h2>
            <div class="com-line"></div>
            <div class="check-grid">
                <div class="check-item">Enhances<br>brand image</div>
                <div class="check-item">Improves employee<br>productivity</div>
                <div class="check-item">Creates better<br>customer experience</div>
                <div class="check-item">Optimizes<br>workflow</div>
                <div class="check-item">Increases<br>operational efficiency</div>
                <div class="check-item">Supports<br>business growth</div>
            </div>
        </section>

        <section class="com-section">
            <h2 class="com-title small">Why Choose ConstructKaro?</h2>
            <div class="com-line"></div>
            <div class="check-grid">
                <div class="check-item">Experienced<br>commercial<br>interior designers</div>
                <div class="check-item">Space planning &amp;<br>brand experience<br>integration</div>
                <div class="check-item">3D design and<br>visualization<br>support</div>
                <div class="check-item">Turnkey<br>execution<br>solution</div>
                <div class="check-item">MEP and<br>fit-out<br>coordination</div>
                <div class="check-item">Suitable for small<br>businesses to large<br>commercial projects</div>
            </div>
            <p class="center-note">We help businesses create functional, professional, and visually impressive commercial spaces that support long-term success.</p>
        </section>

        <section class="com-section">
            <h2 class="com-title small">Our Interior Design Process</h2>
            <div class="com-line"></div>
            <div class="process-grid">
                <div class="process-item">1. Requirement<br>Discussion</div>
                <div class="process-item">2. Site Visit &amp;<br>Measurement</div>
                <div class="process-item">3. Concept Design &amp;<br>Space Planning</div>
                <div class="process-item">4. 3D Visualization<br>&amp; Approval</div>
                <div class="process-item">5. Material<br>Selection</div>
                <div class="process-item">6. Commercial<br>Interior Execution</div>
                <div class="process-item">7. Final Handover</div>
            </div>
        </section>

        <section class="com-section">
            <div class="location-block">
                <h3>Target Locations We Serve</h3>
                <strong>Commercial Interior Design Services</strong>
                <ul>
                    <li>Commercial Interior Designer in Navi Mumbai</li>
                    <li>Office Interior Design Services in Mumbai</li>
                    <li>Commercial Interior Designer in Pune</li>
                    <li>Retail Interior Design Services in Raigad</li>
                    <li>Office Interior Designer in Thane</li>
                </ul>
            </div>

            <div class="location-block">
                <h3>Additional Locations</h3>
                <ul>
                    <li>Commercial Interior Designer in Panvel</li>
                    <li>Office Interior Designer in Kharghar</li>
                    <li>Showroom Interior Designer in Vashi</li>
                    <li>Commercial Interior Designer in Khopoli</li>
                    <li>Interior Design Services in Alibaug</li>
                </ul>
            </div>
        </section>

        <section class="com-section">
            <h2 class="com-title small">Frequently Asked Questions (FAQs)</h2>
            <div class="com-line"></div>

            <div class="faq-wrap">
                @php
                    $faqs = [
                        ['What types of commercial spaces do you design?', 'We support office interiors, showrooms, retail outlets, restaurants, cafes, clinics, co-working spaces, commercial complexes, and institutional interiors.'],
                        ['Do you provide turnkey commercial interior solutions?', 'Yes, turnkey support can include design, planning, material selection, execution coordination, furniture, MEP coordination, and handover.'],
                        ['Can you provide 3D commercial interior designs?', 'Yes, 3D visualization can be provided depending on project scope and approval requirements.'],
                        ['Do you handle office fit-outs and MEP coordination?', 'Yes, commercial interior planning can include fit-out work, electrical planning, lighting, HVAC, plumbing, and site coordination.'],
                        ['How much does commercial interior design cost?', 'Cost depends on area, business type, material quality, furniture scope, MEP requirements, and execution timeline.'],
                    ];
                @endphp

                @foreach($faqs as $faq)
                    <div class="faq-item">
                        <button type="button" class="faq-question">{{ $loop->iteration }}. {{ $faq[0] }}</button>
                        <div class="faq-answer">{{ $faq[1] }}</div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
</main>

<script>
    document.querySelectorAll('.faq-question').forEach(function(button){
        button.addEventListener('click', function(){
            this.closest('.faq-item').classList.toggle('active');
        });
    });
</script>
@endsection
