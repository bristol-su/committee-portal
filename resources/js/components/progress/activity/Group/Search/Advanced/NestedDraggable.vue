<template>
    <draggable :group="{ name: 'condition-group' }" :list="orderedValues" :sort="true" class="dragArea" tag="div">
        <p :key="el.order" v-for="el in orderedValues">
            <operator-node :value="el.operation" @input="updateOperation(el, $event)" v-if="el.order !== 0"></operator-node>
            <nested-draggable v-if="isArray(el.condition)" :value="el.condition" @input="updateChildConditions(el, $event)" ref="childNode"></nested-draggable>
            <condition-node v-else :condition="el.condition" ref="childNode" @input="updateFilter(el, $event)"></condition-node>
        </p>
        <p>
            <b-button variant="light" @click="addCondition"><i class="fa fa-plus" ></i> Condition</b-button>
            <b-button variant="light" @click="addGroup"><i class="fa fa-plus" ></i> Group</b-button>
        </p>
    </draggable>
</template>

<script>
    import draggable from "vuedraggable";
    import ConditionNode from './ConditionNode';
    import OperatorNode from './OperatorNode';

    export default {
        name: "NestedDraggable",

        props: {
            value: {
                required: true,
                type: Array
            }
        },

        components: {
            OperatorNode,
            ConditionNode,
            draggable
        },

        data() {
            return {}
        },

        methods: {
            order(el) {
                return this.value.indexOf(el);
            },
            isArray(array) {
                return Array.isArray(array);
            },
            updateOperation(el, operation) {
                let newValue = this.value;
                newValue[this.value.indexOf(el)].operation = operation;
                this.$emit('input', newValue);
            },

            updateChildConditions(el, childConditions) {
                let newValue = this.value;
                newValue[this.value.indexOf(el)].condition = childConditions;
                this.$emit('input', newValue);
            },

            updateFilter(el, filter) {
                let newValue = this.value;
                newValue[this.value.indexOf(el)].condition = filter;
                this.$emit('input', newValue);
            },

            addCondition() {
                let newValue = this.value;
                newValue.push({
                    operation: 'AND',
                    condition: {filter: null, filterValue: ''}
                });
                this.$emit('input', newValue);
            },
            addGroup() {
                let newValue = this.value;
                newValue.push({
                    operation: 'AND',
                    condition: [{operation: 'AND', condition: {filter: null, filterValue: ''}}]
                });
                this.$emit('input', newValue);
            },
            evaluate(progress) {
                let result = true;
                for(let i=0; i<this.value.length; i++) {
                    let childResult = this.$refs.childNode[i].evaluate(progress);
                    let operation = this.value[i].operation;
                    if(i === 0) {
                        result = childResult;
                    } else if(operation === 'OR') {
                        result = result || childResult;
                    } else if(operation === 'AND') {
                        result = result && childResult;
                    } else {
                        console.error('Operation must be OR or AND');
                    }
                }
                return result;
            }
        },

        computed: {
            orderedValues() {
                return this.value.map(el => {
                    el.order = this.order(el);
                    return el;
                });
            }
        }
    }
</script>

<style scoped>
    .dragArea {
        min-height: 50px;
        outline: 1px solid;
        padding: 15px;
    }
</style>
