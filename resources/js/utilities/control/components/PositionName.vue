<template>
    <div>
        <span v-if="loading">Loading...</span>
        <span v-else>{{position.name}}</span>
    </div>
</template>

<script>
    export default {
        name: "PositionName",

        props: {
            id: {
                required: true,
                type: Number
            }
        },

        data() {
            return {
                loading: true,
                position: {}
            }
        },

        created() {
            this.loadPosition();
        },

        methods: {
            loadPosition() {
                this.$control.position().getById(this.id)
                    .then(response => this.position = response.data)
                    .catch(error => this.$notify.alert('Could not load position information: ' + error.message))
                    .then(() => this.loading = false);
            }
        },

        computed: {}
    }
</script>

<style scoped>

</style>
