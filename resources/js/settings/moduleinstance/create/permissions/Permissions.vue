<template>
    <div>
        <div class="panel-body" v-if="!loading">
            <h4>Participant Permissions</h4>
            <permission-logic-select
                v-for="permission in participantPermissions"
                :key="permission.ability"
                :permission="permission"
                :logic="logic"
                :module-instance-id="moduleInstance.id"
                :assigned-permissions="moduleInstancePermissions"></permission-logic-select>

            <br/><hr/><br/>
            <h4>Admin Permissions</h4>

            <permission-logic-select
                    v-for="permission in adminPermissions"
                    :key="permission.ability"
                    :permission="permission"
                    :logic="logic"
                    :module-instance-id="moduleInstance.id"
                    :assigned-permissions="moduleInstancePermissions"></permission-logic-select>
        </div>
    </div>
</template>

<script>
    import PermissionLogicSelect from "./PermissionLogicSelect";
    export default {
        name: "ModulePermissions",
        components: {PermissionLogicSelect},
        props: {
            moduleInstance: {
                required: true,
                type: Object
            }
        },

        data() {
            return {
                permissions: [],
                moduleInstancePermissions: [],
                logic: [],
                permissionsLoading: false,
                moduleInstancePermissionsLoading: false,
                logicLoading: false
            }
        },

        created() {
            this.loadPermissions();
            this.loadLogic();
        },

        methods: {
            loadPermissions() {
                this.permissionsLoading = true;
                this.$api.modules().getByAlias(this.moduleInstance.alias)
                    .then(response => {
                        this.permissions = response.data.permissions;
                        this.moduleInstancePermissionsLoading = true;
                        this.permissionsLoading = false;
                        this.loadModuleInstancePermissions();
                    })
                    .catch(error => this.$notify.alert('Could not load permissions: ' + error.message));
            },
            loadModuleInstancePermissions() {
                this.$api.moduleInstancePermissions().forModuleInstance(this.moduleInstance.id)
                    .then(response => {
                        this.moduleInstancePermissions = response.data;
                        // this.moduleInstancePermissions.forEach(permission => this.$set(this.model, permission.key, permission.value));
                    })
                    .catch(error => this.$notify.alert('Could not load module permissions: ' + error.message))
                    .then(() => this.moduleInstancePermissionsLoading = false);
            },
            loadLogic() {
                this.logicLoading = true;
                this.$api.logic().all()
                    .then(response => this.logic = response.data)
                    .catch(error => this.$notify('Could not load logic groups'))
                    .then(() => this.logicLoading = false);
            }
        },

        computed: {
            loading() {
                return this.permissionsLoading || this.moduleInstancePermissionsLoading;
            },
            participantPermissions() {
                return this.permissions.filter(permission => permission.module_type === 'participant')
            },
            adminPermissions() {
                return this.permissions.filter(permission => permission.module_type === 'administrator')
            }
        }
    }
</script>

<style scoped>

</style>
