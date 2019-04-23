<template>
    <div>
        <div v-if="loading">
            Loading...
        </div>
        <div v-else-if="this.completed === true">
            You've completed this training.
        </div>
        <div v-else>
            <div class="card" v-if="questions.length > 0" v-for="(question, index) in questions">
                <div class="card-body">

                    <h5 class="card-title">{{question.name}}</h5>
                    <span class="has-error-span" v-if="hasErrors(index)">Incorrect answers</span>

                    <div class="form-group" style="text-align: left; margin-left: 20%">
                        <div v-for="answer in question.answers">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" v-model="form['id_'+answer.id]" :id="'answer_' + answer.id">
                                <label class="form-check-label" :for="'answer_' + answer.id">
                                    {{answer.name}}
                                </label>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card" v-if="questions.length > 0">
                <div class="card-body">

                    <div class="form-group" style="text-align: left; margin-left: 20%">
                        <button type="submit" class="btn btn-info btn-lg" style="width: 80%; margin: auto;" @click="submit">Check answers</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
    export default {
        data() {
            return {
                questions: [],
                form: {},
                loading: true,
                completed: false,
            }
        },

        created() {
            this.$http.post('/incomingtreasurer/completed')
                .then(response => this.completed = true)
                .catch(error => this.completed = false);
            this.$http.get('/incomingtreasurer/questions')
                .then(response => {
                    this.questions = response.data;
                    let formdata = {};
                    this.questions.map(question => {
                        question.answers.map(answer => {
                            formdata['id_' + answer.id] = false;
                        })
                    });
                    this.form = new VueForm(formdata);
                    this.form.shouldReset = false;
                })
                .catch(error => this.$notify.alert('Could not load the questions'))
                .then(() => this.loading = false);
        },

        methods: {
            submit() {
                this.form.errors.clear();
                this.form.post('/incomingtreasurer/questions')
                    .then(response => {
                        this.completed = true;
                        this.$notify.success('Congratulations, you\'ve passed the treasurer training!');
                    })
                    .catch(error => {
                        if(error.response.status === 422) {
                            this.$notify.alert('Some of your answers weren\'t correct!');
                        } else {
                            this.$notify.alert('Something went wrong checking your answers. Please refresh the page.');
                        }
                        this.form.errors.clear();
                        this.form.errors.record(error.response.data.errors);
                    });
            },
            hasErrors(index) {
                return this.questions[index].answers.filter(answer => {
                    return this.form.errors.has('id_' + answer.id);
                }).length > 0;
            }
        },

        computed: {

        }
    }
</script>