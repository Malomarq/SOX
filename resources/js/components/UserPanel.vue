<template>
    <div class="usersox">
        <div class="container">
            <div class="col-12 col-md-12">
                <div class="row">
                    <div class="col-12 col-md-4 my-2 my-md-5">
                        <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-account-list"
                               data-toggle="list" href="#list-account" role="tab" aria-controls="account">
                                <span class="mr-3 panusernav"><i class="fas fa-user-circle fa-lg"/></span>
                                {{account}}
                            </a>
                            <a class="list-group-item list-group-item-action" id="list-orders-list" data-toggle="list"
                               href="#list-orders" role="tab" aria-controls="orders">
                                <span class="mr-3 panusernav"><i class="fas fa-dolly fa-lg"/></span>
                                {{orders}}
                            </a>
                            <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list"
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
                    <div class="col-12 col-md-8 my-2 my-md-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content" id="nav-tabContent">

                                    <!--ACCOUNT-->
                                    <div class="tab-pane fade show active" id="list-account" role="tabpanel"
                                         aria-labelledby="list-account-list">

                                        <div class="panuseracctit ml-3 mt-3">{{accounttext1}}</div>
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
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="panuseracctit ml-3 mt-3">{{accounttext3}}</div>
                                                <div class="container">
                                                    <form @submit.prevent="updatePass">
                                                        <div class="form-group">
                                                            <label>{{currentpass}}</label>
                                                            <!--<input type="password" class="form-control"
                                                                   id="exampleInputPassword1" placeholder="Password">-->
                                                            <eye-pass customclass="form-control" modelprop="vmcurpass"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>{{newpass}}</label>
                                                            <!--<input type="password" class="form-control"
                                                                   id="exampleInputPassword1" placeholder="Password">-->
                                                            <eye-pass customclass="form-control" modelprop="vmnewpass"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>{{confirmpass}}</label>
                                                            <!--<input type="password" class="form-control"
                                                                   id="exampleInputPassword1" placeholder="Password">-->
                                                            <eye-pass customclass="form-control" modelprop="vmconfpass"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary">{{txtbut}}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--ORDERS-->
                                    <div class="tab-pane fade" id="list-orders" role="tabpanel"
                                         aria-labelledby="list-orders-list">orders
                                    </div>

                                    <!--NOTIFICATIONS-->
                                    <div class="tab-pane fade" id="list-messages" role="tabpanel"
                                         aria-labelledby="list-messages-list">notifications
                                    </div>

                                    <!--DESIGNS-->
                                    <div class="tab-pane fade" id="list-designs" role="tabpanel"
                                         aria-labelledby="list-designs-list">designs
                                    </div>

                                    <!--DELETE-->
                                    <div class="tab-pane fade" id="list-delaccount" role="tabpanel"
                                         aria-labelledby="list-delaccount-list">delete account
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import EventBus from "../event-bus";
    import EyePassLogin from "./EyePassLogin";

    const axios = require('axios').default;
    const pubkey = "6d489dd5cfb6966122feaca117e324d5eccd4a3536a3de14a713d03892a7e22a";

    export default {
        components:{
            EyePassLogin
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
            accounttext1: '',
            name: '',
            lastname: '',
            accounttext2: '',

            accounttext3: '',
            currentpass: '',
            newpass: '',
            confirmpass: '',
            txtbut: '',
        },
        computed: {
            iduser() {
                return this.idu;
            }
        },
        data() {
            return {
                user: [{
                    name: '',
                    lastname: '',
                    email: ''
                }],

                // models
                vmcurpass: '',
                vmnewpass: '',
                vmconfpass: '',

                // errors

            }
        },
        mounted() {
            var self = this;
            console.log('user panel montado');
            this.finduser();
            EventBus.$on('inputval', function(data){
                if(data[1] === 'vmcurpass'){
                    self.vmcurpass = data[0];
                }

                if(data[1] === 'vmnewpass'){
                    self.vmnewpass = data[0];
                }

                if(data[1] === 'vmconfpass'){
                    self.vmconfpass = data[0];
                }
            });
        },
        methods: {
            finduser() {
                axios.get('api/findUser', {
                    params: {
                        'pubkey': pubkey,
                        'iduser': this.iduser
                    }
                }).then((response) => {
                    this.user[0].name = response.data[0].name;
                    this.user[0].lastname = response.data[0].lastname;
                    this.user[0].email = response.data[0].email;
                })
            },

            updatePass(){
                axios.post('api/updatePass', {
                    '_token': this.$csrfToken,
                    'pubkey': pubkey,
                    'curpass': this.vmcurpass,
                    'newpass': this.vmnewpass,
                    'confpass': this.vmconfpass
                }).then((response) => {
                   console.log(response.data);
                });
            }
        }
    }
</script>
