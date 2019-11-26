<template>
    <div>
        <b-table :fields="fields" :items="items">
            <template v-slot:cell(has_permission)="data">
                <b-form-checkbox
                    :checked="data.item.has_permission"
                    :id="'user:' + data.item.user_id"
                    @input="changePermission($event, data.item.user_id)"
                ></b-form-checkbox>
            </template>
        </b-table>
    </div>
</template>

<script>
    export default {
        name: "AssignPermissions",

        props: {
            permission: {
                required: true,
                type: Object
            }
        },

        created() {
            this.loadUsers();
            this.loadPermissions();
        },

        data() {
            return {
                users: [],
                permissions: [],
                fields: [
                    {key: 'user_id', label: 'User ID'},
                    {key: 'data_provider_id', label: 'User ID (Data Provider)'},
                    {key: 'has_permission', label: 'Has Permission?'}
                ]
            }
        },

        methods: {
            loadPermissions() {
                this.$api.sitepermissions().usersWith(this.permission.ability)
                    .then(response => this.permissions = response.data)
                    .catch(error => this.$notify.alert('Could not load users with permission: ' + error.message));
            },
            loadUsers() {
                this.$control.user().all()
                    .then(response => this.users = response.data)
                    .catch(error => this.$notify.alert('Could not load users'));
            },
            changePermission(status, userId) {
                let request;
                if(status) {
                    request = this.$api.sitepermissions().giveUserPermissionTo(userId, this.permission.ability);
                } else {
                    request = this.$api.sitepermissions().revokeUserFrom(userId, this.permission.ability);
                }
                request
                    .then(response => this.$notify.success('Changed permissions'))
                    .catch(error => this.$notify.alert('Could not change permissions'));
            }
        },

        computed: {
            items() {
                return this.users.map(user => {
                    let permission = this.permissions.filter(permission => permission.model === 'user' && permission.model_id === user.id);
                    let hasPermission = permission.length > 0 && permission[0].result;
                    return {
                        user_id: user.id,
                        data_provider_id: user.data_provider_id,
                        has_permission: hasPermission
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
