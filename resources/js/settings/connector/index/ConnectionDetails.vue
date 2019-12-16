<template>
    <b-card>
        <b-row class="mb-2">
            <b-col class="text-sm-right" sm="3"><b>Name:</b></b-col>
            <b-col>{{ connection.name }}</b-col>
        </b-row>

        <b-row class="mb-2">
            <b-col class="text-sm-right" sm="3"><b>Description:</b></b-col>
            <b-col>{{ connection.description }}</b-col>
        </b-row>

    </b-card>
</template>

<script>
    export default {
        name: "ConnectionDetails",

        props: {
            connection: {
                required: true,
                type: Object
            }
        },

    }
</script>

<style scoped>
</style>
