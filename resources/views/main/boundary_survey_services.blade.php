@extends('layouts.app')

@section('title', 'Boundary Survey Services')

@section('content')

<style>
    .boundary-page {
        font-family: "Poppins", "Segoe UI", sans-serif;
        background: #efefef;
        color: #222;
    }

    .boundary-hero {
        min-height: 330px;
        display: flex;
        align-items: center;
        padding: 58px 7%;
        background:
            /* linear-gradient(90deg, rgba(0,0,0,.86) 0%, rgba(0,0,0,.58) 48%, rgba(0,0,0,.08) 100%), */
            url("{{ asset('images/logo/bs1.png') }}") center/cover no-repeat;
    }

    .boundary-hero h1 {
        max-width: 760px;
        margin: 0;
        color: #fff;
        font-size: clamp(34px, 5vw, 62px);
        line-height: 1.1;
        font-weight: 900;
        text-shadow: 0 5px 16px rgba(0,0,0,.5);
    }

    .boundary-section {
        padding: 42px 7%;
    }

    .boundary-wrap {
        max-width: 1180px;
        margin: 0 auto;
    }

    .boundary-title {
        text-align: center;
        font-size: clamp(24px, 3vw, 36px);
        font-weight: 900;
        line-height: 1.2;
        margin: 0;
    }

    .boundary-line {
        width: min(260px, 72vw);
        height: 4px;
        margin: 12px auto 28px;
        border-radius: 99px;
        background: linear-gradient(90deg, #f37021 0 50%, #1e73be 50% 100%);
    }

    .boundary-copy {
        font-size: 17px;
        line-height: 1.7;
        color: #444;
        margin: 0 0 18px;
    }

    .boundary-steps {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 14px;
        margin-top: 24px;
    }

    .boundary-step {
        background: #fff;
        border: 2px solid #1e73be;
        border-radius: 8px;
        padding: 16px 12px;
        text-align: center;
        font-size: 14px;
        font-weight: 800;
        min-height: 78px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .boundary-grid {
        display: grid;
        gap: 22px;
    }

    .boundary-grid.three {
        grid-template-columns: repeat(3, 1fr);
    }

    .boundary-grid.four {
        grid-template-columns: repeat(4, 1fr);
    }

    .boundary-card {
        background: #fff;
        border: 2px solid #f37021;
        border-radius: 10px;
        padding: 22px;
        box-shadow: 0 6px 16px rgba(0,0,0,.08);
    }

    .boundary-card.blue {
        border-color: #1e73be;
        background: #f3f9ff;
    }

    .boundary-card h3 {
        margin: 0 0 12px;
        color: #f37021;
        font-size: 18px;
        font-weight: 900;
    }

    .boundary-card.blue h3 {
        color: #1e73be;
    }

    .boundary-card ul {
        margin: 0;
        padding-left: 18px;
    }

    .boundary-card li {
        color: #444;
        font-size: 14px;
        line-height: 1.55;
        margin-bottom: 7px;
    }

    .boundary-project {
        overflow: hidden;
        padding: 0;
    }

    .boundary-project img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        display: block;
    }

    .boundary-project h3 {
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

    .boundary-checks {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 16px;
        text-align: center;
    }

    .boundary-check {
        font-size: 14px;
        line-height: 1.45;
        font-weight: 800;
    }

    .boundary-check span {
        display: block;
        color: #1e73be;
        font-size: 20px;
        margin-bottom: 6px;
    }

    .boundary-process {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 14px;
    }

    .boundary-process div {
        font-size: 14px;
        font-weight: 800;
        text-align: center;
        background: #fff;
        border-radius: 8px;
        padding: 16px 10px;
        border-top: 4px solid #f37021;
    }

    .boundary-locations {
        max-width: 760px;
        margin: 0 auto;
        color: #333;
        font-size: 16px;
        line-height: 1.75;
    }

    .boundary-faq {
        display: flex;
        flex-direction: column;
        gap: 13px;
    }

    .boundary-faq details {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,.12);
        overflow: hidden;
    }

    .boundary-faq summary {
        cursor: pointer;
        padding: 18px 22px;
        font-weight: 900;
        font-size: 15px;
    }

    .boundary-faq p {
        margin: 0;
        padding: 0 22px 18px;
        color: #555;
        line-height: 1.6;
        font-size: 14px;
    }

    @media (max-width: 991px) {
        .boundary-steps,
        .boundary-grid.three,
        .boundary-grid.four,
        .boundary-checks,
        .boundary-process {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .boundary-hero {
            min-height: 280px;
            padding: 48px 22px;
        }

        .boundary-section {
            padding: 34px 18px;
        }

        .boundary-steps,
        .boundary-grid.three,
        .boundary-grid.four,
        .boundary-checks,
        .boundary-process {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="boundary-page">
    <section class="boundary-hero">
        <!-- <h1>Boundary Survey<br>Services</h1> -->
    </section>

    <section class="boundary-section">
        <div class="boundary-wrap">
            <h2 class="boundary-title">Boundary Survey Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane</h2>
            <div class="boundary-line"></div>
            <p class="boundary-copy">
                Before starting construction, plotting, or land development, it is essential to clearly identify the exact boundaries of your property. At ConstructKaro, we provide professional Boundary Survey Services through verified surveyors using modern surveying equipment and accurate measurement methods.
            </p>
            <p class="boundary-copy">
                Whether it is residential land, industrial property, agricultural land, or plotting development, we help ensure your land boundaries are properly measured, marked, and documented.
            </p>
        </div>
    </section>

    <section class="boundary-section">
        <div class="boundary-wrap">
            <h2 class="boundary-title">What is a Boundary Survey?</h2>
            <div class="boundary-line"></div>
            <p class="boundary-copy">
                A boundary survey is a land surveying process used to determine the exact legal boundaries and dimensions of a property.
            </p>
            <div class="boundary-steps">
                <div class="boundary-step">Identifying property limits</div>
                <div class="boundary-step">Avoiding land disputes</div>
                <div class="boundary-step">Planning construction accurately</div>
                <div class="boundary-step">Supporting fencing and compound work</div>
                <div class="boundary-step">Land documentation and development</div>
            </div>
        </div>
    </section>

    <section class="boundary-section">
        <div class="boundary-wrap">
            <h2 class="boundary-title">Our Boundary Survey Services Include</h2>
            <div class="boundary-line"></div>
            <div class="boundary-grid three">
                <div class="boundary-card">
                    <h3>Land Boundary Measurement</h3>
                    <ul>
                        <li>Plot boundary identification</li>
                        <li>Land dimensions verification</li>
                        <li>Property corner marking</li>
                    </ul>
                </div>
                <div class="boundary-card blue">
                    <h3>Boundary Demarcation</h3>
                    <ul>
                        <li>Physical marking on site</li>
                        <li>Setting boundary points</li>
                        <li>Clear site reference for development</li>
                    </ul>
                </div>
                <div class="boundary-card">
                    <h3>DGPS & Total Station Survey</h3>
                    <ul>
                        <li>High-accuracy digital land survey</li>
                        <li>Total Station measurement</li>
                        <li>Reliable coordinates and marking</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="boundary-section">
        <div class="boundary-wrap">
            <h2 class="boundary-title">Types of Boundary Survey Projects</h2>
            <div class="boundary-line"></div>
            <div class="boundary-grid four">
                <!-- <div class="boundary-card boundary-project"> -->
                    <img src="{{ asset('images/logo/bs2.png') }}" alt="Residential plot boundary survey">
                    <!-- <h3>Residential Plot Boundary Survey</h3> -->
                <!-- </div> -->
                <!-- <div class="boundary-card boundary-project blue"> -->
                    <img src="{{ asset('images/logo/bs3.png') }}" alt="Farmhouse and agricultural land survey">
                    <!-- <h3>Farmhouse & Agricultural Land Survey</h3>
                </div> -->
                <!-- <div class="boundary-card boundary-project"> -->
                    <img src="{{ asset('images/logo/bs4.png') }}" alt="Industrial and commercial land survey">
                    <!-- <h3>Industrial & Commercial Land Survey</h3>
                </div> -->
                <!-- <div class="boundary-card boundary-project blue"> -->
                    <img src="{{ asset('images/logo/bs5.png') }}" alt="Plotting and township boundary survey">
                    <!-- <h3>Plotting & Township Boundary Survey</h3>
                </div> -->
            </div>
        </div>
    </section>

    <section class="boundary-section">
        <div class="boundary-wrap">
            <h2 class="boundary-title">Why Boundary Survey is Important?</h2>
            <div class="boundary-line"></div>
            <div class="boundary-checks">
                <div class="boundary-check"><span>&#10003;</span>Prevents land disputes</div>
                <div class="boundary-check"><span>&#10003;</span>Ensures accurate construction planning</div>
                <div class="boundary-check"><span>&#10003;</span>Supports legal land identification</div>
                <div class="boundary-check"><span>&#10003;</span>Helps in fencing and compound work</div>
                <div class="boundary-check"><span>&#10003;</span>Improves plotting and development accuracy</div>
            </div>
        </div>
    </section>

    <section class="boundary-section">
        <div class="boundary-wrap">
            <h2 class="boundary-title">Why Choose ConstructKaro?</h2>
            <div class="boundary-line"></div>
            <div class="boundary-checks">
                <div class="boundary-check"><span>&#10003;</span>Verified land survey professionals</div>
                <div class="boundary-check"><span>&#10003;</span>DGPS and total station survey support</div>
                <div class="boundary-check"><span>&#10003;</span>Accurate measurement and demarcation</div>
                <div class="boundary-check"><span>&#10003;</span>Suitable for residential and industrial projects</div>
                <div class="boundary-check"><span>&#10003;</span>Structured survey reporting support</div>
            </div>
        </div>
    </section>

    <section class="boundary-section">
        <div class="boundary-wrap">
            <h2 class="boundary-title">Our Survey Process</h2>
            <div class="boundary-line"></div>
            <div class="boundary-process">
                <div>1. Requirement Discussion</div>
                <div>2. Site Inspection & Document Review</div>
                <div>3. Boundary Measurement & Survey</div>
                <div>4. Demarcation & Marking</div>
                <div>5. Survey Report & Drawing Submission</div>
            </div>
        </div>
    </section>

    <section class="boundary-section">
        <div class="boundary-wrap">
            <h2 class="boundary-title">Target Locations We Serve</h2>
            <div class="boundary-line"></div>
            <ul class="boundary-locations">
                <li>Boundary Survey in Navi Mumbai</li>
                <li>Land Survey Services in Mumbai</li>
                <li>Boundary Demarcation Survey in Pune</li>
                <li>DGPS Survey Services in Raigad</li>
                <li>Total Station Survey in Thane</li>
            </ul>
        </div>
    </section>

    <section class="boundary-section">
        <div class="boundary-wrap">
            <h2 class="boundary-title">Frequently Asked Questions (FAQs)</h2>
            <div class="boundary-line"></div>
            <div class="boundary-faq">
                <details>
                    <summary>1. What is the purpose of a boundary survey?</summary>
                    <p>It identifies the exact boundaries, dimensions, and reference points of a property before construction, fencing, sale, purchase, or development.</p>
                </details>
                <details>
                    <summary>2. Do you provide DGPS and total station survey?</summary>
                    <p>Yes. ConstructKaro connects you with surveyors who can use DGPS, total station, and other modern instruments based on your project requirement.</p>
                </details>
                <details>
                    <summary>3. Can boundary surveys help avoid land disputes?</summary>
                    <p>Yes. Proper boundary measurement and demarcation can reduce confusion and support clearer land identification.</p>
                </details>
                <details>
                    <summary>4. Do you provide physical boundary marking?</summary>
                    <p>Yes. Boundary marking or demarcation can be included depending on site conditions and project scope.</p>
                </details>
            </div>
        </div>
    </section>
</div>

@endsection
