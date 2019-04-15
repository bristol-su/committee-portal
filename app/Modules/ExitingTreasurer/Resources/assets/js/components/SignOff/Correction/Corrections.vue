<template>
    <div>
        <div>
            <div class="row">
                <div class="col-xs-12">

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
                    <correction-information
                            :initial_id="payload.data.id"
                            @created="save"
                            @remove="remove">

                    </correction-information>
                </div>


            </div>
        </div>


    </div>

</template>

<script>
import CorrectionInformation from './CorrectionInformation';
import YesNoRadio from "../../YesNoRadio";

    export default {

        props: {
            initialPayload: {
                required: false,
                default: null
            }
        },

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
            CorrectionInformation
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
            },

            created() {
                if (this.initialPayload.data !== null) {
                    this.payload.id = this.initial_payload.data.id;
                }
            }
        },

        created() {
            if(this.initialPayload.data !== null) {
                this.payload.data.id = this.initialPayload.data.id;
                this.payload.present = this.initialPayload.present;
            }
        }
    }

</script>

<style>

</style>