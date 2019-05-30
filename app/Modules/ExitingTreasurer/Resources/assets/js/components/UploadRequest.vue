<template>
    <div>
        <div>
            <button class="btn btn-sm btn-success" @click="$bvModal.show(modalMeta.id)">New Upload Request</button>
        </div>

        <b-modal :id="modalMeta.id" :title="modalMeta.title">

            <b-form @submit.prevent="newRequest" @reset="resetForm">

<!--                Society-->
                <b-form-group
                    label="Society:"
                    label-for="society"
                    description="Choose the society to create a request for"
                    >
                    <b-form-select
                        id="society"
                        v-model="form.society"
                        :options="societyOptions"
                        required>

                    </b-form-select>
                </b-form-group>

<!--                Accounts -->
                <b-form-group
                    label="Accounts:"
                    label-for="accounts"
                    description="Which of the society accounts should the request be made against?"
                    v-if="form.society !== null">

                    <b-form-checkbox-group
                            id="accounts"
                            v-model="form.accounts"
                            :options="accountOptions"
                            name="GroupAccount"
                    ></b-form-checkbox-group>

                </b-form-group>
                <button type="submit" class="btn btn-success">Create Document Request</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </b-form>

        </b-modal>
    </div>
</template>

<script>
    export default {
        name: "UploadRequest",

        data() {
            return {
                modalMeta: {
                    id: 'modal',
                    title: 'New Financial Document Request'
                },
                societies: [],
                form: new VueForm({
                    society: null,
                    accounts: []
                }),
            }
        },

        mounted() {
            this.loadSocieties();
        },

        methods: {
            loadSocieties() {
                this.$http.get('/admin/exitingtreasurer/upload-request/groups')
                    .then(response => {
                        this.societies = response.data;
                    })
                    .catch(error => {
                        this.$notify.alert('Failed loading societies: '+error.message);
                    })
            },

            newRequest() {
                this.form.post('/admin/exitingtreasurer/upload-request')
                    .then(response => {
                        this.$notify.success('Financial request created');
                        window.location.reload();
                    })
                    .catch(error => {
                        this.$notify.alert('Something went wrong creating a financial request: '+error.message)
                    });
            },

            resetForm() {
                this.form.reset();
            }
        },

        computed: {
            societyOptions() {
                return this.societies.map(society => {
                    return {
                        text: society.name,
                        value: society.id
                    }
                })
            },

            accountOptions() {
                if(this.form.society === null || this.form.society === "") {
                    return [];
                }
                let society = this.societies.filter(society => society.id === this.form.society)[0];
                return society.accounts.map(account => {
                    return {
                        text: account.code,
                        value: account.id
                    }
                });
            },

        }
    }
</script>

<style scoped>

</style>