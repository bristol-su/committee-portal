<template>
    <div>
        <div style="text-align: left;">
            <button @click="toggleAllDocuments" class="btn btn-sm btn-info" style="">{{allDocumentsText}}</button>
        </div>
        <table class="table table-striped table-responsive table-condensed table-hover" v-if="documents.length > 0">
            <thead>
            <tr>
                <th>Group</th>
                <th>Title</th>
                <th>Year</th>
                <th>Type</th>
                <th>Uploaded?</th>
                <th>Uploaded By</th>
                <th>Requested At</th>
                <th>Uploaded At</th>
            </tr>
            </thead>
            <tbody v-for="document in filteredDocuments">

            <tr>
                <td>{{document.group.name}}</td>
                <td>{{document.title}}</td>
                <td>{{document.year | reaffiliation_year }}</td>
                <td>{{document.type | document_type }}</td>
                <td><span v-html="boolToFA(document.uploaded)"></span></td>
                <td>{{document.user | username }}</td>
                <td>
                    <date-viewer
                            :date="document.created_at"
                    ></date-viewer>
                </td>

                <td>
                    <date-viewer :date="document.updated_at"
                                 v-if="document.created_at !== document.updated_at"
                    >

                    </date-viewer>
                    <span v-else>
                        N/A
                    </span>
                </td>
                <td>
                    <a v-if="document.uploaded" :href="downloadUrl(document.id)">Download&nbsp;|&nbsp;</a>
                    <a v-if="!document.uploaded" @click="showUploadForm(document)" href="#">Upload&nbsp;|&nbsp;</a>
                    <a @click="showNotes(document)" href="#">Notes ({{document.notes.length}})</a>
                </td>
            </tr>


            </tbody>
        </table>
        <div v-else>
            No documents need to be uploaded
        </div>
        <modal
                height="auto"
                name="upload-document-notes-modal"
        >
            <admin-notes
                    :document="editingDocument"
                    @close="hideNotes"
                    @updateddocument="retrieveDocuments"
            >
            </admin-notes>
        </modal>

        <modal
                :resizable="true"
                height="auto"
                name="upload-document-modal"
        >
            <upload-document
                    :document="editingDocument"
                    @close="hideUploadForm"
                    @documentUploaded="updateDocument"
            >

            </upload-document>
        </modal>
    </div>
</template>

<script>
    import AdminNotes from './AdminNotes';
    import Errors from "./../../../../../../../resources/js/utilities/Errors";
    import DateViewer from './../../../../../../../resources/js/components/DateViewer'
    import UploadDocument from './UploadDocument';

    export default {
        props: {},

        data() {
            return {
                documents: [],
                errors: new Errors(),
                currentReaffiliationYear: parseInt(process.env.MIX_REAFFILIATION_YEAR),
                allDocuments: false,
                editingDocument: null
            }
        },

        methods: {

            toggleAllDocuments() {
                this.allDocuments = !this.allDocuments;
            },

            downloadUrl(id) {
                return '/admin/exitingtreasurer/download-documents/' + id;
            },

            showNotes(document) {
                this.editingDocument = document;
                this.$modal.show('upload-document-notes-modal');
            },

            hideNotes() {
                this.editingDocument = null;
                this.$modal.hide('upload-document-notes-modal');
            },

            showUploadForm(document) {
                this.editingDocument = document;
                this.$modal.show('upload-document-modal');
            },

            hideUploadForm() {
                this.editingDocument = null;
                this.$modal.hide('upload-document-modal');
            },

            updateDocument(document) {
                let index = null;
                this.documents.forEach((documentLoop, indexLoop) => {
                    if (documentLoop.id === document.id) {
                        index = indexLoop;
                    }
                });
                this.documents.splice(index, 1, document);
            },

            retrieveDocuments() {
                this.$http.get('/admin/exitingtreasurer/retrieve-documents')
                    .then(response => {
                        this.documents = response.data;
                    })
                    .catch(error => {
                        this.$notify.alert('Sorry, something went wrong.');
                        this.errors.record(error);
                    });
            },

            boolToFA(check) {
                if (check) {
                    return '<i class="fa fa-check" style="color: green; height: 10px;"></i>';
                }
                return '<i class="fa fa-times" style="color: red; height: 10px;"></i>';
            },

        },

        filters: {
            bytesToHuman(bytes) {
                if (bytes === null) {
                    return 'N/A';
                }
                let i = bytes === 0 ? 0 : Math.floor(Math.log(bytes) / Math.log(1024));
                return (bytes / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
            },

            reaffiliation_year(year) {
                return year.toString() + '/' + (year + 1).toString().slice(2);
            },

            username(user) {
                return (user === null ? 'N/A' : user.forename + ' ' + user.surname);
            },

            document_type(type) {
                if (type === 'income_expenditure') {
                    return 'Income & Expenditure';
                } else if (type === 'transaction_list') {
                    return 'Transaction List';
                }
                return 'Unknown';
            },

        },

        computed: {

            filteredDocuments() {
                if (this.allDocuments === false) {
                    return this.documents.filter(document => {
                        return !document.uploaded;
                    })
                }
                return this.documents;
            },


            allDocumentsText() {
                if (this.allDocuments === false) {
                    return 'Show all documents';
                } else {
                    return 'Hide uploaded documents';
                }
            }
        },

        components: {
            AdminNotes,
            DateViewer,
            UploadDocument
        },

        created() {
            this.retrieveDocuments()
        }

    }

</script>

<style>
    table {
        margin: auto;
    }


</style>