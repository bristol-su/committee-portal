<template>
    <div>
        <div style="text-align: left">

            <b-form @submit.prevent="onSubmit">
                <b-form-group
                        description="Choose the type of module you want to add."
                        id="modules-label"
                        label="Module"
                        label-for="modules"
                >
                    <b-form-select id="modules" v-model="form.alias" :options="modules"></b-form-select>
                </b-form-group>

                <b-form-group
                    description="Name of the module (this will appear on the button)"
                    id="name-label"
                    label="Name"
                    label-for="name"
                    >
                    <b-form-input type="text" name="name" v-model="form.name">

                    </b-form-input>
                </b-form-group>

                <b-form-group
                        description="Description of the module"
                        id="description-label"
                        label="Description"
                        label-for="description"
                >
                    <b-form-input type="text" name="description" v-model="form.description">

                    </b-form-input>
                </b-form-group>

                <b-card bg-variant="light">
                    <b-form-group
                            label-cols-lg="3"
                            label="Behaviour"
                            label-size="lg"
                            label-class="font-weight-bold pt-0"
                            class="mb-0"
                    >
                        <b-form-group
                                label-cols-sm="3"
                                label="Active for"
                                label-align-sm="right"
                                label-for="active"
                        >
                            <b-form-select v-model="form.active" :options="logicOptions" name="active" id="active"></b-form-select>
                        </b-form-group>

                        <b-form-group
                                label-cols-sm="3"
                                label="Visible to"
                                label-align-sm="right"
                                label-for="visible"
                        >
                            <b-form-select v-model="form.visible" :options="logicOptions" name="visible" id="visible"></b-form-select>
                        </b-form-group>


                        <b-form-group
                                label-cols-sm="3"
                                label="Mandatory for"
                                label-align-sm="right"
                                label-for="mandatory"
                        >
                            <b-form-select v-model="form.mandatory" :options="logicOptions" name="mandatory" id="mandatory"></b-form-select>
                        </b-form-group>

                        <b-form-group
                                label-cols-sm="3"
                                label="Complete when"
                                label-align-sm="right"
                                label-for="complete"
                        >
                            <b-form-select v-model="form.complete" :options="completeOptions" name="complete" id="complete"></b-form-select>
                        </b-form-group>


                    </b-form-group>
                </b-card>

                <div style="text-align: right;">
                    <b-button type="submit" variant="primary">Next Step</b-button>
                </div>
            </b-form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AddModule",

        props: {
            logic: {
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
                form: {
                    alias: null,
                    name: '',
                    description: '',
                    active: null,
                    visible: null,
                    mandatory: null,
                    complete: null,
                    event_id: this.event.id
                }
            }
        },

        created() {
            this.loadModules();
        },

        methods: {
            loadModules() {
                this.$http.get('/admin/settings/modules')
                    .then(response => this.modules = response.data)
                    .catch(error => this.$notify.alert('There was an error loading modules: '+error.message));
            },

            onSubmit() {
                this.$http.post('/admin/settings/moduleinstance', this.form)
                    .then(response => {
                        this.$notify.success('Module Saved');
                        this.$emit('saved', response.data);
                    })
                    .catch(error => this.$notify.alert('There was an error: ' + error.message));
            }
        },

        computed: {
            completeOptions() {
                if(this.form.alias === null) {
                    return [];
                }
                return this.modules[this.form.alias]['completion'].map(completion => {
                    return {
                        text: completion.name + ' (' + completion.description + ')',
                        value: completion.event
                    }
                });
            },

            logicOptions() {
                return this.logic.map(logic => {
                    return {
                        value: logic.id,
                        text: logic.name
                    };
                })
            }
        }
    }
</script>

<style scoped>

</style>