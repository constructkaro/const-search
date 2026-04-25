<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Segoe UI", sans-serif;
}

/* .header {
    width: 100%;
    height: 76px;
    background: #f5f5f5;
    padding: 0 20px;
    display: flex;
    align-items: center;
} */
    .header {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 9999;
    width: 100%;
    height: 76px;
    background: #f5f5f5;
    padding: 0 20px;
    display: flex;
    align-items: center;
    box-shadow: 0 4px 14px rgba(0,0,0,0.08);
}

body {
    padding-top: 76px;
}

.container {
    width: 100%;
    max-width: 1320px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    gap: 24px;
}

/* Logo */
.logo {
    flex-shrink: 0;
}

.logo img {
    width: 200px;
    height: auto;
    max-height: 90px;
    object-fit: contain;
    display: block;
}

/* Location */
.location {
    display: flex;
    align-items: center;
    background: #e9e9e9;
    padding: 6px 12px;
    border-radius: 20px;
    gap: 6px;
    flex-shrink: 0;
}

.location svg {
    width: 28px;
    height: 28px;
}

.location select {
    border: none;
    background: transparent;
    outline: none;
    font-size: 14px;
    color: #333;
}

/* Navigation - Right Side */
.nav {
    display: flex;
    align-items: center;
    gap: 25px;
    margin-left: auto;
}

.nav a {
    text-decoration: none;
    color: #555;
    font-size: 15px;
    position: relative;
    white-space: nowrap;
}

.nav a.active {
    color: #007bff;
    font-weight: 600;
}

.nav a.active::after {
    content: "";
    position: absolute;
    width: 100%;
    height: 2px;
    background: orange;
    bottom: -6px;
    left: 0;
}

/* Header Right */
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
    min-width: 150px;
    height: 44px;
    padding: 0 20px;
    border-radius: 999px;
    text-decoration: none;
    color: #fff;
    font-size: 14px;
    font-weight: 700;
    background: linear-gradient(180deg, #f08b39 0%, #df7122 100%);
    box-shadow: 0 6px 14px rgba(223, 113, 34, 0.22);
    white-space: nowrap;
}

/* Customer Dropdown */
.customer-dropdown-wrap {
    position: relative;
}

.customer-profile-btn {
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
}

.customer-profile-btn svg {
    width: 22px;
    height: 22px;
}

.customer-dropdown-menu {
    position: absolute;
    right: 0;
    top: 52px;
    width: 170px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
    padding: 8px;
    display: none;
    z-index: 999;
}

.customer-dropdown-menu.show {
    display: block;
}

