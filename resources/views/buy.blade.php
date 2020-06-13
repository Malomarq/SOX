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
            <p class="p-2 p-md-0">@lang('messages.lbbuyform')</p>
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
