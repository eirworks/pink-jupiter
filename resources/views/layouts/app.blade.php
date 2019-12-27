<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.partials._head')
</head>
<body>
    <div id="app">
        @include('layouts.partials.front_end_navbar')

        <main style="margin-top: 4.5rem">
            @include('includes.error_message')
            @yield('content')
        </main>

        <footer class="text-center my-5">
            <div class="mb-3">&copy; {{ env('APP_NAME') }}</div>
        </footer>

    </div>
    @stack('bottom_script')
</body>
</html>
