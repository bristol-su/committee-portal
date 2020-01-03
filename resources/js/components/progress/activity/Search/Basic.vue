<template>
    <div>
        <b-row>

            <slot name="fields"></slot>

            <b-col class="my-1" lg="6">
                <b-form-group
                    class="mb-0"
                    description="Complete Steps"
                    label="Complete"
                    label-align-sm="right"
                    label-cols-sm="3"
                    label-size="sm">
                    <b-form-select :options="moduleInstanceOptions" :select-size="2" multiple
                                   v-model="filters.completed"/>
                </b-form-group>
            </b-col>

            <b-col class="my-1" lg="6">
                <b-form-group
                    class="mb-0"
                    description="Incomplete Steps"
                    label="Incomplete"
                    label-align-sm="right"
                    label-cols-sm="3"
                    label-size="sm">
                    <b-form-select :options="moduleInstanceOptions" :select-size="2" multiple
                                   v-model="filters.incomplete"/>
                </b-form-group>
            </b-col>

            <b-col class="my-1" lg="6">
                <b-form-group
                    class="mb-0"
                    description="The selected steps must be mandatory"
                    label="Mandatory"
                    label-align-sm="right"
                    label-cols-sm="3"
                    label-size="sm">
                    <b-form-select :options="moduleInstanceOptions" :select-size="2" multiple
                                   v-model="filters.mandatory"/>
                </b-form-group>
            </b-col>

            <b-col class="my-1" lg="6">
                <b-form-group
                    class="mb-0"
                    description="The selected steps must be optional"
                    label="Optional"
                    label-align-sm="right"
                    label-cols-sm="3"
                    label-size="sm">
                    <b-form-select :options="moduleInstanceOptions" :select-size="2" multiple
                                   v-model="filters.optional"/>
                </b-form-group>
            </b-col>

            <b-col class="my-1" lg="6">
                <b-form-group
                    class="mb-0"
                    description="Status"
                    label="Status"
                    label-align-sm="right"
                    label-cols-sm="3"
                    label-size="sm">
                    <b-form-select :options="filterStatusOptions" :select-size="5" multiple v-model="filters.status"/>
                </b-form-group>
            </b-col>

            <b-col class="my-1" lg="6">
                <b-row>
                    <b-col>
                        <b-form-group
                            class="mb-0"
                            label="Percentage not below"
                            label-align-sm="right"
                            label-cols-sm="3"
                            label-for="lowerPercentageFilter"
                            label-size="sm"
                        >
                            <b-input-group size="sm">
                                <b-form-input
                                    id="lowerPercentageFilter"
                                    placeholder="0%"
                                    type="number"
                                    v-model="filters.lowerPercentage"
                                />
                                <b-input-group-append>
                                    <b-button @click="filters.lowerPercentage = null">Clear</b-button>
                                </b-input-group-append>
                            </b-input-group>
                        </b-form-group>
                    </b-col>
                    <b-col>
                        <b-form-group
                            class="mb-0"
                            label="Percentage not above"
                            label-align-sm="right"
                            label-cols-sm="3"
                            label-for="upperPercentageFilter"
                            label-size="sm"
                        >
                            <b-input-group size="sm">
                                <b-form-input
                                    id="upperPercentageFilter"
                                    placeholder="100%"
                                    type="number"
                                    v-model="filters.upperPercentage"
                                />
                                <b-input-group-append>
                                    <b-button @click="filters.upperPercentage = null">Clear</b-button>
                                </b-input-group-append>
                            </b-input-group>
                        </b-form-group>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col>
                    </b-col>
                </b-row>
            </b-col>

        </b-row>
    </div>
</template>

<script>
    import progressFunctions from '../progressFunctions';

    export default {
        name: "Basic",

        mixins: [
            progressFunctions
        ],

        props: {
            activity: {
                required: true,
                type: Object
            }
        },

        data() {
            return {
                filters: {
                    completed: [],
                    incomplete: [],
                    mandatory: [],
                    optional: [],
                    status: [],
                    lowerPercentage: 0,
                    upperPercentage: 100
                },
                filterStatusOptions: [
                    {value: 'Finished', text: 'Finished'},
                    {value: 'Not started', text: 'Not started'},
                    {value: 'In progress', text: 'In progress'},
                    {value: 'N/A', text: 'N/A'}
                ]
            }
        },

        watch: {
            filter: {
                handler: function (val) {
                    this.$emit('refresh');
                },
                deep: true
            }
        },

        methods: {
            filter(progress) {
                return this.filterStatus(progress) &&
                    this.filterComplete(progress) &&
                    this.filterIncomplete(progress) &&
                    this.filterLowerPercentage(progress) &&
                    this.filterUpperPercentage(progress) &&
                    this.filterMandatory(progress) &&
                    this.filterOptional(progress)
            },

            filterStatus(progress) {
                return (this.filters.status.length === 0 ? true :
                    this.filters.status.indexOf(this.calculateStatus(progress)) !== -1);
            },

            filterComplete(progress) {
                if (this.filters.completed.length === 0) {
                    return true;
                }
                let completedModuleInstances = this.calculateComplete(progress);
                return this.filters.completed.filter(moduleInstanceId => {
                    return completedModuleInstances.filter(moduleInstance => moduleInstance.id === moduleInstanceId).length !== 0
                }).length === this.filters.completed.length;
            },

            filterIncomplete(progress) {
                if (this.filters.incomplete.length === 0) {
                    return true;
                }
                let incompletedModuleInstances = this.calculateIncomplete(progress);
                return this.filters.incomplete.filter(moduleInstanceId => {
                    return incompletedModuleInstances.filter(moduleInstance => moduleInstance.id === moduleInstanceId).length !== 0
                }).length === this.filters.incomplete.length;
            },

            filterLowerPercentage(progress) {
                return (this.filters.lowerPercentage === null ? true : this.calculatePercentage(progress) >= this.filters.lowerPercentage);
            },

            filterUpperPercentage(progress) {
                return (this.filters.upperPercentage === null ? true : this.calculatePercentage(progress) <= this.filters.upperPercentage);
            },

            filterMandatory(progress) {
                if (this.filters.mandatory.length === 0) {
                    return true;
                }
                let mandatoryModuleInstances = this.calculateMandatory(progress);
                return this.filters.mandatory.filter(moduleInstanceId => {
                    return mandatoryModuleInstances.filter(moduleInstance => moduleInstance.id === moduleInstanceId).length !== 0
                }).length === this.filters.mandatory.length;
            },

            filterOptional(progress) {
                if (this.filters.optional.length === 0) {
                    return true;
                }
                let optionalModuleInstances = this.calculateOptional(progress);
                return this.filters.optional.filter(moduleInstanceId => {
                    return optionalModuleInstances.filter(moduleInstance => moduleInstance.id === moduleInstanceId).length !== 0
                }).length === this.filters.optional.length;
            },

        },

        computed: {
            moduleInstanceOptions() {
                return this.activity.module_instances.map(moduleInstance => {
                    return {value: moduleInstance.id, text: moduleInstance.name}
                });
            }
        }
    }
</script>

<style scoped>

</style>
