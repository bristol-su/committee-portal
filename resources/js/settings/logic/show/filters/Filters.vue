<template>
    <div>
        <div v-if="loading">Loading...</div>
        <div v-else>
            <data-item title="All True">
                <filter-group :filters="allTrue">

                </filter-group>
            </data-item>
            <data-item title="All False">
                <filter-group :filters="allFalse">

                </filter-group>
            </data-item>
            <data-item title="At Least One True">
                <filter-group :filters="anyTrue">

                </filter-group>
            </data-item>
            <data-item title="At Least One False">
                <filter-group :filters="anyFalse">

                </filter-group>
            </data-item>
        </div>
    </div>
</template>

<script>
    import DataItem from "../../../../utilities/DataItem";
    import FilterGroup from "./FilterGroup";
    export default {
        name: "Filters",
        components: {FilterGroup, DataItem},
        props: {
            logicId: {
                required: true,
                type: Number
            }
        },

        data() {
            return {
                filters: [],
                loading: true
            }
        },

        created() {
            this.loadFilters();
        },

        methods: {
            loadFilters() {
                this.$api.filters().getBelongingToLogic(this.logicId)
                    .then(response => this.filters = response.data)
                    .catch(error => this.$notify.alert('Could not load filters: ' + error.message ))
                    .then(() => this.loading = false);
            }
        },

        computed: {
            allTrue() {
                return this.filters.filter(filter => {
                    return filter.logic_type === 'all_true';
                })
            },
            allFalse() {
                return this.filters.filter(filter => {
                    return filter.logic_type === 'all_false';
                })
            },
            anyTrue() {
                return this.filters.filter(filter => {
                    return filter.logic_type === 'any_true';
                })
            },
            anyFalse() {
                return this.filters.filter(filter => {
                    return filter.logic_type === 'any_false';
                })
            },
        }


    }
</script>

<style scoped>

</style>
