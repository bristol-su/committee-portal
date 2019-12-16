<template>
    <div>
        <b-form-group
            :id="'group-' + service"
            :label="service"
            :label-for="service"
            description="Select a connection or create a new one"
            >

            <b-form-select :options="connectionOptions" @input="assignService" :value="value"></b-form-select>
        </b-form-group>
    </div>
</template>

<script>
    export default {
        name: "ServiceSelect",

        props: {
            service: {
                type: String,
                required: true
            },
            connections: {
                required: false,
                default: function() {
                    return [];
                },
                type: Array
            },
            value: {
                required: false,
                type: Number,
                default: null
            }
        },

        data() {
            return {}
        },

        methods: {
            assignService(id) {
                let attributes = {
                    service: ''
                };
                if(this.moduleInstanceServiceId !== null) {
                    this.$api.moduleInstanceServices().update(this.moduleInstanceServiceId)
                } else {
                    this.$api.moduleInstanceServices().create()
                }
            }
        },

        computed: {
            connectionOptions() {
                if(this.connections.length === 0) {
                    return [];
                }
                return this.connections.map(connection => {
                    return {value: connection.id, text: connection.name}
                })
            },
            moduleInstanceServiceId() {
                return this.value;
            }
        },
    }
</script>

<style scoped>

</style>
