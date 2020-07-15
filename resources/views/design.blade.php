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
            <div class="col-sm-5 col-12 offset-sm-1 text-center text-sm-left">
                <div class="card border-0">
                    <img src="{{asset('img/comic2.png')}}" width="100%">

                    <!-- TODO incluir enlace en la memoria
                    <a href="https://www.freepik.es/fotos-vectores-gratis/vintage">Vector de Vintage creado por 0melapics - www.freepik.es</a>-->
                </div>

            </div>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection
