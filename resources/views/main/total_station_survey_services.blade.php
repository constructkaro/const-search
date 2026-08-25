@extends('layouts.app')

@section('title', 'Total Station Survey Services')

@section('content')

<style>
    .total-page {
        font-family: "Poppins", "Segoe UI", sans-serif;
        background: #efefef;
        color: #222;
    }

    .total-hero {
        min-height: 330px;
        display: flex;
        align-items: center;
        padding: 58px 7%;
        background:
            /* linear-gradient(90deg, rgba(0,0,0,.86) 0%, rgba(0,0,0,.56) 45%, rgba(0,0,0,.08) 100%), */
            url("{{ asset('images/logo/tss1.png') }}") center/cover no-repeat;
    }

    .total-hero h1 {
        max-width: 760px;
        margin: 0;
        color: #fff;
        font-size: clamp(34px, 5vw, 62px);
        line-height: 1.1;
        font-weight: 900;
        text-shadow: 0 5px 16px rgba(0,0,0,.5);
    }

    .total-section {
        padding: 42px 7%;
    }

    .total-wrap {
        max-width: 1180px;
        margin: 0 auto;
    }

    .total-title {
        text-align: center;
        font-size: clamp(24px, 3vw, 36px);
        font-weight: 900;
        line-height: 1.2;
        margin: 0;
    }

    .total-line {
        width: min(260px, 72vw);
        height: 4px;
        margin: 12px auto 28px;
        border-radius: 99px;
        background: linear-gradient(90deg, #f37021 0 50%, #1e73be 50% 100%);
    }

    .total-copy {
        font-size: 17px;
        line-height: 1.7;
        color: #444;
        margin: 0 0 18px;
    }

    .total-steps {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 12px;
        margin-top: 24px;
    }

    .total-step {
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

    .total-grid {
        display: grid;
        gap: 22px;
    }

    .total-grid.three {
        grid-template-columns: repeat(3, 1fr);
    }

    .total-grid.two {
        grid-template-columns: repeat(2, 1fr);
        max-width: 780px;
        margin: 22px auto 0;
    }

    .total-grid.four {
        grid-template-columns: repeat(4, 1fr);
    }

    .total-card {
        background: #fff7f1;
        border: 2px solid #f37021;
        border-radius: 10px;
        padding: 22px;
        box-shadow: 0 6px 16px rgba(0,0,0,.08);
        position: relative;
    }

    .total-card.blue {
        border-color: #1e73be;
        background: #f3f9ff;
    }

    .total-number {
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

    .total-card.blue .total-number {
        background: #1e73be;
    }

    .total-card h3 {
        margin: 8px 0 12px;
        color: #f37021;
        font-size: 18px;
        font-weight: 900;
    }

    .total-card.blue h3 {
        color: #1e73be;
    }

    .total-card ul {
        margin: 0;
        padding-left: 18px;
    }

    .total-card li {
        color: #444;
        font-size: 14px;
        line-height: 1.55;
        margin-bottom: 7px;
    }

    .total-project {
        overflow: hidden;
        padding: 0;
        background: #fff;
    }

    .total-project img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        display: block;
    }

    .total-project h3 {
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

    .total-checks {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 14px;
        text-align: center;
    }

    .total-check {
        font-size: 13px;
        line-height: 1.45;
        font-weight: 800;
    }

    .total-check span {
        display: block;
        color: #1e73be;
        font-size: 19px;
        margin-bottom: 6px;
    }

    .total-process {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 14px;
    }

    .total-process div {
        font-size: 14px;
        font-weight: 800;
        text-align: center;
        background: #fff;
        border-radius: 8px;
        padding: 16px 10px;
        border-top: 4px solid #f37021;
    }

    .total-locations {
        max-width: 760px;
        margin: 0 auto;
        color: #333;
        font-size: 16px;
        line-height: 1.75;
    }

    .total-faq {
        display: flex;
        flex-direction: column;
        gap: 13px;
    }

    .total-faq details {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,.12);
        overflow: hidden;
    }

    .total-faq summary {
        cursor: pointer;
        padding: 18px 22px;
        font-weight: 900;
        font-size: 15px;
    }

    .total-faq p {
        margin: 0;
        padding: 0 22px 18px;
        color: #555;
        line-height: 1.6;
        font-size: 14px;
    }

    @media (max-width: 991px) {
        .total-steps,
        .total-grid.three,
        .total-grid.four,
        .total-checks,
        .total-process {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .total-hero {
            min-height: 280px;
            padding: 48px 22px;
        }

        .total-section {
            padding: 34px 18px;
        }

        .total-steps,
        .total-grid.three,
        .total-grid.two,
        .total-grid.four,
        .total-checks,
        .total-process {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="total-page">
    <section class="total-hero">
    <h1 class="ck-visually-hidden">Total Station Survey</h1>
    </section>

    <section class="total-section">
        <div class="total-wrap">
            <h2 class="total-title">Total Station Survey Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane</h2>
            <div class="total-line"></div>
            <p class="total-copy">
                Accurate measurement is the foundation of every successful construction, infrastructure, and land development project.
                At ConstructKaro, we provide professional Total Station Survey Services using advanced Total Station equipment to deliver precise coordinates, levels, distances, and site data.
            </p>
            <p class="total-copy">
                Whether you are planning a residential project, industrial development, road construction, plotting layout, or infrastructure project, our survey experts ensure accurate site information for better planning and execution.
            </p>
        </div>
    </section>

    <section class="total-section">
        <div class="total-wrap">
            <h2 class="total-title">What is a Total Station Survey?</h2>
            <div class="total-line"></div>
            <p class="total-copy">
                A Total Station Survey is a modern surveying method that uses electronic and optical equipment to measure distance, angles, levels, and coordinates with high accuracy.
            </p>
            <div class="total-steps">
                <div class="total-step">Horizontal and vertical angles</div>
                <div class="total-step">Distances and coordinates</div>
                <div class="total-step">Ground levels and elevations</div>
                <div class="total-step">Construction reference points</div>
                <div class="total-step">Construction reference points</div>
                <div class="total-step">Survey control points</div>
            </div>
            <p class="total-copy" style="margin-top:24px;">
                Compared to traditional survey methods, total station surveys provide higher accuracy, faster data collection, and digital mapping capability.
            </p>
        </div>
    </section>

    <section class="total-section">
        <div class="total-wrap">
            <h2 class="total-title">Our Total Station Survey Services Include</h2>
            <div class="total-line"></div>
            <div class="total-grid three">
                <div class="total-card">
                    <div class="total-number">1</div>
                    <h3>Boundary & Land Measurement Survey</h3>
                    <ul>
                        <li>Plot boundary verification</li>
                        <li>Land dimensions</li>
                        <li>Area measurement</li>
                        <li>Property demarcation</li>
                    </ul>
                </div>
                <div class="total-card blue">
                    <div class="total-number">2</div>
                    <h3>Topographic & Contour Survey</h3>
                    <ul>
                        <li>Ground level mapping</li>
                        <li>Contour generation</li>
                        <li>Natural and existing site features</li>
                    </ul>
                </div>
                <div class="total-card">
                    <div class="total-number">3</div>
                    <h3>Construction Layout Survey</h3>
                    <ul>
                        <li>Building layout marking</li>
                        <li>Column grid marking</li>
                        <li>Road alignment setting</li>
                        <li>Infrastructure layout support</li>
                    </ul>
                </div>
            </div>
            <div class="total-grid two">
                <div class="total-card blue">
                    <div class="total-number">4</div>
                    <h3>Plotting & Township Survey</h3>
                    <ul>
                        <li>Residential plotting layout</li>
                        <li>Township development survey</li>
                        <li>Road and plot marking</li>
                    </ul>
                </div>
                <div class="total-card">
                    <div class="total-number">5</div>
                    <h3>As-Built & Verification Survey</h3>
                    <ul>
                        <li>Existing structure measurement</li>
                        <li>Site verification survey</li>
                        <li>Quality checking</li>
                        <li>Construction progress survey</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="total-section">
        <div class="total-wrap">
            <h2 class="total-title">Applications of Total Station Survey</h2>
            <div class="total-line"></div>
            <div class="total-grid four">
                <!-- <div class="total-card total-project"> -->
                    <img src="{{ asset('images/logo/tss2.png') }}" alt="Residential projects">
                    <!-- <h3>Residential Projects</h3> -->
                <!-- </div> -->
                <!-- <div class="total-card total-project blue"> -->
                    <img src="{{ asset('images/logo/tss4.png') }}" alt="Commercial and industrial projects">
                    <!-- <h3>Commercial & Industrial Projects</h3>
                </div> -->
                <!-- <div class="total-card total-project"> -->
                    <img src="{{ asset('images/logo/tss3.png') }}" alt="Road and infrastructure projects">
                    <!-- <h3>Road & Infrastructure Projects</h3>
                </div> -->
                <!-- <div class="total-card total-project blue"> -->
                    <img src="{{ asset('images/logo/tss5.png') }}" alt="Plotting and land development">
                    <!-- <h3>Plotting & Land Development</h3>
                </div> -->
            </div>
        </div>
    </section>

    <section class="total-section">
        <div class="total-wrap">
            <h2 class="total-title">Benefits of Total Station Survey</h2>
            <div class="total-line"></div>
            <div class="total-checks">
                <div class="total-check"><span>&#10003;</span>High measurement accuracy</div>
                <div class="total-check"><span>&#10003;</span>Faster survey execution</div>
                <div class="total-check"><span>&#10003;</span>Digital data collection</div>
                <div class="total-check"><span>&#10003;</span>Reduced human errors</div>
                <div class="total-check"><span>&#10003;</span>Better construction planning</div>
                <div class="total-check"><span>&#10003;</span>Accurate CAD drawings and reports</div>
            </div>
        </div>
    </section>

    <section class="total-section">
        <div class="total-wrap">
            <h2 class="total-title">Why Choose ConstructKaro?</h2>
            <div class="total-line"></div>
            <div class="total-checks">
                <div class="total-check"><span>&#10003;</span>Experienced survey professionals</div>
                <div class="total-check"><span>&#10003;</span>Advanced Total Station survey equipment</div>
                <div class="total-check"><span>&#10003;</span>Accurate land and construction surveys</div>
                <div class="total-check"><span>&#10003;</span>Digital reports and CAD drawings</div>
                <div class="total-check"><span>&#10003;</span>Support for residential, commercial and infrastructure projects</div>
                <div class="total-check"><span>&#10003;</span>We help ensure your project starts with accurate measurements, reliable data, and professional survey support.</div>
            </div>
        </div>
    </section>

    <section class="total-section">
        <div class="total-wrap">
            <h2 class="total-title">Our Survey Process</h2>
            <div class="total-line"></div>
            <div class="total-process">
                <div>1. Requirement Discussion</div>
                <div>2. Site Inspection</div>
                <div>3. Total Station Data Collection</div>
                <div>4. Processing & Mapping</div>
                <div>5. Survey Drawing & Report Submission</div>
            </div>
        </div>
    </section>

    <section class="total-section">
        <div class="total-wrap">
            <h2 class="total-title">Target Locations We Serve</h2>
            <div class="total-line"></div>
            <ul class="total-locations">
                <li>Total Station Survey in Navi Mumbai</li>
                <li>Total Station Survey in Mumbai</li>
                <li>Total Station Survey in Pune</li>
                <li>Total Station Survey in Raigad</li>
                <li>Total Station Survey in Thane</li>
            </ul>
        </div>
    </section>

    <section class="total-section">
        <div class="total-wrap">
            <h2 class="total-title">Additional Locations</h2>
            <div class="total-line"></div>
            <ul class="total-locations">
                <li>Total Station Survey in Panvel</li>
                <li>Total Station Survey in Kharghar</li>
                <li>Total Station Survey in Karjat</li>
                <li>Total Station Survey in Alibaug</li>
                <li>Total Station Survey in Khopoli</li>
            </ul>
        </div>
    </section>

    <section class="total-section">
        <div class="total-wrap">
            <h2 class="total-title">Frequently Asked Questions (FAQs)</h2>
            <div class="total-line"></div>
            <div class="total-faq">
                <details>
                    <summary>1. What is a Total Station Survey used for?</summary>
                    <p>It is used for land measurement, construction layout, boundary marking, levels, coordinates, and accurate site mapping.</p>
                </details>
                <details>
                    <summary>2. How accurate is Total Station Survey Equipment?</summary>
                    <p>Total Station equipment provides high-precision measurements suitable for construction, infrastructure, and land development work.</p>
                </details>
                <details>
                    <summary>3. Do you provide survey drawings and CAD files?</summary>
                    <p>Yes, survey data can be delivered as CAD drawings, reports, levels, coordinates, and other project-ready files.</p>
                </details>
                <details>
                    <summary>4. Can Total Station Survey be used for plotting projects?</summary>
                    <p>Yes, it is commonly used for plotting layouts, township planning, plot demarcation, and road alignment marking.</p>
                </details>
                <details>
                    <summary>5. What is the difference between DGPS and Total Station Survey?</summary>
                    <p>DGPS is often used for large-area coordinate positioning, while Total Station is preferred for precise site measurements, layout marking, and detailed construction survey work.</p>
                </details>
            </div>
        </div>
    </section>
</div>

@endsection
