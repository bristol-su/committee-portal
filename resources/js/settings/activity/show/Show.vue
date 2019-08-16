<template>
    <div style="text-align: left;">
        <b-card header="Activity" header-class="view-header" class="show-card">
            <activity :activity="activity">

            </activity>
        </b-card>

        <b-card header="Participants" header-class="view-header" class="show-card">
            <logic :logic-id="activity.for_logic">

            </logic>
        </b-card>

        <b-card header="Administrators" header-class="view-header" class="show-card">
            <logic :logic-id="activity.admin_logic">

            </logic>
        </b-card>

        <b-card header="Modules" header-class="view-header" class="show-card">
            <module-index
                :activity="activity">

            </module-index>
        </b-card>

    </div>
</template>

<script>
    import ModuleIndex from './module-instance/index/Index';
    import Activity from './activity/Activity';
    import Logic from "./activity/Logic";

    export default {
        name: "Show",
        props: {
            activity: {
                required: true,
                type: Object
            }
        },

        components: {
            ModuleIndex,
            Activity,
            Logic
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
