<template>
    <div>
        <table class="table table-striped table-condensed table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Invoice</th>
                <th>Authorized</th>
                <th>Note</th>
                <th>Documents</th>

            </tr>
            </thead>
            <tbody>
            <tr v-for="invoice in input">
                <td>#{{invoice.id}}</td>
                <td>{{invoice.title}}</td>
                <td>
                    <span v-html="downloadable(invoice.invoice.id)"></span>
                </td>
                <td>
                    <span v-html="boolToFA(invoice.authorized)"></span>
                </td>
                <td>{{invoice.note}}</td>
                <td>
                    <span v-for="document in invoice.treasurer_sign_off_documents"
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
            boolToFA(check) {
                if (check) {
                    return '<i class="fa fa-check" style="color: green; height: 10px;"></i>';
                }
                return '<i class="fa fa-times" style="color: red; height: 10px;"></i>';
            },
            downloadable(id) {
                return '<a href="' + '/exitingtreasurer/download/' + id + '">Download</a>';
            },
        },
    }
</script>

<style scoped>

</style>