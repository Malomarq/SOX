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
    <div class="container designer my-5">
        <div class="row align-items-center">
            <div class="col-sm-6 col-12 my-4">
                <video id="videosox" controls class="shadow">
                    <source src="{{asset('media/video.mp4')}}" type="video/mp4">
                </video>
            </div>
            <div class="col-sm-4 col-12 offset-sm-2 text-center text-sm-left">
                <span class="prodtext"><i>@lang('messages.lbdesignerprox')</i></span>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection
