<template>
    <div v-if="showed">

        <div class="mt-2">
            <ul class="nav justify-content-end py-3 bg-light">
                <li class="nav-item ">
                    <button type="button" class="btn btn-success rounded-circle mr-2 px-2" data-toggle="modal"
                            data-target="#modal-new">
                        <span><i class="fas fa-user-plus fa-1x"></i></span>
                    </button>
                </li>
                <li class="nav-item ">
                    <button type="button" class="btn btn-primary rounded-circle mr-2 px-2" @click="showUpdate">
                        <span><i class="fas fa-user-cog fa-1x"></i></span>
                    </button>
                </li>
                <li class="nav-item ">
                    <button type="button" class="btn btn-danger rounded-circle mr-3 px-2" data-toggle="modal"
                            data-target="#modal-delete">
                        <span><i class="fas fa-user-times fa-1x"></i></span>
                    </button>
                </li>
            </ul>

            <div class="card-deck mt-4">
                <div class="card text-white bg-info mb-3" style="max-width: 18rem;" v-for="item in itemsAd" :key="item.idUser">
                    <div class="card-header">Admin</div>
                    <div class="card-body text-white">
                        <h7 class="card-title">{{ item.name }} {{item.lastname}}</h7>
                        <p class="card-text">{{item.email}}</p>
                    </div>
                </div>
            </div>

            <!-- MODAL NEW -->

            <div class="modal fade" id="modal-new" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitleNew" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitleNew">Nuevo admin</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form id="createform" @submit.prevent="createAd">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input v-model="mdcrename" type="text" class="form-control" required>
                                    <small v-if="showErrName" class="text-danger">{{errName}}</small>
                                </div>
                                <div class="form-group">
                                    <label>Lastname</label>
                                    <input v-model="mdcrelastname" type="text" class="form-control" required>
                                    <small v-if="showErrLastname" class="text-danger">{{errLastname}}</small>
                                </div>
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input name="inpemail" v-model="mdcreemail" type="email" class="form-control"
                                           aria-describedby="emailHelp" required @blur="checkEmail">
                                    <small v-if="showErrEmail" class="form-text text-danger">{{errEmail}}</small>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input v-model="mdcrepass" type="password" class="form-control" required>
                                    <small v-if="showErrPass" class="text-danger">{{errPass}}</small>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <!-- END MODAL NEW -->

            <!-- MODAL UPDATE -->

            <div class="modal fade" id="modal-update" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitleUpdate" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitleUpdate">Actualizar admin</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form id="updateform" @submit.prevent="updateAd">
                                <div class="form-group">
                                    <label for="exampleInputText1">Name</label>
                                    <input type="text" v-model="mdupname" class="form-control" id="exampleInputText1"
                                           aria-describedby="emailHelp" :placeholder="placename">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputText2">Lastname</label>
                                    <input type="text" v-model="mduplastname" class="form-control"
                                           id="exampleInputText2" aria-describedby="emailHelp"
                                           :placeholder="placelastname">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input v-model="mduppass" type="password" class="form-control"
                                           id="exampleInputPassword1" placeholder="contraseña">

                                </div>
                                <div v-if="showErrorUpdate" class="form-group">
                                    <small class="text-danger">Datos incorrectos. Recuerda que name y lastname deben
                                        tener como máximo 50 caracteres. La contraseña debe ser mínimo de 8</small>
                                </div>

                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <!-- END MODAL UPDATE -->

            <!-- MODAL DELETE -->

            <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitleDelete" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitleDelete">Eliminar admin</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="font-weight-bold text-uppercase">¿Estás seguro de que deseas eliminar tu
                                cuenta?</p>
                            <p>Este proceso es irreversible</p>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" @click="confirmDel">Ok</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- END MODAL DELETE -->

            <!-- CUSTOM MODAL -->
            <div class="modal fade" id="modal-custom" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitleConfirm" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitleConfirm">
                                Confirma eliminar admin</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Tu cuenta se eliminará definitivamente. Serás redireccionado al index</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" @click="deleteAd">Ok</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END CUSTOM MODAL -->

        </div>
    </div>
</template>

