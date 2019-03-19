<template>
    <div>
        <div v-if="selections.length === 0">
            {{errorMessage}}
        </div>
        <div v-else>
            <table class="table table-striped table-responsive table-condensed table-hover" style="margin: auto; display: table;">
                <thead>
                    <tr>
                        <th>Group</th>
                        <th>Tier</th>
                        <th>Year</th>
                        <th>Submitter</th>
                        <th>Selection Date</th>
                    </tr>
                </thead>
                <tbody>

                    <tr v-for="(selection, index) in selections">
                        <td>{{ selection.group.name }}</td>
                        <td>{{ selection.tier.name }}</td>
                        <td>{{ selection.year | reaffiliationYear }}</td>
                        <td>{{ selection.user | username }}</td>
                        <td @click="toggleDate(index)" class="clickable">
                        <span v-if="fullDate.indexOf(index) === -1">
                            {{selection.created_at | timeToHuman}}
                        </span>
                            <span v-else>
                            {{selection.created_at | date_format}}
                        </span>
                        </td>
                    </tr>


                </tbody>
            </table>
        </div>
    </div>
</template>

<script>

    import moment from 'moment';
    export default {
        data() {
            return {
                selections: [],
                fullDate: [],
                errorMessage: 'Loading selections...'
            }

        },

        created() {
            this.$http.get('/admin/tierselection/selections')
                .then(response => {
                    this.selections = response.data
                    if(this.selections.length === 0) {
                        this.$notify.info('No selections have been made.');
                        this.errorMessage = 'No selections found.'

                    }
                })
                .catch(error => this.$notify.alert('Couldn\'t get the selections: ' + error.message))
        },

        methods: {
            toggleDate(selectionIndex) {
                let index = this.fullDate.indexOf(selectionIndex);
                if (index === -1) {
                    this.fullDate.push(selectionIndex);
                } else {
                    this.fullDate.splice(index, 1)
                }
            },
        },

        filters: {
            reaffiliationYear(year) {
                return year.toString() + '/' + (year + 1).toString().slice(2);

            },

            timeToHuman(time) {
                return moment(time).fromNow();

            },

            date_format(time) {
                return moment(time).format('lll');

            },

            username(user) {
                return user.forename + ' ' + user.surname;
            }
        }
    }
</script>

<style>

</style>