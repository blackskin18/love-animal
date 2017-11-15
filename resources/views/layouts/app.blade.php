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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" media="screen"
     href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

    <link href="{{ asset('css/layouts/app.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/popModal.css') }}">
    

    <script src="{{ asset('js/jquery-3.2.1.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>
    <script src="{{ asset('js/pagination/dirPagination.js') }}"></script>
    <script src="{{ asset('js/popModal.js') }}"></script>
    
    <script src="{{ asset('js/layouts/app.js') }}"></script>



    @yield('link-css')
    @yield('link-js')

</head>
<body ng-app="pagination">
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
                    <a class="navbar-brand" href="{{ url('/') }}" style="padding: 0;">
                        <img src="{{ asset('logo/logo_page.jpg') }}" height="50px" width="75" style="" alt="">
                        <!-- {{ config('app  .name', 'Love-pet') }} -->
                    </a>
                </div>
                
                <div class="collapse navbar-collapse" id="app-navbar-collapse" style="display: inline-block;">
                    <!-- Left Side Of Navbar -->
                    <div class="navbar-nav" style="width: 70%; height: 50px; margin-left: 115px">
                        <div style="display: inline-block; height: 100%;" >
                            <!-- <button class="btn btn-info"><span class="glyphicon glyphicon-envelope"></span></button> -->
                            <button id="btn-show-today-history"><img src="{{ asset('logo/Notify2.jpg') }}" style="background-size: cover;" width="35px" height="35px" alt=""></button>
                            <input type="text" class="search" id="search" ng-model="search" placeholder="Search">
                        </div>
                        <div id="datetimepicker" class="input-append datetime" style="display: inline-block;" >
                            <input type="text" class="searh" id="datetime-input" style="width: 0px">
                            <span class="add-on">
                                <i data-time-icon="icon-time" class="glyphicon glyphicon-time" data-date-icon="icon-calendar"> </i>
                            </span>
                        </div>

                        <!-- <div style="display: inline-block;">
                            <input type="text">
                        </div> -->
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
                                            a = window.open('https://accounts.google.com/Logout');
                                            $(a).ready(function(){
                                                a.close();
                                            })
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
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.min.js"> </script>
    <script type="text/javascript" src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js"> </script>
    <script type="text/javascript" src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js"></script>
    <script type="text/javascript">
        $(function(){

                $('#datetimepicker').datetimepicker({
                    format: 'yyyy-MM-dd',
                    language: 'pt-BR'
                });
                $('body > div.bootstrap-datetimepicker-widget.dropdown-menu > ul > li.collapse.in > div > div.datepicker-days > table > tbody td').click(function(){
                    $('input#datetime-input').focus();
                });
                $('input#datetime-input').keydown(function(){
                    let dateValue = $('input#datetime-input').val();
                    $('input#search').val(dateValue);
                    $('body > div.bootstrap-datetimepicker-widget.dropdown-menu > ul > li.collapse.in > div > div.datepicker-days > table > tbody td').click(function(){
                        $('input#datetime-input').focus();
                    });
                    $('input#search').focus();
                })

        });
    </script>
    @yield('script')
</body>
</html>