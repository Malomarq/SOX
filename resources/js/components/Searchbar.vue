<template>
    <b-form method="get" action="product/" class="w-100">
        <b-input-group>
            <template v-slot:prepend>
                <b-input-group-text>
                    <i class="fas fa-search"></i>
                </b-input-group-text>
            </template>
            <b-form-input type="text" list="input-list" id="input-large" name="prod"
                          size="lg" class="searchbar rounded-right" :placeholder="searchtext + '...'" @keydown="search"/>
                <datalist id="input-list">
                    <option name="opt" v-for="item in result" :key="item.idArt">
                        <a :href="'product?id='+item.idArt">{{item.name}}</a>
                    </option>
                </datalist>
        </b-input-group>
    </b-form>
</template>
<script>

    const axios = require('axios').default;
    const pubkey = "6d489dd5cfb6966122feaca117e324d5eccd4a3536a3de14a713d03892a7e22a";

    export default {

        props: {
            searchtext: {},

        },

        data() {
            return {
                result: [],
            }
        },

        mounted() {
            console.log('searchbar montado');
        },

        methods: {
            search() {
                axios.get('api/search', {
                    params: {
                        'pubkey': pubkey,
                        'search': $('input[name=search]').val(),
                    }
                }).then((response) => {
                    this.result = response.data;
                })
            },
        }
    }
</script>
