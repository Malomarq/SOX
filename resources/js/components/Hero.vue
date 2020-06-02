<template>
<div>
    <b-modal id="modal-xl" size="xl" ref="my-modal" hide-footer hide-header centered>
        <div class="jumbotron jumbotron-fluid bg-dark jumbonav">
            <div class="container container-fluid text-center">
                <img src="img/logo2.svg" class="logo">
            </div>
        </div>
    </b-modal>
</div>
</template>

<script>
    export default {
        methods: {
            showModal() {
                this.$refs['my-modal'].show()
            },
        },
        mounted() {
            //this.showModal();
        }
    }
</script>

<style scope>
    div#modal-xl___BV_modal_body_.modal-body {
        background-color:#343A40;
    }
</style>
