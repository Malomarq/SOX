/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import '../sass/app.scss'

import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import VueCsrf from 'vue-csrf';
import EventBus from './event-bus';

// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

// Install vue-csrf plugin
Vue.use(VueCsrf);

window.Vue = require('vue');
window.EventBus = new Vue();

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('eye-pass', require('./components/EyePassLogin.vue').default);
Vue.component('hero', require('./components/Hero.vue').default);
Vue.component('searchbar', require('./components/Searchbar.vue').default);
Vue.component('products-index', require('./components/Showproducts.vue').default);
Vue.component('product', require('./components/Product.vue').default);
Vue.component('panelf', require('./components/Panelfilters.vue').default);
Vue.component('admin-panel', require('./components/AdminPanel.vue').default);
Vue.component('home', require('./components/PanAdHome.vue').default);
Vue.component('account', require('./components/PanAdAccount.vue').default);
Vue.component('articles', require('./components/PanAdArticles.vue').default);
Vue.component('users', require('./components/PanAdUsers.vue').default);
Vue.component('orders', require('./components/PanAdOrd.vue').default);
Vue.component('contacts', require('./components/PanAdCon.vue').default);
Vue.component('user-panel', require('./components/UserPanel.vue').default);
Vue.component('pagination', require('./components/Pagination.vue').default);

//Vue.component('page-number', require('laravel-vue-pagination'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
