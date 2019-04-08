<template>
    <div class="container" style="width: 100%; height: 100%">
        <div class="row" style="height: 100%">
            <div class="col-md-12" style="height: 100%">
                <div class="card" style="height: 100%">
                    <div class="card-header">
                        <h3 class="card-title">{{content.header}}</h3>
                        <h5 class="card-subtitle mb-2 text-muted" style="text-align: left;">{{content.subtitle}}</h5>

                    </div>
                    <div class="card-body">

                        <div class="card-text" v-show="content.id === 'intro'">
                            <intro>

                            </intro>
                        </div>
                        <div class="card-text" v-show="content.id === 'unauthorized-expense-claim'">
                            <unauthorized-expense-claims
                                    @payloadUpdated="updateExpenseClaims"
                                    :initial-payload="form.unauthorized_expense_claims">
                            </unauthorized-expense-claims>
                        </div>
                        <div class="card-text" v-show="content.id === 'outstanding-invoice'">
                            <outstanding-invoices
                                    @payloadUpdated="updateOutstandingInvoices"
                            :initial-payload="form.outstanding_invoices">

                            </outstanding-invoices>
                        </div>
                        <div class="card-text" v-show="content.id === 'missing-income-and-expenditure'">
                            <missing-income-and-expenditures
                                    @payloadUpdated="updateMissingIAndE"
                                    :initial-payload="form.missing_i_and_e">
                            </missing-income-and-expenditures>
                        </div>
                        <div class="card-text" v-show="content.id === 'correction'">
                            <corrections
                                    @payloadUpdated="updateCorrections"
                                    :initial-payload="form.missing_i_and_e">

                            </corrections>
                        </div>
                        <div class="card-text" v-show="content.id === 'confirmation'">
                            <confirmation>

                            </confirmation>
                        </div>
                        <div class="card-text" v-show="content.id === 'save'">
                            <save>

                            </save>
                        </div>

                    </div>
                    <div class="card-footer">
                        <div>
                            <button @click="saveBack" class="btn btn-info btn-lg" style="float: left;">
                                <span aria-hidden="true">&larr;</span>Save & Back
                            </button>
                            <button @click="submit" class="btn btn-success btn-lg">
                                Save
                            </button>
                            <button @click="saveForward" class="btn btn-info btn-lg" style="float: right;">
                                Save & Next<span aria-hidden="true">&rarr;</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>







        <!--        <div class="row">-->
        <!--            <div class="col-md-12">-->
        <!--                <div class="form-group">-->
        <!--                    <label for="confirm"> Do you confirm that, other than the corrections that you have notified us of-->
        <!--                        above, that the student group balance as shown on the Income and Expenditure Analysis-->
        <!--                        Report and Transaction list is correct?</label>-->
        <!--                    <input id="confirm" type="checkbox" v-model="confirmed">-->

        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->

        <!--        <div class="row">-->
        <!--            <div class="col-md-12">-->
        <!--                <div class="form-group">-->
        <!--                    <button @click="submit" class="btn btn-info">Submit</button>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
    </div>
</template>

