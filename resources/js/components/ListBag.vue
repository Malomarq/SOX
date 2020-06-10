<template>
    <div class="container border rounded bg-light">
        <div v-if="showBag" class="row">
            <div class="col-12 col-md-8">
                <div class="row" v-for="art in articles" :key="art.idArt">

                </div>
            </div>
            <div class="col-12 col-md-4 border-left">
                <p>Subtotal:</p>
                <p>Gastos de envío:</p>
                <p>TOTAL:</p>
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
        },
        data() {
            return {
                articles: {},
                showEmpty: false,
                showBag: false,
            }
        },
        mounted(){
            this.getBag();
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
                        this.articles = response.data;
                    }
                });
            }
        }
    }

</script>
