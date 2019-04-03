<template>
    <div>
        <div class="form-horizontal">
            <div class="card text-black bg-white mb-0">

                <div class="card-header">
                    <h4 class="m-0">Add a new committee member for your society. Anyone you add must have an account
                        on
                        our
                        <a href="https://www.bristolsu.org.uk">website!</a></h4>
                </div>

                <div class="card-body">

                    <div class="form-group">

                        <div>
                            <small>Select the position of the student</small>
                        </div>

                        <position-select
                                :initialPositionId="form.position_id"
                                @positionSelected="updatePosition"
                        ></position-select>

                        <small><span class="error-span" v-show="form.errors.has('position_id')">{{form.errors.get('position_id')}}</span>
                        </small>

                    </div>


                    <div class="form-group" v-if="shouldShowPositionName">
                        <div>
                            <small>Position Name</small>
                        </div>

                        <input class="form-control" type="text" v-model="form.position_name"/>

                        <small><span class="error-span" v-show="form.errors.has('position_name')">{{form.errors.get('position_name')}}</span>
                        </small>


                    </div>


                    <div class="form-group">

                        <div>
                            <small>Search by Email or Student ID</small>
                        </div>

                        <user-select
                                :initialUid="form.unioncloud_id"
                                @studentSelected="updateStudent"
                        ></user-select>

                        <small><span class="error-span" v-show="form.errors.has('unioncloud_id')">{{form.errors.get('unioncloud_id')}}</span>
                        </small>

                    </div>


                    <button :disabled="submitting || !allInformationPresent" @click="saveCommitteeMember"
                            class="btn btn-info" type="submit">
                        Save committee member
                    </button>

                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import UserSearch from './../../../../../../../resources/js/components/unioncloud/UserSearch';
    import PositionSearch from './control/PositionSearch';

    export default {
        props: {
            committeeMember: {
                default: null
            }

        },

        data() {
            return {
                form: {},
                submitting: false,
                selectedStudentForename: '',
                selectedStudentSurname: ''
            }
        },

        created() {
            let newForm = (this.committeeMember === null);

            this.form = new window.VueForm({
                unioncloud_id: (newForm ? null : this.committeeMember.student.uc_uid),
                position_id: (newForm ? null : this.committeeMember.position.id),
                position_name: (newForm ? '' : this.committeeMember.position_name),
            });
        },


        computed: {
            shouldShowPositionName() {
                return this.form.position_id !== null;
            },

            allInformationPresent() {
                return this.form.unioncloud_id !== null && this.form.position_id !== null && this.form.position_name !== "";
            }
        },

        methods: {
            updateStudent(student) {
                this.form.unioncloud_id = (student === null ? null : student.uid);
                this.selectedStudentForename = student.forename;
                this.selectedStudentSurname = student.surname;
            },

            updatePosition(position) {
                // Clear or update the form position id holder
                if (position === null) {
                    this.form.position_id = null;
                    this.form.position_name = '';
                } else {
                    this.form.position_id = position.id;

                    // Fill in the position name if blank
                    if (this.form.position_name === '') {
                        this.form.position_name = position.name;
                    }
                }
            },

            saveCommitteeMember() {
                // Fire a request to the backend
                if (confirm('Are you sure you wish to give ' + this.selectedStudentForename+
                    ' ' + this.selectedStudentSurname + ' the position of ' + this.form.position_name +
                    '? Clicking OK will update our records and let ' + this.selectedStudentForename + ' know.')) {
                    let url = '/committeedetails' + (this.committeeMember === null ? '' : '/' + this.committeeMember.id);
                    this.submitting = true;
                    this.form.post(url)
                        .then(response => {
                            this.$notify.success('Committee member saved');
                            this.$emit('memberAdded', response);
                            this.submitting = false;
                        })
                        .catch(error => {
                            this.$notify.alert('Committee member couldn\'t be saved.');
                            this.form.errors.record(error.errors);
                            this.submitting = false;
                        });
                }

            }

        },

        components: {
            'user-select': UserSearch,
            'position-select': PositionSearch
        }
    }
</script>

<style>

</style>