<template>
    <div v-if="showed">
        <div class="mt-2">

            <ul class="nav py-3 bg-light">
                <li class="navbar-brand ml-3">{{title}}</li>
                <li class="nav-item ml-auto mr-3">
                    <b-form @submit.prevent="searchUs">
                        <b-input-group>
                            <template v-slot:prepend>
                                <b-input-group-text>
                                    <i class="fas fa-search"></i>
                                </b-input-group-text>
                            </template>
                            <b-form-input type="text" class="form-control rounded-right" placeholder="Buscar..."
                                          v-model="searchuser" @keyup="searchUs"/>
                        </b-input-group>
                    </b-form>
                </li>
            </ul>

            <div v-for="item in selected" :key="item">
                <div class="card mt-5 border-danger bg-light">
                    <div class="card-body">
                        <p class="card-title prodtext3 text-center">Eliminar usuario</p>
                        <p class="panadprodstxt text-center">¿Estás seguro de que deseas eliminar la cuenta de usuario
                            con el identificador {{item.idUser}}? Este proceso será irreversible.</p>
                        <div class="text-center">
                            <button class="btn btn-danger" @click="deleteUser(item.idUser)">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-header">
                    <span><i class="fas fa-table mr-2"></i><b>Cuentas de usuario actuales</b></span>
                </div>

                    <b-table
                        :items="items"
                        :fields="fields"
                        :sort-by.sync="sortBy"
                        :sort-desc.sync="sortDesc"

                        id="tableUsers"
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
                        aria-controls="tableUsers"
                        size="sm"
                        align="center"
                    />
            </div>

        </div>
    </div>
</template>

<script>

    const axios = require('axios').default;

    export default {

        props: {
            showed: false,

            /**
             *  Title
             */

            title: '',
        },

        mounted() {
            this.listUsers();

        },

        data() {
            return {
                sortBy: 'age',
                sortDesc: false,
                fields: [
                    {key: 'idUser', label: 'ident. cuenta', sortable: true},
                    {key: 'name', label: 'nombre', sortable: true},
                    {key: 'lastname', label: 'apellido', sortable: true},
                    {key: 'email', label: 'email', sortable: true},
                ],
                items: [],
                perPage: 10,
                currentPage: 1,
                searchuser: '',
                selected: [],
            }
        },

        computed: {
            rows() {
                return this.items.length
            }
        },

        methods: {

            // @vuese
            // Gets all users's info
            listUsers() {
                axios.post('api/listUsers').then((response) => {
                    this.items = response.data;
                })
            },

            // @vuese
            // Gets a determinate user by an input's value, searching by name, lastname, email or id
            searchUs() {
                axios.post('api/searchUser', {
                    '_token': this.$csrfToken,
                    'search': this.searchuser
                }).then((response) => {
                    this.items = response.data['search'];
                })
            },

            // @vuese
            // Bootstrap-Vue method, for selecting a determinate row
            // @arg items
            onRowSelected(items) {
                this.selected = items;
            },

            // @vuese
            // Bootstrap-Vue method, for clear selected row
            clearSelected() {
                this.$refs.selectableTable.clearSelected()
            },

            // @vuese
            // Deletes a determinate user and reloads the page
            // @arg data
            deleteUser(data) {
                axios.post('api/deleteUser', {
                    '_token': this.$csrfToken,
                    'idUser': data,
                }).then((response) => {
                    location.reload();
                })
            }
        }
    }

</script>
