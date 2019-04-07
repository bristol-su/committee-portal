<template>
    <div class="container">
        <!-- New Upload -->
        <!-- File Table -->

        <hr/>
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">New File</legend>

            <!-- Document Title -->
            <div class="form-group">
                <label for="documentTitleInput">
                    <small class="form-text text-muted" id="titleHelp" style="text-align: left;">Enter a title for the
                        new document.
                    </small>
                </label>

                <small><span class="has-error-span"
                             v-show="this.errors.has('title')">{{this.errors.get('title')}}</span></small>
                <input aria-describedby="titleHelp" class="form-control" id="documentTitleInput" type="text"
                       v-model="documentTitle">
            </div>

            <!-- File Upload -->
            <small><span class="has-error-span" v-show="this.errors.has('file')">{{this.errors.get('file')}}</span>
            </small>

            <div class="form-group" v-if="!isFilePending">
                <br/>
                <div class="large-12 medium-12 small-12 filezone" id="documentFileInput">
                    <input @change="newFile" aria-describedby="fileHelp" id="files" ref="files"
                           type="file"/>
                    <p class="filezone-p">
                        Drop your files here <br>or click to search
                    </p>
                </div>
                <small class="form-text text-muted" id="fileHelp">Drag and drop a new file above, or click to choose a
                    file.
                    The file will appear below - click upload when you're ready! You may upload most standard files,
                    such as .doc, .xls and .pdf
                </small>
            </div>
            <div style="text-align: left;" v-else>
                <ol style="list-style: none;">
                    <li v-for="file in filesPendingUpload">
                        {{file.name}}
                    </li>
                </ol>
            </div>

            <div class="row">
                <div class="col-md-12" v-if="isFilePending">
                    <button @click="submitAllAvailable" class="btn btn-outline-info btn-lg">
                        Confirm and Upload
                    </button>

                    <div class="float-right">
                        <button @click="resetForm" class="btn btn-sm btn-outline-danger">
                            Reset
                        </button>
                    </div>
                </div>
            </div>

        </fieldset>

        <div style="justify-content: center">

            <file-table
                    :files="files"
                    :module="module"
                    :uploading="uploading"
                    :uploadingDocumentTitle="documentTitle"
                    @updatedfile="retrieveFiles"
                    @upload="submitFile"
            >

            </file-table>

        </div>

        <br/><br/>


    </div>
</template>

<script>
    import FileTable from './FileTable';
    import Errors from "../../utilities/Errors";

    export default {
        components: {
            FileTable
        },

        props: {

            module: {
                required: true,
                type: String,
                default: ''
            },

            defaultTitle: {
                required: false,
                type: String,
                default: ''
            }
        },

        data() {
            return {
                files: [],

                documentTitle: '',

                errors: new Errors(),

                uploading: []
            }
        },

        created() {
            this.documentTitle = this.defaultTitle;

            this.retrieveFiles();
        },

        methods: {

            // Methods to process files

            newFile() {
                this.$notify.warning('File selected. Please click \'Upload\' to confirm.');
                this.files = this.files.filter(file => !(file instanceof File));
                let uploadedFiles = this.$refs.files.files;
                for (var i = 0; i < uploadedFiles.length; i++) {
                    this.files.push(uploadedFiles[i]);
                }
            },

            resetForm() {
                this.files = this.files.filter(file => !(file instanceof File));
                this.$refs.files.value = '';
                this.documentTitle = this.defaultTitle;
                this.errors.clear();
            },

            submitAllAvailable() {
                this.files.forEach((file, key) => {
                    this.submitFile(key);
                });
            },

            submitFile(key) {
                if (this.files[key] instanceof File && this.uploading.indexOf(key) === -1) {
                    this.uploading.push(key);
                    let formData = new FormData();
                    formData.append('file', this.files[key]);
                    formData.append('title', this.documentTitle);

                    this.$http.post('/' + this.module + '/upload-files', formData)
                        .then(response => {
                            this.$notify.success('File uploaded!');
                            this.files.splice(key, 1, response.data);
                            this.uploading.splice(this.uploading.indexOf(key), 1);
                            this.$refs.files.value = '';
                        })
                        .catch(error => {
                            this.$notify.alert('Sorry, something went wrong.');
                            this.uploading.splice(this.uploading.indexOf(key), 1);
                            this.errors.record(error.response.data.errors);
                        });
                }
            },

            retrieveFiles() {
                this.$http.get('/' + this.module + '/retrieve-files')
                    .then(response => this.files = response.data)
                    .catch(error => this.$notify.alert('Sorry, something went wrong.'))
            },


        },

        computed: {
            isFilePending() {
                return this.filesPendingUpload.length > 0;
            },

            filesPendingUpload() {
                return this.files.filter((file, key) => {
                    return file instanceof File && this.uploading.indexOf(key) === -1;
                });
            }
        }

    }
</script>

<style scoped>

    /*Formatting for the file upload component*/

    input[type="file"] {
        opacity: 0;
        width: 100%;
        max-height: 150px;
        min-height: 130px;
        position: absolute;
        cursor: pointer;
        box-sizing: border-box;
    }

    .filezone {
        outline: 2px dashed grey;
        outline-offset: -10px;
        background: #ccc;
        color: dimgray;
        display: flex;
        box-sizing: border-box;
        padding: 10px 10px;
        max-height: 150px;
        min-height: 70px;
        /*min-height: 200px;*/
        cursor: pointer;
    }

    .filezone-p {
        width: 100%;
    }

    .filezone:hover {
        background: #c0c0c0;
    }

    .filezone p {
        font-size: 1.2em;
        text-align: center;
        padding: 50px 50px 50px 50px;
    }


    a.submit-button {
        display: block;
        margin: auto;
        text-align: center;
        width: 200px;
        padding: 10px;
        text-transform: uppercase;
        background-color: #CCC;
        color: white;
        font-weight: bold;
        margin-top: 20px;
    }

    /*Border around new file*/
    fieldset.scheduler-border {
        border: 2px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow: 0px 0px 0px 0px #000;
        box-shadow: 0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width: auto;
        padding: 0 10px;
        border-bottom: none;
    }
</style>