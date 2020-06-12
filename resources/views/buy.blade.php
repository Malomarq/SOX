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
         shipmcitytxt="@lang('messages.lbshipmcity')" paymtxt="@lang('messages.lbpaymtxt')"
         paymcredtxt="@lang('messages.lbpaymcredtxt')" paymcadtxt="@lang('messages.lbpaymcadtxt')"
         paymcvctxt="@lang('messages.lbpaymcvctxt')" butbuy="@lang('messages.lbcompra')"></buy>
@endsection

@section('footer')
    @parent
@endsection
