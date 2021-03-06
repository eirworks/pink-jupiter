<div class="fixed-top shadow-sm">
    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'MM3000') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">{{ __('ads.type_service') }}</a></li>
                    <li class="nav-item"><a href="{{ route('shops') }}" class="nav-link">{{ __('ads.type_shop') }}</a></li>
                    <li class="nav-item"><a href="{{ route('tools') }}" class="nav-link">{{ __('ads.type_tools') }}</a></li>
                    <li class="nav-item"><a href="{{ route('articles.index') }}" class="nav-link">{{ __('pages.articles') }}</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item"><a href="{{ route('partner.register') }}" class="nav-link">{{ __('auth.partner.register') }}</a></li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('partner.login') }}">{{ __('Login') }}</a>
                        </li>
                        {{--                            @if (Route::has('register'))--}}
                        {{--                                <li class="nav-item">--}}
                        {{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
                        {{--                                </li>--}}
                        {{--                            @endif--}}
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if(auth()->user()->type == \App\User::TYPE_ADMIN)
                                    <a class="dropdown-item" href="{{ route('admin.home') }}">{{ __('admin.admin_home') }}</a>
                                @endif
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('auth.edit_profile') }}</a>
                                @if(auth()->user()->type == \App\User::TYPE_PARTNER)
                                    <a class="dropdown-item" href="{{ route('partner.services.index') }}">{{ __('ads.ads_title') }}</a>
                                    <a class="dropdown-item" href="{{ route('transactions.index') }}">{{ __('profile.balance') }}</a>
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
{{--    <div class="bg-danger bg-white px-3 pb-2 d-block d-md-none">--}}
{{--        <input type="text" class="form-control" name="search" placeholder="Cari layanan">--}}
{{--    </div>--}}
</div>
