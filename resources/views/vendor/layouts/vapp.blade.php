<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Vendor Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --vendor-bg: #f6f8fb;
            --vendor-card: #ffffff;
            --vendor-navy: #071832;
            --vendor-navy-soft: #0b2f5a;
            --vendor-blue: #075c9f;
            --vendor-orange: #f47b20;
            --vendor-orange-dark: #df6415;
            --vendor-text: #071832;
            --vendor-muted: #667085;
            --vendor-line: #e4eaf2;
            --vendor-shadow: 0 16px 36px rgba(15, 23, 42, 0.06);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: var(--vendor-bg);
            color: var(--vendor-text);
        }

        a {
            text-decoration: none;
        }

        .dashboard-layout {
            display: flex;
        }

        .sidebar {
            width: 278px;
            min-height: 100vh;
            background: #ffffff;
            color: var(--vendor-text);
            position: fixed;
            left: 0;
            top: 0;
            padding: 22px 18px;
            z-index: 120;
            border-right: 1px solid var(--vendor-line);
            box-shadow: 8px 0 26px rgba(15, 23, 42, 0.04);
            display: flex;
            flex-direction: column;
        }

        .main-wrapper {
            margin-left: 278px;
            width: calc(100% - 278px);
            min-height: 100vh;
        }

        .header {
            min-height: 82px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 0 34px;
            border-bottom: 1px solid var(--vendor-line);
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .page-content {
            padding: 34px;
        }

        .brand {
            display: flex;
            align-items: center;
            flex-direction: column;
            gap: 10px;
            justify-content: center;
            min-height: 118px;
            padding: 12px;
            margin-bottom: 24px;
            border-radius: 16px;
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid var(--vendor-line);
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.05);
            color: var(--vendor-navy);
        }

        .brand-logo-wrap {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .brand-logo {
            display: block;
            width: auto;
            max-width: 196px;
            max-height: 54px;
            height: auto;
            object-fit: contain;
        }

        .brand-kicker {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 24px;
            padding: 0 10px;
            border-radius: 999px;
            background: #fff3e8;
            color: var(--vendor-orange-dark);
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .sidebar-label {
            margin: 0 10px 10px;
            color: #98a2b3;
            font-size: 11px;
            font-weight: 900;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #475467;
            padding: 13px 14px;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 800;
            transition: background 0.2s ease, color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
            margin-bottom: 8px;
            position: relative;
        }

        .sidebar-menu a i {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-size: 16px;
            background: rgba(255,255,255,0.08);
            background: #f2f6fb;
            color: var(--vendor-blue);
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: #fff4eb;
            color: var(--vendor-navy);
            transform: translateX(3px);
            box-shadow: none;
        }

        .sidebar-menu a.active::before {
            content: "";
            position: absolute;
            left: -18px;
            top: 12px;
            bottom: 12px;
            width: 4px;
            border-radius: 0 999px 999px 0;
            background: var(--vendor-orange);
        }

        .sidebar-menu a.active i {
            background: linear-gradient(135deg, var(--vendor-orange), #ffae42);
            color: #fff;
            box-shadow: 0 12px 22px rgba(244, 123, 32, 0.24);
        }

        .sidebar-footer {
            margin-top: auto;
            display: flex;
            gap: 12px;
            align-items: center;
            padding: 14px;
            border-radius: 16px;
            background: #f8fafc;
            border: 1px solid var(--vendor-line);
            color: #667085;
        }

        .sidebar-footer-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(244, 123, 32, 0.16);
            color: #ffae42;
            flex: 0 0 40px;
        }

        .sidebar-footer strong,
        .sidebar-footer span {
            display: block;
        }

        .sidebar-footer strong {
            color: var(--vendor-text);
            font-size: 14px;
        }

        .sidebar-footer span {
            margin-top: 3px;
            font-size: 12px;
            line-height: 1.35;
        }

        .header-left h2 {
            font-size: 26px;
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
            background: #f8fafc;
            border: 1px solid var(--vendor-line);
            min-height: 48px;
            padding: 0 16px;
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
            min-height: 48px;
            padding: 0 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-radius: 14px;
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
                width: 248px;
            }

            .main-wrapper {
                margin-left: 248px;
                width: calc(100% - 248px);
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
                display: block;
            }

            .brand {
                min-height: 82px;
                padding: 10px;
                margin-bottom: 14px;
                align-items: flex-start;
            }

            .brand-logo {
                max-width: 174px;
                max-height: 46px;
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

            .sidebar-label,
            .sidebar-footer,
            .brand-kicker {
                display: none;
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
