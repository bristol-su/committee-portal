<template>
    <div>
        <b-form-group
            :id="'group-' + service"
            :label="service"
            :label-for="service"
            description="Select a connection or create a new one"
            v-if="!loading"
            >

            <b-form-select :options="connectionOptions" @input="saveService" :value="value"></b-form-select>
        </b-form-group>
        <div v-else>Loading...</div>
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
            assignedServices: {
                type: Array,
                required: false,
                default() {
                    return [];
                }
            },
            moduleInstanceId: {
                required: true,
                type: Number
            }
        },

        data() {
            return {
                connections: [],
                connectionsLoading: true
            }
        },

        created() {
            this.loadConnections();
        },

        methods: {
            loadConnections() {
                this.connectionsLoading = true;
                this.$api.connection().allForService(this.service)
                    .then(response => this.connections = response.data)
                    .catch(error => this.$notify.alert('Could not load connections for ' + this.service + ': ' + error.message))
                    .then(() => this.connectionsLoading = false);
            },

            saveService(connectionId) {
                if (this.hasCurrentConnection) {
                    this.updateService(connectionId);
                } else {
                    this.createService(connectionId);
                }
            },

            updateService(connectionId) {
                this.$api.moduleInstanceServices().update(this.currentConnection.id, connectionId)
                    .then(response => {
                        this.$notify.success('Updated service connection');
                        this.$emit('updated', response.data);
                    })
                    .catch(error => this.$notify.alert('Could not update the service: ' + error.message));
            },

            createService(connectionId) {
                this.$api.moduleInstanceServices().create(this.service, connectionId, this.moduleInstanceId)
                    .then(response => {
                        this.$notify.success('Created service connection');
                        this.$emit('created', response.data);
                    })
                    .catch(error => this.$notify.alert('Could not create the service: ' + error.message));
            }
        },

        computed: {
            connectionOptions() {
                return this.connections.map(connection => {
                    return {text: connection.name, value: connection.id}
                })
            },
            currentConnection() {
                let services = this.assignedServices.filter(assignment => true);
                if(services.length > 0) {
                    return services[0];
                }
                return null;
            },
            hasCurrentConnection() {
                return this.currentConnection !== null;
            },
            value() {
                if(this.hasCurrentConnection) {
                    return this.currentConnection.connection_id;
                }
                return null;
            },
            loading() {
                return this.connectionsLoading;
            }
        },
    }
</script>

<style scoped>

</style>
