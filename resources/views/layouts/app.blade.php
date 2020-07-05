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
                        <div class="mb-3">&copy; {{ env('APP_NAME') }}</div>

                        <ul class="list-unstyled">
                            <li><a href="{{ route('partner.login') }}">Login</a></li>
                            <li><a href="{{ route('partner.register') }}">Daftar</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-6">
                        <ul class="list-unstyled">
                            <a href="{{ route('articles.index') }}">{{ __('pages.articles') }}</a>
                            @php $pages = \App\Post::pages()->get(); @endphp
                            @foreach($pages as $page)
                                <li><a href="{{ route('page', ['slug' => $page->slug]) }}">{{ $page->name }}</a></li>
                            @endforeach
                            <li><a href="{{ route('page', ['slug' => 'tentang']) }}">Tentang</a></li>
                            <li><a href="{{ route('page', ['slug' => 'panduan']) }}">Panduan</a></li>
                            <li><a href="{{ route('page', ['slug' => 'tips']) }}">Tips</a></li>
                            <li><a href="{{ route('page', ['slug' => 'hubungi-kami']) }}">Hubungi Kami</a></li>
                            <li><a href="{{ route('page', ['slug' => 'syarat']) }}">Syarat &amp; Ketentuan</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

    </div>
    @stack('bottom_script')
</body>
</html>
