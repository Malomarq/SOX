<template>

    <div class="container mb-5">
        <div class="row">
            <div class="col-12 col-md-6 col-sm-12 bagborder">
                <div class="row my-4">
                    <div class="container">
                        <div class="row my-2">
                            <span class="prodtext3 ml-5">{{shipmtxt}}</span>
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
                                    <label class="panadprodstxt">{{shipmphonetxt}}</label>
                                    <input type="text" class="form-control form-control-sm rounded-0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4 bagborder offset-md-1 pt-4">
                <div class="row mb-4">
                    <div class="container">
                        <div class="row my-2">
                            <span class="prodtext3 ml-5">{{ordertxt}}</span>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 col-md-12">
                                <div class="row" v-for="ord in order" :key="ord.idSet">
                                    <div class="col-6 col-md-6 panadprodstxt">{{ord.name}}</div>
                                    <div class="col-6 col-md-6 littleprice text-right">{{ord.price}}€</div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-md-12">
                                <div class="row">
                                    <div class="col-6 col-md-6 border-top pt-3 panadprodstxt">Subtotal:</div>
                                    <div class="col-6 col-md-6 panadprodstxt text-right">{{setPrice}}€</div>
                                </div>
                                <div class="row">
                                    <div class="col-6 col-md-6 panadprodstxt">{{shipmtxt}}:</div>
                                    <div class="col-6 col-md-6 panadprodstxt text-right">3.95€</div>
                                </div>
                                <div class="row">
                                    <div class="col-6 col-md-6 panadprodstxt">TOTAL:</div>
                                    <div class="col-6 col-md-6 littleprice text-right">{{totalPrice}}€</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-5 col-sm-12 bg-light paymborder pt-4 my-4">
                <div class="row mb-4">
                    <div class="container">
                        <div class="row my-2">
                            <span class="prodtext3 ml-5">{{paymtxt}}</span>
                        </div>
                        <div class="row mt-4 ml-3 mx-3">
                            <div class="col-10 col-md-10 col-sm-10">
                                <div class="row mb-2">
                                    <div class="col-12 col-md-12 col-sm-12">
                                        <span><i class="fab fa-cc-visa fa-3x deleteicon"></i></span>&nbsp;
                                        <span><i class="fab fa-cc-mastercard fa-3x deleteicon"></i></span>&nbsp;
                                        <span><i class="fab fa-cc-amex fa-3x deleteicon"></i></span>&nbsp;
                                        <span><i class="fab fa-cc-paypal fa-3x deleteicon"></i></span>
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

    const axios = require('axios').default;
    const pubkey = "6d489dd5cfb6966122feaca117e324d5eccd4a3536a3de14a713d03892a7e22a";

    export default {
        props: {
            iduser: null,
            shipmtxt: '',
            shipmnametxt: '',
            shipmlastnametxt: '',
            shipmaddtxt: '',
            shipmphonetxt: '',

            paymtxt: '',
            paymcredtxt: '',
            paymcadtxt: '',
            paymcvctxt: '',
            butbuy: '',
            ordertxt: '',
        },
        data() {
            return {
                order: {},
                setPrice: null,
                totalPrice: null,
            }
        },
        mounted() {
            this.getOrders();
        },
        methods: {
            getOrders() {
                axios.post('api/getBag', {
                    'pubkey': pubkey,
                    '_token': this.$csrfToken,
                    'iduser': this.iduser,
                }).then((response) => {
                    if (response.data !== 'empty') {
                        this.order = response.data['bag'];
                        this.setPrice = response.data['totalp'];
                        var tprice = this.setPrice + 3.95;
                        this.totalPrice = tprice.toFixed(2);
                    }
                });
            }
        }
    }
</script>
