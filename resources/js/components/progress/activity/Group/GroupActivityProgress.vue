<template>
    <div>
        <div v-show="searchType === 'basic'">
            <basic-group-search ref="basicsearch" @refresh="calculateTableItems" :activity="activity"/>
        </div>
        <div v-show="searchType === 'advanced'">
            <advanced-group-search ref="advancedsearch" @refresh="calculateTableItems"/>
        </div>
        <b-row>
            <b-col style="text-align: right">
                <b-checkbox @input="setSearchType">Advanced Search?</b-checkbox>
            </b-col>
        </b-row>


        <b-table :busy="loading" :fields="fields" :items="filteredTableItems">
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
    import BasicGroupSearch from './Search/BasicGroupSearch';
    import AdvancedGroupSearch from './Search/AdvancedGroupSearch';

    export default {
        name: "GroupActivityProgress",
        components: {AdvancedGroupSearch, BasicGroupSearch},
        props: {
            activity: {
                required: true,
                type: Object
            }
        },

        data() {
            return {
                progress: [],
                filteredTableItems: [],
                fields: [
                    {key: 'group_id', label: 'Group ID', sortable: true},
                    {key: 'group_name', label: 'Name', sortable: true},
                    {key: 'group_email', label: 'Group Email', sortable: true},
                    {key: 'complete_module_instances', label: 'Completed'},
                    {key: 'incomplete_module_instances', 'label': 'Incomplete'},
                    {key: 'status', label: 'Status'},
                    {key: 'percentage', label: 'Percentage'}
                ],
                progressLoading: true,
                tableLoading: false,
                searchType: 'basic'
            }
        },


        created() {
            this.loadProgress();
        },

        methods: {
            loadProgress() {
                this.progressLoading = true;
                this.$api.activity().progress(this.activity.id)
                    .then(response => {
                        this.progress = response.data;
                        this.calculateTableItems();
                    })
                    .catch(error => this.$notify.alert('Could not load activity progress: ' + error.message))
                    .then(() => this.progressLoading = false);
            },

            setSearchType(type) {
                if(type) {
                    this.searchType = 'advanced';
                } else {
                    this.searchType = 'basic';
                }
                this.calculateTableItems();
            },



            /*
            Table data loading
            */

            calculateTableItems() {
                this.tableLoading = true;
                if(this.searchType === 'basic') {
                    this.filteredTableItems = this.progress
                        .filter(this.$refs.basicsearch.filterGroupName)
                        .filter(this.$refs.basicsearch.filterGroupEmail)
                        .filter(this.$refs.basicsearch.filterStatus)
                        .filter(this.$refs.basicsearch.filterComplete)
                        .filter(this.$refs.basicsearch.filterIncomplete)
                        .filter(this.$refs.basicsearch.filterLowerPercentage)
                        .filter(this.$refs.basicsearch.filterUpperPercentage)
                        .filter(this.$refs.basicsearch.filterMandatory)
                        .filter(this.$refs.basicsearch.filterOptional);
                } else if(this.searchType === 'advanced') {
                    this.filteredTableItems = this.progress
                        .filter(this.$refs.advancedsearch.evaluate);
                } else {
                    this.filteredTableItems = this.progress;
                }
                this.tableLoading = false;
            },

            calculateStatus(progressInstance) {
                let incompleted = this.calculateIncomplete(progressInstance).length;
                let completed = this.calculateComplete(progressInstance).length;
                if (incompleted === 0 && completed > 0) {
                    return 'Finished';
                } else if (incompleted === 0 && completed === 0) {
                    return 'N/A';
                } else if (incompleted > 0 && completed === 0) {
                    return 'Not started';
                } else if (incompleted > 0 && completed > 0) {
                    return 'In progress';
                }
                return 'N/A';
            },

            calculatePercentage(progressInstance) {
                let incompleted = this.calculateIncomplete(progressInstance).length;
                let completed = this.calculateComplete(progressInstance).length;
                if (incompleted + completed === 0) {
                    return 'N/A';
                }
                return Math.round((completed / (incompleted + completed)) * 100);
            },

            calculateCompleteText(progressInstance) {
                let filteredModules = this.calculateComplete(progressInstance);
                if (filteredModules.length > 0) {
                    return '<ul>' +
                        filteredModules.map(moduleInstance => '<li style="color: ' + (moduleInstance.evaluation.mandatory === true ? '#ff8370' : 'black') + '">' + moduleInstance.name + '</li>').join('')
                        + '</ul>';
                }
                return '';
            },

            calculateIncompleteText(progressInstance) {
                let filteredModules = this.calculateIncomplete(progressInstance);
                if (filteredModules.length > 0) {
                    return '<ul>' +
                        filteredModules.map(moduleInstance => '<li style="color: ' + (moduleInstance.evaluation.mandatory === true ? '#ff8370' : 'black') + '">' + moduleInstance.name + '</li>').join('')
                        + '</ul>';
                }
                return '';
            },

            calculateComplete(progressInstance) {
                return progressInstance.module_instances.filter(moduleInstance => moduleInstance.evaluation.complete === true);
            },

            calculateIncomplete(progressInstance) {
                return progressInstance.module_instances.filter(moduleInstance => moduleInstance.evaluation.complete === false);
            },




        },

        computed: {
            loading() {
                return this.progressLoading || this.tableLoading;
            }
        }

    }
</script>

<style scoped>
    .mandatory {
        color: #ff8370;
    }

</style>
