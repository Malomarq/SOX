<template>
    <div>

        <div class="col-12 py-3 bg-light">
            <span class="panadprodstxt"><i class="fas fa-truck mr-2"></i>{{address}}</span>
        </div>
        <div class="row py-3" v-for="item in sets" :key="item.idSet">
            <div class="col-12 col-md-3 offset-md-3 py-3 text-center">
                <a v-bind:href="'product?id=' + item.idArt">
                    <b-img :src="'storage/articles/' + item.image" fluid class="imgord"/>
                </a>
            </div>
            <div class="col-12 col-md-6 py-4">
                <div class="row justify-content-md-start justify-content-center panadprodstxt">{{item.name}}</div>
                <div class="row justify-content-md-start justify-content-center txtlight">x {{item.amount}}</div>
                <div class="row justify-content-md-start justify-content-center littleprice">{{item.price}}€</div>
            </div>
        </div>
    </div>
</template>

<script>

    const axios = require('axios').default;

    export default {
        props: {
            idorder: ''
        },
        data() {
            return {
                sets: [],
                address: '',
            }
        },
        mounted() {
            this.getSets();
        },
        methods: {

            // @vuese
            // Gets a summary of an order
            getSets() {
                axios.post('api/sets', {
                    '_token': this.$csrfToken,
                    'idOrder': this.idorder,
                }).then((response) => {
                    this.address = response.data[0]['address'];
                    this.sets = response.data;
                });
            }
        }
    }
</script>
