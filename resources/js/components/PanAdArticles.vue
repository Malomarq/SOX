<template>
    <div v-if="showed">
        <div class="mt-2">
            <ul class="nav py-3 bg-light">
                <li class="navbar-brand ml-3">{{title}}</li>
                <li class="nav-item ml-auto mr-2 dropdown show">

                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ordenar por
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <button type="button" class="dropdown-item" @click="sortby('default')">ref</button>
                        <button type="button" class="dropdown-item" @click="sortby('name')">nombre</button>
                        <button type="button" class="dropdown-item" @click="sortby('price')">precio</button>
                    </div>

                </li>
                <li class="nav-item mt-1">
                    <button type="button" class="btn btn-success btn-sm mr-3" data-toggle="modal"
                            data-target="#product-new">
                        <span><i class="fas fa-plus fa-1x"></i></span>
                    </button>
                </li>
            </ul>

            <div class="mt-5">
                <small>Mostrando un total de {{totalart}} productos</small>
            </div>

            <div class="mt-1">
                <b-row class="justify-content-center">
                    <b-col cols="12" md="3" v-for="item in products.data"
                           :key="item.idArt"
                           class="mb-5"
                    >
                        <b-card class="text-center" footer-tag="footer" header-tag="header">
                            <template v-slot:header>
                                <div class="text-right">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            @click="productUp(item.idArt)">
                                        <span><i class="fas fa-pen fa-1x"></i></span>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            @click="productDel(item.idArt)">
                                        <span><i class="fas fa-trash-alt fa-1x"></i></span>
                                    </button>

                                </div>
                            </template>


                            <a v-bind:href="'product?id=' + item.idArt">
                                <b-card-img-lazy fluid center top :src="'storage/articles/' + item.image"
                                                 class="imgindex"/>
                            </a>

                            <template v-slot:footer>
                                <p class="panadprodstxt mb-1">{{item.name}}</p>
                                <small><strong>{{item.price}}€</strong></small>
                            </template>
                        </b-card>

                    </b-col>
                </b-row>

                <pagination :pagination="products"
                            @paginate="allproducts()"
                            :offset="4">
                </pagination>
            </div>

        </div>

        <!-- PRODUCT NEW -->

        <div class="modal fade" id="product-new" tabindex="-1" role="dialog"
             aria-labelledby="modalCenterTitleNew" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-light">
                        <h5 class="modal-title" id="modalLongTitleProductNew">Nuevo producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form id="newform" enctype="multipart/form-data" @submit.prevent="newproduct">
                            <div class="form-group px-3">
                                <label>Imagen</label>
                                <input id="newimage" type="file" class="form-control-file" ref="newimage"
                                       @change="handleFileUpload" required>
                                <small v-if="showErrnewimage" class="text-danger">{{errNewimage}}</small>
                            </div>
                            <div class="form-group px-3">
                                <label>Nombre</label>
                                <input v-model="newname" type="text" class="form-control" required>
                                <small v-if="showErrnewname" class="text-danger">{{errNewname}}</small>
                            </div>
                            <div class="form-group px-3">
                                <p>Precio</p>
                                <div class="form-check form-check-inline">
                                    <input v-model="newprice" class="form-check-input" name="radios" type="radio"
                                           id="gridRadios1" value="5.95" required>
                                    <label class="form-check-label" for="gridRadios1">
                                        5.95€
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input v-model="newprice" class="form-check-input" name="radios" type="radio"
                                           id="gridRadios2" value="7.95" required>
                                    <label class="form-check-label" for="gridRadios2">
                                        7.95€
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input v-model="newprice" class="form-check-input" name="radios" type="radio"
                                           id="gridRadios3" value="10.95" required>
                                    <label class="form-check-label" for="gridRadios3">
                                        10.95€
                                    </label>
                                </div>
                                <small v-if="showErrnewprice" class="text-danger">{{errNewprice}}</small>
                            </div>
                            <div class="form-group ml-3">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Subir</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <!-- END PRODUCT NEW -->

        <!-- PRODUCT UPDATE -->

        <div class="modal fade" id="prod-update" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitleUpdate" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info text-light">
                        <h5 class="modal-title" id="exampleModalLongTitleUpdate">Actualizar producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-md-6 text-center">
                                <b-card-img-lazy fluid center top :src="'storage/articles/' + placeupimage"/>
                                <div class="mt-3">
                                    <small>{{placeupname}}</small><br>
                                    <small>{{placeupprice}}€</small>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <form id="updateProdform" @submit.prevent="updateProd">
                                    <div class="form-group">
                                        <label>Imagen</label>
                                        <input id="upimage" type="file" class="form-control-file" ref="upimage"
                                               @change="handleFileUpdateUpload">
                                        <small v-if="showErrnewimage" class="text-danger">{{errNewimage}}</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" class="form-control" v-model="upname">
                                        <small v-if="showErrnewname" class="text-danger">{{errNewname}}</small>
                                    </div>
                                    <div class="form-group">
                                        <p>Precio</p>
                                        <div class="form-check form-check-inline">
                                            <input v-model="upprice" class="form-check-input" name="upradios"
                                                   type="radio"
                                                   id="gridUpRadios1" value="5.95">
                                            <label class="form-check-label" for="gridUpRadios1">
                                                5.95€
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input v-model="upprice" class="form-check-input" name="upradios"
                                                   type="radio"
                                                   id="gridUpRadios2" value="7.95">
                                            <label class="form-check-label" for="gridUpRadios2">
                                                7.95€
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input v-model="upprice" class="form-check-input" name="upradios"
                                                   type="radio"
                                                   id="gridUpRadios3" value="10.95">
                                            <label class="form-check-label" for="gridUpRadios3">
                                                10.95€
                                            </label>
                                        </div>
                                        <small v-if="showErrnewprice" class="text-danger">{{errNewprice}}</small>
                                    </div>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- END PRODUCT UPDATE -->

        <!-- PRODUCT DELETE -->

        <div class="modal fade" id="prod-delete" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitleDelete" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-light">
                        <h5 class="modal-title" id="exampleModalLongTitleDelete">Eliminar producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="font-weight-bold text-uppercase">¿Estás seguro de que deseas eliminar este
                            producto?</p>
                        <p>Este proceso es irreversible</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" @click="confirmDel">Ok</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- END PRODUCT DELETE -->


    </div>
