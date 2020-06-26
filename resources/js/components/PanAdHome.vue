<template>
    <div v-if="showed">
        <div class="mt-2">
            <ul class="nav py-3 bg-light">
                <li class="navbar-brand ml-3">Home</li>
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
            }
        },

        mounted() {

            var self = this;
            EventBus.$on('sectioncalled', function (data) {
                if(data === 'Home'){
                    self.getSales();
                    self.getUsers();
                }
            });

            this.getSales();
            this.getUsers();
        },

        methods: {

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
                        this.labels.push(this.data[i].month);
                        this.values.push(this.data[i].sales);
                    }

                    var ctx = document.getElementById('myChartOrders').getContext('2d');
                    var myChartOrders = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: this.labels,
                            datasets: [{
                                label: 'Ventas',
                                backgroundColor: 'rgb(255, 90, 34)',
                                data: this.values
                            }]
                        },
                        options: {
                            responsive: true
                        }
                    });
                });
            },

            getUsers(){

            }
        }
    }

</script>
