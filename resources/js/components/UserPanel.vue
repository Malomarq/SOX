<template>
    <div class="usersox">
            <div class="container">
                <div class="col-12 col-md-12">
                    <div class="row">
                        <div class="col-12 col-md-4 my-5">
                            <div class="list-group" id="list-tab" role="tablist">
                                <a class="list-group-item list-group-item-action active" id="list-account-list"
                                   data-toggle="list" href="#list-account" role="tab" aria-controls="account">
                                    <span class="mr-3 panusernav"><i class="fas fa-user-circle fa-lg"/></span>
                                    {{account}}
                                </a>
                                <a class="list-group-item list-group-item-action" id="list-orders-list"
                                   data-toggle="list"
                                   href="#list-orders" role="tab" aria-controls="orders">
                                    <span class="mr-3 panusernav"><i class="fas fa-dolly fa-lg"/></span>
                                    {{orders}}
                                </a>
                                <a class="list-group-item list-group-item-action" id="list-messages-list"
                                   data-toggle="list"
                                   href="#list-messages" role="tab" aria-controls="messages">
                                    <span class="mr-3 panusernav"><i class="fas fa-envelope fa-lg"/></span>
                                    {{notif}}
                                </a>
                                <a class="list-group-item list-group-item-action" id="list-designs-list" data-toggle="list"
                                   href="#list-designs" role="tab" aria-controls="designs">
                                    <span class="mr-3 panusernav"><i class="fas fa-socks fa-lg"/></span>
                                    {{designs}}
                                </a>
                                <a class="list-group-item list-group-item-action" id="list-delaccount-list"
                                   data-toggle="list"
                                   href="#list-delaccount" role="tab" aria-controls="delaccount">
                                    <span class="mr-3 panusernav"><i class="fas fa-times-circle fa-lg"/></span>
                                    {{delaccount}}
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-md-8 my-5">
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content" id="nav-tabContent">

                                        <!--ACCOUNT-->
                                    <div class="tab-pane fade show active" id="list-account" role="tabpanel"
                                         aria-labelledby="list-account-list">

                                        <div class="panuseracctit ml-3 mt-3">{{account}}</div>
                                        <div class="row my-3">

                                            <div class="col-12 col-md-6 text-center">
                                                <div class="container py-5">
                                                    <div class="row">
                                                        <div class="col-12 col-md-6 panuseraccsubtit">{{name}}</div>
                                                        <div class="col-12 col-md-6">{{user[0].name}}</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-6 panuseraccsubtit">{{lastname}}</div>
                                                        <div class="col-12 col-md-6">{{user[0].lastname}}</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-6 panuseraccsubtit">email</div>
                                                        <div class="col-12 col-md-6">{{user[0].email}}</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-none d-md-block col-md-5 text-center">
                                                <div class="container bg-dark rounded">
                                                    <b-card-img-lazy fluid :src="'./img/logo2.svg'" class="imgindex"/>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row my-3">

                                            <div class="col-12 col-md-6">
                                                <div class="panuseracctit ml-3 mt-3">{{accounttext2}}</div>
                                                <div class="container py-3">
                                                    <form @submit.prevent="updateInfo">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text rounded-left iconlogin"><i
                                                                        class="fas fa-user"></i></span>
                                                                </div>
                                                                <input v-model="vmname" type="text" class="form-control"
                                                                       :placeholder="user[0].name">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text rounded-left iconlogin"><i
                                                                        class="fas fa-user-tag"></i></span>
                                                                </div>
                                                                <input v-model="vmlastname" type="text"
                                                                       class="form-control" :placeholder="user[0].lastname">
                                                            </div>
                                                        </div>
                                                        <div v-if="showErrorUpdateInfo" class="form-group">
                                                            <small class="text-danger">{{upinfoerr}}</small>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary">{{txtbut}}
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="panuseracctit ml-3 mt-3">{{accounttext3}}</div>
                                                <div class="container py-3">
                                                    <form @submit.prevent="updatePass">
                                                        <div class="form-group">
                                                            <eye-pass customclass="form-control" modelprop="vmcurpass"
                                                                      :campopass="currentpass"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <eye-pass customclass="form-control" modelprop="vmnewpass"
                                                                      :campopass="newpass"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <eye-pass customclass="form-control" modelprop="vmconfpass"
                                                                      :campopass="confirmpass"/>
                                                        </div>
                                                        <div v-if="showErrorUpdatePass" class="form-group">
                                                            <small class="text-danger">{{uppasscurrerr}}</small>
                                                        </div>
                                                        <div v-if="showErrorUpdatePassMatch" class="form-group">
                                                            <small class="text-danger">{{uppassnewerr}}</small>
                                                        </div>
                                                        <div v-if="showErrorUpdatePassCurr" class="form-group">
                                                            <small class="text-danger">{{uppassconferr}}</small>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary">{{txtbut}}
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--ORDERS-->
                                    <div class="tab-pane fade" id="list-orders" role="tabpanel"
                                         aria-labelledby="list-orders-list">

                                        <div class="panuseracctit ml-3 mt-3">{{orders}}</div>

                                        <div v-if="emptyOrder" class="row mt-4 mb-5 border bg-light mx-md-5 py-2">
                                            <div class="col-12 col-md-12">
                                                <div class="row pt-3">
                                                    <div class="col-12 col-md-6 panadprodstxt text-center">
                                                        <span class="pl-3">{{noorderstxt1}}</span>
                                                    </div>
                                                    <div class="col-12 col-md-6 mt-2 mt-md-0 text-center">
                                                        <span>
                                                            <i class="far fa-check-square fa-2x deleteicon"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div v-if="fullOrder" class="container my-5">

                                            <div class="col-md-12 mx-md-3 d-none d-sm-block">
                                                <div class="row mr-md-3 bg-light bagborder">
                                                    <div class="col-sm-3 py-sm-3 text-center panadprodstxt">
                                                        ref
                                                    </div>
                                                    <div class="col-sm-3 py-sm-3 text-center panadprodstxt">
                                                        {{datetxt}}
                                                    </div>
                                                    <div class="col-sm-3 py-sm-3 text-center panadprodstxt">
                                                        {{pricetxt}}
                                                    </div>
                                                    <div class="col-sm-3 py-sm-3 text-center"></div>
                                                </div>
                                            </div>

                                            <div class="row mx-md-3 py-3 py-md-0 border-bottom bg-white" v-for="item in ordersinfo"
                                                 :key="item.idOrder">

                                                <div class="col-6 d-block d-sm-none py-sm-3 text-sm-center text-right panadprodstxt">ref</div>
                                                <div class="col-6 col-sm-3 col-md-3 py-sm-3 text-sm-center text-left txtlight">{{item.idOrder}}</div>
                                                <div class="col-6 d-block d-sm-none py-sm-3 text-sm-center text-right panadprodstxt">{{datetxt}}</div>
                                                <div class="col-6 col-sm-3 col-md-3 py-sm-3 text-sm-center text-left txtlight">{{item.pay}}</div>
                                                <div class="col-6 d-block d-sm-none py-sm-3 text-sm-center text-right panadprodstxt">{{pricetxt}}</div>
                                                <div class="col-6 col-sm-3 col-md-3 py-sm-3 text-sm-center text-left littleprice">{{(item.totalPrice + 3.95).toFixed(2)}}€</div>

                                                <div class="col-12 col-sm-3 col-md-3 py-sm-3 py-3 text-center">
                                                    <button class="btn btn-primary" type="button" @click="displayOrder(item.idOrder)">{{btntxt}}</button>
                                                </div>

                                                <div v-if="setorder === item.idOrder" class="col-12">
                                                    <order-details :idorder="item.idOrder"></order-details>
                                                </div>

                                            </div>

                                            <div class="row mx-md-3 my-5 shipmban p-3 shadow">
                                                <div class="col-12 col-sm-6 text-center">
                                                    <b-card-img-lazy fluid :src="'./img/logo2.svg'" class="littlesox"/>
                                                </div>
                                                <div class="col-12 col-sm-6 py-sm-5 pb-4 text-center text-sm-left panadprodstxt">
                                                    {{banntxt}}
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!--NOTIFICATIONS-->
                                    <div class="tab-pane fade px-3" id="list-messages" role="tabpanel"
                                         aria-labelledby="list-messages-list">
                                        <div class="panuseracctit mt-3">{{notif}}</div>

                                        <div class="row mt-4 mb-5 border bg-light mx-md-5 py-2">
                                            <div class="col-12 col-md-12">
                                                <div class="row pt-3">
                                                    <div class="col-12 col-md-6 panadprodstxt text-center">
                                                        <span class="pl-3">{{notiftxt1}}</span>
                                                    </div>
                                                    <div class="col-12 col-md-6 mt-2 mt-md-0 text-center">
                                                        <span>
                                                            <i class="far fa-check-square fa-2x deleteicon"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--DESIGNS-->
                                    <div class="tab-pane fade px-3" id="list-designs" role="tabpanel"
                                         aria-labelledby="list-designs-list">
                                        <div class="panuseracctit mt-3">{{designs}}</div>

                                        <div class="row mt-4 mb-5 border bg-light mx-md-5 py-2">
                                            <div class="col-12 col-md-12">
                                                <div class="row pt-3">
                                                    <div class="col-12 col-md-6 panadprodstxt text-center">
                                                        <span class="pl-3">{{designtxt}}</span>
                                                    </div>
                                                    <div class="col-12 col-md-6 mt-2 mt-md-0 text-center">
                                                        <span>
                                                            <i class="far fa-check-square fa-2x deleteicon"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--DELETE-->
                                    <div class="tab-pane fade" id="list-delaccount" role="tabpanel"
                                         aria-labelledby="list-delaccount-list">

                                        <div class="panuseracctit ml-3 mt-3">{{deltext1}}</div>
                                        <div class="row my-3">
                                            <div class="col-12 col-md-8">
                                                <div class="container text-justify">
                                                    <div><b>{{deltext2}}</b></div>
                                                    <div>{{deltext3}}</div>
                                                </div>
                                            </div>
                                            <div
                                                class="col-6 col-md-3 mt-3 mt-md-0 mx-auto rounded text-center panusdelic"
                                                @mouseenter="movedelicon" @mouseleave="stopdelicon">
                                                <span class="px-3"><i
                                                    :class="{'my-4 fas fa-trash-alt fa-3x': true, 'fa-spin': showdelicon}"/></span>
                                            </div>
                                        </div>
                                        <div class="row my-3">
                                            <div class="col-12 col-md-6">
                                                <div class="container text-justify">
                                                    <div><b>{{deltext4}}</b></div>
                                                    <div class="form-group mt-2">
                                                        <eye-pass customclass="form-control"
                                                                  modelprop="vmdelpass"/>
                                                    </div>
                                                    <div v-if="showErrorDelPassLen" class="form-group">
                                                        <small class="text-danger">{{uppasscurrerr}}</small>
                                                    </div>
                                                    <div v-if="showErrorDelPassMatch" class="form-group">
                                                        <small class="text-danger">{{uppassconferr}}</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-warning"
                                                                @click="checkpass">
                                                            {{txtbut}}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="user-delete" tabindex="-1" role="dialog"
             aria-labelledby="modalCenterTitleDelete" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitleDelete">{{mdelheader}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="font-weight-bold text-uppercase">{{mdeltext1}}</p>
                        <p>{{mdeltext2}}</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{mdelbut}}</button>
                        <button type="button" class="btn btn-primary" @click="confirmDelUser">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import EventBus from "../event-bus";
    import EyePassLogin from "./EyePassLogin";
    import OrderDetails from "./OrderDetails";

    var moment = require('moment');
    const axios = require('axios').default;
    const pubkey = "6d489dd5cfb6966122feaca117e324d5eccd4a3536a3de14a713d03892a7e22a";

    export default {
        components: {
            EyePassLogin, OrderDetails
        },
        props: {

            idu: '',

            //panel
            account: '',
            orders: '',
            notif: '',
            designs: '',
            delaccount: '',

            // account
            name: '',
            lastname: '',
            accounttext2: '',
            upinfoerr: '',
            accounttext3: '',
            currentpass: '',
            newpass: '',
            confirmpass: '',
            txtbut: '',
            uppasscurrerr: '',
            uppassnewerr: '',
            uppassconferr: '',

            // delete
            deltext1: '',
            deltext2: '',
            deltext3: '',
            deltext4: '',
            mdelheader: '',
            mdeltext1: '',
            mdeltext2: '',
            mdelbut: '',

            // notif
            notiftxt1: '',

            // designs
            designtxt: '',

            // orders
            noorderstxt1: '',
            datetxt: '',
            pricetxt: '',
            btntxt: '',
            banntxt: '',
        },
        computed: {
            iduser() {
                return this.idu;
            },
        },
        data() {
            return {
                user: [{
                    name: '',
                    lastname: '',
                    email: ''
                }],

                showdelicon: false,

                // models
                vmname: '',
                vmlastname: '',

                vmcurpass: '',
                vmnewpass: '',
                vmconfpass: '',

                vmdelpass: '',

                // errors
                showErrorUpdateInfo: false,
                showErrorUpdatePass: false,
                showErrorUpdatePassMatch: false,
                showErrorUpdatePassCurr: false,
                showErrorDelPassLen: false,
                showErrorDelPassMatch: false,

                // orders
                ordersinfo: [],
                emptyOrder: false,
                fullOrder: false,
                setorder: null,
            }
        },
        mounted() {
            var self = this;
            this.finduser();

            /**
             * Listens to "inputval" events, that gets the inputs value for: current, new, confirmated password,
             * and password for deleting the account
             */
            EventBus.$on('inputval', function (data) {
                if (data[1] === 'vmcurpass') {
                    self.vmcurpass = data[0];
                }

                if (data[1] === 'vmnewpass') {
                    self.vmnewpass = data[0];
                }

                if (data[1] === 'vmconfpass') {
                    self.vmconfpass = data[0];
                }

                if (data[1] === 'vmdelpass') {
                    self.vmdelpass = data[0];
                }
            });
            this.getOrders();
        },
        methods: {

            // Just decoration stuff
            movedelicon() {
                this.showdelicon = true;
            },

            // Just decoration stuff
            stopdelicon() {
                this.showdelicon = false;
            },

            /**
             * Gets user's info
             */
            finduser() {
                axios.post('api/findUser', {
                        'pubkey': pubkey,
                        'iduser': this.iduser
                }).then((response) => {
                    this.user[0].name = response.data[0].name;
                    this.user[0].lastname = response.data[0].lastname;
                    this.user[0].email = response.data[0].email;
                })
            },

            /**
             * Updates password's user and manages validation errors
             */
            updatePass() {
                axios.post('api/updatePass', {
                    '_token': this.$csrfToken,
                    'pubkey': pubkey,
                    'idUser': this.iduser,
                    'curpass': this.vmcurpass,
                    'newpass': this.vmnewpass,
                    'confpass': this.vmconfpass
                }).then((response) => {
                    // TODO modificar url final
                    location.href = 'http://localhost/sox/public/logout';
                }).catch((error) => {
                    if (error.response.data['error'] === 'validate') {
                        this.showErrorUpdatePass = true;
                    } else {
                        this.showErrorUpdatePass = false;
                    }

                    if (error.response.data['error'] === 'new-conf') {
                        this.showErrorUpdatePassMatch = true;
                    } else {
                        this.showErrorUpdatePassMatch = false;
                    }

                    if (error.response.data['error'] === 'curr') {
                        this.showErrorUpdatePassCurr = true;
                    } else {
                        this.showErrorUpdatePassCurr = false;
                    }
                });
            },

            /**
             * Updates info's user and manages validation errors
             */
            updateInfo() {
                axios.post('api/updateInfo', {
                    '_token': this.$csrfToken,
                    'pubkey': pubkey,
                    'idUser': this.iduser,
                    'name': this.vmname,
                    'lastname': this.vmlastname,
                }).then((response) => {
                    location.reload();
                }).catch((error) => {
                    this.showErrorUpdateInfo = true;
                });
            },

            /**
             * Check's user's password in order to delete the account. It also manages validation errors
             */
            checkpass() {
                axios.post('api/checkPass', {
                    '_token': this.$csrfToken,
                    'pubkey': pubkey,
                    'idUser': this.iduser,
                    'pass': this.vmdelpass
                }).then((response) => {
                    $('#user-delete').modal('show');
                }).catch((error) => {
                    if (error.response.data['error'] === 'validate') {
                        this.showErrorDelPassLen = true;
                    } else {
                        this.showErrorDelPassLen = false;
                    }

                    if (error.response.data['error'] === 'match') {
                        this.showErrorDelPassMatch = true;
                    } else {
                        this.showErrorDelPassMatch = false;
                    }
                });
            },

            /**
             * Deletes an account and redirects to logout route to end the user session
             */
            confirmDelUser() {
                axios.post('api/deleteUser', {
                    '_token': this.$csrfToken,
                    'pubkey': pubkey,
                    'idUser': this.iduser,
                }).then((response) => {
                    // TODO modificar url final
                    location.href = 'http://localhost/sox/public/logout';
                });
            },

            /**
             * Gets order's info of a determinate user
             */
            getOrders() {
                axios.post('api/findOrders', {
                    '_token': this.$csrfToken,
                    'pubkey': pubkey,
                    'idUser': this.iduser,
                }).then((response) => {
                    if (response.data === "empty") {
                        this.emptyOrder = true;
                    } else {
                        this.fullOrder = true;
                        this.ordersinfo = response.data;

                        let i = null;
                        for(i=0; i<this.ordersinfo.length; i++){
                            this.ordersinfo[i].pay = this.moment(this.ordersinfo[i].pay);
                        }
                    }
                });
            },

            // Just decoration stuff
            displayOrder(data){
                (this.setorder == data)? this.setorder = null : this.setorder = data;
            },

            /**
             * Formats a date
             * @param date
             * @returns {string}
             */
            moment(date) {
                return moment(date).format('DD/MM/YYYY');
            },

        }
    }
</script>
