<template>
    <span>
        {{event}}
    </span>
</template>

<script>
    export default {
        name: "Complete",

        props: {
            event: {
                required: true,
                type: String
            }
        }
    }
</script>

<style scoped>

</style>
