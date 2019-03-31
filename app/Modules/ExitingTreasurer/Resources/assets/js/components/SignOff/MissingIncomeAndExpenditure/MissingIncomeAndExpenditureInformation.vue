<template>
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <input class="form-control" type="text" v-model="missing_i_and_e.note">
            </div>
            <div class="col-md-5">
                <input @change="documentsSelected" class="form-control" id="documents" multiple ref="documents"
                       type="file">
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
                missing_i_and_e: {
                    note: null,
                    id: null,
                    documents: []
                }
            }
        },

        created() {
            if (this.initial_id !== null) {
                this.$http.get('/exitingtreasurer/api/missing-i-and-e/' + this.initial_id)
                    .then(response => {
                        this.missing_i_and_e = response.data;
                    })
                    .catch(error => this.$http.error('Could not find your income and expenditures: ' + error.message));
            }
        },

        methods: {
            documentsSelected() {
                this.missing_i_and_e.documents = this.$refs.documents.files;
            },

            save() {
                let formData = new FormData();
                for (let i = 0; i < this.missing_i_and_e.documents.length; i++) {
                    formData.append('documents[' + i + ']', this.missing_i_and_e.documents[i]);
                }
                formData.append('note', this.missing_i_and_e.note);
                // Save or update
                if (this.initial_id === null) {
                    this.$http.post('/exitingtreasurer/api/missing-i-and-e', formData)
                        .then(response => {
                            this.$notify.success('Missing Income and Expenditure data saved');
                            this.missing_i_and_e = response.data;
                            this.$emit('created', this.missing_i_and_e.id);
                        })
                        .catch(error => this.$notify.alert('Could not save the missing income and expenditure data: ' + error.message));


                }
            },

            remove() {
                if (confirm('Are you sure you wish to remove the note?')) {
                    this.$http.delete('/exitingtreasurer/api/missing-i-and-e/' + this.missing_i_and_e.id)
                        .then(response => {
                            this.$notify.info('Note deleted');
                            this.$emit('remove', this.missing_i_and_e.id);
                            this.reset();
                        })
                        .catch(error => this.$notify.alert('Note could not be deleted: ' + error.message));
                }
            },

            reset() {
                this.missing_i_and_e = {
                    note: null,
                    id: null,
                    documents: []
                }
            }

        },

        computed: {
            exists() {
                return this.initial_id !== null;
            },

        }

    }
</script>

<style scoped>

</style>