<template>
    <div style="text-align: left">
        <div class="card">
            <div class="card-header">
                {{title}}
            </div>
            <div class="card-body" style="width: 100%">
                <p class="card-text" style="width: 100%">
                    <filter-block
                        v-for="(filter, index) in selectedFilters"
                        :key="index"
                        :index="index"
                        :filter="filter"
                        @filterUpdated="filterUpdated">

                    </filter-block>
                </p>
                <a href="#" class="btn btn-primary" style="width: 100%" @click="showModal" >Add Filter</a>
            </div>
        </div>

        <b-modal :id="id" title="Add new filter">
            <add-filter
            :filters="filters"
            @filterAdded="filterAdded">
            </add-filter>
        </b-modal>

    </div>

</template>

<script>

    import FilterBlock from './FilterBlock';
    import AddFilter from './AddFilter';

    export default {
        name: "LogicConstraints",

        props: {
            title: {
                required: true,
                type: String
            },

            id: {
                required: true,
                type: String
            },

            filters: {
                required: true,
                type: Array
            },
            value: {
                type: Array
            }
        },

        data() {
            return {
                selectedFilters: [],
            }
        },

        methods: {
            showModal() {
                this.$bvModal.show(this.id);
            },

            filterAdded(filter) {
                this.selectedFilters.push(filter);
                this.$bvModal.hide(this.id);
            },

            filterUpdated(filterSettings, index) {
                let values = this.value;
                values[index] = filterSettings
                this.$emit('input', values);
            }
        },

        components: {
            AddFilter,
            FilterBlock
        }

    }
</script>

<style scoped>

</style>