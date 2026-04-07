@extends('vendor.layouts.app')

@section('title', 'Vendor | ConstructKaro')

@section('content')

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    :root {
        --primary: #111633;
        --primary-2: #1a1f47;
        --accent: #f5a623;
        --accent-dark: #e59200;
        --text: #101828;
        --muted: #667085;
        --light-bg: #f7f8fa;
        --white: #ffffff;
        --border: #e9edf3;
        --shadow: 0 10px 30px rgba(16, 24, 40, 0.08);
        --radius: 22px;
        --container: 1280px;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    .container {
        width: min(92%, var(--container));
        margin: 0 auto;
    }

    .site-header {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: rgba(17, 22, 51, 0.9);
        backdrop-filter: blur(12px);
        border-bottom: 1px solid rgba(255,255,255,0.08);
    }

    .header-inner {
        min-height: 84px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 14px;
        color: var(--white);
        font-size: 24px;
        font-weight: 800;
        letter-spacing: 0.2px;
    }

    .brand-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        background: var(--accent);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
        box-shadow: 0 8px 20px rgba(245,166,35,0.25);
    }

    .nav {
        display: flex;
        align-items: center;
        gap: 34px;
    }

    .nav a {
        color: rgba(255,255,255,0.92);
        font-size: 16px;
        font-weight: 500;
        transition: 0.25s ease;
    }

    .nav a:hover {
        color: var(--accent);
    }

    .btn-header {
        padding: 14px 24px;
        background: var(--accent);
        color: var(--primary) !important;
        border-radius: 14px;
        font-weight: 700 !important;
        box-shadow: 0 10px 20px rgba(245,166,35,0.18);
    }

    .hero {
        position: relative;
        overflow: hidden;
        background:
            radial-gradient(circle at 12% 30%, rgba(245,166,35,0.10), transparent 18%),
            radial-gradient(circle at 88% 55%, rgba(220, 65, 120, 0.10), transparent 22%),
            linear-gradient(135deg, var(--primary) 0%, var(--primary-2) 100%);
        color: var(--white);
    }

    .hero-inner {
        position: relative;
        z-index: 1;
        min-height: 760px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 90px 0 100px;
    }

    .hero-content {
        max-width: 1120px;
    }

    .eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border: 1px solid rgba(255,255,255,0.14);
        border-radius: 999px;
        font-size: 14px;
        color: rgba(255,255,255,0.82);
        margin-bottom: 26px;
        background: rgba(255,255,255,0.04);
    }

    .hero h1 {
        font-size: 76px;
        line-height: 1.05;
        font-weight: 800;
        letter-spacing: -1.2px;
        margin-bottom: 24px;
    }

    .hero p {
        max-width: 880px;
        margin: 0 auto 36px;
        font-size: 23px;
        color: rgba(255,255,255,0.82);
        line-height: 1.6;
    }

    .hero-actions {
        display: flex;
        justify-content: center;
        gap: 18px;
        flex-wrap: wrap;
        margin-bottom: 42px;
    }

    .btn-primary,
    .btn-outline {
        min-width: 250px;
        padding: 18px 30px;
        border-radius: 18px;
        font-size: 18px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        transition: 0.25s ease;
    }

    .btn-primary {
        background: var(--accent);
        color: var(--primary);
        box-shadow: 0 16px 30px rgba(245,166,35,0.18);
    }

    .btn-primary:hover {
        background: var(--accent-dark);
        transform: translateY(-2px);
    }

    .btn-outline {
        border: 1px solid rgba(255,255,255,0.18);
        color: var(--white);
        background: rgba(255,255,255,0.03);
    }

    .btn-outline:hover {
        background: rgba(255,255,255,0.08);
        transform: translateY(-2px);
    }

    .hero-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        max-width: 850px;
        margin: 0 auto;
    }

    .stat-card {
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 18px;
        padding: 18px;
    }

    .stat-card h3 {
        font-size: 28px;
        color: var(--white);
        margin-bottom: 6px;
    }

    .stat-card p {
        margin: 0;
        font-size: 15px;
        color: rgba(255,255,255,0.72);
    }

    .section {
        padding: 110px 0;
    }

    .section-light {
        background: var(--light-bg);
    }

    .section-dark {
        background: linear-gradient(135deg, #131835 0%, #1a1f47 100%);
        color: var(--white);
    }

    .section-head {
        text-align: center;
        max-width: 860px;
        margin: 0 auto 54px;
    }

    .section-head span {
        display: inline-block;
        color: var(--accent);
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 1.3px;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .section-head h2 {
        font-size: 50px;
        font-weight: 800;
        letter-spacing: -0.8px;
        margin-bottom: 14px;
    }

    .section-head p {
        font-size: 20px;
        color: var(--muted);
    }

    .section-dark .section-head p {
        color: rgba(255,255,255,0.72);
    }

    .grid-4 {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 22px;
    }

    .grid-3 {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }

    .category-card,
    .benefit-card {
        background: var(--white);
        border-radius: 22px;
        padding: 26px;
        box-shadow: var(--shadow);
        border: 1px solid #f0f2f5;
        transition: 0.25s ease;
    }

    .category-card {
        min-height: 165px;
    }

    .benefit-card {
        padding: 28px;
    }

    .step-card {
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 24px;
        padding: 30px;
        transition: 0.25s ease;
    }

    .category-card:hover,
    .benefit-card:hover,
    .step-card:hover {
        transform: translateY(-4px);
    }

    .icon-box {
        width: 58px;
        height: 58px;
        border-radius: 16px;
        background: #fbf4e6;
        color: #d98300;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 22px;
    }

    .category-card h3,
    .benefit-card h3 {
        font-size: 22px;
        line-height: 1.4;
        font-weight: 700;
    }

    .category-card p,
    .benefit-card p {
        color: var(--muted);
        font-size: 15px;
        margin-top: 10px;
    }

    .step-top {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 20px;
    }

    .step-number {
        width: 54px;
        height: 54px;
        border-radius: 50%;
        background: var(--accent);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
    }

    .step-top i {
        color: var(--accent);
        font-size: 22px;
    }

    .step-card h3 {
        font-size: 26px;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .step-card p {
        font-size: 17px;
        color: rgba(255,255,255,0.70);
    }

    .benefit-card i {
        font-size: 28px;
        color: #d98300;
        margin-bottom: 18px;
    }

    .cta-box {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-2) 100%);
        border-radius: 30px;
        padding: 60px 40px;
        text-align: center;
        color: var(--white);
        box-shadow: 0 20px 50px rgba(17,22,51,0.18);
    }

    .cta-box h2 {
        font-size: 46px;
        margin-bottom: 14px;
        font-weight: 800;
    }

    .cta-box p {
        max-width: 760px;
        margin: 0 auto 28px;
        font-size: 19px;
        color: rgba(255,255,255,0.76);
    }

    .footer {
        background: #0f1430;
        color: rgba(255,255,255,0.72);
        padding: 34px 0;
        text-align: center;
        font-size: 16px;
    }

    @media (max-width: 1200px) {
        .grid-4 {
            grid-template-columns: repeat(2, 1fr);
        }

        .grid-3 {
            grid-template-columns: repeat(2, 1fr);
        }

        .hero h1 {
            font-size: 60px;
        }
    }

    @media (max-width: 992px) {
        .header-inner {
            flex-direction: column;
            padding: 18px 0;
        }

        .nav {
            flex-wrap: wrap;
            justify-content: center;
            gap: 16px;
        }

        .hero-inner {
            min-height: auto;
        }

        .hero h1 {
            font-size: 46px;
        }

        .hero p {
            font-size: 19px;
        }

        .hero-stats,
        .grid-3 {
            grid-template-columns: 1fr;
        }

        .section-head h2 {
            font-size: 40px;
        }
    }

    @media (max-width: 768px) {
        .grid-4 {
            grid-template-columns: 1fr;
        }

        .hero h1 {
            font-size: 36px;
        }

        .btn-primary,
        .btn-outline {
            width: 100%;
            min-width: auto;
        }

        .section {
            padding: 80px 0;
        }

        .cta-box {
            padding: 42px 24px;
        }

        .cta-box h2 {
            font-size: 34px;
        }
    }

  .vendor-modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(10, 15, 35, 0.65);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    padding: 20px;
    overflow-y: auto;
}

