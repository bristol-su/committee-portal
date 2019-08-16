<template>
    <div>
        <b-form-select :options="options" class="mb-3">
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
                options: [
                    {text: 'File Upload', value: 'fileupload'},
                    {text: 'Quiz', value: 'quiz'}
                ]
            }
        }
    }
</script>

<style scoped>

</style>
