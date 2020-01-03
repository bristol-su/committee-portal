<template>
    <div>
        <div v-if="activityFor === 'user'">
            User Progress
        </div>
        <div v-else-if="activityFor === 'group'">
            <group-activity-progress
                :activity="activity"></group-activity-progress>
        </div>
        <div v-else-if="activityFor === 'role'">
            Role Progress
        </div>
    </div>
</template>

<script>
    import GroupActivityProgress from './GroupActivityProgress';
    export default {
        name: "ActivityProgress",
        components: {GroupActivityProgress},
        props: {
            activity: {
                required: true,
                type: Object
            }
        },

        computed: {
            activityFor() {
                return this.activity.activity_for;
            }
        }

    }
</script>

<style scoped>

</style>
