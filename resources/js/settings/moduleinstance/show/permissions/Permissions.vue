<template>
    <div>
        <div v-if="loading">Loading...</div>
        <div v-else>
            <data-item title="Participant Permissions">
                <data-item v-for="(value, permission) in permissions.participant_permissions" :key="permission" :title="permission">
                    <logic-preview :logic-id="value"></logic-preview>
                </data-item>
            </data-item>
            <data-item title="Administrator Permissions">
                <data-item v-for="(value, permission) in permissions.admin_permissions" :key="permission" :title="permission">
                    <logic-preview :logic-id="value"></logic-preview>
                </data-item>
            </data-item>
        </div>
    </div>
</template>

<script>
    import DataItem from "../../../../utilities/DataItem";
    import LogicPreview from "./LogicPreview";

    export default {
        name: "Permissions",
        components: {LogicPreview, DataItem},
        props: {
            permissionId: {
                required: true,
                type: Number
            }
        },

        data() {
            return {
                permissions: {},
                loading: true
            }
        },

        created() {
            this.loadSettings();
        },

        methods: {
            loadSettings() {
                this.$api.permissions().get(this.permissionId)
                    .then(response => this.permissions = response.data)
                    .catch(error => this.$notify.alert('Something went wrong getting permission information: ' + error.message))
                    .then(() => this.loading = false);
            }
        }
    }
</script>

<style scoped>

</style>
