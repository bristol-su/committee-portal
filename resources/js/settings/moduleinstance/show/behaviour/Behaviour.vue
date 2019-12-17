<template>
    <div>
        <data-item title="Active For">
            <logic-preview :logic-id="moduleInstance.active"></logic-preview>
        </data-item>
        <data-item title="Visible For">
            <logic-preview :logic-id="moduleInstance.visible"></logic-preview>
        </data-item>
        <data-item title="Mandatory For" v-if="completableActivity">
            <logic-preview :logic-id="moduleInstance.mandatory"></logic-preview>
        </data-item>
        <data-item title="Completable" v-if="completableActivity">
            {{moduleInstance.completion_condition_instance.name}}
        </data-item>
    </div>
</template>

<script>
    import DataItem from "../../../../utilities/DataItem";
    import LogicPreview from "./LogicPreview";

    export default {
        name: "Behaviour",
        components: {LogicPreview, DataItem},
        props: {
            moduleInstance: {
                required: true,
                type: Object
            }
        },
        computed: {
            completableActivity() {
                return this.moduleInstance.activity.type !== 'open';
            }
        }
    }
</script>

<style scoped>

</style>
