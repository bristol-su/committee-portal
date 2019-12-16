<template>
    <div>
        <b-form-group
            id="name-group"
            label="Connection Name:"
            label-for="name"
            description="A name for the connection."
        >
            <b-form-input
                id="name"
                v-model="form.name"
                type="text"
                required
                :placeholder="defaultName"
            ></b-form-input>
        </b-form-group>

        <b-form-group
            id="description-group"
            label="Connection description:"
            label-for="description"
            description="A description for the connection to help you identify it in the future."
        >
            <b-form-textarea
                id="name"
                v-model="form.description"
                rows="2"
            ></b-form-textarea>
        </b-form-group>

        <vue-form-generator :schema="connector.settings.schema" :model="form.settings" :options="connector.settings.options">

        </vue-form-generator>

        <b-button variant="info" size="lg" @click="updateConnection">Save Connection</b-button>
    </div>
</template>

<script>
    export default {
        name: "EditConnection",

        props: {
            connector: {
                type: Object,
                required: true
            },
            connection: {
                type: Object,
                required: false,
                default: null
            }
        },

        data() {
            return {
                form: {
                    name: '',
                    description: '',
                    settings: {}
                }
            }
        },

        created() {
            this.form.name = this.connection.name;
            this.form.description = this.connection.description;
            Object.assign(this.form.settings, this.model);
        },

        methods: {
            updateConnection() {
                let attributes = {name: this.form.name, description: this.form.description};
                console.log(this.form.settings, this.model, attributes);
                if(this.form.settings !== this.model) {
                    attributes.settings = this.form.settings;
                }
                this.$api.connection().update(this.connection.id, attributes)
                    .then(response => window.location.reload())
                    .catch(error => this.$notify.alert('Could not update connection: ' + error.message));
            }
        },

        computed: {
            defaultName() {
                return 'My ' + this.connector.name + ' connection';
            },
            model() {
                return this.connector.settings.model;
            }
        }
    }
</script>

<style scoped>

</style>
