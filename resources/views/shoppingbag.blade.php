@php
    App::setLocale(Session::get('locale'))
@endphp

@extends('layouts.mainlayout')

@section('navbar')
    @parent
@endsection

@section('navbar2')
    @parent
@endsection

@section('hero')
@endsection

@section('content')
    <div class="container prodtext mt-5 mb-3">
        <div class="row">
            <!--<div class="col-12 mt-5 small">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index') }}">@lang('messages.lblilnav1')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">@lang('messages.lbbagnav')</a>
                    </li>
                </ul>
            </div>-->
            <p>@lang('messages.lbbagnav')</p>
        </div>
    </div>

    <bag iduser="{{Auth::user()->idUser}}" ordertxt="@lang('messages.lbordertxt')"></bag>
@endsection

@section('footer')
    @parent
@endsection
