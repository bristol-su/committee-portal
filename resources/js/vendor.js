import _ from 'lodash';
import Popper from 'popper.js';
import axios from 'axios';
import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue'
import jQuery from 'jquery';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import Moment from 'moment';
import VModal from "vue-js-modal";
import AWN from "awesome-notifications";
import Vuex from "vuex";
import {Spinner} from 'spin.js';
import 'spin.js/spin.css';
import PortalVue from 'portal-vue';



/**
 * Load lodash
 */
window._ = _;
window.Vue = Vue;
window.$ = window.jQuery = jQuery;

Vue.use(PortalVue);
Vue.use(BootstrapVue);
Vue.use(VModal);
Vue.use(Vuex);

Vue.prototype.$http = axios;
Vue.prototype.$notify = new AWN({
    position: 'top-right'
});

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

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}


