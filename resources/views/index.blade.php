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
            <div class="col-12 mt-5 small">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">@lang('messages.lblilnav1')</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">

                    <div class="col-md-4">
                        <div class="col-12">
                            <panelf header="@lang('messages.lbpanelfheader')"></panelf>

                            <!-- TODO enlace a panel de diseño -->
                                <div class="card my-5 cardsox border-light">
                                    <div class="card-body">
                                        @lang('messages.lbdesign')
                                    </div>
                                </div>

                        </div>
                    </div>

                    <div class="col-md-1"></div>

                    <div class="col-md-7">

                    <!--<div class="row justify-content-center">
                            {{--@foreach($arts as $item)--}}
                        <div class="col-4">
                            <div class="card">
                                <img class="card-img-top" src="{{--{{ asset("storage/articles/$item->image") }}--}}">
                                        <div class="card-body">
                                            <p class="card-text">Some quick example text to build on the card title
                                                and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                </div>
                            {{--@endforeach--}}
                        </div>-->

                        <!--<div class="row justify-content-center">
                            <div class="col-4">-->
                        <products-index totalmess="@lang('messages.lbtotalprods')"
                                        prodstext="@php echo strtolower(__('messages.lbpanadprods')); @endphp">
                        </products-index>
                        <!--</div>
                    </div>-->

                    <!--<div class="row justify-content-center">
                            <div class="col-6 mt-5">
                                {{--{{ $arts->links() }}--}}
                        </div>
                    </div>-->
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection
