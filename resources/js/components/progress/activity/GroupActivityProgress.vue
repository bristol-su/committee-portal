<template>
    <div>
        <b-row>

            <b-col lg="6" class="my-1">
                <b-form-group
                    label="Group Name"
                    label-cols-sm="3"
                    label-align-sm="right"
                    label-size="sm"
                    label-for="groupNameFilter"
                    class="mb-0"
                >
                    <b-input-group size="sm">
                        <b-form-input
                            v-model="filter.groupName"
                            type="search"
                            id="groupNameFilter"
                            placeholder="Type to Search"
                        />
                        <b-input-group-append>
                            <b-button @click="filter.groupName = ''">Clear</b-button>
                        </b-input-group-append>
                    </b-input-group>
                </b-form-group>
            </b-col>

            <b-col lg="6" class="my-1">
                <b-form-group
                    label="Group Email"
                    label-cols-sm="3"
                    label-align-sm="right"
                    label-size="sm"
                    label-for="groupEmailFilter"
                    class="mb-0"
                >
                    <b-input-group size="sm">
                        <b-form-input
                            v-model="filter.groupEmail"
                            type="search"
                            id="groupEmailFilter"
                            placeholder="Type to Search"
                        />
                        <b-input-group-append>
                            <b-button @click="filter.groupEmail = ''">Clear</b-button>
                        </b-input-group-append>
                    </b-input-group>
                </b-form-group>
            </b-col>

            <b-col lg="6" class="my-1">
                <b-form-group
                    label="Complete"
                    label-cols-sm="3"
                    label-align-sm="right"
                    label-size="sm"
                    description="Complete Steps"
                    class="mb-0">
                    <b-form-select v-model="filter.completed" :options="moduleInstanceOptions" multiple
                                   :select-size="2"/>
                </b-form-group>
            </b-col>

            <b-col lg="6" class="my-1">
                <b-form-group
                    label="Incomplete"
                    label-cols-sm="3"
                    label-align-sm="right"
                    label-size="sm"
                    description="Incomplete Steps"
                    class="mb-0">
                    <b-form-select v-model="filter.incomplete" :options="moduleInstanceOptions" multiple
                                   :select-size="2"/>
                </b-form-group>
            </b-col>

            <b-col lg="6" class="my-1">
                <b-form-group
                    label="Status"
                    label-cols-sm="3"
                    label-align-sm="right"
                    label-size="sm"
                    description="Status of the group in reaffiliation"
                    class="mb-0">
                    <b-form-select v-model="filter.status" :options="filterStatusOptions" multiple :select-size="5"/>
                </b-form-group>
            </b-col>

            <b-col lg="3" class="my-1">
                <b-form-group
                    label="Percentage not below"
                    label-cols-sm="3"
                    label-align-sm="right"
                    label-size="sm"
                    label-for="lowerPercentageFilter"
                    class="mb-0"
                >
                    <b-input-group size="sm">
                        <b-form-input
                            v-model="filter.lowerPercentage"
                            type="number"
                            id="lowerPercentageFilter"
                            placeholder="0%"
                        />
                        <b-input-group-append>
                            <b-button @click="filter.lowerPercentage = null">Clear</b-button>
                        </b-input-group-append>
                    </b-input-group>
                </b-form-group>
            </b-col>

            <b-col lg="3" class="my-1">
                <b-form-group
                    label="Percentage not above"
                    label-cols-sm="3"
                    label-align-sm="right"
                    label-size="sm"
                    label-for="upperPercentageFilter"
                    class="mb-0"
                >
                    <b-input-group size="sm">
                        <b-form-input
                            v-model="filter.upperPercentage"
                            type="number"
                            id="upperPercentageFilter"
                            placeholder="100%"
                        />
                        <b-input-group-append>
                            <b-button @click="filter.upperPercentage = null">Clear</b-button>
                        </b-input-group-append>
                    </b-input-group>
                </b-form-group>
            </b-col>
        </b-row>



        <b-table :items="items" :fields="fields" :busy="loading">
            <template v-slot:table-busy>
                <div class="text-center text-danger my-2">
                    <b-spinner class="align-middle"/>
                    <strong>Loading...</strong>
                </div>
            </template>
            <template v-slot:cell(group_id)="data">
                {{data.item.participant.id}}
            </template>
            <template v-slot:cell(group_name)="data">
                {{data.item.participant.name}}
            </template>
            <template v-slot:cell(group_email)="data">
                {{data.item.participant.email}}
            </template>
            <template v-slot:cell(complete_module_instances)="data">
                <span v-html="calculateCompleteText(data.item)"/>
            </template>
            <template v-slot:cell(incomplete_module_instances)="data">
                <span v-html="calculateIncompleteText(data.item)"/>
            </template>
            <template v-slot:cell(status)="data">
                <span v-html="calculateStatus(data.item)"/>
            </template>
            <template v-slot:cell(percentage)="data">
                {{calculatePercentage(data.item)}}%
            </template>

        </b-table>
    </div>
</template>

