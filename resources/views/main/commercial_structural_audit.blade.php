@extends('layouts.app')

@section('title', 'Commercial Structural Audit Services')

@section('content')
<style>
    body {
        background: #e9e9e9;
        color: #141414;
        font-family: "Poppins", "Segoe UI", Arial, sans-serif;
    }

    .csa-page {
        background: #e9e9e9;
        padding-bottom: 42px;
    }

    .csa-hero {
        min-height: 280px;
        background:
            /* linear-gradient(90deg, rgba(2, 8, 16, .95) 0%, rgba(2, 8, 16, .72) 42%, rgba(2, 8, 16, .04) 100%), */
            url("{{ asset('images/logo/csa1.png') }}");
        background-size: cover;
        background-position: center right;
        display: flex;
        align-items: center;
        padding: 44px 70px;
    }

    .csa-hero h1 {
        margin: 0;
        max-width: 560px;
        color: #fff;
        font-size: 43px;
        line-height: 1.06;
        font-weight: 900;
        letter-spacing: 0;
    }

    .csa-wrap {
        max-width: 1120px;
        margin: 0 auto;
        padding: 24px 22px 0;
    }

    .csa-section {
        margin-bottom: 28px;
    }

    .csa-title {
        margin: 0 0 10px;
        color: #080808;
        text-align: center;
        font-size: 24px;
        line-height: 1.2;
        font-weight: 900;
    }

    .csa-title.small {
        font-size: 20px;
    }

    .csa-line {
        width: 154px;
        height: 4px;
        margin: 0 auto 18px;
        border-radius: 999px;
        background: linear-gradient(90deg, #f37021 0 50%, #1e73be 50% 100%);
    }

    .csa-copy {
        margin: 0 0 12px;
        color: #202020;
        font-size: 14px;
        line-height: 1.55;
        font-weight: 500;
    }

    .csa-audit-strip {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 8px;
        margin-top: 18px;
    }

    .csa-step {
        min-height: 54px;
        padding: 8px 12px;
        border: 1px solid #8fb5d2;
        border-radius: 5px;
        background: #fff;
        color: #101010;
        text-align: center;
        font-size: 11px;
        line-height: 1.15;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .csa-step:nth-child(even) {
        border-color: #f0a36e;
        background: #fff6ef;
    }

    .csa-note {
        margin-top: 10px;
        color: #222;
        text-align: center;
        font-size: 12px;
        font-weight: 700;
    }

    .csa-services {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 24px;
        max-width: 850px;
        margin: 0 auto 18px;
    }

    .csa-services.bottom {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        max-width: 580px;
    }

    .csa-service-card {
        position: relative;
        min-height: 142px;
        border: 2px solid #f37021;
        border-radius: 8px;
        background: #fff6ef;
        padding: 30px 18px 18px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, .08);
        text-align: center;
    }

    .csa-service-card.blue {
        border-color: #1e73be;
        background: #eef7ff;
    }

    .csa-service-card .badge {
        position: absolute;
        top: -13px;
        left: 50%;
        width: 26px;
        height: 26px;
        transform: translateX(-50%);
        border-radius: 50%;
        background: #f37021;
        color: #fff;
        font-size: 13px;
        line-height: 26px;
        font-weight: 900;
    }

    .csa-service-card.blue .badge {
        background: #1e73be;
    }

    .csa-service-card h3 {
        margin: 0 0 8px;
        color: #f37021;
        font-size: 15px;
        line-height: 1.15;
        font-weight: 900;
    }

    .csa-service-card.blue h3 {
        color: #1e73be;
    }

    .csa-service-card ul,
    .csa-list-grid ul,
    .csa-location-list,
    .csa-service-area ul,
    .csa-industries ul {
        margin: 0;
        padding-left: 17px;
    }

    .csa-service-card li {
        color: #3c3c3c;
        text-align: left;
        font-size: 11px;
        line-height: 1.38;
        font-weight: 600;
    }

    .csa-property-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
    }

    .csa-property-card {
        overflow: hidden;
        border: 2px solid #1e73be;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, .1);
    }

    .csa-property-card:nth-child(odd) {
        border-color: #f37021;
    }

    .csa-property-card img {
        width: 100%;
        height: 132px;
        display: block;
        object-fit: cover;
    }

    .csa-property-card h3 {
        min-height: 48px;
        margin: 0;
        padding: 9px 10px;
        color: #111;
        text-align: center;
        font-size: 12px;
        line-height: 1.15;
        font-weight: 900;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .csa-list-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px 28px;
    }

    .csa-list-grid li,
    .csa-location-list li,
    .csa-service-area li,
    .csa-industries li {
        color: #222;
        font-size: 13px;
        line-height: 1.35;
        font-weight: 700;
    }

    .csa-benefits {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 18px;
        margin-top: 4px;
    }

    .csa-benefit {
        text-align: center;
    }

    .csa-benefit span {
        display: inline-flex;
        width: 18px;
        height: 18px;
        margin-bottom: 7px;
        border-radius: 50%;
        background: #1e73be;
        color: #fff;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 900;
    }

    .csa-benefit:nth-child(even) span {
        background: #f37021;
    }

    .csa-benefit strong {
        display: block;
        color: #1a1a1a;
        font-size: 12px;
        line-height: 1.25;
        font-weight: 900;
    }

    .csa-process {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 10px;
        margin-top: 14px;
    }

    .csa-process-step {
        min-height: 56px;
        padding: 8px 10px;
        border-radius: 7px;
        background: #fff;
        border-bottom: 4px solid #1e73be;
        color: #111;
        text-align: center;
        font-size: 11px;
        line-height: 1.2;
        font-weight: 900;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 1px 4px rgba(0, 0, 0, .1);
    }

    .csa-process-step:nth-child(even) {
        border-bottom-color: #f37021;
    }

    .csa-service-area {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 38px;
        max-width: 820px;
        margin: 0 auto;
    }

    .csa-service-area h3,
    .csa-industries h3 {
        margin: 0 0 8px;
        color: #111;
        font-size: 16px;
        line-height: 1.2;
        font-weight: 900;
    }

    .csa-industries {
        max-width: 980px;
        margin: 0 auto;
    }

    .csa-industries ul {
        columns: 4;
    }

    .csa-faq {
        max-width: 980px;
        margin: 0 auto;
    }

    .csa-faq details {
        margin-bottom: 12px;
        border-radius: 5px;
        background: #fff;
        box-shadow: 0 1px 4px rgba(0, 0, 0, .13);
    }

    .csa-faq summary {
        padding: 13px 18px;
        color: #111;
        cursor: pointer;
        font-size: 13px;
        font-weight: 900;
    }

    .csa-faq p {
        margin: 0;
        padding: 0 18px 14px;
        color: #3d3d3d;
        font-size: 13px;
        line-height: 1.45;
        font-weight: 500;
    }

    /* Design polish: larger readable text, stronger cards, and better spacing */
    .csa-wrap {
        max-width: 1200px;
        padding: 34px 28px 0;
    }

    .csa-section {
        margin-bottom: 42px;
    }

    .csa-title {
        font-size: 30px;
        margin-bottom: 12px;
    }

    .csa-title.small {
        font-size: 26px;
    }

    .csa-line {
        width: 190px;
        height: 5px;
        margin-bottom: 24px;
    }

    .csa-copy {
        font-size: 16px;
        line-height: 1.72;
    }

    .csa-audit-strip {
        gap: 12px;
    }

    .csa-step {
        min-height: 72px;
        padding: 12px 14px;
        border-radius: 9px;
        font-size: 14px;
        line-height: 1.25;
    }

    .csa-note {
        font-size: 15px;
        line-height: 1.45;
    }

    .csa-services,
    .csa-services.bottom {
        max-width: 1040px;
        gap: 28px;
    }

    .csa-service-card {
        min-height: 192px;
        border-radius: 12px;
        padding: 38px 24px 24px;
        box-shadow: 0 8px 24px rgba(17, 24, 39, .10);
    }

    .csa-service-card .badge {
        width: 32px;
        height: 32px;
        top: -16px;
        font-size: 15px;
        line-height: 32px;
    }

    .csa-service-card h3 {
        font-size: 18px;
        line-height: 1.25;
        margin-bottom: 12px;
    }

    .csa-service-card li,
    .csa-list-grid li,
    .csa-location-list li,
    .csa-service-area li,
    .csa-industries li {
        font-size: 15px;
        line-height: 1.5;
    }

    .csa-property-grid {
        gap: 24px;
    }

    .csa-property-card {
        border-radius: 12px;
        box-shadow: 0 8px 22px rgba(17, 24, 39, .10);
    }

    .csa-property-card img {
        height: 178px;
    }

    .csa-property-card h3 {
        min-height: 68px;
        padding: 12px 14px;
        font-size: 15px;
        line-height: 1.25;
    }

    .csa-benefit strong {
        font-size: 15px;
        line-height: 1.35;
    }

    .csa-benefit span {
        width: 24px;
        height: 24px;
        font-size: 13px;
    }

    .csa-process-step {
        min-height: 76px;
        padding: 12px 14px;
        border-radius: 10px;
        font-size: 14px;
        line-height: 1.3;
    }

    .csa-service-area h3,
    .csa-industries h3 {
        font-size: 21px;
        margin-bottom: 12px;
    }

    .csa-faq summary {
        padding: 16px 20px;
        font-size: 15px;
    }

    .csa-faq p {
        padding: 0 20px 18px;
        font-size: 15px;
        line-height: 1.6;
    }

    @media (max-width: 992px) {
        .csa-hero {
            padding: 38px 28px;
        }

        .csa-hero h1 {
            font-size: 34px;
        }

        .csa-audit-strip,
        .csa-services,
        .csa-services.bottom,
        .csa-property-grid,
        .csa-list-grid,
        .csa-benefits,
        .csa-process,
        .csa-service-area {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            max-width: none;
        }

        .csa-industries ul {
            columns: 2;
        }
    }

    @media (max-width: 576px) {
        .csa-hero {
            min-height: 235px;
            padding: 30px 18px;
        }

        .csa-hero h1 {
            font-size: 28px;
        }

        .csa-wrap {
            padding: 20px 14px 0;
        }

        .csa-title {
            font-size: 20px;
        }

        .csa-audit-strip,
        .csa-services,
        .csa-services.bottom,
        .csa-property-grid,
        .csa-list-grid,
        .csa-benefits,
        .csa-process,
        .csa-service-area {
            grid-template-columns: 1fr;
        }

        .csa-property-card img {
            height: 180px;
        }

        .csa-industries ul {
            columns: 1;
        }
    }
