<template>
    <div>
        <b-list-group>
            <a :href="'/p/' + activity.slug"
               :key="activity.id"
               v-for="activity in activities">
                <b-list-group-item
                    :active="isSelected(activity, false)">
                    {{activity.name}}
                </b-list-group-item>
            </a>
        </b-list-group>

    </div>
</template>

<script>
    export default {
        name: "PortalSidebar",

        props: {
            activities: {
                required: true,
                type: Array
            },
            currentActivity: {
                required: true,
                type: Object,
            },
        },

        methods: {
            isSelected(activity) {
                return activity.id === this.currentActivity.id;
            }
        }
    }
</script>

<style scoped>

</style>
