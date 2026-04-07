<div class="header">
    <div class="header-left">
        <h2>@yield('page_title', 'Dashboard')</h2>
    </div>

    <div class="header-right">
        <div class="user-box">
            <i class="fa-solid fa-user-circle"></i>
            <span>{{ session('vendor_name') ?? 'Vendor' }}</span>
        </div>

        <a href="{{ route('logout') }}" class="logout-btn">Logout</a>
    </div>
</div>