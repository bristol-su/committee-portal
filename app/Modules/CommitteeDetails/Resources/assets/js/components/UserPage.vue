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
                                v-for="committee in committee_members"
                                :committeemember="committee"
                                :key="committee.id"
                                @editing="openCommitteeForm"
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
                axios.get('/committeedetails/api/group_committee')
                    .then(response => {
                        this.committee_members = response.data;
                    })
            },

            openCommitteeForm(id) {
                let data = {};

                if (Number.isInteger(id)) {
                    let member = this.committee_members.filter(committee => {
                        return committee.id === id;
                    })[0];
                    data = {
                        initialUid: member.unioncloud_id,
                        initialPositionId: member.position_id,
                        initialPositionName: member.position_name
                    }
                }
                this.$modal.show(CommitteeMemberForm, data, {draggable: true});
            },

        }

    }
</script>

<style>


</style>