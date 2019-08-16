<template>
    <b-row>
        <b-col cols="2"></b-col>
        <b-col>
            <p>
                <strong>{{title}}</strong>:
                <slot></slot>
            </p>
        </b-col>
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
