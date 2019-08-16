<template>
    <div>
        <div v-for="filter in filters" :key="filter.id">
            {{filter.name}}
        </div>
    </div>
</template>

<script>
    import DataItem from "../../../../utilities/DataItem";
    export default {
        name: "FilterGroup",
        components: {DataItem},
        props: {
            filters: {
                required: true,
                type: Array,
                default: function() {
                    return [];
                }
            }
        }
    }
</script>

<style scoped>

</style>
