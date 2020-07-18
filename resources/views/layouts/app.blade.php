<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.partials._head')
    <meta name="description" content="@yield('seo_description', setting('seo_description', ''))">
    <meta name="keywords" content="@yield('seo_keywords', setting('seo_keywords', ''))">
    @stack('og')
</head>
<body>
    <div id="app">
        @include('layouts.partials.front_end_navbar')

        <main class="site-main">
            @include('includes.error_message')
            @yield('content')
        </main>

        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-6">
                        <div class="mb-3">&copy; {{ now()->year }} {{ env('APP_NAME') }}</div>
                    </div>
                    <div class="col-md-3 col-6">
                        <ul class="list-unstyled">
                            @php $pages = \App\Post::pages()->get(); @endphp
                            @foreach($pages as $page)
                                <li><a href="{{ route('page', ['slug' => $page->slug]) }}">{{ $page->name }}</a></li>
                            @endforeach
                            <li><a href="{{ route('page', ['slug' => 'tentang']) }}">Tentang Kami</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

    </div>
    @stack('bottom_script')
</body>
</html>
