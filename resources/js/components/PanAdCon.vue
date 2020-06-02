<template>
    <div v-if="showed">
        <h3>Contacts</h3>
    </div>
</template>

<script>

    export default {

        props: {
            showed: false
        },

        mounted() {
            console.log('contacts montado');
        },

        methods: {
        }
    }

</script>
