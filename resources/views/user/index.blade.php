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
    <user-panel account="@lang('messages.lbpanusacc')" orders="@lang('messages.lbpanusord')"
                notif="@lang('messages.lbpanusnot')" designs="@lang('messages.lbpanusdes')"
                delaccount="@lang('messages.lbpanusdel')"></user-panel>

    <!--<h5>{{ Auth::user() }}</h5>-->
@endsection

@section('footer')
    @parent
@endsection
