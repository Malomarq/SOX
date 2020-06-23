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

            <div v-for="item in selected">
                <button class="btn btn-dark mt-5" @click="getSets(item.idOrder)">Ver detalles</button>
            </div>

            <div v-if="showselectedinfo">
                <div class="card mt-5 border-dark bg-light">
                    <div class="card-body">
                        <p class="card-title prodtext3 text-center">Resumen del pedido</p>
                        <p class="panadprodstxt text-center" v-for="item in selectedinfo">{{item.name}}</p>
                    </div>
                </div>
            </div>

            <div class="container-fluid mt-5">

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
                    {key: 'idOrder', sortable: true},
                    {key: 'idUser', sortable: true},
                    {key: 'address', sortable: true},
                    {key: 'pay', sortable: true},
                    {key: 'totalPrice', sortable: true},
                ],
                items: [],
                perPage: 10,
                currentPage: 1,

                searchorder: '',
                selected: [],
                selectedinfo: [],
                showselectedinfo: false,
            }
        },

        computed: {
            rows() {
                return this.items.length
            }
        },

        mounted() {
            console.log('orders montado');
            this.listOrders();
        },

        methods: {
            listOrders() {
                axios.post('api/orders', {
                    'pubkey': pubkey,
                    '_token': this.$csrfToken,
                }).then((response) => {
                    this.items = response.data;
                })
            },

            searchOrd() {
                axios.post('api/searchOrder', {
                    'pubkey': pubkey,
                    '_token': this.$csrfToken,
                    'search': this.searchorder
                }).then((response) => {
                    this.items = response.data['search'];
                })
            },

            onRowSelected(items) {
                this.selected = items;
                this.getSets();
            },

            clearSelected() {
                this.$refs.selectableTable.clearSelected()
            },

            getSets(data) {
                axios.post('api/sets', {
                    'pubkey': pubkey,
                    '_token': this.$csrfToken,
                    'idOrder': data,
                }).then((response) => {
                    this.selectedinfo = response.data;
                    this.showselectedinfo = true;
                })
            }
        }
    }

</script>
