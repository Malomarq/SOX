<template>
    <div class="card bg-light shadow">
        <div class="card-header">
            <ul class="nav">
                <li class="nav-item"><span class="littleprice">{{header}}</span></li>
                <li v-if="nofilter" class="nav-item ml-auto">
                    <!--TODO cambiar ruta final -->
                    <a href="http://localhost/FINAL-SOX/sox/public/" class="badge badge-info">
                        <span><i class="far fa-times-circle mr-2 p-1 text-white"></i></span>Quitar filtro
                    </a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="col-12">
                <div class="row justify-content-center">
                    <a @click="filter('azul')" class="mx-1"><i class="fas fa-square fa-2x colazu"></i></a>
                    <a @click="filter('amarillo')" class="mx-1"><i class="fas fa-square fa-2x colama"></i></a>
                    <a @click="filter('verde')" class="mx-1"><i class="fas fa-square fa-2x colver"></i></a>
                    <a @click="filter('negro')" class="mx-1"><i class="fas fa-square fa-2x colne"></i></a>
                    <a @click="filter('gris')" class="mx-1"><i class="fas fa-square fa-2x colgr"></i></a>
                    <a @click="filter('blanco')" class="mx-1"><i class="fas fa-square fa-2x colbla"></i></a>
                    <a @click="filter('rojo')" class="mx-1"><i class="fas fa-square fa-2x colro"></i></a>
                    <a @click="filter('colores')" class="mx-1"><i class="fas fa-square fa-2x colmulti"></i></a>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import EventBus from "../event-bus";

    export default {
        props: {
            header: {},
        },
        data() {
          return {
              colorfilter: '',
              nofilter: false,
          }
        },
        mounted() {
            console.log('montado');
        },
        methods: {
            filter(data){
                this.nofilter = true;
                this.colorfilter = data;
                EventBus.$emit('colorfilter', this.colorfilter);
            }
        }
    }
</script>
