<template>
    <div>
        <div class="mb-2">
            <small>{{totalmess}}{{totalart}}{{' ' + prodstext}}</small>
        </div>

        <b-row class="justify-content-center">
            <b-col cols="12" md="4" sm="6" v-for="item in products.data"
                   :key="item.id"
                   class="mb-5"
            >
                <b-card class="text-center cardindex rounded-0">
                    <a v-bind:href="'product?id=' + item.idArt">
                        <b-card-img-lazy fluid top :src="'storage/articles/' + item.image" class="imgindex"/>
                    </a>
                </b-card>
            </b-col>
        </b-row>

        <pagination :pagination="products"
                    @paginate="allproducts()"
                    :offset="4">
        </pagination>
    </div>
</template>

<script>

    import Pagination from './Pagination.vue';
    import EventBus from "../event-bus";

    const axios = require('axios').default;

    export default {

        components: {
            Pagination
        },

        props: {
            totalmess: '',
            prodstext: '',
        },

        data() {
            return {
                products: {
                    total: 0,
                    per_page: 2,
                    from: 1,
                    to: 0,
                    current_page: 1
                },

                // Pagination
                offset: 4,

                // Filters
                filter: 'default',
                colorfilter: '-',
                totalart: '',

            }
        },

        mounted() {

            var self = this;
            EventBus.$on('colorfilter', function (data) {

                // Listening to this event, the allproducts() method can get products filtered by the color chosen
                self.colorfilter = data;
                self.products.current_page = 1;
                self.allproducts();
            });

            this.allproducts();
        },

        methods: {

            /**
             * Gets all products ordered by pagination (and filtered by color), and the total amount of them
             * @param page
             */
            allproducts(page) {
                axios.post(`api/products?page=${this.products.current_page}`, {
                        'order': this.filter,
                        'colorfilter': this.colorfilter,
                })
                    .then((response) => {
                        //console.log(response.data.total)
                        this.products = response.data;
                        this.totalart = response.data.total;
                    });

                window.scrollTo(0, 0);
            }
        }
    }

</script>
