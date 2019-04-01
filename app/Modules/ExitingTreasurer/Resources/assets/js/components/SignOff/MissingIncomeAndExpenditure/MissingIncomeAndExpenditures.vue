<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <h3>Missing Income or Expenditure</h3>
                <h4>
                    <small>Is there any other income or expenditure missing from the reports?
                    </small>
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <yes-no-radio
                        no="No"
                        v-model="payload.present"
                        yes="Yes"
                ></yes-no-radio>

            </div>
        </div>

        <div class="row" v-if="payload.present">
            <div class="col-md-12">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            Note
                        </div>
                        <div class="col-md-5">
                            Documents
                        </div>
                        <div class="col-md-2">

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <missing-income-and-expenditure-information
                        :initial_id="payload.data.id"
                        @created="save"
                        @remove="remove">

                </missing-income-and-expenditure-information>
            </div>


        </div>

    </div>
</template>

<script>
    import MissingIncomeAndExpenditureInformation from './MissingIncomeAndExpenditureInformation';
    import YesNoRadio from "../../YesNoRadio";

    export default {
        data() {
            return {
                payload: {
                    present: null,
                    data: {
                        id: null,
                    }
                }
            }
        },

        components: {
            YesNoRadio,
            MissingIncomeAndExpenditureInformation
        },

        watch: {
            payload: {
                handler(payload) {
                    this.$emit('payloadUpdated', payload);
                },
                deep: true
            }
        },

        methods: {
            save(id) {
                this.payload.data.id = id;
            },

            remove() {
                this.payload.data.id = null;
            }
        }
    }

</script>

<style>

</style>