<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.partials._head', ['skip_custom_css' => true])
</head>
<body>
<div id="app">
    @include('layouts.partials.admin_navbar')

    <main style="margin: 4.5rem 0">
        @include('includes.error_message')
        @yield('content')
    </main>

</div>
@stack('bottom_script')
</body>
</html>
