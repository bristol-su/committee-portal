import AdminUsersTable from "./admin/settings/users/AdminUsersTable";
import RoleTable from "./admin/settings/roles-and-permissions/RoleTable";
import EventCreate from "./admin/settings/events/Create";
import ModuleList from "./admin/settings/events/module/ModuleList";
import LogicCreate from './admin/settings/logic/Create';

new Vue({
    el: '#root-site-settings',

    components: {
        'admin-users-table': AdminUsersTable,
        'role-table': RoleTable,
        'event-create': EventCreate,
        'module-list': ModuleList,
        'logic-create': LogicCreate
    }
});