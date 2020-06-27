<template>
    <div v-if="showed">
        <div class="mt-2">
            <ul class="nav py-3 bg-light">
                <li class="navbar-brand ml-3">{{title}}</li>
            </ul>

            <div class="pl-3 mt-5">
                <button class="btn btn-success"><span><i class="fas fa-file-alt mr-2"></i></span>Nuevo</button>
            </div>

            <div class="card text-center my-5">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active">Nuevos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#">Leídos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#">Todos</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="row justify-content-end">
                        <small class="mr-3">{{date}}</small>
                    </div>

                    <div class="row justify-content-center my-5">
                        <h3 class="card-title">No hay nuevas notificaciones</h3>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>

    var moment = require('moment');

    export default {

        props: {
            showed: false,
            title: '',
        },

        data(){
            return {
                date: '',
            }
        },

        mounted() {
            this.getDate();
        },

        methods: {
            getDate(){
                this.date = moment().format('DD/MM/YYYY');
            }
        }
    }

</script>
