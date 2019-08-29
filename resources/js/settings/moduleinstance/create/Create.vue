<template>
    <div>
        <form-wizard
            title="Create a new module"
            subtitle=""
            @on-complete="saveActivity">
            <tab-content title="Module Type">
                <module-type v-model="form.alias" @module="selectedModule = $event">

                </module-type>
            </tab-content>
            <tab-content title="Module Information">
                <module-information
                    @name="form.name = $event"
                    @description="form.description = $event"
                    @slug="form.slug = $event">

                </module-information>
            </tab-content>
            <tab-content title="Behaviour">
                <behaviour
                    :for-logic="forLogic"
                    @update="updateBehaviour">

                </behaviour>
            </tab-content>
            <tab-content title="Settings">
                <settings
                    :settings="selectedModule.settings"
                    v-model="form.module_instance_settings">

                </settings>
            </tab-content>
            <tab-content title="Permissions">
                <permissions
                    :permissions="selectedModule.permissions"
                    v-model="form.module_instance_permissions">

                </permissions>
            </tab-content>
        </form-wizard>
    </div>
</template>

<script>
    import {FormWizard, TabContent} from 'vue-form-wizard'
    import 'vue-form-wizard/dist/vue-form-wizard.min.css'
    import ModuleInformation from "./module-information/ModuleInformation";
    import Settings from "./settings/Settings";
    import Permissions from "./permissions/Permissions";
    import Behaviour from "./behaviour/Behaviour";
    import ModuleType from "./type/ModuleType";

    export default {
        name: "Create",

        components: {
            ModuleType,
            Behaviour,
            Permissions,
            Settings,
            ModuleInformation,
            FormWizard, TabContent
        },

        props: {
            forLogic: {
                required: true,
                type: String
            },
            activityId: {
                required: true,
                type: Number
            }
        },

        data() {
            return {
                form: {
                    alias: '',
                    name: '',
                    description: '',
                    slug: '',
                    active: null,
                    visible: null,
                    mandatory: null,
                    complete: '',
                    module_instance_settings: null,
                    module_instance_permissions: null
                },
                selectedModule: {}
            }
        },

        methods: {
            updateBehaviour(type, value) {
                this.form[type] = value;
            },

            saveActivity() {
                this.$api.moduleInstances().create({
                    'alias': this.form.alias,
                    'activity_id': this.activityId,
                    'name': this.form.name,
                    'description': this.form.description,
                    'slug': this.form.slug,
                    'active': this.form.active,
                    'visible':  this.form.visible,
                    'mandatory': this.form.mandatory,
                    'complete': this.form.complete,
                    'module_instance_settings_id': this.form.module_instance_settings,
                    'module_instance_permissions_id': this.form.module_instance_permissions
                })
                    .then(response => console.log(response))
                    .catch(error => this.$notify.alert('Something went wrong: ' + error.message));

            }
        }
    }
</script>

<style scoped>

</style>
