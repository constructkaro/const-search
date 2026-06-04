@extends('layouts.app')

@section('title', 'Industrial Structural Audit Services')

@section('content')
<style>
    body {
        background: #e9e9e9;
        color: #141414;
        font-family: "Poppins", "Segoe UI", Arial, sans-serif;
    }

    .isa-page {
        background: #e9e9e9;
        padding-bottom: 42px;
    }

    .isa-hero {
        min-height: 280px;
        background:
            /* linear-gradient(90deg, rgba(2, 8, 16, .95) 0%, rgba(2, 8, 16, .72) 42%, rgba(2, 8, 16, .04) 100%), */
            url("{{ asset('images/logo/is1.png') }}");
        background-size: cover;
        background-position: center right;
        display: flex;
        align-items: center;
        padding: 44px 70px;
    }

    .isa-hero h1 {
        margin: 0;
        max-width: 560px;
        color: #fff;
        font-size: 43px;
        line-height: 1.06;
        font-weight: 900;
        letter-spacing: 0;
    }

    .isa-wrap {
        max-width: 1120px;
        margin: 0 auto;
        padding: 24px 22px 0;
    }

    .isa-section {
        margin-bottom: 28px;
    }

    .isa-title {
        margin: 0 0 10px;
        color: #080808;
        text-align: center;
        font-size: 24px;
        line-height: 1.2;
        font-weight: 900;
    }

    .isa-title.small {
        font-size: 20px;
    }

    .isa-line {
        width: 154px;
        height: 4px;
        margin: 0 auto 18px;
        border-radius: 999px;
        background: linear-gradient(90deg, #f37021 0 50%, #1e73be 50% 100%);
    }

    .isa-copy {
        margin: 0 0 12px;
        color: #202020;
        font-size: 14px;
        line-height: 1.55;
        font-weight: 500;
    }

    .isa-audit-strip {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 8px;
        margin-top: 18px;
    }

    .isa-step {
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

    .isa-step:nth-child(even) {
        border-color: #f0a36e;
        background: #fff6ef;
    }

    .isa-note {
        margin-top: 10px;
        color: #222;
        text-align: center;
        font-size: 12px;
        font-weight: 700;
    }

    .isa-services {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 24px;
        max-width: 850px;
        margin: 0 auto 18px;
    }

    .isa-services.bottom {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        max-width: 580px;
    }

    .isa-service-card {
        position: relative;
        min-height: 142px;
        border: 2px solid #f37021;
        border-radius: 8px;
        background: #fff6ef;
        padding: 30px 18px 18px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, .08);
        text-align: center;
    }

    .isa-service-card.blue {
        border-color: #1e73be;
        background: #eef7ff;
    }

    .isa-service-card .badge {
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

    .isa-service-card.blue .badge {
        background: #1e73be;
    }

    .isa-service-card h3 {
        margin: 0 0 8px;
        color: #f37021;
        font-size: 15px;
        line-height: 1.15;
        font-weight: 900;
    }

    .isa-service-card.blue h3 {
        color: #1e73be;
    }

    .isa-service-card ul,
    .isa-list-grid ul,
    .isa-location-list,
    .isa-service-area ul,
    .isa-industries ul {
        margin: 0;
        padding-left: 17px;
    }

    .isa-service-card li {
        color: #3c3c3c;
        text-align: left;
        font-size: 11px;
        line-height: 1.38;
        font-weight: 600;
    }

    .isa-property-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
    }

    .isa-property-card {
        overflow: hidden;
        border: 2px solid #1e73be;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, .1);
    }

    .isa-property-card:nth-child(odd) {
        border-color: #f37021;
    }

    .isa-property-card img {
        width: 100%;
        height: 132px;
        display: block;
        object-fit: cover;
    }

    .isa-property-card h3 {
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

    .isa-list-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px 28px;
    }

    .isa-list-grid li,
    .isa-location-list li,
    .isa-service-area li,
    .isa-industries li {
        color: #222;
        font-size: 13px;
        line-height: 1.35;
        font-weight: 700;
    }

    .isa-benefits {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 18px;
        margin-top: 4px;
    }

    .isa-benefit {
        text-align: center;
    }

    .isa-benefit span {
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

    .isa-benefit:nth-child(even) span {
        background: #f37021;
    }

    .isa-benefit strong {
        display: block;
        color: #1a1a1a;
        font-size: 12px;
        line-height: 1.25;
        font-weight: 900;
    }

    .isa-process {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 10px;
        margin-top: 14px;
    }

    .isa-process-step {
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

    .isa-process-step:nth-child(even) {
        border-bottom-color: #f37021;
    }

    .isa-service-area {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 38px;
        max-width: 820px;
        margin: 0 auto;
    }

    .isa-service-area h3,
    .isa-industries h3 {
        margin: 0 0 8px;
        color: #111;
        font-size: 16px;
        line-height: 1.2;
        font-weight: 900;
    }

    .isa-industries {
        max-width: 980px;
        margin: 0 auto;
    }

    .isa-industries ul {
        columns: 4;
    }

    .isa-faq {
        max-width: 980px;
        margin: 0 auto;
    }

    .isa-faq details {
        margin-bottom: 12px;
        border-radius: 5px;
        background: #fff;
        box-shadow: 0 1px 4px rgba(0, 0, 0, .13);
    }

    .isa-faq summary {
        padding: 13px 18px;
        color: #111;
        cursor: pointer;
        font-size: 13px;
        font-weight: 900;
    }

    .isa-faq p {
        margin: 0;
        padding: 0 18px 14px;
        color: #3d3d3d;
        font-size: 13px;
        line-height: 1.45;
        font-weight: 500;
    }

    /* Design polish: larger readable text, stronger cards, and better spacing */
    .isa-wrap {
        max-width: 1200px;
        padding: 34px 28px 0;
    }

    .isa-section {
        margin-bottom: 42px;
    }

    .isa-title {
        font-size: 30px;
        margin-bottom: 12px;
    }

    .isa-title.small {
        font-size: 26px;
    }

    .isa-line {
        width: 190px;
        height: 5px;
        margin-bottom: 24px;
    }

    .isa-copy {
        font-size: 16px;
        line-height: 1.72;
    }

    .isa-audit-strip {
        gap: 12px;
    }

    .isa-step {
        min-height: 72px;
        padding: 12px 14px;
        border-radius: 9px;
        font-size: 14px;
        line-height: 1.25;
    }

    .isa-note {
        font-size: 15px;
        line-height: 1.45;
    }

    .isa-services,
    .isa-services.bottom {
        max-width: 1040px;
        gap: 28px;
    }

    .isa-service-card {
        min-height: 192px;
        border-radius: 12px;
        padding: 38px 24px 24px;
        box-shadow: 0 8px 24px rgba(17, 24, 39, .10);
    }

    .isa-service-card .badge {
        width: 32px;
        height: 32px;
        top: -16px;
        font-size: 15px;
        line-height: 32px;
    }

    .isa-service-card h3 {
        font-size: 18px;
        line-height: 1.25;
        margin-bottom: 12px;
    }

    .isa-service-card li,
    .isa-list-grid li,
    .isa-location-list li,
    .isa-service-area li,
    .isa-industries li {
        font-size: 15px;
        line-height: 1.5;
    }

    .isa-property-grid {
        gap: 24px;
    }

    .isa-property-card {
        border-radius: 12px;
        box-shadow: 0 8px 22px rgba(17, 24, 39, .10);
    }

    .isa-property-card img {
        height: 178px;
    }

    .isa-property-card h3 {
        min-height: 68px;
        padding: 12px 14px;
        font-size: 15px;
        line-height: 1.25;
    }

    .isa-benefit strong {
        font-size: 15px;
        line-height: 1.35;
    }

    .isa-benefit span {
        width: 24px;
        height: 24px;
        font-size: 13px;
    }

    .isa-process-step {
        min-height: 76px;
        padding: 12px 14px;
        border-radius: 10px;
        font-size: 14px;
        line-height: 1.3;
    }

    .isa-service-area h3,
    .isa-industries h3 {
        font-size: 21px;
        margin-bottom: 12px;
    }

    .isa-faq summary {
        padding: 16px 20px;
        font-size: 15px;
    }

    .isa-faq p {
        padding: 0 20px 18px;
        font-size: 15px;
        line-height: 1.6;
    }

    @media (max-width: 992px) {
        .isa-hero {
            padding: 38px 28px;
        }

        .isa-hero h1 {
            font-size: 34px;
        }

        .isa-audit-strip,
        .isa-services,
        .isa-services.bottom,
        .isa-property-grid,
        .isa-list-grid,
        .isa-benefits,
        .isa-process,
        .isa-service-area {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            max-width: none;
        }

        .isa-industries ul {
            columns: 2;
        }
    }

    @media (max-width: 576px) {
        .isa-hero {
            min-height: 235px;
            padding: 30px 18px;
        }

        .isa-hero h1 {
            font-size: 28px;
        }

        .isa-wrap {
            padding: 20px 14px 0;
        }

        .isa-title {
            font-size: 20px;
        }

        .isa-audit-strip,
        .isa-services,
        .isa-services.bottom,
        .isa-property-grid,
        .isa-list-grid,
        .isa-benefits,
        .isa-process,
        .isa-service-area {
            grid-template-columns: 1fr;
        }

        .isa-property-card img {
            height: 180px;
        }

        .isa-industries ul {
            columns: 1;
        }
    }
</style>

<main class="isa-page">
    <section class="isa-hero">
        <!-- <h1>Industrial<br>Structural Audit</h1> -->
    </section>

    <div class="isa-wrap">
        <section class="isa-section">
            <h2 class="isa-title">Industrial Structural Audit Services in Navi Mumbai, Mumbai, Pune, Raigad &amp; Thane</h2>
            <div class="isa-line"></div>
            <p class="isa-copy">Industrial buildings are exposed to heavy loads, machinery vibrations, environmental conditions, and continuous operations that can affect structural performance over time. At ConstructKaro, we provide professional industrial structural audit services to assess the structural health, safety, stability, and serviceability of factories, warehouses, industrial sheds, plant buildings, PEB structures, and industrial infrastructure.</p>
            <p class="isa-copy">Our experienced structural engineers conduct detailed inspections, structural evaluations, and testing to identify potential risks and recommend corrective measures that help ensure safe and uninterrupted operations.</p>
        </section>

        <section class="isa-section">
            <h2 class="isa-title">What is an Industrial Structural Audit?</h2>
            <div class="isa-line"></div>
            <p class="isa-copy">An industrial structural audit is a detailed engineering assessment conducted to evaluate the condition and performance of industrial structures.</p>
            <p class="isa-copy">The audit helps identify:</p>

            <div class="isa-audit-strip">
                <div class="isa-step">Structural cracks</div>
                <div class="isa-step">Concrete deterioration</div>
                <div class="isa-step">Corrosion of reinforcement and steel members</div>
                <div class="isa-step">Foundation settlement</div>
                <div class="isa-step">Machinery vibration impact</div>
                <div class="isa-step">Load-bearing capacity concerns</div>
            </div>
            <p class="isa-note">The objective is to improve safety, extend building life, and reduce operational risks.</p>
        </section>

        <section class="isa-section">
            <h2 class="isa-title">Our Industrial Structural Audit Services Include</h2>
            <div class="isa-line"></div>

            <div class="isa-services">
                <article class="isa-service-card">
                    <span class="badge">1</span>
                    <h3>Visual Structural Inspection</h3>
                    <ul>
                        <li>Column and beam damage inspection</li>
                        <li>Crack and spalling observation</li>
                        <li>Machine foundation checks</li>
                        <li>Safety defect identification</li>
                    </ul>
                </article>

                <article class="isa-service-card blue">
                    <span class="badge">2</span>
                    <h3>RCC &amp; Steel Structure Assessment</h3>
                    <ul>
                        <li>RCC column, beam, slab, and foundation review</li>
                        <li>Steel shed and truss assessment</li>
                        <li>Corrosion and connection checks</li>
                        <li>Structural stability review</li>
                    </ul>
                </article>

                <article class="isa-service-card">
                    <span class="badge">3</span>
                    <h3>Load &amp; Machinery Impact Assessment</h3>
                    <ul>
                        <li>Machinery foundation observations</li>
                        <li>Vibration-related distress checks</li>
                        <li>Load change impact review</li>
                        <li>Operational risk assessment</li>
                    </ul>
                </article>
            </div>

            <div class="isa-services bottom">
                <article class="isa-service-card blue">
                    <span class="badge">4</span>
                    <h3>Non-Destructive Testing (NDT) Consultation</h3>
                    <ul>
                        <li>Rebound hammer test</li>
                        <li>UPV testing support</li>
                        <li>Corrosion mapping</li>
                        <li>Core testing guidance if required</li>
                    </ul>
                </article>

                <article class="isa-service-card">
                    <span class="badge">5</span>
                    <h3>Structural Audit Report</h3>
                    <ul>
                        <li>Detailed findings and observations</li>
                        <li>Defect photographs</li>
                        <li>Repair and strengthening recommendations</li>
                        <li>Priority-wise action plan</li>
                    </ul>
                </article>
            </div>
        </section>

        <section class="isa-section">
            <h2 class="isa-title small">Types of Industrial Facilities We Audit</h2>
            <div class="isa-line"></div>

            <div class="isa-property-grid">
                <article class="isa-property-card">
                    <img src="{{ asset('images/logo/st4.png') }}" alt="Factory and manufacturing plant">
                    <h3>Factories &amp; Manufacturing Plants</h3>
                </article>
                <article class="isa-property-card">
                    <img src="{{ asset('images/logo/ci2.png') }}" alt="Warehouse and logistics facility">
                    <h3>Warehouses &amp; Logistics Facilities</h3>
                </article>
                <article class="isa-property-card">
                    <img src="{{ asset('images/logo/ci3.png') }}" alt="Industrial shed and PEB structure">
                    <h3>Industrial Sheds &amp; PEB Structures</h3>
                </article>
                <article class="isa-property-card">
                    <img src="{{ asset('images/logo/ci4.png') }}" alt="Industrial infrastructure and utility">
                    <h3>Industrial Infrastructure &amp; Utilities</h3>
                </article>
            </div>
        </section>

        <section class="isa-section">
            <h2 class="isa-title small">When Does an Industrial Facility Need a Structural Audit?</h2>
            <div class="isa-line"></div>
            <div class="isa-list-grid">
                <ul>
                    <li>Buildings older than 15 years</li>
                    <li>Expansion or renovation projects</li>
                </ul>
                <ul>
                    <li>Heavy machinery installation</li>
                    <li>Change in production capacity</li>
                </ul>
                <ul>
                    <li>Structural cracks and visible damage</li>
                    <li>Compliance and safety requirements</li>
                </ul>
                <ul>
                    <li>Water leakage or corrosion issues</li>
                    <li>Property acquisition and investment assessment</li>
                </ul>
            </div>
        </section>

        <section class="isa-section">
            <h2 class="isa-title small">Benefits of an Industrial Structural Audit</h2>
            <div class="isa-line"></div>
            <div class="isa-benefits">
                <div class="isa-benefit"><span>1</span><strong>Improved worker safety</strong></div>
                <div class="isa-benefit"><span>2</span><strong>Reduced operational risks</strong></div>
                <div class="isa-benefit"><span>3</span><strong>Early detection of structural issues</strong></div>
                <div class="isa-benefit"><span>4</span><strong>Better maintenance planning</strong></div>
                <div class="isa-benefit"><span>5</span><strong>Improved regulatory compliance</strong></div>
                <div class="isa-benefit"><span>6</span><strong>Reduced downtime and repair costs</strong></div>
            </div>
        </section>

        <section class="isa-section">
            <h2 class="isa-title small">Why Choose ConstructKaro?</h2>
            <div class="isa-line"></div>
            <div class="isa-benefits">
                <div class="isa-benefit"><span>1</span><strong>Experienced structural engineers</strong></div>
                <div class="isa-benefit"><span>2</span><strong>Industrial building inspection expertise</strong></div>
                <div class="isa-benefit"><span>3</span><strong>NDT testing coordination support</strong></div>
                <div class="isa-benefit"><span>4</span><strong>Detailed engineering reports</strong></div>
                <div class="isa-benefit"><span>5</span><strong>Practical repair and strengthening recommendations</strong></div>
                <div class="isa-benefit"><span>6</span><strong>Suitable for all industrial facilities</strong></div>
            </div>
            <p class="isa-note">We help industrial property owners and facility managers maintain safe, reliable, and structurally sound facilities for long-term operations.</p>
        </section>

        <section class="isa-section">
            <h2 class="isa-title small">Our Structural Audit Process</h2>
            <div class="isa-line"></div>
            <div class="isa-process">
                <div class="isa-process-step">1. Requirement Discussion</div>
                <div class="isa-process-step">2. Site Inspection &amp; Data Collection</div>
                <div class="isa-process-step">3. Structural Assessment</div>
                <div class="isa-process-step">4. NDT Testing (if required)</div>
                <div class="isa-process-step">5. Analysis &amp; Engineering Review</div>
            </div>
        </section>

        <section class="isa-section isa-service-area">
            <div>
                <h3>Target Locations We Serve</h3>
                <p class="isa-copy"><strong>Industrial Structural Audit Services</strong></p>
                <ul>
                    <li>Industrial Structural Audit in Navi Mumbai</li>
                    <li>Factory Structural Audit in Mumbai</li>
                    <li>Industrial Building Audit in Pune</li>
                    <li>Structural Inspection Services in Raigad</li>
                    <li>Warehouse Structural Audit in Thane</li>
                </ul>
            </div>
            <div>
                <h3>Additional Locations</h3>
                <ul class="isa-location-list">
                    <li>Industrial Structural Audit in Panvel</li>
                    <li>Factory Inspection Services in Taloja</li>
                    <li>Industrial Audit in Khopoli</li>
                    <li>Warehouse Structural Assessment in Khopoli</li>
                    <li>Structural Audit Factories in Alibaug</li>
                </ul>
            </div>
        </section>

        <section class="isa-section isa-industries">
            <h3>Industries We Serve</h3>
            <ul>
                <li>Manufacturing Plants</li>
                <li>Warehouses &amp; Logistics Facilities</li>
                <li>Industrial Sheds</li>
                <li>PEB Structures</li>
                <li>Processing Units</li>
                <li>Industrial Parks</li>
                <li>Utility Infrastructure</li>
                <li>Engineering Facilities</li>
            </ul>
        </section>

        <section class="isa-section">
            <h2 class="isa-title small">Frequently Asked Questions (FAQs)</h2>
            <div class="isa-line"></div>
            <div class="isa-faq">
                <details>
                    <summary>1. What is an industrial structural audit?</summary>
                    <p>It is an engineering inspection of industrial structures to assess safety, stability, structural defects, and maintenance needs.</p>
                </details>
                <details>
                    <summary>2. Why are industrial structural audits important?</summary>
                    <p>They help identify risks caused by heavy loads, machinery vibration, corrosion, aging, and operational changes before they affect safety or production.</p>
                </details>
                <details>
                    <summary>3. Do you provide NDT testing support?</summary>
                    <p>Yes. We provide NDT consultation and coordination support when tests are required for accurate assessment.</p>
                </details>
                <details>
                    <summary>4. Can industrial sheds and PEB structures be audited?</summary>
                    <p>Yes. We audit RCC industrial structures, steel sheds, PEB structures, warehouses, factories, and related industrial infrastructure.</p>
                </details>
                <details>
                    <summary>5. Will the audit report include repair recommendations?</summary>
                    <p>Yes. The report includes findings, photographs, and practical repair or strengthening recommendations based on observed conditions.</p>
                </details>
            </div>
        </section>
    </div>
</main>
@endsection
