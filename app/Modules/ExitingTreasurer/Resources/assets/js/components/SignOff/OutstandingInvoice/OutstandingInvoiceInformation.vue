<template>
    <tr>
        <td>{{invoice.title}}</td>
        <td v-html="invoiceLink"></td>
        <td v-html="boolToFA(invoice.authorized)"></td>
        <td>{{invoice.note}}</td>
        <td>
            <a v-for="document in invoice.treasurer_sign_off_documents" :href="downloadDocument(document)">Download | </a>
        </td>
        <td>
            <button @click="remove" class="btn btn-sm btn-danger" v-if="exists">Delete</button>
        </td>
    </tr>

</template>

<script>

    import _ from 'lodash';
    import NewInvoiceForm from './NewInvoiceForm';

    export default {

        props: {
            initial_id: {
                required: false,
                default: null,
            },
        },

        data() {
            return {
                invoice: {
                    title: null,
                    invoice: null,
                    note: null,
                    authorized: null,
                    documents: []
                },
                original_invoice: {
                    title: null,
                    invoice: null,
                    note: null,
                    authorized: null,
                    documents: []
                },
            }
        },

        created() {
            if (this.initial_id !== null) {
                this.$http.get('/exitingtreasurer/api/invoices/' + this.initial_id)
                    .then(response => {
                        this.invoice = response.data;
                        this.original_invoice = Object.assign({}, this.invoice);
                    })
                    .catch(error => this.$http.error('Could not find your invoices: ' + error.message));
            }
        },

        methods: {
            saveDetails(details) {
                this.invoice = details;
            },

            showModal() {
                this.$modal.show('new-outstanding-invoice-form')
            },

            closeModal() {
                this.$modal.hide('new-outstanding-invoice-form')
            },

            save() {
                // Save or update
                let formData = new FormData();
                formData.append('invoice', this.invoice.invoice);
                for(let i=0;i<this.invoice.documents.length;i++) {
                    formData.append('documents['+i+']', this.invoice.documents[i]);
                }
                formData.append('title', this.invoice.title);
                formData.append('note', this.invoice.note);
                formData.append('authorized', this.invoice.authorized);

                if (this.initial_id === null) {
                    this.$http.post('/exitingtreasurer/api/invoices', formData)
                        .then(response => {
                            this.$notify.success('Invoice saved');
                            this.invoice = response.data;
                            this.original_invoice = Object.assign({}, this.invoice);
                            this.$emit('created', this.invoice.id);
                            this.reset();
                        })
                        .catch(error => this.$notify.alert('Could not save the unauthorized invoice: ' + error.message));

                }
            },

            remove() {
                if (confirm('Are you sure you wish to remove invoice ' + this.invoice.title + ' from the unauthorized list?')) {
                    this.$http.delete('/exitingtreasurer/api/invoices/' + this.invoice.id)
                        .then(response => {
                            this.$notify.info('Invoice ' + this.invoice.title + ' deleted');
                            this.$emit('remove', this.invoice.id);
                        })
                        .catch(error => this.$notify.alert('Invoice ' + this.invoice.title + ' could not be deleted'));
                }
            },

            reset() {
                this.invoice = {
                    title: null,
                    invoice: null,
                    note: null,
                    authorized: null,
                    documents: [],
                    id: null
                };
                this.original_invoice = {
                    title: null,
                    invoice: null,
                    note: null,
                    authorized: null,
                    documents: [],
                    id: null
                };
            },

            boolToFA(check) {
                if (check) {
                    return '<i class="fa fa-check" style="color: green; height: 10px;"></i>';
                }
                return '<i class="fa fa-times" style="color: red; height: 10px;"></i>';
            },

            downloadDocument(document) {
                return '/exitingtreasurer/download/'+document.id;
            }
        },

        computed: {
            exists() {
                return this.initial_id !== null;
            },

            changed() {
                return !_.isEqual(this.invoice, this.original_invoice);
            },

            invoiceLink() {
                if(this.invoice.invoice === null) {
                    return 'Not Uploaded'
                } else if(this.invoice.invoice instanceof File) {
                    return 'Not Saved';
                } else {
                    return '<a href="/exitingtreasurer/api/invoices/download/'+this.invoice.id+'">Download</a>';

                }
            }
        },

        components: {
            NewInvoiceForm
        }

    }
</script>

<style scoped>

</style>