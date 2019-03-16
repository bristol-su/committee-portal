<template>
    <div style="text-align: center;">
        <div v-if="user !== null">

            <h2>Managing permissions for {{user.forename}}</h2>

            <div>

                <table class="table table-sm table-responsive table-striped">
                    <thead>
                    <tr>
                        <th>Roles</th>
                        <th>Permissions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="combined in combinedRolesAndPermissions">
                        <th>
                            <div v-if="combined.role !== null">

                                <input :id="'role-checkbox-' + combined.role.id" class="form-check-inline"
                                       type="checkbox">
                                <label :for="'role-checkbox-'+ combined.role.id">
                                    {{combined.role.name}}
                                </label>
                            </div>
                        </th>

                        <th>
                            <div v-if="combined.permission !== null">

                                <input :id="'role-checkbox-' + combined.permission.id" class="form-check-inline"
                                       type="checkbox">
                                <label :for="'role-checkbox-'+ combined.permission.id">
                                    {{combined.permission.name}}
                                </label>
                            </div>
                        </th>

                    </tr>
                    </tbody>
                </table>

                <table class="table" style="display: inline-block;">
                    <thead>
                    <tr>
                        <th>Permissions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="permission in permissions">
                        <th>{{permission.name}}</th>
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