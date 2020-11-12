<template>
    <div>
        <b-container fluid="sm">
            <b-row align-v="center" align-h="center" class="my-3">

                <b-col cols="12" md="6" class="p-3 text-center colimgshowprod">
                    <b-img :src="'storage/articles/' + prod.image" fluid class="imgshowprod"/>
                </b-col>

                <b-col cols="12" md="6" class="p-5 text-center border-left">

                    <p class="prodtext">{{ prod.name }}</p>
                    <p class="prodprice">{{ prod.price }}€</p>

                    <b-row class="mt-5" align-v="center" align-h="center">
                        <b-col cols="8">
                            <b-row>
                                <b-form-group>
                                    <div class="rowprodsub text-left">{{ lbprodsize }}</div>
                                    <b-form-radio-group>
                                        <b-form-radio v-model="selectedradio" name="radio-inline" value="36-38">36-38
                                        </b-form-radio>
                                        <b-form-radio v-model="selectedradio" name="radio-inline" value="38-42">38-42
                                        </b-form-radio>
                                        <b-form-radio v-model="selectedradio" name="radio-inline" value="42-45">42-45
                                        </b-form-radio>
                                    </b-form-radio-group>
                                </b-form-group>
                            </b-row>

                        </b-col>

                        <b-col cols="4">
                            <b-row>
                                <b-button v-if="user === '1'" disabled type="button" size="lg" variant="dark">
                                    {{lbprodbut}}
                                </b-button>
                                <b-button v-if="user !== '1'" type="button" size="lg" variant="dark" @click.prevent="addToCart">
                                    {{lbprodbut}}
                                </b-button>
                            </b-row>
                        </b-col>
                    </b-row>
                </b-col>
            </b-row>
        </b-container>

        <div class="modal fade" id="modal-cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p class="panuseracctit">{{modaltext}}</p>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import EventBus from "../event-bus";
    const axios = require('axios').default;
    const pubkey = "6d489dd5cfb6966122feaca117e324d5eccd4a3536a3de14a713d03892a7e22a";

    export default {
        props: {
            user: {},
            art: {},
            lbprodsize: {},
            lbprodbut: {},
            lbprodmod: '',
            lbprodadded: '',
        },

        mounted() {
            this.showProduct();
        },

        data() {
            return {
                prod: [],
                selectedradio: '38-42',
                modaltext: '',
            }
        },

        methods: {

            /**
             * Gets a determinate product's info
             */
            showProduct() {
                axios.post('api/product/' + this.art, {
                        'pubkey': pubkey,
                }).then((response) => {
                    this.prod = response.data;
                });
            },

            /**
             * Adds to the shopping bag the product showed. User has to be registered and logged in to add
             * "newItem" event is emitted and picked up in shoppingBag component
             */
            addToCart() {
                if (this.user === '') {
                    this.modaltext = this.lbprodmod;
                    $('#modal-cart').modal('show');
                } else {
                    this.modaltext = this.lbprodadded;
                    $('#modal-cart').modal('show');
                    axios.post('api/addToCart', {
                        'pubkey': pubkey,
                        '_token': this.$csrfToken,
                        'iduser': this.user,
                        'idart': this.art,
                    }).then(function() {
                        EventBus.$emit('newItem');
                    }).catch((error) => {
                        location.href = 'http://localhost/sox/public/logout';
                    });
                }
            },
        }
    }
</script>
