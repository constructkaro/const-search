@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<style>
    .about-page {
        padding: 50px 0 80px;
        background: #efefef;
    }

    .about-container {
        max-width: 1320px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .about-section {
        margin-bottom: 80px;
    }

    .about-block {
        display: grid;
        grid-template-columns: 1.05fr 0.95fr;
        align-items: center;
        gap: 40px;
    }

    .about-block.reverse {
        grid-template-columns: 0.95fr 1.05fr;
    }

    .about-block.reverse .about-content {
        order: 1;
    }

    .about-block.reverse .about-image-card {
        order: 2;
    }

    .about-image-card {
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 10px 24px rgba(0,0,0,0.08);
        background: #fff;
        transition: all 0.35s ease;
    }

    .about-image-card.blue-border {
        border-left: 5px solid #2b78d0;
    }

    .about-image-card.orange-border {
        border-right: 5px solid #f25c05;
    }

    .about-image-card img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
        filter: grayscale(100%);
        transition: all 0.5s ease;
    }

    .about-image-card:hover img {
        filter: grayscale(0%);
        transform: scale(1.02);
    }

    .about-content {
        padding: 10px 6px;
    }

    .about-title {
        font-size: 34px;
        line-height: 1.2;
        font-weight: 800;
        color: #111;
        margin-bottom: 12px;
    }

    .about-line {
        display: flex;
        align-items: center;
        margin-bottom: 24px;
    }

    .about-line .blue {
        width: 130px;
        height: 4px;
        background: #2b78d0;
        border-radius: 30px 0 0 30px;
    }

    .about-line .orange {
        width: 130px;
        height: 4px;
        background: #f25c05;
        border-radius: 0 30px 30px 0;
    }

    .about-content p {
        font-size: 17px;
        line-height: 1.7;
        color: #4c4c4c;
        margin-bottom: 18px;
    }

    .about-content p strong {
        color: #111;
        font-weight: 700;
    }

    .about-btn {
        display: inline-block;
        margin-top: 12px;
        background: #2b78d0;
        color: #fff;
        text-decoration: none;
        padding: 13px 24px;
        border-radius: 12px;
        font-size: 17px;
        font-weight: 700;
        box-shadow: 0 6px 16px rgba(43, 120, 208, 0.25);
        transition: all 0.3s ease;
    }

    .about-btn.orange {
        background: #f25c05;
        box-shadow: 0 6px 16px rgba(242, 92, 5, 0.25);
    }

    .about-btn:hover {
        color: #fff;
        transform: translateY(-2px);
    }

    .about-center-title {
        text-align: center;
        margin-bottom: 28px;
    }

    .about-center-title h2 {
        font-size: 34px;
        font-weight: 800;
        color: #111;
        margin-bottom: 12px;
    }

    .about-center-line {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .about-center-line .blue {
        width: 110px;
        height: 4px;
        background: #2b78d0;
        border-radius: 30px 0 0 30px;
    }

    .about-center-line .orange {
        width: 110px;
        height: 4px;
        background: #f25c05;
        border-radius: 0 30px 30px 0;
    }

    .about-center-desc {
        max-width: 900px;
        margin: 0 auto 34px;
        text-align: center;
        font-size: 17px;
        line-height: 1.7;
        color: #5a5a5a;
    }

    .about-feature-box {
        display: grid;
        grid-template-columns: 1.35fr 0.85fr;
        gap: 30px;
        align-items: start;
    }

    .about-feature-card {
        background: #f8f8f8;
        border-radius: 18px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        padding: 28px 24px;
    }

    .about-feature-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }

    .about-feature-item {
        text-align: center;
    }

    .about-feature-item img {
        width: 52px;
        height: 52px;
        object-fit: contain;
        margin-bottom: 12px;
    }

    .about-feature-item h4 {
        font-size: 16px;
        font-weight: 800;
        color: #111;
        margin-bottom: 8px;
        line-height: 1.35;
    }

    .about-feature-item p {
        font-size: 14px;
        line-height: 1.55;
        color: #666;
        margin: 0;
    }

    .about-side-text p {
        font-size: 17px;
        line-height: 1.7;
        color: #555;
        margin-bottom: 18px;
    }

    .about-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .about-list li {
        position: relative;
        padding-left: 20px;
        margin-bottom: 14px;
        font-size: 17px;
        line-height: 1.6;
        color: #555;
        font-weight: 600;
    }

    .about-list li::before {
        content: "•";
        position: absolute;
        left: 0;
        top: -1px;
        color: #f25c05;
        font-size: 20px;
        line-height: 1;
    }

    .team-section {
        margin-top: 20px;
    }

    .team-title {
        text-align: center;
        margin-bottom: 40px;
    }

    .team-title h2 {
        font-size: 34px;
        font-weight: 800;
        color: #111;
        margin-bottom: 12px;
    }

    .team-member {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 38px;
        align-items: center;
        margin-bottom: 55px;
    }

    .team-member.reverse .team-photo {
        order: 2;
    }

    .team-member.reverse .team-info {
        order: 1;
    }

    .team-photo {
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 10px 24px rgba(0,0,0,0.08);
        background: #fff;
        transition: all 0.35s ease;
    }

    .team-photo.blue-border {
        border-left: 5px solid #2b78d0;
    }

    .team-photo.orange-border {
        border-right: 5px solid #f25c05;
    }

    .team-photo img {
        width: 100%;
        display: block;
        object-fit: cover;
        filter: grayscale(100%);
        transition: all 0.5s ease;
    }

    .team-photo:hover img {
        filter: grayscale(0%);
        transform: scale(1.02);
    }

    .team-info h3 {
        font-size: 30px;
        line-height: 1.25;
        font-weight: 800;
        color: #111;
        margin-bottom: 10px;
    }

    .team-info h3 span {
        font-size: 18px;
        font-weight: 700;
        color: #222;
    }

    .team-line {
        display: flex;
        margin-bottom: 18px;
    }

    .team-line .blue {
        width: 140px;
        height: 4px;
        background: #2b78d0;
        border-radius: 30px 0 0 30px;
    }

    .team-line .orange {
        width: 140px;
        height: 4px;
        background: #f25c05;
        border-radius: 0 30px 30px 0;
    }

    .team-info p,
    .team-info li {
        font-size: 16px;
        line-height: 1.7;
        color: #5b5b5b;
    }

    .team-info ul {
        list-style: none;
        padding: 0;
        margin: 8px 0 0;
    }

    .team-info ul li {
        position: relative;
        padding-left: 16px;
        margin-bottom: 8px;
    }

    .team-info ul li::before {
        content: "•";
        position: absolute;
        left: 0;
        color: #777;
    }

    .team-info strong {
        color: #111;
    }

    @media (max-width: 1199px) {
        .about-block,
        .about-block.reverse,
        .team-member,
        .about-feature-box {
            grid-template-columns: 1fr;
        }

        .about-block.reverse .about-content,
        .about-block.reverse .about-image-card,
        .team-member.reverse .team-photo,
        .team-member.reverse .team-info {
            order: unset;
        }

        .about-feature-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 767px) {
        .about-page {
            padding: 30px 0 50px;
        }

        .about-container {
            padding: 0 15px;
        }

        .about-section {
            margin-bottom: 55px;
        }

        .about-block,
        .team-member {
            gap: 24px;
        }

        .about-title,
        .about-center-title h2,
        .team-title h2,
        .team-info h3 {
            font-size: 26px;
        }

        .team-info h3 span {
            display: block;
            font-size: 16px;
            margin-top: 6px;
        }

        .about-line .blue,
        .about-line .orange,
        .team-line .blue,
        .team-line .orange {
            width: 90px;
        }

        .about-content p,
        .about-side-text p,
        .about-list li,
        .team-info p,
        .team-info li,
        .about-center-desc {
            font-size: 15px;
            line-height: 1.65;
        }

        .about-btn {
            font-size: 15px;
            padding: 11px 18px;
        }

        .about-feature-grid {
            grid-template-columns: 1fr;
        }

        .about-feature-card {
            padding: 22px 18px;
        }
    }


    .single-image-card {
    padding: 0;
    overflow: hidden;
}

