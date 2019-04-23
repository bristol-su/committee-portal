<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-title">
                        Mark account {{account.account_name}} as closed
                    </div>
                    <div class="card-subtitle">
                        <div class="row">
                            <div class="col-md-12">
                                In order to close your account, we require from you...
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="custom-file-label" for="final_bank_statement">
                                    Final Bank Statement
                                </label>
                                <input @change="add_final_bank_statement" class="custom-file-input"
                                       id="final_bank_statement"
                                       type="file"/>
                            </div>
                            <div class="col-md-12" v-if="final_bank_statement !== null">
                                File: {{final_bank_statement.name}}
                            </div>
                            <div class="col-md-12">
                                <span class="has-error-span" v-if="errors.has('final_bank_statement')">{{errors.get('final_bank_statement')}}</span>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12 custom-file">
                                <label class="custom-file-label" for="confirmation_of_closure">
                                    Confirmation of Closure
                                </label>
                                <input @change="add_confirmation_of_closure" class="custom-file-input"
                                       id="confirmation_of_closure"
                                       type="file"/>
                            </div>
                            <div class="col-md-12" v-if="confirmation_of_closure !== null">
                                File: {{confirmation_of_closure.name}}
                            </div>
                            <div class="col-md-12">
                                <span class="has-error-span" v-if="errors.has('confirmation_of_closure')">{{errors.get('confirmation_of_closure')}}</span>
                            </div>                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="closed_on">
                                    Closed On
                                </label>
                                <input class="form-control-sm" id="closed_on" type="date"
                                       v-model="closed_on"/>
                            </div>
                            <div class="col-md-12">
                                <span class="has-error-span" v-if="errors.has('closed_on')">{{errors.get('closed_on')}}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <button @click="closeAccount" class="btn btn-lg btn-outline-danger" type="button">Mark
                                    Account as Closed
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
        name: "CloseAccountForm",

        props: {
            account: {
                required: true,
                type: Object
            }
        },

        data() {
            return {
                final_bank_statement: null,
                confirmation_of_closure: null,
                closed_on: null,
                errors: new Errors()
            }
        },

        methods: {
            add_final_bank_statement(event) {
                this.final_bank_statement = event.target.files[0]
            },

            add_confirmation_of_closure(event) {
                this.confirmation_of_closure = event.target.files[0]
            },

            closeAccount() {
                let formData = new FormData();
                formData.append('final_bank_statement', this.final_bank_statement);
                formData.append('confirmation_of_closure', this.confirmation_of_closure);
                formData.append('closed_on', this.closed_on);
                this.errors.clear();
                this.$http.post('externalaccounts/account/closure/' + this.account.id, formData)
                    .then(response => {
                        this.$notify.success('Account Saved');
                        this.$emit('accountClosed', response);
                        this.$emit('close');
                    })
                    .catch(error => {
                        this.$notify.alert('Files could not be uploaded');
                        this.errors.record(error.response.data.errors);
                    })
            }
        }
    }
</script>

<style scoped>

</style>