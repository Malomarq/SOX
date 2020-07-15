<template>
    <div v-if="showed">
        <div class="mt-2">
            <ul class="nav py-3 bg-light">
                <li class="navbar-brand ml-3">Home</li>
                <li class="nav-item ml-auto mr-3">
                    <button type="button" class="btn btn-primary" @click="getToNotif()">
                        <span><i class="fas fa-paper-plane mr-2"></i></span>
                        <span class="badge badge-light">0</span>
                    </button>
                </li>
            </ul>

            <div class="row mt-5">
                <div class="col-12 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <span><i class="fas fa-chart-area mr-2"></i><b>Pedidos</b></span>
                        </div>
                        <canvas id="myChartOrders"></canvas>
                    </div>
                </div>
                <div class="col-12 col-sm-6 mt-sm-0 mt-5">
                    <div class="card">
                        <div class="card-header">
                            <span><i class="fas fa-chart-bar mr-2"></i><b>Usuarios</b></span>
                        </div>
                        <canvas id="myChartUsers"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import Chart from 'chart.js';
    import EventBus from "../event-bus";

    const axios = require('axios').default;
    const pubkey = "6d489dd5cfb6966122feaca117e324d5eccd4a3536a3de14a713d03892a7e22a";

    export default {

        props: {
            showed: false,
        },

        data() {
            return {
                data: [],
                labels: [],
                values: [],

                users: [],
                labelsU: [],
                valuesU: [],
            }
        },

        mounted() {
            this.getSales();
            this.getUsers();

            var self = this;

            /**
             * Listen to "sectioncalled" event, that refresh the graphics in order to be seen correctly
             */
            EventBus.$on('sectioncalled', function (data) {
                if(data === 'Home'){
                    self.getSales();
                    self.getUsers();
                }
            });

        },

        methods: {

            /**
             * Gets sales per month and shows a graphic
             */
            getSales() {
                axios.post('api/getSales', {
                    'pubkey': pubkey,
                    '_token': this.$csrfToken,
                }).then((response) => {
                    this.data = response.data;

                    this.labels = [];
                    this.values = [];

                    let i = null;
                    for (i = 0; i < this.data.length; i++) {
                        (this.data[i].month >= 10) ? this.labels.push(this.data[i].month) : this.labels.push('0'+this.data[i].month);
                        this.values.push(this.data[i].sales);
                    }

                    if(this.showed) {
                        var ctx = document.getElementById('myChartOrders').getContext('2d');
                        var myChartOrders = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: this.labels,
                                datasets: [{
                                    label: 'Ventas',
                                    backgroundColor: 'rgb(255, 90, 34)',
                                    hoverBackgroundColor: 'rgb(26, 51, 248)',
                                    data: this.values
                                }]
                            },
                            options: {
                                responsive: true,
                                layout: {
                                    padding: {
                                        left: 20,
                                        right: 20,
                                        top: 20,
                                        bottom: 20
                                    }
                                },
                                scales: {
                                    yAxes: [{
                                        scaleLabel: {
                                            display: true,
                                            labelString: 'Cant.'
                                        }
                                    }],
                                    xAxes: [{
                                        scaleLabel: {
                                            display: true,
                                            labelString: 'Meses'
                                        }
                                    }]
                                },
                            }
                        });
                    }
                });
            },

            /**
             * Gets how many accounts per month are active at the app and shows a graphic
             */
            getUsers(){
                axios.post('api/getUsers', {
                    'pubkey': pubkey,
                    '_token': this.$csrfToken,
                }).then((response) => {
                    this.users = response.data;

                    this.labelsU = [];
                    this.valuesU = [];

                    let i = null;
                    for (i = 0; i < this.users.length; i++) {
                        (this.users[i].month >= 10) ? this.labelsU.push(this.users[i].month) : this.labelsU.push('0'+this.users[i].month);
                        this.valuesU.push(this.users[i].values);
                    }

                    if(this.showed) {
                        var ctxu = document.getElementById('myChartUsers').getContext('2d');
                        var myChartUsers = new Chart(ctxu, {
                            type: 'bar',
                            data: {
                                labels: this.labelsU,
                                datasets: [{
                                    label: 'Nuevas cuentas',
                                    backgroundColor: '#3490dc',
                                    data: this.valuesU
                                }]
                            },
                            options: {
                                responsive: true,
                                layout: {
                                    padding: {
                                        left: 20,
                                        right: 20,
                                        top: 20,
                                        bottom: 20
                                    }
                                },
                                scales: {
                                    yAxes: [{
                                        scaleLabel: {
                                            display: true,
                                            labelString: 'Cant.'
                                        }
                                    }],
                                    xAxes: [{
                                        scaleLabel: {
                                            display: true,
                                            labelString: 'Meses'
                                        }
                                    }]
                                },
                            }
                        });
                    }
                });
            },

            /**
             * Emits the "mail" event if clicked
             */
            getToNotif(){
                EventBus.$emit('mail');
            }
        }
    }

</script>
