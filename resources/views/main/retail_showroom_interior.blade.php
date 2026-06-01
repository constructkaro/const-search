@extends('layouts.app')

@section('title', 'Retail & Showroom Interior')

@section('content')
<style>
    body {
        background: #e9e9e9;
        color: #262626;
        font-family: "Poppins", Arial, sans-serif;
    }

    .retail-hero {
        min-height: 330px;
        background:
            linear-gradient(90deg, rgba(0,0,0,.90) 0%, rgba(0,0,0,.72) 38%, rgba(0,0,0,.18) 100%),
            url("{{ asset('images/logo/i4.png') }}");
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        padding: 48px 36px;
    }

    .retail-hero h1 {
        margin: 0;
        color: #fff;
        font-size: 52px;
        line-height: 1.12;
        font-weight: 900;
        letter-spacing: .2px;
        max-width: 720px;
        text-shadow: 0 5px 14px rgba(0,0,0,.45);
    }

    .retail-page {
        background: #e9e9e9;
        padding: 42px 18px 70px;
    }

    .retail-wrap {
        max-width: 1180px;
        margin: 0 auto;
    }

    .retail-section {
        margin-bottom: 56px;
    }

    .retail-title {
        margin: 0;
        text-align: center;
        color: #252525;
        font-size: 28px;
        line-height: 1.25;
        font-weight: 900;
    }

    .retail-title.small {
        font-size: 24px;
    }

    .retail-line {
        width: 560px;
        max-width: 70%;
        height: 3px;
        margin: 12px auto 28px;
        background: linear-gradient(90deg, #f37021 0 50%, #1e73be 50% 100%);
        border-radius: 20px;
    }

    .retail-text {
        max-width: 1100px;
        margin: 0 auto 18px;
        color: #4c4c4c;
        font-size: 15px;
        line-height: 1.55;
        font-weight: 500;
    }

    .retail-text strong {
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
        .retail-hero h1 {
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
        .retail-hero {
            min-height: 260px;
            padding: 34px 20px;
        }

        .retail-hero h1 {
            font-size: 30px;
        }

        .retail-title,
        .retail-title.small {
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

<section class="retail-hero">
    <h1>Retail &amp; Showroom<br>Interior</h1>
</section>

<main class="retail-page">
    <div class="retail-wrap">
        <section class="retail-section">
            <h2 class="retail-title">Retail &amp; Showroom Interior Design Services in Navi Mumbai, Mumbai, Pune, Raigad &amp; Thane</h2>
            <div class="retail-line"></div>

            <p class="retail-text">
                The design of your retail store or showroom directly impacts customer experience, product visibility, and sales performance. At <strong>ConstructKaro</strong>, we provide professional <strong>Retail &amp; Showroom Interior Design</strong> Services that help businesses create attractive, functional, and brand-focused commercial spaces.
            </p>
            <p class="retail-text">
                Whether you are launching a new retail outlet, upgrading an existing showroom, or expanding your brand presence, our designers create interiors that attract customers and encourage purchasing decisions.
            </p>
        </section>

        <section class="retail-section">
            <h2 class="retail-title small">Why Retail &amp; Showroom Interior Design Matters</h2>
            <div class="retail-line"></div>

            <p class="retail-text">
                A well-designed showroom does more than look attractive. It helps:
            </p>

            <div class="pill-row">
                <div class="pill">Improve customer<br>experience</div>
                <div class="pill orange">Increase product<br>visibility</div>
                <div class="pill">Strengthen brand identity</div>
                <div class="pill orange">Optimize customer<br>movement</div>
                <div class="pill">Enhance product display<br>presentation</div>
                <div class="pill orange">Improve conversion rate<br>and sales</div>
            </div>

            <p class="retail-text">Your showroom should not only showcase your products it should create a memorable experience for visitors.</p>
        </section>

        <section class="retail-section">
            <h2 class="retail-title">Our Retail &amp; Showroom Interior Design Services Include</h2>
            <div class="retail-line"></div>

            <div class="service-grid">
                @php
                    $services = [
                        ['Showroom Interior Design', ['Product display planning', 'Customer circulation flow', 'Premium showroom concepts', 'Brand-focused design'], false],
                        ['Retail & Showroom Interior Design', ['Small retail outlets', 'Large retail spaces', 'Product display planning', 'Customer movement flow'], true],
                        ['Product Display Design', ['Shelves, racks and display units', 'Feature display zones', 'Visual merchandising support', 'Product-first design approach'], false],
                        ['Reception & Customer Experience Areas', ['Welcome counters', 'Waiting areas', 'Customer interaction spaces', 'Premium reception appeal'], true],
                        ['Lighting & Branding Integration', ['Product-focused lighting', 'Ambient lighting setup', 'Signage and branding zones'], false],
                        ['Turnkey Showroom Interior Solutions', ['Design to execution', 'Furniture and fixture work', 'Electrical coordination', 'Final handover'], true],
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

        <section class="retail-section">
            <h2 class="retail-title small">Types of Retail &amp; Showroom Interior Projects</h2>
            <div class="retail-line"></div>

            <div class="project-grid">
                <div class="project-card">
                    <img src="{{ asset('images/logo/i4.png') }}" alt="Automobile Showroom Interiors">
                    <h3>Automobile Showroom<br>Interiors</h3>
                </div>
                <div class="project-card blue">
                    <img src="{{ asset('images/logo/i3.png') }}" alt="Furniture and Home Decor Showrooms">
                    <h3>Furniture &amp; Home Decor<br>Showrooms</h3>
                </div>
                <div class="project-card">
                    <img src="{{ asset('images/logo/i5.png') }}" alt="Fashion and Retail Store Interiors">
                    <h3>Fashion &amp; Retail Store<br>Interiors</h3>
                </div>
                <div class="project-card blue">
                    <img src="{{ asset('images/logo/ic5.png') }}" alt="Electronics and Mobile Showroom Interiors">
                    <h3>Electronics &amp; Mobile<br>Showroom Interiors</h3>
                </div>
            </div>
        </section>

        <section class="retail-section">
            <h2 class="retail-title small">Popular Commercial Interior Design Styles</h2>
            <div class="retail-line"></div>
            <div class="style-row">
                <div class="style-box blue">
                    <h3>Modern Retail Design</h3>
                    <p>Clean layouts, premium lighting, and modern product display.</p>
                </div>
                <div class="style-box">
                    <h3>Luxury Showroom Design</h3>
                    <p>Premium finishes, elegant materials, and high-end customer experience.</p>
                </div>
                <div class="style-box blue">
                    <h3>Minimalist Retail Interiors</h3>
                    <p>Simple, organized, and clutter-free product presentation.</p>
                </div>
                <div class="style-box">
                    <h3>Brand-Focused Showroom Design</h3>
                    <p>Designed to strengthen brand identity and customer recall.</p>
                </div>
            </div>
        </section>

        <section class="retail-section">
            <h2 class="retail-title small">Features of a Successful Showroom Interior</h2>
            <div class="retail-line"></div>
            <div class="check-grid">
                <div class="check-item">Strategic product<br>placement</div>
                <div class="check-item">Attractive visual<br>merchandising</div>
                <div class="check-item">Comfortable<br>customer movement</div>
                <div class="check-item">Effective lighting<br>design</div>
                <div class="check-item">Strong brand<br>identity integration</div>
                <div class="check-item">Space-efficient<br>layouts</div>
            </div>
        </section>

        <section class="retail-section">
            <h2 class="retail-title small">Why Choose ConstructKaro?</h2>
            <div class="retail-line"></div>
            <div class="check-grid">
                <div class="check-item">Experienced<br>commercial<br>interior designers</div>
                <div class="check-item">Experienced<br>retail interior<br>designers</div>
                <div class="check-item">Customized<br>showroom<br>concepts</div>
                <div class="check-item">Product display<br>optimization<br>expertise</div>
                <div class="check-item">3D<br>visualization<br>support</div>
                <div class="check-item">Turnkey<br>interior<br>execution</div>
            </div>
            <p class="center-note">We help businesses create high-impact retail and showroom environments that attract customers and enhance sales performance.</p>
        </section>

        <section class="retail-section">
            <h2 class="retail-title small">Our Interior Design Process</h2>
            <div class="retail-line"></div>
            <div class="process-grid">
                <div class="process-item">1. Requirement<br>Discussion</div>
                <div class="process-item">2. Space Planning &amp;<br>Layout Design</div>
                <div class="process-item">3. 3D Visualization &amp;<br>Design Approval</div>
                <div class="process-item">4. Material &amp; Display<br>Selection</div>
                <div class="process-item">5. Interior<br>Execution</div>
                <div class="process-item">6. Final<br>Handover</div>
            </div>
        </section>

        <section class="retail-section">
            <div class="location-block">
                <h3>Target Locations We Serve</h3>
                <strong>Retail &amp; Showroom Interior Design Services</strong>
                <ul>
                    <li>Showroom Interior Designer in Navi Mumbai</li>
                    <li>Retail Interior Design Services in Mumbai</li>
                    <li>Showroom Interior Designer in Pune</li>
                    <li>Retail Store Interior Design in Raigad</li>
                    <li>Commercial Interior Designer in Thane</li>
                </ul>
            </div>

            <div class="location-block">
                <h3>Additional Locations</h3>
                <ul>
                    <li>Showroom Interior Designer in Panvel</li>
                    <li>Retail Interior Designer in Kharghar</li>
                    <li>Store Interior Design in Vashi</li>
                    <li>Showroom Design Service in Khopoli</li>
                </ul>
            </div>
        </section>

        <section class="retail-section">
            <h2 class="retail-title small">Frequently Asked Questions (FAQs)</h2>
            <div class="retail-line"></div>

            <div class="faq-wrap">
                @php
                    $faqs = [
                        ['What types of showrooms do you design?', 'We design automobile showrooms, furniture showrooms, home decor stores, fashion stores, electronics showrooms, mobile stores, retail outlets, and branded display spaces.'],
                        ['Do you provide 3D showroom designs?', 'Yes, 3D showroom visualization can be provided depending on the project scope and approval requirements.'],
                        ['Can you design interiors according to our brand identity?', 'Yes, showroom interiors can be planned around your brand colors, display style, signage, customer flow, and product positioning.'],
                        ['Do you offer turnkey showroom interior execution?', 'Yes, turnkey execution support can include design, display units, lighting, branding, furniture, electrical work, and final handover.'],
                        ['How much does showroom interior design cost?', 'Cost depends on showroom size, product category, display units, materials, branding, lighting, and execution scope.'],
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
