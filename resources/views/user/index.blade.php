@php
    App::setLocale(Session::get('locale'))
@endphp

@extends('layouts.mainlayout')

@section('navbar')
    @parent
@endsection

@section('hero')
@endsection

@section('main')
@endsection

@section('content')
    <user-panel idu="{{ Auth::user()->idUser }}" account="@lang('messages.lbpanusacc')"
                orders="@lang('messages.lbpanusord')" notif="@lang('messages.lbpanusnot')"
                designs="@lang('messages.lbpanusdes')" delaccount="@lang('messages.lbpanusdel')"
                accounttext1="@lang('messages.lbpanusacc')" name="@lang('messages.lbregname')"
                lastname="@lang('messages.lbreglastname')" accounttext2="@lang('messages.lbpanusacc1')"
                accounttext3="@lang('messages.lbpanusacc2')"
    ></user-panel>

@endsection

@section('footer')
    @parent
@endsection
