<template>
    <div>
        <b-card :title="title">
            <b-row>
                <b-col
                    v-for="activity in activities"
                    :key="activity.id" xs="12" sm="6" md="3">
                    <user-activity
                        :activity="activity"
                        :admin="admin">

                    </user-activity>
                </b-col>
            </b-row>
        </b-card>


    </div>
</template>

<script>
    import UserActivity from './UserActivity';
    export default {
        name: "UserActivities",
        components: {UserActivity},
        props: {
            activities: {
                    type: Array,
                default: function() {
                    return [];
                }
            },
            admin: {
                type: Boolean,
                default: false
            }
        },

        computed: {
            title() {
                return  'Your user account.'
            },

        }
    }
</script>

<style scoped>

</style>
