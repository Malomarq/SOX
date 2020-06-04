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
    <div class="container mg-reg">
        <div class="row shadow">

            <div class="col-md-7 p-0 d-none d-md-block">
                <div class="backg">
                    <img class="" src="{{ asset('img/model3.jpg') }}">
                    <div class="text1">
                        <span>@lang('messages.lbregbann1')</span>
                    </div>
                    <div class="text2">
                        <span>@lang('messages.lbregbann2')</span>
                    </div>
                </div>
            </div>

            <div class="col-md-5 colform p-5">
                <div class="mb-2">
                    <h4>@lang('messages.lbregister')</h4>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group row">

                        <div class="input-group px-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text iconlogin"><i class="fas fa-user"></i></span>
                            </div>
                            <input id="name" type="text"
                                   class="form-control @error('name') is-invalid @enderror" name="name"
                                   value="{{ old('name') }}" required autocomplete="name" autofocus
                                   placeholder="@lang('messages.lbregname')">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="input-group px-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text iconlogin"><i class="fas fa-user-tag"></i></span>
                            </div>
                            <input id="lastname" type="text"
                                   class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                   value="{{ old('lastname') }}" required autocomplete="lastname" autofocus
                                   placeholder="@lang('messages.lbreglastname')">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="input-group px-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text iconlogin"><i class="fas fa-at"></i></span>
                            </div>
                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror" name="email"
                                   value="{{ old('email') }}" required autocomplete="email"
                                   placeholder="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row px-3">
                        <eye-pass customclass="form-control @error('password') is-invalid @enderror"
                                  namepass="password" campopass="@lang('messages.lbregpass')"></eye-pass>

                        @error('password')
                        <small class="text-danger">
                            <strong>{{ $message }}</strong>
                        </small>
                        @enderror
                    </div>


                    <div class="form-group row px-3">
                        <eye-pass customclass="form-control" namepass="password_confirmation"
                                  campopass="@lang('messages.lbregconfpass')"></eye-pass>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">
                                @lang('messages.lbregbutton')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection
