<template>
    <div>
        <b-form-group label="Active for?">
            <logic-select v-model="active">

            </logic-select>
        </b-form-group>
        <b-form-group label="Visible for?">
            <logic-select v-model="visible">

            </logic-select>
        </b-form-group>
        <b-form-group label="Mandatory for?">
            <logic-select v-model="mandatory">

            </logic-select>
        </b-form-group>
        Complete
    </div>
</template>

<script>
    import LogicSelect from "./LogicSelect";
    export default {
        name: "Behaviour",
        components: {LogicSelect},

        data() {
            return {
                active: null,
                visible: null,
                mandatory: null
            }
        }
    }
</script>

<style scoped>

</style>
