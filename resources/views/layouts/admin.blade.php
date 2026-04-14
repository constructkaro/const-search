<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f4f6f9;
            font-family: 'Poppins', Arial, sans-serif;
            color: #1f2937;
        }

        .admin-wrapper {
            min-height: 100vh;
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #1c2c3e 0%, #14212f 100%);
            color: #fff;
            padding: 22px 16px;
            position: sticky;
            top: 0;
        }

        .sidebar-brand {
            font-size: 24px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 28px;
            letter-spacing: 0.3px;
        }

        .sidebar-user-box {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            padding: 14px;
            margin-bottom: 24px;
        }

        .sidebar-user-box h6 {
            margin: 0 0 4px;
            font-size: 15px;
            font-weight: 700;
            color: #fff;
        }

        .sidebar-user-box p {
            margin: 0;
            font-size: 13px;
            color: #c9d3de;
        }

        .sidebar-menu a,
        .sidebar-dropdown-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            background: transparent;
            border: none;
            color: #d9e2ec;
            text-decoration: none;
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 8px;
            transition: all 0.3s ease;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active,
        .sidebar-dropdown-btn:hover,
        .sidebar-dropdown-btn.active {
            background: #f25c05;
            color: #fff;
        }

        .sidebar-submenu {
            display: none;
            padding-left: 12px;
            margin: 2px 0 10px;
        }

        .sidebar-submenu.show {
            display: block;
        }

        .sidebar-submenu a {
            font-size: 14px;
            padding: 10px 12px;
            margin-bottom: 6px;
            border-radius: 10px;
            background: rgba(255,255,255,0.03);
        }

        .sidebar-submenu a:hover,
        .sidebar-submenu a.active {
            background: rgba(242, 92, 5, 0.18);
            color: #fff;
        }

        .dropdown-arrow {
            font-size: 12px;
            transition: transform 0.3s ease;
        }

        .sidebar-dropdown-btn.active .dropdown-arrow {
            transform: rotate(180deg);
        }

        .logout-btn {
            margin-top: 18px;
            width: 100%;
            border: none;
            border-radius: 12px;
            padding: 12px 14px;
            background: #dc3545;
            color: #fff;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: #c82333;
        }

        .content-area {
            padding: 22px;
        }

        .topbar {
            background: #fff;
            border-radius: 18px;
            padding: 16px 20px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            margin-bottom: 22px;
        }

        .topbar h4 {
            margin: 0;
            font-size: 24px;
            font-weight: 800;
            color: #1c2c3e;
        }

        .topbar small {
            color: #6b7280;
            font-size: 13px;
        }

        .page-card {
            background: #fff;
            border-radius: 18px;
            padding: 20px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        }

        .stat-card {
            background: #fff;
            border: none;
            border-radius: 18px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            padding: 22px;
            height: 100%;
        }

        .stat-card h5 {
            font-size: 15px;
            color: #6b7280;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .stat-card h2 {
            font-size: 30px;
            font-weight: 800;
            color: #1c2c3e;
            margin: 0;
        }

        .mobile-topbar {
            display: none;
            background: #1c2c3e;
            color: #fff;
            padding: 14px 16px;
            align-items: center;
            justify-content: space-between;
        }

        .mobile-topbar h5 {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
        }

        .menu-toggle {
            background: transparent;
            border: none;
            color: #fff;
            font-size: 24px;
            line-height: 1;
        }

        @media (max-width: 991px) {
            .sidebar {
                position: fixed;
                left: -280px;
                top: 0;
                width: 280px;
                z-index: 1050;
                transition: all 0.3s ease;
                min-height: 100vh;
            }

            .sidebar.show {
                left: 0;
            }

            .mobile-topbar {
                display: flex;
            }

            .content-area {
                padding: 16px;
            }

            .topbar h4 {
                font-size: 20px;
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.4);
                z-index: 1040;
            }

            .sidebar-overlay.show {
                display: block;
            }
        }
    </style>
</head>
<body>

