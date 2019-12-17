<template>
    <b-row class="mb-2">
        <b-col class="text-sm-right" sm="3"><b>{{title}}:</b></b-col>
        <b-col><slot></slot></b-col>
    </b-row>
</template>

<script>
    export default {
        name: "DataItem",

        props: {
            title: {
                required: true,
                type: String
            }
        }
    }
</script>

<style scoped>

</style>
