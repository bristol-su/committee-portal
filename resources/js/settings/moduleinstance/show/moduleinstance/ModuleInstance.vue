<template>
    <div>
        <data-item title="Name">
            {{moduleInstance.name}}
        </data-item>
        <data-item title="Description">
            {{moduleInstance.description}}
        </data-item>
        <data-item title="Module">
            {{moduleInstance.alias}}
        </data-item>
    </div>
</template>

<script>
    import DataItem from "../../../../utilities/DataItem";
    export default {
        name: "ModuleInstance",
        components: {DataItem},
        props: {
            moduleInstance: {
                required: true,
                type: Object
            }
        }
    }
</script>

<style scoped>

</style>
