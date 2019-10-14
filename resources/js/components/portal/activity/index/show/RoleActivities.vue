<template>
    <div>
        <b-card :title="title">
            <b-row>
                <b-col
                    v-for="activity in activities"
                    :key="activity.id" xs="12" sm="6" md="3">
                    <role-activity
                        :activity="activity"
                        :role-id="roleId"
                        :admin="admin">

                    </role-activity>
                </b-col>
            </b-row>
        </b-card>


    </div>
</template>

<script>
    import RoleActivity from './RoleActivity';
    export default {
        name: "RoleActivities",
        components: {RoleActivity},
        props: {
            activities: {
                type: Array,
                default: function() {
                    return [];
                }
            },
            roleId: {
                required: true
            },
            admin: {
                type: Boolean,
                default: false
            }
        },

        data() {
            return {
                role: null
            }
        },

        created() {
            this.loadRole();
        },

        methods: {
            loadRole() {
                this.$api.role().getById(this.roleId)
                    .then(response => this.role = response.data)
                    .catch(error => this.$notify.alert('Could not load role ' + this.roleId + ': ' + error.message));
            }
        },

        computed: {
            title() {
                if(this.role === null) {
                    return 'Loading role information...';
                }
                return  'Activities for your position of ' + this.role.position.name + ' to ' + this.role.group.name;
            },

        }
    }
</script>

<style scoped>

</style>
