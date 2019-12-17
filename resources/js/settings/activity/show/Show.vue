<template>
    <div style="text-align: left;">

        <div>
            <b-card no-body>
                <b-tabs card pills vertical>
                    <b-tab active title="Activity Information">
                        <activity :activity="activity">

                        </activity>
                    </b-tab>
                    <b-tab title="Participants">
                        <logic :logic-id="activity.for_logic">

                        </logic>
                    </b-tab>
                    <b-tab title="Admins">
                        <logic :logic-id="activity.admin_logic">

                        </logic>
                    </b-tab>
                    <b-tab title="Modules">
                        <module-index
                            :activity="activity">

                        </module-index>
                    </b-tab>
                </b-tabs>
            </b-card>
        </div>


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
