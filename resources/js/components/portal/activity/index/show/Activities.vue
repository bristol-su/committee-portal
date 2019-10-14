<template>
    <div>

        <user-activities
            :activities="userActivity"
            :admin="admin">

        </user-activities>

        <group-activities
            v-for="(groupActivitySet, groupId) in groupActivities"
            :key="groupId"
            :activities="groupActivitySet"
            :group-id="groupId"
            :admin="admin">

        </group-activities>

        <role-activities
            v-for="(roleActivitySet, roleId) in roleActivities"
            :key="roleId"
            :activities="roleActivitySet"
            :role-id="roleId"
            :admin="admin">

        </role-activities>

    </div>
</template>

<script>
    import RoleActivities from './RoleActivities';
    import UserActivities from './UserActivities';
    import GroupActivities from './GroupActivities';
    export default {
        name: "Activities",
        components: {GroupActivities, UserActivities, RoleActivities},
        props: {
            activities: {
                required: true,
                type: Object
            },
            admin: {
                default: false,
                type: Boolean
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

</style>
