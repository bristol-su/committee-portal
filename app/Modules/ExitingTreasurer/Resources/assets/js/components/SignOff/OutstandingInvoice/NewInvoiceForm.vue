<template>
    <div class="container" style="padding: 15px">
        <form @submit.prevent="save">
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="title">Title</label>
                </div>
                <div class="col-md-8">
                    <input class="form-control" id="title" type="text" v-model="invoice.title">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="invoice_file">Invoice</label>
                </div>
                <div class="col-md-8">
                    <input class="form-control" id="invoice_file" ref="invoice_file" type="file" @change="invoiceSelected">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="authorized">Authorized</label>
                </div>
                <div class="col-md-8">
                    <yes-no-radio
                            id="authorized"
                            no="I do not authorise this invoice"
                            yes="I authorise this invoice"
                            v-model="invoice.authorized">

                    </yes-no-radio>
                </div>
            </div>
            <div v-if="invoice.authorized === false">

                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="notes">Reason for no authorisation</label>
                    </div>
                    <div class="col-md-8">
                        <textarea class="form-control" id="notes" rows="5" v-model="invoice.note"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="documents">Supporting documents (i.e. email chains)</label>
                    </div>
                    <div class="col-md-8">
                        <input class="form-control" id="documents" multiple ref="documents" type="file" @change="documentsSelected">
                    </div>
                </div>

            </div>

            <div class="form-group row">
                <div class="col-md-12">
                    <button class="btn btn-info" id="submit" style="width: 50%; margin: auto;"  type="submit">Record Invoice</button>
                </div>
            </div>
        </form>
    </div>

</template>

<script>
    import YesNoRadio from "../../YesNoRadio";

    export default {
        components: {YesNoRadio},

        props: {
            initial_invoice: {
                required: false,
                default: null
            }
        },

        data() {
            return {
                invoice: {
                    title: null,
                    invoice: null,
                    authorized: null,
                    note: null,
                    documents: []
                }
            }
        },

        created() {
            if(this.initial_invoice !== null) {
                this.invoice = this.initial_invoice
            }
        },

        methods: {
            invoiceSelected() {
                this.invoice.invoice = this.$refs.invoice_file.files[0];
            },

            documentsSelected() {
                this.invoice.documents = this.$refs.documents.files;
            },

            save() {
                this.$emit('submit', this.invoice);
                this.$emit('close');
            }
        }

    }
</script>

<style scoped>

</style>