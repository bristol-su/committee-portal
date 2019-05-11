<template>
    <div>

        <b-container fluid>
            <!-- User Interface controls -->
            <b-row>
                <b-col md="6" class="my-1">
                    <b-form-group label-cols-sm="3" label="Filter" class="mb-0">
                        <b-input-group>
                            <b-form-input v-model="filter" placeholder="Type to Search"></b-form-input>
                            <b-input-group-append>
                                <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
                            </b-input-group-append>
                        </b-input-group>
                    </b-form-group>
                </b-col>

                <b-col md="6" class="my-1">
                    <b-form-group label-cols-sm="3" label="Per page" class="mb-0">
                        <b-form-select v-model="perPage" :options="pageOptions"></b-form-select>
                    </b-form-group>
                </b-col>
            </b-row>

            <!-- Main table element -->
            <b-table
                    show-empty
                    stacked="md"
                    :items="dataTableItems"
                    :fields="fields"
                    :current-page="currentPage"
                    :per-page="perPage"
                    :filter="filter"
                    @filtered="onFiltered"
            >

                <template slot="breakdown" slot-scope="row">
                    <b-button size="sm" @click="showBreakdownModal(row.item, row.index, $event.target)">
                        Show Breakdown
                    </b-button>
                </template>

<!--                <template slot="row-details" slot-scope="row">-->
<!--                    <b-card>-->
<!--                        <ul>-->
<!--                            <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value }}</li>-->
<!--                        </ul>-->
<!--                    </b-card>-->
<!--                </template>-->
            </b-table>

            <b-row>
                <b-col md="6" class="my-1">
                    <b-pagination
                            v-model="currentPage"
                            :total-rows="totalRows"
                            :per-page="perPage"
                            class="my-0"
                    ></b-pagination>
                </b-col>
            </b-row>

            <!-- Info modal -->
            <b-modal :id="breakdownModal.id" :title="breakdownModal.title" ok-only @hide="resetBreakdownModal">
                <progress-breakdown
                    :modules="this.breakdownModal.modules"
                    :group="this.breakdownModal.group">

                </progress-breakdown>
            </b-modal>
        </b-container>

    </div>

</template>

<script>
    import ProgressBreakdown from "./ProgressBreakdown";

    export default {
        name: "GroupProgress.vue",

        props: {
            modules: {
                required: true,
                type: Array
            },
        },

        components: {
            ProgressBreakdown
        },

        data() {
            return {
                fields: [
                    {
                        key: 'group_name',
                        sortable: true,
                    },
                    {
                        key: 'completed',
                        sortable: true,
                        label: 'Completed (%)'
                    },
                    {
                        key: 'breakdown',
                        label: 'Progress Breakdown'
                    }
                ],
                totalRows: 1,
                currentPage: 1,
                perPage: 50,
                pageOptions: [50, 100, 150, 200, 500],
                filter: null,
                breakdownModal: {
                    id: 'info-modal',
                    title: 'Some Title',
                    modules: [],
                    group: {}
                }
            }
        },

        methods: {
            percentageOfGroup(group) {
                return (
                    (group.modules.filter(module => module.mandatory === true && module.completed === true).length)
                    /
                    group.modules.filter(module => module.mandatory === true).length)
                    * 100;
            },
            resetBreakdownModal() {
                this.breakdownModal.title = '';
                this.breakdownModal.modules = [];
                this.breakdownModal.group= {};
            },
            onFiltered(filteredItems) {
                // Trigger pagination to update the number of buttons/pages due to filtering
                this.totalRows = filteredItems.length;
                this.currentPage = 1;
            },
            showBreakdownModal(item, index, button) {
                this.breakdownModal.title = item.group_name + ' Reaffiliation Progress';
                this.breakdownModal.modules= item.group_data.modules;
                this.breakdownModal.group = item.group_data.group;
                this.$root.$emit('bv::show::modal', this.breakdownModal.id);
            }
        },

        computed: {
            dataTableItems() {
                return this.completionData.map(group => {
                    return {
                        group_data: group,
                        group_name: group.group.name,
                        completed: Math.round(this.percentageOfGroup(group))+'%',
                    };

                });
            },

            // This function will return an array of {completed: bool, mandatory: bool} to determine completion rates
            completionData() {
                let data = {};
                this.modules.forEach(module => {
                    module.groups.forEach(group => {
                        if(data[group.group.id] === undefined) {
                            data[group.group.id] = {
                                group: group.group,
                                modules: []
                            };
                        }
                        data[group.group.id].modules.push({
                            name: module.name,
                            completed: group.completed,
                            mandatory: group.mandatory
                        });
                    });
                });
                return Object.values(data);
            },

            completedReaffiliation() {
                return this.completionData.filter(group => {
                    return group.modules.filter(module => {
                        return module.mandatory === false || module.completed === true;
                    }).length === group.modules.length;
                }).length;
            },

            totalReaffiliating() {
                return this.completionData.length;
            },

            percentage() {
                return Math.round((this.completedReaffiliation / this.totalReaffiliating) * 100);
            }
        }
    }
</script>

<style scoped>
    .progress-bar {
        color: black;
    }
</style>