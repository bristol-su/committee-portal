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

        // TODO Needs a prop to specify the type of filter allowed.

        created() {
            this.loadFilters();
        },

        methods: {
            loadFilters() {
                this.filters = [
                    {
                        alias: 'group_tagged',
                        name: 'Group Tagged',
                        description: 'Check if a group has been tagged',
                        for: 'group',
                        options: {
                            'tag': [
                                'reference1',
                                'reference2'
                            ]
                        }
                    }
                ];
            }
        }
    }
</script>

<style scoped>

</style>
