@php
    App::setLocale(Session::get('locale'))
@endphp

@extends('layouts.mainlayout')

@section('navbar')
    @parent
@endsection

@section('navbar2')
@endsection

@section('hero')
@endsection

@section('main')
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-12 mg-log">

                <div class="row align-items-center">

                    <div class="col-md-5 colform rounded shadow">

                        <h4>@lang('messages.lblogin')</h4>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text iconlogin"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus
                                           placeholder="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group">
                                <!--<eye-pass newclass="form-control" campopass="@lang('messages.lbregpass')"></eye-pass>-->
                                    <eye-pass namepass="password" campopass="@lang('messages.lbregpass')"></eye-pass>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                        </form>
                    </div>


                    <div class="col-md-1"></div>

                    <div class="col-md-6">

                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100 caroimg" src="{{ asset('img/modelo.jpg') }}"
                                         alt="First slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100 caroimg" src="{{ asset('img/modelo2.jpg') }}"
                                         alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100 caroimg" src="{{ asset('img/modelo3.jpg') }}"
                                         alt="Third slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100 caroimg" src="{{ asset('img/modelo4.png') }}"
                                         alt="Fourth slide">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                               data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                               data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection
