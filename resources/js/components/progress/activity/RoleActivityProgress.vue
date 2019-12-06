<template>
    <div>
<!--        <b-table :items="participants" :fields="fields">-->

<!--            <template v-slot:cell(group)="data">-->
<!--                <group-name :id="data.item.group_id"></group-name>-->
<!--            </template>-->

<!--            <template v-slot:cell(position)="data">-->
<!--                <position-name :id="data.item.position_id"></position-name>-->
<!--            </template>-->

<!--            <template v-slot:cell(position)="data">-->
<!--                <position-name :id="data.item.position_id"></position-name>-->
<!--            </template>-->

<!--        </b-table>-->
    </div>
</template>

<script>
    export default {
        name: "RoleActivityProgress",
        props: {
            activity: {
                required: true,
                type: Object
            }
        },

        data() {
            return {
                progress: [],
                // fields: [
                //     {key: 'id', label: 'Role ID', sortable: true},
                //     {key: 'group', label: 'Group'},
                //     {key: 'position', label: 'Position'}
                // ],
                // moduleInstances: {}
            }
        },

        created() {
            this.loadProgress();
        },

        methods: {
            loadProgress() {
                this.$api.activity().progress(this.activity.for_logic)
                    .then(response => this.participants = response.data)
                    .catch(error => this.$notify.alert('Could not load activity progress: ' + error.message));
            },

        },

        computed: {
        }
    }
</script>

<style scoped>

</style>
