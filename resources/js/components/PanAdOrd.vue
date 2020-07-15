<template>
    <div v-if="showed">
        <div class="mt-2">

            <ul class="nav py-3 bg-light">
                <li class="navbar-brand ml-3">{{title}}</li>
                <li class="nav-item ml-auto mr-3">
                    <b-form @submit.prevent="searchOrd">
                        <b-input-group>
                            <template v-slot:prepend>
                                <b-input-group-text>
                                    <i class="fas fa-search"></i>
                                </b-input-group-text>
                            </template>
                            <b-form-input type="text" class="form-control rounded-right" placeholder="Buscar..."
                                          v-model="searchorder" @keyup="searchOrd"/>
                        </b-input-group>
                    </b-form>
                </li>
            </ul>

            <div v-for="item in selected" class="pl-3">
                <button class="btn btn-dark mt-5" @click="getSets(item.idOrder)">Ver detalles</button>
            </div>

            <div v-if="show" class="px-md-5">
                <div class="card mt-5" v-for="item in selected">
                    <div class="card-header">
                        <div class="nav flex-column flex-sm-row">
                            <div class="nav-item flex-sm-fill">
                                <div class="col-12">
                                    <div class="row">
                                        <small><b>PEDIDO REALIZADO</b></small>
                                    </div>
                                    <div class="row">
                                        <small>{{item.pay}}</small>
                                    </div>
                                </div>
                            </div>

                            <div class="nav-item mt-sm-0 mt-2 flex-sm-fill">
                                <div class="col-12">
                                    <div class="row">
                                        <small><b>TOTAL</b></small>
                                    </div>
                                    <div class="row">
                                        <small>{{item.totalPrice}}</small>
                                    </div>
                                </div>
                            </div>

                            <div class="nav-item mt-sm-0 mt-2 flex-sm-fill">
                                <div class="col-12">
                                    <div class="row">
                                        <small><b>IDENT. CUENTA</b></small>
                                    </div>
                                    <div class="row">
                                        <small>{{item.idUser}}</small>
                                    </div>
                                </div>
                            </div>

                            <div class="nav-item ml-sm-auto mt-sm-0 mt-2 flex-sm-fill">
                                <div class="col-12">
                                    <div class="row">
                                        <small><b>REF. PEDIDO</b></small>
                                    </div>
                                    <div class="row">
                                        <small>{{item.idOrder}}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="row" v-for="item in selectedinfo">
                                    <div class="col-12 col-md-5 py-3 text-center">
                                        <a v-bind:href="'product?id=' + item.idArt">
                                            <b-img :src="'storage/articles/' + item.image" fluid class="imgord"/>
                                        </a>
                                    </div>
                                    <div class="col-12 col-md-7 py-4">
                                        <div class="row justify-content-md-start justify-content-center panadprodstxt">
                                            {{item.name}}
                                        </div>
                                        <div class="row justify-content-md-start justify-content-center txtlight">x
                                            {{item.amount}}
                                        </div>
                                        <div class="row justify-content-md-start justify-content-center littleprice">
                                            {{item.price}}€
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 py-0 py-md-3">
                                <button type="button" class="btn btn-warning btn-lg btn-block">Localizar pedido</button>
                                <button type="button" class="btn btn-secondary btn-lg btn-block">Imprimir detalles</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-header">
                    <span><i class="fas fa-table mr-2"></i><b>Pedidos realizados</b></span>
                </div>

                <b-table
                    :items="items"
                    :fields="fields"
                    :sort-by.sync="sortBy"
                    :sort-desc.sync="sortDesc"

                    id="tableOrders"
                    :per-page="perPage"
                    :current-page="currentPage"

                    responsive="sm"
                    outlined
                    hover
                    bordered
                    selectable
                    select-mode="single"
                    @row-selected="onRowSelected"
                    ref="selectableTable"
                />

                <b-pagination
                    v-model="currentPage"
                    :total-rows="rows"
                    :per-page="perPage"
                    aria-controls="tableOrders"
                    size="sm"
                    align="center"
                />
            </div>

        </div>
    </div>
</template>

<script>

    var moment = require('moment');
    const axios = require('axios').default;
    const pubkey = "6d489dd5cfb6966122feaca117e324d5eccd4a3536a3de14a713d03892a7e22a";

    export default {

        props: {
            showed: false,
            title: '',
        },

        data() {
            return {
                sortBy: 'age',
                sortDesc: false,
                fields: [
                    {key: 'idOrder', label: 'ref. pedido', sortable: true},
                    {key: 'idUser', label: 'ident. cuenta', sortable: true},
                    {key: 'address', label: 'envío', sortable: true},
                    {key: 'pay', label: 'fecha de pago', sortable: true},
                    {key: 'totalPrice', label: 'precio (sin envío)', sortable: true},
                ],
                items: [],
                perPage: 10,
                currentPage: 1,

                searchorder: '',
                selected: [],
                selectedinfo: [],
                show: false,
            }
        },

        computed: {
            rows() {
                return this.items.length
            }
        },

        mounted() {
            this.listOrders();
        },

        methods: {

            /**
             * Gets info of all orders
             */
            listOrders() {
                axios.post('api/orders', {
                    'pubkey': pubkey,
                    '_token': this.$csrfToken,
                }).then((response) => {
                    this.items = response.data;

                    let i = null;
                    for(i=0; i<this.items.length; i++){
                        this.items[i].totalPrice = this.items[i].totalPrice + '€';
                        this.items[i].pay = this.moment(this.items[i].pay);
                    }
                })
            },

            /**
             * Gets a determinate order by an input's value, searching by id, user id, address, or date
             */
            searchOrd() {
                axios.post('api/searchOrder', {
                    'pubkey': pubkey,
                    '_token': this.$csrfToken,
                    'search': this.searchorder
                }).then((response) => {
                    this.items = response.data['search'];
                })
            },

            /**
             * Bootstrap-Vue method, for selecting a determinate row
             * @param items
             */
            onRowSelected(items) {
                this.show = false;
                this.selected = items;
            },

            /**
             * Bootstrap-Vue method, for clear selected row
             */
            clearSelected() {
                this.$refs.selectableTable.clearSelected()
            },

            /**
             * Gets set's info of an order
             * @param data
             */
            getSets(data) {
                axios.post('api/sets', {
                    'pubkey': pubkey,
                    '_token': this.$csrfToken,
                    'idOrder': data,
                }).then((response) => {
                    this.selectedinfo = response.data;
                    (this.show) ? this.show = false : this.show = true;
                })
            },

            /**
             * Formats a date
             */
            moment(date) {
                return moment(date).format('DD/MM/YYYY');
            },
        }
    }

</script>
