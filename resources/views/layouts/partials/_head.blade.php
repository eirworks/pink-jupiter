<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title', '') {{ config('app.name', 'Laravel') }}</title>

@stack('external-script-src')

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/jasago.css') }}" rel="stylesheet">

@stack('headers')

<meta name="api_cities" content="{{ route('api.cities') }}">
<meta name="api_provinces" content="{{ route('api.provinces') }}">
<meta name="api_categories" content="{{ route('api.categories') }}">
<meta name="api_subcategories" content="{{ route('api.subcategories') }}">
