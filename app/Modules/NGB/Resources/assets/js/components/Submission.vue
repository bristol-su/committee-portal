<template>
    <div style="text-align: center;">
        <div v-if="loading">
            Loading...
        </div>
        <div v-else-if="completed">
            You've submitted this! You said:

            <br/><br/>
            "{{form.statement}}"
        </div>
        <div v-else>
                <div class="form-group">

                    <textarea class="form-control-lg" style="width: 80%;" rows="5" v-model="form.statement">

                    </textarea>

                    <span class="has-error-span" v-if="form.errors.has('statement')">{{form.errors.get('statement')}}</span>
                </div>

                <button @click="submit" class="btn btn-info">Submit</button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                form: new VueForm({
                    statement: ''
                }),
                completed: false,
                loading: true
            }
        },

        created() {
            this.form.shouldReset = false;
            this.$http.get('/ngb/complete')
                .then(response => {
                    this.form.statement = response.data.statement;
                    this.completed = true;
                })
                .catch(error => this.completed = false)
                .then(() => this.loading = false)
        },
        methods: {
            submit() {
                this.form.post('/ngb')
                    .then(response => {
                        this.$notify.success('Statement Submitted!');
                        this.completed = true;
                    })
                    .catch(error => this.$notify.alert('There was an error processing your statement.'))
            }
        }
    }
</script>

<style>

</style>