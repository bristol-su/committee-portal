<template>
    <div>
        <form-wizard
            title="Create a new module"
            subtitle="">
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
                    :for-logic="forLogic">

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
                    v-model="form.module_instance_permissions"
                    :for-logic="forLogic">

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
            adminLogic: {
                required: true,
                type: String
            }
        },

        data() {
            return {
                form: {
                    alias: '',
                    name: '',
                    description: '',
                    slug: '',
                    module_instance_settings: null,
                    module_instance_permissions: null
                },
                selectedModule: {}
            }
        }
    }
</script>

<style scoped>

</style>
