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
            <div class="col-12 mt-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('index') }}">@lang('messages.lblilnav1')</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('messages.lblilnav2')</li>
                        <li class="ml-auto">
                            <searchbar searchtext="@lang('messages.lbsearch')"></searchbar>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <product lbprodsize="@lang('messages.lbprodsize')" lbprodtot="@lang('messages.lbprodtot')"
                 lbprodbut="@lang('messages.lbprodbut')" art="{{ $art }}"
                 @auth
                 @if(Auth::user()->adminRole())user="1"
                 @else user="{{ Auth::user()->idUser }}"
                 @endif
                 @else
                 user=""
                 @endauth
                 lbprodmod="@lang('messages.lbprodmodal')" lbprodadded="@lang('messages.lbprodadded')"
        ></product>
    </div>
@endsection

@section('footer')
    @parent
@endsection
