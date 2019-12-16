<template>
    <div style="text-align: left;">
        <div v-if="loading">Loading...</div>
        <div v-else>
            <vue-form-generator :schema="settingsSchema.schema" :model="model" :options="settingsSchema.options">
            </vue-form-generator>
        </div>
        <b-button @click="saveSettings">Save Settings</b-button>

    </div>
</template>

<script>
    export default {
        name: "Settings",

        props: {
            moduleInstance: {
                required: true,
                type: Object
            }
        },

        data() {
            return {
                settingsSchema: {},
                moduleInstanceSettings: [],
                model: {},
                schemaLoading: true,
                settingsLoading: true
            }
        },

        created() {
            this.loadSettingsSchema();
        },

        methods: {
            loadSettingsSchema() {
                this.schemaLoading = true;
                this.$api.modules().getByAlias(this.moduleInstance.alias)
                    .then(response => {
                        this.settingsSchema = response.data.settings;
                        this.model = Object.assign(this.model, this.settingsSchema.model);
                        this.settingsLoading = true;
                        this.schemaLoading = false;
                        this.loadSettings();
                    })
                    .catch(error => this.$notify.alert('Could not load available settings: ' + error.message));
            },
            loadSettings() {
                this.$api.moduleInstanceSettings().forModuleInstance(this.moduleInstance.id)
                    .then(response => {
                        this.moduleInstanceSettings = response.data;
                        this.moduleInstanceSettings.forEach(setting => this.$set(this.model, setting.key, setting.value));
                    })
                    .catch(error => this.$notify.alert('Could not load settings: ' + error.message))
                    .then(() => this.settingsLoading = false);
            },

            saveSettings() {
                Object.keys(this.model).forEach(key => {
                    let setting = this.moduleInstanceSettings.filter(setting => setting.key === key);
                    if(setting.length === 0) {
                        this.saveSetting(key, this.model[key]);
                    } else if(setting[0].value !== this.model[key]){
                        this.updateSetting(setting[0].id, this.model[key]);
                    }
                });
            },

            saveSetting(key, value) {
                this.$api.moduleInstanceSettings().create(key, value, this.moduleInstance.id)
                    .then(response => {
                        this.moduleInstanceSettings.push(response.data);
                        this.$notify.success('Saved setting ' + key);
                    })
                    .catch(error => this.$notify.alert('Could not save setting ' + key + ': ' + error.message));
            },

            updateSetting(id, value) {
                this.$api.moduleInstanceSettings().update(id, value)
                    .then(response => {
                        let index = this.moduleInstanceSettings.indexOf(this.moduleInstanceSettings.filter(set => set.id === id)[0]);
                        this.moduleInstanceSettings.splice(index, 1, response.data);
                        this.$notify.success('Updated setting ' + id);
                    })
                    .catch(error => this.$notify.alert('Could not update setting ' + id + ': ' + error.message));
            }
        },

        computed: {
            loading() {
                return this.schemaLoading || this.settingsLoading;
            }
        }
    }
</script>

<style scoped>

</style>
