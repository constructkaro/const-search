<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    <link rel="icon" href="{{ asset('favicon.png') }}?v=2" type="image/png">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}?v=2" type="image/png">

    <!-- CSS -->
    <style>
        * {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            overflow-x: hidden;
        }

        .main-content {
            width: 100%;
            max-width: 100%;
            margin: 0;
            padding: 0;
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- Header --}}
    @include('partials.header')

    {{-- Main Content --}}
    <main class="main-content">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    <!-- JS -->
    @stack('scripts')

</body>
</html>
