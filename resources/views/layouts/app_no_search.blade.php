<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/popModal.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/layouts/app_no_search.css') }}" rel="stylesheet">

    <script src="{{ asset('js/jquery-3.2.1.js') }}"></script>
    <script src="{{ asset('js/popModal.js') }}"></script>
    <script src="{{ asset('js/layouts/app.js') }}"></script>

    @yield('link-css')
    @yield('link-js')

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container" style="margin-left: 10px; width: 1050px; display: inline-block;">
                <div class="navbar-header" style="display: inline-block;">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}" style="padding: 0; margin-left: 30px">
                        <img src="{{ asset('logo/logo_page.png') }}" height="50px"  style="" alt="">
                        <!-- {{ config('app  .name', 'Love-pet') }} -->
                    </a>
                </div>
                
                <div class="collapse navbar-collapse" id="app-navbar-collapse" style="display: inline-block;">
                    <!-- Left Side Of Navbar -->
                    <div class="navbar-nav" style="width: 70%; height: 50px">
                        <div style="display: inline-block; height: 100%; margin: auto; margin-left: 70px;" >
                            <button id="btn-show-today-history"><img src="{{ asset('logo/time_128.png') }}" style="background-size: cover;" width="35px" height="35px" alt=""></button>
                            <input type="text" class="search"  id="search-box" placeholder="Search" disabled class="form-control" style="display: inline-block;">
                        </div>
                    </div>
                    <!-- Right Side Of Navbar -->
                </div>
            </div>
            <ul class="nav navbar-nav navbar-right" style="display: inline-block; margin:5px 15px 0 0;  height:40px; ;border-radius: 10%; border: 2px solid #E9ECEE">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color: rgba(240, 104, 34, 1); padding: 8px 15px 0px 15px;">
                            <b>{{ Auth::user()->name }} </b><span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="/volunteer/info/{{Auth::user()->id}}">
                                    Trang Cá Nhân
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Đăng Xuất
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>

        </nav>

        @yield('index')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
</body>
</html>

