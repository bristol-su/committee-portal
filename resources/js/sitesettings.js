import AdminUsersTable from "./admin/settings/users/AdminUsersTable";
import RoleTable from "./admin/settings/roles-and-permissions/RoleTable";

new Vue({
    el: '#root-site-settings',

    components: {
        'admin-users-table': AdminUsersTable,
        'role-table': RoleTable,
    }
});