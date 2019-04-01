<template>
    <div>
        <table class="table table-hover table-responsive table-striped table-condensed"
               style="margin: auto; display: table;">
            <thead>
            <tr>
                <th></th>
                <th>Group</th>
                <th>User</th>
                <th>Position</th>
                <th>Year</th>
                <th>Submitted At</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(submission, index) in submissions">
                <td>#{{submission.id}}</td>
                <td>{{submission.group | group_name}}</td>
                <td>{{submission.user | user_name}}</td>
                <td>{{submission.position | position_name}}</td>
                <td>{{submission.year | reaffiliation_year}}</td>
                <td>
                    <date-viewer
                        :date="submission.created_at"
                    ></date-viewer>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import DateViewer from "../../../../../../../resources/js/components/DateViewer";

    export default {
        components: {DateViewer},
        data() {
            return {
                submissions: [],
            }
        },
        created() {
            this.$http.get('/admin/safeguarding/submissions')
                .then(response => this.submissions = response.data)
                .catch(error => this.$notify.alert('There was an error getting the submissions: ' + error.message));
        },
        filters: {
            reaffiliation_year(year) {
                return year.toString() + '/' + (year + 1).toString().slice(2);
            },
            group_name(group) {
                return group.name;
            },
            user_name(user) {
                return user.forename + ' ' + user.surname;
            },
            position_name(position) {
                return position.name;
            }
        }
    }
</script>

<style>
</style>
