<template>
    <div>
        <b-form-group description="Name the trigger/action combo" label="Name">
            <b-input type="text" required :value="name" @input="$emit('name', $event)" class="mb-3"></b-input>
        </b-form-group>
        <b-form-group description="Description for the trigger/action combo" label="Description">
            <b-input type="text" :value="description" @input="$emit('description', $event)" class="mb-3"></b-input>
        </b-form-group>
        <b-form-group description="Choose something to trigger on" label="What should happen in the module...">
            <b-form-select :options="triggerOptions" :value="trigger" @input="$emit('trigger', $event)" class="mb-3">
                <template slot="first">
                    <option :value="null" disabled>-- Please select an option --</option>
                </template>
            </b-form-select>
        </b-form-group>

        <b-form-group description="Choose an action to do" label="...to carry out the action?">
            <b-form-select :options="actionOptions" :value="action" @input="$emit('action', $event)" class="mb-3">
                <template slot="first">
                    <option :value="null" disabled>-- Please select an option --</option>
                </template>
            </b-form-select>
        </b-form-group>
    </div>
</template>

<script>
    export default {
        name: "Setup",

        props: {
            action: {
                required: false,
                default: null
            },
            trigger: {
                required: false,
                default: null
            },
            name: {
                required: false,
                default: ''
            },
            description: {
                required: false,
                default: ''
            },
            moduleInstance: {
                required: true,
                type: Object
            }
        },

        data() {
            return {
                actions: [],
                triggers: []
            }
        },

        created() {
            this.loadTriggers();
            this.loadActions();
        },

        methods: {
            loadTriggers() {
                this.$api.modules().getByAlias(this.moduleInstance.alias)
                    .then(response => this.triggers = response.data.triggers)
                    .catch(error => this.$notify.alert('Could not load available triggers: ' + error.message));
            },

            loadActions() {
                this.$api.action().index()
                    .then(response => this.actions = response.data)
                    .catch(error => this.$notify.alert('Could not load available actions: ' + error.message));
            }
        },

        computed: {
            triggerOptions() {
                return this.triggers.map(trigger => {
                    return {
                        text: trigger.name,
                        value: trigger.event
                    };
                });
            },

            actionOptions() {
                return this.actions.map(action => {
                    return {
                        text: action.name,
                        value: action.class
                    };
                });
            }
        }
    }
</script>

<style scoped>

</style>
