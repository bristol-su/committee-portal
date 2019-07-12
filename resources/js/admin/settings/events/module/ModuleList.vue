<template>
    <b-form-group label="Modules in Event">
        <b-table striped hover :items="modules" :fields="moduleFields">
            <template slot="settings" slot-scope="data">
                <b-button variant="primary" v-b-modal.module-settings-modal @click="moduleInstance = data.item">Settings</b-button>
            </template>
            <template slot="permissions" slot-scope="data">
                <b-button variant="primary" v-b-modal.module-permissions-modal @click="moduleInstance = data.item">Permissions</b-button>
            </template>
        </b-table>

        <b-button v-b-modal.add-module-modal>Add Module</b-button>


        <b-modal id="add-module-modal" title="Add Module to Event" hide-footer>
            <add-module
            :logic="logic"
            :event="event"
            @saved="moduleInstanceAdded"></add-module>
        </b-modal>

        <b-modal id="module-settings-modal" title="Module Specific Settings" hide-footer>
            <module-settings
            :moduleInstance="moduleInstance"
            :settings="moduleInstanceSettings"
            @saved="moduleInstanceSettingsAdded">

            </module-settings>
        </b-modal>

        <b-modal id="module-permissions-modal" title="Module Permissions" hide-footer>
            <module-permissions
                    :moduleInstance="moduleInstance"
                    :permissions="moduleInstancePermissions"
                    @saved="moduleInstancePermissionsAdded"
                    :studentLogic="studentLogic">

            </module-permissions>
        </b-modal>
        
    </b-form-group>
</template>

<script>
    import AddModule from "./AddModule";
    import ModuleSettings from "./ModuleSettings";
    import ModulePermissions from "./ModulePermissions";
    export default {
        name: "ModuleList",
        components: {ModuleSettings, AddModule, ModulePermissions},
        props: {
            groupLogic: {
                required: true,
                type: Array
            },
            studentLogic: {
                required: true,
                type: Array
            },
            event: {
                required: true,
                type: Object
            }
        },

        data() {
            return {
                modules: [],
                moduleInstance: null,
                moduleFields: [
                    'name',
                    'description',
                    'settings',
                    'permissions'
                ]
            }
        },

        created() {
            this.getModuleInstances();
        },

        methods: {
            getModuleInstances() {
                this.$http.get('/admin/settings/events/'+this.event.id+'/moduleinstance')
                    .then(response => this.modules = response.data)
                    .catch(error => this.$notify.alert('There was an error: '+error.message));
            },

            moduleInstanceAdded(moduleInstance) {
                this.$bvModal.hide('add-module-modal');
                this.moduleInstance = moduleInstance;
                this.modules.push(moduleInstance);
            },

            moduleInstanceSettingsAdded(moduleInstanceSettings) {
                this.$bvModal.hide('module-settings-modal');
            },

            moduleInstancePermissionsAdded(moduleInstancePermissions) {
                this.$bvModal.hide('module-permissions-modal');
            }
        },

        computed: {
            moduleOptions() {
                return this.modules.map(module => {
                    return {value: module.id, text: module.name}
                });
            },

            logic() {
                if(this.event.for === 'group') {
                    return this.groupLogic;
                } else if(this.event.for === 'student') {
                    return this.studentLogic;
                }
                return [];
            },

            moduleInstanceSettings() {
                if (this.moduleInstance === null) {
                    return {}
                }
                return this.moduleInstance.module_instance_settings;
            },

            moduleInstancePermissions() {
                if (this.moduleInstance === null) {
                    return {}
                }
                return this.moduleInstance.module_instance_permissions;
            }
        }
    }
</script>

<style scoped>

</style>