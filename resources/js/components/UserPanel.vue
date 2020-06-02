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
                            <a class="list-group-item list-group-item-action" id="list-delaccount-list" data-toggle="list"
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
                                         aria-labelledby="list-account-list">1
                                    </div>
                                    <div class="tab-pane fade" id="list-orders" role="tabpanel"
                                         aria-labelledby="list-orders-list">2
                                    </div>
                                    <div class="tab-pane fade" id="list-messages" role="tabpanel"
                                         aria-labelledby="list-messages-list">3
                                    </div>
                                    <div class="tab-pane fade" id="list-designs" role="tabpanel"
                                         aria-labelledby="list-designs-list">4
                                    </div>
                                    <div class="tab-pane fade" id="list-delaccount" role="tabpanel"
                                         aria-labelledby="list-delaccount-list">5
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
    export default {

        props: {
          account: '',
          orders: '',
          notif: '',
          designs: '',
          delaccount: '',
        },
        mounted() {
            console.log('user panel montado');
        }
    }
</script>