<script>

    const axios = require('axios').default;
    const pubkey = "6d489dd5cfb6966122feaca117e324d5eccd4a3536a3de14a713d03892a7e22a";

    export default {

        props: {

            /**
             *  Component visible
             */

            showed: false,

            /**
             *  Admin's id
             */

            idad: ''
        },

        computed: {

            /**
             *  To use admin's id by axios
             */

            idadmin() {
                return this.idad;
            }
        },

        data() {
            return {

                /**
                 *  Admin's info
                 */

                itemsAd: [],

                /**
                 *  Update modal
                 */

                // placeholders called by axios
                placename: '',
                placelastname: '',
                placeemail: '',

                // inputs values
                mdupname: '',
                mduplastname: '',
                mduppass: '',

                // axios errors
                showErrorUpdate: false,

                /**
                 *  Create modal
                 */

                // input values
                mdcrename: '',
                mdcrelastname: '',
                mdcreemail: '',
                mdcrepass: '',

                // errors
                showErrName: false,
                errName: '',
                showErrLastname: false,
                errLastname: '',
                showErrEmail: false,
                errEmail: '',
                showErrPass: false,
                errPass: '',
            }
        },

        mounted() {
            this.listAdmins();
        },

        methods: {

            /**
             *  Find admins info
             */

            listAdmins() {
                axios.get('api/listAdmins', {
                    params: {
                        'pubkey': pubkey
                    }
                }).then((response) => {
                    this.itemsAd = response.data;
                })
            },

            /**
             *  Hides first delete modal and show up confirm delete modal
             */

            confirmDel() {
                $('#modal-delete').modal('hide');
                $('#modal-custom').modal('show');
            },

            /**
             *  Deletes an admin by its id and redirects to index
             */

            deleteAd() {

                axios.post('api/deleteAdmin', {
                    '_token': this.$csrfToken,
                    'pubkey': pubkey,
                    'idad': this.idadmin,

                }).then((response) => {
                    // TODO modificar url final
                    location.href = 'http://localhost/Sox-app/public/';

                }).catch(error => {
                    console.log(error.message);
                });

            },

            /**
             *  Show up update modal with admin info in placeholders
             */

            showUpdate() {

                axios.get('api/findAdmin', {
                    params: {
                        'pubkey': pubkey,
                        'idad': this.idadmin,
                    }
                }).then((response) => {
                    this.placename = response.data[0].name;
                    this.placelastname = response.data[0].lastname;
                    this.placeemail = response.data[0].email;
                });

                $('#modal-update').modal('show');
            },

            /**
             * Updates admin info by inputs values.
             *  - If values validation fails, it show up errors in modal
             *  - If password is not updated, it reload the page in order to show new admin's info
             *  - If password is also updated, it log out user
             */

            updateAd() {

                axios.post('api/updateAdmin', {
                    '_token': this.$csrfToken,
                    'pubkey': pubkey,
                    'idad': this.idadmin,
                    'name': this.mdupname,
                    'lastname': this.mduplastname,
                    'pass': this.mduppass,
                }).then((response) => {

                    if (response.data['pass'] == 'filled') {
                        // TODO modificar url final
                        location.href = 'http://localhost/Sox-app/public/logout';
                    } else {
                        location.reload();
                    }
                }).catch((error) => {
                    console.log(error.response.data);
                    this.showErrorUpdate = true;
                });
            },

            checkEmail() {
                axios.get('api/checkEmail', {
                    params: {
                        'pubkey': pubkey,
                        'check': $('input[name=inpemail]').val(),
                    }
                }).then((response) => {
                    if (response.data == true) {
                        this.showErrEmail = true;
                        this.errEmail = 'Este email ya se encuentra registrado. Inténtalo de nuevo';
                    } else {
                        this.showErrEmail = false;
                        this.errEmail = '';
                    }
                })
            },

            /**
             * Creates a new admin account by inputs values.
             * - If values validation fails, it show up errors in modal
             * - Reloads the page in order to show new admin's info
             */

            createAd() {

                axios.post('api/createAdmin', {
                    '_token': this.$csrfToken,
                    'pubkey': pubkey,
                    'name': this.mdcrename,
                    'lastname': this.mdcrelastname,
                    'email': this.mdcreemail,
                    'pass': this.mdcrepass,
                }).then((response) => {
                    if (response.data === "Ok") {
                        location.reload();
                    }

                }).catch((error) => {

                    if (error.response.data['errors']['name']) {
                        this.showErrName = true;
                        this.errName = error.response.data['errors']['name'][0];
                    } else {
                        this.showErrName = false;
                        this.errName = '';
                    }

                    if (error.response.data['errors']['lastname']) {
                        this.showErrLastname = true;
                        this.errLastname = error.response.data['errors']['lastname'][0];
                    } else {
                        this.showErrLastname = false;
                        this.errLastname = '';
                    }

                    if (error.response.data['errors']['pass']) {
                        this.showErrPass = true;
                        this.errPass = error.response.data['errors']['pass'][0];
                    } else {
                        this.showErrPass = false;
                        this.errPass = '';
                    }

                });
            }
        }

    }

</script>
