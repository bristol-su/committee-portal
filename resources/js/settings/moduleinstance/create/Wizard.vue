<template>
    <div>
        <form-wizard
            title="Create a new module"
            subtitle="">
            <tab-content title="Module Type">
                <module-type>

                </module-type>
            </tab-content>
            <tab-content title="Module Information">
                <module-information>

                </module-information>
            </tab-content>
            <tab-content title="Behaviour">
                <behaviour>

                </behaviour>
            </tab-content>
            <tab-content title="Settings">
                <settings>

                </settings>
            </tab-content>
            <tab-content title="Permissions">
                <permissions>

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
        name: "Wizard",

        components: {
            ModuleType,
            Behaviour,
            Permissions,
            Settings,
            ModuleInformation,
            FormWizard, TabContent
        }
    }
</script>

<style scoped>

</style>
