<template>
    <div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-condensed table-striped table-borderless">
                    <thead>
                    <tr>
                        <th>Notification</th>
                        <th>Primary Contact</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="contact in contacts">
                        <td>
                            <p>{{contact.title}}</p>
                            <p><small>{{contact.helptext}}</small></p>
                        </td>
                        <td style="margin: auto;">
                            <committee-member-select
                                    v-model="form['id_'+contact.id]"
                                    :committee_members="committee_members">

                            </committee-member-select>
                            <small class="has-error-span" v-if="form.errors.has('id_'+contact.id)">{{form.errors.get('id_'+contact.id)}}</small>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <button @click="updateContacts" class="btn btn-info btn-lg" style="width: 100%">
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
                // Possible things to contact committees about
                contacts: [],
                form: {},
                // Committee members who may be contacted
                committee_members: []
            }
        },

        created() {
            this.loadCommitteeMembers()
                .then(res => this.loadContacts());





        },

        methods: {
            loadCommitteeMembers() {
                // Load the committee members
                return this.$http.get('/control-database/api/position_student_groups')
                    .then(response => this.committee_members = response.data)
                    .catch(error => this.$notify.alert('Could not find your committee: ' + error.message));
            },

            loadContacts() {
                // Load the contacts
                this.$http.get('/maincontacts/contacts')
                    .then(response => {
                        this.contacts = response.data;
                        let data = {};
                        this.contacts.forEach(contact => {
                            data['id_'+contact.id] = (contact.answer ? contact.answer: null);
                        });
                        this.form = new VueForm(data);
                        this.form.shouldReset = false;
                    })
                    .catch(error => {
                        this.$notify.alert('Could not load the contacts: ' + error.message);
                    });
            },

            // Update the students assigned to each contact
            updateContacts() {
                this.form.post('/maincontacts')
                    .then(response => this.$notify.success('Updated your contact preferences.'))
                    .catch(error => {
                        this.$notify.alert('Something went wrong updating your contacts: ' + error.message);
                        this.form.errors.record(error.response.data.errors);
                    })
                    .then(() => window.location.href = process.env.MIX_APP_URL + '/portal');
            }
        }
    }
</script>

<style>

</style>