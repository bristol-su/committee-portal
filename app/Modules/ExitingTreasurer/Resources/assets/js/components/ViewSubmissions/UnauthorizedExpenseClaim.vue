<template>
    <div>
        <table class="table table-striped table-condensed table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>PQU Number</th>
                <th>Note</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="deletable in input">
                <td>#{{deletable.id}}</td>
                <td>{{deletable.pqu_number}}</td>
                <td>{{deletable.note}}</td>
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
    }
</script>

<style scoped>

</style>