<template>

    <div>

        <table class="table table-hover table-striped" v-if="accounts.length > 0">
            <thead>
            <tr>
                <th>Account ID</th>
                <th>Sort Code</th>
                <th>Account Number</th>
                <th>Bank Name</th>
                <th>Account Name</th>
<!--                <th>Account Purpose</th>-->
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="account in accounts">
                <td>{{account.id}}</td>
                <td>{{account.sort_code}}</td>
                <td>{{account.account_number}}</td>
                <td>{{account.bank_name}}</td>
                <td>{{account.account_name}}</td>
<!--                <td>{{account.purpose}}</td>-->
                <td v-if="account.closure_id === null">
                    <button class="btn btn-sm btn-danger" @click="$emit('closeAccount', account)">Close Account</button>
                    <div v-if="account.end_of_year_statements.length === 0">
                        <button class="btn btn-sm btn-info" @click="$emit('eoyAccount', account)">Year End Statement</button>
                    </div>
                    <div v-else>
                        End of Year Statement Submitted
                    </div>
                </td>
                <td v-else>
                    Account Closed
                </td>

            </tr>
            </tbody>
        </table>


    </div>

</template>

<script>
    export default {
        name: "ExternalAccountsTable",

        props: {
            accounts: {
                required: true
            }
        },

    }
</script>

<style scoped>

</style>