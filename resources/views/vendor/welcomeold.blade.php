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
    background: rgba(0,0,0,0.55);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.vendor-modal.show {
    display: flex;
}

.vendor-modal-box {
    width: 100%;
    max-width: 440px;
    background: #fff;
    border-radius: 20px;
    padding: 30px;
    position: relative;
    box-shadow: 0 20px 60px rgba(0,0,0,0.18);
}

.vendor-modal-box h3 {
    font-size: 28px;
    margin-bottom: 8px;
    color: #111633;
}

.vendor-modal-box p {
    font-size: 15px;
    color: #667085;
    margin-bottom: 22px;
}

.vendor-modal-close {
    position: absolute;
    top: 12px;
    right: 16px;
    border: 0;
    background: transparent;
    font-size: 28px;
    cursor: pointer;
    color: #111633;
}

.form-group {
    margin-bottom: 18px;
}

.form-group label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 8px;
    color: #111633;
}

.form-group input {
    width: 100%;
    height: 52px;
    border: 1px solid #dcdfe6;
    border-radius: 12px;
    padding: 0 16px;
    font-size: 15px;
    outline: none;
}

.form-group input:focus {
    border-color: #f5a623;
}

.modal-btn {
    width: 100%;
    height: 52px;
    border: 0;
    border-radius: 12px;
    background: #f5a623;
    color: #111633;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
}

.auth-message {
    margin-top: 15px;
    font-size: 14px;
    font-weight: 600;
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

<div id="vendorAuthModal" class="vendor-modal">
    <div class="vendor-modal-box">
        <button type="button" class="vendor-modal-close" id="closeVendorModal">&times;</button>

        <div id="mobileStep">
            <h3>Vendor Login / Registration</h3>
            <p>Enter your mobile number to continue</p>

            <form id="sendOtpForm">
                @csrf
                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" name="mobile" id="vendorMobile" maxlength="10" placeholder="Enter 10 digit mobile number" required>
                </div>

                <button type="submit" class="modal-btn">Send OTP</button>
            </form>
        </div>

        <div id="otpStep" style="display: none;">
            <h3>Verify OTP</h3>
            <p>Enter the OTP sent to your mobile number</p>

            <form id="verifyOtpForm">
                @csrf
                <input type="hidden" name="mobile" id="otpMobileHidden">

                <div class="form-group">
                    <label>OTP</label>
                    <input type="text" name="otp" id="vendorOtp" maxlength="6" placeholder="Enter OTP" required>
                </div>

                <button type="submit" class="modal-btn">Verify OTP</button>
            </form>
        </div>

        <div id="authMessage" class="auth-message"></div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const openVendorModal = document.getElementById('openVendorModal');
    const closeVendorModal = document.getElementById('closeVendorModal');
    const vendorAuthModal = document.getElementById('vendorAuthModal');

    const sendOtpForm = document.getElementById('sendOtpForm');
    const verifyOtpForm = document.getElementById('verifyOtpForm');

    const mobileStep = document.getElementById('mobileStep');
    const otpStep = document.getElementById('otpStep');
    const authMessage = document.getElementById('authMessage');

    openVendorModal?.addEventListener('click', function () {
        vendorAuthModal.classList.add('show');
    });

    closeVendorModal?.addEventListener('click', function () {
        vendorAuthModal.classList.remove('show');
    });

    window.addEventListener('click', function (e) {
        if (e.target === vendorAuthModal) {
            vendorAuthModal.classList.remove('show');
        }
    });

    sendOtpForm?.addEventListener('submit', function (e) {
        e.preventDefault();

        const mobile = document.getElementById('vendorMobile').value;

        fetch("{{ route('vendor.sendOtp') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ mobile })
        })
        .then(async res => ({ ok: res.ok, data: await res.json() }))
        .then(({ ok, data }) => {
            authMessage.innerHTML = data.message;
            authMessage.style.color = ok ? 'green' : 'red';

            if (data.status) {
                document.getElementById('otpMobileHidden').value = mobile;
                mobileStep.style.display = 'none';
                otpStep.style.display = 'block';
            }
        })
        .catch(() => {
            authMessage.innerHTML = 'Something went wrong while sending OTP.';
            authMessage.style.color = 'red';
        });
    });

    verifyOtpForm?.addEventListener('submit', function (e) {
        e.preventDefault();

        const mobile = document.getElementById('otpMobileHidden').value;
        const otp = document.getElementById('vendorOtp').value;

        fetch("{{ route('vendor.verifyOtp') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ mobile, otp })
        })
        .then(async res => ({ ok: res.ok, data: await res.json() }))
        .then(({ ok, data }) => {
            authMessage.innerHTML = data.message;
            authMessage.style.color = ok ? 'green' : 'red';

            if (data.status && data.redirect) {
                window.location.href = data.redirect;
            }
        })
        .catch(() => {
            authMessage.innerHTML = 'Something went wrong while verifying OTP.';
            authMessage.style.color = 'red';
        });
    });
});
</script>
@endsection