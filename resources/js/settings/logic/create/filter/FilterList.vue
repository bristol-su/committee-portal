<template>
    <div>
        <b-list-group>
            <b-list-group-item hrerf="#" @click="$emit('click', filter)" v-for="filter in filters" :key="filter.alias" class="flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{filter.name}}</h5>
                    <small>{{filter.for}}</small>
                </div>

                <p class="mb-1">
                    {{filter.description}}
                </p>

            </b-list-group-item>
        </b-list-group>

    </div>
</template>

<script>
    export default {
        name: "FilterList",

        data() {
            return {
                filters: []
            }
        },

        created() {
            this.loadFilters();
        },

        methods: {
            loadFilters() {
                this.$api.filters().getAll()
                    .then(response => this.filters = response.data)
                    .catch(error => this.$notify.alert('Filters could not be loaded: ' + error.message));
            }
        },

    }
</script>

<style scoped>

</style>
