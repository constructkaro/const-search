<style>
.header,
.header *,
.location-modal,
.location-modal * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Segoe UI", sans-serif;
}

.header {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 9998;
    width: 100%;
    height: 76px;
    background: rgba(255,255,255,.96);
    padding: 0 28px;
    display: flex;
    align-items: center;
    border-bottom: 1px solid rgba(20,34,53,.08);
    box-shadow: 0 10px 30px rgba(16,36,58,0.08);
    backdrop-filter: blur(12px);
}

body {
    padding-top: 76px;
}

.header .container {
    width: 100%;
    max-width: 1600px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    gap: 24px;
    min-height: 76px;
}

.header .logo {
    flex: 0 0 auto;
    display: flex;
    align-items: center;
}

/* .header .logo img {
    width: 190px;
    max-height: 58px;
    object-fit: contain;
    display: block;
} */

.header .logo picture,
.header .logo img {
    width: 170px;
    max-height: 62px;
    object-fit: contain;
    display: block;
}

.header .location {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 42px;
    background: #f3f6f8;
    padding: 8px 16px;
    border-radius: 999px;
    gap: 8px;
    flex-shrink: 0;
    margin-left: auto;
    cursor: pointer;
    border: 1px solid rgba(28,44,62,.08);
    transition: background .2s ease, box-shadow .2s ease, transform .2s ease;
}

.header .location:hover {
    background: #fff7f1;
    box-shadow: 0 8px 18px rgba(16,36,58,.08);
    transform: translateY(-1px);
}

.header .location svg {
    width: 24px;
    height: 24px;
    display: block;
}

.header #selectedLocationText {
    font-size: 14px;
    color: #263445;
    max-width: 190px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.header .nav {
    display: flex;
    align-items: center;
    gap: 24px;
    margin-left: 0;
    flex-shrink: 0;
}

.header .nav a,
.header .nav button {
    text-decoration: none;
    color: #526171;
    font-size: 14px;
    font-weight: 600;
    line-height: 1;
    position: relative;
    white-space: nowrap;
    display: inline-flex;
    align-items: center;
    min-height: 42px;
    border: none;
    background: transparent;
    cursor: pointer;
    font-family: inherit;
}

.header .nav a.active,
.header .nav button:hover {
    color: #155f9f;
    font-weight: 800;
}

.header .nav a.active::after {
    content: "";
    position: absolute;
    width: 100%;
    height: 2px;
    background: #d96a1f;
    bottom: 2px;
    left: 0;
}

.header .header-right {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
    flex-shrink: 0;
}

.header .header-login-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 150px;
    height: 42px;
    padding: 0 18px;
    border-radius: 999px;
    text-decoration: none;
    color: #fff;
    font-size: 14px;
    font-weight: 700;
    background: linear-gradient(180deg, #f08b39 0%, #d96a1f 100%);
    box-shadow: 0 6px 14px rgba(223, 113, 34, 0.22);
    white-space: nowrap;
    transition: transform .22s ease, box-shadow .22s ease, opacity .22s ease;
}

.header .header-login-btn:hover {
    color: #fff;
    opacity: .94;
    text-decoration: none;
    transform: translateY(-1px);
    box-shadow: 0 10px 20px rgba(223, 113, 34, 0.26);
}

.header .customer-dropdown-wrap {
    position: relative;
}

.header .customer-profile-btn {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    border: none;
    background: #1c2c3e;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: transform .22s ease, box-shadow .22s ease, background .22s ease;
}

.header .customer-profile-btn:hover {
    background: #263c54;
    transform: translateY(-1px);
    box-shadow: 0 8px 18px rgba(28,44,62,.18);
}

.header .customer-profile-btn svg {
    width: 22px;
    height: 22px;
}

.header .customer-dropdown-menu {
    position: absolute;
    right: 0;
    top: 52px;
    width: 170px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 12px 35px rgba(0,0,0,0.15);
    padding: 8px;
    display: none;
    z-index: 9999;
}

.header .customer-dropdown-menu.show {
    display: block;
}

