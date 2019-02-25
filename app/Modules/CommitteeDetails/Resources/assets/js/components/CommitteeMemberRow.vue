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
                :display="committeemember.position_name"
                :failed="true"
        ></committee-member-row-cell>

            <td>
                <input @click="$emit('edit', committeemember)" class="btn btn-outline-info" type="button"
                       value="Edit"/>
                <input @click="$emit('delete', committeemember)" class="btn btn-outline-danger" type="button" value="Delete"/>
            </td>
    </tr>

</template>

<script>

    import CommitteeMemberRowCell from "./CommitteeMemberRowCell";

    export default {
        props: {
            'committeemember': {required: true}
        },

        components: {
            'committee-member-row-cell': CommitteeMemberRowCell
        },

        data() {
            return {
                student: {},
                studentFailed: false

            }
        },

        computed: {
            studentName() {
                return (Object.keys(this.student).length > 0 ? this.student.forename + ' ' + this.student.surname : '');
            }
        },

        mounted() {
            axios.get('/unioncloud/api/user/?uid=' + this.committeemember.student.uc_uid)
                .then(response => this.student = response.data)
                .catch(error => this.studentFailed = true);
        }
    }
</script>

<style>

</style>