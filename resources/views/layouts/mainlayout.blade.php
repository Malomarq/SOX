<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="http://localhost/sox/public/"/>

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
                <img src="{{ asset('img/lillogo.png') }}" width="30" height="30" class="d-inline-block align-top mr-1"
                     alt="" loading="lazy">
                SOX
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSox"
                    aria-controls="navbarSox" aria-expanded="false" aria-label="Toggle navigation">
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
                    <div class="modal-header border-0">
                        <h5 class="modal-title panuseracctit"
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
                    <div class="modal-header border-0">
                        <h5 class="modal-title panuseracctit"
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

    <!-- HERO -->

    @section('hero')
        <div class="jumbotron jumbotron-fluid bg-dark jumbonav shadow">
            <div class="container container-fluid text-center">
                <img src="{{ asset('img/logo2.svg') }}" class="logo">
            </div>
        </div>
    @show

<!--  END HERO -->

    @yield('content')

<!-- FOOTER -->

    @section('footer')

        <div class="row mainfooter py-4 no-gutters px-sm-2">
            <div class="col-sm-6 col-12 text-center text-sm-left">
                ®2020&nbsp;<strong>SOX S.A.</strong> @lang('messages.lbfooter')
            </div>
            <div class="col-sm-6 col-12 mt-sm-0 mt-4">
                <div class="row no-gutters justify-content-center justify-content-sm-end">
                    <div class="col-1 text-center offset-sm-8 ml-2"><i
                            class="fab fa-facebook fa-2x mg-icons fbcol"></i>
                    </div>
                    <div class="col-1 text-center ml-2"><i class="fab fa-instagram fa-2x mg-icons igcol"></i></div>
                    <div class="col-1 text-center ml-2"><i class="fab fa-twitter fa-2x mg-icons twcol"></i></div>
                    <div class="col-1 text-center ml-2"><i class="fab fa-whatsapp fa-2x mg-icons wacol"></i></div>
                </div>
            </div>
        </div>

@show

<!--  END FOOTER -->

</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
