<template>
    <div class="container rounded mb-5">

        <div v-if="showBag" class="row">

            <div class="col-12 col-md-7">
                <span class="rowprodsub">{{items}} items</span>
            </div>

            <div class="col-12 col-md-4 offset-md-1">
                <span class="rowprodsub">{{ordertxt}}</span>
            </div>

            <div class="col-12 bagborder col-md-7">
                <div class="row" v-for="art in articles" :key="art.idSet">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-6 p-0">
                                <a v-bind:href="'product?id=' + art.idArt"><b-img :src="'storage/articles/' + art.image" fluid class="imgbag"/></a>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <p>{{art.name}}</p>
                                </div>
                                <div class="row">
                                    <p>{{art.price}}€</p>
                                </div>
                                <div class="row">
                                    <p>cant:</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4 offset-md-1 bagborder pricebag">
                <p>Subtotal: {{setPrice}}€</p>
                <p>Gastos de envío: 3.95€</p>
                <p>TOTAL: {{totalPrice}}€</p>
            </div>
        </div>
        <div v-if="showEmpty" class="row">
            <p>Bag vacía</p>
        </div>
    </div>
</template>

<script>

    import EventBus from "../event-bus";

    const axios = require('axios').default;
    const pubkey = "6d489dd5cfb6966122feaca117e324d5eccd4a3536a3de14a713d03892a7e22a";

    export default {
        props: {
            iduser: '',
            ordertxt: '',
        },
        data() {
            return {
                articles: {},
                setPrice: null,
                totalPrice: null,
                showEmpty: false,
                showBag: false,
                items: '',
            }
        },
        mounted(){
            this.getBag();
            this.getItems();
        },
        methods: {
            getBag(){
                axios.post('api/getBag', {
                    'pubkey': pubkey,
                    '_token': this.$csrfToken,
                    'iduser': this.iduser,
                }).then((response) => {
                    (response.data === 'empty')? this.showEmpty = true : this.showEmpty = false;
                     if(response.data !== 'empty') {
                        this.showBag = true;
                        this.articles = response.data['bag'];
                        this.setPrice = response.data['totalp'];
                        var tprice = this.setPrice + 3.95;
                        this.totalPrice = tprice.toFixed(2);
                    }
                });
            },

            getItems(){
                axios.post('api/getItems', {
                    'pubkey': pubkey,
                    '_token': this.$csrfToken,
                    'iduser': this.iduser,
                }).then((response)=> {
                    this.items = response.data
                });
            },
        }
    }

</script>
