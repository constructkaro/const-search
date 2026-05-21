@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<style>
    .about-page {
        --about-blue: #1f67ab;
        --about-orange: #e87526;
        --about-ink: #1c2c3e;
        --about-muted: #586474;
        --about-soft: #f7f9fc;
        --about-border: #dfe6ef;

        background: #eef2f7;
        color: var(--about-ink);
        padding: 46px 0 76px;
    }

    .about-container {
        width: min(1180px, calc(100% - 36px));
        margin: 0 auto;
    }

    .about-section {
        margin-bottom: 64px;
    }

    .about-split,
    .team-member {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
        align-items: center;
        gap: clamp(26px, 5vw, 72px);
    }

    .about-split.reverse .about-copy,
    .team-member.reverse .team-copy {
        order: 1;
    }

    .about-split.reverse .about-media,
    .team-member.reverse .team-media {
        order: 2;
    }

    .about-media,
    .team-media,
    .about-feature-media {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        background: #dde4ed;
        box-shadow: 0 16px 34px rgba(22, 42, 64, .12);
    }

    .about-media::after,
    .team-media::after,
    .about-feature-media::after {
        content: "";
        position: absolute;
        inset: 0;
        pointer-events: none;
        border: 1px solid rgba(255,255,255,.55);
        border-radius: inherit;
    }

    .about-media img,
    .team-media img,
    .about-feature-media img {
        width: 100%;
        display: block;
        aspect-ratio: 1.56 / 1;
        object-fit: cover;
        object-position: center;
        filter: grayscale(100%);
        transition: filter .35s ease, transform .35s ease;
    }

    .about-feature-media img {
        aspect-ratio: 2.31 / 1;
        object-fit: contain;
        background: #fff;
        padding: 10px;
    }

    .about-media:hover img,
    .team-media:hover img,
    .about-feature-media:hover img {
        filter: grayscale(0%);
        transform: scale(1.025);
    }

    .about-copy,
    .team-copy {
        max-width: 560px;
    }

    .about-title,
    .team-copy h3,
    .section-heading h2 {
        color: #101828;
        font-weight: 800;
        letter-spacing: 0;
        margin: 0;
    }

    .about-title,
    .section-heading h2 {
        font-size: clamp(28px, 3vw, 40px);
        line-height: 1.16;
    }

    .team-copy h3 {
        font-size: clamp(24px, 2.5vw, 34px);
        line-height: 1.2;
    }

    .team-copy h3 span {
        display: inline;
        color: #344054;
        font-size: .58em;
        font-weight: 700;
    }

    .accent-line {
        display: flex;
        width: 220px;
        height: 4px;
        margin: 14px 0 22px;
        overflow: hidden;
        border-radius: 999px;
    }

    .accent-line.center {
        margin-left: auto;
        margin-right: auto;
    }

    .accent-line .blue,
    .accent-line .orange {
        flex: 1;
    }

    .accent-line .blue {
        background: var(--about-blue);
    }

    .accent-line .orange {
        background: var(--about-orange);
    }

    .about-copy p,
    .about-side-copy p,
    .team-copy p,
    .about-list li,
    .team-copy li {
        color: var(--about-muted);
        font-size: 16px;
        line-height: 1.75;
    }

    .about-copy p,
    .about-side-copy p,
    .team-copy p {
        margin: 0 0 16px;
    }

    .about-copy strong,
    .about-side-copy strong,
    .team-copy strong {
        color: #182230;
        font-weight: 800;
    }

    .about-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 44px;
        margin-top: 8px;
        padding: 0 20px;
        border-radius: 999px;
        background: linear-gradient(180deg, #2f89d0 0%, #1f67ab 100%);
        box-shadow: 0 10px 22px rgba(31,103,171,.22);
        color: #fff;
        font-size: 15px;
        font-weight: 800;
        line-height: 1.2;
        text-decoration: none;
        white-space: normal;
    }

    .about-btn.orange {
        background: linear-gradient(180deg, #ef8a39 0%, #df6d1c 100%);
        box-shadow: 0 10px 22px rgba(223,109,28,.22);
    }

    .about-btn:hover {
        color: #fff;
        text-decoration: none;
    }

    .section-heading {
        max-width: 900px;
        margin: 0 auto 28px;
        text-align: center;
    }

    .section-heading p {
        margin: 0;
        color: var(--about-muted);
        font-size: 16px;
        line-height: 1.75;
    }

    .about-feature {
        display: grid;
        grid-template-columns: minmax(0, 1.2fr) minmax(320px, .8fr);
        align-items: center;
        gap: 34px;
    }

    .about-side-copy {
        padding: 28px;
        border: 1px solid var(--about-border);
        border-radius: 8px;
        background: rgba(255,255,255,.68);
    }

    .about-list,
    .team-copy ul {
        list-style: none;
        margin: 0 0 16px;
        padding: 0;
    }

    .about-list li,
    .team-copy li {
        position: relative;
        margin-bottom: 10px;
        padding-left: 20px;
    }

    .about-list li::before,
    .team-copy li::before,
    .team-copy .bullet-line::before {
        content: "";
        position: absolute;
        left: 0;
        top: .8em;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--about-orange);
    }

    .team-section {
        margin-top: 18px;
    }

    .team-title {
        margin-bottom: 34px;
        text-align: center;
    }

    .team-title h2 {
        margin: 0;
        color: #101828;
        font-size: clamp(28px, 3vw, 38px);
        font-weight: 800;
    }

    .team-member {
        margin-bottom: 54px;
        padding: 24px;
        border: 1px solid rgba(223,230,239,.8);
        border-radius: 8px;
        background: rgba(255,255,255,.5);
    }

    .team-copy .bullet-line {
        position: relative;
        padding-left: 20px;
    }

    @media (max-width: 991px) {
        .about-page {
            padding-top: 34px;
        }

        .about-split,
        .about-split.reverse,
        .team-member,
        .team-member.reverse,
        .about-feature {
            grid-template-columns: 1fr;
        }

        .about-split.reverse .about-copy,
        .about-split.reverse .about-media,
        .team-member.reverse .team-copy,
        .team-member.reverse .team-media {
            order: unset;
        }

        .about-copy,
        .team-copy {
            max-width: none;
        }
    }

    @media (max-width: 640px) {
        .about-container {
            width: min(100% - 28px, 1180px);
        }

        .about-section {
            margin-bottom: 46px;
        }

        .about-media,
        .team-media,
        .about-feature-media,
        .about-side-copy,
        .team-member {
            border-radius: 8px;
        }

        .team-member,
        .about-side-copy {
            padding: 16px;
        }

        .accent-line {
            width: 160px;
            margin-bottom: 18px;
        }

        .about-copy p,
        .about-side-copy p,
        .team-copy p,
        .about-list li,
        .team-copy li {
            font-size: 15px;
            line-height: 1.65;
        }

        .team-copy h3 span {
            display: block;
            margin-top: 5px;
            font-size: 15px;
        }

        .about-btn {
            width: 100%;
            padding: 0 16px;
            text-align: center;
        }
    }
