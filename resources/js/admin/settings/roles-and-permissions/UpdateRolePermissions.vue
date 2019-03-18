<template>
    <div>
        <div v-if="role !== null">
            <div style="display: flex; justify-content: space-evenly;">
                <div class="display: inline-block; ">
                    <h2>Managing permissions for role {{role.name}}</h2>
                </div>
                <div class="float: right;">
                    <button @click="cancel" class="btn btn-danger btn-sm">Cancel</button>
                    <button @click="save" class="btn btn-success btn-sm">Save</button>
                </div>
            </div>


            <div>

                <table class="table table-sm table-responsive table-striped table-hover"
                       style="margin: 0px auto; display: table;">
                    <thead>
                    <tr>
                        <th>Permission</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="permission in permissions">

                        <th>
                            <div style="text-align: left;" v-if="permission !== null" class="form-inline">

                                <input :checked="isSelected(permission)" :id="'role-checkbox-' + permission.id"
                                       @change="toggle(permission)" class="form-check-inline" type="checkbox">
                                <label :for="'role-checkbox-'+ permission.id">
                                    {{permission.title}}
                                </label>

                                <div class="help-tip">
                                    <p>{{permission.description}}</p>
                                </div>
                            </div>
                        </th>

                    </tr>
                    </tbody>
                </table>
            </div>


        </div>
        <div v-else>
            <h2>No role selected.</h2>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            role: {
                required: true,
                default: null,
                type: Object
            }
        },

        data() {
            return {
                permissions: [],
                selected: []
            }
        },

        created() {
            this.$http.get('/admin/settings/permissions/get')
                .then(response => this.permissions = response.data)
                .catch(error => this.$notify.warning('Something went wrong gathering the available permissions. ' + error.message));
            this.selected = this.role.permissions;
        },

        methods: {

            isSelected(permission) {
                return this.selected.filter(selectedPermission => selectedPermission.id === permission.id).length === 1;
            },

            getSelectedIndex(permission) {
                return this.selected.indexOf(this.selected.filter(selectedPermission => selectedPermission.id === permission.id)[0])
            },

            toggle(permission) {
                if (!this.isSelected(permission)) {
                    this.selected.push(permission);
                } else {
                    this.selected.splice(this.getSelectedIndex(permission), 1);
                }
            },

            cancel() {
                if (confirm('Are you sure you wish to cancel? You will lose any unsaved changes.')) {
                    this.$emit('close');
                }
            },

            save() {
                let permissions = this.selected.map(permission => permission.id);
                this.$http.post('/admin/settings/roles-permissions/update/' + this.role.id, {
                    permissions: permissions,
                })
                    .then(response => {
                        this.$notify.success('Permissions updated!');
                        this.$emit('close');
                    })
                    .catch(error => this.$notify.alert('Permissions could not be updated: ' + error.message));
            }


        },

    }
</script>

<style>

</style>