<template>
    <div>

        <b-container fluid>


            <!-- Main table element -->
            <b-table
                    show-empty
                    stacked="md"
                    :items="dataTableItems"
                    :fields="fields"
            >

            </b-table>


        </b-container>

    </div>

</template>

<script>
    export default {
        name: "ProgressBreakdown.vue",

        props: {
            modules: {
                required: true,
                type: Array
            },

            group: {
                required: true,
                type: Object
            }
        },

        data() {
            return {
                fields: [
                    {
                        key: 'module_name',
                        sortable: true,
                    },
                    {
                        key: 'completed',
                        sortable: true,
                    },
                    {
                        key: 'mandatory',
                        sortable: true,
                    },
                ],
            }
        },

        computed: {
            dataTableItems() {
                return this.modules.map(module => {
                    return {
                        module_name: module.name,
                        completed: (module.completed?'Yes':'No'),
                        mandatory: (module.mandatory?'Yes':'No'),
                    };

                });
            },


        }
    }
</script>
