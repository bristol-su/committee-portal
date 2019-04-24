<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-title">
                        Upload an end of year statement for {{account.name}}
                    </div>
                    <div class="card-subtitle">
                        <div class="row">
                            <div class="col-md-12">
                                Your end of year statement...
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="custom-file-label" for="statement">
                                    End of Year Bank Statement
                                </label>
                                <input @change="add_statement" class="custom-file-input"
                                       id="statement"
                                       type="file"/>
                            </div>
                            <div class="col-md-12" v-if="statement !== null">
                                File: {{statement.name}}
                            </div>
                            <div class="col-md-12">
                                <span class="has-error-span" v-if="errors.has('statement')">{{errors.get('statement')}}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <button @click="uploadStatement" class="btn btn-lg btn-outline-info" type="button">Upload End of Year Statement
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import Errors from "../../../../../../../../../resources/js/utilities/Errors";

    export default {
        name: "EoYForm",

        props: {
            account: {
                required: true,
                type: Object
            }
        },

        data() {
            return {
                statement: null,
                errors: new Errors()
            }
        },

        methods: {
            add_statement(event) {
                this.statement = event.target.files[0]
            },

            uploadStatement() {
                let formData = new FormData();
                formData.append('statement', this.statement);
                this.errors.clear();
                this.$http.post('externalaccounts/account/eoy/' + this.account.id, formData)
                    .then(response => {
                        this.$notify.success('Statement Saved');
                        this.$emit('accountChanged', response.data);
                        this.$emit('close');
                    })
                    .catch(error => {
                        this.$notify.alert('Statement could not be uploaded');
                        this.errors.record(error.response.data.errors);
                    })
            }
        }
    }
</script>

<style scoped>

</style>