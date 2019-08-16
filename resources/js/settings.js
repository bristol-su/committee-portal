import Sidebar from './settings/Sidebar';
import 'vue-sidebar-menu/dist/vue-sidebar-menu.css'

import ActivityIndex from './settings/activity/index/Index';
import ActivityShow from './settings/activity/show/Show';
import ActivityCreate from './settings/activity/create/Create';

import ModuleInstanceShow from './settings/moduleinstance/show/Show';
import ModuleInstanceCreate from './settings/moduleinstance/create/Create';

import LogicShow from './settings/logic/show/Show';
import LogicIndex from './settings/logic/index/Index';
import LogicCreate from './settings/logic/create/Create';

new Vue({
    el: '#root-site-settings',

    components: {
        Sidebar,

        ActivityIndex,
        ActivityShow,
        ActivityCreate,

        ModuleInstanceShow,
        ModuleInstanceCreate,

        LogicShow,
        LogicIndex,
        LogicCreate
    }
});
