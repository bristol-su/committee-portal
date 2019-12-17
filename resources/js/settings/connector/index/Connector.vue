<template>
    <div class="align-left">
        <b-card :title="connector.name" :sub-title="subtitle">
            <b-row>
                <b-col>
                    <b-card-text>
                        {{connector.description}}
                    </b-card-text>
                </b-col>
                <b-col>
                    <b-card-text style="text-align: right;">
                        <b-button variant="outline-success" size="md" @click="addConnection"><i class="fa fa-plus"></i> Add new</b-button>
                    </b-card-text>
                </b-col>
            </b-row>
            <b-row>
                <b-col>
                    <connections-table
                        :connections="connector.connections"
                        :connector="connector"></connections-table>
                </b-col>
            </b-row>

        </b-card>

        <b-modal :id="'new-connection-modal-' + connector.alias" :title="'New ' + connector.name + ' connection'">
            <new-connection
                :connector="connector">

            </new-connection>
        </b-modal>
    </div>
</template>

<script>
    import ConnectionsTable from './ConnectionsTable';
    import NewConnection from '../create/NewConnection';
    export default {
        name: "Connector",
        components: {NewConnection, ConnectionsTable},
        props: {
            connector: {
                required: true,
                type: Object
            }
        },

        data() {
            return {}
        },

        methods: {
            addConnection() {
                this.$bvModal.show('new-connection-modal-' + this.connector.alias);
            }
        },

        computed: {
            subtitle() {
                return this.connector.connections.length + ' connections available';
            },
        }
    }
</script>

<style scoped>
    .align-left {
        text-align: left;
    }
</style>
