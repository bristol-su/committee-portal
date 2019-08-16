<template>
    <div>
        <filter-group title="All True" v-model="all_true">

        </filter-group>

        <filter-group title="All False" v-model="all_false">

        </filter-group>

        <filter-group title="Any Must Be True" v-model="any_true">

        </filter-group>

        <filter-group title="Any Must Be False" v-model="any_false">

        </filter-group>
    </div>
</template>

<script>
    import FilterGroup from "./filter/FilterGroup";
    export default {
        name: "Logic",
        components: {FilterGroup},
        data() {
            return {
                all_true: [],
                all_false: [],
                any_true: [],
                any_false: []
            }
        }
    }
</script>

<style scoped>

</style>
