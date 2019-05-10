<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="text-align: left;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="large-12 medium-12 small-12 filezone" id="documentFileInput">
                    <input @change="uploadFiles" ref="files" aria-describedby="fileHelp" id="files"
                           type="file" multiple/>
                    <p class="filezone-p">
                        Drop your files here <br>or click to search
                    </p>
                </div>
            </div>
        </div>
        <div class="row" v-if="files.length > 0" style="text-align: left;">
            <div class="col-md-12">
                Uploaded Files:
                <ul>
                    <li v-for="file in files">
                        {{file.filename}}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Statements",

        data() {
            return {
                files: []
            }
        },

        create() {

        },

        methods: {
            uploadFiles() {
                let files = this.$refs.files.files;
                let formData = new FormData();
                for( var i = 0; i < files.length; i++ ){
                    let file = files[i];
                    formData.append('statements[' + i + ']', file);
                }

                this.$http.post('/externalaccounts/statement', formData)
                    .then(response => {
                        console.log(response);
                        this.$notify.success('Files Uploaded');
                        this.files = response.data;
                    })
                    .catch(error => {
                        this.$notify.alert('The file(s) could not be uploaded: ' + error.message);
                    });
            },

        },

        watch: {
            files(files) {
                this.$emit('input', files.map(file => file.id));
            }
        },
    }
</script>

<style scoped>
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