.customer-dropdown-menu a,
.customer-dropdown-menu button {
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

.customer-dropdown-menu a:hover,
.customer-dropdown-menu button:hover {
    background: #f5f5f5;
}

/* Mobile Menu Button */
.menu-toggle {
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
}

.menu-toggle svg {
    width: 24px;
    height: 24px;
}

/* Responsive */
@media (max-width: 991px) {
    .header {
        height: auto;
        min-height: 76px;
        padding: 10px 16px;
    }

    .container {
        flex-wrap: wrap;
    }

    .nav {
        width: 100%;
        order: 5;
        display: none;
        flex-direction: column;
        align-items: flex-start;
        gap: 14px;
        padding: 15px 0 5px;
        margin-left: 0;
    }

    .nav.show {
        display: flex;
    }

    .menu-toggle {
        display: flex;
    }

    .location {
        display: none;
    }

    .logo img {
        width: 140px;
        max-height: 54px;
    }
}

@media (max-width: 576px) {
    .header-login-btn {
        min-width: auto;
        height: 40px;
        padding: 0 14px;
        font-size: 13px;
    }

    .logo img {
        width: 125px;
        max-height: 50px;
    }
}

.location {
    display: flex;
    align-items: center;
    background: #e9e9e9;
    padding: 6px 12px;
    border-radius: 20px;
    gap: 6px;
    flex-shrink: 0;
    margin-left: auto;
}

.nav {
    display: flex;
    align-items: center;
    gap: 25px;
    margin-left: 0;
}

.header-right {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-shrink: 0;
}
</style>

<header class="header">
    <div class="container">

        <!-- Logo -->
        <div class="logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="ConstructKaro">
            </a>
        </div>

        <!-- Location Selector -->
        <div class="location">
            <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                    <path d="M9.19193 10.6396C9.43138 10.5147 9.7131 9.75879 9.87955 9.50504C10.0567 9.23492 10.2161 8.95172 10.4102 8.67731C10.4546 8.61449 10.6595 8.2018 10.7326 8.11485C10.9685 8.11844 10.8515 7.83301 10.9983 7.71606C11.1119 7.62563 11.2802 7.47727 11.4043 7.35512C12.4699 6.30629 13.6714 5.33907 15.0069 4.6575C15.471 4.425 16.3142 4.18047 16.8244 4.03203C17.0568 3.96446 17.3756 3.7153 17.5172 3.7099C18.4051 3.67605 19.463 3.56207 20.3435 3.6022C21.2852 3.64513 21.7369 3.70787 22.6754 3.63485C23.5683 3.81198 24.571 4.16383 25.3765 4.58457C26.7009 5.27637 28.6089 6.86114 29.4266 8.08957C31.2526 10.8327 32.041 13.911 31.3781 17.1736C30.6121 20.9433 28.772 24.2545 26.7491 27.4782C26.3429 28.1257 25.9728 28.7896 25.5428 29.4229C25.0572 30.1381 24.4962 30.8014 24.0059 31.517C23.4609 32.3125 21.5086 35.0912 20.7765 35.5673C20.4664 35.7689 20.0267 35.8008 19.6724 35.725C19.3763 35.6617 19.1104 35.4839 18.8924 35.2789C18.5848 34.9898 18.3241 34.6389 18.0569 34.3124C17.177 33.2374 16.4047 32.1077 15.6036 30.9755C15.0828 30.2397 14.5181 29.5582 14.0361 28.7924C11.4529 24.6875 8.26064 19.5643 8.40408 14.5613C8.42131 13.9592 8.45638 13.3565 8.59068 12.7676C8.7456 12.0882 8.8722 11.2598 9.19193 10.6396ZM15.9272 14.2896C15.6339 14.9098 15.5237 15.2597 15.8699 15.8888C15.9387 16.0138 15.8887 16.1545 16.0603 16.2542C16.6946 18.247 18.7172 19.4522 20.7717 19.0615C22.8261 18.6709 24.2653 16.8075 24.1238 14.7209C23.9824 12.6345 22.3051 10.9822 20.2167 10.8723C18.1283 10.7624 16.2868 12.2295 15.9272 14.2896Z" fill="#E87124"/>
                </svg>
            </span>

            <select>
                <option>Kharghar, Navi Mumbai</option>
                <option>Mumbai</option>
                <option>Pune</option>
            </select>
        </div>

        <!-- Navigation -->
        <nav class="nav" id="mainNav">
            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
            <a href="{{ route('aboutus') }}" class="{{ request()->routeIs('aboutus') ? 'active' : '' }}">About Us</a>
            <a href="{{ route('knowledgehub') }}" class="{{ request()->routeIs('knowledgehub') ? 'active' : '' }}">Knowledge Hub</a>
        </nav>

        <!-- Right Side -->
        <div class="header-right">
            @if(session('customer_logged_in'))

                <div class="customer-dropdown-wrap">
                    <button type="button" class="customer-profile-btn" id="customerProfileBtn" aria-label="Customer Menu">
                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5zm0 2c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5z"/>
                        </svg>
                    </button>

                    <div class="customer-dropdown-menu" id="customerDropdownMenu">
                        <a href="{{ route('myorder') }}">My Orders</a>
                        <a href="#">My Profile</a>

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
</header>

<script>
document.addEventListener("DOMContentLoaded", function () {
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


