<template>
    <div style="text-align: left;">
        <b-card header="Permission" header-class="view-header" class="show-card">
            <div>
                <data-item title="Name">{{permission.name}}</data-item>
                <data-item title="Description">{{permission.description}}</data-item>
                <data-item title="Shorthand">{{permission.ability}}</data-item>
            </div>
        </b-card>

        <b-card header="Assigned To" header-class="view-header" class="show-card">
            <assign-permissions
                :permission="permission">

            </assign-permissions>
        </b-card>

    </div>
</template>

<script>
    import DataItem from '../../../utilities/DataItem';
    import AssignPermissions from './AssignPermissions';
    export default {
        name: "Show",
        components: {AssignPermissions, DataItem},
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
