<template>
    <div class="container">

        <preview>
            <table class="table table-hover table-responsive table-striped table-condensed"
                   style="margin: auto; display: table;">
                <thead>
                <tr>
                    <th></th>
                    <!--                <th>Group</th>-->
                    <th>User</th>
                    <th>Position</th>
                    <th>Year</th>
                    <th>Unauthorized Expense Claims</th>
                    <th>Outstanding Invoices</th>
                    <th>Missing Income & Expenditure</th>
                    <th>Corrections</th>

                    <th>Submitted At</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="submission in submissions">
                    <td>#{{submission.id}}</td>
                    <!--                <td>{{submission.group | group_name}}</td>-->
                    <td>{{submission.user | user_name}}</td>
                    <td>{{submission.position | position_name}}</td>
                    <td>{{submission.year}}</td>
                    <td @click="showUnauthorizedExpenseClaims(submission)"><span
                            v-html="boolToFA(submission.has_unauthorized_expense_claims)"></span></td>

                    <td @click="showOutstandingInvoices(submission)"><span
                            v-html="boolToFA(submission.has_outstanding_invoices)"></span></td>

                    <td @click="showIncomeAndExpenditure(submission)"><span
                            v-html="boolToFA(submission.has_missing_income_and_expenditure)"></span></td>

                    <td @click="showCorrections(submission)"><span v-html="boolToFA(submission.has_corrections)"></span>
                    </td>
                    <td>
                        <date-viewer
                                :date="submission.updated_at"></date-viewer>
                    </td>
                </tr>

                </tbody>
            </table>
        </preview>

        <modal height="auto" name="expense-claims">
            <unauthorized-expense-claim
                    :input="extract('unauthorized_expense_claim')">

            </unauthorized-expense-claim>
        </modal>

        <modal height="auto" name="outstanding-invoices">
            <outstanding-invoice
                    :input="extract('outstanding_invoice')">

            </outstanding-invoice>
        </modal>

        <modal height="auto" name="missing-income-and-expenditure">
            <missing-income-and-expenditure
                    :input="extract('missing_income_and_expenditure')">

            </missing-income-and-expenditure>
        </modal>

        <modal height="auto" name="corrections">
            <corrections
                    :input="extract('correction')">

            </corrections>
        </modal>


    </div>


</template>

<script>
    import DateViewer from "../../../../../../../../resources/js/components/DateViewer";
    import UnauthorizedExpenseClaim from './UnauthorizedExpenseClaim';
    import MissingIncomeAndExpenditure from './MissingIncomeAndExpenditure';
    import OutstandingInvoice from './OutstandingInvoice';
    import Corrections from './Corrections';
    import Preview from "../../../../../../../../resources/js/components/Preview";

    export default {
        components: {
            DateViewer,
            UnauthorizedExpenseClaim,
            MissingIncomeAndExpenditure,
            OutstandingInvoice,
            Corrections,
            Preview
        },

        props: {
            submissions: {
                required: true,
                type: Array
            }
        },

        data() {
            return {
                editingSubmission: null
            }
        },

            filters: {
            group_name(group) {
                return group.name;
            },
            user_name(user) {
                return user.forename + ' ' + user.surname;
            },
            position_name(position) {
                return position.name;
            },

            reaffiliation_year(year) {
                return year.toString() + '/' + (year + 1).toString().slice(2);
            },
        },


        methods: {
            extract(index) {
                return (this.editingSubmission === null ? null : this.editingSubmission[index]);
            },
            boolToFA(check) {
                if (check) {
                    return '<i class="fa fa-check" style="color: green; height: 10px;"></i>';
                }
                return '<i class="fa fa-times" style="color: red; height: 10px;"></i>';
            },
            showUnauthorizedExpenseClaims(submission) {
                if (submission.has_unauthorized_expense_claims) {
                    this.editingSubmission = submission;
                }
                this.$modal.show('expense-claims');
            },
            hideUnauthorizedExpenseClaims() {
                this.editingSubmission = null;
                this.$modal.hide('expense-claims');
            },
            showOutstandingInvoices(submission) {
                if (submission.has_outstanding_invoices) {
                    this.editingSubmission = submission;
                }
                this.$modal.show('outstanding-invoices');
            },
            hideOutstandingInvoices() {
                this.editingSubmission = null;
                this.$modal.hide('outstanding-invoices');
            },
            showIncomeAndExpenditure(submission) {
                if (submission.has_missing_income_and_expenditure) {
                    this.editingSubmission = submission;
                }
                this.$modal.show('missing-income-and-expenditure');
            },
            hideIncomeAndExpenditure() {
                this.editingSubmission = null;
                this.$modal.hide('missing-income-and-expenditure');
            },
            showCorrections(submission) {
                if (submission.has_corrections) {
                    this.editingSubmission = submission;
                }
                this.$modal.show('corrections');
            },
            hideCorrections() {
                this.editingSubmission = null;
                this.$modal.hide('corrections');
            },
        }
    }
</script>

<style scoped>

</style>