.header .customer-dropdown-menu a,
.header .customer-dropdown-menu button {
    width: 100%;
    display: block;
    padding: 10px 12px;
    border: none;
    background: transparent;
    text-align: left;
    text-decoration: none;
    color: #333;
    font-size: 14px;
    cursor: pointer;
    border-radius: 8px;
}

.header .customer-dropdown-menu a:hover,
.header .customer-dropdown-menu button:hover {
    background: #f5f5f5;
}

.header .menu-toggle {
    width: 42px;
    height: 42px;
    border: none;
    background: #fff;
    color: #1c2c3e;
    border-radius: 50%;
    display: none;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0,0,0,.08);
}

.header .menu-toggle svg {
    width: 24px;
    height: 24px;
}

/* Location Modal */
.location-modal {
    display: none;
    position: fixed;
    z-index: 10000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100vh;
    background: rgba(0,0,0,0.55);
}

.location-modal-content {
    background: #fff;
    width: 460px;
    max-width: 92%;
    margin: 110px auto;
    padding: 25px;
    border-radius: 16px;
    position: relative;
    box-shadow: 0 20px 50px rgba(0,0,0,0.25);
}

.location-modal-content h3 {
    font-size: 22px;
    color: #1c2c3e;
    margin-bottom: 8px;
}

.location-modal-content small {
    color: #666;
}

.close-location-modal {
    position: absolute;
    right: 18px;
    top: 12px;
    font-size: 30px;
    cursor: pointer;
    color: #333;
}

.location-input {
    width: 100%;
    padding: 13px 15px;
    border: 1px solid #ddd;
    border-radius: 10px;
    margin-top: 18px;
    font-size: 15px;
    outline: none;
}

.location-input:focus {
    border-color: #E87124;
}

.location-suggestions {
    margin-top: 10px;
    max-height: 260px;
    overflow-y: auto;
    border-radius: 10px;
    border: 1px solid #eee;
    display: none;
}

.location-suggestion-item {
    padding: 12px 14px;
    cursor: pointer;
    border-bottom: 1px solid #f1f1f1;
    font-size: 14px;
    color: #333;
}

.location-suggestion-item:hover {
    background: #fff4ec;
}

.location-suggestion-item:last-child {
    border-bottom: none;
}

#locationMessage {
    margin-top: 15px;
    font-weight: 600;
    font-size: 14px;
}

.location-powered-by {
    margin-top: 18px;
    padding-top: 14px;
    border-top: 1px solid #f0f0f0;
    text-align: center;
    color: #8a8a8a;
    font-family: Arial, sans-serif;
    font-size: 13px;
    font-weight: 400;
}

.google-wordmark {
    display: inline-flex;
    align-items: center;
    gap: 0;
    margin-left: 4px;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: -0.2px;
}

