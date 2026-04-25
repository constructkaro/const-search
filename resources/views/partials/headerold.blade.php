

<style>
body {
    margin: 0;
    font-family: 'Poppins', Arial, sans-serif;
}

.main-header {
    position: sticky;
    top: 0;
    z-index: 9999;
    background: rgba(255, 255, 255, 0.96);
    border-bottom: 1px solid rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.main-header.scrolled {
    background: rgba(255, 255, 255, 0.88);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

.container {
    width: 92%;
    max-width: 1450px;
    margin: auto;
}

.header-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    min-height: 90px;
    position: relative;
}

.logo {
    display: flex;
    align-items: center;
    flex-shrink: 0;
}

.logo a {
    display: inline-flex;
    align-items: center;
    text-decoration: none;
}

.logo img {
    max-height: 74px;
    width: auto;
    display: block;
}

.nav-menu {
    flex: 1;
    display: flex;
    justify-content: right;
}

.nav-menu ul {
    list-style: none;
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 0;
    padding: 0;
}

.nav-menu ul li a {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 12px 18px;
    text-decoration: none;
    color: #1f2937;
    font-weight: 500;
    font-size: 16px;
    border-radius: 999px;
    transition: all 0.3s ease;
}

.nav-menu ul li a:hover {
    color: #f37021;
    background: rgba(243, 112, 33, 0.08);
}

.nav-menu ul li a.active {
    color: #f37021;
    font-weight: 700;
}

.nav-menu ul li a.active::after,
.nav-menu ul li a:hover::after {
    content: "";
    position: absolute;
    left: 18px;
    right: 18px;
    bottom: 7px;
    height: 2px;
    background: #f37021;
    border-radius: 10px;
}

.header-right {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-shrink: 0;
}

.header-login-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 170px;
    height: 46px;
    padding: 0 22px;
    border-radius: 999px;
    text-decoration: none;
    color: #fff;
    font-weight: 700;
    background: linear-gradient(180deg,#f08b39 0%, #df7122 100%);
    box-shadow: 0 6px 14px rgba(223,113,34,0.22);
    white-space: nowrap;
}

.contact-link {
    text-decoration: none;
    color: #1f2937;
    font-size: 16px;
    font-weight: 500;
    transition: 0.3s ease;
}

.contact-link:hover {
    color: #f37021;
}

.customer-dropdown-wrap {
    position: relative;
}

.customer-profile-btn {
    width: 44px;
    height: 44px;
    border: none;
    border-radius: 50%;
    background: linear-gradient(180deg,#f08b39 0%, #df7122 100%);
    color: #fff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 8px 18px rgba(223,113,34,0.22);
    transition: 0.3s ease;
    padding: 0;
}

.customer-profile-btn:hover {
    transform: translateY(-1px);
}

.customer-profile-btn svg {
    width: 22px;
    height: 22px;
}

.customer-dropdown-menu {
    position: absolute;
    top: calc(100% + 10px);
    right: 0;
    min-width: 170px;
    background: #fff;
    border: 2px solid #2d9cff;
    border-radius: 6px;
    box-shadow: 0 14px 28px rgba(0,0,0,0.12);
    overflow: hidden;
    display: none;
    z-index: 99999;
}

.customer-dropdown-menu.show {
    display: block;
}

.customer-dropdown-menu a,
.customer-dropdown-menu button {
    display: block;
    width: 100%;
    text-align: left;
    padding: 10px 14px;
    background: #fff;
    border: none;
    text-decoration: none;
    color: #111827;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    line-height: 1.3;
}

.customer-dropdown-menu a:hover,
.customer-dropdown-menu button:hover {
    background: #f7f7f7;
}

.customer-dropdown-menu form {
    margin: 0;
}

.menu-toggle {
    display: none;
    width: 46px;
    height: 46px;
    border: none;
    border-radius: 12px;
    background: #fff3ea;
    color: #df7122;
    cursor: pointer;
    align-items: center;
    justify-content: center;
    padding: 0;
}

.menu-toggle svg {
    width: 24px;
    height: 24px;
}

.mobile-menu-panel {
    display: none;
}

/* Tablet */
@media (max-width: 1100px) {
    .header-wrapper {
        min-height: 82px;
        gap: 14px;
    }

    .logo img {
        max-height: 62px;
    }

    .nav-menu ul li a {
        padding: 10px 14px;
        font-size: 15px;
    }

    .header-login-btn {
        min-height: 44px;
        font-size: 13px;
        padding: 0 16px;
    }
}

/* Mobile menu mode */
@media (max-width: 991px) {
    .nav-menu {
        display: none;
    }

    .header-wrapper {
        min-height: 76px;
    }

    .logo img {
        max-height: 56px;
    }

    .mobile-menu-panel {
        display: none;
        width: 100%;
        background: #fff;
        border-top: 1px solid rgba(0,0,0,0.06);
        box-shadow: 0 14px 28px rgba(0,0,0,0.06);
    }

    .mobile-menu-panel.active {
        display: block;
    }

    .mobile-menu-inner {
        width: 92%;
        max-width: 1450px;
        margin: auto;
        padding: 14px 0 18px;
    }

    .mobile-nav {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .mobile-nav a {
        text-decoration: none;
        color: #1f2937;
        font-weight: 600;
        font-size: 15px;
        padding: 12px 14px;
        border-radius: 12px;
        transition: 0.3s ease;
    }

    .mobile-nav a:hover,
    .mobile-nav a.active {
        background: rgba(243, 112, 33, 0.08);
        color: #f37021;
    }

    .mobile-header-actions {
        margin-top: 14px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .mobile-header-actions .header-login-btn {
        width: 100%;
        justify-content: center;
    }

    .mobile-customer-box {
        display: flex;
        flex-direction: column;
        gap: 10px;
        border: 1px solid #e3e3e3;
        border-radius: 16px;
        padding: 12px 14px;
        background: #fff;
    }

    .mobile-customer-box a,
    .mobile-customer-box button {
        text-decoration: none;
        border: none;
        background: #fff;
        text-align: left;
        padding: 10px 0;
        color: #1f2937;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
    }

    .mobile-customer-box form {
        margin: 0;
    }

    .menu-toggle {
        display: inline-flex;
    }

    .header-right {
        gap: 10px;
    }

    .customer-dropdown-wrap,
    .contact-link.desktop-only {
        display: none;
    }
}

/* Small mobile */
@media (max-width: 576px) {
    .container {
        width: 94%;
    }

    .header-wrapper {
        min-height: 70px;
    }

    .logo img {
        max-height: 50px;
    }

    .header-login-btn {
        min-width: auto;
        padding: 0 14px;
        height: 42px;
        font-size: 12px;
    }

    .menu-toggle {
        width: 42px;
        height: 42px;
    }

    .header-right {
        gap: 8px;
    }
}
</style>

<header class="main-header">
    <div class="container header-wrapper">

        <div class="logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="ConstructKaro">
            </a>
        </div>

        <nav class="nav-menu">
            <ul>
                <li><a href="{{ url('/') }}" class="active">Home</a></li>
                <li><a href="{{route('aboutus')}}">About Us</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="{{route('knowledgehub')}}">Knowledge Hub</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>

        <div class="header-right">
            @if(session('customer_logged_in'))
               
                <div class="customer-dropdown-wrap">
                    <button type="button" class="customer-profile-btn" id="customerProfileBtn" aria-label="Customer Menu">
                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5zm0 2c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5z"/>
                        </svg>
                    </button>

                    <div class="customer-dropdown-menu" id="customerDropdownMenu">
                        <a href="{{route('myorder')}}">My Orders</a>
                        <a href="">My Profile</a>

                        <form method="GET" action="{{ route('customer.logout') }}">
                            <button type="submit">Log Out</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="javascript:void(0)" class="header-login-btn open-customer-login-modal">
                    Login / Sign Up
                </a>
            @endif

            <button class="menu-toggle" id="menuToggleBtn" type="button" aria-label="Open Menu">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round">
                    <path d="M4 7H20"></path>
                    <path d="M4 12H20"></path>
                    <path d="M4 17H20"></path>
                </svg>
            </button>
        </div>
    </div>

    <div class="mobile-menu-panel" id="mobileMenuPanel">
        <div class="mobile-menu-inner">
            <nav class="mobile-nav">
                <a href="{{ url('/') }}" class="active">Home</a>
                <a href="#">About Us</a>
                <a href="#">Services</a>
                <a href="{{route('knowledgehub')}}">Knowledge Hub</a>
                <a href="#">Contact</a>
            </nav>

            <div class="mobile-header-actions">
                @if(session('customer_logged_in'))
                    <div class="mobile-customer-box">
                        <a href="">My Orders</a>
                        <a href="">My Profile</a>

                        <form method="GET" action="{{ route('customer.logout') }}">
                            <button type="submit">Log Out</button>
                        </form>
                    </div>
                @else
                    <a href="javascript:void(0)" class="header-login-btn open-customer-login-modal">
                        Login / Sign Up
                    </a>
                @endif
            </div>
        </div>
    </div>
</header>

<script>
window.addEventListener("scroll", function () {
    const header = document.querySelector(".main-header");
    if (window.scrollY > 40) {
        header.classList.add("scrolled");
    } else {
        header.classList.remove("scrolled");
    }
});

const menuToggleBtn = document.getElementById("menuToggleBtn");
const mobileMenuPanel = document.getElementById("mobileMenuPanel");
const customerProfileBtn = document.getElementById("customerProfileBtn");
const customerDropdownMenu = document.getElementById("customerDropdownMenu");

if (menuToggleBtn && mobileMenuPanel) {
    menuToggleBtn.addEventListener("click", function (e) {
        e.stopPropagation();
        mobileMenuPanel.classList.toggle("active");
    });
}

if (customerProfileBtn && customerDropdownMenu) {
    customerProfileBtn.addEventListener("click", function (e) {
        e.stopPropagation();
        customerDropdownMenu.classList.toggle("show");
    });
}

document.addEventListener("click", function (e) {
    if (mobileMenuPanel && menuToggleBtn) {
        if (!mobileMenuPanel.contains(e.target) && !menuToggleBtn.contains(e.target)) {
            mobileMenuPanel.classList.remove("active");
        }
    }

    if (customerDropdownMenu && customerProfileBtn) {
        if (!customerDropdownMenu.contains(e.target) && !customerProfileBtn.contains(e.target)) {
            customerDropdownMenu.classList.remove("show");
        }
    }
});
</script>