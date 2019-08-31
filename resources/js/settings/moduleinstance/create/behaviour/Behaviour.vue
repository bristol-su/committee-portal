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
        <b-form-group label="Mandatory for?">
            <logic-select :for-logic="forLogic" v-model="mandatory">

            </logic-select>
        </b-form-group>
        <b-form-group label="Complete on?">
            <b-form-select v-model="complete" :options="completionOptions"></b-form-select>
        </b-form-group>
    </div>
</template>

<script>
    import LogicSelect from "./LogicSelect";
    export default {
        name: "Behaviour",
        components: {LogicSelect},

        props: {
            forLogic: {
                required: true,
                type: String
            },
            completion: {
                required: false,
                default: function() {
                    return [];
                }
            }
        },

        data() {
            return {
                active: null,
                visible: null,
                mandatory: null,
                complete: ''
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
            complete() {
                this.$emit('update', 'complete', this.complete);
            },
        },

        computed: {
            completionOptions() {
                return this.completion.map(option => {
                    return {
                        value: option.event,
                        text: option.name + ' (' + option.description + ')'
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>
