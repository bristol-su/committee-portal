<template>
    <div style="text-align: left;">
        <vue-form-generator :schema="settings.schema" :model="settings.model" :options="settings.options" @model-updated="update">
        </vue-form-generator>
    </div>
</template>

<script>
    export default {
        name: "Settings",

        // TODO Settings can be loaded through the API from the module alias
        props: {
            settings: {
                required: false,
                type: Object,
                default: function() {
                    return {
                        schema: {},
                        model: {},
                        options: {}
                    }
                }
            }
        },

        data() {
            return {
                id: null
            }
        },
        // TODO Should update/create on clicking 'next' as opposed to debouncing
        methods: {
            update: _.debounce(function() {
                if(this.id === null) {
                    this.createSettings();
                } else {
                    this.updateSettings();
                }
            }, 1000),

            createSettings() {
                this.$api.settings().create({settings: this.settings.model})
                    .then(response => this.id = response.data.id)
                    .catch(error => this.$notify.alert('There was a problem creating the settings: ' + error.message))
                    .then(() => this.$emit('input', this.id));
            },

            updateSettings() {
                this.$api.settings().update(this.id, {settings: this.settings.model})
                    .catch(error => this.$notify.alert('There was a problem creating the settings: ' + error.message))
                    .then(() => this.$emit('input', this.id));
            }
        }
    }
</script>

<style scoped>

</style>
