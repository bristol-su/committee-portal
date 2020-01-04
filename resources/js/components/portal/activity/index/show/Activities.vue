<template>
    <div>

        <activity-group
            class="activity-group"
            :activities="userActivity"
            :admin="admin"
            type="user"
            :resource-id="userId">

        </activity-group>

        <activity-group
            class="activity-group"
            v-for="(groupActivitySet, groupId) in groupActivities"
            :key="groupId"
            :activities="groupActivitySet"
            type="group"
            :resource-id="groupId"
            :admin="admin">

        </activity-group>

        <activity-group
            class="activity-group"
            v-for="(roleActivitySet, roleId) in roleActivities"
            :key="roleId"
            :activities="roleActivitySet"
            type="role"
            :resource-id="roleId"
            :admin="admin">

        </activity-group>

    </div>
</template>

<script>
    import ActivityGroup from './ActivityGroup';
    export default {
        name: "Activities",
        components: {ActivityGroup},
        props: {
            activities: {
                required: true,
                type: Object
            },
            admin: {
                default: false,
                type: Boolean
            },
            userId: {
                required: true,
            }
        },

        data() {
            return {}
        },

        methods: {},

        computed: {
            userActivity() {
                return this.activities.user

            },
            groupActivities() {
                return this.activities.group

            },
            roleActivities() {
                return this.activities.role
            }
        }
    }
</script>

<style scoped>
    .activity-group {
        padding: 10px;
    }

</style>
