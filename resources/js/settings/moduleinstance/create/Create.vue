<template>
    <div>
        <wizard>

        </wizard>
    </div>
</template>

<script>

    import Wizard from "./Wizard";
    export default {
        name: "Create",
        components: {Wizard},
        props: {
            activityId: {
                required: true,
                type: Number
            }
        }
    }
</script>

<style scoped>

</style>
