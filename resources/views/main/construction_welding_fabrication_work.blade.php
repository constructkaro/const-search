@extends('layouts.app')

@section('meta_title', 'Construction Welding & Fabrication Work Navi Mumbai & Raigad')
@section('meta_description', 'Construction welding and fabrication work for homes, offices, factories and infrastructure across Raigad, Navi Mumbai, Pune, Thane and Mumbai. Get a quote.')
@section('title', 'Construction Welding & Fabrication Services | ConstructKaro')

@push('head')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Service",
    "name": "Construction Welding and Fabrication Services",
    "serviceType": "Construction welding and metal fabrication",
    "areaServed": ["Raigad", "Navi Mumbai", "Pune", "Thane", "Mumbai"],
    "provider": {
        "@type": "Organization",
        "name": "ConstructKaro",
        "url": "https://constructkaro.com/"
    }
}
</script>
@endpush

@section('content')
<style>
    .welding-page {
        --wf-blue: #1f67ab;
        --wf-blue-dark: #133a5b;
        --wf-orange: #df6d1c;
        --wf-ink: #1c2c3e;
        --wf-muted: #5b6875;
        --wf-line: #d9e2ec;
        color: var(--wf-ink);
        background: #f5f7f9;
        font-family: 'Poppins', 'Segoe UI', sans-serif;
    }

    .wf-hero {
        min-height: 390px;
        display: flex;
        align-items: center;
        padding: 64px max(7vw, 24px);
        color: #fff;
        background: linear-gradient(90deg, rgba(10, 27, 43, .9), rgba(10, 27, 43, .34)), url("{{ asset('images/banner.webp') }}") center 54% / cover no-repeat;
    }

    .wf-hero-copy {
        width: min(100%, 1160px);
        margin: 0 auto;
    }

    .wf-eyebrow {
        display: inline-block;
        margin-bottom: 14px;
        color: #ffd2ad;
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .wf-hero h1 {
        max-width: 1050px;
        margin: 0 0 14px;
        font-family: 'Montserrat', 'Poppins', sans-serif;
        font-size: clamp(34px, 4.7vw, 58px);
        font-weight: 900;
        line-height: 1.1;
    }

    .wf-hero p {
        margin: 0;
        color: #f2f5f7;
        font-size: clamp(18px, 2vw, 23px);
        font-weight: 600;
        line-height: 1.5;
    }

    .wf-section {
        padding: 58px 24px;
    }

    .wf-section:nth-of-type(even) {
        background: #fff;
    }

    .wf-wrap {
        width: min(100%, 1120px);
        margin: 0 auto;
    }

    .wf-section h2 {
        margin: 0 0 16px;
        color: var(--wf-ink);
        font-family: 'Montserrat', 'Poppins', sans-serif;
        font-size: clamp(25px, 3vw, 34px);
        font-weight: 900;
        line-height: 1.2;
    }

    .wf-section h3 {
        margin: 0 0 9px;
        color: var(--wf-blue-dark);
        font-size: 18px;
        font-weight: 800;
        line-height: 1.35;
    }

    .wf-section p,
    .wf-section li {
        color: var(--wf-muted);
        font-size: 16px;
        line-height: 1.75;
    }

    .wf-section p {
        margin: 0 0 16px;
    }

    .wf-intro {
        display: grid;
        grid-template-columns: minmax(0, 1.5fr) minmax(240px, .8fr);
        align-items: center;
        gap: 42px;
    }

    .wf-intro-aside {
        padding: 25px;
        border-left: 5px solid var(--wf-orange);
        background: #fff;
        box-shadow: 0 8px 24px rgba(16, 35, 57, .08);
    }

    .wf-intro-aside p {
        margin: 0;
        color: var(--wf-ink);
        font-size: 18px;
        font-weight: 800;
        line-height: 1.55;
    }

    .wf-button {
        display: inline-flex;
        min-height: 48px;
        align-items: center;
        justify-content: center;
        border: 0;
        border-radius: 6px;
        padding: 12px 20px;
        background: var(--wf-blue);
        color: #fff;
        font: inherit;
        font-size: 15px;
        font-weight: 800;
        text-align: center;
        text-decoration: none;
        transition: background .2s ease, transform .2s ease;
    }

    .wf-button:hover {
        transform: translateY(-2px);
        background: #174f83;
        color: #fff;
    }

    .wf-button.orange {
        background: var(--wf-orange);
    }

    .wf-button.orange:hover {
        background: #bd5815;
    }

    .wf-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
        margin-top: 26px;
    }

    .wf-card {
        min-height: 132px;
        padding: 22px;
        border-top: 3px solid var(--wf-blue);
        background: #fff;
        box-shadow: 0 5px 16px rgba(16, 35, 57, .06);
    }

    .wf-card:nth-child(even) {
        border-color: var(--wf-orange);
    }

    .wf-card p {
        margin: 0;
        font-size: 14px;
        line-height: 1.6;
    }

    .wf-materials {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
        margin-top: 24px;
    }

    .wf-material {
        padding: 22px;
        border: 1px solid var(--wf-line);
        background: #fff;
    }

    .wf-material p {
        margin: 0;
    }

    .wf-location-card {
        min-height: 150px;
    }

    .wf-location-card p {
        color: var(--wf-muted);
        font-size: 14px;
    }

    .wf-location-card strong {
        color: var(--wf-ink);
    }

    .wf-note {
        margin-top: 20px !important;
        padding: 16px 20px;
        border-left: 4px solid var(--wf-orange);
        background: #fff3e9;
        color: var(--wf-ink) !important;
        font-weight: 700;
    }

    .wf-process {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 12px;
        margin-top: 24px;
        counter-reset: wf-step;
    }

    .wf-process article {
        min-height: 180px;
        padding: 20px;
        border-top: 4px solid var(--wf-orange);
        background: #fff;
        counter-increment: wf-step;
    }

    .wf-process article::before {
        content: "0" counter(wf-step);
        display: block;
        margin-bottom: 15px;
        color: var(--wf-blue);
        font-family: 'Montserrat', sans-serif;
        font-size: 25px;
        font-weight: 900;
    }

    .wf-process p {
        margin: 0;
        font-size: 14px;
        line-height: 1.6;
    }

    .wf-industry-list {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 10px;
        margin: 22px 0 0;
        padding: 0;
        list-style: none;
    }

    .wf-industry-list li {
        padding: 13px 15px;
        border-left: 3px solid var(--wf-orange);
        background: #fff;
        color: var(--wf-ink);
        font-size: 14px;
        font-weight: 800;
        line-height: 1.4;
    }

    .wf-faq-list {
        display: grid;
        gap: 10px;
        margin-top: 24px;
    }

    .wf-faq-list details {
        border: 1px solid var(--wf-line);
        background: #fff;
    }

    .wf-faq-list summary {
        position: relative;
        padding: 17px 48px 17px 18px;
        color: var(--wf-ink);
        font-size: 16px;
        font-weight: 800;
        cursor: pointer;
        list-style: none;
    }

    .wf-faq-list summary::-webkit-details-marker {
        display: none;
    }

    .wf-faq-list summary::after {
        content: "+";
        position: absolute;
        top: 50%;
        right: 18px;
        color: var(--wf-orange);
        font-size: 22px;
        transform: translateY(-50%);
    }

    .wf-faq-list details[open] summary::after {
        content: "−";
    }

    .wf-faq-list details p {
        margin: 0;
        padding: 0 18px 18px;
    }

    .wf-final-cta {
        background: var(--wf-blue-dark) !important;
        color: #fff;
    }

    .wf-final-cta .wf-wrap {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 28px;
    }

    .wf-final-cta h2,
    .wf-final-cta p {
        color: #fff;
    }

    .wf-final-cta p {
        max-width: 720px;
        margin: 0;
        color: #dce7ef;
    }

    @media (max-width: 900px) {
        .wf-process {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .wf-process article {
            min-height: 0;
        }
    }

    @media (max-width: 760px) {
        .wf-hero {
            min-height: 330px;
            padding: 48px 22px;
        }

        .wf-section {
            padding: 42px 20px;
        }

        .wf-intro {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .wf-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .wf-industry-list {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .wf-final-cta .wf-wrap {
            align-items: flex-start;
            flex-direction: column;
        }
    }

    @media (max-width: 480px) {
        .wf-grid,
        .wf-materials,
        .wf-process,
        .wf-industry-list {
            grid-template-columns: 1fr;
        }
    }
</style>

<main class="welding-page">
    <header class="wf-hero">
        <div class="wf-hero-copy">
            <span class="wf-eyebrow">Metalwork made for your project</span>
            <h1>Construction Welding &amp; Fabrication Services in Raigad, Navi Mumbai, Pune, Thane &amp; Mumbai</h1>
            <p>Metalwork Made for Your Project</p>
        </div>
    </header>

    <section class="wf-section">
        <div class="wf-wrap wf-intro">
            <div>
                <h2>Construction Welding &amp; Fabrication Work</h2>
                <p>From a home entrance gate to fabricated components for an industrial site, welding and fabrication work must suit the project's purpose, dimensions and installation conditions. Well-planned metalwork also needs the right material, connections and finish for its intended use.</p>
                <p>Our <strong>construction welding and fabrication work</strong> covers residential, commercial, industrial, infrastructure, interior and renovation projects. Share your drawings or requirements, and we can help define the fabrication and site work needed.</p>
                <a class="wf-button" href="{{ route('customer.welding_fabrication') }}">Enquire About Welding &amp; Fabrication</a>
            </div>
            <aside class="wf-intro-aside">
                <p>Have drawings or a project requirement? Share the details to discuss the fabrication scope.</p>
            </aside>
        </div>
    </section>

    <section class="wf-section">
        <div class="wf-wrap">
            <h2>What Is Construction Welding and Fabrication?</h2>
            <p><strong>Fabrication</strong> is the process of measuring, cutting, shaping and assembling metal components to create a finished item or structure. <strong>Welding</strong> joins metal parts using a suitable welding process. The completed components may then be finished and installed on site.</p>
            <p>Construction projects use these services for gates, grills, railings, staircases, partitions, equipment supports and other project-specific items. The design, material and connection details should be chosen according to the intended use. Structural or load-bearing work requires appropriate engineering design and review.</p>
        </div>
    </section>

    <section class="wf-section">
        <div class="wf-wrap">
            <h2>Our Welding &amp; Fabrication Services</h2>
            <div class="wf-grid">
                <article class="wf-card"><h3>Residential Welding &amp; Fabrication</h3><p>Gates, grills, railings, staircases and custom metalwork planned for homes and residential sites.</p></article>
                <article class="wf-card"><h3>Commercial Welding &amp; Fabrication</h3><p>Metal partitions, railings, supports and fabricated items for offices, shops and commercial spaces.</p></article>
                <article class="wf-card"><h3>Industrial Welding &amp; Fabrication</h3><p>Project-specific fabricated components and site welding for industrial facilities and production spaces.</p></article>
                <article class="wf-card"><h3>Infrastructure Welding &amp; Fabrication</h3><p>Metalwork and welding support planned around infrastructure drawings and site installation needs.</p></article>
                <article class="wf-card"><h3>Interior Metal Fabrication</h3><p>Custom metal details, partitions, fittings and features for interior design and fit-out projects.</p></article>
                <article class="wf-card"><h3>Renovation and Repair Welding</h3><p>Repair or modification of existing metalwork, subject to inspection and suitability for the intended use.</p></article>
            </div>
        </div>
    </section>

    <section class="wf-section">
        <div class="wf-wrap">
            <h2>Common Materials Used in Fabrication</h2>
            <p>The material depends on the item's function, design and exposure conditions.</p>
            <div class="wf-materials">
                <article class="wf-material"><h3>Mild Steel (MS)</h3><p>Mild steel is commonly selected for fabricated frames, gates and other metalwork that will receive a suitable protective finish.</p></article>
                <article class="wf-material"><h3>Stainless Steel (SS)</h3><p>Stainless steel is often considered for handrails, interior details and applications where its appearance or corrosion resistance is desired.</p></article>
            </div>
            <p class="wf-note">Material grade, section size, coating and finish should be confirmed in the project specifications. The choice should account for whether the item will be installed indoors, outdoors or in a demanding industrial environment.</p>
        </div>
    </section>

    <section class="wf-section">
        <div class="wf-wrap">
            <h2>Welding &amp; Fabrication Work Across Raigad, Navi Mumbai, Pune, Thane and Mumbai</h2>
            <p>We support residential, commercial, industrial, infrastructure, interior and renovation projects across these locations. Whether you need a gate for a bungalow, railings for an office, fabricated components for a warehouse or welding support at a construction site, the scope is planned around your drawings, site conditions and installation requirements.</p>
            <div class="wf-grid">
                <article class="wf-card wf-location-card"><h3>Raigad</h3><p><strong>Areas:</strong> Panvel, Pen, Khalapur, Khopoli, Alibag, Roha and surrounding towns and villages.</p></article>
                <article class="wf-card wf-location-card"><h3>Navi Mumbai</h3><p><strong>Areas:</strong> Kharghar, Taloja, Kalamboli, Ulwe, Nerul, Vashi and nearby areas.</p></article>
                <article class="wf-card wf-location-card"><h3>Pune</h3><p><strong>Areas:</strong> Pune city, Pimpri-Chinchwad, Hinjawadi, Chakan, Talegaon and surrounding areas.</p></article>
                <article class="wf-card wf-location-card"><h3>Thane</h3><p><strong>Areas:</strong> Thane city, Bhiwandi, Kalyan, Dombivli, Ambernath and nearby areas.</p></article>
                <article class="wf-card wf-location-card"><h3>Mumbai</h3><p>Residential, commercial and renovation project locations across the city and suburbs.</p></article>
            </div>
            <p class="wf-note">Have a project in one of these locations? Share your site location, drawings and fabrication requirement to discuss the scope of work.</p>
        </div>
    </section>

    <section class="wf-section">
        <div class="wf-wrap">
            <h2>How Welding &amp; Fabrication Work Is Planned</h2>
            <div class="wf-process">
                <article><h3>Understand the Requirement</h3><p>Identify what the item must do, where it will be installed and whether drawings or specifications are available.</p></article>
                <article><h3>Check Drawings and Site Dimensions</h3><p>Review dimensions, fixing points, installation access and existing construction before fabrication.</p></article>
                <article><h3>Finalise Material and Details</h3><p>Confirm the material, section sizes, connections and finish according to the design and intended use.</p></article>
                <article><h3>Fabricate the Components</h3><p>Measure, cut, prepare and assemble metal parts. Welding follows the approved details.</p></article>
                <article><h3>Finish and Install</h3><p>Apply the specified finish, install the item and check alignment and fixing against the agreed scope.</p></article>
            </div>
        </div>
    </section>

    <section class="wf-section">
        <div class="wf-wrap">
            <h2>Industries We Serve</h2>
            <ul class="wf-industry-list">
                <li>Residential Construction</li>
                <li>Commercial Spaces</li>
                <li>Manufacturing and Industrial Facilities</li>
                <li>Warehousing and Logistics</li>
                <li>Infrastructure and Utilities</li>
                <li>Interior Design and Fit-Outs</li>
                <li>Renovation and Property Upgrades</li>
            </ul>
        </div>
    </section>

    <section class="wf-section">
        <div class="wf-wrap">
            <h2>Frequently Asked Questions</h2>
            <div class="wf-faq-list">
                <details><summary>What is the difference between welding and fabrication?</summary><p>Fabrication covers making a metal item, including measuring, cutting, shaping and assembling its parts. Welding is one method used to join metal parts during that process.</p></details>
                <details><summary>What types of welding and fabrication work can I enquire about?</summary><p>You can enquire about gates, grills, staircases, railings, partitions, industrial components, site welding, repair work and other items shown in your project drawings.</p></details>
                <details><summary>Do I need drawings before requesting fabrication work?</summary><p>Drawings help define dimensions, materials and fixing details, especially for complex items. If you do not have drawings, share photographs, approximate measurements and a description of what you need so the next steps can be discussed.</p></details>
                <details><summary>Do you work with mild steel and stainless steel?</summary><p>Both mild steel (MS) and stainless steel (SS) can be considered, depending on the item, its intended use, exposure conditions and required finish. Confirm the material in the agreed specifications.</p></details>
                <details><summary>Can you fabricate a custom item for my site?</summary><p>Custom fabrication can be planned around the required dimensions, design and installation conditions. Share a drawing, reference image or description with your enquiry.</p></details>
                <details><summary>Can damaged gates, grills or railings be repaired?</summary><p>Some items can be repaired or modified, while others may need replacement. An inspection helps determine a suitable approach. Structural or load-bearing elements need an engineer's assessment.</p></details>
                <details><summary>Do you provide welding and fabrication for industrial projects?</summary><p>Industrial enquiries may include heavy fabrication, machine structures and site welding. Review technical drawings, material details and installation requirements before finalising the scope.</p></details>
                <details><summary>Which locations do you serve?</summary><p>Project enquiries can be made from Raigad, Navi Mumbai, Pune, Thane and Mumbai, including nearby towns and villages. Share your exact site location so availability and scope can be discussed.</p></details>
                <details><summary>What affects the cost of welding and fabrication work?</summary><p>Cost depends on the design, dimensions, material grade, quantity, finish, installation conditions and site location. A quotation requires a clearly defined scope and measurements.</p></details>
            </div>
        </div>
    </section>

    <section class="wf-section wf-final-cta">
        <div class="wf-wrap">
            <div>
                <h2>Have a metalwork requirement?</h2>
                <p>Share your site location, drawings or measurements and the item you need. We’ll help you discuss the welding and fabrication scope.</p>
            </div>
            <a class="wf-button orange" href="{{ route('customer.welding_fabrication') }}">Enquire About Welding &amp; Fabrication</a>
        </div>
    </section>
</main>
@endsection
