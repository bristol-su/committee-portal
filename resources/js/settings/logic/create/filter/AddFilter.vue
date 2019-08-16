<template>
    <div>
        <b-button variant="secondary" style="width: 100%" v-b-modal="title">Add Filter</b-button>

        <b-modal :id="title" title="Choose a Filter" no-stacking ok-only ok-title="Cancel">
            <filter-list @click="setupFilter">

            </filter-list>
        </b-modal>
        <b-modal :id="title + '-add'" title="Setup Filter" no-stacking ok-only ok-title="Cancel">
            <filter-setup
                :filter="filter"
                @input="addFilter">

            </filter-setup>
        </b-modal>

    </diV>
</template>

<script>
    import FilterList from "./FilterList";
    import FilterSetup from "./filterinstance/FilterSetup";

    export default {
        name: "AddFilter",

        components: {
            FilterSetup,
            FilterList
        },

        props: {
            title: {
                required: true,
                type: String
            }
        },

        data() {
            return {
                filter: null
            }
        },

        methods: {
            setupFilter(filter) {
                this.filter = filter;
                this.$bvModal.show(this.title + '-add');
            },

            addFilter(id) {
                this.$bvModal.hide(this.title + '-add');
                this.$emit('addFilter', id)
            }
        },

    }
</script>

<style scoped>

</style>
