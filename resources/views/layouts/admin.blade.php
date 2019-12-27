<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.partials._head')
</head>
<body>
<div id="app">
    @include('layouts.partials.admin_navbar')

    <main style="margin-top: 4.5rem">
        @include('includes.error_message')
        @yield('content')
    </main>

</div>
@stack('bottom_script')
</body>
</html>
