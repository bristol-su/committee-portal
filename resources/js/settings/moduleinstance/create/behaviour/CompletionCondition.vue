<template>
    <div style="border-style: solid">
        <b-form-select :options="completionConditionsOptions" class="mb-3" v-model="alias">
            <!-- This slot appears above the options from 'options' prop -->
            <template v-slot:cell(first)="data">
                <option :value="null" disabled>-- Please select an option --</option>
            </template>
        </b-form-select>

        <div v-if="conditionSelected">
            <b-input type="text" v-model="name" placeholder="Name of the condition"></b-input>
            <b-input type="text" v-model="description" placeholder="Desription of the condition"></b-input>
            <b-form-group
                :key="key"
                :label="key"
                :label-for="key"
                v-for="key in selectedConditionOptionKeys">
                    <span
                        v-if="selectedCondition.options[key] && typeof selectedCondition.options[key] === 'object' && selectedCondition.options[key].constructor === Object">
                        <b-form-select
                            :id="key"
                            :options="selectedCondition.options[key]"
                            v-model="settings[key]">

                        </b-form-select>
                    </span>
                <span v-else-if="typeof selectedCondition.options[key] === 'string'">
                        <b-form-input
                            type="text"
                            v-model="settings[key]">

                        </b-form-input>
                    </span>

                <span v-else-if="typeof selectedCondition.options[key] === 'number'">
                        <b-form-input
                            type="number"
                            v-model="settings[key]">

                        </b-form-input>
                    </span>

            </b-form-group>

            <div style="text-align: right;">

                <b-button @click="saveConditions" v-if="allOptionsFilled">Save Conditions</b-button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CompletionCondition",

        props: {
            completionConditions: {
                type: Array,
                default: function () {
                    return [];
                }
            }
        },

        data() {
            return {
                alias: null,
                settings: {},
                name: '',
                description: ''
            }
        },

        methods: {
            saveConditions() {
                this.$api.completionConditions().create({
                    name: this.name,
                    alias: this.alias,
                    settings: this.settings,
                    description: this.description
                })
                    .then(response => {
                        this.$notify.success('Completion conditions saved');
                        this.$emit('input', response.data.id)
                    })
                    .catch(error => this.$notify.alert('Could not save completion conditions: ' + error.message));
            }
        },

        computed: {
            completionConditionsOptions() {
                return this.completionConditions.map(condition => {
                    return {
                        value: condition.alias,
                        text: condition.name
                    }
                });
            },
            conditionSelected() {
                return this.alias !== null;
            },

            selectedCondition() {
                if (this.conditionSelected) {
                    return this.completionConditions.filter(condition => {
                        return condition.alias === this.alias;
                    })[0];
                }
                return null;
            },

            selectedConditionOptionKeys() {
                return Object.keys(this.selectedCondition.options);
            },

            allOptionsFilled() {
                return this.selectedConditionOptionKeys.filter(key => {
                    return this.settings[key] === undefined
                        || this.settings[key] === ''
                        || this.settings[key] === null;
                }).length === 0;
            }
        }
    }
</script>

<style scoped>

</style>
