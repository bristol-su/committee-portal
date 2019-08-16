<template>
    <div>

        <b-container fluid>


            <!-- Main table element -->
            <b-table
                    show-empty
                    stacked="md"
                    :items="submissions"
                    :fields="fields"
            >

                <template slot="fullname" slot-scope="row">
                    {{row.item.user.forename}} {{row.item.user.surname}}
                </template>

                <template slot="signoff" slot-scope="row">
                    <b-button size="sm" @click="showSignOffModal(row.item, row.index, $event.target)">
                        Show Sign-Off
                    </b-button>
                </template>


            </b-table>

            <!-- Info modal -->
            <b-modal :id="signOffModal.id" :title="signOffModal.title" ok-only @hide="resetSignOffModal">
                <single-submission
                :submission="signOffModal.submission">

                </single-submission>
            </b-modal>
        </b-container>

    </div>
</template>

<script>
    import SingleSubmission from "./SingleSubmission";
    export default {
        name: "ExternalAccountsAdmin",
        components: {SingleSubmission},
        props: {
            submissions: {
                required: true,
                type: Array
            }
        },

        data() {
            return {
                fields: [
                    {
                        key: 'group.name',
                        label: 'Group',
                        sortable: true
                    },
                    {
                        key: 'fullname',
                        label: 'Name',
                        sortable: true
                    },
                    {
                        key: 'position.name',
                        label: 'Position',
                        sortable: true
                    },
                    {
                        key: 'year',
                        label: 'Submission Year',
                        sortable: true
                    },
                    {
                        key: 'signoff',
                        label: 'Sign Off'
                    }
                ],
                signOffModal: {
                    id: 'info-modal',
                    title: 'Some Title',
                    submission: {}
                }
            }
        },

        methods: {

            resetSignOffModal() {
                this.signOffModal.title = '';
                this.signOffModal.submission = {};
            },

            showSignOffModal(item, index, button) {
                this.signOffModal.title = item.group.name + ' Sign Off';
                this.signOffModal.submission = item;
                this.$root.$emit('bv::show::modal', this.signOffModal.id);
            }
        },

    }
</script>

<style scoped>

</style>