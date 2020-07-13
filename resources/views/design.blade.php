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
    <!--<div class="container-fluid designer">
        <div class="col-12 text-center">
            <video id="videosox" controls>
                <source src="{{asset('media/video.mp4')}}" type="video/mp4">
            </video>
        </div>
    </div>-->
    <div class="embed-responsive embed-responsive-16by9 designer">
        <iframe class="embed-responsive-item" src="{{asset('media/video.mp4')}}" allowfullscreen></iframe>
    </div>
@endsection

@section('footer')
    @parent
@endsection
