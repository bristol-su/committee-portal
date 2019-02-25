<template>
    <div>
        <div class="form-horizontal">
            <div class="card text-black bg-white mb-0">

                <div class="card-header">
                    <h4 class="m-0">Add a new committee member for your society. Anyone you add must have an account on
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
                                :takenPositions="takenPositions"
                                @positionSelected="updatePosition"
                        ></position-select>
                    </div>


                    <div class="form-group" v-if="shouldShowPositionName">
                        <div>
                            <small>Position Name</small>
                        </div>

                        <input class="form-control" type="text" v-model="form.position_name"/>


                    </div>


                    <div class="form-group">

                        <div>
                            <small>Search by Email or Student ID</small>
                        </div>

                        <user-select
                                :initialUid="form.unioncloud_id"
                                @studentSelected="updateStudent"
                        ></user-select>

                    </div>


                    <button @click="saveCommitteeMember" class="btn btn-info" type="submit">Add
                        Committee Member
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
            },

            takenPositions: {
                required: true
            },

        },

        data() {
            return {
                form: {}
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
        },

        methods: {
            updateStudent(student) {
                this.form.unioncloud_id = (student === null ? null : student.uid);
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
                let url = '/committeedetails' + (this.committeeMember === null ? '' : '/' + this.committeeMember.id);
                this.form.post(url)
                    .then(response => {
                        window.location.reload();
                    })
                    .catch(error => console.log(error));
                this.$emit('close');
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