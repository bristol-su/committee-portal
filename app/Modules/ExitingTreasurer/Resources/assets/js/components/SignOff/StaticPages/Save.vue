<template>
    <div class="container" style="text-align: left; line-height: 1.6em">
        <br/>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <tr>
                        <td>Unauthorized Expense Claims for deletion</td>
                        <td>
                            <div v-if="submission.has_unauthorized_expense_claims === true && submission.unauthorized_expense_claim.length > 0">
                                <span style="display: block;" v-for="claim in submission.unauthorized_expense_claim">
                                    {{claim.pqu_number}}
                                </span>
                            </div>
                            <div v-else-if="submission.has_unauthorized_expense_claims === false">
                                No Expense Claims
                            </div>
                            <span v-else>
                                This section is not complete
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Outstanding Invoices</td>
                        <td>
                            <div v-if="submission.has_outstanding_invoices === true && submission.outstanding_invoice.length > 0">
                                <span style="display: block;" v-for="invoice in submission.outstanding_invoice">
                                    {{invoice.title}}
                                </span>
                            </div>
                            <div v-else-if="submission.has_outstanding_invoices === false">
                                No invoices
                            </div>
                            <span v-else>
                                This section is not complete
                            </span>
                        </td>

                    </tr>
                    <tr>
                        <td>Missing Income and Expenditure</td>
                        <td>

                            <div v-if="submission.has_missing_income_and_expenditure === true && submission.missing_income_and_expenditure !== null">
                                <span style="display: block;">
                                    {{submission.missing_income_and_expenditure.note}}
                                </span>
                            </div>
                            <div v-else-if="submission.has_missing_income_and_expenditure === false">
                                No missing income or expenditure
                            </div>
                            <span v-else>
                                This section is not complete
                            </span>

                        </td>
                    </tr>
                    <tr>
                        <td>Corrections</td>
                        <td>

                            <div v-if="submission.has_corrections === true && submission.correction !== null">
                                <span style="display: block;">
                                    {{submission.correction.note}}
                                </span>
                            </div>
                            <div v-else-if="submission.has_corrections === false">
                                No corrections
                            </div>
                            <span v-else>
                                This section is not complete
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-12">
                <div class="form-check">
                    <input v-model="confirmed" class="form-check-input" id="confirmation"
                           type="checkbox">
                    <label class="form-check-label" for="confirmation">Tick here to confirm that, other than the corrections you have notified us of above, your groups balance as shown on the Financial Summary and Transaction list is correct</label>
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-info btn-lg" style="width: 100%; margin: auto;" @click="complete">
                    Complete your sign-off
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            submission: {
                required: true,
                type: Object,
            }
        },

        data() {
            return {
                confirmed: false
            }
        },

        methods: {
            complete() {
                if(this.confirmed) {
                    this.$emit('save');
                } else {
                    this.$notify.alert('Please confirm the statement before submitting');
                }
            }
        }
    }
</script>

<style scoped>

</style>