<script>
    import Intro from './StaticPages/Intro';
    import UnauthorizedExpenseClaims from './UnauthorizedExpenseClaim/UnauthorizedExpenseClaims';
    import OutstandingInvoices from './OutstandingInvoice/OutstandingInvoices';
    import MissingIncomeAndExpenditures from './MissingIncomeAndExpenditure/MissingIncomeAndExpenditures';
    import Corrections from './Correction/Corrections';
    import Confirmation from './StaticPages/Confirmation';
    import Save from './StaticPages/Save';

    export default {
        components: {
            Intro,
            UnauthorizedExpenseClaims,
            OutstandingInvoices,
            MissingIncomeAndExpenditures,
            Corrections,
            Confirmation,
            Save
        },

        props: {
            currentSubmission: {
                required: false,
                default: null
            }
        },

        data() {
            return {
                confirmed: false,
                form: {},
                submission: null,
                layout: [
                    {
                        id: 'intro',
                        header: 'Treasurer Sign-Off',
                        subtitle: ''
                    },
                    {
                        id: 'unauthorized-expense-claim',
                        header: 'Unauthorized Expense Claims',
                        subtitle: 'If there are any unauthorised expense claims (have a reference number beginning PQU' +
                            ' and  marked at the end of the line with an asterisk) showing on the transaction list that ' +
                            'will never be authorised because there was a problem with them please let us know, so ' +
                            'we can delete them. If there are any outstanding claims on the App which you haven’t ' +
                            'authorised yet, please authorised them.',

                    },
                    {
                        id: 'outstanding-invoice',
                        header: 'Outstanding Invoices',
                        subtitle: 'Are there any outstanding invoices that you are aware of that are not on the reports? Perhaps invoices that you are disputing with a supplier, or which your group hasn’t had the funds to pay?'
                    },
                    {
                        id: 'missing-income-and-expenditure',
                        header: 'Missing Income & Expenditure',
                        subtitle: 'Is there any other income or expenditure missing from the reports?'
                    },
                    {
                        id: 'correction',
                        header: 'Corrections',
                        subtitle: 'Other than those you have recorded earlier in the sign off, are there any other corrections that need to be made?'
                    },
                    {
                        id: 'confirmation',
                        header: 'Confirmation',
                        subtitle: ''
                    },
                    {
                        id: 'save',
                        header: 'Save & Exit',
                        subtitle: ''
                    },
                ],
                iteration: 0,
            }
        },

        created() {
            this.submission = this.currentSubmission;
            if(this.currentSubmission === null) {
                this.form = new VueForm({
                    unauthorized_expense_claims: {
                        present: null,
                        data: []
                    },
                    outstanding_invoices: {
                        present: null,
                        data: []
                    },
                    missing_i_and_e: {
                        present: null,
                        data: {
                            id: null
                        }
                    },
                    corrections: {
                        present: null,
                        data: {
                            id: null
                        }
                    }
                });
                this.create();
            } else {
                this.form = new VueForm({
                    unauthorized_expense_claims: {
                        present: this.submission.has_unauthorized_expense_claims,
                        data: this.submission.unauthorized_expense_claim.map(claim => claim.id)
                    },
                    outstanding_invoices: {
                        present: this.submission.has_outstanding_invoices,
                        data: this.submission.outstanding_invoice.map(invoice => invoice.id)
                    },
                    missing_i_and_e: {
                        present: this.submission.has_missing_income_and_expenditure,
                        data: this.submission.missing_income_and_expenditure
            },
                    corrections: {
                        present: this.submission.has_corrections,
                        data:this.submission.has_corrections
                    }
                })
            }
            this.form.shouldReset = false;

        },

        methods: {
            create() {
                this.$http.post('/exitingtreasurer')
                    .then(response => {
                        this.$emit('newSubmission', response);
                        this.submission = response;
                    })
                    .catch(error => this.$notify.alert('Error starting a sign-off : ' + error.message))
            },

            submit() {
                if (this.submission!== null) {
                    this.form.post('/exitingtreasurer/' + this.submission.id)
                        .then(response => {
                            this.submission = response;
                            this.$emit('newSubmission', response);
                            this.$notify.success('Submission saved');
                        })
                        .catch(error => this.$notify.alert('Error submitting the form: ' + error.message))
                } else {
                    this.$notify.alert('Could not save.');
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

            saveBack() {
                this.submit();
                this.move(-1);
            },

            saveForward() {
                this.submit();
                this.move(1);
            },

            move(step) {
                this.iteration += step;
                if(this.iteration < 0) {
                    this.iteration = this.layout.length - 1;
                }
                if(this.iteration === this.layout.length) {
                    this.iteration = 0;
                }
            }
        },

        computed: {
            content() {
                return this.layout[this.iteration];
            }
        }
    }
</script>

<style scoped>

</style>