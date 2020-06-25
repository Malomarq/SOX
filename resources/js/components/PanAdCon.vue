<template>
    <div v-if="showed">
        <h3>{{title}}</h3>
    </div>
</template>

<script>

    export default {

        props: {
            showed: false,
            title: '',
        },

        mounted() {
            console.log('contacts montado');
        },

        methods: {
        }
    }

</script>