.google-wordmark .g-blue { color: #4285f4; }
.google-wordmark .g-red { color: #ea4335; }
.google-wordmark .g-yellow { color: #fbbc05; }
.google-wordmark .g-green { color: #34a853; }

/* Coming Soon Box */
#comingSoonLocationBox {
    display: none;
    max-width: 1100px;
    margin: 40px auto;
    padding: 35px 20px;
    background: #fff4ec;
    border: 1px solid #ffd6bd;
    border-radius: 18px;
    text-align: center;
}

#comingSoonLocationBox h2 {
    color: #1c2c3e;
    font-size: 28px;
    margin-bottom: 10px;
}

#comingSoonLocationBox p {
    color: #555;
    font-size: 16px;
}

/* ERP Enquiry Modal */
.erp-modal {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 10001;
    width: 100%;
    min-height: 100vh;
    padding: 96px 18px 28px;
    background: rgba(8, 18, 32, .64);
    backdrop-filter: blur(8px);
    overflow-y: auto;
}

.erp-modal.active {
    display: block;
}

.erp-modal-content {
    width: min(100%, 760px);
    margin: 0 auto;
    overflow: hidden;
    border-radius: 8px;
    background: #fff;
    box-shadow: 0 28px 80px rgba(0,0,0,.28);
}

.erp-modal-head {
    position: relative;
    padding: 28px 32px;
    background:
        linear-gradient(120deg, rgba(20,34,53,.95), rgba(21,95,159,.88)),
        url("{{ asset('images/banner.webp') }}") center/cover;
    color: #fff;
}

.erp-modal-head h3 {
    max-width: 580px;
    margin: 0 42px 8px 0;
    font-size: 28px;
    font-weight: 900;
    line-height: 1.18;
}

.erp-modal-head p {
    max-width: 570px;
    margin: 0;
    color: rgba(255,255,255,.82);
    font-size: 14px;
    line-height: 1.55;
}

.erp-modal-close {
    position: absolute;
    top: 18px;
    right: 20px;
    width: 36px;
    height: 36px;
    border: 1px solid rgba(255,255,255,.28);
    border-radius: 50%;
    background: rgba(255,255,255,.12);
    color: #fff;
    font-size: 25px;
    line-height: 1;
    cursor: pointer;
}

.erp-form {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px;
    padding: 28px 32px 32px;
}

.erp-form-group {
    display: flex;
    flex-direction: column;
    gap: 7px;
}

.erp-form-group.full {
    grid-column: 1 / -1;
}

.erp-form-group label {
    color: #263445;
    font-size: 13px;
    font-weight: 800;
}

.erp-form-group input,
.erp-form-group select,
.erp-form-group textarea {
    width: 100%;
    border: 1px solid #dbe5ee;
    border-radius: 8px;
    background: #f8fafc;
    color: #1b2430;
    font-size: 14px;
    outline: none;
    transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
}

.erp-form-group input,
.erp-form-group select {
    height: 46px;
    padding: 0 13px;
}

.erp-form-group textarea {
    min-height: 108px;
    padding: 12px 13px;
    resize: vertical;
}

.erp-form-group input:focus,
.erp-form-group select:focus,
.erp-form-group textarea:focus {
    border-color: #2b84c6;
    background: #fff;
    box-shadow: 0 0 0 4px rgba(43,132,198,.12);
}

.erp-submit-btn {
    min-height: 48px;
    border: none;
    border-radius: 8px;
    background: linear-gradient(180deg, #f08b39 0%, #d96a1f 100%);
    color: #fff;
    font-size: 15px;
    font-weight: 900;
    cursor: pointer;
    box-shadow: 0 12px 24px rgba(217,106,31,.22);
    transition: transform .2s ease, box-shadow .2s ease, opacity .2s ease;
}

.erp-submit-btn:hover {
    opacity: .94;
    transform: translateY(-1px);
    box-shadow: 0 16px 30px rgba(217,106,31,.28);
}

@media (max-width: 991px) {
    .header {
        height: auto;
        min-height: 76px;
        padding: 10px 16px;
    }

    .header .container {
        flex-wrap: wrap;
        gap: 14px;
        min-height: 56px;
    }

    .header .nav {
        width: 100%;
        order: 5;
        display: none;
        flex-direction: column;
        align-items: flex-start;
        gap: 14px;
        padding: 15px 0 5px;
        margin-left: 0;
    }

    .header .nav.show {
        display: flex;
    }

    .header .nav a,
    .header .nav button {
        min-height: 34px;
    }

    .header .menu-toggle {
        display: flex;
    }

    .header .location {
        order: 4;
        width: 100%;
        margin-left: 0;
        justify-content: center;
        min-height: 42px;
    }

    .header .logo picture,
    .header .logo img {
        width: 140px;
        max-height: 54px;
    }
}

@media (max-width: 576px) {
    .header {
        padding: 9px 12px;
    }

    .header .container {
        gap: 8px;
    }

    .header .header-login-btn {
        min-width: auto;
        height: 38px;
        padding: 0 10px;
        font-size: 12px;
    }

    .header .logo picture,
    .header .logo img {
        width: 112px;
        max-height: 46px;
    }

    .header .header-right {
        gap: 8px;
    }

    .header .menu-toggle,
    .header .customer-profile-btn {
        width: 38px;
        height: 38px;
    }

    .header .location {
        padding: 6px 10px;
    }

    .header #selectedLocationText {
        max-width: calc(100vw - 94px);
        font-size: 13px;
    }

    .location-modal-content {
        margin: 90px auto;
    }

    .erp-modal {
        padding-top: 88px;
    }

    .erp-modal-head,
    .erp-form {
        padding-left: 20px;
        padding-right: 20px;
    }

    .erp-modal-head h3 {
        font-size: 23px;
    }

    .erp-form {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 360px) {
    .header .logo picture,
    .header .logo img {
        width: 104px;
    }

    .header .header-login-btn {
        padding: 0 8px;
        font-size: 11px;
    }
}
</style>

<header class="header">
    <div class="container">

        <div class="logo">
            <a href="{{ url('/') }}">
                <picture>
                    <source srcset="{{ asset('images/logo.webp') }}" type="image/webp">
                    <img src="{{ asset('images/logo.png') }}" alt="ConstructKaro" width="215" height="102" decoding="async">
                </picture>
            </a>
        </div>

        <div class="location" id="openLocationModal">
            <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                    <path d="M9.19193 10.6396C9.43138 10.5147 9.7131 9.75879 9.87955 9.50504C10.0567 9.23492 10.2161 8.95172 10.4102 8.67731C10.4546 8.61449 10.6595 8.2018 10.7326 8.11485C10.9685 8.11844 10.8515 7.83301 10.9983 7.71606C11.1119 7.62563 11.2802 7.47727 11.4043 7.35512C12.4699 6.30629 13.6714 5.33907 15.0069 4.6575C15.471 4.425 16.3142 4.18047 16.8244 4.03203C17.0568 3.96446 17.3756 3.7153 17.5172 3.7099C18.4051 3.67605 19.463 3.56207 20.3435 3.6022C21.2852 3.64513 21.7369 3.70787 22.6754 3.63485C23.5683 3.81198 24.571 4.16383 25.3765 4.58457C26.7009 5.27637 28.6089 6.86114 29.4266 8.08957C31.2526 10.8327 32.041 13.911 31.3781 17.1736C30.6121 20.9433 28.772 24.2545 26.7491 27.4782C26.3429 28.1257 25.9728 28.7896 25.5428 29.4229C25.0572 30.1381 24.4962 30.8014 24.0059 31.517C23.4609 32.3125 21.5086 35.0912 20.7765 35.5673C20.4664 35.7689 20.0267 35.8008 19.6724 35.725C19.3763 35.6617 19.1104 35.4839 18.8924 35.2789C18.5848 34.9898 18.3241 34.6389 18.0569 34.3124C17.177 33.2374 16.4047 32.1077 15.6036 30.9755C15.0828 30.2397 14.5181 29.5582 14.0361 28.7924C11.4529 24.6875 8.26064 19.5643 8.40408 14.5613C8.42131 13.9592 8.45638 13.3565 8.59068 12.7676C8.7456 12.0882 8.8722 11.2598 9.19193 10.6396ZM15.9272 14.2896C15.6339 14.9098 15.5237 15.2597 15.8699 15.8888C15.9387 16.0138 15.8887 16.1545 16.0603 16.2542C16.6946 18.247 18.7172 19.4522 20.7717 19.0615C22.8261 18.6709 24.2653 16.8075 24.1238 14.7209C23.9824 12.6345 22.3051 10.9822 20.2167 10.8723C18.1283 10.7624 16.2868 12.2295 15.9272 14.2896Z" fill="#E87124"/>
                </svg>
            </span>

            <span id="selectedLocationText">Select Location</span>
        </div>

        <nav class="nav" id="mainNav">
            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
            <a href="{{ route('aboutus') }}" class="{{ request()->routeIs('aboutus') ? 'active' : '' }}">About Us</a>
            <a href="{{ route('completed.projects') }}" class="{{ request()->routeIs('completed.projects') ? 'active' : '' }}">Projects</a>
            <a href="{{ route('knowledgehub') }}" class="{{ request()->routeIs('knowledgehub') || request()->routeIs('case-study.*') || request()->routeIs('blogsinsights*') || request()->routeIs('constructionarticle') || request()->routeIs('chooserightcontractor') || request()->routeIs('differentconsultant') ? 'active' : '' }}">Constructshala</a>
            <button type="button" id="openErpModalBtn">ERP Enquiry</button>
        </nav>

        <div class="header-right">
            @if(session('customer_logged_in'))

                <div class="customer-dropdown-wrap">
                    <button type="button" class="customer-profile-btn" id="customerProfileBtn" aria-label="Open customer menu">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5zm0 2c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5z"/>
                        </svg>
                    </button>

                    <div class="customer-dropdown-menu" id="customerDropdownMenu">
                        <a href="{{ route('myorder') }}">My Orders</a>
                        <a href="{{ route('customer.profile') }}">My Profile</a>

                        <form method="GET" action="{{ route('customer.logout') }}">
                            <button type="submit">Log Out</button>
                        </form>
                    </div>
                </div>

            @else
                <a href="{{ route('post') }}" class="header-login-btn open-customer-login-modal" data-redirect="{{ route('post') }}">
                    Login / Sign Up
                </a>
            @endif

            <button class="menu-toggle" id="menuToggleBtn" type="button" aria-label="Open navigation menu">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round">
                    <path d="M4 7H20"></path>
                    <path d="M4 12H20"></path>
                    <path d="M4 17H20"></path>
                </svg>
            </button>
        </div>

    </div>
</header>

<div id="locationModal" class="location-modal">
    <div class="location-modal-content">
        <span class="close-location-modal" id="closeLocationModal">&times;</span>

        <h3>Select Your Location</h3>
        <small>Search your area, city or pincode</small>

        <input
            type="text"
            id="locationInput"
            placeholder="Example: Kharghar, Navi Mumbai or 410210"
            class="location-input"
            autocomplete="off"
        >

        <div id="locationSuggestions" class="location-suggestions"></div>

        <p id="locationMessage"></p>

        <div class="location-powered-by">
            powered by
            <span class="google-wordmark" aria-label="Google">
                <span class="g-blue">G</span><span class="g-red">o</span><span class="g-yellow">o</span><span class="g-blue">g</span><span class="g-green">l</span><span class="g-red">e</span>
            </span>
        </div>
    </div>
</div>

<div id="erpEnquiryModal" class="erp-modal" aria-hidden="true">
    <div class="erp-modal-content" role="dialog" aria-modal="true" aria-labelledby="erpModalTitle">
        <div class="erp-modal-head">
            <button type="button" class="erp-modal-close" id="closeErpModalBtn" aria-label="Close ERP enquiry form">&times;</button>
            <h3 id="erpModalTitle">ERP Requirement Enquiry</h3>
            <p>Share your ERP requirement and our team will connect with you for the right construction management solution.</p>
        </div>

        <form class="erp-form" method="POST" action="{{ route('construction.requirement.store') }}">
            @csrf
            <input type="hidden" name="services[]" value="ERP Enquiry">
            <input type="hidden" name="planning_timeframe" value="ERP requirement">

            <div class="erp-form-group">
                <label for="erpFullName">Full Name</label>
                <input type="text" id="erpFullName" name="full_name" required autocomplete="name">
            </div>

            <div class="erp-form-group">
                <label for="erpMobile">Mobile Number</label>
                <input type="tel" id="erpMobile" name="mobile" required pattern="[0-9]{10}" maxlength="10" inputmode="numeric" autocomplete="tel">
            </div>

            <div class="erp-form-group">
                <label for="erpEmail">Email</label>
                <input type="email" id="erpEmail" name="email" autocomplete="email">
            </div>

            <div class="erp-form-group">
                <label for="erpCity">City</label>
                <input type="text" id="erpCity" name="city" autocomplete="address-level2">
            </div>

            <div class="erp-form-group">
                <label for="erpCompany">Company / Project Name</label>
                <input type="text" id="erpCompany" name="house_name">
            </div>

            <div class="erp-form-group">
                <label for="erpRequirementType">ERP Requirement</label>
                <select id="erpRequirementType" name="area">
                    <option value="">Select requirement</option>
                    <option value="Project tracking ERP">Project tracking ERP</option>
                    <option value="Vendor management ERP">Vendor management ERP</option>
                    <option value="Billing and BOQ ERP">Billing and BOQ ERP</option>
                    <option value="Inventory and material ERP">Inventory and material ERP</option>
                    <option value="Complete construction ERP">Complete construction ERP</option>
                    <option value="Other ERP requirement">Other ERP requirement</option>
                </select>
            </div>

            <div class="erp-form-group full">
                <label for="erpDescription">Requirement Details</label>
                <textarea id="erpDescription" name="project_description" placeholder="Tell us what you want to manage with ERP: projects, vendors, billing, inventory, site updates, reports, etc."></textarea>
            </div>

            <button type="submit" class="erp-submit-btn">Submit ERP Enquiry</button>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {

    const GOOGLE_MAPS_KEY = @json(config('services.google_maps.browser_key'));

    const openLocationModal = document.getElementById("openLocationModal");
    const locationModal = document.getElementById("locationModal");
    const closeLocationModal = document.getElementById("closeLocationModal");
    const locationInput = document.getElementById("locationInput");
    const locationSuggestions = document.getElementById("locationSuggestions");
    const locationMessage = document.getElementById("locationMessage");
    const selectedLocationText = document.getElementById("selectedLocationText");
    const openErpModalBtn = document.getElementById("openErpModalBtn");
    const erpEnquiryModal = document.getElementById("erpEnquiryModal");
    const closeErpModalBtn = document.getElementById("closeErpModalBtn");
    const erpFullName = document.getElementById("erpFullName");

    const mainServicesSection = document.getElementById("mainServicesSection");
    const exploreServicesSection = document.getElementById("exploreServicesSection");
    const comingSoonLocationBox = document.getElementById("comingSoonLocationBox");

    function showServices() {
        if (mainServicesSection) mainServicesSection.style.display = "block";
        if (exploreServicesSection) exploreServicesSection.style.display = "block";
        if (comingSoonLocationBox) comingSoonLocationBox.style.display = "none";
    }

    function showComingSoon() {
        if (mainServicesSection) mainServicesSection.style.display = "none";
        if (exploreServicesSection) exploreServicesSection.style.display = "none";
        if (comingSoonLocationBox) comingSoonLocationBox.style.display = "block";
    }

    function hideBothSections() {
        if (mainServicesSection) mainServicesSection.style.display = "none";
        if (exploreServicesSection) exploreServicesSection.style.display = "none";
        if (comingSoonLocationBox) comingSoonLocationBox.style.display = "none";
    }

    hideBothSections();

    const savedLocation = localStorage.getItem("selected_location_text");
    const savedLocationAllowed = localStorage.getItem("location_allowed");

    if (savedLocation) {
        selectedLocationText.innerText = savedLocation;

        if (savedLocationAllowed === "yes") {
            showServices();
        } else if (savedLocationAllowed === "no") {
            showComingSoon();
        }
    } else {
        showServices();
    }

    openLocationModal.addEventListener("click", function () {
        locationModal.style.display = "block";
        locationInput.focus();
        loadGooglePlaces();
    });

    closeLocationModal.addEventListener("click", function () {
        locationModal.style.display = "none";
    });

    window.addEventListener("click", function (e) {
        if (e.target === locationModal) {
            locationModal.style.display = "none";
        }

        if (e.target === erpEnquiryModal) {
            closeErpModal();
        }
    });

    function openErpModal() {
        if (!erpEnquiryModal) return;
        erpEnquiryModal.classList.add("active");
        erpEnquiryModal.setAttribute("aria-hidden", "false");
        document.body.style.overflow = "hidden";
        if (mainNav) mainNav.classList.remove("show");

        setTimeout(function () {
            if (erpFullName) erpFullName.focus();
        }, 80);
    }

    function closeErpModal() {
        if (!erpEnquiryModal) return;
        erpEnquiryModal.classList.remove("active");
        erpEnquiryModal.setAttribute("aria-hidden", "true");
        document.body.style.overflow = "";
    }

    if (openErpModalBtn) {
        openErpModalBtn.addEventListener("click", openErpModal);
    }

    if (closeErpModalBtn) {
        closeErpModalBtn.addEventListener("click", closeErpModal);
    }

    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape" && erpEnquiryModal && erpEnquiryModal.classList.contains("active")) {
            closeErpModal();
        }
    });

    let typingTimer = null;

    function checkTypedLocationSearch(search) {
        const cleanSearch = (search || "").trim();

        if (!cleanSearch) {
            return;
        }

        if (/^[0-9]{6}$/.test(cleanSearch)) {
            checkLocationInDatabase("", "", cleanSearch, cleanSearch);
            return;
        }

        checkLocationInDatabase(cleanSearch, cleanSearch, "", cleanSearch);
    }

    locationInput.addEventListener("input", function () {
        const search = this.value.trim();

        locationMessage.innerHTML = "";
        locationSuggestions.innerHTML = "";
        locationSuggestions.style.display = "none";

        clearTimeout(typingTimer);

        if (search.length < 3) {
            return;
        }

        typingTimer = setTimeout(function () {
            if (/^[0-9]{6}$/.test(search)) {
                locationSuggestions.innerHTML = "";
                locationSuggestions.style.display = "none";
                checkTypedLocationSearch(search);
                return;
            }

            fetchGoogleLocationSuggestions(search);
        }, 450);
    });

    function loadGooglePlaces(callback) {
        if (window.google && google.maps && google.maps.places) {
            if (callback) callback();
            return;
        }

        if (!GOOGLE_MAPS_KEY) {
            locationMessage.style.color = "red";
            locationMessage.innerHTML = "Google Maps API key is not configured.";
            return;
        }

        if (window.constructKaroGoogleMapsLoading) {
            window.constructKaroGoogleMapsQueue.push(callback);
            return;
        }

        window.constructKaroGoogleMapsLoading = true;
        window.constructKaroGoogleMapsQueue = [callback];
        window.constructKaroGoogleMapsReady = function () {
            window.constructKaroGoogleMapsLoading = false;
            window.constructKaroGoogleMapsQueue.forEach(function (queuedCallback) {
                if (queuedCallback) queuedCallback();
            });
            window.constructKaroGoogleMapsQueue = [];
        };

        const script = document.createElement("script");
        script.src = `https://maps.googleapis.com/maps/api/js?key=${encodeURIComponent(GOOGLE_MAPS_KEY)}&libraries=places&loading=async&callback=constructKaroGoogleMapsReady`;
        script.async = true;
        script.defer = true;
        script.onerror = function () {
            window.constructKaroGoogleMapsLoading = false;
            locationMessage.style.color = "red";
            locationMessage.innerHTML = "Google location service failed to load.";
        };
        document.head.appendChild(script);
    }

    function fetchGoogleLocationSuggestions(search) {
        locationMessage.style.color = "#555";
        locationMessage.innerHTML = "Searching location...";

        loadGooglePlaces(async function () {
            try {
                const { AutocompleteSuggestion, AutocompleteSessionToken } = await google.maps.importLibrary("places");
                const sessionToken = new AutocompleteSessionToken();
                const response = await AutocompleteSuggestion.fetchAutocompleteSuggestions({
                    input: search,
                    includedRegionCodes: ["in"],
                    sessionToken: sessionToken
                });
                const suggestions = response.suggestions || [];

                locationMessage.innerHTML = "";

                if (suggestions.length === 0) {
                    locationMessage.style.color = "red";
                    locationMessage.innerHTML = "No Google suggestion found. Checking city availability...";
                    checkTypedLocationSearch(search);
                    return;
                }

                locationSuggestions.innerHTML = "";
                locationSuggestions.style.display = "block";

                suggestions.slice(0, 8).forEach(function (suggestion) {
                    const prediction = suggestion.placePrediction;

                    if (!prediction) {
                        return;
                    }

                    const mainText = prediction.mainText ? prediction.mainText.toString() : prediction.text.toString();
                    const secondaryText = prediction.secondaryText ? prediction.secondaryText.toString() : "";
                    const fullText = prediction.text.toString();

                    const item = document.createElement("div");
                    item.className = "location-suggestion-item";

                    item.innerHTML = `
                        <strong>${mainText}</strong><br>
                        <small>${secondaryText || fullText}</small>
                    `;

                    item.addEventListener("click", function () {
                        locationInput.value = fullText;
                        locationSuggestions.style.display = "none";
                        fetchGooglePlaceDetails(prediction, fullText);
                    });

                    locationSuggestions.appendChild(item);
                });
            } catch (error) {
                console.error(error);
                locationMessage.style.color = "#555";
                locationMessage.innerHTML = "Checking city availability...";
                checkTypedLocationSearch(search);
            }
        });
    }

    async function fetchGooglePlaceDetails(prediction, fallbackAddress) {
        locationMessage.style.color = "#555";
        locationMessage.innerHTML = "Reading location details...";

        try {
            const place = prediction.toPlace();
            await place.fetchFields({ fields: ["addressComponents", "formattedAddress"] });

            const parsedLocation = parseGoogleAddressComponents(place.addressComponents || []);
            const fullAddress = place.formattedAddress || fallbackAddress;

            checkLocationInDatabase(
                parsedLocation.area,
                parsedLocation.city,
                parsedLocation.pincode,
                fullAddress
            );
        } catch (error) {
            console.error(error);
            locationMessage.style.color = "red";
            locationMessage.innerHTML = "Could not read this location. Please try another one.";
        }
    }

    function parseGoogleAddressComponents(components) {
        const findComponent = function (types) {
            const component = components.find(function (item) {
                return types.some(function (type) {
                    return item.types.includes(type);
                });
            });

            return component ? (component.longText || component.long_name || component.shortText || component.short_name || "") : "";
        };

        return {
            area: findComponent(["sublocality_level_1", "sublocality", "neighborhood", "route"]),
            city: findComponent(["locality", "administrative_area_level_3", "administrative_area_level_2"]),
            pincode: findComponent(["postal_code"])
        };
    }

    function checkLocationInDatabase(area, city, pincode, fullAddress) {
        locationMessage.style.color = "#555";
        locationMessage.innerHTML = "Checking service availability...";

        fetch("{{ route('check.service.location') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                area: area,
                city: city,
                pincode: pincode
            })
        })
        .then(response => response.json())
        .then(data => {

            if (data.status === true) {
                const locationPincode = data.location.pincode ? " - " + data.location.pincode : "";
                const finalText = data.location.area_name + ", " + data.location.city_name + locationPincode;

                locationMessage.style.color = "green";
                locationMessage.innerHTML = "Service available in your location.";

                selectedLocationText.innerText = finalText;

                localStorage.setItem("selected_location_text", finalText);
                localStorage.setItem("location_allowed", "yes");

                showServices();

                setTimeout(function () {
                    locationModal.style.display = "none";
                }, 700);

            } else {
                selectedLocationText.innerText = fullAddress;

                locationMessage.style.color = "red";
                locationMessage.innerHTML = "Sorry, service is not available in this location.";

                localStorage.setItem("selected_location_text", fullAddress);
                localStorage.setItem("location_allowed", "no");

                showComingSoon();

                setTimeout(function () {
                    locationModal.style.display = "none";
                }, 1000);
            }
        })
        .catch(error => {
            console.error(error);
            locationMessage.style.color = "red";
            locationMessage.innerHTML = "Something went wrong. Please try again.";
        });
    }

    const profileBtn = document.getElementById("customerProfileBtn");
    const dropdownMenu = document.getElementById("customerDropdownMenu");
    const menuToggleBtn = document.getElementById("menuToggleBtn");
    const mainNav = document.getElementById("mainNav");

    if (profileBtn && dropdownMenu) {
        profileBtn.addEventListener("click", function (e) {
            e.stopPropagation();
            dropdownMenu.classList.toggle("show");
        });

        document.addEventListener("click", function () {
            dropdownMenu.classList.remove("show");
        });
    }

    if (menuToggleBtn && mainNav) {
        menuToggleBtn.addEventListener("click", function () {
            mainNav.classList.toggle("show");
        });
    }
});
</script>
@endpush
