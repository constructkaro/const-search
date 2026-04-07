<div class="sidebar">
    <div class="brand">ConstructKaro</div>

    <div class="sidebar-menu">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-house"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('vendor.categories') }}" class="{{ request()->routeIs('vendor.categories') ? 'active' : '' }}">
            <i class="fa-solid fa-layer-group"></i>
            <span>Categories</span>
        </a>
    </div>
</div>  