<template>
    <div class="container rounded mt-3 mb-5 px-5">

        <div v-if="showBag" class="row">

            <div class="col-12 col-md-7 order-1 order-md-1">
                <span class="rowprodsub">{{items}} items</span>
            </div>

            <div class="col-12 col-md-4 offset-md-1 order-md-2 order-3">
                <span class="rowprodsub">{{ordertxt}}</span>
            </div>

            <div class="col-12 col-md-7 bagborder order-md-3 order-2">

                <div class="row my-4" v-for="art in articles" :key="art.idSet">
                    <div class="container">
                        <div class="row">
                            <div class="col-4 col-md-4 p-2 p-md-0">
                                <a v-bind:href="'product?id=' + art.idArt">
                                    <b-img :src="'storage/articles/' + art.image" fluid class="imgbag"/>
                                </a>
                            </div>

                            <div class="col-6 col-md-6 pt-md-4">
                                <div class="row panuseraccsubtit px-2">
                                    <span>{{art.name}}</span>
                                </div>
                                <div class="row littleprice px-2">
                                    <span>{{art.price}}€</span>
                                </div>
                                <div class="row px-2 my-2">
                                    <select class="custom-select custom-select-sm col-2" v-model="amselected"
                                    @change="amountchange(art.idSet)">
                                        <option value="" selected>{{art.amount}}</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>

                                    <span class="deleteicon ml-4"><i class="far fa-trash-alt fa-2x"
                                    @click="deleteSet(art.idSet, art.idOrder)"></i></span>
                                </div>
                            </div>
                            <div class="col-2 col-md-2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4 offset-md-1 bagborder pricebag order-md-4 order-4 pt-md-4">
                <div class="row my-4">
                    <div class="col-12">
                        <div class="row px-2">
                            <div class="col-12 text-right prodtext3">
                                Subtotal:&nbsp;&nbsp; <span class="littleprice">{{setPrice}}€</span>
                            </div>
                        </div>
                        <div class="row px-2 mb-5">
                            <div class="col-12 text-right panuseraccsubtit">
                                <span class="mr-4">{{shipmtxt}}:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 3.95€
                            </div>
                        </div>
                        <div class="row px-2">
                            <div class="col-12 border-top border-dark text-right prodtext2">
                                TOTAL:&nbsp;&nbsp; <span class="littleprice">{{totalPrice}}€</span>
                            </div>
                        </div>
                        <div class="row px-5 mt-4">
                            <a href="http://localhost/sox/public/buy" class="btn btn-dark btn-lg btn-block">{{butbuytxt}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="showEmpty" class="row">
            <div class="col-12 col-md-7">
                <span class="rowprodsub">{{items}} items</span>
            </div>

            <div class="col-12 col-md-7 bagborder">
                <div class="my-5 panuseraccsubtit">{{bagemptytxt}}</div>
            </div>
        </div>
    </div>
</template>

<script>

    import EventBus from "../event-bus";

    const axios = require('axios').default;

    export default {
        props: {
            iduser: '',
            ordertxt: '',
            shipmtxt: '',
            butbuytxt: '',
            bagemptytxt: '',
        },
        data() {
            return {
                articles: {},
                setPrice: null,
                totalPrice: null,
                showEmpty: false,
                showBag: false,
                items: '',
                amselected: '',
            }
        },
        mounted() {
            this.getBag();
            this.getItems();
        },
        methods: {

            /**
             * Gets info of the shopping bag (sets and price). It also shows if bag is empty
             */
            getBag() {
                axios.post('api/getBag', {
                    '_token': this.$csrfToken,
                    'iduser': this.iduser,
                }).then((response) => {
                    (response.data === 'empty') ? this.showEmpty = true : this.showEmpty = false;
                    if (response.data !== 'empty') {
                        this.showBag = true;
                        this.articles = response.data['bag'];
                        this.setPrice = response.data['totalp'];
                        var tprice = this.setPrice + 3.95;
                        this.totalPrice = tprice.toFixed(2);
                    }
                });
            },

            /**
             * Gets the number of items in the bag
             */
            getItems() {
                axios.post('api/getItems', {
                    '_token': this.$csrfToken,
                    'iduser': this.iduser,
                }).then((response) => {
                    this.items = response.data
                });
            },

            /**
             * Updates amount of an item of the bag and reload the page
             * @param data
             */
            amountchange(data){
                axios.post('api/amountchange', {
                    '_token': this.$csrfToken,
                    'idSet': data,
                    'amount': this.amselected,
                }).then((response) => {
                    if(response.data === 'ok'){
                        location.reload();
                    }

                    if(response.data === 'error'){
                        location.href = 'http://localhost/sox/public/logout';
                    }
                });
            },

            /**
             * Deletes an item (set) of the bag (order) and reloads the page
             * @param idSet
             * @param idOrder
             */
            deleteSet(idSet, idOrder){
                axios.post('api/deleteSet', {
                    '_token': this.$csrfToken,
                    'idSet': idSet,
                    'idOrder': idOrder,
                }).then((response) => {
                    if(response.data === 'ok'){
                        location.reload();
                    }

                    if(response.data === 'error'){
                        location.href = 'http://localhost/sox/public/logout';
                    }
                });
            }
        }
    }

</script>
