<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Vendor Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --vendor-bg: #f4f7fb;
            --vendor-card: #ffffff;
            --vendor-navy: #111633;
            --vendor-navy-soft: #1e3766;
            --vendor-orange: #f5a623;
            --vendor-orange-dark: #eb7a2f;
            --vendor-text: #111633;
            --vendor-muted: #667085;
            --vendor-line: #e7edf5;
            --vendor-shadow: 0 10px 28px rgba(15, 23, 42, 0.06);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background:
                linear-gradient(rgba(17, 22, 51, 0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(17, 22, 51, 0.025) 1px, transparent 1px),
                var(--vendor-bg);
            background-size: 52px 52px, 52px 52px, auto;
            color: var(--vendor-text);
        }

        a {
            text-decoration: none;
        }

        .dashboard-layout {
            display: flex;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: linear-gradient(180deg, #111633 0%, #0d122b 100%);
            color: #fff;
            position: fixed;
            left: 0;
            top: 0;
            padding: 22px 14px;
            z-index: 120;
            box-shadow: 12px 0 36px rgba(17, 22, 51, 0.14);
        }

        .main-wrapper {
            margin-left: 260px;
            width: calc(100% - 260px);
            min-height: 100vh;
        }

        .header {
            min-height: 76px;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(14px);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 0 28px;
            border-bottom: 1px solid rgba(231, 237, 245, 0.9);
            box-shadow: 0 2px 18px rgba(15, 23, 42, 0.04);
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .page-content {
            padding: 28px;
        }

        .brand {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            min-height: 54px;
            padding: 0 8px 0 6px;
            margin-bottom: 22px;
            letter-spacing: 0;
        }

        .brand-logo {
            display: block;
            width: auto;
            max-width: 210px;
            height: 48px;
            object-fit: contain;
            filter: drop-shadow(0 8px 18px rgba(245,166,35,0.15));
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #d5dbff;
            padding: 14px 14px;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 700;
            transition: background 0.2s ease, color 0.2s ease, transform 0.2s ease;
            margin-bottom: 8px;
        }

        .sidebar-menu a i {
            width: 22px;
            text-align: center;
            font-size: 16px;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: var(--vendor-orange);
            color: var(--vendor-navy);
            transform: translateX(2px);
        }

        .header-left h2 {
            font-size: 24px;
            color: var(--vendor-text);
            line-height: 1.2;
            font-weight: 900;
        }

        .header-left p {
            color: var(--vendor-muted);
            margin-top: 4px;
            font-size: 13px;
            font-weight: 700;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .user-box {
            background: #f5f7fb;
            border: 1px solid var(--vendor-line);
            padding: 10px 16px;
            border-radius: 999px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--vendor-text);
            font-weight: 800;
        }

        .logout-btn {
            background: #ef4444;
            color: #fff;
            min-height: 42px;
            padding: 0 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 800;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .logout-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(239, 68, 68, 0.18);
        }

        .card {
            background: var(--vendor-card);
            border-radius: 16px;
            padding: 22px;
            border: 1px solid var(--vendor-line);
            box-shadow: var(--vendor-shadow);
        }

        .grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .stat-card {
            background: var(--vendor-card);
            border-radius: 16px;
            padding: 20px;
            border: 1px solid var(--vendor-line);
            box-shadow: var(--vendor-shadow);
        }

        .stat-card h3 {
            font-size: 16px;
            color: #667085;
            margin-bottom: 10px;
        }

        .stat-card h2 {
            font-size: 30px;
            color: #111633;
        }

        .vendor-alert {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            border-radius: 14px;
            padding: 14px 16px;
            margin-bottom: 18px;
            font-weight: 800;
            line-height: 1.5;
            border: 1px solid transparent;
            background: #fff;
        }

        .vendor-alert.success {
            color: #027a48;
            background: #ecfdf3;
            border-color: #abefc6;
        }

        .vendor-alert.error {
            color: #b42318;
            background: #fef3f2;
            border-color: #fecdca;
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 220px;
            }

            .main-wrapper {
                margin-left: 220px;
                width: calc(100% - 220px);
            }

            .grid-3 {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .dashboard-layout {
                display: block;
            }

            .sidebar {
                position: static;
                width: 100%;
                min-height: auto;
                padding: 14px 12px 0;
                border-radius: 0 0 18px 18px;
            }

            .brand {
                text-align: left;
                padding: 0 6px;
                margin-bottom: 14px;
            }

            .sidebar-menu {
                display: flex;
                overflow-x: auto;
                padding-bottom: 10px;
            }

            .sidebar-menu a {
                flex: 0 0 auto;
                padding: 12px 16px;
            }

            .main-wrapper {
                margin-left: 0;
                width: 100%;
            }

            .header {
                height: auto;
                min-height: 70px;
                gap: 14px;
                padding: 14px 16px;
                flex-wrap: wrap;
            }

            .header-left h2 {
                font-size: 20px;
            }

            .header-right {
                width: 100%;
                justify-content: space-between;
            }

            .page-content {
                padding: 16px;
            }
        }

        @media (max-width: 480px) {
            .user-box {
                max-width: calc(100% - 102px);
            }

            .user-box span {
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }
        }

        .sidebar-menu a {
    display: flex;
    align-items: center;
    gap: 10px;
}

        .sidebar-menu a .badge {
            margin-left: auto;
            min-width: 24px;
            height: 24px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            padding: 0 7px;
            border-radius: 20px;
            background: #ef4444;
            color: #fff;
        }
    </style>

    @stack('styles')
</head>
<body>

<div class="dashboard-layout">
    @include('vendor.partials.sidebar')

    <div class="main-wrapper">
        @include('vendor.partials.vheader')

        <div class="page-content">
            @if(session('success'))
                <div class="vendor-alert success">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="vendor-alert error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

@stack('scripts')
</body>
</html>
