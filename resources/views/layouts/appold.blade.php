<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'My Laravel App')</title>

    <!-- CSS -->
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

</body>
</html>