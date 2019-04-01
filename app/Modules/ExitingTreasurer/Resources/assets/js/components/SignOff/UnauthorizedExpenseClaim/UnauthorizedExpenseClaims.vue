<template>
    <div>
        <div class="row">
            <div class="col-xs-12">
                <h3>Unauthorised Expense Claims</h3>
                <h4>
                    <small>If there are any unauthorised expense claims (have a reference number beginning PQU and
                        marked at
                        the end of the line with an asterisk) showing on the transaction list that will never be
                        authorised
                        because there was a problem with them please let us know, so we can delete them. If there are
                        any
                        outstanding claims on the App which you haven’t authorised yet, please authorised them.
                    </small>
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">

                <yes-no-radio
                        no="Not relevant, no PQU expenses or all the PQU expenses on the transaction
                            list are valid and will be authorised later by the treasurer/student services."
                        v-model="payload.present"
                        yes="Please delete the expense claims with the PQU reference numbers as attached/as below as the
                            expenses are invalid or have already been re-submitted and paid under a different reference."
                ></yes-no-radio>

            </div>
        </div>

        <div class="row" v-if="payload.present">
            <div class="col-md-12">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            PQU Numbers
                        </div>
                        <div class="col-md-5">
                            Notes
                        </div>
                        <div class="col-md-2">

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="container">
                    <div class="row" v-for="claim_id in payload.data">
                        <div class="col-md-12">
                            <unauthorized-expense-claim-information
                                    :initial_id="claim_id"
                                    @remove="remove">

                            </unauthorized-expense-claim-information>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <unauthorized-expense-claim-information
                                    @created="save">

                            </unauthorized-expense-claim-information>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</template>

<script>
    import UnauthorizedExpenseClaimInformation from './UnauthorizedExpenseClaimInformation';
    import YesNoRadio from "../../YesNoRadio";

    export default {
        data() {
            return {
                payload: {
                    present: null,
                    data: []
                }
            }
        },

        components: {
            YesNoRadio,
            UnauthorizedExpenseClaimInformation
        },

        watch: {
            payload: {
                handler(payload) {
                    this.$emit('payloadUpdated', payload);
                },
                deep: true
            }
        },

        methods: {
            save(id) {
                this.payload.data.push(id);
            },

            remove(id) {
                this.payload.data.splice(this.payload.data.indexOf(id), 1);
            }
        }
    }

</script>

<style>

</style>