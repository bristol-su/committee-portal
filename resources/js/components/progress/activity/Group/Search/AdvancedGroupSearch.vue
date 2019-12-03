<template>
    <div>
        <condition-layout ref="conditionLayout" @refresh="$emit('refresh')"></condition-layout>
    </div>
</template>

<script>

    import ConditionLayout from './Advanced/ConditionLayout';
    export default {
        name: "AdvancedGroupSearch",
        components: {ConditionLayout},
        props: {},

        data() {
            return {}
        },

        methods: {
            evaluate(progress) {
                return this.$refs.conditionLayout.evaluate(progress);
            }
        },

        computed: {}
    }
</script>

<style scoped>

</style>
