<template>
    <div>
        <div v-if="loading">
            Loading...
        </div>
        <div v-else>
            <connector
                v-for="connector in connectorsWithConnections"
                :key="connector.alias"
                :connector="connector">

            </connector>
        </div>
    </div>
</template>

<script>
    import Connector from './Connector';
    export default {
        name: "Index",
        components: {Connector},
        props: {},

        data() {
            return {
                connections: [],
                connectors: [],
                loadingConnectors: false,
                loadingConnections: false
            }
        },

        created() {
            this.loadConnectors();
            this.loadConnections();
        },

        methods: {
            loadConnectors() {
                this.loadConnectors = true;
                this.$api.connector().index()
                    .then(response => this.connectors = response.data)
                    .catch(error => this.$notify.alert('Could not load connectors'))
                    .then(this.loadConnectors = false);
            },

            loadConnections() {
                this.loadConnections = true;
                this.$api.connection().index()
                    .then(response => this.connections = response.data)
                    .catch(error => this.$notify.alert('Could not load connections'))
                    .then(this.loadConnections = false);
            }
        },

        computed: {
            connectorsWithConnections() {
                return this.connectors.map(connector => {
                    this.$set(connector, 'connections', this.connections.filter(connection => connection.alias === connector.alias));
                    return connector;
                })
            },
            loading() {
                return this.loadingConnectors && this.loadingConnections
            }
        }
    }
</script>

<style scoped>

</style>
