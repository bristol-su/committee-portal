<template>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">

                <yes-no-radio
                        no="We have no unauthorised expenses or all unauthorised expenses are valid and will be
                        authorised asap by the treasurer and student services"
                        v-model="payload.present"
                        yes="We have unauthorised expenses that need to be deleted from our transaction list.
                        Once clicked you will be able to identify the transactions using the PQU reference and add evidence in the notes section."
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
        props: {
            initialPayload: {
                required: false,
                default: null
            }
        },

        data() {
            return {
                payload: {
                    present: null,
                    data: []
                }
            }
        },

        created() {
            if (this.initialPayload !== null) {
                this.payload = this.initialPayload;
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