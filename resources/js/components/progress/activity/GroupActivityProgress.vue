<template>
    <div>
        <b-table :items="items" :fields="fields">

            <template v-slot:cell(status)="data">
                <span v-if="hasActivityInstance(data.item.group_id)">
                    <status
                        :module-instances="getModuleInstance(data.item.group_id)"></status>
                </span>
                <span v-else>Not started</span>
            </template>

        </b-table>
    </div>
</template>

<script>
    import Status from './Status';
    export default {
        name: "GroupActivityProgress",
        components: {Status},
        props: {
            activity: {
                required: true,
                type: Object
            }
        },

        data() {
            return {
                progress: [],
                participants: [],
                fields: [
                    {key: 'group_id', label: 'Group ID', sortable: true},
                    {key: 'group_name', label: 'Name', sortable: true},
                    {key: 'group_email', label: 'Group Email', sortable: true},
                    {key: 'status', label: 'Status'}
                ],
            }
        },

        created() {
            this.loadProgress();
            this.loadParticipants();
        },

        methods: {
            loadProgress() {
                this.$api.activity().progress(this.activity.id)
                    .then(response => this.progress = response.data)
                    .catch(error => this.$notify.alert('Could not load activity progress: ' + error.message));
            },

            loadParticipants() {
                this.$api.logic().groupAudience(this.activity.for_logic)
                    .then(response => this.participants = response.data)
                    .catch(error => this.$notify.alert('Could not load participants of the activity: ' + error.message));
            },

            hasActivityInstance(resourceId) {
                return this.progress.filter(progress => {
                    return progress.resource_id === resourceId;
                }).length > 0;
            },

            getModuleInstance(resourceId) {
                
            }

        },

        computed: {
            items() {
                return this.participants.map(participant => {
                    return {
                        group_id: participant.id,
                        group_name: participant.name,
                        group_email: participant.email
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>
