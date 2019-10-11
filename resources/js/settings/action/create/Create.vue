<template>
    <div>
        <form-wizard
            @on-complete="saveAndExit"
            subtitle=""
            title="Add an Action">
            <tab-content title="Setup">
                <setup
                    :module-instance="moduleInstance"
                    @action="form.action = $event"
                    @trigger="form.event = $event"
                    @name="form.name = $event"
                    @description="form.description = $event">

                </setup>
            </tab-content>
            <tab-content title="Map Fields">
                <map-fields
                    v-if="this.actionInstance !== null"
                    :action-instance="actionInstance"
                >

                </map-fields>

                <div v-else>
                    Please complete the first section
                </div>
            </tab-content>

        </form-wizard>
    </div>
</template>

<script>
    import Setup from './setup/Setup';
    import MapFields from './mapfields/MapFields';
    import {FormWizard, TabContent} from 'vue-form-wizard';
    import 'vue-form-wizard/dist/vue-form-wizard.min.css';

    export default {
        name: "Create",

        components: {
            Setup, MapFields,
            FormWizard, TabContent
        },

        props: {
            moduleInstance: {
                required: true,
                type: Object
            }
        },

        data() {
            return {
                form: {
                    action: null,
                    event: null,
                    name: '',
                    description: ''
                },
                actionInstance: null
            }
        },

        watch: {
            form: {
                deep: true,
                handler: 'saveActionDebounced'
            }
        },

        methods: {
            saveActionDebounced: _.debounce(function() {
                this.saveAction();
            }, 1000),

            saveAction() {
                if(this.isComplete) {
                    let promise;
                    if(this.actionInstance === null) {
                        promise = this.$api.actionInstance().create(this.processedForm)
                    } else {
                        promise = this.$api.actionInstance().update(this.actionInstance.id, this.processedForm);
                    }
                    promise
                        .then(response => this.actionInstance = response.data)
                        .catch(error => this.$notify.alert('Couldn\'t save your trigger: ' + error.message));
                }
            },

            saveAndExit() {
                this.saveAction();
                this.$notify.success('Action successfully saved');
                window.location.href = '/settings/activity/' + this.moduleInstance.activity_id + '/module_instance/' + this.moduleInstance.id;
            },
        },

        computed: {
            isComplete() {
                return this.form.action !== null
                    && this.form.event !== null
                    && this.form.name !== ''
                    && this.form.description !== '';
            },

            processedForm() {
                let form = this.form;
                form.module_instance_id = this.moduleInstance.id;
                return form;
            }
        }
    }
</script>

<style scoped>

</style>
