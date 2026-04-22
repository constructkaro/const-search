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

        <a href="{{ route('vendor.notifications') }}" class="{{ request()->routeIs('vendor.notifications') ? 'active' : '' }}">
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
</div>