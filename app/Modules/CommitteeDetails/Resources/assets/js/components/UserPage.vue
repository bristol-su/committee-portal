<template>

    <div>
        <!-- Action buttons (add and save) -->
        <div class="row">
            <div class="col-md-12">
                <input type="button" value="Add Committee Member" class="btn btn-outline-info" @click="showNewCommitteeForm"/>
             </div>
        </div>


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
                                v-for="committee in committee_members"
                                :key="committee.id"
                                :committeemember="committee"
                                @editing="editCommitteeMember"
                            >

                            </committee-member-row>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <committee-member-form>

        </committee-member-form>

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
                axios.get('/committeedetails/api/group_committee')
                    .then(response => {
                        this.committee_members = response.data;
                    })
            },

            showNewCommitteeForm() {
                CommitteeDetailsEvent.$emit('committeedetails-add-new-committee-member', {});
            },

            editCommitteeMember(id) {
                CommitteeDetailsEvent.$emit('committeedetails-edit-committee-member',
                    this.editingCommitteeMember = this.committee_members.filter(committee => {
                        return committee.id = id;
                    })[0]
                );
            }

        }

    }
</script>

<style>


</style>