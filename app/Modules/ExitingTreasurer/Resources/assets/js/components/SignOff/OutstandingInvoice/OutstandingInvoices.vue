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

                <yes-no-radio
                        no="No, all the invoices for the year to date are showing on the Trans List."
                        v-model="payload.present"
                        yes="Yes, there are unpaid invoices which are not showing on the Trans List.">

                </yes-no-radio>

            </div>
        </div>

        <div class="row" v-if="payload.present">
            <div class="col-md-12">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            Title
                        </div>
                        <div class="col-md-2">
                            Invoice
                        </div>
                        <div class="col-md-2">
                            Authorized
                        </div>
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-2">

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="container">
                    <div class="row" v-for="invoice_id in payload.data">
                        <div class="col-md-12">
                            <outstanding-invoice-information
                                    :initial_id="invoice_id"
                                    @remove="remove">

                            </outstanding-invoice-information>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <outstanding-invoice-information
                                    @created="save">

                            </outstanding-invoice-information>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</template>

<script>
    import OutstandingInvoiceInformation from './OutstandingInvoiceInformation';
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
                this.payload.data.push(id);
            },

            remove(id) {
                this.payload.data.splice(this.payload.data.indexOf(id), 1);
            },



        }

    }

</script>

<style>

</style>