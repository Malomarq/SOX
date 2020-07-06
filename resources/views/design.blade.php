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
    <!--<div class="container my-5">
        <div class="row">
            <div class="col-12 text-center">
                <designer></designer>
            </div>
        </div>
    </div>-->
@endsection

@section('footer')
    @parent
@endsection
