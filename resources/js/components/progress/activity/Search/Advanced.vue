<template>
    <div>
        <condition-layout v-model="conditions" ref="conditionLayout"></condition-layout>
        <p>
            <b-button variant="light" @click="addCondition"><i class="fa fa-plus"></i> Condition</b-button>
            <b-button variant="light" @click="addGroup"><i class="fa fa-plus"></i> Group</b-button>
        </p>
    </div>
</template>

<script>

    import ConditionLayout from './Advanced/ConditionLayout';
    export default {
        name: "Advanced",
        components: {ConditionLayout},
        props: {},

        data() {
            return {
                conditions: []
            }
        },

        watch: {
            conditions: {
                handler: function(val) {
                    this.$nextTick(function() {
                        this.$emit('refresh');
                    });
                },
                deep: true
            }
        },

        methods: {
            evaluate(progress) {
                return this.$refs.conditionLayout.evaluate(progress);
            },

            addCondition() {
                this.conditions.push({
                    operation: 'AND',
                    condition: {filter: null, filterValue: ''}
                });
            },

            addGroup() {
                this.conditions.push({
                    operation: 'AND',
                    condition: [{operation: 'AND', condition: {filter: null, filterValue: ''}}]
                });
            },
        },

        computed: {}
    }
</script>

<style scoped>

</style>
