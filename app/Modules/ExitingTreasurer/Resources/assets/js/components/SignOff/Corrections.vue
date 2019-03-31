<template>
    <div>
        <div class="row">
            <div class="col-xs-12">
                <h3>Corrections</h3>
                <h4><small>Are there any corrections that need to be made?
                </small></h4>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">


                <div class="custom-controls-stacked">
                    <div class="custom-control custom-radio" style="text-align: left;">
                        <input
                                :value="false"
                                class="custom-control-input"
                                id="no_corrections"
                                name="corrections_exist"
                                type="radio"
                                v-model="form.has_corrections"
                        >
                        <label
                                class="custom-control-label"
                                for="no_corrections">
                            No.
                        </label>
                    </div>
                    <div class="custom-control custom-radio" style="text-align: left;">
                        <input
                                :value="true"
                                class="custom-control-input"
                                id="corrections"
                                name="corrections_exist"
                                type="radio"
                                v-model="form.has_corrections"
                        >
                        <label
                                class="custom-control-label"
                                for="corrections">
                            Yes.
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" v-if="form.has_corrections">
            <div class="col-md-12">
                Something here to add corrections

                Please provide as much information as you can about the required correction. For example, the amount, the error, and the correction needed.

                A free text field to allow the treasurer to describe what’s missing / and the possibility to upload any relevant correspondence as a pdf or similar.
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
                    has_corrections: null,
                })
            }
        }
    }

</script>

<style>

</style>