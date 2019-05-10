<template>
    <div>
        <!--        Introduction-->
        <p>You have indicated that you have an external bank account, or your group has had an external
            account in previous years. By external bank account, we mean a bank account operated by a
            Bristol SU affiliated student group in their own name. This account operates entirely outside
            of Bristol SU finances. </p>
        <p>If you have never had an external bank account then please email
            <a href="mailto:bristolsu-accounts@bristol.ac.uk">bristolsu-accounts@bristol.ac.uk</a>
            immediately.
        </p>
        <p>Please read the ‘Student Group External Accounts Policy & Procedure’ below before proceeding.</p>
        <p style="text-align: center;">
            <a :href="documents.procedures | static" target="_blank">
                <button class="btn btn-outline-info">Click to read policy</button>
            </a>
        </p>


        <!--        Has completed-->
        <div v-if="completed">
            You have already given us your external account audit! To make any amendments, please contact us.
        </div>

        <!--        Submission -->
        <div v-else>
            Please confirm that you have read the above policy, that you are aware of and accept Bristol SU's
            regulations on when groups can have external accounts and confirm that your group meet all of the required
            criteria.
            <conditions-met v-model="form.conditions_met"></conditions-met>

            <br/>
            <hr style="margin: auto; width: 40%"/>
            <br/>

            For which of these reasons does your group need an external bank account?
            <missing-functionality v-model="form.missing_functionality"></missing-functionality>
            <lost-income v-model="form.potential_income_lost"></lost-income>

            <br/>
            <hr style="margin: auto; width: 40%"/>
            <br/>

            When is your financial year end, i.e. the date to which you produce your financial accounts?
            <year-end v-model="form.year_end"></year-end>

            <br/>
            <hr style="margin: auto; width: 40%"/>
            <br/>

            Please list details for all your external accounts (For each account please upload a year end bank
            statement. If the account has been closed please upload the final bank statement).
            <accounts @input="val => form.accounts = val"></accounts>

            <br/>
            <hr style="margin: auto; width: 40%"/>
            <br/>

            <p>In line with our External Accounts Procedure, any student group with an external account must produce
                financial accounts on an annual basis and submit them to Bristol SU through the reaffiliation process.
                These
                accounts must be checked by an auditor or independent examiner. Guidance on who can act as an
                independent
                examiner and what they need to do can be found on the
                <a href="https://www.gov.uk/government/organisations/charity-commission">Charity Commission website</a>
            </p>

            <p>
                There is no prescribed format, however, as a minimum we require the following to be uploaded for
                external accounts:</p>

            <ol>
                <li>Receipts & Payments Account for the year.</li>
                <li>Summary of the movement on the bank account during the year</li>
                <li>Signed statement from the auditor/independent examiner</li>
            </ol>

            <p>See <a :href="documents.audited | static" target="_blank">here</a> for an example document that covers the above.</p>

            <statements @input="val => form.statements = val"></statements>

            <hr style="margin-top: 20px"/>

            <div style="text-align: center; margin-top: 60px;">

                <button @click="submit" class="btn btn-lg btn-outline-info" type="button">
                    Submit all answers
                </button>
            </div>
        </div>

    </div>
</template>

<script>

    import Accounts from './SubmissionComponents/Accounts';
    import ConditionsMet from './SubmissionComponents/ConditionsMet';
    import LostIncome from './SubmissionComponents/LostIncome';
    import MissingFunctionality from './SubmissionComponents/MissingFunctionality';
    import Statements from './SubmissionComponents/Statements';
    import YearEnd from './SubmissionComponents/YearEnd';


    export default {
        name: "Submission",

        data() {
            return {
                form: new VueForm({
                    'conditions_met': false,
                    'missing_functionality': null,
                    'potential_income_lost': null,
                    'year_end': null,
                    'accounts': [],
                    'statements': [],
                }),
                completed: false,
                documents: {
                    procedures: 'student-group-external-accounts-policy-and-procedure.pdf',
                    audited: 'student-group-external-accounts-example-audited.pdf'
                }
            }
        },

        components: {
            Accounts,
            ConditionsMet,
            LostIncome,
            MissingFunctionality,
            Statements,
            YearEnd
        },

        methods: {
            submit() {
                this.form.post('externalaccounts/submission')
                    .then(response => {
                        this.completed = true;
                        this.$notify.success('External Account Audit Received');
                    })
                    .catch(error => this.$notify.alert('There was an error processing your external account audit'));
            }
        },

        created() {
            this.$http.get('externalaccounts/submission')
                .then(response => this.completed = true)
                .catch(error => this.completed = false);
        },

        filters: {
            static(filename) {
                return window.serveStaticContent(filename);
            }
        }
    }
</script>

<style scoped>

</style>