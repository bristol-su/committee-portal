<template>
    <div>

        <b-container fluid>


            <!-- Main table element -->
            <b-table
                    show-empty
                    stacked="md"
                    :items="accounts"
                    :fields="fields"
            >

                <template slot="account" slot-scope="row">
                    <b-button size="sm" :variant="(row.item.closure_id === null?'secondary':'danger')" @click="showAccountModal(row.item, row.index, $event.target)">
                        Show {{(row.item.closure_id === null?'':'Closed ')}}Account
                    </b-button>
                </template>

            </b-table>

            <!-- Info modal -->
            <b-modal :id="accountModal.id" :title="accountModal.title" ok-only @hide="resetAccountModal">
                <account-sign-off
                    :account="accountModal.account">

                </account-sign-off>
            </b-modal>
        </b-container>

    </div>
</template>

<script>
    import AccountSignOff from "./AccountSignOff";
    export default {
        name: "ExternalAccountsAdmin",
        components: {AccountSignOff},
        props: {
            accounts: {
                required: true,
                type: Array
            }
        },

        data() {
            return {
                fields: [
                    {
                        key: 'account_name',
                        label: 'Account Name',
                        sortable: true
                    },
                    {
                        key: 'account_number',
                        label: 'Account Number',
                        sortable: true
                    },
                    {
                        key: 'bank_name',
                        label: 'Bank Name',
                        sortable: true
                    },
                    {
                        key: 'sort_code',
                        label: 'Sort Code',
                        sortable: true
                    },
                    {
                        key: 'account',
                        label: 'Account'
                    },
                ],
                accountModal: {
                    id: 'info-modal',
                    title: 'Some Title',
                    account: {}
                }
            }
        },

        methods: {

            resetAccountModal() {
                this.accountModal.title = '';
                this.accountModal.account = {};
            },

            showAccountModal(item, index, button) {
                this.accountModal.title = item.account_name + ' Account';
                this.accountModal.account = item;
                if(this.accountModal.account.closure_id !== null) {
                    this.accountModal.title += ' (closed)';
                }
                this.$root.$emit('bv::show::modal', this.accountModal.id);
            }
        },

    }
</script>

<style scoped>

</style>