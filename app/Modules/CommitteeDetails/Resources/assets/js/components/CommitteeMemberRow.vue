<template>
    <tr>
        <committee-member-row-cell
                :display="studentName"
                :failed="studentFailed"
        ></committee-member-row-cell>

        <committee-member-row-cell
                :display="student.id"
                :failed="studentFailed"
        ></committee-member-row-cell>

        <committee-member-row-cell
                :display="position.name"
                :failed="positionFailed"
        ></committee-member-row-cell>

        <td>
            <input type="button" value="Edit" class="btn btn-outline-info" @click="$emit('editing', committeemember)"/>
            <input type="button" value="Delete" class="btn btn-outline-danger"/>
        </td>
    </tr>

</template>

<script>

    import CommitteeMemberRowCell from "./CommitteeMemberRowCell";

    export default {
        props: {
            'committeemember': { required: true }
        },

        components: {
            'committee-member-row-cell': CommitteeMemberRowCell
        },

        data() {
            return {
                position: {},
                student: {},
                positionFailed: false,
                studentFailed: false

            }
        },

        computed: {
            studentName() {
                return (Object.keys(this.student).length > 0? this.student.forename + ' ' + this.student.surname : '');
            }
        },

        mounted() {
            axios.get('/control-database/api/positions/'+this.committeemember.position_control_id)
                .then(response => this.position = response.data)
                .catch(error => this.positionFailed = true);
            axios.get('/unioncloud/api/user/?uid=' + this.committeemember.unioncloud_id)
                .then(response => this.student = response.data)
                .catch(error => this.studentFailed = true)

        }
    }
</script>

<style>

</style>