<template>
    <b-card :sub-title="field.helptext" :title="field.label">
        <b-card-text>
            <b-form-select :options="eventOptions" v-model="mapping" class="mb-3">
                <template v-slot:cell(first)="data">
                    <option :value="null" disabled>-- Please select an option --</option>
                </template>
            </b-form-select>
        </b-card-text>
    </b-card>
</template>

<script>
    export default {
        name: "FieldMapping",

        props: {
            field: {
                required: true,
                type: Object
            },
            eventFields: {
                required: true,
                type: Object
            },
            actionInstanceId: {
                required: true
            }
        },

        data() {
            return {
                actionInstanceField: null,
                mapping: null
            }
        },

        watch: {
            mapping(val) {
                if(val !== null) {
                    this.save();
                }
            }
        },

        methods: {
            save() {
                let promise;
                if(this.actionInstanceField === null) {
                    promise = this.$api.actionInstanceField().create(this.formData);
                } else {
                        promise = this.$api.actionInstanceField().update(this.actionInstanceField.id, this.formData);
                }
                promise.then(response => this.actionInstanceField = response.data)
                    .catch(error => this.$notify.alert('Could not save the field mapping: ' + error.message));
            }
        },

        computed: {
            eventOptions() {
                return Object.keys(this.eventFields).map(key => {
                    return {text: this.eventFields[key].label, value: key}
                })
            },

            formData() {
                return {
                    action_instance_id: this.actionInstanceId,
                    event_field: this.mapping,
                    action_field: this.field.value
                }
            }
        },
    }
</script>

<style scoped>

</style>
