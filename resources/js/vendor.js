import _ from 'lodash';
import jQuery from 'jquery';
import Popper from 'popper.js';
import 'bootstrap';
import axios from 'axios';
import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue'
import VModal from "vue-js-modal";
import AWN from "awesome-notifications";
import Vuex from "vuex";
import 'spin.js/spin.css';
import PortalVue from 'portal-vue';
import api from "./utilities/api/api";



/**
 * Load lodash
 */
window._ = _;
window.Vue = Vue;
window.$ = window.jQuery = jQuery;
window.axios = axios;

Vue.use(PortalVue);
Vue.use(BootstrapVue);
Vue.use(VModal);
Vue.use(Vuex);

Vue.prototype.$http = axios;
Vue.prototype.$notify = new AWN({
    position: 'top-right'
});
Vue.prototype.$api = new api('http://portal.local/api');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */


window.Popper = Popper.default;


/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

