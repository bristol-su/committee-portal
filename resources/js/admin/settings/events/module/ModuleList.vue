<template>
    <b-form-group label="Modules in Event">
        <b-form-checkbox-group
                :options="moduleOptions"
                name="modules"
                stacked
                v-model="selectedModules"
        ></b-form-checkbox-group>

        <b-button v-b-modal.add-module-modal>Add Module</b-button>


        <b-modal id="add-module-modal" title="Add Module to Event">
            <add-module></add-module>
        </b-modal>
    </b-form-group>
</template>

<script>
    import AddModule from "./AddModule";
    export default {
        name: "ModuleList",
        components: {AddModule},
        data() {
            return {
                modules: [
                    {id: 1, name: 'name1'},
                    {id: 2, name: 'name2'}
                ],
                selectedModules: []
            }
        },

        computed: {
            moduleOptions() {
                return this.modules.map(module => {
                    return {value: module.id, text: module.name}
                });
            }
        }
    }
</script>

<style scoped>

</style>