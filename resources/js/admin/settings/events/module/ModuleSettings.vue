<template>
    <div>
        <div class="panel-body">
            <form @submit.prevent="onSubmit">
                <vue-form-generator :schema="schema" :model="model" :options="options">
                </vue-form-generator>

                <b-button type="submit" variant="primary">Save Settings</b-button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ModuleSettings",

        props: {
            moduleInstance: {
                required: true
            },
            settings: {
                required: true,
                type: Object
            }
        },

        data() {
            return {
                schema: {},
                model: {},
                options: {}
            }
        },

        created() {
            this.getModuleSettings(this.moduleInstance.alias);
        },

        methods: {
            getModuleSettings(alias) {
                this.$http.get('/admin/settings/modules/'+this.moduleInstance.alias+'/settings')
                    .then(response => {
                        this.schema = response.data.schema;
                        this.model = {...response.data.model, ...this.settings.settings};
                        this.options = response.data.options;
                    })
                    .catch(error => this.$notify.alert('Could not load module settings: '+error.message));
            },

            onSubmit() {
                this.$http.post('/admin/settings/moduleinstance/'+this.moduleInstance.id+'/settings', {settings: this.model})
                    .then(response => {
                        this.$notify.success('Settings Saved');
                        this.$emit('saved', response.data);
                    })
                    .catch(error => this.$notify.alert('Settings not saved: '+error.message));
            }
        }
    }
</script>

<style scoped>

</style>