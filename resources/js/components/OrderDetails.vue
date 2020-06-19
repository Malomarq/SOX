<template>
<div class="container">
    <!--<div class="col-12 col-md-12">
    <div class="row">-->
        <div class="row py-3 border" v-for="item in sets" :key="item.idSet">
            <div class="col-md-3 py-3 text-center">
                <a v-bind:href="'product?id=' + item.idArt">
                    <b-img :src="'storage/articles/' + item.image" fluid class="imgord"/>
                </a>
            </div>

            <div class="col-md-3 py-3 text-center">
                    {{item.name}}</div>
            <div class="col-md-3 py-3 text-center">
                x {{item.amount}}
            </div>
            <div class="col-md-3 py-3 text-center">
                    {{item.price}}€</div>
        </div>
    <!--</div>-->
</div>
</template>

<script>

    const axios = require('axios').default;
    const pubkey = "6d489dd5cfb6966122feaca117e324d5eccd4a3536a3de14a713d03892a7e22a";

    export default {
        props: {
            idorder: ''
        },
        data(){
          return {
              sets: [],
          }
        },
        mounted() {
            this.getSets();
        },
        methods: {
            getSets(){
                axios.post('api/sets', {
                    '_token': this.$csrfToken,
                    'pubkey': pubkey,
                    'idOrder': this.idorder,
                }).then((response) => {
                    this.sets = response.data;
                });
            }
        }
    }
</script>
