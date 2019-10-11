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
        },

        data() {
            return {
                active: null,
                visible: null,
                mandatory: null,
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
        },

    }
</script>

<style scoped>

</style>
