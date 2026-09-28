@extends('layouts.app')

@section('meta_title', 'Construction Feasibility Report | Project Site Assessment')
@section('meta_description', 'Plan your project with a construction feasibility report covering site conditions, technical needs, indicative costs, risks and next steps.')
@section('title', 'Construction Feasibility Report | ConstructKaro')

@section('content')
<style>
    .feasibility-page {
        --fr-blue: #1f67ab;
        --fr-blue-dark: #133a5b;
        --fr-orange: #df6d1c;
        --fr-ink: #1c2c3e;
        --fr-muted: #5b6875;
        --fr-line: #d9e2ec;
        color: var(--fr-ink);
        background: #f5f7f9;
        font-family: 'Poppins', 'Segoe UI', sans-serif;
    }

    .fr-hero {
        min-height: 390px;
        display: flex;
        align-items: center;
        padding: 64px max(7vw, 24px);
        color: #fff;
        background: linear-gradient(90deg, rgba(10, 27, 43, .88), rgba(10, 27, 43, .28)), url("{{ asset('images/banner.webp') }}") center 54% / cover no-repeat;
    }

    .fr-hero-copy {
        width: min(100%, 1160px);
        margin: 0 auto;
    }

    .fr-eyebrow {
        display: inline-block;
        margin-bottom: 14px;
        color: #ffd2ad;
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .fr-hero h1 {
        max-width: 820px;
        margin: 0 0 14px;
        font-family: 'Montserrat', 'Poppins', sans-serif;
        font-size: clamp(36px, 5vw, 62px);
        font-weight: 900;
        line-height: 1.08;
    }

    .fr-hero p {
        max-width: 700px;
        margin: 0;
        color: #f2f5f7;
        font-size: clamp(18px, 2vw, 23px);
        font-weight: 600;
        line-height: 1.5;
    }

    .fr-section {
        padding: 58px 24px;
    }

    .fr-section:nth-of-type(even) {
        background: #fff;
    }

    .fr-wrap {
        width: min(100%, 1120px);
        margin: 0 auto;
    }

    .fr-section h2 {
        margin: 0 0 16px;
        color: var(--fr-ink);
        font-family: 'Montserrat', 'Poppins', sans-serif;
        font-size: clamp(25px, 3vw, 34px);
        font-weight: 900;
        line-height: 1.2;
    }

    .fr-section h3 {
        margin: 0 0 9px;
        color: var(--fr-blue-dark);
        font-size: 18px;
        font-weight: 800;
        line-height: 1.35;
    }

    .fr-section p,
    .fr-section li {
        color: var(--fr-muted);
        font-size: 16px;
        line-height: 1.75;
    }

    .fr-section p {
        margin: 0 0 16px;
    }

    .fr-intro {
        display: grid;
        grid-template-columns: minmax(0, 1.5fr) minmax(240px, .8fr);
        align-items: center;
        gap: 42px;
    }

    .fr-intro-aside {
        padding: 25px;
        border-left: 5px solid var(--fr-orange);
        background: #fff;
        box-shadow: 0 8px 24px rgba(16, 35, 57, .08);
    }

    .fr-intro-aside p {
        margin: 0;
        color: var(--fr-ink);
        font-size: 18px;
        font-weight: 800;
        line-height: 1.55;
    }

    .fr-button {
        display: inline-flex;
        min-height: 48px;
        align-items: center;
        justify-content: center;
        border: 0;
        border-radius: 6px;
        padding: 12px 20px;
        background: var(--fr-blue);
        color: #fff;
        font: inherit;
        font-size: 15px;
        font-weight: 800;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        transition: background .2s ease, transform .2s ease;
    }

    .fr-button:hover {
        transform: translateY(-2px);
        background: #174f83;
        color: #fff;
    }

    .fr-button.orange {
        background: var(--fr-orange);
    }

    .fr-button.orange:hover {
        background: #bd5815;
    }

    .fr-button-note {
        display: block;
        margin-top: 8px;
        color: var(--fr-muted);
        font-size: 13px;
    }

    .fr-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
        margin-top: 26px;
    }

    .fr-point {
        min-height: 124px;
        padding: 20px;
        border-top: 3px solid var(--fr-blue);
        background: #fff;
        box-shadow: 0 5px 16px rgba(16, 35, 57, .06);
    }

    .fr-point:nth-child(even) {
        border-color: var(--fr-orange);
    }

    .fr-point h3 {
        font-size: 16px;
    }

    .fr-point p {
        margin: 0;
        font-size: 14px;
        line-height: 1.6;
    }

    .fr-callout {
        margin-top: 24px !important;
        padding: 16px 20px;
        border-left: 4px solid var(--fr-orange);
        background: #fff3e9;
        color: var(--fr-ink) !important;
    }

    .fr-benefits {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0 36px;
        margin-top: 24px;
    }

    .fr-benefit {
        padding: 19px 0;
        border-top: 1px solid var(--fr-line);
    }

    .fr-benefit p {
        margin: 0;
    }

    .fr-list {
        margin: 16px 0 0;
        padding-left: 22px;
    }

    .fr-list li {
        margin: 0 0 9px;
        padding-left: 4px;
    }

    .fr-table-scroll {
        overflow-x: auto;
        margin-top: 22px;
        border: 1px solid var(--fr-line);
        background: #fff;
    }

    .fr-table {
        width: 100%;
        min-width: 640px;
        border-collapse: collapse;
        text-align: left;
    }

    .fr-table th,
    .fr-table td {
        padding: 15px 18px;
        border-bottom: 1px solid var(--fr-line);
        vertical-align: top;
        color: var(--fr-muted);
        font-size: 14px;
        line-height: 1.6;
    }

    .fr-table th {
        background: var(--fr-blue-dark);
        color: #fff;
        font-size: 14px;
        font-weight: 800;
    }

    .fr-table td:first-child {
        width: 34%;
        color: var(--fr-ink);
        font-weight: 800;
    }

    .fr-industry-list {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 10px;
        margin: 22px 0 0;
        padding: 0;
        list-style: none;
    }

    .fr-industry-list li {
        padding: 13px 15px;
        border-left: 3px solid var(--fr-orange);
        background: #fff;
        color: var(--fr-ink);
        font-size: 14px;
        font-weight: 800;
        line-height: 1.4;
    }

    .fr-faq-list {
        display: grid;
        gap: 10px;
        margin-top: 24px;
    }

    .fr-faq-list details {
        border: 1px solid var(--fr-line);
        background: #fff;
    }

    .fr-faq-list summary {
        position: relative;
        padding: 17px 48px 17px 18px;
        color: var(--fr-ink);
        font-size: 16px;
        font-weight: 800;
        cursor: pointer;
        list-style: none;
    }

    .fr-faq-list summary::-webkit-details-marker {
        display: none;
    }

    .fr-faq-list summary::after {
        content: "+";
        position: absolute;
        top: 50%;
        right: 18px;
        color: var(--fr-orange);
        font-size: 22px;
        transform: translateY(-50%);
    }

    .fr-faq-list details[open] summary::after {
        content: "−";
    }

    .fr-faq-list details p {
        margin: 0;
        padding: 0 18px 18px;
    }

    .fr-final-cta {
        background: var(--fr-blue-dark) !important;
        color: #fff;
    }

    .fr-final-cta h2,
    .fr-final-cta p {
        color: #fff;
    }

    .fr-final-cta .fr-wrap {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 28px;
    }

    .fr-final-cta p {
        max-width: 700px;
        margin: 0;
        color: #dce7ef;
    }

    .fr-print-sample {
        display: none;
    }

    @media (max-width: 760px) {
        .fr-hero {
            min-height: 330px;
            padding: 48px 22px;
        }

        .fr-section {
            padding: 42px 20px;
        }

        .fr-intro {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .fr-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .fr-industry-list {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .fr-final-cta .fr-wrap {
            align-items: flex-start;
            flex-direction: column;
        }
    }

    @media (max-width: 480px) {
        .fr-grid,
        .fr-benefits,
        .fr-industry-list {
            grid-template-columns: 1fr;
        }

        .fr-point {
            min-height: 0;
        }
    }

    @media print {
        body * {
            visibility: hidden !important;
        }

        .fr-print-sample,
        .fr-print-sample * {
            visibility: visible !important;
        }

        .fr-print-sample {
            position: absolute;
            inset: 0 auto auto 0;
            display: block;
            width: 100%;
            padding: 24px;
            color: #172b3e;
            background: #fff;
            font-family: Arial, sans-serif;
        }

        .fr-print-sample h1 {
            margin: 0 0 8px;
            font-size: 25px;
        }

        .fr-print-sample h2 {
            margin: 22px 0 7px;
            padding-bottom: 5px;
            border-bottom: 2px solid #1f67ab;
            font-size: 16px;
        }

        .fr-print-sample p,
        .fr-print-sample li {
            font-size: 11px;
            line-height: 1.5;
        }

        .fr-print-sample ol {
            columns: 2;
        }
    }
</style>

<main class="feasibility-page">
    <header class="fr-hero">
        <div class="fr-hero-copy">
            <span class="fr-eyebrow">Project planning and site assessment</span>
            <h1>Construction Feasibility Report</h1>
            <p>Understand Your Project Before Construction Begins</p>
        </div>
    </header>

    <section class="fr-section">
        <div class="fr-wrap fr-intro">
            <div>
                <h2>Construction Feasibility Report Services</h2>
                <p>A construction project starts with a question: <strong>Can this project be built on the proposed site, within the available budget and timeline?</strong> A construction feasibility report brings together the information needed to answer it.</p>
                <p>Whether you are planning a bungalow, commercial building, warehouse or industrial facility, a feasibility study helps you examine the site, define the proposed work, identify constraints and compare practical options before committing to detailed design or construction.</p>
                <a class="fr-button" href="{{ route('guide.requirement') }}">Request a feasibility assessment</a>
            </div>
            <aside class="fr-intro-aside">
                <p>Planning a project? Request a construction feasibility assessment for your site.</p>
            </aside>
        </div>
    </section>

    <section class="fr-section">
        <div class="fr-wrap">
            <h2>What Is a Construction Feasibility Report?</h2>
            <p>A <strong>construction feasibility report</strong> is an assessment of whether a proposed project is practical to develop. It reviews the site and project requirements alongside technical, planning, cost and delivery considerations.</p>
            <p>The report may examine access, land levels, ground conditions, drainage, utilities, the proposed building layout, indicative construction costs, approvals to investigate and an initial project timeline. Its findings help the owner decide whether to proceed, revise the proposal or gather more information.</p>
            <p>The depth of the report depends on the project. An early assessment for a bungalow will differ from a detailed study for a warehouse or a large development. Where required, specialist inputs such as a land survey, geotechnical investigation, architectural concept or legal review should be commissioned separately or included in the agreed scope.</p>
        </div>
    </section>

    <section class="fr-section">
        <div class="fr-wrap">
            <h2>Key Points Covered in a Construction Feasibility Report</h2>
            <p>A report can be tailored to the site and project, but commonly covers:</p>
            <div class="fr-grid">
                <article class="fr-point"><h3>Project brief</h3><p>Intended use, proposed size, space requirements and the owner's priorities.</p></article>
                <article class="fr-point"><h3>Site conditions</h3><p>Plot shape, boundaries, levels, existing structures, vegetation and visible physical constraints.</p></article>
                <article class="fr-point"><h3>Access and connectivity</h3><p>Approach roads, entry and exit options, construction vehicle access and material movement.</p></article>
                <article class="fr-point"><h3>Ground and structural considerations</h3><p>Available soil information, likely foundation considerations and the need for further testing.</p></article>
                <article class="fr-point"><h3>Planning and approval review</h3><p>Applicable land use and development requirements to confirm with authorities and professionals.</p></article>
                <article class="fr-point"><h3>Utilities and drainage</h3><p>Water, electricity, wastewater disposal and stormwater management requirements.</p></article>
                <article class="fr-point"><h3>Concept options</h3><p>Preliminary ways to position or configure the proposed development.</p></article>
                <article class="fr-point"><h3>Indicative cost</h3><p>An early budget range based on available information, with assumptions stated.</p></article>
                <article class="fr-point"><h3>Timeline and execution</h3><p>Likely project stages, dependencies and factors that may affect the schedule.</p></article>
                <article class="fr-point"><h3>Risks and next steps</h3><p>Matters to resolve before design, procurement or construction begins.</p></article>
            </div>
            <p class="fr-callout">An indicative estimate is a planning tool. Final construction costs should be developed from approved drawings, specifications, site investigations and a detailed BOQ.</p>
        </div>
    </section>

    <section class="fr-section">
        <div class="fr-wrap">
            <h2>Why Conduct a Construction Feasibility Report?</h2>
            <div class="fr-benefits">
                <article class="fr-benefit"><h3>Make an Informed Investment Decision</h3><p>A site may appear suitable at first glance but require additional work to address levels, access, ground conditions or utilities. A feasibility report brings these considerations into the decision before major project spending begins.</p></article>
                <article class="fr-benefit"><h3>Compare Development Options</h3><p>An early study helps compare possible layouts, building sizes or construction approaches against your requirements and the site's constraints.</p></article>
                <article class="fr-benefit"><h3>Plan a More Realistic Budget</h3><p>The report identifies likely cost drivers, such as extensive earthwork, retaining structures, drainage work or utility connections, giving you a stronger starting point for budget discussions.</p></article>
                <article class="fr-benefit"><h3>Identify Work That Must Happen First</h3><p>Some decisions depend on a survey, soil test, title review, authority clarification or specialist design. Identifying these requirements early helps the project team sequence the work.</p></article>
                <article class="fr-benefit"><h3>Improve Coordination</h3><p>A clear project brief and documented assumptions help owners, architects, engineers, consultants and contractors work from the same information as the design develops.</p></article>
            </div>
        </div>
    </section>

    <section class="fr-section">
        <div class="fr-wrap">
            <h2>When Should a Construction Feasibility Report Be Prepared?</h2>
            <p>The best time is <strong>before finalising the design or committing to construction</strong>. It can also be valuable:</p>
            <ul class="fr-list">
                <li>Before purchasing land for a specific development.</li>
                <li>After shortlisting a site but before investing in detailed plans.</li>
                <li>When comparing two or more development options.</li>
                <li>Before setting a project budget or seeking funding.</li>
                <li>When an existing design needs to be reviewed against site conditions.</li>
                <li>Before expanding, redeveloping or changing the use of an existing property.</li>
            </ul>
            <p>For complex projects, feasibility is often refined in stages. An initial review may identify whether the proposal is worth exploring; a more detailed study can then incorporate survey data, testing, concept designs and specialist assessments.</p>
        </div>
    </section>

    <section class="fr-section">
        <div class="fr-wrap">
            <h2>Types of Construction Feasibility Reports</h2>
            <div class="fr-table-scroll">
                <table class="fr-table">
                    <thead><tr><th>Report type</th><th>Main focus</th></tr></thead>
                    <tbody>
                        <tr><td>Site feasibility report</td><td>Whether the plot's access, shape, levels and physical conditions support the proposed development.</td></tr>
                        <tr><td>Technical feasibility report</td><td>Practical construction considerations, including preliminary structural, foundation, drainage and utility requirements.</td></tr>
                        <tr><td>Financial feasibility report</td><td>Indicative project costs, funding needs and, where relevant, expected returns or operating costs.</td></tr>
                        <tr><td>Planning and regulatory feasibility report</td><td>Land use, applicable development rules and approvals requiring professional or authority confirmation.</td></tr>
                        <tr><td>Environmental feasibility report</td><td>Potential environmental constraints and the need for further assessment or mitigation.</td></tr>
                        <tr><td>Redevelopment feasibility report</td><td>Options and constraints for replacing, extending or adapting an existing structure.</td></tr>
                        <tr><td>Industrial or commercial feasibility report</td><td>Site layout, vehicle movement, loading, utilities and operational needs for the proposed facility.</td></tr>
                    </tbody>
                </table>
            </div>
            <p style="margin-top: 18px">A project may need several of these assessments combined into one report. The appropriate scope depends on the site, intended use and stage of planning.</p>
        </div>
    </section>

    <section class="fr-section">
        <div class="fr-wrap">
            <h2>Construction Feasibility Report Sample PDF</h2>
            <p>Want to see how the findings are presented? A sample report can help you understand the typical structure before requesting one for your project.</p>
            <h3>A sample report may contain:</h3>
            <ol class="fr-list">
                <li>Project and site overview</li>
                <li>Owner's requirements and proposed development</li>
                <li>Information reviewed and site observations</li>
                <li>Site access, levels and utility assessment</li>
                <li>Preliminary planning and technical considerations</li>
                <li>Concept options</li>
                <li>Indicative cost and timeline</li>
                <li>Key risks, assumptions and information gaps</li>
                <li>Findings and recommended next steps</li>
            </ol>
            <button class="fr-button orange" type="button" onclick="window.print()">Download Sample Construction Feasibility Report PDF</button>
            <span class="fr-button-note">In the print dialog, choose “Save as PDF”.</span>
        </div>
    </section>

    <section class="fr-section">
        <div class="fr-wrap">
            <h2>Industries We Serve</h2>
            <p>Construction feasibility assessments can support projects across a wide range of sectors. Each industry has different space, access, service and operational needs, so the assessment should reflect the intended use rather than rely on a standard layout or cost assumption.</p>
            <ul class="fr-industry-list">
                <li>Residential</li>
                <li>Commercial</li>
                <li>Industrial</li>
                <li>Warehousing and logistics</li>
                <li>Hospitality</li>
                <li>Healthcare and education</li>
                <li>Infrastructure and site development</li>
            </ul>
        </div>
    </section>

    <section class="fr-section">
        <div class="fr-wrap">
            <h2>Frequently Asked Questions</h2>
            <div class="fr-faq-list">
                <details><summary>1. What is a construction feasibility report?</summary><p>A construction feasibility report assesses whether a proposed project is practical on a particular site. It considers factors such as site conditions, access, technical requirements, indicative costs, approvals to investigate and potential risks.</p></details>
                <details><summary>2. Why do I need a construction feasibility report?</summary><p>It helps identify major constraints before spending heavily on detailed design or construction. The findings can help you decide whether to proceed, adjust your plans or gather more information.</p></details>
                <details><summary>3. When should I get a construction feasibility report?</summary><p>Ideally, before finalising the building design or construction budget. You may also request one before buying land if you have a specific project in mind.</p></details>
                <details><summary>4. What information is needed to prepare the report?</summary><p>Useful starting information includes the site location, plot area, available land documents, survey drawings, photographs and a description of what you want to build. Exact requirements depend on the project.</p></details>
                <details><summary>5. Does a feasibility report include construction costs?</summary><p>It may include an indicative cost estimate based on available information. A detailed construction price requires developed drawings, specifications, site investigation results and a BOQ.</p></details>
                <details><summary>6. Will the report confirm that my project will receive approval?</summary><p>No. A feasibility report can identify planning and approval matters that need review, but it does not replace an official approval or a determination by the relevant authority.</p></details>
            </div>
        </div>
    </section>

    <section class="fr-section fr-final-cta">
        <div class="fr-wrap">
            <div>
                <h2>Understand the site before you commit.</h2>
                <p>Share your project requirements and request a construction feasibility assessment tailored to your site and plans.</p>
            </div>
            <a class="fr-button orange" href="{{ route('guide.requirement') }}">Request an assessment</a>
        </div>
    </section>
</main>

<section class="fr-print-sample" aria-hidden="true">
    <p>CONSTRUCTKARO | ILLUSTRATIVE REPORT OUTLINE</p>
    <h1>Construction Feasibility Report</h1>
    <p><strong>Sample structure for discussion</strong> | This outline is illustrative only. Findings, costs, approvals and timelines must be prepared for the specific project using verified information.</p>
    <h2>Typical report contents</h2>
    <ol>
        <li>Project and site overview</li>
        <li>Owner's requirements and proposed development</li>
        <li>Information reviewed and site observations</li>
        <li>Site access, levels and utility assessment</li>
        <li>Preliminary planning and technical considerations</li>
        <li>Concept options</li>
        <li>Indicative cost and timeline, with assumptions</li>
        <li>Key risks, assumptions and information gaps</li>
        <li>Findings and recommended next steps</li>
    </ol>
    <h2>Assessment areas</h2>
    <p>Project brief | Site conditions | Access and connectivity | Ground and structural considerations | Planning matters to confirm | Utilities and drainage | Concept options | Indicative cost | Timeline and execution | Risks and next steps</p>
    <h2>Important note</h2>
    <p>This sample is not a site-specific assessment, cost estimate, design, approval or guarantee of project feasibility. Specialist investigations and authority confirmations may be required for an actual project.</p>
    <p>ConstructKaro | constructkaro.com</p>
</section>
@endsection
