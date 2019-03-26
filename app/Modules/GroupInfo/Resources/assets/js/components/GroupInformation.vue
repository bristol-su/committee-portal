<template>

    <div>

        <form @submit.prevent="saveInformation" v-if="questions.length > 0">
            <hr/>

            <div v-for="question in questions">
                <div class="form-group row">
                    <label :for="question.identity" class="col-4 col-form-label" style="font-weight: bold;">
                        {{question.name}}
                    </label>
                    <div class="col-8">

                        <div v-if="question.type === 'select'">
                            <!-- Select -->
                            <select
                                    :aria-describedby="question.identity + 'HelpBlock'"
                                    :id="question.identity"
                                    :name="question.identity"
                                    :required="question.required"
                                    class="custom-select"
                                    v-model="form[question.identity]">
                                <option
                                        :value="value"
                                        v-for="(configuration, value) in question.configuration">
                                    {{configuration.text}}
                                </option>
                            </select>
                        </div>


                        <div v-else-if="question.type === 'text'">
                            <!-- Text -->
                            <input
                                    :aria-describedby="question.identity + 'HelpBlock'"
                                    :id="question.identity"
                                    :name="question.identity"
                                    :required="question.required"
                                    class="form-control"
                                    type="text"
                                    v-model="form[question.identity]">
                        </div>


                        <div v-else-if="question.type === 'radio'">
                            <!-- Radio -->
                            <div class="custom-controls-stacked"
                                 v-for="(configuration, value) in question.configuration">
                                <div class="custom-control custom-radio" style="text-align: left;">
                                    <input
                                            :aria-describedby="question.identity + 'HelpBlock'"
                                            :id="question.identity + '_' + value"
                                            :name="question.identity"
                                            :required="question.required"
                                            :value="value"
                                            class="custom-control-input"
                                            type="radio"
                                            v-model="form[question.identity]"
                                    >
                                    <label
                                            :for="question.identity + '_' + value"
                                            class="custom-control-label">
                                        {{configuration.text}}
                                    </label>
                                </div>
                                <input
                                        :aria-describedby="question.identity + 'HelpBlock'"
                                        :id="question.identity + '_' + value + '_data'"
                                        :placeholder="configuration.textbox.placeholder"
                                        class="form-control"
                                        type="text"
                                        v-if="configuration.textbox !== undefined && form[question.identity] === value"
                                        v-model="form[question.identity + '_' + value + '_data']">
                            </div>
                        </div>


                        <small><span class="error-span" v-show="form.errors.has(question.identity)"
                                     v-text="form.errors.get(question.identity)">

                        </span></small>

                        <span :id="question.identity + 'HelpBlock'"
                              class="form-text text-muted"
                              style="text-align: left;">{{question.helpText}}</span>
                    </div>
                </div>
                <hr/>
            </div>


            <div class="form-group row">
                <div class="offset-4 col-8">
                    <button class="btn btn-primary" name="submit" type="submit" :disabled="submitting">Save</button>
                </div>
            </div>

        </form>


        <div v-else-if="loading === true">
            Loading...
        </div>

        <div v-else>
            Error
        </div>

    </div>
</template>

<script>

    export default {
       data() {
            return {
                form: {},
                loading: true,
                questions: {},
                submitting: false
            }
        },

        created() {

            this.$http.get('/groupinfo/questions')
                .then(response => {
                    this.questions = response.data.questions;
                    let answers = response.data.answers;
                    let formData = {};
                    let i = 0;
                    this.questions.forEach(question => {
                        // Set the form index to model
                        formData[question.identity] = answers[question.identity];
                        if (question.configuration.length !== 0) {
                            Object.keys(question.configuration).forEach(key => {
                                if (question.configuration[key].textbox !== undefined) {
                                    formData[question.identity + '_' + key + '_data'] = answers[question.identity + '_' + key + '_data']
                                }
                            });
                        }
                    });
                    this.form = new VueForm(formData);
                    this.form.shouldReset = false;
                })
                .catch(error => this.$notify.alert('Could not load your group: ' + error.message))
                .then(() => this.loading = false);
        },

        methods: {
            saveInformation() {
                this.submitting = true;
                this.form.post('/groupinfo')
                    .then(response => this.$notify.success('Group updated'))
                    .catch(error => this.$notify.alert('Group couldn\'t be updated: ' + error.message))
                    .then(() => this.submitting = false);
            }
        }
    }

</script>

<style>

</style>