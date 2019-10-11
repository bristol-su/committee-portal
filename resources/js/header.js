import 'bootstrap';
import Vue from 'vue';
import AWN from "awesome-notifications";
import api from "./utilities/api/api";
import LogIntoRole from './components/login/LogIntoRole';
import axios from 'axios';

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

}
Vue.prototype.$http = axios;
Vue.prototype.$notify = new AWN({position: 'top-right'});
Vue.prototype.$api = new api(process.env.MIX_API_URL, axios);

Vue.prototype.$csrf = token.content;

new Vue({
    el: '#header-vue-root',

    components: {
        LogIntoRole,
    }
});
