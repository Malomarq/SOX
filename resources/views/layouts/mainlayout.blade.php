<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- TODO cambiar ruta en despliegue -->
    <base href="http://localhost/FINAL-SOX/sox/public/"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SOX') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
<div id="app">

    <!-- NAVBAR -->
    @section('navbar')

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

                <a class="navbar-brand" href="{{ route('index') }}">
                    <img src="{{ asset('img/lillogo.png') }}" width="30" height="30" class="d-inline-block align-top mr-1" alt="" loading="lazy">
                    SOX
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSox" aria-controls="navbarSox" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSox">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="modal" data-target="#exampleModalCenter2"
                               href="#">@lang('messages.lbshipping')<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="modal" data-target="#exampleModalCenter"
                               href="#">@lang('messages.lbcontact')</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        @if (Route::has('login'))
                            @auth

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink2"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @lang('messages.lbwelcome'), {{ Auth::user()->name }}!
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                                        @if(Auth::user()->adminRole())
                                            @if(url()->current() == route('admin'))
                                                <a href="{{ url('/') }}"
                                                   class="dropdown-item">Index</a>
                                            @else
                                                <a href="{{ url('/admin') }}"
                                                   class="dropdown-item">@lang('messages.lbhome')</a>
                                            @endif
                                        @else
                                            @if(url()->current() == route('profile'))
                                                <a href="{{ url('/') }}"
                                                   class="dropdown-item">Index</a>
                                            @else
                                                <a href="{{ url('/home') }}"
                                                   class="dropdown-item">@lang('messages.lbhome')</a>
                                            @endif
                                        @endif
                                        <a class="dropdown-item igcol"
                                           href="{{ route('logout') }}">@lang('messages.lblogout')</a>
                                    </div>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="btn btn-outline color-sox"
                                       href="{{ route('login') }}">@lang('messages.lblogin')</a>

                                    @if (Route::has('register'))
                                        <a class="btn btn-outline-light"
                                           href="{{ route('register') }}">@lang('messages.lbregister')</a>
                                    @endif
                                </li>
                            @endauth
                        @endif

                        @auth
                            @if(!Auth::user()->adminRole())
                                <li class="nav-item">
                                    <shopping-bag iduser="{{Auth::user()->idUser}}"></shopping-bag>
                                </li>
                            @endif
                        @endauth

                            <div class="nav-item dropdown">
                                <a class="navbar-brand nav-link ml-md-2" href="#" id="navbarDropdownMenuLink3"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-language fa-lg langho"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="navbarDropdownMenuLink3">
                                    <a class="dropdown-item"
                                       href="{{ route('language', ['url' => 'es']) }}">@lang('messages.lbspanish')</a>
                                    <a class="dropdown-item"
                                       href="{{ route('language', ['url' => 'en']) }}">@lang('messages.lbenglish')</a>
                                </div>
                            </div>
                    </ul>
                </div>
            </nav>

        <!-- MODAL CONTACTO -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-sox2"
                            id="exampleModalLongTitle">@lang('messages.lbcontact')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            @lang('messages.lbcontacttext')
                        </p>
                        <h6><b>Email:</b><a href="mailto:#"> info@sox.com</a></h6>
                        <br>
                        <h6><b>@lang('messages.lbphone'):</b> 789456123</h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL ENVÍOS -->
        <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-sox2"
                            id="exampleModalLongTitle">@lang('messages.lbshipping')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @lang('messages.lbshippingtext')
                    </div>
                </div>
            </div>
        </div>
    @show
<!-- END NAVBAR -->

    @section('navbar2')
        <!--<nav class="navbar navbar-expand-lg navbar-dark bg-light flex-column flex-md-row secnav shadow-sm"
             id="secNav">
            <div class="container">
                <ul class="nav navbar-nav mx-auto searchbar py-2">
                    <searchbar searchtext="@lang('messages.lbsearch')"></searchbar>
                </ul>-->
                <!--<ul class="navbar-nav ml-auto">
                    @auth
                        @if(!Auth::user()->adminRole())
                            <li class="nav-item">
                                <shopping-bag iduser="{{Auth::user()->idUser}}"></shopping-bag>
                            </li>
                        @endif
                    @endauth
                    <li class="nav-item dropdown">
                        <a class="nav-link text-dark infotag" href="#" id="navbarDropdownMenuLink"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-question-circle fa-2x"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" data-toggle="modal" data-target="#exampleModalCenter" href="#">
                                    <span class="mr-2 fbcol"><i
                                            class="fas fa-envelope"></i></span>@lang('messages.lbcontact')
                            </a>
                            <a class="dropdown-item" data-toggle="modal" data-target="#exampleModalCenter2"
                               href="#">
                                    <span class="mr-2 fbcol"><i
                                            class="fas fa-paper-plane"></i></span>@lang('messages.lbshipping')
                            </a>
                            <div class="dropdown-divider"></div>
                            <span class="dropdown-item" href="#">®2020&nbsp;<strong>SOX</strong></span>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>-->
    @show


<!-- HERO -->

    @section('hero')
    <!--<div class="jumbotron jumbotron-fluid bg-dark jumbonav">
            <div class="container container-fluid text-center">
                <img src="{{ asset('img/logo2.svg') }}" class="logo">
            </div>
        </div>-->
        <hero></hero>
    @show

<!--  END HERO -->

    @yield('content')

<!-- FOOTER -->

    @section('footer')
        <div class="jumbotron jumbotron-fluid jumbonav">
            <div class="container container-fluid text-center">
                <p>®2020&nbsp;<strong>SOX S.A.</strong> @lang('messages.lbfooter')</p>

                <div class="">
                    <i class="fab fa-facebook fa-2x mg-icons fbcol"></i>
                    <i class="fab fa-instagram fa-2x mg-icons igcol"></i>
                    <i class="fab fa-twitter fa-2x mg-icons twcol"></i>
                    <i class="fab fa-whatsapp fa-2x mg-icons wacol"></i>
                </div>
            </div>
        </div>
@show

<!--  END FOOTER -->

</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
