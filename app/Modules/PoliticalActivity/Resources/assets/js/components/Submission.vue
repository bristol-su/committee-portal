<template>
    <div style="text-align: center;">
        <div v-if="loading">
            Loading...
        </div>
        <div v-else-if="completed">
            You've accepted this!
        </div>
        <div v-else>
            <form @submit.prevent="confirm_read">
                <div class="form-group">

                    <input type="checkbox" id="check_confirm_read" v-model="accepted"/>
                    <label for="check_confirm_read">I confirm ...</label>
                </div>

                <button type="submit" class="btn btn-info">Confirm</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                accepted: false,
                completed: false,
                loading: true
            }
        },

        created() {
            this.$http.get('/politicalactivity/complete')
                .then(response => this.completed = true)
                .catch(error => this.completed = false)
                .then(() => this.loading = false)
        },
        methods: {
            confirm_read() {
                if(this.accepted) {
                    this.$http.post('/politicalactivity')
                        .then(response => {
                            this.$notify.success('Confirmed!');
                            this.completed = true;
                        })
                        .catch(error => this.$notify.alert('There was an error processing your confirmation.'))
                } else {
                    alert('Please accept the content on this page.');
                }
            }
        }
    }
</script>

<style>

</style>