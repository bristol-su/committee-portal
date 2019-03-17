<template>
    <div>
        <div v-if="user !== null">
            <div style="display: flex; justify-content: space-evenly;">
                <div class="display: inline-block; ">
                    <h2>Managing permissions for {{user.forename}}</h2>
                </div>
                <div class="float: right;">
                    <button class="btn btn-danger btn-sm" @click="cancel">Cancel</button>
                    <button class="btn btn-success btn-sm" @click="save">Save</button>
                </div>
            </div>


            <div>

                <table class="table table-sm table-responsive table-striped table-hover"
                       style="margin: 0px auto; display: table;">
                    <thead>
                    <tr>
                        <th>Roles</th>
                        <th>Permissions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="combined in combinedRolesAndPermissions">
                        <th style="border-right: 1px dotted black">
                            <div style="text-align: left;" v-if="combined.role !== null">

                                <input :id="'role-checkbox-' + combined.role.id" class="form-check-inline"
                                       type="checkbox" :checked="isRoleSelected(combined.role)"  @change="toggleRole(combined.role)">
                                <label :for="'role-checkbox-'+ combined.role.id">
                                    {{combined.role.name}}
                                </label>
                            </div>
                        </th>

                        <th>
                            <div style="text-align: left;" v-if="combined.permission !== null">

                                <input :id="'role-checkbox-' + combined.permission.id" class="form-check-inline"
                                       type="checkbox" :checked="isPermissionSelected(combined.permission)" @change="togglePermission(combined.permission)">
                                <label :for="'role-checkbox-'+ combined.permission.id">
                                    {{combined.permission.name}}
                                </label>
                            </div>
                        </th>

                    </tr>
                    </tbody>
                </table>
            </div>


        </div>
        <div v-else>
            <h2>No user selected.</h2>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            user: {
                required: true,
                default: null,
                type: Object
            }
        },

        data() {
            return {
                roles: [],
                permissions: [],
                selectedRoles: [],
                selectedPermissions: []
            }
        },

        created() {
            this.$http.get('/admin/settings/permissions/get')
                .then(response => this.permissions = response.data)
                .catch(error => this.$notify.warning('Something went wrong gathering the available permissions.'));
            this.$http.get('/admin/settings/roles/get')
                .then(response => this.roles = response.data)
                .catch(error => this.$notify.warning('Something went wrong gathering the available roles.'));
            this.selectedRoles = this.user.roles;
            this.selectedPermissions = this.user.permissions;
            this.user.roles.forEach(role => {
                role.permissions.forEach(permission => {
                    if(!this.isPermissionSelected(permission)) {
                        this.selectedPermissions.push(permission);
                    }
                });
            });
        },

        methods: {
            isRoleSelected(role) {
                return this.selectedRoles.filter(selectedRole => selectedRole.id === role.id).length === 1;
            },

            isPermissionSelected(permission) {
                return this.selectedPermissions.filter(selectedPermission => selectedPermission.id === permission.id).length === 1;
            },

            getSelectedIndexOfRole(role) {
                return this.selectedRoles.indexOf(this.selectedRoles.filter(selectedRole => selectedRole.id === role.id)[0])
            },

            getSelectedIndexOfPermission(permission) {
                return this.selectedPermissions.indexOf(this.selectedPermissions.filter(selectedPermission => selectedPermission.id === permission.id)[0])
            },

            toggleRole(role) {
                if(!this.isRoleSelected(role)) {
                    this.selectedRoles.push(role);
                    this.addPermissionsDueToRole(role);
                } else {
                    this.selectedRoles.splice(this.getSelectedIndexOfRole(role), 1);
                    this.removePermissionsDueToRole(role);
                }
            },

            togglePermission(permission) {
                if(!this.isPermissionSelected(permission)) {
                    this.selectedPermissions.push(permission);
                } else {
                    this.selectedPermissions.splice(this.getSelectedIndexOfPermission(permission), 1);
                }
            },

            addPermissionsDueToRole(role) {
                role.permissions.forEach(permission => {
                    if(!this.isPermissionSelected(permission)) {
                        this.selectedPermissions.push(permission);
                    }
                });
            },

            removePermissionsDueToRole(role) {
                role.permissions.forEach(permission => {
                    if(this.isPermissionSelected(permission)) {
                        if(this.selectedRoles.filter(role => {
                            return role.permissions.filter(rolePermission => rolePermission.id === permission.id).length === 1;
                        }).length === 0) {
                            // No other applied roles own the permission
                            this.selectedPermissions.splice(this.getSelectedIndexOfPermission(permission), 1);
                        }
                    }
                });
            },

            cancel() {
                if(confirm('Are you sure you wish to cancel? You will lose any unsaved changes.')) {
                    this.$emit('close');
                }
            },

            save() {
                let permissions = this.selectedPermissions.map(permission => permission.id );
                let roles = this.selectedRoles.map(role => role.id);
                this.$http.post('/admin/settings/permissions/update/'+this.user.id, {
                    permissions: permissions,
                    roles: roles
                })
                    .then(response => this.$notify.success('Permissions updated!'))
                    .catch(error => this.$notify.alert('Permissions could not be updated: ' + error.message));
            }


        },

        computed: {
            combinedRolesAndPermissions() {
                let permissions = this.permissions;
                let roles = this.roles;

                return [...Array(Math.max(this.permissions.length, this.roles.length))].map(function (value, index) {
                    return {
                        permission: (permissions[index] === undefined ? null : permissions[index]),
                        role: (roles[index] === undefined ? null : roles[index]),
                    };
                })
            }
        }
    }
</script>

<style>

</style>