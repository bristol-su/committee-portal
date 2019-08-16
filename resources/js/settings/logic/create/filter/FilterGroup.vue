<template>
    <div>
        <div class="card">
            <div class="card-header">
                {{title}}
            </div>
            <div class="card-body" style="width: 100%">
                <p class="card-text" style="width: 100%">
                    {{filters}}
                </p>
                <add-filter :title="title" @addFilter="addFilter">

                </add-filter>
            </div>
        </div>

    </div>
</template>

<script>
    import FilterList from "./FilterList";
    import FilterSetup from "./filterinstance/FilterSetup";
    import AddFilter from './AddFilter';

    export default {
        name: "FilterGroup",
        components: {AddFilter, FilterSetup, FilterList},
        props: {
            title: {
                required: true,
                type: String
            }
        },

        data() {
            return {
                filters: []
            }
        },

        watch: {
            filters(filters) {
                this.$emit('input', filters.map(filter => filter.id));
            }

        },

        methods: {
            addFilter(filter) {
                this.filters.push(filter);
            }
        }
    }
</script>

<style scoped>

</style>
