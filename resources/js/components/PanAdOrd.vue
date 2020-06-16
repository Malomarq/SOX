<template>
    <div v-if="showed">
        <h3>Orders</h3>

        <!--listOrders()-->
    </div>
</template>

<script>

    export default {

        props: {
            showed: false
        },

        mounted() {
            console.log('orders montado');
        },

        methods: {
        }
    }

</script>
