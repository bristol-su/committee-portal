<template>
    <div>
        <b-card header="Permission" header-class="view-header" class="show-card">
            <div>
                <data-item title="Name">{{permission.name}}</data-item>
                <data-item title="Description">{{permission.description}}</data-item>
            </div>
        </b-card>

    </div>
</template>

<script>
    import DataItem from '../../../utilities/DataItem';
    export default {
        name: "Show",
        components: {DataItem},
        props: {
            permission: {
                required: true,
                type: Object
            }
        },
    }
</script>

<style scoped>
    .view-header {
        font-size: 25px;
    }

    .show-card {
        margin-top: 10px;
        margin-bottom: 5px;
    }
</style>
