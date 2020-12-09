<template>
    <div class="py-2 d-block">
        <a href="http://localhost/sox/public/bag"><i class="shopcarticon fas fa-shopping-basket fa-lg"/></a>
        <span class="shopcartpill badge badge-danger">{{amount}}</span>
    </div>
</template>

<script>

    import EventBus from "../event-bus";
    const axios = require('axios').default;
    var itemAdded = new Audio('media/bell.wav');

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

            // Listens to "newItem" event. Everytime the component pick up this event, a bell sound is played
            EventBus.$on('newItem', function () {
                itemAdded.play();
                self.getItems();
            });
        },
        methods: {

            // @vuese
            // Gets de amount of items in the shopping bag
            getItems(){
                axios.post('api/getItems', {
                    '_token': this.$csrfToken,
                    'iduser': this.iduser,
                }).then((response)=> {
                    this.amount = response.data
                });
            },
        }
    }
</script>
