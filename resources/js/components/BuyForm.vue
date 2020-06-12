<template>

    <div class="container mb-5">
        <div class="row">
            <div class="col-12 col-md-6 col-sm-12 bagborder">
                <div class="row my-4">
                    <div class="container">
                        <div class="row my-2">
                            <span class="prodtext3 p-2">{{shipmtxt}}</span>
                        </div>
                        <div class="row mt-4 ml-3 mx-3">
                            <div class="col-12 col-md-5">
                                <div class="form-group">
                                    <label class="panadprodstxt">{{shipmnametxt}}</label>
                                    <input type="text" class="form-control form-control-sm rounded-0">
                                </div>
                            </div>
                            <div class="col-12 col-md-5">
                                <div class="form-group">
                                    <label class="panadprodstxt">{{shipmlastnametxt}}</label>
                                    <input type="text" class="form-control form-control-sm rounded-0">
                                </div>
                            </div>
                        </div>
                        <div class="row mx-3">
                            <div class="col-6 col-md-6">
                                <div class="form-group">
                                    <label class="panadprodstxt">{{shipmaddtxt}}</label>
                                    <input type="text" class="form-control form-control-sm rounded-0">
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="form-group">
                                    <label class="panadprodstxt">{{shipmcitytxt}}</label>
                                    <input type="text" class="form-control form-control-sm rounded-0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4 bagborder offset-md-1"></div>

            <div class="col-12 col-md-5 col-sm-12 bg-light bagborder pt-4 my-4">
                <div class="row mb-4">
                    <div class="container">
                        <div class="row my-2">
                            <span class="prodtext3 p-2">{{paymtxt}}</span>
                        </div>
                        <div class="row mt-4 ml-3 mx-3">
                            <div class="col-10 col-md-10 col-sm-10">
                                <div class="row mb-2">
                                    <div class="col-12 col-md-12 col-sm-12">
                                        <span><i class="fab fa-cc-visa fa-2x deleteicon"></i></span>&nbsp;
                                        <span><i class="fab fa-cc-mastercard fa-2x deleteicon"></i></span>&nbsp;
                                        <span><i class="fab fa-cc-amex fa-2x deleteicon"></i></span>&nbsp;
                                        <span><i class="fab fa-cc-paypal fa-2x deleteicon"></i></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-12 col-sm-12">
                                        <input type="text" class="form-control" :placeholder="paymcredtxt">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6 col-md-6 col-sm-6">
                                        <input type="text" class="form-control" :placeholder="paymcadtxt">
                                    </div>
                                    <div class="col-6 col-md-6 col-sm-6">
                                        <input type="text" class="form-control" :placeholder="paymcvctxt">
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <button type="button" class="btn btn-primary btn-block">{{butbuy}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: {
            shipmtxt: '',
            shipmnametxt: '',
            shipmlastnametxt: '',
            shipmaddtxt: '',
            shipmcitytxt: '',

            paymtxt: '',
            paymcredtxt: '',
            paymcadtxt: '',
            paymcvctxt: '',
            butbuy: '',
        }
    }
</script>
