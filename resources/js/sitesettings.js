import AdminUsersTable from "./admin/settings/admin-users/AdminUsersTable";
import RoleTable from "./admin/settings/roles-and-permissions/RoleTable";
import NewUser from "./admin/settings/admin-users/NewUser";
import NewRole from "./admin/settings/roles-and-permissions/NewRole";

new Vue({
    el: '#root-site-settings',

    components: {
        'admin-users-table': AdminUsersTable,
        'role-table': RoleTable,
    }
});