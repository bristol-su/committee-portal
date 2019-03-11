<template>
    <div>
        <!--// TODO Complete this-->
        <button class="btn btn-outline-info" @click="addNewTemplate" type="button">
            New Template
        </button>
        <table class="table table-striped table-responsive table-condensed table-hover" v-if="templates.length > 0">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Template</th>
            </tr>
            </thead>
            <tbody v-for="(template, index) in sortedTemplates">

            <tr>
                <td>{{template.name}}</td>
                <td>{{template.description}}</td>
                <td>{{template.template}}</td>
                <td>
                    <a>Edit</a>&nbsp;|&nbsp;
                    <a>Delete</a>
                </td>
            </tr>


            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: {
            module: {
                required: true,
                type: String,
                default: ''
            }
        },

        data() {
            return {
                templates: []
            }
        },

        methods: {
            addNewTemplate() {

            }
        },

        computed: {
            sortedTemplates() {
                return this.templates;
            }
        },

        created() {
            this.$http.get('/admin/' + this.module + '/retrieve-note-templates')
                .then(response => this.templates = response.data )
                .catch(error => {
                    this.$notify.alert('Sorry, something went wrong.');
                })
        }
    }

</script>

<style>
    table {
        margin: auto;
    }


</style>