<script>
    import Status from './Status';
    export default {
        name: "GroupActivityProgress",
        components: {Status},
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
                    status: [],
                    lowerPercentage: 0,
                    upperPercentage: 100
                },
                progress: [],
                fields: [
                    {key: 'group_id', label: 'Group ID', sortable: true},
                    {key: 'group_name', label: 'Name', sortable: true},
                    {key: 'group_email', label: 'Group Email', sortable: true},
                    {key: 'complete_module_instances', label: 'Completed'},
                    {key: 'incomplete_module_instances', 'label': 'Incomplete'},
                    {key: 'status', label: 'Status'},
                    {key: 'percentage', label: 'Percentage'}
                ],
                loading: true,
                filterStatusOptions: [
                    {value: 'Finished', text: 'Finished'},
                    {value: 'No steps to complete have yet been defined', text: 'No steps to complete have yet been defined'},
                    {value: 'Not started', text: 'Not started'},
                    {value: 'In progress', text: 'In progress'},
                    {value: 'N/A', text: 'N/A'}
                ]
            }
        },

        created() {
            this.loadProgress();
        },

        methods: {
            loadProgress() {
                this.loading = true;
                this.$api.activity().progress(this.activity.id)
                    .then(response => this.progress = response.data)
                    .catch(error => this.$notify.alert('Could not load activity progress: ' + error.message))
                    .then(() => this.loading = false);
            },

            calculateStatus(progressInstance) {
                let incompleted = this.calculateIncomplete(progressInstance).length;
                let completed = this.calculateComplete(progressInstance).length;
                if(incompleted === 0 && completed > 0) {
                    return 'Finished';
                } else if(incompleted === 0 && completed === 0) {
                    return 'No steps to complete have yet been defined';
                } else if(incompleted > 0 && completed === 0) {
                    return 'Not started';
                } else if (incompleted > 0 && completed > 0) {
                    return 'In progress';
                }
                return 'N/A';
            },

            calculatePercentage(progressInstance) {
                let incompleted = this.calculateIncomplete(progressInstance).length;
                let completed = this.calculateComplete(progressInstance).length;
                if(incompleted + completed === 0) {
                    return 'N/A';
                }
                return Math.round((completed / (incompleted + completed)) * 100);
            },

            calculateCompleteText(progressInstance) {
                let filteredModules = this.calculateComplete(progressInstance);
                if(filteredModules.length > 0) {
                    return '<ul>' +
                        filteredModules.map(moduleInstance => '<li style="' + (moduleInstance.evaluation.mandatory === true ? 'mandatory' : 'optional') + '">' + moduleInstance.name + '</li>').toString()
                        + '</ul>';
                }
                return 'None';
            },

            calculateIncompleteText(progressInstance) {
                let filteredModules = this.calculateIncomplete(progressInstance);
                if(filteredModules.length > 0) {
                    return '<ul>' +
                        filteredModules.map(moduleInstance => '<li style="' + (moduleInstance.evaluation.mandatory === true ? 'mandatory' : 'optional') + '">' + moduleInstance.name + '</li>').toString()
                        + '</ul>';
                }
                return 'None';
            },

            calculateComplete(progressInstance) {
                return progressInstance.module_instances.filter(moduleInstance => moduleInstance.evaluation.complete === true);
            },

            calculateIncomplete(progressInstance) {
                return progressInstance.module_instances.filter(moduleInstance => moduleInstance.evaluation.complete === false);
            },

            filterGroupName(progress) {
                return progress.participant.name.toUpperCase().indexOf(this.filter.groupName.toUpperCase()) !== -1;
            },

            filterGroupEmail(progress) {
                return progress.participant.email.toUpperCase().indexOf(this.filter.groupEmail.toUpperCase()) !== -1;
            },

            filterStatus(progress) {
                return (this.filter.status.length === 0?true:
                    this.filter.status.indexOf(this.calculateStatus(progress)) !== -1);
            },

            filterComplete(progress) {
                if(this.filter.completed.length === 0) {
                    return true;
                }
                let completedModuleInstances = this.calculateComplete(progress);
                return this.filter.completed.filter(moduleInstanceId => {
                    return completedModuleInstances.filter(moduleInstance => moduleInstance.id === moduleInstanceId).length !== 0
                }).length === this.filter.completed.length;
            },

            filterIncomplete(progress) {
                if(this.filter.incomplete.length === 0) {
                    return true;
                }
                let incompletedModuleInstances = this.calculateIncomplete(progress);
                return this.filter.incomplete.filter(moduleInstanceId => {
                    return incompletedModuleInstances.filter(moduleInstance => moduleInstance.id === moduleInstanceId).length !== 0
                }).length === this.filter.incomplete.length;
            },

            filterLowerPercentage(progress) {
                return (this.filter.lowerPercentage === null?true:this.calculatePercentage(progress) >= this.filter.lowerPercentage);
            },

            filterUpperPercentage(progress) {
                return (this.filter.upperPercentage === null?true:this.calculatePercentage(progress) <= this.filter.upperPercentage);
            }

        },

        computed: {
            items() {
                return this.progress.filter(this.filterGroupName)
                    .filter(this.filterGroupEmail)
                    .filter(this.filterStatus)
                    .filter(this.filterComplete)
                    .filter(this.filterIncomplete)
                    .filter(this.filterLowerPercentage)
                    .filter(this.filterUpperPercentage);
            },
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