.vendor-modal.show {
    display: flex;
}

.vendor-modal-box {
    position: relative;
    width: 100%;
    animation: modalFade 0.25s ease;
}

.vendor-register-modal-box {
    max-width: 920px;
}

@keyframes modalFade {
    from {
        opacity: 0;
        transform: translateY(15px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.vendor-modal-close {
    position: absolute;
    top: 14px;
    right: 18px;
    border: 0;
    background: transparent;
    font-size: 30px;
    line-height: 1;
    cursor: pointer;
    color: #111633;
    z-index: 2;
}

.register-card {
    background: #fbfbfa;
    border-radius: 24px;
    padding: 28px 28px 30px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.18);
}

.register-head {
    margin-bottom: 22px;
}

.register-head h2 {
    font-size: 40px;
    line-height: 1.1;
    font-weight: 800;
    color: #111633;
    margin-bottom: 8px;
    letter-spacing: 0.3px;
}

.register-head p {
    font-size: 16px;
    color: #667085;
}

.register-form-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px 18px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-size: 15px;
    font-weight: 600;
    color: #111633;
    margin-bottom: 8px;
}

.form-group label span {
    color: #ef4444;
}

.form-group input,
.form-group select {
    width: 100%;
    height: 52px;
    border: 1px solid #d5d9e2;
    border-radius: 14px;
    padding: 0 16px;
    font-size: 15px;
    color: #111633;
    background: #fff;
    outline: none;
    transition: 0.2s ease;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #f5a623;
    box-shadow: 0 0 0 3px rgba(245, 166, 35, 0.12);
}

.form-group input::placeholder {
    color: #98a2b3;
}

.full-row {
    grid-column: 1 / -1;
}

.form-submit {
    display: flex;
    justify-content: flex-end;
    margin-top: 4px;
}

.continue-btn {
    min-width: 180px;
    height: 52px;
    border: none;
    border-radius: 14px;
    background: #f5a623;
    color: #111633;
    font-size: 17px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    cursor: pointer;
    transition: 0.25s ease;
}

.continue-btn:hover {
    background: #e59200;
    transform: translateY(-1px);
}

@media (max-width: 992px) {
    .vendor-register-modal-box {
        max-width: 760px;
    }

    .register-form-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .register-head h2 {
        font-size: 34px;
    }
}

@media (max-width: 768px) {
    .register-card {
        padding: 24px 18px 24px;
    }

    .register-form-grid {
        grid-template-columns: 1fr;
    }

    .form-submit {
        justify-content: stretch;
    }

    .continue-btn {
        width: 100%;
    }

    .register-head h2 {
        font-size: 30px;
    }
}



.alert {
    padding: 12px 16px;
    border-radius: 10px;
    margin-bottom: 18px;
    font-size: 14px;
    font-weight: 500;
}

.alert-success {
    background: #ecfdf3;
    color: #027a48;
    border: 1px solid #abefc6;
}

.alert-error {
    background: #fef3f2;
    color: #b42318;
    border: 1px solid #fecdca;
}

.text-danger {
    color: #dc2626;
    font-size: 13px;
    margin-top: 6px;
    display: block;
}
</style>


<section class="hero" id="top">
    <div class="container hero-inner">
        <div class="hero-content">
            <div class="eyebrow">
                <i class="fa-solid fa-circle-check"></i>
                Verified vendor onboarding platform
            </div>

            <h1>Get Verified Construction Projects in Your Area</h1>

            <p>
                Join ConstructKaro as a trusted service partner and receive genuine,
                location-based project opportunities tailored to your category and expertise.
            </p>

            <div class="hero-actions">
                <a href="javascript:void(0)" class="btn-primary" id="openVendorModal">
                    <i class="fa-regular fa-user"></i>
                    Register as Vendor
                </a>

                <a href="tel:+919999999999" class="btn-outline">
                    <i class="fa-solid fa-phone"></i>
                    Talk to Team
                </a>
            </div>

            <div class="hero-stats">
                <div class="stat-card">
                    <h3>Verified</h3>
                    <p>Focused onboarding for serious service partners</p>
                </div>
                <div class="stat-card">
                    <h3>Category-Based</h3>
                    <p>Relevant project matching by expertise</p>
                </div>
                <div class="stat-card">
                    <h3>Region-Specific</h3>
                    <p>Get leads based on your selected service area</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section-light" id="who-can-join">
    <div class="container">
        <div class="section-head">
            <span>Categories</span>
            <h2>Who Can Join</h2>
            <p>ConstructKaro onboards verified professionals across construction-related categories and services.</p>
        </div>

        <div class="grid-4">
            <div class="category-card">
                <div class="icon-box"><i class="fa-regular fa-building"></i></div>
                <h3>Contractor</h3>
                <p>Civil, residential, commercial, industrial and infrastructure execution experts.</p>
            </div>

            <div class="category-card">
                <div class="icon-box"><i class="fa-regular fa-compass"></i></div>
                <h3>Architect</h3>
                <p>Planning, design, approval support and technical coordination professionals.</p>
            </div>

            <div class="category-card">
                <div class="icon-box"><i class="fa-solid fa-palette"></i></div>
                <h3>Interior Designer</h3>
                <p>Interior planning, fit-out, execution and turnkey design specialists.</p>
            </div>

            <div class="category-card">
                <div class="icon-box"><i class="fa-solid fa-location-dot"></i></div>
                <h3>Surveyor</h3>
                <p>Land survey, drone survey, layout marking and contour survey professionals.</p>
            </div>

            <div class="category-card">
                <div class="icon-box"><i class="fa-solid fa-calculator"></i></div>
                <h3>BOQ / Estimation Expert</h3>
                <p>Quantity takeoff, BOQ, cost estimation and rate analysis specialists.</p>
            </div>

            <div class="category-card">
                <div class="icon-box"><i class="fa-solid fa-flask"></i></div>
                <h3>Testing Lab / Agency</h3>
                <p>Soil, concrete, steel, aggregate and other technical material testing partners.</p>
            </div>

            <div class="category-card">
                <div class="icon-box"><i class="fa-solid fa-shield-halved"></i></div>
                <h3>Structural Auditor / Engineer</h3>
                <p>Audit, structural stability review, repair assessment and technical reporting experts.</p>
            </div>

            <div class="category-card">
                <div class="icon-box"><i class="fa-solid fa-truck"></i></div>
                <h3>Machinery Provider</h3>
                <p>Construction equipment rental, machinery supply and heavy equipment operators.</p>
            </div>

            <div class="category-card">
                <div class="icon-box"><i class="fa-solid fa-border-all"></i></div>
                <h3>Facade Specialist</h3>
                <p>Glass façade, ACP cladding, aluminium work and elevation execution teams.</p>
            </div>

            <div class="category-card">
                <div class="icon-box"><i class="fa-solid fa-fire-flame-curved"></i></div>
                <h3>Welding &amp; Fabrication</h3>
                <p>MS, SS and structural fabrication service providers for site and workshop work.</p>
            </div>

            <div class="category-card">
                <div class="icon-box"><i class="fa-solid fa-scale-balanced"></i></div>
                <h3>Legal / NA Support</h3>
                <p>NA conversion, due diligence, title scrutiny and land-legal support professionals.</p>
            </div>
        </div>
    </div>
</section>

<section class="section section-dark" id="how-it-works">
    <div class="container">
        <div class="section-head">
            <span>Process</span>
            <h2>How It Works</h2>
            <p>Simple onboarding flow designed to verify your profile and connect you with relevant opportunities.</p>
        </div>

        <div class="grid-3">
            <div class="step-card">
                <div class="step-top">
                    <div class="step-number">1</div>
                    <i class="fa-solid fa-user-plus"></i>
                </div>
                <h3>Register your business</h3>
                <p>Fill in your company details, contact information and business profile.</p>
            </div>

            <div class="step-card">
                <div class="step-top">
                    <div class="step-number">2</div>
                    <i class="fa-solid fa-list-check"></i>
                </div>
                <h3>Select your services</h3>
                <p>Choose the categories, sub-categories and project types you handle.</p>
            </div>

            <div class="step-card">
                <div class="step-top">
                    <div class="step-number">3</div>
                    <i class="fa-solid fa-arrow-up-from-bracket"></i>
                </div>
                <h3>Upload documents</h3>
                <p>Submit the required verification and business support documents.</p>
            </div>

            <div class="step-card">
                <div class="step-top">
                    <div class="step-number">4</div>
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h3>Get verified</h3>
                <p>Our team reviews your submission and activates your verified profile.</p>
            </div>

            <div class="step-card">
                <div class="step-top">
                    <div class="step-number">5</div>
                    <i class="fa-regular fa-bell"></i>
                </div>
                <h3>Receive inquiries</h3>
                <p>Get matched with project opportunities based on your service area and category.</p>
            </div>

            <div class="step-card">
                <div class="step-top">
                    <div class="step-number">6</div>
                    <i class="fa-solid fa-briefcase"></i>
                </div>
                <h3>Work as partner</h3>
                <p>Deliver quality work, build credibility and grow with long-term opportunities.</p>
            </div>
        </div>
    </div>
</section>

<section class="section section-light" id="why-join">
    <div class="container">
        <div class="section-head">
            <span>Benefits</span>
            <h2>Why Vendors Join</h2>
            <p>ConstructKaro helps service professionals grow with a transparent and opportunity-focused system.</p>
        </div>

        <div class="grid-3">
            <div class="benefit-card">
                <i class="fa-regular fa-circle-check"></i>
                <h3>Genuine project inquiries</h3>
                <p>Access real and relevant project opportunities from verified customer requirements.</p>
            </div>

            <div class="benefit-card">
                <i class="fa-regular fa-map"></i>
                <h3>Work in your region</h3>
                <p>Receive opportunities based on the city, district and serviceable locations you select.</p>
            </div>

            <div class="benefit-card">
                <i class="fa-solid fa-headphones"></i>
                <h3>Dedicated support team</h3>
                <p>Our team supports you during onboarding, verification and project coordination stages.</p>
            </div>

            <div class="benefit-card">
                <i class="fa-regular fa-eye"></i>
                <h3>Transparent system</h3>
                <p>Clear process, better matching, fair platform structure and no confusing steps.</p>
            </div>

            <div class="benefit-card">
                <i class="fa-solid fa-arrow-trend-up"></i>
                <h3>Long-term growth</h3>
                <p>Build a consistent business pipeline with category-specific construction opportunities.</p>
            </div>

            <div class="benefit-card">
                <i class="fa-solid fa-user-shield"></i>
                <h3>Professional visibility</h3>
                <p>Strengthen your brand presence as a trusted and verified construction service partner.</p>
            </div>
        </div>
    </div>
</section>

<section class="section section-light" id="register" style="padding-top: 0;">
    <div class="container">
        <div class="cta-box">
            <h2>Ready to Join ConstructKaro?</h2>
            <p>
                Register your business, complete your vendor profile, and start receiving
                project opportunities suited to your category and location.
            </p>
            <a href="#" class="btn-primary">
                <i class="fa-regular fa-user"></i>
                Start Vendor Registration
            </a>
        </div>
    </div>
</section>

<!-- <div id="vendorRegisterModal" class="vendor-modal {{ $errors->any() ? 'show' : '' }}">
    <div class="vendor-modal-box vendor-register-modal-box">
        <button type="button" class="vendor-modal-close" id="closeVendorModal">&times;</button>

        <div class="register-card">
            <div class="register-head">
                <h2>Basic Details</h2>
                <p>Tell us about yourself and your business</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('vendor.register.submit') }}" method="POST" class="register-form-grid">
                @csrf

                <div class="form-group">
                    <label>Full Name <span>*</span></label>
                    <input type="text" name="full_name" placeholder="Enter your full name" value="{{ old('full_name') }}" required>
                    @error('full_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Mobile Number <span>*</span></label>
                    <input type="text" name="mobile" placeholder="10-digit mobile" maxlength="10" value="{{ old('mobile') }}" required>
                    @error('mobile')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Email <span>*</span></label>
                    <input type="email" name="email" placeholder="you@example.com" value="{{ old('email') }}" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Company / Firm Name <span>*</span></label>
                    <input type="text" name="company_name" placeholder="Your business name" value="{{ old('company_name') }}" required>
                    @error('company_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>City <span>*</span></label>
                    <input type="text" name="city" placeholder="Enter city" value="{{ old('city') }}" required>
                    @error('city')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Pincode <span>*</span></label>
                    <input type="text" name="pincode" placeholder="Enter pincode" maxlength="6" value="{{ old('pincode') }}" required>
                    @error('pincode')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group full-row">
                    <label>Business Address <span>*</span></label>
                    <input type="text" name="business_address" placeholder="Full address" value="{{ old('business_address') }}" required>
                    @error('business_address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Type of Business Entity <span>*</span></label>
                    <select name="business_entity" required>
                        <option value="">Select</option>
                        <option value="Individual" {{ old('business_entity') == 'Individual' ? 'selected' : '' }}>Individual</option>
                        <option value="Proprietorship" {{ old('business_entity') == 'Proprietorship' ? 'selected' : '' }}>Proprietorship</option>
                        <option value="Partnership" {{ old('business_entity') == 'Partnership' ? 'selected' : '' }}>Partnership</option>
                        <option value="Pvt Ltd" {{ old('business_entity') == 'Pvt Ltd' ? 'selected' : '' }}>Pvt Ltd</option>
                        <option value="LLP" {{ old('business_entity') == 'LLP' ? 'selected' : '' }}>LLP</option>
                        <option value="Other" {{ old('business_entity') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('business_entity')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-submit full-row">
                    <button type="submit" class="continue-btn">
                        Continue <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> -->
<div id="vendorRegisterModal" class="vendor-modal {{ $errors->any() ? 'show' : '' }}">
    <div class="vendor-modal-box vendor-register-modal-box">
        <button type="button" class="vendor-modal-close" id="closeVendorModal">&times;</button>

        <div class="register-card">
            <div class="register-head">
                <h2>Basic Details</h2>
                <p>Tell us about yourself and your business</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('vendor.register.submit') }}" method="POST" class="register-form-grid">
                @csrf

                <div class="form-group">
                    <label>Full Name <span>*</span></label>
                    <input type="text" name="full_name" placeholder="Enter your full name" value="{{ old('full_name') }}" required>
                    @error('full_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Mobile Number <span>*</span></label>
                    <input type="text" name="mobile" id="registerMobile" placeholder="10-digit mobile" maxlength="10" value="{{ old('mobile') }}" required>
                    @error('mobile')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Email <span>*</span></label>
                    <input type="email" name="email" placeholder="you@example.com" value="{{ old('email') }}" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Company / Firm Name <span>*</span></label>
                    <input type="text" name="company_name" placeholder="Your business name" value="{{ old('company_name') }}" required>
                    @error('company_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>City <span>*</span></label>
                    <input type="text" name="city" placeholder="Enter city" value="{{ old('city') }}" required>
                    @error('city')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Pincode <span>*</span></label>
                    <input type="text" name="pincode" placeholder="Enter pincode" maxlength="6" value="{{ old('pincode') }}" required>
                    @error('pincode')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group full-row">
                    <label>Business Address <span>*</span></label>
                    <input type="text" name="business_address" placeholder="Full address" value="{{ old('business_address') }}" required>
                    @error('business_address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Type of Business Entity <span>*</span></label>
                    <select name="business_entity" required>
                        <option value="">Select</option>
                        <option value="Individual" {{ old('business_entity') == 'Individual' ? 'selected' : '' }}>Individual</option>
                        <option value="Proprietorship" {{ old('business_entity') == 'Proprietorship' ? 'selected' : '' }}>Proprietorship</option>
                        <option value="Partnership" {{ old('business_entity') == 'Partnership' ? 'selected' : '' }}>Partnership</option>
                        <option value="Pvt Ltd" {{ old('business_entity') == 'Pvt Ltd' ? 'selected' : '' }}>Pvt Ltd</option>
                        <option value="LLP" {{ old('business_entity') == 'LLP' ? 'selected' : '' }}>LLP</option>
                        <option value="Other" {{ old('business_entity') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('business_entity')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Password <span>*</span></label>
                    <input type="password" name="password" placeholder="Enter password" required>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Confirm Password <span>*</span></label>
                    <input type="password" name="password_confirmation" placeholder="Confirm password" required>
                </div>

                <div class="form-submit full-row">
                    <button type="submit" class="continue-btn">
                        Continue <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const openVendorModal = document.getElementById('openVendorModal');
    const closeVendorModal = document.getElementById('closeVendorModal');
    const vendorRegisterModal = document.getElementById('vendorRegisterModal');

    if (vendorRegisterModal && vendorRegisterModal.classList.contains('show')) {
        document.body.style.overflow = 'hidden';
    }

    if (openVendorModal) {
        openVendorModal.addEventListener('click', function () {
            vendorRegisterModal.classList.add('show');
            document.body.style.overflow = 'hidden';
        });
    }

    if (closeVendorModal) {
        closeVendorModal.addEventListener('click', function () {
            vendorRegisterModal.classList.remove('show');
            document.body.style.overflow = '';
        });
    }

    window.addEventListener('click', function (e) {
        if (e.target === vendorRegisterModal) {
            vendorRegisterModal.classList.remove('show');
            document.body.style.overflow = '';
        }
    });
});
</script>
<!-- <script>
document.addEventListener('DOMContentLoaded', function () {
    const openVendorModal = document.getElementById('openVendorModal');
    const closeVendorModal = document.getElementById('closeVendorModal');
    const vendorRegisterModal = document.getElementById('vendorRegisterModal');

    openVendorModal.addEventListener('click', function () {
        vendorRegisterModal.classList.add('show');
        document.body.style.overflow = 'hidden';
    });

    closeVendorModal.addEventListener('click', function () {
        vendorRegisterModal.classList.remove('show');
        document.body.style.overflow = '';
    });

    window.addEventListener('click', function (e) {
        if (e.target === vendorRegisterModal) {
            vendorRegisterModal.classList.remove('show');
            document.body.style.overflow = '';
        }
    });
});
</script> -->
@endsection