</style>

<main class="csa-page">
    <section class="csa-hero">
        <!-- <h1>Commercial<br>Structural Audit</h1> -->
    </section>

    <div class="csa-wrap">
        <section class="csa-section">
            <h2 class="csa-title">Commercial Structural Audit Services in Navi Mumbai, Mumbai, Pune, Raigad &amp; Thane</h2>
            <div class="csa-line"></div>
            <p class="csa-copy">The safety, stability, and long-term performance of a commercial building are critical for business operations, employee safety, and regulatory compliance. At ConstructKaro, we provide expert commercial structural audit services for office buildings, shopping complexes, retail spaces, hotels, hospitals, educational buildings, warehouses, and commercial facilities.</p>
            <p class="csa-copy">Our experienced structural engineers conduct detailed inspections and assessments to identify structural defects, maintenance requirements, and safety concerns before they become major risks.</p>
        </section>

        <section class="csa-section">
            <h2 class="csa-title">What is a Commercial Structural Audit?</h2>
            <div class="csa-line"></div>
            <p class="csa-copy">A commercial structural audit is a comprehensive evaluation of a building's structural condition, strength, safety, and serviceability.</p>
            <p class="csa-copy">The audit helps identify:</p>

            <div class="csa-audit-strip">
                <div class="csa-step">Structural cracks</div>
                <div class="csa-step">Concrete deterioration</div>
                <div class="csa-step">RCC member weakness</div>
                <div class="csa-step">Water seepage issues</div>
                <div class="csa-step">Foundation settlement</div>
                <div class="csa-step">Load and occupancy related concerns</div>
            </div>
            <p class="csa-note">The objective is to ensure that the building remains safe for occupants, customers, and daily business operations.</p>
        </section>

        <section class="csa-section">
            <h2 class="csa-title">Our Commercial Structural Audit Services Include</h2>
            <div class="csa-line"></div>

            <div class="csa-services">
                <article class="csa-service-card">
                    <span class="badge">1</span>
                    <h3>Visual Structural Inspection</h3>
                    <ul>
                        <li>Building crack assessment</li>
                        <li>RCC member visual inspection</li>
                        <li>Water seepage observation</li>
                        <li>Safety hazard identification</li>
                    </ul>
                </article>

                <article class="csa-service-card blue">
                    <span class="badge">2</span>
                    <h3>RCC Structural Assessment</h3>
                    <ul>
                        <li>Column, beam, slab, and staircase inspection</li>
                        <li>Load-bearing member review</li>
                        <li>Structural stability observations</li>
                        <li>Commercial usage impact review</li>
                    </ul>
                </article>

                <article class="csa-service-card">
                    <span class="badge">3</span>
                    <h3>Non-Destructive Testing (NDT) Consultation</h3>
                    <ul>
                        <li>Rebound hammer test support</li>
                        <li>UPV test coordination</li>
                        <li>Carbonation and corrosion checks</li>
                        <li>Core testing guidance if required</li>
                    </ul>
                </article>
            </div>

            <div class="csa-services bottom">
                <article class="csa-service-card blue">
                    <span class="badge">4</span>
                    <h3>Water Seepage &amp; Durability Assessment</h3>
                    <ul>
                        <li>Leakage inspection</li>
                        <li>Terrace and basement checks</li>
                        <li>Dampness impact review</li>
                        <li>Waterproofing repair suggestions</li>
                    </ul>
                </article>

                <article class="csa-service-card">
                    <span class="badge">5</span>
                    <h3>Structural Audit Report</h3>
                    <ul>
                        <li>Detailed inspection findings</li>
                        <li>Photographic evidence</li>
                        <li>Repair and strengthening recommendations</li>
                        <li>Priority-wise action plan</li>
                    </ul>
                </article>
            </div>
        </section>

        <section class="csa-section">
            <h2 class="csa-title small">Types of Commercial Properties We Audit</h2>
            <div class="csa-line"></div>

            <div class="csa-property-grid">
                <article class="csa-property-card">
                    <img src="{{ asset('images/logo/st3.png') }}" alt="Office building">
                    <h3>Office Buildings</h3>
                </article>
                <article class="csa-property-card">
                    <img src="{{ asset('images/logo/st4.png') }}" alt="Shopping complex and retail building">
                    <h3>Shopping Complexes &amp; Retail Buildings</h3>
                </article>
                <article class="csa-property-card">
                    <img src="{{ asset('images/logo/st5.png') }}" alt="Hotel and hospitality property">
                    <h3>Hotels &amp; Hospitality Properties</h3>
                </article>
                <article class="csa-property-card">
                    <img src="{{ asset('images/logo/st6.png') }}" alt="Educational and healthcare building">
                    <h3>Educational &amp; Healthcare Buildings</h3>
                </article>
            </div>
        </section>

        <section class="csa-section">
            <h2 class="csa-title small">When Does a Commercial Building Need a Structural Audit?</h2>
            <div class="csa-line"></div>
            <div class="csa-list-grid">
                <ul>
                    <li>Buildings older than 15-30 years</li>
                    <li>Change in building usage</li>
                </ul>
                <ul>
                    <li>Visible structural cracks</li>
                    <li>Structural distress indicators</li>
                </ul>
                <ul>
                    <li>Water seepage and dampness</li>
                    <li>Compliance and safety requirements</li>
                </ul>
                <ul>
                    <li>Renovation or expansion plans</li>
                    <li>Property purchase or investment assessment</li>
                </ul>
            </div>
        </section>

        <section class="csa-section">
            <h2 class="csa-title small">Benefits of a Commercial Structural Audit</h2>
            <div class="csa-line"></div>
            <div class="csa-benefits">
                <div class="csa-benefit"><span>1</span><strong>Improved occupant safety</strong></div>
                <div class="csa-benefit"><span>2</span><strong>Early detection of structural problems</strong></div>
                <div class="csa-benefit"><span>3</span><strong>Reduced maintenance costs</strong></div>
                <div class="csa-benefit"><span>4</span><strong>Increased building lifespan</strong></div>
                <div class="csa-benefit"><span>5</span><strong>Better asset management</strong></div>
                <div class="csa-benefit"><span>6</span><strong>Compliance with safety requirements</strong></div>
            </div>
        </section>

        <section class="csa-section">
            <h2 class="csa-title small">Why Choose ConstructKaro?</h2>
            <div class="csa-line"></div>
            <div class="csa-benefits">
                <div class="csa-benefit"><span>1</span><strong>Experienced structural engineers</strong></div>
                <div class="csa-benefit"><span>2</span><strong>Comprehensive commercial building inspection</strong></div>
                <div class="csa-benefit"><span>3</span><strong>NDT testing coordination support</strong></div>
                <div class="csa-benefit"><span>4</span><strong>Detailed structural audit report</strong></div>
                <div class="csa-benefit"><span>5</span><strong>Practical repair recommendations</strong></div>
                <div class="csa-benefit"><span>6</span><strong>Suitable for all commercial property types</strong></div>
            </div>
            <p class="csa-note">We help property owners, facility managers, and business operators protect their assets through professional structural assessments and engineering recommendations.</p>
        </section>

        <section class="csa-section">
            <h2 class="csa-title small">Our Structural Audit Process</h2>
            <div class="csa-line"></div>
            <div class="csa-process">
                <div class="csa-process-step">1. Requirement Discussion</div>
                <div class="csa-process-step">2. Site Inspection &amp; Visual Assessment</div>
                <div class="csa-process-step">3. Structural Evaluation</div>
                <div class="csa-process-step">4. NDT Testing (if required)</div>
                <div class="csa-process-step">5. Analysis &amp; Report Preparation</div>
            </div>
        </section>

        <section class="csa-section csa-service-area">
            <div>
                <h3>Target Locations We Serve</h3>
                <p class="csa-copy"><strong>Commercial Structural Audit Services</strong></p>
                <ul>
                    <li>Commercial Structural Audit in Navi Mumbai</li>
                    <li>Structural Audit Services in Mumbai</li>
                    <li>Commercial Building Audit in Pune</li>
                    <li>Structural Inspection Services in Raigad</li>
                    <li>Structural Engineer Assessment in Thane</li>
                </ul>
            </div>
            <div>
                <h3>Additional Locations</h3>
                <ul class="csa-location-list">
                    <li>Structural Audit in Panvel</li>
                    <li>Commercial Building Inspection in Kharghar</li>
                    <li>Structural Assessment in Vashi</li>
                    <li>Building Safety Audit in Wagholi</li>
                    <li>Structural Audit Services in Khopoli</li>
                </ul>
            </div>
        </section>

        <section class="csa-section csa-industries">
            <h3>Industries We Serve</h3>
            <ul>
                <li>Corporate Offices</li>
                <li>IT Parks</li>
                <li>Shopping Malls</li>
                <li>Retail Complexes</li>
                <li>Hotels &amp; Resorts</li>
                <li>Educational Institutions</li>
                <li>Healthcare Facilities</li>
                <li>Warehouses &amp; Commercial Buildings</li>
            </ul>
        </section>

        <section class="csa-section">
            <h2 class="csa-title small">Frequently Asked Questions (FAQs)</h2>
            <div class="csa-line"></div>
            <div class="csa-faq">
                <details>
                    <summary>1. What is a commercial structural audit?</summary>
                    <p>It is a professional inspection of a commercial building to assess structural safety, defects, maintenance needs, and long-term stability.</p>
                </details>
                <details>
                    <summary>2. Is a structural audit mandatory for commercial buildings?</summary>
                    <p>It may be required depending on building age, local authority requirements, safety norms, and property usage.</p>
                </details>
                <details>
                    <summary>3. Do you provide NDT testing services?</summary>
                    <p>We provide NDT consultation and coordination support where testing is needed for accurate structural assessment.</p>
                </details>
                <details>
                    <summary>4. Can a structural audit identify repair requirements?</summary>
                    <p>Yes. The audit identifies defects and provides practical repair, strengthening, maintenance, and durability recommendations.</p>
                </details>
                <details>
                    <summary>5. How often should commercial buildings undergo a structural audit?</summary>
                    <p>Frequency depends on building age, usage, condition, and local compliance requirements. Older or heavily used commercial buildings should be inspected periodically.</p>
                </details>
            </div>
        </section>
    </div>
</main>
@endsection
