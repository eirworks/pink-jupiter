<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.partials._head')
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
                    <div class="col-md-3">
                        <div class="mb-3">&copy; {{ env('APP_NAME') }}</div>
                    </div>
                    <div class="col-md-3">
                        @php $pages = \App\Post::pages()->get(); @endphp
                        @foreach($pages as $page)
                            <ul class="list-unstyled">
                                <li><a href="{{ route('page', ['slug' => $page->slug]) }}">{{ $page->name }}</a></li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </footer>

    </div>
    @stack('bottom_script')
</body>
</html>
