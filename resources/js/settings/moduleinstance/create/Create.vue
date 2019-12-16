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
                    :completion-conditions="selectedModule.completionConditions"
                    :for-logic="forLogic"
                    :activity="activity"
                    @update="updateBehaviour"
                    @createModuleInstance="createModuleInstance"
                >
                </behaviour>
            </tab-content>


            <tab-content title="Services" v-if="hasModuleInstance">
                <services :module-instance="moduleInstance"></services>
            </tab-content>
            <tab-content title="Settings" v-if="hasModuleInstance">
                <settings :module-instance="moduleInstance"></settings>
            </tab-content>
            <tab-content title="Permissions" v-if="hasModuleInstance">
                <permissions :module-instance="moduleInstance"></permissions>
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
    import Services from './services/Services';

    export default {
        name: "Create",

        components: {
            Services,
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
            activity: {
                required: true,
                type: Object
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
                    completion_condition_instance_id: null
                },
                moduleInstance: null,
                selectedModule: {}
            }
        },

        methods: {
            updateBehaviour(type, value) {
                this.form[type] = value;
            },

            createModuleInstance() {
                this.$api.moduleInstances().create({
                    'alias': this.form.alias,
                    'activity_id': this.activity.id,
                    'name': this.form.name,
                    'description': this.form.description,
                    'slug': this.form.slug,
                    'active': this.form.active,
                    'visible':  this.form.visible,
                    'mandatory': this.form.mandatory,
                    'completion_condition_instance_id': this.form.completion_condition_instance_id
                })
                    .then(response => {
                        this.$notify.success('Module Instance ' + this.form.name + ' created!');
                        this.moduleInstance = response.data;
                    })
                    .catch(error => this.$notify.alert('Something went wrong: ' + error.message));

            },

        },

        computed: {
            hasModuleInstance() {
                return this.moduleInstance !== null;
            },
        }
    }
</script>

<style scoped>

</style>
