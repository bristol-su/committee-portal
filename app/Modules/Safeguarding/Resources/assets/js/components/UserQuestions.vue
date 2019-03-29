<template>
    <div>

        <div class="card" v-if="questions.length > 0" v-for="question in questions">
            <div class="card-body">

                <h5 class="card-title">{{question.name}}</h5>

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

        <div v-else>
            Loading...
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                questions: [],
                form: new VueForm()
            }
        },

        created() {
            this.$http.get('/safeguarding/questions')
                .then(response => this.questions = response.data)
                .catch(error => this.$notify.alert('Could not load the questions'));
            this.form.shouldReset = false;
        },

        methods: {
            submit() {
                this.form.post('/safeguarding/questions')
                    .then(response => console.log(response))
                    .catch(error => this.$notify.alert('Could not check your answers: '+error.message));
            }
        }
    }
</script>