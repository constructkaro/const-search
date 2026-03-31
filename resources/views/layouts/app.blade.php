<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'My Laravel App')</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    {{-- Header --}}
    @include('partials.header')

    {{-- Main Content --}}
    <main class="container">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    <!-- JS -->
    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>