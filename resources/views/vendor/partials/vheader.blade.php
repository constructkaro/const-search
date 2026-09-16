<div class="header">
    <div class="header-left">
        <h2>@yield('page_title', 'Dashboard')</h2>
        <p>ConstructKaro Vendor Admin</p>
    </div>

    <div class="header-right">
        <div class="user-box">
            <i class="fa-solid fa-user-circle"></i>
            <span>{{ session('vendor_name') ?? 'Vendor' }}</span>
        </div>

        <a href="{{ route('logout') }}" class="logout-btn">
            <i class="fa-solid fa-right-from-bracket"></i>
            Logout
        </a>
    </div>
</div>
