<template>

    <div class="container mb-5">

            <form @submit.prevent="buybag" class="row">
                <div class="col-12 col-md-6 col-sm-12 border mb-4 bg-light">
                    <div class="row my-4">
                        <div class="container">
                            <div class="row my-2">
                                <span class="prodtext3 ml-5">{{shipmtxt}}</span>
                            </div>
                            <div class="row mt-4 mx-3">
                                <div class="col-12 col-md-5">
                                    <div class="form-group">
                                        <label class="panadprodstxt">{{shipmnametxt}}</label>
                                        <input type="text" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-5">
                                    <div class="form-group">
                                        <label class="panadprodstxt">{{shipmlastnametxt}}</label>
                                        <input type="text" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-3">
                                <div class="col-6 col-md-6">
                                    <div class="form-group">
                                        <label class="panadprodstxt">{{shipmaddtxt}}</label>
                                        <input v-model="address" type="text" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4">
                                    <div class="form-group">
                                        <label class="panadprodstxt">{{shipmphonetxt}}</label>
                                        <input type="text" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row my-5 mx-4">
                                <div class="col-6 col-md-6 buygift">{{gifttxt}}</div>
                                <div class="col-6 col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="gift" type="radio" value="1">
                                        <label class="form-check-label panadprodstxt">{{giftyes}}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="gift" type="radio" value="0">
                                        <label class="form-check-label panadprodstxt">{{giftno}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-5 mx-4 shipmban py-4 rounded shadow text-light">
                                <div class="col-12 col-md-12">
                                    <div class="row">
                                        <div class="col-12 col-md-2 offset-md-1 text-center">
                                            <span><i class="fas fa-check fa-2x"></i></span>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <span>{{ban1}}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-2 offset-md-1 text-center">
                                            <span><i class="fas fa-check fa-2x"></i></span>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <span>{{ban2}}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-2 offset-md-1 text-center">
                                            <span><i class="fas fa-check fa-2x"></i></span>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <span>{{ban3}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 offset-md-1">

                    <div class="col-12 col-md-12 bagborder pt-4 mb-4">
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
                                            <div class="col-6 col-md-6 panadprodstxt pt-3 text-right">{{setPrice}}€
                                            </div>
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

                    <div class="col-12 col-md-12 bg-light paymborder pt-4 mb-4">
                        <div class="row mb-4">
                            <div class="container">
                                <div class="row my-2">
                                    <span class="prodtext3 ml-5">{{paymtxt}}</span>
                                </div>
                                <div class="row mt-4 ml-3 mx-3">
                                    <div class="col-12 col-md-12 col-sm-12">
                                        <div class="col-12 col-md-12 col-sm-12 mb-2 text-center">
                                            <span><i class="fab fa-cc-visa fa-3x deleteicon"></i></span>&nbsp;
                                            <span><i class="fab fa-cc-mastercard fa-3x deleteicon"></i></span>&nbsp;
                                            <span><i class="fab fa-cc-amex fa-3x deleteicon"></i></span>&nbsp;
                                            <span><i class="fab fa-cc-paypal fa-3x deleteicon"></i></span>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-sm-12">
                                                <input type="text" class="form-control" :placeholder="paymcredtxt"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-6 col-md-6 col-sm-6">
                                                <input type="text" class="form-control" :placeholder="paymcadtxt"
                                                       required>
                                            </div>
                                            <div class="col-6 col-md-6 col-sm-6">
                                                <input type="text" class="form-control" :placeholder="paymcvctxt"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="row my-4">
                                            <button type="submit" class="btn btn-primary btn-block">{{butbuy}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>

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
            gifttxt: '',
            giftyes: '',
            giftno: '',

            ban1: '',
            ban2: '',
            ban3: '',

            paymtxt: '',
            paymcredtxt: '',
            paymcadtxt: '',
            paymcvctxt: '',
            butbuy: '',
            ordertxt: '',
        },
        data() {
            return {
                order: [],
                setPrice: null,
                totalPrice: null,
                address: '',
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
            },
            buybag() {
                axios.post('api/buybag', {
                    'pubkey': pubkey,
                    '_token': this.$csrfToken,
                    'iduser': this.iduser,
                    'address': this.address,
                }).then((response) => {
                    // TODO modificar url final
                    location.href = 'http://localhost/sox/public';
                });
            }
        }
    }
</script>
