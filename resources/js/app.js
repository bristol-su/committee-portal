
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.Popper = require('popper.js');

window.jQuery = require('jquery');

window.axios = require('axios');

window.VueSelect = require('vue-select');
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
//
// const files = require.context('./', true, /\.vue$/i); // Get all files in this directory
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default)); // register

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component("v-select", VueSelect.VueSelect);

