<template>

    <div class="container" style="padding: 5px;">
        <div class="row form-group">
            <label class="col-md-4 control-label" for="sort_code">Sort Code</label>
            <div class="col-md-8">
                <input id="sort_code" type="text" placeholder="e.g. 00-00-00" class="form-control input-md" v-model="form.sort_code">
                <span class="has-error-span" v-if="form.errors.has('sort_code')">{{form.errors.get('sort_code')}}</span>
            </div>
        </div>

        <div class="row form-group">
            <label class="col-md-4 control-label" for="account_number">Account Number</label>
            <div class="col-md-8">
                <input id="account_number" type="text" placeholder="e.g. 00000000" class="form-control input-md" v-model="form.account_number">
                <span class="has-error-span" v-if="form.errors.has('account_number')">{{form.errors.get('account_number')}}</span>
            </div>
        </div>

        <div class="row form-group">
            <label class="col-md-4 control-label" for="bank_name">Bank Name</label>
            <div class="col-md-8">
                <input id="bank_name" type="text" placeholder="" class="form-control input-md" v-model="form.bank_name">
                <span class="has-error-span" v-if="form.errors.has('bank_name')">{{form.errors.get('bank_name')}}</span>
            </div>
        </div>

        <div class="row form-group">
            <label class="col-md-4 control-label" for="account_name">Account Name</label>
            <div class="col-md-8">
                <input id="account_name" type="text" placeholder="" class="form-control input-md" v-model="form.account_name">
                <span class="has-error-span" v-if="form.errors.has('account_name')">{{form.errors.get('account_name')}}</span>
            </div>
        </div>

        <div class="row form-group">
            <label class="col-md-4 control-label" for="purpose">Account Purpose</label>
            <div class="col-md-8">
                <input id="purpose" type="text" placeholder="" class="form-control input-md" v-model="form.purpose">
                <span class="has-error-span" v-if="form.errors.has('purpose')">{{form.errors.get('purpose')}}</span>
            </div>
        </div>

        <button type="button" class="btn btn-info" @click="addAccount">Create New Account</button>
    </div>
</template>

<script>
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
                this.form.post('/externalaccounts/account')
                    .then(response => {
                        this.$notify.success('Account Added');
                        console.log(response);
                        this.$emit('newAccount', response);
                        this.$emit('close');
                    })
                    .catch(error => {
                        this.$notify.alert('Account could not be added: '+error.message);
                    })
            }
        }

    }
</script>

<style scoped>

</style>