<template>
    <div>
        <table class="table table-striped table-condensed table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Note</th>
                <th>Documents</th>

            </tr>
            </thead>
            <tbody>
            <tr v-for="corrections in input">
                <td>#{{corrections.id}}</td>
                <td>{{corrections.note}}</td>
                <td>
                    <span v-for="document in corrections.treasurer_sign_off_documents"
                          v-html="downloadable(document.id)" style="display: block;"></span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: {
            input: {
                required: false,
                default: null
            }
        },

        methods: {
            downloadable(id) {
                return '<a href="' + '/exitingtreasurer/download/' + id + '">Download</a>';
            },
        },
    }
</script>

<style scoped>

</style>