</template>

<script>

    import Pagination from './Pagination.vue';

    const axios = require('axios').default;

    export default {
        components: {
            Pagination
        },

        props: {

            // Component visible
            showed: false,

            // Title
            title: '',
        },

        data() {
            return {

                // Products's info
                products: {
                    total: 0,
                    per_page: 2,
                    from: 1,
                    to: 0,
                    current_page: 1
                },

                totalart: '',

                // Pagination
                offset: 4,

                // Filter
                filter: 'default',

                // Product's id
                idArt: null,

                // * New product's form

                // inputs values
                newimage: null,
                newname: '',
                newprice: null,

                // errors
                showErrnewname: false,
                errNewname: '',
                showErrnewprice: false,
                errNewprice: '',
                showErrnewimage: false,
                errNewimage: '',

                // * Update product's form

                // input values
                upname: '',
                upimage: '',
                upprice: '',

                // placeholders
                placeupimage: '',
                placeupname: '',
                placeupprice: '',

            }
        },

        mounted() {
            this.sortby('default');
            this.allproducts();
        },

        methods: {

            // @vuese
            // Finds products info and paginates it
            // @arg sorted
            // @arg page

            allproducts() {
                axios.post(`api/products?page=${this.products.current_page}`, {
                        'order': this.filter
                })
                    .then((response) => {
                        this.products = response.data;
                        this.totalart = response.data.total;
                    });

                window.scrollTo(0, 0);
            },

            // @vuese
            // Save product's id to delete it
            // @arg data
            productDel(data) {
                this.idArt = data;
                $('#prod-delete').modal('show');
            },

            // @vuese
            // Save product's id to update it
            // @arg data
            productUp(data) {
                this.idArt = data;

                axios.post('api/product/' + this.idArt).then((response) => {
                    this.placeupimage = response.data.image;
                    this.placeupname = response.data.name;
                    this.placeupprice = response.data.price;
                }).catch((error) => {
                    console.log(error);
                });


                $('#prod-update').modal('show');
            },

            // @vuese
            // Handles a new file to add a new product or update it
            // @arg e

            handleFileUpload(e) {
                this.newimage = this.$refs.newimage.files[0];
            },

            handleFileUpdateUpload(e) {
                this.upimage = this.$refs.upimage.files[0];
            },

            // @vuese
            // Adds a new product to database and reloads the page. It also manages every validation error

            newproduct() {

                const data = new FormData();

                data.append('_token', this.$csrfToken);
                data.append('newimage', this.newimage);
                data.append('newname', this.newname);
                data.append('newprice', this.newprice);

                axios.post('api/upload', data).then((response) => {
                    if (response.data === "Ok") {
                        location.reload();
                    }
                }).catch((error) => {

                    if (error.response.data['errors']['newname']) {
                        this.showErrnewname = true;
                        this.errNewname = error.response.data['errors']['newname'][0];
                    } else {
                        this.showErrnewname = false;
                        this.errNewname = '';
                    }

                    if (error.response.data['errors']['newimage']) {
                        this.showErrnewimage = true;
                        this.errNewimage = error.response.data['errors']['newimage'][0];
                    } else {
                        this.showErrnewimage = false;
                        this.errNewimage = '';
                    }

                    if (error.response.data['errors']['newprice']) {
                        this.showErrnewprice = true;
                        this.errNewprice = error.response.data['errors']['newprice'][0];
                    } else {
                        this.showErrnewprice = false;
                        this.errNewprice = '';
                    }
                });
            },

            // @vuese
            // Deletes a product by its id and reloads the page
            confirmDel() {

                axios.post('api/delete', {
                    '_token': this.$csrfToken,
                    'idprod': this.idArt,
                }).then((response) => {
                    if (response.data === "Ok") {
                        this.idArt = null;
                        location.reload();
                    }
                }).catch(error => {
                    console.log(error.message);
                });
            },

            // @vuese
            // Updates image, name or price of a product by id. It also manages every validation error
            updateProd() {

                const data = new FormData();

                data.append('_token', this.$csrfToken);
                data.append('idArt', this.idArt);
                data.append('upimage', this.upimage);
                data.append('upname', this.upname);
                data.append('upprice', this.upprice);

                axios.post('api/update', data).then((response) => {
                    if (response.data === "Ok") {
                        this.idArt = null;
                        location.reload();
                    }
                }).catch((error) => {
                    console.log(error);
                    if (error.response.data['errors']['upname']) {
                        this.showErrnewname = true;
                        this.errNewname = error.response.data['errors']['upname'][0];
                    } else {
                        this.showErrnewname = false;
                        this.errNewname = '';
                    }

                    if (error.response.data['errors']['upimage']) {
                        this.showErrnewimage = true;
                        this.errNewimage = error.response.data['errors']['upimage'][0];
                    } else {
                        this.showErrnewimage = false;
                        this.errNewimage = '';
                    }

                    if (error.response.data['errors']['upprice']) {
                        this.showErrnewprice = true;
                        this.errNewprice = error.response.data['errors']['upprice'][0];
                    } else {
                        this.showErrnewprice = false;
                        this.errNewprice = '';
                    }
                });

            },

            // @vuese
            // Sorts products by the filter choosen
            // @arg data
            sortby(data) {
                this.filter = data;
                this.allproducts();
            },
        }
    }

</script>
