<template>
    <div>
        <div>
            <b-form @submit.prevent="">

                <b-form-group
                        description="Please confirm that you have read the above policy, that you are aware of and accept Bristol SU's regulations on when groups can have external accounts and confirm that your group meet all of the required criteria."
                        label=""
                        label-for="conditions"
                >
                    <b-form-checkbox
                            disabled
                            id="conditions"
                            name="conditions"
                            unchecked-value="0"
                            v-model="submission_data.conditions_met"
                            value="1"
                    >
                        Accepted?
                    </b-form-checkbox>
                </b-form-group>
                <hr/>

                <b-form-group
                        description="Reasons for an external account: Missing Functionality"
                        label=""
                        label-for="missing_functionality"
                >
                    <b-form-textarea
                            id="missing_functionality"
                            v-model="submission_data.missing_functionality"
                            disabled
                    ></b-form-textarea>
                </b-form-group>
                <b-form-group
                        description="Reasons for an external account: Potential Lost Income"
                        label=""
                        label-for="potential_income_lost"
                >
                    <b-form-textarea
                            id="potential_income_lost"
                            v-model="submission_data.potential_income_lost"
                            disabled
                    ></b-form-textarea>
                </b-form-group>
                <hr/>

                <b-form-group
                        description="Financial Year End"
                        label=""
                        label-for="year_end"
                >
                    <b-form-input
                            id="year_end"
                            v-model="submission_data.year_end"
                            type="date"
                            disabled
                    ></b-form-input>
                </b-form-group>
                <hr/>

                <accounts-table
                :accounts="submission_data.accounts">

                </accounts-table>
                <hr/>

                <b-form-group
                        description="Financial Account Documents"
                        label=""
                        label-for="financial_account_documents"
                >
                    <ul v-for="statement in submission.statements">
                        <li>
                            <a :href="documentUrl(statement.id)">{{statement.filename}}</a>
                        </li>
                    </ul>
                </b-form-group>

            </b-form>
        </div>
    </div>
</template>

<script>
    import AccountsTable from "./AccountsTable";
    export default {
        name: "SingleSubmission",
        components: {AccountsTable},
        props: {
            submission: {
                required: true,
                type: Object
            }
        },

        data() {
            return {
                submission_data: {}
            }
        },
        created() {
            this.submission_data = this.submission;
        },

        methods: {
            documentUrl(id) {
                return '/admin/externalaccounts/document/' + id;
            }
        }
    }
</script>

<style scoped>

</style>