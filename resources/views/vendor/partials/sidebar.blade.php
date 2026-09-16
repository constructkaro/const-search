<div class="sidebar">
    <a href="{{ route('dashboard') }}" class="brand">
        <span class="brand-logo-wrap">
            <img src="{{ asset('images/logo.png') }}" alt="ConstructKaro" class="brand-logo">
        </span>
        <span class="brand-kicker">Vendor Portal</span>
    </a>

    <div class="sidebar-menu">
        <div class="sidebar-label">Workspace</div>

        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-house"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('vendor.categories') }}" class="{{ request()->routeIs('vendor.categories') ? 'active' : '' }}">
            <i class="fa-solid fa-layer-group"></i>
            <span>Categories</span>
        </a>

        <a href="{{ route('vendor.notifications') }}" class="{{ request()->routeIs('vendor.notifications') || request()->routeIs('vendor.project.track') ? 'active' : '' }}">
            <i class="fa-solid fa-bell"></i>
            <span>Notifications</span>

            @php
                $unreadCount = DB::table('vendor_project_notifications')
                    ->where('vendor_id', session('vendor_id'))
                    ->where('status', 'unread')
                    ->count();
            @endphp

            @if($unreadCount > 0)
                <span class="badge bg-danger ms-auto">{{ $unreadCount }}</span>
            @endif
        </a>
    </div>

    <div class="sidebar-footer">
        <div class="sidebar-footer-icon">
            <i class="fa-solid fa-headset"></i>
        </div>
        <div>
            <strong>Need help?</strong>
            <span>Contact ConstructKaro team</span>
        </div>
    </div>
</div>
