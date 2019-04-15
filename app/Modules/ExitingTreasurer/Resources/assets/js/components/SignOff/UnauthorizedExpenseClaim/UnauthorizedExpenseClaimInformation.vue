<template>
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <input class="form-control" type="text" v-model="claim.pqu_number" v-if="!exists">
                <p v-else>{{claim.pqu_number}}</p>
            </div>
            <div class="col-md-5">
                <input class="form-control" type="text" v-model="claim.note" v-if="!exists">
                <p v-else>{{claim.note}}</p>
            </div>
            <div class="col-md-2">
                <button @click="remove" class="btn btn-sm btn-danger" v-if="exists">Delete</button>
                <button @click="save" class="btn btn-sm btn-success" v-else>Add</button>
            </div>
        </div>
    </div>


</template>

<script>

    import _ from 'lodash';
    export default {

        props: {
            initial_id: {
                required: false,
                default: null,
            },
        },

        data() {
            return {
                claim: {
                    pqu_number: null,
                    note: null,
                    id: null,
                },
                original_claim: {
                    pqu_number: null,
                    note: null,
                    id: null,
                }
            }
        },

        created() {
            if (this.initial_id !== null) {
                this.$http.get('/exitingtreasurer/api/expense-claims/' + this.initial_id)
                    .then(response => {
                        this.claim = response.data;
                        this.original_claim = Object.assign({}, this.claim);
                    })
                    .catch(error => this.$http.error('Could not find your expense claims: ' + error.message));
            }
        },
        
        watch: {
            initial_id(id) {
                if (id !== null) {
                    this.$http.get('/exitingtreasurer/api/expense-claims/' + id)
                        .then(response => {
                            this.claim = response.data;
                            this.original_claim = Object.assign({}, this.claim);
                        })
                        .catch(error => this.$http.error('Could not find your expense claims: ' + error.message));
                }
            }
        },
        
        methods: {
            save() {
                // Save or update
                if (this.initial_id === null) {
                    this.$http.post('/exitingtreasurer/api/expense-claims', this.claim)
                        .then(response => {
                            this.$notify.success('Expense claim saved');
                            this.claim = response.data;
                            this.original_claim = Object.assign({}, this.claim);
                            this.$emit('created', this.claim.id);
                            this.reset();
                        })
                        .catch(error => this.$notify.alert('Could not save the unauthorized expense claim: ' + error.message));


                } else {
                    this.$http.post('/exitingtreasurer/api/expense-claims/' + this.claim.id, this.claim)
                        .then(response => {
                            this.$notify.success('Expense claim saved');
                            this.claim = response.data;
                            this.original_claim = Object.assign({}, this.claim);
                        })
                        .catch(error => this.$notify.alert('Could not save the unauthorized expense claim: ' + error.message));
                }
            },

            remove() {
                if (confirm('Are you sure you wish to remove PQU ' + this.claim.pqu_number + ' from the unauthorized list?')) {
                    this.$http.delete('/exitingtreasurer/api/expense-claims/' + this.claim.id)
                        .then(response => {
                            this.$notify.info('PQU ' + this.claim.pqu_number + ' deleted');
                            this.$emit('remove', this.claim.id);
                        })
                        .catch(error => this.$notify.alert('PQU ' + this.claim.pqu_number + ' could not be deleted'));
                }
            },

            reset() {
                this.claim = {
                    pqu_number: null,
                    note: null,
                    id: null,
                };
                this.original_claim = {
                    pqu_number: null,
                    note: null,
                    id: null,
                }
            }
        },

        computed: {
            exists() {
                return this.initial_id !== null;
            },

            changed() {
                return !_.isEqual(this.claim, this.original_claim);
            }
        }

    }
</script>

<style scoped>

</style>