</style>

<section class="about-page">
    <div class="about-container">

        <div class="about-section">
            <div class="about-split">
                <div class="about-media">
                    <img src="{{ asset('images/about/1.png') }}" alt="ConstructKaro team">
                </div>
                <div class="about-copy">
                    <h2 class="about-title">Who We Are</h2>
                    <div class="accent-line"><span class="blue"></span><span class="orange"></span></div>
                    <p>
                        ConstructKaro is a <strong>construction services and execution platform in India</strong>
                        that provides a <strong>structured and guided way to start and complete construction projects.</strong>
                    </p>
                    <a href="{{ route('aboutwhome') }}" class="about-btn">Learn More About Who We Are</a>
                </div>
            </div>
        </div>

        <div class="about-section">
            <div class="about-split reverse">
                <div class="about-copy">
                    <h2 class="about-title">Our Background</h2>
                    <div class="accent-line"><span class="blue"></span><span class="orange"></span></div>
                    <p>
                        We come from years of hands-on experience in the
                        <strong>construction industry in India</strong>, working across a wide
                        range of projects including residential, commercial, interior, estimation,
                        site coordination, and vendor execution work.
                    </p>
                    <a href="{{ route('ourbaround') }}" class="about-btn orange">Learn More About Our Background</a>
                </div>
                <div class="about-media">
                    <img src="{{ asset('images/about/2.png') }}" alt="Construction site background">
                </div>
            </div>
        </div>

        <div class="about-section">
            <div class="about-split">
                <div class="about-media">
                    <img src="{{ asset('images/about/3.png') }}" alt="Construction planning problem">
                </div>
                <div class="about-copy">
                    <h2 class="about-title">The Core Problem</h2>
                    <div class="accent-line"><span class="blue"></span><span class="orange"></span></div>
                    <p>
                        The real problem is the lack of a <strong>clear and structured way to start construction projects</strong>.
                        Customers often do not know whom to contact first, how to plan properly,
                        and how to move from requirement to execution in the right sequence.
                    </p>
                    <a href="{{ route('coreproblem') }}" class="about-btn">Learn More About Core Problem</a>
                </div>
            </div>
        </div>

        <div class="about-section">
            <div class="section-heading">
                <h2>What ConstructKaro Does</h2>
                <div class="accent-line center"><span class="blue"></span><span class="orange"></span></div>
                <p>
                    ConstructKaro acts as a <strong>construction services and execution platform in India</strong>,
                    helping customers move from <strong>idea to project completion through a structured and guided process.</strong>
                </p>
            </div>

            <div class="about-feature">
                <div class="about-feature-media">
                    <img src="{{ asset('images/about/15.png') }}" alt="ConstructKaro service flow">
                </div>
                <div class="about-side-copy">
                    <p>
                        Unlike traditional platforms that only provide listings or leads, ConstructKaro focuses on
                        <strong>end-to-end construction services and project execution.</strong>
                    </p>
                    <ul class="about-list">
                        <li>From unstructured construction enquiries</li>
                        <li>To organized, reliable, and professionally managed execution</li>
                        <li>All in one system</li>
                    </ul>
                    <p>
                        <strong>You do not have to manage multiple vendors.</strong>
                        ConstructKaro manages the entire construction process for you.
                    </p>
                </div>
            </div>
        </div>

        <div class="about-section">
            <div class="about-split reverse">
                <div class="about-copy">
                    <h2 class="about-title">How ConstructKaro Is Different</h2>
                    <div class="accent-line"><span class="blue"></span><span class="orange"></span></div>
                    <p>
                        Most construction platforms in India focus only on
                        <strong>lead generation, listings, or vendor directories.</strong>
                        ConstructKaro is different because it provides structured project execution support.
                    </p>
                    <a href="{{ route('canstructkarodifferent') }}" class="about-btn orange">Learn More About How ConstructKaro Is Different</a>
                </div>
                <div class="about-media">
                    <img src="{{ asset('images/about/4.png') }}" alt="Construction team reviewing plans">
                </div>
            </div>
        </div>

        <div class="about-section">
            <div class="about-split">
                <div class="about-media">
                    <img src="{{ asset('images/about/5.png') }}" alt="Engineer overlooking construction site">
                </div>
                <div class="about-copy">
                    <h2 class="about-title">Our Vision</h2>
                    <div class="accent-line"><span class="blue"></span><span class="orange"></span></div>
                    <p><strong>A platform where:</strong></p>
                    <ul class="about-list">
                        <li>Every project starts with clarity</li>
                        <li>Every service is structured</li>
                        <li>Every execution is monitored</li>
                        <li>Every stakeholder is accountable</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="about-section">
            <div class="about-split reverse">
                <div class="about-copy">
                    <h2 class="about-title">Our Mission</h2>
                    <div class="accent-line"><span class="blue"></span><span class="orange"></span></div>
                    <ul class="about-list">
                        <li>To simplify construction for every customer</li>
                        <li>To bring structure to an unorganized industry</li>
                        <li>To enable vendors with real, execution-ready work</li>
                        <li>To create transparency in pricing and delivery</li>
                    </ul>
                </div>
                <div class="about-media">
                    <img src="{{ asset('images/about/6.png') }}" alt="Construction team discussing project plan">
                </div>
            </div>
        </div>

        <div class="team-section">
            <div class="team-title">
                <h2>Leadership Team</h2>
                <div class="accent-line center"><span class="blue"></span><span class="orange"></span></div>
            </div>

            <div class="team-member">
                <div class="team-media">
                    <img src="{{ asset('images/about/7.png') }}" alt="Aniket A. Patil">
                </div>
                <div class="team-copy">
                    <h3>Aniket A. Patil <span>(Founder & CEO)</span></h3>
                    <div class="accent-line"><span class="blue"></span><span class="orange"></span></div>
                    <p class="bullet-line">Civil Engineer with business background</p>
                    <p class="bullet-line">8+ years of experience in construction execution and business development</p>
                    <p><strong>Hands-on expertise in:</strong></p>
                    <ul>
                        <li>Project execution and site management</li>
                        <li>Bringing new construction works and finalising them</li>
                        <li>Vendor and client coordination</li>
                        <li>BOQ, estimation, and costing</li>
                        <li>Billing and payment cycle handling</li>
                    </ul>
                </div>
            </div>

            <div class="team-member reverse">
                <div class="team-media">
                    <img src="{{ asset('images/about/8.png') }}" alt="Samiksha Shirke">
                </div>
                <div class="team-copy">
                    <h3>Samiksha Shirke <span>(Co-Founder & Operations Head)</span></h3>
                    <div class="accent-line"><span class="blue"></span><span class="orange"></span></div>
                    <p class="bullet-line">Civil Engineer with full-time site execution experience</p>
                    <p class="bullet-line">Leads day-to-day operations and project coordination</p>
                    <p><strong>Core strengths include:</strong></p>
                    <ul>
                        <li>Contractor and vendor management</li>
                        <li>Quality and progress monitoring</li>
                        <li>Billing and estimation support</li>
                        <li>BOQ, estimation, and costing</li>
                        <li>Team and execution discipline</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="team-section">
            <div class="team-title">
                <h2>Technology Team</h2>
                <div class="accent-line center"><span class="blue"></span><span class="orange"></span></div>
            </div>

            <div class="team-member">
                <div class="team-media">
                    <img src="{{ asset('images/about/9.png') }}" alt="Pratiksha Misal">
                </div>
                <div class="team-copy">
                    <h3>Pratiksha Misal <span>(Tech Lead & Web Developer)</span></h3>
                    <div class="accent-line"><span class="blue"></span><span class="orange"></span></div>
                    <p class="bullet-line">7+ years of experience in web application development</p>
                    <p><strong>Expertise in:</strong></p>
                    <ul>
                        <li>Laravel, CodeIgniter, PHP</li>
                        <li>Frontend and backend architecture</li>
                        <li>Database systems</li>
                        <li>Cloud deployment</li>
                    </ul>
                    <p><strong>Strength:</strong> Building and scaling the ConstructKaro platform.</p>
                </div>
            </div>
        </div>

        <div class="team-section">
            <div class="team-title">
                <h2>Core Execution & Support Team</h2>
                <div class="accent-line center"><span class="blue"></span><span class="orange"></span></div>
            </div>

            <div class="team-member reverse">
                <div class="team-media">
                    <img src="{{ asset('images/about/16.png') }}" alt="Apurva Patil">
                </div>
                <div class="team-copy">
                    <h3>Apurva Patil <span>(Consulting Architect)</span></h3>
                    <div class="accent-line"><span class="blue"></span><span class="orange"></span></div>
                    <p class="bullet-line">Experienced architect supporting planning and design direction</p>
                    <ul>
                        <li>Architectural planning and layout optimization</li>
                        <li>Coordination with execution team for design feasibility</li>
                        <li>Guidance on approvals and documents</li>
                    </ul>
                </div>
            </div>

            <div class="team-member">
                <div class="team-media">
                    <img src="{{ asset('images/about/14.png') }}" alt="Manali Sawant">
                </div>
                <div class="team-copy">
                    <h3>Manali Sawant <span>(Civil Technical Engineer)</span></h3>
                    <div class="accent-line"><span class="blue"></span><span class="orange"></span></div>
                    <p class="bullet-line">Civil engineer with strong on-site technical execution experience</p>
                    <ul>
                        <li>Quality checks and progress tracking</li>
                        <li>BOQ understanding and quantity verification</li>
                        <li>Coordination with contractors and vendors</li>
                        <li>Handling technical challenges during execution</li>
                    </ul>
                </div>
            </div>

            <div class="team-member reverse">
                <div class="team-media">
                    <img src="{{ asset('images/about/10.png') }}" alt="Omkar Bhilare">
                </div>
                <div class="team-copy">
                    <h3>Omkar Bhilare <span>(Marketing Executive)</span></h3>
                    <div class="accent-line"><span class="blue"></span><span class="orange"></span></div>
                    <ul>
                        <li>Handles marketing strategies and brand communication</li>
                        <li>Lead generation through digital campaigns</li>
                        <li>Managing social media and online presence</li>
                    </ul>
                </div>
            </div>

            <div class="team-member">
                <div class="team-media">
                    <img src="{{ asset('images/about/11.png') }}" alt="Darshana Salunkhe">
                </div>
                <div class="team-copy">
                    <h3>Darshana Salunkhe <span>(Telemarketing & Field Sales)</span></h3>
                    <div class="accent-line"><span class="blue"></span><span class="orange"></span></div>
                    <ul>
                        <li>Handles customer interaction and initial requirement understanding</li>
                        <li>Calling and qualifying incoming leads</li>
                        <li>Supporting customer onboarding process</li>
                    </ul>
                </div>
            </div>

            <div class="team-member reverse">
                <div class="team-media">
                    <img src="{{ asset('images/about/13.png') }}" alt="Sakshi Shinde">
                </div>
                <div class="team-copy">
                    <h3>Sakshi Shinde <span>(Telemarketing & Field Sales)</span></h3>
                    <div class="accent-line"><span class="blue"></span><span class="orange"></span></div>
                    <ul>
                        <li>Supports lead handling and customer coordination</li>
                        <li>Managing customer inquiries and follow-ups</li>
                        <li>Supporting sales conversion process</li>
                    </ul>
                </div>
            </div>

            <div class="team-member">
                <div class="team-media">
                    <img src="{{ asset('images/about/12.png') }}" alt="Pinal Majethiya">
                </div>
                <div class="team-copy">
                    <h3>Pinal Majethiya <span>(UI/UX & Graphic Designer)</span></h3>
                    <div class="accent-line"><span class="blue"></span><span class="orange"></span></div>
                    <ul>
                        <li>Handles design, user experience, and visual communication</li>
                        <li>Website UI/UX design and user flow structuring</li>
                        <li>Creating visual creatives for marketing and branding</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
