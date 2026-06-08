@extends('layouts.app')

@section('title', 'Construction Layout Survey Services')

@section('content')

<style>
    .construction-layout-page {
        font-family: "Poppins", "Segoe UI", sans-serif;
        background: #efefef;
        color: #222;
    }

    .construction-layout-hero {
        min-height: 330px;
        display: flex;
        align-items: center;
        padding: 58px 7%;
        background:
            /* linear-gradient(90deg, rgba(0,0,0,.86) 0%, rgba(0,0,0,.56) 45%, rgba(0,0,0,.08) 100%), */
            url("{{ asset('images/logo/cls1.png') }}") center/cover no-repeat;
    }

    .construction-layout-hero h1 {
        max-width: 760px;
        margin: 0;
        color: #fff;
        font-size: clamp(34px, 5vw, 62px);
        line-height: 1.1;
        font-weight: 900;
        text-shadow: 0 5px 16px rgba(0,0,0,.5);
    }

    .construction-layout-section {
        padding: 42px 7%;
    }

    .construction-layout-wrap {
        max-width: 1180px;
        margin: 0 auto;
    }

    .construction-layout-title {
        text-align: center;
        font-size: clamp(24px, 3vw, 36px);
        font-weight: 900;
        line-height: 1.2;
        margin: 0;
    }

    .construction-layout-line {
        width: min(260px, 72vw);
        height: 4px;
        margin: 12px auto 28px;
        border-radius: 99px;
        background: linear-gradient(90deg, #f37021 0 50%, #1e73be 50% 100%);
    }

    .construction-layout-copy {
        font-size: 17px;
        line-height: 1.7;
        color: #444;
        margin: 0 0 18px;
    }

    .construction-layout-steps {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 12px;
        margin-top: 24px;
    }

    .construction-layout-step {
        background: #fff;
        border: 2px solid #1e73be;
        border-radius: 8px;
        padding: 14px 10px;
        text-align: center;
        font-size: 13px;
        font-weight: 800;
        min-height: 72px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .construction-layout-grid {
        display: grid;
        gap: 22px;
    }

    .construction-layout-grid.three {
        grid-template-columns: repeat(3, 1fr);
    }

    .construction-layout-grid.two {
        grid-template-columns: repeat(2, 1fr);
        max-width: 780px;
        margin: 22px auto 0;
    }

    .construction-layout-grid.four {
        grid-template-columns: repeat(4, 1fr);
    }

    .construction-layout-card {
        background: #fff7f1;
        border: 2px solid #f37021;
        border-radius: 10px;
        padding: 22px;
        box-shadow: 0 6px 16px rgba(0,0,0,.08);
        position: relative;
    }

    .construction-layout-card.blue {
        border-color: #1e73be;
        background: #f3f9ff;
    }

    .construction-layout-number {
        position: absolute;
        top: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 28px;
        height: 28px;
        border-radius: 6px;
        background: #f37021;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 900;
    }

    .construction-layout-card.blue .construction-layout-number {
        background: #1e73be;
    }

    .construction-layout-card h3 {
        margin: 8px 0 12px;
        color: #f37021;
        font-size: 18px;
        font-weight: 900;
    }

    .construction-layout-card.blue h3 {
        color: #1e73be;
    }

    .construction-layout-card ul {
        margin: 0;
        padding-left: 18px;
    }

    .construction-layout-card li {
        color: #444;
        font-size: 14px;
        line-height: 1.55;
        margin-bottom: 7px;
    }

    .construction-layout-project {
        overflow: hidden;
        padding: 0;
        background: #fff;
    }

    .construction-layout-project img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        display: block;
    }

    .construction-layout-project h3 {
        min-height: 64px;
        margin: 0;
        padding: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        font-size: 15px;
        color: #222;
    }

    .construction-layout-checks {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 14px;
        text-align: center;
    }

    .construction-layout-check {
        font-size: 13px;
        line-height: 1.45;
        font-weight: 800;
    }

    .construction-layout-check span {
        display: block;
        color: #1e73be;
        font-size: 19px;
        margin-bottom: 6px;
    }

    .construction-layout-process {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 14px;
    }

    .construction-layout-process div {
        font-size: 13px;
        font-weight: 800;
        text-align: center;
        background: #fff;
        border-radius: 8px;
        padding: 16px 10px;
        border-top: 4px solid #f37021;
    }

    .construction-layout-locations {
        max-width: 760px;
        margin: 0 auto;
        color: #333;
        font-size: 16px;
        line-height: 1.75;
    }

    .construction-layout-faq {
        display: flex;
        flex-direction: column;
        gap: 13px;
    }

    .construction-layout-faq details {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,.12);
        overflow: hidden;
    }

    .construction-layout-faq summary {
        cursor: pointer;
        padding: 18px 22px;
        font-weight: 900;
        font-size: 15px;
    }

    .construction-layout-faq p {
        margin: 0;
        padding: 0 22px 18px;
        color: #555;
        line-height: 1.6;
        font-size: 14px;
    }

    @media (max-width: 991px) {
        .construction-layout-steps,
        .construction-layout-grid.three,
        .construction-layout-grid.four,
        .construction-layout-checks,
        .construction-layout-process {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .construction-layout-hero {
            min-height: 280px;
            padding: 48px 22px;
        }

        .construction-layout-section {
            padding: 34px 18px;
        }

        .construction-layout-steps,
        .construction-layout-grid.three,
        .construction-layout-grid.two,
        .construction-layout-grid.four,
        .construction-layout-checks,
        .construction-layout-process {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="construction-layout-page">
    <section class="construction-layout-hero">
        <!-- <h1>Construction<br>Layout Survey</h1> -->
    </section>

    <section class="construction-layout-section">
        <div class="construction-layout-wrap">
            <h2 class="construction-layout-title">Construction Layout Survey Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane</h2>
            <div class="construction-layout-line"></div>
            <p class="construction-layout-copy">
                Before construction begins, accurate layout marking is essential to ensure that every column, footing, wall, road, and structure is built in the correct location. At ConstructKaro, we provide professional Construction Layout Survey Services using advanced Total Station Survey Equipment and DGPS Technology to ensure precision on site setting out and construction alignment.
            </p>
            <p class="construction-layout-copy">
                Whether it is a residential building, commercial complex, industrial facility, warehouse, road project, or infrastructure development, our construction layout survey helps eliminate costly errors and ensures smooth project execution.
            </p>
        </div>
    </section>

    <section class="construction-layout-section">
        <div class="construction-layout-wrap">
            <h2 class="construction-layout-title">What is a Construction Layout Survey?</h2>
            <div class="construction-layout-line"></div>
            <p class="construction-layout-copy">
                A Construction Layout Survey, also known as setting out survey, is the process of transferring approved engineering and architectural drawings from paper or CAD files onto the actual construction site.
            </p>
            <p class="construction-layout-copy">The survey helps mark:</p>
            <div class="construction-layout-steps">
                <div class="construction-layout-step">Building corners</div>
                <div class="construction-layout-step">Footing locations</div>
                <div class="construction-layout-step">Column grid lines</div>
                <div class="construction-layout-step">Road alignments</div>
                <div class="construction-layout-step">Boundary references</div>
                <div class="construction-layout-step">Utility and infrastructure positions</div>
            </div>
            <p class="construction-layout-copy" style="margin-top:24px;">
                Our Construction Layout Survey Services include:
            </p>
        </div>
    </section>

    <section class="construction-layout-section">
        <div class="construction-layout-wrap">
            <h2 class="construction-layout-title">Our Layout & Plotting Survey Services Include</h2>
            <div class="construction-layout-line"></div>
            <div class="construction-layout-grid three">
                <div class="construction-layout-card">
                    <div class="construction-layout-number">1</div>
                    <h3>Building Layout Marking</h3>
                    <ul>
                        <li>Column grid marking</li>
                        <li>Axis line setting out</li>
                        <li>Foundation reference points</li>
                        <li>Basement alignment verification</li>
                    </ul>
                </div>
                <div class="construction-layout-card blue">
                    <div class="construction-layout-number">2</div>
                    <h3>Footing & Column Layout Survey</h3>
                    <ul>
                        <li>Footing position marking</li>
                        <li>Column centerline marking</li>
                        <li>Structural drawing transfer</li>
                        <li>Grid verification</li>
                    </ul>
                </div>
                <div class="construction-layout-card">
                    <div class="construction-layout-number">3</div>
                    <h3>Road & Infrastructure Layout Survey</h3>
                    <ul>
                        <li>Road centerline marking</li>
                        <li>Drainage alignment setting out</li>
                        <li>Utility corridor marking</li>
                        <li>Infrastructure reference points</li>
                    </ul>
                </div>
            </div>
            <div class="construction-layout-grid two">
                <div class="construction-layout-card blue">
                    <div class="construction-layout-number">4</div>
                    <h3>Industrial & Warehouse Layout Survey</h3>
                    <ul>
                        <li>Factory building layout</li>
                        <li>Warehouse grid setting</li>
                        <li>Equipment foundation marking</li>
                        <li>Industrial infrastructure alignment</li>
                    </ul>
                </div>
                <div class="construction-layout-card">
                    <div class="construction-layout-number">5</div>
                    <h3>Verification & As-Built Survey</h3>
                    <ul>
                        <li>Layout verification</li>
                        <li>Construction accuracy checking</li>
                        <li>Deviation identification</li>
                        <li>As-built documentation</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="construction-layout-section">
        <div class="construction-layout-wrap">
            <h2 class="construction-layout-title">Types of Construction Layout Survey Projects</h2>
            <div class="construction-layout-line"></div>
            <div class="construction-layout-grid four">
                <!-- <div class="construction-layout-card construction-layout-project"> -->
                    <img src="{{ asset('images/logo/cls2.png') }}" alt="Residential construction layout survey">
                    <!-- <h3>Residential Construction Layout Survey</h3> -->
                <!-- </div> -->
                <!-- <div class="construction-layout-card construction-layout-project blue"> -->
                    <img src="{{ asset('images/logo/cls3.png') }}" alt="Commercial construction layout survey">
                    <!-- <h3>Commercial Construction Layout Survey</h3> -->
                <!-- </div> -->
                <!-- <div class="construction-layout-card construction-layout-project"> -->
                    <img src="{{ asset('images/logo/cls4.png') }}" alt="Industrial construction layout survey">
                    <!-- <h3>Industrial Construction Layout Survey</h3> -->
                <!-- </div> -->
                <!-- <div class="construction-layout-card construction-layout-project blue"> -->
                    <img src="{{ asset('images/logo/cls5.png') }}" alt="Road and infrastructure layout survey">
                    <!-- <h3>Road & Infrastructure Layout Survey</h3> -->
                <!-- </div> -->
            </div>
        </div>
    </section>

    <section class="construction-layout-section">
        <div class="construction-layout-wrap">
            <h2 class="construction-layout-title">Benefits of Layout & Plotting Survey</h2>
            <div class="construction-layout-line"></div>
            <div class="construction-layout-checks">
                <div class="construction-layout-check"><span>&#10003;</span>Accurate building positioning</div>
                <div class="construction-layout-check"><span>&#10003;</span>Prevents construction errors</div>
                <div class="construction-layout-check"><span>&#10003;</span>Reduces rework and wastage</div>
                <div class="construction-layout-check"><span>&#10003;</span>Ensures design compliance</div>
                <div class="construction-layout-check"><span>&#10003;</span>Faster project execution</div>
                <div class="construction-layout-check"><span>&#10003;</span>Improved construction quality</div>
            </div>
        </div>
    </section>

    <section class="construction-layout-section">
        <div class="construction-layout-wrap">
            <h2 class="construction-layout-title">Why Choose ConstructKaro?</h2>
            <div class="construction-layout-line"></div>
            <div class="construction-layout-checks">
                <div class="construction-layout-check"><span>&#10003;</span>Experienced survey professionals</div>
                <div class="construction-layout-check"><span>&#10003;</span>Advanced Total Station and DGPS equipment</div>
                <div class="construction-layout-check"><span>&#10003;</span>Accurate setting out and layout marking</div>
                <div class="construction-layout-check"><span>&#10003;</span>Digital survey records and reports</div>
                <div class="construction-layout-check"><span>&#10003;</span>Support for residential, commercial and industrial projects</div>
                <div class="construction-layout-check"><span>&#10003;</span>We help ensure your construction starts with precise layout marking and professional surveying support.</div>
            </div>
        </div>
    </section>

    <section class="construction-layout-section">
        <div class="construction-layout-wrap">
            <h2 class="construction-layout-title">Our Survey Process</h2>
            <div class="construction-layout-line"></div>
            <div class="construction-layout-process">
                <div>1. Drawing & Document Review</div>
                <div>2. Site Inspection</div>
                <div>3. Control Point Establishment</div>
                <div>4. Layout Marking & Setting Out</div>
                <div>5. Verification & Accuracy Check</div>
                <div>6. Survey Report Submission</div>
            </div>
        </div>
    </section>

    <section class="construction-layout-section">
        <div class="construction-layout-wrap">
            <h2 class="construction-layout-title">Target Locations We Serve</h2>
            <div class="construction-layout-line"></div>
            <ul class="construction-layout-locations">
                <li>Construction Layout Services in Navi Mumbai</li>
                <li>Building Layout Survey in Mumbai</li>
                <li>Setting Out Survey in Pune</li>
                <li>Construction Survey Services in Raigad</li>
                <li>Total Station Layout Survey in Thane</li>
            </ul>
        </div>
    </section>

    <section class="construction-layout-section">
        <div class="construction-layout-wrap">
            <h2 class="construction-layout-title">Additional Locations</h2>
            <div class="construction-layout-line"></div>
            <ul class="construction-layout-locations">
                <li>Construction Survey in Panvel</li>
                <li>Layout Marking Survey in Kharghar</li>
                <li>Setting Out Survey in Karjat</li>
                <li>Building Layout Survey in Khopoli</li>
                <li>Construction Survey in Alibaug</li>
            </ul>
        </div>
    </section>

    <section class="construction-layout-section">
        <div class="construction-layout-wrap">
            <h2 class="construction-layout-title">Frequently Asked Questions (FAQs)</h2>
            <div class="construction-layout-line"></div>
            <div class="construction-layout-faq">
                <details>
                    <summary>1. What is a construction layout survey?</summary>
                    <p>It is the process of transferring approved drawings onto the construction site by marking columns, footings, walls, roads, and other reference points.</p>
                </details>
                <details>
                    <summary>2. Why is construction layout marking important?</summary>
                    <p>It prevents positioning errors, reduces rework, improves site accuracy, and helps ensure construction follows the approved drawings.</p>
                </details>
                <details>
                    <summary>3. Which equipment is used for construction layout surveys?</summary>
                    <p>Total Station and DGPS equipment may be used depending on the project size, required accuracy, and site conditions.</p>
                </details>
                <details>
                    <summary>4. Do you provide layout surveys for industrial projects?</summary>
                    <p>Yes, layout surveys can be provided for industrial buildings, warehouses, factories, roads, and infrastructure projects.</p>
                </details>
                <details>
                    <summary>5. Can you verify construction accuracy after marking?</summary>
                    <p>Yes, verification and as-built surveys can be done to check construction accuracy and identify deviations.</p>
                </details>
            </div>
        </div>
    </section>
</div>

@endsection
