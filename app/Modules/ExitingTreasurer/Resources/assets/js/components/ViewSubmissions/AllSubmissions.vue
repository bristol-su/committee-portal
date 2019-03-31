<template>
    <div class="container">
        <div v-for="submission in submissions" class="row">

        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                submissions: []
            }
        },

        created() {
            this.$http.get('/admin/exitingtreasurer/submissions')
                .then(response => this.submissions = response.data)
                .catch(error => this.$notify.alert('Could not find previous submissions: '+error.message));
        }
    }
</script>

<style scoped>

</style>