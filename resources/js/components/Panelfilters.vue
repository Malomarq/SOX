<template>
    <b-card
        bg-variant="light"
        :header="header"
        header-class="font-weight-bold"
        class="shadow-sm"
    >
        <b-card-text>
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
                    <!--TODO última opción para quitar los filtros-->
                </div>
            </div>
        </b-card-text>
    </b-card>

</template>

<script>
    import EventBus from "../event-bus";

    export default {
        props: {
            header: {},
        },
        data() {
          return {
              colorfilter: ''
          }
        },
        mounted() {
            console.log('montado');
        },
        methods: {
            filter(data){
                this.colorfilter = data;
                EventBus.$emit('colorfilter', this.colorfilter);
            }
        }
    }
</script>
