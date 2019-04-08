<template>
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <input class="form-control" type="text" v-model="correction.note" v-if="!exists">
                <p v-else>{{correction.note}}</p>
            </div>
            <div class="col-md-5">
                <input @change="documentsSelected" class="form-control" id="documents" multiple ref="documents"
                       type="file" v-if="!exists">
                <div v-else>
                    <span v-for="document in correction.documents"
                          v-html="downloadable(document.id)" style="display: block;"></span>
                </div>
            </div>
            <div class="col-md-2">
                <button @click="remove" class="btn btn-sm btn-danger" v-if="exists">Delete</button>
                <button @click="save" class="btn btn-sm btn-success" v-if="!exists">Save</button>
            </div>
        </div>
    </div>


</template>

<script>

    export default {

        props: {
            initial_id: {
                required: false,
                default: null,
            },
        },

        data() {
            return {
                correction: {
                    note: null,
                    id: null,
                    documents: []
                }
            }
        },

        created() {
            if (this.initial_id !== null) {
                this.$http.get('/exitingtreasurer/api/correction/' + this.initial_id)
                    .then(response => {
                        this.correction.id = response.data.id;
                        this.correction.documents = response.data.treasurer_sign_off_documents;
                        this.correction.note= response.data.note;
                    })
                    .catch(error => this.$http.error('Could not find your corrections: ' + error.message));
            }
        },

        methods: {
            downloadable(id) {
                return '<a href="' + '/exitingtreasurer/download/' + id + '">Download</a>';
            },

            documentsSelected() {
                this.correction.documents = this.$refs.documents.files;
            },

            save() {
                let formData = new FormData();
                for (let i = 0; i < this.correction.documents.length; i++) {
                    formData.append('documents[' + i + ']', this.correction.documents[i]);
                }
                formData.append('note', this.correction.note);
                // Save or update
                if (this.initial_id === null) {
                    this.$http.post('/exitingtreasurer/api/correction', formData)
                        .then(response => {
                            this.$notify.success('Corrections saved');
                            this.correction.id = response.data.id;
                            this.correction.documents = response.data.treasurer_sign_off_documents;
                            this.correction.note= response.data.note;
                            this.$emit('created', this.correction.id);
                        })
                        .catch(error => this.$notify.alert('Could not save corrections: ' + error.message));


                }
            },

            remove() {
                if (confirm('Are you sure you wish to remove the correction?')) {
                    this.$http.delete('/exitingtreasurer/api/correction/' + this.correction.id)
                        .then(response => {
                            this.$notify.info('Correction deleted');
                            this.$emit('remove', this.correction.id);
                            this.reset();
                        })
                        .catch(error => this.$notify.alert('Correction could not be deleted: ' + error.message));
                }
            },

            reset() {
                this.correction = {
                    note: null,
                    id: null,
                    documents: []
                }
            }

        },

        computed: {
            exists() {
                return this.correction.id !== null;
            },

        }

    }
</script>

<style scoped>

</style>