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

    <buy></buy>
@endsection

@section('footer')
    @parent
@endsection
