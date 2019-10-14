<template>
    <div>
        <b-card :title="title">
            <b-row>
                <b-col
                    v-for="activity in activities"
                    :key="activity.id" xs="12" sm="6" md="3">
                    <group-activity
                        :activity="activity"
                        :group-id="groupId"
                        :admin="admin">

                    </group-activity>
                </b-col>
            </b-row>
        </b-card>


    </div>
</template>

<script>
    import GroupActivity from './GroupActivity';
    export default {
        name: "GroupActivities",
        components: {GroupActivity},
        props: {
            activities: {
                type: Array,
                default: function() {
                    return [];
                }
            },
            groupId: {
                required: true
            },
            admin: {
                type: Boolean,
                default: false
            }
        },

        data() {
            return {
                group: null
            }
        },

        created() {
            this.loadGroup();
        },

        methods: {
            loadGroup() {
                this.$api.group().getById(this.groupId)
                    .then(response => this.group = response.data)
                    .catch(error => this.$notify.alert('Could not load group ' + this.groupId + ': ' + error.message));
            }
        },

        computed: {
            title() {
                if(this.group === null) {
                    return 'Loading group membership information...';
                }
               return  'Activities for your membership to ' + this.group.name;
            },

        }
    }
</script>

<style scoped>

</style>
