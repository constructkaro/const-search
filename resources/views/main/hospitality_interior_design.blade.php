@extends('layouts.app')

@section('title', 'Hospitality Interior Design')

@section('content')
<style>
    body {
        background: #e9e9e9;
        color: #262626;
        font-family: "Poppins", Arial, sans-serif;
    }

    .hosp-hero {
        min-height: 330px;
        background:
            linear-gradient(90deg, rgba(0,0,0,.90) 0%, rgba(0,0,0,.72) 38%, rgba(0,0,0,.18) 100%),
            url("{{ asset('images/logo/i5.png') }}");
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        padding: 48px 36px;
    }

    .hosp-hero h1 {
        margin: 0;
        color: #fff;
        font-size: 52px;
        line-height: 1.12;
        font-weight: 900;
        letter-spacing: .2px;
        max-width: 720px;
        text-shadow: 0 5px 14px rgba(0,0,0,.45);
    }

    .hosp-page {
        background: #e9e9e9;
        padding: 42px 18px 70px;
    }

    .hosp-wrap {
        max-width: 1180px;
        margin: 0 auto;
    }

    .hosp-section {
        margin-bottom: 56px;
    }

    .hosp-title {
        margin: 0;
        text-align: center;
        color: #252525;
        font-size: 28px;
        line-height: 1.25;
        font-weight: 900;
    }

    .hosp-title.small {
        font-size: 24px;
    }

    .hosp-line {
        width: 560px;
        max-width: 70%;
        height: 3px;
        margin: 12px auto 28px;
        background: linear-gradient(90deg, #f37021 0 50%, #1e73be 50% 100%);
        border-radius: 20px;
    }

    .hosp-text {
        max-width: 1100px;
        margin: 0 auto 18px;
        color: #4c4c4c;
        font-size: 15px;
        line-height: 1.55;
        font-weight: 500;
    }

    .hosp-text strong {
        color: #252525;
        font-weight: 900;
    }

    .pill-row {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
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
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        max-width: 920px;
        margin: 0 auto;
    }

    .style-box {
        background: #fff0e6;
        border: 2px solid #f37021;
        border-radius: 8px;
        padding: 18px;
        min-height: 118px;
        box-shadow: 0 4px 6px rgba(0,0,0,.12);
    }

    .style-box.blue {
        background: #eaf4ff;
        border-color: #1e73be;
    }

    .style-box h3 {
        margin: 0 0 8px;
        color: #111;
        font-size: 14px;
        line-height: 1.2;
        font-weight: 900;
    }

    .style-box p {
        margin: 0;
        color: #444;
        font-size: 10px;
        line-height: 1.45;
        font-weight: 700;
    }

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
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 18px;
        max-width: 980px;
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
        .hosp-hero h1 {
            font-size: 38px;
        }

        .pill-row,
        .service-grid,
        .project-grid,
        .style-row,
        .check-grid,
        .process-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 560px) {
        .hosp-hero {
            min-height: 260px;
            padding: 34px 20px;
        }

        .hosp-hero h1 {
            font-size: 30px;
        }

        .hosp-title,
        .hosp-title.small {
            font-size: 21px;
        }

        .pill-row,
        .service-grid,
        .project-grid,
        .style-row,
        .check-grid,
        .process-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="hosp-hero">
    <h1>Hospitality Interior<br>Design</h1>
</section>

<main class="hosp-page">
    <div class="hosp-wrap">
        <section class="hosp-section">
            <h2 class="hosp-title">Hospitality Interior Design Services in Navi Mumbai, Mumbai, Pune, Raigad &amp; Thane</h2>
            <div class="hosp-line"></div>

            <p class="hosp-text">
                In the hospitality industry, first impressions matter. A thoughtfully designed hotel, resort, restaurant, cafe, or guest accommodation can significantly enhance guest satisfaction, brand perception, and business success. At <strong>ConstructKaro</strong>, we provide expert Hospitality Interior Design Services that are functional, aesthetic, brand-focused, and operationally efficient.
            </p>
            <p class="hosp-text">
                Our designers create welcoming and memorable environments that reflect your brand identity while ensuring an exceptional guest experience.
            </p>
        </section>

        <section class="hosp-section">
            <h2 class="hosp-title small">What is Hospitality Interior Design?</h2>
            <div class="hosp-line"></div>

            <p class="hosp-text">
                Hospitality Interior Design focuses on designing interior spaces for hotels, resorts, and businesses in the hospitality industry where visitors stay or relax.
            </p>

            <div class="pill-row">
                <div class="pill">Hotels</div>
                <div class="pill orange">Resorts</div>
                <div class="pill">Restaurants</div>
                <div class="pill orange">Cafes</div>
                <div class="pill">Banquet halls</div>
                <div class="pill orange">Guest Houses</div>
                <div class="pill">Serviced Apartments</div>
                <div class="pill orange">Homestays</div>
                <div class="pill">Luxury Villas</div>
            </div>

            <p class="hosp-text">The goal is to create attractive, comfortable, and functional spaces that encourage guests to return.</p>
        </section>

        <section class="hosp-section">
            <h2 class="hosp-title">Our Hospitality Interior Design Services Include</h2>
            <div class="hosp-line"></div>

            <div class="service-grid">
                @php
                    $services = [
                        ['Hotel Interior Design', ['Hotel lobby interiors', 'Reception and waiting areas', 'Guest room planning', 'Corridor and common area design'], false],
                        ['Resort Interior Design', ['Luxury resort interiors', 'Cottage and villa interiors', 'Restaurant and lounge spaces', 'Outdoor-inspired concepts'], true],
                        ['Restaurant Interior Design', ['Dining area planning', 'Theme-based restaurant concepts', 'Kitchen service coordination', 'Lighting and ambience planning'], false],
                        ['Cafe Interior Design', ['Modern cafe layouts', 'Counter and seating zones', 'Lighting and decor concepts', 'Customer-friendly atmosphere'], true],
                        ['Banquet Hall & Event Space Design', ['Stage and event layout', 'Lighting and decor planning', 'Flexible seating arrangement', 'Premium event ambience'], false],
                        ['Turnkey Hospitality Interior Solutions', ['Design to execution', 'Furniture and fixture coordination', 'Lighting and electrical works', 'Site supervision and handover'], true],
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

        <section class="hosp-section">
            <h2 class="hosp-title small">Types of Hospitality Interior Design Projects</h2>
            <div class="hosp-line"></div>

            <div class="project-grid">
                <div class="project-card">
                    <img src="{{ asset('images/logo/i5.png') }}" alt="Hotel Interior Design">
                    <h3>Hotel Interior Design</h3>
                </div>
                <div class="project-card blue">
                    <img src="{{ asset('images/logo/i6.png') }}" alt="Resort and Villa Interior Design">
                    <h3>Resort &amp; Villa Interior Design</h3>
                </div>
                <div class="project-card">
                    <img src="{{ asset('images/logo/i4.png') }}" alt="Restaurant and Cafe Interior Design">
                    <h3>Restaurant &amp; Cafe Interior<br>Design</h3>
                </div>
                <div class="project-card blue">
                    <img src="{{ asset('images/logo/ic5.png') }}" alt="Banquet Hall and Event Venue Design">
                    <h3>Banquet Hall &amp; Event Venue<br>Design</h3>
                </div>
            </div>
        </section>

        <section class="hosp-section">
            <h2 class="hosp-title small">Popular Hospitality Interior Design Styles</h2>
            <div class="hosp-line"></div>
            <div class="style-row">
                <div class="style-box blue">
                    <h3>Luxury Hospitality Design</h3>
                    <p>Elegant finishes, premium materials, and rich guest experience.</p>
                </div>
                <div class="style-box">
                    <h3>Modern Hospitality Design</h3>
                    <p>Clean planning, smart furniture, and contemporary ambience.</p>
                </div>
                <div class="style-box blue">
                    <h3>Resort-Style Design</h3>
                    <p>Relaxed tropical interiors, natural textures, and open planning.</p>
                </div>
                <div class="style-box">
                    <h3>Boutique Hospitality Design</h3>
                    <p>Unique themes and personalized guest experience.</p>
                </div>
                <div class="style-box blue">
                    <h3>Minimalist Hospitality Design</h3>
                    <p>Simple, elegant, and clutter-free environments.</p>
                </div>
            </div>
        </section>

        <section class="hosp-section">
            <h2 class="hosp-title small">Why Hospitality Interior Design is Important?</h2>
            <div class="hosp-line"></div>
            <div class="check-grid">
                <div class="check-item">Enhances<br>guest experience</div>
                <div class="check-item">Strengthens<br>brand identity</div>
                <div class="check-item">Increases<br>customer retention</div>
                <div class="check-item">Improves<br>operational efficiency</div>
                <div class="check-item">Creates<br>memorable environments</div>
                <div class="check-item">Supports<br>business growth<br>and profitability</div>
            </div>
        </section>

        <section class="hosp-section">
            <h2 class="hosp-title small">Why Choose ConstructKaro?</h2>
            <div class="hosp-line"></div>
            <div class="check-grid">
                <div class="check-item">Experienced<br>hospitality interior<br>designers</div>
                <div class="check-item">Hotels, resorts,<br>restaurant and<br>cafe design expertise</div>
                <div class="check-item">3D design<br>visualization<br>support</div>
                <div class="check-item">Turnkey<br>interior execution<br>solutions</div>
                <div class="check-item">Customized<br>hospitality<br>concepts</div>
                <div class="check-item">Suitable for boutique<br>and large-scale<br>hospitality projects</div>
            </div>
            <p class="center-note">We help hospitality businesses create beautiful, functional, and guest-focused spaces that leave lasting impressions.</p>
        </section>

        <section class="hosp-section">
            <h2 class="hosp-title small">Our Design Process</h2>
            <div class="hosp-line"></div>
            <div class="process-grid">
                <div class="process-item">1. Business &amp; Brand<br>Requirement<br>Discussion</div>
                <div class="process-item">2. Concept<br>Development &amp;<br>Space Planning</div>
                <div class="process-item">3. 3D Design<br>Visualization</div>
                <div class="process-item">4. Material &amp;<br>Furniture Selection</div>
                <div class="process-item">5. Interior<br>Execution</div>
                <div class="process-item">6. Final<br>Handover</div>
            </div>
        </section>

        <section class="hosp-section">
            <div class="location-block">
                <h3>Target Locations We Serve</h3>
                <strong>Retail &amp; Showroom Interior Design Services</strong>
                <ul>
                    <li>Hospitality Interior Designer in Navi Mumbai</li>
                    <li>Hotel Interior Design Services in Mumbai</li>
                    <li>Resort Interior Designer in Pune</li>
                    <li>Restaurant Interior Design Services in Raigad</li>
                    <li>Hospitality Interior Designer in Thane</li>
                </ul>
            </div>

            <div class="location-block">
                <h3>Additional Locations</h3>
                <ul>
                    <li>Hotel Interior Designer in Panvel</li>
                    <li>Resort Interior Designer in Kharghar</li>
                    <li>Restaurant Interior Designer in Vashi</li>
                    <li>Hospitality Design Services in Khopoli</li>
                    <li>Interior Designer in Alibaug</li>
                </ul>
            </div>
        </section>

        <section class="hosp-section">
            <h2 class="hosp-title small">Frequently Asked Questions (FAQs)</h2>
            <div class="hosp-line"></div>

            <div class="faq-wrap">
                @php
                    $faqs = [
                        ['What types of hospitality projects do you design?', 'We design hotels, resorts, restaurants, cafes, banquet halls, guest houses, serviced apartments, homestays, and luxury villas.'],
                        ['Do you provide 3D hospitality interior designs?', 'Yes, 3D design visualization can be provided based on project scope and approval requirements.'],
                        ['Can you create interiors according to our brand theme?', 'Yes, hospitality interiors can be designed around your brand theme, target guests, ambience, comfort, and operational requirements.'],
                        ['Do you provide turnkey hospitality interior execution?', 'Yes, turnkey execution support can include design, furniture, lighting, material selection, site execution, and final handover.'],
                        ['How much does hospitality interior design cost?', 'Cost depends on project type, area, material quality, furniture scope, ambience requirement, and execution complexity.'],
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
