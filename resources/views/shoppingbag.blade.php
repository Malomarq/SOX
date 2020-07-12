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

    <div class="container mb-5">

        <div class="row">
            <div class="col-12 mt-5 mb-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('index') }}">@lang('messages.lblilnav1')</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('messages.lbbagnav')</li>
                        <li class="ml-auto">
                            <searchbar searchtext="@lang('messages.lbsearch')"></searchbar>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row prodtext mt-4 mb-3 px-5">
            <p class="p-2 p-md-0">@lang('messages.lbbagnav')</p>
        </div>
    </div>

    <bag iduser="{{Auth::user()->idUser}}" ordertxt="@lang('messages.lbordertxt')"
         shipmtxt="@lang('messages.lbshippmentcost')" butbuytxt="@lang('messages.lbcompra')"
         bagemptytxt="@lang('messages.lbemptybag')"></bag>
@endsection

@section('footer')
    @parent
@endsection
