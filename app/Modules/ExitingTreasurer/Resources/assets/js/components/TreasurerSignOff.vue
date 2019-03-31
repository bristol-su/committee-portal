<template>
    <div class="container">
        <br/>
        <br/>
        <hr/>
        <div class="row">
            <div class="col-xs-12">
                <unauthorized-expense-claims>

                </unauthorized-expense-claims>
            </div>
        </div>

        <br/>
        <br/>
        <hr/>
        <div class="row">
            <div class="col-xs-12">
                <outstanding-invoices>

                </outstanding-invoices>
            </div>
        </div>

        <br/>
        <br/>
        <hr/>
        <div class="row">
            <div class="col-xs-12">
                <missing-income-and-expenditures>

                </missing-income-and-expenditures>
            </div>
        </div>

        <br/>
        <br/>
        <hr/>
        <div class="row">
            <div class="col-xs-12">
                <corrections>

                </corrections>
            </div>
        </div>

        <br/>
        <br/>
        <hr/>

        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="confirm"> Do you confirm that, other than the corrections that you have notified us of
                        above, that the student group balance as shown on the Income and Expenditure Analysis Report and
                        Transaction list is correct?</label>
                    <input id="confirm" type="checkbox" v-model="confirmed">

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <button @click="submit" class="btn btn-info">Submit</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import UnauthorizedExpenseClaims from './SignOff/UnauthorizedExpenseClaims';
    import OutstandingInvoices from './SignOff/OutstandingInvoices';
    import MissingIncomeAndExpenditures from './SignOff/MissingIncomeAndExpenditures';
    import Corrections from './SignOff/Corrections';

    export default {
        components: {
            UnauthorizedExpenseClaims,
            OutstandingInvoices,
            MissingIncomeAndExpenditures,
            Corrections
        },

        data() {
            return {
                confirmed: false
            }
        },

        methods: {
            submit() {
                if(this.confirmed === true) {
                    this.$notify.success('Submitting!')
                } else {
                    this.$notify.alert('Please confirm this information is complete');
                }
            }
        }
    }
</script>

<style>
    .container {
        text-align: center;
    }

    .row {
        width: 100%;
    }

    .col-xs-12 {
        width: 100%;
    }
</style>