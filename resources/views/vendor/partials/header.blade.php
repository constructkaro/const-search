<style>
    .vendor-header {
    position: sticky;
    top: 0;
    z-index: 1000;
    background: rgba(17, 22, 51, 0.95);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(255,255,255,0.08);
}

.header-container {
    min-height: 84px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.logo-link {
    display: flex;
    align-items: center;
    gap: 14px;
    color: #fff;
    font-size: 24px;
    font-weight: 800;
    text-decoration: none;
}

.logo-icon {
    width: 46px;
    height: 46px;
    border-radius: 12px;
    background: #f5a623;
    color: #111633;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
    box-shadow: 0 8px 20px rgba(245,166,35,0.25);
}

.logo-text {
    color: #fff;
}

.nav-menu {
    display: flex;
    align-items: center;
    gap: 34px;
}

.nav-menu a {
    color: rgba(255,255,255,0.92);
    font-size: 16px;
    font-weight: 500;
    text-decoration: none;
    transition: 0.25s ease;
}

.nav-menu a:hover {
    color: #f5a623;
}

.register-btn {
    padding: 14px 24px;
    background: #f5a623;
    color: #111633 !important;
    border-radius: 14px;
    font-weight: 700 !important;
    box-shadow: 0 10px 20px rgba(245,166,35,0.18);
}

@media (max-width: 992px) {
    .header-container {
        flex-direction: column;
        padding: 18px 0;
    }

    .nav-menu {
        flex-wrap: wrap;
        justify-content: center;
        gap: 16px;
    }
}
</style>
<header class="vendor-header">
    <div class="container header-container">
        <div class="logo-wrap">
            <a href="{{ route('vendor') }}" class="logo-link">
                <div class="logo-icon">
                    <i class="fa-solid fa-helmet-safety"></i>
                </div>
                <span class="logo-text">ConstructKaro</span>
            </a>
        </div>

        <nav class="nav-menu">
            <a href="#who-can-join">Who Can Join</a>
            <a href="#how-it-works">How It Works</a>
            <a href="#why-join">Why Join</a>
            <a href="{{route('login')}}" class="register-btn">Login</a>
        </nav>
    </div>
</header>