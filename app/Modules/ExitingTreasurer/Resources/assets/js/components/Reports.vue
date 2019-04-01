<template>
    <div>
        <table class="table table-borderless table-condensed table-hover">
            <thead>
            <tr>
                <th>Report Name</th>
                <th>Year</th>
                <th>Type</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="report in reports">
                <td>{{report.title}}</td>
                <td>{{report.year | reaffiliation_year}}</td>
                <td>{{report.type | reportType}}</td>
                <td><span v-html="downloadable(report.id)"></span></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import DateViewer from "../../../../../../../resources/js/components/DateViewer";
    export default {
        components: {DateViewer},
        props: {
            reports: {
                required: true,
                type: Array
            }
        },

        methods: {
            downloadable(id) {
                return '<a href="' + '/exitingtreasurer/download-report/' + id + '">Download</a>';
            },
        },

        filters: {
            reaffiliation_year(year) {
                return year.toString() + '/' + (year + 1).toString().slice(2);
            },

            reportType(type) {
                if(type === 'transaction_list') {
                    return 'Transaction List'
                } else if(type === 'income_expenditure') {
                    return 'Income Expenditure';
                }
                return 'N/A';
            },


        }
    }
</script>

<style scoped>

</style>