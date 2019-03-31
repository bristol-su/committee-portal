<template>
    <div>
        <div class="row">
            <div class="col-xs-12">
                <h3>Missing Income or Expenditure</h3>
                <h4>
                    <small>Is there any other income or expenditure missing from the reports?
                    </small>
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">


                <div class="custom-controls-stacked">
                    <div class="custom-control custom-radio" style="text-align: left;">
                        <input
                                :value="false"
                                class="custom-control-input"
                                id="no_missing_income_and_expenditure"
                                name="missing_income_and_expenditure_exists"
                                type="radio"
                                v-model="form.has_missing_income_and_expenditure"
                        >
                        <label
                                class="custom-control-label"
                                for="no_missing_income_and_expenditure">
                            No.
                        </label>
                    </div>
                    <div class="custom-control custom-radio" style="text-align: left;">
                        <input
                                :value="true"
                                class="custom-control-input"
                                id="missing_income_and_expenditure"
                                name="missing_income_and_expenditure_exists"
                                type="radio"
                                v-model="form.has_missing_income_and_expenditure"
                        >
                        <label
                                class="custom-control-label"
                                for="missing_income_and_expenditure">
                            Yes.
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" v-if="form.has_missing_income_and_expenditure">
            <div class="col-md-12">
                Something here to add new income and expenditure

                Please provide as much information as you can about the missing income or expenditure. For example
                whether it was income or expenditure, the amount, what it was for, relevant dates, and refer to any
                earlier correspondence with Student Services or the Finance Team.


                A free text field to allow the treasurer to describe what’s missing / and the possibility to upload any
                relevant correspondence as a pdf or similar.
            </div>
        </div>

    </div>
</template>

<script>
    import Form from "../../../../../../../../resources/js/utilities/Form";

    export default {
        data() {
            return {
                form: new Form({
                    has_missing_income_and_expenditure: null,
                })
            }
        }
    }

</script>

<style>

</style>