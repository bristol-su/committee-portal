<template>
    <div class="container" style="margin: 2%;">

        <div style="display: flex; justify-content: space-evenly;">
            <div class="display: inline-block; ">
                <h2>{{formTitle}}</h2>
            </div>
            <div class="float: right;">
                <button @click="cancel" class="btn btn-danger btn-sm">Cancel</button>
                <button @click="save" class="btn btn-success btn-sm">{{submitText}}</button>
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <div class="col-md-12">
                Forename:
                <input class="form-control input-md" id="forename" name="forename" placeholder="Forename" required=""
                       type="text" v-model="form.forename">
                <small><span class="error-span" v-show="this.form.errors.has('forename')">{{this.form.errors.get('forename')}}</span>
                </small>

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <div class="col-md-12">
                Surname:
                <input class="form-control input-md" id="surname" name="surname" placeholder="Surname" required=""
                       type="text" v-model="form.surname">
                <small><span class="error-span" v-show="this.form.errors.has('surname')">{{this.form.errors.get('surname')}}</span>
                </small>

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <div class="col-md-12">
                Student ID:
                <input class="form-control input-md" id="student_id" name="student_id"
                       placeholder="Student ID e.g. xy12345"
                       type="text" v-model="form.student_id">
                <small><span class="error-span" v-show="this.form.errors.has('student_id')">{{this.form.errors.get('student_id    ')}}</span>
                </small>

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <div class="col-md-12">
                Email:
                <input class="form-control input-md" id="email" name="email" placeholder="Email" required=""
                       type="email" v-model="form.email">
                <small><span class="error-span"
                             v-show="this.form.errors.has('email')">{{this.form.errors.get('email')}}</span></small>
            </div>
        </div>


    </div>
</template>

<script>

    export default {
        props: {
            user: {
                default: null,
            }
        },

        data() {
            return {
                form: {}
            }
        },

        created() {
            let newForm = this.user === null;

            this.form = new window.VueForm({
                forename: (newForm ? '' : this.user.forename),
                surname: (newForm ? '' : this.user.surname),
                email: (newForm ? '' : this.user.email),
                student_id: (newForm ? '' : this.user.student_id)
            })
        },

        methods: {
            cancel() {
                if (confirm('Are you sure you wish to cancel? You will lose any unsaved changes.')) {
                    this.$emit('close');
                }
            },

            save() {
                this.form.post('/admin/settings/admin-users/update' + (this.user === null?'':'/'+this.user.id))
                    .then(response => {
                        this.$notify.success('User Saved');
                        this.$emit('userUpdated', response);
                        this.$emit('close');
                    })
                    .catch(error => this.$notify.alert('User not saved: '+error.message))
            }
        },

        computed: {
            formTitle() {
                return (this.user === null ? 'Create new user' : 'Edit user #' + this.user.id);
            },

            submitText() {
                return (this.user === null ? 'Create User' : 'Update User')
            }
        }
    }
</script>

<style>

</style>