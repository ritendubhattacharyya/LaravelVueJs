/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ShowBlog.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
import VueResource from 'vue-resource';
import VueRouter from 'vue-router';
import ShowBlog from "./components/ShowBlog.vue";
import AddBlog from "./components/AddBlog.vue";
import Header from "./components/Header.vue";
import SingleBlog from "./components/SingleBlog.vue";

Vue.component('header-component', Header);

Vue.use(VueResource);
Vue.use(VueRouter);

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;

const router = new VueRouter({
    routes: [
        {path: '/', component: ShowBlog},
        {path: '/add', component: AddBlog},
        {path: '/:id', component: SingleBlog}
    ]
})
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
});
