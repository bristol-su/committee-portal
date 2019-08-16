<template>
    <div>
        <div v-if="loading">Loading...</div>
        <div v-else>
            <data-item v-for="(value, setting) in settings.settings" :key="setting" :title="setting">
                {{value}}
            </data-item>
        </div>
    </div>
</template>

<script>
    import DataItem from "../../../../utilities/DataItem";
    export default {
        name: "Settings",
        components: {DataItem},
        props: {
            settingId: {
                required: true,
                type: Number
            }
        },

        data() {
            return {
                settings: {},
                loading: true
            }
        },

        created() {
            this.loadSettings();
        },

        methods: {
            loadSettings() {
                this.$api.settings().get(this.settingId)
                    .then(response => this.settings = response.data)
                    .catch(error => this.$notify.alert('Something went wrong getting settings information: ' + error.message))
                    .then(() => this.loading = false);
            }
        }
    }
</script>

<style scoped>

</style>
