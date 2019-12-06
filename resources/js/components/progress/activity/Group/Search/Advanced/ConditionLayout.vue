<template>
    <div>
        <draggable :group="{ name: 'condition-group' }" :list="value" class="dragArea" tag="div">
            <p :key="el.order" v-for="(el, order) in value">
                <operator-node :value="el.operation" @input="updateChildOperator(el, $event)" v-if="order !== 0"></operator-node>
                <condition-layout v-if="isArray(el.condition)" :value="el.condition" ref="childNode"></condition-layout>
                <condition-node @input="updateChildCondition(el, $event)" v-else :condition="el.condition" ref="childNode"></condition-node>
            </p>
        </draggable>
    </div>
</template>

    <script>
        import draggable from "vuedraggable";
        import ConditionNode from './ConditionNode';
        import OperatorNode from './OperatorNode';

        export default {
            name: "ConditionLayout",

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
                updateChildOperator(el, operation) {
                    let newValue = this.value;
                    newValue[this.value.indexOf(el)].operation = operation;
                    this.$emit('input', newValue);
                },

                updateChildCondition(el, childConditions) {
                    let newValue = this.value;
                    newValue[this.value.indexOf(el)].condition = childConditions;
                    this.$emit('input', newValue);
                },

                evaluate(progress) {
                    let result = true;
                    for (let i = 0; i < this.value.length; i++) {
                        let childResult = this.$refs.childNode[i].evaluate(progress);
                        let operation = this.value[i].operation;
                        if (i === 0) {
                            result = childResult;
                        } else if (operation === 'OR') {
                            result = (result || childResult);
                        } else if (operation === 'AND') {
                            result = (result && childResult);
                        } else {
                            console.error('Operation must be OR or AND');
                        }
                    }

                    return result;
                }
            },

            computed: {}
        }
    </script>

    <style scoped>
        .dragArea {
            min-height: 50px;
            outline: 1px solid;
            padding: 15px;
        }
    </style>
