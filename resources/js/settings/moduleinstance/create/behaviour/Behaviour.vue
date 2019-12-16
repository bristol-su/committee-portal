<template>
    <div>
        <b-form-group label="Active for?">
            <logic-select :for-logic="forLogic" v-model="active">

            </logic-select>
        </b-form-group>
        <b-form-group label="Visible for?">
            <logic-select :for-logic="forLogic" v-model="visible">

            </logic-select>
        </b-form-group>
        <b-form-group v-if="isCompletable" label="Mandatory for?">
            <logic-select :for-logic="forLogic" v-model="mandatory">

            </logic-select>
        </b-form-group>
        <b-form-group v-if="isCompletable" label="Mark as complete when">
            <completion-condition
                :completion-conditions="completionConditions"
                v-model="completionConditionInstanceId">

            </completion-condition>
        </b-form-group>

        <b-button @click="$emit('createModuleInstance')">Create Module Instance</b-button>
    </div>
</template>

<script>
    import LogicSelect from "./LogicSelect";
    import CompletionCondition from './CompletionCondition';
    export default {
        name: "Behaviour",
        components: {CompletionCondition, LogicSelect},

        props: {
            forLogic: {
                required: true,
                type: String
            },
            completionConditions: {
                required: true,
                type: Array,
                default: function() {
                    return [];
                }
            },
            activity: {
                required: true,
                type: Object
            }
        },

        data() {
            return {
                active: null,
                visible: null,
                mandatory: null,
                completionConditionInstanceId: null
            }
        },

        watch: {
            active() {
                this.$emit('update', 'active', this.active);
            },
            visible() {
                this.$emit('update', 'visible', this.visible);
            },
            mandatory() {
                this.$emit('update', 'mandatory', this.mandatory);
            },
            completionConditionInstanceId() {
                this.$emit('update', 'completion_condition_instance_id', this.completionConditionInstanceId)
            }
        },

        computed: {
            isCompletable() {
                return this.activity.type === 'completable' || this.activity.type === 'multi-completable'
            }
        }

    }
</script>

<style scoped>

</style>
