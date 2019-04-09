<template>

    <div>
        <!-- Action buttons - add committee member -->
        <div class="row">
            <div class="col-md-12">
                <input @click="openCommitteeForm(null)" class="btn btn-outline-info" type="button"
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
                                @edit="openCommitteeForm(committee)"
                                v-for="committee in committee_members"
                        >

                        </committee-member-row>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <modal
                name="committee-member-form"
                height="auto"
        >

            <committee-member-form
                    :committee-member="editingCommitteeMember"
                    @memberAdded="memberAdded"
            >
            </committee-member-form>
        </modal>
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
                editingCommitteeMember: null,
            }
        },

        created() {
            this.$http.get('/control-database/api/position_student_groups')
                .then(response => {
                    this.committee_members = response.data;
                })
                .catch(error => this.$notify.alert('Couldn\'t find your committee: ' + error.message))
        },

        methods: {

            memberAdded(member) {
                this.$modal.hide('committee-member-form');
                if(this.editingCommitteeMember !== null) {
                    this.committee_members.splice(this.committee_members.indexOf(this.editingCommitteeMember), 1, member);
                    this.editingCommitteeMember = null;
                } else {
                    this.committee_members.push(member)
                }
            },

            openCommitteeForm(member) {
                if (member !== null) {
                    this.editingCommitteeMember = member;
                }
                this.$modal.show('committee-member-form');

            },

            deleteCommitteeMember(member) {
                if (Number.isInteger(member.id)) {
                    this.$http.delete('committeedetails/' + member.id)
                        .then(response => {
                            this.committee_members = this.committee_members.filter(allMembers => {
                                return allMembers.id !== member.id;
                            });
                        })
                        .catch(error => this.$notify.alert('Couldn\'t delete the committee member: ' + error.message));
                }

            }

        }

    }
</script>

<style>


</style>