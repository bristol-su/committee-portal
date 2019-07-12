import AdminUsersTable from "./admin/settings/users/AdminUsersTable";
import RoleTable from "./admin/settings/roles-and-permissions/RoleTable";
import Create from "./admin/settings/events/Create";
import ModuleList from "./admin/settings/events/module/ModuleList";

new Vue({
    el: '#root-site-settings',

    components: {
        'admin-users-table': AdminUsersTable,
        'role-table': RoleTable,
        'event-create': Create,
        'module-list': ModuleList
    }
});