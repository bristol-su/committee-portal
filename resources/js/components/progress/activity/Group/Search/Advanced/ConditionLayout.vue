<template>
    <div>
        <nested-draggable v-model="conditions" ref="draggable"/>
    </div>
</template>

<script>
    import NestedDraggable from './NestedDraggable';

    export default {
        name: "ConditionLayout",

        props: {},

        components: {
            NestedDraggable
        },

        data() {
            return {
                conditions: []
            }
        },

        watch: {
            conditions: {
                handler: function(val) {
                    // this.$emit('refresh');
                },
                deep: true
            }
        },

        methods: {
            evaluate(progress) {
                return this.$refs.draggable.evaluate(progress);
            }
        },

        computed: {}
    }
</script>

<style scoped>

</style>
