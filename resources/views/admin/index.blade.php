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
<admin-panel idad="{{Auth::user()->idUser}}" account="@lang('messages.lbpanadacc')"
             users="@lang('messages.lbpanadusers')" articles="@lang('messages.lbpanadprods')"
             orders="@lang('messages.lbpanadord')" newadmin="@lang('messages.lbpanadnewad')"
             contact="@lang('messages.lbpanadcont')">
</admin-panel>
@endsection

@section('footer')
    @parent
@endsection
