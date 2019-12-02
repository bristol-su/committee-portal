<template>
    <div class="row">
        <module-instance
            v-for="moduleInstance in activity.module_instances"
            :key="moduleInstance.id"
            :module-instance="moduleInstance"
            :evaluation="evaluationObject(moduleInstance.id)"
            :activity="activity"
            :admin="admin">

        </module-instance>
    </div>
</template>

<script>
    import ModuleInstance from './ModuleInstance';
    export default {
        name: "ModuleInstances",
        components: {ModuleInstance},
        props: {
            activity: {
                required: true,
                type: Object,
            },
            admin: {
                required: true,
                type: Boolean
            },
            evaluation: {
                required: false,
                default() {
                    []
                }
            }
        },

        methods: {
            evaluationObject(id) {
                return (this.evaluation[id] !== undefined
                    ? this.evaluation[id]
                    : {
                        active: false,
                        visible: false,
                        mandatory: false,
                    });
            },


        }
    }
</script>

<style scoped>

</style>
