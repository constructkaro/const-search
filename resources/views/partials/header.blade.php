<style>
body {
    margin: 0;
    font-family: 'Poppins', Arial, sans-serif;
}

/* Header */
.main-header {
    position: sticky;
    top: 0;
    z-index: 999;
    background: rgba(255, 255, 255, 0.96);
    border-bottom: 1px solid rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.main-header.scrolled {
    background: rgba(255, 255, 255, 0.82);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

/* Container */
.container {
    width: 92%;
    max-width: 1450px;
    margin: auto;
}

/* Flex Layout */
.header-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
    min-height: 92px;
}

/* Logo */

.logo {
    display: flex;
    align-items: center;
    justify-content: flex-start;
}

.logo img {
    max-height: 90px;
    width: auto;
    display: block;
    margin-left: -60px;
}

/* Navigation */
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
    /* background: rgba(243, 112, 33, 0.12); */
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

/* Buttons */
.header-actions {
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

.btn-light {
    background: linear-gradient(180deg, #ffab72 0%, #f37021 100%);
}

/* Responsive */
@media (max-width: 1100px) {
    .header-wrapper {
        flex-wrap: wrap;
        justify-content: center;
        padding: 18px 0;
    }

    .logo {
        width: 100%;
        justify-content: center;
    }

    .nav-menu {
        width: 100%;
        order: 2;
    }

    .nav-menu ul {
        flex-wrap: wrap;
        justify-content: center;
    }

    .header-actions {
        width: 100%;
        justify-content: center;
        order: 3;
        flex-wrap: wrap;
    }
}

@media (max-width: 768px) {
    .container {
        width: 94%;
    }

    .header-wrapper {
        min-height: auto;
    }

    .logo img {
        max-height: 48px;
    }

    .nav-menu ul li a {
        padding: 10px 14px;
        font-size: 15px;
    }

    .btn-glow {
        min-height: 44px;
        padding: 0 18px;
        font-size: 13px;
    }
}
</style>

<header class="main-header">
    <div class="container header-wrapper">

        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="ConstructKaro">
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

        <div class="header-actions">
            <a href="#" class="btn-glow">ConstructKaro Job Portal</a>
            <a href="#" class="btn-glow btn-light">Login / Sign Up</a>
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
</script>