<template>
    <div>
        <search
            :activity="activity"
            :basicFunctions="basicFunctions"
            :basicFilter="basicFilter"
            @basicFilterUpdated="updateBasicFilter"
            @refresh="calculateTableItems"
            ref="search">

            <template v-slot:basic>
                <b-col class="my-1" lg="6">
                    <b-form-group class="mb-0" label="Group Name" label-align-sm="right" label-cols-sm="3"
                                  label-for="groupNameFilter" label-size="sm">
                        <b-input-group size="sm">
                            <b-form-input
                                id="groupNameFilter" placeholder="Type to Search" type="search"
                                @input="$emit('basicFilterUpdated', 'name', $event)"
                                :value="basicFilter.name"/>
                            <b-input-group-append>
                                <b-button @click="filters.basic.name = ''">Clear</b-button>
                            </b-input-group-append>
                        </b-input-group>
                    </b-form-group>
                </b-col>

                <b-col class="my-1" lg="6">
                    <b-form-group
                        class="mb-0" label="Group Email" label-align-sm="right" label-cols-sm="3"
                        label-for="groupEmailFilter" label-size="sm">
                        <b-input-group size="sm">
                            <b-form-input id="groupEmailFilter" placeholder="Type to Search" type="search"
                              :value="basicFilter.name"
                                          @input="$emit('basicFilterUpdated', 'name', $event)"/>
                            <b-input-group-append>
                                <b-button @click="filters.basic.email = ''">Clear</b-button>
                            </b-input-group-append>
                        </b-input-group>
                    </b-form-group>
                </b-col>
            </template>
        </search>

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
    import Search from './Search/Search';
    import progressFunctions from './progressFunctions';

    export default {
        name: "GroupActivityProgress",
        components: {Search},
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
                basicFunctions: [
                    function (progress, filter) {
                        return progress.participant.name.toUpperCase().indexOf(filter.name.toUpperCase()) !== -1;
                    },
                    function (progress, filter) {
                        return progress.participant.email.toUpperCase().indexOf(filter.email.toUpperCase()) !== -1;
                    },
                ],
                basicFilter: {
                    name: '',
                    email: ''
                }
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

            calculateTableItems() {
                this.tableLoading = true;
                this.filteredTableItems = this.progress.filter(this.$refs.search.filterResult);

                this.tableLoading = false;
            },

            updateBasicFilter(key, value) {
                this.$set(this.basicFilter, key, value);
            }

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
