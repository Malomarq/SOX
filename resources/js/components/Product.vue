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

                            <b-row>
                                <b-col>
                                    <b-row>
                                        <div class="rowprodsub">{{ lbprodtot }}</div>
                                    </b-row>
                                    <b-row>
                                        <b-form-select v-model="selectedsize" :options="optionselect"
                                                       size="sm" class="w-25"/>
                                    </b-row>
                                </b-col>
                            </b-row>
                        </b-col>

                        <b-col cols="4">
                            <b-row>
                                <b-button type="button" size="lg" variant="dark" @click.prevent="addToCart">
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
                        <p>{{modaltext}}</p>
                    </div>
                    <div class="modal-footer">
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
            lbprodtot: {},
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
                selectedsize: 1,
                optionselect: [
                    {value: 1, text: '1'},
                    {value: 2, text: '2'},
                    {value: 3, text: '3'},
                    {value: 4, text: '4'},
                    {value: 5, text: '5'}
                ],
                modaltext: ''
            }
        },

        methods: {

            showProduct() {
                axios.get('api/product/' + this.art, {
                    params: {
                        'pubkey': pubkey,
                    }
                }).then((response) => {
                    this.prod = response.data;
                });
            },

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
                        'amount': this.selectedsize,
                    }).then(function() {
                        EventBus.$emit('newItem');
                    }).catch((error) => {
                        //TODO modificar url
                        //location.href = 'http://localhost/sox/public/logout';
                    });
                }
            }
        }
    }
</script>
