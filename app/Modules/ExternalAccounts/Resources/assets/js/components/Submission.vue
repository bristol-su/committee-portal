<template>
    <div>
        <div v-if="completed">
            You have already given us your external account audit! To make any amendments, please contact us.
        </div>
        <div v-else>
            Please confirm that you are aware of and accept BSU's regulations on when groups can have external bank accounts
            and confirm that your group meets the conditions.
            <conditions-met v-model="form.conditions_met"></conditions-met>

            <br/><hr style="margin: auto; width: 40%"/><br/>

            For which of these reasons does your group need an external bank account?
            <missing-functionality v-model="form.missing_functionality"></missing-functionality>
            <lost-income v-model="form.potential_income_lost"></lost-income>

            <br/><hr style="margin: auto; width: 40%"/><br/>

            When is your year end?
            <year-end v-model="form.year_end"></year-end>

            <br/><hr style="margin: auto; width: 40%"/><br/>

            Please ensure the information about your accounts is correct. For each account, either mark it as closed or submit
            an end of year statement.
            <accounts @input="val => form.accounts = val"></accounts>

            <br/><hr style="margin: auto; width: 40%"/><br/>

            Statements
            <statements @input="val => form.statements = val"></statements>

            <button type="button" class="btn btn-lg btn-outline-info" @click="submit">
                Submit your External Account Audit
            </button>
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
                completed: false
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
        }
    }
</script>

<style scoped>

</style>