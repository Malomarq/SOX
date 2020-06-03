<template>
    <div class="usersox">
        <div class="container">
            <div class="col-12 col-md-12">
                <div class="row">
                    <div class="col-12 col-md-4 my-2 my-md-5">
                        <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-account-list"
                               data-toggle="list" href="#list-account" role="tab" aria-controls="account">
                                <span class="mr-3 panusernav"><i class="fas fa-user-circle fa-lg"></i></span>
                                {{account}}
                            </a>
                            <a class="list-group-item list-group-item-action" id="list-orders-list" data-toggle="list"
                               href="#list-orders" role="tab" aria-controls="orders">
                                <span class="mr-3 panusernav"><i class="fas fa-dolly fa-lg"></i></span>
                                {{orders}}
                            </a>
                            <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list"
                               href="#list-messages" role="tab" aria-controls="messages">
                                <span class="mr-3 panusernav"><i class="fas fa-envelope fa-lg"></i></span>
                                {{notif}}
                            </a>
                            <a class="list-group-item list-group-item-action" id="list-designs-list" data-toggle="list"
                               href="#list-designs" role="tab" aria-controls="designs">
                                <span class="mr-3 panusernav"><i class="fas fa-socks fa-lg"></i></span>
                                {{designs}}
                            </a>
                            <a class="list-group-item list-group-item-action" id="list-delaccount-list"
                               data-toggle="list"
                               href="#list-delaccount" role="tab" aria-controls="delaccount">
                                <span class="mr-3 panusernav"><i class="fas fa-times-circle fa-lg"></i></span>
                                {{delaccount}}
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-8 my-2 my-md-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="list-account" role="tabpanel"
                                         aria-labelledby="list-account-list">

                                        <div class="panuseracctit ml-3 mt-3">{{accounttext1}}</div>
                                        <div class="row">

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

                                        <div class="panuseracctit ml-3 mt-3">{{accounttext2}}</div>
                                        <div class="row">

                                        </div>

                                        <div class="panuseracctit ml-3 mt-3">{{accounttext3}}</div>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="container">
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Password</label>
                                                        <input type="password" class="form-control"
                                                               id="exampleInputPassword1" placeholder="Password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Password</label>
                                                        <input type="password" class="form-control"
                                                               id="exampleInputPassword1" placeholder="Password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Password</label>
                                                        <input type="password" class="form-control"
                                                               id="exampleInputPassword1" placeholder="Password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="container">
                                                    <button>GUardar</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="tab-pane fade" id="list-orders" role="tabpanel"
                                         aria-labelledby="list-orders-list">orders
                                    </div>
                                    <div class="tab-pane fade" id="list-messages" role="tabpanel"
                                         aria-labelledby="list-messages-list">notifications
                                    </div>
                                    <div class="tab-pane fade" id="list-designs" role="tabpanel"
                                         aria-labelledby="list-designs-list">designs
                                    </div>
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

    const axios = require('axios').default;
    const pubkey = "6d489dd5cfb6966122feaca117e324d5eccd4a3536a3de14a713d03892a7e22a";

    export default {

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
        },
        mounted() {
            console.log('user panel montado');
            this.finduser();
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
                }]
            }
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
            }
        }
    }
</script>
