<template>
    <div>
        <b-table :fields="fields" :items="logics">
            <template slot="actions" slot-scope="data">
                <a :href="'/logic/' + data.item.id">
                    <b-button variant="secondary">View</b-button>
                </a>
            </template>
        </b-table>
    </div>
</template>

<script>
    export default {
        name: "Index",

        props: {
            logics: {
                required: true,
                type: Array,
                default: function() {
                    return [];
                }
            }
        },

        data() {
            return {
                fields: [
                    'name',
                    'description',
                    'for',
                    'actions'
                ]
            }
        }
    }
</script>

<style scoped>

</style>
