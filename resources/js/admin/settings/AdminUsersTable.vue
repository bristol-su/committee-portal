<template>
    <div>

        <table class="table table-hover table-responsive table-striped" style="margin-left:auto; margin-right:auto;">
            <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Email</th>
                <th>ID</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="user in users">
                    <th>#{{user.id}}</th>
                    <th>{{user | fullname}}</th>
                    <th>{{user.email}}</th>
                    <th>{{user.student_id}}</th>
                    <th>
                        <!--<button type="button" class="btn btn-outline-info" @click="editUser(user)">Edit</button>-->
                        <button type="button" class="btn btn-outline-info" @click="manageUserPermissions(user)">Manage Permissions</button>
                        <button type="button" class="btn btn-outline-danger" @click="deleteUser(user)">Delete</button>
                    </th>
                </tr>
            </tbody>
        </table>

        <modal
                height="auto"
                name="manage-admin-user-permissions"
        >
            <manage-admin-user-permissions-and-roles
                    :user="editingUser"
                    @close="hideManagePermissions()"
            >
            </manage-admin-user-permissions-and-roles>
        </modal>
    </div>
</template>

<script>

    import ManageAdminUserPermissionsAndRoles from './ManageAdminUserPermissionsAndRoles';

    export default {
        components: {
            ManageAdminUserPermissionsAndRoles
        },

        data() {
            return {
                users: [],

                editingUser: null
            }
        },

        created() {

            this.$http.get('/admin/settings/admin-users/get-users')
                .then(response => this.users = response.data)
                .catch(error => this.$notify.alert(error.message));
        },

        filters: {
            fullname (user) {
                return user.forename + ' ' + user.surname;
            }
        },

        methods: {
            editUser(user) {
                // TODO Implement edit user function to allow admins to edit their/all profiles
            },
            deleteUser(user) {
                if(confirm('Deleting user #'+user.id+'('+ user.email +'). Are you sure?')) {
                    this.$http.delete('/admin/settings/admin-users/'+ user.id +'/delete-user')
                        .then(response => {
                            this.$notify.success('User deleted.');
                            this.users.splice(this.users.indexOf(user), 1);
                        })
                        .catch(error => {
                            this.$notify.alert('User couldn\'t be deleted. ' + error.message );
                        })
                }
            },
            manageUserPermissions(user) {
                this.editingUser = user;
                this.$modal.show('manage-admin-user-permissions')
            },

            hideManagePermissions() {
                this.editingUser = null;
                this.$modal.hide('manage-admin-user-permissions')
            }
        }
    }
</script>

<style>

</style>