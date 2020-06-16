<template>

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
