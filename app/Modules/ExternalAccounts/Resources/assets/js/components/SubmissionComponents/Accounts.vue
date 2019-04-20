<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <button @click="newAccountForm" class="btn btn-outline-info">
                    Add New Account
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <external-accounts-table
                        :accounts="accounts"
                        @closeAccount="closeAccountForm"
                        @eoyAccount="eoyAccountForm">

                </external-accounts-table>
            </div>
        </div>


        <!-- Modals-->

        <modal name="newAccountForm" height="auto">
            <new-account-form
                    @newAccount="addNewAccount"
            @close="$modal.hide('newAccountForm')">
            </new-account-form>
        </modal>
        <modal name="closeAccountForm"  height="auto"
        >
            <close-account-form
                :account="closeAccount"
                @accountClosed="updateAccount"
                @close="closeCloseAccountForm">

            </close-account-form>
        </modal>

        <modal name="eoyAccountForm" height="auto"
            >
            <eo-y-form
                :account="eoyAccount"
                @accountChanged="updateAccount"
                @close="closeEoYAccountForm">

            </eo-y-form>
        </modal>
    </div>
</template>

<script>
    import ExternalAccountsTable from "./AccountComponents/ExternalAccountsTable";
    import CloseAccountForm from "./AccountComponents/CloseAccountForm";
    import EoYForm from "./AccountComponents/EoYForm";
    import NewAccountForm from "./AccountComponents/NewAccountForm";

    export default {
        name: "Accounts",

        components: {
            EoYForm,
            CloseAccountForm,
            ExternalAccountsTable,
            NewAccountForm
        },

        data() {
            return {
                accounts: [],
                closeAccount: null,
                eoyAccount: null
            }
        },

        methods: {
            // New Account
            newAccountForm() {
                this.$modal.show('newAccountForm');
            },
            addNewAccount(account) {
                this.accounts.push(account);
            },

            // Close Account
            closeAccountForm(account) {
                this.closeAccount = account;
                this.$modal.show('closeAccountForm');
            },

            closeCloseAccountForm() {
                this.closeAccount = null;
                this.$modal.hide('closeAccountForm');
            },

            // End of Year Account
            eoyAccountForm(account) {
                this.eoyAccount = account;
                this.$modal.show('eoyAccountForm')
            },

            closeEoYAccountForm() {
                this.eoyAccount = null;
                this.$modal.hide('eoyAccountForm');
            },

            updateAccount(updatedAccount) {
                let accountsWithID = this.accounts.filter(account => account.id === updatedAccount.id);
                if (accountsWithID.length > 0) {
                    let index = this.accounts.indexOf(accountsWithID[0]);
                    this.accounts.splice(index, 1, updatedAccount);
                } else {
                    this.loadAccounts();
                }
            },

            // Accounts

            loadAccounts() {
                this.$http.get('/externalaccounts/account')
                    .then(response => this.accounts = response.data)
                    .catch(error => this.$notify.alert('Could not retrieve your groups accounts'));
            }
        },

        watch: {
            accounts(accounts) {
                this.$emit('input', accounts.map(account => account.id));
            }
        },

        created() {
            this.loadAccounts()
        }
    }
</script>

<style scoped>

</style>