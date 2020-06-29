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
    @parent
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <designer></designer>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection
