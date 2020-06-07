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
                accounttext3="@lang('messages.lbpanusacc2')" currentpass="@lang('messages.lbpanuscurpass')"
                newpass="@lang('messages.lbpanusnewpass')" confirmpass="@lang('messages.lbpanusconfpass')"
                txtbut="@lang('messages.lbsavebutton')" upinfoerr="@lang('messages.lbpanuserrinfo')"
                uppasscurrerr="@lang('messages.lbpanuscurrerr')" uppassnewerr="@lang('messages.lbpanusnewerr')"
                uppassconferr="@lang('messages.lbpanusconferr')" deltext1="@lang('messages.lbpanusdel')"
                deltext2="@lang('messages.lbpanusdelmess')" deltext3="@lang('messages.lbpanusdelmess2')"
                deltext4="@lang('messages.lbpanusdelmess3')" mdelheader="@lang('messages.lbpanusdel')"
                mdeltext1="@lang('messages.lbpanusdelmess')" mdeltext2="@lang('messages.lbpanusdelmess4')"
                mdelbut="@lang('messages.lbpanusdelbut')"

    ></user-panel>

@endsection

@section('footer')
    @parent
@endsection
