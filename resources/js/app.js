import axios from 'axios';
import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue'
import AWN from "awesome-notifications";
import api from "./utilities/api/api";
import control from "./utilities/control/api";
import VueFormGenerator from 'vue-form-generator'


import ModuleInstances from './components/portal/module_instances/ModuleInstances';
import ActivitySidebar from "./components/portal/activity/ActivitySidebar";
import Sidebar from './settings/Sidebar';
import ActivityIndex from './settings/activity/index/Index';
import ActivityShow from './settings/activity/show/Show';
import ActivityCreate from './settings/activity/create/Create';
import ModuleInstanceShow from './settings/moduleinstance/show/Show';
import ModuleInstanceCreate from './settings/moduleinstance/create/Create';
import LogicShow from './settings/logic/show/Show';
import LogicIndex from './settings/logic/index/Index';
import LogicCreate from './settings/logic/create/Create';
import ActionShow from './settings/action/show/Show';
import ActionCreate from './settings/action/create/Create';
import Activities from './components/portal/activity/index/show/Activities';
import LogIntoRole from './components/login/LogIntoRole';
import LogIntoGroup from './components/login/LogIntoGroup';
import LogIntoUser from './components/login/LogIntoUser';
import LogIntoAdmin from './components/login/LogIntoAdmin';
import ToggleAdminOrParticipant from './components/portal/ToggleAdminOrParticipant';
import SitePermissions from './settings/sitepermissions/index/Index';
import SitePermission from './settings/sitepermissions/show/Show';
import RoleActivityProgress from './components/progress/activity/RoleActivityProgress';

import ActivityInstanceSwitcher from './components/portal/activity/ActivityInstanceSwitcher';

Vue.use(BootstrapVue);
Vue.use(VueFormGenerator);
Vue.prototype.$http = axios;
Vue.prototype.$notify = new AWN({position: 'top-right'});
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}
Vue.prototype.$api = new api(portal.API_URL, axios);
Vue.prototype.$control = new control(portal.API_URL + '/control', axios);
Vue.prototype.$csrf = token.content;

window.Event = new Vue();

new Vue({
    el: '#vue-root',

    components: {
        ModuleInstances,
        ActivitySidebar,
        Sidebar,

        ActivityIndex,
        ActivityShow,
        ActivityCreate,

        ModuleInstanceShow,
        ModuleInstanceCreate,

        LogicShow,
        LogicIndex,
        LogicCreate,

        ActionShow,
        ActionCreate,

        Activities,
        ToggleAdminOrParticipant,

        LogIntoRole,
        LogIntoGroup,
        LogIntoUser,
        LogIntoAdmin,

        SitePermissions,
        SitePermission,

        ActivityInstanceSwitcher,
        RoleActivityProgress

    }
});


