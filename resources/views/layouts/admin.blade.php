<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #eef6ff;
            font-family: 'Poppins', Arial, sans-serif;
            color: #1f2937;
        }

        .admin-wrapper {
            min-height: 100vh;
        }

        .sidebar {
            min-height: 100vh;
            background: #e7f2ff;
            color: #004487;
            padding: 20px 12px;
            position: sticky;
            top: 0;
            border-right: 1px solid #c7dcf1;
            overflow-y: auto;
        }

        .sidebar-brand {
            font-size: 20px;
            font-weight: 800;
            color: #004487;
            margin-bottom: 16px;
            letter-spacing: 0;
            text-transform: uppercase;
        }

        .sidebar-user-box {
            background: #f8fbff;
            border: 1px solid #bdd8ef;
            border-radius: 8px;
            padding: 12px 14px;
            margin-bottom: 14px;
        }

        .sidebar-user-box h6 {
            margin: 0 0 4px;
            font-size: 15px;
            font-weight: 700;
            color: #004487;
        }

        .sidebar-user-box p {
            margin: 0;
            font-size: 13px;
            color: #4b6f91;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .sidebar-module {
            background: #f8fbff;
            border: 1px solid #bdd8ef;
            border-radius: 8px;
            overflow: hidden;
        }

        .sidebar-module.open,
        .sidebar-module:has(.active) {
            border-color: #ff7a1a;
            background: #fff8f2;
        }

        .sidebar-module-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            background: transparent;
            border: none;
            color: #004487;
            text-decoration: none;
            padding: 14px 15px;
            transition: all 0.2s ease;
            font-weight: 800;
            font-size: 15px;
            letter-spacing: 2px;
            line-height: 1.35;
            text-transform: uppercase;
            cursor: pointer;
        }

        .sidebar-module-title,
        .sidebar-menu a .menu-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-module-btn:hover,
        .sidebar-module-btn.active {
            color: #004487;
        }

        .sidebar-submenu {
            display: none;
            padding: 0 8px 8px;
            margin: 0;
        }

        .sidebar-submenu.show {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            color: #004487;
            text-decoration: none;
            border-radius: 7px;
            transition: all 0.2s ease;
            font-weight: 700;
            cursor: pointer;
        }

        .sidebar-submenu a {
            font-size: 14px;
            padding: 11px 12px;
            background: transparent;
            letter-spacing: 0;
        }

        .sidebar-submenu a:hover,
        .sidebar-submenu a.active {
            background: #ff7a1a;
            color: #fff;
        }

        .dropdown-arrow {
            color: #00579f;
            font-size: 18px;
            line-height: 1;
            transition: transform 0.3s ease;
        }

        .sidebar-module.open .dropdown-arrow {
            transform: rotate(45deg);
        }

        .logout-btn {
            margin-top: 18px;
            width: 100%;
            border: none;
            border-radius: 8px;
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

        .mobile-topbar {
            display: none;
            background: #004487;
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
                max-height: 100vh;
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
    <button class="menu-toggle" type="button" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </button>
</div>

@if(false)
<div class="mobile-topbar">
    <h5>Admin Panel</h5>
    <button class="menu-toggle" type="button" onclick="toggleSidebar()">☰</button>
</div>

@endif

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
                    @php
                        $role = auth()->user()->role;
                        $canSeeAdminModules = $role !== 'marketing';

                        $sidebarModules = [
                            [
                                'title' => 'Overview',
                                'icon' => 'bi-grid-1x2',
                                'visible' => true,
                                'items' => array_values(array_filter([
                                    $canSeeAdminModules ? [
                                        'label' => 'Dashboard',
                                        'icon' => 'bi-house-door',
                                        'route' => 'admin.dashboard',
                                        'active' => ['admin.dashboard'],
                                    ] : null,
                                    $canSeeAdminModules ? [
                                        'label' => 'ERP Gap Analysis',
                                        'icon' => 'bi-bar-chart-line',
                                        'route' => 'admin.vendor.strategy',
                                        'active' => ['admin.vendor.strategy'],
                                    ] : null,
                                ])),
                            ],
                            [
                                'title' => 'Projects',
                                'icon' => 'bi-folder2-open',
                                'visible' => $canSeeAdminModules,
                                'items' => [
                                    [
                                        'label' => 'All Projects',
                                        'icon' => 'bi-kanban',
                                        'route' => 'admin.allprojects',
                                        'active' => ['admin.allprojects', 'admin.post-leads.*'],
                                    ],
                                    [
                                        'label' => 'Engineer Desk Flow',
                                        'icon' => 'bi-diagram-3-fill',
                                        'route' => 'admin.engineer-desk.create',
                                        'active' => ['admin.engineer-desk.*'],
                                    ],
                                ],
                            ],
                            [
                                'title' => 'HR',
                                'icon' => 'bi-people',
                                'visible' => $role === 'super_admin',
                                'items' => [
                                    [
                                        'label' => 'User Management',
                                        'icon' => 'bi-person-gear',
                                        'route' => 'admin.users.index',
                                        'active' => ['admin.users.*'],
                                    ],
                                ],
                            ],
                            [
                                'title' => 'Content',
                                'icon' => 'bi-newspaper',
                                'visible' => true,
                                'items' => [
                                    [
                                        'label' => 'Blogs',
                                        'icon' => 'bi-journal-richtext',
                                        'route' => 'admin.blogs.index',
                                        'active' => ['admin.blogs.*'],
                                    ],
                                    [
                                        'label' => 'Construction Education Posts',
                                        'icon' => 'bi-instagram',
                                        'route' => 'construction-education-posts.index',
                                        'active' => ['construction-education-posts.*', 'admin.construction-education-posts.*'],
                                    ],
                                ],
                            ],
                            [
                                'title' => 'Purchase Management',
                                'icon' => 'bi-cart-check',
                                'visible' => $canSeeAdminModules,
                                'items' => [
                                    ['label' => 'All Orders', 'icon' => 'bi-box-seam', 'route' => 'admin.orders.index', 'active' => ['admin.orders.index']],
                                    ['label' => 'Contractor Orders', 'icon' => 'bi-bricks', 'route' => 'admin.orders.contractor', 'active' => ['admin.orders.contractor']],
                                    ['label' => 'Interior Orders', 'icon' => 'bi-layout-text-window', 'route' => 'admin.orders.interior', 'active' => ['admin.orders.interior']],
                                    ['label' => 'Survey Orders', 'icon' => 'bi-compass', 'route' => 'admin.orders.survey', 'active' => ['admin.orders.survey']],
                                    ['label' => 'Testing Orders', 'icon' => 'bi-clipboard2-pulse', 'route' => 'admin.orders.testing', 'active' => ['admin.orders.testing']],
                                    ['label' => 'BOQ Orders', 'icon' => 'bi-calculator', 'route' => 'admin.orders.boq', 'active' => ['admin.orders.boq']],
                                ],
                            ],
                            [
                                'title' => 'Store & Inventory',
                                'icon' => 'bi-boxes',
                                'visible' => $canSeeAdminModules,
                                'items' => [
                                    ['label' => 'Vendors', 'icon' => 'bi-person-badge', 'route' => 'admin.allvendors', 'active' => ['admin.allvendors']],
                                ],
                            ],
                            [
                                'title' => 'Masters',
                                'icon' => 'bi-sliders',
                                'visible' => $canSeeAdminModules,
                                'items' => [
                                    ['label' => 'Tracking Templates', 'icon' => 'bi-list-check', 'route' => 'admin.tracking_templates.index', 'active' => ['admin.tracking_templates.*']],
                                ],
                            ],
                            [
                                'title' => 'Site Work',
                                'icon' => 'bi-building-gear',
                                'visible' => $canSeeAdminModules,
                                'items' => [
                                    ['label' => 'Project Tracking', 'icon' => 'bi-signpost-split', 'route' => 'admin.order_tracking.index', 'active' => ['admin.order_tracking.*']],
                                ],
                            ],
                            [
                                'title' => 'Settings',
                                'icon' => 'bi-gear',
                                'visible' => $canSeeAdminModules,
                                'items' => [
                                    ['label' => 'Settings', 'icon' => 'bi-gear', 'url' => '#', 'active' => []],
                                ],
                            ],
                        ];

                        $visibleModules = array_values(array_filter($sidebarModules, fn ($module) => $module['visible'] && count($module['items'])));
                    @endphp

                    @foreach($visibleModules as $moduleIndex => $module)
                        @php
                            $moduleIsOpen = collect($module['items'])->contains(function ($item) {
                                return collect($item['active'])->contains(fn ($pattern) => request()->routeIs($pattern));
                            });
                            $submenuId = 'sidebarModule' . $moduleIndex;
                        @endphp

                        <div class="sidebar-module {{ $moduleIsOpen || $moduleIndex === 0 ? 'open' : '' }}">
                            <button
                                type="button"
                                class="sidebar-module-btn {{ $moduleIsOpen ? 'active' : '' }}"
                                onclick="toggleSidebarModule('{{ $submenuId }}', this)"
                            >
                                <span class="sidebar-module-title">
                                    <i class="bi {{ $module['icon'] }}"></i>
                                    <span>{{ $module['title'] }}</span>
                                </span>
                                <i class="bi bi-plus dropdown-arrow"></i>
                            </button>

                            <div class="sidebar-submenu {{ $moduleIsOpen || $moduleIndex === 0 ? 'show' : '' }}" id="{{ $submenuId }}">
                                @foreach($module['items'] as $item)
                                    <a href="{{ isset($item['route']) ? route($item['route']) : $item['url'] }}"
                                       class="{{ collect($item['active'])->contains(fn ($pattern) => request()->routeIs($pattern)) ? 'active' : '' }}">
                                        <span class="menu-left">
                                            <i class="bi {{ $item['icon'] }}"></i>
                                            <span>{{ $item['label'] }}</span>
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    @if(false)
                    @if(auth()->user()->role !== 'marketing')
                    <a href="{{ route('admin.dashboard') }}"
                       class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <span class="menu-left">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </span>
                    </a>

                    @if(auth()->user()->role === 'super_admin')
                        <a href="{{ route('admin.users.index') }}"
                           class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <span class="menu-left">
                                <i class="bi bi-people"></i>
                                <span>User Management</span>
                            </span>
                        </a>
                    @endif

                    <a href="{{ route('admin.allprojects') }}"
                       class="{{ request()->routeIs('admin.allprojects') ? 'active' : '' }}">
                        <span class="menu-left">
                            <i class="bi bi-kanban"></i>
                            <span>Projects</span>
                        </span>
                    </a>

                    <a href="{{ route('admin.engineer-desk.create') }}"
                       class="{{ request()->routeIs('admin.engineer-desk.*') ? 'active' : '' }}">
                        <span class="menu-left">
                            <i class="bi bi-diagram-3-fill"></i>
                            <span>Engineer Desk Flow</span>
                        </span>
                    </a>

                    <a href="{{ route('admin.vendor.strategy') }}"
                       class="{{ request()->routeIs('admin.vendor.strategy') ? 'active' : '' }}">
                        <span class="menu-left">
                            <i class="bi bi-diagram-3"></i>
                            <span>Vendor Strategy</span>
                        </span>
                    </a>

                    <a href="{{ route('admin.allvendors') }}"
                       class="{{ request()->routeIs('admin.allvendors') ? 'active' : '' }}">
                        <span class="menu-left">
                            <i class="bi bi-person-badge"></i>
                            <span>Vendors</span>
                        </span>
                    </a>
                    @endif

                    <a href="{{ route('admin.blogs.index') }}"
                       class="{{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                        <span class="menu-left">
                            <i class="bi bi-journal-richtext"></i>
                            <span>Blogs</span>
                        </span>
                    </a>

                    <a href="{{ route('construction-education-posts.index') }}"
                       class="{{ request()->routeIs('construction-education-posts.*') || request()->routeIs('admin.construction-education-posts.*') ? 'active' : '' }}">
                        <span class="menu-left">
                            <i class="bi bi-instagram"></i>
                            <span>construction-education-posts</span>
                        </span>
                    </a>

                    @if(auth()->user()->role !== 'marketing')
                    @php
                        $ordersMenuOpen =
                            request()->routeIs('admin.orders.index') ||
                            request()->routeIs('admin.orders.contractor') ||
                            request()->routeIs('admin.orders.interior') ||
                            request()->routeIs('admin.orders.survey') ||
                            request()->routeIs('admin.orders.testing') ||
                            request()->routeIs('admin.orders.boq') ||
                            request()->routeIs('admin.tracking_templates.*') ||
                            request()->routeIs('admin.order_tracking.*');
                    @endphp

                    <button
                        type="button"
                        class="sidebar-dropdown-btn {{ $ordersMenuOpen ? 'active' : '' }}"
                        onclick="toggleOrdersMenu()"
                        id="ordersMenuBtn"
                    >
                        <span class="menu-left">
                            <i class="bi bi-box-seam"></i>
                            <span>Orders</span>
                        </span>
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
                            Tracking Templates
                        </a>

                        <a href="{{ route('admin.order_tracking.index') }}"
                           class="{{ request()->routeIs('admin.order_tracking.*') ? 'active' : '' }}">
                            Project Tracking
                        </a>
                    </div>

                    <a href="#">
                        <span class="menu-left">
                            <i class="bi bi-gear"></i>
                            <span>Settings</span>
                        </span>
                    </a>
                    @endif

                    @endif

                    <form action="{{ route('admin.logout') }}" method="POST" class="mt-3">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
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
    function toggleSidebarModule(submenuId, button) {
        const submenu = document.getElementById(submenuId);
        const module = button.closest('.sidebar-module');

        submenu.classList.toggle('show');
        module.classList.toggle('open');
        button.classList.toggle('active');
    }

    function toggleSidebar() {
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');

        sidebar.classList.toggle('show');
        overlay.classList.toggle('show');
    }
</script>

@stack('scripts')
</body>
</html>
