<template>
    <div v-if="showed">
        <h3>Home</h3>
    </div>
</template>

<script>

    export default {

        props: {
            showed: false
        },

        mounted() {
            console.log('home montado');
        },

        methods: {
        }
    }

</script>
