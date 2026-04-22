<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Vendor Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
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
            background: #111633;
            color: #fff;
            position: fixed;
            left: 0;
            top: 0;
            padding: 24px 0;
        }

        .main-wrapper {
            margin-left: 260px;
            width: calc(100% - 260px);
            min-height: 100vh;
        }

        .header {
            height: 72px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .page-content {
            padding: 24px;
        }

        .brand {
            font-size: 24px;
            font-weight: 800;
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #d5dbff;
            padding: 14px 22px;
            font-size: 15px;
            transition: 0.2s ease;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: #f5a623;
            color: #111633;
            font-weight: 700;
        }

        .header-left h2 {
            font-size: 22px;
            color: #111633;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .user-box {
            background: #f5f7fb;
            padding: 10px 16px;
            border-radius: 999px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #111633;
            font-weight: 600;
        }

        .logout-btn {
            background: #ef4444;
            color: #fff;
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
        }

        .card {
            background: #fff;
            border-radius: 16px;
            padding: 22px;
            box-shadow: 0 6px 24px rgba(0,0,0,0.05);
        }

        .grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 6px 24px rgba(0,0,0,0.05);
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

        .sidebar-menu a {
    display: flex;
    align-items: center;
    gap: 10px;
}

.sidebar-menu a .badge {
    margin-left: auto;
    font-size: 11px;
    padding: 5px 8px;
    border-radius: 20px;
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
            @yield('content')
        </div>
    </div>
</div>

@stack('scripts')
</body>
</html>