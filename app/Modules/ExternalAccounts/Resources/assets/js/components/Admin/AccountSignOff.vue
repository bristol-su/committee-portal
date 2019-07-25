<template>
    <div>
        <p><strong>Account Name:</strong> {{account.account_name}}</p>
        <p><strong>Account Number:</strong> {{account.account_number}}</p>
        <p><strong>Bank Name:</strong> {{account.bank_name}}</p>
        <p><strong>Sort Code:</strong> {{account.sort_code}}</p>
        <p><strong>Purpose:</strong> {{purpose}}</p>
        <p>
            <strong>Statements: </strong>
        </p>
        <ul>
            <li v-for=" statement in account.end_of_year_statements">
                <a :href="documentUrl(statement.statement.id)">
                    {{statement.statement.filename}} ({{statement.statement.created_at}})
                </a>
            </li>
        </ul>
        <div v-if="account.closure_id !== null">
            <p>
                <strong>Closure Information:</strong>
            </p>
            <ul>
                <li v-if="account.closure !== null">
                    <a :href="documentUrl(account.closure.final_bank_statement)">Final Bank Statement</a>
                </li>
                <li v-if="account.closure !== null">
                    <a :href="documentUrl(account.closure.confirmation_of_closure)">Confirmation of Closure</a>
                </li>
            </ul>
        </div>

    </div>
</template>

<script>
    export default {
        name: "AccountSignOff",
        props: {
            account: {
                required: true,
                type: Object
            }
        },

        computed: {
            purpose() {
                if (this.account.purpose === null) {
                    return 'No purpose given';
                }
                return this.account.purpose;
            }
        },

        methods: {
            documentUrl(id) {
                return '/admin/externalaccounts/document/' + id;
            },

        }
    }
</script>

<style scoped>

</style>