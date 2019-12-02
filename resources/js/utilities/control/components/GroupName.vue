<template>
    <div>
        <span v-if="loading">Loading...</span>
        <span v-else>{{group.name}}</span>
    </div>
</template>

<script>
    export default {
        name: "GroupName",

        props: {
            id: {
                required: true,
                type: Number
            }
        },

        data() {
            return {
                loading: true,
                group: {}
            }
        },

        created() {
            this.loadGroup();
        },

        methods: {
            loadGroup() {
                this.$control.group().getById(this.id)
                    .then(response => this.group = response.data)
                    .catch(error => this.$notify.alert('Could not load group information: ' + error.message))
                    .then(() => this.loading = false);
            }
        },

        computed: {}
    }
</script>

<style scoped>

</style>
