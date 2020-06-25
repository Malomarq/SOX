<template>
    <div v-if="showed">
        <div class="mt-2">
            <ul class="nav py-3 bg-light">
                <li class="navbar-brand ml-3">Home</li>
            </ul>

            <div class="row mt-5">
                <div class="col-12 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <span><i class="fas fa-chart-area mr-2"></i><b>Pedidos</b></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <span><i class="fas fa-chart-bar mr-2"></i><b>Usuarios</b></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {

        props: {
            showed: false,
        },

        mounted() {
        },

        methods: {
        }
    }

</script>
