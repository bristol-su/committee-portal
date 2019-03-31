<template>
    <div>
        <div class="row">
            <div class="col-xs-12">
                <h3>Outstanding Invoices</h3>
                <h4>
                    <small>Are there any outstanding invoices that you are aware of that are not on the reports? Perhaps
                        invoices that you are disputing with a supplier, or which your group hasn’t had the funds to
                        pay?
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
                                id="no_outstanding_invoices"
                                type="radio"
                                v-model="form.has_outstanding_invoices"
                        >
                        <label
                                class="custom-control-label"
                                for="no_outstanding_invoices">
                            No, all the invoices for the year to date are showing on the Trans List.
                        </label>
                    </div>
                    <div class="custom-control custom-radio" style="text-align: left;">
                        <input
                                :value="true"
                                class="custom-control-input"
                                id="outstanding_invoices"
                                type="radio"
                                v-model="form.has_outstanding_invoices"
                        >
                        <label
                                class="custom-control-label"
                                for="outstanding_invoices">
                            Yes, there are unpaid invoices which are not showing on the Trans List.
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" v-if="form.has_outstanding_invoices">
            <div class="col-md-12">
                Something here to add new invoices

                Upload a copy of unpaid invoice 1 (pdf/photo)
                Either – “I authorise payment of this invoice”
                Or – “This invoice hasn’t been authorised because” ….
                    allow free text field. AND allow upload of supporting email chain (as pdf) or similar.
<!--                <table class="table table-condensed table-borderless">-->
<!--                    <thead>-->
<!--                    <tr>-->
<!--                        <th>PQU Number</th>-->
<!--                        <th>Notes</th>-->
<!--                        <th></th>-->
<!--                    </tr>-->
<!--                    </thead>-->
<!--                    <tbody>-->
<!--                    <tr v-for="(pqu_number, index) in form.pqu_numbers">-->
<!--                        <td style="width: 40%">-->
<!--                            <input class="form-control" style="width: 100%" type="text"-->
<!--                                   v-model="form.pqu_numbers[index]">-->
<!--                        </td>-->
<!--                        <td style="width: 40%">-->
<!--                            <input class="form-control" style="width: 100%" type="text" v-model="form.notes[index]">-->
<!--                        </td>-->
<!--                        <td>-->
<!--                            <button @click="delete_claim(pqu_number)" class="btn btn-sm btn-danger">Delete</button>-->
<!--                        </td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td style="width: 45%">-->
<!--                            <input class="form-control" style="width: 100%" type="text" v-model="new_pqu_number">-->
<!--                        </td>-->
<!--                        <td style="width: 45%">-->
<!--                            <input class="form-control" style="width: 100%" type="text" v-model="new_notes">-->
<!--                        </td>-->
<!--                        <td>-->
<!--                            <button @click="save_claim" class="btn btn-sm btn-info">Add</button>-->
<!--                        </td>-->
<!--                    </tr>-->
<!--                    </tbody>-->
<!--                </table>-->
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
                    has_outstanding_invoices: null,
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