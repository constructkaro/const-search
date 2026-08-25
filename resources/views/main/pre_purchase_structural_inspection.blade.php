@extends('layouts.app')

@section('title', 'Pre-Purchase Structural Inspection Services')

@section('content')
<style>
    body {
        background: #e9e9e9;
        color: #141414;
        font-family: "Poppins", "Segoe UI", Arial, sans-serif;
    }

    .ppsa-page {
        background: #e9e9e9;
        padding-bottom: 42px;
    }

    .ppsa-hero {
        min-height: 280px;
        background:
            /* linear-gradient(90deg, rgba(2, 8, 16, .95) 0%, rgba(2, 8, 16, .72) 42%, rgba(2, 8, 16, .04) 100%), */
            url("{{ asset('images/logo/pps1.png') }}");
        background-size: cover;
        background-position: center right;
        display: flex;
        align-items: center;
        padding: 44px 70px;
    }

    .ppsa-hero h1 {
        margin: 0;
        max-width: 650px;
        color: #fff;
        font-size: 39px;
        line-height: 1.08;
        font-weight: 900;
        letter-spacing: 0;
    }

    .ppsa-wrap {
        max-width: 1120px;
        margin: 0 auto;
        padding: 24px 22px 0;
    }

    .ppsa-section {
        margin-bottom: 28px;
    }

    .ppsa-title {
        margin: 0 0 10px;
        color: #080808;
        text-align: center;
        font-size: 24px;
        line-height: 1.2;
        font-weight: 900;
    }

    .ppsa-title.small {
        font-size: 20px;
    }

    .ppsa-line {
        width: 154px;
        height: 4px;
        margin: 0 auto 18px;
        border-radius: 999px;
        background: linear-gradient(90deg, #f37021 0 50%, #1e73be 50% 100%);
    }

    .ppsa-copy {
        margin: 0 0 12px;
        color: #202020;
        font-size: 14px;
        line-height: 1.55;
        font-weight: 500;
    }

    .ppsa-audit-strip {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 8px;
        margin-top: 18px;
    }

    .ppsa-step {
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

    .ppsa-step:nth-child(even) {
        border-color: #f0a36e;
        background: #fff6ef;
    }

    .ppsa-note {
        margin-top: 10px;
        color: #222;
        text-align: center;
        font-size: 12px;
        font-weight: 700;
    }

    .ppsa-services {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 24px;
        max-width: 850px;
        margin: 0 auto 18px;
    }

    .ppsa-services.bottom {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        max-width: 580px;
    }

    .ppsa-service-card {
        position: relative;
        min-height: 142px;
        border: 2px solid #f37021;
        border-radius: 8px;
        background: #fff6ef;
        padding: 30px 18px 18px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, .08);
        text-align: center;
    }

    .ppsa-service-card.blue {
        border-color: #1e73be;
        background: #eef7ff;
    }

    .ppsa-service-card .badge {
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

    .ppsa-service-card.blue .badge {
        background: #1e73be;
    }

    .ppsa-service-card h3 {
        margin: 0 0 8px;
        color: #f37021;
        font-size: 15px;
        line-height: 1.15;
        font-weight: 900;
    }

    .ppsa-service-card.blue h3 {
        color: #1e73be;
    }

    .ppsa-service-card ul,
    .ppsa-list-grid ul,
    .ppsa-location-list,
    .ppsa-service-area ul {
        margin: 0;
        padding-left: 17px;
    }

    .ppsa-service-card li {
        color: #3c3c3c;
        text-align: left;
        font-size: 11px;
        line-height: 1.38;
        font-weight: 600;
    }

    .ppsa-property-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
    }

    .ppsa-property-card {
        overflow: hidden;
        border: 2px solid #1e73be;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, .1);
    }

    .ppsa-property-card:nth-child(odd) {
        border-color: #f37021;
    }

    .ppsa-property-card img {
        width: 100%;
        height: 132px;
        display: block;
        object-fit: cover;
    }

    .ppsa-property-card h3 {
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

    .ppsa-list-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px 28px;
    }

    .ppsa-list-grid li,
    .ppsa-location-list li,
    .ppsa-service-area li {
        color: #222;
        font-size: 13px;
        line-height: 1.35;
        font-weight: 700;
    }

    .ppsa-benefits {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 18px;
        margin-top: 4px;
    }

    .ppsa-benefit {
        text-align: center;
    }

    .ppsa-benefit span {
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

    .ppsa-benefit:nth-child(even) span {
        background: #f37021;
    }

    .ppsa-benefit strong {
        display: block;
        color: #1a1a1a;
        font-size: 12px;
        line-height: 1.25;
        font-weight: 900;
    }

    .ppsa-process {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 10px;
        margin-top: 14px;
    }

    .ppsa-process-step {
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

    .ppsa-process-step:nth-child(even) {
        border-bottom-color: #f37021;
    }

    .ppsa-service-area {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 38px;
        max-width: 820px;
        margin: 0 auto;
    }

    .ppsa-service-area h3 {
        margin: 0 0 8px;
        color: #111;
        font-size: 16px;
        line-height: 1.2;
        font-weight: 900;
    }

    .ppsa-faq {
        max-width: 980px;
        margin: 0 auto;
    }

    .ppsa-faq details {
        margin-bottom: 12px;
        border-radius: 5px;
        background: #fff;
        box-shadow: 0 1px 4px rgba(0, 0, 0, .13);
    }

    .ppsa-faq summary {
        padding: 13px 18px;
        color: #111;
        cursor: pointer;
        font-size: 13px;
        font-weight: 900;
    }

    .ppsa-faq p {
        margin: 0;
        padding: 0 18px 14px;
        color: #3d3d3d;
        font-size: 13px;
        line-height: 1.45;
        font-weight: 500;
    }

    /* Design polish: larger readable text, stronger cards, and better spacing */
    .ppsa-wrap {
        max-width: 1200px;
        padding: 34px 28px 0;
    }

    .ppsa-section {
        margin-bottom: 42px;
    }

    .ppsa-title {
        font-size: 30px;
        margin-bottom: 12px;
    }

    .ppsa-title.small {
        font-size: 26px;
    }

    .ppsa-line {
        width: 190px;
        height: 5px;
        margin-bottom: 24px;
    }

    .ppsa-copy {
        font-size: 16px;
        line-height: 1.72;
    }

    .ppsa-audit-strip {
        gap: 12px;
    }

    .ppsa-step {
        min-height: 72px;
        padding: 12px 14px;
        border-radius: 9px;
        font-size: 14px;
        line-height: 1.25;
    }

    .ppsa-note {
        font-size: 15px;
        line-height: 1.45;
    }

    .ppsa-services,
    .ppsa-services.bottom {
        max-width: 1040px;
        gap: 28px;
    }

    .ppsa-service-card {
        min-height: 192px;
        border-radius: 12px;
        padding: 38px 24px 24px;
        box-shadow: 0 8px 24px rgba(17, 24, 39, .10);
    }

    .ppsa-service-card .badge {
        width: 32px;
        height: 32px;
        top: -16px;
        font-size: 15px;
        line-height: 32px;
    }

    .ppsa-service-card h3 {
        font-size: 18px;
        line-height: 1.25;
        margin-bottom: 12px;
    }

    .ppsa-service-card li,
    .ppsa-list-grid li,
    .ppsa-location-list li,
    .ppsa-service-area li {
        font-size: 15px;
        line-height: 1.5;
    }

    .ppsa-property-grid {
        gap: 24px;
    }

    .ppsa-property-card {
        border-radius: 12px;
        box-shadow: 0 8px 22px rgba(17, 24, 39, .10);
    }

    .ppsa-property-card img {
        height: 178px;
    }

    .ppsa-property-card h3 {
        min-height: 68px;
        padding: 12px 14px;
        font-size: 15px;
        line-height: 1.25;
    }

    .ppsa-benefit strong {
        font-size: 15px;
        line-height: 1.35;
    }

    .ppsa-benefit span {
        width: 24px;
        height: 24px;
        font-size: 13px;
    }

    .ppsa-process-step {
        min-height: 76px;
        padding: 12px 14px;
        border-radius: 10px;
        font-size: 14px;
        line-height: 1.3;
    }

    .ppsa-service-area h3 {
        font-size: 21px;
        margin-bottom: 12px;
    }

    .ppsa-faq summary {
        padding: 16px 20px;
        font-size: 15px;
    }

    .ppsa-faq p {
        padding: 0 20px 18px;
        font-size: 15px;
        line-height: 1.6;
    }

    @media (max-width: 992px) {
        .ppsa-hero {
            padding: 38px 28px;
        }

        .ppsa-hero h1 {
            font-size: 32px;
        }

        .ppsa-audit-strip,
        .ppsa-services,
        .ppsa-services.bottom,
        .ppsa-property-grid,
        .ppsa-list-grid,
        .ppsa-benefits,
        .ppsa-process,
        .ppsa-service-area {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            max-width: none;
        }
    }

    @media (max-width: 576px) {
        .ppsa-hero {
            min-height: 235px;
            padding: 30px 18px;
        }

        .ppsa-hero h1 {
            font-size: 27px;
        }

        .ppsa-wrap {
            padding: 20px 14px 0;
        }

        .ppsa-title {
            font-size: 20px;
        }

        .ppsa-audit-strip,
        .ppsa-services,
        .ppsa-services.bottom,
        .ppsa-property-grid,
        .ppsa-list-grid,
        .ppsa-benefits,
        .ppsa-process,
        .ppsa-service-area {
            grid-template-columns: 1fr;
        }

        .ppsa-property-card img {
            height: 180px;
        }
    }
</style>

<main class="ppsa-page">
    <section class="ppsa-hero">
    <h1 class="ck-visually-hidden">Pre-Purchase Structural Inspection</h1>
    </section>

    <div class="ppsa-wrap">
        <section class="ppsa-section">
            <h2 class="ppsa-title">Pre-Purchase Structural Audit Services in Navi Mumbai, Mumbai, Pune, Raigad &amp; Thane</h2>
            <div class="ppsa-line"></div>
            <p class="ppsa-copy">Purchasing a property is a significant investment, and before committing, it is essential to clearly understand its structural condition. At ConstructKaro, we provide expert Pre-Purchase Structural Audit Services to help homebuyers, investors, businesses, and developers assess the structural soundness of a property before making a purchase decision.</p>
            <p class="ppsa-copy">Our experienced structural engineers conduct a detailed inspection and provide an unbiased assessment of the building's safety, durability, and maintenance requirements.</p>
        </section>

        <section class="ppsa-section">
            <h2 class="ppsa-title">What is a Pre-Purchase Structural Audit?</h2>
            <div class="ppsa-line"></div>
            <p class="ppsa-copy">A pre-purchase structural audit is a comprehensive inspection of a property conducted before buying it. The audit helps identify visible and potential structural issues that may affect the property's safety, value, or future maintenance costs.</p>
            <p class="ppsa-copy">The audit evaluates:</p>

            <div class="ppsa-audit-strip">
                <div class="ppsa-step">Visible cracks</div>
                <div class="ppsa-step">RCC condition</div>
                <div class="ppsa-step">Water seepage</div>
                <div class="ppsa-step">Structural stability</div>
                <div class="ppsa-step">Corrosion and deterioration</div>
                <div class="ppsa-step">Future repair requirements</div>
            </div>
        </section>

        <section class="ppsa-section">
            <h2 class="ppsa-title">Why is a Pre-Purchase Structural Audit Important?</h2>
            <div class="ppsa-line"></div>
            <p class="ppsa-copy">Many structural issues are not immediately visible during a routine property visit. A professional audit helps you avoid hidden risks and make an informed investment decision.</p>
            <p class="ppsa-copy">You benefit by:</p>
            <div class="ppsa-audit-strip">
                <div class="ppsa-step">Avoiding structural risk after purchase</div>
                <div class="ppsa-step">Understanding repair costs</div>
                <div class="ppsa-step">Getting negotiation input</div>
                <div class="ppsa-step">Checking building safety</div>
                <div class="ppsa-step">Verifying property condition</div>
                <div class="ppsa-step">Planning future expenses</div>
            </div>
        </section>

        <section class="ppsa-section">
            <h2 class="ppsa-title">Our Pre-Purchase Structural Audit Services Include</h2>
            <div class="ppsa-line"></div>

            <div class="ppsa-services">
                <article class="ppsa-service-card">
                    <span class="badge">1</span>
                    <h3>Visual Building Inspection</h3>
                    <ul>
                        <li>Crack inspection</li>
                        <li>Seepage and leakage observation</li>
                        <li>Column, beam, slab, and wall inspection</li>
                        <li>Visible structural condition review</li>
                    </ul>
                </article>

                <article class="ppsa-service-card blue">
                    <span class="badge">2</span>
                    <h3>RCC Structural Assessment</h3>
                    <ul>
                        <li>RCC condition assessment</li>
                        <li>Structural stability observations</li>
                        <li>Foundation and settlement checks</li>
                        <li>Load-bearing member review</li>
                    </ul>
                </article>

                <article class="ppsa-service-card">
                    <span class="badge">3</span>
                    <h3>Water Seepage &amp; Dampness Inspection</h3>
                    <ul>
                        <li>Leakage inspection</li>
                        <li>Dampness and fungus observation</li>
                        <li>Terrace waterproofing review</li>
                        <li>Bathroom and plumbing seepage checks</li>
                    </ul>
                </article>
            </div>

            <div class="ppsa-services bottom">
                <article class="ppsa-service-card blue">
                    <span class="badge">4</span>
                    <h3>Structural Risk Assessment</h3>
                    <ul>
                        <li>Safety review of structural elements</li>
                        <li>Expected maintenance issues</li>
                        <li>Repair priority advice</li>
                        <li>Future risk identification</li>
                    </ul>
                </article>

                <article class="ppsa-service-card">
                    <span class="badge">5</span>
                    <h3>Audit Report &amp; Recommendation</h3>
                    <ul>
                        <li>Detailed inspection report</li>
                        <li>Photographic documentation</li>
                        <li>Repair recommendations</li>
                        <li>Professional opinion for purchase decision</li>
                    </ul>
                </article>
            </div>
        </section>

        <section class="ppsa-section">
            <h2 class="ppsa-title small">Types of Properties We Inspect</h2>
            <div class="ppsa-line"></div>

            <div class="ppsa-property-grid">
                <article class="ppsa-property-card">
                    <img src="{{ asset('images/logo/st2.png') }}" alt="Residential properties">
                    <h3>Residential Properties</h3>
                </article>
                <article class="ppsa-property-card">
                    <img src="{{ asset('images/logo/st3.png') }}" alt="Commercial properties">
                    <h3>Commercial Properties</h3>
                </article>
                <article class="ppsa-property-card">
                    <img src="{{ asset('images/logo/st4.png') }}" alt="Industrial properties">
                    <h3>Industrial Properties</h3>
                </article>
                <article class="ppsa-property-card">
                    <img src="{{ asset('images/logo/st5.png') }}" alt="Old and resale properties">
                    <h3>Old &amp; Resale Properties</h3>
                </article>
            </div>
        </section>

        <section class="ppsa-section">
            <h2 class="ppsa-title small">What We Check During a Pre-Purchase Structural Audit</h2>
            <div class="ppsa-line"></div>
            <div class="ppsa-services">
                <article class="ppsa-service-card">
                    <span class="badge">1</span>
                    <h3>Structural Components</h3>
                    <ul>
                        <li>Columns</li>
                        <li>Beams</li>
                        <li>Slabs</li>
                        <li>Walls and supports</li>
                    </ul>
                </article>

                <article class="ppsa-service-card blue">
                    <span class="badge">2</span>
                    <h3>Building Condition</h3>
                    <ul>
                        <li>Cracks</li>
                        <li>Settlement</li>
                        <li>Dampness</li>
                        <li>Leakage observations</li>
                    </ul>
                </article>

                <article class="ppsa-service-card">
                    <span class="badge">3</span>
                    <h3>Water &amp; Moisture Issues</h3>
                    <ul>
                        <li>Roof leakage</li>
                        <li>Wall seepage</li>
                        <li>Bathroom leakage</li>
                        <li>Waterproofing failure</li>
                    </ul>
                </article>
            </div>
        </section>

        <section class="ppsa-section">
            <h2 class="ppsa-title small">Who Should Get a Pre-Purchase Structural Audit?</h2>
            <div class="ppsa-line"></div>
            <div class="ppsa-list-grid">
                <ul>
                    <li>Homebuyers</li>
                    <li>Real estate developers</li>
                </ul>
                <ul>
                    <li>Property investors</li>
                    <li>Replacement property owners</li>
                </ul>
                <ul>
                    <li>Commercial property buyers</li>
                </ul>
                <ul>
                    <li>Industrial property purchasers</li>
                </ul>
            </div>
        </section>

        <section class="ppsa-section">
            <h2 class="ppsa-title small">Why Choose ConstructKaro?</h2>
            <div class="ppsa-line"></div>
            <div class="ppsa-benefits">
                <div class="ppsa-benefit"><span>1</span><strong>Experienced structural engineers</strong></div>
                <div class="ppsa-benefit"><span>2</span><strong>Independent property assessment</strong></div>
                <div class="ppsa-benefit"><span>3</span><strong>Detailed inspection reports</strong></div>
                <div class="ppsa-benefit"><span>4</span><strong>Practical repair recommendations</strong></div>
                <div class="ppsa-benefit"><span>5</span><strong>Decision-making support for buyers</strong></div>
            </div>
            <p class="ppsa-note">We help buyers make confident, informed, and risk-aware property investment decisions.</p>
        </section>

        <section class="ppsa-section">
            <h2 class="ppsa-title small">Our Structural Audit Process</h2>
            <div class="ppsa-line"></div>
            <div class="ppsa-process">
                <div class="ppsa-process-step">1. Property Information Review</div>
                <div class="ppsa-process-step">2. Site Visit &amp; Inspection</div>
                <div class="ppsa-process-step">3. Structural Assessment</div>
                <div class="ppsa-process-step">4. Risk Evaluation</div>
                <div class="ppsa-process-step">5. Report Preparation</div>
            </div>
        </section>

        <section class="ppsa-section ppsa-service-area">
            <div>
                <h3>Target Locations We Serve</h3>
                <p class="ppsa-copy"><strong>Pre-Purchase Structural Audit Services</strong></p>
                <ul>
                    <li>Pre-Purchase Structural Audit in Navi Mumbai</li>
                    <li>Property Structural Inspection in Mumbai</li>
                    <li>Home Structural Audit in Pune</li>
                    <li>Building Inspection Services in Raigad</li>
                    <li>Commercial Assessment in Thane</li>
                </ul>
            </div>
            <div>
                <h3>Additional Locations</h3>
                <ul class="ppsa-location-list">
                    <li>Property Audit in Panvel</li>
                    <li>Structural Inspection in Kharghar</li>
                    <li>Building Audit in Virar</li>
                    <li>Property Assessment in Khopoli</li>
                    <li>Structural Audit in Alibaug</li>
                </ul>
            </div>
        </section>

        <section class="ppsa-section">
            <h2 class="ppsa-title small">Frequently Asked Questions (FAQs)</h2>
            <div class="ppsa-line"></div>
            <div class="ppsa-faq">
                <details>
                    <summary>1. What is a pre-purchase structural audit?</summary>
                    <p>It is a professional inspection conducted before buying a property to evaluate structural safety, defects, and future repair needs.</p>
                </details>
                <details>
                    <summary>2. Is a structural audit necessary before buying a property?</summary>
                    <p>Yes. It helps identify hidden structural risks and maintenance costs before purchase.</p>
                </details>
                <details>
                    <summary>3. Can a structural audit help with price negotiation?</summary>
                    <p>Yes. The findings can help buyers understand repair costs and make a more informed purchase or negotiation decision.</p>
                </details>
                <details>
                    <summary>4. Do you provide a detailed audit report?</summary>
                    <p>Yes. The audit includes observations, photographs, risk notes, and practical recommendations.</p>
                </details>
                <details>
                    <summary>5. Can you audit residential, commercial, and industrial properties?</summary>
                    <p>Yes. We inspect residential, commercial, industrial, old, resale, and redevelopment-related properties.</p>
                </details>
            </div>
        </section>
    </div>
</main>
@endsection
