<template>
    <div v-if="showed">
        <div class="mt-2">

            <ul class="nav justify-content-end py-3 bg-light"></ul>


            <div class="container-fluid mt-5 w-100">
            <!--<div id="panadustab" class="mt-5 w-100 px-5">-->
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

            <div class="w-25 border">
                <p>Prueba</p>
            </div>

        </div>
    </div>
</template>

<script>

    const axios = require('axios').default;
    const pubkey = "6d489dd5cfb6966122feaca117e324d5eccd4a3536a3de14a713d03892a7e22a";

    export default {

        props: {
            showed: false
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
        }
    }

</script>
