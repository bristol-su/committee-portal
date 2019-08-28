<template>
    <div>
        <b-form-select :options="dropdownOptions" class="mb-3" @input="moduleChanged">
            <!-- This slot appears above the options from 'options' prop -->
            <template slot="first">
                <option :value="null" disabled>-- Please select an option --</option>
            </template>
        </b-form-select>
    </div>
</template>

<script>
    export default {
        name: "ModuleType",

        data() {
            return {
                options: []
            }
        },

        created() {
            this.loadModules();
        },

        methods: {
            loadModules() {
                return this.$api.modules().all()
                    .then(response => this.options = response.data)
                    .catch(error => this.$notify.alert('Could not load modules: ' + error.message));
            },

            moduleChanged(alias) {
                this.$emit('input', alias);
                this.$emit('module', this.options[alias]);
            }
        },

        computed: {
            dropdownOptions() {
                return Object.keys(this.options).map(alias => {
                    return {
                        value: alias,
                        text: this.options[alias].name
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>
