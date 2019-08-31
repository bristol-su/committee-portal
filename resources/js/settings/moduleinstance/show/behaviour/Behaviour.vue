<template>
    <div>
        <data-item title="Active For">
            <logic-preview :logic-id="activeId"></logic-preview>
        </data-item>
        <data-item title="Visible For">
            <logic-preview :logic-id="visibleId"></logic-preview>
        </data-item>
        <data-item title="Mandatory For">
            <logic-preview :logic-id="mandatoryId"></logic-preview>
        </data-item>
        <data-item title="Complete On">
            <complete :event="completeEvent"></complete>
        </data-item>
    </div>
</template>

<script>
    import DataItem from "../../../../utilities/DataItem";
    import LogicPreview from "./LogicPreview";
    import Complete from "./Complete";
    export default {
        name: "Behaviour",
        components: {Complete, LogicPreview, DataItem},
        props: {
            activeId: {
                required: true,
                type: Number
            },
            visibleId: {
                required: true,
                type: Number
            },
            mandatoryId: {
                required: true,
                type: Number
            },
            completeEvent: {
                required: true,
                type: String
            },
        }
    }
</script>

<style scoped>

</style>
