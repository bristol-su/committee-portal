<template>
    <div style="text-align: center;">
        <button class="btn btn-outline-info" style="float:left; width: 50%;" @click="showEditUserForm(null)">Add New Administrator</button>

        <table class="table table-hover table-responsive table-striped table-condensed" style="margin: auto; display: table;">
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
                        <button type="button" class="btn btn-outline-info" @click="showEditUserForm(user)">Edit</button>
                        <button type="button" class="btn btn-outline-info" @click="manageUserPermissions(user)">Manage Permissions</button>
                        <button type="button" class="btn btn-outline-danger" @click="deleteUser(user)">Delete</button>
                    </th>
                </tr>
            </tbody>
        </table>

        <modal
                name="manage-admin-user-permissions"
                height="auto"
                :scrollable="true"
                :resizable="true"
        >
            <manage-admin-user-permissions-and-roles
                    :user="editingUser"
                    @close="hideManagePermissions()"
            >
            </manage-admin-user-permissions-and-roles>
        </modal>

        <modal
                name="manage-admin-user"
                height="auto"
                :scrollable="true"
                :resizable="true"
        >
            <new-user-form
                    :user="editingUser"
                    @close="hideEditUserForm()"
                    @userUpdated="updateUser"
            >
            </new-user-form>
        </modal>
    </div>
</template>

<script>

    import ManageAdminUserPermissionsAndRoles from './ManageAdminUserPermissionsAndRoles';
    import NewUser from "./NewUser";

    export default {
        components: {
            ManageAdminUserPermissionsAndRoles,
            'new-user-form': NewUser
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
            },

            showEditUserForm(user) {
                this.editingUser = user;
                this.$modal.show('manage-admin-user')
            },

            hideEditUserForm() {
                this.editingUser = null;
                this.$modal.hide('manage-admin-user')
            },

            updateUser(user) {
                if (this.users.filter(singleUser => singleUser.id === user.id).length === 0) {
                    this.users.push(user);
                } else {
                    this.users.splice(this.users.indexOf(this.users.filter(singleUser => singleUser.id === user.id)[0]), 1, user);
                }
            }
        }
    }
</script>

<style>

</style>