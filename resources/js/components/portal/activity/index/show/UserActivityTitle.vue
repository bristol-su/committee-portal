<template>
    <span>{{title}}</span>
</template>

<script>
    export default {
        name: "UserActivityTitle",
        props: {
            userId: {
                required: true,
            }
        },

        computed: {
            title() {
                return  'Your user account.'
            },

        }
    }
</script>

<style scoped>

</style>
