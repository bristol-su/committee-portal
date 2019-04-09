<template>
    <div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-condensed table-striped table-borderless">
                    <thead>
                    <tr>
                        <th>Task</th>
                        <th>Committee member to complete the task</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="task in tasks">
                        <td>
                            <p>{{task.title}}</p>
                            <p><small>{{task.helptext}}</small></p>
                        </td>
                        <td style="margin: auto;">
                            <committee-member-select
                                    v-model="form['id_'+task.id]"
                                    :committee_members="committee_members">

                            </committee-member-select>
                            <small class="has-error-span" v-if="form.errors.has('id_'+task.id)">{{form.errors.get('id_'+task.id)}}</small>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <button @click="updateTasks" class="btn btn-info btn-lg" style="width: 100%">
                    Save
                </button>
            </div>
        </div>


    </div>
</template>

<script>

    import CommitteeMemberSelect from './../../../../../../../resources/js/components/unioncloud/CommitteeMemberSelect';

    export default {
        components: {
            CommitteeMemberSelect
        },

        data() {
            return {
                // Possible things to task committees about
                tasks: [],
                form: {},
                // Committee members who may be tasked
                committee_members: []
            }
        },

        created() {
            this.loadCommitteeMembers()
                .then(res => this.loadTasks());





        },

        methods: {
            loadCommitteeMembers() {
                // Load the committee members
                return this.$http.get('/control-database/api/position_student_groups')
                    .then(response => this.committee_members = response.data)
                    .catch(error => this.$notify.alert('Could not find your committee: ' + error.message));
            },

            loadTasks() {
                // Load the tasks
                this.$http.get('/taskallocation/tasks')
                    .then(response => {
                        this.tasks = response.data;
                        let data = {};
                        this.tasks.forEach(task => {
                            data['id_'+task.id] = (task.answer ? task.answer: null);
                        });
                        this.form = new VueForm(data);
                        this.form.shouldReset = false;
                    })
                    .catch(error => {
                        this.$notify.alert('Could not load the tasks: ' + error.message);
                    });
            },

            // Update the students assigned to each task
            updateTasks() {
                this.form.post('/taskallocation')
                    .then(response => {
                        this.$notify.success('Updated your task preferences.');
                        window.location.href = process.env.MIX_APP_URL + '/portal';
                    })
                    .catch(error => {
                        this.$notify.alert('Something went wrong updating your tasks: ' + error.message);
                        this.form.errors.record(error.response.data.errors);
                    })
            }
        }
    }
</script>

<style>

</style>