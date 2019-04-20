<template>

    <div class="container" style="padding: 5px;">
        <div class="row form-group">
            <label class="col-md-4 control-label" for="sort_code">Sort Code</label>
            <div class="col-md-8">
                <input class="form-control input-md" id="sort_code" placeholder="e.g. 00-00-00" type="text"
                       v-model="form.sort_code">
                <span class="has-error-span" v-if="form.errors.has('sort_code')">{{form.errors.get('sort_code')}}</span>
            </div>
        </div>

        <div class="row form-group">
            <label class="col-md-4 control-label" for="account_number">Account Number</label>
            <div class="col-md-8">
                <input class="form-control input-md" id="account_number" placeholder="e.g. 00000000" type="text"
                       v-model="form.account_number">
                <span class="has-error-span" v-if="form.errors.has('account_number')">{{form.errors.get('account_number')}}</span>
            </div>
        </div>

        <div class="row form-group">
            <label class="col-md-4 control-label" for="bank_name">Bank Name</label>
            <div class="col-md-8">
                <input class="form-control input-md" id="bank_name" placeholder="" type="text" v-model="form.bank_name">
                <span class="has-error-span" v-if="form.errors.has('bank_name')">{{form.errors.get('bank_name')}}</span>
            </div>
        </div>

        <div class="row form-group">
            <label class="col-md-4 control-label" for="account_name">Account Name</label>
            <div class="col-md-8">
                <input class="form-control input-md" id="account_name" placeholder="" type="text"
                       v-model="form.account_name">
                <span class="has-error-span"
                      v-if="form.errors.has('account_name')">{{form.errors.get('account_name')}}</span>
            </div>
        </div>

        <div class="row form-group">
            <label class="col-md-4 control-label" for="purpose">Account Purpose</label>
            <div class="col-md-8">
                <input class="form-control input-md" id="purpose" placeholder="" type="text" v-model="form.purpose">
                <span class="has-error-span" v-if="form.errors.has('purpose')">{{form.errors.get('purpose')}}</span>
            </div>
        </div>

        <button @click="addAccount" class="btn btn-info" type="button">Create New Account</button>
    </div>
</template>

<script>

    import UkModulusChecking from 'uk-modulus-checking';

    export default {
        name: "ExternalAccountsForm",

        data() {
            return {
                form: new VueForm({
                    sort_code: null,
                    account_number: null,
                    bank_name: null,
                    account_name: null,
                    purpose: null
                })
            }
        },

        created() {
            this.form.shouldReset = false;
        },

        methods: {
            addAccount() {
                console.log(new UkModulusChecking({
                    accountNumber: this.form.account_number,
                    sortCode: this.form.sort_code
                }).isValid())
                if (new UkModulusChecking({
                        accountNumber: this.form.account_number,
                        sortCode: this.form.sort_code
                    }).isValid()
                    || confirm('We couldn\'t validate your bank details, are you sure they\'re correct? Click \'Cancel\' to go back and check.')) {
                    this.form.post('/externalaccounts/account')
                        .then(response => {
                            this.$notify.success('Account Added');
                            console.log(response);
                            this.$emit('newAccount', response);
                            this.$emit('close');
                        })
                        .catch(error => {
                            this.$notify.alert('Account could not be added: ' + error.message);
                        })
                }
            }

        }

    }
</script>

<style scoped>

</style>