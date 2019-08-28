<template>
    <div>
        <div class="card">
            <div class="card-header">
                {{title}}
            </div>
            <div class="card-body" style="width: 100%">
                <p class="card-text" style="width: 100%">
                    <b-list-group>
                        <b-list-group-item class="flex-column align-items-start" v-for="filter in filters" :key="filter.id">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{filter.name}}</h5>
                                <small>{{filter.alias}} (#{{filter.id}})</small>
                            </div>

                            <span><small v-for="setting in Object.keys(filter.settings)">
                                <strong>{{setting.charAt(0).toUpperCase()}}{{setting.slice(1)}}</strong>: {{filter.settings[setting]}}
                            </small></span>

                        </b-list-group-item>
                    </b-list-group>
                </p>
                <add-filter :title="title" @addFilter="addFilter" :for-logic="forLogic">

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
            },
            forLogic: {
                required: true,
                type: String
            }
        },

        data() {
            return {
                filters: []
            }
        },

        methods: {
            addFilter(filter) {
                this.filters.push(filter);
                this.$emit('input', this.filters.map(filter => filter.id));
            }
        }
    }
</script>

<style scoped>

</style>
