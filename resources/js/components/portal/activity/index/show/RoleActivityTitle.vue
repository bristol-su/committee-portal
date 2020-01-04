<template>
    <span>{{title}}</span>
</template>

<script>
    export default {
        name: "RoleActivityTitle",
        props: {
            roleId: {
                required: true,
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
