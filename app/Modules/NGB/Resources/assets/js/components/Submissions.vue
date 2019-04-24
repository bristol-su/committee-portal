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
                <th>Statement</th>
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
                <td>{{submission.statement}}</td>
                <td @click="toggleDate(index)" class="clickable">
                    <span v-if="fullDate.indexOf(index) === -1">
                        {{submission.created_at | timeToHuman}}
                    </span>
                    <span v-else>
                        {{submission.created_at | date_format}}
                    </span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

    import moment from 'moment';

    export default {
        data() {
            return {
                submissions: [],
                fullDate: [],
            }
        },

        created() {
            this.$http.get('/admin/ngb/submissions')
                .then(response => this.submissions = response.data)
                .catch(error => this.$notify.alert('There was an error getting the submissions: ' + error.message));

        },

        methods: {
            toggleDate(submissionIndex) {
                let index = this.fullDate.indexOf(submissionIndex);
                if (index === -1) {
                    this.fullDate.push(submissionIndex);
                } else {
                    this.fullDate.splice(index, 1)
                }
            },
        },

        filters: {
            timeToHuman(time) {
                return moment(time).fromNow();
            },

            date_format(time) {
                return moment(time).format('lll');
            },

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