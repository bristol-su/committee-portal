<template>
    <div>
        <div v-if="loading">
            Loading...
        </div>
        <div v-else>
            <data-item title="Name">
                {{logic.name}}
            </data-item>
            <data-item title="Description">
                {{logic.description}}
            </data-item>
            <data-item title="Applicable To">
                {{logic.for}}
            </data-item>
            <data-item title="View">
                <a :href="url"><b-button variant="secondary" size="sm">View</b-button></a>
            </data-item>
        </div>
    </div>
</template>

<script>
    import DataItem from "../../../../utilities/DataItem";
    export default {
        name: "Logic",
        components: {DataItem},
        props: {
            logicId: {
                required: true,
                type: Number
            }
        },

        data() {
            return {
                logic: {},
                loading: true
            }
        },

        created() {
            this.loadLogic();
        },

        methods: {
            loadLogic() {
                this.$api.logic().get(this.logicId)
                    .then(response => this.logic = response.data)
                    .catch(error => this.$notify.alert('Could not load logic information: ' + error.message))
                    .then(() => this.loading = false);
            }
        },

        computed: {
            url() {
                return process.env.MIX_APP_URL + '/logic/' + this.logic.id;
            }
        }
    }
</script>

<style scoped>

</style>
