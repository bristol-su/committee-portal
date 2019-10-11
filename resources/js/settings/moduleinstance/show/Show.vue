<template>
    <div style="text-align: left;">
        <b-card header="Module Instance Registration Information" header-class="view-header" class="show-card">
            <module-instance
            :module-instance="moduleInstance">

            </module-instance>
        </b-card>

        <b-card header="Behaviour" header-class="view-header" class="show-card">
            <behaviour
                :active-id="moduleInstance.active"
                :visible-id="moduleInstance.visible"
                :mandatory-id="moduleInstance.mandatory">

            </behaviour>
        </b-card>

        <b-card header="Settings" header-class="view-header" class="show-card">
            <settings :setting-id="moduleInstance.module_instance_settings_id">

            </settings>
        </b-card>

        <b-card header="Permissions" header-class="view-header" class="show-card">
            <permissions :permission-id="moduleInstance.module_instance_permissions_id">

            </permissions>
        </b-card>

        <b-card header="Actions" header-class="view-header" class="show-card">
            <actions :module-instance="moduleInstance">

            </actions>
        </b-card>

    </div>
</template>

<script>
    import ModuleInstance from "./moduleinstance/ModuleInstance";
    import Behaviour from "./behaviour/Behaviour";
    import Permissions from "./permissions/Permissions";
    import Settings from "./settings/Settings";
    import Actions from './actions/Actions';

    export default {
        name: "Show",
        components: {Settings, Permissions, Behaviour, ModuleInstance, Actions},
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
