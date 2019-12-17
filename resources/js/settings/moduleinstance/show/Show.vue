<template>
    <div style="text-align: left;">

        <div>
            <b-card no-body>
                <b-tabs card pills vertical>
                    <b-tab active title="Module Information">
                        <module-instance
                            :module-instance="moduleInstance">

                        </module-instance>
                    </b-tab>
                    <b-tab title="Behaviour">
                        <behaviour
                            :module-instance="moduleInstance">
                        </behaviour>
                    </b-tab>
                    <b-tab title="Settings">
                        <settings :module-instance="moduleInstance"></settings>
                    </b-tab>
                    <b-tab title="Permissions">
                        <permissions :module-instance="moduleInstance"></permissions>

                    </b-tab>
                    <b-tab title="Services">
                        <services :module-instance="moduleInstance"></services>

                    </b-tab>
                    <b-tab title="Actions">
                        <actions :module-instance="moduleInstance">

                        </actions>
                    </b-tab>
                </b-tabs>
            </b-card>
        </div>


    </div>
</template>

<script>
    import ModuleInstance from "./moduleinstance/ModuleInstance";
    import Behaviour from "./behaviour/Behaviour";
    import Permissions from "./../create/permissions/Permissions";
    import Settings from "./../create/settings/Settings";
    import Actions from './actions/Actions';
    import Services from '../create/services/Services';

    export default {
        name: "Show",
        components: {Services, Settings, Permissions, Behaviour, ModuleInstance, Actions},
        props: {
            moduleInstance: {
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
