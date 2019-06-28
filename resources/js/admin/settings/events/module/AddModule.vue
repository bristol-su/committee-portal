<template>
    <div>
        <div style="text-align: left">

            <b-form @reset="onReset" @submit.prevent="onSubmit">
                <b-form-group
                        description="Choose the type of module you want to add."
                        id="modules-label"
                        label="Modules:"
                        label-for="modules"
                >
                    <b-form-select id="modules" v-model="form.alias" :options="modules"></b-form-select>
                </b-form-group>


                <b-button type="submit" variant="primary">Submit</b-button>
                <b-button type="reset" variant="danger">Reset</b-button>
            </b-form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AddModule",

        data() {
            return {
                modules: [],
                form: {
                    alias: null
                }
            }
        },

        created() {
            this.loadModules();
        },

        methods: {
            loadModules() {
                this.$http.get('/admin/settings/modules')
                    .then(response => this.modules = response.data)
                    .catch(error => this.$notify.alert('There was an error loading modules: '+error.message));
            },

            onReset() {

            },

            onSubmit() {

            }
        }
    }
</script>

<style scoped>

</style>