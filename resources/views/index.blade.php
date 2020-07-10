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

        <div class="row">
            <div class="col-12 mt-5">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">@lang('messages.lblilnav1')</li>
                            <li class="ml-auto"><searchbar searchtext="@lang('messages.lbsearch')"></searchbar></li>
                        </ol>
                    </nav>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">

                    <div class="col-md-4">
                        <div class="col-12">
                            <panelf header="@lang('messages.lbpanelfheader')"></panelf>

                            <a href="{{route('design')}}">
                                <div class="card my-5 cardsox border-light">
                                    <div class="card-body text-center">
                                        <span class="mock">@lang('messages.lbdesign')</span>
                                    </div>
                                </div>
                            </a>

                        </div>
                    </div>

                    <div class="col-md-1"></div>

                    <div class="col-md-7">
                        <products-index totalmess="@lang('messages.lbtotalprods')"
                                        prodstext="@php echo strtolower(__('messages.lbpanadprods')); @endphp">
                        </products-index>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection
