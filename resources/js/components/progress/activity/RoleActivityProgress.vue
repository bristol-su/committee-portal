<template>
    <div>
        <b-table :items="participants" :fields="fields">

            <template v-slot:cell(group)="data">
                <group-name :id="data.item.group_id"></group-name>
            </template>

            <template v-slot:cell(position)="data">
                <position-name :id="data.item.position_id"></position-name>
            </template>

            <template v-slot:cell(position)="data">
                <position-name :id="data.item.position_id"></position-name>
            </template>

        </b-table>
    </div>
</template>

<script>
    import GroupName from '../../../utilities/control/components/GroupName';
    import PositionName from '../../../utilities/control/components/PositionName';
    export default {
        name: "ActivityProgress",
        components: {GroupName, PositionName},
        props: {
            activity: {
                required: true,
                type: Object
            }
        },

        data() {
            return {
                participants: [],
                fields: [
                    {key: 'id', label: 'Role ID', sortable: true},
                    {key: 'group', label: 'Group'},
                    {key: 'position', label: 'Position'}
                ],
                moduleInstances: {}
            }
        },

        created() {
            this.loadParticipants();
        },

        methods: {
            loadParticipants() {
                this.$api.logic().roleAudience(this.activity.for_logic)
                    .then(response => {
                        this.participants = response.data;
                        this.loadModuleInstances();
                    })
                    .catch(error => this.$notify.alert('Could not load activity participants: ' + error.message));
            },

            loadModuleInstances() {
                this.participants.forEach(role => {
                    this.$api.asRole(role.id).activity().evaluation(this.activity.id)
                    .then(response => console.log(response));
                })
            }
        },

        computed: {
        }
    }
</script>

<style scoped>

</style>
