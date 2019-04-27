<template>
    <div>
        <div class="row">
            <div class="col-xs-12">

                <yes-no-radio
                        no="No, all the invoices for the year to date are showing on the transaction list."
                        v-model="payload.present"
                        yes="Yes, there are unpaid invoices which are not showing on the transaction list.">

                </yes-no-radio>

            </div>
        </div>
        <br/>

        <div v-if="showNewForm">
            <new-invoice-form
                @submit="newInvoice">

            </new-invoice-form>
        </div>
        <div v-else>
            <div class="row" v-if="payload.present">
                <div class="col-md-12">
                    <button @click="showNewForm = true;" class="btn btn-info" style="margin: auto; width: 40%">
                        Record Outstanding Invoice
                    </button>
                </div>
            </div>
            <div class="row" v-if="payload.present && payload.data.length > 0">
                <div class="col-md-12">
                    <table class="table table-striped table-hover table-condensed ">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Invoice</th>
                            <th>Authorised</th>
                            <th>Notes</th>
                            <th>Documents</th>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody v-for="invoice_id in payload.data">
                            <outstanding-invoice-information
                                    :initial_id="invoice_id"
                                    @remove="remove">

                            </outstanding-invoice-information>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import OutstandingInvoiceInformation from './OutstandingInvoiceInformation';
    import YesNoRadio from "../../YesNoRadio";
    import NewInvoiceForm from "./NewInvoiceForm";

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
                },
                showNewForm: false
            }
        },

        components: {
            NewInvoiceForm,
            YesNoRadio,
            OutstandingInvoiceInformation
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
                console.log('saving id ' + id);
                this.payload.data.push(id);
            },

            remove(id) {
                this.payload.data.splice(this.payload.data.indexOf(id), 1);
            },

            newInvoice(invoice) {
                console.log(invoice);
                // Save or update
                let formData = new FormData();
                formData.append('invoice', invoice.invoice);
                for (let i = 0; i < invoice.documents.length; i++) {
                    formData.append('documents[' + i + ']', invoice.documents[i]);
                }
                formData.append('title', invoice.title);
                formData.append('note', invoice.note);
                formData.append('authorized', invoice.authorized);
                this.$http.post('/exitingtreasurer/api/invoices', formData)
                    .then(response => {
                        console.log(response);
                        this.save(response.data.id)
                    })
                    .catch(error => this.$notify.alert('Could not save the invoice: ' + error.message))
                    .then(() => this.showNewForm = false);
            }
        },

        created() {
            if(this.initialPayload !== null) {
                console.log(this.initialPayload);
                this.payload = this.initialPayload;
            }
        }

    }

</script>

<style>

</style>