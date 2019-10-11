<template>
    <div>
        <b-row v-for="field in fields" :key="field.value">
            <b-col>
                <field-mapping
                :field="field"
                :event-fields="actionInstance.event_fields"
                :action-instance-id="actionInstance.id">

                </field-mapping>
            </b-col>
        </b-row>
    </div>

</template>

<script>
    import FieldMapping from './FieldMapping';

    export default {
        name: "MapFields",

        components: {
            FieldMapping
        },

        props: {
            actionInstance: {
                required: true,
                type: Object
            }
        },

        methods: {},

        computed: {
            fields() {
                return Object.keys(this.actionInstance.action_fields).map(key => {
                    let field = this.actionInstance.action_fields[key];
                    return {
                        label: field.label,
                        value: key,
                        helptext: field.helptext
                    }
                })
            },
        }
    }
</script>

<style scoped>

</style>
