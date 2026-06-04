@extends('layouts.app')

@section('title', 'Renovation & Repair Structural Audit Services')

@section('content')
<style>
    body {
        background: #e9e9e9;
        color: #141414;
        font-family: "Poppins", "Segoe UI", Arial, sans-serif;
    }

    .rrsa-page {
        background: #e9e9e9;
        padding-bottom: 42px;
    }

    .rrsa-sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border: 0;
    }

    .rrsa-hero {
        min-height: 280px;
        background:
            #111
            url("{{ asset('images/logo/rrs1.png') }}");
        background-size: cover;
        background-position: center right;
        display: flex;
        align-items: center;
        padding: 44px 70px;
    }

    .rrsa-hero h1 {
        margin: 0;
        max-width: 670px;
        color: #fff;
        font-size: 39px;
        line-height: 1.08;
        font-weight: 900;
        letter-spacing: 0;
    }

    .rrsa-wrap {
        max-width: 1120px;
        margin: 0 auto;
        padding: 24px 22px 0;
    }

    .rrsa-section {
        margin-bottom: 28px;
    }

    .rrsa-title {
        margin: 0 0 10px;
        color: #080808;
        text-align: center;
        font-size: 24px;
        line-height: 1.2;
        font-weight: 900;
    }

    .rrsa-title.small {
        font-size: 20px;
    }

    .rrsa-line {
        width: 154px;
        height: 4px;
        margin: 0 auto 18px;
        border-radius: 999px;
        background: linear-gradient(90deg, #f37021 0 50%, #1e73be 50% 100%);
    }

    .rrsa-copy {
        margin: 0 0 12px;
        color: #202020;
        font-size: 14px;
        line-height: 1.55;
        font-weight: 500;
    }

    .rrsa-audit-strip {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 8px;
        margin-top: 18px;
    }

    .rrsa-step {
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

    .rrsa-step:nth-child(even) {
        border-color: #f0a36e;
        background: #fff6ef;
    }

    .rrsa-note {
        margin-top: 10px;
        color: #222;
        text-align: center;
        font-size: 12px;
        font-weight: 700;
    }

    .rrsa-services {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 24px;
        max-width: 850px;
        margin: 0 auto 18px;
    }

    .rrsa-services.bottom {
        grid-template-columns: repeat(3, minmax(0, 1fr));
        max-width: 850px;
    }

    .rrsa-service-card {
        position: relative;
        min-height: 142px;
        border: 2px solid #f37021;
        border-radius: 8px;
        background: #fff6ef;
        padding: 30px 18px 18px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, .08);
        text-align: center;
    }

    .rrsa-service-card.blue {
        border-color: #1e73be;
        background: #eef7ff;
    }

    .rrsa-service-card .badge {
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

    .rrsa-service-card.blue .badge {
        background: #1e73be;
    }

    .rrsa-service-card h3 {
        margin: 0 0 8px;
        color: #f37021;
        font-size: 15px;
        line-height: 1.15;
        font-weight: 900;
    }

    .rrsa-service-card.blue h3 {
        color: #1e73be;
    }

    .rrsa-service-card ul,
    .rrsa-list-grid ul,
    .rrsa-location-list,
    .rrsa-service-area ul {
        margin: 0;
        padding-left: 17px;
    }

    .rrsa-service-card li {
        color: #3c3c3c;
        text-align: left;
        font-size: 11px;
        line-height: 1.38;
        font-weight: 600;
    }

    .rrsa-property-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
    }

    .rrsa-property-card {
        overflow: hidden;
        border: 2px solid #1e73be;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, .1);
    }

    .rrsa-property-card:nth-child(odd) {
        border-color: #f37021;
    }

    .rrsa-property-card img {
        width: 100%;
        height: 132px;
        display: block;
        object-fit: cover;
    }

    .rrsa-property-card h3 {
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

    .rrsa-list-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px 28px;
    }

    .rrsa-list-grid li,
    .rrsa-location-list li,
    .rrsa-service-area li {
        color: #222;
        font-size: 13px;
        line-height: 1.35;
        font-weight: 700;
    }

    .rrsa-benefits {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 18px;
        margin-top: 4px;
    }

    .rrsa-benefit {
        text-align: center;
    }

    .rrsa-benefit span {
        display: inline;
        margin-right: 3px;
        color: #111;
        font-size: 12px;
        font-weight: 900;
    }

    .rrsa-benefit:nth-child(even) span {
        color: #111;
    }

    .rrsa-benefit strong {
        display: block;
        color: #1a1a1a;
        font-size: 12px;
        line-height: 1.25;
        font-weight: 900;
    }

    .rrsa-process {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 10px;
        margin-top: 14px;
    }

    .rrsa-process-step {
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

    .rrsa-process-step:nth-child(even) {
        border-bottom-color: #f37021;
    }

    .rrsa-service-area {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 38px;
        max-width: 820px;
        margin: 0 auto;
    }

    .rrsa-service-area h3 {
        margin: 0 0 8px;
        color: #111;
        font-size: 16px;
        line-height: 1.2;
        font-weight: 900;
    }

    .rrsa-faq {
        max-width: 980px;
        margin: 0 auto;
    }

    .rrsa-faq details {
        margin-bottom: 12px;
        border-radius: 5px;
        background: #fff;
        box-shadow: 0 1px 4px rgba(0, 0, 0, .13);
    }

    .rrsa-faq summary {
        padding: 13px 18px;
        color: #111;
        cursor: pointer;
        font-size: 13px;
        font-weight: 900;
    }

    .rrsa-faq p {
        margin: 0;
        padding: 0 18px 14px;
        color: #3d3d3d;
        font-size: 13px;
        line-height: 1.45;
        font-weight: 500;
    }

    @media (max-width: 992px) {
        .rrsa-hero {
            padding: 38px 28px;
        }

        .rrsa-hero h1 {
            font-size: 32px;
        }

        .rrsa-audit-strip,
        .rrsa-services,
        .rrsa-services.bottom,
        .rrsa-property-grid,
        .rrsa-list-grid,
        .rrsa-benefits,
        .rrsa-process,
        .rrsa-service-area {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            max-width: none;
        }
    }

    @media (max-width: 576px) {
        .rrsa-hero {
            min-height: 235px;
            padding: 30px 18px;
        }

        .rrsa-hero h1 {
            font-size: 27px;
        }

        .rrsa-wrap {
            padding: 20px 14px 0;
        }

        .rrsa-title {
            font-size: 20px;
        }

        .rrsa-audit-strip,
        .rrsa-services,
        .rrsa-services.bottom,
        .rrsa-property-grid,
        .rrsa-list-grid,
        .rrsa-benefits,
        .rrsa-process,
        .rrsa-service-area {
            grid-template-columns: 1fr;
        }

        .rrsa-property-card img {
            height: 180px;
        }
    }
</style>

<main class="rrsa-page">
    <section class="rrsa-hero">
        <h1 class="rrsa-sr-only">Renovation &amp; Repair Structural Audit</h1>
    </section>

    <div class="rrsa-wrap">
        <section class="rrsa-section">
            <h2 class="rrsa-title">Renovation &amp; Repair Structural Audit Services in Navi Mumbai, Mumbai, Pune, Raigad &amp; Thane</h2>
            <div class="rrsa-line"></div>
            <p class="rrsa-copy">Before starting any renovation, extension, remodeling, repair, or redevelopment project, it is essential to understand the structural condition of the existing building. At ConstructKaro, we provide professional Renovation &amp; Repair Structural Audit Services to evaluate the structural health, load-bearing capacity, and safety of buildings before civil, interior, or structural modification work begins.</p>
            <p class="rrsa-copy">Our experienced structural engineers help identify hidden defects, structural weaknesses, and repair requirements, ensuring that your renovation project is safe, cost-effective, and structurally sound.</p>
        </section>

        <section class="rrsa-section">
            <h2 class="rrsa-title">What is a Renovation &amp; Repair Structural Audit?</h2>
            <div class="rrsa-line"></div>
            <p class="rrsa-copy">A renovation and repair structural audit is a detailed engineering assessment conducted before renovation or repair work to determine whether the existing structure can safely support proposed modifications.</p>
            <p class="rrsa-copy">It evaluates:</p>

            <div class="rrsa-audit-strip">
                <div class="rrsa-step">Structural cracks</div>
                <div class="rrsa-step">Load-bearing capacity</div>
                <div class="rrsa-step">RCC deterioration</div>
                <div class="rrsa-step">Column and beam condition</div>
                <div class="rrsa-step">Water seepage impact</div>
                <div class="rrsa-step">Safety of planned changes</div>
            </div>
        </section>

        <section class="rrsa-section">
            <h2 class="rrsa-title">Why is a Structural Audit Important Before Renovation?</h2>
            <div class="rrsa-line"></div>
            <p class="rrsa-copy">Many older buildings may have hidden structural defects that become risky during renovation work.</p>
            <p class="rrsa-copy">Benefits of a Renovation Structural Audit:</p>
            <div class="rrsa-audit-strip">
                <div class="rrsa-step">Avoid unsafe modification</div>
                <div class="rrsa-step">Reduce repair surprises</div>
                <div class="rrsa-step">Plan strengthening work</div>
                <div class="rrsa-step">Improve renovation safety</div>
                <div class="rrsa-step">Support redesign decisions</div>
                <div class="rrsa-step">Avoid long-term damage</div>
            </div>
        </section>

        <section class="rrsa-section">
            <h2 class="rrsa-title">Our Renovation &amp; Repair Structural Audit Services Include</h2>
            <div class="rrsa-line"></div>

            <div class="rrsa-services">
                <article class="rrsa-service-card">
                    <span class="badge">1</span>
                    <h3>Visual Structural Inspection</h3>
                    <ul>
                        <li>Crack mapping</li>
                        <li>Settlement and leakage observation</li>
                        <li>Column, beam, slab, and wall inspection</li>
                        <li>Visible damage assessment</li>
                    </ul>
                </article>

                <article class="rrsa-service-card blue">
                    <span class="badge">2</span>
                    <h3>RCC Structural Assessment</h3>
                    <ul>
                        <li>RCC member condition review</li>
                        <li>Load-bearing element checks</li>
                        <li>Foundation and settlement observation</li>
                        <li>Modification suitability review</li>
                    </ul>
                </article>

                <article class="rrsa-service-card">
                    <span class="badge">3</span>
                    <h3>Repair Design &amp; Assessment</h3>
                    <ul>
                        <li>Repair method recommendation</li>
                        <li>Strengthening options</li>
                        <li>Structural repair prioritization</li>
                        <li>Modification risk review</li>
                    </ul>
                </article>
            </div>

            <div class="rrsa-services bottom">
                <article class="rrsa-service-card blue">
                    <span class="badge">4</span>
                    <h3>Water Damage &amp; Seepage Assessment</h3>
                    <ul>
                        <li>Dampness inspection</li>
                        <li>Leakage impact review</li>
                        <li>Waterproofing recommendations</li>
                        <li>RCC deterioration checks</li>
                    </ul>
                </article>

                <article class="rrsa-service-card">
                    <span class="badge">5</span>
                    <h3>Non-Destructive Testing (NDT) Consultation</h3>
                    <ul>
                        <li>Rebound hammer test</li>
                        <li>UPV testing support</li>
                        <li>Carbonation and corrosion checks</li>
                        <li>Core testing guidance</li>
                    </ul>
                </article>

                <article class="rrsa-service-card blue">
                    <span class="badge">6</span>
                    <h3>Renovation Feasibility Report</h3>
                    <ul>
                        <li>Pre-renovation safety assessment</li>
                        <li>Structural feasibility opinion</li>
                        <li>Repair and strengthening suggestions</li>
                        <li>Stage-wise recommendation</li>
                    </ul>
                </article>
            </div>
        </section>

        <section class="rrsa-section">
            <h2 class="rrsa-title small">Types of Renovation Projects We Audit</h2>
            <div class="rrsa-line"></div>

            <div class="rrsa-property-grid">
                <article class="rrsa-property-card">
                    <img src="{{ asset('images/logo/st2.png') }}" alt="Home renovation structural audit">
                    <h3>Home Renovation Structural Audit</h3>
                </article>
                <article class="rrsa-property-card">
                    <img src="{{ asset('images/logo/st3.png') }}" alt="Commercial renovation audit">
                    <h3>Commercial Renovation Structural Audit</h3>
                </article>
                <article class="rrsa-property-card">
                    <img src="{{ asset('images/logo/st4.png') }}" alt="Structural repair and renewal audit">
                    <h3>Structural Repair &amp; Renewal Audit</h3>
                </article>
                <article class="rrsa-property-card">
                    <img src="{{ asset('images/logo/st5.png') }}" alt="Old building rehabilitation audit">
                    <h3>Old Building Rehabilitation Audit</h3>
                </article>
            </div>
        </section>

        <section class="rrsa-section">
            <h2 class="rrsa-title small">When Should You Conduct a Renovation Structural Audit?</h2>
            <div class="rrsa-line"></div>
            <div class="rrsa-list-grid">
                <ul>
                    <li>Before removing walls</li>
                    <li>After visible structural cracks appear</li>
                </ul>
                <ul>
                    <li>Before adding new floors</li>
                    <li>Before structural modification work</li>
                </ul>
                <ul>
                    <li>Before major renovation work</li>
                    <li>When renovating older buildings</li>
                </ul>
                <ul>
                    <li>Before changing building usage</li>
                    <li>Before redevelopment planning</li>
                </ul>
            </div>
        </section>

        <section class="rrsa-section">
            <h2 class="rrsa-title small">Common Issues Identified During Renovation Audits</h2>
            <div class="rrsa-line"></div>
            <div class="rrsa-list-grid">
                <ul>
                    <li>Structural cracks</li>
                    <li>Foundation settlement</li>
                </ul>
                <ul>
                    <li>Concrete deterioration</li>
                    <li>Load-bearing wall concerns</li>
                </ul>
                <ul>
                    <li>Corrosion of reinforcement steel</li>
                    <li>Roof and slab damage</li>
                </ul>
                <ul>
                    <li>Water seepage damage</li>
                    <li>Structural instability risks</li>
                </ul>
            </div>
        </section>

        <section class="rrsa-section">
            <h2 class="rrsa-title small">Why Choose ConstructKaro?</h2>
            <div class="rrsa-line"></div>
            <div class="rrsa-benefits">
                <div class="rrsa-benefit"><strong><span>&#10003;</span>Experienced structural engineers</strong></div>
                <div class="rrsa-benefit"><strong><span>&#10003;</span>Detailed building inspection</strong></div>
                <div class="rrsa-benefit"><strong><span>&#10003;</span>NDT testing coordination support</strong></div>
                <div class="rrsa-benefit"><strong><span>&#10003;</span>Practical repair and strengthening recommendations</strong></div>
                <div class="rrsa-benefit"><strong><span>&#10003;</span>Residential, commercial &amp; industrial expertise</strong></div>
                <div class="rrsa-benefit"><strong><span>&#10003;</span>Comprehensive audit reports</strong></div>
            </div>
            <p class="rrsa-copy" style="margin-top: 12px;">We help property owners renovate with confidence by providing accurate structural assessments and professional engineering recommendations.</p>
        </section>

        <section class="rrsa-section">
            <h2 class="rrsa-title small">Our Audit Process</h2>
            <div class="rrsa-line"></div>
            <div class="rrsa-process">
                <div class="rrsa-process-step">1. Requirement Discussion</div>
                <div class="rrsa-process-step">2. Site Inspection &amp; Visual Assessment</div>
                <div class="rrsa-process-step">3. Structural Evaluation</div>
                <div class="rrsa-process-step">4. NDT Testing (if required)</div>
                <div class="rrsa-process-step">5. Analysis &amp; Risk Assessment</div>
                <div class="rrsa-process-step">6. Structural Audit Report Submission</div>
            </div>
        </section>

        <section class="rrsa-section rrsa-service-area">
            <div>
                <h3>Target Locations We Serve</h3>
                <p class="rrsa-copy"><strong>Renovation Structural Audit Services</strong></p>
                <ul>
                    <li>Renovation Structural Audit in Navi Mumbai</li>
                    <li>Building Repair Structural Audit in Mumbai</li>
                    <li>Structural Assessment for Renovation in Pune</li>
                    <li>Building Rehabilitation Audit in Raigad</li>
                    <li>Structural Inspection Services in Thane</li>
                </ul>
            </div>
            <div>
                <h3>Additional Locations</h3>
                <ul class="rrsa-location-list">
                    <li>Structural Audit in Panvel</li>
                    <li>Renovation Assessment in Kharghar</li>
                    <li>Building Repair Inspection in Karjat</li>
                    <li>Structural Evaluation in Khopoli</li>
                    <li>Property Rehabilitation Audit in Alibaug</li>
                </ul>
            </div>
        </section>

        <section class="rrsa-section">
            <h2 class="rrsa-title small">Frequently Asked Questions (FAQs)</h2>
            <div class="rrsa-line"></div>
            <div class="rrsa-faq">
                <details>
                    <summary>1. Why do I need a structural audit before renovation?</summary>
                    <p>It helps confirm whether the existing structure can safely support planned changes and identifies repair or strengthening needs before work starts.</p>
                </details>
                <details>
                    <summary>2. Can I remove walls after a structural audit?</summary>
                    <p>The audit can help identify whether a wall is structural or non-structural and whether removal requires strengthening or redesign.</p>
                </details>
                <details>
                    <summary>3. Do you provide NDT testing support?</summary>
                    <p>Yes. We provide NDT consultation and coordination support when testing is required for accurate structural assessment.</p>
                </details>
                <details>
                    <summary>4. Can you assess old buildings for renovation?</summary>
                    <p>Yes. We inspect old buildings and provide practical recommendations for repair, strengthening, and renovation feasibility.</p>
                </details>
                <details>
                    <summary>5. Will I receive recommendations for repairs and strengthening?</summary>
                    <p>Yes. The report includes findings, photographs, risk observations, and repair or strengthening recommendations.</p>
                </details>
            </div>
        </section>
    </div>
</main>
@endsection
