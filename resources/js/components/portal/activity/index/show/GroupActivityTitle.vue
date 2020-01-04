<template>
    <span>{{title}}</span>
</template>

<script>
    export default {
        name: "GroupActivityTitle",
        props: {
            groupId: {
                required: true,
            }
        },

        data() {
            return {
                group: null
            }
        },

        created() {
            this.loadGroup();
        },

        methods: {
            loadGroup() {
                this.$api.group().getById(this.groupId)
                    .then(response => this.group = response.data)
                    .catch(error => this.$notify.alert('Could not load group ' + this.groupId + ': ' + error.message));
            }
        },

        computed: {
            title() {
                if(this.group === null) {
                    return 'Loading group membership information...';
                }
               return  'Activities for your membership to ' + this.group.name;
            },

        }
    }
</script>

<style scoped>

</style>
