<template>
    <div>
        <b-list-group>
            <a :href="makeUrl(instance.id)"
               :key="instance.id"
               v-for="instance in activityInstances">
                <b-list-group-item
                    :variant="(instance.id === currentActivityInstance.id?'primary':'light')">
                    {{instance.name}}
                </b-list-group-item>
            </a>
            <b-list-group-item
                @click="newActivityInstance"
                variant="light">
                New Run Through
            </b-list-group-item>
        </b-list-group>


        <b-modal id="new-activity-instance">
            <NewActivityInstance
                :activity-id="currentActivityInstance.activity_id"
                :resource-id="currentActivityInstance.resource_id"
                :resource-type="currentActivityInstance.resource_type">

            </NewActivityInstance>
        </b-modal>
    </div>
</template>

<script>
    import NewActivityInstance from './NewActivityInstance';
    import Url from 'domurl';

    export default {
        name: "ActivityInstanceSwitcher",
        components: {NewActivityInstance},
        props: {
            activityInstances: {
                required: true,
                type: Array,
                default: function () {
                    return [];
                }
            },
            currentActivityInstance: {
                required: true,
                type: Object,
            }
        },

        methods: {
            newActivityInstance() {
                this.$bvModal.show('new-activity-instance');
            },
            makeUrl(id) {
                let u = new Url;
                u.query.aiid = id;
                return u.toString();
            }
        },

        computed: {}
    }
</script>

<style scoped>

</style>
