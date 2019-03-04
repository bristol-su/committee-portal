<template>

    <div>
        <!-- Action buttons (add and save) -->
        <div class="row">
            <div class="col-md-12">
                <input @click="openCommitteeForm" class="btn btn-outline-info" type="button"
                       value="Add Committee Member"/>
            </div>
        </div>

        <!-- Table -->
        <div class="row">
            <div class="col-md-12">

                <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Student ID</th>
                            <th scope="col">Position</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <committee-member-row
                                :committeemember="committee"
                                :key="committee.id"
                                @delete="deleteCommitteeMember"
                                @edit="openCommitteeForm"
                                v-for="committee in committee_members"
                        >

                        </committee-member-row>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import CommitteeMemberRow from './CommitteeMemberRow';
    import CommitteeMemberForm from './CommitteeMemberForm';

    export default {

        components: {
            'committee-member-row': CommitteeMemberRow,
            'committee-member-form': CommitteeMemberForm
        },


        data() {
            return {
                committee_members: [],
            }
        },

        created() {
            this.loadCommittee();
        },

        methods: {

            loadCommittee() {
                this.$http.get('/control-database/api/position_student_groups')
                    .then(response => {
                        this.committee_members = response.data;
                    })
            },

            committeeChanged(event) {
                console.log('committee_changed');
                this.loadCommittee();
            },

            openCommitteeForm(member) {
                let data = {};
                if (!(member instanceof MouseEvent)) {
                    data = {
                        committeeMember: member
                    };
                }

                data.takenPositions = this.committee_members.map(o => o.position.id);
                // https://www.npmjs.com/package/vue-js-modal#properties
                this.$modal.show(CommitteeMemberForm, data, window.$defaultModalSettings, {
                    'committeeChanged': this.committeeChanged
                });
            },

            deleteCommitteeMember(member) {
                if (Number.isInteger(member.id)) {
                    this.$http.delete('committeedetails/'+member.id)
                        .then(response => {
                            window.location.reload();
                        })
                        .catch(e => console.log(e));
                }

            }

        }

    }
</script>

<style>


</style>