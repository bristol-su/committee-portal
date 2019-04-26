<template>
    <div style="text-align: center;">
        <button class="btn btn-outline-info" style="float:left; width: 50%;" @click="showEditRoleForm(null)">Add New Role</button>

        <table class="table table-hover table-responsive table-striped table-condensed" style="margin: auto; display: table;">
            <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="role in roles">
                    <th>#{{role.id}}</th>
                    <th>{{role.name}}</th>
                    <th>
                        <button type="button" class="btn btn-outline-info" @click="showEditRoleForm(role)">Edit</button>
                        <button type="button" class="btn btn-outline-info" @click="manageRolePermissions(role)">Manage Permissions</button>
                        <button type="button" class="btn btn-outline-danger" @click="deleteRole(role)">Delete</button>
                    </th>
                </tr>
            </tbody>
        </table>

        <modal
                name="manage-role-permissions"
                height="auto"
                :scrollable="true"
                :resizable="true"
        >
            <update-role-permissions
                    :role="editingRole"
                    @close="hideManagePermissions()"
            >
            </update-role-permissions>
        </modal>

        <modal
                name="manage-role"
                height="auto"
                :scrollable="true"
                :resizable="true"
        >
            <new-role-form
                    :role="editingRole"
                    @close="hideEditRoleForm()"
                    @roleUpdated="updateRole"
            >
            </new-role-form>
        </modal>
    </div>
</template>

<script>

    import UpdateRolePermissions from './UpdateRolePermissions';
    import NewRole from './NewRole';
    import Form from './../../../utilities/Form';

    export default {
        components: {
            UpdateRolePermissions,
            'new-role-form': NewRole
        },

        data() {
            return {
                roles: [],

                editingRole: null
            }
        },

        mounted() {

            new Form({}).get('/admin/settings/roles/get')
                .then(data => {
                    this.roles = data;
                })
                .catch(error => this.$notify.alert(error.message));
        },

        methods: {
            deleteRole(role) {
                if(confirm('Deleting role #'+role.id+'('+ role.name +'). Are you sure?')) {
                    this.$http.delete('/admin/settings/roles/'+ role.id +'')
                        .then(response => {
                            this.$notify.success('Role deleted.');
                            this.roles.splice(this.roles.indexOf(role), 1);
                        })
                        .catch(error => {
                            this.$notify.alert('Role couldn\'t be deleted. ' + error.message );
                        })
                }
            },
            manageRolePermissions(role) {
                this.editingRole = role;
                this.$modal.show('manage-role-permissions')
            },

            hideManagePermissions() {
                this.editingRole = null;
                this.$modal.hide('manage-role-permissions')
            },

            showEditRoleForm(role) {
                this.editingRole = role;
                this.$modal.show('manage-role')
            },

            hideEditRoleForm() {
                this.editingRole = null;
                this.$modal.hide('manage-role')
            },

            updateRole(role) {
                if (this.roles.filter(singleRole => singleRole.id === role.id).length === 0) {
                    this.roles.push(role);
                } else {
                    this.roles.splice(this.roles.indexOf(this.roles.filter(singleRole => singleRole.id === role.id)[0]), 1, role);
                }
            }
        }
    }
</script>

<style>

</style>
