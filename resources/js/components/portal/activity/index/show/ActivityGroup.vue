<template>
    <div>
        <b-card>
            <template v-slot:header>
                <h4 class="mb-0">
                    <user-activity-title v-if="type === 'user'" :user-id="resourceId"/>
                    <group-activity-title v-if="type === 'group'" :group-id="resourceId"/>
                    <role-activity-title v-if="type === 'role'" :role-id="resourceId"/>
                </h4>
            </template>
            <b-row>
                <b-col
                    v-for="activity in activities"
                    :key="activity.id" xs="12" sm="6" md="3">
                    <activity
                        :activity="activity"
                        :resource-id="resourceId"
                        :admin="admin"
                        :type="type">

                    </activity>
                </b-col>
            </b-row>
        </b-card>


    </div>
</template>

<script>
    import Activity from './Activity';
    import UserActivityTitle from './UserActivityTitle';
    import GroupActivityTitle from './GroupActivityTitle';
    import RoleActivityTitle from './RoleActivityTitle';
    export default {
        name: "ActivityGroup",
        components: {Activity, UserActivityTitle, GroupActivityTitle, RoleActivityTitle},
        props: {
            activities: {
                type: Array,
                default: function() {
                    return [];
                }
            },
            resourceId: {
                required: true
            },
            admin: {
                type: Boolean,
                default: false
            },
            type: {
                required: true,
                type: String
            }
        },

    }
</script>

<style scoped>

</style>
