<template>
    <div>
        <b-table :fields="fields" :items="connections" responsive="sm" striped>
            <template v-slot:cell(name)="row">
                <div @click="row.toggleDetails" class="fill-parent">
                    <i :class="{'fa-caret-right': !row.detailsShowing, 'fa-caret-down': row.detailsShowing}"
                       class="fa"></i>
                    {{row.item.name}}
                </div>
            </template>

            <template v-slot:cell(user_id)="row">
                <div @click="row.toggleDetails" class="fill-parent">
                    {{row.item.user_id}}
                </div>
            </template>

            <template v-slot:cell(actions)="row">
                <div class="fill-parent">
                    <b-button :variant="testVariant(row.item.id)" @click="testConnection(row.item.id)" size="sm">
                        <i :class="testIcon(row.item.id)"
                           class="fa"></i>
                        Test
                    </b-button>
                    <b-button @click="editConnection(row.item)" size="sm" variant="outline-secondary">Edit</b-button>
                    <b-button @click="deleteConnection(row.item.id)" size="sm" variant="outline-danger">Delete
                    </b-button>
                </div>
            </template>

            <template v-slot:row-details="row">
                <connection-details :connection="row.item">

                </connection-details>
            </template>
        </b-table>

        <b-modal id="edit-connection-modal" v-if="editingConnection !== null" :title="'Editing connection ' + editingConnection.name">
            <edit-connection :connector="connector" :connection="editingConnection"></edit-connection>
        </b-modal>
    </div>
</template>

<script>
    import ConnectionDetails from './ConnectionDetails';
    import EditConnection from '../create/EditConnection';

    export default {
        name: "ConnectionsTable",
        components: {EditConnection, ConnectionDetails},
        props: {
            connections: {
                required: true,
                type: Array
            },
            connector: {
                required: true,
                type: Object
            }
        },

        data() {
            return {
                fields: [
                    {key: 'name', label: 'name'},
                    {key: 'user_id', label: 'Created By'},
                    {key: 'actions', label: 'Actions'},
                ],
                testedTrue: [],
                testedFalse: [],
                editingConnection: null
            }
        },

        methods: {
            deleteConnection(id) {
                this.$bvModal.msgBoxConfirm('Are you sure you want to delete this connection?', {
                    title: 'Deleting connection',
                    size: 'sm',
                    buttonSize: 'sm',
                    okVariant: 'danger',
                    okTitle: 'Delete',
                    cancelTitle: 'Cancel',
                    footerClass: 'p-2',
                    hideHeaderClose: true,
                    centered: true
                })
                    .then(confirmed => {
                        if(confirmed) {
                            this.$api.connection().delete(id)
                                .then(response => window.location.reload())
                                .catch(error => this.$notify.alert('Could not delete the connection: ' + error.message));
                        } else {
                            this.$notify.warning('Connection not deleted');
                        }
                    })

            },

            editConnection(connection) {
                this.editingConnection = connection;
                this.$nextTick(() => this.$bvModal.show('edit-connection-modal'));
            },

            testConnection(id) {
                this.$api.connection().test(id)
                    .then(response => {
                        if (response.data.result === true) {
                            this.testedTrue.push(id);
                            if (this.testedFalse.indexOf(id) !== -1) {
                                this.testedFalse.splice(this.testedFalse.indexOf(id), 1);
                            }
                        } else if (response.data.result === false) {
                            this.testedFalse.push(id);
                            if (this.testedTrue.indexOf(id) !== -1) {
                                this.testedTrue.splice(this.testedTrue.indexOf(id), 1);
                            }
                        }
                    })
                    .catch(error => this.$notify.alert('Testing could not be completed: ' + error.message));
            },

            testVariant(id) {
                if (this.testedTrue.indexOf(id) !== -1) {
                    return 'outline-success';
                } else if (this.testedFalse.indexOf(id) !== -1) {
                    return 'outline-danger';
                } else {
                    return 'outline-info';
                }
            },
            testIcon(id) {
                if (this.testedTrue.indexOf(id) !== -1) {
                    return 'fa-check';
                } else if (this.testedFalse.indexOf(id) !== -1) {
                    return 'fa-times';
                } else {
                    return 'fa-question';
                }
            }
        }

    }
</script>

<style scoped>
    .fill-parent {
        margin: 0;
        width: 100%;
        height: 100%;
    }
</style>
