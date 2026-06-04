@extends('layouts.app')

@section('title', 'Residential Structural Audit Services')

@section('content')
<style>
    body {
        background: #e9e9e9;
        color: #141414;
        font-family: "Poppins", "Segoe UI", Arial, sans-serif;
    }

    .rsa-page {
        background: #e9e9e9;
        padding-bottom: 42px;
    }

    .rsa-hero {
        min-height: 280px;
        background:
            linear-gradient(90deg, rgba(2, 8, 16, .95) 0%, rgba(2, 8, 16, .72) 42%, rgba(2, 8, 16, .04) 100%),
            url("{{ asset('images/logo/st1.png') }}");
        background-size: cover;
        background-position: center right;
        display: flex;
        align-items: center;
        padding: 44px 70px;
    }

    .rsa-hero h1 {
        margin: 0;
        max-width: 560px;
        color: #fff;
        font-size: 43px;
        line-height: 1.06;
        font-weight: 900;
        letter-spacing: 0;
    }

    .rsa-wrap {
        max-width: 1120px;
        margin: 0 auto;
        padding: 24px 22px 0;
    }

    .rsa-section {
        margin-bottom: 28px;
    }

    .rsa-title {
        margin: 0 0 10px;
        color: #080808;
        text-align: center;
        font-size: 24px;
        line-height: 1.2;
        font-weight: 900;
    }

    .rsa-title.small {
        font-size: 20px;
    }

    .rsa-line {
        width: 154px;
        height: 4px;
        margin: 0 auto 18px;
        border-radius: 999px;
        background: linear-gradient(90deg, #f37021 0 50%, #1e73be 50% 100%);
    }

    .rsa-copy {
        margin: 0 0 12px;
        color: #202020;
        font-size: 14px;
        line-height: 1.55;
        font-weight: 500;
    }

    .rsa-audit-strip {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 8px;
        margin-top: 18px;
    }

    .rsa-step {
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

    .rsa-step:nth-child(even) {
        border-color: #f0a36e;
        background: #fff6ef;
    }

    .rsa-note {
        margin-top: 10px;
        color: #222;
        text-align: center;
        font-size: 12px;
        font-weight: 700;
    }

    .rsa-services {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 24px;
        max-width: 850px;
        margin: 0 auto 18px;
    }

    .rsa-services.bottom {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        max-width: 580px;
    }

    .rsa-service-card {
        position: relative;
        min-height: 142px;
        border: 2px solid #f37021;
        border-radius: 8px;
        background: #fff6ef;
        padding: 30px 18px 18px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, .08);
        text-align: center;
    }

    .rsa-service-card.blue {
        border-color: #1e73be;
        background: #eef7ff;
    }

    .rsa-service-card .badge {
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

    .rsa-service-card.blue .badge {
        background: #1e73be;
    }

    .rsa-service-card h3 {
        margin: 0 0 8px;
        color: #f37021;
        font-size: 15px;
        line-height: 1.15;
        font-weight: 900;
    }

    .rsa-service-card.blue h3 {
        color: #1e73be;
    }

    .rsa-service-card ul,
    .rsa-list-grid ul,
    .rsa-location-list,
    .rsa-service-area ul {
        margin: 0;
        padding-left: 17px;
    }

    .rsa-service-card li {
        color: #3c3c3c;
        text-align: left;
        font-size: 11px;
        line-height: 1.38;
        font-weight: 600;
    }

    .rsa-property-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
    }

    .rsa-property-card {
        overflow: hidden;
        border: 2px solid #1e73be;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, .1);
    }

    .rsa-property-card:nth-child(odd) {
        border-color: #f37021;
    }

    .rsa-property-card img {
        width: 100%;
        height: 132px;
        display: block;
        object-fit: cover;
    }

    .rsa-property-card h3 {
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

    .rsa-list-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px 28px;
    }

    .rsa-list-grid li,
    .rsa-location-list li,
    .rsa-service-area li {
        color: #222;
        font-size: 13px;
        line-height: 1.35;
        font-weight: 700;
    }

    .rsa-benefits {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 18px;
        margin-top: 4px;
    }

    .rsa-benefit {
        text-align: center;
    }

    .rsa-benefit span {
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

    .rsa-benefit:nth-child(even) span {
        background: #f37021;
    }

    .rsa-benefit strong {
        display: block;
        color: #1a1a1a;
        font-size: 12px;
        line-height: 1.25;
        font-weight: 900;
    }

    .rsa-process {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 10px;
        margin-top: 14px;
    }

    .rsa-process-step {
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

    .rsa-process-step:nth-child(even) {
        border-bottom-color: #f37021;
    }

    .rsa-service-area {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 38px;
        max-width: 780px;
        margin: 0 auto;
    }

    .rsa-service-area h3 {
        margin: 0 0 8px;
        color: #111;
        font-size: 16px;
        line-height: 1.2;
        font-weight: 900;
    }

    .rsa-faq {
        max-width: 980px;
        margin: 0 auto;
    }

    .rsa-faq details {
        margin-bottom: 12px;
        border-radius: 5px;
        background: #fff;
        box-shadow: 0 1px 4px rgba(0, 0, 0, .13);
    }

    .rsa-faq summary {
        padding: 13px 18px;
        color: #111;
        cursor: pointer;
        font-size: 13px;
        font-weight: 900;
    }

    .rsa-faq p {
        margin: 0;
        padding: 0 18px 14px;
        color: #3d3d3d;
        font-size: 13px;
        line-height: 1.45;
        font-weight: 500;
    }

    /* Design polish: larger readable text, stronger cards, and better spacing */
    .rsa-wrap {
        max-width: 1200px;
        padding: 34px 28px 0;
    }

    .rsa-section {
        margin-bottom: 42px;
    }

    .rsa-title {
        font-size: 30px;
        margin-bottom: 12px;
    }

    .rsa-title.small {
        font-size: 26px;
    }

    .rsa-line {
        width: 190px;
        height: 5px;
        margin-bottom: 24px;
    }

    .rsa-copy {
        font-size: 16px;
        line-height: 1.72;
    }

    .rsa-audit-strip {
        gap: 12px;
    }

    .rsa-step {
        min-height: 72px;
        padding: 12px 14px;
        border-radius: 9px;
        font-size: 14px;
        line-height: 1.25;
    }

    .rsa-note {
        font-size: 15px;
        line-height: 1.45;
    }

    .rsa-services,
    .rsa-services.bottom {
        max-width: 1040px;
        gap: 28px;
    }

    .rsa-service-card {
        min-height: 192px;
        border-radius: 12px;
        padding: 38px 24px 24px;
        box-shadow: 0 8px 24px rgba(17, 24, 39, .10);
    }

    .rsa-service-card .badge {
        width: 32px;
        height: 32px;
        top: -16px;
        font-size: 15px;
        line-height: 32px;
    }

    .rsa-service-card h3 {
        font-size: 18px;
        line-height: 1.25;
        margin-bottom: 12px;
    }

    .rsa-service-card li,
    .rsa-list-grid li,
    .rsa-location-list li,
    .rsa-service-area li {
        font-size: 15px;
        line-height: 1.5;
    }

    .rsa-property-grid {
        gap: 24px;
    }

    .rsa-property-card {
        border-radius: 12px;
        box-shadow: 0 8px 22px rgba(17, 24, 39, .10);
    }

    .rsa-property-card img {
        height: 178px;
    }

    .rsa-property-card h3 {
        min-height: 68px;
        padding: 12px 14px;
        font-size: 15px;
        line-height: 1.25;
    }

    .rsa-benefit strong {
        font-size: 15px;
        line-height: 1.35;
    }

    .rsa-benefit span {
        width: 24px;
        height: 24px;
        font-size: 13px;
    }

    .rsa-process-step {
        min-height: 76px;
        padding: 12px 14px;
        border-radius: 10px;
        font-size: 14px;
        line-height: 1.3;
    }

    .rsa-service-area h3 {
        font-size: 21px;
        margin-bottom: 12px;
    }

    .rsa-faq summary {
        padding: 16px 20px;
        font-size: 15px;
    }

    .rsa-faq p {
        padding: 0 20px 18px;
        font-size: 15px;
        line-height: 1.6;
    }

    @media (max-width: 992px) {
        .rsa-hero {
            padding: 38px 28px;
        }

        .rsa-hero h1 {
            font-size: 34px;
        }

        .rsa-audit-strip,
        .rsa-services,
        .rsa-services.bottom,
        .rsa-property-grid,
        .rsa-list-grid,
        .rsa-benefits,
        .rsa-process,
        .rsa-service-area {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            max-width: none;
        }
    }

    @media (max-width: 576px) {
        .rsa-hero {
            min-height: 235px;
            padding: 30px 18px;
        }

        .rsa-hero h1 {
            font-size: 28px;
        }

        .rsa-wrap {
            padding: 20px 14px 0;
        }

        .rsa-title {
            font-size: 20px;
        }

        .rsa-audit-strip,
        .rsa-services,
        .rsa-services.bottom,
        .rsa-property-grid,
        .rsa-list-grid,
        .rsa-benefits,
        .rsa-process,
        .rsa-service-area {
            grid-template-columns: 1fr;
        }

        .rsa-property-card img {
            height: 180px;
        }
    }
</style>

<main class="rsa-page">
    <section class="rsa-hero">
        <h1>Residential<br>Structural Audit</h1>
    </section>

    <div class="rsa-wrap">
        <section class="rsa-section">
            <h2 class="rsa-title">Residential Structural Audit Services in Navi Mumbai, Mumbai, Pune, Raigad &amp; Thane</h2>
            <div class="rsa-line"></div>
            <p class="rsa-copy">Over time, buildings can develop cracks, seepage issues, structural deterioration, and safety concerns due to age, environmental conditions, poor maintenance, or construction defects. At ConstructKaro, we provide professional residential structural audit services to assess the structural health, safety, and stability of houses, apartments, villas, bungalows, and residential buildings.</p>
            <p class="rsa-copy">Our experienced structural engineers conduct detailed inspections and provide expert recommendations to help homeowners identify potential risks before they become major problems.</p>
        </section>

        <section class="rsa-section">
            <h2 class="rsa-title">What is a Residential Structural Audit?</h2>
            <div class="rsa-line"></div>
            <p class="rsa-copy">A residential structural audit is a detailed technical inspection of a residential building to evaluate its structural condition, safety, durability, and maintenance requirements.</p>
            <p class="rsa-copy">The audit helps identify:</p>

            <div class="rsa-audit-strip">
                <div class="rsa-step">Structural cracks</div>
                <div class="rsa-step">Concrete deterioration</div>
                <div class="rsa-step">Corrosion of reinforcement steel</div>
                <div class="rsa-step">Water seepage and leakage damage</div>
                <div class="rsa-step">Foundation movement issues</div>
                <div class="rsa-step">Weak or damaged RCC members</div>
            </div>
            <p class="rsa-note">The objective is to ensure that the building remains safe, stable, and suitable for occupation.</p>
        </section>

        <section class="rsa-section">
            <h2 class="rsa-title">Our Residential Structural Audit Services Include</h2>
            <div class="rsa-line"></div>

            <div class="rsa-services">
                <article class="rsa-service-card">
                    <span class="badge">1</span>
                    <h3>Visual Structural Inspection</h3>
                    <ul>
                        <li>Crack inspection</li>
                        <li>Seepage and leakage assessment</li>
                        <li>Column, beam, slab, and wall inspection</li>
                        <li>Settlement defect checks</li>
                        <li>Damage observation</li>
                    </ul>
                </article>

                <article class="rsa-service-card blue">
                    <span class="badge">2</span>
                    <h3>Structural Condition Assessment</h3>
                    <ul>
                        <li>RCC member assessment</li>
                        <li>Structural stability review</li>
                        <li>Load-bearing element inspection</li>
                        <li>Foundation observation</li>
                    </ul>
                </article>

                <article class="rsa-service-card">
                    <span class="badge">3</span>
                    <h3>Non-Destructive Testing (NDT) Consultation</h3>
                    <ul>
                        <li>Rebound hammer test</li>
                        <li>Ultrasonic pulse velocity test</li>
                        <li>Carbonation depth guidance</li>
                        <li>Corrosion mapping support</li>
                    </ul>
                </article>
            </div>

            <div class="rsa-services bottom">
                <article class="rsa-service-card blue">
                    <span class="badge">4</span>
                    <h3>Repair &amp; Strengthening Advice</h3>
                    <ul>
                        <li>Repair method recommendation</li>
                        <li>Retrofitting guidance</li>
                        <li>Waterproofing and leakage solutions</li>
                        <li>Structural improvement suggestions</li>
                    </ul>
                </article>

                <article class="rsa-service-card">
                    <span class="badge">5</span>
                    <h3>Structural Audit Report</h3>
                    <ul>
                        <li>Detailed inspection findings</li>
                        <li>Defect photographs</li>
                        <li>Repair recommendation</li>
                        <li>Priority-wise action plan</li>
                        <li>Engineer safety observations</li>
                    </ul>
                </article>
            </div>
        </section>

        <section class="rsa-section">
            <h2 class="rsa-title small">Types of Residential Properties We Audit</h2>
            <div class="rsa-line"></div>

            <div class="rsa-property-grid">
                <article class="rsa-property-card">
                    <img src="{{ asset('images/logo/st2.png') }}" alt="Individual house and bungalow">
                    <h3>Individual Houses &amp; Bungalows</h3>
                </article>
                <article class="rsa-property-card">
                    <img src="{{ asset('images/logo/st3.png') }}" alt="Apartment and residential building">
                    <h3>Apartments &amp; Residential Buildings</h3>
                </article>
                <article class="rsa-property-card">
                    <img src="{{ asset('images/logo/st4.png') }}" alt="Old aging residential structure">
                    <h3>Old &amp; Aging Residential Structures</h3>
                </article>
                <article class="rsa-property-card">
                    <img src="{{ asset('images/logo/st5.png') }}" alt="Pre-purchase structural inspection">
                    <h3>Property Purchase Structural Inspection</h3>
                </article>
            </div>
        </section>

        <section class="rsa-section">
            <h2 class="rsa-title small">Signs That Your Home May Need a Structural Audit</h2>
            <div class="rsa-line"></div>
            <div class="rsa-list-grid">
                <ul>
                    <li>Visible wall cracks</li>
                    <li>Corrosion of reinforcement steel</li>
                </ul>
                <ul>
                    <li>Slab cracks</li>
                    <li>Structural distress</li>
                </ul>
                <ul>
                    <li>Water seepage and dampness</li>
                    <li>Aging building conditions</li>
                </ul>
                <ul>
                    <li>Settlement or uneven flooring</li>
                    <li>Renovation or extension planning</li>
                </ul>
            </div>
        </section>

        <section class="rsa-section">
            <h2 class="rsa-title small">Benefits of a Residential Structural Audit</h2>
            <div class="rsa-line"></div>
            <div class="rsa-benefits">
                <div class="rsa-benefit"><span>1</span><strong>Improved building safety</strong></div>
                <div class="rsa-benefit"><span>2</span><strong>Early identification of structural issues</strong></div>
                <div class="rsa-benefit"><span>3</span><strong>Reduced repair costs through preventive action</strong></div>
                <div class="rsa-benefit"><span>4</span><strong>Better maintenance planning</strong></div>
                <div class="rsa-benefit"><span>5</span><strong>Increased property value</strong></div>
                <div class="rsa-benefit"><span>6</span><strong>Peace of mind for homeowners</strong></div>
            </div>
        </section>

        <section class="rsa-section">
            <h2 class="rsa-title small">Why Choose ConstructKaro?</h2>
            <div class="rsa-line"></div>
            <div class="rsa-benefits">
                <div class="rsa-benefit"><span>1</span><strong>Experienced structural engineers</strong></div>
                <div class="rsa-benefit"><span>2</span><strong>Comprehensive building inspection</strong></div>
                <div class="rsa-benefit"><span>3</span><strong>NDT testing coordination support</strong></div>
                <div class="rsa-benefit"><span>4</span><strong>Detailed audit report</strong></div>
                <div class="rsa-benefit"><span>5</span><strong>Practical repair recommendations</strong></div>
                <div class="rsa-benefit"><span>6</span><strong>Suitable for residential property types</strong></div>
            </div>
            <p class="rsa-note">We help homeowners protect their investment with professional structural assessments and expert safety recommendations.</p>
        </section>

        <section class="rsa-section">
            <h2 class="rsa-title small">Our Structural Audit Process</h2>
            <div class="rsa-line"></div>
            <div class="rsa-process">
                <div class="rsa-process-step">1. Requirement Discussion</div>
                <div class="rsa-process-step">2. Site Inspection &amp; Visual Assessment</div>
                <div class="rsa-process-step">3. Structural Evaluation</div>
                <div class="rsa-process-step">4. NDT Testing (if required)</div>
                <div class="rsa-process-step">5. Analysis &amp; Report Preparation</div>
            </div>
        </section>

        <section class="rsa-section rsa-service-area">
            <div>
                <h3>Target Locations We Serve</h3>
                <p class="rsa-copy"><strong>Residential Structural Audit Services</strong></p>
                <ul>
                    <li>Residential Structural Audit in Navi Mumbai</li>
                    <li>Structural Audit Services in Mumbai</li>
                    <li>Residential Building Audit in Pune</li>
                    <li>Structural Inspection Services in Raigad</li>
                    <li>Structural Engineer Inspection in Thane</li>
                </ul>
            </div>
            <div>
                <h3>Additional Locations</h3>
                <ul class="rsa-location-list">
                    <li>Structural Audit in Panvel</li>
                    <li>Residential Building Inspection in Kharghar</li>
                    <li>Structural Assessment in Kalwa</li>
                    <li>Home Structural Audit in Wagholi</li>
                    <li>Building Safety Inspection in Badlapur</li>
                </ul>
            </div>
        </section>

        <section class="rsa-section">
            <h2 class="rsa-title small">Frequently Asked Questions (FAQs)</h2>
            <div class="rsa-line"></div>
            <div class="rsa-faq">
                <details>
                    <summary>1. What is a residential structural audit?</summary>
                    <p>It is a technical inspection of a residential property to assess its structural safety, condition, defects, and maintenance needs.</p>
                </details>
                <details>
                    <summary>2. When should a building undergo a structural audit?</summary>
                    <p>A structural audit is recommended for aging buildings, visible cracks, leakage issues, settlement signs, corrosion, or before major renovation and purchase decisions.</p>
                </details>
                <details>
                    <summary>3. Do you provide NDT testing services?</summary>
                    <p>We provide NDT consultation and coordination support when tests such as rebound hammer, UPV, carbonation, or corrosion mapping are required.</p>
                </details>
                <details>
                    <summary>4. Can a structural audit identify repair requirements?</summary>
                    <p>Yes. The audit helps identify defects and suggests practical repair, strengthening, waterproofing, or maintenance actions.</p>
                </details>
                <details>
                    <summary>5. Is a structural audit useful before purchasing a property?</summary>
                    <p>Yes. It helps buyers understand the actual condition of the property before making a purchase decision.</p>
                </details>
            </div>
        </section>
    </div>
</main>
@endsection
