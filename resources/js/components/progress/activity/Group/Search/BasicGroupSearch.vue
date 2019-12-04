<template>
    <div>
        <b-row>

            <b-col class="my-1" lg="6">
                <b-form-group
                    class="mb-0"
                    label="Group Name"
                    label-align-sm="right"
                    label-cols-sm="3"
                    label-for="groupNameFilter"
                    label-size="sm"
                >
                    <b-input-group size="sm">
                        <b-form-input
                            id="groupNameFilter"
                            placeholder="Type to Search"
                            type="search"
                            v-model="filter.groupName"
                        />
                        <b-input-group-append>
                            <b-button @click="filter.groupName = ''">Clear</b-button>
                        </b-input-group-append>
                    </b-input-group>
                </b-form-group>
            </b-col>

            <b-col class="my-1" lg="6">
                <b-form-group
                    class="mb-0"
                    label="Group Email"
                    label-align-sm="right"
                    label-cols-sm="3"
                    label-for="groupEmailFilter"
                    label-size="sm"
                >
                    <b-input-group size="sm">
                        <b-form-input
                            id="groupEmailFilter"
                            placeholder="Type to Search"
                            type="search"
                            v-model="filter.groupEmail"
                        />
                        <b-input-group-append>
                            <b-button @click="filter.groupEmail = ''">Clear</b-button>
                        </b-input-group-append>
                    </b-input-group>
                </b-form-group>
            </b-col>

            <b-col class="my-1" lg="6">
                <b-form-group
                    class="mb-0"
                    description="Complete Steps"
                    label="Complete"
                    label-align-sm="right"
                    label-cols-sm="3"
                    label-size="sm">
                    <b-form-select :options="moduleInstanceOptions" :select-size="2" multiple
                                   v-model="filter.completed"/>
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
                                   v-model="filter.incomplete"/>
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
                                   v-model="filter.mandatory"/>
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
                                   v-model="filter.optional"/>
                </b-form-group>
            </b-col>

            <b-col class="my-1" lg="6">
                <b-form-group
                    class="mb-0"
                    description="Status of the group in reaffiliation"
                    label="Status"
                    label-align-sm="right"
                    label-cols-sm="3"
                    label-size="sm">
                    <b-form-select :options="filterStatusOptions" :select-size="5" multiple v-model="filter.status"/>
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
                                    v-model="filter.lowerPercentage"
                                />
                                <b-input-group-append>
                                    <b-button @click="filter.lowerPercentage = null">Clear</b-button>
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
                                    v-model="filter.upperPercentage"
                                />
                                <b-input-group-append>
                                    <b-button @click="filter.upperPercentage = null">Clear</b-button>
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
    export default {
        name: "BasicGroupSearch",

        props: {
            activity: {
                required: true,
                type: Object
            }
        },

        data() {
            return {
                filter: {
                    groupName: '',
                    groupEmail: '',
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
            filterGroupName(progress) {
                return progress.participant.name.toUpperCase().indexOf(this.filter.groupName.toUpperCase()) !== -1;
            },

            filterGroupEmail(progress) {
                return progress.participant.email.toUpperCase().indexOf(this.filter.groupEmail.toUpperCase()) !== -1;
            },

            filterStatus(progress) {
                return (this.filter.status.length === 0 ? true :
                    this.filter.status.indexOf(this.calculateStatus(progress)) !== -1);
            },

            filterComplete(progress) {
                if (this.filter.completed.length === 0) {
                    return true;
                }
                let completedModuleInstances = this.calculateComplete(progress);
                return this.filter.completed.filter(moduleInstanceId => {
                    return completedModuleInstances.filter(moduleInstance => moduleInstance.id === moduleInstanceId).length !== 0
                }).length === this.filter.completed.length;
            },

            filterIncomplete(progress) {
                if (this.filter.incomplete.length === 0) {
                    return true;
                }
                let incompletedModuleInstances = this.calculateIncomplete(progress);
                return this.filter.incomplete.filter(moduleInstanceId => {
                    return incompletedModuleInstances.filter(moduleInstance => moduleInstance.id === moduleInstanceId).length !== 0
                }).length === this.filter.incomplete.length;
            },

            filterLowerPercentage(progress) {
                return (this.filter.lowerPercentage === null ? true : this.calculatePercentage(progress) >= this.filter.lowerPercentage);
            },

            filterUpperPercentage(progress) {
                return (this.filter.upperPercentage === null ? true : this.calculatePercentage(progress) <= this.filter.upperPercentage);
            },

            filterMandatory(progress) {
                if (this.filter.mandatory.length === 0) {
                    return true;
                }
                let mandatoryModuleInstances = this.calculateMandatory(progress);
                return this.filter.mandatory.filter(moduleInstanceId => {
                    return mandatoryModuleInstances.filter(moduleInstance => moduleInstance.id === moduleInstanceId).length !== 0
                }).length === this.filter.mandatory.length;
            },

            filterOptional(progress) {
                if (this.filter.optional.length === 0) {
                    return true;
                }
                let optionalModuleInstances = this.calculateOptional(progress);
                return this.filter.optional.filter(moduleInstanceId => {
                    return optionalModuleInstances.filter(moduleInstance => moduleInstance.id === moduleInstanceId).length !== 0
                }).length === this.filter.optional.length;
            },

            calculateMandatory(progressInstance) {
                return progressInstance.module_instances.filter(moduleInstance => moduleInstance.evaluation.mandatory === true);
            },

            calculateOptional(progressInstance) {
                return progressInstance.module_instances.filter(moduleInstance => moduleInstance.evaluation.mandatory === false);
            },

            calculatePercentage(progressInstance) {
                let incompleted = this.calculateIncomplete(progressInstance).length;
                let completed = this.calculateComplete(progressInstance).length;
                if (incompleted + completed === 0) {
                    return 'N/A';
                }
                return Math.round((completed / (incompleted + completed)) * 100);
            },

            calculateComplete(progressInstance) {
                return progressInstance.module_instances.filter(moduleInstance => moduleInstance.evaluation.complete === true);
            },

            calculateIncomplete(progressInstance) {
                return progressInstance.module_instances.filter(moduleInstance => moduleInstance.evaluation.complete === false);
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
