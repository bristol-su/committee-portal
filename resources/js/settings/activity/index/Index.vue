<template>
    <div>
        <b-table :fields="fields" :items="activities">
            <template slot="actions" slot-scope="data">
                <a :href="'/settings/activity/' + data.item.id">
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
            activities: {
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
                    'actions'
                ]
            }
        }
    }
</script>

<style scoped>

</style>
