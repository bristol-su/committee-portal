<template>
    <span>
        <span v-if="loading">Loading</span>
        <span v-else>
            {{logic.name}} <a :href="'/logic/' + logic.id"><b-button variant="secondary" size="sm">View</b-button></a>
        </span>
    </span>
</template>

<script>
    export default {
        name: "LogicPreview",

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
                    .catch(error => this.$notify.alert('Something went wrong loading logic: ' + error.message))
                    .then(() => this.loading = false);
            }
        }
    }
</script>

<style scoped>

</style>
