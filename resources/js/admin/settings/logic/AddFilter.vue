<template>
    <div>
        <b-list-group>
            <b-list-group-item
                    v-for="filter in filters"
                    :key="filter.name"
                    class="flex-column align-items-start"
                    @click="$emit('filterAdded', filter)">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{filter.name}}</h5>
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
        name: "AddFilter.vue",
        props: {
            filters: {
                required: true,
                type: Array
            }
        }
    }
</script>

<style scoped>

</style>