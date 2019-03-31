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


                <div class="custom-controls-stacked">
                    <div class="custom-control custom-radio" style="text-align: left;">
                        <input
                                :value="false"
                                class="custom-control-input"
                                id="no_expense_claims"
                                type="radio"
                                v-model="form.has_unauthorized_expense_claim"
                        >
                        <label
                                class="custom-control-label"
                                for="no_expense_claims">
                            Not relevant, no PQU expenses or all the PQU expenses on the transaction
                            list are valid and will be authorised later by the treasurer/student services.
                        </label>
                    </div>
                    <div class="custom-control custom-radio" style="text-align: left;">
                        <input
                                :value="true"
                                class="custom-control-input"
                                id="expense_claims"
                                type="radio"
                                v-model="form.has_unauthorized_expense_claim"
                        >
                        <label
                                class="custom-control-label"
                                for="expense_claims">
                            Please delete the expense claims with the PQU reference numbers as attached/as below as the
                            expenses are invalid or have already been re-submitted and paid under a different reference.
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" v-if="form.has_unauthorized_expense_claim">
            <div class="col-md-12">
                <table class="table table-condensed table-borderless">
                    <thead>
                    <tr>
                        <th>PQU Number</th>
                        <th>Notes</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(pqu_number, index) in form.pqu_numbers">
                        <td style="width: 40%">
                            <input class="form-control" style="width: 100%" type="text"
                                   v-model="form.pqu_numbers[index]">
                        </td>
                        <td style="width: 40%">
                            <input class="form-control" style="width: 100%" type="text" v-model="form.notes[index]">
                        </td>
                        <td>
                            <button class="btn btn-sm btn-danger" @click="delete_claim(pqu_number)">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 45%">
                            <input class="form-control" style="width: 100%" type="text" v-model="new_pqu_number">
                        </td>
                        <td style="width: 45%">
                            <input class="form-control" style="width: 100%" type="text" v-model="new_notes">
                        </td>
                        <td>
                            <button class="btn btn-sm btn-info" @click="save_claim">Add</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</template>

<script>
    import Form from "../../../../../../../../resources/js/utilities/Form";

    export default {
        data() {
            return {
                form: new Form({
                    has_unauthorized_expense_claim: null,
                    pqu_numbers: [],
                    notes: []
                }),
                new_pqu_number: '',
                new_notes: ''
            }
        },

        methods: {
            delete_claim(pqu_number) {
                this.form.pqu_numbers.splice(this.form.pqu_numbers.indexOf(pqu_number), 1)
            },

            save_claim() {
                this.form.pqu_numbers.push(this.new_pqu_number);
                this.form.notes.push(this.new_notes);
                this.new_pqu_number = '';
                this.new_notes = '';
            }
        }
    }

</script>

<style>

</style>