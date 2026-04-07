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

.container {
    width: 92%;
    max-width: 1450px;
    margin: auto;
}

.header-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
    min-height: 92px;
}

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

.header-right{
    display:flex;
    align-items:center;
    gap:14px;
}

.header-login-btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    min-width:170px;
    height:46px;
    padding:0 22px;
    border-radius:999px;
    text-decoration:none;
    color:#fff;
    font-weight:700;
    background:linear-gradient(180deg,#f08b39 0%, #df7122 100%);
    box-shadow:0 6px 14px rgba(223,113,34,0.22);
}

.customer-login-box{
    display:flex;
    align-items:center;
    gap:12px;
    background:#fff;
    border:1px solid #e3e3e3;
    border-radius:999px;
    padding:8px 10px 8px 8px;
    box-shadow:0 4px 12px rgba(0,0,0,0.08);
}

.customer-avatar{
    width:40px;
    height:40px;
    border-radius:50%;
    background:linear-gradient(180deg,#3485cd 0%, #206eb4 100%);
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:16px;
    font-weight:800;
}

.customer-info{
    display:flex;
    flex-direction:column;
    line-height:1.2;
}

.customer-name{
    font-size:14px;
    font-weight:700;
    color:#1f2329;
}

.customer-mobile{
    font-size:12px;
    color:#666;
}

.logout-btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    height:36px;
    padding:0 14px;
    border-radius:999px;
    text-decoration:none;
    color:#fff;
    font-size:13px;
    font-weight:700;
    background:linear-gradient(180deg,#f08b39 0%, #df7122 100%);
}

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

@media(max-width:767px){
    .customer-login-box{
        width:100%;
        border-radius:18px;
        justify-content:space-between;
    }

    .header-right{
        width:100%;
    }

    .logo img {
        max-height: 48px;
        margin-left: 0;
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
        </div>

        <div class="header-right">
            @if(session('customer_logged_in'))
                <div class="customer-login-box">
                    <!-- <div class="customer-avatar">
                        {{ strtoupper(substr(session('customer_mobile') ?: 'C', 0, 1)) }}
                    </div> -->

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