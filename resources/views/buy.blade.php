@php
    App::setLocale(Session::get('locale'))
@endphp

@extends('layouts.mainlayout')

@section('navbar')
    @parent
@endsection

@section('hero')
@endsection

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('index') }}">@lang('messages.lblilnav1')</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('bag') }}">@lang('messages.lbbagnav')</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('messages.lbbuyform')</li>
                        <li class="ml-auto">
                            <searchbar searchtext="@lang('messages.lbsearch')"></searchbar>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="container prodtext mt-5 mb-3">
        <div class="row pl-5">
            <p class="p-md-0">@lang('messages.lbbuyform')</p>
        </div>
    </div>

    <buy shipmtxt="@lang('messages.lbshipmtxt')" shipmnametxt="@lang('messages.lbregname')"
         shipmlastnametxt="@lang('messages.lbreglastname')" shipmaddtxt="@lang('messages.lbshipmadd')"
         shipmphonetxt="@lang('messages.lbphone')" paymtxt="@lang('messages.lbpaymtxt')"
         paymcredtxt="@lang('messages.lbpaymcredtxt')" paymcadtxt="@lang('messages.lbpaymcadtxt')"
         paymcvctxt="@lang('messages.lbpaymcvctxt')" butbuy="@lang('messages.lbcompra')"
         ordertxt="@lang('messages.lbordertxt')" iduser="{{Auth::user()->idUser}}"
         gifttxt="@lang('messages.lbgifttxt')" giftyes="@lang('messages.lbgiftyes')"
         giftno="@lang('messages.lbgiftno')" ban1="@lang('messages.lbban1')" ban2="@lang('messages.lbban2')"
         ban3="@lang('messages.lbban3')"></buy>

@endsection

@section('footer')
    @parent
@endsection