<div class="mobile-topbar">
    <h5>Admin Panel</h5>
    <button class="menu-toggle" type="button" onclick="toggleSidebar()">☰</button>
</div>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<div class="container-fluid admin-wrapper">
    <div class="row">
        <div class="col-lg-2 p-0">
            <div class="sidebar" id="adminSidebar">
                <div class="sidebar-brand">Admin Panel</div>

                <div class="sidebar-user-box">
                    <h6>{{ auth()->user()->name }}</h6>
                    <p>{{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}</p>
                </div>

                <div class="sidebar-menu">
                    <a href="{{ route('admin.dashboard') }}"
                       class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <span>Dashboard</span>
                    </a>

                    @if(auth()->user()->role === 'super_admin')
                        <a href="{{ route('admin.users.index') }}"
                           class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <span>User Management</span>
                        </a>
                    @endif

                    <a href="#">
                        <span>Projects</span>
                    </a>

                    @php
                        $ordersMenuOpen =
                            request()->routeIs('admin.orders.index') ||
                            request()->routeIs('admin.orders.contractor') ||
                            request()->routeIs('admin.orders.interior') ||
                            request()->routeIs('admin.orders.survey') ||
                            request()->routeIs('admin.orders.testing') ||
                            request()->routeIs('admin.orders.boq');
                    @endphp

                    <button
                        type="button"
                        class="sidebar-dropdown-btn {{ $ordersMenuOpen ? 'active' : '' }}"
                        onclick="toggleOrdersMenu()"
                        id="ordersMenuBtn"
                    >
                        <span>Orders</span>
                        <span class="dropdown-arrow">▼</span>
                    </button>

                    <div class="sidebar-submenu {{ $ordersMenuOpen ? 'show' : '' }}" id="ordersSubmenu">
                        <a href="{{ route('admin.orders.index') }}"
                           class="{{ request()->routeIs('admin.orders.index') ? 'active' : '' }}">
                            All Orders
                        </a>

                        <a href="{{ route('admin.orders.contractor') }}"
                           class="{{ request()->routeIs('admin.orders.contractor') ? 'active' : '' }}">
                            Contractor Orders
                        </a>

                        <a href="{{ route('admin.orders.interior') }}"
                           class="{{ request()->routeIs('admin.orders.interior') ? 'active' : '' }}">
                            Interior Orders
                        </a>

                        <a href="{{ route('admin.orders.survey') }}"
                           class="{{ request()->routeIs('admin.orders.survey') ? 'active' : '' }}">
                            Survey Orders
                        </a>

                        <a href="{{ route('admin.orders.testing') }}"
                           class="{{ request()->routeIs('admin.orders.testing') ? 'active' : '' }}">
                            Testing Orders
                        </a>

                        <a href="{{ route('admin.orders.boq') }}"
                           class="{{ request()->routeIs('admin.orders.boq') ? 'active' : '' }}">
                            BOQ Orders
                        </a>


                        <a href="{{ route('admin.tracking_templates.index') }}"
                        class="{{ request()->routeIs('admin.tracking_templates.*') ? 'active' : '' }}">
                            <span>Tracking Templates</span>
                        </a>

                        
    <a href="{{ route('admin.order_tracking.index') }}">Order Tracking</a>

                    </div>

                    <a href="#">
                        <span>Settings</span>
                    </a>

                    <form action="{{ route('admin.logout') }}" method="POST" class="mt-3">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-10 content-area">
            <div class="topbar d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <h4>@yield('page_title', 'Dashboard')</h4>
                    <small>
                        Welcome, {{ auth()->user()->name }}
                        ({{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }})
                    </small>
                </div>
            </div>

            @yield('content')
        </div>
    </div>
</div>

<script>
    function toggleOrdersMenu() {
        const submenu = document.getElementById('ordersSubmenu');
        const btn = document.getElementById('ordersMenuBtn');

        submenu.classList.toggle('show');
        btn.classList.toggle('active');
    }

    function toggleSidebar() {
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');

        sidebar.classList.toggle('show');
        overlay.classList.toggle('show');
    }
</script>

</body>
</html>