.single-image-card img {
    width: 100%;
    height: 100%;
    display: block;
    object-fit: cover;
    filter: grayscale(100%);
    transition: all 0.5s ease;
}

.single-image-card:hover img {
    filter: grayscale(0%);
    transform: scale(1.02);
}
</style>

<section class="about-page">
    <div class="about-container">

        <!-- Who We Are -->
        <div class="about-section">
            <div class="about-block">
                <div class="about-image-card blue-border">
                    <img src="{{ asset('images/about/1.png') }}" alt="Who We Are">
                </div>
                <div class="about-content">
                    <h2 class="about-title">Who we Are:</h2>
                    <div class="about-line">
                        <span class="blue"></span>
                        <span class="orange"></span>
                    </div>
                    <p>
                        ConstructKaro is a <strong>construction services and execution platform in India</strong>
                        that provides a <strong>structured and guided way to start and complete construction projects.</strong>
                    </p>
                    <a href="#" class="about-btn">Learn more about Who we Are</a>
                </div>
            </div>
        </div>

        <!-- Our Background -->
        <div class="about-section">
            <div class="about-block reverse">
                <div class="about-content">
                    <h2 class="about-title">Our Background:</h2>
                    <div class="about-line">
                        <span class="blue"></span>
                        <span class="orange"></span>
                    </div>
                    <p>
                        We come from years of hands-on experience in the
                        <strong>construction industry in India</strong>, working across a wide
                        range of projects including residential, commercial, interior, estimation,
                        site coordination, and vendor execution work.
                    </p>
                    <a href="#" class="about-btn orange">Learn more about Our Background:</a>
                </div>
                <div class="about-image-card orange-border">
                    <img src="{{ asset('images/about/2.png') }}" alt="Our Background">
                </div>
            </div>
        </div>

        <!-- Core Problem -->
        <div class="about-section">
            <div class="about-block">
                <div class="about-image-card blue-border">
                    <img src="{{ asset('images/about/3.png') }}" alt="Core Problem">
                </div>
                <div class="about-content">
                    <h2 class="about-title">The Core Problem</h2>
                    <div class="about-line">
                        <span class="blue"></span>
                        <span class="orange"></span>
                    </div>
                    <p>
                        The real problem is the lack of a <strong>clear and structured way to start construction projects</strong>.
                        Customers often do not know whom to contact first, how to plan properly,
                        and how to move from requirement to execution in the right sequence.
                    </p>
                    <a href="#" class="about-btn">Learn more about Core Problem</a>
                </div>
            </div>
        </div>

        <!-- What ConstructKaro Does -->
        <div class="about-section">
            <div class="about-center-title">
                <h2>What ConstructKaro Does</h2>
                <div class="about-center-line">
                    <span class="blue"></span>
                    <span class="orange"></span>
                </div>
            </div>

            <p class="about-center-desc">
                ConstructKaro acts as a <strong>construction services and execution platform in India</strong>,
                helping customers move from <strong>idea to project completion through a structured and guided process.</strong>
            </p>

           <div class="about-feature-box">
        <div class="about-feature-card single-image-card">
            <img src="{{ asset('images/about/15.png') }}" alt="What ConstructKaro Does">
        </div>

    <div class="about-side-text">
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

        <!-- Different -->
        <div class="about-section">
            <div class="about-block reverse">
                <div class="about-content">
                    <h2 class="about-title">How ConstructKaro is Different</h2>
                    <div class="about-line">
                        <span class="blue"></span>
                        <span class="orange"></span>
                    </div>
                    <p>
                        Most construction platforms in India focus only on
                        <strong>lead generation, listings, or vendor directories.</strong>
                        ConstructKaro is different because it provides structured project execution support.
                    </p>
                    <a href="#" class="about-btn orange">Learn more about How ConstructKaro is Different</a>
                </div>
                <div class="about-image-card orange-border">
                    <img src="{{ asset('images/about/4.png') }}" alt="How ConstructKaro is Different">
                </div>
            </div>
        </div>

        <!-- Vision -->
        <div class="about-section">
            <div class="about-block">
                <div class="about-image-card blue-border">
                    <img src="{{ asset('images/about/5.png') }}" alt="Our Vision">
                </div>
                <div class="about-content">
                    <h2 class="about-title">Our Vision</h2>
                    <div class="about-line">
                        <span class="blue"></span>
                        <span class="orange"></span>
                    </div>
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

        <!-- Mission -->
        <div class="about-section">
            <div class="about-block reverse">
                <div class="about-content">
                    <h2 class="about-title">Our Mission</h2>
                    <div class="about-line">
                        <span class="blue"></span>
                        <span class="orange"></span>
                    </div>
                    <ul class="about-list">
                        <li>To simplify construction for every customer</li>
                        <li>To bring structure to an unorganized industry</li>
                        <li>To enable vendors with real, execution-ready work</li>
                        <li>To create transparency in pricing and delivery</li>
                    </ul>
                </div>
                <div class="about-image-card orange-border">
                    <img src="{{ asset('images/about/6.png') }}" alt="Our Mission">
                </div>
            </div>
        </div>

        <!-- Leadership Team -->
        <div class="team-section">
            <div class="team-title">
                <h2>Leadership Team</h2>
                <div class="about-center-line">
                    <span class="blue"></span>
                    <span class="orange"></span>
                </div>
            </div>

            <div class="team-member">
                <div class="team-photo blue-border">
                    <img src="{{ asset('images/about/7.png') }}" alt="Aniket A. Patil">
                </div>
                <div class="team-info">
                    <h3>Aniket A. Patil <span>(Founder & CEO)</span></h3>
                    <div class="team-line">
                        <span class="blue"></span>
                        <span class="orange"></span>
                    </div>
                    <p>• Civil Engineer with business background</p>
                    <p>• 8+ years of experience in construction execution & business development</p>
                    <p><strong>Hands-on expertise in:</strong></p>
                    <ul>
                        <li>Project execution & site management</li>
                        <li>Bringing new construction works and finalising them</li>
                        <li>Vendor and client coordination</li>
                        <li>BOQ, estimation, and costing</li>
                        <li>Billing and payment cycle handling</li>
                    </ul>
                </div>
            </div>

            <div class="team-member reverse">
                <div class="team-photo orange-border">
                    <img src="{{ asset('images/about/8.png') }}" alt="Samiksha Shirke">
                </div>
                <div class="team-info">
                    <h3>Samiksha Shirke <span>(Co-Founder & Operations Head)</span></h3>
                    <div class="team-line">
                        <span class="blue"></span>
                        <span class="orange"></span>
                    </div>
                    <p>• Civil Engineer with full-time site execution experience</p>
                    <p>• Leads day-to-day operations and project coordination</p>
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

        <!-- Technology Team -->
        <div class="team-section">
            <div class="team-title">
                <h2>Technology Team</h2>
                <div class="about-center-line">
                    <span class="blue"></span>
                    <span class="orange"></span>
                </div>
            </div>

            <div class="team-member">
                <div class="team-photo blue-border">
                    <img src="{{ asset('images/about/9.png') }}" alt="Pratiksha Misal">
                </div>
                <div class="team-info">
                    <h3>Pratiksha Misal <span>(Tech Lead & Web Developer)</span></h3>
                    <div class="team-line">
                        <span class="blue"></span>
                        <span class="orange"></span>
                    </div>
                    <p>• 7+ years of experience in web application development</p>
                    <p><strong>Expertise in:</strong></p>
                    <ul>
                        <li>Laravel, CodeIgniter, PHP</li>
                        <li>Frontend & backend architecture</li>
                        <li>Database systems</li>
                        <li>Cloud deployment</li>
                    </ul>
                    <p><strong>Strength:</strong> Building and scaling the ConstructKaro platform.</p>
                </div>
            </div>
        </div>

        <!-- Core Execution & Support Team -->
        <div class="team-section">
            <div class="team-title">
                <h2>Core Execution & Support Team</h2>
                <div class="about-center-line">
                    <span class="blue"></span>
                    <span class="orange"></span>
                </div>
            </div>

            <div class="team-member reverse">
                <div class="team-photo orange-border">
                    <img src="{{ asset('images/about/16.png') }}" alt="Apurva Patil">
                </div>
                <div class="team-info">
                    <h3>Apurva Patil <span>(Consulting Architect)</span></h3>
                    <div class="team-line">
                        <span class="blue"></span>
                        <span class="orange"></span>
                    </div>
                    <p>• Experienced architect supporting planning and design direction</p>
                    <ul>
                        <li>Architectural planning and layout optimization</li>
                        <li>Coordination with execution team for design feasibility</li>
                        <li>Guidance on approvals and documents</li>
                    </ul>
                </div>
            </div>

            <div class="team-member">
                <div class="team-photo blue-border">
                    <img src="{{ asset('images/about/14.png') }}" alt="Manali Sawant">
                </div>
                <div class="team-info">
                    <h3>Manali Sawant <span>(Civil Technical Engineer)</span></h3>
                    <div class="team-line">
                        <span class="blue"></span>
                        <span class="orange"></span>
                    </div>
                    <p>• Civil engineer with strong on-site technical execution experience</p>
                    <ul>
                        <li>Quality checks and progress tracking</li>
                        <li>BOQ understanding and quantity verification</li>
                        <li>Coordination with contractors and vendors</li>
                        <li>Handling technical challenges during execution</li>
                    </ul>
                </div>
            </div>

            <div class="team-member reverse">
                <div class="team-photo orange-border">
                    <img src="{{ asset('images/about/10.png') }}" alt="Omkar Bhilare">
                </div>
                <div class="team-info">
                    <h3>Omkar Bhilare <span>(Marketing Executive)</span></h3>
                    <div class="team-line">
                        <span class="blue"></span>
                        <span class="orange"></span>
                    </div>
                    <ul>
                        <li>Handles marketing strategies and brand communication</li>
                        <li>Lead generation through digital campaigns</li>
                        <li>Managing social media and online presence</li>
                    </ul>
                </div>
            </div>

            <div class="team-member">
                <div class="team-photo blue-border">
                    <img src="{{ asset('images/about/11.png') }}" alt="Darshana Salunkhe">
                </div>
                <div class="team-info">
                    <h3>Darshana Salunkhe <span>(Telemarketing & Field Sales)</span></h3>
                    <div class="team-line">
                        <span class="blue"></span>
                        <span class="orange"></span>
                    </div>
                    <ul>
                        <li>Handles customer interaction and initial requirement understanding</li>
                        <li>Calling and qualifying incoming leads</li>
                        <li>Supporting customer onboarding process</li>
                    </ul>
                </div>
            </div>

            <div class="team-member reverse">
                <div class="team-photo orange-border">
                    <img src="{{ asset('images/about/13.png') }}" alt="Sakshi Shinde">
                </div>
                <div class="team-info">
                    <h3>Sakshi Shinde <span>(Telemarketing & Field Sales)</span></h3>
                    <div class="team-line">
                        <span class="blue"></span>
                        <span class="orange"></span>
                    </div>
                    <ul>
                        <li>Supports lead handling and customer coordination</li>
                        <li>Managing customer inquiries and follow-ups</li>
                        <li>Supporting sales conversion process</li>
                    </ul>
                </div>
            </div>

            <div class="team-member">
                <div class="team-photo blue-border">
                    <img src="{{ asset('images/about/12.png') }}" alt="Pinal Majethiya">
                </div>
                <div class="team-info">
                    <h3>Pinal Majethiya <span>(UI/UX & Graphic Designer)</span></h3>
                    <div class="team-line">
                        <span class="blue"></span>
                        <span class="orange"></span>
                    </div>
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