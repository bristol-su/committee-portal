<template>
    <div>
        <div v-if="loading">
            Loading...
        </div>
        <div v-else>
            <b-row>
                <b-col>
                    <b-table striped hover :items="modules" :fields="moduleFields">
                        <template slot="view" slot-scope="data">
                            <a :href="'/activity/' + activity.id + '/module_instance/' + data.item.id"><b-button variant="primary">View</b-button></a>
                        </template>
                    </b-table>
                </b-col>
            </b-row>
            <b-row>
                <b-col style="text-align: right; padding-right: 10px;">
                    <a :href="'/activity/' + activity.id + '/module_instance/create'">
                        <b-button variant="secondary">Add new module</b-button>
                    </a>
                </b-col>
            </b-row>

        </div>

    </div>
</template>

<script>
    export default {
        name: "Index",

        props: {
            activity: {
                required: true,
                type: Object
            }
        },

        data() {
            return {
                modules: [],
                moduleFields: [
                    'name',
                    'description',
                    'view',
                ],
                loading: true
            }
        },

        created() {
            this.loadModules();
        },

        methods: {
            loadModules() {
                this.$api.modules().getBelongingToActivity(this.activity.id)
                    .then(response => this.modules = response.data)
                    .catch(error => this.$notify.alert('Something went wrong getting the module instances: ' + error.message))
                    .then(() => this.loading = false);
            }
        }

    }
</script>

<style scoped>

</style>
