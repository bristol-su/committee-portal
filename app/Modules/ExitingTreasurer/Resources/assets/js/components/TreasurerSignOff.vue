<template>
    <div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <button
                            @click="newSubmission"
                            class="btn btn-info"
                            v-if="this.submission !== null">New Submission
                    </button>
                </div>
            </div>
        </div>

        <div class="container">
            <submissions
                    :submissions="submissions">

            </submissions>
        </div>
        <!--        <modal height="auto" name="exitingtreasurer-new-submission">-->

        <div class="container" v-if="submissionForm">
            <br/>
            <br/>
            <hr/>
            <div class="row">
                <div class="col-md-12">
                    <unauthorized-expense-claims
                            @payloadUpdated="updateExpenseClaims">

                    </unauthorized-expense-claims>
                </div>
            </div>

            <br/>
            <br/>
            <hr/>
            <div class="row">
                <div class="col-md-12">
                    <outstanding-invoices
                            @payloadUpdated="updateOutstandingInvoices">

                    </outstanding-invoices>
                </div>
            </div>

            <br/>
            <br/>
            <hr/>
            <div class="row">
                <div class="col-md-12" style="width: 100%">
                    <missing-income-and-expenditures
                            @payloadUpdated="updateMissingIAndE">


                    </missing-income-and-expenditures>
                </div>
            </div>

            <br/>
            <br/>
            <hr/>
            <div class="row">
                <div class="col-md-12" style="width: 100%">
                    <corrections
                            @payloadUpdated="updateCorrections">

                    </corrections>
                </div>
            </div>

            <br/>
            <br/>
            <hr/>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="confirm"> Do you confirm that, other than the corrections that you have notified
                            us
                            of
                            above, that the student group balance as shown on the Income and Expenditure Analysis
                            Report
                            and
                            Transaction list is correct?</label>
                        <input id="confirm" type="checkbox" v-model="confirmed">

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <button @click="submit" class="btn btn-info">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <!--        </modal>-->


    </div>
</template>

<script>
    import UnauthorizedExpenseClaims from './SignOff/UnauthorizedExpenseClaim/UnauthorizedExpenseClaims';
    import OutstandingInvoices from './SignOff/OutstandingInvoice/OutstandingInvoices';
    import MissingIncomeAndExpenditures from './SignOff/MissingIncomeAndExpenditure/MissingIncomeAndExpenditures';
    import Corrections from './SignOff/Correction/Corrections';
    import Submissions from './ViewSubmissions/Submissions';

    export default {
        components: {
            UnauthorizedExpenseClaims,
            OutstandingInvoices,
            MissingIncomeAndExpenditures,
            Corrections,
            Submissions
        },

        data() {
            return {
                confirmed: false,
                form: new VueForm({
                    unauthorized_expense_claims: {},
                    outstanding_invoices: {},
                    missing_i_and_e: {},
                    corrections: {}
                }),
                submissions: [],
                // New Submissions
                submission: null
            }
        },

        created() {
            this.form.shouldReset = false;
            this.$http.get('/exitingtreasurer/complete')
                .then(response => {
                    this.submissions = response.data;
                    if (response.data.length > 0) {
                        this.submission = response.data[0];
                    }
                })
                .catch(error => {
                });
        },

        methods: {
            submit() {
                if (this.confirmed === true) {
                    this.form.post('/exitingtreasurer')
                        .then(response => {
                            this.submissions.push(response);
                            this.submission = response;
                        })
                        .catch(error => this.$notify.alert('Error submitting the form: ' + error.message))
                } else {
                    this.$notify.alert('Please confirm this information is complete');
                }
            },

            updateExpenseClaims(val) {
                this.form.unauthorized_expense_claims = val;
            },

            updateOutstandingInvoices(val) {
                this.form.outstanding_invoices = val;
            },

            updateMissingIAndE(val) {
                this.form.missing_i_and_e = val;
            },

            updateCorrections(val) {
                this.form.corrections = val;
            },

            newSubmission() {
                this.form.reset();
                this.submission = null;
                // this.$modal.show('exitingtreasurer-new-submission');
            }
        },

        computed: {
            viewRecords() {
                return this.submissions.length > 0;
            },

            submissionForm() {
                return this.submission === null;
            }
        }
    }
</script>

<style>

</style>