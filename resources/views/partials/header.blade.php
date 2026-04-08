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
    gap: 12px;
    flex-shrink: 0;
}

.btn-glow {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 48px;
    padding: 0 22px;
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    text-decoration: none;
    border-radius: 999px;
    background: linear-gradient(180deg, #ff9348 0%, #e56a1f 100%);
    box-shadow:
        inset 0 1px 3px rgba(255,255,255,0.35),
        0 8px 18px rgba(229,106,31,0.28);
    transition: all 0.3s ease;
    white-space: nowrap;
}

.btn-glow:hover {
    transform: translateY(-2px);
    background: linear-gradient(180deg, #ffa25d 0%, #dc5f14 100%);
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

.customer-login-box {
    display: flex;
    align-items: center;
    gap: 12px;
    background: #fff;
    border: 1px solid #e3e3e3;
    border-radius: 999px;
    padding: 8px 10px 8px 14px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.customer-info {
    display: flex;
    flex-direction: column;
    line-height: 1.2;
}

.customer-name {
    font-size: 14px;
    font-weight: 700;
    color: #1f2329;
}

.customer-mobile {
    font-size: 12px;
    color: #666;
}

.logout-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 36px;
    padding: 0 14px;
    border-radius: 999px;
    text-decoration: none;
    color: #fff;
    font-size: 13px;
    font-weight: 700;
    background: linear-gradient(180deg,#f08b39 0%, #df7122 100%);
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

    .btn-glow,
    .header-login-btn {
        min-height: 44px;
        font-size: 13px;
        padding: 0 16px;
    }

    .customer-login-box {
        padding: 7px 8px 7px 12px;
        gap: 10px;
    }

    .customer-name {
        font-size: 13px;
    }

    .customer-mobile {
        font-size: 11px;
    }
}

/* Mobile menu mode */
@media (max-width: 991px) {
    .nav-menu {
        display: none;
    }

    .header-right .btn-glow {
        display: none;
    }

    .menu-toggle {
        display: inline-flex;
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

    .mobile-header-actions .btn-glow,
    .mobile-header-actions .header-login-btn,
    .mobile-header-actions .logout-btn {
        width: 100%;
        justify-content: center;
    }

    .mobile-customer-box {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        border: 1px solid #e3e3e3;
        border-radius: 16px;
        padding: 12px 14px;
        background: #fff;
    }

    .mobile-customer-left {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .mobile-customer-left .customer-name {
        font-size: 14px;
    }

    .mobile-customer-left .customer-mobile {
        font-size: 12px;
    }

    .header-right {
        gap: 10px;
    }

    .customer-login-box {
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
                <li><a href="#">About Us</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Knowledge Hub</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>

        <div class="header-right">

            @if(session('customer_logged_in'))
                <div class="customer-login-box">
                    <div class="customer-info">
                        <div class="customer-name">
                            {{ session('customer_name') ?: 'Mobile User' }}
                        </div>
                        <div class="customer-mobile">
                            {{ session('customer_mobile') }}
                        </div>
                    </div>

                    <a href="{{ route('customer.logout') }}" class="logout-btn">Logout</a>
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
                <a href="#">Knowledge Hub</a>
                <a href="#">Contact</a>
            </nav>

            <div class="mobile-header-actions">
              
                @if(session('customer_logged_in'))
                    <div class="mobile-customer-box">
                        <div class="mobile-customer-left">
                            <div class="customer-name">{{ session('customer_name') ?: 'Mobile User' }}</div>
                            <div class="customer-mobile">{{ session('customer_mobile') }}</div>
                        </div>
                        <a href="{{ route('customer.logout') }}" class="logout-btn">Logout</a>
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

if (menuToggleBtn && mobileMenuPanel) {
    menuToggleBtn.addEventListener("click", function () {
        mobileMenuPanel.classList.toggle("active");
    });

    document.addEventListener("click", function (e) {
        if (
            !mobileMenuPanel.contains(e.target) &&
            !menuToggleBtn.contains(e.target)
        ) {
            mobileMenuPanel.classList.remove("active");
        }
    });
}
</script>