<template>
    <div style="text-align: left;">
        <b-card header="Logic Information" header-class="view-header" class="show-card">
            <logic :logic="logic"></logic>
        </b-card>

        <b-card header="Filters" header-class="view-header" class="show-card">
            <filters :logic-id="logic.id">

            </filters>
        </b-card>

        <b-card header="Audience" header-class="view-header" class="show-card">
            <audience :logic-id="logic.id">

            </audience>
        </b-card>
    </div>
</template>

<script>
    import Logic from "./Logic";
    import DataItem from "../../../utilities/DataItem";
    import FilterGroup from "./filters/FilterGroup";
    import Filters from "./filters/Filters";
    import Audience from "./audience/Audience";

    export default {
        name: "Show",
        components: {Filters, FilterGroup, DataItem, Logic, Audience},
        props: {
            logic: {
                required: true,
                type: Object
            }
        }
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
