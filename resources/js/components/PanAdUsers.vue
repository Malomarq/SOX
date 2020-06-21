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
                                          v-model="searchuser"/>
                        </b-input-group>
                    </b-form>
                </li>
            </ul>

            <div v-if="search">holi</div>

            <div class="container-fluid mt-5">

                <b-table
                    :items="items"
                    :fields="fields"
                    :sort-by.sync="sortBy"
                    :sort-desc.sync="sortDesc"

                    id="tableUsers"
                    :per-page="perPage"
                    :current-page="currentPage"
                    small
                    responsive="sm"
                    outlined
                    hover
                    selectable
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
    const pubkey = "6d489dd5cfb6966122feaca117e324d5eccd4a3536a3de14a713d03892a7e22a";

    export default {

        props: {
            showed: false,

            /**
             *  Title
             */

            title: '',
        },

        mounted() {
            console.log('users montado');
            this.listUsers();

        },

        data() {
            return {
                sortBy: 'age',
                sortDesc: false,
                fields: [
                    {key: 'idUser', sortable: true},
                    {key: 'name', sortable: true},
                    {key: 'lastname', sortable: true},
                    {key: 'email', sortable: true},
                ],
                items: [],
                perPage: 10,
                currentPage: 1,
                searchuser: '',
                search: true,
            }
        },

        computed: {
            rows() {
                return this.items.length
            }
        },

        methods: {

            listUsers() {
                axios.get('api/listUsers', {
                    params: {
                        'pubkey': pubkey
                    }
                }).then((response) => {
                    this.items = response.data;
                })
            },

            searchUs() {
                axios.post('api/searchUser', {
                    'pubkey': pubkey,
                    '_token': this.$csrfToken,
                    'search': this.searchuser
                }).then((response) => {
                    
                })
            }
        }
    }

</script>
