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
    <div class="container">

        <div class="row">
            <div class="col-12 mt-5 small">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index') }}">@lang('messages.lblilnav1')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">@lang('messages.lblilnav2')</a>
                    </li>
                </ul>
            </div>
        </div>

        <product lbprodsize="@lang('messages.lbprodsize')" lbprodtot="@lang('messages.lbprodtot')"
                 lbprodbut="@lang('messages.lbprodbut')" art="{{ $art }}" user="{{ Auth::user() }}"
                 lbprodmod="@lang('messages.lbprodmodal')"
        ></product>
    </div>
@endsection

@section('footer')
    @parent
@endsection
