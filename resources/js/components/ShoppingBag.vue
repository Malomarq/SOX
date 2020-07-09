<template>
    <div class="container py-2 d-block">
        <!--TODO cambiar ruta -->
        <a href="http://localhost/FINAL-SOX/sox/public/bag"><i class="shopcarticon fas fa-shopping-basket fa-lg"/></a>
        <span class="shopcartpill badge badge-danger">{{amount}}</span>
    </div>
</template>

<script>
    import EventBus from "../event-bus";
    const axios = require('axios').default;
    const pubkey = "6d489dd5cfb6966122feaca117e324d5eccd4a3536a3de14a713d03892a7e22a";

    export default {
        props: {
            iduser: '',
        },

        data(){
            return{
                amount: null,
            }
        },
        mounted() {
            var self = this;
            this.getItems();
            EventBus.$on('newItem', function () {
                self.getItems();
            });
        },
        methods: {
            getItems(){
                axios.post('api/getItems', {
                    'pubkey': pubkey,
                    '_token': this.$csrfToken,
                    'iduser': this.iduser,
                }).then((response)=> {
                    this.amount = response.data
                });
            },
        }
    }
</script>
