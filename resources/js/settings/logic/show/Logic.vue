<template>
    <div>
        <data-item title="Name">
            {{logic.name}}
        </data-item>
        <data-item title="Description">
            {{logic.description}}
        </data-item>
        <data-item title="for">
            {{logic.for}}
        </data-item>
    </div>
</template>

<script>
    import DataItem from "../../../utilities/DataItem";
    export default {
        name: "Logic",
        components: {DataItem},
        props: {
            logic: {
                required: true,
                type: Object
            }
        }
    }
</script>

<style scoped>

</style>
