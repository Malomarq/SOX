<template>
    <b-form method="get" action="product/" class="w-100">
        <b-input-group>
            <template v-slot:prepend>
                <b-input-group-text>
                    <i class="fas fa-search"></i>
                </b-input-group-text>
            </template>
            <b-form-input size="sm" type="text" list="input-list" id="input-large" name="prod" class="searchbar rounded-right" :placeholder="searchtext + '...'" @keydown="search"/>
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
        },

        methods: {

            // @vuese
            // Gets a list of products by the input's value. This value must be a part of a name's product
            search() {
                axios.post('api/search', {
                        'search': $('input[name=search]').val(),
                }).then((response) => {
                    this.result = response.data;
                })
            },
        }
    }
</script>
