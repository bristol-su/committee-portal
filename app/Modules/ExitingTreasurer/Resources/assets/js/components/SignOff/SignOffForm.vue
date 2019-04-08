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
                                    :initial-payload="form.unauthorized_expense_claims"
                                    @payloadUpdated="updateExpenseClaims">
                            </unauthorized-expense-claims>
                        </div>
                        <div class="card-text" v-show="content.id === 'outstanding-invoice'">
                            <outstanding-invoices
                                    :initial-payload="form.outstanding_invoices"
                                    @payloadUpdated="updateOutstandingInvoices">

                            </outstanding-invoices>
                        </div>
                        <div class="card-text" v-show="content.id === 'missing-income-and-expenditure'">
                            <missing-income-and-expenditures
                                    :initial-payload="form.missing_i_and_e"
                                    @payloadUpdated="updateMissingIAndE">
                            </missing-income-and-expenditures>
                        </div>
                        <div class="card-text" v-show="content.id === 'correction'">
                            <corrections
                                    :initial-payload="form.corrections"
                                    @payloadUpdated="updateCorrections">

                            </corrections>
                        </div>
                        <div class="card-text" v-show="content.id === 'save'">
                            <save
                                    :submission="submission"
                                    @save="confirmFinished">

                            </save>
                        </div>

                    </div>
                    <div class="card-footer">
                        <div>
                            <button @click="saveBack(content.shouldSave)" class="btn btn-info btn-lg" style="float: left;" v-if="iteration !== 0">
                                <span aria-hidden="true">&larr;</span>
                                <span v-if="content.shouldSave">Save & </span>Back
                            </button>
                            <button @click="$emit('close')" class="btn btn-danger btn-lg" v-if="!content.shouldSave">
                                Exit
                            </button>
                            <button @click="saveAndExit(content.shouldSave)" class="btn btn-success btn-lg" v-else>
                                Save & Exit
                            </button>
                            <button @click="saveForward(content.shouldSave)" class="btn btn-info btn-lg" style="float: right;"  v-if="iteration !== layout.length - 1">
                                <span v-if="content.shouldSave">Save & </span>Next<span aria-hidden="true">&rarr;</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import Intro from './StaticPages/Intro';
    import UnauthorizedExpenseClaims from './UnauthorizedExpenseClaim/UnauthorizedExpenseClaims';
    import OutstandingInvoices from './OutstandingInvoice/OutstandingInvoices';
    import MissingIncomeAndExpenditures from './MissingIncomeAndExpenditure/MissingIncomeAndExpenditures';
    import Corrections from './Correction/Corrections';
    import Save from './StaticPages/Save';

    export default {
        components: {
            Intro,
            UnauthorizedExpenseClaims,
            OutstandingInvoices,
            MissingIncomeAndExpenditures,
            Corrections,
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
                form: {},
                submission: null,
                layout: [
                    {
                        id: 'intro',
                        header: 'Treasurer Sign-Off',
                        subtitle: '',
                        shouldSave: false,
                    },
                    {
                        id: 'unauthorized-expense-claim',
                        header: 'Unauthorized Expense Claims',
                        subtitle: 'If there are any unauthorised expense claims (have a reference number beginning PQU' +
                            ' and  marked at the end of the line with an asterisk) showing on the transaction list that ' +
                            'will never be authorised because there was a problem with them please let us know, so ' +
                            'we can delete them. If there are any outstanding claims on the App which you haven’t ' +
                            'authorised yet, please authorised them.',
                        shouldSave: true,
                    },
                    {
                        id: 'outstanding-invoice',
                        header: 'Outstanding Invoices',
                        subtitle: 'Are there any outstanding invoices that you are aware of that are not on the reports? Perhaps invoices that you are disputing with a supplier, or which your group hasn’t had the funds to pay?',
                        shouldSave: true,
                    },
                    {
                        id: 'missing-income-and-expenditure',
                        header: 'Missing Income & Expenditure',
                        subtitle: 'Is there any other income or expenditure missing from the reports?',
                        shouldSave: true,
                    },
                    {
                        id: 'correction',
                        header: 'Corrections',
                        subtitle: 'Other than those you have recorded earlier in the sign off, are there any other corrections that need to be made?',
                        shouldSave: true,
                    },
                    {
                        id: 'save',
                        header: 'Review & Submit',
                        subtitle: '',
                        shouldSave: false,
                    },
                ],
                iteration: 0,
            }
        },

        created() {
            this.submission = this.currentSubmission;
            if (this.currentSubmission === null) {
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
                        data: {
                            id: (this.submission.missing_income_and_expenditure === null ? null : this.submission.missing_income_and_expenditure.id)
                        }
                    },
                    corrections: {
                        present: this.submission.has_corrections,
                        data: {
                            id: (this.submission.correction === null ? null : this.submission.correction.id)
                        }
                    }
                })
            }
            this.form.shouldReset = false;

        },

        methods: {

            confirmFinished() {
                this.$http.post('/exitingtreasurer/complete/' + this.submission.id)
                    .then(response => {
                        this.$notify.success('Your sign off has been received.');
                        this.$emit('newSubmission', response.data);
                        this.$emit('close');
                    })
                    .catch(error => this.$notify.alert('There was an error completing your sign off (' + error.message +
                        '). Have you completed every section and given us information about any discrepancies?'));
            },

            create() {
                this.$http.post('/exitingtreasurer')
                    .then(response => {
                        this.$emit('newSubmission', response);
                        this.submission = response.data;
                    })
                    .catch(error => this.$notify.alert('Error starting a sign-off : ' + error.message))
            },

            submit(notify = true) {
                if (this.submission !== null) {
                    this.form.post('/exitingtreasurer/' + this.submission.id)
                        .then(response => {
                            this.submission = response;
                            this.$emit('newSubmission', response);
                            if(notify) {
                                this.$notify.success('Submission saved');
                            }
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

            saveBack(notify) {
                this.submit(notify);
                this.move(-1);
            },

            saveForward(notify) {
                this.submit(notify);
                this.move(1);
            },

            saveAndExit(notify) {
                if (this.submission !== null) {
                    this.form.post('/exitingtreasurer/' + this.submission.id)
                        .then(response => {
                            this.submission = response;
                            this.$emit('newSubmission', response);
                            if(notify) {
                                this.$notify.success('Submission saved');
                            }
                            this.$emit('close');
                        })
                        .catch(error => this.$notify.alert('Error submitting the form: ' + error.message))
                } else {
                    this.$notify.alert('Could not save.');
                }
            },

            move(step) {
                if(
                       ( this.iteration !== 0 || step > -1 )
                    && ( this.iteration !== this.layout.length - 1 || step < 1)
                ) {
                    this.iteration += step;
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